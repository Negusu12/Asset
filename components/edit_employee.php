<?php
include "../connect.php";

$employee_id = $full_name = $department = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
	if (!isset($_GET['employee_id'])) {
		header('Location: ../report_employee.php');
		exit;
	}

	$employee_id = $_GET['employee_id'];
	$sql = "SELECT employee_id, full_name, department FROM employee WHERE employee_id=?";
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $employee_id);

	if (!$stmt->execute()) {
		$error = "Error: " . $stmt->error;
	} else {
		$stmt->store_result();

		if ($stmt->num_rows == 0) {
			header('Location: ../report_employee.php');
			exit;
		}

		$stmt->bind_result($employee_id, $full_name,  $department);
		$stmt->fetch();
	}
	$stmt->close();
} else {
	$employee_id = $_POST["employee_id"];
	$full_name = $_POST["full_name"];
	$department = $_POST["department"];



	if (empty($error)) {
		$sql = "UPDATE employee SET full_name=?, department=? WHERE employee_id=?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ssi', $full_name, $department, $employee_id);

		if (!$stmt->execute()) {
			$error = "Error: " . $stmt->error;
		} else {
			echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Loner Record Updated Successfully',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            }).then(function() {
                window.location.href = '../report_employee.php';
            });
        }
    </script>";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Edit User</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="assets/images/icons/favicon.ico" />
	<link rel="stylesheet" href="../asset/css/sweetalert2.min.css">

	<style>
		body {
			font-family: 'Arial', sans-serif;
			background-color: #03949B;
			margin: 0;
			padding: 0;
			color: #26225B;
		}

		.container {
			max-width: 600px;
			margin: 50px auto;
			/* Adjusted margin for centering */
			background-color: #FFFFFF;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		h1 {
			color: #26225B;
			font-size: 28px;
			/* Increased font size */
			text-align: center;
			/* Centered text */
			margin-bottom: 20px;
			/* Added margin */
		}

		.form-group {
			margin-bottom: 20px;
		}

		label {
			display: block;
			margin-bottom: 8px;
			font-weight: bold;
			color: #26225B;
		}

		input,
		textarea,
		select {
			width: 100%;
			padding: 10px;
			border: 1px solid #B2B435;
			border-radius: 5px;
			box-sizing: border-box;
			margin-bottom: 10px;
			/* Added margin for spacing between form elements */
		}

		button {
			background-color: #03949B;
			color: #FFFFFF;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		button:hover {
			background-color: #4D7DBF;
		}

		.alert {
			margin-top: 20px;
			padding: 10px;
			border-radius: 5px;
		}

		.alert-danger {
			background-color: #FFD2D2;
			border: 1px solid #FF5E5E;
			color: #D8000C;
		}

		.alert-success {
			background-color: #DFF2BF;
			border: 1px solid #4F8A10;
			color: #4F8A10;
		}

		.btn-back {
			display: block;
			text-align: right;
			margin-bottom: 10px;
			text-decoration: none;
			color: #03949B;
			font-weight: bold;
		}

		.btn-back:hover {
			color: #4D7DBF;
		}
	</style>
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

				<div employee_id="box" class="box container">
					<a href="../report_employee.php" class="btn-back">Back to Loners List</a>
					<h1>Edit User</h1>
					<form method="post" enctype="multipart/form-data">
						<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">

						<div class="form-group">
							<label for="full_name">full_name</label>
							<input class="input100" type="text" name="full_name" value="<?php echo $full_name ?>" required>
						</div>

						<div class="form-group">
							<label for="department">department</label>
							<select type="text" name="department" oninvalid="this.setCustomValidity('Enter Department Here')" oninput="setCustomValidity('')" required>
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

						<button type="submit">Update</button>
						<?php if (!empty($error)) { ?>
							<div class="alert alert-danger"><?php echo $error ?></div>
						<?php } else if (!empty($success)) { ?>
							<div class="alert alert-success"><?php echo $success ?></div>
						<?php } ?>
					</form>

				</div>
			</div>
		</div>
	</div>
	<script src="../asset/js/sweetalert2.min.js"></script>
</body>

</html>