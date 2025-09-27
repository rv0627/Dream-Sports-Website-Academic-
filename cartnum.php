<?php
session_start();
require "connection.php";

$cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='".$_SESSION["userData"]["email"]."'");
$cart_num = $cart_rs->num_rows;

if($cart_num == 0){
    echo("0");
}else{
    echo($cart_num);
}

?>