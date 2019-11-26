<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Trang quản lí Baobab Homestay Website</title>
	<link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>css/css.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>css/icofont.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>css/ad.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>css/dashboard.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>css/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>css/simplelightbox.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
	<style>
		.tablesorter-pager .btn-group-sm .btn {
		  font-size: 1.2em; /* make pager arrows more visible */
		}
	</style>
	<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.1/css/fileinput.css"> -->
</head>
<body>
	<!-- Pre loader -->
	<!-- <div id="preloader">
		<div id="loader"></div>
	</div> -->
	<!-- modal alert proccessing -->
	<div class="modal fade" id="alertPModal" role="dialog" aria-modal="true"">
	    <div class="modal-dialog modal-dialog-centered">
	    
	      <!-- Modal content-->
	      <div class="modal-content" style="font-family: 'Montserrat', sans-serif;">
	        
	        <div class="modal-body py-1 px-2 text-center">
	        	<div class="text-pro">
		          <button class="btn" type="button" disabled="">
				  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
				  Đang xử lí...
				  </button>
	        	</div>
	        	<p class="text-success"></p>
	        </div>
	        
	      </div>
	      
	    </div>
	</div>
	<!-- end modal alert proccessing -->
