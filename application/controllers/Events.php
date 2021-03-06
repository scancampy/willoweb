<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");    
class Events extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('username')) {
        	redirect('welcome');
        }
    }

    public function voucher() {
		$data = array();

		if($this->input->post('btnsubmit')) {
			$dataInsert = array(
							'nama' => $this->input->post('nama'),
							'deskripsi' => $this->input->post('deskripsi'),
							'highlight' => $this->input->post('highlight'),
							'kuota_harian' => $this->input->post('kuota_harian')
						);

			if ($_FILES['voucher_image']['size'] != 0)
			{
				// upload promo
				$config['upload_path']          = './voucher/';
                $config['allowed_types']        = 'gif|jpg|png|bmp|jpeg';
                $config['max_size']             = 1000000;
                $config['overwrite']			= TRUE;
                $config['file_name']			= 'voucher_'.url_title($this->input->post('nama'), '_', true).'_'.date('Ymdhis').'.jpg';

                $this->load->library('upload', $config);
                $ifupload = true;

                if ( ! $this->upload->do_upload('voucher_image')) {
                	$this->session->set_flashdata('notif', 'voucer_error');	
                	$this->session->set_flashdata('notif_msg',$this->upload->display_errors());	
                	$errorcheck = true;
                } else {
                	$dataInsert['voucher_image'] = $config['file_name'];
                }
			}
			

			if($this->input->post('hididvoucher')) {
				$this->load->helper('url');
				$this->eventmodel->doUpdateVoucher($this->input->post('hididvoucher'), $dataInsert);
				$this->session->set_flashdata('notif', 'edit_voucher_success');				
			} else {								
				$this->eventmodel->doInsertVoucher($dataInsert);
				$this->session->set_flashdata('notif', 'add_voucher_success');
			}
			
	  		redirect('events/voucher');
		}

		if($this->session->flashdata('notif')) {
			$data['notif'] = $this->session->flashdata('notif');
		}

		if($this->session->flashdata('notif_msg')) {
			$data['notif_msg'] = $this->session->flashdata('notif_msg');
		}

		$data['voucher'] = $this->eventmodel->getAllVoucher();

		
		
  		// DATA TABLE
  		$data['js'] = "
  			$('#example2').DataTable({
      \"paging\": true,
      \"lengthChange\": false,
      \"searching\": true,
      \"ordering\": true,
      \"info\": true,
      \"autoWidth\": false,
    });
  		";

  		// ADD NEW EVENT
  		$data['js'] .= "
  		$('#btnadd').on('click',function() {
  			$('#nama').val('');
  			$('#hididvoucher').val('');
  			$('#deskripsi').val('');
  			$('#kuota_harian').val('');
  			$('#highlight').val('');
  			$('#current_voucher_div').hide();
  		});
  		";

  		// EVENT EDIT
    	$data['js'] .= "
		$('#modal-lg').on('shown.bs.modal', function () {
		    $('#nama').focus();
		});

		$('body').on('click', '.btnedit', function() {
			// ajax call
			$.post('".base_url('events/loadvoucher')."', { voucherid:$(this).attr('voucherid') }, function(data) {
				var json = JSON.parse(data);
				$('#hididvoucher').val(json['data'][0].id);
				$('#nama').val(json['data'][0].nama);
				$('#deskripsi').val(json['data'][0].deskripsi);
				$('#highlight').val(json['data'][0].highlight);
				$('#kuota_harian').val(json['data'][0].kuota_harian);

				$('#current_voucher_div').hide();

				if(json['data'][0].voucher_image != '') {
					$('#current_voucher_img').attr('src', '".base_url('voucher/')."' + json['data'][0].voucher_image);
					$('#current_voucher_div').show();
				} else {
					$('#current_voucher_div').hide();
				}		
			});
		});
		";

  		// FORM VALIDATION JS
  		$data['js'] .= "
  	$('#formtambahperiode').validate({
		    rules: {
		      nama: {
		        required: true
		      },
		      deskripsi: {
		        required: true
		      },
		      highlight: {
		        required: true
		      },
		      kuota_harian: {
		        required: true
		      }
		    },
		    messages: {
		      nama: {
		        required: 'Harus diisi'
		      },
		      deskripsi: {
		        required: 'Harus diisi'
		      },
		      highlight: {
		        required: 'Harus diisi'
		      },
		      kuota_harian: {
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


		$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('events/v_voucher', $data);
		$this->load->view('v_footer', $data);
	}
	public function index()
	{
		redirect('dashboard');
	}

	public function tenant() {
		$data = array();

		if($this->input->post('btnsubmit')) {
			$dataInsert = array(
							'nama' => $this->input->post('nama'),
							'deskripsi' => $this->input->post('deskripsi')
						);
			

			if($this->input->post('hididtenant')) {
				$this->load->helper('url');
				$ifupload = false;
				if ($_FILES['promo_pdf']['size'] != 0)
				{
					// upload promo
					$config['upload_path']          = './tenant/';
	                $config['allowed_types']        = 'pdf';
	                $config['max_size']             = 1000000;
	                $config['overwrite']			= TRUE;
	                $config['file_name']			= 'promo_'.url_title($this->input->post('nama'), '_', true).'_'.date('Ymdhis').'.pdf';

	                $this->load->library('upload', $config);
	                $ifupload = true;

	                if ( ! $this->upload->do_upload('promo_pdf')) {
	                	$this->session->set_flashdata('notif', 'promo_error');	
	                	$this->session->set_flashdata('notif_msg',$this->upload->display_errors());	
	                	$errorcheck = true;
	                } else {
	                	$dataInsert['promo_pdf'] = $config['file_name'];
	                }
				}

				if ($_FILES['logo']['size'] != 0)
				{
					// upload logo
					$configlogo['upload_path']          = './tenant/';
	                $configlogo['allowed_types']        = 'gif|jpg|png|bmp|jpeg';
	                $configlogo['max_size']             = 1000000;
	                $configlogo['overwrite']			= TRUE;
	                $configlogo['file_name']			= 'logo_'.url_title($this->input->post('nama'), '_', true).'_'.date('Ymdhis').'.jpg';

	                if($ifupload == false) {
	                	$this->load->library('upload', $configlogo);
	                } else {
	                	$this->upload->initialize($configlogo);
	                }

	                if ( ! $this->upload->do_upload('logo')) {
	                	$this->session->set_flashdata('notif', 'logo_error');	
	                	$this->session->set_flashdata('notif_msg',$this->upload->display_errors());	
	                	$errorcheck = true;
	                } else {
	                	$dataInsert['logo'] = $configlogo['file_name'];
	                }
				}

				$this->eventmodel->doUpdateTenant($this->input->post('hididtenant'), $dataInsert);
				$this->session->set_flashdata('notif', 'edit_tenant_success');				
			} else {								
				$this->load->helper('url');
				$errorcheck =false;
				// upload promo
				$config['upload_path']          = './tenant/';
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = 1000000;
                $config['overwrite']			= TRUE;
                $config['file_name']			= 'promo_'.url_title($this->input->post('nama'), '_', true).'_'.date('Ymdhis').'.pdf';

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('promo_pdf')) {
                	$this->session->set_flashdata('notif', 'promo_error');	
                	$this->session->set_flashdata('notif_msg',$this->upload->display_errors());	
                	$errorcheck = true;
                } else {
                	$dataInsert['promo_pdf'] = $config['file_name'];
                }

                // upload logo
				$configlogo['upload_path']          = './tenant/';
                $configlogo['allowed_types']        = 'gif|jpg|png|bmp|jpeg';
                $configlogo['max_size']             = 1000000;
                $configlogo['overwrite']			= TRUE;
                $configlogo['file_name']			= 'logo_'.url_title($this->input->post('nama'), '_', true).'_'.date('Ymdhis').'.jpg';

                $this->upload->initialize($configlogo);

                if ( ! $this->upload->do_upload('logo')) {
                	$this->session->set_flashdata('notif', 'logo_error');	
                	$this->session->set_flashdata('notif_msg',$this->upload->display_errors());	
                	$errorcheck = true;
                } else {
                	$dataInsert['logo'] = $configlogo['file_name'];
                }

                if($errorcheck == false) {
                	$this->eventmodel->doInsertTenant($dataInsert);
					$this->session->set_flashdata('notif', 'add_tenant_success');
                }
			}
			
	  		redirect('events/tenant');
		}

		if($this->session->flashdata('notif')) {
			$data['notif'] = $this->session->flashdata('notif');
		}

		if($this->session->flashdata('notif_msg')) {
			$data['notif_msg'] = $this->session->flashdata('notif_msg');
		}

		$data['tenants'] = $this->eventmodel->getAllTenant();

		
		
  		// DATA TABLE
  		$data['js'] = "
  			$('#example2').DataTable({
      \"paging\": true,
      \"lengthChange\": false,
      \"searching\": true,
      \"ordering\": true,
      \"info\": true,
      \"autoWidth\": false,
    });
  		";

  		// ADD NEW EVENT
  		$data['js'] .= "
  		$('#btnadd').on('click',function() {
  			$('#nama').val('');
  			$('#hididtenant').val('');
  			$('#deskripsi').val('');
  			$('#logo').val('');
  			$('#promo_pdf').val('');
  			$('#current_logo_div').hide();
  			$('#current_promo_div').hide();

  			$( '#logo' ).rules( 'add', {
			  required: true,
			  messages: {
			    required: 'Harus diisi'
			  }
			});

			$( '#promo_pdf' ).rules( 'add', {
			  required: true,
			  messages: {
			    required: 'Harus diisi'
			  }
			});
  		});
  		";

  		// EVENT EDIT
    	$data['js'] .= "
		$('#modal-lg').on('shown.bs.modal', function () {
		    $('#nama').focus();
		});

		$('body').on('click', '.btnedit', function() {
			$( '#logo' ).rules( 'remove' );
			$( '#promo_pdf' ).rules( 'remove' );
			// ajax call
			$.post('".base_url('events/loadtenant')."', { tenantid:$(this).attr('tenantid') }, function(data) {
				var json = JSON.parse(data);
				$('#hididtenant').val(json['data'][0].id);
				$('#nama').val(json['data'][0].nama);
				$('#deskripsi').val(json['data'][0].deskripsi);
				$('#current_logo_img').attr('src', '".base_url('tenant/')."' + json['data'][0].logo);
				$('#current_logo_div').show();
				$('#current_promo_pdf').attr('href', '".base_url('tenant/')."' + json['data'][0].promo_pdf);
				$('#current_promo_pdf').html(json['data'][0].promo_pdf);
				$('#current_promo_div').show();			
			});
		});
		";

  		// FORM VALIDATION JS
  		$data['js'] .= "
  	$('#formtambahperiode').validate({
		    rules: {
		      nama: {
		        required: true
		      },
		      promo_pdf: {
		        required: true
		      },
		      deskripsi: {
		        required: true
		      },
		      logo: {
		        required: true
		      }
		    },
		    messages: {
		      nama: {
		        required: 'Harus diisi'
		      },
		      promo_pdf: {
		        required: 'Harus diisi'
		      },
		      deskripsi: {
		        required: 'Harus diisi'
		      },
		      logo: {
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


		$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('events/v_tenant', $data);
		$this->load->view('v_footer', $data);
	}

	public function periode() {
		$data = array();

		if($this->input->post('btnsubmit')) {
			$this->load->helper('url');			

			$isaktif = $this->input->post('is_aktif');
			if($isaktif == '') { $isaktif = 0; }
			$dataInsert = array(
							'nama' => $this->input->post('nama'),
							'singkat' => $this->input->post('singkat'),
							'deskripsi' => $this->input->post('deskripsi'),
							'tanggal_mulai' => $this->input->post('tanggal_mulai'),
							'tanggal_selesai' => $this->input->post('tanggal_selesai'),
							'is_aktif' => $isaktif,
							'probabilitas' => $this->input->post('probabilitas'),
							'max_voucher_harian' => $this->input->post('max_voucher_harian')
						);

			if ($_FILES['banner_img']['size'] != 0)
			{
				// upload promo
				$configlogo['upload_path']          = './events/';
                $configlogo['allowed_types']        = 'gif|jpg|png|bmp|jpeg';
                $configlogo['max_size']             = 1000000;
                $configlogo['overwrite']			= TRUE;
                $configlogo['file_name']			= 'event_'.url_title($this->input->post('nama'), '_', true).'_'.date('Ymdhis').'.jpg';

                $this->load->library('upload', $configlogo);
                $ifupload = true;

                if ( ! $this->upload->do_upload('banner_img')) {
                	$this->session->set_flashdata('notif', 'banner_error');	
                	$this->session->set_flashdata('notif_msg',$this->upload->display_errors());	

                	$errorcheck = true;
                } else {
                	$dataInsert['banner_img'] = $configlogo['file_name'];
                }
			}
			

			if($this->input->post('hididperiode')) {
				$this->eventmodel->doUpdateEvent($this->input->post('hididperiode'), $dataInsert);
				$this->session->set_flashdata('notif', 'edit_event_success');				
			} else {				
				$this->eventmodel->doInsertEvent($dataInsert);
				$this->session->set_flashdata('notif', 'add_event_success');
			}
			
	  		redirect('events/periode');
		}

		if($this->session->flashdata('notif')) {
			$data['notif'] = $this->session->flashdata('notif');
		}

		if($this->session->flashdata('notif_msg')) {
			$data['notif_msg'] = $this->session->flashdata('notif_msg');
		}

		$data['events'] = $this->eventmodel->getAllEvent();

		// DATE PICKER & SETUP TOAST
  		$data['js'] = "
			//Date range picker
			$('#tanggal_mulai').datetimepicker({
	        format: 'DD MMMM YYYY', ignoreReadonly: true
	    });

	    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

	    $('.tanggal_mulai, .tanggal_selesai').on('keypress', function(e) {
			var keyCode = (e.keyCode ? e.keyCode : e.which);
			if (keyCode >= 47 && keyCode <= 57 )  {
		    	if($(this).val().length ==10) {
		    		e.preventDefault();
		    	}		    	
		    } else {
		    	e.preventDefault();
		    }		    
		});

		$('.tanggal_mulai, .tanggal_selesai').on('focus', function() {
			var a = $(this).val().split(' ');
			var b = months.indexOf(a[1]) + 1;
			if(b < 10) {
				$(this).val(a[0] + '/0' + b + '/' + a[2]);	
			} else {				
				$(this).val(a[0] + '/' +  b + '/' + a[2]);
			}		
		});

		$('.tanggal_mulai, .tanggal_selesai').on('change', function() {
			var tgljual = $(this).val();
			var y = tgljual.substr(6,10);
			var m = parseInt(tgljual.substr(3,5));
			var d = tgljual.substr(0,2);
			$(this).val(d + ' ' + months[m-1] + ' ' + y);
		});

		$('.tanggal_mulai, .tanggal_selesai').on('blur', function() {
			var tgljual = $(this).val();
			if($(this).val().split('/').length > 1) {
				var y = tgljual.substr(6,10);
				var m = parseInt(tgljual.substr(3,5));
				var d = tgljual.substr(0,2);
				$(this).val(d + ' ' + months[m-1] + ' ' + y);
			}
		});

	    $('#tanggal_selesai').datetimepicker({
	        format: 'DD MMMM YYYY',  ignoreReadonly: true
	    });

	    var Toast = Swal.mixin({
	      toast: true,
	      position: 'top-end',
	      showConfirmButton: false,
	      timer: 3000
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

  		// ADD NEW EVENT
  		$data['js'] .= "
  		$('#btnadd').on('click',function() {
  			$('#nama').val('');
  			$('#singkat').val('');
  			$('#hididperiode').val('');
  			$('#deskripsi').val('');
			$('#is_aktif').prop('checked', false);
			$('#max_voucher_harian').val(1);
			$('#probabilitas').val('5');
			var today = new Date();
			var dd = today.getDate();

			var mm = today.getMonth()+1; 
			var yyyy = today.getFullYear();
			if(dd<10) 
			{
			    dd='0'+dd;
			} 

			if(mm<10) 
			{
			    mm='0'+mm;
			} 
			today = yyyy+'-'+mm+'-'+dd;
			$('#tanggal_mulai').val(today);
			$('#tanggal_selesai').val(today);

			$('#current_banner_div').hide();
  		});
  		";

  		// EVENT EDIT
    	$data['js'] .= "
		$('#modal-lg').on('shown.bs.modal', function () {
		    $('#nama').focus();
		});

		$('body').on('click', '.btnedit', function() {
			// ajax call
			$.post('".base_url('events/loadevent')."', { eventid:$(this).attr('eventid') }, function(data) {
				var json = JSON.parse(data);
				$('#hididperiode').val(json['data'][0].id);
				$('#nama').val(json['data'][0].nama);
				$('#singkat').val(json['data'][0].singkat);
				$('#deskripsi').val(json['data'][0].deskripsi);
				$('#tanggal_mulai').val(json['data'][0].tanggal_mulai);
				$('#tanggal_selesai').val(json['data'][0].tanggal_selesai);
				$('#max_voucher_harian').val(json['data'][0].max_voucher_harian);
				$('#probabilitas').val(json['data'][0].probabilitas);
				
				if(json['data'][0].is_aktif == 1) {
					$('#is_aktif').prop('checked', true);
				} else {
					$('#is_aktif').prop('checked', false);
				}				

				if(json['data'][0].banner_img != '') {
					$('#current_banner_img').attr('src', '".base_url('events/')."' + json['data'][0].banner_img);
					$('#current_banner_div').show();
				} else {
					$('#current_banner_div').hide();
				}	
			});
		});
		";

  		// FORM VALIDATION JS
  		$data['js'] .= "
  	$('#formtambahperiode').validate({
		    rules: {
		      nama: {
		        required: true
		      },
		      singkat: {
		        required: true
		      },
		      deskripsi: {
		        required: true
		      },
		      tanggal_mulai: {
		        required: true
		      },
		      tanggal_selesai: {
		        required: true
		      }
		    },
		    messages: {
		      nama: {
		        required: 'Harus diisi'
		      },
		      singkat: {
		        required: 'Harus diisi'
		      },
		      deskripsi: {
		        required: 'Harus diisi'
		      },
		      tanggal_mulai: {
		        required: 'Harus diisi'
		      },
		      tanggal_selesai: {
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

  		// VALIDASI TANGGAL JS
  		$data['js'] .= "
  		$('#btnsubmit').on('click', function(e) {
  			var tanggal_mulai = $('#tanggal_mulai').val();
  			var tanggal_selesai = $('#tanggal_selesai').val();

        	//Generate an array where the first element is the year, second is month and third is day
        	var splitMulai = tanggal_mulai.split('/');
        	var splitSelesai = tanggal_selesai.split('/');

        	//Create a date object from the arrays
        	var tanggal_mulai_date = Date.parse(splitMulai[0], splitMulai[1] - 1, splitMulai[2]);
        	var tanggal_selesai_date = Date.parse(splitSelesai[0], splitSelesai[1] - 1, splitSelesai[2]);

       		if(tanggal_selesai_date < tanggal_mulai_date) {
       			e.preventDefault();
       			alert('Tanggal mulai harus kurang dari tanggal selesai event');
       		}
  		});
  		";


		$this->load->view('v_header', $data);
		$this->load->view('v_sidebar', $data);
		$this->load->view('events/v_periode', $data);
		$this->load->view('v_footer', $data);
	}

	public function delperiode($id) {
		$this->eventmodel->doDelEvent($id);
		$this->session->set_flashdata('notif', 'del_event_success');
		redirect('events/periode');
	}
	public function deltenant($id) {
		$this->eventmodel->doDelTenant($id);
		$this->session->set_flashdata('notif', 'del_tenant_success');
		redirect('events/tenant');
	}

	public function delvoucher($id) {
		$this->eventmodel->doDelVoucher($id);
		$this->session->set_flashdata('notif', 'del_voucher_success');
		redirect('events/voucher');
	}

	public function loadevent() {
		if($this->input->post('eventid')) {
			$data = $this->eventmodel->getAllEvent($this->input->post('eventid'));
			echo json_encode(array('result' => 'success', 'data'=> $data));
		} else {
			echo json_encode(array('result'=> 'false'));
		}
	}

	public function loadtenant() {
		if($this->input->post('tenantid')) {
			$data = $this->eventmodel->getAllTenant($this->input->post('tenantid'));
			echo json_encode(array('result' => 'success', 'data'=> $data));
		} else {
			echo json_encode(array('result'=> 'false'));
		}
	}

	public function loadvoucher() {
		if($this->input->post('voucherid')) {
			$data = $this->eventmodel->getAllVoucher($this->input->post('voucherid'));
			echo json_encode(array('result' => 'success', 'data'=> $data));
		} else {
			echo json_encode(array('result'=> 'false'));
		}
	}
	
}
