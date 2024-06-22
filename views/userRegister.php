<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="./style/bootstrap.min.css" rel="stylesheet">
    <link href="./style/userregister.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form method="post" class="m-auto main mt-2">
            <h2 class="text-center">register</h2>
            <div class="d-flex justify-content-evenly">
                <div>
                    <label>Username</label>
                    <br>
                    <input class="form-control" type="text" name="name">
                </div>
                <div>
                    <label>email</label>
                    <br>
                    <input class="form-control" type="email" name="email">
                </div>
            </div>
            <div class="d-flex justify-content-evenly">
                <div>
                <label for="">phone</label>
                    <br>
                    <input class="form-control" type="number" name="phone">
                </div>
                <div>
                <label for="">password</label>
                    <br>
                    <input class="form-control" type="text" name="password">
                </div>
            </div>
            <br>
            <div class="w-75 m-auto">    
                <label for="" class>address</label>
                <br>
                <input class="form-control" type="text" name="address">
            </div>
            <div class="d-flex justify-content-evenly my-4">
                <input type="submit" class="btn btn-dark w-25" value="Register" />
            </div>
            
            <?php
        require("../modules/FormValidation.php");
        require("../modules/user.php");
        require("../modules/Connection.php");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $check = new FormValidation($_POST);
            $error = $check->ValidateForm();
            if ($error != []) {
                foreach ($error as $key => $value) {
                    echo "<div class='alert alert-danger' role='alert'>
                    {$value}
                    </div>";
                }
            } else {
                $conn = new Connection;
                $user = new user($conn->conn);
                $user->add_user($_POST["name"], $_POST["password"], $_POST["email"], $_POST["phone"], $_POST["address"]);
            }
        }
        ?>
            </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>