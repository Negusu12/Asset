<?php
include("connect.php");

if (isset($_POST['category_total'])) {
    $category_total = $_POST['category_total'];

    // Your SQL query to fetch items by category goes here
    // Make sure to modify it to fetch the required data

    $item_query = "SELECT 
                        item_code,
                        CONCAT(item_name, IFNULL(CONCAT(' - ', brand), ''), IFNULL(CONCAT(' - ', model), '')) AS item_name, 
                        SUM(total_qty) AS total_qty
                    FROM 
                        total_item_qty_view 
                    WHERE 
                        item_category = '$category_total' 
                    GROUP BY 
                        item_code, item_name, brand, model 
                    ORDER BY 
                        total_qty DESC";

    $item_result = $con->query($item_query);

    if ($item_result->num_rows > 0) {
        $html = '<ul class="item-list_total">';
        while ($row = $item_result->fetch_assoc()) {
            echo '<li><i class="fas fa-circle" style="color: #414142;"></i> <a class="item-link" item_name="' . urlencode($row["item_name"]) . '" item_code="' . $row["item_code"] . '">' . $row["item_name"] . ' - Total Qty: ' . $row["total_qty"] . '</a><ul class="item-details_total" style="display:none;"></ul></li>';
        }
        echo '</ul>';
    } else {
        echo "No items found in this category.";
    }
}
?>

<script>
    $(document).on("click", ".item-link", function() {
        var item_name = $(this).attr('item_name');
        var item_code = $(this).attr('item_code'); // Retrieve the item code
        var itemDetails = $(this).next('.item-details_total');

        if (itemDetails.is(':visible')) {
            itemDetails.hide(); // Hide the item details if it's visible
        } else {
            $.ajax({
                url: "get_item_details.php",
                method: "POST",
                data: {
                    item_code: item_code // Send item code instead of item name
                },
                success: function(data) {
                    itemDetails.html(data).show(); // Show and populate the item details
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>