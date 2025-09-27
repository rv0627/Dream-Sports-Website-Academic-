<?php
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.categories_id,product.brand_has_model_id,product.color_id,
    product.price,product.qty,product.title,product.condition_id,product.status_id,product.user_email,
    product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,product.description,
    model.model_name,brand.brand_name FROM `product` INNER JOIN `brand_has_model` ON
    brand_has_model.id=product.brand_has_model_id INNER JOIN `brand` ON
    brand.id=brand_has_model.brand_id INNER JOIN `model` ON
    model.id=brand_has_model.model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo ($product_data["title"]); ?> | eShop</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

            <link rel="icon" href="resources/dream sports (3).svg" />

        </head>

        <body>
            <div class="container-fluid">
                <div class="row">
                    <?php include "header.php"; ?>

                    <div class="col-12 mt-5">
                        <hr class="bg-secondary" style="height: 15px;" />
                    </div>

                    <div class="col-12 mt-0 mb-5 bg-white singleProduct">
                        <div class="row">
                            <div class="col-12" style="padding: 10px;">
                                <div class="row">

                                    <div class="col-12 col-lg-2 order-2 order-lg-1">
                                        <ul>
                                            <?php
                                            $img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $pid . "'");
                                            $img_num = $img_rs->num_rows;
                                            $img = array();

                                            if ($img_num != 0) {
                                                for ($x = 0; $x < $img_num; $x++) {
                                                    $img_data = $img_rs->fetch_assoc();
                                                    $img[$x] = $img_data["image_path"];
                                            ?>
                                                    <li class="d-flex flex-column justify-content-between align-items-center border border-1 border-secondary mb-1">
                                                        <img src="<?php echo ($img["$x"]); ?>" class="img-thumbnail mt-1 mb-1" id="productImg<?php echo ($x); ?>" onclick="loadMainImg('<?php echo ($x); ?>');" />
                                                    </li>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-between align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-between align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-between align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                            <?php
                                            }
                                            ?>


                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="row">
                                            <div class="col-12 align-items-center border border-1 border-secondary">
                                                <!-- <div class="main-img" id="main-img"> -->
                                                <img src="<?php echo ($img_data["image_path"]); ?>" class="img-fluid" id="main-img">
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-8">
                                                        <nav aria-label="breadcrumb">
                                                            <ol class="breadcrumb">
                                                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                                <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                                            </ol>
                                                        </nav>
                                                    </div>
                                                    <div class="col-4 mt-2 mb-2">
                                                        <?php
                                                        $s_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                                                        $s_num = $s_rs->num_rows;
                                                        $s_data = $s_rs->fetch_assoc();
                                                        ?>
                                                        <button class="btn btn-primary" onclick="contactSeller('<?php echo ($s_data['user_email']); ?>');">contact for seller</button>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 text-success fw-bold"><?php echo ($product_data["title"]); ?></span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>

                                                            &nbsp;&nbsp;

                                                            <label class="fs-5 text-dark fw-bold">4.5 Stars | 39 Reviewa & Raiting</label>
                                                        </span>
                                                    </div>
                                                </div>

                                                <?php
                                                $price = $product_data["price"];
                                                $adding_price = ($price / 100) * 5;
                                                $new_price = $price + $adding_price;
                                                $difference = $new_price - $price;
                                                $percentage = ($difference / $price) * 100;
                                                ?>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 fw-bold text-dark">Rs. <?php echo ($price); ?> .00</span>
                                                        &nbsp; | &nbsp;
                                                        <span class="fw-bold text-danger text-decoration-line-through">Rs. <?php echo ($new_price); ?> .00</span>
                                                        &nbsp; | &nbsp;
                                                        <span class="fs-5 fw-bold text-black-50">Save Rs. <?php echo ($difference); ?> .00 (<?php echo ($percentage); ?>%)</span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-5 text-primary"><b>Warrenty : </b>6 Months Warrenty</span><br />
                                                        <span class="fs-5 text-primary"><b>Return Policy : </b>1 Month Return Policy</span><br />
                                                        <span class="fs-5 text-primary"><b>In Stock : </b><?php echo ($product_data["qty"]); ?> Items Available</span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <div class="row g-2">
                                                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class="fs-5 text-primary"><?php echo ($_SESSION["userData"]["first_name"] . " " . $_SESSION["userData"]["last_name"]); ?></span>
                                                            </div>
                                                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class="fs-5 text-primary"><b>Sold :</b>10 Items</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="my-2 offset-lg-1 col-12 col-lg-10 border border-1 border-danger rounded">
                                                                <div class="row">
                                                                    <div class="col-3 col-lg-2 border-end border-2 border-danger">
                                                                        <img src="resources/pricetag.png" style="background-size: contain;" />
                                                                    </div>
                                                                    <div class="col-9 col-lg-10">
                                                                        <span class="fs-5 text-danger fw-bold text-lg-center">Stand a chance to get 5% discount by using VISA or MASTER</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <div class="row g-2">

                                                                    <div class="border border-1 border-secondary rounded overflow-hidden 
                                                        float-left mt-1 position-relative product-qty">
                                                                        <div class="col-8">
                                                                            <span>Quantity : </span>
                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" id="qty_input" onkeyup='checkValue(<?php echo ($product_data["qty"]); ?>);' />

                                                                            <div class="position-absolute qty-buttons">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-inc">
                                                                                    <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo ($product_data["qty"]); ?>);'></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-dec">
                                                                                    <i class="bi bi-caret-down-fill text-primary fs-5" onclick="qty_dec();"></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-12 mt-5">
                                                                            <div class="row">
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn text-white" type="submit" id="payhere-payment" onclick="payNow(<?php echo ($pid); ?>);" style="background-color: #009900;background-image: linear-gradient(100deg,#009900 0%,#00CC00);">Buy Now</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn text-white" onclick="addCart('<?php echo ($pid); ?>');" style="background-color: #FF0000;background-image: linear-gradient(100deg,#FF0000 0%,#FF0033);">Add To Cart</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <?php
                                                                                    if (isset($_SESSION["userData"])) {

                                                                                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $pid . "' AND
                                                                                        `user_email`='" . $_SESSION["userData"]["email"] . "'");
                                                                                        $watchlist_num = $watchlist_rs->num_rows;

                                                                                        if ($watchlist_num == 1) {
                                                                                    ?>

                                                                                            <a class="mt-2" onclick='addToWatchlist(<?php echo ($pid); ?>);'>
                                                                                                <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo ($pid); ?>' style="cursor: pointer;"></i>
                                                                                            </a>

                                                                                        <?php

                                                                                        } else {
                                                                                        ?>

                                                                                            <a class="mt-2" onclick='addToWatchlist(<?php echo ($pid); ?>);'>
                                                                                                <i class="bi bi-heart-fill text-dark fs-5" id='heart<?php echo ($pid); ?>' style="cursor: pointer;"></i>
                                                                                            </a>

                                                                                        <?php
                                                                                        }
                                                                                    } else {
                                                                                        ?>

                                                                                        <a href="index.php">
                                                                                            <i class="bi bi-heart-fill text-dark fs-5"></i>
                                                                                        </a>

                                                                                    <?php
                                                                                    }


                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row justify-content-center gap-2">
                                    <?php
                                    $p_rs = Database::search("SELECT * FROM `product` WHERE `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 8 OFFSET 0 ");
                                    $p_num = $p_rs->num_rows;


                                    for ($x = 0; $x < $p_num; $x++) {
                                        $p_data = $p_rs->fetch_assoc();

                                        $im_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $p_data["id"] . "'");
                                        $im_num = $im_rs->num_rows;
                                        $im_data = $im_rs->fetch_assoc();
                                    ?>

                                        <div class="card animation3 col-6 col-lg-3" style="width: 18rem;height: 500px;">
                                            <img src="<?php echo ($im_data["image_path"]) ?>" class="card-img-top img-fluid img-thumbnail" alt="..." style="height: 180px;" />
                                            <div class="card-body text-center">
                                                <h5 class="card-title"><?php echo ($p_data["title"]); ?><br /><span class="badge bg-info">New</span></h5>
                                                <span class="card-text text-primary">Rs. <?php echo ($p_data["price"]); ?> .00</span> <br />
                                                <?php

                                                if ($p_data["qty"] > 0) {

                                                ?>

                                                    <span class="card-text text-warning fw-bold">In Stock</span> <br />
                                                    <span class="card-text text-success fw-bold"><?php echo ($p_data["qty"]); ?> Items Available</span><br /><br />

                                                    <a href='<?php echo ("singleProductView.php?id=" . $p_data["id"]); ?>' class="col-12 btn text-white" style="background-color: #009900;background-image: linear-gradient(100deg,#009900 0%,#00CC00);">Buy Now</a>
                                                    <button class="col-12 btn text-white mt-2" onclick="addCart('<?php echo ($p_data['id']); ?>');" style="background-color: #FF0000;background-image: linear-gradient(100deg,#FF0000 0%,#FF0033);">Add to Cart</button>

                                                <?php

                                                } else {

                                                ?>

                                                    <span class="card-text text-warning fw-bold">Out of Stock</span> <br />
                                                    <span class="card-text text-success fw-bold">0 Items Available</span><br /><br />

                                                    <button class="col-12 btn text-white disabled" style="background-color: #009900;background-image: linear-gradient(100deg,#009900 0%,#00CC00);">Buy Now</button>
                                                    <button class="col-12 btn text-white mt-2 disabled" style="background-color: #FF0000;background-image: linear-gradient(100deg,#FF0000 0%,#FF0033);">Add to Cart</button>


                                                    <?php

                                                }

                                                if (isset($_SESSION["userData"])) {

                                                    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $p_data["id"] . "' AND
                                                    `user_email`='" . $_SESSION["userData"]["email"] . "'");
                                                    $watchlist_num = $watchlist_rs->num_rows;

                                                    if ($watchlist_num == 1) {
                                                    ?>

                                                        <a class="col-12 mt-2 text-center" onclick='addToWatchlist(<?php echo ($p_data["id"]); ?>);'>
                                                            <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo ($p_data["id"]); ?>' style="cursor: pointer;"></i>
                                                        </a>

                                                    <?php

                                                    } else {
                                                    ?>

                                                        <a class="col-12 mt2 text-center" onclick='addToWatchlist(<?php echo ($p_data["id"]); ?>);'>
                                                            <i class="bi bi-heart-fill text-dark fs-5" id='heart<?php echo ($p_data["id"]); ?>' style="cursor: pointer;"></i>
                                                        </a>

                                                    <?php
                                                    }
                                                } else {
                                                    ?>

                                                    <a href="index.php" class="col-12 mt-2 text-center">
                                                        <i class="bi bi-heart-fill text-dark fs-5" style="cursor: pointer;"></i>
                                                    </a>

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

                            <div class="col-12 bg-white">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row">

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Brand : </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo ($product_data["brand_name"]); ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Model : </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo ($product_data["model_name"]); ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fs-4 fw-bold">Product Description : </label>
                                            </div>
                                            <div>
                                                <textarea cols="30" rows="10" class="form-control" readonly><?php echo ($product_data["description"]); ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <?php include "footer.php" ?>

                    <!-- modelCart -->
                    <div class="modal" tabindex="-1" id="viewCart" style="margin-top: 200px;">

                    </div>
                    <!-- modelCart -->

                    <!-- modelWatchlist -->
                    <div class="modal" tabindex="-1" id="viewWatchlist" style="margin-top: 200px;">

                    </div>
                    <!-- modelWatchlist -->

                    <!-- message model -->
                    <div class="modal" tabindex="-1" id="contactseller">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <?php
                                    $seller_rs = Database::search("SELECT * FROM `user` INNER JOIN `product` ON
                                    `user`.`email`=`product`.`user_email` WHERE `user_email`='" . $product_data["user_email"] . "'");
                                    $seller_data = $seller_rs->fetch_assoc();
                                    ?>
                                    <h5 class="modal-title">Seller : <?php echo ($seller_data["first_name"]) ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body overflow-auto">
                                    <div class="col-12">
                                        <div class="row g-1">

                                            <div class="col-12">
                                                <div class="row justify-content-end">
                                                    <div class="col-8 bg-secondary border rounded-3">
                                                        <div class="row text-end text-white p-2">
                                                            <span>Hello Seller</span>
                                                            <span>09:52 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row justify-content-start">
                                                    <div class="col-8 bg-success border rounded-3">
                                                        <div class="row text-start text-white p-2">
                                                            <span>Hello Customer</span>
                                                            <span>09:53 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-2">
                                                <i class="bi bi-send fs-3 p-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- message model -->

                </div>
            </div>

            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
        </body>

        </html>

<?php
    } else {
        echo ("Sorry for the Inconvenience");
    }
} else {
    echo ("Somthing went wrong");
}
?>