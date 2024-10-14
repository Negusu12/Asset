<?php
include 'backend/insert.php';
include("connect.php");

$user_data = check_login($con);

$employee_id = $borrower_title = $full_name = $department = $list_id = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
	if (!isset($_GET['employee_id'])) {
		header('Location: ../reports/report_employee.php');
		exit;
	}

	$employee_id = $_GET['employee_id'];
	$sql = "SELECT e.employee_id as employee_id,
e.borrower_title as borrower_title,
e.full_name as full_name,
e.department as department,
li.list_id as list_id
from employee e
left join drop_down_list li on li.list_id = e.list_id WHERE employee_id=?";
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $employee_id);

	if (!$stmt->execute()) {
		$error = "Error: " . $stmt->error;
	} else {
		$stmt->store_result();

		if ($stmt->num_rows == 0) {
			header('Location: ../reports/report_employee.php');
			exit;
		}

		$stmt->bind_result($employee_id, $borrower_title, $full_name, $department, $list_id);
		$stmt->fetch();
	}
	$stmt->close();
} else {
	$employee_id = $_POST["employee_id"];
	$borrower_title = $_POST["borrower_title"];
	$full_name = $_POST["full_name"];
	$department = $_POST["department"];
	$list_id = $_POST["list_id"];

	if (empty($error)) {
		$sql = "UPDATE employee SET borrower_title=?, full_name=?, department=?, list_id=? WHERE employee_id=?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ssssi', $borrower_title, $full_name, $department,  $list_id, $employee_id);

		if (!$stmt->execute()) {
			$error = "Error: " . $stmt->error;
		} else {
			echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Borrower Record Updated Successfully',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            }).then(function() {
                window.location.href = 'index.php?page=reports/report_employee';
            });
        }
    </script>";
		}
	}
}
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
					<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
					<div class="col-md-6">
						<b class="text-muted">Add List Choice</b>
						<div class="form-group">
							<label for="" class="control-label"><span style="color: red;">*</span> Borrower Title</label>
							<select name="borrower_title" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Title Here')" oninput="setCustomValidity('')" required>
								<option value="" <?php if ($borrower_title == '') echo 'selected'; ?>></option>
								<option value="Mr." <?php if ($borrower_title == 'Mr.') echo 'selected'; ?>>Mr.</option>
								<option value="Ms." <?php if ($borrower_title == 'Ms.') echo 'selected'; ?>>Ms.</option>
								<option value="Dr." <?php if ($borrower_title == 'Dr.') echo 'selected'; ?>>Dr.</option>
								<option value="Prof." <?php if ($borrower_title == 'Prof.') echo 'selected'; ?>>Prof.</option>
								<option value="Eng." <?php if ($borrower_title == 'Eng.') echo 'selected'; ?>>Eng.</option>
							</select>
						</div>

						<div class="form-group">
							<label for="" class="control-label"><span style="color: red;">*</span> Borrower Name</label>
							<input type="text" name="full_name" class="form-control form-control-sm" value="<?php echo $full_name ?>" oninvalid="this.setCustomValidity('Enter User Name Here')" oninput="setCustomValidity('')" required>
						</div>
						<div class="form-group">
							<label for="" class="control-label"><span style="color: red;">*</span> Department</label>
							<select name="department" id="department" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Role Here')" oninput="setCustomValidity('')" required>
								<?php
								$sql = "SELECT list_id, department FROM drop_down_list WHERE department IS NOT NULL AND department <> ''";
								$result = mysqli_query($con, $sql);
								if ($result) {
									while ($row = mysqli_fetch_assoc($result)) {
										$selected = ($row["department"] == $department) ? 'selected' : '';
										echo "<option value='" . $row["department"] . "' $selected>" . $row["department"] . "</option>";
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="" class="control-label"><span style="color: red;">*</span> Location</label>
							<select name="list_id" id="list_id" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Enter Location Name Here')" oninput="setCustomValidity('')" required>
								<option value=""></option>
								<?php
								$sql = "SELECT list_id, location FROM drop_down_list WHERE location IS NOT NULL AND location <> '' order by location ";
								$result = mysqli_query($con, $sql);
								if ($result) {
									while ($row = mysqli_fetch_assoc($result)) {
										$selected = ($row["list_id"] == $list_id) ? 'selected' : '';
										echo "<option value='" . $row["list_id"] . "' $selected>" . $row["location"] . "</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-left d-flex">
					<button class="btn btn-primary mr-2" type="submit">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>