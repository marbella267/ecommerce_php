<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="./next.css?v=<?php echo time(); ?>">
    <style>
        .input {
            position: absolute;
            font-size: 50px;
            opacity: 0;
            right: 0;
            top: 0;
            cursor: pointer !important;

        }

        .file {
            cursor: pointer !important;
            position: relative;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <?php
    spl_autoload_register(function ($class) {
        require "../modules/" . $class .= ".php";
    });
    $con = new Connection();
    $user = new User($con->conn);
    ?>

    <div class='container-fluid h-100 mx-0'>
        <div class='row h-100'>
            <?php
            session_start();
            if (!isset($_SESSION['email'])) {
                header('location:http://localhost/ecommerce_php/views/userlogin.php');
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user->update_user($_POST["name"], $_POST["email"], $_POST["password"], $_POST["phone"], $_POST["address"]);
            }
            $data = $user->get_user_data($_SESSION["email"]);
            // var_dump($data);
            require "./usersidebar.php";
            ?>
            <div class='content col ps-5'>
                <h1>Account</h1>
                <div class="w-50">
                    <form method="post" action="upload.php" class="position-relative" enctype="multipart/form-data">
                        <img src="
                        <?php 
                            echo '../uploads/'.$data['img'];
                        ?>" alt="Profile Photo" class="img-fluid" style="border-radius: 50%; width: 120px; height: 110px; object-fit: cover;">
                        <div class="file btn btn-warning ms-4">
                            Upload New Picture
                            <input class="input" type="file" name="profile_photo" />
                        </div>
                        <input type="submit" name="submit" value="Save Photo" class="btn btn-primary">
                    </form>
                </div>
                    <p class=" fs-3 text-danger"><?php 
                    if(isset($_GET["error"])){
                        echo $_GET["error"];
                    }
                    ?></p>
                <div>
                    <form action="" method="post" class="mt-5 w-75">
                        <div class="row row-cols-2 flex-wrap">
                            <div class=" col-6 my-3">
                                <label for="" class=" fw-semibold fs-5 my-2">Name</label>
                                <input type="text" class="form-control w-75" value="<?php if (isset($data)) {
                                                                                        echo $data["name"];
                                                                                    } ?>" name="name">
                            </div>
                            <div class=" col-6 my-3">
                                <label for="" class=" fw-semibold fs-5 my-2">Email</label>
                                <input type="text" class="form-control w-75" value="<?php if (isset($data)) {
                                                                                        echo $data["email"];
                                                                                    } ?>" name="email">
                            </div>
                            <div class=" col-6 my-3">
                                <label for="" class=" fw-semibold fs-5 my-2">Phone</label>
                                <input type="text" class="form-control w-75" value="0<?php if (isset($data)) {
                                                                                            echo $data["phone"];
                                                                                        } ?>" name="phone">
                            </div>
                            <div class=" col-6 my-3">
                                <label for="" class=" fw-semibold fs-5 my-2">Address</label>
                                <input type="text" class="form-control w-75" value="<?php if (isset($data)) {
                                                                                        echo $data["address"];
                                                                                    } ?>" name="address">
                            </div>
                            <div class=" col-6 my-3">
                                <label for="" class=" fw-semibold fs-5 my-2">Password</label>
                                <input type="text" class="form-control w-75" value="<?php if (isset($data)) {
                                                                                        echo $data["password"];
                                                                                    } ?>" name="password">
                            </div>
                        </div>
                        <input type="submit" value="Save Changes" class="btn btn-success my-3">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>