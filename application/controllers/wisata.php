<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisata extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('wisata_model');
	}

	public function index()
	{
		if ($this->session->userdata('login')!=true) {
			redirect('login','refresh');
		}else{
			$data['title'] = 'Wisata';
			$data['main_view'] = 'wisata_view';
			$data['loader'] = 'loader';
			return $this->load->view('template', $data);
		}
	}

	public function GetAllDataWisata()
	{
		$result = $this->wisata_model->GetWisata();

		echo json_encode($result);
	}

	public function GetAllDataPaketHarga()
	{
		$result = $this->wisata_model->GetPaketHarga();

		echo json_encode($result);
	}

	public function SaveData()
	{
		$data = $this->input->post('Data');
		if ($data['ID_WISATA'] == "") {
			$result = $this->wisata_model->InsertWisata($data);
		}else{
			$result = $this->wisata_model->UpdateWisata($data);
		}

		echo $result;
	}

	public function DeleteWisata()
	{
		$ID_WISATA = $this->input->post("ID_WISATA");
		
	}

	public function UploadImage()
	{
		$id = $this->input->post("ID");

		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']  = '500';
		$config['file_name'] = md5($id);
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->overwrite = true;
		
		if ( ! $this->upload->do_upload("fileUpload")){
			$error = array('error' => $this->upload->display_errors());
			echo json_encode($error["error"]);
		}
		else{
			$data = array('upload_data' => $this->upload->data());
		}

		if ($data != null) {
			$filename = $data['upload_data']['file_name'];
			$status = $this->wisata_model->SetImage($id, $data['upload_data']['file_name']);
			echo json_encode($status);
		}
	}

}

/* End of file wisata.php */
/* Location: ./application/controllers/wisata.php */