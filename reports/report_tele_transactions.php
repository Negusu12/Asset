<div class="wrapperr">
	<div class="container-fluidd">
		<div class="navigation_arrow">
			<button class="navigation-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
			<button class="navigation-btn" onclick="goForward()"><i class="fas fa-arrow-right"></i></button>
		</div>
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-hover table-bordered mydatatable" id="mydatatable">
						<thead>
							<tr>
								<th>#</th>
								<th>Transaction ID</th>
								<th>Current Holder</th>
								<th>Date</th>
								<th>Status</th>
								<th>Description</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// Replace with your DB connection
							include 'connect.php';

							$status = isset($_GET['status']) ? $_GET['status'] : '';
							$sql = "SELECT
st.transaction_id,
e.full_name AS current_holder,
st.given_date,
st.status,
st.description
from sim_card_transactions st
LEFT JOIN employee e ON st.current_holder = e.employee_id";

							// Append condition for payment_type if specified
							if ($status === 'Loaned') {
								$sql .= " WHERE st.status = 'Loaned'";
							}

							$sql .= " ORDER BY st.transaction_id DESC";
							$result = mysqli_query($con, $sql);
							$i = 1;

							if ($result) {
								while ($row = mysqli_fetch_assoc($result)) :
							?>
									<tr>
										<th class="text-center"><?php echo $i++; ?></th>
										<td><b><?php echo $row['transaction_id']; ?></b></td>
										<td><b><?php echo $row['current_holder']; ?></b></td>
										<td><b><?php echo date('Y-m-d', strtotime($row['given_date'])); ?></b></td>
										<td><b><?php echo $row['status']; ?></b></td>
										<td><b><?php echo $row['description']; ?></b></td>
										<td class='text-center'>
											<div class='btn-group'>
												<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='true'>Action <span class='caret'></span></button>
												<ul class='dropdown-menu'>
													<li><button class='dropdown-item' onclick='viewDetails(<?php echo $row['transaction_id']; ?>)'>View Details</button></li>
													<li class='dropdown-divider'></li>
													<li><a class='dropdown-item' href='print/print_dilivary_order.php?transaction_id=<?php echo $row['transaction_id']; ?>' target='_blank'>Print Delivery Form</a></li>
													<?php if ($row['payment_type'] === 'Credit') : ?>
														<li class='dropdown-divider'></li>
														<li><button class='dropdown-item' onclick='markFullyPaid(<?php echo $row['transaction_id']; ?>)'>Fully Paid</button></li>
													<?php endif; ?>
													<?php if (in_array($user_data['role'], [3])) : ?>
														<li class='dropdown-divider'></li>
														<li><button class='dropdown-item text-danger' onclick='deleteRecord(<?php echo $row['transaction_id']; ?>)'>Delete</button></li>
													<?php endif; ?>
												</ul>
											</div>
										</td>

									</tr>
							<?php
								endwhile;
							}
							?>
						</tbody>
					</table>




				</div>
			</div>

			<!-- Modal for viewing details -->
			<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="detailsModalLabel">Sales Details</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="table-responsivee">
								<table class="table tabe-hover table-bordered mydatatable" id="mydatatable">
									<thead>
										<tr>
											<th>transaction_id Line</th>
											<th>charge</th>
											<th>owner</th>
											<th>phone_number</th>
											<th>payment_period</th>
											<th>expire_date</th>
											<th>taken_date</th>
											<th>payment_type</th>
											<th>status</th>
											<th>description_line</th>
										</tr>
									</thead>
									<tbody id="detailsTableBody">
										<!-- Details will be loaded here using AJAX -->
									</tbody>
								</table>
							</div>
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
					if (columnTitle === 'Date') {
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
						var date = data[3]; // Assuming the date column index is 3

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

			function viewDetails(transaction_id) {
				$.ajax({
					url: 'backend/fetch_item_details.php',
					method: 'POST',
					data: {
						transaction_id: transaction_id
					},
					success: function(response) {
						$('#detailsTableBody').html(response);
						$('#detailsModal').modal('show');
					}
				});
			}
		</script>
		<script>
			function markFullyPaid(salesId) {
				// Display a confirmation message using SweetAlert
				Swal.fire({
					icon: 'question',
					title: 'Are you sure you want to mark this as Fully Paid?',
					showCancelButton: true,
					confirmButtonText: 'Yes',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: 'update/mark_fully_paid.php',
							type: 'POST',
							data: {
								transaction_id: salesId
							},
							success: function(response) {
								if (response == 'success') {
									// Display a success message using SweetAlert
									Swal.fire({
										icon: 'success',
										title: 'Payment type updated to Fully Paid.',
										showConfirmButton: true,
										confirmButtonText: 'OK',
										timer: 2000
									}).then(function() {
										window.location.href = 'index.php?page=reports/report_use';
									});
								} else {
									// Display an error message using SweetAlert
									Swal.fire({
										icon: 'error',
										title: 'Failed to update Payment Type.',
										showConfirmButton: false,
										showDenyButton: true,
										denyButtonText: 'OK'
									});
								}
							}
						});
					}
				});
			}
		</script>
		<script>
			function deleteRecord(salesId) {
				// Confirm deletion with SweetAlert
				Swal.fire({
					icon: 'warning',
					title: 'Are you sure you want to delete this record?',
					text: "This action cannot be undone!",
					showCancelButton: true,
					confirmButtonText: 'Yes, delete it!',
					cancelButtonText: 'No, keep it',
					dangerMode: true,
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: 'backend/delete_sales_record.php', // PHP script to handle the delete action
							type: 'POST',
							data: {
								transaction_id: salesId
							},
							success: function(response) {
								if (response === 'success') {
									// Show success message
									Swal.fire({
										icon: 'success',
										title: 'Record deleted successfully.',
										showConfirmButton: false,
										timer: 2000
									}).then(function() {
										// Reload the page to reflect changes
										location.reload();
									});
								} else {
									// Show error message
									Swal.fire({
										icon: 'error',
										title: 'Failed to delete the record.',
										showConfirmButton: false,
										showDenyButton: true,
										denyButtonText: 'OK'
									});
								}
							}
						});
					}
				});
			}
		</script>