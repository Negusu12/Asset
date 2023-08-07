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
                Asset Register
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="input-data">
                        <input type="text" oninvalid="this.setCustomValidity('Enter Item Code Here')" oninput="setCustomValidity('')" required name="item_c">
                        <div class="underline"></div>
                        <label for="">Item Code</label>
                    </div>
                    <div class="input-data">
                        <input type="text" name="item_name" oninvalid="this.setCustomValidity('Enter Item Name Here')" oninput="setCustomValidity('')" required>
                        <div class="underline"></div>
                        <label for="">Item Name</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <select type="text" name="item_condition" oninvalid="this.setCustomValidity('Select Item Condition')" oninput="setCustomValidity('')" required>
                            <option value=""></option>
                            <option value="Functional">Functional</option>
                            <option value="Damaged but Functional">Damaged but Functional</option>
                            <option value="Non Functional">Non Functional</option>
                            <option value="Damaged">Damaged</option>
                            <option value="Damaged and Non-Functional">Damaged and Non-Functional</option>
                            <option value="Damaged or Non-Functional">Damaged or Non-Functional</option>
                        </select>
                        <div class="underline"></div>
                        <label for="">Item Condition</label>
                    </div>
                    <div class="username_s">
                        <input type="number" name="qty" value="0">
                        <div class="underline"></div>
                        <label for="">Quantity</label>
                    </div>
                    <div class="input-data">
                        <input type="date" name="doc_date" id="doc_date" oninvalid="this.setCustomValidity('Enter Date Here')" oninput="setCustomValidity('')" required>
                        <div class="underline"></div>
                        <label for="doc_date">Document Date</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data textarea">
                        <input type="textarea" rows="8" cols="80" name="description">
                        <div class="underline"></div>
                        <label for="">Discription</label>
                    </div>
                </div>
                <div class="username_s">
                    <input type="text" name="user_name" value="<?php echo $user_data['user_name']; ?>">
                    <div class="underline"></div>
                    <label for="">qwert</label>
                </div>
                <br>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <div class="inner"></div>
                        <input type="submit" name="submit">
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