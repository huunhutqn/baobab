
	
	<!-- Optional js -->
	<script src="<?= base_url() ?>js/jquery-3.4.1.min.js"></script>
	<script src="<?= base_url() ?>js/jquery.tablesorter.js"></script>
	<script src="<?= base_url() ?>js/jquery.tablesorter.widgets.js"></script>
	<script src="<?= base_url() ?>js/popper1.15.min.js"></script>
	<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>js/bootstrap.bundle.min.js"></script>
	<!-- <script src="<?= base_url() ?>js/js.js"></script> -->
	<script src="<?= base_url() ?>js/feather.min.js"></script>
	<script src="<?= base_url() ?>js/Chart.min.js"></script>
	<script src="<?= base_url() ?>js/dashboard.js"></script>
	<script src="<?= base_url() ?>js/file-upload-with-preview.min.js"></script>
	<script src="<?= base_url() ?>js/simple-lightbox.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.js"></script>
	<script src="<?= base_url() ?>js/moment.js"></script>
	<script src="<?= base_url() ?>js/moment.vi.js"></script>
	<script src="<?= base_url() ?>js/jquery.tablesorter.pager.js"></script>
	<script src="<?= base_url() ?>js/ad.js"></script>
	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.1/js/fileinput.js"></script> -->
	<script>
		$(document).ready(function() {
			// setTimeout(function(){
			// 	$('#preloader').addClass('d-none');
			// }, 3000);
			// $('[data-toggle="tooltip"]').tooltip({trigger: "hover active focus", delay: {show: 100, hide: 400}});
			var url = $(location).attr('href'),
		    parts = url.split("/"),
		    last_part = parts[parts.length-1];
		    // console.log(last_part);
		    $('.'+last_part).addClass('active');
			$('[data-toggle="tooltip"]').tooltip({trigger: "hover"});
			// $('[data-toggle="tooltip"]').on("mouseleave", function(){
			// 	$(this).tooltip("hide"); 
			// })
			<?php 
				if($this->session->flashdata('msg_room_add')){
					echo '$("#nav-room-add-tab").trigger("click");';
				}
				if($this->session->flashdata('msg_room_update')){
					echo '$("#msgModal").modal();';
				}
			?>

		});
	</script>
</body>
</html>