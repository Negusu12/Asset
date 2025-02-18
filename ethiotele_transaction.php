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
                        <div id="item-rows">
                            <div class="item-row">
                                <!-- Form fields for sim_card_transactions_line -->
                                <div class="form-group">
                                    <label for="" class="control-label"><span style="color: red;">*</span> Charge</label>
                                    <select name="charge[]" id="charge" class="custom-select custom-select-sm select2" required>
                                        <option value=""></option>
                                        <?php
                                        $sql = "SELECT charge_id, charge FROM charges";
                                        $result = mysqli_query($con, $sql);
                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row["charge_id"] . "'>" . $row["charge"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label"><span style="color: red;">*</span> Owner</label>
                                    <select name="owner[]" id="owner" class="custom-select custom-select-sm select2" required>
                                        <option value="213">ABH Partners</option>
                                        <?php
                                        $sql = "SELECT employee_id, full_name FROM employee WHERE employee_id != 195 ORDER BY full_name";
                                        $result = mysqli_query($con, $sql);
                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row["employee_id"] . "'>" . $row["full_name"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number" class="control-label">Phone Number</label>
                                    <input type="text" name="phone_number[]" id="phone_number" class="form-control form-control-sm" pattern="^(\+2519\d{8}|09\d{8})$" title="Please enter a valid Ethiopian phone number">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label"><span style="color: red;">*</span> Payment Period</label>
                                    <select name="payment_period[]" class="custom-select custom-select-sm select2" onchange="toggleExpireDate(this)" required>
                                        <option value=""></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Yearly">Yearly</option>
                                    </select>
                                </div>
                                <div class="form-group" id="expire-date-group" style="display: none;">
                                    <label for="" class="control-label">Expire Date</label>
                                    <input type="date" name="expire_date[]" id="expire_date" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label"><span style="color: red;">*</span> Payment Type</label>
                                    <select name="payment_type[]" class="custom-select custom-select-sm select2" required>
                                        <option value=""></option>
                                        <option value="Post Paid">Post Paid</option>
                                        <option value="Pre Paid">Pre Paid</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Line Description</label>
                                    <textarea name="description_line[]" cols="30" rows="4" class="form-control"></textarea>
                                </div>
                                <button type="button" class="btn btn-danger" onclick="removeItemRow(this)">Remove</button>
                                <hr>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" onclick="addItemRow()">Add Item</button>

                        <button type="button" class="btn btn-primary" onclick="copyItemRow()">Copy Item</button>
                    </div>
                    <div class="col-md-6">
                        <br />
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Borrower Name</label>
                            <select name="current_holder" class="custom-select custom-select-sm select2" required>
                                <option value=""></option>
                                <?php
                                $sql = "SELECT employee_id, full_name FROM employee WHERE employee_id != 195 ORDER BY full_name";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["employee_id"] . "'>" . $row["full_name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label"><span style="color: red;">*</span> Given Date</label>
                            <input type="date" name="given_date" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="description" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-lg-12 text-right">
                    <button class="btn btn-primary" type="submit" name="submit_transaction">Save</button>
                    <button class="btn btn-secondary" type="reset">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const today = new Date().toISOString().split('T')[0];

        document.getElementById('given_date').value = today; // Default to today's date
    });
</script>
<script>
    function toggleExpireDate(selectElement) {
        const itemRow = selectElement.closest('.item-row');
        const expireDateGroup = itemRow.querySelector('.form-group#expire-date-group');
        if (selectElement.value === 'Yearly') {
            expireDateGroup.style.display = 'block';
        } else {
            expireDateGroup.style.display = 'none';
        }
    }
</script>
<script>
    function addItemRow() {
        var itemRow = document.querySelector('.item-row');
        var newItemRow = itemRow.cloneNode(true);

        // Reset the values
        newItemRow.querySelectorAll('input').forEach(input => input.value = '');
        newItemRow.querySelectorAll('textarea').forEach(textarea => textarea.value = '');
        newItemRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

        // Remove existing Select2 container
        $(newItemRow).find('.select2-container').remove();

        // Append the new row and reinitialize Select2
        document.getElementById('item-rows').appendChild(newItemRow);
        initializeSelect2(newItemRow);

        // Add event listener for new dropdown
        newItemRow.querySelector('select[name="payment_period[]"]').setAttribute('onchange', 'toggleExpireDate(this)');
    }


    function removeItemRow(button) {
        var itemRow = button.closest('.item-row');
        if (document.querySelectorAll('.item-row').length > 1) {
            itemRow.remove();
        } else {
            alert('At least one item row is required.');
        }
    }

    function copyItemRow() {
        var itemRows = document.querySelectorAll('.item-row');
        if (itemRows.length === 0) {
            alert('No item to copy.');
            return;
        }

        // Get the last item row
        var lastItemRow = itemRows[itemRows.length - 1];
        var newItemRow = lastItemRow.cloneNode(true); // Clone the last row with its data

        // Handle select boxes explicitly
        newItemRow.querySelectorAll('select').forEach(function(select, index) {
            var originalSelect = lastItemRow.querySelectorAll('select')[index];
            select.value = originalSelect.value; // Copy the selected value
        });

        // Remove existing Select2 container in the cloned row
        $(newItemRow).find('.select2-container').remove();

        // Append the cloned row
        document.getElementById('item-rows').appendChild(newItemRow);

        // Reinitialize Select2 for the new row
        initializeSelect2(newItemRow);

        // Add event listener for dropdown changes
        newItemRow.querySelector('select[name="payment_period[]"]').setAttribute('onchange', 'toggleExpireDate(this)');
    }



    function initializeSelect2(container) {
        $(container).find('.select2').each(function() {
            $(this).select2({
                width: '100%' // Ensure the select2 dropdown takes 100% width of its parent
            });
        });
    }

    $(document).ready(function() {
        initializeSelect2(document);

        // Use event delegation for dynamically added rows
        $('#item-rows').on('click', '.btn-success', function() {
            addItemRow();
        });

        $('#item-rows').on('click', '.btn-danger', function() {
            removeItemRow(this);
        });

        // Initialize select2 on page load
        $('.select2').select2({
            width: '100%' // Ensure the select2 dropdown takes 100% width of its parent
        });
    });
</script>