
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Document</title>
</head>
<body>
 <?php
 require "./navbar.php";
 spl_autoload_register(function($class){
    require "../modules/".$class.=".php";
});
$con = new Connection();
$tabledata = new Data($con);
$user  = new user($con);
$product = new product($con);
$category = new Category($con);
if(isset($_SESSION['email']))
{
$email= $_SESSION['email'];
$user_data = $user -> get_users($email);
$user_id=$user_data[0]['user_id'];
$data =$tabledata->GetData($user_id);   
if(isset($_POST['quantity']))
{
$prodata=$product->GetProducts($_GET['id']);
$price = $prodata[0]['price']*$_POST['quantity']; 
$product_id = $_GET['id'];
$res = $tabledata -> SetData($product_id,$user_id,$_POST['quantity'],$price);
header("location:http://localhost/ecommerce_php/views/product.php/?id=$product_id");
}
}
 ?>
    <div class='container mt-5'>
        <div class='row gx-5'>
<div class='col col-8 '>
<?php 
if(!empty($data)){
    echo"
<table class='table'>
        <thead style='background-color:blanchedalmond;'>
            <tr>
            <th>product</th>
            <th>product price</th>
            <th>quantity</th>
            <th>category</th>
            <th>total price</th>
            <th>Action</th>
</tr>
    </thead>";
    
 

$order_price = 0;
$num_product=count($data);
foreach ($data as $key => $row1) {

echo "<tr>";
$productData = $product->GetProducts($row1['product_id']);
$catdata = $category->GetCategory($productData[0]['category_id']);
$catname = $catdata[0]['category_name'];
$totalprice = $row1['order_quantity']*$productData[0]['price'];
$order_price+=$totalprice;
foreach ($productData as $key => $row) {
     echo "<td>$row[product_name]</td>";
     echo "<td>$row[price]</td>";
     echo "<td class='w-25'>
     <form method='post' action='http://localhost/ecommerce_php/views/updatecart.php/?id=$row1[product_id]'>
    <input class='w-25 text-cneter' name='quantity' value=$row1[order_quantity]> 
    <button type='submit' class='btn btn-dark'>
      update
     </button>";
     if($row1['order_quantity']>$row['quantity']){
        $not=1;
    echo" <p class='text-danger'>we only have $row[quantity] of this product</p>";
     echo"<br>";
    }echo"
    </form>
     </td>";
     echo "<td>$catname</td>";
     echo "<td>$totalprice</td>";
     echo "<td><a  href='http://localhost/ecommerce_php/views/delcart2.php/?id=$row1[product_id]' class='delcart text-danger'>
     <i class='fa-solid fa-trash-can'></i>
     </a></td>";
}
    echo "</tr>";
}
 
?>    

</table>
<a class='btn btn-danger' href='http://localhost/ecommerce_php/views/delcart2.php'>Delete All </a>
</div>
<div class='col p-5 mx-4 text-center w-75 card ' style='background-color:blanchedalmond;'>
 <h3 class='card-title text-center'>Cart Totals</h3>
 <div class='card-body mt-4'>
    <p class='card-text fw-bold'>Total Price: <?php echo $order_price;?></p>
    <p class='card-text fw-bold'>Total Products: <?php echo $num_product;?></p>
    <?php
    if(isset($not)){
        echo "<a href='#' class='btn w-50 mt-3 text-light btn-dark' type=''>make order</a>";
    }
    
    else{echo "<a href='http://localhost/ecommerce_php/views/addorder.php' class='btn w-50 mt-3 text-light btn-dark' type='button'>make order</a>";}
    ?>
 </div>
    
</div>
<?php }
else{
    echo "<table class='table'>
    <thead style='background-color:blanchedalmond;'>
        <tr>
        <th>product</th>
        <th>product price</th>
        <th>quantity</th>
        <th>category</th>
        <th>total price</th>
        <th>Action</th>
    </tr>
</thead></br>
<tr>

</tr>
</table><p class='text-muted text-center fs-1 mt-5'>empty cart</p></div>";
}
?>
        </div>
    </div>
</body>
</html>