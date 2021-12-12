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
			if(count($data['event']) > 0) {
				$data['daily'] = $this->eventmodel->getVoucherClaimedDaily($this->input->get('eventid'));
			}

			 $datediff = strtotime($data['event'][0]->tanggal_selesai) - strtotime($data['event'][0]->tanggal_mulai);
			 $claimed = array();
			 foreach($data['events_voucher'] as $key => $value) {
				 for($i=0; $i<= round($datediff / (60 * 60 * 24)); $i++) {
				 	$claimed[$value->voucher_id][$i] =  $this->eventmodel->getVoucherClaimedPerDaily($this->input->get('eventid'), $value->voucher_id, strftime("%Y-%m-%d", strtotime("+".$i." day", strtotime($data['event'][0]->tanggal_mulai))) );
				 }
			}

			$data['claimed'] = $claimed;


			$where ='';
			if($this->input->get('voucher_claimed')) {
				if($this->input->get('voucher_claimed') == 'digital_claimed') {
					$where = ' voucher_pool.digital_claimed_by_customer_id IS NOT NULL ';
				} else if($this->input->get('voucher_claimed') == 'physical_traded') {
					$where = ' voucher_pool.physical_claimed_date IS NOT NULL ';
				}
			}

			// READ VOUCHER
			if($this->input->get('voucher_id')) {
				$data['voucher_pool'] = $this->eventmodel->getAllVoucherPool($this->input->get('eventid'), $this->input->get('voucher_id'), $where);

			} else {
				$data['voucher_pool'] = $this->eventmodel->getAllVoucherPool($this->input->get('eventid'), 'all', $where);
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

			$('#voucher_claimed').on('change', function() {
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

  		// SLIDER
  		$data['js'] .= "
  		$('.range_2').ionRangeSlider()
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