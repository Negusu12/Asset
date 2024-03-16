<?php
include("connect.php");

$user_data = check_login($con);

if (isset($_POST['submitp'])) {
	$id = isset($_POST['id']) ? $_POST['id'] : ''; // Assuming user_id is passed from the form
	$current_passwordd = isset($_POST['current_passwordd']) ? addslashes($_POST['current_passwordd']) : '';
	$new_password = isset($_POST['new_password']) ? addslashes($_POST['new_password']) : '';
	$confirm_password = isset($_POST['confirm_password']) ? addslashes($_POST['confirm_password']) : '';


	$sql = "SELECT password FROM users WHERE id='$id'";
	$result = mysqli_query($con, $sql);

	if ($result) {
		$row = mysqli_fetch_assoc($result);

		// Check if $row is not null before accessing its value
		if ($row !== null) {
			$hashed_password = $row['password'];

			// Check if the new password and confirm password fields match
			if ($new_password !== $confirm_password) {
				// Display an error message
				echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'New Passwords and Confirm Password do not match.',
                            showConfirmButton: false,
                            showDenyButton: true,
                            denyButtonText: 'OK'
                        });
                    }
                </script>";
			} else if (!password_verify($current_passwordd, $hashed_password)) {
				// Check if the entered current password is incorrect
				echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Current password is incorrect.',
                            showConfirmButton: false,
                            showDenyButton: true,
                            denyButtonText: 'OK'
                        });
                    }
                </script>";
			} else {
				// Update the password in the database
				$hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
				$update_sql = "UPDATE users SET password='$hashed_new_password' WHERE id='$id'";
				$update_result = mysqli_query($con, $update_sql);

				if ($update_result) {
					// Display a success message
					echo "<script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Password Updated Successfully',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                            }).then(function() {
                                window.location.href = 'index.php';
                            });
                        }
                    </script>";
				} else {
					// Display an error message
					echo "<script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Password not changed.',
                                showConfirmButton: false,
                                showDenyButton: true,
                                denyButtonText: 'OK'
                            });
                        }
                    </script>";
				}
			}
		} else {
			// Handle case where no user with the given user_id is found
			echo "<script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'User not found.',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                }
            </script>";
		}
	}
}
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form method="post">
				<div class="row">
					<div class="col-md-6 border-right">
						<b class="text-muted">Add User</b>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" readonly style="text-transform: capitalize;" value="<?php echo $user_data['user_name']; ?>" required autocomplete="off">
						</div>
						<input type="text" style="display: none;" readonly name="id" value="<?php echo $user_data['id']; ?>">
						<div class="form-group">
							<label for="">Current Password</label>
							<input class="form-control" type="password" name="current_passwordd" required>
						</div>
						<div class="form-group">
							<label for="">New Password</label>
							<input class="form-control" type="password" name="new_password" required>
						</div>
						<div class="form-group">
							<label for="">Confirm Password</label>
							<input class="form-control" type="password" name="confirm_password" required>
						</div>
					</div>
					<div class="col-md-6">
						<!-- Additional fields can be added here if needed -->
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2" type="submit" name="submitp" value="Signup">Save</button>
					<button class="btn btn-secondary" type="reset">Clear</button>
				</div>
			</form>
		</div>
	</div>
</div>