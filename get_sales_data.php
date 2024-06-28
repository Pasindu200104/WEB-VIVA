<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'connection.php';

function getSalesData($timeframe) {
    // Adjust the SQL query based on $timeframe (monthly, weekly, yearly)
    $query = "SELECT `name` AS title, `quantity` AS total_sold FROM `product`";

    $result = Database::search($query);
    $sales_data = array();

    while ($row = $result->fetch_assoc()) {
        $sales_data[] = $row;
    }

    return json_encode($sales_data);
}

// Example: Get monthly sales data
if (isset($_GET['timeframe'])) {
    $timeframe = $_GET['timeframe'];
    echo getSalesData($timeframe);
}
?>