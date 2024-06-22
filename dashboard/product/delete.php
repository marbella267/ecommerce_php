<?php
require "../../modules/Connection.php";
$con = new Connection();
require '../../modules/product.php';
$id = $_GET['id'];
$product = new product($con);
try{
    $product -> DeleteProduct($id);

}catch(Exception $e){
    $e = "There are not shipped orders that contain this product";
    header("location:http://localhost/ecommerce_php/dashboard/product/?err=$e");
}
?> 