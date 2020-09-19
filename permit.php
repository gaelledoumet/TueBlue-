<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

$username=$_POST["username"];

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
    $stmt = $mysqli->prepare("DELETE FROM banned WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    die("user banned");
?>