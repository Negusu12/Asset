<?php
include("connect.php");

// Check if item code is provided in URL parameters
if (isset($_GET['item_code'])) {
    $item_code = $_GET['item_code'];

    // Your SQL query to fetch item records based on item code
    // Modify it according to your database structure
    $qry = $con->prepare("SELECT * FROM asset_record WHERE item_code = ?");
    $qry->bind_param("s", $item_code);
    $qry->execute();
    $result = $qry->get_result();

    // Display fetched records
?>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table class="table tabe-hover table-bordered mydatatable" id="mydatatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Item Code</th>
                            <th scope="col">Item Code</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Model</th>
                            <th scope="col">Item Category</th>
                            <th scope="col">Item Type</th>
                            <th scope="col">UOM</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Description</th>
                            <th scope="col">Item Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = $result->fetch_assoc()) :
                        ?>
                            <tr>
                                <th class="text-center"><?php echo $i++ ?></th>
                                <td><b><?php echo $row['item_code'] ?></b></td>
                                <td><b><?php echo $row['item_c'] ?></b></td>
                                <td><b><?php echo ucwords($row['item_name']) ?></b></td>
                                <td><b><?php echo $row['brand'] ?></b></td>
                                <td><b><?php echo $row['model'] ?></b></td>
                                <td><b><?php echo $row['item_category'] ?></b></td>
                                <td><b><?php echo $row['item_type'] ?></b></td>
                                <td><b><?php echo $row['uom'] ?></b></td>
                                <td><b><?php echo $row['qty'] ?></b></td>
                                <td><b><?php echo $row['description'] ?></b></td>
                                <td class="img_tbl">
                                    <?php
                                    $image_data = $row['item_image'];
                                    if (!empty($image_data)) {
                                        $base64_image = base64_encode($image_data);
                                        if ($base64_image) {
                                            echo '<img src="data:image/jpeg;base64,' . $base64_image . '" alt="Image" class="img-thumbnail" style="cursor: pointer;" onclick="openImageModal(\'' . $base64_image . '\')">';
                                        } else {
                                            echo '<p>Error: Unable to encode image data.</p>';
                                        }
                                    } else {
                                        echo '<p></p>';
                                    }
                                    ?>
                                </td>



                                <td class="text-center">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="./index.php?page=backend/edit_asset&item_code=<?php echo $row['item_code'] ?>">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="./index.php?page=backend/edit_image&item_code=<?php echo $row['item_code'] ?>">Change Image</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" style="cursor: pointer;" onclick="viewReport(<?php echo $row['item_code']; ?>)">View Item Information</a>
                                    </div>
                                </td>

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Item Information</h5>
                </div>
                <div class="modal-body">
                    <iframe id="reportIframe" src="" frameborder="0" style="width: 100%; height: 900px;" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>



    <script>
        function viewReport(itemCode) {
            console.log("Loan ID received in viewReport:", itemCode); // Debugging log

            // Check if the loanId is valid
            if (!itemCode || isNaN(itemCode)) {
                console.error("Invalid Loan ID:", itemCode);
                return;
            }

            // Generate the report URL
            const reportUrl = `report_design/view_item_info.php?item_code=${itemCode}`;
            console.log("Generated Report URL:", reportUrl); // Debugging log

            // Set the iframe source
            $('#reportIframe').attr('src', reportUrl);

            // Show the modal
            $('#reportModal').modal('show');
        }
    </script>
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
                        targets: [10], // index of the "Password" column (zero-based index)
                        visible: false // set to false to hide the column by default
                    }
                    // Add similar blocks for other columns you want to hide by default
                ]
            });
            table.columns().every(function() {
                var that = this;
                var columnTitle = $(this.header()).text().trim();

                // Create the input element based on the column title
                var input;
                {
                    // Create a regular text input element for other columns
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
<?php
} else {
    // Redirect or handle error if item code is not provided
}
?>