<?php
class product
{
    protected $con;
    public function __construct($connn)
    {
        $this->con = $connn;
    }
    public function GetProducts($id = 0)
    {
        if ($id != 0) {
            // if there is id get
            $query = "SELECT * FROM `products` WHERE `product_id`=$id";
            $data = $this->con->conn->query($query)->fetch_all(MYSQLI_ASSOC);
            return $data;
        }
        $query = "SELECT * FROM `products`";
        $data = $this->con->conn->query($query)->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function SetProduct($name, $image, $desc, $quantity, $price, $cid,$brief)
    {
        $query2 = "INSERT INTO `products`(  `product_name`, `price`, `product_img`, `quantity`, `description`, `category_id`,`brief` ) VALUES ( '$name','$price','$image','$quantity','$desc','$cid','$brief' )";
        $ex =  $this->con->conn->query($query2);
    }
    public function DeleteProduct($product_id)
    {
        $query = "DELETE FROM `products` WHERE `product_id` = $product_id";
        $result = $this->con->conn->query($query);
    }
    public function UpdateProduct($product_id, string $name, $image, $desc,$brief, $quantity, $price, $cid, $status = 'available')
    {
        if ($quantity != 0) {
            $query = "UPDATE `products` SET  `product_name`='$name',`price`='$price',`product_img`='$image',`quantity`='$quantity',`description`='$desc',`brief`='$brief',`status`='$status',`category_id`='$cid'  WHERE `product_id` = $product_id";
            $this->con->conn->query($query);
        } else {
            $query = "UPDATE `products` SET  `product_name`='$name',`price`='$price',`product_img`='$image',`quantity`='$quantity',`description`='$desc',`brief`='$brief',`status`='not available',`category_id`='$cid'  WHERE `product_id` = $product_id";
            $this->con->conn->query($query);
        }
    }
    public function GetProductsByCat($id)
    {
        $query = "SELECT * FROM `products` WHERE `category_id`=$id";
        $data = $this->con->conn->query($query)->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function Get7Products($start, $end)
    {
        $query = "SELECT * FROM `products` limit $start,$end ";
        $data = $this->con->conn->query($query)->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function GetallProducts()
    {
        $query = "SELECT * FROM `products`";
        $result = $this->con->query($query);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function GetAvailableProducts(){
            $query = "SELECT * FROM `products` WHERE `quantity`>0";
            $data = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
            return $data;
    }
    public function Get7AvailableProducts($start,$end){
        $query = "SELECT * FROM `products`  WHERE `quantity`> 0 limit $start,$end ";
        $data = $this->con->conn->query($query)->fetch_all(MYSQLI_ASSOC);
        return $data;
}
    public function get_products_by_search($search){
         $query = "SELECT * FROM `products` WHERE `product_name` LIKE '%$search%'";
         $data = $this->con->conn->query($query)->fetch_all(MYSQLI_ASSOC);
        return $data;
}
}
// 1
