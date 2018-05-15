<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		if ($this->session->userdata('login')!=true) {
			redirect('login','refresh');
		}else{
			$data['title'] = 'Dashboard';
			$data['main_view'] = 'dashboard_view';
			return $this->load->view('template', $data);
		}
		
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */