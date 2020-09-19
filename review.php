<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();
$username=$_SESSION["signedin"];
$pcode=$_POST["pcode"];
$review=$_POST["review"];
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

$stmt13=$mysqli->prepare("UPDATE rates SET review=? WHERE products_pcode=?");
$stmt13->bind_param("si",$review,$pcode);
$stmt13->execute();

die("Your review has been posted successfully.");




?>