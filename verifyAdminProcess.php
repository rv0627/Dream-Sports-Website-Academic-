<?php
session_start();
require "connection.php";

if(isset($_GET["v"])){
    $v_code = $_GET["v"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `verification_code`='".$v_code."'");
    $admin_num = $admin_rs->num_rows;

    if($admin_num == 1){
        $admin_data = $admin_rs->fetch_assoc();
        $_SESSION["au"] = $admin_data;
        echo("Success");  
    }else{
        echo("Invalid Verification Code");
    }

}else{
    echo("Please enter your verification code");
}
?>