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
                            <input type="text" name="department" class="form-control form-control-sm" id="department">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Category</label>
                            <input type="text" name="category" class="form-control form-control-sm" id="category">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">UOM</label>
                            <input type="text" name="uom" class="form-control form-control-sm" id="uom">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Location</label>
                            <input type="text" name="location" class="form-control form-control-sm" id="location">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[type="text"]');

        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    inputs.forEach(otherInput => {
                        if (otherInput !== this) {
                            otherInput.disabled = true;
                        }
                    });
                } else {
                    let allEmpty = true;
                    inputs.forEach(otherInput => {
                        if (otherInput.value.trim() !== '') {
                            allEmpty = false;
                        }
                    });
                    if (allEmpty) {
                        inputs.forEach(otherInput => {
                            otherInput.disabled = false;
                        });
                    }
                }
            });
        });
    });
</script>