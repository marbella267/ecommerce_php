<?php
$user_id = $_GET['id'];
$time = $_GET['create'];
$date = $_GET['date'];
?>
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
if($_SERVER['REQUEST_METHOD']=='POST'){
    $date = $_POST['date'];
    $status = $_POST['status'];
    $id = $_POST['id'];
    $time = $_POST['time'];
    header("location:http://localhost/ecommerce_php/dashboard/order/updateorder.php?id=$id&create=$time&date=$date&status=$status");
} 
require "../../views/sidebar.php";
$con = new Connection();
$order = new order($con);
$user = new user($con);
$product = new product($con);
$orderdata = $order->SelectOrder((int)$user_id,$time);
$user_data = $user->get_user_by_id($orderdata[0]['user_id']);
$name = $user_data[0]['name'];
$phone = $user_data[0]['phone'];
$email = $user_data[0]['email'];
$address = $user_data[0]['address'];
$price = $orderdata[0]['price'];
$time = $orderdata[0]['time'];
$status = $orderdata[0]['status'];
$products = explode(',',$orderdata[0]['products']);
$quantity = explode(',',$orderdata[0]['quantity']);
 
 ?>
 <div class='col content'>
 <div class="card container mt-5">
  <div class="card-header text-center">
    Order
  </div>
  <div class="card-body gx-5 justify-content-center row">
    <div class='d-inline-block col-5 mt-5'>
    <h4 class="card-title   text-muted">Customer data</h4>
    <p class="card-text mt-4">
         <?php
         echo "<p class='text-muted fw-bolder'>Name: <span class='fw-normal'>$name</span></p> ";
         echo "<p class='text-muted mt-4 fw-bolder'>Phone: <span class='fw-normal'>$phone</span></p> ";
         echo "<p class='text-muted mt-4 fw-bolder'>Email: <span class='fw-normal'>$email</span></p> ";
         echo "<p class='text-muted mt-4 fw-bolder'>Address: <span class='fw-normal'>$address</span></p> ";
         ?>
    </p>
</div>
<div class='d-inline-block mt-5 col-5'>
    <h5 class="card-title   text-muted">order</h5>
    <p class="card-text mt-4 ">
         <?php
         echo "<p class='text-muted mt-4 fw-bolder'>price: <span class='fw-normal'>$$price</span></p>";
         echo "<p class='text-muted mt-4 fw-bolder'>due date: <span class='fw-normal'>$time</span></p>";
        echo "<ol class='list-group list-group-numbered mt-5'>";
        for($i=0;$i<count($products);$i++){
                $proname=$product->GetProducts($products[$i])[0]['product_name'];
                echo "
                <li class='list-group-item d-flex justify-content-between align-items-start'>
                <div class='ms-2 me-auto'>
                $proname
              </div>
              <span class='badge bg-primary '>quantity $quantity[$i]</span>
          
                </li>";
        }  
        echo "</ol>";
        
    $modal = 'i';
   echo " </p>
    <a  class='del btn ' data-bs-toggle='modal' data-bs-target='#$modal' type='submit'>
    update
    </a>
    <div class='modal fade' id=$modal tabindex='-1'   aria-labelledby=$modal aria-hidden='true'>
    <div class='modal-dialog' >
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id=$modal>Update Order</h5>
          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
          </button>
        </div>
        <div class='modal-body'>
           <form method='post'>
           <div class='d-inline-block'>
          <label class='form-label'>status</label>
          <select  class='form-select  ' name='status'>";?>
            <option  class='text-danger' <?php if($status=='canceled'){echo "selected";}?> vlaue='canceled'>canceled</option>
            <option  class='text-muted bold' <?php if($status=='completed'){echo "selected";}?> vlaue='completed'>completed</option>
            <option  class='text-success  bold' <?php if($status=='processing '){echo "selected";}?> vlaue='processing'>procssing</option>
          </select>
</div>
          <div class='d-inline-block mx-3'>
          <label class='form-label'>due date yyyy-mm-dd format</label>
          <input type='text' name='date' value='<?php echo $time?>' class='form-control  '>
          <input type='text' name='id' value='<?php echo $orderdata[0]['user_id']?>' class='visually-hidden' >
          <input type='text' name='time' value='<?php echo $orderdata[0]['created_at']?>' class='visually-hidden' >
          
</div>
            
   
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
          <button type='submit' class='btn del'>update</button>
        </div>
  </form> 
  </div>
    </div>
  </div>
</div>
  </div>
  
  <div class="card-footer text-center text-muted">
    <?php echo "<p class='d-inline-block'>$date </p><p class='w-25 d-inline-block'></p>";     
    if($status=='processing '){
                echo "<p class='text-success d-inline-block' >processing <i class='fa-solid fa-spinner'></i></p>";
         }elseif ($status=='completed') {
            echo "<p class='text-secondary d-inline-block'>completed <i class='fa-solid fa-circle-check'></i></p>";
         }else{
            echo "<p class='text-danger d-inline-block'>canceled <i class='fa-solid fa-ban'></i></p>";
         }?>
  </div>
</div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>