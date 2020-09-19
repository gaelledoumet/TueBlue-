<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

$product_code=(int)$_POST["code"];

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
$stmt1 = $mysqli->prepare("DELETE FROM products WHERE pcode=?");
$stmt1->bind_param("i",$product_code);
$stmt1->execute();
$stmt1->store_result();

$stmt2 = $mysqli->prepare("DELETE FROM rates WHERE products_pcode=?");
$stmt2->bind_param("d", $product_code);
$stmt2->execute();
$stmt2->store_result();

$stmt6 = $mysqli->prepare("DELETE FROM cart_has_products WHERE products_pcode=?");
$stmt6->bind_param("i",$product_code);
$stmt6->execute();
$stmt6->store_result();



$stmt4=$mysqli->prepare("SELECT orders_oid FROM orders_has_products  WHERE products_pcode =? ");
$stmt4->bind_param("i",$product_code);
$stmt4->execute();
$stmt4->store_result();
$stmt4->bind_result($oid);
while($stmt4->fetch()) 
{
    $stmt3 = $mysqli->prepare("DELETE FROM orders_has_products WHERE products_pcode=? AND orders_oid =? ");
    $stmt3->bind_param("ii",$product_code,$oid);
    $stmt3->execute();
    $stmt3->store_result();

    $stmt5=$mysqli->prepare("SELECT orders_oid FROM orders_has_products  WHERE orders_oid =? ");
    $stmt5->bind_param("i",$oid);
    $stmt5->execute();
    $stmt5->store_result();
    $stmt5->bind_result($oid);
    $count5=$stmt5->num_rows;
    if($count5==0)
    {
    $stmt = $mysqli->prepare("DELETE FROM orders WHERE oid=? ");
    $stmt->bind_param("i",$oid);
    $stmt->execute();
    $stmt->store_result();
}
}



echo("Item successfully removed.");


?>