<?php
include 'backend/insert.php';
include("connect.php");

$user_data = check_login($con);
?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 border-right">
                        <b class="text-muted">Asset Loan</b>
                        <div class="form-group">
                            <label for="" class="control-label">Item Name</label>
                            <select name="item_code" id="item_code" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Item Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php

                                // Retrieve all records from the asset_record table
                                $sql = "SELECT item_code, CONCAT(item_name, IFNULL(CONCAT(' - ', model), ''),IFNULL(CONCAT(' - ', item_category), '')) AS Item_Name FROM asset_record order by Item_Name";
                                $result = mysqli_query($con, $sql);

                                // Check if query was successful
                                if ($result) {
                                    // Loop through each row of the result set and output the item_name value as an option in the select dropdown
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["item_code"] . "'>" . $row["Item_Name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Loaner Name</label>
                            <select name="employee_id" id="employee_id" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Loaner Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                // Retrieve all records from the employee table ordered by full_name
                                $sql = "SELECT employee_id, full_name FROM employee ORDER BY full_name";
                                $result = mysqli_query($con, $sql);

                                // Check if query was successful
                                if ($result) {
                                    // Loop through each row of the result set and output the full_name value as an option in the select dropdown
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["employee_id"] . "'>" . $row["full_name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Quantity</label>
                            <input type="number" name="qty" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter Quantity Here')" oninput="setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br />
                        <div class="form-group">
                            <label for="" class="control-label">Date</label>
                            <input type="date" name="doc_date" id="doc_date" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter Date Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Serial No</label>
                            <input type="text" name="serial_no" id="serial_no" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter Serial No Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
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
                    <button class="btn btn-primary mr-2" type="submit" name="submit_l">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>