<div class="wrapperr">
    <div class="container-fluidd">
        <div class="navigation_arrow">
            <button class="navigation-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
            <button class="navigation-btn" onclick="goForward()"><i class="fas fa-arrow-right"></i></button>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table tabe-hover table-bordered mydatatable" id="mydatatable">
                        <thead>
                            <tr>
                                <th>Row No.</th>
                                <th scope="col">Loan ID</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Model</th>
                                <th scope="col">Item Category</th>
                                <th scope="col">Item Condition</th>
                                <th scope="col">Item Type</th>
                                <th scope="col">Serial No.</th>
                                <th scope="col">Loaned To</th>
                                <th scope="col">Borrower Department</th>
                                <th scope="col">Location</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Loaned Quantity</th>
                                <th scope="col">Quantity on Loan</th>
                                <th scope="col">Document Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Prepared By</th>
                                <th scope="col">Print</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $con->query("select * from asset_loan_v where qty > 0 and department != 'damaged' order by loan_id desc");
                            while ($row = $qry->fetch_assoc()) {
                                $id = $row['loan_id'];
                            ?>
                                <tr>
                                    <th class="text-center"><?php echo $i++ ?></th>
                                    <td><b><?php echo $row['loan_id'] ?></b></td>
                                    <td><b><?php echo ucwords($row['item_name']) ?></b></td>
                                    <td><b><?php echo $row['brand'] ?></b></td>
                                    <td><b><?php echo $row['model'] ?></b></td>
                                    <td><b><?php echo $row['item_category'] ?></b></td>
                                    <td><b><?php echo $row['item_condition'] ?></b></td>
                                    <td><b><?php echo $row['item_type'] ?></b></td>
                                    <td><b><?php echo $row['serial_no'] ?></b></td>
                                    <td><b><?php echo $row['full_name'] ?></b></td>
                                    <td><b><?php echo $row['department'] ?></b></td>
                                    <td><b><?php echo $row['location'] ?></b></td>
                                    <td><b><?php echo $row['uom'] ?></b></td>
                                    <td><b><?php echo ucwords($row['qty_taken']) ?></b></td>
                                    <td><b><?php echo $row['qty'] ?></b></td>
                                    <td><b><?php echo date('Y-m-d', strtotime($row['doc_date'])); ?></b></td>
                                    <td><b><?php echo $row['description'] ?></b></td>
                                    <td><b><?php echo $row['user_name'] ?></b></td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <?php if ($user_data['role'] == 1 || $user_data['role'] == 3) : ?>
                                                <a class="dropdown-item" href="./index.php?page=backend/edit_loan&loan_id=<?php echo $row['loan_id'] ?>">Edit</a>
                                                <div class="dropdown-divider"></div>
                                            <?php endif; ?>
                                            <a class="dropdown-item" href="print_loan.php?loan_id=<?php echo $row['loan_id'] ?>" target="_blank">Print</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="13" class="text-right">Total Quantity:</th>
                                <th id="loanedQuantity"></th>
                                <th id="onLoanQuantity"></th>
                                <th colspan="4"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Check if DataTable is already initialized
        var isDataTableInitialized = $.fn.DataTable.isDataTable('#mydatatable');

        // If DataTable is initialized, destroy it
        if (isDataTableInitialized) {
            $('#mydatatable').DataTable().destroy();
        }

        // Initialize DataTable
        var table = $('#mydatatable').DataTable({
            ordering: true,
            buttons: [{
                    extend: 'excel',
                    text: 'Export Excel',
                    exportOptions: {
                        columns: ':visible' // Export only visible columns
                    }
                },
                {
                    extend: 'pdf',
                    text: 'Export PDF',
                    orientation: 'landscape', // Set orientation to landscape
                    exportOptions: {
                        columns: ':visible' // Export only visible columns
                    }
                },
                'colvis'
            ],
            pagingType: 'full_numbers',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            columnDefs: [{
                targets: [0, 6, 7, 10, 11, 17], // indices of columns to hide by default
                visible: false
            }]
        });

        // Add filtering inputs
        $('#mydatatable thead th').each(function(index) {
            var columnTitle = $(this).text().trim();
            var that = table.column(index);

            if (columnTitle === 'Document Date') {
                var dateFilterHtml = `
                <input type="text" id="minDate" class="form-control datepicker" placeholder="From Date" style="margin-bottom:5px;"/>
                <input type="text" id="maxDate" class="form-control datepicker" placeholder="To Date"/>
            `;
                $(this).append(dateFilterHtml);

                // Initialize jQuery UI Datepicker
                $(".datepicker").datepicker({
                    dateFormat: 'yy-mm-dd', // Match your database format
                    onSelect: function() {
                        table.draw();
                    }
                });
            } else {
                // Regular filter input for other columns
                $('<input type="text" class="form-control" placeholder="Filter"/>')
                    .appendTo($(this))
                    .on('keyup change', function() {
                        // Correctly reference the visible column index
                        table.column($(this).parent().index() + ':visible').search($(this).val()).draw();
                    });
            }
        });

        // Custom filtering function for date range
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#minDate').val();
                var max = $('#maxDate').val();
                var date = data[15]; // Adjust this index based on the position in the data array, considering hidden columns

                // Convert string to date for comparison
                var dateValue = new Date(date);

                if ((min === "" || min === null) && (max === "" || max === null)) {
                    return true; // No filtering if both min and max are empty
                }
                if ((min === "" || min === null) && dateValue <= new Date(max)) {
                    return true; // Only max filter
                }
                if (min && !max && dateValue.toDateString() === new Date(min).toDateString()) {
                    return true; // Only min filter with exact date match
                }
                if (dateValue >= new Date(min) && dateValue <= new Date(max)) {
                    return true; // Within the range
                }
                return false; // Outside the range or conditions not met
            }
        );

        // Append buttons container
        table.buttons().container()
            .appendTo('#mydatatable_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to your delete script with the user ID
                window.location.href = 'delete_user.php?id=' + userId;
            }
        });
    }
</script>
<script>
    // Calculate and display total quantity
    function calculateLoanedQuantity() {
        var loanedQuantity = 0;
        $('#mydatatable tbody tr').each(function() {
            var qty_taken = parseFloat($(this).find('td:not(.hiddenColumn):eq(8)').text().trim());
            if (!isNaN(qty_taken)) {
                loanedQuantity += qty_taken;
            }
        });
        $('#loanedQuantity').text(loanedQuantity);
    }

    calculateLoanedQuantity(); // Initial calculation
    $('#mydatatable').on('draw.dt', function() {
        calculateLoanedQuantity(); // Recalculate total quantity when the DataTable is redrawn (e.g., page change)
    });

    function calculateOnLoanQuantity() {
        var onLoanQuantity = 0;
        $('#mydatatable tbody tr').each(function() {
            var qty = parseFloat($(this).find('td:not(.hiddenColumn):eq(9)').text().trim());
            if (!isNaN(qty)) {
                onLoanQuantity += qty;
            }
        });
        $('#onLoanQuantity').text(onLoanQuantity);
    }

    calculateOnLoanQuantity(); // Initial calculation

    $('#mydatatable').on('draw.dt', function() {
        calculateOnLoanQuantity(); // Recalculate total quantity when the DataTable is redrawn (e.g., page change)
    });
</script>