<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_page_model extends CI_Model {

	public function ValidasiUser($username, $telpon)
	{
		$result = $this->db->where('USERNAME_CUSTOMER', $username)->get('customer')->result();
		if (count($result)>0) {
			return "Username Telah Dipakai";
		}else{
			$result = $this->db->where('NOMOR_TELPON_CUSTOMER', $telpon)->get('customer')->result();
			if (count($result)>0) {
				return "Nomor telpon telah dipakai";
			}else{
				return "";
			}
		}
	}

	public function SaveUser($data)
	{
		$object = array(
			"ID_CUSTOMER" => null,
			"USERNAME_CUSTOMER" => $data["USERNAME_CUSTOMER"],
			"PASSWORD_CUSTOMER" => md5($data["PASSWORD_CUSTOMER"]),
			"NOMOR_TELPON_CUSTOMER" => $data["NOMOR_TELPON_CUSTOMER"],
			"NAMA_CUSTOMER" => $data["NAMA_CUSTOMER"],
			"ALAMAT_CUSTOMER" => $data["ALAMAT_CUSTOMER"]
		);

		$this->db->insert('customer', $object);

		if ($this->db->affected_rows()>0) {
			$array = array(
				'LOGIN' => true,
				'ID_CUSTOMER' => $this->db->insert_id(),
				'NAMA_CUSTOMER' => $data["NAMA_CUSTOMER"]
			);
			
			$this->session->set_userdata( $array );
			return "OK";
		}else{
			return "Gagal menyimpan data";
		}
	}

}

/* End of file login_page_model.php */
/* Location: ./application/models/login_page_model.php */