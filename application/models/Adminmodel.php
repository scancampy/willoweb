<?php
	class Adminmodel extends CI_Model {
   
    function __construct()
    {
    	parent::__construct();		
    }

    function get_data($where) {        
        $this->db->where($where);
        $r = $this->db->get_where('admin', $where);
        return $r->row();
    }

    function change_pass($username, $oldpass, $newpass) {
        // cek oldpass

        $q = $this->db->get_where('admin', array('username' => $username));
        $hq = $q->row();
        $salt = $hq->salt;
       //  echo $salt; 
        $password = do_hash($oldpass.do_hash($salt,'md5'), 'md5');
        //echo 
        if($hq->password == $password) {
            $newpassword = do_hash($newpass.do_hash($salt,'md5'), 'md5');

            $data = array('password' => $newpassword);
            $this->db->where('username', $username);
            $this->db->update('admin', $data);

            return "success";
        } else {
            return "invalid";
        }
    }

    function sign_in($username, $pass) {
        $q = $this->db->get_where('admin', array('username' => $username));

        if($q->num_rows() > 0) {
            $hq = $q->row();
            $salt = $hq->salt;

            $password = do_hash($pass.do_hash($salt,'md5'), 'md5');
            if($password == $hq->password) {                
                // create session
                $data = array('last_login' => date('Y-m-d H:i:s'));
                $this->db->where('username', $username);
                $this->db->update('admin', $data);
                return true;
               
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

} ?>