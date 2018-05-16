<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
    }

    public function index()
    {
        if ($this->session->userdata('login')!=true) {
            redirect('login','refresh');
        }else{
            $data['title'] = 'Transaksi';
            $data['main_view'] = 'transaksi_view';
            $data['loader'] = 'loader';
            return $this->load->view('template', $data);
        }
    }

    public function GetAllDataTransaksi()
    {
        $result = $this->transaksi_model->GetTransaksi();

        echo json_encode($result);
    }

    public function GetDetailTransaksi($ID_ORDER)
    {
        $result = $this->transaksi_model->GetDetail($ID_ORDER);
        echo json_encode($result);
    }

    public function ConfirmOrder()
    {
        $ID_ORDER = $this->input->post("ID");

        $result = $this->transaksi_model->Confirm($ID_ORDER);

        echo json_encode($result);
    }

    public function CancelOrder()
    {
        $ID_ORDER = $this->input->post("ID");

        $result = $this->transaksi_model->Cancel($ID_ORDER);

        echo json_encode($result);
    }

}

/* End of file wisata.php */
/* Location: ./application/controllers/wisata.php */