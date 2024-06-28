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
            <?php include "header.php"; ?>
            <div class="col-12">
                <div class="row mt-5 d-flex justify-content-center">
                    <div class="col-lg-10 col-md-10 col-12  mt-5">
                        <?php
                        if (isset($_SESSION["u"])) {
                            $u_data = $_SESSION["u"];
                        ?>
                        <span class=" text-white fs-3 fw-bold">PROFILE SETTINGS</span>

                            <div class="row bg-dark">
                                <div class="col-lg-4 col-md-4 col-12 bgcol1">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-6 mt-5">
                                            <?php
                                            $user_img = Database::search("SELECT * FROM `user_img` WHERE `user_id`='" . $u_data["id"] . "'");
                                            $img_num = $user_img->num_rows;
                                            if ($img_num > 0) {
                                                $img_data = $user_img->fetch_assoc();

                                            ?>
                                                <img src="<?php echo $img_data["path"]; ?>" class="col-12 rounded-circle bg-body" style="width: 150px;height: 150px;" alt="SPC_propicture">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="resources/1564534_customer_man_user_account_profile_icon(1).png" class="col-12 rounded-circle bg-body" style="width: 150px;height: 150px;" alt="SPC_propicture">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row text-white mt-3">
                                        <span class=" text-center fs-5 fw-bold"><?php echo $u_data["fname"] . " " . $u_data["lname"]; ?></span>
                                        <span class=" text-center fw-light"><?php echo $u_data["email"]; ?></span>
                                        <span class=" text-center fw-light"><?php echo $u_data["mobile"]; ?></span>
                                        <span class=" text-center fw-light mt-3">A Member since : <?php echo $u_data["date"]; ?></span>

                                    </div><br><br>

                                    <div class="row d-flex justify-content-center text-white">
                                        <div class="col-8 rounded p-3">
                                            <span class=" mb-3  fw-bold text-dark">Address :</span><br>

                                            <?php
                                            $address = Database::search("SELECT * FROM `address` WHERE `user_id`='" . $u_data["id"] . "'");
                                            $address_num = $address->num_rows;
                                            if ($address_num > 0) {
                                                $address_data = $address->fetch_assoc();
                                                $cit_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                                                $cit_data = $cit_rs->fetch_assoc();
                                            ?>
                                                <span class=" fw-light"><?php echo $address_data["line1"]; ?></span><br>
                                                <span class=" fw-light"><?php echo $address_data["line2"]; ?></span><br>
                                                <span class=" fw-light"><?php echo $address_data["zipcode"]; ?></span><br>
                                                <span class=" fw-light"><?php echo $cit_data["name"]; ?></span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class=" mb-3"></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            <?php
                                            }
                                            ?>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-12 text-white fw-light">
                                    <span class=" fw-bold">Update Profile Details</span>
                                    <div class="row mt-3 d-flex justify-content-center">
                                        <div class="col-2 d-flex justify-content-center">
                                            <img src="resources/1564534_customer_man_user_account_profile_icon(1).png" class="col-12 bg-white rounded-circle" id="p0" style="width: 100px;height: 100px;" alt="spc_proimage">
                                        </div>
                                    </div>
                                    <div class="row mt-3 d-flex justify-content-center">
                                        <input type="file" class=" d-none" id="proImg">
                                        <label for="proImg" class="btn btn-outline-light col-lg-3 col-md-3 col-6" onclick="proImgSelect();">Selec Image</label>
                                    </div><br>

                                    <div class="row mt-3">
                                        <div class="col-6 mt-2">
                                            <span>First Name</span>
                                            <input type="text" class="form-control" value="<?php echo $u_data["fname"]; ?>" id="profname">
                                        </div>
                                        <div class="col-6 mt-2">
                                            <span>Last Name</span>
                                            <input type="text" class="form-control" value="<?php echo $u_data["lname"]; ?>" id="prolname">
                                        </div>
                                        <div class="col-6 mt-2">
                                            <span>Email</span>
                                            <input type="text" class="form-control" value="<?php echo $u_data["email"]; ?>" disabled>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <span>Mobile</span>
                                            <input type="text" class="form-control" value="<?php echo $u_data["mobile"]; ?>" id="promob">
                                        </div>
                                        <div class="col-6 mt-2">
                                            <span>Password</span>
                                            <input type="text" class="form-control" value="<?php echo $u_data["password"]; ?>" disabled>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <?php
                                            $gen = Database::search("SELECT * FROM `gender` WHERE `id`='" . $u_data["gender_id"] . "'");
                                            $gen_data = $gen->fetch_assoc();
                                            ?>
                                            <span>Gender</span>
                                            <input type="text" class="form-control" value="<?php echo $gen_data["name"]; ?>" disabled>
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-center">
                                        <button class="btn btn-outline-primary col-lg-3 col-md-3 col-6" onclick="updatePro();">Update Details</button>
                                    </div><br>
                                    <span class=" fw-bold">Update Address</span>
                                    <div class="row mt-3">
                                        <?php

                                        $add_rs = Database::search("SELECT * FROM `address` WHERE `user_id`='" . $u_data["id"] . "'");
                                        $add_num = $add_rs->num_rows;
                                        if ($add_num > 0) {
                                            $add_data = $add_rs->fetch_assoc();
                                        ?>
                                            <div class="col-6 mt-2">
                                                <span>Address Line 01</span>
                                                <input type="text" class="form-control" value="<?php echo $add_data["line1"]; ?>" id="line1">
                                            </div>
                                            <div class="col-6 mt-2">
                                                <span>Address Line 02 <span class=" text-white-50">(Optional)</span></span>
                                                <input type="text" class="form-control" value="<?php echo $add_data["line2"]; ?>" id="line2">
                                            </div>
                                            <div class="col-6 mt-2">
                                                <span>ZipCode</span>
                                                <input type="text" class="form-control" value="<?php echo $add_data["zipcode"]; ?>" id="zip">
                                            </div>

                                            <?php
                                            $city = Database::search("SELECT * FROM `city` WHERE `id`='" . $add_data["city_id"] . "'");
                                            $city_num = $city->num_rows;
                                            if ($city_num > 0) {
                                                $city_data = $city->fetch_assoc();
                                            ?>
                                                <div class="col-6 mt-2">
                                                    <span>Nearest City</span>
                                                    <select class="form-select" id="locup">
                                                        <option value="<?php echo $city_data["id"]; ?>"><?php echo $city_data["name"]; ?></option>
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

                                            <?php
                                            }
                                            ?>

                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-6 mt-2">
                                                <span>Address Line 01</span>
                                                <input type="text" class="form-control" id="line1">
                                            </div>
                                            <div class="col-6 mt-2">
                                                <span>Address Line 02 <span class=" text-white-50">(Optional)</span></span>
                                                <input type="text" class="form-control" id="line2">
                                            </div>
                                            <div class="col-6 mt-2">
                                                <span>ZipCode</span>
                                                <input type="text" class="form-control" id="zip">
                                            </div>
                                            <div class="col-6 mt-2">
                                                <span>City</span>
                                                <select class="form-select" id="locup">
                                                    <option value="0">Select the nearest City</option>
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
                                        <?php
                                        }
                                        ?>

                                    </div><br>
                                    <div class="row d-flex justify-content-center">
                                        <button class="btn btn-outline-primary col-lg-3 col-md-3 col-6" onclick="updateAddress();">Update Address</button>
                                    </div><br>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="row vh-100 vw-100 d-flex align-items-center">
                                <span class=" text-center fs-1 fw-bold text-danger">Access Denid</span>
                            </div>
                        <?php
                        }
                        ?>

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