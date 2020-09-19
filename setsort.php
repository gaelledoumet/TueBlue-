<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();
$_SESSION["sort"]=$_POST["sort"];

if(isset($_SESSION["search"]))
    unset($_SESSION["search"]);   


?>