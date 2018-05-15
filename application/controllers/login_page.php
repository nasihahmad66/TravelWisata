<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_page_model','login_model');
	}

	public function index()
	{
		if ($this->session->userdata('LOGIN') == true) {
			redirect('home','refresh');
		}else{
			$data['loader'] = 'loader';
			$this->load->view('user/login_view', $data);
		}
		
	}

	public function DoRegister()
	{
		$data = $this->input->post("Data");
		$message = $this->login_model->ValidasiUser($data["USERNAME_CUSTOMER"],$data["NOMOR_TELPON_CUSTOMER"]);
		if ($message == "") {
			$message = $this->login_model->SaveUser($data);
			echo json_encode($message);
			return;
		}else{
			echo json_encode($message);
			return;
		}
	}

	public function DoLogout()
	{
		session_destroy();
		redirect('login_page','refresh');
	}

}

/* End of file login_page.php */
/* Location: ./application/controllers/login_page.php */