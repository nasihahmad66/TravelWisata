<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userguide extends CI_Controller {

	public function index()
	{
		// $data['title'] = 'User-guide';
        // $data['main_view'] = 'usergude_view';
        // $data['loader'] = 'loader';
        return $this->load->view('userguide_view');
	}

}

/* End of file user-guide.php */
/* Location: ./application/controllers/user-guide.php */