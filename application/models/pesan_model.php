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

}

/* End of file pesan_model.php */
/* Location: ./application/models/pesan_model.php */