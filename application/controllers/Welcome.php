<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");    
class Welcome extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('username')) {
        	redirect('dashboard');
        }
    }


	public function index()
	{
		$data = array();
		/*$this->load->helper('string');
		$salt = random_string('alnum', 10);
		echo 'salt '.$salt.'<br/>';
		$pass = do_hash('password'.do_hash($salt,'md5'), 'md5');
		echo 'pass '.$pass;*/

		if($this->input->post('btnlogin')) {
			$username = $this->input->post('username');
			$pass = $this->input->post('password');
			if($this->adminmodel->sign_in($username,$pass)) {
				$admin = $this->adminmodel->get_data(array('username' => $username));
				$this->session->set_userdata('username', $admin->username);
				$this->session->set_userdata('name', $admin->name);
				redirect('dashboard');
			} else {
				$data['notif'] = 'login_failed';
				$data['notif_msg'] = 'Invalid login credentials';
			}
		}
		$this->load->view('v_login', $data);
	}
}
