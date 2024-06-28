<?php
session_start();
require "connection.php";

$user = $_SESSION["u"];
$user_id = $user["id"];

$line1 = $_POST["line1"];
$line2 = $_POST["line2"];
$zip = $_POST["zip"];
$locup = $_POST["locup"];

if (empty($line1)) {
    echo ("Please add a line1");
} else if (strlen($line1) > 100) {
    echo ("Title Characters should be less than 100.");
} else if (empty($line2)) {
    echo ("Please add a line1");
} else if (strlen($line2) > 100) {
    echo ("Title Characters should be less than 100.");
} else if ($locup == '0') {
    echo ("Please Select a Category");
} else {
    $add_rs = Database::search("SELECT * FROM `address` WHERE `user_id`='" . $user_id . "'");
    $add_num = $add_rs->num_rows;

    if ($add_num > 0) {
        Database::iud("UPDATE `address` SET `line1`='" . $line1 . "',`line2`='" . $line2 . "',`zipcode`='" . $zip . "',`city_id`='" . $locup . "' WHERE `user_id`='" . $user_id . "'");
        echo ("Address Updated Successfully.");
    }else{
        Database::iud("INSERT INTO `address`(`line1`,`line2`,`zipcode`,`user_id`,`city_id`)
        VALUES('".$line1."','".$line2."','".$zip."','".$user_id."','".$locup."')");
        echo("Address Updated Successfully.");
    }
}
