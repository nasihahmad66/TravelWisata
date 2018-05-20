<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wisata_model extends CI_Model {

	public function GetWisata()
	{
		return $this->db->get('wisata')->result();
	}

	public function GetWisataHavePaket()
	{
		$this->db->join('paket_harga', 'paket_harga.ID_WISATA = wisata.ID_WISATA');
		$this->db->group_by('wisata.ID_WISATA');
		return $this->db->get('wisata')->result();
	}

	public function GetAllDataPaketHarga()
	{
		return $this->$this->db->get('paket_harga')->result();
	}

	public function InsertWisata($data)
	{
		$object = array(
			'ID_WISATA'		=> null,
			'ID_ADMIN'		=> $this->session->userdata('ID_ADMIN'),
			'NAMA_WISATA'	=> $data['NAMA_WISATA'],
			'KOTA'			=> $data['KOTA'],
			'KETERANGAN'	=> $data['KETERANGAN']
		);

		$this->db->insert('wisata', $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function UpdateWisata($data)
	{
		$object = array(
			"NAMA_WISATA"	=> $data["NAMA_WISATA"],
			"KOTA"			=> $data["KOTA"],
			"KETERANGAN"	=> $data["KETERANGAN"]
		);

		$this->db->where('ID_WISATA', $data["ID_WISATA"]);
		$this->db->update('wisata', $object);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function DeleteWisata($ID_WISATA)
	{
		$this->db->where('ID_WISATA', $ID_WISATA);
		$this->db->delete('wisata');
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function SetImage($id, $namafile)
	{
		$this->db->where('ID_WISATA', $id);
		$object = array(
			"GAMBAR" => $namafile
		);

		$this->db->update('wisata', $object);

		if ($this->db->affected_rows() > 0) {
			return "success";
		}else{
			return "gagal memperbarui database";
		}
		
	}

}

/* End of file wisata_model.php */
/* Location: ./application/models/wisata_model.php */