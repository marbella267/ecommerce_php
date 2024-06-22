<?php
    if(isset($_POST["submit"])&&isset($_FILES["profile_photo"])){
        session_start();
        require("../modules/Connection.php");
        require("../modules/user.php");
        $con = new Connection();
        $user = new User($con->conn);
        $img_name = $_FILES["profile_photo"]["name"];
        $img_size = $_FILES["profile_photo"]["size"];
        $img_temp = $_FILES["profile_photo"]["tmp_name"];
        $error = $_FILES["profile_photo"]["error"];
        if($error == 0){
            if($img_size>12550000){
                $em = "Sorry your File is to Large";
                header("Location: http://localhost/ecommerce_php/views/useraccount.php?error=$em");
            }else{
                $img_ex = strtolower(pathinfo($img_name,PATHINFO_EXTENSION));
                $allowed_ext = ["jpg","png","jpeg","enc"];
                if(in_array($img_ex,$allowed_ext)){
                    $new_img_path = uniqid("IMG-",true).''.$img_ex;
                    $image_upload_path = '../uploads/'.$new_img_path ;
                    move_uploaded_file($img_temp,$image_upload_path);
                    $user->update_user_img($new_img_path,$_SESSION["email"]);
                    header("Location: http://localhost/ecommerce_php/views/useraccount.php");
                }
            }
        }else{
            $em = "Unknown Error Occurred";
            header("Location: http://localhost/ecommerce_php/views/useraccount.php?error=$em");
        }
    }
?>