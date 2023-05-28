<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if(isset($_POST['send'])){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'goodbloxsystem@gmail.com';
    $mail->Password = 'nexlkzmedlhgifje';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom($_USER['email']);
    $mail->addAddress('YOUR_EMAIL');
    $mail->Subject = ("GoodBlox Verification");
    $mail->Body = "Verify your GoodBlox Account: no link lmao";
    $mail->send();

    header("Location: /");
}
?>