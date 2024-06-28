<?php
require "connection.php";

session_start();
if (isset($_SESSION["a"])) {
    $admin_data = $_SESSION["a"];

    $fname = $_POST["admf"];
    $lname = $_POST["adml"];
    $mob = $_POST["admm"];

    Database::iud("UPDATE `admin` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mob . "' WHERE `email`='" . $admin_data["email"]. "'");

    $img = Database::search("SELECT * FROM `admin_img` WHERE `admin_email`='" . $admin_data["email"] . "'");
    $img_num = $img->num_rows;

    if ($img_num > 0) {
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

                        $file_name = "resources/profileImg/" . $admin_data["fname"] . "_" . $x . "_" . uniqid() . $new_img_extension;
                        move_uploaded_file($img_file["tmp_name"], $file_name);

                        Database::iud("UPDATE `admin_img` SET `path`='" . $file_name . "' WHERE `admin_email`='" . $admin_data["email"] . "'");
                        echo("success");
                    } else {
                        echo ("Wrong image extension.");
                    }
                }
            }

            echo ("Profile Updateed Successfully.");
        }
    } else {
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

                        $file_name = "resources/profileImg/" . $admin_data["fname"] . "_" . $x . "_" . uniqid() . $new_img_extension;
                        move_uploaded_file($img_file["tmp_name"], $file_name);

                        Database::iud("INSERT INTO `admin_img`(`path`, `admin_email`) VALUES('" . $file_name . "', '" . $admin_data["email"] . "')");
                        echo("success");
                    } else {
                        echo ("Wrong image extension.");
                    }
                }
            }

            echo ("Profile Updateed Successfully.");
        }
    }
}
?>