<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Admin</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="resources/dream sports (3).svg">
</head>

<body style="background-color: #f0f0f5;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12 mb-5">
                <div class="row">
                    <nav class="navbar navbar-dark bg-dark fixed-top pt-3 pb-3">
                        <div class="container-fluid">
                            <a class="navbar-brand fw-bold" href="#">DREAM SPORTS</a>
                            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                                <span class="text-white fs-4 fw-bold pe-4">Dashboard</span>
                                <span class="navbar-toggler-icon fs-4"></span>
                            </button>
                            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title fw-bold" id="offcanvasDarkNavbarLabel">DREAM SPORTS</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle active fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Dashboard
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-dark">
                                                <li><a class="dropdown-item" href="adminPanel.php">- E-commerce</a></li>
                                                <li><a class="dropdown-item" href="manageUsers.php">- Manage Users</a></li>
                                                <li><a class="dropdown-item active" href="manageProduct.php">- Manage Products</a></li>
                                            </ul>
                                        </li>

                                        <div class="col-12">
                                            <hr />
                                        </div>

                                        <li class="nav-item">
                                            <a class="nav-link active fs-5" aria-current="page" href="#">Selling History</a>
                                        </li>

                                        <div class="col-12">
                                            <hr />
                                        </div>

                                        <li class="nav-item">
                                            <label class="form-label">From Date</label>
                                        </li>
                                        <li class="nav-item">
                                            <input type="date" class="form-control">
                                        </li>

                                        <li class="nav-item mt-3">
                                            <label class="form-label">To Date</label>
                                        </li>
                                        <li class="nav-item">
                                            <input type="date" class="form-control">
                                        </li>
                                        <div class="col-12">
                                            <hr />
                                        </div>

                                        <div class="col-12 d-grid">
                                            <button class="btn btn-primary">View Selling</button>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="col-12 mt-5 mb-3">
                <div class="row">

                    <div class="col-10 offset-1 pt-2 pb-2">
                        <div class="row">
                            <div class="col-6 text-start">
                                <label class="form-label fw-bold text-black-50 fs-5">Manage Products</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-10 offset-1 bg-white mt-3 mb-2">
                        <div class="row">
                            <div class="col-10 offset-1 pt-2 pb-1">
                                <div class="row">
                                    <div class="col-6 text-start pt-2">
                                        <label class="form-label fw-bold fs-6">Products List</label>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="row p-2">
                                            <div class="col-10 col-lg-10 offset-lg-1 border-4 ">
                                                <input type="text" class="form-control fs-6" placeholder="Search user" />
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
                                    <div class="col-3 col-lg-3">
                                        <label class="form-label fw-bold fs-6">Title</label>
                                    </div>
                                    <div class="col-1 col-lg-2 text-center">
                                        <label class="form-label fw-bold fs-6">Price</label>
                                    </div>
                                    <div class="col-1 col-lg-1 text-center">
                                        <label class="form-label fw-bold fs-6">Quantity</label>
                                    </div>
                                    <div class="col-2 col-lg-1 text-center">
                                        <label class="form-label fw-bold fs-6">Register Date</label>
                                    </div>
                                    <div class="col-1 col-lg-2">
                                        <label class="form-label fw-bold fs-6"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- user 1 -->
                    <?php
                    $count = 1;
                    $query = "SELECT * FROM `product`";
                    $pageno;

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $product_rs = Database::search($query);
                    $product_num = $product_rs->num_rows;


                    $results_per_page = 20;
                    $number_of_pages = ceil($product_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                    $selected_num = $selected_rs->num_rows;
                    for ($x = 0; $x < $selected_num; $x++) {
                        $s_data = $selected_rs->fetch_assoc();
                    ?>
                        <div class="col-10 offset-1 bg-white mt-1">
                            <div class="row pt-3 pb-2">
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-6 col-lg-1">
                                            <span class="form-label fw-bold fs-6 d-block d-lg-none">No</span>
                                            <label class="form-label fs-6"><?php echo ($count++) ?></label>
                                        </div>
                                        <div class="col-6 col-lg-2 text-center text-lg-start" onclick="viewProductModel('<?php echo ($s_data['id']); ?>');">
                                            <span class="form-label fw-bold fs-6 d-block d-lg-none">Product Image</span>
                                            <?php
                                            $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $s_data["id"] . "'");
                                            $image_data = $image_rs->fetch_assoc();
                                            ?>
                                            <img src="<?php echo ($image_data["image_path"]); ?>" class="img-fluid img-thumbnail rounded-circle dropdown" style="height: 60px;width: 60px;cursor: pointer;" alt="">
                                        </div>
                                        <div class="col-6 col-lg-3 pt-3 pt-lg-0 text-lg-start">
                                            <span class="form-label fw-bold fs-6 d-block d-lg-none">Title</span>
                                            <label class="form-label fs-6"><?php echo ($s_data["title"]); ?></label>
                                        </div>
                                        <div class="col-6 col-lg-2 text-center pt-3 pt-lg-0">
                                            <span class="form-label fw-bold fs-6 d-block d-lg-none">Price</span>
                                            <label class="form-label fw-bold fs-6">Rs. <?php echo ($s_data["price"]); ?> .00</label>
                                        </div>
                                        <div class="col-6 col-lg-1 text-center pt-3 pt-lg-0">
                                            <span class="form-label fw-bold fs-6 d-block d-lg-none">Quantity</span>
                                            <label class="form-label fw-bold fs-6"><?php echo ($s_data["qty"]); ?></label>
                                        </div>
                                        <div class="col-6 col-lg-1 text-center pt-3 pt-lg-0">
                                            <span class="form-label fw-bold fs-6 d-block d-lg-none">Register Date</span>
                                            <label class="form-label fw-bold fs-6"><?php echo ($s_data["datetime_added"]); ?></label>
                                        </div>
                                        <div class="col-12 col-lg-2 text-center">
                                            <?php
                                            if ($s_data["status_id"] == 1) {
                                            ?>
                                                <button class="btn fw-bold text-danger" style="background-color: #f0f0f5;" id="bs<?php echo ($s_data["id"]); ?>" onclick="blockProducts('<?php echo ($s_data['id']); ?>');"><i class="bi bi-trash3-fill"></i> Block</button>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="btn fw-bold text-success" style="background-color: #f0f0f5;" id="bs<?php echo ($s_data["id"]); ?>" onclick="blockProducts('<?php echo ($s_data['id']); ?>');"><i class="bi bi-trash3-fill"></i> Unblock</button>
                                            <?php
                                            }
                                            ?>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- modal 1 -->
                        <div class="modal" tabindex="-1" id="viewProductModel<?php echo ($s_data['id']); ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold text-success"><?php echo ($s_data["title"]); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="offset-4 col-4">
                                            <img src="<?php echo ($image_data["image_path"]); ?>" class="img-fluid" style="height: 150px;" />
                                        </div>
                                        <div class="col-12">
                                            <span class="fs-5 fw-bold text-black-50">Price :</span>&nbsp;
                                            <span class="fs-5">Rs. <?php echo ($s_data["price"]); ?> .00</span><br />
                                            <span class="fs-5 fw-bold text-black-50">Quantity :</span>&nbsp;
                                            <span class="fs-5"><?php echo ($s_data["qty"]); ?> Product left</span><br />
                                            <?php
                                            $pu = Database::search("SELECT * FROM `user` WHERE `email`='".$s_data["user_email"]."'");
                                            $pn = $pu->num_rows;
                                            $pd = $pu->fetch_assoc();
                                            ?>
                                            <span class="fs-5 fw-bold text-black-50">Seller :</span>&nbsp;
                                            <span class="fs-5"><?php echo($pd["first_name"]) ?></span><br />
                                        </div>
                                        <div class="col-12 mt-2 overflow-scroll" style="height: 300px;">
                                            <span class="fs-4 fw-bold text-black-50">Description :</span>&nbsp;
                                            <span class="fs-6 overflow-scroll"><?php echo ($s_data["description"]); ?></span><br />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal 1 -->

                    <?php
                    }
                    ?>
                    <!-- user 1 -->



                    <!-- pagination -->
                    <div class="col-10 offset-1 d-flex flex-row justify-content-end bg-white pt-4">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <label class="form-label text-black-50 pe-2 pt-2">1 - 20 of <?php echo ($selected_num); ?> items</label>
                                <li class="page-item">
                                    <a class="page-link" href="
                                                        <?php if ($pageno <= 1) {
                                                            echo ("#");
                                                        } else {
                                                            echo "?page=" . ($pageno - 1);
                                                        } ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php

                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                    if ($x == $pageno) {
                                ?>
                                        <li class="page-item active">
                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                        </li>
                                <?php
                                    }
                                }

                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                    echo ("#");
                                                                } else {
                                                                    echo "?page=" . ($pageno + 1);
                                                                } ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- pagination -->

                </div>
            </div>

            <div class="col-12" id="vm"></div>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>