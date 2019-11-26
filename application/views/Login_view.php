	<!-- Body main wrapper start -->
	<div class="wrapper bg-white">
		<form class="col-md-4 card py-3 px-5 m-3 mx-auto shadow-lg" action="<?php echo base_url('admin/auth');?>" method="post">
			<h4 class="text-center title">Đăng nhập hệ thống</h4>

				<?php 
					if ($this->session->flashdata('msg'))
					{
						?>
							<div class="alert alert-danger" role="alert">
								<?php echo $this->session->flashdata('msg'); ?>
							</div>
						<?php
					}
					if ($this->session->flashdata('msgs'))
					{
						?>
							<div class="alert alert-success" role="alert">
								<?php echo $this->session->flashdata('msgs'); ?>
							</div>
						<?php
					}
				?>
			<!-- modal alert proccessing -->
			<div class="modal fade" id="alertPModal" role="dialog" aria-modal="true"">
			    <div class="modal-dialog modal-dialog-centered">
			    
			      <!-- Modal content-->
			      <div class="modal-content" style="font-family: 'Montserrat', sans-serif;">
			        
			        <div class="modal-body py-1 px-2 text-center">
			        	<div class="oldA">
				          <button class="btn" type="button" disabled="">
						  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
						  <span class="dxl">Đang xử lí...</span>
			        	</div>
					  <span class="text-success py-2"></span>
					  <span class="text-danger py-2"></span>
					</button>
			        </div>
			        
			      </div>
			      
			    </div>
			</div>
			<!-- end modal alert proccessing -->
			<div class="form-group">
				<label for="email">Địa chỉ Email &nbsp;</label><label class="wE text-danger"></label>
				<input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" name="email" required autofocus>
			</div>
			<div class="form-group">
				<label for="password">Mật khẩu</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
			</div>
			<span class="mb-3 forget">Quên mật khẩu?</span>
			<button type="submit" class="btn btn-primary btn-login">Đăng nhập</button>
			</form>
	</div>
