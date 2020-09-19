<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

$username=$_SESSION["signedin"];


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

//total order amount in USD
$total=0;

//generate date purchased 
$date_purchased= date("Y-m-d");

//generate a random tracking number
$tracking_number= rand();

//check for uniqueness of this tracking number
$stmt0=$mysqli->prepare("SELECT tracking_number FROM orders_has_products WHERE tracking_number=?");
$stmt0->bind_param("i",$tracking_number);
$stmt0->execute();
$stmt0->store_result();
$stmt0->bind_result($tracking);
$count= $stmt0->num_rows; 
while($count!= 0)
{
    $tracking_number= rand();
    $stmt1=$mysqli->prepare("SELECT tracking_number FROM orders_has_products WHERE tracking_number=?");
    $stmt1->bind_param("i",$tracking_number);
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result($tracking);
    $count= $stmt1->num_rows; 
}


//add order to orders
$stmt3 = $mysqli->prepare("INSERT INTO orders (customers_username, tracking_number) VALUES(?,?)");
$stmt3->bind_param("si",$username,$tracking_number);
$stmt3->execute();

//get the order id
$sql = "SELECT oid FROM orders  WHERE tracking_number ='{$tracking_number}' AND customers_username='{$username}' ";
if($result = $mysqli -> query($sql))
{
    $row = $result -> fetch_row();
    $result -> free_result();
}
$order_id=$row[0];

//add to order has products and to customers has products
$stmt4=$mysqli->prepare("SELECT products_pcode,color,size,quantity FROM cart_has_products  WHERE cart_customers_username =? ");
$stmt4->bind_param("s",$username);
$stmt4->execute();
$stmt4->store_result();
$stmt4->bind_result($product_code,$color,$size,$quantity);
while($stmt4->fetch()) {

    if($quantity!=0)
    {
        $sql2 = "SELECT newprice,initialquantity FROM products WHERE pcode = '{$product_code}' ";
        if($result2 = $mysqli -> query($sql2))
        {
            $row2 = $result2 -> fetch_row();
            $result2 -> free_result();
        }
        $price=$row2[0];
        $initialquantity=$row2[1];

        //price_at_purchase is price of the product without being multiplied by quantity
        $sql = "INSERT INTO orders_has_products (orders_oid, products_pcode, price_at_purchase, color, size, quantity, date_purchased, tracking_number ) VALUES('{$order_id}','{$product_code}','{$price}','{$color}','{$size}','{$quantity}','{$date_purchased}','{$tracking_number}')";
        $result = $mysqli -> query($sql);

        $total+= ($price*$quantity);
    

        $stmt9= $mysqli->prepare("INSERT INTO customers_has_products (products_pcode, customers_username) VALUES(?, ?)");
        $stmt9->bind_param("ds", $product_code,$username);
        $stmt9->execute();

        //update the product's remaining quantity
        $remaining=$initialquantity-$quantity;
        $sql = "UPDATE products SET quantity='{$remaining}' WHERE pcode='{$product_code}'";
        $result = $mysqli -> query($sql);

                
        //check for users whose quantity for this product in cart has become now> remaining
        $stmt13=$mysqli->prepare("SELECT cart_customers_username, cart_ccart FROM cart_has_products  WHERE products_pcode =? AND quantity> ? ");
        $stmt13->bind_param("ii",$product_code,$remaining);
        $stmt13->execute();
        $stmt13->store_result();
        $stmt13->bind_result($customer, $cartid);
        while($stmt13->fetch()) {

            //set their quantity to 0
            $newquantity=0;
            $stmt12 = $mysqli->prepare("UPDATE cart_has_products SET quantity=? WHERE products_pcode=? AND cart_ccart=?");
            $stmt12->bind_param("iii",$newquantity,$product_code,$cartid);
            $stmt12->execute();
            $stmt12->store_result();

        }
    }
}

//update total amount of the order without delivery fee
$stmt11 = $mysqli->prepare("UPDATE orders SET total_price=? WHERE oid=?");
$stmt11->bind_param("di",$total,$order_id);
$stmt11->execute();
$stmt11->store_result();

//clear cart
$stmt8 = $mysqli->prepare("DELETE FROM cart_has_products WHERE cart_customers_username=?");
$stmt8->bind_param("s",$username);
$stmt8->execute();
$stmt8->store_result();


die(" ".$tracking_number);
?>
