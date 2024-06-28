<?php
require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$mob = $_POST["mob"];
$gen = $_POST["gen"];

if (empty($fname)) {
    echo ("Please Enter First Name");
} else if (strlen($fname) > 45) {
    echo ("Character Limit Exceeded.");
} else if (empty($lname)) {
    echo ("Please Enter Last Name");
} else if (strlen($lname) > 45) {
    echo ("Character Limit Exceeded.");
} else if (empty($email)) {
    echo ("Please Enter an Email");
} else if (strlen($email) > 100) {
    echo ("Character Limit Exceeded.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email.");
} else if (empty($pass)) {
    echo ("Please Enter a Password");
} else if (strlen($pass) < 8 || strlen($pass) > 20) {
    echo ("Password length must me between 8 and 20");
} else if (empty($mob)) {
    echo ("Please Enter a Mobile Number");
} else if (strlen($mob) != 10) {
    echo ("Mobile Number must contain 10 Characters");
} else if (!preg_match("/07[0,1,2,3,4,5,6,7,8][0-9]/", $mob)) {
    echo ("Invalid Mobile Number");
} else {
    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' OR `mobile`='" . $mob . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num > 0) {
        echo ("User With the same email or password alredy exists.");
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user` (`fname`,`lname`,`email`,`mobile`,`password`,`date`,`status_id`,`gender_id`)
        VALUES('" . $fname . "','" . $lname . "','" . $email . "','".$mob."','" . $pass . "','".$date."','1','" . $gen . "')");

        echo ("Success");
    }
}

?>