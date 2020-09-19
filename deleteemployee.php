<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

$email=$_POST["email"];

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


//DELETE FROM table_name WHERE condition;
$stmt = $mysqli->prepare("DELETE FROM employees WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

echo("successfully deleted");


?>