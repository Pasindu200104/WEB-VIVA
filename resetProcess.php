<?php
require "connection.php";

$email = $_POST["email"];
$veri = $_POST["veri"];
$pass1 = $_POST["pass1"];
$pass2 = $_POST["pass2"];

if (empty($email)) {
    echo ("Please Enter an Email");
} else if (strlen($email) > 100) {
    echo ("Character Limit Exceeded.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email.");
} else if (empty($veri)) {
    echo ("Please Enter Verification Code");
} else if (empty($pass1)) {
    echo ("Please Enter a Password");
} else if (strlen($pass1) < 8 || strlen($pass1) > 20) {
    echo ("Password length must me between 8 and 20");
} else if ($pass1 != $pass2) {
    echo ("Please Check the password agin.");
} else {
    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num > 0) {
        $user_data = $user_rs->fetch_assoc();
        if ($user_data["verification"] == $veri) {
            Database::iud("UPDATE `user` SET `password`='" . $pass1 . "' WHERE `email`='".$email."'");
            echo ("Success");
        } else {
            echo ("Invalid Verification Code");
        }
    } else {
        echo ("Invalid Email Address");
    }
}
