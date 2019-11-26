<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
	}

	public function index()
	{
		$rooms_data = $this->Home_model->all_room();
		$rooms_datajson = json_encode($this->Home_model->all_room(), true);
		$data = array('rooms_data' => $rooms_data,
						'rooms_datajson' => $rooms_datajson,
								//'rooms_data2' => $rooms_data
								);
		$this->load->view('templates/Header_client_view');
		$this->load->view('Home_view', $data);
		$this->load->view('templates/Bottom_client_view');
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */