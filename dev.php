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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
</head>

<body>
    <section class="">
        <?php include 'side_menu.php'; ?>
    </section>
    <div class="container">
        <section class="asset_r">


            <div class="text">
                Asset Return
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="input-data">
                        <select name="loan_id" placeholder="Name" class="form__input" onchange="this.form.submit()">
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
                        <div class="underline"></div>
                    </div>
                    <div class="input-data">
                        <select name="employee_id" placeholder="Employee" class="form__input" onchange="this.form.submit()">
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
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <select name="item_code" placeholder="Item Name" class="form__input" onchange="this.form.submit()">
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
                        <div class="underline"></div>
                    </div>
                    <div class="input-data">
                        <input type="number" name="qty">
                        <div class="underline"></div>
                        <label for="">Quantity</label>
                    </div>
                </div>
                <div class="form-row">
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
                        <input type="submit" name="submit_r">
                    </div>
                </div>
            </form>

    </div>
    </section>

    <script src="asset/js/js.js"></script>
    <script src="components/inset.js"></script>
</body>

</html>