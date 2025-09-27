<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller to Add Product | Dream Sports</title>

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
            ?>

                <div class="col-12 mt-3">
                    <div class="row">

                        <div class="col-12 mt-5 mb-3 pt-3 pb-3 bg-white text-center">
                            <label class="form-label fw-bold fs-3">Add now and sell new items</label>
                        </div>

                        <div class="col-12 mb-5 pt-3 pb-3 bg-white">
                            <div class="row">

                                <div class="col-12 col-lg-4">
                                    <p class="form-label fs-5 fw-bolder" style="color: #484848;">Select Product Category</p>
                                    <select class="form-select text-center" id="category" onchange="load_brand();">
                                        <option value="0">Select Category</option>
                                        <?php
                                        $category_rs = Database::search("SELECT * FROM `categories`");
                                        $category_num = $category_rs->num_rows;

                                        for ($x = 0; $x < $category_num; $x++) {
                                            $category_data = $category_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo ($category_data["id"]); ?>"><?php echo ($category_data["categories_name"]); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <p class="form-label fs-5 fw-bolder" style="color: #484848;">Select Product Brand</p>
                                    <select class="form-select text-center" id="brand" onchange="load_model();">
                                        <option value="0">Select Brand</option>
                                        <?php
                                        $brand_rs = Database::search("SELECT * FROM `brand`");
                                        $brand_num = $brand_rs->num_rows;

                                        for ($x = 0; $x < $brand_num; $x++) {
                                            $brand_data = $brand_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo ($brand_data["id"]); ?>"><?php echo ($brand_data["brand_name"]); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <p class="form-label fs-5 fw-bolder" style="color: #484848;">Select Product Model</p>
                                    <select class="form-select text-center" id="model">
                                        <option value="0">Select Model</option>
                                        <?php
                                        $model_rs = Database::search("SELECT * FROM `model`");
                                        $model_num = $model_rs->num_rows;

                                        for ($x = 0; $x < $model_num; $x++) {
                                            $model_data = $model_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo ($model_data["id"]); ?>"><?php echo ($model_data["model_name"]); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" style="border-width: 2px;" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <p class="form-label fs-5 fw-bolder" style="color: #484848;">Add a title to your product</p>
                                        <div class="col-12 offset-0 col-lg-8 offset-lg-2">
                                            <input type="text" class="form-control" id="title" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" style="border-width: 2px;" />
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-4 border-end border-success">
                                            <p class="form-label fs-5 fw-bolder" style="color: #484848;">Select Condition</p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="c" id="b" checked />
                                                <label class="form-check-label" for="b">Brand New</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="c" id="u" />
                                                <label class="form-check-label" for="u">Used</label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4 border-end border-success">
                                            <p class="form-label fs-5 fw-bolder" style="color: #484848;">Select product colour</p>
                                            <select class="form-select" id="cl">
                                                <option value="0">Select Colour</option>
                                                <?php
                                                $clr_rs = Database::search("SELECT * FROM `color`");
                                                $clr_num = $clr_rs->num_rows;

                                                for ($a = 0; $a < $clr_num; $a++) {
                                                    $clr_data = $clr_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo ($clr_data["id"]) ?>"><?php echo ($clr_data["color_name"]) ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <p class="form-label fs-5 fw-bolder" style="color: #484848;">Add Product Quantity</p>
                                            <div class="col-12">
                                                <input type="number" class="form-control" value="0" min="0" id="qty" />
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" style="border-width: 2px;" />
                                </div>

                                <div class="col-6 border-end border-success">
                                    <p class="form-label fs-5 fw-bolder" style="color: #484848;">Cost per item</p>
                                    <div class="col-12 col-lg-8 offset-0 offset-lg-2">
                                        <div class="input-group mb-2 mt-2">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" id="cost" />
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <p class="form-label fs-5 fw-bolder" style="color: #484848;">Approved payment methods</p>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="offset-2 offset-lg-2 col-2 pm pm1"></div>
                                            <div class="col-2 pm pm2"></div>
                                            <div class="col-2 pm pm3"></div>
                                            <div class="col-2 pm pm4"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" style="border-width: 2px;" />
                                </div>

                                <div class="col-6 border-end border-success">
                                    <p class="form-label fs-5 fw-bolder" style="color: #484848;">Delivery cost</p>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-lg-3 offset-lg-1">
                                                <label class="form-label">Delivery cost within colombo</label>
                                            </div>
                                            <div class="col-12 col-lg-8">
                                                <div class="input-group mb-2 mt-2">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" id="dwc" />
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <p class="form-label fs-5 fw-bolder" style="color: #484848;">Delivery cost</p>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-lg-3 offset-lg-1">
                                                <label class="form-label">Delivery cost out of colombo</label>
                                            </div>
                                            <div class="col-12 col-lg-8">
                                                <div class="input-group mb-2 mt-2">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" id="doc" />
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" style="border-width: 2px;" />
                                </div>

                                <div class="col-12">
                                    <p class="form-label fs-5 fw-bolder" style="color: #484848;">Product Description</p>
                                    <div class="col-12">
                                        <textarea class="form-control" cols="30" rows="10" id="desc"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" style="border-width: 2px;" />
                                </div>

                                <div class="col-12">
                                    <p class="form-label fs-5 fw-bolder" style="color: #484848;">Add product images</p>
                                    <div class="col-12 col-lg-6 offset-lg-3">
                                        <div class="row">
                                            <div class="col-4 border border-primary rounded pt-3 pb-3">
                                                <img src="resources/addimagen.svg" class="img-fluid" style="height: 200px;" id="i0" />
                                            </div>
                                            <div class="col-4 border border-primary rounded pt-3 pb-3">
                                                <img src="resources/addimagen.svg" class="img-fluid" style="height: 200px;" id="i1" />
                                            </div>
                                            <div class="col-4 border border-primary rounded pt-3 pb-3">
                                                <img src="resources/addimagen.svg" class="img-fluid" style="height: 200px;" id="i2" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                        <input type="file" class="d-none" id="imageuploader" multiple />
                                        <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <hr class="border-success" style="border-width: 2px;" />
                                </div>

                                <div class="col-12">
                                    <p class="form-label fs-5 fw-bolder" style="color: #484848;">Notice...</p>
                                    <p class="form-label">We are taking 5% of the product from price from every product as a service charge.</p>
                                </div>

                                <div class="col-12 col-lg-4 offset-lg-4 d-grid mt-4 mb-4">
                                    <button class="btn btn-success fw-bold text-white" onclick="addProduct();">Save Product</button>
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

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>