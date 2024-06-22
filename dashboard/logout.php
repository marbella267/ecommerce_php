<?php
    session_start();
    session_destroy();
    header("Location:http://localhost/ecommerce_php/views/adminLogin.php");
?>