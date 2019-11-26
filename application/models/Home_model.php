<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	function all_room()
	{
		$this->db->select('*');
		$rooms = $this->db->get('room');
		$rooms = $rooms->result_array();
		foreach ($rooms as $key => $value) {
				$rooms[$key]['features'] = json_decode($value['features'], true);
				$rooms[$key]['gallery_image'] = json_decode($value['gallery_image'], true);
				$rooms[$key]['date_booked'] = json_decode($value['date_booked'], true);
			// echo '<pre>';
			// echo $key.': '.var_dump($value['features']);
			// echo $key.': '.var_dump($value['gallery_image']);
		}
		// echo '<pre>';
		// var_dump($rooms);
		return $rooms;
	}

}

/* End of file Home_model.php */
/* Location: ./application/models/Home_model.php */