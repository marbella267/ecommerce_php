<?php
spl_autoload_register(function($class){
    require "../modules/".$class.=".php";
});
$id = $_GET['id'];
$con = new Connection();
$data = new Data($con);
$data -> DeleteData($id);
header("location:http://localhost/ecommerce_php/views/product.php/?id=$id");
?>