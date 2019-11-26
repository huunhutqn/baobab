<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	function validate($email,$password){
	    $this->db->where('user_email',$email);
	    $this->db->where('user_password',$password);
	    $result = $this->db->get('user',1);
	    return $result;
	}

	function create_room($room_data_create)
	{
		$this->db->insert('room', $room_data_create);
		return $this->db->insert_id();
	}
	function update_room($room_data_update)
	{
		$this->db->where('room_id', $room_data_update['room_id']);
		return $this->db->update('room', $room_data_update);
	}
	function getRooms()
	{
		$this->db->select('room_id, name');
		$rooms = $this->db->get('room');
		$rooms = $rooms->result_array();
		return $rooms;
	}
	function get_rooms()
	{
		$this->db->select('*');
		$rooms = $this->db->get('room');
		$rooms = $rooms->result_array();
		foreach ($rooms as $key => $value) {
				$rooms[$key]['features'] = json_decode($value['features'], true);
				$rooms[$key]['gallery_image'] = json_decode($value['gallery_image'], true);
			// echo '<pre>';
			// echo $key.': '.var_dump($value['features']);
			// echo $key.': '.var_dump($value['gallery_image']);
		}
		// echo '<pre>';
		// var_dump($rooms);
		return $rooms;
	}
	function remove_room($user_id)
	{
		$this->db->where('room_id', $id);
		$this->db->delete('room');
		return $this->db->affected_rows();
	}

	function get_orders()
	{
		$this->db->select('*');
		$data = $this->db->get('orders');
		$data = $data->result_array();
		return $data;

	}
	function update_orders($orders_data)
	{
		$this->db->where('order_id', $orders_data['order_id']);
		return $this->db->update('orders', $orders_data);
	}
	function remove_orders($order_id)
	{
		$this->db->where('order_id', $order_id);
		$this->db->delete('orders');
		return $this->db->affected_rows();
	}

	function get_client()
	{
		$this->db->select('*');
		$data = $this->db->get('client');
		$data = $data->result_array();
		return $data;

	}
	function getClients()
	{
		$this->db->select('client_id, email');
		$data = $this->db->get('client');
		$data = $data->result_array();
		return $data;

	}
	function updatestt_lient($client_data)
	{
		$this->db->where('client_id', $client_data['client_id']);
		return $this->db->update('client', $client_data);
	}
	function update_lient($client_data)
	{
		$this->db->where('client_id', $client_data['client_id']);
		return $this->db->update('client', $client_data);
	}
	function remove_client($client_id)
	{
		$this->db->where('client_id', $client_id);
		$this->db->delete('client');
		return $this->db->affected_rows();
	}

	function get_user()
	{
		$this->db->select('*');
		$data = $this->db->get('user');
		$data = $data->result_array();
		return $data;

	}
	function update_user($user_data)
	{
		$this->db->where('user_id', $user_data['user_id']);
		return $this->db->update('user', $user_data);
	}
	function forget($email)
	{
		$this->db->select('token');
		$this->db->where('user_email', $email);
		$result = $this->db->get('user');
		$result = $result->result_array();
		return $result;
	}
	function updatePW($password, $id){
		$this->db->where('user_id', $id);
		$data = array('user_password' => $password);
		return $this->db->update('user', $data);
	}
	function getEmailToken($token) {
		$this->db->select('user_id');
		$this->db->where('token', $token);
		$result = $this->db->get('user');
		$result = $result->result_array();
		return $result;
	}
	function createTokenUser($email, $token){
		$this->db->where('user_email', $email);
		$data = array('token' => $token);
		return $this->db->update('user', $data);
	}

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */