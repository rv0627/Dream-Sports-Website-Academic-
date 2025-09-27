<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | Dream Sports</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="resources/dream sports (3).svg">

</head>

<body style="background-color: #E8E8E8;">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            if (isset($_SESSION["userData"])) {

            ?>

                <div class="col-12 mt-5">
                    <div class="row">

                        <div class="col-12 mb-3">
                            <div class="row">

                                <div class="col-12 mt-1 bg-white">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-lg-2 mt-3 mb-3 mx-2 topic1"></div>
                                            <div class="col-12 col-lg-6 mt-4 mb-3">
                                                <input type="text" class="form-control" placeholder="Search in watchlist..." id="text" onkeyup="watchlistSearch();" />
                                            </div>
                                            <div class="col-12 col-lg-2 mt-lg-4 mb-lg-4 d-grid">
                                                <button class="btn btn-primary" onclick="watchlistSearch();">Select</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-lg-2 mt-3 pt-3 bg-white">
                                    <div class="row">
                                        <div class="col-11 border-end border-2 border-warning mb-2">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                                </ol>
                                            </nav>
                                            <nav class="nav nav-pills flex-column">
                                                <a class="nav-link active" aria-current="page" href="watchlist.php">My Watchlist</a>
                                                <a class="nav-link" href="cart.php">My Cart</a>
                                                <a class="nav-link" href="#">Recents</a>
                                            </nav>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                require "connection.php";
                                $user = $_SESSION["userData"]["email"];

                                $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $user . "'");
                                $watch_num = $watch_rs->num_rows;

                                if ($watch_num == 0) {

                                ?>

                                    <!-- empty view -->
                                    <div class="col-12 col-lg-9 mt-5 mb-5">
                                        <div class="row">
                                            <div class="col-12 emptylist"></div>
                                            <div class="col-12 text-center mb-2">
                                                <label class="form-label fs-3 fw-bold">
                                                    You have no items in your Watchlist yet.
                                                </label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="home.php" class="btn btn-outline-primary fs-5 fw-bold">Start Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- empty view -->

                                <?php

                                } else {
                                ?>
                                    <div class="col-12 col-lg-9">
                                        <div class="row" id="view">
                                            <?php
                                            for ($x = 0; $x < $watch_num; $x++) {
                                                $watch_data = $watch_rs->fetch_assoc();
                                            ?>

                                                <!-- have Products -->


                                                <div class="card mb-3 mx-0 mx-lg-2 col-12 mt-3">
                                                    <div class="row g-0">
                                                        <?php
                                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $watch_data["product_id"] . "'");
                                                        $product_data = $product_rs->fetch_assoc();

                                                        $p_color_rs = Database::search("SELECT * FROM `color` WHERE `id`='" . $product_data["color_id"] . "'");
                                                        $p_color_data = $p_color_rs->fetch_assoc();

                                                        $con_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data["condition_id"] . "' ");
                                                        $con_data = $con_rs->fetch_assoc();

                                                        $img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $watch_data["product_id"] . "'");
                                                        $img_data = $img_rs->fetch_assoc();
                                                        ?>
                                                        <div class="col-md-3 col-12 text-center text-md-start mt-3">
                                                            <img src="<?php echo ($img_data["image_path"]); ?>" class="img-fluid rounded-start" style="height: 200px;" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">
                                                                <h5 class="card-title fs-2 fw-bold text-primary"><?php echo ($product_data["title"]); ?></h5>
                                                                <span class="fs-5 fw-bold text-black-50">Color : <?php echo ($p_color_data["color_name"]); ?></span>
                                                                &nbsp;&nbsp; | &nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black-50">Condition : <?php echo ($con_data["condition"]); ?></span><br />
                                                                <span class="fs-5 fw-bold text-black-50">Price : </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black">Rs : <?php echo ($product_data["price"]); ?> .00</span><br />
                                                                <span class="fs-5 fw-bold text-black-50">Quantity : </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black"><?php echo ($product_data["qty"]); ?> Items Available</span><br />
                                                                <span class="fs-5 fw-bold text-black-50">Seller : </span><br />
                                                                <span class="fs-5 fw-bold text-black"><?php echo ($_SESSION["userData"]["first_name"]); ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-lg-5">
                                                            <div class="card-body d-grid d-lg-grid">
                                                                <a href='<?php echo ("singleProductView.php?id=" . $product_data["id"]); ?>' class="btn text-white mb-2" style="background-color: #009900;background-image: linear-gradient(100deg,#009900 0%,#00CC00);">Buy Now</a>
                                                                <a href="#" class="btn text-white mb-2" onclick='addCart(<?php echo ($product_data["id"]); ?>);' style="background-color: #0745ff;background-image: linear-gradient(100deg,#0745ff 0%,#2158ff);">Add To Cart</a>
                                                                <a href="#" class="btn text-white" onclick='removeFromWatchlist(<?php echo ($watch_data["id"]); ?>);' style="background-color: #FF0000;background-image: linear-gradient(100deg,#FF0000 0%,#FF0033);">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- have Products -->

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }

                                ?>

                            </div>
                        </div>

                    </div>
                </div>

            <?php

            } else {
                echo ("Please Login First");
            }

            ?>

            <?php include "footer.php"; ?>

            <!-- modelCart -->
            <div class="modal" tabindex="-1" id="viewCart" style="margin-top: 200px;">

            </div>
            <!-- modelCart -->

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>