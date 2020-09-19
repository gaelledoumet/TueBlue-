<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

$username=$_SESSION["signedin"];
$product_code=$_POST["code"];

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

$stmt3 = $mysqli->prepare("DELETE FROM cart_has_products WHERE cart_customers_username=? AND products_pcode=? ");
$stmt3->bind_param("si", $username,$product_code);
$stmt3->execute();
$stmt3->store_result();

echo("Item successfully removed from cart");


?>