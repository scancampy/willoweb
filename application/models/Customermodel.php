<?php
	class Customermodel extends CI_Model {
   
    function __construct()
    {
    	parent::__construct();		
    }
    
    function forgot_pass($kode_customer) {
        $this->load->helper('string');
        $this->load->helper('security');
        $q = $this->db->get_where('mst_customer', array('kode_customer' => $kode_customer));
        if($q->num_rows() >0 ) {
            $hq = $q->row();
            $salt = $hq->salt;
            $pass = strtolower(random_string('alnum', 8));
            $newpass = do_hash(do_hash($pass.$salt,'md5'), 'md5');
            $data = array('password' => $newpass);
            $this->db->where('kode_customer', $kode_customer);
            $this->db->update('mst_customer', $data);
            
            return $pass;
        } else {
            return false;
        }
    }

    function change_pass($kode_customer, $old, $pass) {
        $this->load->helper('security');
        $q = $this->db->get_where('mst_customer', array('kode_customer' => $kode_customer));
        if($q->num_rows() >0 ) {
            $hq = $q->row();
            $salt = $hq->salt;
            $oldpassword = do_hash(do_hash($old.$salt,'md5'), 'md5');
            if($oldpassword == $hq->password) {
                // change pass
                $newpass = do_hash(do_hash($pass.$salt,'md5'), 'md5');
                $data = array('password' => $newpass);
                $this->db->where('kode_customer', $kode_customer);
                $this->db->update('mst_customer', $data);
                return json_encode(array('result' => 'true', 'message' => 'success'));
            } else {
                return json_encode(array('result' => 'false', 'message' => 'old_invalid'));
            }
        } else {
            return json_encode(array('result' => 'false', 'message' => 'not_found'));
        }
    }

    function get_data($where = null) {
        $this->db->order_by('nama_customer', 'asc');
        if($where == null) {
            $q = $this->db->get('mst_customer');
        } else {
            $q = $this->db->get_where('mst_customer', $where);
        }

        return $q->result();
    }

    function update_data($kode_customer, $data) {
        $this->db->where('kode_customer', $kode_customer);
        $this->db->update('mst_customer', $data);
    }

    function check_token($token, $kode_customer) {
        $q = $this->db->get_where('token', array('token' => $token, 'kode_customer' => $kode_customer));
        if($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }       
    }

    function activated($hp, $email, $pass) {
        $this->load->helper('string');
        $this->load->helper('security');

        $q = $this->db->get_where('mst_customer', array('no_hp' => $hp));
        if($q->num_rows() > 0) {
            $hq = $q->row();
            if($hq->status_customer == 'inactive') {
                $salt = random_string('alnum', 10);
                $password = do_hash(do_hash($pass.$salt,'md5'), 'md5');
                $data = array('status_customer' => 'active', 
                              'email_customer' => $email,
                              'salt' => $salt,
                              'password' => $password);
                $this->db->where('kode_customer', $hq->kode_customer);
                $this->db->update('mst_customer', $data);
                return json_encode(array('result' => 'true', 'message' => 'user_activated'));   
            } else if($hq->status_customer == 'active') {
                return json_encode(array('result' => 'false', 'message' => 'user_active'));    
            } else if($hq->status_customer == 'deleted') {
                return json_encode(array('result' => 'false', 'message' => 'not_found'));    
            }  else {
                return json_encode(array('result' => 'false', 'message' => 'banned'));    
            }
        } else {
            return json_encode(array('result' => 'false', 'message' => 'not_found'));
        }
    }

    function activated2($hp, $email, $pass) {
        $this->load->helper('string');
        $this->load->helper('security');
      //  return json_encode(array('result' => 'false', 'message' => 'test'));

        $q = $this->db->get_where('mst_customer', array('no_hp' => $hp));
        if($q->num_rows() > 0) {
            $hq = $q->row();
            if($hq->status_customer == 'inactive') {
                $salt = random_string('alnum', 10);
                $password = do_hash(do_hash($pass.$salt,'md5'), 'md5');
                $data = array('status_customer' => 'active', 
                              'email_customer' => $email,
                              'salt' => $salt,
                              'password' => $password);
                $this->db->where('kode_customer', $hq->kode_customer);
                $this->db->update('mst_customer', $data);

                return json_encode(array('result' => 'true', 'message' => 'user_activated', 'db' => $this->db->last_query()));   
            } else if($hq->status_customer == 'active') {
                return json_encode(array('result' => 'false', 'message' => 'user_active'));    
            } else if($hq->status_customer == 'deleted') {
                return json_encode(array('result' => 'false', 'message' => 'not_found'));    
            }  else {
                return json_encode(array('result' => 'false', 'message' => 'banned'));    
            }
        } else {
            return json_encode(array('result' => 'false', 'message' => 'not_found'));
        }
    }

    function sign_in($email, $pass) {
        $this->load->helper('security');
        $this->load->helper('string');
        $q = $this->db->get_where('mst_customer', array('email_customer' => $email, 'status_customer'=> 'active'));

        if($q->num_rows() == 0) {
            $q = $this->db->get_where('mst_customer', array('no_hp' => $email, 'status_customer'=> 'active'));
        } 

        if($q->num_rows() > 0) {
            $hq = $q->row();
            $salt = $hq->salt;

            $password = do_hash(do_hash($pass.$salt,'md5'), 'md5');
            if($password == $hq->password) {                
                // create token
                $kode = $this->db->get_where('token', array('kode_customer' => $hq->kode_customer));
                if($kode->num_rows() > 0) {
                    $hkode = $kode->row();
                    $token = $hkode->token;
                } else {
                    $token  = random_string('alnum', 30);
                    $data = array('token' => $token,
                              'kode_customer' => $hq->kode_customer,
                              'created' => date('Y-m-d H:i:s'));
                    $this->db->insert('token', $data);
                }

                return json_encode(array('result' => 'true', 'message' => 'success', 'kode_customer' => $hq->kode_customer, 'token' => $token, 'nama_depan' => $hq->nama_depan, 'nama_belakang' => $hq->nama_belakang));
            } else {
                return json_encode(array('result' => 'false', 'message' => 'invalid'));
            }
        } else {
            return json_encode(array('result' => 'false', 'message' => 'not_found'));
        }
    }

} ?>