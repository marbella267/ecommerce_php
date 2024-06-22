<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="./style/bootstrap.min.css" rel="stylesheet">
    <link href="./style/userlogin.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<?php
require("../modules/user.php");
require("../modules/Connection.php");
$err = '';
$conn = new Connection;
session_start();
if (isset($_COOKIE["sessionId"])) {
    $user = new user($conn->conn);
    $check = $user->get_user_session($_COOKIE["sessionId"]);
    if ($check) {
        header("location: http://localhost/ecommerce_php/views/useraccount.php");
    } else {
        setcookie("sessionId", "", time() - 1456);
        header("Location: http://localhost/ecommerce_php/views/userlogin.php");
    }
} else if (isset($_SESSION["email"])) {
    header("location: http://localhost/ecommerce_php/views/useraccount.php");
} else if (isset($_SESSION["username"])) {
    header("location: http://localhost/ecommerce_php/dashboard");
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = new user($conn->conn);
        $err = $user->get_user($_POST);
    }
}

?>

<body>
    <div class="container-fluid p-0">
        <?php
        require('./navbar.php');
        ?>
        <div class="d-flex justify-content-between flex-wrap" style="height: 100vh; padding-top:80px">
            <div class="w-50 main">
                <form method="post" class="p-5">
                    <h3 class="main-color">REGISTERED CUSTOMERS</h3>
                    <p class=" fst-italic fs-5 mt-3">If you have an account, sign in with your email address.</p>
                    <input class="form-control input mt-5 my-4" type="text" name="email" placeholder="E-mail">
                    <input class="form-control input mb-3" type="text" name="password" placeholder="Password">
                    <div class=" flex-column">
                        <div>
                            <input type="checkbox" class="form control mt-2 ms-2" style="width:20px;" name="rem" value="true">
                            <label style="font-size: 19px;">Stay loged in</label>
                        </div>
                        <div class="d-flex justify-content-around align-items-center">
                            <input type="submit" class=" mt-2 mb-4 button submit" value="Log in" />
                            <a type="submit" href="http://localhost/ecommerce_php/views/adminLogin.php" class=" mt-2 mb-4 button submit">Admin</a>
                        </div>
                        <div class="err">
                            <?php
                            if ($err) {
                                echo $err;
                                $err = "";
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="w-50 main">
                <div class="py-5">
                    <h3 class="main-color">REGISTERED CUSTOMERS</h3>
                    <p class="fs-5 mt-3">By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                    <a class=" mt-2 mb-4 button submit d-inline-block" style="height: 40px;" href="http://localhost/ecommerce_php/views/userregister.php">Create an Account</a>
                </div>
            </div>
        </div>
        <?php
        require("./footer.php")
        ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>