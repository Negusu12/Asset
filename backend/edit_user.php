<?php
include 'backend/insert.php';
include("connect.php");

$user_data = check_login($con);

$id = $user_name = $password = $role = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['id'])) {
        header('Location: users.php');
        exit;
    }

    $id = $_GET['id'];
    $sql = "SELECT id, user_name, role FROM users WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id);

    if (!$stmt->execute()) {
        $error = "Error: " . $stmt->error;
    } else {
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            header('Location: users.php');
            exit;
        }

        $stmt->bind_result($id, $user_name,  $role);
        $stmt->fetch();
    }
    $stmt->close();
} else {
    $id = $_POST["id"];
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Check if the password is empty
    if (empty($password)) {
        // Retrieve the old hashed password from the database
        $sqlOldPassword = "SELECT password FROM users WHERE id=?";
        $stmtOldPassword = $con->prepare($sqlOldPassword);
        $stmtOldPassword->bind_param('i', $id);
        if (!$stmtOldPassword->execute()) {
            $error = "Error: " . $stmtOldPassword->error;
        } else {
            $stmtOldPassword->store_result();

            if ($stmtOldPassword->num_rows == 0) {
                $error = "Error: User not found";
            } else {
                $stmtOldPassword->bind_result($old_password);
                $stmtOldPassword->fetch();
            }
        }
        $stmtOldPassword->close();

        // Use the old password if the new password is empty
        $password = $old_password;
    } else {
        // Hash the new password if provided
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    if (empty($error)) {
        $sql = "UPDATE users SET user_name=?, password=?, role=? WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssi', $user_name, $password, $role, $id);

        if (!$stmt->execute()) {
            $error = "Error: " . $stmt->error;
        } else {
            echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'User Updated Successfully',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            }).then(function() {
                window.location.href = 'index.php?page=users';
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
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="col-md-6">
                        <b class="text-muted">Add List Choice</b>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> User Name</label>
                            <input type="text" name="user_name" class="form-control form-control-sm" value="<?php echo $user_name ?>" oninvalid="this.setCustomValidity('Enter User Name Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Password</label>
                            <input type="text" name="password" class="form-control form-control-sm" placeholder="Leave empty to keep current password">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Role</label>
                            <select name="role" id="role" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Role Here')" oninput="setCustomValidity('')" required>
                                <option value="1" <?php echo ($role == 1) ? 'selected' : ''; ?>>Admin and User</option>
                                <option value="2" <?php echo ($role == 2) ? 'selected' : ''; ?>>User</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-left d-flex">
                    <button class="btn btn-primary mr-2" type="submit">Update</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>