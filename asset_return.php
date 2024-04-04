<?php
include 'backend/insert.php';
include("connect.php");

$user_data = check_login($con);
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
                    <div class="col-md-6 border-right">
                        <b class="text-muted">Asset Return</b>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Loan ID</label>
                            <select name="loan_id" id="loan_id" class="custom-select custom-select-sm select2" onchange="updateLoanedQty()" oninvalid="this.setCustomValidity('Select Loan ID Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT DISTINCT 
                                al.loan_id,
                                al.employee_id,
                                al.item_code,
                                al.qty as sum_qty,
                                e.full_name as full_name,
                                ar.item_name as item_name
                                 FROM  asset_loan al
                                LEFT JOIN employee e ON al.employee_id = e.employee_id
                                LEFT JOIN asset_record ar ON al.item_code = ar.item_code
                                where al.qty > 0";
                                $result = mysqli_query($con, $sql);

                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = "";
                                        if (isset($_POST['loan_id']) && $_POST['loan_id'] == $row["loan_id"]) {
                                            $selected = "selected";
                                        }
                                        echo "<option value='" . $row["loan_id"] . "' " . $selected . " data-qty='" . $row["sum_qty"] . "' . ' " . $selected . " data-full_name='" . $row["full_name"] . "' . ' " . $selected . " data-item_name='" . $row["item_name"] . "' . ' " . $selected . " data-employee_id='" . $row["employee_id"] . "' . ' " . $selected . " data-item_code='" . $row["item_code"] . "'>" . $row["loan_id"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Borrower Name</label>
                            <input id="borrower_name" type="text" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Name</label>
                            <input id="item_name" type="text" class="form-control form-control-sm" readonly>
                        </div>

                        <div class="form-group" style="display: none;">
                            <label for="" class="control-label"><span style="color: red;">*</span> Borrower Name</label>
                            <input name="employee_id" id="employee_id" type="text" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Name</label>
                            <input name="item_code" id="item_code" type="text" class="form-control form-control-sm" readonly>
                        </div>


                        <div class="form-group">
                            <label for="" class="control-label">&nbsp;&nbsp;&nbsp;Unreturned QTY</label>
                            <input id="loaned_qty" type="text" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br />
                        <div class="form-group">
                            <label class="control-label"><span style="color: red;">*</span> Quantity</label>
                            <input type="number" class="form-control form-control-sm" name="qty" min="0" oninvalid="this.setCustomValidity('Enter Quantity Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Date</label>
                            <input type="date" name="doc_date" id="doc_date" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter Date Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">&nbsp;&nbsp;&nbsp;Description</label>
                            <textarea name="description" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group " style="display: none;">
                            <label class="control-label">Prepared By</label>
                            <input type="text" class="form-control form-control-sm" name="user_name" value="<?php echo $user_data['user_name']; ?>">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                    <button class="btn btn-primary mr-2" type="submit" name="submit_r">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function updateLoanedQty() {
        var selectedItem = document.getElementById("loan_id");
        var selectedOption = selectedItem.options[selectedItem.selectedIndex];
        var unreturnedQtyInput = document.getElementById("loaned_qty");
        unreturnedQtyInput.value = selectedOption.getAttribute("data-qty");
        var borrowerNameInput = document.getElementById("borrower_name");
        borrowerNameInput.value = selectedOption.getAttribute("data-full_name");
        var itemNameInput = document.getElementById("item_name");
        itemNameInput.value = selectedOption.getAttribute("data-item_name");

        var borrowerIdInput = document.getElementById("employee_id");
        borrowerIdInput.value = selectedOption.getAttribute("data-employee_id");
        var itemCodeInput = document.getElementById("item_code");
        itemCodeInput.value = selectedOption.getAttribute("data-item_code");

    }
</script>