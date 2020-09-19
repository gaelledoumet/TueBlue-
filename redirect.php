<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

    session_start();
    if(isset($_SESSION["cart_item"]))
    {
        die("signupbuyer.html");
    }
    else
    die("signup.html");
?>