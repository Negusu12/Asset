<?php
ob_start();
include("connect.php");

$user_data = check_login($con);

$loan_id = $item_code = $employee_id = $description = $user_name = $serial_no = $item_condition = $doc_date = $qty = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['loan_id'])) {
        header('Location: ../report_loan.php');
        exit;
    }

    $loan_id = $_GET['loan_id'];
    $sql = "SELECT loan_id, item_code, employee_id, description, user_name, serial_no, item_condition, doc_date, qty FROM asset_loan WHERE loan_id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $loan_id);

    if (!$stmt->execute()) {
        $error = "Error: " . $stmt->error;
    } else {
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            header('Location: ../report_loan.php');
            exit;
        }

        $stmt->bind_result($loan_id, $item_code, $employee_id, $description, $user_name, $serial_no, $item_condition, $doc_date, $qty);
        $stmt->fetch();
    }
    $stmt->close();
} else {
    $loan_id = $_POST["loan_id"];
    $item_code = $_POST["item_code"];
    $employee_id = $_POST["employee_id"];
    $description = $_POST["description"];
    $user_name = $_POST["user_name"];
    $serial_no = $_POST["serial_no"];
    $item_condition = $_POST["item_condition"];

    // Fetch current doc_date and qty to keep them unchanged
    $sql = "SELECT doc_date, qty FROM asset_loan WHERE loan_id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $loan_id);
    $stmt->execute();
    $stmt->bind_result($doc_date, $qty);
    $stmt->fetch();
    $stmt->close();

    if (empty($error)) {
        $sql = "UPDATE asset_loan SET item_code=?, employee_id=?, description=?, user_name=?, serial_no=?, item_condition=? WHERE loan_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssssi', $item_code, $employee_id, $description, $user_name, $serial_no, $item_condition, $loan_id);

        if (!$stmt->execute()) {
            $error = "Error: " . $stmt->error;
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Asset Record Updated Successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                    }).then(function() {
                        window.location.href = 'index.php?page=report_damaged';
                    });
                }
            </script>";
        }
    }
}
ob_end_flush();
?>

<div class="navigation_arrow">
    <button class="navigation-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
    <button class="navigation-btn" onclick="goForward()"><i class="fas fa-arrow-right"></i></button>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <input type="hidden" name="loan_id" value="<?php echo $loan_id; ?>">
                    <div class="col-md-6 border-right">
                        <b class="text-muted">Asset Loan</b>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Name</label>
                            <select name="item_code" id="item_code" class="custom-select custom-select-sm select2" onchange="updateAvailableQty()" oninvalid="this.setCustomValidity('Select Item Here')" oninput="setCustomValidity('')" required disabled>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT item_code, CONCAT(item_name, IFNULL(CONCAT(' - ', brand), ''), IFNULL(CONCAT(' - ', model), ''), IFNULL(CONCAT(' - ', item_category), '')) AS Item_Name, qty as sum_qty, uom FROM asset_record where item_type = 'asset' order by Item_Name";
                                $result = mysqli_query($con, $sql);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = ($row["item_code"] == $item_code) ? "selected" : "";
                                        echo "<option value='" . $row["item_code"] . "' data-qty='" . $row["sum_qty"] . "' data-uom='" . $row["uom"] . "' $selected>" . $row["Item_Name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" name="item_code" value="<?php echo $item_code; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Condition</label>
                            <select name="item_condition" id="item_condition" class="custom-select custom-select-sm select2" onchange="updateAvailableQty()" oninvalid="this.setCustomValidity('Select Item Condition Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <option value="Brand New" <?php if ($item_condition == "Brand New") echo "selected"; ?>>Brand New</option>
                                <option value="like New" <?php if ($item_condition == "like New") echo "selected"; ?>>Like New</option>
                                <option value="Excellent" <?php if ($item_condition == "Excellent") echo "selected"; ?>>Excellent</option>
                                <option value="Good" <?php if ($item_condition == "Good") echo "selected"; ?>>Good</option>
                                <option value="Fair" <?php if ($item_condition == "Fair") echo "selected"; ?>>Fair</option>
                                <option value="Poor" <?php if ($item_condition == "Poor") echo "selected"; ?>>Poor</option>
                                <option value="Damaged" <?php if ($item_condition == "Damaged") echo "selected"; ?>>Damaged</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Borrower Name</label>
                            <select name="employee_id" id="employee_id" class="custom-select custom-select-sm select2" disabled>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT employee_id, full_name FROM employee ORDER BY full_name";
                                $result = mysqli_query($con, $sql);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = ($row["employee_id"] == $employee_id) ? "selected" : "";
                                        echo "<option value='" . $row["employee_id"] . "' $selected>" . $row["full_name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br />
                        <div class="form-group">
                            <label class="control-label">&nbsp;&nbsp;&nbsp;Serial No</label>
                            <input type="text" class="form-control form-control-sm" name="serial_no" value="<?php echo $serial_no ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">&nbsp;&nbsp;&nbsp;Description</label>
                            <textarea name="description" id="description" cols="30" rows="4" class="form-control"><?php echo $description ?></textarea>
                        </div>
                        <div class="form-group " style="display: none;">
                            <label class="control-label">Prepared By</label>
                            <input type="text" class="form-control form-control-sm" name="user_name" value="<?php echo $user_data['user_name']; ?>">
                        </div>
                    </div>
                </div>

                <hr>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                    <button class="btn btn-primary mr-2" type="submit" name="submit_l">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>