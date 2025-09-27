<?php

session_start();
require "connection.php";

$user_mail = $_SESSION["userData"];

$search = $_POST["s"];
$time = $_POST["t"];
$qty = $_POST["q"];
$condition = $_POST["c"];

$query = "SELECT * FROM `product` WHERE `user_email`='" . $user_mail["email"] . "'";

if (!empty($search)) {
    $query .= " AND `title` LIKE '%" . $search . "%'";
}

if ($condition != "0") {
    $query .= " AND `condition_id`='" . $condition . "'";
}

if ($time != "0") {
    if ($time == "1") {
        $query .= " ORDER BY `datetime_added` DESC";
    } else if ($time == "2") {
        $query .= " ORDER BY `datetime_added` ASC";
    }
}

if ($time != "0" && $qty != "0") {
    if ($qty == 1) {
        $query .= " , `qty` DESC";
    } else if ($qty == "2") {
        $query .= " , `qty` ASC";
    }
} else if ($time == "0" && $qty != "0") {
    if ($qty == 1) {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}
?>

<div class="col-10 offset-1 text-center">
    <div class="row justify-content-center">
        <?php
        if (isset($_GET["page"])) {
            $pageNo = $_GET["page"];
        } else {
            $pageNo = 1;
        }

        $product_rs = Database::search($query);
        $product_num = $product_rs->num_rows;

        $results_per_page = 6;
        $number_of_page = ceil($product_num / $results_per_page);

        $page_results = ($pageNo - 1) * $results_per_page;
        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

        $selected_num = $selected_rs->num_rows;

        for ($x = 0; $x < $selected_num; $x++) {
            $selected_data = $selected_rs->fetch_assoc();
        ?>
            <!-- card -->
            <div class="card mb-3 mt-3 col-12 col-lg-6">
                <div class="row">
                    <div class="col-md-4 mt-4">
                        <?php
                        $product_img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $selected_data["id"] . "'");
                        $product_img_data = $product_img_rs->fetch_assoc();
                        ?>
                        <img src="<?php echo ($product_img_data["image_path"]); ?>" class="img-fluid img-thumbnail rounded-start" />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo ($selected_data["title"]); ?></h5>
                            <span class="card-text fw-bold text-primary">Rs. <?php echo ($selected_data["price"]); ?> .00</span><br />
                            <span class="card-text fw-bold text-success"><?php echo ($selected_data["qty"]); ?> Items left</span>
                            <div class="form-check form-switch mx-3 mx-lg-0 mx-md-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo ($selected_data["id"]); ?>" <?php if ($selected_data["status_id"] == 2) { ?>checked<?php } ?> onclick="changeStatus('<?php echo ($selected_data['id']); ?>');" />
                                <label class="form-check-label text-info fw-bold" for="fd<?php echo ($selected_data["id"]); ?>">
                                    <?php if ($selected_data["status_id"] == 2) { ?>
                                        Make Your Product Active
                                    <?php } else { ?>
                                        Make Your Product Deactive
                                    <?php
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row g-1">
                                        <div class="col-12 col-lg-6 d-grid">
                                            <button class="btn btn-success fw-bold">Update</button>
                                        </div>
                                        <div class="col-12 col-lg-6 d-grid">
                                            <button class="btn btn-danger fw-bold">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card -->
        <?php
        }

        ?>
    </div>
</div>


<!-- pagination -->
<div class="col-12 d-flex flex-row justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="<?php if ($pageNo <= 1) {
                                                echo ("#");
                                            } else {
                                                echo ("?page=" . ($pageNo - 1));
                                            } ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for ($x = 1; $x <= $number_of_page; $x++) {
                if ($x == $pageNo) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" href="<?php echo ("?page=" . $x); ?>"><?php echo ($x); ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo ("?page=" . $x); ?>"><?php echo ($x); ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a class="page-link" href="<?php if ($pageNo >= $number_of_page) {
                                                echo ("#");
                                            } else {
                                                echo ("?page=" . ($pageNo + 1));
                                            } ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<!-- pagination -->