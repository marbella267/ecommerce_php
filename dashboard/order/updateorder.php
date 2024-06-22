<?php
$user_id = (int)$_GET['id'];
$time = $_GET['create'];
$status = $_GET['status'];
$date = (string)$_GET['date'];
echo $time;

spl_autoload_register(function($class){
    require "../../modules/".$class.=".php";
  });
$con = new Connection();
$order = new order($con);

if($status=='canceled'){
  $orderdata=$order->OrdersData($user_id,$time);
  $products = explode(',',$orderdata[0]['products']);
  $quantity = explode(',',$orderdata[0]['quantity']);
  for($i=0;$i<count($products);$i++){
      $order->UpdateProductQuantity((int)$products[$i],(int)$quantity[$i]);
  }
}
 $order->EditOrder($user_id,$time,$status,$date);
header("location:http://localhost/ecommerce_php/dashboard/order/");

?>