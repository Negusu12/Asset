<?php
// Database connection
include 'connect.php';

// Fetch all employees for the dropdown
$employeesQuery = "SELECT employee_id, full_name FROM employee";
$employeesResult = $con->query($employeesQuery);
?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form action="reports/print_Responsibility_form.php" method="POST" target="_blank">
                <div class="row">
                    <div class="col-md-6">
                        <b class="text-muted">Register Borrower</b>
                        <div class="form-group">
                            <label for="">Select Employee</label>
                            <select name="employee_id" id="employee" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Enter Department Name Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                if ($employeesResult->num_rows > 0) {
                                    while ($row = $employeesResult->fetch_assoc()) {
                                        echo "<option value='" . $row['employee_id'] . "'>" . $row['full_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                    <button class="btn btn-primary mr-2" type="submit">Generate Responsibility Form</button>
                </div>
            </form>
        </div>
    </div>
</div>