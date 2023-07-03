<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_coverage_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	var $fieldmap_daftar_6 = array('id_sales', 'nama_sales', 'nama_tap', 'nama_cluster', 'status', 'dikunjungi', '(xx.total_pjp - xx.dikunjungi)', 'total_pjp');
	var $column_order_6 = array(null, 'id_sales', 'nama_sales', 'nama_tap', 'nama_cluster', 'status', 'dikunjungi', '(xx.total_pjp - xx.dikunjungi)', 'total_pjp');
	var $column_search_6 = array('id_sales', 'nama_sales', 'nama_tap', 'nama_cluster', 'status', 'dikunjungi', '(xx.total_pjp - xx.dikunjungi)', 'total_pjp');

	function build_query_daftar_6()
	{
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');

		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.id_cluster
				, xx.nama_cluster
				, xx.id_sales
				, xx.nama_sales
				, xx.status
				, xx.total_pjp
				, xx.dikunjungi
				, (xx.total_pjp - xx.dikunjungi) AS tdk_dikunjungi
			');
			$this->db->from('
				(
					SELECT
							s.id_tap
							, t.nama_tap
							, t.id_cluster
							, c.nama_cluster
							, s.id_sales
							, s.nama_sales
							, s.status
							, (
										SELECT
												COUNT(d.id_daftar_pjp)
										FROM
												fe_daftar_pjp d
										WHERE (d.id_sales = s.id_sales
												AND d.tanggal = "'.$tgl.'")
								) AS total_pjp
							, (
										SELECT
												COUNT(h.id_history_pjp)
										FROM
												fb_histroy_pjp h
										WHERE (h.id_sales = s.id_sales
												AND h.tanggal = "'.$tgl.'"
												AND h.jam_clock_in <> "00:00:00")
								) AS dikunjungi
					FROM
							db_sales s
							INNER JOIN bd_tap t
									ON (s.id_tap = t.id_tap)
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (UPPER(s.status) = "AKTIF")
				) xx
			');
			$this->db->where('xx.dikunjungi >', 0);
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.id_cluster
				, xx.nama_cluster
				, xx.id_sales
				, xx.nama_sales
				, xx.status
				, xx.total_pjp
				, xx.dikunjungi
				, (xx.total_pjp - xx.dikunjungi) AS tdk_dikunjungi
			');
			$this->db->from('
				(
					SELECT
							s.id_tap
							, t.nama_tap
							, t.id_cluster
							, c.nama_cluster
							, s.id_sales
							, s.nama_sales
							, s.status
							, (
										SELECT
												COUNT(d.id_daftar_pjp)
										FROM
												fe_daftar_pjp d
										WHERE (d.id_sales = s.id_sales
												AND d.tanggal = "'.$tgl.'")
								) AS total_pjp
							, (
										SELECT
												COUNT(h.id_history_pjp)
										FROM
												fb_histroy_pjp h
										WHERE (h.id_sales = s.id_sales
												AND h.tanggal = "'.$tgl.'"
												AND h.jam_clock_in <> "00:00:00")
								) AS dikunjungi
					FROM
							db_sales s
							INNER JOIN bd_tap t
									ON (s.id_tap = t.id_tap)
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (c.id_branch = "'.$id_divisi.'"
							AND UPPER(s.status) = "AKTIF")
				) xx
			');
			$this->db->where('xx.dikunjungi >', 0);
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.id_cluster
				, xx.nama_cluster
				, xx.id_sales
				, xx.nama_sales
				, xx.status
				, xx.total_pjp
				, xx.dikunjungi
				, (xx.total_pjp - xx.dikunjungi) AS tdk_dikunjungi
			');
			$this->db->from('
				(
					SELECT
							s.id_tap
							, t.nama_tap
							, t.id_cluster
							, c.nama_cluster
							, s.id_sales
							, s.nama_sales
							, s.status
							, (
										SELECT
												COUNT(d.id_daftar_pjp)
										FROM
												fe_daftar_pjp d
										WHERE (d.id_sales = s.id_sales
												AND d.tanggal = "'.$tgl.'")
								) AS total_pjp
							, (
										SELECT
												COUNT(h.id_history_pjp)
										FROM
												fb_histroy_pjp h
										WHERE (h.id_sales = s.id_sales
												AND h.tanggal = "'.$tgl.'"
												AND h.jam_clock_in <> "00:00:00")
								) AS dikunjungi
					FROM
							db_sales s
							INNER JOIN bd_tap t
									ON (s.id_tap = t.id_tap)
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (t.id_cluster = "'.$id_divisi.'"
							AND UPPER(s.status) = "AKTIF")
				) xx
			');
			$this->db->where('xx.dikunjungi >', 0);
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.id_cluster
				, xx.nama_cluster
				, xx.id_sales
				, xx.nama_sales
				, xx.status
				, xx.total_pjp
				, xx.dikunjungi
				, (xx.total_pjp - xx.dikunjungi) AS tdk_dikunjungi
			');
			$this->db->from('
				(
					SELECT
							s.id_tap
							, t.nama_tap
							, t.id_cluster
							, c.nama_cluster
							, s.id_sales
							, s.nama_sales
							, s.status
							, (
										SELECT
												COUNT(d.id_daftar_pjp)
										FROM
												fe_daftar_pjp d
										WHERE (d.id_sales = s.id_sales
												AND d.tanggal = "'.$tgl.'")
								) AS total_pjp
							, (
										SELECT
												COUNT(h.id_history_pjp)
										FROM
												fb_histroy_pjp h
										WHERE (h.id_sales = s.id_sales
												AND h.tanggal = "'.$tgl.'"
												AND h.jam_clock_in <> "00:00:00")
								) AS dikunjungi
					FROM
							db_sales s
							INNER JOIN bd_tap t
									ON (s.id_tap = t.id_tap)
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (s.id_tap = "'.$id_divisi.'"
							AND UPPER(s.status) = "AKTIF")
				) xx
			');
			$this->db->where('xx.dikunjungi >', 0);
		}
	}

	var $fieldmap_daftar_7 = array('id_sales', 'nama_sales', 'nama_tap', 'nama_cluster', 'status', 'dikunjungi', '(xx.total_pjp - xx.dikunjungi)', 'total_pjp');
	var $column_order_7 = array(null, 'id_sales', 'nama_sales', 'nama_tap', 'nama_cluster', 'status', 'dikunjungi', '(xx.total_pjp - xx.dikunjungi)', 'total_pjp');
	var $column_search_7 = array('id_sales', 'nama_sales', 'nama_tap', 'nama_cluster', 'status', 'dikunjungi', '(xx.total_pjp - xx.dikunjungi)', 'total_pjp');

	function build_query_daftar_7()
	{
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');

		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.id_cluster
				, xx.nama_cluster
				, xx.id_sales
				, xx.nama_sales
				, xx.status
				, xx.total_pjp
				, xx.dikunjungi
				, (xx.total_pjp - xx.dikunjungi) AS tdk_dikunjungi
			');
			$this->db->from('
				(
					SELECT
							s.id_tap
							, t.nama_tap
							, t.id_cluster
							, c.nama_cluster
							, s.id_sales
							, s.nama_sales
							, s.status
							, (
										SELECT
												COUNT(d.id_daftar_pjp)
										FROM
												fe_daftar_pjp d
										WHERE (d.id_sales = s.id_sales
												AND d.tanggal = "'.$tgl.'")
								) AS total_pjp
							, (
										SELECT
												COUNT(h.id_history_pjp)
										FROM
												fb_histroy_pjp h
										WHERE (h.id_sales = s.id_sales
												AND h.tanggal = "'.$tgl.'"
												AND h.jam_clock_in <> "00:00:00")
								) AS dikunjungi
					FROM
							db_sales s
							INNER JOIN bd_tap t
									ON (s.id_tap = t.id_tap)
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (UPPER(s.status) = "AKTIF")
				) xx
			');
			$this->db->where('xx.dikunjungi', 0);
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.id_cluster
				, xx.nama_cluster
				, xx.id_sales
				, xx.nama_sales
				, xx.status
				, xx.total_pjp
				, xx.dikunjungi
				, (xx.total_pjp - xx.dikunjungi) AS tdk_dikunjungi
			');
			$this->db->from('
				(
					SELECT
							s.id_tap
							, t.nama_tap
							, t.id_cluster
							, c.nama_cluster
							, s.id_sales
							, s.nama_sales
							, s.status
							, (
										SELECT
												COUNT(d.id_daftar_pjp)
										FROM
												fe_daftar_pjp d
										WHERE (d.id_sales = s.id_sales
												AND d.tanggal = "'.$tgl.'")
								) AS total_pjp
							, (
										SELECT
												COUNT(h.id_history_pjp)
										FROM
												fb_histroy_pjp h
										WHERE (h.id_sales = s.id_sales
												AND h.tanggal = "'.$tgl.'"
												AND h.jam_clock_in <> "00:00:00")
								) AS dikunjungi
					FROM
							db_sales s
							INNER JOIN bd_tap t
									ON (s.id_tap = t.id_tap)
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (c.id_branch = "'.$id_divisi.'"
							AND UPPER(s.status) = "AKTIF")
				) xx
			');
			$this->db->where('xx.dikunjungi', 0);
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.id_cluster
				, xx.nama_cluster
				, xx.id_sales
				, xx.nama_sales
				, xx.status
				, xx.total_pjp
				, xx.dikunjungi
				, (xx.total_pjp - xx.dikunjungi) AS tdk_dikunjungi
			');
			$this->db->from('
				(
					SELECT
							s.id_tap
							, t.nama_tap
							, t.id_cluster
							, c.nama_cluster
							, s.id_sales
							, s.nama_sales
							, s.status
							, (
										SELECT
												COUNT(d.id_daftar_pjp)
										FROM
												fe_daftar_pjp d
										WHERE (d.id_sales = s.id_sales
												AND d.tanggal = "'.$tgl.'")
								) AS total_pjp
							, (
										SELECT
												COUNT(h.id_history_pjp)
										FROM
												fb_histroy_pjp h
										WHERE (h.id_sales = s.id_sales
												AND h.tanggal = "'.$tgl.'"
												AND h.jam_clock_in <> "00:00:00")
								) AS dikunjungi
					FROM
							db_sales s
							INNER JOIN bd_tap t
									ON (s.id_tap = t.id_tap)
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (t.id_cluster = "'.$id_divisi.'"
							AND UPPER(s.status) = "AKTIF")
				) xx
			');
			$this->db->where('xx.dikunjungi', 0);
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.id_cluster
				, xx.nama_cluster
				, xx.id_sales
				, xx.nama_sales
				, xx.status
				, xx.total_pjp
				, xx.dikunjungi
				, (xx.total_pjp - xx.dikunjungi) AS tdk_dikunjungi
			');
			$this->db->from('
				(
					SELECT
							s.id_tap
							, t.nama_tap
							, t.id_cluster
							, c.nama_cluster
							, s.id_sales
							, s.nama_sales
							, s.status
							, (
										SELECT
												COUNT(d.id_daftar_pjp)
										FROM
												fe_daftar_pjp d
										WHERE (d.id_sales = s.id_sales
												AND d.tanggal = "'.$tgl.'")
								) AS total_pjp
							, (
										SELECT
												COUNT(h.id_history_pjp)
										FROM
												fb_histroy_pjp h
										WHERE (h.id_sales = s.id_sales
												AND h.tanggal = "'.$tgl.'"
												AND h.jam_clock_in <> "00:00:00")
								) AS dikunjungi
					FROM
							db_sales s
							INNER JOIN bd_tap t
									ON (s.id_tap = t.id_tap)
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (s.id_tap = "'.$id_divisi.'"
							AND UPPER(s.status) = "AKTIF")
				) xx
			');
			$this->db->where('xx.dikunjungi', 0);
		}
	}

	var $fieldmap_daftar_1 = array(
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);
	var $column_order_1 = array(
		null,
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);
	var $column_search_1 = array(
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);

	function build_query_daftar_1()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$tahun = $this->input->post('tahun') ? (int) $this->input->post('tahun') : (int) date('Y');
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : (int) date('m');

		if (strlen($bulan) == 1)
		{
			$bulan = '0'.$bulan;
		}
		else
		{
			$bulan = $bulan;
		}

		$this->db->select('xx.*');

		if ($id_level == 1) // Regional
		{
			$this->db->from('
				(
						SELECT
								d.id_branch AS id
								, b.nama_branch AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ae_dashboard_coverage_branch d
								INNER JOIN bb_branch b
										ON (d.id_branch = b.id_branch)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'")
						GROUP BY d.id_branch, b.nama_branch
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->from('
				(
						SELECT
								d.id_branch AS id
								, b.nama_branch AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ae_dashboard_coverage_branch d
								INNER JOIN bb_branch b
										ON (d.id_branch = b.id_branch)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND d.id_branch = "'.$id_divisi.'")
						GROUP BY d.id_branch, b.nama_branch
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->from('
				(
						SELECT
								d.id_branch AS id
								, b.nama_branch AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ae_dashboard_coverage_branch d
								INNER JOIN bb_branch b
										ON (d.id_branch = b.id_branch)
								INNER JOIN bc_cluster c
										ON (c.id_branch = b.id_branch)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND c.id_cluster = "'.$id_divisi.'")
						GROUP BY d.id_branch, b.nama_branch
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->from('
				(
						SELECT
								d.id_branch AS id
								, b.nama_branch AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ae_dashboard_coverage_branch d
								INNER JOIN bb_branch b
										ON (d.id_branch = b.id_branch)
								INNER JOIN bc_cluster c
										ON (c.id_branch = b.id_branch)
								INNER JOIN bd_tap t
										ON (t.id_cluster = c.id_cluster)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND t.id_tap = "'.$id_divisi.'")
						GROUP BY d.id_branch, b.nama_branch
				) xx
			');
		}
	}

	var $fieldmap_daftar_2 = array(
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);
	var $column_order_2 = array(
		null,
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);
	var $column_search_2 = array(
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);

	function build_query_daftar_2()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$tahun = $this->input->post('tahun') ? (int) $this->input->post('tahun') : (int) date('Y');
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : (int) date('m');

		if (strlen($bulan) == 1)
		{
			$bulan = '0'.$bulan;
		}
		else
		{
			$bulan = $bulan;
		}

		$this->db->select('xx.*');

		if ($id_level == 1) // Regional
		{
			$this->db->from('
				(
						SELECT
								d.id_cluster AS id
								, c.nama_cluster AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								af_dashboard_coverage_cluster d
								INNER JOIN bc_cluster c
										ON (d.id_cluster = c.id_cluster)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'")
						GROUP BY d.id_cluster, c.nama_cluster
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->from('
				(
						SELECT
								d.id_cluster AS id
								, c.nama_cluster AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								af_dashboard_coverage_cluster d
								INNER JOIN bc_cluster c
										ON (d.id_cluster = c.id_cluster)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND c.id_branch = "'.$id_divisi.'")
						GROUP BY d.id_cluster, c.nama_cluster
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->from('
				(
						SELECT
								d.id_cluster AS id
								, c.nama_cluster AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								af_dashboard_coverage_cluster d
								INNER JOIN bc_cluster c
										ON (d.id_cluster = c.id_cluster)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND d.id_cluster = "'.$id_divisi.'")
						GROUP BY d.id_cluster, c.nama_cluster
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->from('
				(
						SELECT
								d.id_cluster AS id
								, c.nama_cluster AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								af_dashboard_coverage_cluster d
								INNER JOIN bc_cluster c
										ON (d.id_cluster = c.id_cluster)
								INNER JOIN bd_tap t
										ON (t.id_cluster = c.id_cluster)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND t.id_tap = "'.$id_divisi.'")
						GROUP BY d.id_cluster, c.nama_cluster
				) xx
			');
		}
	}

	var $fieldmap_daftar_3 = array(
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);
	var $column_order_3 = array(
		null,
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);
	var $column_search_3 = array(
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);

	function build_query_daftar_3()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$tahun = $this->input->post('tahun') ? (int) $this->input->post('tahun') : (int) date('Y');
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : (int) date('m');

		if (strlen($bulan) == 1)
		{
			$bulan = '0'.$bulan;
		}
		else
		{
			$bulan = $bulan;
		}

		$this->db->select('xx.*');

		if ($id_level == 1) // Regional
		{
			$this->db->from('
				(
						SELECT
								d.id_tap AS id
								, t.nama_tap AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ag_dashboard_coverage_tap d
								INNER JOIN bd_tap t
										ON (d.id_tap = t.id_tap)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'")
						GROUP BY d.id_tap, t.nama_tap
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->from('
				(
						SELECT
								d.id_tap AS id
								, t.nama_tap AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ag_dashboard_coverage_tap d
								INNER JOIN bd_tap t
										ON (d.id_tap = t.id_tap)
								INNER JOIN bc_cluster c
										ON (t.id_cluster = c.id_cluster)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND c.id_branch = "'.$id_divisi.'")
						GROUP BY d.id_tap, t.nama_tap
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->from('
				(
						SELECT
								d.id_tap AS id
								, t.nama_tap AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ag_dashboard_coverage_tap d
								INNER JOIN bd_tap t
										ON (d.id_tap = t.id_tap)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND t.id_cluster = "'.$id_divisi.'")
						GROUP BY d.id_tap, t.nama_tap
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->from('
				(
						SELECT
								d.id_tap AS id
								, t.nama_tap AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ag_dashboard_coverage_tap d
								INNER JOIN bd_tap t
										ON (d.id_tap = t.id_tap)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND d.id_tap = "'.$id_divisi.'")
						GROUP BY d.id_tap, t.nama_tap
				) xx
			');
		}
	}

	var $fieldmap_daftar_4 = array(
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);
	var $column_order_4 = array(
		null,
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);
	var $column_search_4 = array(
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);

	function build_query_daftar_4()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$tahun = $this->input->post('tahun') ? (int) $this->input->post('tahun') : (int) date('Y');
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : (int) date('m');

		if (strlen($bulan) == 1)
		{
			$bulan = '0'.$bulan;
		}
		else
		{
			$bulan = $bulan;
		}

		$this->db->select('xx.*');

		if ($id_level == 1) // Regional
		{
			$this->db->from('
				(
						SELECT
								d.id_kabupaten AS id
								, kb.nama_kabupaten AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ah_dashboard_coverage_kabupaten d
								INNER JOIN cb_kabupaten kb
										ON (d.id_kabupaten = kb.id_kabupaten)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'")
						GROUP BY d.id_kabupaten, kb.nama_kabupaten
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->from('
				(
						SELECT
								d.id_kabupaten AS id
								, kb.nama_kabupaten AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ah_dashboard_coverage_kabupaten d
								INNER JOIN cb_kabupaten kb
										ON (d.id_kabupaten = kb.id_kabupaten)
								INNER JOIN cc_kecamatan kc
										ON (kc.id_kabupaten = kb.id_kabupaten)
							INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND c.id_branch = "'.$id_divisi.'")
						GROUP BY d.id_kabupaten, kb.nama_kabupaten
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->from('
				(
						SELECT
								d.id_kabupaten AS id
								, kb.nama_kabupaten AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ah_dashboard_coverage_kabupaten d
								INNER JOIN cb_kabupaten kb
										ON (d.id_kabupaten = kb.id_kabupaten)
								INNER JOIN cc_kecamatan kc
										ON (kc.id_kabupaten = kb.id_kabupaten)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND kc.id_cluster = "'.$id_divisi.'")
						GROUP BY d.id_kabupaten, kb.nama_kabupaten
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->from('
				(
						SELECT
								d.id_kabupaten AS id
								, kb.nama_kabupaten AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ah_dashboard_coverage_kabupaten d
								INNER JOIN cb_kabupaten kb
										ON (d.id_kabupaten = kb.id_kabupaten)
								INNER JOIN cc_kecamatan kc
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bd_tap t
										ON (t.id_cluster = c.id_cluster)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND t.id_tap = "'.$id_divisi.'")
						GROUP BY d.id_kabupaten, kb.nama_kabupaten
				) xx
			');
		}
	}

	var $fieldmap_daftar_5 = array(
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);
	var $column_order_5 = array(
		null,
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);
	var $column_search_5 = array(
		'nama',
		'outlet_open', 'outlet_close', 'outlet_total', 'outlet_target', 'outlet_coverage',
		'sekolah_open', 'sekolah_close', 'sekolah_total', 'sekolah_target', 'sekolah_coverage',
		'kampus_open', 'kampus_close', 'kampus_total', 'kampus_target', 'kampus_coverage',
		'fakultas_open', 'fakultas_close', 'fakultas_total', 'fakultas_target', 'fakultas_coverage',
		'poi_open', 'poi_close', 'poi_total', 'poi_target', 'poi_coverage'
	);

	function build_query_daftar_5()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$tahun = $this->input->post('tahun') ? (int) $this->input->post('tahun') : (int) date('Y');
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : (int) date('m');

		if (strlen($bulan) == 1)
		{
			$bulan = '0'.$bulan;
		}
		else
		{
			$bulan = $bulan;
		}

		$this->db->select('xx.*');

		if ($id_level == 1) // Regional
		{
			$this->db->from('
				(
						SELECT
								d.id_kecamatan AS id
								, kc.nama_kecamatan AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ai_dashboard_coverage_kecamatan d
								INNER JOIN cc_kecamatan kc
										ON (d.id_kecamatan = kc.id_kecamatan)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'")
						GROUP BY d.id_kecamatan, kc.nama_kecamatan
				) xx
			');
		}
		elseif ($id_level == 2) // Branch
		{
			$this->db->from('
				(
						SELECT
								d.id_kecamatan AS id
								, kc.nama_kecamatan AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ai_dashboard_coverage_kecamatan d
								INNER JOIN cc_kecamatan kc
										ON (d.id_kecamatan = kc.id_kecamatan)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND c.id_branch = "'.$id_divisi.'")
						GROUP BY d.id_kecamatan, kc.nama_kecamatan
				) xx
			');
		}
		elseif ($id_level == 3) // Cluster
		{
			$this->db->from('
				(
						SELECT
								d.id_kecamatan AS id
								, kc.nama_kecamatan AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ai_dashboard_coverage_kecamatan d
								INNER JOIN cc_kecamatan kc
										ON (d.id_kecamatan = kc.id_kecamatan)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND kc.id_cluster = "'.$id_divisi.'")
						GROUP BY d.id_kecamatan, kc.nama_kecamatan
				) xx
			');
		}
		elseif ($id_level == 4) // TAP
		{
			$this->db->from('
				(
						SELECT
								d.id_kecamatan AS id
								, kc.nama_kecamatan AS nama
								, COUNT(d.id) AS total
								, SUM(d.outlet_open) AS outlet_open
								, SUM(d.outlet_close) AS outlet_close
								, SUM(d.outlet_total) AS outlet_total
								, SUM(d.outlet_new) AS outlet_new
								, SUM(d.outlet_device) AS outlet_device
								, SUM(d.outlet_reguler) AS outlet_reguler
								, SUM(d.outlet_pareto) AS outlet_pareto
								, SUM(d.outlet_pjp) AS outlet_pjp
								, SUM(d.outlet_clockin) AS outlet_clockin
								, SUM(d.outlet_target) AS outlet_target
								, ROUND(SUM(d.outlet_coverage) / COUNT(d.id), 2) AS outlet_coverage
								, SUM(d.sekolah_open) AS sekolah_open
								, SUM(d.sekolah_close) AS sekolah_close
								, SUM(d.sekolah_total) AS sekolah_total
								, SUM(d.sekolah_new) AS sekolah_new
								, SUM(d.sekolah_pjp) AS sekolah_pjp
								, SUM(d.sekolah_clockin) AS sekolah_clockin
								, SUM(d.sekolah_target) AS sekolah_target
								, ROUND(SUM(d.sekolah_coverage) / COUNT(d.id), 2) AS sekolah_coverage
								, SUM(d.kampus_open) AS kampus_open
								, SUM(d.kampus_close) AS kampus_close
								, SUM(d.kampus_total) AS kampus_total
								, SUM(d.kampus_new) AS kampus_new
								, SUM(d.kampus_pjp) AS kampus_pjp
								, SUM(d.kampus_clockin) AS kampus_clockin
								, SUM(d.kampus_target) AS kampus_target
								, ROUND(SUM(d.kampus_coverage) / COUNT(d.id), 2) AS kampus_coverage
								, SUM(d.fakultas_open) AS fakultas_open
								, SUM(d.fakultas_close) AS fakultas_close
								, SUM(d.fakultas_total) AS fakultas_total
								, SUM(d.fakultas_new) AS fakultas_new
								, SUM(d.fakultas_pjp) AS fakultas_pjp
								, SUM(d.fakultas_clockin) AS fakultas_clockin
								, SUM(d.fakultas_target) AS fakultas_target
								, ROUND(SUM(d.fakultas_coverage) / COUNT(d.id), 2) AS fakultas_coverage
								, SUM(d.poi_open) AS poi_open
								, SUM(d.poi_close) AS poi_close
								, SUM(d.poi_total) AS poi_total
								, SUM(d.poi_new) AS poi_new
								, SUM(d.poi_pjp) AS poi_pjp
								, SUM(d.poi_clockin) AS poi_clockin
								, SUM(d.poi_target) AS poi_target
								, ROUND(SUM(d.poi_coverage) / COUNT(d.id), 2) AS poi_coverage
						FROM
								ai_dashboard_coverage_kecamatan d
								INNER JOIN cc_kecamatan kc
										ON (d.id_kecamatan = kc.id_kecamatan)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bd_tap t
										ON (t.id_cluster = c.id_cluster)
						WHERE (CONCAT(d.tahun, IF(LENGTH(d.bulan) = 1, CONCAT("0", d.bulan), d.bulan)) <= "'.$tahun.$bulan.'"
								AND t.id_tap = "'.$id_divisi.'")
						GROUP BY d.id_kecamatan, kc.nama_kecamatan
				) xx
			');
		}
	}

	function get_data_sales($id=NULL)
	{
		$this->db->select('*');
		$this->db->from('db_sales');
		$this->db->where('id_sales', $id);

		$result = $this->db->get()->row_array();

    return $result;
	}

	var $fieldmap_daftar_8 = array('kode_lokasi', 'nama_lokasi', 'status', 'total_perdana', 'total_voucher');
	var $column_order_8 = array(null, 'kode_lokasi', 'nama_lokasi', 'status', 'total_perdana', 'total_voucher');
	var $column_search_8 = array('kode_lokasi', 'nama_lokasi', 'status', 'total_perdana', 'total_voucher');

	function build_query_daftar_8()
	{
		$id_jenis_sales = $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : 0;
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : '';

		if ($id_jenis_sales == 'SDS') // Sekolah, Kampus, Fakultas, POI
		{
			$this->db->select('
				xx.id_lokasi
				, xx.kode_lokasi
				, xx.nama_lokasi
				, xx.status
				, xx.jenis_lokasi
				, xx.total_perdana
				, xx.total_voucher
			');
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id_lokasi
							, l.no_npsn AS kode_lokasi
							, l.nama_sekolah AS nama_lokasi
							, d.status
							, "SEK" AS jenis_lokasi
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jc_penjualan xpj
												INNER JOIN jd_penjualan_detail xpjd
														ON (xpj.no_nota = xpjd.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_lokasi = d.id_tempat
												AND UPPER(xpj.id_jenis_lokasi) = d.id_jenis_lokasi
												AND xpj.id_sales = d.id_sales
												AND xpj.tgl_transaksi = d.tanggal
												AND xp.id_jenis_produk IN ("SGPREPAID", "SGOTA", "SGVIN", "SGVGS", "SGVGG", "SGVGP"))
							) AS total_perdana
						, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jc_penjualan xpj
												INNER JOIN jd_penjualan_detail xpjd
														ON (xpj.no_nota = xpjd.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_lokasi = d.id_tempat
												AND UPPER(xpj.id_jenis_lokasi) = d.id_jenis_lokasi
												AND xpj.id_sales = d.id_sales
												AND xpj.tgl_transaksi = d.tanggal
												AND xp.id_jenis_produk IN ("INSAC", "INVIN", "INVGA"))
							) AS total_voucher
					FROM
							fb_histroy_pjp d
							INNER JOIN ec_sekolah l
									ON (d.id_tempat = l.id_sekolah)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "SEK")

					UNION ALL

					SELECT
							d.id_tempat AS id_lokasi
							, l.no_npsn AS kode_lokasi
							, l.nama_universitas AS nama_lokasi
							, d.status
							, "KAM" AS jenis_lokasi
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jc_penjualan xpj
												INNER JOIN jd_penjualan_detail xpjd
														ON (xpj.no_nota = xpjd.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_lokasi = d.id_tempat
												AND UPPER(xpj.id_jenis_lokasi) = d.id_jenis_lokasi
												AND xpj.id_sales = d.id_sales
												AND xpj.tgl_transaksi = d.tanggal
												AND xp.id_jenis_produk IN ("SGPREPAID", "SGOTA", "SGVIN", "SGVGS", "SGVGG", "SGVGP"))
							) AS total_perdana
						, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jc_penjualan xpj
												INNER JOIN jd_penjualan_detail xpjd
														ON (xpj.no_nota = xpjd.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_lokasi = d.id_tempat
												AND UPPER(xpj.id_jenis_lokasi) = d.id_jenis_lokasi
												AND xpj.id_sales = d.id_sales
												AND xpj.tgl_transaksi = d.tanggal
												AND xp.id_jenis_produk IN ("INSAC", "INVIN", "INVGA"))
							) AS total_voucher
					FROM
							fb_histroy_pjp d
							INNER JOIN ed_kampus l
									ON (d.id_tempat = l.id_universitas)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "KAM")

					UNION ALL

					SELECT
							d.id_tempat AS id_lokasi
							, "" AS kode_lokasi
							, l.nama_fakultas AS nama_lokasi
							, d.status
							, "FAK" AS jenis_lokasi
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jc_penjualan xpj
												INNER JOIN jd_penjualan_detail xpjd
														ON (xpj.no_nota = xpjd.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_lokasi = d.id_tempat
												AND UPPER(xpj.id_jenis_lokasi) = d.id_jenis_lokasi
												AND xpj.id_sales = d.id_sales
												AND xpj.tgl_transaksi = d.tanggal
												AND xp.id_jenis_produk IN ("SGPREPAID", "SGOTA", "SGVIN", "SGVGS", "SGVGG", "SGVGP"))
							) AS total_perdana
						, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jc_penjualan xpj
												INNER JOIN jd_penjualan_detail xpjd
														ON (xpj.no_nota = xpjd.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_lokasi = d.id_tempat
												AND UPPER(xpj.id_jenis_lokasi) = d.id_jenis_lokasi
												AND xpj.id_sales = d.id_sales
												AND xpj.tgl_transaksi = d.tanggal
												AND xp.id_jenis_produk IN ("INSAC", "INVIN", "INVGA"))
							) AS total_voucher
					FROM
							fb_histroy_pjp d
							INNER JOIN ee_fakultas l
									ON (d.id_tempat = l.id_fakultas)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "FAK")

					UNION ALL

					SELECT
							d.id_tempat AS id_lokasi
							, "" AS kode_lokasi
							, l.nama_poi AS nama_lokasi
							, d.status
							, "POI" AS jenis_lokasi
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jc_penjualan xpj
												INNER JOIN jd_penjualan_detail xpjd
														ON (xpj.no_nota = xpjd.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_lokasi = d.id_tempat
												AND UPPER(xpj.id_jenis_lokasi) = d.id_jenis_lokasi
												AND xpj.id_sales = d.id_sales
												AND xpj.tgl_transaksi = d.tanggal
												AND xp.id_jenis_produk IN ("SGPREPAID", "SGOTA", "SGVIN", "SGVGS", "SGVGG", "SGVGP"))
							) AS total_perdana
						, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jc_penjualan xpj
												INNER JOIN jd_penjualan_detail xpjd
														ON (xpj.no_nota = xpjd.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_lokasi = d.id_tempat
												AND UPPER(xpj.id_jenis_lokasi) = d.id_jenis_lokasi
												AND xpj.id_sales = d.id_sales
												AND xpj.tgl_transaksi = d.tanggal
												AND xp.id_jenis_produk IN ("INSAC", "INVIN", "INVGA"))
							) AS total_voucher
					FROM
							fb_histroy_pjp d
							INNER JOIN ef_poi l
									ON (d.id_tempat = l.id_poi)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "POI")
				) xx
			');
		}
		else // Outlet
		{
			$this->db->select('
				xx.id_lokasi
				, xx.kode_lokasi
				, xx.nama_lokasi
				, xx.status
				, xx.jenis_lokasi
				, xx.total_perdana
				, xx.total_voucher
			');
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id_lokasi
							, l.id_digipos AS kode_lokasi
							, l.nama_outlet AS nama_lokasi
							, d.status
							, "OUT" AS jenis_lokasi
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jc_penjualan xpj
												INNER JOIN jd_penjualan_detail xpjd
														ON (xpj.no_nota = xpjd.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_lokasi = d.id_tempat
												AND UPPER(xpj.id_jenis_lokasi) = d.id_jenis_lokasi
												AND xpj.id_sales = d.id_sales
												AND xpj.tgl_transaksi = d.tanggal
												AND xp.id_jenis_produk IN ("SGPREPAID", "SGOTA", "SGVIN", "SGVGS", "SGVGG", "SGVGP"))
							) AS total_perdana
						, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jc_penjualan xpj
												INNER JOIN jd_penjualan_detail xpjd
														ON (xpj.no_nota = xpjd.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_lokasi = d.id_tempat
												AND UPPER(xpj.id_jenis_lokasi) = d.id_jenis_lokasi
												AND xpj.id_sales = d.id_sales
												AND xpj.tgl_transaksi = d.tanggal
												AND xp.id_jenis_produk IN ("INSAC", "INVIN", "INVGA"))
							) AS total_voucher
					FROM
							fb_histroy_pjp d
							INNER JOIN eb_outlet l
									ON (d.id_tempat = l.id_outlet)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "OUT")
				) xx
			');
		}
	}

	function get_list_distribusi($tgl, $sales, $jenis_lokasi, $lokasi, $jenis_produk)
	{
		$this->db->select('pjd.serial_number');
    $this->db->from('jc_penjualan pj');
    $this->db->join('jd_penjualan_detail pjd', 'pj.no_nota = pjd.no_nota');
    $this->db->join('gb_produk p', 'pjd.id_produk = p.id_produk');
		$this->db->where('pj.tgl_transaksi', $tgl);
		$this->db->where('pj.id_sales', $sales);
		$this->db->where('UPPER(pj.id_jenis_lokasi)', $jenis_lokasi);
		$this->db->where('pj.id_lokasi', $lokasi);

		if ($jenis_produk == 'voucher') { $this->db->where_in('p.id_jenis_produk', array("INSAC", "INVIN", "INVGA")); }
		if ($jenis_produk == 'perdana') { $this->db->where_in('p.id_jenis_produk', array("SGPREPAID", "SGOTA", "SGVIN", "SGVGS", "SGVGG", "SGVGP")); }

		$query = $this->db->get();

		return $query->result();
	}

	var $fieldmap_daftar_9 = array(
		'kode_lokasi', 'nama_lokasi', 'status',
		'total_perdana', 'total_voucher_fisik', 'total_spanduk', 'total_poster', 'total_papan_nama', 'total_backdrop'
	);
	var $column_order_9 = array(null,
		'kode_lokasi', 'nama_lokasi', 'status',
		'total_perdana', 'total_voucher_fisik', 'total_spanduk', 'total_poster', 'total_papan_nama', 'total_backdrop'
	);
	var $column_search_9 = array(
		'kode_lokasi', 'nama_lokasi', 'status',
		'total_perdana', 'total_voucher_fisik', 'total_spanduk', 'total_poster', 'total_papan_nama', 'total_backdrop'
	);

	function build_query_daftar_9()
	{
		$id_jenis_sales = $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : 0;
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : '';

		if ($id_jenis_sales == 'SDS') // Sekolah, Kampus, Fakultas, POI
		{
			$this->db->select('
				xx.id_lokasi
				, xx.kode_lokasi
				, xx.nama_lokasi
				, xx.status
				, xx.jenis_lokasi
				, xx.total_perdana
				, xx.total_voucher_fisik
				, xx.total_spanduk
				, xx.total_poster
				, xx.total_papan_nama
				, xx.total_backdrop
			');
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id_lokasi
							, l.no_npsn AS kode_lokasi
							, l.nama_sekolah AS nama_lokasi
							, d.status
							, "SEK" AS jenis_lokasi
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PERDANA"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PERDANA"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_perdana
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "VOUCHER_FISIK"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "VOUCHER_FISIK"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_voucher_fisik
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "SPANDUK"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "SPANDUK"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_spanduk
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "POSTER"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "POSTER"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_poster
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PAPAN_NAMA"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PAPAN_NAMA"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_papan_nama
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "BACKDROP"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mc_merchandising_sekolah xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_sekolah = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "BACKDROP"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_backdrop
					FROM
							fb_histroy_pjp d
							INNER JOIN ec_sekolah l
									ON (d.id_tempat = l.id_sekolah)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "SEK")

					UNION ALL

					SELECT
							d.id_tempat AS id_lokasi
							, l.no_npsn AS kode_lokasi
							, l.nama_universitas AS nama_lokasi
							, d.status
							, "KAM" AS jenis_lokasi
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PERDANA"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PERDANA"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_perdana
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "VOUCHER_FISIK"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "VOUCHER_FISIK"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_voucher_fisik
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "SPANDUK"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "SPANDUK"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_spanduk
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "POSTER"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "POSTER"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_poster
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PAPAN_NAMA"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PAPAN_NAMA"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_papan_nama
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "BACKDROP"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													md_merchandising_kampus xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_universitas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "BACKDROP"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_backdrop
					FROM
							fb_histroy_pjp d
							INNER JOIN ed_kampus l
									ON (d.id_tempat = l.id_universitas)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "KAM")

					UNION ALL

					SELECT
							d.id_tempat AS id_lokasi
							, "" AS kode_lokasi
							, l.nama_fakultas AS nama_lokasi
							, d.status
							, "FAK" AS jenis_lokasi
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PERDANA"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PERDANA"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_perdana
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "VOUCHER_FISIK"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "VOUCHER_FISIK"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_voucher_fisik
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "SPANDUK"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "SPANDUK"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_spanduk
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "POSTER"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "POSTER"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_poster
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PAPAN_NAMA"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PAPAN_NAMA"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_papan_nama
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "BACKDROP"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													me_merchandising_fakultas xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_fakultas = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "BACKDROP"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_backdrop
					FROM
							fb_histroy_pjp d
							INNER JOIN ee_fakultas l
									ON (d.id_tempat = l.id_fakultas)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "FAK")

					UNION ALL

					SELECT
							d.id_tempat AS id_lokasi
							, "" AS kode_lokasi
							, l.nama_poi AS nama_lokasi
							, d.status
							, "POI" AS jenis_lokasi
							, 0 AS total_perdana
							, 0 AS total_voucher_fisik
							, 0 AS total_spanduk
							, 0 AS total_poster
							, 0 AS total_papan_nama
							, 0 AS total_backdrop
					FROM
							fb_histroy_pjp d
							INNER JOIN ef_poi l
									ON (d.id_tempat = l.id_poi)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "POI")
				) xx
			');
		}
		else // Outlet
		{
			$this->db->select('
				xx.id_lokasi
				, xx.kode_lokasi
				, xx.nama_lokasi
				, xx.status
				, xx.jenis_lokasi
				, xx.total_perdana
				, xx.total_voucher_fisik
				, xx.total_spanduk
				, xx.total_poster
				, xx.total_papan_nama
				, xx.total_backdrop
			');
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id_lokasi
							, l.id_digipos AS kode_lokasi
							, l.nama_outlet AS nama_lokasi
							, d.status
							, "OUT" AS jenis_lokasi
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PERDANA"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PERDANA"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_perdana
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "VOUCHER_FISIK"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "VOUCHER_FISIK"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_voucher_fisik
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "SPANDUK"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "SPANDUK"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_spanduk
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "POSTER"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "POSTER"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_poster
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PAPAN_NAMA"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "PAPAN_NAMA"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_papan_nama
							, (
									ROUND((((
											SELECT
													COALESCE(SUM(xm.telkomsel), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "BACKDROP"
													AND xm.created_by = d.id_sales)
									) /
									(
											SELECT
													COALESCE(SUM(xm.total), 0)
											FROM
													mb_merchandising_outlet xm
											WHERE (xm.tgl = d.tanggal
													AND xm.id_outlet = d.id_tempat
													AND UPPER(xm.id_jenis_share) = "BACKDROP"
													AND xm.created_by = d.id_sales)
									)) * 100), 2)
								) AS total_backdrop
					FROM
							fb_histroy_pjp d
							INNER JOIN eb_outlet l
									ON (d.id_tempat = l.id_outlet)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "OUT")
				) xx
			');
		}
	}

	function get_data_merchandising_trans($tgl, $sales, $jenis_lokasi, $lokasi, $jenis_share)
	{
		if ($jenis_lokasi == 'OUT')
		{
			$this->db->select('
				m.id_merchandising
				, m.tgl
				, "OUT" AS jenis_lokasi
				, l.id_digipos AS kode_lokasi
				, l.nama_outlet AS nama_lokasi
				, js.nama_jenis_share AS jenis_share
				, s.id_jenis_sales AS jenis_sales
				, s.nama_sales
				, m.telkomsel
				, m.isat
				, m.xl
				, m.tri
				, m.smartfren
				, m.axis
				, m.other
				, m.total
				, ROUND(((m.telkomsel / m.total) * 100), 2) AS persen_telkomsel
				, ROUND(((m.isat / m.total) * 100), 2) AS persen_isat
				, ROUND(((m.xl / m.total) * 100), 2) AS persen_xl
				, ROUND(((m.tri / m.total) * 100), 2) AS persen_tri
				, ROUND(((m.smartfren / m.total) * 100), 2) AS persen_smartfren
				, ROUND(((m.axis / m.total) * 100), 2) AS persen_axis
				, ROUND(((m.other / m.total) * 100), 2) AS persen_other
				, ROUND(((m.total / m.total) * 100), 2) AS persen_total
			');
			$this->db->from('mb_merchandising_outlet m');
			$this->db->join('ma_merchandisng_jenis_share js', 'm.id_jenis_share = js.id_jenis_share');
			$this->db->join('eb_outlet l', 'm.id_outlet = l.id_outlet');
			$this->db->join('db_sales s', 'm.created_by = s.id_sales');
			$this->db->where('m.tgl', $tgl);
			$this->db->where('m.id_outlet', $lokasi);
			$this->db->where('m.id_jenis_share', $jenis_share);
			$this->db->where('m.created_by', $sales);
		}
		else if ($jenis_lokasi == 'SEK')
		{
			$this->db->select('
				m.id_merchandising
				, m.tgl
				, "SEK" AS jenis_lokasi
				, l.no_npsn AS kode_lokasi
				, l.nama_sekolah AS nama_lokasi
				, js.nama_jenis_share AS jenis_share
				, s.id_jenis_sales AS jenis_sales
				, s.nama_sales
				, m.telkomsel
				, m.isat
				, m.xl
				, m.tri
				, m.smartfren
				, m.axis
				, m.other
				, m.total
				, ROUND(((m.telkomsel / m.total) * 100), 2) AS persen_telkomsel
				, ROUND(((m.isat / m.total) * 100), 2) AS persen_isat
				, ROUND(((m.xl / m.total) * 100), 2) AS persen_xl
				, ROUND(((m.tri / m.total) * 100), 2) AS persen_tri
				, ROUND(((m.smartfren / m.total) * 100), 2) AS persen_smartfren
				, ROUND(((m.axis / m.total) * 100), 2) AS persen_axis
				, ROUND(((m.other / m.total) * 100), 2) AS persen_other
				, ROUND(((m.total / m.total) * 100), 2) AS persen_total
			');
			$this->db->from('mc_merchandising_sekolah m');
			$this->db->join('ma_merchandisng_jenis_share js', 'm.id_jenis_share = js.id_jenis_share');
			$this->db->join('ec_sekolah l', 'm.id_sekolah = l.id_sekolah');
			$this->db->join('db_sales s', 'm.created_by = s.id_sales');
			$this->db->where('m.tgl', $tgl);
			$this->db->where('m.id_sekolah', $lokasi);
			$this->db->where('m.id_jenis_share', $jenis_share);
			$this->db->where('m.created_by', $sales);
		}
		else if ($jenis_lokasi == 'KAM')
		{
			$this->db->select('
				m.id_merchandising
				, m.tgl
				, "KAM" AS jenis_lokasi
				, l.no_npsn AS kode_lokasi
				, l.nama_universitas AS nama_lokasi
				, js.nama_jenis_share AS jenis_share
				, s.id_jenis_sales AS jenis_sales
				, s.nama_sales
				, m.telkomsel
				, m.isat
				, m.xl
				, m.tri
				, m.smartfren
				, m.axis
				, m.other
				, m.total
				, ROUND(((m.telkomsel / m.total) * 100), 2) AS persen_telkomsel
				, ROUND(((m.isat / m.total) * 100), 2) AS persen_isat
				, ROUND(((m.xl / m.total) * 100), 2) AS persen_xl
				, ROUND(((m.tri / m.total) * 100), 2) AS persen_tri
				, ROUND(((m.smartfren / m.total) * 100), 2) AS persen_smartfren
				, ROUND(((m.axis / m.total) * 100), 2) AS persen_axis
				, ROUND(((m.other / m.total) * 100), 2) AS persen_other
				, ROUND(((m.total / m.total) * 100), 2) AS persen_total
			');
			$this->db->from('md_merchandising_kampus m');
			$this->db->join('ma_merchandisng_jenis_share js', 'm.id_jenis_share = js.id_jenis_share');
			$this->db->join('ed_kampus l', 'm.id_universitas = l.id_universitas');
			$this->db->join('db_sales s', 'm.created_by = s.id_sales');
			$this->db->where('m.tgl', $tgl);
			$this->db->where('m.id_universitas', $lokasi);
			$this->db->where('m.id_jenis_share', $jenis_share);
			$this->db->where('m.created_by', $sales);
		}
		elseif ($jenis_lokasi == 'FAK')
		{
			$this->db->select('
				m.id_merchandising
				, m.tgl
				, "FAK" AS jenis_lokasi
				, "" AS kode_lokasi
				, CONCAT(k.nama_universitas, "-", l.nama_fakultas) AS nama_lokasi
				, js.nama_jenis_share AS jenis_share
				, s.id_jenis_sales AS jenis_sales
				, s.nama_sales
				, m.telkomsel
				, m.isat
				, m.xl
				, m.tri
				, m.smartfren
				, m.axis
				, m.other
				, m.total
				, ROUND(((m.telkomsel / m.total) * 100), 2) AS persen_telkomsel
				, ROUND(((m.isat / m.total) * 100), 2) AS persen_isat
				, ROUND(((m.xl / m.total) * 100), 2) AS persen_xl
				, ROUND(((m.tri / m.total) * 100), 2) AS persen_tri
				, ROUND(((m.smartfren / m.total) * 100), 2) AS persen_smartfren
				, ROUND(((m.axis / m.total) * 100), 2) AS persen_axis
				, ROUND(((m.other / m.total) * 100), 2) AS persen_other
				, ROUND(((m.total / m.total) * 100), 2) AS persen_total
			');
			$this->db->from('me_merchandising_fakultas m');
			$this->db->join('ma_merchandisng_jenis_share js', 'm.id_jenis_share = js.id_jenis_share');
			$this->db->join('ee_fakultas l', 'm.id_fakultas = l.id_fakultas');
			$this->db->join('ed_kampus k', 'l.id_universitas = k.id_universitas');
			$this->db->join('db_sales s', 'm.created_by = s.id_sales');
			$this->db->where('m.tgl', $tgl);
			$this->db->where('m.id_fakultas', $lokasi);
			$this->db->where('m.id_jenis_share', $jenis_share);
			$this->db->where('m.created_by', $sales);
		}

    $result = $this->db->get();

    return $result->row_array();
	}

	function get_data_merchandising_attac()
	{
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : NULL;
		$sales = $this->input->post('sales') ? $this->input->post('sales') : NULL;
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? $this->input->post('jenis_lokasi') : NULL;
		$lokasi = $this->input->post('lokasi') ? $this->input->post('lokasi') : NULL;
		$jenis_share = $this->input->post('jenis_share') ? $this->input->post('jenis_share') : NULL;

		if ($jenis_lokasi == 'OUT')
		{
			$this->db->select('*');
			$this->db->from('mb_merchandising_outlet');
			$this->db->where('tgl', $tgl);
			$this->db->where('id_outlet', $lokasi);
			$this->db->where('id_jenis_share', $jenis_share);
			$this->db->where('created_by', $sales);
		}
		else if ($jenis_lokasi == 'SEK')
		{
			$this->db->select('*');
			$this->db->from('mc_merchandising_sekolah');
			$this->db->where('tgl', $tgl);
			$this->db->where('id_sekolah', $lokasi);
			$this->db->where('id_jenis_share', $jenis_share);
			$this->db->where('created_by', $sales);
		}
		else if ($jenis_lokasi == 'KAM')
		{
			$this->db->select('*');
			$this->db->from('md_merchandising_kampus');
			$this->db->where('tgl', $tgl);
			$this->db->where('id_universitas', $lokasi);
			$this->db->where('id_jenis_share', $jenis_share);
			$this->db->where('created_by', $sales);
		}
		else if ($jenis_lokasi == 'FAK')
		{
			$this->db->select('*');
			$this->db->from('me_merchandising_fakultas');
			$this->db->where('tgl', $tgl);
			$this->db->where('id_fakultas', $lokasi);
			$this->db->where('id_jenis_share', $jenis_share);
			$this->db->where('created_by', $sales);
		}

    $result = $this->db->get();

    return $result->row_array();
	}

	var $fieldmap_daftar_10 = array('kode_lokasi', 'nama_lokasi', 'status', 'total');
	var $column_order_10 = array(null, 'kode_lokasi', 'nama_lokasi', 'status', 'total');
	var $column_search_10 = array('kode_lokasi', 'nama_lokasi', 'status', 'total');

	function build_query_daftar_10()
	{
		$id_jenis_sales = $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : 0;
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : '';

		if ($id_jenis_sales == 'SDS') // Sekolah, Kampus, Fakultas, POI
		{
			$this->db->select('
				xx.id_lokasi
				, xx.kode_lokasi
				, xx.nama_lokasi
				, xx.status
				, xx.jenis_lokasi
				, xx.total
			');
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id_lokasi
							, l.no_npsn AS kode_lokasi
							, l.nama_sekolah AS nama_lokasi
							, d.status
							, "SEK" AS jenis_lokasi
							, (
										SELECT
												COUNT(xp.id_promotion)
										FROM
												nd_promotion_sekolah xp
										WHERE (xp.id_sekolah = d.id_tempat
												AND xp.created_by = d.id_sales
												AND xp.tgl = d.tanggal)
								) AS total
					FROM
							fb_histroy_pjp d
							INNER JOIN ec_sekolah l
									ON (d.id_tempat = l.id_sekolah)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "SEK")

					UNION ALL

					SELECT
							d.id_tempat AS id_lokasi
							, l.no_npsn AS kode_lokasi
							, l.nama_universitas AS nama_lokasi
							, d.status
							, "KAM" AS jenis_lokasi
							, (
										SELECT
												COUNT(xp.id_promotion)
										FROM
												ne_promotion_kampus xp
										WHERE (xp.id_universitas = d.id_tempat
												AND xp.created_by = d.id_sales
												AND xp.tgl = d.tanggal)
								) AS total
					FROM
							fb_histroy_pjp d
							INNER JOIN ed_kampus l
									ON (d.id_tempat = l.id_universitas)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "KAM")

					UNION ALL

					SELECT
							d.id_tempat AS id_lokasi
							, "" AS kode_lokasi
							, l.nama_fakultas AS nama_lokasi
							, d.status
							, "FAK" AS jenis_lokasi
							, (
										SELECT
												COUNT(xp.id_promotion)
										FROM
												nf_promotion_fakultas xp
										WHERE (xp.id_fakultas = d.id_tempat
												AND xp.created_by = d.id_sales
												AND xp.tgl = d.tanggal)
								) AS total
					FROM
							fb_histroy_pjp d
							INNER JOIN ee_fakultas l
									ON (d.id_tempat = l.id_fakultas)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "FAK")

					UNION ALL

					SELECT
							d.id_tempat AS id_lokasi
							, "" AS kode_lokasi
							, l.nama_poi AS nama_lokasi
							, d.status
							, "POI" AS jenis_lokasi
							, (
										SELECT
												COUNT(xp.id_promotion)
										FROM
												nf_promotion_poi xp
										WHERE (xp.id_poi = d.id_tempat
												AND xp.created_by = d.id_sales
												AND xp.tgl = d.tanggal)
								) AS total
					FROM
							fb_histroy_pjp d
							INNER JOIN ef_poi l
									ON (d.id_tempat = l.id_poi)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "POI")
				) xx
			');
		}
		else // Outlet
		{
			$this->db->select('
				xx.id_lokasi
				, xx.kode_lokasi
				, xx.nama_lokasi
				, xx.status
				, xx.jenis_lokasi
				, xx.total
			');
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id_lokasi
							, l.id_digipos AS kode_lokasi
							, l.nama_outlet AS nama_lokasi
							, d.status
							, "OUT" AS jenis_lokasi
							, (
										SELECT
												COUNT(xp.id_promotion)
										FROM
												nc_promotion_outlet xp
										WHERE (xp.id_outlet = d.id_tempat
												AND xp.created_by = d.id_sales
												AND xp.tgl = d.tanggal)
								) AS total
					FROM
							fb_histroy_pjp d
							INNER JOIN eb_outlet l
									ON (d.id_tempat = l.id_outlet)
					WHERE (d.id_sales = "'.$id_sales.'"
							AND d.tanggal = "'.$tgl.'"
							AND d.id_jenis_lokasi = "OUT")
				) xx
			');
		}
	}

	function get_list_promotion($tgl, $sales, $jenis_lokasi, $lokasi)
	{
		if ($jenis_lokasi == "OUT")
		{
			$this->db->select('
				p.id_jenis_weekly
				, jw.id_jenis
				, j.nama_jenis
				, p.id_promotion
				, p.file_video
			');
			$this->db->from('nc_promotion_outlet p');
			$this->db->join('nb_promotion_jenis_weekly jw', 'p.id_jenis_weekly = jw.id_jenis_weekly');
			$this->db->join('na_promotion_jenis j', 'jw.id_jenis = j.id_jenis');
			$this->db->where('p.id_outlet', $lokasi);
			$this->db->where('p.created_by', $sales);
			$this->db->where('p.tgl', $tgl);
		}
		else if ($jenis_lokasi == "SEK")
		{
			$this->db->select('
				p.id_jenis_weekly
				, jw.id_jenis
				, j.nama_jenis
				, p.id_promotion
				, p.file_video
			');
			$this->db->from('nd_promotion_sekolah p');
			$this->db->join('nb_promotion_jenis_weekly jw', 'p.id_jenis_weekly = jw.id_jenis_weekly');
			$this->db->join('na_promotion_jenis j', 'jw.id_jenis = j.id_jenis');
			$this->db->where('p.id_sekolah', $lokasi);
			$this->db->where('p.created_by', $sales);
			$this->db->where('p.tgl', $tgl);
		}
		else if ($jenis_lokasi == "KAM")
		{
			$this->db->select('
				p.id_jenis_weekly
				, jw.id_jenis
				, j.nama_jenis
				, p.id_promotion
				, p.file_video
			');
			$this->db->from('ne_promotion_kampus p');
			$this->db->join('nb_promotion_jenis_weekly jw', 'p.id_jenis_weekly = jw.id_jenis_weekly');
			$this->db->join('na_promotion_jenis j', 'jw.id_jenis = j.id_jenis');
			$this->db->where('p.id_universitas', $lokasi);
			$this->db->where('p.created_by', $sales);
			$this->db->where('p.tgl', $tgl);
		}
		else if ($jenis_lokasi == "FAK")
		{
			$this->db->select('
				p.id_jenis_weekly
				, jw.id_jenis
				, j.nama_jenis
				, p.id_promotion
				, p.file_video
			');
			$this->db->from('nf_promotion_fakultas p');
			$this->db->join('nb_promotion_jenis_weekly jw', 'p.id_jenis_weekly = jw.id_jenis_weekly');
			$this->db->join('na_promotion_jenis j', 'jw.id_jenis = j.id_jenis');
			$this->db->where('p.id_fakultas', $lokasi);
			$this->db->where('p.created_by', $sales);
			$this->db->where('p.tgl', $tgl);
		}
		else if ($jenis_lokasi == "POI")
		{
			$this->db->select('
				p.id_jenis_weekly
				, jw.id_jenis
				, j.nama_jenis
				, p.id_promotion
				, p.file_video
			');
			$this->db->from('nf_promotion_poi p');
			$this->db->join('nb_promotion_jenis_weekly jw', 'p.id_jenis_weekly = jw.id_jenis_weekly');
			$this->db->join('na_promotion_jenis j', 'jw.id_jenis = j.id_jenis');
			$this->db->where('p.id_poi', $lokasi);
			$this->db->where('p.created_by', $sales);
			$this->db->where('p.tgl', $tgl);
		}

		$query = $this->db->get();

		return $query->result();
	}

	var $fieldmap_daftar_11 = array(
		'kode_lokasi', 'nama_lokasi', 'status',
		'belanja',
		'sales_broadband_ld', 'sales_broadband_md', 'sales_broadband_hd',
		'voucher_fisik_ld', 'voucher_fisik_md', 'voucher_fisik_hd'
	);
	var $column_order_11 = array(null,
		'kode_lokasi', 'nama_lokasi', 'status',
		'belanja',
		'sales_broadband_ld', 'sales_broadband_md', 'sales_broadband_hd',
		'voucher_fisik_ld', 'voucher_fisik_md', 'voucher_fisik_hd'
	);
	var $column_search_11 = array(
		'kode_lokasi', 'nama_lokasi', 'status',
		'belanja',
		'sales_broadband_ld', 'sales_broadband_md', 'sales_broadband_hd',
		'voucher_fisik_ld', 'voucher_fisik_md', 'voucher_fisik_hd'
	);

	function build_query_daftar_11()
	{
		$id_jenis_sales = $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : 0;
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : '';

		$this->db->select('xx.*');
		$this->db->from('
			(
				SELECT
						d.id_tempat AS id_lokasi
						, l.id_digipos AS kode_lokasi
						, l.nama_outlet AS nama_lokasi
						, d.status
						, "OUT" AS jenis_lokasi
						, (
								(
									(
											SELECT
													COALESCE(SUM(telkomsel), 0)
											FROM
													ob_market_audit_outlet
											WHERE (tgl = d.tanggal
													AND id_outlet = d.id_tempat
													AND id_jenis_share = "BELANJA"
													AND created_by = d.id_sales)
									) /
									(
										(
												SELECT
														COALESCE(SUM(telkomsel), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "BELANJA"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(isat), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "BELANJA"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(xl), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "BELANJA"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(tri), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "BELANJA"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(smartfren), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "BELANJA"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(axis), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "BELANJA"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(other), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "BELANJA"
														AND created_by = d.id_sales)
										)
									)
								) * 100
							) AS belanja

						, (
								(
									(
											SELECT
													COALESCE(SUM(telkomsel_ld), 0)
											FROM
													ob_market_audit_outlet
											WHERE (tgl = d.tanggal
													AND id_outlet = d.id_tempat
													AND id_jenis_share = "SALES_BROADBAND"
													AND created_by = d.id_sales)
									) /
									(
										(
												SELECT
														COALESCE(SUM(telkomsel_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(isat_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(xl_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(tri_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(smartfren_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(axis_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(other_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										)
									)
								) * 100
							) AS sales_broadband_ld

						, (
								(
									(
											SELECT
													COALESCE(SUM(telkomsel_md), 0)
											FROM
													ob_market_audit_outlet
											WHERE (tgl = d.tanggal
													AND id_outlet = d.id_tempat
													AND id_jenis_share = "SALES_BROADBAND"
													AND created_by = d.id_sales)
									) /
									(
										(
												SELECT
														COALESCE(SUM(telkomsel_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(isat_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(xl_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(tri_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(smartfren_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(axis_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(other_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										)
									)
								) * 100
							) AS sales_broadband_md

						, (
								(
									(
											SELECT
													COALESCE(SUM(telkomsel_hd), 0)
											FROM
													ob_market_audit_outlet
											WHERE (tgl = d.tanggal
													AND id_outlet = d.id_tempat
													AND id_jenis_share = "SALES_BROADBAND"
													AND created_by = d.id_sales)
									) /
									(
										(
												SELECT
														COALESCE(SUM(telkomsel_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(isat_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(xl_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(tri_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(smartfren_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(axis_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(other_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "SALES_BROADBAND"
														AND created_by = d.id_sales)
										)
									)
								) * 100
							) AS sales_broadband_hd

						, (
								(
									(
											SELECT
													COALESCE(SUM(telkomsel_ld), 0)
											FROM
													ob_market_audit_outlet
											WHERE (tgl = d.tanggal
													AND id_outlet = d.id_tempat
													AND id_jenis_share = "VOUCHER_FISIK"
													AND created_by = d.id_sales)
									) /
									(
										(
												SELECT
														COALESCE(SUM(telkomsel_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(isat_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(xl_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(tri_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(smartfren_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(axis_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(other_ld), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										)
									)
								) * 100
							) AS voucher_fisik_ld

						, (
								(
									(
											SELECT
													COALESCE(SUM(telkomsel_md), 0)
											FROM
													ob_market_audit_outlet
											WHERE (tgl = d.tanggal
													AND id_outlet = d.id_tempat
													AND id_jenis_share = "VOUCHER_FISIK"
													AND created_by = d.id_sales)
									) /
									(
										(
												SELECT
														COALESCE(SUM(telkomsel_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(isat_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(xl_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(tri_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(smartfren_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(axis_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(other_md), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										)
									)
								) * 100
							) AS voucher_fisik_md

						, (
								(
									(
											SELECT
													COALESCE(SUM(telkomsel_hd), 0)
											FROM
													ob_market_audit_outlet
											WHERE (tgl = d.tanggal
													AND id_outlet = d.id_tempat
													AND id_jenis_share = "VOUCHER_FISIK"
													AND created_by = d.id_sales)
									) /
									(
										(
												SELECT
														COALESCE(SUM(telkomsel_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(isat_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(xl_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(tri_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(smartfren_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(axis_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										) +
										(
												SELECT
														COALESCE(SUM(other_hd), 0)
												FROM
														ob_market_audit_outlet
												WHERE (tgl = d.tanggal
														AND id_outlet = d.id_tempat
														AND id_jenis_share = "VOUCHER_FISIK"
														AND created_by = d.id_sales)
										)
									)
								) * 100
							) AS voucher_fisik_hd
				FROM
						fb_histroy_pjp d
						INNER JOIN eb_outlet l
								ON (d.id_tempat = l.id_outlet)
				WHERE (d.id_sales = "'.$id_sales.'"
						AND d.tanggal = "'.$tgl.'"
						AND d.id_jenis_lokasi = "OUT")
			) xx
		');
	}

	function get_data_market_audit_trans($tgl, $sales, $jenis_lokasi, $lokasi, $jenis_share, $kategori)
	{
		$this->db->select('*');
		$this->db->from('ob_market_audit_outlet');
		$this->db->where('tgl', $tgl);
		$this->db->where('id_outlet', $lokasi);
		$this->db->where('id_jenis_share', $jenis_share);
		$this->db->where('created_by', $sales);

    $result = $this->db->get();

    return $result->row_array();
	}
}
?>