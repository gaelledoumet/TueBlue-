<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();

$username=$_SESSION["signedin"];
$governorate=$_POST["governorate"];

$db_host="localhost";
$db_user="root";
$db_pass=null;
$db_name="tueblue";

if(($governorate=="Choose one option"))
{
    die("empty");
}


$mysqli=new mysqli($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno())
{
    echo("connect failed");
    exit();
}

$stmt= $mysqli -> prepare("UPDATE customers set gov=? WHERE username =?");
$stmt -> bind_param ("ss",$governorate, $username); 
$stmt -> execute();
$stmt -> store_result();

    die("success");


?>