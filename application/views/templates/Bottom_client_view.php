		<!-- footer content -->
		<div class="footer">
			<div class="container d-md-flex py-3">
				<div class="col-md-3 d-flex justify-content-center align-items-center">
					<div>
						<img src="<?= base_url() ?>uploads/images/logo/logooriginal100dpi-fit-trans-150x163.png">
					</div>
				</div>
				<div class="col-md-6 col-sm-12 pt-md-5 footer-menu">
					<div>
						<div class="d-block font-weight-bold pb-1" style="color: #747082; padding-left: 5px; text-transform: uppercase;">
							<span>Truy Cập Nhanh</span>
						</div>
						<ul>
							<li>
								<a href="">Baobab Homestay</a>
							</li>
							<li>
								<a href="">Phòng Baobab</a>
							</li>
							<li>
								<a href="">Về Baobab Homestay</a>
							</li>
							<li>
								<a href="">Liên hệ</a>
							</li>
							<li>
								<a href="">Chính sách Baobab</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-12 pt-md-5 footer-contact">
					<div>
						<div class="d-block font-weight-bold pb-1" style="color: #747082; padding-left: 5px; text-transform: uppercase;">
							<span>Liên hệ</span>
						</div>
						<div class="d-block footer-contact-add pb-1">
							<span>02 Bùi Hữu Nghĩa, An Hải Bắc, Sơn Trà, Đà Nẵng</span>
						</div>
						<div class="d-block footer-contact-email pb-1">
							<span><i class="icofont-mail"></i> <a href="mailto:baobab.homestay@gmail.com">baobab.homestay@gmail.com</a></span>
						</div>
						<div class="d-block footer-contact-phone pb-1">
							<span><i class="icofont-ui-cell-phone"> </i><a href="tel:+84915314600">+84915314600</a></span>
						</div>
						<div class="footer-cocial">
							<a href=""><i class="icofont-facebook"></i></a>
							<a href=""><i class="icofont-instagram"></i></a>
							<a href=""><i class="icofont-skype"></i></a>
							<a href=""><i class="icofont-whatsapp"></i></a>
							<a href=""><i class="icofont-youtube"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="container pb-3 text-center footer-copyright">
				<span class="col">© 2019 Baobab Homestay.</span>
			</div>
		</div>

	</div>
	
	<!-- Optional js -->
	<script src="<?= base_url() ?>js/jquery-3.4.1.min.js"></script>
	<script src="<?= base_url() ?>js/popper1.15.min.js"></script>
	<script src="<?= base_url() ?>js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>js/simple-lightbox.min.js"></script>
	<script src="<?= base_url() ?>js/bootstrap-datepicker.js"></script>
	<script src="<?= base_url() ?>js/bootstrap-datepicker.vi.min.js"></script>
	<script src="<?= base_url() ?>js/moment.js"></script>
	<script src="<?= base_url() ?>js/moment.vi.js"></script>
	<script src="<?= base_url() ?>js/wow.js"></script>
	<script src="<?= base_url() ?>js/lightslider.js"></script>
	<script>
	new WOW().init();
	var datepicker = $.fn.datepicker.noConflict(); // return $.fn.datepicker to previously assigned value
	$.fn.bootstrapDP = datepicker;                 // give $().bootstrapDP the bootstrap-datepicker functionality
	moment().format("DD/MM/YYYY");
	</script>
	<script src="<?= base_url() ?>js/js.js"></script>
	<script>
		$(document).ready(function() {
			setTimeout(function(){
				$('#preloader').addClass('d-none');
			}, 3000);
			// $('[data-toggle="tooltip"]').tooltip({trigger: "hover active focus", delay: {show: 100, hide: 400}});
			$('[data-toggle="tooltip"]').tooltip({trigger: "hover click"});
			$('[data-toggle="tooltip"]').on("mouseleave", function(){
				$(this).tooltip("hide"); 
			});
			

		});
	</script>
</body>
</html>