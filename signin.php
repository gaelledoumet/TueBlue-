<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');
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

    $account_user=$_POST["user"];
    $account_pw= $_POST["password"];

    if($account_user == null || $account_pw == null)
    {
        die("please fill out all boxes");
    }

    $stmt = $mysqli->prepare("SELECT username FROM customers WHERE username=? AND password=? ");
    $stmt->bind_param("ss", $account_user,hash('md5',$account_pw));
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($name);
    $count = $stmt->num_rows; 

    if ($count==0)
    {
        $stmt1 = $mysqli->prepare("SELECT username FROM sellers WHERE username=? AND password=? ");
        $stmt1->bind_param("ss", $account_user,hash('md5',$account_pw));
        $stmt1->execute();
        $stmt1->store_result();
        $stmt1->bind_result($name);
        $count1 = $stmt1->num_rows;  

        if($count1==0)
        {
            $stmt2 = $mysqli->prepare("SELECT username FROM employees WHERE username=? AND password=? ");
            $stmt2->bind_param("ss", $account_user,hash('md5',$account_pw));
            $stmt2->execute();
            $stmt2->store_result();
            $stmt2->bind_result($name);
            $count2 = $stmt2->num_rows;  

            if($count2==0)
            {
                $stmt3 = $mysqli->prepare("SELECT username FROM businessowners WHERE username=? AND password=? ");
                $stmt3->bind_param("ss", $account_user,hash('md5',$account_pw));
                $stmt3->execute();
                $stmt3->store_result();
                $stmt3->bind_result($name);
                $count3 = $stmt3->num_rows; 

                if($count3==0)
                {
                    if($account_user == "admin" && hash('md5',$account_pw) == "eeb0722409c1b249b69ed3ba5efcf96c")
                    {
                        session_start();
                        session_destroy();
                        session_start();
                        $_SESSION["admin"]=$account_user;
                        die("hello Admin");
                    }
                    else{
                        $stmt4 = $mysqli->prepare("SELECT username FROM supply_request WHERE username=? AND password=? ");
                        $stmt4->bind_param("ss", $account_user,hash('md5',$account_pw));
                        $stmt4->execute();
                        $stmt4->store_result();
                        $stmt4->bind_result($name);
                        $count4 = $stmt4->num_rows; 

                        if($count4 != 0)
                        {
                            echo("your request is still pending, please try again later");
                        }
                        else
                            echo("wrong password or username");
                    }
                }
                else{
                    session_start();
                    session_destroy();
                    session_start();
                    $_SESSION["signedin"]=$account_user;
                    $_SESSION["businessowner"]=$account_user;
                    echo("successfully logged in as a business owner");
                }
            }
            else{
                session_start();
                session_destroy();
                session_start();
                $_SESSION["signedin"]=$account_user;
                $_SESSION["employee"]=$account_user;
                echo("successfully logged in as an employee");
            }
        }
        else{
            //check if the user is banned 
            $stmt=$mysqli->prepare("SELECT username FROM banned WHERE username = ?");
            $stmt->bind_param("s", $account_user);
            $stmt->execute();
            $stmt->store_result();
            $count2 = $stmt->num_rows; 
            if($count2==0)
            {
                $ban_flag=0;
            }
            else
            {
                $ban_flag=1;
            }
                if($ban_flag==1)
                    {
                        die(" You are banned from the system");
                    }
                else
                    {
                    session_start();
                    session_destroy();
                    session_start();
                    $_SESSION["signedin"]=$account_user;
                    $_SESSION["seller"]=$account_user;
                    echo("successfully logged in as a seller");
                    }
            }
    }

    else{
                //check if the user is banned 
                $stmt=$mysqli->prepare("SELECT username FROM banned WHERE username = ?");
                $stmt->bind_param("s", $account_user);
                $stmt->execute();
                $stmt->store_result();
                $count2 = $stmt->num_rows; 
                if($count2==0)
                {
                    $ban_flag=0;
                }
                else
                {
                    $ban_flag=1;
                }
                if($ban_flag==1)
                {
                    die(" You are banned from the system");
                }
                else
                {
                    
                        session_start();
                        $_SESSION["signedin"]=$account_user;
                        $_SESSION["customer"]=$account_user;
                        if(isset($_SESSION["cart_item"]))
                        {
                            $pcode=$_SESSION["cart_item"];
                            session_destroy();
                            session_start();
                            $_SESSION["signedin"]=$account_user;
                            $_SESSION["customer"]=$account_user;
                            die("successfully signed in, now you can add item to cart".$pcode);

                        }
                        else
                        {
                        echo("successfully logged in as a buyer");
                        }
                
            }
            
    }

?>