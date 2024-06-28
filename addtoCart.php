<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $user_data = $_SESSION["u"];

    $pid = $_GET["id"];

    $proc_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $proc_data = $proc_rs->fetch_assoc();

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $user_data["id"] . "' AND `product_id`='".$pid."'");
    $cart_num = $cart_rs->num_rows;

    if ($cart_num > 0) {
        echo ("This Item Alredy Added to the Cart.");
    } else {
        Database::iud("INSERT INTO `cart`(`qty`,`product_id`,`user_id`) 
    VALUES('" . $proc_data["quantity"] . "','" . $pid . "','" . $user_data["id"] . "')");

        echo ("Success");
    }
}
?>