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
                                <th>#</th>
                                <th scope="col">Return ID</th>
                                <th scope="col">loan ID</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Model</th>
                                <th scope="col">Serial No</th>
                                <th scope="col">Category</th>
                                <th scope="col">Type</th>
                                <th scope="col">Borrower Name</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">loaned Date</th>
                                <th scope="col">Return Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Prepared By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $con->query("select * from asset_return_v order by return_id desc");
                            while ($row = $qry->fetch_assoc()) :
                            ?>
                                <tr>
                                    <th class="text-center"><?php echo $i++ ?></th>
                                    <td><b><?php echo $row['return_id'] ?></b></td>
                                    <td><b><?php echo $row['loan_id'] ?></b></td>
                                    <td><b><?php echo ucwords($row['item_name']) ?></b></td>
                                    <td><b><?php echo $row['brand'] ?></b></td>
                                    <td><b><?php echo $row['model'] ?></b></td>
                                    <td><b><?php echo $row['serial_no'] ?></b></td>
                                    <td><b><?php echo $row['item_category'] ?></b></td>
                                    <td><b><?php echo $row['item_type'] ?></b></td>
                                    <td><b><?php echo $row['full_name'] ?></b></td>
                                    <td><b><?php echo $row['uom'] ?></b></td>
                                    <td><b><?php echo $row['qty'] ?></b></td>
                                    <td><b><?php echo date('Y-m-d', strtotime($row['loned_date'])); ?></b></td>
                                    <td><b><?php echo date('Y-m-d', strtotime($row['return_date'])); ?></b></td>
                                    <td><b><?php echo $row['description'] ?></b></td>
                                    <td><b><?php echo $row['user_name'] ?></b></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
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
                    targets: [1, 7], // index of the "Password" column (zero-based index)
                    visible: false // set to false to hide the column by default
                }
                // Add similar blocks for other columns you want to hide by default
            ]
        });

        // Function to add filter inputs dynamically
        function addFilterInputs() {
            $('#mydatatable thead th').each(function(index) {
                var columnTitle = $(this).text().trim();
                var that = table.column(index);

                if ($(this).find('input').length === 0) { // Avoid duplicating inputs
                    if (columnTitle === 'Return Date' || columnTitle === 'loaned Date') {
                        var dateFilterHtml =
                            '<input type="text" id="min' + columnTitle.replace(/\s+/g, '') + '" class="form-control datepicker" placeholder="From Date" style="margin-bottom:5px;"/>' +
                            '<input type="text" id="max' + columnTitle.replace(/\s+/g, '') + '" class="form-control datepicker" placeholder="To Date"/>';
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
                }
            });
        }

        // Add initial filter inputs
        addFilterInputs();

        // Custom filtering function for date range
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var minReturnDate = $('#minReturnDate').val();
                var maxReturnDate = $('#maxReturnDate').val();
                var returnDate = data[13];

                var minLoanedDate = $('#minloanedDate').val();
                var maxLoanedDate = $('#maxloanedDate').val();
                var loanedDate = data[12];

                var returnDateValue = new Date(returnDate);
                var loanedDateValue = new Date(loanedDate);

                // Filter for Return Date
                if ((minReturnDate === "" || minReturnDate === null) && (maxReturnDate === "" || maxReturnDate === null)) {
                    // No filtering if both min and max are empty
                } else if ((minReturnDate === "" || minReturnDate === null) && returnDateValue <= new Date(maxReturnDate)) {
                    return true; // Only max filter
                } else if (minReturnDate && !maxReturnDate && returnDateValue.toDateString() === new Date(minReturnDate).toDateString()) {
                    return true; // Only min filter with exact date match
                } else if (returnDateValue >= new Date(minReturnDate) && returnDateValue <= new Date(maxReturnDate)) {
                    return true; // Within the range
                } else {
                    return false; // Outside the range or conditions not met
                }


                // Filter for Loaned Date -  Same logic as Return Date
                if ((minLoanedDate === "" || minLoanedDate === null) && (maxLoanedDate === "" || maxLoanedDate === null)) {
                    // No filtering if both min and max are empty
                } else if ((minLoanedDate === "" || minLoanedDate === null) && loanedDateValue <= new Date(maxLoanedDate)) {
                    return true; // Only max filter
                } else if (minLoanedDate && !maxLoanedDate && loanedDateValue.toDateString() === new Date(minLoanedDate).toDateString()) {
                    return true; // Only min filter with exact date match
                } else if (loanedDateValue >= new Date(minLoanedDate) && loanedDateValue <= new Date(maxLoanedDate)) {
                    return true; // Within the range
                } else {
                    return false; // Outside the range or conditions not met
                }

                return true; // Return true only if BOTH date filters pass
            }
        );
        // Append buttons container
        table.buttons().container()
            .appendTo('#mydatatable_wrapper .col-md-6:eq(0)');

        // Handle column visibility toggling
        table.on('column-visibility', function(e, settings, column, state) {
            if (state) { // Column is now visible
                addFilterInputs(); // Re-add filter inputs
            }
        });
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