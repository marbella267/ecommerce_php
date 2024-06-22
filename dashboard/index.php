 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="./next.css?v=<?php echo time(); ?>">
</head>
<body>
 <?php
 spl_autoload_register(function($class){
  require "../modules/".$class.=".php";
 });
 $con = new Connection();
 $category = new Category($con);
 $order = new order($con);
 $product = new product($con);
 $NumP = count($product -> GetProducts());
 $NumO=count($order->GetOrders());
 $NumC = count($category->GetCategory());
 $user = new user($con);
 $NumU = count($user -> get_users());
 
 ?>
 <div class='container-fluid h-100 mx-0'>
 <div class='row  h-100'>
  <?php
  session_start();

 if(!isset($_SESSION['username'])){
   header('location:http://localhost/ecommerce_php/views/adminLogin.php');
 }
   require "../views/sidebar.php";
 
 ?>
 <div class=' content col  '>
 <div class=' grid gx-2 g-0'>
  <a class=' info card1 container ' href='http://localhost/ecommerce_php/dashboard/order/'> 
    <div class='littlecard  row row-cols-5 w-75   '>
        <span class='icons orders pt-1 text-center  px-0 col-6 mt-2 d-inline-block'>
            <i class="fa-solid fa-cart-shopping"></i>
        </span>
          <p class=' col  mt-3 '>Orders <br> <?php echo $NumO?></p>
    </div>
</a>
  <a class=' info card2 container ' href='http://localhost/ecommerce_php/dashboard/product/?page=1'> 
    <div class='littlecard  row row-cols-5 w-75   '>
        <span class='icons products pt-1 text-center  px-0 col-6 mt-2 d-inline-block'>
        <i class="fa-brands fa-product-hunt"></i>
        </span>
          <p class=' col  mt-3'>Products <br> <?php echo $NumP?></p>
    </div>
</a>  
  <a class=' info card3 container ' href='http://localhost/ecommerce_php/dashboard/category/?page=1'> 
    <div class='littlecard  row row-cols-5 w-75   '>
        <span class='icons categories pt-1 text-center  px-0 col-6 mt-2 d-inline-block'>
        <i class="fa-regular fa-rectangle-list"></i>
        </span>
          <p class=' col  mt-3  '>categories <br> <?php echo $NumC?></p>
    </div>
</a>
  <a class=' info card4 container ' href='http://localhost/ecommerce_php/dashboard/customers/?page=1'> 
    <div class='littlecard  row row-cols-5 w-75   '>
        <span class='icons users pt-1 text-center  px-0  col-6 mt-2 d-inline-block'>
        <i class="fa-solid fa-user"></i>
        </span>
          <p class=' col  mt-3 '>Customers <br> <?php echo $NumU?></p>
    </div> 
  
</a>
 </div>
 <?php
 //active users data
 $data = $order -> get_users_id();
 $res =[];
 foreach ($data as $key => $value) {
   $res[]=$order->ActiveUsers($value['user_id']);
 }
 usort($res,function($a,$b){
  return $a[0]['value']<$b [0]['value'];
 });
 //popular products data
 $prodata = $product -> GetProducts();
 $resofpro =[];
 foreach ($prodata as $key => $value) {
   $populardata = $order ->  PopularProduct ($value['product_id']);
   $resofpro[]=$populardata;
 }
 usort($resofpro,function($a,$b){
  return $a[0]['value']<$b[0]['value'];
 });
 ?>
<div class='container'>
<div class='row gx-4 gap-5'>
<div class='col col-4 mt-5' style='height:max-content; background-color:white;padding:2%;border-radius:2%;'>
<h3 style='color:#c8aca9;' class='fw-bolder text-center'>Active Users</h3>
<table class='table text-muted mt-4'> 
  <tr>
  <th class='text-muted'>user name</th>
  <th class='text-muted'>spent</th>
  <th class='text-muted'>total orders</th>
</tr>
<?php
$count =0;
foreach ($res as $key => $row) {
  $count+=1;
    $user_name = $user->get_user_by_id($row[0]['user_id'])[0]['name'];
    $price= $row[0]['price'];
    $orders = $row[0]['value'];
     echo "<tr><td>$user_name</td>
     <td>$$price</td>
     <td>$orders</td>
     </tr>";
    if($count>5){
      break;
    }
}
?></table>
 </div>
 <div class='col col-7  mt-5' style='background-color:white;padding:2%;border-radius:2%;'>
 <h3 style='color:#8abf74;' class='fw-bolder text-center'>Popular Products</h3>
<table class='table text-muted mt-4'> 
  <tr>
  <th class='text-muted'>product</th>
  <th class='text-muted'>ordered quantity</th>
  <th class='text-muted'>sales</th>
  <th class='text-muted'>orders</th>
</tr>
<?php
if(count($resofpro)<6){
  $end = count($resofpro);
}else{
  $end = 7;
}
for ($i=0; $i<$end ; $i++) { 
 foreach ($resofpro[$i] as $key => $value) {
   $product_name = $product -> GetProducts($value['product_id'])[0]['product_name'];
   echo "<tr><td>$product_name</td>";
   echo "<td>$value[quantity]</td>";
   echo "<td>$$value[price]</td>";
   echo "<td>$value[value]</td></tr>";
 }
}
?>
</div>
</div>
</div>
</div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">

</script>
</body>
</html>