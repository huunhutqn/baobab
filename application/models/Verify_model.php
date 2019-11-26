<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verify_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getT($input)
	{
		$this->db->select('token, status, client_id');
		$this->db->where('token', $input);
		$data = $this->db->get('orders');
		$data = $data->result_array();
		return $data;
	}
	public function updateT($input, $status)
	{
		$this->db->where('token', $input);
		$data = array("status"=>$status);
		return $this->db->update('orders', $data);
	}
	public function updateC($client_id, $status)
	{
		$this->db->where('client_id', $client_id);
		$data = array("status"=>$status);
		return $this->db->update('client', $data);
	}

}

/* End of file Verify_model.php */
/* Location: ./application/models/Verify_model.php */