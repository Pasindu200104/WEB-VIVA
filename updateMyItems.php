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
            if (isset($_GET["id"])) {
                $pid = $_GET["id"];

                $pro_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                $pro_data = $pro_rs->fetch_assoc();
            }
            ?>
            <div class="col-12">
                <div class="row d-flex justify-content-center mt-5">
                    <div class="col-10 mt-5">
                        <span class=" text-white fs-3 fw-bold">UPDATE MY ITEMS</span>
                        <div class="p-3 row text-white bg-dark">
                            <div class="col-lg-6 col-md-6 col-12 p-3">
                                <span>Add Title</span>
                                <input type="text" class="form-control" id="title2" value="<?php echo $pro_data["name"]; ?>">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-3">
                                <span>Add Quantity</span>
                                <input type="text" class="form-control" id="qty2" value="<?php echo $pro_data["quantity"]; ?>">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-3">
                                <span>Add Price</span>
                                <input type="text" class="form-control" id="price2" value="<?php echo $pro_data["price"]; ?>">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-3">
                                <span>Category</span>
                                <select class="form-select" id="cat2" disabled>
                                    <?php
                                    $cat_rs1 = Database::search("SELECT * FROM `category` WHERE `id`='" . $pro_data["category_id"] . "'");
                                    $cat_data1 = $cat_rs1->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $cat_data1["id"]; ?>"><?php echo $cat_data1["name"]; ?></option>

                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-3">
                                <span>Item Location</span>
                                <select class="form-select" id="loc2" disabled>
                                    <?php
                                    $city_rs1 = Database::search("SELECT * FROM `city` WHERE `id`='" . $pro_data["city_id"] . "'");
                                    $city_data1 = $city_rs1->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $city_data1["id"]; ?>"><?php echo $city_data1["name"]; ?></option>

                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-3">
                                <span>Condition</span>
                                <select class="form-select" id="con2" disabled>
                                    <?php
                                    $cond1_rs1 = Database::search("SELECT * FROM `condition` WHERE `id`='" . $pro_data["condition_id"] . "'");
                                    $cond1_data1 = $cond1_rs1->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $cond1_data1["id"]; ?>"><?php echo $cond1_data1["name"]; ?></option>

                                </select>
                            </div>
                            <div class="col-12 p-3">
                                <span>Add Images</span>
                                <?php
                                $img = array();

                                $pro_img2 = Database::search("SELECT * FROM `pro_img` WHERE `product_id`='" . $pro_data["id"] . "'");
                                $img_num2 = $pro_img2->num_rows;
                                if ($img_num2 > 0) {
                                    for ($x = 0; $x < $img_num2; $x++) {
                                        $img_data2 = $pro_img2->fetch_assoc();

                                        $img[$x] = $img_data2["path"];
                                    }
                                ?>
                                    <div class="row p-3">
                                        <div class="col-lg-6 col-md-6 col-12 p-3 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                            <img src="<?php echo $img[0]; ?>" class="col-3" alt="spc_IMG" style="height: 200px;width: 200px;" id="u0">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-center align-items-center">
                                            <div class="col-4 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                                <img src="<?php echo $img[1]; ?>" class="col-3" alt="spc_IMG" style="height: 150px;width: 150px;" id="u1">
                                            </div>
                                            <div class="col-4 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                                <img src="<?php echo $img[2]; ?>" class="col-3" alt="spc_IMG" style="height: 150px;width: 150px;" id="u2">
                                            </div>
                                            <div class="col-4 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                                <img src="<?php echo $img[3]; ?>" class="col-3" alt="spc_IMG" style="height: 150px;width: 150px;" id="u3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <input type="file" class=" d-none" id="imgup2" multiple>
                                        <label for="imgup2" class="btn btn-outline-primary col-lg-2 col-md-4 col-6" onclick="changeProductImage2();">Upload Image</label>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="row p-3">
                                        <div class="col-lg-6 col-md-6 col-12 p-3 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                            <img src="resources/352259_camera_icon.png" class="col-3" alt="spc_IMG" style="height: 200px;width: 200px;" id="u0">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-center align-items-center">
                                            <div class="col-4 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                                <img src="resources/352259_camera_icon.png" class="col-3" alt="spc_IMG" style="height: 150px;width: 150px;" id="u1">
                                            </div>
                                            <div class="col-4 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                                <img src="resources/352259_camera_icon.png" class="col-3" alt="spc_IMG" style="height: 150px;width: 150px;" id="u2">
                                            </div>
                                            <div class="col-4 d-flex justify-content-center align-items-center border border-2" style="height: 200px;">
                                                <img src="resources/352259_camera_icon.png" class="col-3" alt="spc_IMG" style="height: 150px;width: 150px;" id="u3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <input type="file" class=" d-none" id="imgup2" multiple>
                                        <label for="imgup2" class="btn btn-outline-primary col-2" onclick="changeProductImage2();">Upload Image</label>
                                    </div>
                                <?php
                                }
                                ?>



                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-3">
                                <span>Add Specifications</span>
                                <textarea class="form-control" cols="30" rows="5" id="speci2"><?php echo $pro_data["specifications"]; ?></textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-3">
                                <span>Add The Reason to sell</span>
                                <textarea class="form-control" cols="30" rows="5" id="reason2"><?php echo $pro_data["reason"]; ?></textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-3">
                                <span>Warrenty</span>
                                <select class="form-select" id="war2" disabled>
                                    <?php
                                    $war_rs1 = Database::search("SELECT * FROM `warenty` WHERE `id`='" . $pro_data["warenty_id"] . "'");
                                    $war_data1 = $war_rs1->fetch_assoc();
                                    ?>
                                    <option value="<?php echo $war_data1["id"]; ?>"><?php echo $war_data1["name"]; ?></option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-3">
                                <span>Delivery Fee</span>
                                <input type="text" class="form-control" id="del2" value="<?php echo $pro_data["delivery_price"]; ?>">
                                <!-- <span><b class=" text-danger">*</b> If you use a free delivery service add 0.00 as delivery fee</span> -->
                            </div>

                            <div class="col-12 mt-3 d-flex justify-content-center">
                                <button class="btn text-white rounded-0 mybtn col-lg-3 col-md-4 col-6" onclick="updateItem(<?php echo $pro_data['id']; ?>);">Update Item</button>
                            </div>
                        </div>
                    </div>
                </div><br>
            </div>
            <?php include "footer.php"; ?>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </div>
</body>

</html>