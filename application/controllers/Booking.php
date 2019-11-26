<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Booking_model');
	}

	public function index()
	{
		
	}
	public function test()
	{
		// $a = date('d/m/Y');
		// $a = date_create("20/06/2019");
		// $a =  date_format(date_create_from_format("d/m/Y","20/06/2019"), "d/m/Y");
		// $b =  date_format(date_create_from_format("d/m/Y","19/07/2019"), "d/m/Y");
		// 
		
		// đoạn dưới là chèn chuỗi ngày lưu trú vào phòng
		$a1 = "20/06/2019";
		$a2 = "23/06/2019";
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
		echo '<pre>';
		var_dump($countt);
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
		$date_booked = $this->Booking_model->get_date_booked();
		echo '<pre>';
		var_dump($date_booked);
		//////
		// Sắp xếp ngày trong mảng rồi đưa vô lại		
		//////
		function date_sort($a, $b) {
		    return strtotime($a) - strtotime($b);
		}
		foreach ($date_booked as $key => &$value) {
			if($value['date_booked'])
			{
				$value['date_booked'] = json_decode($value['date_booked'], true);

				//chỗ này để chèn ngày vào. array_merge($a1,$a2)
				
				$value['date_booked'] = array_merge($value['date_booked'], $dadd);

				foreach ($value['date_booked'] as &$val) {
					$val = str_replace("/","-",$val);
				}
				usort($value['date_booked'], "date_sort");

				$value['date_booked'] = json_encode($value['date_booked'], true);
				$value['date_booked'] = str_replace("-","/",$value['date_booked']);
				echo '<pre>';
				var_dump($value['date_booked']);
			}

		}
		//end lưu chuỗi ngày lưu trú

		echo '<hr>';
		echo '<pre>';
		var_dump($date_booked);
		
		$aa =  "20/09/2019";
		$bb =  "20/09/2019";
		var_dump($aa);
		$a =  date_create_from_format("d/m/Y",$aa);
		$b =  date_create_from_format("d/m/Y",$bb);
		// $a = date_format($a, "d/m/Y");
		// var_dump($a);
		if($b > $a) 
			echo 'ngày '.$bb.' lớn hơn ngày '.$aa.'.'; 
		else if($b == $a) echo 'ngày '.$bb.' bằng chính ngày '.$aa.'.'; else echo 'ngày '.$bb.' nhỏ hơn ngày '.$aa.'.';
		// echo $a;
	}
	public function send_booking()
	{
		//
		// phần này là update lại thông tin của thằng khách
		//
		$client_id = $this->input->post('client_id');
		$email = $this->input->post('email');
		$fullname = $this->input->post('fullname');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');

		

		$room_id = $this->input->post('room_id');
		$checkin = $this->input->post('checkin');
		$checkout = $this->input->post('checkout');

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
				// var_dump($value['date_booked']);
				//chỗ này để chèn ngày vào. array_merge($a1,$a2)
				// var_dump($value['date_booked']);
				// var_dump($dadd);
				if(array_intersect($value['date_booked'],$dadd))
				{
					die(json_encode('booked'));
				}
				$value['date_booked'] = array_merge($value['date_booked'], $dadd);
				// var_dump($value['date_booked']);
				foreach ($value['date_booked'] as &$val) {
					// var_dump($val);
					$val = str_replace("/","-",$val);
				}
				// var_dump($value['date_booked']);
				usort($value['date_booked'], "date_sort");
				// var_dump($value['date_booked']);
				$value['date_booked'] = json_encode($value['date_booked'], true);
				$value['date_booked'] = str_replace("-","/",$value['date_booked']);
				$datebooked =  $value['date_booked'];
			}

		}

		$date_booked = $datebooked;
		// echo $date_booked;
		// $date_booked = stripslashes($date_booked);
		//end lưu chuỗi ngày lưu trú
		// var_dump($date_booked);
		// echo $date_booked;

		//set status = 3 vì book xong thì đợi confirm đi :))
		//email nếu status = 1 là ổn. 2 là bị khóa. 3 là cần xác nhận đơn hàng trước
		$status = '3';
		// echo $client_id;
		if($client_id)
		{
			if(!$email)
			{
				// nếu có id khách, nhưng khách xài thông tin cũ
				$datacl = compact("client_id", "status");
				if($this->Booking_model->send_bookingcl($datacl))
				{
					// cái này sẽ trả về true or false
					// echo 'update client ok';
				} else echo 'lỗi khi update client';
			} // khúc else dưới có vẻ dư, do khách xài lại thông tin cũ, mà khách cũng có thay đổi được địa chỉ email đâu :(
			else {
				// nếu có id khách, và khách update lại thông tin
				$datacl = compact("client_id", "fullname", "email", "phone", "address", "status");
				if($this->Booking_model->send_bookingcl($datacl))
				{
					// cái này sẽ trả về true or false
					// echo 'update client ok';
				} else echo 'lỗi khi update client';
			}
			
		} else 
		{
			// nếu là khách mới
			$datacl = compact("fullname", "email", "phone", "address", "status");
			$client_id = $this->Booking_model->send_bookingcl_new($datacl);
			if($client_id)
			{
				// cái này sẽ trả về id của thằng khách mới
				// echo 'tạo mới client ok';
				
			}
			 else echo 'lỗi khi tạo mới client';
		}


		// 
		// Phần này là booking thật sự :)) nhiều vấn đề z khi nào mới tốt nghiệp đc, khóc 1 dòng sông
		// 
		// room status = 1 là chờ confirm, 2 là chờ đến checkin, 3 là chờ checkout, 4 là đã checkout và thanh toán - tức là hoàn thành xong đơn này, 5 là đã hủy đơn
		
		// status bên dưới chắc reset lại của thằng trên :)) lười tạo var mới, khó compact. set status = 1 vì chờ confirm
		$status = '1';
		$total = $this->input->post('total');
		// $client_id ở trên
		$token = openssl_random_pseudo_bytes(16);
		$token = md5($token);
		$people = $this->input->post('people');
		$databk = compact("room_id", "status", "total", "checkin", "checkout", "client_id", "token", "people");
		if($this->Booking_model->send_bookingr($databk))
		{
			// cái này sẽ trả về id của order
			// echo 'tạo mới order ok';
			// tạo mới order ok thì cập nhật ngày ở cho phòng, kèm sắp xếp thứ tự ngày
			if($this->Booking_model->update_date_booked($room_id, $date_booked)) {
				//cập nhật date_booked ok
			}

			//giờ đến phần gửi mail cho khách
			try {
				$this->load->library('email');
			
				$this->email->from('baobab@huhuhihi.com', 'Baobab Homestay Da Nang');
				$this->email->to($email);
				// $this->email->cc('another@example.com');
				// $this->email->bcc('and@another.com');
				
				$this->email->subject('Xác thực đơn đặt phòng tại Baobab Homestay.');
				$this->email->message('Vui lòng xác thực đơn đặt phòng của bạn bằng đường dẫn bên dưới<br><br><strong><a href="'.base_url().'verify/'.$token.'"</a>'.base_url().'verify/'.$token.'</strong><br><br>Baobab Homestay kính chúc bạn có một kỳ nghỉ vui vẻ!');
				
				$this->email->send();
			} catch (Exception $e) {
				
			}
			

			echo json_encode('book-success');
			
		}  else echo 'lỗi khi tạo mới order';
	}


	public function info_client()
	{
		$client_id = $this->input->post('client_id');
		if($client_id)
		{
			$result = $this->Booking_model->info_client($client_id);
			die(json_encode($result, true));
		}
		$email = $this->input->post('email');
		$emailToName = $this->input->post('emailToName');
		// echo $emailToName;
		if($emailToName)
		{
			$result = $this->Booking_model->info_client_safe($emailToName);
			die(json_encode($result, true));
		}
		$result = $this->Booking_model->info_client_safe($email);
		// var_dump($result);
		foreach ($result as $key => &$value) {
			for($i = 1; $i <= mb_strlen($value['fullname'],'UTF-8')-1; $i++)
			{
				if($i%4 == 0)
				{	if($value['fullname'][$i]!=" ")
					$value['fullname'][$i] = 'x';
					else
					{
						$value['fullname'][$i-1] = 'x';
						$value['fullname'][$i] = 'x';
					}
					
				}
				if($value['fullname'][$i]==" ") $value['fullname'][$i] = 'x';
			}
			$value['fullname'] = iconv("UTF-8", "UTF-8//IGNORE", $value['fullname']);

			for($i = 1; $i <= mb_strlen($value['address'],'UTF-8')-1; $i++)
			{	
				if($i%4 == 0)
				{	if($value['address'][$i]!=" ")
					{
						$value['address'][$i] = 'x';
					}
					else $value['address'][$i-1] = 'x';
				}
				if($value['address'][$i]==" ") $value['address'][$i] = 'x';
			}
			$value['address'] = iconv("UTF-8", "UTF-8//IGNORE", $value['address']);
			for($i = 0; $i <= strlen($value['phone'])-1; $i++)
			{
				if ($i > FLOOR(strlen($value['phone'])/2))
			    	$value['phone'][$i] = 'x';
			}
		}
		//var_dump($result);
		if($result)
		{
			echo json_encode($result);
		}
	}
	public function checkPhone()
	{
		$client_id = $this->input->post('client_id');
		$phone = $this->input->post('phone');
		$data = $this->Booking_model->checkPhone($client_id);
		if($data[0]['phone'])
		{
			if($phone == $data[0]['phone'])
				echo json_encode('match');
			else echo json_encode('wrong');
		}
	}

	public function check_email()
	{
		$email = $this->input->post('email');
		$status = $this->Booking_model->check_email($email);
		foreach ($status as $value) {

			$status = $value['status'];
		}
		if($status)
		{
			echo json_encode($status);
		} else  
		{
			// echo 'chưa tồn tại email';
			echo json_encode('0');
		}
		// email nếu status = 1 là ổn. 2 là bị khóa. 3 là cần xác nhận đơn hàng trước
		// echo 'Đây là status của email: '; var_dump($status);
		// switch ($status) {
		// 	case expr:
		// 		// code...
		// 		break;
			
		// 	default:
		// 		// code...
		// 		break;
		// }
	}
	public function checkAvailability()
	{// đặt tên biến có nhiều cách, cách này là lạc đà camel thì phải. còn cái trên dùng _ đặt giữa. nói chung đặt biến cần đồng bộ, không nên đặt lộn xộn

		// tạo ra một mảng chuỗi ngày lưu trú
		$checkin = $this->input->post('checkin');
		$checkout = $this->input->post('checkout');
		$date_tmp = "";
		$dates = array();
		array_push($dates, $checkin);
		// thêm chấm nhẽo trước định dạng ngày để đưa giờ về 00:00:00
		$checkin = date_create_from_format("!d/m/Y",$checkin);
		$checkout = date_create_from_format("!d/m/Y",$checkout);
		date_sub($checkout,date_interval_create_from_date_string("1 days"));
		$num = 0;
		$count = date_diff($checkin, $checkout);
		$count = json_decode(json_encode($count), True);
		$num = $count['days'];
		for($i=1; $i<=$num; $i++)
		{
			date_add($checkin,date_interval_create_from_date_string("1 days"));
			$date_tmp = date_format($checkin, "d/m/Y");
			array_push($dates, $date_tmp);
		}
		// kết thúc tạo mảng chuỗi ngày lưu trú
		
		// đối chiếu chuỗi ngày lưu trú với chuỗi ngày đã được đặt của từng phòng. nếu trung 1 ngày nào sẽ loại phòng đó ra
		$people = $this->input->post('people');
		$getPeopleResult = $this->Booking_model->getPeople($people);
		// tạo mảng rooms_id để chứa id các phòng phù hợp
		$rooms_id = array();
		foreach ($getPeopleResult as $key => $value) {
			// gán những ngày đã được đặt của từng phòng vào $date_booked
			$date_booked = json_decode($value['date_booked'], true);
			// gán các ngày trùng của 2 chuỗi ngày sau khi so sánh vào $result
			$result = array_intersect($dates,$date_booked);
			// kiểm tra xem nếu không có giá trị nào trong mảng result thì thêm id phòng đó vào rooms_id
			if(!$result)
			{
				array_push($rooms_id, $value['room_id']);
			}
		}
		// đưa mảng id phòng thành json rồi trả lại cho client
		$rooms_id = json_encode($rooms_id, true);
		echo $rooms_id;
	}

}

/* End of file Booking.php */
/* Location: ./application/controllers/Booking.php */