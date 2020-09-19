<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

$name=$_POST["name"];
$email=$_POST["email"];
$tel=$_POST["tel"];
$message=$_POST["message"];

$boolean=preg_match('/[0-9]{8}/', $tel);

$boolean2=preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/', $email);



if($name == null || $email == null || $tel == null || $message == null)
{
    die("please fill out all the requirements to proceed");
}

if($boolean == false)
{
    die("the phone number is not in the right format");
}

if($boolean2 == false)
{
    die("please enter a valid email address");
}
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

$sql = "INSERT INTO help_and_support (name,email,message,phone_number)
                         VALUES ('$name','$email','$message','$tel')";
mysqli_query($mysqli, $sql);


echo("your message is sent");



?>