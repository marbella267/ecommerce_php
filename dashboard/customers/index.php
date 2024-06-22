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
  <div class='row'>

  <?php 
  session_start();
  spl_autoload_register(function($class){
  require "../../modules/".$class.=".php";
});
 
 if(!isset($_SESSION['username'])){
  header('location:http://localhost/ecommerce_php/views/adminLogin.php');
}
require "../../views/sidebar.php";
$con = new Connection();
$userT=new user($con);
$data = $userT->get_users();
$Cdata = $userT -> Customers_data($data);
$users_per_page = 5;
$num_of_users = count($Cdata);
if(isset($_SESSION['option']))
{
if($_SESSION['option']=='recent'){
  $data = $userT->RecentUsers();
  $Cdata = $userT -> Customers_data($data);
}

if($_SESSION['option']=='spent'){
  $Cdata = $userT->MostSpent();
}
if($_SESSION['option']=='oldest'){
  $data = $userT->get_users();
  $Cdata = $userT -> Customers_data($data);
}
if($_SESSION['option']=='orders'){
  $Cdata = $userT -> MostOrders();
}
}
if($_SERVER['REQUEST_METHOD']=='POST'){
  
          if($_POST['filter']=='recent'){
            $_SESSION['option']='recent';
            $data = $userT->RecentUsers();
            $Cdata = $userT -> Customers_data($data);
          }
          if($_POST['filter']=='oldest'){
            $_SESSION['option']='oldest';
            $data = $userT->get_users();
            $Cdata = $userT -> Customers_data($data);
          }
         if($_POST['filter']=='spent'){
          $_SESSION['option']='spent';
          $Cdata = $userT->MostSpent();
                   
                }
        if($_POST['filter']=='orders'){
          $_SESSION['option']='orders';
            $Cdata = $userT->MostOrders();
                }
}

        
        $start =0;
        
        $num_of_pages = ceil($num_of_users/$users_per_page);
        $page =1;
        if(isset($_GET['page'])){
          $page = $_GET['page'];
          $start = ($page-1) * $users_per_page;
         }
 ?>

 <div class='col container content  mt-2 p-0'>
  <div class='row' style=' background-color:white; padding:1%; border-radius: 20px;' > 
  <div class='col col-7 mt-2'>Total Number Of Customers: <?php echo count($data)?></div>
  <div class='col col-1 mt-1 fs-5'>Sort By</div>
    <form method='post' action='#' class='col col-4'>
      <select class='form-select w-50 d-inline'name='filter'>
      <option value='oldest'>Oldest Customers</option>
        <option value='recent' >Recent Customers </option>
        <option value='spent'  >Most Spent</option>
        <option value='orders'  >Most Orders</option>
        </select>
        <button type='submit' class='btn mx-4' style='background-color:#ff8e8e;color:white;border:none;color:white;'>Sort</button>
        </form>
  </div>
 <div class='product mt-4 pt-0 h-100'>
   <table class='table' style='border-width:1px;border-color: #ff8e8e;'>
    <thead>
      <th class='text-muted '>Name</th>
      <th class='text-muted'>E-mail</th>
      <th class='text-muted'>Orders Made</th>
      <th class='text-muted'>Paid Products</th>
      <th class='text-muted'>Spent</th>
  <?php 
  if(($start+$users_per_page)>count($Cdata)){ 
  $end = count($Cdata);}
  else{
    $end=$start+$users_per_page;
  }
  for ($i=$start; $i <$end ; $i++) { 
     echo "<tr>";
     foreach ($Cdata[$i] as $key => $value) {
      echo "<td>$value</td>";
     }
     echo "</tr>";
  }
  echo "</table></div>";
  echo "<div class='mt-3 buttonsdiv'><h5 class='text-center text-muted'>showing   $page  of  $num_of_pages  pages</h5>";
  ?>
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
</div>
</body>
</html>