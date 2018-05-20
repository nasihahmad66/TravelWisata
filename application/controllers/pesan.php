<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pesan_model');
		$this->load->model('riwayat_transaksi_model');
	}

	public function index($id)
	{
		if ($this->session->userdata('LOGIN') != true) {
			redirect('login_page','refresh');
		}else{
			$result = $this->pesan_model->getWisataPesan($id);
			$data["data"] = $result;
			$data['main_view'] = 'user/pesanan_view';
			$data['loader'] = 'loader';
			$this->load->view('user/template', $data);
		}
	}

	public function UbahPesanan($ID_ORDER)
	{
		if ($this->session->userdata('LOGIN') != true) {
			redirect('login_page','refresh');
		}else{
			$orderdata = $this->riwayat_transaksi_model->GetDetail($ID_ORDER);
			$this->session->set_flashdata('ID_PAKET', $orderdata->ID_PAKET);
			$result = $this->pesan_model->getWisataPesan($orderdata->ID_WISATA);
			$data["dataorder"] = json_encode($orderdata);
			$data["data"] = $result;
			$data['main_view'] = 'user/pesanan_view';
			$data['loader'] = 'loader';
			$this->load->view('user/template', $data);
		}
	}


	public function GetPaket($id)
	{
		$result = $this->pesan_model->getWisataPesan($id);
		echo json_encode($result);
	}

	public function ProsesPesan()
	{
		$data = $this->input->post("Data");
		if ($data["ID_ORDER"] == "") {
			$message = $this->pesan_model->SavePesanan($data);
		}else{
			$message = $this->pesan_model->UpdatePesanan($data);
		}
		echo json_encode($message);
	}

	public function GetKuota()
	{
		$data = $this->input->post("Data");
		$kuota = $this->pesan_model->CheckKuota($data);
		echo json_encode($kuota);
	}

}

/* End of file pesan.php */
/* Location: ./application/controllers/pesan.php */