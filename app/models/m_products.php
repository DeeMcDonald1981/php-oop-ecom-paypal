<?php 

class Products{
	private $Database;
	private $db_table = 'products';

	function __construct(){
		global $Database;
		$this->Database = $Database;
	}

	public function get($id = null){
		$data = [];
		if(is_array($id)){

		}elseif($id != null){
			if($stmt = $this->Database->prepare("select 
			$this->db_table.id,
			$this->db_table.name,
			$this->db_table.description,
			$this->db_table.price,
			$this->db_table.image,
			categories.name AS category_name
			from $this->db_table, categories
			where $this->db_table.id = ? and $this->db_table.category_id = categories.id")){
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($prod_id, $prod_name, $prod_description, $prod_price, $prod_image, $cat_name);
				$stmt->fetch();

				if($stmt->num_rows > 0){
					$data = ['id' => $prod_id, 'name' => $prod_name, 'description' => $prod_description, 'price' => $prod_price, 'image' => $prod_image, 'category_name' => $cat_name ];
				}
				$stmt->close();
			}
		}else{
			if($result = $this->Database->query("select * from " . $this->db_table . " order by name")){
				if($result->num_rows > 0){
					while($row = $result->fetch_array()){
						$data[] = [
							'id' => $row['id'],
							'name' => $row['name'],
							'price' => $row['price'],
							'image' => $row['image'],
						];
					}
				}
			}
		}
		return $data;
  }

  public function get_in_category($id){

  }
  

  public function create_product_table($cols = 4, $category = null){
    if($category != null){
      $products = $this->get_in_category($category) ;
    }else{
      $products = $this->get();
    }
    $data = '';

    if( ! empty($products)){
      $i  = 1;
      foreach($products as $product){
        $data .= '<li';
        if($i == $cols){
          $data .= ' class="last"';
          $i = 0;
        }
        $data .= '><a href="' .SITE_PATH . ' product.php?id=' . $product['id']  . '">';
        $data .=  '<img src="' . IMAGE_PATH . $product['image'] . '" alt="' . $product['name'] . '"><br>';
        $data .= '<strong>' . $product['name'] . '</strong></a><br>$' . $product['price'];
        $data .= '<br><a class="button_sml" href="' . SITE_PATH . 'cart.php?id=' . $product['id'] . '">Add to cart</a></li>';
        $i++;
      }
    }
    return $data;
  }


}/* Products Class */

