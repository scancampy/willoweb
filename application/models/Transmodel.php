<?php
	class Transmodel extends CI_Model {
   
    function __construct()
    {
    	parent::__construct();		
    }

    function get_data($where = null) {
        $this->db->limit(5);
        $this->db->order_by('tgl_trans', 'desc');
        $this->db->select('kode_trans, kode_toko,kode_customer, DATE_FORMAT(tgl_trans,"%d %M %Y") as tgl_trans2, tgl_trans, FORMAT(`nilai_trans`,0,"de_DE") as nilai_trans, keterangan');
        if($where == null) {
            $q = $this->db->get('trn_history');
        } else {
            $q = $this->db->get_where('trn_history', $where);
        }

        return $q->result();
    }


} ?>