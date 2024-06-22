<?php
spl_autoload_register(function($class){
    require "../modules/".$class.=".php";
});
$id = $_GET['id'];
$con = new Connection();
$data = new Data($con);
$order = new order($con);
$dataodata = $data -> GetData();
foreach ($dataodata as $key => $row) {
    $order ->SetOrder($row['user_id'],$row['product_id'],$row['order_quantity'],$row['totalprice']);
    $data -> DeleteData($row['product_id']);
}

header("location:http://localhost/ecommerce_php/views/cart.php");
?>