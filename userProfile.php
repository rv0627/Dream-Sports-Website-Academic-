<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Dream Sports</title>

    <link rel="icon" href="resources/dream sports (3).svg" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body style="margin: 0;padding: 0;">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            require "connection.php";

            if (isset($_SESSION["userData"])) {

                $email = $_SESSION["userData"]["email"];

                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON 
                gender.id=user.gender_id WHERE `email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                user_has_address.city_id=city.id INNER JOIN `district` ON
                city.district_id=district.id INNER JOIN `province` ON
                district.province_id=province.id WHERE `user_email`='" . $email . "' ");

                $user_data = $details_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();


            ?>

                <div class="col-12 bg-primary">
                    <div class="row">
                        <div class="col-12 bg-body rounded mt-4 mb-4">
                            <div class="row g-2">
                                <div class="col-md-3 border-end">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                        <?php

                                        if (empty($image_data["path"])) {

                                        ?>

                                            <img src="resources/user icon2.svg" class="rounded-circle  mt-5" id="viewImg" style="width: 130px; height: 130px;" />

                                        <?php

                                        } else {

                                        ?>

                                            <img src="<?php echo ($image_data["path"]); ?>" class="rounded-circle  mt-5" id="viewImg" style="width: 130px; height: 130px;">

                                        <?php

                                        }

                                        ?>


                                        <span class="fw-bold"><?php echo ($user_data["first_name"]); ?>&nbsp;<?php echo ($user_data["last_name"]); ?></span>
                                        <span class="fw-bold text-black-50"><?php echo ($user_data["email"]); ?></span>

                                        <input type="file" class="d-none" id="profileimg" accept="image/*">
                                        <label for="profileimg" class="btn btn-primary mt-5" onclick="updateProfileImage();">Update Profile Image</label>
                                    </div>
                                </div>
                                <div class="col-md-5 border-end">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center ">
                                            <h4 class="fw-bold">Profile Setting</h4>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" value="<?php echo ($user_data["first_name"]); ?>" id="fname" />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">last Name</label>
                                                <input type="text" class="form-control" value="<?php echo ($user_data["last_name"]); ?>" id="lname" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Mobile</label>
                                                <input type="text" class="form-control" value="<?php echo ($user_data["mobile"]); ?>" id="mobile" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" value="<?php echo ($user_data["email"]); ?>" disabled />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control" id="newPassword" value="<?php echo ($data["password"]); ?>" aria-label="Recipient's username" aria-describedby="button-addon2" readonly>
                                                    <span class="input-group-text bg-primary" id="basic-addon2">
                                                        <i class="bi bi-eye-slash-fill text-white" onclick="showPassword();" id="eye1" style="cursor: pointer;"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Registered Date</label>
                                                <input type="text" class="form-control" value="<?php echo ($user_data["join_date"]); ?>" readonly />
                                            </div>

                                            <?php

                                            if (!empty($address_data["line1"])) {

                                            ?>

                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" class="form-control" id="line1" value="<?php echo ($address_data["line1"]); ?>" />
                                                </div>

                                            <?php

                                            } else {
                                            ?>

                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" class="form-control" id="line1" />
                                                </div>

                                            <?php
                                            }

                                            ?>

                                            <?php

                                            if (!empty($address_data["line2"])) {

                                            ?>

                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" class="form-control" id="line2" value="<?php echo ($address_data["line2"]); ?>" />
                                                </div>

                                            <?php

                                            } else {
                                            ?>

                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" class="form-control" id="line2" />
                                                </div>

                                            <?php
                                            }

                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");

                                            ?>

                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    $province_num = $province_rs->num_rows;
                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>

                                                        <option value="<?php echo ($province_data["id"]); ?>" <?php
                                                                                                                if (!empty($address_data["province_id"])) {
                                                                                                                    if ($province_data["id"] == $address_data["province_id"]) {
                                                                                                                ?>selected<?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>><?php echo ($province_data["province_name"]); ?></option>

                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    $district_num = $district_rs->num_rows;
                                                    for ($x = 0; $x < $district_num; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>

                                                        <option value="<?php echo ($district_data["id"]); ?>" <?php
                                                                                                                if (!empty($address_data["district_id"])) {
                                                                                                                    if ($district_data["id"] == $address_data["district_id"]) {
                                                                                                                ?>selected<?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>><?php echo ($district_data["district_name"]); ?></option>

                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">City</label>
                                                <select class="form-select" id="city">
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    $city_num = $city_rs->num_rows;
                                                    for ($x = 0; $x < $city_num; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>

                                                        <option value="<?php echo ($city_data["id"]); ?>" <?php
                                                                                                            if (!empty($address_data["city_id"])) {
                                                                                                                if ($city_data["id"] == $address_data["city_id"]) {
                                                                                                            ?>selected<?php
                                                                                                                    }
                                                                                                                }
                                                                                                                        ?>><?php echo ($city_data["name"]); ?></option>

                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>

                                            <?php

                                            if (!empty($address_data["postal_code"])) {

                                            ?>

                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" class="form-control" value="<?php echo ($address_data["postal_code"]); ?>" id="pcode" />
                                                </div>

                                            <?php

                                            } else {

                                            ?>

                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" class="form-control" id="pcode" />
                                                </div>

                                            <?php

                                            }

                                            ?>


                                            <div class="col-12">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" id="gender" value="<?php echo ($user_data["gender_name"]) ?>" disabled />
                                            </div>
                                            <div class="col-12 d-grid mt-4">
                                                <button class="btn btn-primary" onclick="updateProfile();">Update My Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            } else {

                header("Location:home.php");
            }

            ?>



            <?php include "footer.php" ?>
        </div>
    </div>



    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>