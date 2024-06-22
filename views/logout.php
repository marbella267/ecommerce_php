<?php
    session_start();
    session_destroy();
    setcookie("sessionId","",time()-1456);
    header("Location: http://localhost/ecommerce_php/views/userlogin.php") 
?>