<?php

class Categories{
    private $Database;
		private $db_table = "categories";
		
		function __construct(){
			global $Database;
			$this->Database = $Database;
		}



	public function	get_categories($id = null){
		$data = [];
		if($id != null){
			if($stmt = $this->Database->prepare("select id, name from " . $this->db_table . " where id = ? limit 1")){
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$stmt->store_result();

				$stmt->bind_result($cat_id, $cat_name);
				$stmt->fetch();

				if($stmt->num_rows > 0){

					$data = ['id' => $cat_id, 'name' => $cat_name];
				}
				$stmt->close();
			}

		}else{
			if($result = $this->Database->query("select * from " . $this->db_table . " order by name")){
				if($result->num_rows > 0){
					while($row = $result->fetch_array()){
						$data[] = ['id' => $row['id'], 'name'=> $row['name']];
					}
				}
			}
		}
		return $data;	
	}



	public function create_category_nav($active = null){

		$categories = $this->get_categories();


		$data = '<li';
		if($active == strtolower('home')){
			$data .= ' class="active"';
		}
		$data .= '><a href="' . SITE_PATH .  '">View All</a></li>';

		if( ! empty($categories)){

			foreach($categories as $category){
				$data .= '<li';
				if(strtolower($active) == strtolower($category['name'])){
					$data .= 'class="active"';

				}
				$data .= '><a href= "' . SITE_PATH . 'index.php?id=' . $category['id'] . '">' . $category['name'] . '</a></li>';
			}
		}
		return $data;
	}


}