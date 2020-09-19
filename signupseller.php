<?php
error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

        $num = $_POST["number"];
        $pass0 = $_POST["password"];
        $pass1 = $_POST["passwordconfirmed"];
        $name1= $_POST["username"];
        $fnamee1= $_POST["firstname"];
        $lnamee1= $_POST["lastname"];
        $address11= $_POST["address"];
        $email11 = $_POST["email"];
        $boolean=preg_match('/[0-9]{8}/', $num);       
        $boolean1=preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/', $email11);
        $boolean2=preg_match('/^[a-zA-Z]+$/', $fnamee1);
        $boolean3=preg_match('/^[a-zA-Z]+$/', $lnamee1);
        $boolean4=preg_match('/^(?!.*\.\.)(?!.*\.$)[^\W][\w.]{0,29}$/', $name1);

        if( ($pass0 == null) || ($pass1 == null) || ($num == null) || ($name1 == null) || ($fnamee1 == null) || ($lnamee1 == null) || ($address11 == null) || ($email11 == null))
        {
            die("Please fill out all the requirements.");
        }
        if($boolean1==false)
        {
            die("wrong email format.");
        }
        if(($boolean2==false))
        {
            die("wrong firstname format.");
        }
        if(($boolean3==false))
        {
            die("wrong lastname format.");
        }
        if($boolean4==false)
        {
            die("wrong username format.");
        }       
        if ($boolean==false)
        {
            die("Wrong phone number format.");
        }
        else if(strcmp($pass1,$pass0)!=0 )
        {
            die("The passwords don't match.");
        }
        else
        {

            $db_host = "localhost";
            $db_user="root";
            $dbt_pass=null;
            $db_name="tueblue";
            $mysqli= new mysqli($db_host,$db_user,$dbt_pass,$db_name);
            
            if (mysqli_connect_errno()){
                printf("connect failed : %s \n" , mysqli_connect_error());
                exit();
            }

        if (isset($_POST["email"]) && isset($_POST["password"]))
        {   
                $name1= $_POST["username"];
                $fnamee= $_POST["firstname"];
                $lnamee= $_POST["lastname"];
                $address1= $_POST["address"];
                $email1 = $_POST["email"];
                $password1 = $_POST["password"];
                $number1 = $_POST["number"];

                $stmt3= $mysqli -> prepare("SELECT * FROM banned WHERE email = ?");
                $stmt3-> bind_param ("s", $email1); 
                $stmt3-> execute();
                $stmt3-> store_result();
                $stmt3-> bind_result($emailll);
                $count3= $stmt3->num_rows; 
                if($count3 != 0)
                   die("this email has been banned");

                else{

                
                $stmt0= $mysqli -> prepare("SELECT phonenumber FROM customers WHERE phonenumber = ?");
                $stmt0-> bind_param ("s", $number1); 
                $stmt0-> execute();
                $stmt0-> store_result();
                $stmt0-> bind_result($phh);
                $count0= $stmt0->num_rows; 

                if($count0 != 0)
                {
                    die("this phone number already exists");
                }

                else{
                    $stmt10= $mysqli -> prepare("SELECT phonenumber FROM sellers WHERE phonenumber = ?");
                    $stmt10-> bind_param ("s", $number1); 
                    $stmt10-> execute();
                    $stmt10-> store_result();
                    $stmt10-> bind_result($ph);
                    $count10= $stmt10->num_rows; 

                    if($count10!=0)
                    {
                        die("this phone number already exists");
                    }
                    else{
                        $stmt101= $mysqli -> prepare("SELECT phonenumber FROM employees WHERE phonenumber = ?");
                        $stmt101-> bind_param ("s", $number1); 
                        $stmt101-> execute();
                        $stmt101-> store_result();
                        $stmt101-> bind_result($phhh);
                        $count101= $stmt101->num_rows; 

                        if($count101!=0)
                        {
                            die("this phone number already exists");
                        }

                        else{
                            $stmt102= $mysqli -> prepare("SELECT phonenumber FROM businessowners WHERE phonenumber = ?");
                            $stmt102-> bind_param ("s", $number1); 
                            $stmt102-> execute();
                            $stmt102-> store_result();
                            $stmt102-> bind_result($phhhhh);
                            $count102= $stmt102->num_rows; 

                            if($count102!=0)
                            {
                                die("this phone number already exists");
                            }
                            else{
                            $stmt1021= $mysqli -> prepare("SELECT phonenumber FROM supply_request WHERE phonenumber = ?");
                            $stmt1021-> bind_param ("s", $number1); 
                            $stmt1021-> execute();
                            $stmt1021-> store_result();
                            $stmt1021-> bind_result($phhhhhh);
                            $count1021= $stmt1021->num_rows; 
                            if($count1021!=0)
                            {
                                die("this phone number already exists");
                            }
                            else{
                                $stmt10211= $mysqli -> prepare("SELECT phonenumber FROM customers_to_be WHERE phonenumber = ?");
                                $stmt10211-> bind_param ("s", $number1); 
                                $stmt10211-> execute();
                                $stmt10211-> store_result();
                                $stmt10211-> bind_result($phhhhhh);
                                $count10211= $stmt10211->num_rows; 
                                if($count10211!=0)
                                {
                                    die("this phone number already exists");
                                }
                            }
                            }
                        }
                    }
                }
        
                $stmt= $mysqli -> prepare("SELECT email FROM customers WHERE email = ?");
                $stmt -> bind_param ("s", $email1); 
                $stmt -> execute();
                $stmt -> store_result();
                $stmt -> bind_result($em);
                $count= $stmt->num_rows;  

            if ($count !=0 )
            {
                die("this email already exists");
            }

            else{
                $stmt11= $mysqli -> prepare("SELECT email FROM sellers WHERE email = ?");
                $stmt11 -> bind_param ("s", $email1); 
                $stmt11 -> execute();
                $stmt11 -> store_result();
                $stmt11 -> bind_result($ema);
                $count11= $stmt11->num_rows;  

                if ($count11 !=0 )
                {
                    die("this email already exists");
                }
                else{
                    $stmt111= $mysqli -> prepare("SELECT email FROM employees WHERE email = ?");
                    $stmt111 -> bind_param ("s", $email1); 
                    $stmt111 -> execute();
                    $stmt111 -> store_result();
                    $stmt111 -> bind_result($emaa);
                    $count111= $stmt111->num_rows;  

                    if ($count111 !=0 )
                    {
                        die("this email already exists");
                    }
                    else{
                    $stmt112= $mysqli -> prepare("SELECT email FROM businessowners WHERE email = ?");
                    $stmt112 -> bind_param ("s", $email1); 
                    $stmt112 -> execute();
                    $stmt112 -> store_result();
                    $stmt112 -> bind_result($emaaa);
                    $count112= $stmt112->num_rows;

                    if($count112!=0)
                    {
                        die("this email already exists");
                    }
                    else{
                        $stmt1111= $mysqli -> prepare("SELECT email password FROM supply_request WHERE email = ?");
                        $stmt1111 -> bind_param ("s", $email1); 
                        $stmt1111-> execute();
                        $stmt1111 -> store_result();
                        $stmt1111 -> bind_result($userr);
                        $count1111= $stmt1111->num_rows;
                        if($count1111!=0)
                        {
                            die("this email already exists");
                        }
                        else{
                            $stmt11111= $mysqli -> prepare("SELECT email password FROM customers_to_be WHERE email = ?");
                            $stmt11111 -> bind_param ("s", $email1); 
                            $stmt11111-> execute();
                            $stmt11111 -> store_result();
                            $stmt11111 -> bind_result($userr);
                            $count11111= $stmt11111->num_rows;
                            if($count11111!=0)
                            {
                                die("this email already exists");
                            }
                        }
                    }

                    }
                }
            }

            $stmt1= $mysqli -> prepare("SELECT username password FROM customers WHERE username = ?");
            $stmt1 -> bind_param ("s", $name1); 
            $stmt1 -> execute();
            $stmt1 -> store_result();
            $stmt1 -> bind_result($user);
            $count1= $stmt1->num_rows;  

           if ($count1 != 0 )
             {
              die("this username already exists");
             }

             else{
                $stmt13= $mysqli -> prepare("SELECT username password FROM sellers WHERE username = ?");
                $stmt13 -> bind_param ("s", $name1); 
                $stmt13 -> execute();
                $stmt13 -> store_result();
                $stmt13 -> bind_result($userr);
                $count13= $stmt13->num_rows;  
    
               if ($count13 != 0 )
                 {
                  die("this username already exists");
                 }
                else{
                    $stmt131= $mysqli -> prepare("SELECT username password FROM employees WHERE username = ?");
                    $stmt131 -> bind_param ("s", $name1); 
                    $stmt131 -> execute();
                    $stmt131 -> store_result();
                    $stmt131 -> bind_result($userrr);
                    $count131= $stmt131->num_rows;  

                    if($count131!=0)
                    {
                        die("this username already exists");
                    }
                    else{
                    $stmt132= $mysqli -> prepare("SELECT username password FROM businessowners WHERE username = ?");
                    $stmt132 -> bind_param ("s", $name1); 
                    $stmt132 -> execute();
                    $stmt132 -> store_result();
                    $stmt132 -> bind_result($userrrr);
                    $count132= $stmt132->num_rows;
                    }
                    if($count132!=0)
                    {
                        die("this username already exists");               
                    }
                    else{
                        $stmt0000= $mysqli -> prepare("SELECT username password FROM supply_request WHERE username = ?");
                        $stmt0000 -> bind_param ("s", $name1); 
                        $stmt0000 -> execute();
                        $stmt0000 -> store_result();
                        $stmt0000 -> bind_result($userrrrr);
                        $count0000= $stmt0000->num_rows;
                        if($count0000!=0)
                        {
                            die("this username already exists");
                        }
                        else{
                            $stmt00001= $mysqli -> prepare("SELECT username password FROM customers_to_be WHERE username = ?");
                            $stmt00001 -> bind_param ("s", $name1); 
                            $stmt00001 -> execute();
                            $stmt00001 -> store_result();
                            $stmt00001 -> bind_result($userrrrr);
                            $count00001= $stmt00001->num_rows;
    
                            if($count00001!=0)
                            {
                                die("this username already exists");
                            } 
                        }
                    }
                 }
             }

            if($count00001 == 0 && $count11111 == 0 && $count10211  == 0 && $count1021 == 0 && $count1111 == 0 && $count0000 == 0 && $count == 0 && $count10 == 0 && $count11 == 0 && $count1 == 0 && $count0 == 0 && $count13 == 0 && $count102 == 0 && $count101 == 0 && $count111 == 0 && $count112 == 0 && $count131 == 0 && $count132 == 0)
            {
                    $pend = "pending";

                    $stmt2 = $mysqli->prepare("INSERT INTO supply_request (username, phonenumber, address, firstname, lastname, email, password, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt2->bind_param("ssssssss", $name1, $number1, $address1, $fnamee, $lnamee, $email1, hash('md5', $password1), $pend);
                    $stmt2->execute();

                    die("request sent to admin");
            }
        }

    }
        }
        
        
        ?>