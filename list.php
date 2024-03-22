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
                        <b class="text-muted">Add List Choice</b>
                        <div class="form-group">
                            <label for="" class="control-label">Department</label>
                            <input type="text" name="department" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Category</label>
                            <input type="text" name="category" class="form-control form-control-sm">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">UOM</label>
                            <input type="text" name="uom" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-left d-flex">
                    <button class="btn btn-primary mr-2" type="submit" name="submit_list">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>