<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resources/second hand.png">
</head>

<body>
    <div class=" container-fluid">
        <div class="row bgH">
            <?php include "header.php";

            if (isset($_SESSION["u"])) {
                $user_data = $_SESSION["u"];

                if ($user_data["status_id"] == 1) {
            ?>
                    <div class="col-12">
                        <div class="row d-flex justify-content-center mt-5">
                            <div class="col-lg-10 col-md-10 col-12 mt-5">
                                <span class=" text-white fs-3 fw-bold">SELL ITEMS</span>
                                <div class="p-3 row text-white bg-dark">
                                    <div class="col-lg-6 col-md-6 col-12 p-3">
                                        <span>Add Title</span>
                                        <input type="text" class="form-control" id="title">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 p-3">
                                        <span>Add Quantity</span>
                                        <input type="number" class="form-control" value="1" min="1" id="qty">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 p-3">
                                        <span>Add Price</span>
                                        <input type="text" class="form-control" id="price">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 p-3">
                                        <span>Category</span>
                                        <select class="form-select" id="cat">
                                            <option value="0">Select Category</option>
                                            <?php
                                            $cat_rs = Database::search("SELECT * FROM `category`");
                                            $cat_num = $cat_rs->num_rows;
                                            for ($x = 0; $x < $cat_num; $x++) {
                                                $cat_data = $cat_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cat_data["id"]; ?>"><?php echo $cat_data["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 p-3">
                                        <span>Item Location</span>
                                        <select class="form-select" id="loc">
                                            <option value="0">Select the Nearest City to your Location</option>
                                            <?php
                                            $city_rs = Database::search("SELECT * FROM `city`");
                                            $city_num = $city_rs->num_rows;
                                            for ($x = 0; $x < $city_num; $x++) {
                                                $city_data = $city_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $city_data["id"]; ?>"><?php echo $city_data["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 p-3">
                                        <span>Condition</span>
                                        <select class="form-select" id="con">
                                            <option value="0">Select Condition</option>
                                            <?php
                                            $cond_rs = Database::search("SELECT * FROM `condition`");
                                            $cond_num = $cond_rs->num_rows;
                                            for ($x = 0; $x < $cond_num; $x++) {
                                                $cond_data = $cond_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cond_data["id"]; ?>"><?php echo $cond_data["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 p-3">
                                        <span>Add Images</span>
                                        <div class="row p-3">
                                            <div class="col-lg-6 col-md-6 col-12 p-3 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                                <img src="resources/352259_camera_icon.png" class="col-3" alt="spc_IMG" style="height: 200px;width: 200px;" id="i0">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-center align-items-center">
                                                <div class="col-4 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                                    <img src="resources/352259_camera_icon.png" class="col-3" alt="spc_IMG" style="height: 150px;width: 150px;" id="i1">
                                                </div>
                                                <div class="col-4 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                                    <img src="resources/352259_camera_icon.png" class="col-3" alt="spc_IMG" style="height: 150px;width: 150px;" id="i2">
                                                </div>
                                                <div class="col-4 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                                    <img src="resources/352259_camera_icon.png" class="col-3" alt="spc_IMG" style="height: 150px;width: 150px;" id="i3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <input type="file" class=" d-none" id="imgup" multiple>
                                            <label for="imgup" class="btn btn-outline-primary col-lg-2 col-md-2 col-6" onclick="changeProductImage();">Upload Image</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 p-3">
                                        <span>Add Specifications</span>
                                        <textarea class="form-control" cols="30" rows="5" id="speci"></textarea>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 p-3">
                                        <span>Add The Reason to sell</span>
                                        <textarea class="form-control" cols="30" rows="5" id="reason"></textarea>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 p-3">
                                        <span>Warrenty</span>
                                        <select class="form-select" id="war">
                                            <option value="0">Select Warrenty</option>
                                            <?php
                                            $war_rs = Database::search("SELECT * FROM `warenty`");
                                            $war_num = $war_rs->num_rows;
                                            for ($x = 0; $x < $war_num; $x++) {
                                                $war_data = $war_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $war_data["id"]; ?>"><?php echo $war_data["name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 p-3">
                                        <span>Delivery Fee</span>
                                        <input type="text" class="form-control" id="del">
                                        <span><b class=" text-danger">*</b> If you use a free delivery service add 0.00 as delivery fee</span>
                                    </div>

                                    <div class="col-12 mt-3 d-flex justify-content-center">
                                        <button class="btn text-white bgcol1 col-lg-3 col-md-3 col-6" onclick="sell();">Sell Item</button>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    </div>
                <?php
                }else{
                    ?>
                <div class="row vh-100 vw-100 d-flex align-items-center">
                    <span class=" text-center fs-1 fw-bold text-danger">Your Seller Account Has Been banded.</span>
                </div>
            <?php  
                }
            } else {
                ?>
                <div class="row vh-100 vw-100 d-flex align-items-center">
                    <span class=" text-center fs-1 fw-bold text-danger">Access Denid</span>
                </div>
            <?php
            }
            ?>


            <?php include "footer.php"; ?>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </div>
</body>

</html>