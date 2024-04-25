<?php
// Include necessary files and configurations
include("connect.php");

// Check if the 'item_code' parameter is set
if (isset($_GET['item_code'])) {
    // Sanitize the input
    $item_code = $_GET['item_code'];

    // Prepare and execute a query to fetch the item details
    $stmt = $con->prepare("SELECT * FROM asset_record WHERE item_code = ?");
    $stmt->bind_param("s", $item_code);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the item exists
    if ($result->num_rows > 0) {
        // Fetch the item details
        $item = $result->fetch_assoc();

        // Generate HTML content for item details
        $htmlContent = '<div class="item-details-form">';
        $htmlContent .= '<h2>Item Code: ' . $item['item_code'] . '</h2>';
        $htmlContent .= '<div class="form-row">';
        $htmlContent .= '<div class="form-column">';
        $htmlContent .= '<label for="item_code">Item Code:</label>';
        $htmlContent .= '<span>' . $item['item_c'] . '</span>';
        $htmlContent .= '</div>';
        $htmlContent .= '<div class="form-column">';
        $htmlContent .= '<label for="item_name">Item Name:</label>';
        $htmlContent .= '<span>' . $item['item_name'] . '</span>';
        $htmlContent .= '</div>';
        $htmlContent .= '</div>';

        $htmlContent .= '<div class="form-row">';
        $htmlContent .= '<div class="form-column">';
        $htmlContent .= '<label for="model">Model:</label>';
        $htmlContent .= '<span>' . $item['model'] . '</span>';
        $htmlContent .= '</div>';
        $htmlContent .= '<div class="form-column">';
        $htmlContent .= '<label for="brand">Brand:</label>';
        $htmlContent .= '<span>' . $item['brand'] . '</span>';
        $htmlContent .= '</div>';
        $htmlContent .= '</div>';


        $htmlContent .= '<div class="form-row">';
        $htmlContent .= '<div class="form-column">';
        $htmlContent .= '<label for="item_category">Item Category:</label>';
        $htmlContent .= '<span>' . $item['item_category'] . '</span>';
        $htmlContent .= '</div>';
        $htmlContent .= '<div class="form-column">';
        $htmlContent .= '<label for="item_type">Item Type:</label>';
        $htmlContent .= '<span>' . $item['item_type'] . '</span>';
        $htmlContent .= '</div>';
        $htmlContent .= '</div>';

        $htmlContent .= '<div class="form-row">';
        $htmlContent .= '<div class="form-column">';
        $htmlContent .= '<label for="uom">UOM:</label>';
        $htmlContent .= '<span>' . $item['uom'] . '</span>';
        $htmlContent .= '</div>';
        $htmlContent .= '<div class="form-column">';
        $htmlContent .= '<label for="qty">Quantity:</label>';
        $htmlContent .= '<span>' . $item['qty'] . '</span>';
        $htmlContent .= '</div>';
        $htmlContent .= '</div>';
        $htmlContent .= '<div class="form-row">';
        $htmlContent .= '<div class="form-column">';
        $htmlContent .= '<label for="description">Description:</label>';
        $htmlContent .= '<span>' . $item['description'] . '</span>';
        $htmlContent .= '</div>';
        $htmlContent .= '</div>';

        if ($item['item_image'] !== null) {
            $htmlContent .= '<div class="form-row">';
            $htmlContent .= '<div class="form-column">';
            $htmlContent .= '<label for="item_image">Item Image</label>';
            $htmlContent .= '</div>';
            $htmlContent .= '</div>';

            $htmlContent .= '<div class="form-row">';
            $htmlContent .= '</div>';
            $htmlContent .= '<div class="form-column">';
            $htmlContent .= '<img src="data:image/jpeg;base64,' . base64_encode($item['item_image']) . '" alt="Item Image" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">';
            $htmlContent .= '</div>';
        }

        $htmlContent .= '<button onclick="window.print()" class="btn btn-primary">Print</button>';

        // Close the div
        $htmlContent .= '</div>';

        // Output the HTML content
        echo $htmlContent;
    } else {
        // Item not found
        echo "Item not found.";
    }
} else {
    // 'item_code' parameter not set
    echo "Missing 'item_code' parameter.";
}
