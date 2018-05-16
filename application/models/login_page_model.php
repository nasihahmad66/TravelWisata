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

	function ValidLogin($data)
	{
		$username = $data["USERNAME_CUSTOMER"];
		$password = $data["PASSWORD_CUSTOMER"];

		$this->db->where('USERNAME_CUSTOMER', $username);
		$this->db->where('PASSWORD_CUSTOMER', md5($password));
		$result = $this->db->get('customer')->result();

		if (count($result) > 0) {
			$array = array(
				'LOGIN' => true,
				'ID_CUSTOMER' => $result[0]->ID_CUSTOMER,
				'NAMA_CUSTOMER' => $result[0]->NAMA_CUSTOMER
			);
			
			$this->session->set_userdata( $array );
			return "OK";
		}else{
			return "Username atau Password salah";
		}
	}

}

/* End of file login_page_model.php */
/* Location: ./application/models/login_page_model.php */