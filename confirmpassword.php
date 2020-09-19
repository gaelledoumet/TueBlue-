<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();

$username=$_SESSION["signedin"];
$password=$_POST["password"];
$confirm=$_POST["confirm"];
$flag=$_POST["flag"];

$db_host="localhost";
$db_user="root";
$db_pass=null;
$db_name="tueblue";
if(($password=="")||($confirm==""))
{
    die("empty");
}
if($password!=$confirm)
{
    die("Passwords do not match");
}
$pass = hash('md5', $password);

$mysqli=new mysqli($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno())
{
    echo("connect failed");
    exit();
}

if($flag=="")
{
    $stmt= $mysqli -> prepare("UPDATE customers set password=? WHERE username =?");
    $stmt -> bind_param ("ss",$pass, $username); 
    $stmt -> execute();
    $stmt -> store_result();
    
        die("success");
}
else if($flag=="seller")
{
    $stmt= $mysqli -> prepare("UPDATE sellers set password=? WHERE username =?");
    $stmt -> bind_param ("ss",$pass, $_SESSION["seller"]); 
    $stmt -> execute();
    $stmt -> store_result();
    
        die("success");
}
else if($flag=="employee")
{
    $stmt= $mysqli -> prepare("UPDATE employees set password=? WHERE username =?");
    $stmt -> bind_param ("ss",$pass, $username); 
    $stmt -> execute();
    $stmt -> store_result();
    
        die("success");
}
else if($flag=="businessowner")
{
    $stmt= $mysqli -> prepare("UPDATE businessowners set password=? WHERE username =?");
    $stmt -> bind_param ("ss",$pass, $username); 
    $stmt -> execute();
    $stmt -> store_result();
    
        die("success");
}


?>