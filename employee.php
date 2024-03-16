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
                        <b class="text-muted">Register Loaner</b>
                        <div class="form-group">
                            <label for="" class="control-label">Loaner Name</label>
                            <input type="text" name="full_name" class="form-control form-control-sm" oninvalid="this.setCustomValidity('Enter Loaner Name Here')" oninput="setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br />
                        <div class="form-group">
                            <label for="" class="control-label">Department</label>
                            <select name="department" id="department" class="custom-select custom-select-sm select2" required>
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