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
    <title>Drop Down List</title>
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
                Add Drop Down List
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="input-data">
                        <input type="text" name="department">
                        <div class="underline"></div>
                        <label for="">Department</label>
                    </div>
                    <div class="input-data">
                        <input type="text" name="category">
                        <div class="underline"></div>
                        <label for="">Category</label>
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <div class="inner"></div>
                        <input type="submit" name="submit_list">
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