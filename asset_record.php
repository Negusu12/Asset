<?php
include 'components/inset.php';
if (isset($_GET['success_message'])) {
    // Escape the message to prevent XSS attacks
    $success_message = htmlspecialchars($_GET['success_message']);
    // Display the message using JavaScript
    echo '<script>alert("' . $success_message . '"); window.location.href = "asset_record.php";</script>';
    exit(); // Exit to prevent the rest of the page from loading
}
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
            <?php
            /* Add the success message here */
            if (isset($_SESSION['success_message'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
                unset($_SESSION['success_message']);
            }
            ?>
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
                        <input type="text" name="item_name"> <br>
                        <div class="underline"></div>
                        <label for="">Item Name</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <input type="number" name="qty">
                        <div class="underline"></div>
                        <label for="">Quantity</label>
                    </div>
                    <div class="input-data">
                        <input type="date" name="doc_date">
                        <div class="underline"></div>
                        <label for="">Document Date</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data textarea">
                        <input type="textarea" rows="8" cols="80" name="description">
                        <div class="underline"></div>
                        <label for="">Discription</label>
                    </div>
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