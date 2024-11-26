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
                        <b class="text-muted">Asset Register</b>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Charge</label>
                            <select name="charge" id="charge" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Charge Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                // Retrieve all records from the employee table ordered by full_name
                                $sql = "SELECT charge_id, charge FROM charges";
                                $result = mysqli_query($con, $sql);

                                // Check if query was successful
                                if ($result) {
                                    // Loop through each row of the result set and output the full_name value as an option in the select dropdown
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["charge_id"] . "'>" . $row["charge"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Owner</label>
                            <select name="owner" id="owner" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Borrower Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                // Retrieve all records from the employee table ordered by full_name
                                $sql = "SELECT employee_id, full_name FROM employee where employee_id != 195 ORDER BY full_name";
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
                            <label for="" class="control-label"><span style="color: red;">*</span> Borrower Name</label>
                            <select name="current_holder" id="borrower" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Borrower Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                // Retrieve all records from the employee table ordered by full_name
                                $sql = "SELECT employee_id, full_name FROM employee where employee_id != 195 ORDER BY full_name";
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
                            <label for="" class="control-label">&nbsp;&nbsp;&nbsp;Phone Number</label>
                            <input type="text" name="phone_number" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Payment Period</label>
                            <select name="payment_period" id="payment_period" class="custom-select custom-select-sm select2" onchange="toggleExpireDate(this.value)" required>
                                <option value=""></option>
                                <option value="Monthly">Monthly</option>
                                <option value="Yearly">Yearly</option>
                            </select>
                        </div>
                        <input type="hidden" name="status" value="Active" />
                    </div>
                    <div class="col-md-6">
                        <br />
                        <div class="form-group" id="expire-date-group" style="display: none;">
                            <label for="" class="control-label">Expire Date</label>
                            <input type="date" name="expire_date" id="expire_date" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Given Date</label>
                            <input type="date" name="given_date" id="given_date" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter Given Date Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Payment Type</label>
                            <select name="payment_type" id="payment_type" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Payment Type Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <option value="Post Paid">Post Paid</option>
                                <option value="Pre Paid">Pre Paid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">&nbsp;&nbsp;&nbsp;Description</label>
                            <textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                    <button class="btn btn-primary mr-2" type="submit" name="submit_transaction">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const today = new Date().toISOString().split('T')[0];

        document.getElementById('given_date').value = today; // Default to today's date
    });
</script>
<script>
    function toggleExpireDate(value) {
        const expireDateGroup = document.getElementById('expire-date-group');
        if (value === 'Yearly') {
            expireDateGroup.style.display = 'block';
        } else {
            expireDateGroup.style.display = 'none';
        }
    }
</script>