<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../index.css?v=<?php echo time(); ?>">
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Document</title>
</head>
<body>   
 <div class='container'>
  <div calss='row g-0'>
  <?php 
  session_start();
  spl_autoload_register(function($class){
  require "../../modules/".$class.=".php";
});
 if(!isset($_SESSION['username'])){
  header('location:http://localhost/ecommerce_php/views/adminLogin.php');
}
require "../../views/sidebar.php";
 ?>
          
<div class='content h-100 col mt-4'   >
  <div class='product h-100 w-100'  >
<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
 $con = new Connection();
 if(trim($_POST['name']) && trim($_POST['image']) && trim($_POST['desc']) && trim($_POST['brief'])){
   
   print_r($_POST);
   $product = new product($con);
   $product -> SetProduct($_POST['name'],$_POST['image'],$_POST['desc'],$_POST['quantity'],$_POST['price'],$_POST['cid'],$_POST["brief"]);
   header('location:http://localhost/ecommerce_php/dashboard/product?page=1');
 }
}
 
//Get all needed data
$con = new Connection();
$product = new product($con);
$num_of_products = count($product->GetProducts());
$start =0;
$product_per_page = 5;
$num_of_pages = ceil($num_of_products/$product_per_page);
$page =1;
if(isset($_GET['page'])){
  $page = $_GET['page'];
  $start = ($page-1) * $product_per_page;

 }
//showing products
$data = $product->Get7Products($start,$product_per_page);?>

<table class='w-100 h-100'>
<tr class='tr mt-5  mx-5'scope='row'>
<th class='text-muted ' style='padding:20px ;' scope='col'> Product Name </th>
<th class='text-muted  ' style='padding:20px;' scope='col'> Price </th>
<th class='text-muted  ' style='padding :20px;' scope='col'> Quantity </th>
<!-- <th class='text-muted  ' scope='col'> Brief</th> -->
<th class='text-muted  ' style='padding :20px;' scope='col'>Status</th>
<th class='text-muted  ' style='padding:20px;' scope='col'> Category Name </th>
<th class='text-muted  ' style='padding:20px;' scope='col'> Action </th>
</tr>
<?php
foreach ($data as $row => $RowData) {
    echo"<tbody   data-bs-toggle='tooltip' data-bs-placement='top' title='view more'> 
    <tr  class='tr w-100 productrow tablerow' scope='row' >
    ";
    foreach ($RowData as $key => $value) {
      $id = $RowData['product_id'];
      if ($key == "product_id" or $key=='description' or $key=='brief' or $key == "updated_on" or $key == "created_at" or $key == "product_img") {
        continue;
      }
      if ($key == 'category_id') {
        $CategoryName = $con->conn->query("SELECT `category_name` FROM `category` WHERE `category_id` = $value ")->fetch_assoc()['category_name'];
        echo "<td data-href='http://localhost/ecommerce_php/dashboard/product/details.php?id=$RowData[product_id]' class='tr' style='padding :20px;' scope='col'>$CategoryName</td>";
        continue;
      }
      echo "<td class='tr' data-href='http://localhost/ecommerce_php/dashboard/product/details.php?id=$RowData[product_id]' style='padding :20px;' scope='col'>$value</td>";
    }
    $name = "name$id";
    echo "<td class='pt-4 d-flex justify-content-center align-content-center'>
   
    <button type='button' class='btn del' data-bs-toggle='modal' data-bs-target='#$name'>
      Delete
    </button>
    <div class='modal fade' id=$name tabindex='-1'   aria-labelledby=$name aria-hidden='true'>
      <div class='modal-dialog' >
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id=$name>Alert</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
               
            </button>
          </div>
          <div class='modal-body'>
            are you sure you want to delete $RowData[product_name] product 
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
            <a type='button' href='http://localhost/ecommerce_php/dashboard/product/delete.php?id=$id' class='btn del'>Delete</a>
          </div>
        </div>
      </div>
    </div>";

 
echo " <a type='button' class='btn updatecat'  href='http://localhost/ecommerce_php/dashboard/product/update.php?id=$id'>
    update
  </a>
    </td>";
    echo " </tr></tbody>";
    
  }
  echo "</table>";
       if(isset($_GET["err"])){
        echo "<div class='alert alert-danger' role='alert'>
        {$_GET['err']}
      </div>";
      }
    
  echo "</div>";
 
?> 
  
   
 <?php
  $name = "add";

  echo "<button type='button' data-bs-toggle='modal' class='btn addcat mt-4' data-bs-target='#$name'>
  Add Product
</button>
<div class='modal-lg modal fade addform' id=$name tabindex='-1'   aria-labelledby=$name aria-hidden='true'>
  <div class='modal-dialog' >
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id=$name>new product</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
        </button>
      </div>";
      ?>
      <div class='modal-body'>
      <form class='form row w-100' method='post' >
      <div class='col-md-6'>
        <label for='inputEmail4' class='form-label mt-2'>Name</label>
        <input type='text' class='form-control' name='name' required>
      </div>
      <div class='col-md-6'>
        <label for='inputPassword4' class='form-label mt-2'>image</label>
        <input type='text' class='form-control' name='image' required>
      </div>
      <div class='col-7'>
        <label for='inputAddress' class='form-label mt-2'>Description</label>
        <input type='textarea' class='form-control' name='desc' required >
      </div>
      <div class='col-7'>
        <label for='inputAddress' class='form-label mt-2'>Brief</label>
        <input type='textarea' class='form-control' name='brief' required >
      </div>
      <div class='col-4'>
        <label for='inputAddress2' class='form-label mt-2'>Quantity</label>
        <input type='number' class='form-control' name='quantity' required>
      </div>
      <div class='col-md-4 h'>
        <label for='inputCity' class='form-label mt-2'>Price</label>
        <input type='number' class='form-control' name='price' required>
      </div>
      <div class='col-9'></div>
      <br>
      
      <div class='col-md-6'>
        <label for='inputState' class='form-label mt-2' >Category</label>
        <select id='inputState' class='form-select' name='cid'>
         <?php
        $con = new Connection();
        $category = new Category($con);
        $data = $category -> GetCategory();
        print_r($data);
        foreach ($data as $key => $row) {
           echo "<option value=$row[category_id]>$row[category_name]</option>";
      }?>
     
        </select>
      </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
        <button type='submit' class='btn addcat' >Add</button>
      </div>
      
    </form>
    </div>
  </div>
</div>
 
</div>
<?php 
  echo "<div class=' buttonsdiv'><h5 class='text-center text-muted'>showing   $page  of  $num_of_pages  pages</h5>";?>
<?php
echo  "
  <ul class='pagination   justify-content-center ul'>
  ";
    if(isset($_GET['page']) && $_GET['page']>1){
      $page = $_GET['page']-1;
       
  echo" <li class='page-item'>
      <a class='page-link' href='?page=$page'><span aria-hidden='true'>&laquo;</span></a>
    </li> ";}
    else{
      echo "<li class='page-item'>
      <a class='page-link' href='#' > <span aria-hidden='true'>&laquo;</span></a>
    </li>";
    }
    
    ?>
    <?php
    for ($i=1; $i <=$num_of_pages ; $i++) { 
       echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
    }
    ?>
    <?php
    if(isset($_GET['page']) && $_GET['page']<$num_of_pages){
      $page = $_GET['page']+1;
  echo" <li class='page-item'>
      <a class='page-link' href='?page=$page'> <span aria-hidden='true'>&raquo;</span></a>
    </li>";
    }
    else{
      echo" <li class='page-item'>
      <a class='page-link' href=''> <span aria-hidden='true'>&raquo;</span></a>
    </li>";
    }?>
  </ul>
   
 
  </div>
    </div>

</div>

    <script>
document.addEventListener("DOMContentLoaded",()=>{
const rows= document.querySelectorAll("td[data-href]");
rows.forEach(row => {
  row.addEventListener('click',()=>{
    window.location.href = row.dataset.href;
  })
});
})
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
    </script>
</body>
</html>  