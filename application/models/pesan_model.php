<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_model extends CI_Model {

	public function getWisataPesan($id_wisata)
	{
		$this->db->where('wisata.ID_WISATA', $id_wisata);
		$this->db->join('paket_harga', 'paket_harga.ID_WISATA = wisata.ID_WISATA');
		$result = $this->db->get('wisata')->result();

		return $result;
	}

	public function CheckKuota($data)
	{
		$idPaket = $data["ID_PAKET"];
		$tanggalBerangkat = $data["TANGGAL_BERANGKAT"];
		$tanggalKembali = $data["TANGGAL_KEMBALI"];

		$this->db->select('SUM(KUOTA_PESAN) as TERPAKAI, KUOTA_MAKSIMAL, KUOTA_MINIMAL');
		$this->db->join('order', 'order.ID_PAKET = paket_harga.ID_PAKET');

		$this->db->where('order.STATUS !=', 'canceled');
		$this->db->where('paket_harga.ID_PAKET', $idPaket);
		$where = "TANGGAL_KEMBALI BETWEEN '$tanggalBerangkat' AND '$tanggalKembali'";
		$this->db->where($where);
		$where = "TANGGAL_BERANGKAT BETWEEN '$tanggalBerangkat' AND '$tanggalKembali'";
		$this->db->or_where($where);

		return $this->db->get('paket_harga')->row();
	}

	public function SavePesanan($data)
	{
		$object = array(
			"ID_ORDER"			=> null,
			"ID_CUSTOMER"		=> $this->session->userdata('ID_CUSTOMER'),
			"ID_PAKET"			=> $data["ID_PAKET"],
			"KUOTA_PESAN"		=> $data["KUOTA_PESAN"],
			"TOTAL_TRANSAKSI"	=> $data["TOTAL_TRANSAKSI"],
			"TANGGAL_TRANSAKSI"	=> date("Y-m-d"),
			"TANGGAL_BERANGKAT"	=> $data["TANGGAL_BERANGKAT"],
			"TANGGAL_KEMBALI"	=> $data["TANGGAL_KEMBALI"],
			"BUKTI_BAYAR"		=> null,
			"STATUS"			=> "order"
		);

		$this->db->insert('order', $object);
		if ($this->db->affected_rows() > 0) {
			return "";
		}else{
			return "Gagal menyimpan data";
		}
	}

}

/* End of file pesan_model.php */
/* Location: ./application/models/pesan_model.php */