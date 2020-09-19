<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();
$_SESSION["category"]=$_POST["category"];
if(isset($_SESSION["sort"]))
     unset($_SESSION["sort"]);

if(isset($_SESSION["search"]))
     unset($_SESSION["search"]);  

if(isset($_SESSION["filter1"])){
     unset($_SESSION["filter1"]);  
     unset($_SESSION["filter2"]);
}
if(isset($_SESSION["number"])){
     unset($_SESSION["number"]); 
}
?>