				<!-- must -->
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2">Quản lí đơn đặt phòng</h1>
					</div>
				<!-- end must -->
					<!-- modal alert proccessing -->
					<div class="modal fade" id="editOPModal" role="dialog" aria-modal="true"">
					    <div class="modal-dialog modal-dialog-centered">
					    
					      <!-- Modal content-->
					      <div class="modal-content" style="font-family: 'Montserrat', sans-serif;">
					        
					        <div class="modal-body py-1 px-2 text-center">
					        	<p class="h5">Cập nhật trạng thái khách hàng</p>
					        	<p class="text-success"></p>
					        	<div class="edit-od text-left">
					        		<input type="hidden" name="client_id">
					        		<div class="form-group">
										<label for="name">Email khách</label>
										<input type="text" class="form-control" id="name" disabled readonly aria-describedby="emailHelp" placeholder="Tên khách" name="email" required autofocus>
									</div>
									<div class="form-group">
										<label for="status">Trạng thái</label>
										<select class="custom-select" name="status">
											<option value="0" selected>Không thay đổi</option>
										  <option value="1">Được thuê</option>
										  <option value="2">Tạm khóa</option>
										  <option value="3">Xác nhận thuê</option>
										</select>
									</div>
									<button type="button" class="btn cancel-eo mx-1 float-right">Hủy</button>
									<button type="button" class="btn submit-eo float-right">Lưu</button>
					        	</div>
					        </div>
					        
					      </div>
					      
					    </div>
					</div>
					<!-- end modal alert proccessing -->

					<div class="row">
						<table class="table table-bordered table-striped">
						  <thead class="thead-light">
						    <tr>
						      <th>Mã</th>
						      <th class="filter-select filter-exact" data-placeholder="Chọn phòng">Tên phòng</th>
						      <th>Trạng thái</th>
						      <th>Tổng tiền</th>
						      <th>Checkin</th>
						      <th>Checkout</th>
						      <th>Email khách thuê</th>
						      <th>Số khách ở</th>
						      <th>Ngày đặt</th>
						      <th></th>
						    </tr>
						  </thead>
						  <tfoot>
						    <tr>
						      <th>Mã</th>
						      <th>Tên phòng</th>
						      <th>Trạng thái</th>
						      <th>Tổng tiền</th>
						      <th>Checkin</th>
						      <th>Checkout</th>
						      <th>Email khách thuê</th>
						      <th>Số khách ở</th>
						      <th>Ngày đặt</th>
						      <th></th>
						    </tr>
						    <tr>
						      <th colspan="10" class="ts-pager">
						        <div class="form-inline">
						          <div class="btn-group btn-group-sm mx-1" role="group">
						            <button type="button" class="btn btn-secondary first" title="first">⇤</button>
						            <button type="button" class="btn btn-secondary prev" title="previous">←</button>
						          </div>
						          <span class="pagedisplay"></span>
						          <div class="btn-group btn-group-sm mx-1" role="group">
						            <button type="button" class="btn btn-secondary next" title="next">→</button>
						            <button type="button" class="btn btn-secondary last" title="last">⇥</button>
						          </div>
						          <select class="form-control-sm custom-select px-1 pagesize" title="Select page size">
						            <option selected="selected" value="10">10</option>
						            <option value="20">20</option>
						            <option value="30">30</option>
						            <option value="all">All Rows</option>
						          </select>
						          <select class="form-control-sm custom-select px-4 mx-1 pagenum" title="Select page number"></select>
						        </div>
						      </th>
						    </tr>
						  </tfoot>
						  <tbody>
						  	<?php foreach ($orders_data as $value): ?>
						  		<tr>
							      <td class="order_id"><?= $value['order_id'] ?></td>
							      <td class="room_id" data-id="<?= $value['room_id'] ?>"><?php 
							      		foreach ($rooms_data as $ke => $val) {
							      			if($val['room_id'] == $value['room_id']){
							      				echo $val['name'];
							      			}
							      		}

							      	?></td>
							      <td class="status" data-id="<?= $value['status'] ?>"><?php 
							      		switch ($value['status']) {
							      			case '1':
							      				echo 'Chờ xác nhận';
							      				break;
							      			case '2':
							      				echo 'Chờ check-in';
							      				break;
							      			case '3':
							      				echo 'Chờ check-out';
							      				break;
							      			case '4':
							      				echo 'Đã xong';
							      				break;
							      			case '5':
							      				echo 'Đã hủy';
							      				break;
							      		}
							      	?></td>
							      <td class="total"><?= $value['total'] ?></td>
							      <td class="checkin"><?= $value['checkin'] ?></td>
							      <td class="checkout"><?= $value['checkout'] ?></td>
							      <td class="client_id" data-id="$value['client_id']"><?php 
							      		foreach ($clients_data as $k => $va) {
							      			if($value['client_id'] == $va['client_id']){
							      				echo $va['email'];
							      			}
							      		}
							      	?></td>
							      <td class="people"><?= $value['people'] ?></td>
							      <td class="date"><?= $value['date'] ?></td>
							      <td>
							      	<button type="button" class="edit-o" title="Sửa thông tin đơn thuê này"><i class="icofont-spanner"></i></button>
							      	<button type="button" class="remove-o" title="Xóa đơn thuê này"><i class="icofont-close-line"></i></button>
							      </td>
							    </tr>
						  	<?php endforeach ?>
						  </tbody>
						</table>
					</div>

				<!-- must -->
			</main>
		</div>
	  <!-- end Row -->

	</div>
	<!-- end Container -->

</div>
<!-- end Body main wrapper -->
<!-- end must -->