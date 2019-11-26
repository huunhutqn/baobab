		
		<!-- Slider home page -->
		<div class="slider-container">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			    <!-- <ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			    </ol> -->
			    <div class="carousel-inner" role="listbox">
					<!-- Slide One - Set the background image for this slide in the line below -->
					<div class="carousel-item active" style="background-image: url('uploads/images/slide/slide179341140.jpg')">
						<!-- <div class="carousel-caption d-none d-md-block">
							<h2 class="display-4">First Slide</h2>
							<p class="lead">This is a description for the first slide.</p>
						</div> -->
					</div>
					<!-- Slide Two - Set the background image for this slide in the line below -->
					<div class="carousel-item" style="background-image: url('uploads/images/slide/slide162454611.jpg')">
						<!-- <div class="carousel-caption d-none d-md-block">
							<h2 class="display-4">Second Slide</h2>
							<p class="lead">This is a description for the second slide.</p>
						</div> -->
					</div>
					<!-- Slide Three - Set the background image for this slide in the line below -->
					<div class="carousel-item" style="background-image: url('uploads/images/slide/slide179341161.jpg')">
						<!-- <div class="carousel-caption d-none d-md-block">
							<h2 class="display-4">Third Slide</h2>
							<p class="lead">This is a description for the third slide.</p>
						</div> -->
					</div>
			    </div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		
		<!-- modal alert wait -->
		<div class="modal fade" id="alertWModal" role="dialog" aria-modal="true"">
		    <div class="modal-dialog modal-dialog-centered">
		    
		      <!-- Modal content-->
		      <div class="modal-content" style="font-family: 'Montserrat', sans-serif;">
		        
		        <div class="modal-body py-1 px-2 text-center">
		          <button class="btn" type="button" disabled="">
				  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
				  Đang tìm phòng...
				</button>
		        </div>
		        
		      </div>
		      
		    </div>
		</div>
		<!-- end modal alert wait -->

		<!-- modal alert proccessing -->
		<div class="modal fade" id="alertPModal" role="dialog" aria-modal="true"">
		    <div class="modal-dialog modal-dialog-centered">
		    
		      <!-- Modal content-->
		      <div class="modal-content" style="font-family: 'Montserrat', sans-serif;">
		        
		        <div class="modal-body py-1 px-2 text-center">
		          <button class="btn" type="button" disabled="">
				  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
				  Đang xử lí...
				</button>
		        </div>
		        
		      </div>
		      
		    </div>
		</div>
		<!-- end modal alert proccessing -->

		<!-- modal alert danger -->
		<div class="modal fade" id="alertDModal" role="dialog" aria-modal="true">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content" style="font-family: 'Montserrat', sans-serif;">
		        <div class="modal-header py-1 px-2">
		          <h6 class="modal-title">Thông báo</h6>
		        </div>
		        <div class="modal-body py-3 px-2">
		          <p class="alert alert-danger text-danger content-alert mb-0 py-1 px-2" style="font-size: 90%;"></p>
		        </div>
		        <div class="modal-footer py-1 px-2">
		          <button type="button" class="btn btn-default py-0" data-dismiss="modal" style="font-size: 80%;">Đóng</button>
		        </div>
		      </div>
		      
		    </div>
		</div>
		<!-- end modal alert danger -->

				
		<!-- Modal booked -->
		  <div class="modal fade" id="bookedModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <h4 class="modal-title">Thông báo</h4>
		        </div>
		        <div class="modal-body">
		          <p class="text-danger">Xin lỗi, ngày lưu trú của bạn cho phòng này đã có người <strong>vừa đặt</strong>. Vui lòng chọn lại ngày khác.<br><span class="text-muted" style="font-style: italic;">Hệ thống tự động tải lại trong 10s. <span class="btn-refresh" style="cursor: pointer;">(Tải lại)</span></span></p>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default btn-refresh">Tải lại</button>
		        </div>
		      </div>
		      
		    </div>
		</div>
		
		<!-- Modal book-success -->
		  <div class="modal fade" id="booksuccessModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-body">
		          	<h6 class="alert-success p-2">Đặt phòng thành công</h6>
		          	<hr>
		          		<p>Tên người đặt: <input type="text" disabled name="rcname" value=""></p>
			          	<p>Tên phòng: <input type="text" disabled name="rname" value=""></p>
			          	<p>Ngày checkin: <input type="text" disabled name="rcheckin" value=""></p>
			          	<p>Ngày checkout: <input type="text" disabled name="rcheckout" value=""></p>
			          	<p>Số người lưu trú: <input type="text" disabled name="rpeople" value=""></p>
			          	<p>Thành tiền: <input type="text" disabled name="rtotal" value=""></p>
		          	<hr>
		          	<span class="d-block">Cảm ơn bạn đã đặt phòng tại Baobab Homestay.</span>
		          	<span class="d-block"><small class="text-danger">**Vui lòng kiểm tra email để xác nhận thông tin đặt phòng</small></span>
		          	<hr>
		          	<span class="d-block"><strong>Hệ thống sẽ tự động tải lại sau 30s.</strong></span>
		        
		        </div>
		        <div class="modal-footer py-1">
		          <button type="button" class="btn btn-default btn-refresh">Tải lại</button>
		        </div>
		      </div>
		      
		    </div>
		</div>

		<!-- Modal check availability -->
		<div class="modal fade" id="checkAvModal" role="dialog" style="padding-right: 17px;" aria-modal="true">
			<div class="modal-dialog" style="max-width: 800px;">
			<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-body">
				    <h6 class="alert-success p-2">Tìm thấy <strong class="numAv"></strong> phòng phù hợp cho <strong class="numPe"></strong> từ <strong class="dateChi"></strong> đến <strong class="dateCho"></strong></h6>
				    <hr>
				    <div style="display: block;max-height: 70vh;overflow-y: auto;position: relative;" class="roomsAv">

				    </div>
				  </div>
				  <div class="modal-footer py-0">
				    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				  </div>
				</div>
			</div>
		</div>
		<!-- end check avmodal -->

		<!-- main content -->
		<div class="content">
			<div class="container px-md-3 px-sm-0">
				<div class="container parent-booking-form px-md-3 px-sm-0 wow flipInX" data-wow-duration="2s" data-wow-delay="3s">
					<div class="booking-form container-fluid d-md-inline-flex d-md-flex align-items-center px-md-3 px-sm-0">
						<div class="col-md-2 col-sm-12 pb-sm-2 pb-md-0">
							<h4>Đặt
								<span>PHÒNG</span>
							</h4>
						</div>
						<form class="col-md-10 d-md-inline-flex col-sm-12">
							<div class="form-group mr-md-3">
								<label class="text-white">Ngày đến</label>
								<div class="booking-date">
									<span><i class="icofont-calendar"></i></span>
									<input type="text" name="check-in" class="check-in" data-provide="datepicker" required readonly value="" placeholder="--/--/--">
									<span><i class="icofont-thin-down"></i></span>
								</div>
							</div>
							<div class="form-group mr-md-3">
								<label class="text-white">Ngày đi</label>
								<div class="booking-date">
									<span><i class="icofont-calendar"></i></span>
									<input type="text" name="check-out" class="check-out" data-provide="datepicker" required readonly value="" placeholder="--/--/--">
									<span><i class="icofont-thin-down"></i></span>
								</div>
							</div>
							<div class="form-group mr-md-3">
								<label class="text-white">Số người</label>
								<div class="booking-person">
									<span><i class="icofont-users-alt-6"></i></span>
									<!-- <input type="text" name="" readonly value="01" placeholder=""> -->
									<select class="custom-select people-select" id="inputGroupSelect01">
									    <option value="1" selected>1</option>
									    <option value="2">2</option>
									    <option value="3">3</option>
									    <option value="4">4</option>
									    <option value="5">5</option>
									    <option value="6">6</option>
									    <option value="7">7</option>
									    <option value="8">8</option>
									    <option value="9">9</option>
									    <option value="10">10</option>
									    <option value="11">11</option>
									    <option value="12">12</option>
									    <option value="13">13</option>
									    <option value="14">14</option>
									    <option value="15">15</option>
									  </select>
									<span><i class="icofont-thin-down"></i></span>
								</div>
							</div>
							<div class="form-group">
								<label>&nbsp;</label>
								<button type="button" class="btn btn-light booking-button d-block">Kiểm Tra Phòng</button>
							</div>
							<div class="d-block booking-time">(Nhận phòng: 02:00 PM / Trả phòng: 12:00 PM)</div>
						</form>
					</div>
				</div>
				<div class="content-head">
					<div class="text-center">
						<div class="welcome" id="welcome">
							<h2>Chào mừng đến với Baobab</h2>
							<span>Slogan của Baobab!!!</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 offset-md-2 welcome-desc text-center">
							<span>Baobab Homestay nằm giữa một khu phố yên tĩnh liền kề bãi biển Phạm Văn Đồng, cách chợ địa phương 200m, cách cầu Rồng và cầu sông Hàn 5 phút đi xe.</span>
							<br><br>
							<span>BaoBab ra đời với sứ mệnh mang đến một địa điểm dừng chân lý tưởng cho các tín đồ du lịch khi đến Đà Nẵng. Và thật may mắn khi hành trình đó chúng tôi luôn nhận được sự yêu quý, tin tưởng và trân trọng của các vị khách đến từ khắp nơi trên thế giới. Đó là niềm tự hào, và là động lực để chúng tôi không ngừng hoàn thiện, mang đến trải nghiệm ngày một tốt hơn cho du khách.</span>
						</div>
					</div>

				</div>
				<div class="content-mid">
					<div class="container list-room py-3" id="list-room">
						<div class="col mt-md-5 text-center">
							<span class="h3 title">Phòng của BaoBab</span>
						</div>
						<!-- start get room -->
						<script>$rooms_datajson = <?= $rooms_datajson ?></script>
						<?php $num = 1; ?>
						<?php foreach ($rooms_data as $key => $value): ?>
						<?php $num++; 
							if($num%2 != 0){
								?>
								<div class="row py-5">
									<div class="col-md-5 offset-md-1">
										<figure class="figure room-pic wow slideInLeft" data-wow-duration="1s">
											<a href=""><img src="uploads/images/room/<?= $value['thumbnail_image'] ?>" class="figure-img img-fluid" alt="..."></a>
											<span class="price-right"><sup>vnđ</sup><?php echo substr($value['price'],0,-3); ?>K<small>01 Đêm</small></span>
										</figure>
									</div>
									<div class="col-md-4 offset-md-1">
										<div class="room-desc">
											<h3><?= $value['name'] ?></h3>
											<p><?= $value['short_desc'] ?>
											</p>
											<ul>
												<?php if($value['features']) foreach ($value['features'] as $value_feature): 
													switch ($value_feature) {
														case 'dhoa':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Máy điều hòa"><i class="icofont-snow-temp"></i></li>';
							      							break;
							      						case 'tvi':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Ti vi"><i class=" icofont-imac"></i></li>';
							      							break;
							      						case 'mgiat':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Máy giặt"><i class="icofont-washing-machine"></i></li>';
							      							break;
							      						case 'nvsinh':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Nhà vệ sinh riêng"><i class="icofont-bathtub"></i></li>';
							      							break;
							      						case 'wfi':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Wifi miễn phí"><i class="icofont-wifi"></i></li>';
							      							break;
							      						case 'asang':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Bao gồm bữa ăn sáng"><i class="icofont-culinary"></i></li>';
							      							break;
													}
												?>
												
												<?php endforeach ?>

											</ul>
											<button class="btn btn-room-detail" id-room=<?= $value['room_id'] ?>>Chi tiết</button>
										</div>
									</div>
								</div>
								<?php 
							} else {
								?>
								<div class="row py-5">
									<div class="col-md-4 offset-md-1">
										<div class="room-desc">
											<h3><?= $value['name'] ?></h3>
											<p><?= $value['short_desc'] ?>
											</p>
											<ul>
												<?php if($value['features']) foreach ($value['features'] as $value_feature): 
													switch ($value_feature) {
														case 'dhoa':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Máy điều hòa"><i class="icofont-snow-temp"></i></li>';
							      							break;
							      						case 'tvi':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Ti vi"><i class=" icofont-imac"></i></li>';
							      							break;
							      						case 'mgiat':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Máy giặt"><i class="icofont-washing-machine"></i></li>';
							      							break;
							      						case 'nvsinh':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Nhà vệ sinh riêng"><i class="icofont-bathtub"></i></li>';
							      							break;
							      						case 'wfi':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Wifi miễn phí"><i class="icofont-wifi"></i></li>';
							      							break;
							      						case 'asang':
							      							echo '<li data-toggle="tooltip" data-placement="bottom" title="Bao gồm bữa ăn sáng"><i class="icofont-culinary"></i></li>';
							      							break;
													}
												?>
												<?php endforeach ?>
											</ul>
											<button class="btn btn-room-detail" id-room=<?= $value['room_id'] ?>>Chi tiết</button>
										</div>
									</div>
									<div class="col-md-5 offset-md-1">
										<figure class="figure room-pic wow slideInRight" data-wow-duration="1s">
											<a href=""><img src="uploads/images/room/<?= $value['thumbnail_image'] ?>" class="figure-img img-fluid" alt="..."></a>
											<span class="price-left"><sup>vnđ</sup><?php echo substr($value['price'],0,-3); ?>K<small>01 Đêm</small></span>
										</figure>
									</div>
								</div>
								<?php
							}
						?>
						<?php endforeach ?>
						<!-- end get room -->

					</div>
				</div>
				<div class="content-bot">
					
				</div>
			</div>
		</div>

