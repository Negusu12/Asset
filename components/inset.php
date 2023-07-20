<?php
include 'connect.php';
if (isset($_POST['submit'])) {
    $item_code = /*addlashes so it accept commas and sympols*/ addslashes($_POST['item_code']);
    $item_name = addslashes($_POST['item_name']);
    $qty = addslashes($_POST['qty']);
    $doc_date = addslashes($_POST['doc_date']);
    $description = addslashes($_POST['description']);

    $sql = "insert into `asset_record`(item_code,item_name,qty,doc_date,description)
    values ('$item_code','$item_name', '$qty', '$doc_date', '$description')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "sucess";
    }
}

if (isset($_POST['submit_e'])) {
    $full_name = /*addlashes so it accept commas and sympols*/ addslashes($_POST['full_name']);
    $department = addslashes($_POST['department']);

    $sql = "insert into `employee`(full_name,department)
    values ('$full_name','$department')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "sucess";
    }
}

if (isset($_POST['submit_l'])) {
    $item_code = /*addslashes so it accept commas and symbols*/ addslashes($_POST['item_code']);
    $employee_id = addslashes($_POST['employee_id']);
    $qty = addslashes($_POST['qty']);
    $doc_date = addslashes($_POST['doc_date']);
    $description = addslashes($_POST['description']);

    // Retrieve the current quantity for the selected item_code from the asset_record table
    $sql = "SELECT qty FROM asset_record WHERE item_code='$item_code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_qty = $row['qty'];

    // Calculate the new quantity
    $new_qty = $current_qty - $qty;

    // Check if the new quantity is less than 0
    if ($new_qty < 0) {
        // Display an error message
        $error_message = "Error: The selected item is out of stock.";
    } else {
        // Update the qty column in the asset_record table with the new quantity
        $update_sql = "UPDATE asset_record SET qty='$new_qty' WHERE item_code='$item_code'";
        $update_result = mysqli_query($con, $update_sql);

        if ($update_result) {
            // Insert the data into the asset_loan table
            $insert_sql = "INSERT INTO asset_loan (item_code, employee_id, qty, doc_date, description)
                           VALUES ('$item_code', '$employee_id', '$qty', '$doc_date', '$description')";
            $insert_result = mysqli_query($con, $insert_sql);

            if ($insert_result) {
                // Redirect the user to another page
                header('Location: dev.php');
                exit();
            } else {
                // Display an error message
                $error_message = "Error: Failed to insert data into the asset_loan table.";
            }
        } else {
            // Display an error message
            $error_message = "Error: Failed to update the asset_record table.";
        }
    }

    // Display the error message, if any
    if (isset($error_message)) {
        echo $error_message;
    }
}
