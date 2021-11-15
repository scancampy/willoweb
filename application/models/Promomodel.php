<?php
	class Promomodel extends CI_Model {
   
    function __construct()
    {
    	parent::__construct();		
    }

    function get_next_ai() {
        $q = $this->db->query("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES
WHERE table_name = 'promo'");
        return $q->row();
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('promo');
    }

    function set_visible($id) {
        $this->db->query('UPDATE promo SET is_visible = IF(is_visible=1, 0, 1) WHERE id="'.$id.'"');
    }

    function insert($title, $content, $short_desc, $promo_date) {
        $data = array('title' => $title, 'content' => $content, 'short_desc' => $short_desc, 'created' => date('Y-m-d H:i:s'), 'promo_date' => $promo_date, 'is_visible' => 1);
        $this->db->insert('promo', $data);
    }

    function update($id, $title, $content, $short_desc, $promo_date) {
        $data = array('title' => $title, 'content' => $content, 'short_desc' => $short_desc, 'promo_date' => $promo_date);
        $this->db->where('id', $id);
        $this->db->update('promo', $data); 
    }

    function get_data($where = null) {
        $this->db->order_by('promo_date', 'desc');
        if($where == null) {
            $q = $this->db->get('promo');
        } else {
            $q = $this->db->get_where('promo', $where);
        }

        return $q->result();
    }


} ?>