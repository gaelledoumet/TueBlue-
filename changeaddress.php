<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();

$username=$_SESSION["signedin"];
$address=$_POST["address"];
$flag=$_POST["flag"];

$db_host="localhost";
$db_user="root";
$db_pass=null;
$db_name="tueblue";

if(($address==""))
{
    die("empty");
}


$mysqli=new mysqli($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno())
{
    echo("connect failed");
    exit();
}

if($flag=="")
{
$stmt= $mysqli -> prepare("UPDATE customers set location=? WHERE username =?");
$stmt -> bind_param ("ss",$address, $username); 
$stmt -> execute();
$stmt -> store_result();

    die("success");
}
else if($flag=="seller")
{
    $stmt= $mysqli -> prepare("UPDATE sellers set address=? WHERE username =?");
    $stmt -> bind_param ("ss",$address, $_SESSION["signedin"]); 
    $stmt -> execute();
    $stmt -> store_result();

    die("success");
}
else if($flag=="employee")
{
    $stmt= $mysqli -> prepare("UPDATE employees set address=? WHERE username =?");
    $stmt -> bind_param ("ss",$address, $_SESSION["employee"]); 
    $stmt -> execute();
    $stmt -> store_result();
    
        die("success");
}
else if($flag=="businessowner")
{
    $stmt= $mysqli -> prepare("UPDATE businessowners set address=? WHERE username =?");
    $stmt -> bind_param ("ss",$address, $username); 
    $stmt -> execute();
    $stmt -> store_result();
    
        die("success");
}
?>