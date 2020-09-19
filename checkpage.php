<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();
if(isset($_SESSION["admin"]))
{
    die("admin.html");
}
else if(isset($_SESSION["employee"]))
{
    die("employee.html");
}
else if(isset($_SESSION["businessowner"]))
{
    die("businessowner.html");
} 
else if(isset($_SESSION["seller"]))
{
    die("seller.php");
}
else if(isset($_SESSION["customer"]))
{
    die("home.php");
}
else
{
    die("don't change location");
}



?>