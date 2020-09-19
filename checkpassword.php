<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();

$username=$_SESSION["signedin"];
$password=$_POST["password"];
$flag = $_POST["flag"];

$db_host="localhost";
$db_user="root";
$db_pass=null;
$db_name="tueblue";
if($password=="")
{
    die("empty");
}

$pass = hash('md5', $password);

$mysqli=new mysqli($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno())
{
    echo("connect failed");
    exit();
}

if ($flag=="")
{
    $stmt= $mysqli -> prepare("SELECT username FROM customers WHERE username = ? AND password=?");
    $stmt -> bind_param ("ss", $username,$pass); 
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($user);
    $count= $stmt->num_rows;

    if($count==0)
    {
        die("wrong password");
    }
    else
    {
        die("success");

    }
}
else if($flag=="seller")
{
    $stmt= $mysqli -> prepare("SELECT username FROM sellers WHERE username = ? AND password=?");
    $stmt -> bind_param ("ss", $username,$pass); 
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($user);
    $count= $stmt->num_rows;

    if($count==0)
    {
        die("wrong password");
    }
    else
    {
        die("success");

    }
}
else if($flag=="employee")
{
    $stmt= $mysqli -> prepare("SELECT username FROM employees WHERE username = ? AND password=?");
    $stmt -> bind_param ("ss", $username,$pass); 
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($user);
    $count= $stmt->num_rows;

    if($count==0)
    {
        die("wrong password");
    }
    else
    {
        die("success");

    }
}
else if($flag=="businessowner")
{
    $stmt= $mysqli -> prepare("SELECT username FROM businessowners WHERE username = ? AND password=?");
    $stmt -> bind_param ("ss", $username,$pass); 
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($user);
    $count= $stmt->num_rows;

    if($count==0)
    {
        die("wrong password");
    }
    else
    {
        die("success");

    }
}
?>