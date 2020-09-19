<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();

if(isset($_SESSION["signedin"]))
{
    $pcodes=array();
    $account_user=$_SESSION["signedin"]; 
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

    //it starts here
    $stmt0=$mysqli->prepare("SELECT quantity, products_pcode FROM cart_has_products WHERE cart_customers_username=?");
    $stmt0->bind_param("s",$account_user);
    $stmt0->execute();
    $stmt0->store_result();
    $stmt0->bind_result($quantity,$product_code);
    $count= $stmt0->num_rows;  
    while($stmt0->fetch()) {
        if($quantity==0)
        {
            array_push($pcodes,$product_code);
        }
    }
    if(count($pcodes)==0)
    {
        die("nothing to notify");
    }
    else
    {
        $codes="";
        for($i=0;$i<count($pcodes)-1;$i++)
        {
            $codes=$codes.$pcodes[$i].", ";
        }
        $codes=$codes.$pcodes[count($pcodes)-1];
        die("Please update the quantity of the following products in your cart since they are no longer available in the previously specified quantity:".$codes);
    }

}
else
{
    die("nothing to notify");
}
?>