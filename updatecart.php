<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

    session_start();

    $pcode=$_POST["pcode"];
    $quantity=$_POST["quantity"];
    $size=$_POST["size"];
    $color=$_POST["color"];
    $username=$_SESSION["signedin"];
    if($quantity=="")
    {
        $quantity=1;
    }
            $db_host = "localhost";
            $db_user="root";
            $dbt_pass=null;
            $db_name="tueblue";
            $mysqli= new mysqli($db_host,$db_user,$dbt_pass,$db_name);
            
            if (mysqli_connect_errno()){
                printf("connect failed : %s \n" , mysqli_connect_error());
                exit();
            }

            $stmt=$mysqli->prepare("SELECT sizeid FROM sizes WHERE pcode = ?");
            $stmt->bind_param("d",$pcode);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($sizeid);
            $count=$stmt->num_rows; 
            if($count!=0)
            {
                if(count($size)==0)
                {
                    die("Please choose the convenient size.");
                }
            }

            $stmt2=$mysqli->prepare("SELECT colorid FROM colors WHERE pcode = ?");
            $stmt2->bind_param("d",$pcode);
            $stmt2->execute();
            $stmt2->store_result();
            $stmt2->bind_result($colorid);
            $count2=$stmt2->num_rows; 
            if($count2!=0)
            {       
                if(count($color)==0)
                {
                    die("Please choose the convenient color.");
                }
            }    



            $sql = "SELECT ccart FROM cart WHERE customers_username = '{$username}' ";

            if($result = $mysqli -> query($sql))
            {
                $row = $result -> fetch_row();
                $result -> free_result();
            }
        
            $cartid=$row[0];

            if((count($size)==0)&&(count($color)==0))
            {
                $size="none";
                $color="none";
                $sql = "UPDATE cart_has_products set color ='$color',size='$size',quantity='$quantity' WHERE cart_customers_username='$username' AND products_pcode='$pcode'";
                mysqli_query($mysqli, $sql);
                die("Item updated");
            }
            if((count($size)==0)&&(count($color)!=0))
            {
                $size="none";
                $sql = "UPDATE cart_has_products set color ='$color[0]',size='$size',quantity='$quantity' WHERE cart_customers_username='$username' AND products_pcode='$pcode'";
                mysqli_query($mysqli, $sql);
                die("Item updated");
            }
            if((count($size)!=0)&&(count($color)==0))
            {
                $color="none";
                $sql = "UPDATE cart_has_products set color ='$color',size='$size[0]',quantity='$quantity' WHERE cart_customers_username='$username' AND products_pcode='$pcode'";
                mysqli_query($mysqli, $sql);
                die("Item updated");
            }
            if((count($size)!=0)&&(count($color)!=0))
            {
                $sql = "UPDATE cart_has_products set color ='$color[0]',size='$size[0]',quantity='$quantity' WHERE cart_customers_username='$username' AND products_pcode='$pcode'";
                mysqli_query($mysqli, $sql);
                die("Item updated");
            }

?>