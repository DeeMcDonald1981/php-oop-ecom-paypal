<?php 
include('app/init.php');


$category_nav = $Categories->create_category_nav('home');
$Template->set_data('page_nav', $category_nav);

$products = $Products->create_product_table();
$Template->set_data('products', $products);

$Template->load('app/views/v_public_home.php', 'Welcome To My  Store');

?>


