<?php
require "connection.php";

$pid = $_GET["id"];

Database::iud("DELETE FROM `cart` WHERE `product_id`='".$pid."'");
echo("Success");
?>