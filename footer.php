<!-- SweetAlert2 -->
<script src="assets/dist/js/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="assets/plugins/toastr/toastr.min.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="assets/dist/js/js.js"></script>
<script>
	$(document).ready(function() {
		// $('.datetimepicker').datetimepicker({
		//     format:'Y/m/d H:i',
		//     startDate: '+3d'
		// })

		$('.select2').select2({
			placeholder: "Please select here",
			width: "100%"
		})
	})
	window.start_load = function() {
		$('body').prepend('<div id="preloader2"></div>')
	}
	window.end_load = function() {
		$('#preloader2').fadeOut('fast', function() {
			$(this).remove();
		})
	}
	window.viewer_modal = function($src = '') {
		start_load()
		var t = $src.split('.')
		t = t[1]
		if (t == 'mp4') {
			var view = $("<video src='" + $src + "' controls autoplay></video>")
		} else {
			var view = $("<img src='" + $src + "' />")
		}
		$('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
		$('#viewer_modal .modal-content').append(view)
		$('#viewer_modal').modal({
			show: true,
			backdrop: 'static',
			keyboard: false,
			focus: true
		})
		end_load()

	}
	window.uni_modal = function($title = '', $url = '', $size = "") {
		start_load()
		$.ajax({
			url: $url,
			error: err => {
				console.log()
				alert("An error occured")
			},
			success: function(resp) {
				if (resp) {
					$('#uni_modal .modal-title').html($title)
					$('#uni_modal .modal-body').html(resp)
					if ($size != '') {
						$('#uni_modal .modal-dialog').addClass($size)
					} else {
						$('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
					}
					$('#uni_modal').modal({
						show: true,
						backdrop: 'static',
						keyboard: false,
						focus: true
					})
					end_load()
				}
			}
		})
	}
	window._conf = function($msg = '', $func = '', $params = []) {
		$('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
		$('#confirm_modal .modal-body').html($msg)
		$('#confirm_modal').modal('show')
	}
	var Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 5000
	});
	window.alert_toast = function($msg = 'TEST', $bg = 'success') {
		//   $('#alert_toast').removeClass('bg-success')
		//   $('#alert_toast').removeClass('bg-danger')
		//   $('#alert_toast').removeClass('bg-info')
		//   $('#alert_toast').removeClass('bg-warning')

		// if($bg == 'success')
		//   $('#alert_toast').addClass('bg-success')
		// if($bg == 'danger')
		//   $('#alert_toast').addClass('bg-danger')
		// if($bg == 'info')
		//   $('#alert_toast').addClass('bg-info')
		// if($bg == 'warning')
		//   $('#alert_toast').addClass('bg-warning')
		// $('#alert_toast .toast-body').html($msg)
		// $('#alert_toast').toast({delay:3000}).toast('show');
		console.log('TEST')
		Toast.fire({
			icon: $bg,
			title: $msg
		})
	}
	$(function() {
		$('.summernote').summernote({
			height: 300,
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
				['fontname', ['fontname']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ol', 'ul', 'paragraph', 'height']],
				['table', ['table']],
				['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
			]
		})

	})

	// Go back and forward to page
	function goBack() {
		window.history.back();
	}

	function goForward() {
		window.history.forward();
	}
	// Go back and forward to page


	// make image open when clicked
	function openImageModal(imageData) {
		// Set the source of the full-size image in the modal
		document.getElementById('previewImage').src =
			'data:image/jpeg;base64,' + imageData

		// Open the modal
		$('#imageModal').modal('show')
	}
	// End make image open when clicked
</script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>

<!-- PAGE assets/plugins -->
<!-- jQuery Mapael -->
<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard2.js"></script>
<!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="assets/plugins/ckeditor/ckeditor.js"></script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		document.querySelectorAll('#description, #description1, #description2, #description3, #description4, #description5').forEach(element => {
			ClassicEditor
				.create(element)
				.then(editor => {
					console.log(editor);
				})
				.catch(error => {
					console.error(error);
				});
		});
	});
</script>


<script>
	document.querySelectorAll('.priceFormat').forEach(function(element) {
		element.addEventListener('input', function(e) {
			let value = e.target.value;

			// Remove any non-digit characters, except the decimal point
			let rawValue = value.replace(/[^0-9.]/g, '');

			// Split the value on the decimal point
			const parts = rawValue.split('.');
			// Format the integer part with commas
			parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');

			// Join the parts back together for display
			e.target.value = parts.join('.');

			// Update the underlying hidden input with the raw value
			if (element.name === 'projected_sales') {
				document.getElementById('projected_sales_raw').value = rawValue;
			} else if (element.name === 'price') {
				document.getElementById('price_raw').value = rawValue;
			} else if (element.name === 'wholesale_price') {
				document.getElementById('wholesale_price_raw').value = rawValue;
			}
		});
	});
</script>