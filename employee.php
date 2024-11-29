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
                        <b class="text-muted">Register Borrower</b>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Borrower Title</label>
                            <select name="borrower_title" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select Title Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <option value="Mr.">Mr.</option>
                                <option value="Ms.">Ms.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Prof.">Prof.</option>
                                <option value="Eng.">Eng.</option>
                                <option value="Not a Person">Not a Person</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Borrower Name</label>
                            <input type="text" name="full_name" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter Borrower Name Here')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Department</label>
                            <select name="department" id="department" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Enter Department Name Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT list_id, department FROM drop_down_list WHERE department IS NOT NULL AND department <> '' order by department ";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["department"] . "'>" . $row["department"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Location</label>
                            <select name="list_id" id="list_id" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Enter Location Name Here')" oninput="setCustomValidity('')" required>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT list_id, location FROM drop_down_list WHERE location IS NOT NULL AND location <> '' order by location ";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["list_id"] . "'>" . $row["location"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                    <button class="btn btn-primary mr-2" type="submit" name="submit_e">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>