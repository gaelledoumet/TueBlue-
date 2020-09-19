<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

session_start();

$username=$_SESSION["signedin"];
$number=$_POST["number"];
$flag=$_POST["flag"];

$db_host="localhost";
$db_user="root";
$db_pass=null;
$db_name="tueblue";

if(($number==""))
{
    die("empty");
}
$boolean=preg_match('/[0-9]{8}/', $number);
if(!($boolean))
{
    die("wrong format");
}

$mysqli=new mysqli($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno())
{
    echo("connect failed");
    exit();
}
$stmt0= $mysqli -> prepare("SELECT phonenumber FROM customers WHERE phonenumber = ?");
$stmt0-> bind_param ("s", $number); 
$stmt0-> execute();
$stmt0-> store_result();
$stmt0-> bind_result($phh);
$count0= $stmt0->num_rows;
if($count0 == 0)
{
    $stmt10= $mysqli -> prepare("SELECT phonenumber FROM sellers WHERE phonenumber = ?");
    $stmt10-> bind_param ("s", $number); 
    $stmt10-> execute();
    $stmt10-> store_result();
    $stmt10-> bind_result($ph);
    $count10= $stmt10->num_rows; 
    if($count10 == 0)
    {
        $stmt101= $mysqli -> prepare("SELECT phonenumber FROM employees WHERE phonenumber = ?");
        $stmt101-> bind_param ("s", $number); 
        $stmt101-> execute();
        $stmt101-> store_result();
        $stmt101-> bind_result($phhh);
        $count101= $stmt101->num_rows; 
        if($count101 == 0)
        {
            $stmt102= $mysqli -> prepare("SELECT phonenumber FROM businessowners WHERE phonenumber = ?");
            $stmt102-> bind_param ("s", $number); 
            $stmt102-> execute();
            $stmt102-> store_result();
            $stmt102-> bind_result($phhhhh);
            $count102= $stmt102->num_rows; 
            if($count101==0)
            {
                if($flag=="")
{
    $stmt= $mysqli -> prepare("UPDATE customers set phonenumber=? WHERE username =?");
    $stmt -> bind_param ("ss",$number, $username); 
    $stmt -> execute();
    $stmt -> store_result();

        die("success");
}
else if($flag=="seller")
{
    $stmt= $mysqli -> prepare("UPDATE sellers set phonenumber=? WHERE username =?");
    $stmt -> bind_param ("ss",$number, $_SESSION["signedin"]); 
    $stmt -> execute();
    $stmt -> store_result();

        die("success");
}
else if($flag=="employee")
{
    $stmt= $mysqli -> prepare("UPDATE employees set phonenumber=? WHERE username =?");
    $stmt -> bind_param ("ss",$number, $_SESSION["signedin"]); 
    $stmt -> execute();
    $stmt -> store_result();

        die("success");
}
else if($flag=="businessowner")
{
    $stmt= $mysqli -> prepare("UPDATE businessowners set phonenumber=? WHERE username =?");
    $stmt -> bind_param ("ss",$number, $_SESSION["signedin"]); 
    $stmt -> execute();
    $stmt -> store_result();

        die("success");
}
            }
            else{
                die("this phone number already exists") ;
            }
        }
        else{
            die("this phone number already exists") ;
        }
    }
    else{
        die("this phone number already exists") ;
    }
}
else{
    die("this phone number already exists") ;
}


?>