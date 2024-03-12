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
    <link rel="icon" href="images/logo.png" type="image">
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="asset/css/sweetalert2.min.css">
</head>

<body>
    <section class="">
        <?php include 'side_menu.php'; ?>
    </section>
    <div class="container">
        <section class="asset_b">
            <div class="text">
                Buy Asset
            </div>

            <form method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="input-data">
                        <select name="item_code" id="item_code" placeholder="Item Name" oninvalid="this.setCustomValidity('Select Here')" oninput="setCustomValidity('')" required>
                            <option value=""></option>
                            <?php
                            // Retrieve all records from the asset_record table
                            $sql = "SELECT item_code, CONCAT(item_name, IFNULL(CONCAT(' - ', model), ''),IFNULL(CONCAT(' - ', item_category), '')) AS Item_Name, uom FROM asset_record order by Item_Name";
                            $result = mysqli_query($con, $sql);

                            // Check if query was successful
                            if ($result) {
                                // Loop through each row of the result set and output the item_name value as an option in the select dropdown
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row["item_code"] . "' data-uom='" . $row["uom"] . "'>" . $row["Item_Name"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div class="underline"></div>
                        <label for="">Item Name</label>
                    </div>

                    <div class="input-data">
                        <select name="uom" id="uom" placeholder="UOM" class="form__input" onchange="this.form.submit()">

                        </select>
                        <div class="underline"></div>
                        <label for="">UOM</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <input type="number" name="qty" oninvalid="this.setCustomValidity('Enter Quantity Here')" oninput="setCustomValidity('')" required>
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
                        <input type="textarea" rows="8" cols="80" name="description"> <br />
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
                        <input type="submit" name="submit_b">
                    </div>
                </div>
            </form>

        </section>
    </div>

    <script src="asset/js/js.js"></script>
    <script src="components/inset.js"></script>
    <script src="asset/js/sweetalert2.min.js"></script>

    <script>
        // JavaScript to populate UOM field based on selected item
        document.getElementById('item_code').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var uom = selectedOption.getAttribute('data-uom');
            document.getElementById('uom').innerHTML = '<option value="' + uom + '">' + uom + '</option>';
        });
    </script>

</body>

</html>