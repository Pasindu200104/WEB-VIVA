<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $order_id = $_POST["o"];
    $pid = $_POST["i"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];
    $qty = $_POST["q"];
    $uid = $_POST["u"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

    $current_qty = $product_data["quantity"];
    $new_qty = $current_qty - $qty;

    Database::iud("UPDATE `product` SET `quantity`='" . $new_qty . "' WHERE `id`='" . $pid . "'");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`qty`,`price`,`product_id`,`user_id`) VALUES 
    ('" . $order_id . "','" . $date . "','" . $qty . "','" . $amount . "','" . $pid . "','" . $uid . "')");

    Database::iud("INSERT INTO `ship`(`order_id`,`track_id`,`user_id`) VALUES('".$order_id."','1','".$uid."')");

    echo ("success");
}
