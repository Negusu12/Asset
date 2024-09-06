<?php
include("../connect.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $list_id = $_POST["list_id"];
    $department = $_POST["department"];
    $category = $_POST["category"];
    $uom = $_POST["uom"];
    $location = $_POST["location"];

    $sql = "UPDATE drop_down_list SET department=?, category=?, uom=?, location=? WHERE list_id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssssi', $department, $category, $uom, $location, $list_id);

    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error;
    } else {
        header('Location: ../index.php?page=reports/report_list');
    }
    $stmt->close();
}
