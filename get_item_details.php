<?php
include("connect.php");

if (isset($_POST['item_code'])) {
    $item_code = $_POST['item_code'];

    // Your SQL query to fetch item details goes here
    // Modify it according to your database view structure

    $item_details_query = "SELECT 
                                item_name,
                                total_qty_record,
                                total_qty_loan,
                                total_qty_inactive
                            FROM 
                                total_item_qty_view
                            WHERE 
                                item_code = '$item_code'";

    $item_details_result = $con->query($item_details_query);

    if ($item_details_result) {
        if ($item_details_result->num_rows > 0) {
            $row = $item_details_result->fetch_assoc();
            $html = '<li><a class="item-link" href="index.php?page=pages/report_in_store&item_code=' . $item_code . '"><i class="far fa-circle"></i> In Store: ' . $row["total_qty_record"] . '</a></li>';
            $html .= '<li><a class="item-link" href="index.php?page=pages/report_on_loan&item_code=' . $item_code . '"><i class="far fa-circle"></i> On Loan: ' . $row["total_qty_loan"] . '</a></li>';
            $html .= '<li><a class="item-link" href="index.php?page=pages/report_on_inactive&item_code=' . $item_code . '"><i class="far fa-circle"></i> Inactive: ' . $row["total_qty_inactive"] . '</a></li>';
            echo $html;
        } else {
            echo "No rows found for item code: " . $item_code;
        }
    } else {
        echo "Query execution failed: " . $con->error;
    }
}
