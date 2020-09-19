<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

$username=$_SESSION["signedin"];

$db_host="localhost";
$db_user="root";
$db_pass=null;
$db_name="tueblue";

$mysqli=new mysqli($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno())
{
    echo("connect failed");
    exit();
}

$flag=1;
$stmt1=$mysqli->prepare("UPDATE customers SET subscription =? WHERE username=?");
$stmt1->bind_param("is",$flag,$username);
$stmt1->execute();

echo("subscription successful");


?>