<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./index.css?v=<?php echo time(); ?>">
  <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./next.css">
    <title>Document</title>
</head>
<body>
<div class='container-fluid h-100 mx-0'>
 <div class='row  h-100'>
 <?php 
  session_start();
  spl_autoload_register(function($class){
  require "../modules/".$class.=".php";
});
 require "./usersidebar.php";
 if(!isset($_SESSION['email'])){
  header('location:http://localhost/ecommerce_php/views/userLogin.php');
}?>
 
<div class='col col-2'></div>
<div class='content container col mx-3 mt-3'>
<?php $con = new Connection();
$user = new user($con);
$order = new order($con);
$user_id = $user->get_user_id_by_email($_SESSION["email"])[0]["user_id"];
$data = $order->Orderuser($user_id);

$product = new product($con);   
//make update to order 
 if($_SERVER['REQUEST_METHOD']=='POST'){
          $date = $_POST['date'];
          $status = $_POST['status'];
          $id = $_POST['id'];
          $time = $_POST['time'];
          header("location:http://localhost/ecommerce_php/dashboard/order/updateorder.php?id=$id&create=$time&date=$date&status=$status");
   } 
//start design?>
<?php
echo "<div class='product h-100 w-100 mt-3'>
<table class=' '>
<tr>
<th style='padding-left:20px ;'>user name</th>
<th>Total Price</th>
<th>Order Date</th>
<th>Products</th>
<th>Status</th>
<th>Due Date</th>
</tr>
";
 ?>
 <?php
 //getting all needed data
      foreach ($data as $key => $row) {
         date_default_timezone_set('africa/cairo');
         $datesec = time()-strtotime($row['created_at']) ;
         $datemin = round($datesec/60);
         $datehours = round($datesec/(60*60));
         $datedays = round($datesec/(60*60*24));
         if($datedays>0){
          $date=$datedays.' days ';
          if($datedays==1){
            $date = $datedays.' day';
          }
         }elseif ($datehours>0) {
           $date=$datehours.' hours ago';
         }elseif ($datemin>0) {
          $date = $datemin.' minutes ago';
          
         }else{
          $date = 'just now';
         }if($datehours>24){
           
          $datenewhours =  abs(($datehours)-(($datedays*(60*60*24))/(60*60)) );
         }
        $products = explode(',',$row['products']);
         $quantity = explode(',',$row['quantity']);
         $value = $row['order_id'];
         $id = "hi$value";
         $name=$user->get_user_by_id(((int)$row['user_id']))[0]['name'];
         $collapse = "coll$value";
         $count = count($products);
         $modal = "modal$row[order_id]";
         if($row['status']=='canceled'){
         $selectstyle = 'text-danger';
        }elseif ($row['status']=='processing ') {
          $selectstyle = 'text-success';
        }else{
          $selectstyle = 'text-muted';
        }
        //pass data to the row in table
         echo "
         <tbody  data-bs-toggle='tooltip' data-bs-placement='top' title='view more'> 
         <tr  scope='row' class=' tr w-100 productrow tablerow' >
          <td style='padding-left:20px' class='tr' data-href='http://localhost/ecommerce_php/dashboard/order/details.php?id=$row[user_id]&create=$row[created_at]&date=$date'  scope='col'>$name</td>
          <td class='tr' data-href='http://localhost/ecommerce_php/dashboard/order/details.php?id=$row[user_id]&create=$row[created_at]&date=$date'  scope='col'>$$row[price]</td>";
          if($datehours>24){
          echo "<td data-href='http://localhost/ecommerce_php/dashboard/order/details.php?id=$row[user_id]&create=$row[created_at]&date=$date'>$date and $datenewhours hours ago</td>";
          }
      else{
        echo "<td class='tr'  data-href='http://localhost/ecommerce_php/dashboard/order/details.php?id=$row[user_id]&create=$row[created_at]&date=$date' scope='col' >$date </td>";
      }
        echo "<td class='tr' style='padding-bottom :-20px;' scope='col' class=' mt-0 hov d-inline-block'>
         <div class='col mt-0 table-hover  d-inline-block' >
         <div class='accordion mt-0 accordion-flush'   id=$id >
        <div class='accordion-item mt-0'>
          <h2 class='accordion-header mt-0' style='background-color:red;' >
            <span class='accordion-button mt-0 collapsed' type='button'  data-bs-toggle='collapse' data-bs-target='#$collapse' aria-expanded='false' aria-controls='#$collapse'>
               <span class='badge  rounded-pill '>
            $count products </span>
            </span>
          </h2>
          <div id=$collapse class='accordion-collapse collapse' data-bs-parent='.table'>
            <div class='accordion-body'> 
             <table class='table'>
             <tr>
             <th class='text-muted  '>Product</th>
             <th class='text-muted '>quantity</th>
             </tr>
            ";
         
        for ($i=0; $i <count($products) ; $i++) { 
         echo"<tr>";
         $name=$product->GetProducts($products[$i])[0]['product_name'];
         echo "<td>$name</td>";
         echo "<td class='text-center'>$quantity[$i]</td>";
      
        echo"</tr>";
        }
      echo "</table> 
      </div>
      </div>
    </div>
    </div>
     
    </td>
    <td>";
    if($row['status']=='processing '){
      echo "<p class='text-success d-inline-block' >processing <i class='fa-solid fa-spinner'></i></p>";
}elseif ($row['status']=='completed') {
  echo "<p class='text-secondary d-inline-block'>completed <i class='fa-solid fa-circle-check'></i></p>";
}else{
  echo "<p class='text-danger d-inline-block'>canceled <i class='fa-solid fa-ban'></i></p>";
}
    echo" </td>
    <td data-href='http://localhost/ecommerce_php/dashboard/order/details.php?id=$row[user_id]&create=$row[created_at]&date=$date'>$row[time]</td>
    <td>
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
          <select  class='form-select  $selectstyle' name='status'>";?>
            <option  class='text-danger' <?php if($row['status']=='canceled'){echo "selected";}?> vlaue='canceled'>canceled</option>
            <option  class='text-muted bold' <?php if($row['status']=='completed'){echo "selected";}?> vlaue='completed'>completed</option>
            <option  class='text-success  bold' <?php if($row['status']=='processing '){echo "selected";}?> vlaue='processing'>procssing</option>
          </select>
</div>
          <div class='d-inline-block mx-3'>
          <label class='form-label'>due date yyyy-mm-dd format</label>
          <input type='text' name='date' value='<?php echo $row['time']?>' class='form-control  '>
          <input type='text' name='id' value='<?php echo $row['user_id']?>' class='visually-hidden' >
          <input type='text' name='time' value='<?php echo $row['created_at']?>' class='visually-hidden' >
          
</div>
            
   
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
          <button type='submit' class='btn del'>update</button>
        </div>
  </form> 
 
     <?php echo"</div>
    </div>
  </div>
    </td>
    </tr>
    </tbody> ";

      }echo"</table>
</div>";?>
 
</div>
</div> 
 

</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
</html>