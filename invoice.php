<?php
require "connection.php";


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="resources/dream sports (3).svg">
</head>

<body style="background-color: #E8E8E8;">
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php";
            if (isset($_SESSION["userData"])) {

                $umail = $_SESSION["userData"]["email"];
                $oid = $_GET["id"];
            ?>

                <div class="col-12 bg-light pt-3 pb-3 mt-5 mb-2">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="title fw-bold">INVOICE</h5>
                        </div>
                        <div class="col-8 btn-toolbar justify-content-end">
                            <button class="btn btn-dark me-2"  onclick="printInvoice();"><i class="bi bi-printer-fill"></i> print</button>
                            <button class="btn btn-danger me-2"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 bg-white mb-3 pt-3 pb-3" id="page">
                    <div class="row">

                        <div class="col-6">
                            <div class="ms-5 invoiceHeaderImage"></div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 text-dark text-decoration-underline text-end">
                                    <h2 class="fw-bold">Dream Sports</h2>
                                </div>
                                <div class="col-12 fw-bold text-end">
                                    <span>Maradana, Colombo 10, Sri Lanka</span><br />
                                    <span>+94 112 785694</span><br />
                                    <span>dreamsportslanka@gmail.com</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <h4 class="fw-bold" style="color: #6600FF;">INVOICE TO :</h4>
                                    <?php
                                    $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON
                                    `user_has_address`.`city_id`=`city`.`id` INNER JOIN `district` ON
                                    `city`.`district_id`=`district`.`id`
                                    WHERE `user_email`='" . $umail . "'");
                                    $address_data = $address_rs->fetch_assoc();
                                    ?>
                                    <h5 class=""><?php echo ($_SESSION["userData"]["first_name"] . " " . $_SESSION["userData"]["last_name"]); ?></h5>
                                    <span><?php echo ($address_data["line1"] . ", " . $address_data["line2"]); ?></span><br />
                                    <span><?php echo ($address_data["district_name"]) ?></span><br />
                                    <span><?php echo ($umail) ?></span>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <?php

                                        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                        $invoice_num = $invoice_rs->num_rows;
                                        $invoice_data = $invoice_rs->fetch_assoc();
                                        ?>
                                        <div class="col-12 text-lg-end">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5 class="fw-bold" style="color: #6600FF;">Invoice Number</h5>
                                                    <span>INV-00<?php echo ($invoice_data["id"]); ?></span>
                                                </div>
                                                <div class="col-6">
                                                    <h5 class="fw-bold" style="color: #6600FF;">Date issued</h5>
                                                    <span><?php echo ($invoice_data["date"]); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-3 border-primary" />
                        </div>

                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr style="color: #6600FF;">
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Description</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>0<?php echo ($invoice_num); ?></td>
                                    <td><?php echo ($oid); ?></td>
                                    <?php
                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();
                                    ?>
                                    <td><?php echo ($product_data["title"]) ?></td>
                                    <td class="text-end">Rs. <?php echo ($product_data["price"]) ?> .00</td>
                                    <td class="text-end"><?php echo ($invoice_data["qty"]) ?></td>
                                    <td class="text-end">Rs. <?php echo ($invoice_data["total"]) ?> .00</td>
                                </tbody>
                                <tfoot>
                                    <?php
                                    $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                                    $city_data = $city_rs->fetch_assoc();

                                    $delivery = 0;
                                    if ($city_data["district_id"] == 2) {
                                        $delivery = $product_data["delivery_fee_colombo"];
                                    } else {
                                        $delivery = $product_data["delivery_fee_other"];
                                    }
                                    $t = $invoice_data["total"];
                                    $g = $t - $delivery;
                                    ?>
                                    <tr>
                                        <td colspan="4" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold">Subtotal</td>
                                        <td class="text-end">Rs. <?php echo($g); ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary">Delivery Fee</td>
                                        <td class="text-end border-primary">Rs. <?php echo($delivery); ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary text-primary">Total</td>
                                        <td class="text-end border-primary text-primary">Rs. <?php echo($t); ?> .00</td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>

                        <div class="col-12 mt-3 mb-3 text-center">
                            <p class="form-label fw-bold fs-3 text-black-50">Thank You for your business!</p>
                        </div>

                        <div class="col-8 offset-2 text-center">
                            <hr class="border border-3 border-primary" />
                        </div>

                        <div class="col-12 text-center mb-3">
                            <label class="form-label fs-5 text-black-50 fw-bold">Invoice was created on a computer and is valid without the Signature and Seal.</label>
                        </div>

                        <div class="col-12 border-start border-5 border-primary mt-3 mb-3 rounded" style="background-color: #e7f2ff;">
                            <div class="row">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label fw-bold fs-5">NOTICE :</label><br />
                                    <label class="form-label fs-6">Purchased items can return before 7 days of Delivery.</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            <?php
            } else {
                header("Location:index.php");
            }

            ?>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>