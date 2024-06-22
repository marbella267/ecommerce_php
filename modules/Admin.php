<?php
// require '../modules/Connection.php';
class Admin
{
    private $username;
    private $password;
    private $con;
    public function __construct($connn){
         $this -> con = $connn;
    }
    public function Access_check($postdata){
        $data = $this -> con -> conn -> query("SELECT * FROM `admin`")->fetch_all(MYSQLI_ASSOC); 
        $count =0;
        foreach ($data as $arr => $value1) {
            foreach ($postdata as $key => $value) {
                 if($value == $value1['username']){
                    $count +=1;
                 }
                 if($value == $value1['password']){
                    $count+=1;
                 }
            }
        }
        if($count==2){
            return true;
        }
        return false;
    }
    public function Check_Admin($username){
        if($username=='mai'){
            return true;
        }else{
            return false;
        }
    }
    public function GetAdmins($id=0){
        if($id){
                $query = "SELECT * FROM `admin` WHERE `admin_id`=$id";
                $data = $this -> con -> conn -> query($query) -> fetch_all(MYSQLI_ASSOC);
                return $data ; 
             }
            $query = "SELECT * FROM `admin`";
            $data = $this -> con -> conn -> query($query) -> fetch_all(MYSQLI_ASSOC);
            return $data ; 
        }
    public function AddAdmins($username,$password){
        $query2 = "INSERT INTO `admin`(  `username`, `password`) VALUES ( '$username','$password')";
        $this -> con -> conn -> query($query2);
    }
    public function DeleteAdmin($id){
        $query = "DELETE FROM `admin` WHERE `admin_id` = $id";
            $result = $this -> con -> conn -> query($query);
    }

}
 
 
