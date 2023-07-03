<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_radius_model extends Base_Model {

	var $fieldmap_daftar = array('nama_provinsi', 'id_kabupaten', 'nama_kabupaten', 'radius_clock_in');
	var $column_order = array(null, 'nama_provinsi', 'id_kabupaten', 'nama_kabupaten', 'radius_clock_in');
	var $column_search = array('nama_provinsi', 'id_kabupaten', 'nama_kabupaten', 'radius_clock_in');

	function __construct()
	{
		parent::__construct();
	}

	function build_query_daftar()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
				, kb.id_kabupaten
				, kb.nama_kabupaten
				, kb.radius_clock_in
			');
			$this->db->from('cb_kabupaten kb');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
				, kc.id_kabupaten
				, kb.nama_kabupaten
				, kb.radius_clock_in
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
				, kc.id_kabupaten
				, kb.nama_kabupaten
				, kb.radius_clock_in
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
			$this->db->where('kc.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('a.id_cluster');
			$this->db->from('bd_tap a');
			$this->db->where('a.id_tap', $id_divisi);
			$rs = $this->db->get()->row_array();
			$id_cluster = isset($rs['id_cluster']) ? $rs['id_cluster'] : 0;

			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
				, kc.id_kabupaten
				, kb.nama_kabupaten
				, kb.radius_clock_in
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
			$this->db->where('kc.id_cluster', $id_cluster);
		}
	}

	function build_query_form($id=NULL)
	{
		$this->db->select('
			kb.id_provinsi
			, pr.nama_provinsi
			, kb.id_kabupaten
			, kb.nama_kabupaten
			, kb.radius_clock_in
		');
		$this->db->from('cb_kabupaten kb');
		$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
		$this->db->where('kb.id_kabupaten', $id);
	}

	function update_kabupaten()
	{
		$id_kab = $this->input->post('id') ? $this->input->post('id') : NULL;

		$this->db->select('1');
		$this->db->from('cb_kabupaten');
		$this->db->where('id_kabupaten', $id_kab);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$data_x = array(
				'radius_clock_in' => $this->input->post('radius') ? prepare_integer($this->input->post('radius')) : 0
			);

			$this->db->where('id_kabupaten', $id_kab);
			$this->db->update('cb_kabupaten', $data_x);
			$this->check_trans_status('update cb_kabupaten failed');
		}
	}

	function save_detail()
	{
		$this->update_kabupaten();
	}

	function cek_exist()
	{
		$id = $this->input->post('id') ? $this->input->post('id') : NULL;

		if($id != NULL)
		{
			$this->db->select('COUNT(id_kabupaten) AS data_exists');
			$this->db->from('cb_kabupaten');
			$this->db->where('id_kabupaten', $this->input->post('id'));
			$result = $this->db->get()->row_array();

			if($result && $result['data_exists'] > 0)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return TRUE;
		}
	}

	function check_duplikasi()
	{
		return TRUE;
	}

	function check_dependency($id)
	{
		return TRUE;
	}
}
?>