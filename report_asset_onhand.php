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
					$qry = $con->query("select * from asset_record");
					while ($row = $qry->fetch_assoc()) :
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
			buttons: ['excel', 'pdf', 'colvis'],
			pagingType: 'full_numbers',
			lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
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