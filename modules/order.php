<?php
spl_autoload_register(function($class){
   require './'.$class.=".php";
});
 
 
class order extends product 

  {  
 
    public function GetOrders($id=0){
        if($id!=0){
        $query = "SELECT * FROM `order` WHERE `order_id`=$id";
        $data = $this -> con -> conn -> query($query) -> fetch_all(MYSQLI_ASSOC);
        return $data ; 
     }
    $query = "SELECT * FROM `order`  ";
    $data = $this -> con -> conn -> query($query) -> fetch_all(MYSQLI_ASSOC);
    return $data ; 
}
   public function SetOrder($user_id,$product_id,$quantity,$price){
      $time = date('Y-m-d',(time()+(60*60*24)*3));
         $query = "INSERT INTO `order`(  `user_id`, `product_id`, `quantity`, `price`,`time` ) VALUES ('$user_id','$product_id','$quantity','$price','$time')";
         $product_data =$this -> GetProducts($product_id);
         if($product_data[0]['quantity']>=$quantity){
            $this -> con -> conn -> query($query);
            $product_quantity = $product_data[0]['quantity']-$quantity;
            $this -> UpdateProduct($product_id,$product_data[0]['product_name'],$product_data[0]['product_img'],$product_data[0]['description'],$product_data[0]['brief'],$product_quantity,$product_data[0]['price'],$product_data[0]['category_id']);
            return ;
         }
         if($product_data[0]['status']=='not available'){
                return "sorry this product is not available now";
         }
         else{
            return "sorry we only have $product_data[0][quantity] of that product";
         }
    }

    public function UpdateOrder($order_id,$user_id,$product_id,$quantity,$price,$status='not paid'){
        $order_quantity = $this ->GetOrders($order_id)[0]['quantity'];
        if($order_quantity!= $quantity){
         if($order_quantity<$quantity){
            $new_quanity = $quantity - $order_quantity;
            $product_data =$this -> GetProducts($product_id);
         if($product_data[0]['quantity']>=$new_quanity){
            $product_quantity = $product_data[0]['quantity']-$new_quanity;
            $this -> UpdateProduct($product_id,'hi',$product_data[0]['product_img'],$product_data[0]['description'],$product_data[0]['brief'],$product_quantity,$product_data[0]['price'],$product_data[0]['category_id']);
            $query ="UPDATE `order` SET `user_id`='$user_id',`product_id`='$product_id',`quantity`='$quantity',`price`='$price',`status`='$status' WHERE `order_id`=$order_id";
            $this -> con -> conn -> query($query);
            return;
         }
         if($product_data[0]['status']=='not available'){
                return "sorry this product is not available now";
         }
         else{
            return "sorry we don't have this amount of that product";
         }
         }
        if($order_quantity>$quantity){
            $new_quanity = $order_quantity - $quantity;
            $product_data =$this -> GetProducts($product_id);
            $product_quantity = $product_data[0]['quantity']+$new_quanity;
            $this -> UpdateProduct($product_id,'hi',$product_data[0]['product_img'],$product_data[0]['description'],$product_data[0]['brief'],$product_quantity,$product_data[0]['price'],$product_data[0]['category_id']);
            $query ="UPDATE `order` SET `user_id`='$user_id',`product_id`='$product_id',`quantity`='$quantity',`price`='$price',`status`='$status' WHERE `order_id`=$order_id";
            $this -> con -> conn -> query($query);
            return;
         
         
        }
        }
    }

    public function DeleteOrder($order_id){
        $query = "DELETE FROM `order` WHERE `order_id`=$order_id";
        $data =$this -> GetOrders($order_id) ;
        $quantity = $data[0]['quantity'];
        $product_data =$this -> GetProducts($data[0]['product_id']);
        $product_quantity = $product_data[0]['quantity']+$quantity;
        $this -> UpdateProduct($data[0]['product_id'],'hi',$product_data[0]['product_img'],$product_data[0]['description'],$product_data[0]['brief'],$product_quantity,$product_data[0]['price'],$product_data[0]['category_id']);
        $this -> con -> conn -> query($query);
    }
   public function GetTotalOrders($id){
      $query = "SELECT * FROM `order` WHERE `user_id`=$id GROUP BY `created_at`";
      $data = $this -> con -> conn->query($query)->fetch_all(MYSQLI_ASSOC);
      return $data;
   }
   public function GetTotalProducts($id){
      $query = "SELECT `product_id` FROM `order` WHERE `user_id`=$id ";
      $data = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
      return $data;
   }
   public function GetTotalSpend($id){
      $query = "SELECT `price` FROM `order` WHERE `user_id`=$id ";
      $data = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
      $count=0;
      foreach ($data as $key => $value) {
          $count+=$value['price'];
      }
      return $count;
   }
   public function GetGroup($id){
      $query = "SELECT `product_id`,`quantity`   FROM `order` WHERE `user_id`=$id GROUP BY `created_at` ";
      $data = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
      return $data;
   }
   public function ActiveUsers($id){
      $query = "SELECT COUNT(`user_id`) as 'value',SUM(`price`)as'price',`user_id` FROM `order` WHERE `user_id`=$id";
      $data = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
      return $data;
   }
   public function PopularProduct($id){
      $query = "SELECT COUNT(`product_id`) as 'value', SUM(`price`)as'price',SUM(`quantity`)as'quantity',`product_id` FROM `order` WHERE `product_id`= $id";
      $data = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
      return $data;
   }
   public function GetIds(){
      $query = "SELECT `user_id` FROM `order` GROUP BY `user_id`";
      $data = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
      return $data;
   }
   public function GetId(){
      $query = "SELECT `user_id` FROM `order` WHERE `user_id` = '19' GROUP BY `user_id`";
      $data = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
      return $data;
   }
   public function OrdersData($ids,$time=0){
      if($time){
         $query="SELECT `time`,`status`,`created_at`,`user_id`,`order_id`,GROUP_CONCAT(`product_id`)as'products',GROUP_CONCAT(`quantity`)as'quantity',SUM(`price`) as 'price' FROM `order` WHERE `user_id`=$ids AND `created_at`='$time' GROUP BY(`created_at`)  ";
         $res = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
         return $res;
      }
          $query="SELECT `time`,`status`,`created_at`,`user_id`,`order_id`,GROUP_CONCAT(`product_id`)as'products',GROUP_CONCAT(`quantity`)as'quantity',SUM(`price`) as 'price' FROM `order`  GROUP BY `created_at`,`user_id` ";
          $res = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
          
   
      return $res;
   }
   public function Orderuser($id){
      $query="SELECT `time`,`status`,`created_at`,`user_id`,`order_id`,GROUP_CONCAT(`product_id`)as'products',GROUP_CONCAT(`quantity`)as'quantity',SUM(`price`) as 'price' FROM `order` WHERE `user_id`=$id  GROUP BY (`created_at`)";
      $res = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
      return $res;
   }
   public function EditOrder($user_id,$created_at,$status,$time){
      $query = "UPDATE `order` SET `status`='$status',`time`='$time' WHERE `user_id`=$user_id AND `created_at` ='$created_at'";
      $res = $this -> con -> conn -> query($query);
      return $res;
   }
   public function UpdateProductQuantity($id,$quantity){
      $proQuantity = $this -> con -> conn->query("SELECT `quantity` FROM `products` WHERE `product_id`=$id")->fetch_all(MYSQLI_ASSOC);
      $new_quanity = $proQuantity[0]['quantity'] +$quantity;
      $this -> con -> conn -> query("UPDATE `products` SET  `quantity`=$new_quanity , `status`='available' WHERE `product_id`=$id");
   }
   public function SelectOrder($user_id,$created_at){
         $query = "SELECT `time`,`status`,`created_at`,`user_id`,`order_id`,GROUP_CONCAT(`product_id`)as'products',GROUP_CONCAT(`quantity`)as'quantity',SUM(`price`) as 'price' FROM `order` WHERE `user_id`=$user_id AND `created_at` ='$created_at' GROUP BY `created_at` ";
         $data = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
         return $data;
   }
   public function OrdersDataFilter($ids,$status){
          $query="SELECT `time`,`status`,`created_at`,`user_id`,`order_id`,GROUP_CONCAT(`product_id`)as'products',GROUP_CONCAT(`quantity`)as'quantity',SUM(`price`) as 'price' FROM `order` WHERE `status`='$status'  GROUP BY `created_at`,`user_id` ";
          $res = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
     
      return $res;
   }
   public function get_users_id(){
         $query = "SELECT `user_id` FROM `order` GROUP BY `user_id` ";
         $data = $this -> con -> conn -> query($query)->fetch_all(MYSQLI_ASSOC);
         return $data;
   }
   
}
 