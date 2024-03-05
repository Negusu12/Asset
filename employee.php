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
    <title>Add Loaner</title>
    <link rel="icon" href="images/logo.png" type="image">
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="asset/css/sweetalert2.min.css">
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
                        <input type="text" name="full_name" oninvalid="this.setCustomValidity('Enter Name Here')" oninput="setCustomValidity('')" required>
                        <div class="underline"></div>
                        <label for="">Employee Name</label>
                    </div>
                    <div class="input-data">
                        <select type="text" name="department" oninvalid="this.setCustomValidity('Enter Department Here')" oninput="setCustomValidity('')" required>
                            <option value=""></option>
                            <?php
                            $sql = "SELECT list_id, department FROM drop_down_list WHERE department IS NOT NULL AND department <> ''";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row["department"] . "'>" . $row["department"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div class="underline"></div>
                        <label for="">Department Name</label>
                    </div>
                    <div class="username_s">
                        <input type="text" name="user_name" value="<?php echo $user_data['user_name']; ?>">
                        <div class="underline"></div>
                        <label for="">qwert</label>
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
    <script src="asset/js/sweetalert2.min.js"></script>
</body>

</html>