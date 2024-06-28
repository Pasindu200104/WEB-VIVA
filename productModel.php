<?php
require "connection.php";

$pid = $_GET["id"];
$pro_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
$pro_data = $pro_rs->fetch_assoc();

$pro_img = Database::search("SELECT * FROM `pro_img` WHERE `product_id`='" . $pid . "'");
$pro_img_data = $pro_img->fetch_assoc();
?>
<div class="row">
    <div class="col-6">
        <img src="<?php echo $pro_img_data["path"]; ?>" class="col-12" alt="SPC_img">
    </div>
    <div class="col-6">
    <span>Product ID: <?php echo $pro_data["id"]; ?></span><br><br>
        <span>Title: <?php echo $pro_data["name"]; ?></span><br>
        <span>Quantity: <?php echo $pro_data["quantity"]; ?></span><br>
        <span>Price: Rs.<?php echo $pro_data["price"]; ?>.00/=</span><br>
        <span>Delivery fee: <?php echo $pro_data["delivery_price"]; ?></span><br><br>
        <?php
        $user_rs = Database::search("SELECT * FROM `user` WHERE `id`='".$pro_data["user_id"]."'");
        $user_data = $user_rs->fetch_assoc();
        ?>
        <span>Seller: <?php echo $user_data["fname"]." ".$user_data["lname"]; ?></span><br>
        <span>Email: <?php echo $user_data["email"]; ?></span><br>
        <span>Mobile: <?php echo $user_data["mobile"]; ?></span><br>
    </div>

</div>