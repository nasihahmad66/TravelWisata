<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_page extends CI_Controller {

	public function index()
	{
		// $data['main_view'] = 'user/pesanan_view';
		$data['loader'] = 'loader';
		$this->load->view('user/login_view', $data);
	}

	public function DoRegister()
	{
		$data = $this->input->post("Data");
	}

}

/* End of file login_page.php */
/* Location: ./application/controllers/login_page.php */