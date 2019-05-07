<?php

$server = 'localhost';
$user = 'root';
$password = 'thefallen_09';
$db = 'ks_shop';
$Database = new mysqli($server, $user, $password, $db);

mysqli_report(MYSQLI_REPORT_ERROR);
ini_set('display_errors', 1);
define('SITE_NAME', 'My Online Store');
define('SITE_PATH', 'http://localhost/LocalServer/projects/full_stack/ecom/');
define('IMAGE_PATH','http://localhost/LocalServer/projects/full_stack/ecom/resources/images/');

include('app/models/m_template.php');
include('app/models/m_categories.php');
include('app/models/m_products.php');

$Template = new Template();
$Categories = new Categories();
$Products = new Products();

session_start();