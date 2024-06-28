<?php
session_start();
require "connection.php";

$user = $_SESSION["u"];
$user_id = $user["id"];

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
} else if ($qty == "0" | $qty == "e" | $qty < 0) {
    echo ("Cant Use any symboles in quantity");
} else if (empty($price)) {
    echo ("Please add a price");
} else if ($price == "0" | $price == "e" | $price < 0) {
    echo ("Cant Use any symboles in Price");
} else if ($cat == '0') {
    echo ("Please Select a Category");
} else if ($loc == '0') {
    echo ("Please Select a Location");
} else if ($con == '0') {
    echo ("Please Select a condition");
} else if (empty($speci)) {
    echo ("Please add Specifications");
} else if (empty($reason)) {
    echo ("Please add a Resont to sell the Item.");
} else if ($war == '0') {
    echo ("Please Select a Warrenty type");
} else if (empty($del)) {
    echo ("Please add Delivery fee");
} else if ($del == "0" | $del == "e" | $del < 0) {
    echo ("Cant Use any symboles in Delivery Price");
} else {
    $pro_rs = Database::search("SELECT * FROM `product` WHERE `name`='" . $title . "'");
    $pro_num = $pro_rs->num_rows;
    
    if ($pro_num > 0) {
        echo ("Product with the same Title already exists");
    } else {
        // Insert product first
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");
    
        Database::iud("INSERT INTO `product`(`name`,`price`,`quantity`,`specifications`,`reason`,`delivery_price`,`date`,`category_id`,`user_id`,`condition_id`,`warenty_id`,`status_id`,`city_id`)
        VALUES('" . $title . "','" . $price . "','" . $qty . "','" . $speci . "','" . $reason . "','" . $del . "','" . $date . "','" . $cat . "','" . $user_id . "','" . $con . "','" . $war . "','1','".$loc."');");
    
        $pro_id = Database::$connection->insert_id;
    
        $length = count($_FILES);
    
        if ($length <= 4 && $length > 0) {
            $img_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    
            for ($x = 0; $x < $length; $x++) {
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
    
                        Database::iud("INSERT INTO `pro_img`(`path`, `product_id`) VALUES('" . $file_name . "', '" . $pro_id . "')");
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

}
