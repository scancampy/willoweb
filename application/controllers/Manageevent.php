<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");    
class Manageevent extends CI_Controller {
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
			$data['event'] = $this->eventmodel->getAllEvent($this->input->get('eventid'));
			$data['events_tenant'] = $this->eventmodel->getAllEventTenant($this->input->get('eventid'));
			$this->load->library('ciqrcode');
			$data['qr'] = array();
			$config['cacheable']    = true; //boolean, the default is true
	        $config['imagedir']     = './tenant/'; //direktori penyimpanan qr code
	        $config['quality']      = true; //boolean, the default is true
	        $config['size']         = '1024'; //interger, the default is 1024
	        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
	        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
	        $this->ciqrcode->initialize($config);

			foreach($data['events_tenant'] as $t) {
			
		        $image_name=$t->kode.'.png'; //buat name dari qr code sesuai dengan nim
		 		$params['data'] = 'https://event.willowapps.net/tenant/'.$t->kode;
		        $params['level'] = 'H'; //H=High
		        $params['size'] = 10;
		        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

			}

			$data['events_voucher'] = $this->eventmodel->getAllEventVoucher($this->input->get('eventid'));
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

		// READ VOUCHER
		if($this->input->post('voucherid')) {
			if($this->eventmodel->registerVoucher($this->input->post('voucherid'), $this->input->get('eventid'))) {
				$this->session->set_flashdata('notif', 'add_voucher_success');
			} else {
				$this->session->set_flashdata('notif', 'add_voucher_failed');
				$this->session->set_flashdata('notif_msg', 'Voucher sudah pernah didaftarkan di event ini');
			}

			redirect('manageevent?eventid='.$this->input->get('eventid').'&tab=timeline');
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
		";

		// FORM VALIDATION VOUCHER
  		$data['js'] .= "
  	$('#formgeneratevoucher').validate({
		    rules: {
		      qty: {
		        required: true
		      }
		    },
		    messages: {
		      qty: {
		        required: 'Harus diisi'
		      }
		    },
		    errorElement: 'span',
		    errorPlacement: function (error, element) {
		      error.addClass('invalid-feedback');
		      element.closest('.form-group').append(error);
		    },
		    highlight: function (element, errorClass, validClass) {
		      $(element).addClass('is-invalid');
		    },
		    unhighlight: function (element, errorClass, validClass) {
		      $(element).removeClass('is-invalid');
		    }
		  });
  	";
  		// BUTTON GENERATE VOUCHER
  		$data['js'] .= "
	  		$('.btngenerate').on('click', function(data) { 
	  			$('#namavoucher').val($(this).attr('vouchername'));
	  			$('#hididvoucher').val($(this).attr('voucherid'));
	  		});
  		";

		// KEY CHANGE CARI TENANT
		$data['js'] .= "
			$('#cari').on('keyup', function() {
				$.post('".base_url('manageevent/caritenant')."', { cari:$('#cari').val() }, function(data) {
					var json = JSON.parse(data);
					if(json['result'] == 'success') {
						if(json['data'].length > 0) {
							var str = '';
							for(var i = 0; i < json['data'].length; i++) {
								str += '<tr><td>' + json['data'][i].nama + '</td><td><img src=\"".base_url('tenant/')."' + json['data'][i].logo + '\" style=\"width:100px; height:auto;\" /></td><td><button type=\"submit\" name=\"tenantid\" value=\"' + json['data'][i].id + '\" class=\"btn btn-flat btn-sm btn-primary\">Pilih</button></td></tr>';
							}
							
							$('#resulttenant_tr').html(str);
						}
					} else {
						$('#resulttenant_tr').html('<tr ><td colspan=\"3\">-</td></tr>');
					}
				});
			});
		";

		// KEY CHANGE CARI VOUCHER
		$data['js'] .= "
			$('#carivoucher').on('keyup', function() {
				$.post('".base_url('manageevent/carivoucher')."', { carivoucher:$('#carivoucher').val() }, function(data) {
					var json = JSON.parse(data);
					if(json['result'] == 'success') {
						if(json['data'].length > 0) {
							var str = '';
							
							for(var i = 0; i < json['data'].length; i++) {
								str += '<tr><td>' + json['data'][i].nama + '</td><td><img src=\"".base_url('voucher/')."' + json['data'][i].voucher_image + '\" style=\"width:100px; height:auto;\" /></td><td><button type=\"submit\" name=\"voucherid\" value=\"' + json['data'][i].id + '\" class=\"btn btn-flat btn-sm btn-primary\">Pilih</button></td></tr>';
							}
							
							$('#resultvoucher_tr').html(str);
						}
					} else {
						$('#resultvoucher_tr').html('<tr ><td colspan=\"3\">-</td></tr>');
					}
				});
			});
		";

		$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('manageevent/v_manage_event', $data);
		$this->load->view('v_footer', $data);
	}

	public function removetenant($tenant_id, $event_id) {
		$this->eventmodel->removetenant($tenant_id, $event_id);
		$this->session->set_flashdata('notif', 'remove_tenant_success');
		redirect('manageevent?eventid='.$event_id);
	}

	public function removevoucher($voucher_id, $event_id) {
		$this->eventmodel->removevoucher($voucher_id, $event_id);
		$this->session->set_flashdata('notif', 'remove_voucher_success');
		redirect('manageevent?eventid='.$event_id.'&tab=timeline');
	}

	public function printqr($event_id) {
		$data =array();
		$data['event'] = $this->eventmodel->getAllEvent($event_id);
		$data['events_tenant'] = $this->eventmodel->getAllEventTenant($event_id);
		$this->load->view('manageevent/v_print_tenant', $data);
	}

	public function caritenant() {
		if($this->input->post('cari')) {
			$data = $this->eventmodel->getAllTenant('', 'nama LIKE "%'.$this->input->post('cari').'%" ');
			echo json_encode(array('result' => 'success', 'data'=> $data));
		} else {
			echo json_encode(array('result'=> 'false'));
		}
	}

	public function carivoucher() {
		if($this->input->post('carivoucher')) {
			$data = $this->eventmodel->getAllVoucher('', 'nama LIKE "%'.$this->input->post('carivoucher').'%" ');
			echo json_encode(array('result' => 'success', 'data'=> $data));
		} else {
			echo json_encode(array('result'=> 'false'));
		}
	}
	
}
