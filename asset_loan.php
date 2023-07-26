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
    <link rel="stylesheet" href="asset/css/sweetalert2.min.css">
</head>

<body>
    <section class="">
        <?php include 'side_menu.php'; ?>
    </section>
    <div class="container">
        <section class="asset_l">
            <div class="text">
                Asset Loan
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="input-data">
                        <select name="item_code">
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
                        <div class="underline"></div>
                    </div>
                    <div class="input-data">
                        <select name="employee_id">
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
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="input-data">
                        <input type="number" name="qty">
                        <div class="underline"></div>
                        <label for="">Quantity</label>
                    </div>
                    <div class="input-data">
                        <input type="date" name="doc_date">
                        <div class="underline"></div>
                        <label for="">Document Date</label>

                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data textarea">
                        <input type="textarea" rows="8" cols="80" name="description"> <br />
                        <div class="underline"></div>
                        <label for="">Discription</label>
                    </div>
                </div>
                <br>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <div class="inner"></div>
                        <input type="submit" name="submit_l">
                    </div>
                </div>
            </form>

        </section>


        <script src="asset/js/js.js"></script>
        <script src="components/inset.js"></script>
        <script src="asset/js/sweetalert2.min.js"></script>
</body>

</html>