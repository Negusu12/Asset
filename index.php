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
        <div class="top-sec">
            <p>Asset Management</p>
        </div>
        <ul class="menu-ul">
            <li id="asset_record">Asset Register</li>
            <li id="asset_buy">Asset Buy</li>
            <li id="asset_loan">Asset Loan</li>
            <li id="asset_return">Asset Return</li>
            <li id="asset_detail">Asset detail</li>
            <li id="asset_employee">Asset employee</li>
        </ul>
    </section>
    <section class="asset_r active">
        <div class="title_h">
            <h1>Asset Register</h1>
        </div>
        <div class="form_i">
            <form method="post" enctype="multipart/form-data">
                <label for="" class="input_n">Item Code</label>
                <input type="text" placeholder="Enter Item Code" name="item_code" class="input_t">
                <label for="" class="input_n">Item Name</label>
                <input type="text" placeholder="Enter Item Name" name="item_name" class="input_t"> <br>
                <label for="" class="input_n">Quantity</label>
                <input type="number" placeholder="Enter Item Quantity" name="qty" class="input_t">
                <label for="" class="input_n">Document Date</label>
                <input type="date" name="doc_date" class="input_t"> <br>
                <label for="" class="input_n">Description</label>
                <input type="taxetarea" name="description" class="input_t"> <br>
                <button type="submit" class="button_s" name="submit" required>Send Message</button>
            </form>
        </div>
    </section>
    <section class="asset_b">
        <div>
            <h1>Buy Asset </h1>
        </div>
        <div class="form_i">
            <form method="post" enctype="multipart/form-data">
                <label for="" class="input_n">Item Name</label>
                <select name="item_code" class="input_t">
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
                <label for="" class="input_n">Quantity</label>
                <input type="number" placeholder="Enter Item Quantity" name="qty" class="input_t">
                <label for="" class="input_n">Document Date</label>
                <input type="date" name="doc_date" class="input_t"> <br>
                <label for="" class="input_n">Description</label>
                <input type="taxetarea" name="description" class="input_t"> <br>
                <button type="submit" class="button_s" name="submit_b" required>Send Message</button>
            </form>
        </div>
    </section>
    <section class="asset_l">
        <div>
            <h1>Asset Loan</h1>
        </div>
        <div class="form_i">
            <form method="post" enctype="multipart/form-data">
                <label for="" class="input_n">Item Name</label>
                <select name="item_code" class="input_t">
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
    <section class="asset_re">
        <div>
            <h1>Asset Return </h1>
        </div>
        <div class="form_i">
            <form method="post" enctype="multipart/form-data">
                <label for="" class="input_n">Loan ID</label>
                <select name="loan_id" class="input_t" onchange="this.form.submit()">
                    <option value=""> Select Loan ID</option>
                    <?php
                    $sql = "SELECT DISTINCT loan_id FROM asset_loan where qty > 0";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $selected = "";
                            if (isset($_POST['loan_id']) && $_POST['loan_id'] == $row["loan_id"]) {
                                $selected = "selected";
                            }
                            echo "<option value='" . $row["loan_id"] . "' " . $selected . ">" . $row["loan_id"] . "</option>";
                        }
                    }
                    ?>
                </select>
                <label for="" class="input_n">Employee ID</label>
                <select name="employee_id" class="input_t" onchange="this.form.submit()">
                    <?php
                    if (isset($_POST['loan_id'])) {
                        $loan_id = $_POST['loan_id'];

                        $sql = "SELECT DISTINCT employee_id FROM asset_loan WHERE loan_id = ?";
                        $stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $loan_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["employee_id"] . "'>" . $row["employee_id"] . "</option>";
                            }
                        }
                    }
                    ?>
                </select>
                <label for="" class="input_n">Item Code</label>
                <select name="item_code" class="input_t">
                    <?php
                    if (isset($_POST['loan_id'])) {
                        $loan_id = $_POST['loan_id'];

                        $sql = "SELECT DISTINCT item_code FROM asset_loan WHERE loan_id = ?";
                        $stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $loan_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["item_code"] . "'>" . $row["item_code"] . "</option>";
                            }
                        }
                    }
                    ?>
                </select>
                <label for="" class="input_n">Quantity</label>
                <input type="number" placeholder="Enter Item Quantity" name="qty" class="input_t">
                <label for="" class="input_n">Document Date</label>
                <input type="date" name="doc_date" class="input_t"> <br>
                <label for="" class="input_n">Description</label>
                <input type="text" name="description" class="input_t"> <br>
                <button type="submit" class="button_s" name="submit_r">Send Message</button>
            </form>
        </div>
    </section>
    <section class="asset_d">
        <div>
            <h1>Asset Detail</h1>
        </div>
    </section>
    <section class="asset_e">
        <div class="title_h">
            <h1>Employee</h1>
        </div>
        <div class="form_i">
            <form method="post" enctype="multipart/form-data">
                <label for="" class="input_n">full name</label>
                <input type="text" placeholder="Enter Item Code" name="full_name" class="input_t">
                <label for="" class="input_n">Department</label>
                <input type="text" placeholder="Enter Item Name" name="department" class="input_t"> <br>

                <button type="submit" class="button_s" name="submit_e" required>Send Message</button>
            </form>
        </div>
    </section>

    <script src="asset/js/js.js"></script>
</body>

</html>