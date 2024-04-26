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
                                        <a class="dropdown-item" style="cursor: pointer;" onclick="viewItem('<?php echo $row['item_code']; ?>')">View</a>

                                    </div>
                                </td>

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
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
    <script>
        function viewItem(itemCode) {
            fetch('item_detail_card.php?item_code=' + itemCode)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Change to text() to receive plain text response
                })
                .then(data => {
                    // Display the plain text response directly
                    Swal.fire({
                        title: 'Item Details',
                        html: data // Display the plain text response
                    });
                })
                .catch(error => {
                    console.error('Error fetching item details:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to fetch item details. Please try again later.',
                        icon: 'error'
                    });
                });
        }
    </script>
<?php
} else {
    // Redirect or handle error if item code is not provided
}
?>