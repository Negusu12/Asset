<?php
if (isset($_GET["bid_id"])) {
    include('connect.php');
    $bid_id = $_GET['bid_id']; // Corrected variable name
    $sql = "DELETE FROM bid WHERE bid_id=$bid_id";
    if ($con->query($sql) == TRUE) {
        header('location:index.php?page=bid_list');
    } else {
        echo "Error deleting record: " . $con->error;
    }
}
