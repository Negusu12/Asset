<?php
include 'backend/insert.php';
include("connect.php");

$user_data = check_login($con);
?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 border-right">
                        <b class="text-muted">Asset Register</b>
                        <div class="form-group">
                            <label for="" class="control-label">Item Code</label>
                            <input type="text" name="item_c" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Item Name</label>
                            <input type="text" name="item_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Brand</label>
                            <input type="text" name="brand" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Model</label>
                            <input type="text" name="model" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Item Type</label>
                            <select name="item_type" id="item_type" class="custom-select custom-select-sm select2" required>
                                <option value=""></option>
                                <option value="asset">Asset</option>
                                <option value="consumable">Consumable</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Item Category</label>
                            <select name="item_category" id="item_category" class="custom-select custom-select-sm select2" required>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT list_id, category FROM drop_down_list WHERE category IS NOT NULL AND category <> ''";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["category"] . "'>" . $row["category"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br />
                        <div class="form-group">
                            <label for="" class="control-label">UOM</label>
                            <select name="uom" id="uom" class="custom-select custom-select-sm select2" required>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT list_id, uom FROM drop_down_list WHERE uom IS NOT NULL AND uom <> ''";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["uom"] . "'>" . $row["uom"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label class="control-label">Quantity</label>
                            <input type="number" class="form-control form-control-sm" name="qty" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Date</label>
                            <input type="date" name="doc_date" id="doc_date" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
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
                    <button class="btn btn-primary mr-2" type="submit" name="submit">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>