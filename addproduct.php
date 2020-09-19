<?php
        error_reporting(E_ERROR | E_PARSE);
        header('Content-Type:text/plain');
        session_start();
        $product_name=$_POST["pname"];
        $price=$_POST["price"];
        $quantity=(int)$_POST["quantity"];
        $category=$_POST["category"];
        $description=$_POST["description"];
        $color_boolean=$_POST["color_boolean"];
        $size_boolean=$_POST["size_boolean"];
        $sizes=$_POST["sizes"];
        $colors=$_POST["colors"];
        if($quantity==0)
        {
            die("Quantity can't be 0");
        }
        if((($color_boolean!="Yes")&&($color_boolean!="No"))||(($size_boolean!="Yes")&&($size_boolean!="No")))
        {
            die("Please fill out all the requirements to proceed");
        }

        if((($color_boolean =="Yes")&&(count($colors)==0)) ||(($size_boolean=="Yes")&&(count($sizes)==0)) )
        {
            die("Please fill out all the requirements to proceed");
        }

        $boolean2=preg_match('/^[1-9]\d*$/', $quantity);

        if($product_name == null || $price == null || $quantity == null || $category == null || $description == null)
        {
            die("Please fill out all the requirements to proceed");
        }

        if(!is_numeric($price))
        {
            die("the price should only contain digits");
        }
        if(!($boolean2))
        {
            die("the quantity should be a whole number");
        }

        $seller_username=$_SESSION["signedin"];

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
        $token = rand();
        //check uniqueness of this rand number
        $stmt0=$mysqli->prepare("SELECT token FROM products WHERE token=?");
        $stmt0->bind_param("i",$token);
        $stmt0->execute();
        $stmt0->store_result();
        $stmt0->bind_result($token);
        $count= $stmt0->num_rows; 
        while($count!= 0)
        {
            $token= rand();
            $stmt1=$mysqli->prepare("SELECT token FROM products WHERE token=?");
            $stmt1->bind_param("i",$token);
            $stmt1->execute();
            $stmt1->store_result();
            $stmt1->bind_result($token);
            $count= $stmt1->num_rows; 
        }


        //check if such a product already exist              
        $stmt2=$mysqli->prepare("SELECT  products.description, products.pname, products.sellers_username,products.quantity  FROM products");
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($description2,$pname2,$seller,$quantityy);

        while($stmt2->fetch()) {
            if(($description==$description2) && ($pname2==$product_name) && ($seller==$seller_username)&&($quantityy!=0))
            {
                die("You have supplied such a product already");
            }
            else
            {
                if(($description==$description2) && ($pname2==$product_name) && ($url == $url2) && ($seller==$seller_username)&&($quantity==0))
                {
                    $stmt=$mysqli->prepare("DELETE FROM products WHERE description =? AND pname=? AND sellers_username=? AND quantity=?");
                    $stmt->bind_param("ssssi",$description,$pname2,$seller_username,0);
                    $stmt->execute();
                }
            }
        }
        $sql = "INSERT INTO products (description,oldprice,newprice,initialquantity,quantity,pname,category,dateadded,sellers_username,token)
                                VALUES ('$description','$price','$price','$quantity','$quantity','$product_name','$category','$date','$seller_username','$token')";
        mysqli_query($mysqli, $sql);

        $sql = "SELECT pcode FROM products WHERE description='{$description}' AND pname='{$product_name}' AND sellers_username='{$seller_username}' ";
        if($result = $mysqli -> query($sql))
        {
            $row = $result -> fetch_row();
            $result -> free_result();
        }
        $pcode=$row[0];
        if($color_boolean=="Yes")
        {
            
            for($i=0;$i<count($colors);$i++)
            {
                // $stmt3 = $mysqli->prepare("INSERT INTO colors (pcode,color) VALUES(?, ?)");
                // $stmt3->bind_param("ds", $pcode,$colors[$i]);
                // $stmt3->execute();
                $sql3 = "INSERT INTO colors (pcode, color) VALUES('$pcode', '$colors[$i]')";
                mysqli_query($mysqli, $sql3);

            }

        }

        if($size_boolean=="Yes")
        {
            for($i=0;$i<count($sizes);$i++)
            {
                $sql4 = "INSERT INTO sizes (pcode,size) VALUES ('$pcode','$sizes[$i]')";
                mysqli_query($mysqli, $sql4);
            }

        }
echo($token);

?>