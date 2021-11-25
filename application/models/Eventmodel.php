<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventmodel extends CI_Model {
	// EVENT
	public function doInsertEvent($data) {
		if($data['is_aktif'] == 1) {
			$this->db->update('events', array('is_aktif' => 0));
		}
		$this->db->insert('events', $data);
	}

	public function getAllEvent($id = '', $where = '', $limit = 0) {
		if($id != '') {
			$this->db->where('id', $id);
		}

		if($where != '') {
			$this->db->where($where);
		}

		if($limit > 0) {
			$this->db->limit($limit);
		}

		$this->db->where('status', 'active');
		$this->db->order_by('tanggal_mulai','desc');
		$q = $this->db->get('events');

		return $q->result();
	}

	public function getKodeAll($kode, $where = '', $limit = 0) {
		if($kode != '') {
			$this->db->where('kode', $kode);
		}

		if($where != '') {
			$this->db->where($where);
		}

		if($limit > 0) {
			$this->db->limit($limit);
		}

		$this->db->where('status', 'active');
		$this->db->order_by('nama','asc');
		$q = $this->db->get('barang');

		return $q->result();
	}

	public function doUpdateEvent($id, $data) {
		if($data['is_aktif'] == 1) {
			$this->db->update('events', array('is_aktif' => 0));
		}

		$this->db->where('id', $id);
		$this->db->update('events', $data);
	}

	public function doDelEvent($id) {
		$this->db->where('id', $id);
		$this->db->update('events', array('status' => 'deleted'));
	}

	// TENANT
	public function doInsertTenant($data) {
		$this->db->insert('tenants', $data);
		return $this->db->insert_id();
	}

	public function getAllTenant($id = '', $where = '', $limit = 0) {
		if($id != '') {
			$this->db->where('id', $id);
		}

		if($where != '') {
			$this->db->where($where);
		}

		if($limit > 0) {
			$this->db->limit($limit);
		}

		$this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$q = $this->db->get('tenants');


		return $q->result();
	}

	public function doUpdateTenant($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('tenants', $data);
	}

	public function doDelTenant($id) {
		$this->db->where('id', $id);
		$this->db->update('tenants', array('status' => 'deleted'));
	}

	// VOUCHER
	public function doInsertVoucher($data) {
		$this->db->insert('voucher', $data);
		return $this->db->insert_id();
	}

	public function getAllVoucher($id = '', $where = '', $limit = 0) {
		if($id != '') {
			$this->db->where('id', $id);
		}

		if($where != '') {
			$this->db->where($where);
		}

		if($limit > 0) {
			$this->db->limit($limit);
		}

		$this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$q = $this->db->get('voucher');

		return $q->result();
	}

	public function doUpdateVoucher($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('voucher', $data);
	}

	public function doDelVoucher($id) {
		$this->db->where('id', $id);
		$this->db->update('voucher', array('status' => 'deleted'));
	}

	// MANAGED EVENT
	public function registerTenant($id, $event_id) {
		// cek tenant sudah ada atau belum
		$q= $this->db->get_where('events_tenant', array('tenant_id' => $id, 'event_id' => $event_id));
		

		if($q->num_rows() > 0) {
			return false;
		} else {
			// generate code
			$this->load->helper('string');
			do {
				$code = random_string('alnum', 10);
				$cek = $this->db->get_where('events_tenant', array('kode' => $code));
			} while($cek->num_rows() > 0);

			$dataInsert = array('event_id' => $event_id, 'tenant_id' => $id, 'kode' => $code);
			$this->db->insert('events_tenant', $dataInsert);
			
			return true;
		}
	}

	public function getAllEventTenant($id = '', $where = '', $limit = 0) {
		if($id != '') {
			$this->db->where('event_id', $id);
		}

		if($where != '') {
			$this->db->where($where);
		}

		if($limit > 0) {
			$this->db->limit($limit);
		}

		$this->db->join('tenants', 'tenants.id = events_tenant.tenant_id');
		$this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$this->db->select('events_tenant.*, tenants.logo, tenants.nama, tenants.promo_pdf');
		$q = $this->db->get('events_tenant');

		return $q->result();
	}

	public function removetenant($tenant_id, $event_id) {
		$this->db->delete('events_tenant', array('tenant_id' => $tenant_id, 'event_id' => $event_id));
	}
}
?>