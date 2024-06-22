 
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

 ?>
 <div class='container-fluid h-100 mx-0'>
 <div class='row h-100'>
  <?php
  session_start();

 if(!isset($_SESSION['email'])){
   header('location:http://localhost/ecommerce_php/views/userlogin.php');
 }
   require "./usersidebar.php";
 
 ?>
 <div class=' content col  '>
 
</div>
</div>
</div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">

</script>
</body>
</html>