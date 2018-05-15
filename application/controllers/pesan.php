<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pesan_model');
	}

	public function index($id)
	{
		$result = $this->pesan_model->getWisataPesan($id);
		$data["data"] = $result;
		$data['main_view'] = 'user/pesanan_view';
		$data['loader'] = 'loader';
		$this->load->view('user/template', $data);
	}


	public function GetPaket($id)
	{
		$result = $this->pesan_model->getWisataPesan($id);
		echo json_encode($result);
	}

}

/* End of file pesan.php */
/* Location: ./application/controllers/pesan.php */