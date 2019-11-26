				<!-- must -->
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="h2">Quản lí khách thuê</h1>
					</div>
				<!-- end must -->
					<!-- modal alert proccessing -->
					<div class="modal fade" id="editCPModal" role="dialog" aria-modal="true"">
					    <div class="modal-dialog modal-dialog-centered">
					    
					      <!-- Modal content-->
					      <div class="modal-content" style="font-family: 'Montserrat', sans-serif;">
					        
					        <div class="modal-body py-1 px-2 text-center">
					        	<p class="h5">Cập nhật thông tin khách hàng</p>
					        	<p class="text-success"></p>
					        	<div class="edit-cl text-left">
					        		<input type="hidden" name="client_id">
					        		<div class="form-group">
										<label for="name">Tên khách</label>
										<input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Tên khách" name="fullname" required autofocus>
									</div>
						            <div class="form-group">
										<label for="email">Địa chỉ Email</label>
										<input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" name="email" required autofocus>
									</div>
									<div class="form-group">
										<label for="phone">Số điện thoại</label>
										<input type="text" class="form-control" id="phone" aria-describedby="emailHelp" placeholder="Số điện thoại" name="phone" required autofocus>
									</div>
									<div class="form-group">
										<label for="address">Địa chỉ</label>
										<input type="text" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Địa chỉ" name="address" required autofocus>
									</div>
									<div class="form-group">
										<label for="status">Trạng thái</label>
										<select class="custom-select" name="status">
										  <option value="1">Được thuê</option>
										  <option value="2">Tạm khóa</option>
										  <option value="3">Xác nhận thuê</option>
										</select>
									</div>
									<button type="button" class="btn cancel-ecl mx-1 float-right">Hủy</button>
									<button type="button" class="btn submit-ecl float-right">Lưu</button>
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
						      <th>Tên</th>
						      <th>Email</th>
						      <th>Điện thoại</th>
						      <th>Địa chỉ</th>
						      <th class="filter-select filter-exact" data-placeholder="Chọn trạng thái">Trạng thái</th>
						      <th>Ngày tạo</th>
						      <th></th>
						    </tr>
						  </thead>
						  <tfoot>
						    <tr>
					    	  <th>Mã</th>
						      <th>Tên</th>
						      <th>Email</th>
						      <th>Điện thoại</th>
						      <th>Địa chỉ</th>
						      <th>Trạng thái</th>
						      <th>Ngày tạo</th>
						      <th></th>
						    </tr>
						    <tr>
						      <th colspan="8" class="ts-pager">
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
						  	<?php foreach ($client_data as $key => $value): ?>
						  	  <tr>
						      <td class="client_id"><?= $value['client_id'] ?></td>
						      <td class="fullname"><?= $value['fullname'] ?></td>
						      <td class="email"><?= $value['email'] ?></td>
						      <td class="phone"><?= $value['phone'] ?></td>
						      <td class="address"><?= $value['address'] ?></td>
						      <td class="status"><?php 
						      	switch ($value['status']) {
						      		case '1':
						      			echo 'Được thuê';
						      			break;
						      		case '2':
						      			echo 'Tạm khóa';
						      			break;
						      		case '3':
						      			echo 'Xác nhận thuê';
						      			break;
						      	}
						      ?></td>
						      <td><?= $value['date_used'] ?></td>
						      <td>
						      	<button type="button" class="edit" title="Sửa thông tin khách này"><i class="icofont-spanner"></i></button>
						      	<button type="button" class="edit-ok d-none" title="Hoàn tất sửa thông tin khách này"><i class="icofont-check"></i></button>
						      	<button type="button" class="remove" title="Xóa khách này"><i class="icofont-close-line"></i></button>
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