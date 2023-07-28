<?php
session_start();

include("connect.php");
include("components/functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric(($user_name))) {
        $user_id = random_num(20);
        $query = "insert into users (user_id,user_name,password)
    values ('$user_id','$user_name','$password')";
        mysqli_query($con, $query);
        header("LOCATION: login.php");
        die;
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
    <title>Sign Up</title>
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
                    <img src="asset/image/logo.png" alt="IMG">
                </div>

                <div id="box">
                    <form method="post">
                        <span class="login100-form-title">
                            Signup
                        </span>

                        <div class="wrap-input100 validate-input" data-validate="Valid Username is required: ex@abc.xyz">
                            <input class="input100" id="text" type="text" name="user_name" onkeyup="lettersOnly(this)" placeholder="Username">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" id="text" type="password" name="password" placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">

                            <input class="login100-form-btn" type="submit" value="Signup">

                        </div>


                        <div class="text-center p-t-136">

                        </div>

                    </form>
                </div>
            </div>
        </div>
        <script src="assets/js/js.js"></script>
        <script src="asset/js/sweetalert2.min.js"></script>
</body>

</html>