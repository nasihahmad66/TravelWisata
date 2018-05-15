<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paketharga extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('wisata_model');
		$this->load->model('paketharga_model');
	}

	public function index()
	{
		if ($this->session->userdata('login')!=true) {
			redirect('login','refresh');
		}else{
			$data['title'] = 'Wisata';
			$data['main_view'] = 'paketharga_view';
			$data['loader'] = 'loader';
			$this->load->view('template.php', $data);
		}
	}

	public function GetAllDataWisata()
	{
		$result = $this->wisata_model->GetWisata();

		echo json_encode($result);
	}

	public function GetAllDataPaketwisata()
	{
		$result = $this->paketharga_model->GetPaket();

		echo json_encode($result);
	}

	public function SaveData()
	{
		$data = $this->input->post("Data");
		$validasi = $this->paketharga_model->ValidasiPaket($data["ID_PAKET"],$data["ID_WISATA"], $data["NAMA_PAKET"]);
		if ($validasi) {
			if ($data["ID_PAKET"] == "") {
				$simpan = $this->paketharga_model->InsertPaket($data);
				if ($simpan) {
					echo json_encode('');
				}else{
					echo json_encode('Gagal Menyimpan Data');
				}
			}else{
				$update = $this->paketharga_model->UpdatePaket($data);
				if ($update) {
					echo json_encode('');
				}else {
					echo json_encode('Gagal Mengupdate Data');
				}
			}
		}else{
			echo json_encode("Nama paket pada wisata ini telah terdaftar");
		}
	}

}

/* End of file paketharga.php */
/* Location: ./application/controllers/paketharga.php */