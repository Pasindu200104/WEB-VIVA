<?php
session_start();
require "connection.php";

$code = $_POST["code"];

if (empty($code)) {
    echo ("Please Enter Verification code.");
} else {
    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `verification`='" . $code . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {
        echo ("Success");
        $admin_data = $admin_rs->fetch_assoc();
        $_SESSION["a"] = $admin_data;
    } else {
        echo ("Invalid Code");
    }
}
