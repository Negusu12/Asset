<?php
include 'backend/insert.php';
include("connect.php");

$user_data = check_login($con);

$item_code = $item_name = $model = $brand = $item_type = $item_category = $qty = $uom = $doc_date = $description = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['item_code'])) {
        header('Location: ../report_asset.php');
        exit;
    }

    $item_code = $_GET['item_code'];
    $sql = "SELECT item_code, item_name, model, brand, item_type, item_category, qty, uom, doc_date, description FROM asset_record WHERE item_code=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $item_code);

    if (!$stmt->execute()) {
        $error = "Error: " . $stmt->error;
    } else {
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            header('Location: ../report_asset.php');
            exit;
        }

        $stmt->bind_result($item_code, $item_name, $model, $brand, $item_type, $item_category, $qty, $uom, $doc_date, $description);
        $stmt->fetch();
    }
    $stmt->close();
} else {
    $item_code = $_POST["item_code"];
    $item_name = $_POST["item_name"];
    $model = $_POST["model"];
    $brand = $_POST["brand"];
    $item_type = $_POST["item_type"];
    $item_category = $_POST["item_category"];
    $qty = $_POST["qty"];
    $uom = $_POST["uom"];
    $doc_date = $_POST["doc_date"];
    $description = $_POST["description"];

    if (empty($error)) {
        $sql = "UPDATE asset_record SET item_name=?, model=?, brand=?, item_type=?, item_category=?, qty=?, uom=?, doc_date=?, description=? WHERE item_code=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssssissss', $item_name, $model, $brand, $item_type, $item_category, $qty, $uom, $doc_date, $description, $item_code);

        if (!$stmt->execute()) {
            $error = "Error: " . $stmt->error;
        } else {
            echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Asset Record Updated Successfully',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            }).then(function() {
                window.location.href = 'index.php?page=report_asset_onhand';
            });
        }
    </script>";
        }
    }
}
?>
<div class="navigation_arrow">
    <button class="navigation-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
    <button class="navigation-btn" onclick="goForward()"><i class="fas fa-arrow-right"></i></button>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <input type="hidden" name="item_code" value="<?php echo $item_code; ?>">
                    <div class="col-md-6">
                        <b class="text-muted">Edit Asset</b>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Name</label>
                            <input type="text" name="item_name" class="form-control form-control-sm" value="<?php echo $item_name ?>" oninvalid="this.setCustomValidity('Enter Item Name Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Brand</label>
                            <input type="text" name="brand" class="form-control form-control-sm" value="<?php echo $brand ?>">
                        </div>
                        <div class=" form-group">
                            <label for="" class="control-label">Model</label>
                            <input type="text" name="model" class="form-control form-control-sm" value="<?php echo $model ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Type</label>
                            <select name="item_type" id="item_type" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Enter Item Type Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <option value="asset" <?php if ($item_type == "asset") echo "selected"; ?>>Asset</option>
                                <option value="consumable" <?php if ($item_type == "consumable") echo "selected"; ?>>Consumable</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Category</label>
                            <select name="item_category" id="item_category" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Enter Item Category Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT list_id, category FROM drop_down_list WHERE category IS NOT NULL AND category <> ''";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["category"] . "'" . ($item_category == $row["category"] ? " selected" : "") . ">" . $row["category"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label class="control-label"><span style="color: red;">*</span> Quantity</label>
                            <input type="number" class="form-control form-control-sm" name="qty" value="<?php echo $qty ?>" oninvalid="this.setCustomValidity('Enter Quantity Here')" oninput="setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br />
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> UOM</label>
                            <select name="uom" id="uom" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Enter UOM Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT list_id, uom FROM drop_down_list WHERE uom IS NOT NULL AND uom <> ''";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["uom"] . "'" . ($uom == $row["uom"] ? " selected" : "") . ">" . $row["uom"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Date</label>
                            <input type="date" name="doc_date" id="doc_date" class="form-control form-control-sm" value="<?php echo $doc_date ?>" oninvalid="this.setCustomValidity('Enter Date Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">&nbsp;&nbsp;&nbsp;Description</label>
                            <textarea name="description" id="description" cols="30" rows="4" class="form-control"><?php echo $description ?></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-left d-flex">
                    <button class="btn btn-primary mr-2" type="submit">Update</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>