<?php
 class Connection
 {
     private $host_name = "localhost";
     private $username = "root";
     private $password = "";
     private $db_name = "e-commerce";
     private const port = 3306;
     public $conn;
 
     public function __construct()
     {
         $this->conn = new mysqli($this->host_name, $this->username, $this->password, $this->db_name, self::port);
     }
 }

 
 
	?>

