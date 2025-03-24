<?php
// Database connection
include 'connect.php';

// Fetch all employees for the dropdown
$sql = "SELECT DISTINCT full_name FROM employee";
$result = $con->query($sql);
$employees = [];
while ($row = $result->fetch_assoc()) {
    $employees[] = $row['full_name'];
}

// Get selected employee from GET request
$full_name = isset($_GET['full_name']) ? $_GET['full_name'] : '';
?>


<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form method="get" action="report_design/print_Responsibility_form.php" target="_blank">
                <div class="row">
                    <div class="col-md-6">
                        <b class="text-muted">Responsibility Form</b>
                        <div class="form-group">
                            <label for="">Select Employee</label>
                            <select name="full_name" id="full_name" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Enter Department Name Here')" oninput="setCustomValidity('')" required>
                                <option value="">-- Select Employee --</option>
                                <?php foreach ($employees as $employee) : ?>
                                    <option value="<?= htmlspecialchars($employee) ?>" <?= ($full_name == $employee) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($employee) ?>
                                    </option>
                                <?php endforeach; ?>
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