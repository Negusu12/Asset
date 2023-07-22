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

                        $sql = "SELECT al.employee_id, e.full_name 
                FROM asset_loan al
                LEFT JOIN employee e ON al.employee_id = e.employee_id
                WHERE al.loan_id = ?";
                        $stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $loan_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["employee_id"] . "'>" . $row["full_name"] . "</option>";
                            }
                        }
                    }
                    ?>
                </select>
                <label for="" class="input_n">Item Code</label>
                <select name="item_code" class="input_t" onchange="this.form.submit()">
                    <?php
                    if (isset($_POST['loan_id'])) {
                        $loan_id = $_POST['loan_id'];

                        $sql = "SELECT al.item_code, ar.item_name
                FROM asset_loan al
                LEFT JOIN asset_record ar ON al.item_code = ar.item_code
                WHERE al.loan_id = ?";
                        $stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $loan_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["item_code"] . "'>" . $row["item_name"] . "</option>";
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

    <script src="asset/js/js.js"></script>
    <script src="components/inset.js"></script>
</body>

</html>