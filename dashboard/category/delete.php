<?php
require "../../modules/Connection.php";
$con = new Connection();
require '../../modules/Category.php';
$id = $_GET['id'];
$product = new Category($con);
$product -> DeleteCategory($id);
header('location:http://localhost/ecommerce_php/dashboard/category/');
?> 