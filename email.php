<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './config.php';
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$license = $_POST['license'];
$rent = $_POST['rent'];
$app = $_POST['app'];
$referral = isset($_POST['referral']) ? $_POST['referral'] : '';

try {
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USER;;
    $mail->Password = SMTP_PASSWORD;
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';

    $mail->setFrom($email, $name);
    $mail->addAddress('mateuszkantarewicz@gmail.com');
    $mail->isHTML(false);
    $mail->Subject = 'PCO Driver Application';
    $mail->Body    = "Name: $name\nEmail: $email\nMobile Number: $phone\nHow many years do you hold PCO license? $license years\nDo you rent or own the vehicle that you use for work?: $rent \nOn which taxi services or ride-hailing platforms do you drive?: $app\nReferral: $referral";

    $mail->send();
    header('Location: success.html');
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
