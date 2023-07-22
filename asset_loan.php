<?php
include 'components/inset.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset/css/style.css">
</head>

<body>
    <section class="side-menu">
        <?php include 'side_menu.php'; ?>
    </section>
    <section class="asset_l">
        <div>
            <h1>Asset Loan</h1>
        </div>
        <div class="form_i">
            <form method="post" enctype="multipart/form-data">
                <label for="" class="input_n">Item Name</label>
                <select name="item_code" class="input_t">
                    <option value="">--Select Item Name--</option>
                    <?php

                    // Retrieve all records from the asset_record table
                    $sql = "SELECT item_code, item_name FROM asset_record";
                    $result = mysqli_query($con, $sql);

                    // Check if query was successful
                    if ($result) {
                        // Loop through each row of the result set and output the item_name value as an option in the select dropdown
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row["item_code"] . "'>" . $row["item_name"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <label for="" class="input_n">Employee Name</label>
                <select name="employee_id" class="input_t">
                    <option value="">--Select Loaner Name--</option>
                    <?php


                    // Retrieve all records from the asset_record table
                    $sql = "SELECT employee_id, full_name FROM employee";
                    $result = mysqli_query($con, $sql);

                    // Check if query was successful
                    if ($result) {
                        // Loop through each row of the result set and output the item_name value as an option in the select dropdown
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row["employee_id"] . "'>" . $row["full_name"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <label for="" class="input_n">Quantity</label>
                <input type="number" placeholder="Enter Item Quantity" name="qty" class="input_t">
                <label for="" class="input_n">Document Date</label>
                <input type="date" name="doc_date" class="input_t"> <br>
                <label for="" class="input_n">Description</label>
                <input type="taxetarea" name="description" class="input_t"> <br>
                <button type="submit" class="button_s" name="submit_l" required>Send Message</button>
            </form>
        </div>
    </section>

    <script src="asset/js/js.js"></script>
    <script src="components/inset.js"></script>
</body>

</html>