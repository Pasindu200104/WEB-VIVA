<?php
session_start();
require "connection.php";

$user = $_SESSION["u"];
$user_id = $user["id"];

$profname = $_POST["profname"];
$prolname = $_POST["prolname"];
$promob = $_POST["promob"];

Database::iud("UPDATE `user` SET `fname`='".$profname."',`lname`='".$prolname."',`mobile`='".$promob."' WHERE `id`='".$user_id."'");

$img = Database::search("SELECT * FROM `user_img` WHERE `user_id`='".$user_id."'");
$img_num = $img->num_rows;

if($img_num > 0){
    $length = count($_FILES);

    if ($length <= 1 && $length > 0) {
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
    
                    $file_name = "resources/profileImg/" . $user["fname"] . "_" . $x . "_" . uniqid() . $new_img_extension;
                    move_uploaded_file($img_file["tmp_name"], $file_name);
    
                    Database::iud("UPDATE `user_img` SET `path`='".$file_name."' WHERE `user_id`='".$user_id."'");
                } else {
                    echo ("Wrong image extension.");
                }
            }
        }
    
        echo ("Profile Updateed Successfully.");
    }
    
}else{
    $length = count($_FILES);

    if ($length <= 1 && $length > 0) {
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
    
                    $file_name = "resources/profileImg/" . $user["fname"] . "_" . $x . "_" . uniqid() . $new_img_extension;
                    move_uploaded_file($img_file["tmp_name"], $file_name);
    
                    Database::iud("INSERT INTO `user_img`(`path`, `user_id`) VALUES('" . $file_name . "', '" . $user_id . "')");
                } else {
                    echo ("Wrong image extension.");
                }
            }
        }
    
        echo ("Profile Updateed Successfully.");
    }
    
}
