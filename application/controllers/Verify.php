<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verify extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Verify_model');
	}

	function _remap($input) {
        $this->index($input);
    }

	public function index($input = null)
	{
		if($input === null)
		{
			Show_404();
		}

		$data = $this->Verify_model->getT($input);
		if($data)
		{
			$status = $data[0]['status'];
			$client_id = $data[0]['client_id'];
			switch ($status) {
				case 1:
					{
						$status = 2;
						$this->Verify_model->updateT($input, $status);
						$this->Verify_model->updateC($client_id, 2);

						$this->session->set_flashdata('msg','<p class="alert-success p-3">Thông tin đặt phòng của bạn đã được xác thực. Cảm ơn bạn đã sử dụng dịch vụ. Hẹn sớm gặp bạn tại Baobab!</p>');
				        $this->load->view('templates/Header_client_view');
				        $this->load->view('Verify_view');
				        $this->load->view('templates/Bottom_client_view');
					}
					break;
				case 2:
				{
						$this->session->set_flashdata('msg','<p class="alert-info p-3">Thông tin đặt phòng của bạn đã được xác thực. Vui lòng đến checkin. Cảm ơn bạn đã sử dụng dịch vụ. Hẹn sớm gặp bạn tại Baobab!</p>');
				        $this->load->view('templates/Header_client_view');
				        $this->load->view('Verify_view');
				        $this->load->view('templates/Bottom_client_view');
				}
					break;
				default:
				{
					$this->session->set_flashdata('msg','<p class="alert-danger p-3">Thông tin đặt phòng của bạn không thể xác thực. Xin vui lòng liên hệ chúng tôi. Cảm ơn bạn đã sử dụng dịch vụ!</p>');
			        $this->load->view('templates/Header_client_view');
			        $this->load->view('Verify_view');
			        $this->load->view('templates/Bottom_client_view');
				}	
					break;
			}

			
		} else {
			$this->session->set_flashdata('msg','<p class="alert-danger p-3">Thông tin đặt phòng của bạn không thể xác thực. Xin vui lòng liên hệ chúng tôi. Cảm ơn bạn đã sử dụng dịch vụ!</p>');
	        $this->load->view('templates/Header_client_view');
	        $this->load->view('Verify_view');
	        $this->load->view('templates/Bottom_client_view');
		}
		// echo $data[0]['token'];
		// echo '<br>';
		// echo $data[0]['status'];
		// var_dump($data);
		// $this->load->view('templates/header_client_view');
		// $this->load->view('verify_view');
		// $this->load->view('templates/bottom_client_view');
		
	}

}

/* End of file Verify.php */
/* Location: ./application/controllers/Verify.php */