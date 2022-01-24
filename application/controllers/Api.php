<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");  
 
 date_default_timezone_set('Asia/Jakarta');

class Api extends CI_Controller {

	public function request_forgot() {
 		header("Access-Control-Allow-Origin: *");
 		if($this->input->post('email')) {	
 			$q = $this->customermodel->get_data(array('email_customer' => $this->input->post('email')));
 			if(!empty($q)) {
	 			echo json_encode(array('message' => 'true', 'data' => $q));	
	 		} else {
	 			echo json_encode(array('message' => 'false'));	
	 		}
 		} else {
 			echo json_encode(array('message' => 'false'));	
 		}
		
	}

	
	
	public function forgotpass() {
	     header("Access-Control-Allow-Origin: *");
	    if($this->input->post('email')) {
			// cek token dulu
			$cust = $this->customermodel->get_data(array('email_customer' => $this->input->post('email'))); 
			if(count($cust) > 0) {
			    
			    $pass = $this->customermodel->forgot_pass($cust[0]->kode_customer);
			    
			    if($pass == false) {
			          echo json_encode(array('result' => 'false', 'message'=> 'error'));
			    } else {
    			    $this->load->library('email');
    	    
            	    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'gator4164.hostgator.com';
                    $config['smtp_user'] = 'donotreply@willowapps.net';
                    $config['smtp_pass'] = '*t6SS)PxX7zD';
                    $config['smtp_port'] = '465';
                    $config['smtp_crypto'] = 'ssl';
                    
            
                    $this->email->initialize($config);
            
                    $this->email->from('apps@willowbabyshop.com', 'Willow Baby & Kids Apps');
                    $this->email->to($this->input->post('email'));
                    
                    $this->email->subject('Password Have Been Changed - Willow Baby & Kids Apps');
                    $this->email->message("Dear ".ucwords($cust[0]->nama_customer).", \r\n Please be advised that your password have been changed to ".$pass." \r\n\r\n Use this new password to login into Willow Baby & Kids Apps. You should change your password immediately after login. \r\n\r\n Regards,\r\n Willow Baby & Kids Admin.");
            	

                    if ( ! $this->email->send())
                    {
                        //echo json_encode(array('result' => 'false', 'message'=> 'error'.$this->email->print_debugger()));
                        echo json_encode(array('result' => 'false', 'message'=> 'error'));
                    } else {
                        echo json_encode(array('result' => 'true', 'message'=> 'success'));
                    }
			    }
			    
			} else {
			    echo json_encode(array('result' => 'false', 'message'=> 'notfound'));
			}
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	   
	}

	public function getundian() {
 		if($this->input->post('token')) {
			// cek token dulu
			if($this->customermodel->check_token($this->input->post('token'), $this->input->post('kode_customer'))) {
				$lucky = $this->luckymodel->get_data(array('kode_customer' =>$this->input->post('kode_customer')), $this->input->post('search'));
				echo json_encode(array('result' => 'true', 'data'=> $lucky));
			} else {
				echo json_encode(array('result' => 'false', 'message'=> 'token_error'));
			}			
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}		
	}

	public function gettoko() {
 		if($this->input->post('token')) {
			// cek token dulu
			if($this->customermodel->check_token($this->input->post('token'), $this->input->post('kode_customer'))) {
				$toko = $this->tokomodel->get_data();
				echo json_encode(array('result' => 'true', 'data'=> $toko));
			} else {
				echo json_encode(array('result' => 'false', 'message'=> 'token_error'));
			}			
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}		
	}
	
	public function getbarcodetest() {
	    $bar = SUBSTR(md5('W32000137'.date('Ymd')), 0, 12);
 	    //$bar = SUBSTR(do_hash('W32000137'.date('Ymd'),'md5'), 1, 12);
 	    echo 'date("Ymd") = '.date('Ymd');
 	    echo '<br/>';
 	    echo 'kodekust + date("Ymd") = '.'W32000137'.date('Ymd');
 	    echo '<br/>Result: ';
        echo json_encode(array('result' => 'true', 'data'=> $bar));
			
	}

	public function getbarcode() {
 		if($this->input->post('token')) {
			// cek token dulu
			if($this->customermodel->check_token($this->input->post('token'), $this->input->post('kode_customer'))) {
				//$bar = SUBSTR(do_hash($this->input->post('kode_customer').date('Ymd'),'md5'), 1, 12);
                $bar = SUBSTR(md5($this->input->post('kode_customer').date('Ymd')), 0, 12);
				
				echo json_encode(array('result' => 'true', 'data'=> $bar));
			} else {
				echo json_encode(array('result' => 'false', 'message'=> 'token_error'));
			}			
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}		
	}



	public function getpromo() {
		if($this->input->post('userid')) {
			$res = $this->promomodel->get_data(array('is_visible' => 1));
			echo json_encode(array('result' => 'true', 'data'=> $res));
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	}

	public function getfaq() {		
		$res = $this->faqmodel->get_data();
		echo json_encode(array('result' => 'true', 'data'=> $res));		
	}

	public function getpromodetail() {
		if($this->input->post('id')) {
			$res = $this->promomodel->get_data(array('id' => $this->input->post('id')));
			echo json_encode(array('result' => 'true', 'data'=> $res));
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	}



	public function updateprofile() {
		if($this->input->post('token')) {
			// cek token dulu
			if($this->customermodel->check_token($this->input->post('token'), $this->input->post('kode_customer'))) {
				$this->customermodel->update_data($this->input->post('kode_customer'),array('nama_depan' => $this->input->post('firstname'), 'nama_belakang' => $this->input->post('lastname')));
				echo json_encode(array('result' => 'true', 'message'=> 'success'));
			} else {
				echo json_encode(array('result' => 'false', 'message'=> 'token_error'));
			}			
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	}

	public function getinboxmesage() {
		$this->load->helper('text');
		$this->load->helper('string');

		if($this->input->post('token')) {
			// cek token dulu
			if($this->customermodel->check_token($this->input->post('token'), $this->input->post('kode_customer'))) {
				$res = $this->inboxmodel->get_data(array('kode_customer' => $this->input->post('kode_customer'), 'is_delete' => 0));

				$data = array();
				foreach ($res as $key => $value) {
					$data[$key]['title'] = $value->title;
					$data[$key]['created'] = strftime("%d %B %Y", strtotime($value->created));
					$data[$key]['content'] = character_limiter(strip_tags($value->content),20,'...');
					$data[$key]['id'] = $value->id;
					$data[$key]['is_read'] = $value->is_read;				}

				
				echo json_encode(array('result' => 'true', 'data'=> $data));
			} else {
				echo json_encode(array('result' => 'false', 'message'=> 'token_error'));
			}			
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	}

	public function getmasterreward() {
		if($this->input->post('token')) {
			// cek token dulu
			if($this->customermodel->check_token($this->input->post('token'), $this->input->post('kode_customer'))) {
				$res = $this->rewardmodel->get_master_reward();
				
				echo json_encode(array('result' => 'true', 'data'=> $res));
			} else {
				echo json_encode(array('result' => 'false', 'message'=> 'token_error'));
			}			
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	}

	public function getrewardhistory() {
		if($this->input->post('token')) {
			// cek token dulu
			if($this->customermodel->check_token($this->input->post('token'), $this->input->post('kode_customer'))) {
				$res = $this->rewardmodel->get_data(array('kode_customer' => $this->input->post('kode_customer')));
				$tot = $this->rewardmodel->get_data(array('kode_customer' => $this->input->post('kode_customer'), 'poin_ditukar' => 0, 'reward_didapat' => 0));

				if(count($tot) >0) {
					$total = $tot[0]->saldo_poin;	
				} else {
					$total = 0;
				}
				/*foreach ($res as $key => $value) {
					$total += $value->reward_didapat;
				}*/
				echo json_encode(array('result' => 'true', 'data'=> $res, 'total' => $total));
			} else {
				echo json_encode(array('result' => 'false', 'message'=> 'token_error'));
			}			
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	}

	public function gettranshistory() {
		if($this->input->post('token')) {
			// cek token dulu
			if($this->customermodel->check_token($this->input->post('token'), $this->input->post('kode_customer'))) {
				$res = $this->transmodel->get_data(array('kode_customer' => $this->input->post('kode_customer')));

				echo json_encode(array('result' => 'true', 'data'=> $res));
			} else {
				echo json_encode(array('result' => 'false', 'message'=> 'token_error'));
			}			
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	}

	public function changepass() {
		if($this->input->post('token')) {
			// cek token dulu
			if($this->customermodel->check_token($this->input->post('token'), $this->input->post('kode_customer'))) {
				echo $this->customermodel->change_pass(
					$this->input->post('kode_customer'), 
					$this->input->post('oldpassword'), 
					$this->input->post('password'));
				//echo json_encode(array('result' => 'true', 'message'=> 'success'));
			} else {
				echo json_encode(array('result' => 'false', 'message'=> 'token_error'));
			}			
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	}

	public function loadprofile() {
		if($this->input->post('token')) {
			// cek token dulu
			if($this->customermodel->check_token($this->input->post('token'), $this->input->post('kode_customer'))) {
				$res = $this->customermodel->get_data(array('kode_customer' => $this->input->post('kode_customer')));
				echo json_encode(array('result' => 'true', 'data'=> $res));
			} else {
				echo json_encode(array('result' => 'false', 'message'=> 'token_error'));
			}			
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	}

	public function signin() {
		if($this->input->post('email')) {
			$pass = trim($this->input->post('pass'));
			$email = trim($this->input->post('email'));
			$res = $this->customermodel->sign_in($email, $pass);
			echo $res;
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	}

	public function activated() {
		if($this->input->post('hp')) {
			$hp = trim($this->input->post('hp'));
			$email = trim($this->input->post('email'));
			$pass = trim($this->input->post('pass'));

			$res = $this->customermodel->activated($hp, $email, $pass );
			echo $res;
		} else {
			echo json_encode(array('result' => 'false', 'message'=> 'error'));
		}
	}

	public function activated2() {
		$res = $this->customermodel->activated2('085850745583', 'andrenoto@yahoo.co.id', 'password' );
		echo $res;
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
}
