<?php
include("connect.php");

if (isset($_POST['category'])) {
    $category = $_POST['category'];

    $item_query = "SELECT concat(item_name,'-', item_condition) as item_name, qty FROM asset_record WHERE item_category = '$category' and qty > 0 order by qty desc";
    $item_result = $con->query($item_query);

    if ($item_result->num_rows > 0) {
        $html = '<ul class="item-list">';
        while ($row = $item_result->fetch_assoc()) {
            $html .= '<li>' . $row["item_name"] . ' - Qty: ' . $row["qty"] . '</li>';
        }
        $html .= '</ul>';
        echo $html;
    } else {
        echo "No items found in this category.";
    }
}


if (isset($_POST['category_loan'])) {
    $category_loan = $_POST['category_loan'];

    $item_query = "SELECT concat(item_name,'-', item_condition) as item_name, SUM(qty) AS total_qty FROM asset_loan_v WHERE item_category = '$category_loan' AND qty > 0 GROUP BY item_name ORDER BY total_qty DESC";
    $item_result = $con->query($item_query);

    if ($item_result->num_rows > 0) {
        $html = '<ul class="item-list_loan">';
        while ($row = $item_result->fetch_assoc()) {
            $html .= '<li>' . $row["item_name"] . ' - Qty: ' . $row["total_qty"] . '</li>';
        }
        $html .= '</ul>';
        echo $html;
    } else {
        echo "No items found in this category.";
    }
}
