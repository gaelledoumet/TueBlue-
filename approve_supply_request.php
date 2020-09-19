<?php

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ERROR | E_PARSE);
header('Content-Type:text/plain');

$email=$_POST["email"];

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

//to fetch results
$result = mysqli_query($mysqli, "SELECT username, firstname, lastname, phonenumber, address, password FROM supply_request WHERE email='{$email}'");
$row = mysqli_fetch_row($result);

//send the person an approval email.
$developmentMode = true;//when the website is deployed, set this to false
$mailer = new PHPMailer($developmentMode);

try {
    $mailer->SMTPDebug = 0;
    $mailer->isSMTP();

    if ($developmentMode) {
    $mailer->SMTPOptions = [
        'ssl'=> [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        ]
    ];
    }

    $mailer->Host = 'smtp.gmail.com';
    $mailer->SMTPAuth = true;
    $mailer->Username = 'tueblue123@gmail.com';
    $mailer->Password = 'tueBLUE123supp';
    $mailer->SMTPSecure = 'tls';
    $mailer->Port = 587;

    $mailer->setFrom('tueblue123@gmail.com', 'TueBlue Support');
    $mailer->addAddress($email, " ");

    $mailer->isHTML(true);
    $mailer->Subject = 'Request approved.';
    $mailer->Body = 'Dear supplier, we are glad to inform you that your supply request has been approved. Click on this link to login into your account: http://localhost/clarawork/TueBlue/Tueblue/signin.html';

    $mailer->send();
    $mailer->ClearAllRecipients();


    //to add results
    $sql = "INSERT INTO sellers (username, phonenumber, address, firstname, lastname, email, password)
    VALUES ('$row[0]','$row[3]','$row[4]','$row[1]','$row[2]','$email','$row[5]')";
    mysqli_query($mysqli, $sql);

    // sql to delete row
    $sql2 = "DELETE FROM supply_request WHERE email='{$email}'";
    mysqli_query($mysqli, $sql2); 
    
    die("Request approved.");


} catch (Exception $e) {
    echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
    die("Sorry, there seems to be a problem with the connection, try later.");
}





?>