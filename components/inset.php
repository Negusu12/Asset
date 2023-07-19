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
