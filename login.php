<?php
session_start();

include("connect.php");
include("backend/functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric(($user_name))) {
        $query = "select * from users where BINARY user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);
        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Username or Password is incorrect please enter valid information!',
                showConfirmButton: false,
                showDenyButton: true,
                denyButtonText: 'OK'
            });
        }
     </script>";
    } else {
        echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Please enter valid information!',
                showConfirmButton: false,
                showDenyButton: true,
                denyButtonText: 'OK'
            });
        }
     </script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/icon" href="assets/dist/img/logo.png" />
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/dist/css/login.css">
    <link rel="stylesheet" href="assets/dist/css/sweetalert2.min.css">
    <style>
        .password-container {
            position: relative;
            width: 100%;
        }

        .form-control {
            width: 100%;
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="text-center login-titleee">
                            <a href="home" <h2 class="heading-section" style="color: #B2B435; font-size: 30px; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">ABH Inventory System</h2></a>
                        </div>
                        <div class="d-flex">
                            <div class="w-100" style="text-align: right;">
                                <h3 class="mb-3" style="color: #03949B; font-size: 24px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Log In</h3>
                            </div>
                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                </p>
                            </div>
                        </div>
                        <form method="post" class="login-form">
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
                                <input type="text" name="user_name" class="form-control rounded-left" placeholder="Username" onkeyup="lettersOnly(this)" required>
                            </div>
                            <div class="form-group">
                                <div class="password-container">
                                    <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>

                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control rounded-left"
                                        placeholder="Password"
                                        required
                                        id="password-field">
                                    <button
                                        type="button"
                                        class="toggle-password"
                                        onclick="togglePassword()">
                                        👁️
                                    </button>
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <div class="w-100">
                                    <label class="checkbox-wrap checkbox-primary mb-0">Save Password
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-100 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary rounded submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/popper/popper.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/dist/js/sweetalert2.min.js"></script>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password-field');
            const toggleButton = document.querySelector('.toggle-password');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleButton.textContent = '🙈'; // Change icon to "Hide" state
            } else {
                passwordField.type = 'password';
                toggleButton.textContent = '👁️'; // Change icon to "Show" state
            }
        }
    </script>
</body>

</html>