<div class="wrapperr">
    <div class="container-fluidd">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table tabe-hover table-bordered mydatatable" id="mydatatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Use ID</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Model</th>
                                <th scope="col">Item Category</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Document Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Prepared By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $con->query("select * from used_asset_report order by u_asset desc");
                            while ($row = $qry->fetch_assoc()) :
                            ?>
                                <tr>
                                    <th class="text-center"><?php echo $i++ ?></th>
                                    <td><b><?php echo $row['u_asset'] ?></b></td>
                                    <td><b><?php echo ucwords($row['item_name']) ?></b></td>
                                    <td><b><?php echo $row['brand'] ?></b></td>
                                    <td><b><?php echo $row['model'] ?></b></td>
                                    <td><b><?php echo $row['item_category'] ?></b></td>
                                    <td><b><?php echo $row['uom'] ?></b></td>
                                    <td><b><?php echo $row['qty'] ?></b></td>
                                    <td><b><?php echo date('Y-m-d', strtotime($row['doc_date'])); ?></b></td>
                                    <td><b><?php echo $row['description'] ?></b></td>
                                    <td><b><?php echo $row['user_name'] ?></b></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" class="text-right">Total Quantity:</th>
                                <th id="totalQuantity"></th>
                                <th colspan="3"></th>
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
            ]
        });

        // Add Date Range Filtering Inputs
        $('#mydatatable thead th').each(function() {
            var columnTitle = $(this).text().trim();
            var that = table.column($(this).index());

            // Check if the column title matches 'Date'
            if (columnTitle === 'Document Date') {
                var dateFilterHtml = `
                <input type="text" id="minDate" class="form-control datepicker" placeholder="From Date" style="margin-bottom:5px;"/>
                <input type="text" id="maxDate" class="form-control datepicker" placeholder="To Date"/>
            `;
                $(this).append(dateFilterHtml);

                // Initialize jQuery UI Datepicker on both inputs
                $(".datepicker").datepicker({
                    dateFormat: 'yy-mm-dd', // Set the format to match your database format
                    onSelect: function() {
                        table.draw();
                    }
                });
            } else {
                // Create a regular text input element for other columns
                $('<input type="text" class="form-control" placeholder="Filter"/>')
                    .appendTo($(this))
                    .on('keyup change', function() {
                        that.search($(this).val()).draw();
                    });
            }
        });

        // Custom filtering function for date range
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#minDate').val();
                var max = $('#maxDate').val();
                var date = data[8]; // Assuming the date column index is 3

                if (min && new Date(min).toString() === "Invalid Date") {
                    min = null;
                }
                if (max && new Date(max).toString() === "Invalid Date") {
                    max = null;
                }

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

                    input = $('<input type="text" class="form-control" placeholder="Filter"/>')
                        .appendTo($(this.header()))
                        .on('keyup change', function() {
                            that.search($(this).val()).draw();
                        });
                }
            });

        table.buttons().container()
            .appendTo('#mydatatable_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    // Calculate and display total quantity
    function calculateTotalQuantity() {
        var totalQuantity = 0;
        $('#mydatatable tbody tr').each(function() {
            var qty = parseFloat($(this).find('td:eq(6)').text().trim()); // 5th column (index starts from 0)
            if (!isNaN(qty)) {
                totalQuantity += qty;
            }
        });
        $('#totalQuantity').text(totalQuantity);
    }

    calculateTotalQuantity(); // Initial calculation

    $('#mydatatable').on('draw.dt', function() {
        calculateTotalQuantity(); // Recalculate total quantity when the DataTable is redrawn (e.g., page change)
    });
</script>