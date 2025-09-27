<?php

session_start();

if(isset($_SESSION["userData"])){

    $_SESSION["userData"] = null;
    session_destroy();

    echo("Success");

}

?>