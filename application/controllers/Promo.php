<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");    
class Promo extends CI_Controller {
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

    	// get next autoincrement
    	$next = $this->promomodel->get_next_ai();


    	if($this->input->post('btnsubmit')) {
    		$config['upload_path']          = './images/promo/';
            $config['allowed_types']        = 'jpg|jpeg';
            $config['max_size']             = 1000000;
            $config['max_width']            = 10024;
            $config['max_height']           = 7068;
            $config['overwrite']			= TRUE;
            $config['file_name']			= $next->auto_increment.'_small.jpg';
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('smallimg')) {              
                $data['error'] = $this->upload->display_errors();
            }
            else {
                $config2['image_library'] = 'gd2';
				$config2['source_image'] = './images/promo/'.$next->auto_increment.'_small.jpg';
				$config2['create_thumb'] = FALSE;
				$config2['maintain_ratio'] = FALSE;
				$config2['width']         = 500;
				$config2['height']       = 353;
				$config2['overwrite']			= TRUE;

				$this->load->library('image_lib', $config2);
				if(!$this->image_lib->resize()) {
					$data['error'] = $this->image_lib->display_errors();					
				}
            }

            if($data['error'] == '') {
            	$config['upload_path']          = './images/promo/';
	            $config['allowed_types']        = 'jpg|jpeg';
	            $config['max_size']             = 1000000;
	            $config['max_width']            = 10024;
	            $config['max_height']           = 7068;
	            $config['overwrite']			= TRUE;
	            $config['file_name']			= $next->auto_increment.'.jpg';
	            $this->upload->initialize($config);
	            if(!$this->upload->do_upload('largeimg')) {              
	                $data['error'] = $this->upload->display_errors();	               
	            }
	            else {
	                $config2['image_library'] = 'gd2';
					$config2['source_image'] = './images/promo/'.$next->auto_increment.'.jpg';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = FALSE;
				//	$config2['width']         = 500;
				//	$config2['height']       = 750;
					$config2['width']         = 750;
					$config2['height']       = 1540;
					$config2['overwrite']			= TRUE;

					$this->image_lib->initialize($config2);
					if(!$this->image_lib->resize()) {
						$data['error'] = $this->image_lib->display_errors();						
					}
	            }
            }

            if($data['error'] == '') {
            	$this->promomodel->insert($this->input->post('title'), $this->input->post('content'), $this->input->post('short_desc'), $this->input->post('promo_date'));
            	$this->session->set_flashdata('notif', 'add_success');
            	redirect('promo');
            }
    	}

    	$data['js'] = "
    	 $('.textarea').summernote({
    	 	fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
    	 	toolbar: [
['fontname', ['fontname']],
['style', ['bold', 'italic', 'underline', 'clear']],
['fontsize', ['fontsize']],
['color', ['color']],
['para', ['ul', 'ol', 'paragraph']],
['height', ['height']],
['insert', ['picture', 'myvideo', 'link', 'table', 'hr']],
['misc', ['fullscreen', 'undo', 'redo']]
],
    	 });
    	 
    	 $('.datepicker').datepicker();
    	";
    	$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('v_promo_add', $data);
		$this->load->view('v_footer', $data);
    }

    public function delete($id) {
    	$this->promomodel->delete($id);
    	$this->session->set_flashdata('notif', 'del_success');
    	redirect('promo');
    }

    public function edit($id) {
    	$data = array();
    	$data['error'] = '';
    	$data['promo'] = $this->promomodel->get_data(array('id' => $id));
    	if($this->session->flashdata('notif')) {
			$data['notif'] = $this->session->flashdata('notif');
		}

    	if($this->input->post('btnsubmit')) {
    	    
        //print_r($_POST); die();
    		$config['upload_path']          = './images/promo/';
            $config['allowed_types']        = 'jpg|jpeg';
            $config['max_size']             = 1000000;
            $config['max_width']            = 10024;
            $config['max_height']           = 7068;
            $config['overwrite']			= TRUE;
            $config['file_name']			= $id.'_small.jpg';
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('smallimg')) {              
              //  $data['error'] = $this->upload->display_errors();
            }
            else {
                $config2['image_library'] = 'gd2';
				$config2['source_image'] = './images/promo/'.$id.'_small.jpg';
				$config2['create_thumb'] = FALSE;
				$config2['maintain_ratio'] = FALSE;
				$config2['width']         = 500;
				$config2['height']       = 353;
				$config2['overwrite']			= TRUE;

				$this->load->library('image_lib', $config2);
				if(!$this->image_lib->resize()) {
					//$data['error'] = $this->image_lib->display_errors();					
				}
            }

            if($data['error'] == '') {
            	$config['upload_path']          = './images/promo/';
	            $config['allowed_types']        = 'jpg|jpeg';
	            $config['max_size']             = 1000000;
	            $config['max_width']            = 10024;
	            $config['max_height']           = 7068;
	            $config['overwrite']			= TRUE;
	            $config['file_name']			= $id.'.jpg';
	            $this->upload->initialize($config);
	            if(!$this->upload->do_upload('largeimg')) {              
	               // $data['error'] = $this->upload->display_errors();	               
	            }
	            else {
	                $config2['image_library'] = 'gd2';
					$config2['source_image'] = './images/promo/'.$id.'.jpg';
					$config2['create_thumb'] = FALSE;
					$config2['maintain_ratio'] = FALSE;
					//$config2['width']         = 500;
					//$config2['height']       = 750;
					
					$config2['width']         = 750;
					$config2['height']       = 1540;
					$config2['overwrite']			= TRUE;
					$this->load->library('image_lib', $config2);
					$this->image_lib->initialize($config2);
					if(!$this->image_lib->resize()) {
					//	$data['error'] = $this->image_lib->display_errors();						
					}
	            }
            }

            $this->promomodel->update($id, $this->input->post('title'), $this->input->post('content'), $this->input->post('short_desc'), $this->input->post('promo_date'));
        	$this->session->set_flashdata('notif', 'edit_success');
        	redirect('promo/edit/'.$id);
    	}


		$data['js'] = "
    	 $('.textarea').summernote({
    	 	fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
    	 	toolbar: [
['fontname', ['fontname']],
['style', ['bold', 'italic', 'underline', 'clear']],
['fontsize', ['fontsize']],
['color', ['color']],
['para', ['ul', 'ol', 'paragraph']],
['height', ['height']],
['insert', ['picture', 'myvideo', 'link', 'table', 'hr']],
['misc', ['fullscreen', 'undo', 'redo']]
],
    	 });
    	 
    	 
    	 $('.datepicker').datepicker({format: 'yyyy/mm/dd'});
    	";
    	$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('v_promo_edit', $data);
		$this->load->view('v_footer', $data);    	
    }

    public function visible() {
    	$id= $this->input->post('id');
    	$this->promomodel->set_visible($id);
    	$q = $this->promomodel->get_data(array('id' => $id));
    	echo $q[0]->is_visible;
    }

	public function index()
	{
		$data = array();
		if($this->session->flashdata('notif')) {
			$data['notif'] = $this->session->flashdata('notif');
		}

		$data['promo'] = $this->promomodel->get_data();
		$data['js'] = "
		$('.cekvisible').on('click',function() {
			var idprom = $(this).attr('idpromo');
			var cur = $(this);
			$.post('".base_url('promo/visible')."', { id:idprom}, function(data) {
				if(data ==0){
					cur.html('<i class=\"fa fa-times text-danger\"></i>');
				} else {
					cur.html('<i class=\"fa fa-check text-success\"></i>');
				}				
			});
		});

		$('#example2').DataTable({
      \"paging\": true,
      \"lengthChange\": false,
      \"searching\": false,
      \"ordering\": true,
      \"info\": true,
      \"autoWidth\": false,
    });
		";
		$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('v_promo', $data);
		$this->load->view('v_footer', $data);
	}

	
}
