<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function check_email($email)
	{
		
		$this->db->select('status');
		$this->db->where('email', $email);
		$result = $this->db->get('client');
		$result = $result->result_array();
		return $result;
	}
	public function info_client($client_id)
	{
		$this->db->select('*');
		$this->db->where('client_id', $client_id);
		$result = $this->db->get('client');
		$result = $result->result_array();
		return $result;
	}
	public function info_client_safe($email)
	{
		$this->db->select('client_id, fullname, phone, address');
		$this->db->where('email', $email);
		$result = $this->db->get('client');
		$result = $result->result_array();
		return $result;
	}
	public function checkPhone($client_id)
	{
		$this->db->select('phone');
		$this->db->where('client_id', $client_id);
		$result = $this->db->get('client');
		$result = $result->result_array();
		return $result;

	}
	public function send_bookingcl_new($datacl)
	{
		$this->db->insert('client', $datacl);
		return $this->db->insert_id();
	}
	public function send_bookingcl($datacl)
	{
		$this->db->where('client_id', $datacl['client_id']);
		return $this->db->update('client', $datacl);
	}
	public function send_bookingr($databk)
	{
		$this->db->insert('orders', $databk);
		return $this->db->insert_id();
	}
	public function get_date_booked($room_id)
	{
		$this->db->select('date_booked');
		$this->db->where('room_id', $room_id);
		$date_booked = $this->db->get('room');
		$date_booked = $date_booked->result_array();
		return $date_booked;
	}
	public function update_date_booked($room_id, $date_booked)
	{
		$date_booked = array('date_booked'=>$date_booked);
		$this->db->where('room_id', $room_id);
		return $this->db->update('room', $date_booked);
	}
	function getPeople($people)
	{
		$this->db->select('room_id, people, date_booked');
		$this->db->where('people >= '.$people);
		$getPeopleResult = $this->db->get('room');
		$getPeopleResult = $getPeopleResult->result_array();
		return $getPeopleResult;
	}

}

/* End of file Booking_model.php */
/* Location: ./application/models/Booking_model.php */