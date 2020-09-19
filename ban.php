<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

$username=$_POST["username"];
$ban=$_POST["ban"];
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

if($ban=="customer")
{
    $sql = "SELECT email FROM customers WHERE username = '{$username}' ";

    if($result = $mysqli -> query($sql))
    {
        $row = $result -> fetch_row();
        $result -> free_result();
    }

    $email=$row[0]; 

    $stmt2 = $mysqli->prepare("INSERT INTO banned (username, email) VALUES(?, ?)");
    $stmt2->bind_param("ss", $username, $email);
    $stmt2->execute();

    die("customer banned");
}
else
{
    $sql = "SELECT email FROM sellers WHERE username = '{$username}' ";

    if($result = $mysqli -> query($sql))
    {
        $row = $result -> fetch_row();
        $result -> free_result();
    }

    $email=$row[0]; 

    $stmt2 = $mysqli->prepare("INSERT INTO banned (username, email) VALUES(?, ?)");
    $stmt2->bind_param("ss", $username, $email);
    $stmt2->execute();
    
    die("seller banned");
}




?>