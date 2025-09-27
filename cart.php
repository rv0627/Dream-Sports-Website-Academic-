<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="resources/dream sports (3).svg" />
</head>

<body style="background-color: #E8E8E8;">
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php";
            require "connection.php";

            if (isset($_SESSION["userData"])) {
                $email = $_SESSION["userData"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;
            ?>

                <div class="col-12 mt-5 bg-white">

                    <div class="col-12 pt-3">

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>

                    </div>

                </div>

                <div class="col-12 mt-1 mb-3">
                    <div class="row">

                        <div class="col-12 bg-white">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 text-center col-lg-2 mt-4 mb-1 mt-lg-1 mb-lg-0">
                                        <span class="fs-4 fw-bold text-bg-light text-danger" style="font-family: Masque;">DREAM SPORTS</span>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-4 mb-3">
                                        <input type="text" class="form-control" placeholder="Search in cart..." />
                                    </div>
                                    <div class="col-12 col-lg-2 mt-lg-4 mb-4 d-grid">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $cart_rs = Database::search("SELECT * FROm `cart` WHERE `user_email`='" . $email . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {
                        ?>
                            <!-- empty View -->

                            <div class="col-12 mt-5 pt-5">
                                <div class="row">
                                    <div class="col-12 mt-3 mb-5 emptyCart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-3 fw-bold">
                                            You have no items in your Crat yet.
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                        <a href="home.php" class="btn btn-outline-primary fs-5 fw-bold">Start Shopping</a>
                                    </div>
                                </div>
                            </div>

                            <!-- empty View -->
                        <?php
                        } else {
                        ?>
                            <div class="col-12 col-lg-8 mt-4 mb-3">
                                <div class="row">
                                    <div class="col-12 bg-white">
                                        <div class="col-12 pt-2">
                                            <label class="form-label fw-bold fs-3">Shopping Cart</label>
                                        </div>
                                        <div class="col-12 pt-4 ps-3 mb-3">
                                            <input type="checkbox" id="sAll" onclick="selectAll();" checked/>&nbsp;&nbsp;&nbsp;<span class="fs-6 text-black-50 fw-bold gap-2">Select all items</span>
                                        </div>
                                    </div>

                                    <?php
                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                        $address_rs = Database::search("SELECT district.id AS did FROM `user_has_address` INNER JOIN `city` ON
                                        user_has_address.city_id=city.id INNER JOIN `district` ON
                                        city.district_id=district.id WHERE `user_email`='" . $email . "'");

                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                        if ($address_data["did"] == 2) {
                                            $ship = $product_data["delivery_fee_colombo"];
                                            $shipping = $shipping + $ship;
                                        } else {
                                            $ship = $product_data["delivery_fee_other"];
                                            $shipping = $shipping + $ship;
                                        }

                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["first_name"] . " " . $seller_data["last_name"];

                                    ?>
                                        <div class="col-12 mt-4 bg-white">

                                            <div class="card mt-3 mb-3 mx-0 col-12">
                                                <div class="row g-0">

                                                    <div class="col-md-12 mt-3 mb-3">
                                                        <div class="row">
                                                            <div class="col-12 ps-5">
                                                                <span class="fw-bold text-black-50 fs-5 ps-2">Seller :</span>&nbsp;
                                                                <span class="fw-bold text-black fs-5"><?php echo ($seller); ?></span>&nbsp;
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr />

                                                    <?php
                                                    $img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data["id"] . "'");
                                                    $img_data = $img_rs->fetch_assoc();

                                                    $color_rs = Database::search("SELECT * FROM `color` WHERE `id`='" . $product_data["color_id"] . "'");
                                                    $color_data = $color_rs->fetch_assoc();

                                                    $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data["condition_id"] . "'");
                                                    $condition_data = $condition_rs->fetch_assoc();
                                                    ?>

                                                    <div class="col-5 col-md-4">
                                                        <img src="<?php echo ($img_data["image_path"]); ?>" class="img-fluid rounded-start" style="max-width: 200px;" />
                                                    </div>

                                                    <div class="col-7 col-md-5">
                                                        <div class="card-body">
                                                            <h3 class="card-title"><?php echo ($product_data["title"]); ?></h3>
                                                            <span class="fw-bold fs-5 text-black-50">Colour : </span>
                                                            <span class="fs-6 text-black"><?php echo ($color_data["color_name"]); ?></span><br />
                                                            <span class="fw-bold fs-5 text-black-50">Condition : </span>
                                                            <span class="fs-6 text-black"><?php echo ($condition_data["condition"]); ?></span><br />
                                                            <span class="fw-bold fs-5 text-black-50">Price : </span>
                                                            <span class="fs-5 text-black">Rs. <?php echo ($product_data["price"]); ?> .00</span><br />
                                                            <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                            <input type="number" class="mt-3 border border-1  fs-5 px-3 shadow-none" value="<?php echo ($cart_data["qty"]); ?>">
                                                            <br /><br />
                                                            <?php
                                                            if ($address_data["did"] == 2) {
                                                            ?>
                                                                <span class="fw-bold fs-5 text-black-50">Delivery Fee : </span>
                                                                <span class="fs-6 text-black">Rs. <?php echo ($product_data["delivery_fee_colombo"]); ?> .00</span>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span class="fw-bold fs-5 text-black-50">Delivery Fee : </span>
                                                                <span class="fs-6 text-black">Rs. <?php echo ($product_data["delivery_fee_other"]); ?> .00</span>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="card-body d-grid">
                                                            <a href='<?php echo ("singleProductView.php?id=" . $product_data["id"]); ?>' class="btn btn-outline mb-2 text-white" style="background-color: #009900;background-image: linear-gradient(100deg,#009900 0%,#00CC00);">Buy Now</a>
                                                            <a href="#" class="btn btn-outline-danger mb-2 text-white" onclick="deleteFromCart('<?php echo ($cart_data['id']); ?>');" style="background-color: #FF0000;background-image: linear-gradient(100deg,#FF0000 0%,#FF0033);">Remove</a>
                                                        </div>
                                                    </div>

                                                    <hr />

                                                    <div class="col-md-12 mt-3 mb-3">
                                                        <div class="row">
                                                            <div class="col-6 col-md-6 ps-4">
                                                                <span class="fw-bold fs-5 text-black-50">Request Total <i class="bi bi-info-circle"></i></span>
                                                            </div>
                                                            <div class="col-6 col-md-6 text-end pe-4">
                                                                <span class="fw-bold fs-5 text-black-50">Rs. <?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?> .00</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    <?php

                                    }
                                    ?>
                                </div>
                            </div>

                            <!-- summary -->
                            <div class="col-12 col-lg-3 mt-4 bg-white ms-lg-5" style="max-height: 400px;z-index: 100;margin-top: 200px;" id="searchScroll2">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold">items (<?php echo ($cart_num); ?>)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold">Rs. <?php echo ($total); ?> .00</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>

                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo ($shipping); ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-5 fw-bold">Total</span>
                                    </div>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-5 fw-bold">Rs. <?php echo ($shipping + $total); ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                                    </div>

                                </div>
                            </div>
                            <!-- summary -->
                        <?php
                        }
                        ?>

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