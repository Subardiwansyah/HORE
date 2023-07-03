<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_distribusi_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	var $fieldmap_daftar = array(
		'nama',
		'segel_prepaid', 'segel_voucher', 'sa_ld', 'sa_md', 'sa_hd', 'vf_ld', 'vf_md', 'vf_hd', 'linkaja'
	);
	var $column_order = array(
		null,
		'nama',
		'segel_prepaid', 'segel_voucher', 'sa_ld', 'sa_md', 'sa_hd', 'vf_ld', 'vf_md', 'vf_hd', 'linkaja'
	);
	var $column_search = array(
		'nama',
		'segel_prepaid', 'segel_voucher', 'sa_ld', 'sa_md', 'sa_hd', 'vf_ld', 'vf_md', 'vf_hd', 'linkaja'
	);

	function build_query_daftar()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');

		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.nama
				, xx.segel_prepaid
				, xx.segel_voucher
				, xx.sa_ld
				, xx.sa_md
				, xx.sa_hd
				, xx.vf_ld
				, xx.vf_md
				, xx.vf_hd
				, xx.linkaja
			');
			$this->db->from('
				(
					SELECT
							b.nama_branch AS nama
							, COALESCE((d.outlet_segel_prepaid + d.sekolah_segel_prepaid + d.kampus_segel_prepaid + d.fakultas_segel_prepaid + d.poi_segel_prepaid), 0) AS segel_prepaid
							, COALESCE((d.outlet_segel_voucher + d.sekolah_segel_voucher + d.kampus_segel_voucher + d.fakultas_segel_voucher + d.poi_segel_voucher), 0) AS segel_voucher
							, COALESCE((d.outlet_sa_ld + d.sekolah_sa_ld + d.kampus_sa_ld + d.fakultas_sa_ld + d.poi_sa_ld), 0) AS sa_ld
							, COALESCE((d.outlet_sa_md + d.sekolah_sa_md + d.kampus_sa_md + d.fakultas_sa_md + d.poi_sa_md), 0) AS sa_md
							, COALESCE((d.outlet_sa_hd + d.sekolah_sa_hd + d.kampus_sa_hd + d.fakultas_sa_hd + d.poi_sa_hd), 0) AS sa_hd
							, COALESCE((d.outlet_vf_ld + d.sekolah_vf_ld + d.kampus_vf_ld + d.fakultas_vf_ld + d.poi_vf_ld), 0) AS vf_ld
							, COALESCE((d.outlet_vf_md + d.sekolah_vf_md + d.kampus_vf_md + d.fakultas_vf_md + d.poi_vf_md), 0) AS vf_md
							, COALESCE((d.outlet_vf_hd + d.sekolah_vf_hd + d.kampus_vf_hd + d.fakultas_vf_hd + d.poi_vf_hd), 0) AS vf_hd
							, COALESCE((d.outlet_linkaja + d.sekolah_linkaja + d.kampus_linkaja + d.fakultas_linkaja + d.poi_linkaja), 0) AS linkaja
					FROM
							bb_branch b
							LEFT JOIN aj_dashboard_distribusi_branch d
									ON (b.id_branch = d.id_branch AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.segel_prepaid
				, xx.segel_voucher
				, xx.sa_ld
				, xx.sa_md
				, xx.sa_hd
				, xx.vf_ld
				, xx.vf_md
				, xx.vf_hd
				, xx.linkaja
			');
			$this->db->from('
				(
					SELECT
							b.nama_branch AS nama
							, COALESCE((d.outlet_segel_prepaid + d.sekolah_segel_prepaid + d.kampus_segel_prepaid + d.fakultas_segel_prepaid + d.poi_segel_prepaid), 0) AS segel_prepaid
							, COALESCE((d.outlet_segel_voucher + d.sekolah_segel_voucher + d.kampus_segel_voucher + d.fakultas_segel_voucher + d.poi_segel_voucher), 0) AS segel_voucher
							, COALESCE((d.outlet_sa_ld + d.sekolah_sa_ld + d.kampus_sa_ld + d.fakultas_sa_ld + d.poi_sa_ld), 0) AS sa_ld
							, COALESCE((d.outlet_sa_md + d.sekolah_sa_md + d.kampus_sa_md + d.fakultas_sa_md + d.poi_sa_md), 0) AS sa_md
							, COALESCE((d.outlet_sa_hd + d.sekolah_sa_hd + d.kampus_sa_hd + d.fakultas_sa_hd + d.poi_sa_hd), 0) AS sa_hd
							, COALESCE((d.outlet_vf_ld + d.sekolah_vf_ld + d.kampus_vf_ld + d.fakultas_vf_ld + d.poi_vf_ld), 0) AS vf_ld
							, COALESCE((d.outlet_vf_md + d.sekolah_vf_md + d.kampus_vf_md + d.fakultas_vf_md + d.poi_vf_md), 0) AS vf_md
							, COALESCE((d.outlet_vf_hd + d.sekolah_vf_hd + d.kampus_vf_hd + d.fakultas_vf_hd + d.poi_vf_hd), 0) AS vf_hd
							, COALESCE((d.outlet_linkaja + d.sekolah_linkaja + d.kampus_linkaja + d.fakultas_linkaja + d.poi_linkaja), 0) AS linkaja
					FROM
							bb_branch b
							LEFT JOIN aj_dashboard_distribusi_branch d
									ON (b.id_branch = d.id_branch AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (b.id_branch = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.segel_prepaid
				, xx.segel_voucher
				, xx.sa_ld
				, xx.sa_md
				, xx.sa_hd
				, xx.vf_ld
				, xx.vf_md
				, xx.vf_hd
				, xx.linkaja
			');
			$this->db->from('
				(
					SELECT
							b.nama_branch AS nama
							, COALESCE((d.outlet_segel_prepaid + d.sekolah_segel_prepaid + d.kampus_segel_prepaid + d.fakultas_segel_prepaid + d.poi_segel_prepaid), 0) AS segel_prepaid
							, COALESCE((d.outlet_segel_voucher + d.sekolah_segel_voucher + d.kampus_segel_voucher + d.fakultas_segel_voucher + d.poi_segel_voucher), 0) AS segel_voucher
							, COALESCE((d.outlet_sa_ld + d.sekolah_sa_ld + d.kampus_sa_ld + d.fakultas_sa_ld + d.poi_sa_ld), 0) AS sa_ld
							, COALESCE((d.outlet_sa_md + d.sekolah_sa_md + d.kampus_sa_md + d.fakultas_sa_md + d.poi_sa_md), 0) AS sa_md
							, COALESCE((d.outlet_sa_hd + d.sekolah_sa_hd + d.kampus_sa_hd + d.fakultas_sa_hd + d.poi_sa_hd), 0) AS sa_hd
							, COALESCE((d.outlet_vf_ld + d.sekolah_vf_ld + d.kampus_vf_ld + d.fakultas_vf_ld + d.poi_vf_ld), 0) AS vf_ld
							, COALESCE((d.outlet_vf_md + d.sekolah_vf_md + d.kampus_vf_md + d.fakultas_vf_md + d.poi_vf_md), 0) AS vf_md
							, COALESCE((d.outlet_vf_hd + d.sekolah_vf_hd + d.kampus_vf_hd + d.fakultas_vf_hd + d.poi_vf_hd), 0) AS vf_hd
							, COALESCE((d.outlet_linkaja + d.sekolah_linkaja + d.kampus_linkaja + d.fakultas_linkaja + d.poi_linkaja), 0) AS linkaja
					FROM
							bc_cluster c
							INNER JOIN bb_branch b
									ON (c.id_branch = b.id_branch)
							LEFT JOIN aj_dashboard_distribusi_branch d
									ON (b.id_branch = d.id_branch AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (c.id_cluster = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.segel_prepaid
				, xx.segel_voucher
				, xx.sa_ld
				, xx.sa_md
				, xx.sa_hd
				, xx.vf_ld
				, xx.vf_md
				, xx.vf_hd
				, xx.linkaja
			');
			$this->db->from('
				(
					SELECT
							b.nama_branch AS nama
							, COALESCE((d.outlet_segel_prepaid + d.sekolah_segel_prepaid + d.kampus_segel_prepaid + d.fakultas_segel_prepaid + d.poi_segel_prepaid), 0) AS segel_prepaid
							, COALESCE((d.outlet_segel_voucher + d.sekolah_segel_voucher + d.kampus_segel_voucher + d.fakultas_segel_voucher + d.poi_segel_voucher), 0) AS segel_voucher
							, COALESCE((d.outlet_sa_ld + d.sekolah_sa_ld + d.kampus_sa_ld + d.fakultas_sa_ld + d.poi_sa_ld), 0) AS sa_ld
							, COALESCE((d.outlet_sa_md + d.sekolah_sa_md + d.kampus_sa_md + d.fakultas_sa_md + d.poi_sa_md), 0) AS sa_md
							, COALESCE((d.outlet_sa_hd + d.sekolah_sa_hd + d.kampus_sa_hd + d.fakultas_sa_hd + d.poi_sa_hd), 0) AS sa_hd
							, COALESCE((d.outlet_vf_ld + d.sekolah_vf_ld + d.kampus_vf_ld + d.fakultas_vf_ld + d.poi_vf_ld), 0) AS vf_ld
							, COALESCE((d.outlet_vf_md + d.sekolah_vf_md + d.kampus_vf_md + d.fakultas_vf_md + d.poi_vf_md), 0) AS vf_md
							, COALESCE((d.outlet_vf_hd + d.sekolah_vf_hd + d.kampus_vf_hd + d.fakultas_vf_hd + d.poi_vf_hd), 0) AS vf_hd
							, COALESCE((d.outlet_linkaja + d.sekolah_linkaja + d.kampus_linkaja + d.fakultas_linkaja + d.poi_linkaja), 0) AS linkaja
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
							INNER JOIN bb_branch b
									ON (c.id_branch = b.id_branch)
							LEFT JOIN aj_dashboard_distribusi_branch d
									ON (b.id_branch = d.id_branch AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (t.id_tap = "'.$id_divisi.'")
				) xx
			');
		}
	}

	var $fieldmap_daftar_1 = array(
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);
	var $column_order_1 = array(
		null,
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);
	var $column_search_1 = array(
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);

	function build_query_daftar_1()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');

		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							b.nama_branch AS nama
							, d.*
					FROM
							bb_branch b
							LEFT JOIN aj_dashboard_distribusi_branch d
									ON (b.id_branch = d.id_branch AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							b.nama_branch AS nama
							, d.*
					FROM
							bb_branch b
							LEFT JOIN aj_dashboard_distribusi_branch d
									ON (b.id_branch = d.id_branch AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (b.id_branch = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							b.nama_branch AS nama
							, d.*
					FROM
							bc_cluster c
							INNER JOIN bb_branch b
									ON (c.id_branch = b.id_branch)
							LEFT JOIN aj_dashboard_distribusi_branch d
									ON (b.id_branch = d.id_branch AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (c.id_cluster = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							b.nama_branch AS nama
							, d.*
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
							INNER JOIN bb_branch b
									ON (c.id_branch = b.id_branch)
							LEFT JOIN aj_dashboard_distribusi_branch d
									ON (b.id_branch = d.id_branch AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (t.id_tap = "'.$id_divisi.'")
				) xx
			');
		}
	}

	var $fieldmap_daftar_2 = array(
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);
	var $column_order_2 = array(
		null,
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);
	var $column_search_2 = array(
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);

	function build_query_daftar_2()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');

		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							c.nama_cluster AS nama
							, d.*
					FROM
							bc_cluster c
							LEFT JOIN ak_dashboard_distribusi_cluster d
									ON (c.id_cluster = d.id_cluster AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							c.nama_cluster AS nama
							, d.*
					FROM
							bc_cluster c
							LEFT JOIN ak_dashboard_distribusi_cluster d
									ON (c.id_cluster = d.id_cluster AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (c.id_branch = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							c.nama_cluster AS nama
							, d.*
					FROM
							bc_cluster c
							LEFT JOIN ak_dashboard_distribusi_cluster d
									ON (c.id_cluster = d.id_cluster AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (c.id_cluster = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							c.nama_cluster AS nama
							, d.*
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
							LEFT JOIN ak_dashboard_distribusi_cluster d
									ON (c.id_cluster = d.id_cluster AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (t.id_tap = "'.$id_divisi.'")
				) xx
			');
		}
	}

	var $fieldmap_daftar_3 = array(
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);
	var $column_order_3 = array(
		null,
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);
	var $column_search_3 = array(
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);

	function build_query_daftar_3()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');

		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							t.nama_tap AS nama
							, d.*
					FROM
							bd_tap t
							LEFT JOIN al_dashboard_distribusi_tap d
									ON (t.id_tap = d.id_tap AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							t.nama_tap AS nama
							, d.*
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
							LEFT JOIN al_dashboard_distribusi_tap d
									ON (t.id_tap = d.id_tap AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (c.id_branch = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							t.nama_tap AS nama
							, d.*
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
							LEFT JOIN al_dashboard_distribusi_tap d
									ON (t.id_tap = d.id_tap AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (c.id_cluster = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							t.nama_tap AS nama
							, d.*
					FROM
							bd_tap t
							LEFT JOIN al_dashboard_distribusi_tap d
									ON (t.id_tap = d.id_tap AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (t.id_tap = "'.$id_divisi.'")
				) xx
			');
		}
	}

	var $fieldmap_daftar_4 = array(
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);
	var $column_order_4 = array(
		null,
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);
	var $column_search_4 = array(
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);

	function build_query_daftar_4()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');

		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							kb.nama_kabupaten AS nama
							, d.*
					FROM
							cb_kabupaten kb
							LEFT JOIN am_dashboard_distribusi_kabupaten d
									ON (kb.id_kabupaten = d.id_kabupaten AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT DISTINCT
							kb.nama_kabupaten AS nama
							, d.*
					FROM
							cc_kecamatan kc
							INNER JOIN cb_kabupaten kb
									ON (kc.id_kabupaten = kb.id_kabupaten)
							INNER JOIN bc_cluster c
									ON (kc.id_cluster = c.id_cluster)
							LEFT JOIN am_dashboard_distribusi_kabupaten d
									ON (kb.id_kabupaten = d.id_kabupaten AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (c.id_branch = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT DISTINCT
							kb.nama_kabupaten AS nama
							, d.*
					FROM
							cc_kecamatan kc
							INNER JOIN cb_kabupaten kb
									ON (kc.id_kabupaten = kb.id_kabupaten)
							LEFT JOIN am_dashboard_distribusi_kabupaten d
									ON (kb.id_kabupaten = d.id_kabupaten AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (kc.id_cluster = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT DISTINCT
							kb.nama_kabupaten AS nama
							, d.*
					FROM
							cb_kabupaten kb
							INNER JOIN bd_tap t
									ON (kb.id_kabupaten = t.id_kabupaten)
							LEFT JOIN am_dashboard_distribusi_kabupaten d
									ON (kb.id_kabupaten = d.id_kabupaten AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (t.id_tap = "'.$id_divisi.'")
				) xx
			');
		}
	}

	var $fieldmap_daftar_5 = array(
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);
	var $column_order_5 = array(
		null,
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);
	var $column_search_5 = array(
		'nama',
		'outlet_segel_prepaid', 'outlet_segel_voucher', 'outlet_sa_ld', 'outlet_sa_md', 'outlet_sa_hd', 'outlet_vf_ld', 'outlet_vf_md', 'outlet_vf_hd', 'outlet_linkaja',
		'sekolah_segel_prepaid', 'sekolah_segel_voucher', 'sekolah_sa_ld', 'sekolah_sa_md', 'sekolah_sa_hd', 'sekolah_vf_ld', 'sekolah_vf_md', 'sekolah_vf_hd', 'sekolah_linkaja',
		'kampus_segel_prepaid', 'kampus_segel_voucher', 'kampus_sa_ld', 'kampus_sa_md', 'kampus_sa_hd', 'kampus_vf_ld', 'kampus_vf_md', 'kampus_vf_hd', 'kampus_linkaja',
		'fakultas_segel_prepaid', 'fakultas_segel_voucher', 'fakultas_sa_ld', 'fakultas_sa_md', 'fakultas_sa_hd', 'fakultas_vf_ld', 'fakultas_vf_md', 'fakultas_vf_hd', 'fakultas_linkaja',
		'poi_segel_prepaid', 'poi_segel_voucher', 'poi_sa_ld', 'poi_sa_md', 'poi_sa_hd', 'poi_vf_ld', 'poi_vf_md', 'poi_vf_hd', 'poi_linkaja'
	);

	function build_query_daftar_5()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');

		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							kc.nama_kecamatan AS nama
							, d.*
					FROM
							cc_kecamatan kc
							LEFT JOIN an_dashboard_distribusi_kecamatan d
									ON (kc.id_kecamatan = d.id_kecamatan AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							kc.nama_kecamatan AS nama
							, d.*
					FROM
							cc_kecamatan kc
							INNER JOIN bc_cluster c
									ON (kc.id_cluster = c.id_cluster)
							LEFT JOIN an_dashboard_distribusi_kecamatan d
									ON (kc.id_kecamatan = d.id_kecamatan AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (c.id_branch = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							kc.nama_kecamatan AS nama
							, d.*
					FROM
							cc_kecamatan kc
							LEFT JOIN an_dashboard_distribusi_kecamatan d
									ON (kc.id_kecamatan = d.id_kecamatan AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (kc.id_cluster = "'.$id_divisi.'")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.*
			');
			$this->db->from('
				(
					SELECT
							kc.nama_kecamatan AS nama
							, d.*
					FROM
							cc_kecamatan kc
							INNER JOIN bd_tap t
									ON (kc.id_cluster = t.id_cluster)
							LEFT JOIN an_dashboard_distribusi_kecamatan d
									ON (kc.id_kecamatan = d.id_kecamatan AND d.tahun = "'.$tahun.'" AND d.bulan = "'.$bulan.'")
					WHERE (t.id_tap = "'.$id_divisi.'")
				) xx
			');
		}
	}
}
?>