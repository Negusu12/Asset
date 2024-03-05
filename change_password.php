<?php
session_start();
include 'components/inset.php';
include("connect.php");
include("components/functions.php");

$user_data = check_login($con);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="images/logo.png" type="image">
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="asset/css/sweetalert2.min.css">

</head>

<body>
    <section class="">
        <?php include 'side_menu.php'; ?>
    </section>
    <div class="container">
        <section class="asset_r">

            <div class="text">
                Change Password
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="input-data">
                        <input readonly style="text-transform: capitalize;" value="<?php echo $user_data['user_name']; ?>">
                        <div class="underline"></div>
                        <label for="">Username</label>
                    </div>
                    <div class="username_s">
                        <input type="text" readonly name="id" value="<?php echo $user_data['id']; ?>">
                        <div class="underline"></div>
                        <label for="">User id</label>
                    </div>
                    <div class="input-data">
                        <input type="password" name="current_passwordd" oninvalid="this.setCustomValidity('Enter current_password Here')" oninput="setCustomValidity('')" required> <br>
                        <div class="underline"></div>
                        <label for="">current_password</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <input type="password" name="new_password" oninvalid="this.setCustomValidity('Enter new_password Here')" oninput="setCustomValidity('')" required>
                        <div class="underline"></div>
                        <label for="">password</label>
                    </div>
                    <div class="input-data">
                        <input type="password" name="confirm_password">
                        <div class="underline"></div>
                        <label for="doc_date">confirm_password</label>
                    </div>
                </div>
                <br>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <div class="inner"></div>
                        <input type="submit" name="submitp">
                    </div>
                </div>
            </form>
        </section>
    </div>
    <script src="asset/js/js.js"></script>
    <script src="components/inset.js"></script>
    <script src="asset/js/sweetalert2.min.js"></script>

</body>

</html>