<?php
include 'backend/insert.php';
include("connect.php");

$user_data = check_login($con);
?>
<div class="navigation_arrow">
    <button class="navigation-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
    <button class="navigation-btn" onclick="goForward()"><i class="fas fa-arrow-right"></i></button>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 border-right">
                        <b class="text-muted">Record Adjustment</b>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Name</label>
                            <select name="item_code" id="item_code" class="custom-select custom-select-sm select2" onchange="updateAvailableQty()" oninvalid="this.setCustomValidity('Select Item Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php


                                // Retrieve all records from the asset_record table
                                $sql = "SELECT item_code, qty, CONCAT(item_name, IFNULL(CONCAT(' - ', brand, ' - ', model, ' - ', item_category), '')) AS Item_Name, uom FROM asset_record";
                                $result = mysqli_query($con, $sql);

                                // Check if query was successful
                                if ($result) {
                                    // Loop through each row of the result set and output the item_name value as an option in the select dropdown
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["item_code"] . "' data-qty='" . $row["qty"] . "' . data-uom='" . $row["uom"] . "'>" . $row["Item_Name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> UOM</label>
                            <input id="item_uom" type="text" class="form-control form-control-sm" disabled>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">&nbsp;&nbsp;&nbsp;Available QTY</label>
                            <input id="available_qty" type="text" class="form-control form-control-sm" disabled>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><span style="color: red;">*</span>Quantity to Subtract</label>
                            <input id="qty_to_subtract" type="number" class="form-control form-control-sm" name="qty_to_subtract" min="0" oninput="toggleAddQty(this.value)">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><span style="color: red;">*</span>Quantity to Add</label>
                            <input id="qty_to_add" type="number" class="form-control form-control-sm" name="qty_to_add" min="0" oninput="toggleSubtractQty(this.value)">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br />
                        <div class="form-group">
                            <label class="control-label">&nbsp;&nbsp;&nbsp;Description</label>
                            <textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group " style="display: none;">
                            <label class="control-label">Prepared By</label>
                            <input type="text" class="form-control form-control-sm" name="user_name" value="<?php echo $user_data['user_name']; ?>">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                    <button class="btn btn-primary mr-2" type="submit" name="submit_adj">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function updateAvailableQty() {
        var selectedItem = document.getElementById("item_code");
        var selectedOption = selectedItem.options[selectedItem.selectedIndex];
        var availableQtyInput = document.getElementById("available_qty");
        availableQtyInput.value = selectedOption.getAttribute("data-qty");
        var uomInput = document.getElementById("item_uom");
        uomInput.value = selectedOption.getAttribute("data-uom");
    }

    function toggleAddQty(subtractValue) {
        var addInput = document.getElementById("qty_to_add");
        addInput.disabled = subtractValue > 0;
        if (subtractValue > 0) {
            addInput.value = '';
        }
    }

    function toggleSubtractQty(addValue) {
        var subtractInput = document.getElementById("qty_to_subtract");
        subtractInput.disabled = addValue > 0;
        if (addValue > 0) {
            subtractInput.value = '';
        }
    }

    function resetForm() {
        document.getElementById("qty_to_add").disabled = false;
        document.getElementById("qty_to_subtract").disabled = false;
    }
</script>