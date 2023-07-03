<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_promotion_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_list_program()
	{
		$this->db->select('
			id_jenis AS id_program
			, nama_jenis AS nama_program
		');
		$this->db->from('na_promotion_jenis');
		$this->db->where('UPPER(status)', 'AKTIF');

		$query = $this->db->get();

		return $query->result();
	}

	function get_list_minggu($tahun, $bulan)
	{
		$this->db->distinct();
		$this->db->select('minggu');
		$this->db->from('nb_promotion_jenis_weekly');
		$this->db->where('tahun', $tahun);
		$this->db->where('bulan', $bulan);

		$query = $this->db->get();

		return $query->result();
	}

	var $fieldmap_daftar_1 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_order_1 = array(
		null,
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_search_1 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
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
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1)
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2)
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3)
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4)
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5)
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND b.id_branch = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND b.id_branch = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND b.id_branch = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND b.id_branch = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND b.id_branch = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
												INNER JOIN bc_cluster c
														ON (c.id_branch = b.id_branch)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
												INNER JOIN bc_cluster c
														ON (c.id_branch = b.id_branch)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
												INNER JOIN bc_cluster c
														ON (c.id_branch = b.id_branch)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
												INNER JOIN bc_cluster c
														ON (c.id_branch = b.id_branch)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
												INNER JOIN bc_cluster c
														ON (c.id_branch = b.id_branch)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
												INNER JOIN bc_cluster c
														ON (c.id_branch = b.id_branch)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND t.id_tap = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
												INNER JOIN bc_cluster c
														ON (c.id_branch = b.id_branch)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND t.id_tap = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
												INNER JOIN bc_cluster c
														ON (c.id_branch = b.id_branch)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND t.id_tap = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
												INNER JOIN bc_cluster c
														ON (c.id_branch = b.id_branch)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND t.id_tap = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ng_promotion_res_regional p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bb_branch b
														ON (p.id_regional = b.id_regional)
												INNER JOIN bc_cluster c
														ON (c.id_branch = b.id_branch)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND t.id_tap = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
	}

	var $fieldmap_daftar_2 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_order_2 = array(
		null,
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_search_2 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
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
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1)
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2)
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3)
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4)
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5)
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND p.id_branch = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND p.id_branch = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND p.id_branch = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND p.id_branch = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND p.id_branch = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_branch = c.id_branch)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_branch = c.id_branch)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_branch = c.id_branch)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_branch = c.id_branch)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_branch = c.id_branch)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_branch = c.id_branch)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_branch = c.id_branch)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_branch = c.id_branch)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_branch = c.id_branch)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nh_promotion_res_branch p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_branch = c.id_branch)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND c.id_cluster = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
	}

	var $fieldmap_daftar_3 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_order_3 = array(
		null,
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_search_3 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
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
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1)
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2)
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3)
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4)
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5)
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND c.id_branch = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND c.id_branch = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND c.id_branch = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND c.id_branch = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND c.id_branch = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND p.id_cluster = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND p.id_cluster = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND p.id_cluster = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND p.id_cluster = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND p.id_cluster = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_cluster = c.id_cluster)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND t.id_tap = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_cluster = c.id_cluster)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND t.id_tap = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_cluster = c.id_cluster)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND t.id_tap = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_cluster = c.id_cluster)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND t.id_tap = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												ni_promotion_res_cluster p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bc_cluster c
														ON (p.id_cluster = c.id_cluster)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND t.id_tap = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
	}

	var $fieldmap_daftar_4 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_order_4 = array(
		null,
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_search_4 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
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
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1)
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2)
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3)
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4)
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5)
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bd_tap t
														ON (p.id_tap = t.id_tap)
												INNER JOIN bc_cluster c
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND c.id_branch = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bd_tap t
														ON (p.id_tap = t.id_tap)
												INNER JOIN bc_cluster c
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND c.id_branch = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bd_tap t
														ON (p.id_tap = t.id_tap)
												INNER JOIN bc_cluster c
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND c.id_branch = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bd_tap t
														ON (p.id_tap = t.id_tap)
												INNER JOIN bc_cluster c
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND c.id_branch = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bd_tap t
														ON (p.id_tap = t.id_tap)
												INNER JOIN bc_cluster c
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND c.id_branch = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bd_tap t
														ON (p.id_tap = t.id_tap)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND t.id_cluster = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bd_tap t
														ON (p.id_tap = t.id_tap)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND t.id_cluster = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bd_tap t
														ON (p.id_tap = t.id_tap)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND t.id_cluster = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bd_tap t
														ON (p.id_tap = t.id_tap)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND t.id_cluster = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN bd_tap t
														ON (p.id_tap = t.id_tap)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND t.id_cluster = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND p.id_tap = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND p.id_tap = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND p.id_tap = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND p.id_tap = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nj_promotion_res_tap p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND p.id_tap = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
	}

	var $fieldmap_daftar_5 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_order_5 = array(
		null,
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_search_5 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
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
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1)
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2)
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3)
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
											ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4)
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
											ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5)
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND c.id_branch = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND c.id_branch = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND c.id_branch = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND c.id_branch = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND c.id_branch = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND kc.id_cluster = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND kc.id_cluster = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND kc.id_cluster = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND kc.id_cluster = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND kc.id_cluster = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND t.id_tap = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND t.id_tap = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND t.id_tap = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND t.id_tap = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nl_promotion_res_kabupaten p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cb_kabupaten kb
														ON (p.id_kabupaten = kb.id_kabupaten)
												INNER JOIN cc_kecamatan kc
														ON (kc.id_kabupaten = kb.id_kabupaten)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
												INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND t.id_tap = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
	}

	var $fieldmap_daftar_6 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_order_6 = array(
		null,
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);
	var $column_search_6 = array(
		'nama', 'w1', 'w2', 'w3', 'w4', 'w5'
	);

	function build_query_daftar_6()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');

		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1)
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2)
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3)
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
											ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4)
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
											ON (p.id_jenis_weekly = j.id_jenis_weekly)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5)
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND c.id_branch = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND c.id_branch = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND c.id_branch = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND c.id_branch = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND c.id_branch = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND kc.id_cluster = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND kc.id_cluster = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND kc.id_cluster = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND kc.id_cluster = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND kc.id_cluster = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.nama
				, xx.w1
				, xx.w2
				, xx.w3
				, xx.w4
				, xx.w5
			');
			$this->db->from('
				(
					SELECT
							nama_jenis AS nama
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
												 INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 1
												AND t.id_tap = "'.$id_divisi.'")
								) AS w1
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
												 INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 2
												AND t.id_tap = "'.$id_divisi.'")
								) AS w2
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
												 INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 3
												AND t.id_tap = "'.$id_divisi.'")
								) AS w3
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
												 INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 4
												AND t.id_tap = "'.$id_divisi.'")
								) AS w4
							, (
										SELECT
												COALESCE(SUM(p.total), 0)
										FROM
												nm_promotion_res_kecamatan p
												INNER JOIN nb_promotion_jenis_weekly j
														ON (p.id_jenis_weekly = j.id_jenis_weekly)
												INNER JOIN cc_kecamatan kc
														ON (p.id_kecamatan = kc.id_kecamatan)
												INNER JOIN bc_cluster c
														ON (kc.id_cluster = c.id_cluster)
												 INNER JOIN bd_tap t
														ON (t.id_cluster = c.id_cluster)
										WHERE (j.id_jenis = pj.id_jenis
												AND j.tahun = "'.$tahun.'"
												AND j.bulan = "'.$bulan.'"
												AND j.minggu = 5
												AND t.id_tap = "'.$id_divisi.'")
								) AS w5
					FROM
							na_promotion_jenis pj
					WHERE (UPPER(pj.status) = "AKTIF")
				) xx
			');
		}
	}
}
?>