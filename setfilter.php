<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();
$_SESSION["number"]=1;
$_SESSION["filter1"]=(int)$_POST["amount1"];
$_SESSION["filter2"]=(int)$_POST["amount2"];
alert($_SESSION["filter2"]);
    
if(isset($_SESSION["search"]))
{
     unset($_SESSION["search"]);  
}
 
?>