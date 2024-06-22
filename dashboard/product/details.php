
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../next.css?v=<?php echo time(); ?>">
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Document</title>
</head>
<body>
<div class='container'>
  <div calss='row g-0'>
    <?php
session_start();
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
spl_autoload_register(function($class){
    require "../../modules/".$class.=".php";
  });
$con = new Connection();
$product = new product($con);
$data = $product->GetProducts($id);
$quantity = $data[0]['quantity'];
    require "../../views/sidebar.php";
    ?>
<div class='content container '>
        <div class='row mt-5 w-100 g-1' style='  '>
           <div class='col col-5  '>
            <img style='width:100%;height:100%; ' src="<?php echo $data[0]['product_img']; ?>">
                    </div>
            <div class='col-7 card p-3' style=' border:1px solid #ff8e8e;'>
                 
                 <div class='card-body'>
                <div class='card-title text-center fw-bolder' ><?php  echo $data[0]['product_name'] ?></div><br>
                 <p ><span class='fw-semibold'>Description: </span><?php echo $data[0]['description'] ?><p> 
                <p><span class='fw-semibold'>Brief: </span><?php echo $data[0]['brief'] ?></p> <br>
                <p><span class='fw-semibold'>Price: </span> <?php echo $data[0]['price'] ?></p> <br>
                <?php
                if($data[0]['quantity']==0){
                    echo "<p><span class='fw-semibold'>quantity: </span> $quantity<span class='fw-bolder'><br> Not Available</span></p><br>";
                }else{
                    echo"<p><span class='fw-semibold'>quantity: </span> $quantity </p> ";
                }
                ?>
                <div class='mx-5 row'>
                    <div class='col col-5'></div>
                    <div class='col'>
<?php
                $name = "name$id";
    echo " 
   
    <button type='button' class='btn del' data-bs-toggle='modal' class='d-inline-block' data-bs-target='#$name'>
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
            are you sure you want to delete this product 
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
  </a></div>";?>
              
                </div>
            </div>
 
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>