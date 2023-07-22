<?php
include 'components/inset.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset/css/style.css">
    <script src="https://kit.fontawesome.com/f747a1147b.js" crossorigin="anonymous"></script>

</head>

<body>
    <section class="side-menu">
        <div class="top-sec">
            <p>Asset Management</p>
        </div>
        <ul class="menu-ul">
            <li id="asset_record"><a href="asset_record.php">
                    <i class="fa-solid fa-clapperboard"></i>

                </a></li>
            <li id="asset_buy"><a href="asset_buy.php">
                    Asset BUY
                </a></li>
            <li id="asset_loan"><a href="asset_loan.php">
                    <i class="fa-solid fa-hand-holding-hand"></i>
                    Asset Loan
                </a></li>
            <li id="asset_return"><a href="asset_return.php">
                    <i class="fa-solid fa-person-walking-arrow-loop-left"></i>
                    Asset Return
                </a></li>
            <li id="asset_employee"><a href="employee.php">
                    <i class="fa-solid fa-plus-minus"></i>
                    Add Employee
                </a></li>
            <li id="asset_detail">
                <a href="">
                    <i class="fa-solid fa-book-bookmark" style="color: #25511f;"></i>
                    Asset detail
                </a>
            </li>

        </ul>
    </section>


    <script src="asset/js/js.js"></script>

</body>

</html>