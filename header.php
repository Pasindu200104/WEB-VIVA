<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resources/second hand.png">
</head>

<body>
    <div class=" container-fluid">
        <div class="row bg-black shadow-lg fixed-top">
            <div class="col-lg-3 col-md-3 col-12 d-flex justify-content-lg-start justify-content-sm-center align-items-lg-center">
                <span class="A ms-3" style="color:#ff33ff;">SECONDHAND <span class=" text-danger">PC</span></span>
            </div>
            <?php
            require "connection.php";

            session_start();
            ?>
            <div class=" col-lg-6 col-md-6 col-12 text-white d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <a href="home.php" class=" text-decoration-none text-white">Home</i></a>
                    </div>
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <a>About</a>
                    </div>
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <a>Contact</a>
                    </div>
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-outline-light border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                List
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="myOrder.php">My Orders</a></li>
                                <li><a class="dropdown-item" href="listedItems.php">Listed Items</a></li>
                                <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                                <li><a class="dropdown-item" href="selling.php">My Selling</a></li>
                                <li><a class="dropdown-item" href="sell.php">Sell Item</a></li>
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="#" onclick="signOut();">Log Out</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-3 col-12 d-none d-lg-block d-md-block p-3">
                <div class="row">
                    <div class="col-3">


                    </div>
                    <div class="col-9 text-white">
                        <div class="row">
                            <?php
                            

                            if (isset($_SESSION["u"])) {
                                $data = $_SESSION["u"];
                            ?>
                                <div class="col-lg-8 col-md-8 col-12">
                                    <span class=" float-end"><?php echo $data["fname"] . " " . $data["lname"]; ?></span><br>
                                    <span class="float-end"><?php echo $data["email"]; ?></span>
                                </div>

                                <div class="col-lg-4 col-md-4 d-flex justify-content-center align-items-center">
                                    <?php
                                    $pro_img = Database::search("SELECT * FROM `user_img` WHERE `user_id`='" . $data["id"] . "'");
                                    $pro_num = $pro_img->num_rows;

                                    if ($pro_num > 0) {
                                        $pro_data = $pro_img->fetch_assoc();
                                    ?>

                                        <img src="<?php echo $pro_data["path"]; ?>" class="col-12 rounded-circle bg-body p-1" style="width: 40px;height: 40px;" alt="propic">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resources/1564534_customer_man_user_account_profile_icon(1).png" class="col-12 rounded-circle bg-body p-1" style="width: 40px;height: 40px;" alt="propic">
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            } else {
                            ?>
                                <a href="index.php" class="btn btn-primary text-center col-10 text-end">Sign In</a>
                            <?php
                            }
                            ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="script.js"></script>
    </div>
</body>

</html>