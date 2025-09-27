<?php

require "connection.php";

if (isset($_GET["b"])) {
    $brand_id = $_GET["b"];

    $model_rs = Database::search("SELECT * FROM `model` WHERE `brand_id`='" . $brand_id . "'");
    $model_num = $model_rs->num_rows;

    if ($model_num > 0) {

        for ($x = 0; $x < $model_num; $x++) {

            $model_data = $model_rs->fetch_assoc();

?>

            <option value="<?php echo ($model_data["id"]); ?>"><?php echo ($model_data["model_name"]); ?></option>


        <?php
        }
    } else {

        $all_model = Database::search("SELECT * FROM `model`");
        $all_num = $all_model->num_rows;

        for ($y = 0; $y < $all_num; $y++) {
            $all_data = $all_model->fetch_assoc();
        ?>

            <option value="<?php echo ($all_data["id"]); ?>"><?php echo ($all_data["model_name"]); ?></option>


<?php
        }
    }
}

?>