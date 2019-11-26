<div class="col-md-5 text-center mx-auto my-3">
	<h4>Xác thực đặt phòng</h4>
	<hr>
	<?php 
		if($this->session->flashdata('msg')){
			echo $this->session->flashdata('msg');
		} else {
			echo '<p class="alert-danger p-3">Thông tin đặt phòng của bạn không thể xác thực. Xin vui lòng liên hệ chúng tôi. Cảm ơn bạn đã sử dụng dịch vụ!</p>';
		}
	?>
	
</div>