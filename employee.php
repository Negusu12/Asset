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
</head>

<body>
    <section class="">
        <?php include 'side_menu.php'; ?>
    </section>
    <div class="container">
        <section class="asset_e">
            <div class="text">
                Registed Employee
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="input-data">
                        <input type="text" name="full_name">
                        <div class="underline"></div>
                        <label for="">Employee Name</label>
                    </div>
                    <div class="input-data">
                        <select type="text" name="department">
                            <option value="">--Select Department Here--</option>
                            <option value="it">IT</option>
                            <option value="Operation">Operation</option>
                            <option value="hr">HR</option>
                            <option value="hr">Technical Department</option>
                            <option value="Finance">Finance Department</option>
                        </select>
                        <div class="underline"></div>
                    </div>
                </div>

                <div class="form-row submit-btn">
                    <div class="input-data">
                        <div class="inner"></div>
                        <input type="submit" name="submit_e">
                    </div>
                </div>
            </form>
    </div>
    </section>
    </div>
    <script src="asset/js/js.js"></script>
    <script src="components/inset.js"></script>
</body>

</html>