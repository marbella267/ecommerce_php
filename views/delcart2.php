<?php
spl_autoload_register(function($class){
    require "../modules/".$class.=".php";
});
if($_GET['id']){
$id = $_GET['id'];
}
else{
    $id=0;
}
$con = new Connection();
$data = new Data($con);
$data -> DeleteData($id);
header("location:http://localhost/ecommerce_php/views/cart.php");
?>