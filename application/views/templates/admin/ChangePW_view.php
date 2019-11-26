	<!-- Body main wrapper start -->
	<div class="wrapper bg-white">

		<form class="col-md-6 card py-3 px-5 m-3 mx-auto" action="<?php echo base_url() ?>admin/changepw" id="cPw" method="post">
			<h5 class="text-center">Thay đổi mật khẩu</h5>
			<div class="form-group">
				<label for="password">Mật khẩu mới</label>
				<?php foreach ($data as $value): ?>
					<input type="hidden" name="iac" value="<?= $value['user_id'] ?>">
				<?php endforeach ?>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
			</div>
			<div class="form-group">
				<label for="password">Nhập lại mật khẩu mới</label>
				<input type="password" class="form-control" id="rpassword" name="rpassword" placeholder="Xác nhận Password" required>
			</div>
			<button type="submit" class="btn btn-primary btn-changepw" onclick="return validateMyForm();">Đổi mật khẩu</button>
		</form>

	</div>