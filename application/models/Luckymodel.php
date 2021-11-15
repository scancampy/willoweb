<?php
	class Luckymodel extends CI_Model {
   
    function __construct()
    {
    	parent::__construct();		
    }

    function get_data($where = null, $search ='') {
        $this->db->order_by('expired', 'desc');

        if($search != '') {
            $this->db->like('nomor_undian', $search);
        }

        $this->db->select('kode_customer, kode_undian, nomor_undian, DATE_FORMAT(purchased,"%d %M %Y") as purchased, DATE_FORMAT(purchased,"%d %M %Y") as expired, is_winning, DATE_FORMAT(winning_date,"%d-%m-%Y") as winning_date');
        
        if($where == null) {
            $q = $this->db->get('trn_undian');
        } else {
            $q = $this->db->get_where('trn_undian', $where);
        }

        return $q->result();
    }




} ?>