<?php
session_start();

include("connect.php");
include("components/functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric(($user_name))) {
        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);
        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] === $password) {
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

<!DOCTYPE html>
<html lang="en">

<head>
    <title>LogIn</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="asset/image/logo.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="asset/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="asset/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="asset/login/css/main.css">
    <link rel="stylesheet" href="asset/css/sweetalert2.min.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <a class="navbar-brand" href="home">
                        <img src="asset/image/logo.png" alt="IMG">
                    </a>
                </div>

                <div id="box">
                    <form method="post">
                        <span class="login100-form-title">
                            Admin Login
                        </span>

                        <div class="wrap-input100">
                            <input class="input100" id="text" type="text" name="user_name" placeholder="Username" onkeyup="lettersOnly(this)">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100" data-validate="Password is required">
                            <input class="input100" id="text" type="password" name="password" placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">

                            <input class="login100-form-btn" type="submit" value="Login">

                        </div>


                        <div class="text-center p-t-136">

                        </div>

                    </form>
                </div>
            </div>
        </div>




        <!--===============================================================================================-->
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/tilt/tilt.jquery.min.js"></script>
        <script>
            $('.js-tilt').tilt({
                scale: 1.1
            })
        </script>
        <!--===============================================================================================-->
        <script src="js/main.js"></script>
        <script src="assets/js/js.js"></script>
        <script src="asset/js/sweetalert2.min.js"></script>

</body>

</html>