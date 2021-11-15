<?php
	class Inboxmodel extends CI_Model {
   
    function __construct()
    {
    	parent::__construct();		
    }

    function get_data($where = null) {
        $this->db->order_by('id_inbox', 'desc');
        $this->db->join('inbox', 'inbox.id = inbox_customer.id_inbox');
        $this->db->select('inbox.title, inbox.content, inbox.created, inbox_customer.*');
        if($where == null) {
            $q = $this->db->get('inbox_customer');
        } else {
            $q = $this->db->get_where('inbox_customer', $where);
        }

        return $q->result();
    }


} ?>