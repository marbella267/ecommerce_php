<?php
class Data{
    protected $con ;
    public function __construct($connn){
        $this -> con = $connn;
    }
    public function SetData($product_id,$user_id,$order_quantity,$price){
        $query = "INSERT INTO `data`(`product_id`, `user_id`, `order_quantity`,`totalprice`) VALUES ('$product_id','$user_id','$order_quantity','$price')";
        $res =$this -> con-> conn-> query($query);
        return $res;
    }
    public function GetData($id=0){
        if($id){
        $query = "SELECT * FROM `data` WHERE `user_id`=$id ";
        $data = $this -> con-> conn-> query($query)->fetch_all(MYSQLI_ASSOC);
        return $data;
        }
        $query = "SELECT * FROM `data` ";
        $data = $this -> con-> conn-> query($query)->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function DeleteData($id=0){
        if($id){
        $query = "DELETE FROM `data` WHERE `product_id`=$id ";
        $this -> con-> conn-> query($query) ;
        return ;
    }
    else{
        $query = "DELETE FROM `data` ";
        $this -> con-> conn-> query($query) ;
        return ;
    }
     
    }
    public function UpdateData($product_id,$order_quantity,$price){
        $query="UPDATE `data` SET  `order_quantity`='$order_quantity',`totalprice`='$price' WHERE `product_id`=$product_id";
        $this -> con-> conn-> query($query) ;
        
    }
}