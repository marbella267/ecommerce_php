<?php  
session_start();
spl_autoload_register(function($class){
  require "../../modules/".$class.=".php";
});
$con = new Connection();
 $admin = new Admin($con);
 $data = $admin -> GetAdmins();
if($_SERVER['REQUEST_METHOD']=='POST'){
  $admin->AddAdmins($_POST['username'],$_POST['password']);
  header('location:http://localhost/ecommerce_php/dashboard/admin/');
}
?>
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
<div class='content w-75 h-100 col mt-4'>
  <div class='product h-100  mt-5 mx-5'>
 <?php 


 if($_SESSION['username']!='mai'){
  header('location:http://localhost/ecommerce_php/dashboard/');
 }
  require "../../views/sidebar.php";
 ?>
<table class='table w-100 h-100 p-3'>
<tr class='tr mt-5 'scope='row'>
<th class='text-muted 'scope='col'> Admin Id</th>
<th class='text-muted 'scope='col'> Admin Name</th>
<th class='text-muted 'scope='col'> Admin Password</th>
<th class='text-muted  ' scope='col'> Action </th>
</tr>
<?php
foreach ($data as $row => $RowData) {
  if($RowData['username']!='mai' or $RowData['admin_id']!=1 or $RowData['password']!=1234){
    echo "<tr class='tr' scope='row'>";
    foreach ($RowData as $key => $value) {
      $id = $RowData['admin_id'];
      if ( $key == "updated_on" or $key == "created_at" ) {
        continue;
      }
      echo "<td class='tr' scope='col'>$value</td>";
    }
    $name = "name$id";
    echo "<td>
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
            are you sure you want to delete $RowData[username] 
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
            <a type='button' href='http://localhost/ecommerce_php/dashboard/admin/delete.php?id=$id' class='btn del'>Delete</a>
          </div>
        </div>
      </div>
    </div></td>";

echo "</tr>";}
    
  }
echo "</table></div>";?>
 <?php
  $name = "addadmin";
if(count($data)<6){
  echo "<button type='button' data-bs-toggle='modal' class='btn addcat mt-5 mx-5' data-bs-target='#$name'>
  Add Admin
</button>
<div class='modal modal fade addform' id=$name tabindex='-1'   aria-labelledby=$name aria-hidden='true'>
  <div class='modal-dialog' >
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id=$name>new admin</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
        </button>
      </div>
       
      <div class='modal-body'>
      <form class='form ' method='post' >
      <div class='col-md-6'>
        <label for='inputEmail4' class='form-label mt-2'>Name</label>
        <input type='text' class='form-control' name='username' required>
      </div>
      <div class='col-5'>
        <label for='inputAddress2' class='form-label mt-2'>password</label>
        <input type='password' class='form-control' name='password' required>
      </div>
      <div class='col-9'></div>
      <br>
    
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
        <button type='submit' class='btn addcat' >Add</button>
      </div>
    </form>
    </div>
  </div>
</div>";}
 ?>
 
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>