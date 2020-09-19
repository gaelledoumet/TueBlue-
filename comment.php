<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');
session_start();

$comment=$_POST["comment"];
$username=$_SESSION["signedin"];

if($comment=="")
{
    die("You cannot post an empty comment.");
}
else
{
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
    
    $date=date("Y-m-d");
    
    $sql = "INSERT INTO comments (comment,username,date)
                             VALUES ('$comment','$username','$date')";
    mysqli_query($mysqli, $sql);
    
    
    die("comment successfully posted.");
}



?>