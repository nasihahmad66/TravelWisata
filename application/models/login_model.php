<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function CeckLogin($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		return $this->db->get('admin')->result();
	}

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */