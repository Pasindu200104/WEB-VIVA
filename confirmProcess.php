<?php
require "connection.php";

$order_id = $_GET["id"];

$ship_rs = Database::search("SELECT * FROM `ship` WHERE `order_id`='".$order_id."'");
$ship_num = $ship_rs->num_rows;

if($ship_num>0){
Database::iud("UPDATE `ship` SET `track_id`='5' WHERE `order_id`='".$order_id."'");
echo("success");
}else{
    echo("Invalid Order");
}
?>