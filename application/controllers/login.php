<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function DoLogin()
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$result = $this->login_model->CeckLogin($username, $password);
		if (count($result)>0) {
			$array = array(
				'login'		=> true,
				'ID_ADMIN'	=> $result[0]->ID_ADMIN,
				// 'USERNAME'	=> $result[0]->USERNAME,
				'NOMOR_TELPON'	=> $result[0]->NOMOR_TELPON,
				'ALAMAT'		=> $result[0]->ALAMAT
			);
			
			$this->session->set_userdata( $array );
			redirect('dashboard','refresh');
		}else{
			$this->session->set_flashdata('notif', 'username atau password salah');
			redirect('login','refresh');
		}
	}

	public function DoLogout()
	{
		session_destroy();
		redirect('login','refresh');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */