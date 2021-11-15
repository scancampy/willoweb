<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");    
class Privacy extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('username')) {
        	redirect('dashboard');
        }
    }


	public function index()
	{
		$this->load->view('v_privacy');
	}
}
