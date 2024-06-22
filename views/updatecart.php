<?php
spl_autoload_register(function($class){
    require "../modules/".$class.=".php";
});
if($_GET['id']){
$id = $_GET['id'];
$quantity = $_POST['quantity'];
}
else{
    $id=0;
}
$con = new Connection();
$data = new Data($con);
$product = new product($con);
$prodata = $product->GetProducts($id);
$price = $quantity * $prodata[0]['price'];
$data -> UpdateData($id,$quantity,$price);
header("location:http://localhost/ecommerce_php/views/cart.php");
?>