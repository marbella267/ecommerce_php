<?php
require "../../modules/Connection.php";
$con = new Connection();
require '../../modules/Admin.php';
$id = $_GET['id'];
$admin = new Admin($con);
$admin -> DeleteAdmin($id);
header('location:http://localhost/ecommerce_php/dashboard/admin/');
?> 