<?php
 spl_autoload_register(function($class){
    require '../modules/'.$class.=".php";
 });
class user  
{
    protected $order;
    protected $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
        $this -> order=new order($this->conn);
    }
    public function add_user($username, $Email, $password, $phone_number, $address)
    {
        try {
            $query = "INSERT INTO `user`( `name`, `password`, `email`, `phone`, `address`) VALUES ('$username','$Email','$password','$phone_number','$address')";
            $this->conn->query($query);
            return header("Location: userAccount.php");
        } catch (Exception $e) {
            echo "this email or phone is already used";
            // echo $e;
        }
    }
    public function update_user($username, $Email, $password, $phone_number, $address)
    {
        try {
            $query = "UPDATE `user` SET `name`='$username',`password`='$password',`email`='$Email',`phone`='$phone_number',`address`='$address' WHERE `email` = '$Email'";
            // in the future we need to validate the new data !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            $this->conn->query($query);
            // return header("Location: userAccount.php");
        } catch (Exception $e) {
            echo $e;
        }
    }   
    public function get_user($post)
    {
        $email = $post["email"];
        $password = $post["password"];
        $query = "SELECT COUNT(*) FROM `user` WHERE `email` = '$email' AND `password` = '$password'";
        $result = $this->conn->query($query);
        $count = $result->fetch_all(MYSQLI_NUM);
        if ($count[0][0] != 0) {
            session_start();
            if (isset($post["rem"])) {
                $sessionId = session_create_id();
                $query2 = "UPDATE `user` SET `sessionid`='$sessionId' WHERE `email` = '$email'";
                $this->conn->query($query2);
                setcookie("sessionId", $sessionId, time() + 60 * 60 * 60);
                // setcookie("pass", $password, time() + 60);
            }
            $_SESSION["email"] = $email;
            return header("Location:http://localhost/ecommerce_php/views/userAccount.php");
        } else {
            return "the email or password is not correct please try again";
        }
    }
    public function get_user_data($email)
    {
        $query = "SELECT * FROM `user` WHERE `email` = '$email'";
        $result2 = $this->conn->query($query);
        return $result2->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function get_user_session($sessionId)
    {

        $query = "SELECT  `email` FROM `user` WHERE `sessionid` = '$sessionId'";

        $result2 = $this->conn->query($query);
        $email = $result2->fetch_all(MYSQLI_NUM);
        if ($email[0][0] != 0) {
            $_SESSION["email"] = $email[0][0];
            return true;
        } else {
            return false;
        }
    }
    public function get_users($email = 0)

    {
        if ($email) {
            $query = "SELECT `user_id` FROM `user` WHERE `email`='$email'";
            $data = $this->conn->conn->query($query)->fetch_all(MYSQLI_ASSOC);
            return $data;
        }
        $query = "SELECT * FROM `user` ";
        $data = $this->conn->conn->query($query)->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function get_user_by_id($id){
        $query = "SELECT * FROM `user` WHERE `user_id` = $id ";
            $data = $this->conn->conn->query($query)->fetch_all(MYSQLI_ASSOC);
            return $data;
    }

    public function Customers_data($data){
        $Cdata = [];
        foreach ($data as $key => $user) {
            $name=$user['name'];
            $email =$user['email'];
            $orders =count($this ->order-> GetTotalOrders((int)$user['user_id']));
            $products = count($this->order->GetTotalProducts((int)$user['user_id']));
            $spent = $this->order->GetTotalSpend((int)$user['user_id']);
            $Cdata[]=['name'=>$name,'email'=>$email,'orders'=>$orders,'products'=>$products,'spent'=>$spent];
        }
        return $Cdata;
    }
    public function RecentUsers(){
        $query = "SELECT * FROM `user` ORDER BY `created_at` DESC";
        $data = $this->conn->conn->query($query)->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
    public function MostSpent(){
    $data=$this->Customers_data($this->get_users());
    usort($data,function($a,$b){
        return $a['spent']<$b['spent'];
    });
    return $data;
    } 
    public function MostOrders(){
    $data=$this->Customers_data($this->get_users());
    usort($data,function( $a,$b){
        return  $a['orders']<$b['orders'];
    });
return $data;
    }
    public function get_user_id_by_email($email){
      $query = "SELECT `user_id` FROM `user` WHERE `email` = '$email'";
      $data = $this -> conn ->conn-> query($query)->fetch_all(MYSQLI_ASSOC);
      return $data;
    } 
    public function update_user_img($img_url,$email){
      $query = "UPDATE `user` SET `img`='$img_url' WHERE `email` = '$email'";
      $this -> conn -> query($query);
    } 
}
