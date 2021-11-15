<?php
	class Rewardmodel extends CI_Model {
   
    function __construct()
    {
    	parent::__construct();		
    }

    function get_data($where = null) {
        $this->db->order_by('tgl_redeem', 'desc');
        $this->db->select('kode_reward, DATE_FORMAT(tgl_redeem,"%d %M %Y") as tgl_redeem2, tgl_redeem, kode_customer, poin_ditukar, saldo_poin, reward_didapat, keterangan');
        if($where == null) {
            $q = $this->db->get('trn_reward');
        } else {
            $q = $this->db->get_where('trn_reward', $where);
        }

        return $q->result();
    }

    function get_master_reward() {
        $this->db->order_by('value_bawah', 'asc');
        $q = $this->db->get('mst_reward');
        return $q->result();
    }


} ?>