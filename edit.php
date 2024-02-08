<?php
include "connect.php";

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
                window.location.href = 'users.php';
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
  <link rel="stylesheet" href="asset/css/sweetalert2.min.css">

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

        <div id="box" class="box container">
          <a href="users.php" class="btn-back">Back to Users</a>
          <h1>Edit User</h1>
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
              <label for="user_name">User Name:</label>
              <input class="input100" type="text" name="user_name" value="<?php echo $user_name ?>" required>
            </div>

            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" name="password" placeholder="Leave empty to keep current password">
            </div>
            <div class="form-group">
              <label for="role">Role:</label>
              <select name="role" required>
                <option value="1" <?php echo ($role == 1) ? 'selected' : ''; ?>>Admin and User</option>
                <option value="2" <?php echo ($role == 2) ? 'selected' : ''; ?>>User</option>
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
  <script src="asset/js/sweetalert2.min.js"></script>
</body>

</html>