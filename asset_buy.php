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
                        <b class="text-muted">Asset Buy</b>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Item Name</label>
                            <select name="item_code" id="item_code" class="custom-select custom-select-sm select1" oninvalid="this.setCustomValidity('Select Item Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                // Retrieve all records from the asset_record table
                                $sql = "SELECT ar.item_code,
                                CONCAT(ar.item_name,
                                IFNULL(CONCAT(' - ', ar.model), ''),IFNULL(CONCAT(' - ', ar.item_category), '')) AS Item_Name,
                                ar.uom,
                                ats.sum_qty
                                FROM asset_record ar
                               left join asset_total_summury_v ats on ats.item_code = ar.item_code order by Item_Name";
                                $result = mysqli_query($con, $sql);

                                // Check if query was successful
                                if ($result) {
                                    // Loop through each row of the result set and output the item_name value as an option in the select dropdown
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["item_code"] . "' data-uom='" . $row["uom"] . "' dataq-sum_qty='" . $row["sum_qty"] . "'>" . $row["Item_Name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> UOM</label>
                            <select name="uom" id="uom" class="custom-select custom-select-sm select2">
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Current QTY</label>
                            <select id="sum_qty" class="custom-select custom-select-sm select2" disabled>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><span style="color: red;">*</span> Additional Quantity</label>
                            <input type="number" class="form-control form-control-sm" name="qty" min="0" oninvalid="this.setCustomValidity('Enter Quantity Here')" oninput="setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br />
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Date</label>
                            <input type="date" name="doc_date" id="doc_date" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter Date Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">&nbsp;&nbsp;&nbsp;Description</label>
                            <textarea name="description" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="form-group " style="display: none;">
                            <label class="control-label">Prepared By</label>
                            <input type="text" class="form-control form-control-sm" name="user_name" value="<?php echo $user_data['user_name']; ?>">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                    <button class="btn btn-primary mr-2" type="submit" name="submit_b">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('item_code').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var uom = selectedOption.getAttribute('data-uom');
        var sum_qty = selectedOption.getAttribute('dataq-sum_qty');

        // Update UOM field using Select2
        $('#uom').html('<option value="' + uom + '">' + uom + '</option>').trigger('change');

        // Update Current QTY field using Select2
        $('#sum_qty').html('<option value="' + sum_qty + '">' + sum_qty + '</option>').trigger('change');
    });
</script>