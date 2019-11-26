<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
	}

	public function index()
	{
		// nếu chưa đăng nhập, chuyển sang trang đăng nhập
		if($this->session->userdata('logged_in') !== TRUE){
			$this->load->view('templates/admin/Header_admin_view');
			$this->load->view('Login_view');
			$this->load->view('templates/admin/Bottom_admin_view');
		}

		// nếu session đăng nhập còn, có thể truy cập view admin
		else {
				//Allowing akses to admin only, chỉ cho phép admin truy cập
				if($this->session->userdata('level')==='1'){
					// $this->load->view('templates/admin/Header_admin_view');
					// $this->load->view('Admin_view');
					// $this->load->view('templates/admin/Dashboard_view');
					// $this->load->view('templates/admin/Bottom_admin_view');
					redirect('admin/room','refresh');
				} else{
					// sau này viết thêm phân viên cho quản gia vs đầy tớ vào chỗ này
					echo "<center>Truy cập bị từ chối! Vui lòng liên hệ Quản lí.";
					echo '<a href="'.base_url('admin/logout').'">(Quay lại)</a></center>';
				}
		}

	}
	function test()
	{
		$this->Admin_model->get_rooms();
	}
	function delcl()
	{
		$client_id = $this->input->post('client_id');
		if($this->Admin_model->remove_client($client_id))
		{
			die(json_encode('ok'));
		}
	}
	function delo()
	{
		$order_id = $this->input->post('order_id');
		if($this->Admin_model->remove_orders($order_id))
		{
			die(json_encode('ok'));
		}
	}
	function deloUp()
	{
		$order_id = $this->input->post('order_id');
		$client_id = $this->input->post('client_id');
		$status = $this->input->post('status_client');
		$checkin = $this->input->post('checkin');
		$checkout = $this->input->post('checkout');
		$room_id = $this->input->post('room_id');

		$a1 = $checkin;
		$a2 = $checkout;
		$a3 = "";
		$dadd = array();
		array_push($dadd, $a1);
		$a1 = date_create_from_format("d/m/Y",$a1);
		$a2 = date_create_from_format("d/m/Y",$a2);
		date_sub($a2,date_interval_create_from_date_string("1 days"));
		// giảm ngày đi xuống 1 ngày cho đủ số ngày ở, chỉ tính đêm lưu trú
		$count = 0;
		$countt = date_diff($a1,$a2);
		$countt = json_decode(json_encode($countt), True);
		
		foreach ($countt as $value) {
			$count = $countt['days'];
		}
		$count = $count;
		for($i=1; $i<=$count; $i++)
		{
			date_add($a1,date_interval_create_from_date_string("1 days"));
			$a3 = date_format($a1, "d/m/Y");
			array_push($dadd, $a3);
		}
		// xác định chuỗi ngày lưu trú rồi đặt vô đây
		$this->load->model('Booking_model');
		$date_booked = $this->Booking_model->get_date_booked($room_id);
		// var_dump($date_booked);
		//////
		// Sắp xếp ngày trong mảng rồi đưa vô lại		
		//////
		function date_sort($a, $b) {
		    return strtotime($a) - strtotime($b);
		}
		foreach ($date_booked as $key => &$value) {
			// var_dump($value);
			if($value['date_booked'])
			{
				$value['date_booked'] = json_decode($value['date_booked'], true);
				
				if(array_diff($value['date_booked'],$dadd))
				{
					$datebooked = array_diff($value['date_booked'],$dadd);
				}
			}

		}
		$ddd = array();
		foreach ($datebooked as $key => $value) {
			array_push($ddd, $value);
		}
		$date_booked = stripslashes(json_encode($ddd, true));
		$this->Booking_model->update_date_booked($room_id, $date_booked);

		if ($status == '0') {
			if($this->Admin_model->remove_orders($order_id))
			{
				die(json_encode('ok'));
			}
		} else if(($status == '1') || ($status == '2') || ($status == '3'))
		{
			$data = compact("client_id", "status");
			if($this->Admin_model->updatestt_lient($data))
			{
				if($this->Admin_model->remove_orders($order_id))
				{
					die(json_encode('ok'));
				}
			}
		}
	}
	function client()
	{
		if($this->session->userdata('logged_in')!==TRUE)
		{
			Show_404();
		}
		if($this->session->userdata('level')==='1'){
			$this->load->view('templates/admin/Header_admin_view');
			$this->load->view('Admin_view');

			$client_data = $this->Admin_model->get_client();
			$client_data = array('client_data' => $client_data,
								//'rooms_data2' => $rooms_data
								);
			$this->load->view('templates/admin/Client_view', $client_data);
			$this->load->view('templates/admin/Bottom_admin_view');
			// echo '<pre>';
			// var_dump($rooms_data);
			// var_dump($rooms_data);
		} else{
			// sau này viết thêm phân viên cho quản gia vs đầy tớ vào chỗ này
			echo "<center>Truy cập bị từ chối! Vui lòng liên hệ Quản lí.";
			echo '<a href="'.base_url('admin/logout').'">(Quay lại)</a></center>';
		}
	}
	function client_modify()
	{
		if($this->session->userdata('logged_in')!==TRUE)
		{
			Show_404();
		}
		if($this->session->userdata('level')==='1'){

			$client_id = $this->input->post('client_id');
			$fullname = $this->input->post('fullname');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$address = $this->input->post('address');
			$status = $this->input->post('status');

			$client_data = compact("client_id", "fullname", "email", "phone", "address", "status");

			if($this->Admin_model->update_lient($client_data))
			{
				die(json_encode('ok'));
			}

			// echo '<pre>';
			// var_dump($rooms_data);
			// var_dump($rooms_data);
		} else{
			// sau này viết thêm phân viên cho quản gia vs đầy tớ vào chỗ này
			echo "<center>Truy cập bị từ chối! Vui lòng liên hệ Quản lí.";
			echo '<a href="'.base_url('admin/logout').'">(Quay lại)</a></center>';
		}
	}
	function account()
	{
		if($this->session->userdata('logged_in')!==TRUE)
		{
			Show_404();
		}
		if($this->session->userdata('level')==='1'){
			$this->load->view('templates/admin/Header_admin_view');
			$this->load->view('Admin_view');

			$user_data = $this->Admin_model->get_user();
			$user_data = array('user_data' => $user_data,
								//'rooms_data2' => $rooms_data
								);
			$this->load->view('templates/admin/Account_view', $user_data);
			$this->load->view('templates/admin/Bottom_admin_view');
			// echo '<pre>';
			// var_dump($rooms_data);
			// var_dump($rooms_data);
		} else{
			// sau này viết thêm phân viên cho quản gia vs đầy tớ vào chỗ này
			echo "<center>Truy cập bị từ chối! Vui lòng liên hệ Quản lí.";
			echo '<a href="'.base_url('admin/logout').'">(Quay lại)</a></center>';
		}
	}
	function account_modify()
	{
		if($this->session->userdata('logged_in')!==TRUE)
		{
			Show_404();
		}
		if($this->session->userdata('level')==='1'){

			$user_id = $this->input->post('user-id');
			$user_name = $this->input->post('user-name');
			$password = $this->input->post('password');

			$user_data = compact("user_id", "user_name", "password");

			if($this->Admin_model->update_user($user_data))
			{
				$this->session->set_flashdata('msg_user_update','<div class="alert alert-success" role="alert">Thông tin tài khoản '.$user_name.' đã được cập nhật!</div>');
				redirect('admin/room','refresh');
			}

			// echo '<pre>';
			// var_dump($rooms_data);
			// var_dump($rooms_data);
		} else{
			// sau này viết thêm phân viên cho quản gia vs đầy tớ vào chỗ này
			echo "<center>Truy cập bị từ chối! Vui lòng liên hệ Quản lí.";
			echo '<a href="'.base_url('admin/logout').'">(Quay lại)</a></center>';
		}
	}
	function orders()
	{
		if($this->session->userdata('logged_in')!==TRUE)
		{
			Show_404();
		}
		if($this->session->userdata('level')==='1'){
			$this->load->view('templates/admin/Header_admin_view');
			$this->load->view('Admin_view');

			$orders_data = $this->Admin_model->get_orders();
			$rooms_data = $this->Admin_model->getRooms();
			$clients_data = $this->Admin_model->getClients();
			$orders_data = array('orders_data' => $orders_data,
								'rooms_data' => $rooms_data,
								'clients_data' => $clients_data
								);
			$this->load->view('templates/admin/Orders_view', $orders_data);
			$this->load->view('templates/admin/Bottom_admin_view');
			// echo '<pre>';
			// var_dump($rooms_data);
			// var_dump($rooms_data);
		} else{
			// sau này viết thêm phân viên cho quản gia vs đầy tớ vào chỗ này
			echo "<center>Truy cập bị từ chối! Vui lòng liên hệ Quản lí.";
			echo '<a href="'.base_url('admin/logout').'">(Quay lại)</a></center>';
		}
	}

	function room()
	{
		if($this->session->userdata('logged_in')!==TRUE)
		{
			Show_404();
		}
		if($this->session->userdata('level')==='1'){
			$this->load->view('templates/admin/Header_admin_view');
			$this->load->view('Admin_view');
			$rooms_data = $this->Admin_model->get_rooms();
			$data = array('rooms_data' => $rooms_data,
								//'rooms_data2' => $rooms_data
								);
			$this->load->view('templates/admin/Room_view', $data);
			$this->load->view('templates/admin/Bottom_admin_view');
			// echo '<pre>';
			// var_dump($rooms_data);
			// var_dump($rooms_data);
		} else{
			// sau này viết thêm phân viên cho quản gia vs đầy tớ vào chỗ này
			echo "<center>Truy cập bị từ chối! Vui lòng liên hệ Quản lí.";
			echo '<a href="'.base_url('admin/logout').'">(Quay lại)</a></center>';
		}
	}
	function remove_room()
	{
		// kiểm tra nếu là ad và đã login thì được phép xóa qua url
		// kiểm tra login
		if($this->session->userdata('logged_in')===TRUE)
		{
			// kiểm tra có phải ad không
			if($this->session->userdata('level')==='1')
			{
				$room_id = $this->input->post('id');
				// echo $room_id;
				if($this->Admin_model->remove_room($room_id))
				{
					echo json_encode('xóa thành công');
					//redirect('admin/room','refresh');
				} //echo 'xóa thất bại';
				
			} else
			{
				// sau này viết thêm phân viên cho quản gia vs đầy tớ vào chỗ này
				echo "<center>Truy cập bị từ chối! Vui lòng liên hệ Quản lí.";
				echo '<a href="'.base_url('admin/logout').'">(Quay lại)</a></center>';
			}
		} else Show_404();
			
	}
	function update_room()
	{
		if($this->session->userdata('logged_in')===TRUE)
		{
			// kiểm tra có phải ad không
			if($this->session->userdata('level')==='1')
			{
				$room_id = $this->input->post('room_id');
				$name = $this->input->post('room-name');
				$price = $this->input->post('room-price');
				$short_desc = $this->input->post('room-short-desc');
				$long_desc = $this->input->post('room-long-desc');
				$people = $this->input->post('room-people');
				if(!$this->input->post('features')){
					$features = "";
				} else
				$features = json_encode($this->input->post('features'));
				
				$square = $this->input->post('room-square');

				// khai báo cài đặt upload library
				$config['upload_path']          = './uploads/images/room/';
		        $config['allowed_types']        = 'gif|jpg|png';
		        $config['max_size']             = 5000;
		        $config['overwrite'] = TRUE;
			    $config['encrypt_name'] = FALSE;
			    $config['remove_spaces'] = TRUE;
		        // $config['max_width']            = 800;
		        // $config['max_height']           = 480;

			    // gọi thư viện upload kèm theo cấu hình ở trên
		        $this->load->library('upload', $config);
				// Upload ảnh
				// kiểm tra tên file, nếu có thì up load rồi lấy tên file sau upload, ko có thì gán rỗng cho tên file
				// $check_thumb_room = getimagesize($_FILES["room-thumbnail-image"]["tmp_name"]);
				// echo $_FILES["room-thumbnail-image"]["tmp_name"].'hic';
				// exit();
				if(!($_FILES["room-thumbnail-image"]["name"])){
					$thumbnail_image = "";
				}
				 else { 
				 	// do upload
				 	if($this->upload->do_upload('room-thumbnail-image')){
						$thumbnail_image = $this->upload->data('file_name');
				 	} else {
				 		$this->session->set_flashdata('msg_room_update','<div class="alert alert-danger" role="alert">Ảnh đại diện của phòng <strong>'.$name.'</strong> bị lỗi, vui lòng kiểm tra lại hoặc thay đổi hình khác!</div>');
						redirect('admin/room','refresh');
				 	}
				 	
					// $room_thumbnail_data = $this->upload->data();
					// get file name after upload
				}

				// upload thư viện ảnh
				if(empty($_FILES['room-gallery-image']))
				{ //!($_FILES["room-gallery-image"]["name"])
					$gallery_image = "";
				} else 
				{
					$gallery_image = array();
					// đếm xem có bao nhiêu file ảnh
					$filesCount = count($_FILES['room-gallery-image']['name']);
					for( $i = 0; $i < $filesCount; $i++)
					{
						$_FILES['file']['name']     = $_FILES['room-gallery-image']['name'][$i];
		                $_FILES['file']['type']     = $_FILES['room-gallery-image']['type'][$i];
		                $_FILES['file']['tmp_name'] = $_FILES['room-gallery-image']['tmp_name'][$i];
		                $_FILES['file']['error']    = $_FILES['room-gallery-image']['error'][$i];
		                $_FILES['file']['size']     = $_FILES['room-gallery-image']['size'][$i];

		                // upload file to server
		                if($this->upload->do_upload('file'))
		                {
		                	// uploaded file
		                	$gallery_image_data = $this->upload->data();
		                	// echo '<pre>';
		                	// var_dump($gallery_image_data);
		                	$gallery_image[$i] = $gallery_image_data['file_name'];
		                	//var_dump($gallery_image_data[$i]['file_name']) ;
		                } else 
		                {
		                	$this->session->set_flashdata('msg_room_update','<div class="alert alert-danger" role="alert">Ảnh thuộc bộ sưu tập ảnh phòng <strong>'.$name.'</strong> bị lỗi, vui lòng kiểm tra lại hoặc thay đổi hình khác!</div>');
							redirect('admin/room','refresh');
		                }

					}

					// nếu có tên file của ảnh trong gallery thì gán nó vào mảng $gallery_image
					// if(!empty($upload_data))
					// {

					// }
					$gallery_image = json_encode($gallery_image);
					// echo '<pre>';
					// var_dump($gallery_image);
					// echo '<pre>';
					// var_dump($thumbnail_image);
					// echo '<pre>';
					// var_dump($features);
				}


				//bây giờ gán hết thông tin có được vô trong 1 biến gồm tập hợp biến
				$room_data_update = compact("room_id", "name", "price", "short_desc", "long_desc", "people", "features", "thumbnail_image", "gallery_image", "square");
				
				// đóng gói xong, giờ gửi data này sang model làm việc của nó
				// nếu model thêm phòng thành công sẽ trả về true
				if($this->Admin_model->update_room($room_data_update)){
					//nếu thêm ok, thì gán thông báo thành công vô session
					$this->session->set_flashdata('msg_room_update','<div class="alert alert-success" role="alert">Cập nhật thông tin phòng <strong>'.$name.'</strong> thành công!</div>');
					// echo $room_id;
					redirect('admin/room','refresh');
				} else {
					$this->session->set_flashdata('msg_room_update','<div class="alert alert-danger" role="alert">Cập nhật thông tin phòng <strong>'.$name.'</strong> thất bại!</div>');
					redirect('admin/room','refresh');
				}
				
			} else
			{
				// sau này viết thêm phân viên cho quản gia vs đầy tớ vào chỗ này
				echo "<center>Truy cập bị từ chối! Vui lòng liên hệ Quản lí.";
				echo '<a href="'.base_url('admin/logout').'">(Quay lại)</a></center>';
			}
		} else Show_404();
		
	}
	function add_room()
	{
		$name = $this->input->post('room-name');
		$price = $this->input->post('room-price');
		$short_desc = $this->input->post('room-short-desc');
		$long_desc = $this->input->post('room-long-desc');
		$people = $this->input->post('room-people');
		if(!$this->input->post('features')){
			$features = "";
		} else
		$features = json_encode($this->input->post('features'));
		
		$square = $this->input->post('room-square');

		// khai báo cài đặt upload library
		$config['upload_path']          = './uploads/images/room/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000;
        $config['overwrite'] = TRUE;
	    $config['encrypt_name'] = FALSE;
	    $config['remove_spaces'] = TRUE;
        // $config['max_width']            = 800;
        // $config['max_height']           = 480;

	    // gọi thư viện upload kèm theo cấu hình ở trên
        $this->load->library('upload', $config);
		// Upload ảnh
		// kiểm tra tên file, nếu có thì up load rồi lấy tên file sau upload, ko có thì gán rỗng cho tên file
		// $check_thumb_room = getimagesize($_FILES["room-thumbnail-image"]["tmp_name"]);
		if(!($_FILES["room-thumbnail-image"]["name"])){
			$thumbnail_image = "";
		}
		 else { 
		 	// do upload
		 	if($this->upload->do_upload('room-thumbnail-image')){
				$thumbnail_image = $this->upload->data('file_name');
		 	} else {
		 		$this->session->set_flashdata('msg_room_add','<div class="alert alert-danger" role="alert">Ảnh đại diện của phòng <strong>'.$name.'</strong> bị lỗi, vui lòng kiểm tra lại hoặc thay đổi hình khác!</div>');
				redirect('admin/room','refresh');
		 	}
		 	
			// $room_thumbnail_data = $this->upload->data();
			// get file name after upload
		}

		// upload thư viện ảnh
		if(empty($_FILES['room-gallery-image']))
		{ //!($_FILES["room-gallery-image"]["name"])
			$gallery_image = "";
		} else 
		{
			$gallery_image = array();
			// đếm xem có bao nhiêu file ảnh
			$filesCount = count($_FILES['room-gallery-image']['name']);
			for( $i = 0; $i < $filesCount; $i++)
			{
				$_FILES['file']['name']     = $_FILES['room-gallery-image']['name'][$i];
                $_FILES['file']['type']     = $_FILES['room-gallery-image']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['room-gallery-image']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['room-gallery-image']['error'][$i];
                $_FILES['file']['size']     = $_FILES['room-gallery-image']['size'][$i];

                // upload file to server
                if($this->upload->do_upload('file'))
                {
                	// uploaded file
                	$gallery_image_data = $this->upload->data();
                	// echo '<pre>';
                	// var_dump($gallery_image_data);
                	$gallery_image[$i] = $gallery_image_data['file_name'];
                	//var_dump($gallery_image_data[$i]['file_name']) ;
                } else 
                {
                	$this->session->set_flashdata('msg_room_add','<div class="alert alert-danger" role="alert">Ảnh thuộc bộ sưu tập ảnh phòng <strong>'.$name.'</strong> bị lỗi, vui lòng kiểm tra lại hoặc thay đổi hình khác!</div>');
					redirect('admin/room','refresh');
                }

			}

			// nếu có tên file của ảnh trong gallery thì gán nó vào mảng $gallery_image
			// if(!empty($upload_data))
			// {

			// }
			$gallery_image = json_encode($gallery_image);
			// echo '<pre>';
			// var_dump($gallery_image);
			// echo '<pre>';
			// var_dump($thumbnail_image);
			// echo '<pre>';
			// var_dump($features);
		}


		//bây giờ gán hết thông tin có được vô trong 1 biến gồm tập hợp biến
		$room_data_create = compact("name", "price", "short_desc", "long_desc", "people", "features", "thumbnail_image", "gallery_image", "square");
		
		// đóng gói xong, giờ gửi data này sang model làm việc của nó
		// nếu model thêm phòng thành công sẽ trả về true
		if($this->Admin_model->create_room($room_data_create)){
			//nếu thêm ok, thì gán thông báo thành công vô session
			$this->session->set_flashdata('msg_room_add','<div class="alert alert-success" role="alert">Thêm mới phòng <strong>'.$name.'</strong> thành công!</div>');
			redirect('admin/room','refresh');
		} else {
			$this->session->set_flashdata('msg_room_add','<div class="alert alert-danger" role="alert">Thêm mới phòng <strong>'.$name.'</strong> thất bại!</div>');
			redirect('admin/room','refresh');
		}


		// var_dump($room_features) ;
		// echo 'Tên phòng là: '.$room_name.'<br>';
		// echo 'Giá phòng là: '.$room_price.'<br>';
		// echo 'Tên file ảnh là: '.$room_thumbnail_image.'<br>';
		// echo 'mô tả ngắn phòng là: '.$room_short_desc.'<br>';
		// echo 'số người của phòng là: '.$room_people.'<br>';
		// echo 'tiện ích đi kèm của phòng là: ';
		// foreach($_POST['features'] as $features){
		// echo $features."</br>";
		// }
		// echo '<br>';
	}

	function auth(){
	    $email    = $this->input->post('email',TRUE);
	    $password = md5($this->input->post('password',TRUE));
	    $validate = $this->Admin_model->validate($email,$password);
	    if($validate->num_rows() > 0){
	        $data  = $validate->row_array();
	        $name  = $data['user_name'];
	        $email = $data['user_email'];
	        $level = $data['user_level'];
	        $sesdata = array(
	            'username'  => $name,
	            'email'     => $email,
	            'level'     => $level,
	            'logged_in' => TRUE
	        );
	        $this->session->set_userdata($sesdata);
	        // access login for admin
	        if($level === '1'){
	            redirect('admin');
	 
	        // access login for staff
	        }elseif($level === '2'){
	            redirect('page/staff');
	 
	        // access login for author
	        }else{
	            redirect('page/author');
	        }
	    }else{
	        $this->session->set_flashdata('msg','Tài khoản hoặc mật khẩu sai!');
	        redirect('admin');
	    }
	  }
 
	  function logout(){
	      $this->session->sess_destroy();
	      redirect('admin');
	  }
	  function changepw(){
	  	$password = md5($this->input->post('rpassword'));
	  	$id = $this->input->post('iac');
	  	if($this->Admin_model->updatePW($password, $id)){
	  		$this->session->set_flashdata('msgs','Cập nhật mật khẩu thành công!');
	  		redirect('admin');
	  	} else Show_404();
	  }
	  function changepwa(){
	  	$id = $this->input->post('iac');
	  	$password = md5($this->input->post('rpassword'));
	  	if($this->Admin_model->updatePW($password, $id)){
	  		$this->session->set_flashdata('msgs','Cập nhật mật khẩu thành công!');
	  		redirect('admin/account');
	  	} else Show_404();
	  }
	  function reset($token){
	  	$data = $this->Admin_model->getEmailToken($token);
	  	if(!$data)
	  	{
	  		Show_404();
	  	} else 
	  	{
	  		if(!$data[0]['user_id'])
	  		{
	  			Show_404();
	  		} else 
	  		{
	  			$data = array('data' => $data);
	  			$this->load->view('templates/admin/Header_admin_view');

	  			$this->load->view('templates/admin/ChangePW_view', $data);

				$this->load->view('templates/admin/Bottom_admin_view');
	  		}
	  	}
	  }
	  function forget(){
	  	$email = $this->input->post('email');
	  	$data = $this->Admin_model->forget($email);
	  	// var_dump($data);
	  	if(!$data)
	  	{
	  		die(json_encode('2'));
	  	} else
	  	{
	  		if(!$data[0]['token'])
		  	{
				$token = openssl_random_pseudo_bytes(16);
				$token = md5($token);
		  		if($this->Admin_model->createTokenUser($email, $token)) 
		  		{
		  			$data = $this->Admin_model->forget($email);
		  			if($data[0]['token'])
		  			{
	  					try {
						$this->load->library('email');
					
						$this->email->from('baobab@huhuhihi.com', 'Baobab Homestay Da Nang');
						$this->email->to($email);
						
						$this->email->subject('Cập nhật mật khẩu tài khoản Baobab Homestay.');
						$this->email->message('Vui lòng cập nhật lại mật khẩu của bạn bằng đường dẫn sau: '.base_url().'admin/reset/'.$token);
						
						$this->email->send();
						} catch (Exception $e) {
							
						}

		  				die(json_encode('1'));
		  			} else die(json_encode('2'));
		  		}
		  	} else 
		  	{	$token = openssl_random_pseudo_bytes(16);
				$token = md5($token);
				if($this->Admin_model->createTokenUser($email, $token)) 
		  		{
		  			$data = $this->Admin_model->forget($email);
		  			if($data[0]['token'])
		  			{
			  		try {
						$this->load->library('email');
					
						$this->email->from('baobab@huhuhihi.com', 'Baobab Homestay Da Nang');
						$this->email->to($email);
						
						$this->email->subject('Cập nhật mật khẩu tài khoản Baobab Homestay.');
						$this->email->message('Vui lòng cập nhật lại mật khẩu của bạn bằng đường dẫn sau: '.base_url().'admin/reset/'.$token);
						
						$this->email->send();
					} catch (Exception $e) {
						
					}
		  			die(json_encode('1'));
		  			} else die(json_encode('2'));
		  		}
		  	}
		} 
	  }

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */