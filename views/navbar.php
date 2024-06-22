<?php
if(session_status()!=2){
    session_start();
}
spl_autoload_register(function($class){
    require "../modules/".$class.=".php";
});

if(isset($_SESSION['email']))
{
$con = new Connection();
$tabledata = new Data($con);
$user  = new user($con);
$email= $_SESSION['email'];
$user_data = $user -> get_users($email);
$user_id=$user_data[0]['user_id'];
$datao =$tabledata->GetData($user_id); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/navbar.css">
    <link href="style/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>navbar</title>
</head>

<body>
   
<nav class="navbar navbar-expand-lg" style="background-color: white;">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="fw-bold navbar-brand fs-4">
                        e-commerce
                    </div>
                    <div class=" fw-semibold" id="navbar">
                        <div class="navbar-nav ps-5 ms-5 ">
                            <a class="fs-5 nav-link ms-5" href="http://localhost/ecommerce_php/views/index.php">Home</a>
                            <a class="fs-5 nav-link ms-5" href="http://localhost/ecommerce_php/views/products.php">Shop</a>
                            <a class="fs-5 nav-link ms-5" href="http://localhost/ecommerce_php/views/about.php">About</a>
                            <a class="fs-5 nav-link ms-5" href="http://localhost/ecommerce_php/views/contact.php">Contact</a>
                        </div>
                    </div>
                    <div class="navbar-nav">
                        <a class="nav-link mx-3" href="">
                            <span class="fs-2 material-symbols-outlined">
                                search
                            </span></a>
                        <a class="nav-link mx-3" href="http://localhost/ecommerce_php/views/userlogin.php">
                            <span class="fs-2 material-symbols-outlined">
                                person
                            </span></a>
                        <a class="nav-link ms-3" href="http://localhost/ecommerce_php/views/cart.php">
                            <span class="fs-2 material-symbols-outlined">
                                shopping_cart
                            </span></a>
                            </span>
                           <?php if(isset($datao)){echo count($datao);}?>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">

</script>
    </body>
</html>