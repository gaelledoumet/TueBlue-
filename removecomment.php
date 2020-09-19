<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');
$id=$_POST["id"];

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

$stmt3 = $mysqli->prepare("DELETE FROM comments WHERE commentid=? ");
$stmt3->bind_param("i", $id);
$stmt3->execute();
$stmt3->store_result();

echo("Comment deleted");


?>