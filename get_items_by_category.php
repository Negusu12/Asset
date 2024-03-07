<?php
include("connect.php");

if (isset($_POST['category'])) {
    $category = $_POST['category'];

    $item_query = "SELECT item_name, qty FROM asset_record WHERE item_category = '$category' and qty > 0";
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
