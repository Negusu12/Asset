<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <!-- <title>Sider Menu Bar CSS</title> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="asset/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#reports').click(function() {
                $('#sub-menu').toggle();
            });
        });
    </script>
</head>

<body>
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
        <header><?php echo $user_data['user_name']; ?>
        </header>
        <ul>
            <li><a href="index.php"><i class="fas fa-qrcode"></i>Dashboard</a></li>
            <li><a href="asset_record.php"><i class=" fas fa-solid fa-plus"></i>Asset Registor</a></li>
            <li><a href="asset_buy.php"><i class=" fas fa-solid fa-cart-arrow-down"></i>Asset Buy</a></li>
            <li><a href="asset_use.php"><i class=" fas fa-solid fa-cart-arrow-down"></i>Asset Use</a></li>
            <li><a href="asset_loan.php"><i class="fas fa-solid fa-landmark"></i>Asset Loan</a></li>
            <li><a href="asset_return.php"><i class="fas fa-regular fa-thumbs-up"></i>Asset Return</a></li>
            <li><a href="employee.php"><i class=" fas fa-solid fa-plus"></i>Add Employee</a></li>
            <li id="reports"><a href="#"><i class="fa-solid fa-arrow-down"></i>Reports</a></li>
            <ul id="sub-menu" style="display: none;">
                <li><a href="report_asset_onhand.php"><i class="fa-regular fa-address-book"></i>Asset On Hand</a></li>
                <li><a href="report_loan.php"><i class="fa-regular fa-address-book"></i>Asset On Loan</a></li>
                <li><a href="report_return.php"><i class="fa-regular fa-address-book"></i>Asset Return</a></li>
                <li><a href="report_buy.php"><i class="fa-regular fa-address-book"></i>Asset Buy</a></li>
                <li><a href="report_use.php"><i class="fa-regular fa-address-book"></i>Asset Used</a></li>
                <?php if ($user_data['role'] == 1) : ?>
                    <li><a href="users.php"><i class="fa-regular fa-address-book"></i>Users</a></li>
                <?php endif; ?>
            </ul>
            <?php if ($user_data['role'] == 1) : ?>
                <li><a href="signup.php"><i class="fa-solid fa-user"></i>Add User</a></li>
                <li><a href="list.php"><i class="fa-solid fa-user"></i>Add Drop Down List</a></li>
            <?php endif; ?>
            <li><a href="change_password.php"><i class="fa-solid fa-user"></i>Change Password</a></li>
            <li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Log Out</a></li>

        </ul>
    </div>
</body>

</html>