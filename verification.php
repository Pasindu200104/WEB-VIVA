<?php
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["email"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
$user_num = $user_rs->num_rows;
$user_data = $user_rs->fetch_assoc();

if ($user_num == 1) {
    $code = uniqid();

    Database::iud("UPDATE `user` SET `verification`='" . $code . "' WHERE `email`='" . $email . "'");
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dilshanpasindu593@gmail.com';
        $mail->Password = 'uwuyfrfrnovnomxy';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('dilshanpasindu593@gmail.com', 'SPC Reset Password');
        $mail->addReplyTo('dilshanpasindu593@gmail.com', 'SPC Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Verification Code';
        $bodyContent = '<h4 font-weight: lighter;>Hello '.$user_data["fname"]." ".$user_data["lname"].',</h4>
        <h4 font-weight: lighter;>You have requested a verification code to change your Password.</h4>
        <h3 font-weight: bold;>Verification Code : <b  style="color:green;">'.$code.'</b></h3>
        <h4 font-weight: lighter;>If this is not you, change your Password imediately & contact custom support.</h4><br/>
        <h4 font-weight: lighter;>Thank You For Using Our Service!</h4>';
        $mail->Body = $bodyContent;

        $mail->send();
        echo 'Success';
    } catch (Exception $e) {
        echo 'Verification code sending failed. Mailer Error: ' . $mail->ErrorInfo;
    }
} else {
    echo ("Invalid User Email");
}
