<?php
        error_reporting(E_ERROR | E_PARSE);
        header('Content-Type:text/plain');
        session_start();

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

        $token=(int)$_GET["token"];
        $newtoken=0;
        $file=$_FILES['file'];
        $fileName=$_FILES['file']['name'];
        $fileTmpName=$_FILES['file']['tmp_name'];
        $fileSize=$_FILES['file']['size'];
        $fileError=$_FILES['file']['error'];
        $fileType=$_FILES['file']['type'];

        $fileExt=explode('.',$fileName);
        $fileActualExt= strtolower($fileExt[1]);

        $allowed=array('jpg','jpeg','png');
        if(in_array($fileActualExt,$allowed))
        {
            if($fileError===0)
            {
                if($fileSize<1000000)
                {
                    $fileNameNew=uniqid('',true).".".$fileActualExt;
                    $fileDestination='uploads/'.$fileNameNew;

                    move_uploaded_file($fileTmpName,$fileDestination);

                    $stmt=$mysqli->prepare("UPDATE products SET image_url = ?, token =? WHERE token=?");
                    $stmt->bind_param("sii",$fileDestination,$newtoken,$token);
                    $stmt->execute();
                    die("Image uploaded succesfully.");

                }
                else
                {
                    die("your file is too big");
                }

            }
            else
            {
                die("there was an error uploading your file");
            }
        }
        else
        {
            die("you cannot upload files of this type");
        }

?>