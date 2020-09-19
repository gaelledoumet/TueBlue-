<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

$newprice=$_POST["newprice"];
$pcode = $_POST["pcode"];

if($newprice == null)
{
    die("please enter the price you want first");
}
else if(!is_numeric($newprice)){
    die("Your price should be a number");
}
else{



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

$result = mysqli_query($mysqli, "SELECT oldprice FROM products WHERE pcode = {$pcode}");
$row = mysqli_fetch_row($result);

if ($row[0] == $newprice)
{
   echo("you have not changed the price");   
}

else{
$sql = "UPDATE products SET newprice={$newprice} WHERE pcode={$pcode}";
mysqli_query($mysqli, $sql);
echo("updated successfully");
}
}

?>