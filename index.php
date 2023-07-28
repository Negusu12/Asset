<?php
session_start();

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
</head>

<body>
    <section class="">
        <?php include 'side_menu.php'; ?>
    </section>
</body>

</html>