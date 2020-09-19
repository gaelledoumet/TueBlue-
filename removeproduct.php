<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

$username=$_SESSION["signedin"];
$product_code=$_POST["code"];
$tracking=$_POST["tracking"];
$quantity=$_POST["quantity"];

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

$stmt3 = $mysqli->prepare("DELETE FROM orders_has_products WHERE products_pcode=? AND tracking_number=? ");
$stmt3->bind_param("ii",$product_code,$tracking);
$stmt3->execute();
$stmt3->store_result();

$stmt4=$mysqli->prepare("SELECT orders_oid FROM orders_has_products  WHERE tracking_number =? ");
$stmt4->bind_param("i",$tracking);
$stmt4->execute();
$stmt4->store_result();
$stmt4->bind_result($oid);
$count4=$stmt4->num_rows;
if($count4==0)
{
    $stmt = $mysqli->prepare("DELETE FROM orders WHERE tracking_number=? ");
    $stmt->bind_param("i",$tracking);
    $stmt->execute();
    $stmt->store_result();
}

$stmt6 = $mysqli->prepare("DELETE FROM customers_has_products WHERE products_pcode=? ");
$stmt6->bind_param("i",$product_code);
$stmt6->execute();
$stmt6->store_result();

$stmt5=$mysqli->prepare("SELECT quantity FROM products  WHERE pcode =? ");
$stmt5->bind_param("i",$product_code);
$stmt5->execute();
$stmt5->store_result();
$stmt5->bind_result($remaining_quantity);


$sql = "SELECT quantity FROM products  WHERE pcode ='{$product_code}' ";
if($result = $mysqli -> query($sql))
{
    $row = $result -> fetch_row();
    $result -> free_result();
}
$remaining_quantity=$row[0];
$new_remaining=$remaining_quantity+$quantity;

$stmt2 = $mysqli->prepare("UPDATE products set quantity=? WHERE pcode=?");
$stmt2->bind_param("ii",$new_remaining,$product_code);
$stmt2->execute();
$stmt2->store_result();


echo("Item successfully removed from order.");


?>