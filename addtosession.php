<?php
    session_start();
    $pcode=$_POST["pcode"];
    $_SESSION["cart_item"]=$pcode;


    die("item added to cart session");
?>