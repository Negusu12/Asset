<?php
include("../connect.php");

// --------------  edit list------------------------------

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['list_model'])) {
        // Handle updating the drop_down_list table
        $list_id = $_POST["list_id"];
        $department = $_POST["department"];
        $category = $_POST["category"];
        $uom = $_POST["uom"];
        $location = $_POST["location"];

        $sql = "UPDATE drop_down_list SET department=?, category=?, uom=?, location=? WHERE list_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssi', $department, $category, $uom, $location, $list_id);

        if ($stmt->execute()) {
            header('Location: ../index.php?page=reports/report_list');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

        // --------------  End edit list------------------------------

        // --------------  edit Charge------------------------------
    } elseif (isset($_POST['charge_model'])) {
        // Handle updating the charges table
        $charge_id = $_POST['charge_id'];
        $charge = $_POST['charge'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        $stmt = $con->prepare("UPDATE charges SET Charge = ?, price = ?, description = ? WHERE charge_id = ?");
        $stmt->bind_param("sssi", $charge, $price, $description, $charge_id);

        if ($stmt->execute()) {
            header("Location: ../index.php?page=reports/report_charge");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Invalid submission.";
    }
    // --------------  End edit Charge------------------------------
}
