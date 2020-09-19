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

//send the person a disapproval email.
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
    $mailer->Subject = 'Regret message.';
    $mailer->Body = 'We are sorry to inform you that your supply request has been disapproved.';

    $mailer->send();
    $mailer->ClearAllRecipients();

    $stmt = $mysqli->prepare("DELETE FROM supply_request WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->store_result();
    die("Request successfully disapproved");

} catch (Exception $e) {
   // echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
    die("Sorry, there seems to be a problem with the connection, try later.");
}




?>
