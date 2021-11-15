<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");    
class Landing extends CI_Controller {
	


	public function index()
	{
		redirect('http://www.willowbabyshop.com/');
	}
}
