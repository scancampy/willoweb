<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");    
class Dashboard extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('username')) {
        	redirect('welcome');
        }
    }


	public function index()
	{
		$data = array();
		$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('v_dashboard', $data);
		$this->load->view('v_footer', $data);
	}

	public function password() {
		$data = array();

		if($this->input->post('btnsubmit')) {
		 	$this->load->library('form_validation');

            $this->form_validation->set_rules('oldpass', 'Old Password', 'required');
            $this->form_validation->set_rules('newpass', 'New Password', 'required');            
            $this->form_validation->set_rules('repass', 'Repeat Password', 'matches[newpass]');

            if ($this->form_validation->run() == FALSE)
            {
             	$data['error'] = validation_errors();
            }
            else
            {
                if($this->adminmodel->change_pass($this->session->userdata('username'), $this->input->post('oldpass'), $this->input->post('newpass')) == 'success' ) {
					$data['notif'] = 'Password has been changed';
                } else {                	
                	$data['error'] = 'Old password is incorrect';
                }
            }
		}

		$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('v_password', $data);
		$this->load->view('v_footer', $data);
	}

	public function signout() {
		$this->session->sess_destroy();
		redirect('welcome');
	}
}
