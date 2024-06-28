<?php
session_start();
require "connection.php";

$user = $_SESSION["u"];
$user_id = $user["id"];

$pid = $_GET["id"];

$title = $_POST["title"];
$qty = $_POST["qty"];
$price = $_POST["price"];
$cat = $_POST["cat"];
$loc = $_POST["loc"];
$con = $_POST["con"];
$speci = $_POST["speci"];
$reason = $_POST["reason"];
$war = $_POST["war"];
$del = $_POST["del"];

if (empty($title)) {
    echo ("Please add a title");
} else if (strlen($title) > 100) {
    echo ("Title Characters should be less than 100.");
} else if (empty($qty)) {
    echo ("Please add Quantity");
} else if ($qty == "0" || $qty == "e" || $qty < 0) {
    echo ("Cant Use any symbols in quantity");
} else if (empty($price)) {
    echo ("Please add a price");
} else if ($price == "0" || $price == "e" || $price < 0) {
    echo ("Cant Use any symbols in Price");
} else if ($cat == '0') {
    echo ("Please Select a Category");
} else if ($loc == '0') {
    echo ("Please Select a Location");
} else if ($con == '0') {
    echo ("Please Select a condition");
} else if (empty($speci)) {
    echo ("Please add Specifications");
} else if (empty($reason)) {
    echo ("Please add a Reason to sell the Item.");
} else if ($war == '0') {
    echo ("Please Select a Warranty type");
} else if (empty($del)) {
    echo ("Please add Delivery fee");
} else if ($del == "0" || $del == "e" || $del < 0) {
    echo ("Cant Use any symbols in Delivery Price");
} else {
    Database::iud("UPDATE `product` SET `name`='" . $title . "',`price`='" . $price . "',`quantity`='" . $qty . "',`specifications`='" . $speci . "',
        `reason`='" . $reason . "',`delivery_price`='" . $del . "' WHERE `id`='" . $pid . "'");

    $length = count($_FILES);

    if ($length <= 4 && $length > 0) {
        $pro_data = $img_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
        $pro_img_rs = Database::search("SELECT * FROM `pro_img` WHERE `product_id`='" . $pid . "'");
        $pro_img_num = $pro_img_rs->num_rows;

        for ($x = 0; $x < $length; $x++) {
            $pro_img_data = $pro_img_rs->fetch_assoc();

            if (isset($_FILES["img" . $x])) {
                $img_file = $_FILES["img" . $x];
                $file_exten = $img_file["type"];

                if (in_array($file_exten, $img_extensions)) {
                    $new_img_extension;

                    if ($file_exten == "image/jpg") {
                        $new_img_extension = ".jpg";
                    } else if ($file_exten == "image/jpeg") {
                        $new_img_extension = ".jpeg";
                    } else if ($file_exten == "image/png") {
                        $new_img_extension = ".png";
                    } else if ($file_exten == "image/svg+xml") {
                        $new_img_extension = ".svg";
                    }

                    $file_name = "resources/product_Img/" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                    move_uploaded_file($img_file["tmp_name"], $file_name);
                    if ($pro_img_num > 0) {
                        Database::iud("UPDATE `pro_img` SET `path`='" . $file_name . "' WHERE `id`='" . $pro_img_data["id"] . "'");
                    } else {
                        Database::iud("INSERT INTO `pro_img`(`path`,`product_id`) VALUES('" . $file_name . "','" . $pid . "')");
                    }
                } else {
                    echo ("Wrong image extension.");
                }
            }
        }

        echo ("Success");
    } else {
        echo ("Invalid image count");
    }
}
?>