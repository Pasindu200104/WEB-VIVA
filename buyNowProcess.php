<?php
session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["email"];

    $array;

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE id='".$id."'");
    $product_data = $product_rs->fetch_assoc();

    $address_rs = Database::search("SELECT * FROM `address` WHERE `user_id`='".$_SESSION["u"]["id"]."'");
    $address_num = $address_rs->num_rows;

    if($address_num == 1){

        $address_data = $address_rs->fetch_assoc();

        $address_id = $address_data["id"];
        $address = $address_data["line1"].", ".$address_data["line2"];

        $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$address_data["city_id"]."'");
        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["id"];
        $delivery = $product_data["delivery_price"];

        $item = $product_data["name"];
        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $uid = $_SESSION["u"]["id"];
        $mobile = $_SESSION["u"]["mobile"];
        $uaddress = $address;
        $city = $city_data["name"];

        $merchant_id = "1221358";
        $merchant_secret = "MzU3NjMyNzQ1ODI3NzMyOTYxMDkzMTczMDIwMDEwMjMyMzY2NjI4";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["uid"] = $uid;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["city"] = $city;
        $array["umail"] = $umail;
        $array["mid"] = $merchant_id;
        $array["msecret"] = $merchant_secret;
        $array["currency"] = $currency;
        $array["hash"] = $hash;

        echo json_encode($array);

    }else{
        echo ("2");
    }

}else{
    echo("1");
}

?>