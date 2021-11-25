<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");    
class Managevoucher extends CI_Controller {
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
		$data['events'] = $this->eventmodel->getAllEvent();

		if($this->input->get('eventid')) {			
			$data['events_voucher'] = $this->eventmodel->getAllEventVoucher($this->input->get('eventid'));
			$data['event'] = $this->eventmodel->getAllEvent($this->input->get('eventid'));

			// READ VOUCHER
			if($this->input->get('voucher_id')) {
				$data['voucher_pool'] = $this->eventmodel->getAllVoucherPool($this->input->get('eventid'), $this->input->get('voucher_id'));

			} else {
				$data['voucher_pool'] = $this->eventmodel->getAllVoucherPool($this->input->get('eventid'), 'all');
			}
		}

		


		// READ TENANT
		if($this->input->post('tenantid')) {
			if($this->eventmodel->registerTenant($this->input->post('tenantid'), $this->input->get('eventid'))) {
				$this->session->set_flashdata('notif', 'add_tenant_success');
			} else {
				$this->session->set_flashdata('notif', 'add_tenant_failed');
				$this->session->set_flashdata('notif_msg', 'Tenant sudah pernah didaftarkan di event ini');
			}

			redirect('manageevent?eventid='.$this->input->get('eventid'));
		}

		
		// GENERATE VOUCHER
		if($this->input->post('btngeneratesubmit')) {
			$this->eventmodel->generateVoucher($this->input->post('hididvoucher'), $this->input->get('eventid'), $this->input->post('qty'));
			$this->session->set_flashdata('notif', 'generate_voucher_success');
			$this->session->set_flashdata('notif_msg', $this->input->post('qty').' kode voucher telah berhasil dibuat');

			redirect('manageevent?eventid='.$this->input->get('eventid').'&tab=timeline');
		}

		// INIT SESSION NOTIF
		if($this->session->flashdata('notif')) {
			$data['notif'] = $this->session->flashdata('notif');
		}

		if($this->session->flashdata('notif_msg')) {
			$data['notif_msg'] = $this->session->flashdata('notif_msg');
		}
		


		// select on change and submit
		$data['js'] = "
			$('#eventid').on('change', function() {
				$('#formpilihevent').submit();
			});

			$('#voucher_id').on('change', function() {
				$('#formpilihevent').submit();
			});
		";

		// DATA TABLE
  		$data['js'] .= "
  			$('#example2').DataTable({
      \"paging\": true,
      \"lengthChange\": false,
      \"searching\": true,
      \"ordering\": true,
      \"info\": true,
      \"autoWidth\": false,
    });
  		";

	
		$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('managevoucher/v_manage_voucher', $data);
		$this->load->view('v_footer', $data);
	}

	public function removevoucher($code, $event_id) {
		$voucher_id= $this->eventmodel->removevouchercode($code, $event_id);
		$this->session->set_flashdata('notif', 'remove_voucher_success');
		redirect('managevoucher?eventid='.$event_id.'&voucher_id='.$voucher_id);
	}	
}