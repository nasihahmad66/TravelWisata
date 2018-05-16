<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('wisata_model');
	}

	public function index()
	{
		$data['main_view'] = 'user/home_view';
		$data['loader'] = 'loader';
		return $this->load->view('user/template', $data);
	}

	public function GetDataWisata()
	{
		$result = $this->wisata_model->GetWisataHavePaket();

		echo json_encode($result);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */