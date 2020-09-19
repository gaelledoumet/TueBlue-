<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();
$username=$_SESSION["signedin"];
$pcode=$_POST["pcode"];
$stars=(int)$_POST["stars"];
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

$review="none";
$query ="INSERT INTO rates (review, rating, customers_username, products_pcode) ";
$query .= "VALUES('".$review."','".$stars."','".$username."','".$pcode."')";
$result = $mysqli -> query($query);

    die("The product has been successfully rated for ". $stars ." stars");




?>