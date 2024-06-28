<?php
require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST["email"];
if (empty($email)) {
    echo ("Please Enter an Email");
} else {
    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {
        $admin_data = $admin_rs->fetch_assoc();
        $code = uniqid();
        Database::iud("UPDATE `admin` SET `verification` = '" . $code . "' WHERE `email`='" . $email . "'");
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'dilshanpasindu593@gmail.com';
            $mail->Password = 'uwuyfrfrnovnomxy';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('dilshanpasindu593@gmail.com', 'SPC Admin Login');
            $mail->addReplyTo('dilshanpasindu593@gmail.com', 'SPC Admin Login');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Verification Code';
            $bodyContent = '<h4 font-weight: lighter;>Welcome ' . $admin_data["fname"] . " " . $admin_data["lname"] . ',</h4>
            <h4 font-weight: lighter;>You have requested a Login verification code.</h4>
            <h3 font-weight: bold;>Verification Code : <b  style="color:green;">' . $code . '</b></h3>
            <br/>
            <h4 font-weight: lighter;>Thank You For Using Our Service!</h4>';
            $mail->Body = $bodyContent;

            $mail->send();
            echo 'Success';
        } catch (Exception $e) {
            echo 'Verification code sending failed. Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        echo ("Invalid Email");
    }
}
?>