<?php
include 'backend/insert.php';
include("connect.php");

$user_data = check_login($con);

$item_code = $item_name = $model = $brand = $item_type = $item_category = $qty = $uom = $doc_date = $description = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
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

    // Process image upload
    if (!empty($_FILES['image']['tmp_name'])) {
        $image = $_FILES['image'];
        $image_data = file_get_contents($image['tmp_name']); // Get binary data of the new image

        // First, delete the existing image
        $delete_sql = "UPDATE asset_record SET item_image = NULL WHERE item_code=?";
        $delete_stmt = $con->prepare($delete_sql);
        $delete_stmt->bind_param('s', $item_code);
        $delete_stmt->execute();
        $delete_stmt->close();

        // Insert the new image
        $insert_sql = "UPDATE asset_record SET item_image=? WHERE item_code=?";
        $insert_stmt = $con->prepare($insert_sql);
        $insert_stmt->bind_param('ss', $image_data, $item_code);
        if ($insert_stmt->execute()) {
            $success = "Asset image is changed successfully";
        } else {
            $error = "Error updating image: " . $insert_stmt->error;
        }
        $insert_stmt->close();
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
            <?php if ($error) : ?>
                <div>Error: <?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success) : ?>
                <script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'success',
                            title: '<?php echo $success; ?>',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                        }).then(function() {
                            window.location.href = 'index.php?page=report_asset_onhand';
                        });
                    }
                </script>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data">
                <!-- Your form fields -->
                <input type="file" name="image" accept="image/*">
                <button type="submit">Update Image</button>
            </form>
        </div>
    </div>
</div>