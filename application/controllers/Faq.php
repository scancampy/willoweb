<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");    
class Faq extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('username')) {
        	redirect('welcome');
        }
    }

    public function add() {
    	$data = array();
    	$data['error'] = '';

    	if($this->input->post('btnsubmit')) {
    		$this->faqmodel->insert($this->input->post('title'), $this->input->post('content'));
            $this->session->set_flashdata('notif', 'add_success');
            	redirect('faq');            
    	}

    	$data['js'] = "
    	 $('.textarea').summernote({
    	 fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Quicks Regular', 'Quicks Bold'],
  fontNamesIgnoreCheck: ['Quicks Regular', 'Quicks Bold'],
    	 	fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
    	 	toolbar: [
['fontname', ['fontname']],
['style', ['bold', 'italic', 'underline', 'clear']],
['fontsize', ['fontsize']],
['color', ['color']],
['para', ['ul', 'ol', 'paragraph']],
['height', ['height']],
['insert', ['picture', 'myvideo', 'link', 'table', 'hr']],
['misc', ['fullscreen', 'undo', 'redo','codeview']]
],
    	 });
    	";
    	
    	$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('v_faq_add', $data);
		$this->load->view('v_footer', $data);
    }

    public function delete($id) {
    	if($this->faqmodel->delete($id)) {
	    	$this->session->set_flashdata('notif', 'del_success');
	    } else {
	    	$this->session->set_flashdata('notif', 'del_failed');
	    }

    	redirect('faq');
    }

    public function edit($id) {
    	$data = array();
    	$data['faq'] = $this->faqmodel->get_data(array('id' => $id));
    	if($this->session->flashdata('notif')) {
			$data['notif'] = $this->session->flashdata('notif');
		}

    	if($this->input->post('btnsubmit')) { 
    		$this->faqmodel->update($id, $this->input->post('title'), $this->input->post('content'));
        	$this->session->set_flashdata('notif', 'edit_success');
        	redirect('faq/edit/'.$id);
    	}


			$data['js'] = "
    	 $('.textarea').summernote({
    	 fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Quicks Regular', 'Quicks Bold'],
  fontNamesIgnoreCheck: ['Quicks Regular', 'Quicks Bold'],
    	 	fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
    	 	toolbar: [
['fontname', ['fontname']],
['style', ['bold', 'italic', 'underline', 'clear']],
['fontsize', ['fontsize']],
['color', ['color']],
['para', ['ul', 'ol', 'paragraph']],
['height', ['height']],
['insert', ['picture', 'myvideo', 'link', 'table', 'hr']],
['misc', ['fullscreen', 'undo', 'redo','codeview']]
],
    	 });
    	";
    	$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('v_faq_edit', $data);
		$this->load->view('v_footer', $data);    	
    }

    public function down($id) {
    	if($this->faqmodel->down($id)) {
    		$this->session->set_flashdata('notif','order_success');
    	} else {
    		$this->session->set_flashdata('notif','order_failed');
    	}
    	redirect('faq');
    }

    public function up($id) {
    	if($this->faqmodel->up($id)) {
    		$this->session->set_flashdata('notif','order_success');
    	} else {
    		$this->session->set_flashdata('notif','order_failed');
    	}
    	redirect('faq');
    }

	public function index()
	{
		$this->load->helper('text');
		$data = array();
		if($this->session->flashdata('notif')) {
			$data['notif'] = $this->session->flashdata('notif');
		}

		$data['faq'] = $this->faqmodel->get_data();
		$data['js'] = "
		";
		$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('v_faq', $data);
		$this->load->view('v_footer', $data);
	}

	
}
