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
                    <div class="col-md-6">
                        <b class="text-muted">Add Charge</b>
                        <div class="form-group">
                            <label class="control-label"><span style="color: red;">*</span>Charge</label>
                            <input type="text" name="charge" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><span style="color: red;">*</span>Price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="height: 80%;">$</span>
                                </div>
                                <input type="text" class="form-control form-control-sm priceFormat" name="price" required>
                                <input type="hidden" id="price_raw" name="price_raw">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Description</label>
                            <input type="text" name="description" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-left d-flex">
                    <button class="btn btn-primary mr-2" type="submit" name="submit_charge">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>