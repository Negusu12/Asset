<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <!-- <title>Sider Menu Bar CSS</title> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="asset/css/style.css">
</head>

<body>
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
        <header>My App</header>
        <ul>
            <li><a href="#"><i class="fas fa-qrcode"></i>Dashboard</a></li>
            <li><a href="asset_record.php"><i class="fa-solid fa-clapperboard"></i>Asset Registor</a></li>
            <li><a href="asset_buy.php"><i class="fas fa-stream"></i>Asset Buy</a></li>
            <li><a href="asset_loan.php"><i class="fas fa-calendar-week"></i>Asset Loan</a></li>
            <li><a href="asset_return.php"><i class="far fa-question-circle"></i>Asset Return</a></li>
            <li><a href="employee.php"><i class="fas fa-sliders-h"></i>Add Employee</a></li>
            <li><a href="#"><i class="far fa-envelope"></i>Contact</a></li>
        </ul>
    </div>
</body>

</html>