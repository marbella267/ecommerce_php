<?php
 
class Category  
{
    private $con;
    public function __construct($connn){
         $this -> con = $connn;
    }
    public function GetCategory($id=0){
         if($id!=0){
            $query = "SELECT * FROM `category` WHERE `category_id`=$id";
            $data = $this -> con -> conn -> query($query) -> fetch_all(MYSQLI_ASSOC);
            return $data ; 
         }
        $query = "SELECT * FROM `category` ";
        $data = $this -> con -> conn -> query($query) -> fetch_all(MYSQLI_ASSOC);
        return $data ; 
    }
    public function SetCategory($category_name){
        $query = "INSERT INTO `category`(`category_name` ) VALUES ('$category_name')";
         $res =$this -> con -> conn -> query($query) ;
         return $res;
         
    }
    public function UpdateCategory($category_id,$category_name){
        $query = "UPDATE `category` SET  `category_name`='$category_name' WHERE `category_id`=$category_id";
        $this -> con -> conn -> query($query);
    }
    public function DeleteCategory($category_id){
        $query = "DELETE FROM `category` WHERE `category_id`=$category_id";
        $this -> con -> conn -> query($query);
    }
    public function NumOfProducts($id){
        $query = "SELECT COUNT(`product_name`) as 'value' FROM `products` WHERE `category_id` =$id";
        $data = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function CheckCategory($name){
            $data = $this -> GetCategory();
            $count =0;
            foreach ($data as $key => $value) {
                # code...
                if($value['category_name']==$name){
                    $count+=1;
                    break;
                }
            }
            return $count;
    }
    public function Get7Category($start,$end){
        $query = "SELECT * FROM `category` limit $start,$end ";
        $data = $this -> con -> conn -> query($query) -> fetch_all(MYSQLI_ASSOC);
        return $data ; 
    }
}
 
 
