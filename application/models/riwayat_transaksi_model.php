<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_transaksi_model extends CI_Model {

	public function GetTransaksi()
    {
    	$this->db->select('ID_ORDER, ID_CUSTOMER, NAMA_WISATA, NAMA_PAKET, TANGGAL_BERANGKAT, TANGGAL_KEMBALI, TANGGAL_TRANSAKSI, KUOTA_PESAN, order.STATUS AS STATUS');
    	$this->db->where('ID_CUSTOMER', $this->session->userdata('ID_CUSTOMER'));
    	$this->db->join('paket_harga', 'paket_harga.ID_PAKET = order.ID_PAKET');
    	$this->db->join('wisata', 'wisata.ID_WISATA = paket_harga.ID_WISATA');
    	$this->db->order_by('order.STATUS', 'DESC');
        return $this->db->get('order')->result();
    }

    public function GetDetail($ID_ORDER)
    {
    	$this->db->select('ID_ORDER, wisata.ID_WISATA, NAMA_WISATA, paket_harga.ID_PAKET, NAMA_PAKET,KOTA , TANGGAL_BERANGKAT, TANGGAL_KEMBALI, KUOTA_PESAN,TOTAL_TRANSAKSI, order.STATUS AS STATUS, NAMA_ADMIN, NOMOR_TELPON, ALAMAT,BUKTI_BAYAR');

    	$this->db->where('order.ID_ORDER', $ID_ORDER);
    	$this->db->join('paket_harga', 'paket_harga.ID_PAKET = order.ID_PAKET');
    	$this->db->join('wisata', 'wisata.ID_WISATA = paket_harga.ID_WISATA');
    	$this->db->join('admin', 'admin.ID_ADMIN = wisata.ID_ADMIN');
        return $this->db->get('order')->row();
    }

    public function SetImage($id,$namafile)
    {
    	$this->db->where('ID_ORDER', $id);
		$object = array(
			"BUKTI_BAYAR" => $namafile,
			"STATUS" => "waiting"
		);

		$this->db->update('order', $object);

		if ($this->db->affected_rows() > 0) {
			return "";
		}else{
			return "gagal memperbarui database";
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

/* End of file riwayat_transaksi_model.php */
/* Location: ./application/models/riwayat_transaksi_model.php */