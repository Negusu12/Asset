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
    <section class="side-menu">
        <?php include 'side_menu.php'; ?>
    </section>
    <section class="asset_e">
        <div class="title_h">
            <h1>Employee</h1>
        </div>
        <div class="form_i">
            <form method="post" enctype="multipart/form-data">
                <label for="" class="input_n">full name</label>
                <input type="text" placeholder="Enter Item Code" name="full_name" class="input_t">
                <label for="" class="input_n">Department</label>
                <select type="text" name="department" class="input_t">
                    <option value="">--Select Department Here--</option>
                    <option value="it">IT</option>
                    <option value="Operation">Operation</option>
                    <option value="hr">HR</option>
                    <option value="hr">Technical Department</option>
                </select>

                <button type="submit" class="button_s" name="submit_e" required>Send Message</button>
            </form>
        </div>
    </section>

    <script src="asset/js/js.js"></script>
    <script src="components/inset.js"></script>
</body>

</html>