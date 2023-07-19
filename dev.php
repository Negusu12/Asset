<?php
include 'components/inset.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset/css/style.css">

</head>

<body>
    <section class="side-menu">
        <div class="top-sec">
            <p>Asset Management</p>
        </div>
        <ul class="menu-ul">
            <li id="asset_record">Asset Record</li>
            <li id="asset_loan">Asset Loan</li>
            <li id="asset_return">Asset Return</li>
            <li id="asset_detail">Asset detail</li>
        </ul>
    </section>
    <section class="asset_r active">
        <div class="title_h">
            <h1>Asset Record</h1>
        </div>
        <div class="form_i">
            <form method="post" enctype="multipart/form-data">
                <label for="" class="input_n">Item Code</label>
                <input type="text" placeholder="Enter Item Code" name="item_code" class="input_t">
                <label for="" class="input_n">Item Name</label>
                <input type="text" placeholder="Enter Item Name" name="item_name" class="input_t"> <br>
                <label for="" class="input_n">Quantity</label>
                <input type="number" placeholder="Enter Item Quantity" name="qty" class="input_t">
                <label for="" class="input_n">Document Date</label>
                <input type="date" name="doc_date" class="input_t"> <br>
                <label for="" class="input_n">Description</label>
                <input type="taxetarea" name="description" class="input_t"> <br>
                <button type="submit" class="button_s" name="submit" required>Send Message</button>
            </form>
        </div>
    </section>


    <script src="asset/js/js.js"></script>
    <script src="components/inset.js"></script>
</body>

</html>