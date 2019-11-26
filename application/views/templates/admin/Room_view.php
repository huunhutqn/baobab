	<!-- must -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<!-- Modal -->
				  <div class="modal fade" id="msgModal" role="dialog">
				    <div class="modal-dialog">
				    
				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <h4 class="modal-title">Thông báo</h4>
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				        </div>
				        <div class="modal-body">
				          <p>
				          	<?php 
								if($this->session->flashdata('msg_room_update')){
									echo $this->session->flashdata('msg_room_update');
								}
							?>
				          </p>
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        </div>
				      </div>
				      
				    </div>
				  </div>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Quản lí phòng</h1>
		<!-- <?php 
			// echo '<pre>';
			// var_dump($rooms_data);
			// echo '<hr>';
			// var_dump($rooms_data2);
		?> -->
	</div>
	<!-- end must -->

<!-- start optional -->
				<nav>
				  <div class="nav nav-tabs" id="nav-tab" role="tablist">
				    <a class="nav-item nav-link active" id="nav-room-home-tab" data-toggle="tab" href="#nav-room-home" role="tab" aria-controls="nav-room-home" aria-selected="true">Quản lí</a>
				    <a class="nav-item nav-link" id="nav-room-add-tab" data-toggle="tab" href="#nav-room-add" role="tab" aria-controls="nav-room-add" aria-selected="false">Thêm mới</a>
				  </div>
				</nav>
				

				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-room-home" role="tabpanel" aria-labelledby="nav-room-home-tab">
				  		<div class="mx-auto py-3 px-5 room-list">

				  			<!-- room info -->
				  			<?php $galleryNo = 0 ?>
				  			<!-- <?php //echo '<pre>';var_dump($rooms_data); ?> -->
				  			<?php foreach ($rooms_data as $key => $value): ?>
					  			<form accept-charset="UTF-8" action="update_room" method="POST" enctype="multipart/form-data">
					  			<div class="card mb-3 room_detail">
								  <div class="row no-gutters">
								    <div class="col-md-4">
								    	<?php
								    		$galleryNo++;
									    	if($value['thumbnail_image'])
									    	{
									    		echo '<div class="av-room current-info" data-av="'.$value['thumbnail_image'].'"><img src="../uploads/images/room/'.$value['thumbnail_image'].'" class="card-img" alt="..."></div>';
									    	} else echo '<div class="alert alert-dark av-room current-info" data-av="'.$value['thumbnail_image'].' role="alert">Hiện tại chưa có hình đại diện cho phòng này!</div>';
									    	
								    	?>
								      	<!-- edit upload multiple images / gallery -->
										<div class="av-room custom-file-container edit-info d-none px-2 pt-3" data-av='<?= $value['thumbnail_image'] ?>' data-upload-id="upload-one<?= $galleryNo ?>" style="max-height: 310px;">
										    <label>Ảnh đại diện cho phòng <a href="javascript:void(0)" class="custom-file-container__image-clear" data-toggle="tooltip" data-placement="bottom" title="Xóa hình đã chọn">&times;</a></label>
										    <label class="custom-file-container__custom-file" >
										        <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/png, image/jpeg, image/jpg" aria-label="Chọn ảnh đại diện cho phòng" name="room-thumbnail-image">
										        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="500" /> -->
										        <span class="custom-file-container__custom-file__custom-file-control"></span>
										    </label>
										    <div class="custom-file-container__image-preview" style="height: 200px"></div>
										</div>
										<!-- end edit upload multiple images / gallery -->
								      	<div class="px-2 py-3">
									      	<p class="card-text">
									      		<span class="badge badge-secondary">Giá</span>
									      		<span class="float-right current-info"><?= $value['price'] ?> <i class="icofont-dong"></i></span>
									      		<span class="edit-info d-none"><input type="text" name="room-price" class="d-inline col-md-8 form-control" placeholder="Giá phòng" required style="height: 1.5rem;" value="<?= $value['price'] ?>"> <i class="icofont-dong"></i></span>
									      	</p>
									      	<p class="card-text">
									      		<span class="badge badge-secondary">Số người</span>
									      		<span class="float-right current-info"><?= $value['people'] ?> <i class="icofont-users-alt-3"></i></span>
									      		<span class="edit-info d-none"><select class="d-inline form-control col-md-7 py-0" name="room-people" style="height: 1.5rem">
									      			  <option><?= $value['people'] ?></option>
												      <option>1</option>
												      <option>2</option>
												      <option>3</option>
												      <option>4</option>
												      <option>5</option>
												      <option>6</option>
												      <option>7</option>
												      <option>8</option>
												      <option>9</option>
												      <option>10</option>
												      <option>11</option>
												      <option>12</option>
												      <option>13</option>
												      <option>14</option>
												      <option>15</option>
												      <option>16</option>
												    </select> 
												   <i class="icofont-users-alt-3"></i>
												</span>
									      	<p class="card-text">
									      		<span class="badge badge-secondary">Diện tích</span>
									      		<span class="float-right current-info"><?= $value['square'] ?> m<sup>2</sup></span>
									      		<span class="edit-info d-none"><input type="text" name="room-square" class="d-inline form-control col-md-7" placeholder="Diện tích" style="height: 1.5rem;" value="<?= $value['square'] ?>" required=""> m<sup>2</sup></span>
									      	</p>
									      	<p class="card-text">
										      	<span class="badge badge-secondary">Tiện ích đi kèm</span>
									      		<div class="current-info"> 
									      			<?php 
									      				if($value['features']) foreach ($value['features'] as $value_features):
									      					switch ($value_features) {
									      						case 'dhoa':
									      							echo '<div class="offset-md-2"><i class="mr-5 icofont-snow-temp"></i>Máy điều hòa</div>';
									      							break;
									      						case 'tvi':
									      							echo '<div class="offset-md-2"><i class="mr-5 icofont-imac"></i>Ti vi</div>';
									      							break;
									      						case 'mgiat':
									      							echo '<div class="offset-md-2"><i class="mr-5 icofont-washing-machine"></i>Máy giặt</div>';
									      							break;
									      						case 'nvsinh':
									      							echo '<div class="offset-md-2"><i class="mr-5 icofont-bathtub"></i>Nhà vệ sinh riêng</div>';
									      							break;
									      						case 'wfi':
									      							echo '<div class="offset-md-2"><i class="mr-5 icofont-wifi"></i>Wifi miễn phí</div>';
									      							break;
									      						case 'asang':
									      							echo '<div class="offset-md-2"><i class="mr-5 icofont-culinary"></i>Bữa sáng miễn phí</div>';
									      							break;
									      					}; endforeach;
									      			 	else echo '<div class="alert alert-dark" role="alert">Hiện tại chưa có tiện ích đi kèm nào!</div>'; ?>
									      		</div>
									      		<div class="offset-md-4 edit-info d-none">
									  		    	<div class="form-check">
													  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="dhoa" <?php if($value['features']) foreach ($value['features'] as $value_features_check) if($value_features_check=='dhoa') echo'checked'; ?>>
													  <label class="form-check-label" for="inlineCheckbox1">Máy điều hòa</label>
													</div>
													<div class="form-check">
													  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="tvi" <?php if($value['features']) foreach ($value['features'] as $value_features_check) if($value_features_check=='tvi') echo'checked'; ?>>
													  <label class="form-check-label" for="inlineCheckbox1">Ti vi</label>
													</div>
													<div class="form-check">
													  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="mgiat" <?php if($value['features']) foreach ($value['features'] as $value_features_check) if($value_features_check=='mgiat') echo'checked'; ?>>
													  <label class="form-check-label" for="inlineCheckbox1">Máy giặt</label>
													</div>
													<div class="form-check">
													  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="nvsinh" <?php if($value['features']) foreach ($value['features'] as $value_features_check) if($value_features_check=='nvsinh') echo'checked'; ?>>
													  <label class="form-check-label" for="inlineCheckbox1">Nhà vệ sinh riêng</label>
													</div>
													<div class="form-check">
													  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="wfi" <?php if($value['features']) foreach ($value['features'] as $value_features_check) if($value_features_check=='wfi') echo'checked'; ?>>
													  <label class="form-check-label" for="inlineCheckbox1">Wifi miễn phí</label>
													</div>
													<div class="form-check">
													  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="asang" <?php if($value['features']) foreach ($value['features'] as $value_features_check) if($value_features_check=='asang') echo'checked'; ?>>
													  <label class="form-check-label" for="inlineCheckbox1">Bữa sáng miễn phí</label>
													</div>
								  		    	</div>
									      	</p>
								      	</div>
								    </div>
								    <div class="col-md-8">
								      <div class="card-body">
								      	<div class="position-absolute current-info btn-room">
								      		<i class="icofont-edit text-warning modify_room" data-toggle="tooltip" data-placement="bottom" title="Sửa thông tin phòng"></i>
								      		<i class="icofont-error text-danger delete_room" data-toggle="tooltip" data-placement="bottom" title="Xóa phòng"><input type="hidden" name="room_id" id="room_id" value="<?= $value['room_id'] ?>"></i>
								      	</div>
								        <h5 class="card-title current-info"><?= $value['name'] ?></h5>
								        <input type="text" name="room-name" class="form-control edit-info mt-3 mb-3 d-none room-name" placeholder="Tên phòng" required="" value="<?= $value['name'] ?>">
								        <label class="badge badge-secondary">Mô tả ngắn</label>
								        <p class="card-text current-info"><?= $value['short_desc'] ?></p>
								        <textarea name="room-short-desc" class="form-control mb-3 edit-info room-short-desc d-none" placeholder="Nội dung mô tả ngắn. Tối đa 255 kí tự!" rows="4" required><?= $value['short_desc'] ?></textarea>
								        <label class="badge badge-secondary">Mô tả chi tiết phòng</label>
								        <p class="card-text current-info"><?= $value['long_desc'] ?></p>
								        <textarea name="room-long-desc" class="form-control mb-3 room-long-desc edit-info d-none" placeholder="Nội dung giới thiệu chi tiết phòng." rows="7"><?= $value['long_desc'] ?></textarea>
								        <div>
								        	<label class="badge badge-secondary">Bộ sưu tập hình ảnh phòng</label>
												
									        <div class="gallery-room current-info g<?= $galleryNo ?>">
												<!-- gallery images -->
												<?php //echo '<pre>'; 
												// 	var_dump($value['gallery_image']);
												?>
												<?php if($value['gallery_image']) foreach ($value['gallery_image'] as &$value_gallery): ?>
													<a href="../uploads/images/room/<?= $value_gallery ?>">
										        		<img src="../uploads/images/room/<?= $value_gallery ?>">
										        	</a>
										        	<?php $value_gallery = base_url().'uploads/images/room/'.$value_gallery ?>
												<?php endforeach; else echo '<div class="alert alert-dark" role="alert">Hiện tại chưa có ảnh nào trong bộ sưu tập!</div>'; ?>
												<!-- end gallery images -->
									        </div>
									        <?php 
									        	$gallery_images = json_encode($value['gallery_image'], JSON_UNESCAPED_SLASHES);
									        	// $char_need = array('[', ']');
									        	// $gallery_images = str_replace($char_need, '', $gallery_images );
									        	// echo $gallery_images;
									        ?>
									        
									        <!-- edit upload multiple images / gallery -->
											<div class="custom-file-container edit-info d-none" data-gallery='<?= $gallery_images ?>' data-upload-id="upload-multiple<?= $galleryNo ?>">
											    <label>Xóa các hình đã chọn <a href="javascript:void(0)" class="custom-file-container__image-clear" data-toggle="tooltip" data-placement="bottom" title="Xóa tất cả hình ảnh">&times;</a></label>
											    <label class="custom-file-container__custom-file" >
											        <input type="file" class="custom-file-container__custom-file__custom-file-input update-multiple-images" accept="image/png, image/jpeg, image/jpg" multiple aria-label="Chọn ảnh cho bộ sưu tập" name="room-gallery-image[]">
											        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="500" /> -->
											        <span class="custom-file-container__custom-file__custom-file-control"></span>
											    </label>
											    <div class="custom-file-container__image-preview" style="height: 120px"></div>
											</div>
											<!-- end edit upload multiple images / gallery -->
								        </div>
								        <div class="float-right mb-2 edit-info d-none">
								        	<button type="button" class="btn cancel-edit">Hủy thao tác</button>
								        	<button type="submit" class="btn submit-edit">Lưu</button>
								        </div>
								      </div>
								    </div>
								  </div>
								</div>
								</form>
							<?php endforeach ?>
							<script>var $galleryNo = <?php echo $galleryNo; ?></script>
							<!-- end room info -->

				  		</div>
					</div>
					<div class="tab-pane fade" id="nav-room-add" role="tabpanel" aria-labelledby="nav-room-add-tab">
				  		<form class="mx-auto py-3 px-5 form-add-room" accept-charset="UTF-8" action="add_room" method="POST" enctype="multipart/form-data">
				  			<?php 
								if ($this->session->flashdata('msg_room_add'))
								{
									echo $this->session->flashdata('msg_room_add'); 
								}
							?>
				  		  <div class="form-row">
				  		    <div class="col-md-8 pt-3">
				  		      <label>Tên phòng</label>
				  		      <input type="text" name="room-name" class="form-control" placeholder="Tên phòng" required>
				  		      <small id="room-name-help" class="form-text text-muted">Tên phòng tối đa 255 kí tự.</small>
				  		    </div>
				  		    <div class="col-md-4 pt-3">
				  		    	<label>Giá phòng</label>
				  		    	<!-- <div class="flex-nowrap"> -->
					  		  		<!-- <span class="text-right position-absolute" style="padding: 0 10px; right: 0; top: 25%;">VNĐ</span> -->

						  		    <!-- <input type="text" name="room-price" class="form-control d-inline" placeholder="Giá phòng" style="border-right: 50px solid #e9e9e9;"> -->
					  		      <!-- <div class="input-group-prepend">
								    <span class="input-group-text" id="addon-wrapping">@</span>
								  </div>
						  		    <input type="text" name="room-price" class="form-control" placeholder="Giá phòng" aria-describedby="addon-wrapping">
				  		  		</div> -->
				  		  		<div class="input-group flex-nowrap">
								  
								  <input type="text" name="room-price" class="form-control" placeholder="Giá phòng" aria-describedby="addon-wrapping" required>
								  <div class="input-group-append">
								    <span class="input-group-text" id="addon-wrapping">VNĐ</span>
								  </div>
								</div>

				  		      	<small id="room-price-help" class="form-text text-muted">Vd: 500000</small>
				  		    </div>
				  		    <div class="col-md-6 pt-3">
				  		    	<label>Mô tả ngắn</label>
				  		      <textarea name="room-short-desc" class="form-control" placeholder="Nội dung mô tả ngắn. Tối đa 255 kí tự!" rows="4"  required></textarea>
				  		    </div>
				  		    <div class="col-md-2">
				  		    	<div class=" pt-3">
				  		    		<label>Số người</label>
									<select class="form-control" name="room-people">
								      <option>1</option>
								      <option>2</option>
								      <option>3</option>
								      <option>4</option>
								      <option>5</option>
								      <option>6</option>
								      <option>7</option>
								      <option>8</option>
								      <option>9</option>
								      <option>10</option>
								      <option>11</option>
								      <option>12</option>
								      <option>13</option>
								      <option>14</option>
								      <option>15</option>
								      <option>16</option>
								    </select>
				  		    	</div>
				  		    	<div class=" pt-1">
				  		    		<label>Diện tích</label>
				  		    		<div class="input-group flex-nowrap">
									  <input type="text" name="room-square" class="form-control" placeholder="Diện tích" aria-describedby="addon-wrapping" required>
									  <div class="input-group-append">
									    <span class="input-group-text" id="addon-wrapping">m<sup>2</sup></span>
									  </div>
									</div>
									<small id="room-square-help" class="form-text text-muted">Vd: 100</small>
				  		    	</div>
				  		    </div>
				  		    <div class="col-md-4 pt-3">
				  		    	<label>Tiện ích đi kèm</label>
				  		    	<div class="pl-md-2">
					  		    	<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="dhoa">
									  <label class="form-check-label" for="inlineCheckbox1">Máy điều hòa</label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="tvi">
									  <label class="form-check-label" for="inlineCheckbox1">Ti vi</label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="mgiat">
									  <label class="form-check-label" for="inlineCheckbox1">Máy giặt</label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="nvsinh">
									  <label class="form-check-label" for="inlineCheckbox1">Nhà vệ sinh riêng</label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="wfi" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Wifi miễn phí</label>
									</div>
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="features[]" value="asang" checked>
									  <label class="form-check-label" for="inlineCheckbox1">Bữa sáng miễn phí</label>
									</div>
				  		    	</div>
					  		    
				  		    </div>
				  		    <div class="col-md-12 pt-3">
				  		    	<label>Giới thiệu chi tiết</label>
				  		      <textarea name="room-long-desc" class="form-control" placeholder="Nội dung giới thiệu chi tiết phòng." rows="7"></textarea>
				  		    </div>

				  		    <!-- <div class="col-md-6 pt-3">
				  		    	<label>Hình ảnh đại diện</label>
				  		    	<div class="input-group flex-nowrap">
								  <div class="input-group-prepend">
								    <span class="input-group-text py-0" id="inputGroupFileAddon01">Tải lên</span>
								  </div>
								  <div class="custom-file">
								    <input type="file" class="custom-file-input" name="room-thumbnail-image" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
								    <label class="custom-file-label" for="inputGroupFile01">Chọn file ảnh</label>
								  </div>
								</div>
								<small id="room-upload-image-help" class="form-text text-muted">Kích thước yêu cầu: 800x480(px)</small>
				  		    </div> -->
							
							<!-- upload one image / thumbnail -->
							<div class="custom-file-container col-md-5 pt-3" data-upload-id="upload-one">
							    <label>Hình ảnh đại diện <a href="javascript:void(0)" class="custom-file-container__image-clear" data-toggle="tooltip" data-placement="bottom" title="Xóa hình ảnh">&times;</a></label>
							    <label class="custom-file-container__custom-file" >
							        <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/png, image/jpeg, image/jpg" aria-label="Chọn ảnh đại diện" name="room-thumbnail-image">
							        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="500" /> -->
							        <span class="custom-file-container__custom-file__custom-file-control"></span>
							    </label>
							    <div class="custom-file-container__image-preview"></div>
							</div>
							
							<!-- upload multiple images / gallery -->
							<div class="custom-file-container col-md-7 pt-3" data-upload-id="upload-multiple">
							    <label>Bộ sưu tập ảnh <a href="javascript:void(0)" class="custom-file-container__image-clear" data-toggle="tooltip" data-placement="bottom" title="Xóa tất cả hình ảnh">&times;</a></label>
							    <label class="custom-file-container__custom-file" >
							        <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/png, image/jpeg, image/jpg" multiple aria-label="Chọn ảnh cho bộ sưu tập" name="room-gallery-image[]">
							        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="500" /> -->
							        <span class="custom-file-container__custom-file__custom-file-control"></span>
							    </label>
							    <div class="custom-file-container__image-preview"></div>
							</div>

				  		    <div class="col pt-3">
				  		    	<button type="submit" class="btn btn-primary d-block float-right">Tạo phòng</button>
				  		    </div>
				  		  </div>
				  		</form>
				 	</div>
				</div>

<!-- end optional -->

	<!-- must -->
</main>
		  </div>
		  <!-- end Row -->

		</div>
		<!-- end Container -->

	</div>
	<!-- end Body main wrapper -->
	<!-- end must -->