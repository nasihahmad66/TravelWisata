<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paketharga_model extends CI_Model {

	public function GetPaket()
	{
		$this->db->join('wisata', 'wisata.ID_WISATA = paket_harga.ID_WISATA');
		return $this->db->get('paket_harga')->result();
	}

	public function ValidasiPaket($ID_PAKET,$ID_WISATA,$NAMA_PAKET)
	{
		$this->db->where('ID_PAKET !=', $ID_PAKET);
		$this->db->where('ID_WISATA', $ID_WISATA);
		$this->db->like('NAMA_PAKET', $NAMA_PAKET, 'BOTH');
		$data = $this->db->get('paket_harga')->result();
		if (count($data)> 0) {
			return false;
		}else{
			return true;
		}
	}

	public function InsertPaket($data)
	{
		$object = array(
			"ID_PAKET" => null,
			"ID_WISATA" => $data["ID_WISATA"],
			"NAMA_PAKET" => $data["NAMA_PAKET"],
			"KUOTA_MINIMAL" => $data["KUOTA_MINIMAL"],
			"KUOTA_MAKSIMAL" => $data["KUOTA_MAKSIMAL"],
			"HARGA" => $data["HARGA"],
			"JENIS_HARGA" => $data["JENIS_HARGA"],
			"STATUS" => $data["STATUS"],
			"DURASI_WISATA" => $data["DURASI_WISATA"]
		);

		$this->db->insert('paket_harga', $object);
		if ($this->db->affected_rows()>0) {
			return true;
		}else{
			return false;
		}
	}

	public function UpdatePaket($data)
	{
		$this->db->where('ID_PAKET', $data["ID_PAKET"]);
		$object = array(
			"ID_WISATA" => $data["ID_WISATA"],
			"NAMA_PAKET" => $data["NAMA_PAKET"],
			"KUOTA_MINIMAL" => $data["KUOTA_MINIMAL"],
			"KUOTA_MAKSIMAL" => $data["KUOTA_MAKSIMAL"],
			"HARGA" => $data["HARGA"],
			"JENIS_HARGA" => $data["JENIS_HARGA"],
			"STATUS" => $data["STATUS"],
			"DURASI_WISATA" => $data["DURASI_WISATA"]
		);

		$this->db->update('paket_harga', $object);
		if ($this->db->affected_rows()>0) {
			return true;
		}else{
			return false;
		}
	}

}

/* End of file paketharga_model.php */
/* Location: ./application/models/paketharga_model.php */