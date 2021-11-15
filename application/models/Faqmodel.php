<?php
	class Faqmodel extends CI_Model {
   
    function __construct()
    {
    	parent::__construct();		
    }

    function get_data($where = null) {
        if($where != null) {
            $this->db->where($where);
        }
        $this->db->order_by('urutan', 'asc');
        $q = $this->db->get('faq');
        
        return $q->result();
    }

    function delete($id) {
        $q = $this->db->get_where('faq', array('id' => $id));

        if($q->num_rows() > 0) {
            $hq = $q->row();
            //$hq->urutan;

            $this->db->query('UPDATE faq SET urutan = urutan-1 WHERE urutan > '.$hq->urutan.';');
            $this->db->delete('faq', array('id' => $id));
            return true;
        } else {
            return false;
        }
    }

    function update($id, $title, $content) {
        $data = array('faq' => $title, 'content' => $content);
        $this->db->where('id', $id);
        $this->db->update('faq', $data); 
    }

    function insert($title, $content) {
        $q = $this->db->get('faq');
        $tot = $q->num_rows();
        $data = array('faq' => $title, 'content' => $content, 'urutan' => $tot+1);
        $this->db->insert('faq', $data);
    }

    function up($id) {
        $q = $this->db->get_where('faq', array('id' => $id));
        $hq = $q->row();
        $urutanawal = $hq->urutan;
        $p = $this->db->get_where('faq', array('urutan' => $urutanawal-1));

        if($p->num_rows() > 0) {
            $hp = $p->row();
            $data = array('urutan' => $urutanawal);
            $this->db->where('id', $hp->id);
            $this->db->update('faq',$data);


            $data = array('urutan' => $urutanawal-1);
            $this->db->where('id', $id);
            $this->db->update('faq',$data);

            return true;
        } else {
            return false;
        }
    }

    function down($id) {
        $q = $this->db->get_where('faq', array('id' => $id));
        $hq = $q->row();
        $urutanawal = $hq->urutan;
        $p = $this->db->get_where('faq', array('urutan' => $urutanawal+1));

        if($p->num_rows() > 0) {
            $hp = $p->row();
            $data = array('urutan' => $urutanawal);
            $this->db->where('id', $hp->id);
            $this->db->update('faq',$data);


            $data = array('urutan' => $urutanawal+1);
            $this->db->where('id', $id);
            $this->db->update('faq',$data);

            return true;
        } else {
            return false;
        }
    }


} ?>