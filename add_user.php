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
                        <b class="text-muted">Add User</b>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> User Name</label>
                            <input type="text" name="user_name" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter User Name Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Password</label>
                            <input type="password" name="password" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter User Name Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Role</label>
                            <select name="role" id="role" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Role Here')" oninput="setCustomValidity('')" required>
                                <option value="">Select a Role</option>
                                <option value="2">User</option>
                                <option value="1">Admin and User</option>
                                <option value="3">Super Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-left d-flex">
                    <button class="btn btn-primary mr-2" type="submit" name="submit_user">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>