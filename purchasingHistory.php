<?php

require "connection.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchasing History | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/dream sports (3).svg">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body style="background-color: #E8E8E8;">
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php"; ?>

            <div class="col-12 bg-white mt-4 pt-3 pb-3 text-center">
                <span class="fs-1 text-primary fw-bold mt-3">Purchasing History</span>
            </div>

            <?php

            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $_SESSION["userData"]["email"] . "'");
            $invoice_num = $invoice_rs->num_rows;

            if ($invoice_num == 0) {
            ?>

                <div class="col-12 mt-3 mb-3 d-flex justify-content-center" style="height: 400px;">
                    <div class="row align-items-center">
                        <h3>You have not purchased any product yet...</h3>
                    </div>
                </div>

            <?php
            } else {

            ?>
                <div class="col-12 mt-5 mb-3">
                    <div class="row">

                        <div class="col-10 offset-1 bg-white mt-3 mb-2">
                            <div class="row">
                                <div class="col-10 offset-1 pt-2 pb-1">
                                    <div class="row">
                                        <div class="col-6 text-start pt-2">
                                            <label class="form-label fw-bold fs-6">Product List</label>
                                        </div>
                                        <div class="col-6 text-end">
                                            <div class="row p-2">
                                                <div class="col-10 col-lg-10 offset-lg-1 border-4 ">
                                                    <input type="text" class="form-control fs-6" placeholder="Search product" />
                                                </div>
                                                <div class="col-2 col-lg-1">
                                                    <i class="bi bi-search fs-5 text-black-50 fw-bold" style="cursor: pointer;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 offset-1 mt-1">
                            <div class="row pt-1 pb-1">
                                <div class="col-12 d-none d-lg-block">
                                    <div class="row">
                                        <div class="col-1 col-lg-1">
                                            <label class="form-label fw-bold fs-6">No</label>
                                        </div>
                                        <div class="col-3 col-lg-2">
                                            <label class="form-label fw-bold fs-6">Product Image</label>
                                        </div>
                                        <div class="col-1 col-lg-2">
                                            <label class="form-label fw-bold fs-6">Selle & Title</label>
                                        </div>
                                        <div class="col-3 col-lg-2">
                                            <label class="form-label fw-bold fs-6">Price</label>
                                        </div>
                                        <div class="col-1 col-lg-1">
                                            <label class="form-label fw-bold fs-6">Quantity</label>
                                        </div>
                                        <div class="col-1 col-lg-2">
                                            <label class="form-label fw-bold fs-6">Purchased Date</label>
                                        </div>
                                        <div class="col-1 col-lg-1">
                                            <label class="form-label fw-bold fs-6"></label>
                                        </div>
                                        <div class="col-1 col-lg-1">
                                            <label class="form-label fw-bold fs-6"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                        $on = 1;
                        for ($x = 0; $x < $invoice_num; $x++) {
                            $invoice_data = $invoice_rs->fetch_assoc();
                            $pid = $invoice_data["product_id"];
                        ?>
                            <!-- product 1 -->
                            <div class="col-10 offset-1 bg-white">
                                <div class="row pt-3 pb-2">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6 col-lg-1">
                                                <span class="form-label fw-bold fs-6 d-block d-lg-none">No</span>
                                                <label class="form-label fs-6"><?php echo ($on++) ?></label>
                                            </div>
                                            <div class="col-6 col-lg-1 text-center ">
                                                <?php
                                                $img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $pid . "'");
                                                $img_data = $img_rs->fetch_assoc();
                                                ?>
                                                <span class="form-label fw-bold fs-6 d-block d-lg-none">Product Image</span>
                                                <img src="<?php echo ($img_data["image_path"]); ?>" style="height: 40px;">
                                            </div>
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                                            $product_data = $product_rs->fetch_assoc();
                                            ?>
                                            <div class="col-6 col-lg-3 pt-3 pt-lg-0 text-lg-center">
                                                <span class="form-label fw-bold fs-6 d-block d-lg-none">Seller & Title</span>
                                                <label class="form-label fs-6"><b><?php echo ($_SESSION["userData"]["first_name"]) ?></b></label><br />
                                                <label class="form-label fs-6"><?php echo ($product_data["title"]) ?></label>
                                            </div>
                                            <div class="col-6 col-lg-2 text-center pt-3 pt-lg-0">
                                                <span class="form-label fw-bold fs-6 d-block d-lg-none">Price</span>
                                                <label class="form-label fs-6">Rs. <?php echo ($invoice_data["total"]); ?> .00</label>
                                            </div>
                                            <div class="col-6 col-lg-1">
                                                <span class="form-label fw-bold fs-6 d-block d-lg-none">Quantity</span>
                                                <label class="form-label fs-6"><?php echo ($invoice_data["qty"]) ?></label>
                                            </div>
                                            <div class="col-6 col-lg-2 text-center text-lg-start">
                                                <span class="form-label fw-bold fs-6 d-block d-lg-none">Purchased Date</span>
                                                <label class="form-label fs-6"><?php echo ($invoice_data["date"]); ?></label>
                                            </div>
                                            <div class="col-6 d-lg-none d-block d-grid">
                                                <button class="btn fw-bold" style="background-color: #f0f0f5;"> <i class="bi bi-info-circle-fill"></i> Feedback</button>
                                            </div>
                                            <div class="col-12 d-none d-lg-block">
                                                <div class="row">
                                                    <div class="col-6 offset-lg-10 col-lg-2 d-grid pt-1">
                                                        <button class="btn fw-bold" style="background-color: #f0f0f5;"><i class="bi bi-info-circle-fill"></i> Feedback</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 d-lg-none d-block d-grid">
                                                <button class="btn fw-bold text-danger" style="background-color: #f0f0f5;"><i class="bi bi-trash3-fill"></i> Delete</button>
                                            </div>
                                            <div class="col-12 d-none d-lg-block">
                                                <div class="row">
                                                    <div class="col-6 offset-lg-10 col-lg-2 d-grid pt-1">
                                                        <button class="btn fw-bold text-danger" style="background-color: #f0f0f5;" onclick="deleteProduct('<?php echo ($pid); ?>');" ><i class="bi bi-trash3-fill"></i> Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- product 1 -->
                        <?php
                        }

                        ?>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-10 offset-1 mb-3">
                            <div class="row">
                                <div class="offset-lg-8 col-12 col-lg-4 d-grid mb-3">
                                    <button class="btn btn-danger" onclick="deleteAllProduct();"> <i class="bi bi-trash3-fill"></i> Delete All Records</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php
            }

            ?>

            <?php include "footer.php"; ?>
        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>