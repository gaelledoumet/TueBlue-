<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();
$_SESSION["search"]=$_POST["search"];
if(isset($_SESSION["sort"]))
     unset($_SESSION["sort"]);
if(isset($_SESSION["category"]))
    unset($_SESSION["category"]);
if(isset($_SESSION["filter1"])){
        unset($_SESSION["filter1"]);  
        unset($_SESSION["filter2"]);
   }
?>