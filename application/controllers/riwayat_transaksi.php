<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('riwayat_transaksi_model');
	}

	public function index()
	{
		if ($this->session->userdata('LOGIN') == true) {
			$data['main_view'] = 'user/riwayat_transaksi_view.php';
            $data['loader'] = 'loader';
            return $this->load->view('user/template', $data);
		}else{
			redirect('login_page','refresh');
		}
	}

	public function GetTransaksiUser()
    {
        $result = $this->riwayat_transaksi_model->GetTransaksi();

        echo json_encode($result);
    }

    public function GetDetailTransaksi($ID_ORDER)
    {
        $result = $this->riwayat_transaksi_model->GetDetail($ID_ORDER);
        echo json_encode($result);
    }

    public function UploadImage()
	{
		$id = $this->input->post("ID");

		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']  = '500';
		$config['file_name'] = md5("B".$id.$this->session->userdata('ID_CUSTOMER'));

		// $config['max_width']  = '1024';
		// $config['max_height']  = '768';
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->overwrite = true;
		
		if ( ! $this->upload->do_upload("fileUpload")){
			// $error = array('error' => $this->upload->display_errors());
			echo json_encode($this->upload->display_errors());
		}
		else{
			$data = array('upload_data' => $this->upload->data());
		}

		if ($data != null) {
			$filename = $data['upload_data']['file_name'];
			$status = $this->riwayat_transaksi_model->SetImage($id, $data['upload_data']['file_name']);
			echo json_encode($status);
		}
	}

	public function CancelOrder()
	{
		$ID_ORDER = $this->input->post("ID");

		$result = $this->riwayat_transaksi_model->Cancel($ID_ORDER);
		echo json_encode($result);
	}

}

/* End of file riwayat_transaksi.php */
/* Location: ./application/controllers/riwayat_transaksi.php */