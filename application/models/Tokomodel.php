<?php
	class Tokomodel extends CI_Model {
   
    function __construct()
    {
    	parent::__construct();		
    }

    function get_data($where = null) {      
       
        if($where == null) {
            $q = $this->db->get('mst_toko');
        } else {
            $q = $this->db->get_where('mst_toko', $where);
        }

        return $q->result();
    }


} ?>