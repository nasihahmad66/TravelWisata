<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    public function GetTransaksi()
    {
    	$this->db->select('ID_ORDER, NAMA_WISATA, NAMA_PAKET, TANGGAL_BERANGKAT, TANGGAL_KEMBALI, TANGGAL_TRANSAKSI, KUOTA_PESAN, order.STATUS AS STATUS');
    	$this->db->join('paket_harga', 'paket_harga.ID_PAKET = order.ID_PAKET');
    	$this->db->join('wisata', 'wisata.ID_WISATA = paket_harga.ID_WISATA');
    	$this->db->order_by('order.STATUS', 'DESC');
        return $this->db->get('order')->result();
    }

    public function GetDetail($ID_ORDER)
    {
    	$this->db->select('ID_ORDER, NAMA_WISATA, NAMA_PAKET,KOTA , TANGGAL_BERANGKAT, TANGGAL_KEMBALI, KUOTA_PESAN,TOTAL_TRANSAKSI, order.STATUS AS STATUS, NAMA_CUSTOMER, NOMOR_TELPON_CUSTOMER, ALAMAT_CUSTOMER,BUKTI_BAYAR');

    	$this->db->where('order.ID_ORDER', $ID_ORDER);
    	$this->db->join('customer', 'customer.ID_CUSTOMER = order.ID_CUSTOMER');
    	$this->db->join('paket_harga', 'paket_harga.ID_PAKET = order.ID_PAKET');
    	$this->db->join('wisata', 'wisata.ID_WISATA = paket_harga.ID_WISATA');
    	$this->db->order_by('order.STATUS', 'DESC');
        return $this->db->get('order')->row();
    }

    public function Confirm($ID_ORDER)
    {
        $this->db->where('ID_ORDER', $ID_ORDER);
        $object = array(
            "STATUS" => "confirmed"
        );

        $this->db->update('order', $object);

        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function Cancel($ID_ORDER)
    {
        $this->db->where('ID_ORDER', $ID_ORDER);
        $object = array(
            "STATUS" => "canceled"
        );

        $this->db->update('order', $object);

        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

}

/* End of file wisata_model.php */
/* Location: ./application/models/wisata_model.php */