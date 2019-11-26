				<!-- must -->
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2">Quản lí tài khoản</h1>
					</div>
				<!-- end must -->
					<?php foreach ($user_data as $value): ?>
					<div class="row">
						<div class="col-md-8 mx-auto">
							<form action="<?php echo base_url() ?>admin/changepwa" method="post">
								<div class="form-group row text-center">
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
								</div>
							  <div class="form-group row">
							    <label for="inputEmail3" class="col-sm-4 col-form-label">Email tài khoản</label>
							    <div class="col-sm-8">
							      <input type="email" class="form-control" readonly disabled value="<?= $value['user_email'] ?>">
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="inputEmail3" class="col-sm-4 col-form-label">Tên người sử dụng</label>
							    <div class="col-sm-8">
						    	<input type="hidden" name="iac" value="<?= $value['user_id'] ?>">
							      <input type="text" class="form-control" id="inputEmail3" placeholder="Tên tài khoản" value="<?= $value['user_name'] ?>">
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="inputPassword3" class="col-sm-4 col-form-label">Mật khẩu</label>
							    <div class="col-sm-8">
							      <input type="password" class="form-control" id="password" placeholder="*****">
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="inputPassword3" class="col-sm-4 col-form-label">Nhập lại mật khẩu</label>
							    <div class="col-sm-8">
							      <input type="password" class="form-control" id="rpassword" name="rpassword" placeholder="*****">
							    </div>
							  </div>
							  <div class="form-group row">
							    <div class="col-sm-10">
							     	<button type="submit" class="btn btn-primary btn-main-color" onclick="return validateMyForm();">Cập nhật</button>
							    </div>
							  </div>
							</form>
						</div>
					</div>
					<?php endforeach ?>

				<!-- must -->
			</main>
		</div>
	  <!-- end Row -->

	</div>
	<!-- end Container -->

</div>
<!-- end Body main wrapper -->
<!-- end must -->