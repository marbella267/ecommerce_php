<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="./style/bootstrap.min.css" rel="stylesheet">
    <link href="./style/userlogin.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<?php
session_start();
require("../modules/Connection.php");
$con = new Connection();
$err = '';
require "../modules/Admin.php";
$admin = new admin($con);
if(isset($_SESSION['username'])){
    header("location:http://localhost/ecommerce_php/dashboard/");
}else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $res = $admin->Access_check($_POST);
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    if ($res) {
        header("location:http://localhost/ecommerce_php/dashboard/");
    } else {
        $err = 'sorry you do not have the access to dashboard';
        session_destroy();
    }
}
?>

<body>
    <div class="container-fluid p-0">
        <?php
        require('./navbar.php');
        ?>
        <div class="d-flex justify-content-between" style="height: 80vh; padding-top:0px">
            <div class="w-50 main m-auto">
                <form method="post" class="p-5">
                    <h3 class="main-color">Admin Login</h3>
                    <p class=" fst-italic fs-5 mt-3">If you have an account, sign in with your email address.</p>
                    <input class="form-control input mt-5 my-4" type="text" name="username" placeholder="Username">
                    <input class="form-control input mb-3" type="text" name="password" placeholder="Password">
                    <div class="err">
                        <?php
                        if ($err) {
                            echo $err;
                        }
                        ?>
                    </div>
                    <div class=" flex-column">
                        <div class="d-flex justify-content-around align-items-center">
                            <input type="submit" class=" mt-2 mb-4 button submit" value="Log in" />
                            <a type="submit" href="http://localhost/ecommerce_php/views/userlogin.php" class=" mt-2 mb-4 button submit">User</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
        require("./footer.php")
        ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>



<!-- <body>
    <div class="container">
        <form method="post" class="m-auto main mt-5">
            <h2 class="text-center ">Admin Login</h2>
            <label class="my-2">username</label>
            <br>
            <input class="form-control" type="text" value="<?php if (isset($_SESSION['username'])) echo $_SESSION['username'];  ?>" name="username">
            <br>
            <label class="my-2">Password</label>
            <br>
            <input class="form-control" type="text" value="<?php if (isset($_SESSION['password'])) echo "$_SESSION[password]"; ?>" name="password">
            <div class="err">
                <?php
                if ($err) {
                    echo $err;
                }
                ?>
            </div>
            <div class="d-flex justify-content-evenly mt-4">
                <input type="submit" class=" btn btn-primary button" value="Log in" />
                <a class="text-decoration-none btn btn-outline-dark " style="width: 80px;" href="userlogin.php">User</a>
            </div>
        
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body> -->

</html>