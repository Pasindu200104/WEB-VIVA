<?php
require "connection.php";


if (isset($_POST["select"]) && isset($_GET["id"])) {
    $track_id = $_POST["select"];
    $order_id = $_GET["id"];

// echo($track_id."  ". $order_id);
    Database::iud("UPDATE `ship` SET `track_id`='" . $track_id . "' WHERE `order_id`='" . $order_id . "'");
    echo "success";
} else {
    echo "error";
}
?>