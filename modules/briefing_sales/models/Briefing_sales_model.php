<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Briefing_sales_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function penjualan_tanggal($tgl)
	{
		$this->w1_tahun = 0; $this->w1_bulan = 0; $this->w1_minggu = 0;
		$this->w2_tahun = 0; $this->w2_bulan = 0; $this->w2_minggu = 0;
		$this->w3_tahun = 0; $this->w3_bulan = 0; $this->w3_minggu = 0;
		$this->w4_tahun = 0; $this->w4_bulan = 0; $this->w4_minggu = 0;

		$this->w0_tgl_mulai = 0; $this->w0_tgl_selesai = 0;
		$this->w1_tgl_mulai = 0; $this->w1_tgl_selesai = 0; // W
		$this->w2_tgl_mulai = 0; $this->w2_tgl_selesai = 0; // W-1
		$this->w3_tgl_mulai = 0; $this->w3_tgl_selesai = 0; // W-2
		$this->w4_tgl_mulai = 0; $this->w4_tgl_selesai = 0; // W-3


		$this->db->select('p.tahun, p.bulan, p.minggu');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tanggal', $tgl);
		$rs_a = $this->db->get()->row_array();

		$tahun = isset($rs_a['tahun']) ? $rs_a['tahun'] : 0;
		$bulan = isset($rs_a['bulan']) ? (strlen((string) $rs_a['bulan']) == 1 ? '0'.$rs_a['bulan'] : $rs_a['bulan']) : 0;
		$minggu = isset($rs_a['minggu']) ? $rs_a['minggu'] : 0;


		$this->db->select('
			xx.tahun
			, xx.bulan
			, xx.minggu
			, xx.tgl_mulai
			, xx.tgl_selesai
		');
		$this->db->from('
			(
				SELECT
					p.tahun
					, p.bulan
					, p.minggu
					, (
								SELECT
										MIN(xp.tanggal)
								FROM
										ja_penjualan_tanggal xp
								WHERE (xp.tahun = p.tahun
										AND xp.bulan = p.bulan
										AND xp.minggu = p.minggu)
						) AS tgl_mulai
					, (
								SELECT
										MAX(xp.tanggal)
								FROM
										ja_penjualan_tanggal xp
								WHERE (xp.tahun = p.tahun
										AND xp.bulan = p.bulan
										AND xp.minggu = p.minggu)
						) AS tgl_selesai
				FROM ja_penjualan_tanggal p
				WHERE CONCAT(p.tahun, (IF(LENGTH(p.bulan) = 1, CONCAT("0", p.bulan), p.bulan)), p.minggu) = "'.$tahun.$bulan.$minggu.'"
				GROUP BY p.tahun, p.bulan, p.minggu
			) xx
		');
		$rs_b = $this->db->get()->row_array();

		$this->w0_tgl_mulai = isset($rs_b['tgl_mulai']) ? $rs_b['tgl_mulai'] : 0;
		$this->w0_tgl_selesai = isset($rs_b['tgl_selesai']) ? $rs_b['tgl_selesai'] : 0;


		$this->db->select('
			xx.tahun
			, xx.bulan
			, xx.minggu
			, xx.tgl_mulai
			, xx.tgl_selesai
		');
		$this->db->from('
			(
				SELECT
					p.tahun
					, p.bulan
					, p.minggu
					, (
								SELECT
										MIN(xp.tanggal)
								FROM
										ja_penjualan_tanggal xp
								WHERE (xp.tahun = p.tahun
										AND xp.bulan = p.bulan
										AND xp.minggu = p.minggu)
						) AS tgl_mulai
					, (
								SELECT
										MAX(xp.tanggal)
								FROM
										ja_penjualan_tanggal xp
								WHERE (xp.tahun = p.tahun
										AND xp.bulan = p.bulan
										AND xp.minggu = p.minggu)
						) AS tgl_selesai
				FROM ja_penjualan_tanggal p
				WHERE CONCAT(p.tahun, (IF(LENGTH(p.bulan) = 1, CONCAT("0", p.bulan), p.bulan)), p.minggu) <= "'.$tahun.$bulan.$minggu.'"
				GROUP BY p.tahun, p.bulan, p.minggu
				ORDER BY p.tanggal_merge DESC
				LIMIT 4
			) xx
		');
		$rs_c = $this->db->get()->result_array();

		if (!empty($rs_c))
		{
			$total = count($rs_c);

			if ($total == 4)
			{
				$this->w1_tahun = isset($rs_c[0]['tahun']) ? $rs_c[0]['tahun'] : 0;
				$this->w1_bulan = isset($rs_c[0]['bulan']) ? $rs_c[0]['bulan'] : 0;
				$this->w1_minggu = isset($rs_c[0]['minggu']) ? $rs_c[0]['minggu'] : 0;
				$this->w2_tahun = isset($rs_c[1]['tahun']) ? $rs_c[1]['tahun'] : 0;
				$this->w2_bulan = isset($rs_c[1]['bulan']) ? $rs_c[1]['bulan'] : 0;
				$this->w2_minggu = isset($rs_c[1]['minggu']) ? $rs_c[1]['minggu'] : 0;
				$this->w3_tahun = isset($rs_c[2]['tahun']) ? $rs_c[2]['tahun'] : 0;
				$this->w3_bulan = isset($rs_c[2]['bulan']) ? $rs_c[2]['bulan'] : 0;
				$this->w3_minggu = isset($rs_c[2]['minggu']) ? $rs_c[2]['minggu'] : 0;

				$this->w4_tahun = isset($rs_c[3]['tahun']) ? $rs_c[3]['tahun'] : 0;
				$this->w4_bulan = isset($rs_c[3]['bulan']) ? $rs_c[3]['bulan'] : 0;
				$this->w4_minggu = isset($rs_c[3]['minggu']) ? $rs_c[3]['minggu'] : 0;

				$this->w1_tgl_mulai = isset($rs_c[0]['tgl_mulai']) ? $rs_c[0]['tgl_mulai'] : 0;
				$this->w1_tgl_selesai = isset($rs_c[0]['tgl_selesai']) ? $rs_c[0]['tgl_selesai'] : 0;
				$this->w2_tgl_mulai = isset($rs_c[1]['tgl_mulai']) ? $rs_c[1]['tgl_mulai'] : 0;
				$this->w2_tgl_selesai = isset($rs_c[1]['tgl_selesai']) ? $rs_c[1]['tgl_selesai'] : 0;
				$this->w3_tgl_mulai = isset($rs_c[2]['tgl_mulai']) ? $rs_c[2]['tgl_mulai'] : 0;
				$this->w3_tgl_selesai = isset($rs_c[2]['tgl_selesai']) ? $rs_c[2]['tgl_selesai'] : 0;
				$this->w4_tgl_mulai = isset($rs_c[3]['tgl_mulai']) ? $rs_c[3]['tgl_mulai'] : 0;
				$this->w4_tgl_selesai = isset($rs_c[3]['tgl_selesai']) ? $rs_c[3]['tgl_selesai'] : 0;
			}
			else if ($total == 3)
			{
				$this->w1_tahun = isset($rs_c[0]['tahun']) ? $rs_c[0]['tahun'] : 0;
				$this->w1_bulan = isset($rs_c[0]['bulan']) ? $rs_c[0]['bulan'] : 0;
				$this->w1_minggu = isset($rs_c[0]['minggu']) ? $rs_c[0]['minggu'] : 0;
				$this->w2_tahun = isset($rs_c[1]['tahun']) ? $rs_c[1]['tahun'] : 0;
				$this->w2_bulan = isset($rs_c[1]['bulan']) ? $rs_c[1]['bulan'] : 0;
				$this->w2_minggu = isset($rs_c[1]['minggu']) ? $rs_c[1]['minggu'] : 0;
				$this->w3_tahun = isset($rs_c[2]['tahun']) ? $rs_c[2]['tahun'] : 0;
				$this->w3_bulan = isset($rs_c[2]['bulan']) ? $rs_c[2]['bulan'] : 0;
				$this->w3_minggu = isset($rs_c[2]['minggu']) ? $rs_c[2]['minggu'] : 0;

				$this->w1_tgl_mulai = isset($rs_c[0]['tgl_mulai']) ? $rs_c[0]['tgl_mulai'] : 0;
				$this->w1_tgl_selesai = isset($rs_c[0]['tgl_selesai']) ? $rs_c[0]['tgl_selesai'] : 0;
				$this->w2_tgl_mulai = isset($rs_c[1]['tgl_mulai']) ? $rs_c[1]['tgl_mulai'] : 0;
				$this->w2_tgl_selesai = isset($rs_c[1]['tgl_selesai']) ? $rs_c[1]['tgl_selesai'] : 0;
				$this->w3_tgl_mulai = isset($rs_c[2]['tgl_mulai']) ? $rs_c[2]['tgl_mulai'] : 0;
				$this->w3_tgl_selesai = isset($rs_c[2]['tgl_selesai']) ? $rs_c[2]['tgl_selesai'] : 0;
			}
			else if ($total == 2)
			{
				$this->w1_tahun = isset($rs_c[0]['tahun']) ? $rs_c[0]['tahun'] : 0;
				$this->w1_bulan = isset($rs_c[0]['bulan']) ? $rs_c[0]['bulan'] : 0;
				$this->w1_minggu = isset($rs_c[0]['minggu']) ? $rs_c[0]['minggu'] : 0;
				$this->w2_tahun = isset($rs_c[1]['tahun']) ? $rs_c[1]['tahun'] : 0;
				$this->w2_bulan = isset($rs_c[1]['bulan']) ? $rs_c[1]['bulan'] : 0;
				$this->w2_minggu = isset($rs_c[1]['minggu']) ? $rs_c[1]['minggu'] : 0;

				$this->w1_tgl_mulai = isset($rs_c[0]['tgl_mulai']) ? $rs_c[0]['tgl_mulai'] : 0;
				$this->w1_tgl_selesai = isset($rs_c[0]['tgl_selesai']) ? $rs_c[0]['tgl_selesai'] : 0;
				$this->w2_tgl_mulai = isset($rs_c[1]['tgl_mulai']) ? $rs_c[1]['tgl_mulai'] : 0;
				$this->w2_tgl_selesai = isset($rs_c[1]['tgl_selesai']) ? $rs_c[1]['tgl_selesai'] : 0;
			}
			else if ($total == 1)
			{
				$this->w1_tahun = isset($rs_c[0]['tahun']) ? $rs_c[0]['tahun'] : 0;
				$this->w1_bulan = isset($rs_c[0]['bulan']) ? $rs_c[0]['bulan'] : 0;
				$this->w1_minggu = isset($rs_c[0]['minggu']) ? $rs_c[0]['minggu'] : 0;

				$this->w1_tgl_mulai = isset($rs_c[0]['tgl_mulai']) ? $rs_c[0]['tgl_mulai'] : 0;
				$this->w1_tgl_selesai = isset($rs_c[0]['tgl_selesai']) ? $rs_c[0]['tgl_selesai'] : 0;
			}
		}
	}

	var $fieldmap_daftar_1 = array('nama_lokasi', 'clock_in', 'clock_out', 'durasi', 'status_pjp');
	var $column_order_1 = array(null,'nama_lokasi', 'clock_in', 'clock_out', 'durasi', 'status_pjp');
	var $column_search_1 = array('nama_lokasi', 'clock_in', 'clock_out', 'durasi', 'status_pjp');

	function build_query_daftar_1()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');

		$this->db->select('
			xx.id_lokasi
			, xx.kode_lokasi
			, xx.nama_lokasi
			, xx.clock_in
			, xx.clock_out
			, xx.durasi
			, xx.status_pjp
			, xx.longitude
			, xx.latitude
		');
		$this->db->from('
			(
				SELECT
						d.id_tempat AS id_lokasi
						, CASE d.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.id_digipos FROM eb_outlet a WHERE (a.id_outlet = d.id_tempat))
									WHEN "SEK" THEN (SELECT a.no_npsn FROM ec_sekolah a WHERE (a.id_sekolah = d.id_tempat))
									WHEN "KAM" THEN (SELECT a.no_npsn FROM ed_kampus a WHERE (a.id_universitas = d.id_tempat))
									WHEN "FAK" THEN ""
									WHEN "POI" THEN ""
									ELSE NULL
							END AS kode_lokasi
						, CASE d.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = d.id_tempat))
									WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = d.id_tempat))
									WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = d.id_tempat))
									WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = d.id_tempat))
									WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = d.id_tempat))
									ELSE NULL
							END AS nama_lokasi
						, h.jam_clock_in AS clock_in
					 , IF(h.jam_clock_out = "00:00:00", "", h.jam_clock_out) AS clock_out
					 , IF(h.jam_clock_out = "00:00:00", 0, FORMAT(((TIME_TO_SEC(h.jam_clock_out) - TIME_TO_SEC(h.jam_clock_in)) / 60), 0)) AS durasi
					 , IF(h.status = "OPEN", "<span class=\'badge badge-success badge-pill\'>OPEN</span>", "<span class=\'badge badge-danger badge-pill\'>CLOSE</span>") AS status_pjp
						, d.longitude
						, d.latitude
				FROM
						fe_daftar_pjp d
						LEFT JOIN fb_histroy_pjp h
								ON (h.id_sales = d.id_sales AND h.id_tempat = d.id_tempat AND h.id_jenis_lokasi = d.id_jenis_lokasi AND h.tanggal = d.tanggal)
				WHERE (d.id_sales = "'.$id_sales.'"
						AND d.tanggal = "'.$tgl.'")
				ORDER BY d.no_kunjungan ASC
			) xx
		');
	}

	var $fieldmap_daftar_2 = array();
	var $column_order_2 = array();
	var $column_search_2 = array();

	function build_query_daftar_2()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');

		$this->penjualan_tanggal($tgl);

		$this->db->select('v.*');
		$this->db->from('
			(SELECT @id_sales:="'.$id_sales.'") x_id_sales,
			(SELECT @tanggal:="'.$tgl.'") x_tanggal,
			(SELECT @w0_tgl_mulai:="'.$this->w0_tgl_mulai.'") x_w0_tgl_mulai,
			(SELECT @w0_tgl_selesai:="'.$this->w0_tgl_selesai.'") x_w0_tgl_selesai,
			v_briefing_distribusi_tp_outlet v
		');
	}

	var $fieldmap_daftar_3 = array();
	var $column_order_3 = array();
	var $column_search_3 = array();

	function build_query_daftar_3()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');

		$this->penjualan_tanggal($tgl);

		$this->db->select('v.*');
		$this->db->from('
			(SELECT @id_sales:="'.$id_sales.'") x_id_sales,
			(SELECT @tanggal:="'.$tgl.'") x_tanggal,
			(SELECT @w1_tgl_mulai:="'.$this->w1_tgl_mulai.'") x_w1_tgl_mulai,
			(SELECT @w1_tgl_selesai:="'.$this->w1_tgl_selesai.'") x_w1_tgl_selesai,
			(SELECT @w2_tgl_mulai:="'.$this->w2_tgl_mulai.'") x_w2_tgl_mulai,
			(SELECT @w2_tgl_selesai:="'.$this->w2_tgl_selesai.'") x_w2_tgl_selesai,
			(SELECT @w3_tgl_mulai:="'.$this->w3_tgl_mulai.'") X_w3_tgl_mulai,
			(SELECT @w3_tgl_selesai:="'.$this->w3_tgl_selesai.'") x_w3_tgl_selesai,
			(SELECT @w4_tgl_mulai:="'.$this->w4_tgl_mulai.'") X_w4_tgl_mulai,
			(SELECT @w4_tgl_selesai:="'.$this->w4_tgl_selesai.'") x_w4_tgl_selesai,
			v_briefing_distribusi_ho_outlet v
		');
	}

	var $fieldmap_daftar_4 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);
	var $column_order_4 = array(null,
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);
	var $column_search_4 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);

	function build_query_daftar_4()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');
		$id_jenis_share = 'PERDANA';

		$this->penjualan_tanggal($tgl);

		$this->db->select('xx.*');
		$this->db->from('
			(
				SELECT
						p.id_tempat AS id_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.id_digipos FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.no_npsn FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.no_npsn FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN "-"
									WHEN "POI" THEN "-"
									ELSE NULL
							END AS kode_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = p.id_tempat))
									WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = p.id_tempat))
									ELSE NULL
							END AS nama_lokasi

						, COALESCE(SUM(m_1.telkomsel), 0) AS w1_telkomsel
						, COALESCE(SUM(m_1.isat), 0) AS w1_isat
						, COALESCE(SUM(m_1.xl), 0) AS w1_xl
						, COALESCE(SUM(m_1.tri), 0) AS w1_tri
						, COALESCE(SUM(m_1.smartfren), 0) AS w1_smartfren
						, COALESCE(SUM(m_1.axis), 0) AS w1_axis
						, COALESCE(SUM(m_1.other), 0) AS w1_other
						, COALESCE(SUM(m_1.total), 0) AS w1_total

						, COALESCE(SUM(m_2.telkomsel), 0) AS w2_telkomsel
						, COALESCE(SUM(m_2.isat), 0) AS w2_isat
						, COALESCE(SUM(m_2.xl), 0) AS w2_xl
						, COALESCE(SUM(m_2.tri), 0) AS w2_tri
						, COALESCE(SUM(m_2.smartfren), 0) AS w2_smartfren
						, COALESCE(SUM(m_2.axis), 0) AS w2_axis
						, COALESCE(SUM(m_2.other), 0) AS w2_other
						, COALESCE(SUM(m_2.total), 0) AS w2_total

						, COALESCE(SUM(m_3.telkomsel), 0) AS w3_telkomsel
						, COALESCE(SUM(m_3.isat), 0) AS w3_isat
						, COALESCE(SUM(m_3.xl), 0) AS w3_xl
						, COALESCE(SUM(m_3.tri), 0) AS w3_tri
						, COALESCE(SUM(m_3.smartfren), 0) AS w3_smartfren
						, COALESCE(SUM(m_3.axis), 0) AS w3_axis
						, COALESCE(SUM(m_3.other), 0) AS w3_other
						, COALESCE(SUM(m_3.total), 0) AS w3_total

						, COALESCE(SUM(m_4.telkomsel), 0) AS w4_telkomsel
						, COALESCE(SUM(m_4.isat), 0) AS w4_isat
						, COALESCE(SUM(m_4.xl), 0) AS w4_xl
						, COALESCE(SUM(m_4.tri), 0) AS w4_tri
						, COALESCE(SUM(m_4.smartfren), 0) AS w4_smartfren
						, COALESCE(SUM(m_4.axis), 0) AS w4_axis
						, COALESCE(SUM(m_4.other), 0) AS w4_other
						, COALESCE(SUM(m_4.total), 0) AS w4_total
				FROM
						fa_pjp p
						LEFT JOIN mb_merchandising_outlet m_1
								ON (p.id_tempat = m_1.id_outlet) AND (m_1.tgl BETWEEN "'.$this->w1_tgl_mulai.'" AND "'.$this->w1_tgl_selesai.'") AND (m_1.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_2
								ON (p.id_tempat = m_2.id_outlet) AND (m_2.tgl BETWEEN "'.$this->w2_tgl_mulai.'" AND "'.$this->w2_tgl_selesai.'") AND (m_2.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_3
								ON (p.id_tempat = m_3.id_outlet) AND (m_3.tgl BETWEEN "'.$this->w3_tgl_mulai.'" AND "'.$this->w3_tgl_selesai.'") AND (m_3.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_4
								ON (p.id_tempat = m_4.id_outlet) AND (m_4.tgl BETWEEN "'.$this->w4_tgl_mulai.'" AND "'.$this->w4_tgl_selesai.'") AND (m_4.id_jenis_share = "'.$id_jenis_share.'")
				WHERE (p.id_sales = "'.$id_sales.'")
				GROUP BY id_lokasi
			) xx
		');
	}

	var $fieldmap_daftar_5 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);
	var $column_order_5 = array(null,
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);
	var $column_search_5 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);

	function build_query_daftar_5()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');
		$id_jenis_share = 'VOUCHER_FISIK';

		$this->penjualan_tanggal($tgl);

		$this->db->select('xx.*');
		$this->db->from('
			(
				SELECT
						p.id_tempat AS id_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.id_digipos FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.no_npsn FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.no_npsn FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN "-"
									WHEN "POI" THEN "-"
									ELSE NULL
							END AS kode_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = p.id_tempat))
									WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = p.id_tempat))
									ELSE NULL
							END AS nama_lokasi

						, COALESCE(SUM(m_1.telkomsel), 0) AS w1_telkomsel
						, COALESCE(SUM(m_1.isat), 0) AS w1_isat
						, COALESCE(SUM(m_1.xl), 0) AS w1_xl
						, COALESCE(SUM(m_1.tri), 0) AS w1_tri
						, COALESCE(SUM(m_1.smartfren), 0) AS w1_smartfren
						, COALESCE(SUM(m_1.axis), 0) AS w1_axis
						, COALESCE(SUM(m_1.other), 0) AS w1_other
						, COALESCE(SUM(m_1.total), 0) AS w1_total

						, COALESCE(SUM(m_2.telkomsel), 0) AS w2_telkomsel
						, COALESCE(SUM(m_2.isat), 0) AS w2_isat
						, COALESCE(SUM(m_2.xl), 0) AS w2_xl
						, COALESCE(SUM(m_2.tri), 0) AS w2_tri
						, COALESCE(SUM(m_2.smartfren), 0) AS w2_smartfren
						, COALESCE(SUM(m_2.axis), 0) AS w2_axis
						, COALESCE(SUM(m_2.other), 0) AS w2_other
						, COALESCE(SUM(m_2.total), 0) AS w2_total

						, COALESCE(SUM(m_3.telkomsel), 0) AS w3_telkomsel
						, COALESCE(SUM(m_3.isat), 0) AS w3_isat
						, COALESCE(SUM(m_3.xl), 0) AS w3_xl
						, COALESCE(SUM(m_3.tri), 0) AS w3_tri
						, COALESCE(SUM(m_3.smartfren), 0) AS w3_smartfren
						, COALESCE(SUM(m_3.axis), 0) AS w3_axis
						, COALESCE(SUM(m_3.other), 0) AS w3_other
						, COALESCE(SUM(m_3.total), 0) AS w3_total

						, COALESCE(SUM(m_4.telkomsel), 0) AS w4_telkomsel
						, COALESCE(SUM(m_4.isat), 0) AS w4_isat
						, COALESCE(SUM(m_4.xl), 0) AS w4_xl
						, COALESCE(SUM(m_4.tri), 0) AS w4_tri
						, COALESCE(SUM(m_4.smartfren), 0) AS w4_smartfren
						, COALESCE(SUM(m_4.axis), 0) AS w4_axis
						, COALESCE(SUM(m_4.other), 0) AS w4_other
						, COALESCE(SUM(m_4.total), 0) AS w4_total
				FROM
						fa_pjp p
						LEFT JOIN mb_merchandising_outlet m_1
								ON (p.id_tempat = m_1.id_outlet) AND (m_1.tgl BETWEEN "'.$this->w1_tgl_mulai.'" AND "'.$this->w1_tgl_selesai.'") AND (m_1.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_2
								ON (p.id_tempat = m_2.id_outlet) AND (m_2.tgl BETWEEN "'.$this->w2_tgl_mulai.'" AND "'.$this->w2_tgl_selesai.'") AND (m_2.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_3
								ON (p.id_tempat = m_3.id_outlet) AND (m_3.tgl BETWEEN "'.$this->w3_tgl_mulai.'" AND "'.$this->w3_tgl_selesai.'") AND (m_3.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_4
								ON (p.id_tempat = m_4.id_outlet) AND (m_4.tgl BETWEEN "'.$this->w4_tgl_mulai.'" AND "'.$this->w4_tgl_selesai.'") AND (m_4.id_jenis_share = "'.$id_jenis_share.'")
				WHERE (p.id_sales = "'.$id_sales.'")
				GROUP BY id_lokasi
			) xx
		');
	}

	var $fieldmap_daftar_6 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);
	var $column_order_6 = array(null,
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);
	var $column_search_6 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);

	function build_query_daftar_6()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');
		$id_jenis_share = 'SPANDUK';

		$this->penjualan_tanggal($tgl);

		$this->db->select('xx.*');
		$this->db->from('
			(
				SELECT
						p.id_tempat AS id_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.id_digipos FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.no_npsn FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.no_npsn FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN "-"
									WHEN "POI" THEN "-"
									ELSE NULL
							END AS kode_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = p.id_tempat))
									WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = p.id_tempat))
									ELSE NULL
							END AS nama_lokasi

						, COALESCE(SUM(m_1.telkomsel), 0) AS w1_telkomsel
						, COALESCE(SUM(m_1.isat), 0) AS w1_isat
						, COALESCE(SUM(m_1.xl), 0) AS w1_xl
						, COALESCE(SUM(m_1.tri), 0) AS w1_tri
						, COALESCE(SUM(m_1.smartfren), 0) AS w1_smartfren
						, COALESCE(SUM(m_1.axis), 0) AS w1_axis
						, COALESCE(SUM(m_1.other), 0) AS w1_other
						, COALESCE(SUM(m_1.total), 0) AS w1_total

						, COALESCE(SUM(m_2.telkomsel), 0) AS w2_telkomsel
						, COALESCE(SUM(m_2.isat), 0) AS w2_isat
						, COALESCE(SUM(m_2.xl), 0) AS w2_xl
						, COALESCE(SUM(m_2.tri), 0) AS w2_tri
						, COALESCE(SUM(m_2.smartfren), 0) AS w2_smartfren
						, COALESCE(SUM(m_2.axis), 0) AS w2_axis
						, COALESCE(SUM(m_2.other), 0) AS w2_other
						, COALESCE(SUM(m_2.total), 0) AS w2_total

						, COALESCE(SUM(m_3.telkomsel), 0) AS w3_telkomsel
						, COALESCE(SUM(m_3.isat), 0) AS w3_isat
						, COALESCE(SUM(m_3.xl), 0) AS w3_xl
						, COALESCE(SUM(m_3.tri), 0) AS w3_tri
						, COALESCE(SUM(m_3.smartfren), 0) AS w3_smartfren
						, COALESCE(SUM(m_3.axis), 0) AS w3_axis
						, COALESCE(SUM(m_3.other), 0) AS w3_other
						, COALESCE(SUM(m_3.total), 0) AS w3_total

						, COALESCE(SUM(m_4.telkomsel), 0) AS w4_telkomsel
						, COALESCE(SUM(m_4.isat), 0) AS w4_isat
						, COALESCE(SUM(m_4.xl), 0) AS w4_xl
						, COALESCE(SUM(m_4.tri), 0) AS w4_tri
						, COALESCE(SUM(m_4.smartfren), 0) AS w4_smartfren
						, COALESCE(SUM(m_4.axis), 0) AS w4_axis
						, COALESCE(SUM(m_4.other), 0) AS w4_other
						, COALESCE(SUM(m_4.total), 0) AS w4_total
				FROM
						fa_pjp p
						LEFT JOIN mb_merchandising_outlet m_1
								ON (p.id_tempat = m_1.id_outlet) AND (m_1.tgl BETWEEN "'.$this->w1_tgl_mulai.'" AND "'.$this->w1_tgl_selesai.'") AND (m_1.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_2
								ON (p.id_tempat = m_2.id_outlet) AND (m_2.tgl BETWEEN "'.$this->w2_tgl_mulai.'" AND "'.$this->w2_tgl_selesai.'") AND (m_2.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_3
								ON (p.id_tempat = m_3.id_outlet) AND (m_3.tgl BETWEEN "'.$this->w3_tgl_mulai.'" AND "'.$this->w3_tgl_selesai.'") AND (m_3.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_4
								ON (p.id_tempat = m_4.id_outlet) AND (m_4.tgl BETWEEN "'.$this->w4_tgl_mulai.'" AND "'.$this->w4_tgl_selesai.'") AND (m_4.id_jenis_share = "'.$id_jenis_share.'")
				WHERE (p.id_sales = "'.$id_sales.'")
				GROUP BY id_lokasi
			) xx
		');
	}

	var $fieldmap_daftar_7 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);
	var $column_order_7 = array(null,
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);
	var $column_search_7 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);

	function build_query_daftar_7()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');
		$id_jenis_share = 'POSTER';

		$this->penjualan_tanggal($tgl);

		$this->db->select('xx.*');
		$this->db->from('
			(
				SELECT
						p.id_tempat AS id_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.id_digipos FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.no_npsn FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.no_npsn FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN "-"
									WHEN "POI" THEN "-"
									ELSE NULL
							END AS kode_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = p.id_tempat))
									WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = p.id_tempat))
									ELSE NULL
							END AS nama_lokasi

						, COALESCE(SUM(m_1.telkomsel), 0) AS w1_telkomsel
						, COALESCE(SUM(m_1.isat), 0) AS w1_isat
						, COALESCE(SUM(m_1.xl), 0) AS w1_xl
						, COALESCE(SUM(m_1.tri), 0) AS w1_tri
						, COALESCE(SUM(m_1.smartfren), 0) AS w1_smartfren
						, COALESCE(SUM(m_1.axis), 0) AS w1_axis
						, COALESCE(SUM(m_1.other), 0) AS w1_other
						, COALESCE(SUM(m_1.total), 0) AS w1_total

						, COALESCE(SUM(m_2.telkomsel), 0) AS w2_telkomsel
						, COALESCE(SUM(m_2.isat), 0) AS w2_isat
						, COALESCE(SUM(m_2.xl), 0) AS w2_xl
						, COALESCE(SUM(m_2.tri), 0) AS w2_tri
						, COALESCE(SUM(m_2.smartfren), 0) AS w2_smartfren
						, COALESCE(SUM(m_2.axis), 0) AS w2_axis
						, COALESCE(SUM(m_2.other), 0) AS w2_other
						, COALESCE(SUM(m_2.total), 0) AS w2_total

						, COALESCE(SUM(m_3.telkomsel), 0) AS w3_telkomsel
						, COALESCE(SUM(m_3.isat), 0) AS w3_isat
						, COALESCE(SUM(m_3.xl), 0) AS w3_xl
						, COALESCE(SUM(m_3.tri), 0) AS w3_tri
						, COALESCE(SUM(m_3.smartfren), 0) AS w3_smartfren
						, COALESCE(SUM(m_3.axis), 0) AS w3_axis
						, COALESCE(SUM(m_3.other), 0) AS w3_other
						, COALESCE(SUM(m_3.total), 0) AS w3_total

						, COALESCE(SUM(m_4.telkomsel), 0) AS w4_telkomsel
						, COALESCE(SUM(m_4.isat), 0) AS w4_isat
						, COALESCE(SUM(m_4.xl), 0) AS w4_xl
						, COALESCE(SUM(m_4.tri), 0) AS w4_tri
						, COALESCE(SUM(m_4.smartfren), 0) AS w4_smartfren
						, COALESCE(SUM(m_4.axis), 0) AS w4_axis
						, COALESCE(SUM(m_4.other), 0) AS w4_other
						, COALESCE(SUM(m_4.total), 0) AS w4_total
				FROM
						fa_pjp p
						LEFT JOIN mb_merchandising_outlet m_1
								ON (p.id_tempat = m_1.id_outlet) AND (m_1.tgl BETWEEN "'.$this->w1_tgl_mulai.'" AND "'.$this->w1_tgl_selesai.'") AND (m_1.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_2
								ON (p.id_tempat = m_2.id_outlet) AND (m_2.tgl BETWEEN "'.$this->w2_tgl_mulai.'" AND "'.$this->w2_tgl_selesai.'") AND (m_2.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_3
								ON (p.id_tempat = m_3.id_outlet) AND (m_3.tgl BETWEEN "'.$this->w3_tgl_mulai.'" AND "'.$this->w3_tgl_selesai.'") AND (m_3.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_4
								ON (p.id_tempat = m_4.id_outlet) AND (m_4.tgl BETWEEN "'.$this->w4_tgl_mulai.'" AND "'.$this->w4_tgl_selesai.'") AND (m_4.id_jenis_share = "'.$id_jenis_share.'")
				WHERE (p.id_sales = "'.$id_sales.'")
				GROUP BY id_lokasi
			) xx
		');
	}

	var $fieldmap_daftar_8 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);
	var $column_order_8 = array(null,
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);
	var $column_search_8 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);

	function build_query_daftar_8()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');
		$id_jenis_share = 'PAPAN_NAMA';

		$this->penjualan_tanggal($tgl);

		$this->db->select('xx.*');
		$this->db->from('
			(
				SELECT
						p.id_tempat AS id_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.id_digipos FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.no_npsn FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.no_npsn FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN "-"
									WHEN "POI" THEN "-"
									ELSE NULL
							END AS kode_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = p.id_tempat))
									WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = p.id_tempat))
									ELSE NULL
							END AS nama_lokasi

						, COALESCE(SUM(m_1.telkomsel), 0) AS w1_telkomsel
						, COALESCE(SUM(m_1.isat), 0) AS w1_isat
						, COALESCE(SUM(m_1.xl), 0) AS w1_xl
						, COALESCE(SUM(m_1.tri), 0) AS w1_tri
						, COALESCE(SUM(m_1.smartfren), 0) AS w1_smartfren
						, COALESCE(SUM(m_1.axis), 0) AS w1_axis
						, COALESCE(SUM(m_1.other), 0) AS w1_other
						, COALESCE(SUM(m_1.total), 0) AS w1_total

						, COALESCE(SUM(m_2.telkomsel), 0) AS w2_telkomsel
						, COALESCE(SUM(m_2.isat), 0) AS w2_isat
						, COALESCE(SUM(m_2.xl), 0) AS w2_xl
						, COALESCE(SUM(m_2.tri), 0) AS w2_tri
						, COALESCE(SUM(m_2.smartfren), 0) AS w2_smartfren
						, COALESCE(SUM(m_2.axis), 0) AS w2_axis
						, COALESCE(SUM(m_2.other), 0) AS w2_other
						, COALESCE(SUM(m_2.total), 0) AS w2_total

						, COALESCE(SUM(m_3.telkomsel), 0) AS w3_telkomsel
						, COALESCE(SUM(m_3.isat), 0) AS w3_isat
						, COALESCE(SUM(m_3.xl), 0) AS w3_xl
						, COALESCE(SUM(m_3.tri), 0) AS w3_tri
						, COALESCE(SUM(m_3.smartfren), 0) AS w3_smartfren
						, COALESCE(SUM(m_3.axis), 0) AS w3_axis
						, COALESCE(SUM(m_3.other), 0) AS w3_other
						, COALESCE(SUM(m_3.total), 0) AS w3_total

						, COALESCE(SUM(m_4.telkomsel), 0) AS w4_telkomsel
						, COALESCE(SUM(m_4.isat), 0) AS w4_isat
						, COALESCE(SUM(m_4.xl), 0) AS w4_xl
						, COALESCE(SUM(m_4.tri), 0) AS w4_tri
						, COALESCE(SUM(m_4.smartfren), 0) AS w4_smartfren
						, COALESCE(SUM(m_4.axis), 0) AS w4_axis
						, COALESCE(SUM(m_4.other), 0) AS w4_other
						, COALESCE(SUM(m_4.total), 0) AS w4_total
				FROM
						fa_pjp p
						LEFT JOIN mb_merchandising_outlet m_1
								ON (p.id_tempat = m_1.id_outlet) AND (m_1.tgl BETWEEN "'.$this->w1_tgl_mulai.'" AND "'.$this->w1_tgl_selesai.'") AND (m_1.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_2
								ON (p.id_tempat = m_2.id_outlet) AND (m_2.tgl BETWEEN "'.$this->w2_tgl_mulai.'" AND "'.$this->w2_tgl_selesai.'") AND (m_2.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_3
								ON (p.id_tempat = m_3.id_outlet) AND (m_3.tgl BETWEEN "'.$this->w3_tgl_mulai.'" AND "'.$this->w3_tgl_selesai.'") AND (m_3.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_4
								ON (p.id_tempat = m_4.id_outlet) AND (m_4.tgl BETWEEN "'.$this->w4_tgl_mulai.'" AND "'.$this->w4_tgl_selesai.'") AND (m_4.id_jenis_share = "'.$id_jenis_share.'")
				WHERE (p.id_sales = "'.$id_sales.'")
				GROUP BY id_lokasi
			) xx
		');
	}

	var $fieldmap_daftar_9 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);
	var $column_order_9 = array(null,
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w3_total'
	);
	var $column_search_9 = array(
		'id_lokasi', 'kode_lokasi', 'nama_lokasi',
		'w1_telkomsel', 'w1_isat', 'w1_xl', 'w1_smartfren', 'w1_axis', 'w1_other', 'w1_smartfren', 'w1_total',
		'w2_telkomsel', 'w2_isat', 'w2_xl', 'w2_smartfren', 'w2_axis', 'w2_other', 'w2_smartfren', 'w2_total',
		'w3_telkomsel', 'w3_isat', 'w3_xl', 'w3_smartfren', 'w3_axis', 'w3_other', 'w3_smartfren', 'w3_total',
		'w4_telkomsel', 'w4_isat', 'w4_xl', 'w4_smartfren', 'w4_axis', 'w4_other', 'w4_smartfren', 'w4_total'
	);

	function build_query_daftar_9()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');
		$id_jenis_share = 'BACKDROP';

		$this->penjualan_tanggal($tgl);

		$this->db->select('xx.*');
		$this->db->from('
			(
				SELECT
						p.id_tempat AS id_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.id_digipos FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.no_npsn FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.no_npsn FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN "-"
									WHEN "POI" THEN "-"
									ELSE NULL
							END AS kode_lokasi
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = p.id_tempat))
									WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = p.id_tempat))
									ELSE NULL
							END AS nama_lokasi

						, COALESCE(case when sum(m_1.telkomsel) >= 1 then 1 else 0 end, 0) AS w1_telkomsel
						, COALESCE(SUM(m_1.isat), 0) AS w1_isat
						, COALESCE(SUM(m_1.xl), 0) AS w1_xl
						, COALESCE(SUM(m_1.tri), 0) AS w1_tri
						, COALESCE(SUM(m_1.smartfren), 0) AS w1_smartfren
						, COALESCE(SUM(m_1.axis), 0) AS w1_axis
						, COALESCE(SUM(m_1.other), 0) AS w1_other
						, COALESCE(case when sum(m_1.total) >= 1 then 1 else 0 end, 0) AS w1_total

						, COALESCE(case when sum(m_2.telkomsel) >= 1 then 1 else 0 end, 0) AS w2_telkomsel
						, COALESCE(SUM(m_2.isat), 0) AS w2_isat
						, COALESCE(SUM(m_2.xl), 0) AS w2_xl
						, COALESCE(SUM(m_2.tri), 0) AS w2_tri
						, COALESCE(SUM(m_2.smartfren), 0) AS w2_smartfren
						, COALESCE(SUM(m_2.axis), 0) AS w2_axis
						, COALESCE(SUM(m_2.other), 0) AS w2_other
						, COALESCE(case when sum(m_2.total) >= 1 then 1 else 0 end, 0) AS w2_total

						, COALESCE(case when sum(m_3.telkomsel) >= 1 then 1 else 0 end, 0) AS w3_telkomsel
						, COALESCE(SUM(m_3.isat), 0) AS w3_isat
						, COALESCE(SUM(m_3.xl), 0) AS w3_xl
						, COALESCE(SUM(m_3.tri), 0) AS w3_tri
						, COALESCE(SUM(m_3.smartfren), 0) AS w3_smartfren
						, COALESCE(SUM(m_3.axis), 0) AS w3_axis
						, COALESCE(SUM(m_3.other), 0) AS w3_other
						, COALESCE(case when sum(m_3.total) >= 1 then 1 else 0 end, 0) AS w3_total

						, COALESCE(case when sum(m_4.telkomsel) >= 1 then 1 else 0 end, 0) AS w4_telkomsel
						, COALESCE(SUM(m_4.isat), 0) AS w4_isat
						, COALESCE(SUM(m_4.xl), 0) AS w4_xl
						, COALESCE(SUM(m_4.tri), 0) AS w4_tri
						, COALESCE(SUM(m_4.smartfren), 0) AS w4_smartfren
						, COALESCE(SUM(m_4.axis), 0) AS w4_axis
						, COALESCE(SUM(m_4.other), 0) AS w4_other
						, COALESCE(case when sum(m_4.total) >= 1 then 1 else 0 end, 0) AS w4_total
				FROM
						fa_pjp p
						LEFT JOIN mb_merchandising_outlet m_1
								ON (p.id_tempat = m_1.id_outlet) AND (m_1.tgl BETWEEN "'.$this->w1_tgl_mulai.'" AND "'.$this->w1_tgl_selesai.'") AND (m_1.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_2
								ON (p.id_tempat = m_2.id_outlet) AND (m_2.tgl BETWEEN "'.$this->w2_tgl_mulai.'" AND "'.$this->w2_tgl_selesai.'") AND (m_2.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_3
								ON (p.id_tempat = m_3.id_outlet) AND (m_3.tgl BETWEEN "'.$this->w3_tgl_mulai.'" AND "'.$this->w3_tgl_selesai.'") AND (m_3.id_jenis_share = "'.$id_jenis_share.'")
						LEFT JOIN mb_merchandising_outlet m_4
								ON (p.id_tempat = m_4.id_outlet) AND (m_4.tgl BETWEEN "'.$this->w4_tgl_mulai.'" AND "'.$this->w4_tgl_selesai.'") AND (m_4.id_jenis_share = "'.$id_jenis_share.'")
				WHERE (p.id_sales = "'.$id_sales.'")
				GROUP BY id_lokasi
			) xx
		');
	}

	var $fieldmap_daftar_10 = array();
	var $column_order_10 = array();
	var $column_search_10 = array();

	function build_query_daftar_10()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');

		$this->penjualan_tanggal($tgl);

		$select = ''; $selectx = ''; $from = ''; $where = ''; $order_by = '';
		$select_w1 = ''; $select_w2 = ''; $select_w3 = ''; $select_w4 = '';
		$select_w1x = ''; $select_w2x = ''; $select_w3x = ''; $select_w4x = '';

		$arr_w1 = array(); $arr_w2 = array(); $arr_w3 = array(); $arr_w4 = array();


		if ($this->w1_tahun !== 0)
		{
			$this->db->select('
				a.id_jenis
				, b.nama_jenis
			');
			$this->db->from('nb_promotion_jenis_weekly a');
			$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
			$this->db->where('a.tahun', $this->w1_tahun);
			$this->db->where('a.bulan', $this->w1_bulan);
			$this->db->where('a.minggu', $this->w1_minggu);
			$rs = $this->db->get()->result_array();

			for ($a=0; $a<count($rs); $a++)
			{
				$id_jenis = $rs[$a]['id_jenis'] ? $rs[$a]['id_jenis'] : 0;
				$arr_w1[] = $rs[$a]['id_jenis'];

				$select_w1x .= '
					, xx.program_w1_'.$a.'
				';

				$select_w1 .= '
					, (
								SELECT
										COUNT(xp.id_promotion)
								FROM
										nc_promotion_outlet xp
										INNER JOIN nb_promotion_jenis_weekly xj
												ON (xp.id_jenis_weekly = xj.id_jenis_weekly)
								WHERE (xp.id_outlet = p.id_tempat
										AND xp.tgl BETWEEN "'.$this->w1_tgl_mulai.'" AND "'.$this->w1_tgl_selesai.'"
										AND xp.created_by = p.id_sales
										AND xj.id_jenis = "'.$id_jenis.'")
						) AS program_w1_'.$a.'
				';
			}
		}

		if ($this->w2_tahun !== 0)
		{
			$this->db->select('
				a.id_jenis
				, b.nama_jenis
			');
			$this->db->from('nb_promotion_jenis_weekly a');
			$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
			$this->db->where('a.tahun', $this->w2_tahun);
			$this->db->where('a.bulan', $this->w2_bulan);
			$this->db->where('a.minggu', $this->w2_minggu);
			$rs = $this->db->get()->result_array();

			for ($a=0; $a<count($rs); $a++)
			{
				$id_jenis = $rs[$a]['id_jenis'] ? $rs[$a]['id_jenis'] : 0;
				$arr_w2[] = $rs[$a]['id_jenis'];

				$select_w2x .= '
					, xx.program_w2_'.$a.'
				';

				$select_w2 .= '
					, (
								SELECT
										COUNT(xp.id_promotion)
								FROM
										nc_promotion_outlet xp
										INNER JOIN nb_promotion_jenis_weekly xj
												ON (xp.id_jenis_weekly = xj.id_jenis_weekly)
								WHERE (xp.id_outlet = p.id_tempat
										AND xp.tgl BETWEEN "'.$this->w2_tgl_mulai.'" AND "'.$this->w2_tgl_selesai.'"
										AND xp.created_by = p.id_sales
										AND xj.id_jenis = "'.$id_jenis.'")
						) AS program_w2_'.$a.'
				';
			}
		}

		if ($this->w3_tahun !== 0)
		{
			$this->db->select('
				a.id_jenis
				, b.nama_jenis
			');
			$this->db->from('nb_promotion_jenis_weekly a');
			$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
			$this->db->where('a.tahun', $this->w3_tahun);
			$this->db->where('a.bulan', $this->w3_bulan);
			$this->db->where('a.minggu', $this->w3_minggu);
			$rs = $this->db->get()->result_array();

			for ($a=0; $a<count($rs); $a++)
			{
				$id_jenis = $rs[$a]['id_jenis'] ? $rs[$a]['id_jenis'] : 0;
				$arr_w3[] = $rs[$a]['id_jenis'];

				$select_w3x .= '
					, xx.program_w3_'.$a.'
				';

				$select_w3 .= '
					, (
								SELECT
										COUNT(xp.id_promotion)
								FROM
										nc_promotion_outlet xp
										INNER JOIN nb_promotion_jenis_weekly xj
												ON (xp.id_jenis_weekly = xj.id_jenis_weekly)
								WHERE (xp.id_outlet = p.id_tempat
										AND xp.tgl BETWEEN "'.$this->w3_tgl_mulai.'" AND "'.$this->w3_tgl_selesai.'"
										AND xp.created_by = p.id_sales
										AND xj.id_jenis = "'.$id_jenis.'")
						) AS program_w3_'.$a.'
				';
			}
		}

		if ($this->w4_tahun !== 0)
		{
			$this->db->select('
				a.id_jenis
				, b.nama_jenis
			');
			$this->db->from('nb_promotion_jenis_weekly a');
			$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
			$this->db->where('a.tahun', $this->w4_tahun);
			$this->db->where('a.bulan', $this->w4_bulan);
			$this->db->where('a.minggu', $this->w4_minggu);
			$rs = $this->db->get()->result_array();

			for ($a=0; $a<count($rs); $a++)
			{
				$id_jenis = $rs[$a]['id_jenis'] ? $rs[$a]['id_jenis'] : 0;
				$arr_w4[] = $rs[$a]['id_jenis'];

				$select_w4x .= '
					, xx.program_w4_'.$a.'
				';

				$select_w4 .= '
					, (
								SELECT
										COUNT(xp.id_promotion)
								FROM
										nc_promotion_outlet xp
										INNER JOIN nb_promotion_jenis_weekly xj
												ON (xp.id_jenis_weekly = xj.id_jenis_weekly)
								WHERE (xp.id_outlet = p.id_tempat
										AND xp.tgl BETWEEN "'.$this->w4_tgl_mulai.'" AND "'.$this->w4_tgl_selesai.'"
										AND xp.created_by = p.id_sales
										AND xj.id_jenis = "'.$id_jenis.'")
						) AS program_w4_'.$a.'
				';
			}
		}

		$select .= '
			SELECT
					p.id_tempat AS id_lokasi
					, CASE p.id_jenis_lokasi
								WHEN "OUT" THEN (SELECT a.id_digipos FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
								WHEN "SEK" THEN (SELECT a.no_npsn FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
								WHEN "KAM" THEN (SELECT a.no_npsn FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
								WHEN "FAK" THEN "-"
								WHEN "POI" THEN "-"
								ELSE NULL
						END AS kode_lokasi
					, CASE p.id_jenis_lokasi
								WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
								WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
								WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
								WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = p.id_tempat))
								WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = p.id_tempat))
								ELSE NULL
						END AS nama_lokasi
		';

		$selectx .= 'xx.id_lokasi, xx.kode_lokasi, xx.nama_lokasi';

		$from .= '
			FROM
					fa_pjp p
		';

		$where .= '
			WHERE (p.id_sales = "'.$id_sales.'")
		';

		// $order_by .= 'ORDER BY p.no_kunjungan ASC';
		$order_by .= '';

		$this->db->select($selectx.$select_w1x.$select_w2x.$select_w3x.$select_w4x);
		$this->db->from('('.$select.$select_w1.$select_w2.$select_w3.$select_w4.$from.$where.$order_by.') xx');
	}

	function daftar_program($id_sales, $tgl)
	{
		$this->penjualan_tanggal($tgl);

		$arr_w1 = array(); $arr_w2 = array(); $arr_w3 = array(); $arr_w4 = array();

		if ($this->w1_tahun !== 0)
		{
			$this->db->select('
				a.id_jenis
				, b.nama_jenis
			');
			$this->db->from('nb_promotion_jenis_weekly a');
			$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
			$this->db->where('a.tahun', $this->w1_tahun);
			$this->db->where('a.bulan', $this->w1_bulan);
			$this->db->where('a.minggu', $this->w1_minggu);
			$rs = $this->db->get()->result_array();

			for ($a=0; $a<count($rs); $a++)
			{
				$id_jenis = $rs[$a]['id_jenis'] ? $rs[$a]['id_jenis'] : 0;
				$arr_w1[] = $rs[$a]['id_jenis'];
			}
		}

		if ($this->w2_tahun !== 0)
		{
			$this->db->select('
				a.id_jenis
				, b.nama_jenis
			');
			$this->db->from('nb_promotion_jenis_weekly a');
			$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
			$this->db->where('a.tahun', $this->w2_tahun);
			$this->db->where('a.bulan', $this->w2_bulan);
			$this->db->where('a.minggu', $this->w2_minggu);
			$rs = $this->db->get()->result_array();

			for ($a=0; $a<count($rs); $a++)
			{
				$id_jenis = $rs[$a]['id_jenis'] ? $rs[$a]['id_jenis'] : 0;
				$arr_w2[] = $rs[$a]['id_jenis'];
			}
		}

		if ($this->w3_tahun !== 0)
		{
			$this->db->select('
				a.id_jenis
				, b.nama_jenis
			');
			$this->db->from('nb_promotion_jenis_weekly a');
			$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
			$this->db->where('a.tahun', $this->w3_tahun);
			$this->db->where('a.bulan', $this->w3_bulan);
			$this->db->where('a.minggu', $this->w3_minggu);
			$rs = $this->db->get()->result_array();

			for ($a=0; $a<count($rs); $a++)
			{
				$id_jenis = $rs[$a]['id_jenis'] ? $rs[$a]['id_jenis'] : 0;
				$arr_w3[] = $rs[$a]['id_jenis'];
			}
		}

		if ($this->w4_tahun !== 0)
		{
			$this->db->select('
				a.id_jenis
				, b.nama_jenis
			');
			$this->db->from('nb_promotion_jenis_weekly a');
			$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
			$this->db->where('a.tahun', $this->w4_tahun);
			$this->db->where('a.bulan', $this->w4_bulan);
			$this->db->where('a.minggu', $this->w4_minggu);
			$rs = $this->db->get()->result_array();

			for ($a=0; $a<count($rs); $a++)
			{
				$id_jenis = $rs[$a]['id_jenis'] ? $rs[$a]['id_jenis'] : 0;
				$arr_w4[] = $rs[$a]['id_jenis'];
			}
		}

		$this->arr_w1 = $arr_w1;
		$this->arr_w2 = $arr_w2;
		$this->arr_w3 = $arr_w3;
		$this->arr_w4 = $arr_w4;

		return array(
			"week1" => $arr_w1,
			"week2" => $arr_w2,
			"week3" => $arr_w3,
			"week4" => $arr_w4
		);
	}

	function list_program_w1($tgl)
	{
		$this->penjualan_tanggal($tgl);

		$this->db->select('
			a.id_jenis
			, b.nama_jenis
		');
		$this->db->from('nb_promotion_jenis_weekly a');
		$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
		$this->db->where('a.tahun', $this->w1_tahun);
		$this->db->where('a.bulan', $this->w1_bulan);
		$this->db->where('a.minggu', $this->w1_minggu);

		$result = $this->db->get();

		return $result->result();
	}

	function list_program_w2($tgl)
	{
		$this->penjualan_tanggal($tgl);

		$this->db->select('
			a.id_jenis
			, b.nama_jenis
		');
		$this->db->from('nb_promotion_jenis_weekly a');
		$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
		$this->db->where('a.tahun', $this->w2_tahun);
		$this->db->where('a.bulan', $this->w2_bulan);
		$this->db->where('a.minggu', $this->w2_minggu);

		$result = $this->db->get();

		return $result->result();
	}

	function list_program_w3($tgl)
	{
		$this->penjualan_tanggal($tgl);

		$this->db->select('
			a.id_jenis
			, b.nama_jenis
		');
		$this->db->from('nb_promotion_jenis_weekly a');
		$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
		$this->db->where('a.tahun', $this->w3_tahun);
		$this->db->where('a.bulan', $this->w3_bulan);
		$this->db->where('a.minggu', $this->w3_minggu);

		$result = $this->db->get();

		return $result->result();
	}

	function list_program_w4($tgl)
	{
		$this->penjualan_tanggal($tgl);

		$this->db->select('
			a.id_jenis
			, b.nama_jenis
		');
		$this->db->from('nb_promotion_jenis_weekly a');
		$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
		$this->db->where('a.tahun', $this->w4_tahun);
		$this->db->where('a.bulan', $this->w4_bulan);
		$this->db->where('a.minggu', $this->w4_minggu);

		$result = $this->db->get();

		return $result->result();
	}

	var $fieldmap_daftar_11 = array('no_nota', 'pembayaran', 'total_perdana', 'total_linkaja', 'total_penjualan', 'setoran', 'status_setoran');
	var $column_order_11 = array(null, 'no_nota', 'pembayaran', 'total_perdana', 'total_linkaja', 'total_penjualan', 'setoran', 'status_setoran');
	var $column_search_11 = array('no_nota', 'pembayaran', 'total_perdana', 'total_linkaja', 'total_penjualan', 'setoran', 'status_setoran');

	function build_query_daftar_11()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');

		$this->db->select('
			xx.no_nota
			, xx.tgl_transaksi
			, xx.pembayaran
			, xx.total_perdana
			, xx.total_linkaja
			, xx.total_penjualan
			, xx.setoran
			, xx.status_setoran
		');
		$this->db->from('
			(
				SELECT
						p.no_nota
						, p.tgl_transaksi
						, p.pembayaran
						, COALESCE(SUM(pd.harga_jual), 0) AS total_perdana
						, p.link_aja AS total_linkaja
						, COALESCE(SUM(pd.harga_jual), 0) + p.link_aja AS total_penjualan
						, p.setoran
						, IF (p.setoran = COALESCE(SUM(pd.harga_jual), 0) + COALESCE(SUM(p.link_aja), 0), "<span class=\'badge badge-success badge-pill\'>Complete</span>", "<span class=\'badge badge-warning badge-pill\'>Not Complete</span>") status_setoran
				FROM
						jd_penjualan_detail pd
						INNER JOIN jc_penjualan p
								ON (pd.no_nota = p.no_nota)
				WHERE (p.tgl_transaksi = "'.$tgl.'"
						AND p.id_sales = "'.$id_sales.'")
				GROUP BY p.no_nota, p.tgl_transaksi, p.pembayaran
			) xx
		');
	}

	function get_data_penjualan($nota=0)
	{
		$this->db->select('
			pj.no_nota
			, sl.nama_sales
			, DATE_FORMAT(pj.tgl_transaksi, "%d/%m/%Y") AS tanggal
			, jl.nama_jenis_lokasi
			, CASE pj.id_jenis_lokasi
						WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = pj.id_lokasi))
						WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = pj.id_lokasi))
						WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = pj.id_lokasi))
						WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = pj.id_lokasi))
						WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = pj.id_lokasi))
						ELSE NULL
				END AS nama_lokasi
			, pj.nama_pembeli
			, pj.no_hp_pembeli
			, pj.pembayaran
			, pj.link_aja
		');
    $this->db->from('jc_penjualan pj');
    $this->db->join('db_sales sl', 'pj.id_sales = sl.id_sales');
    $this->db->join('ea_jenis_lokasi jl', 'pj.id_jenis_lokasi = jl.id_jenis_lokasi');
    $this->db->where('pj.no_nota', $nota);
		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_penjualan($id=0)
	{
		$this->db->select('
			pd.nama_produk
			, pjd.harga_jual
			, COUNT(pjd.id_penjualan_detail) AS jml_jual
			, (pjd.harga_jual * COUNT(pjd.id_penjualan_detail)) AS total
		');
    $this->db->from('jd_penjualan_detail pjd');
    $this->db->join('gb_produk pd', 'pjd.id_produk = pd.id_produk');
		$this->db->where('pjd.no_nota', $id);
		$this->db->group_by('pd.nama_produk, pjd.harga_jual');

		$result = $this->db->get();

		return $result->result();
	}

	function get_list_penjualan_perdana()
	{
		$id = $this->input->post('id') ? strtoupper($this->input->post('id')) : 0;
		$produk = $this->input->post('produk') ? strtoupper($this->input->post('produk')) : NULL;
		$sn = $this->input->post('sn') ? strtoupper($this->input->post('sn')) : NULL;

		$this->db->select('
			xx.id_produk
			, xx.nama_produk
			, xx.qty
			, xx.serial_number
		');
		$this->db->from("
			(
				SELECT DISTINCT
						pd.id_produk
						, p.nama_produk
						, COUNT(pd.id_penjualan_detail) AS qty
						, (
									SELECT
											GROUP_CONCAT(xpd.serial_number SEPARATOR ',')
									FROM
											jd_penjualan_detail xpd
									WHERE (xpd.no_nota = pd.no_nota
											AND xpd.serial_number LIKE '%".$sn."%')
							) AS serial_number
				FROM
						jd_penjualan_detail pd
						INNER JOIN gb_produk p
								ON (pd.id_produk = p.id_produk)
				WHERE (pd.no_nota = '".$id."'
					AND (UPPER(pd.id_produk) LIKE '%".$produk."%' OR UPPER(p.nama_produk) LIKE '%".$produk."%')
					AND UPPER(pd.serial_number) LIKE '%".$sn."%')
			) xx
		");

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_data_kunjungan_lokasi()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$tgl = $this->input->post('tgl') ? prepare_date($this->input->post('tgl')) : date('Y-m-d');

		$this->db->select('
			xx.jumlah
			, xx.dikunjungi
			, (xx.jumlah - xx.dikunjungi) AS tdk_dikunjungi
		');
		$this->db->from('
			(
				SELECT
						COUNT(d.id_daftar_pjp) AS jumlah
						, (
								SELECT
										COUNT(h.id_history_pjp)
								FROM
										fb_histroy_pjp h
								WHERE (h.id_sales = d.id_sales
										AND h.tanggal = d.tanggal
										AND h.jam_clock_in <> "00:00:00"
										AND h.jam_clock_out <> "00:00:00")
							)  AS dikunjungi
				FROM
						fe_daftar_pjp d
				WHERE (d.id_sales = "'.$id_sales.'"
						AND d.tanggal = "'.$tgl.'")
			) xx
		');

    $result = $this->db->get();

    return $result->row_array();
	}

	function get_data_total_penjualan()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$tgl = $this->input->post('tgl') ? prepare_date($this->input->post('tgl')) : date('Y-m-d');

		$this->db->select('
			xx.lunas
			, xx.konsinyasi
			, xx.total
			, xx.link_aja
		');
		$this->db->from('
			(
				SELECT
							(
									SELECT
											COALESCE(SUM(xpd.harga_jual), 0)
									FROM
											jd_penjualan_detail xpd
											INNER JOIN jc_penjualan xp
													ON (xpd.no_nota = xp.no_nota)
									WHERE (xp.id_sales = p.id_sales
											AND xp.tgl_transaksi = p.tgl_transaksi
											AND xp.pembayaran = "LUNAS")
							) AS lunas
						, (
									SELECT
											COALESCE(SUM(xpd.harga_jual), 0)
									FROM
											jd_penjualan_detail xpd
											INNER JOIN jc_penjualan xp
													ON (xpd.no_nota = xp.no_nota)
									WHERE (xp.id_sales = p.id_sales
											AND xp.tgl_transaksi = p.tgl_transaksi
											AND xp.pembayaran = "KONSINYASI")
								) AS konsinyasi
							, (
									SELECT
											COALESCE(SUM(xpd.harga_jual), 0)
									FROM
											jd_penjualan_detail xpd
											INNER JOIN jc_penjualan xp
													ON (xpd.no_nota = xp.no_nota)
									WHERE (xp.id_sales = p.id_sales
											AND xp.tgl_transaksi = p.tgl_transaksi)
								) AS total
							, COALESCE(SUM(p.link_aja), 0) AS link_aja
				FROM
						jc_penjualan p
				WHERE (p.id_sales = "'.$id_sales.'"
						AND p.tgl_transaksi = "'.$tgl.'")
			) xx
		');

    $result = $this->db->get();

    return $result->row_array();
	}

	function get_data_briefing_komitmen($id_sales, $tgl)
  {
    $this->db->select('*');
		$this->db->from('pa_briefing');
		$this->db->where('id_sales', $id_sales);
		$this->db->where('tgl', $tgl);
    $result = $this->db->get()->row_array();

    return $result;
  }

	function save_data()
  {
    $this->db->trans_begin();
    try {

			$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
			$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : NULL;
			$coverage_pagi = $this->input->post('coverage_pagi') ? $this->input->post('coverage_pagi') : NULL;
			$distribution_pagi = $this->input->post('distribution_pagi') ? $this->input->post('distribution_pagi') : NULL;
			$merchandising_pagi = $this->input->post('merchandising_pagi') ? $this->input->post('merchandising_pagi') : NULL;
			$promotion_pagi = $this->input->post('promotion_pagi') ? $this->input->post('promotion_pagi') : NULL;
			$issue_pagi = $this->input->post('issue_pagi') ? $this->input->post('issue_pagi') : NULL;
			$need_support_pagi = $this->input->post('need_support_pagi') ? $this->input->post('need_support_pagi') : NULL;

			$coverage_sore = $this->input->post('coverage_sore') ? $this->input->post('coverage_sore') : NULL;
			$distribution_sore = $this->input->post('distribution_sore') ? $this->input->post('distribution_sore') : NULL;
			$merchandising_sore = $this->input->post('merchandising_sore') ? $this->input->post('merchandising_sore') : NULL;
			$promotion_sore = $this->input->post('promotion_sore') ? $this->input->post('promotion_sore') : NULL;
			$issue_sore = $this->input->post('issue_sore') ? $this->input->post('issue_sore') : NULL;
			$need_support_sore = $this->input->post('need_support_sore') ? $this->input->post('need_support_sore') : NULL;

			$this->db->select('1');
			$this->db->from('pa_briefing');
			$this->db->where('id_sales', $id_sales);
			$this->db->where('tgl', $tgl);
			$rs = $this->db->get()->row_array();

			if ($rs)
			{
				$data_x = array(
					'id_sales' => $id_sales,
					'tgl' => $tgl,
					'coverage_pagi' => $coverage_pagi,
					'distribution_pagi' => $distribution_pagi,
					'merchandising_pagi' => $merchandising_pagi,
					'promotion_pagi' => $promotion_pagi,
					'issue_pagi' => $issue_pagi,
					'need_support_pagi' => $need_support_pagi,
					'coverage_sore' => $coverage_sore,
					'distribution_sore' => $distribution_sore,
					'merchandising_sore' => $merchandising_sore,
					'promotion_sore' => $promotion_sore,
					'issue_sore' => $issue_sore,
					'need_support_sore' => $need_support_sore
				);

				$this->db->where('id_sales', $id_sales);
				$this->db->where('tgl', $tgl);
				$this->db->update('pa_briefing', $data_x);
				$this->check_trans_status('update pa_briefing failed');
			}
			else
			{
				$data_x = array(
					'id_sales' => $id_sales,
					'tgl' => $tgl,
					'coverage_pagi' => $coverage_pagi,
					'distribution_pagi' => $distribution_pagi,
					'merchandising_pagi' => $merchandising_pagi,
					'promotion_pagi' => $promotion_pagi,
					'issue_pagi' => $issue_pagi,
					'need_support_pagi' => $need_support_pagi,
					'coverage_sore' => $coverage_sore,
					'distribution_sore' => $distribution_sore,
					'merchandising_sore' => $merchandising_sore,
					'promotion_sore' => $promotion_sore,
					'issue_sore' => $issue_sore,
					'need_support_sore' => $need_support_sore
				);

				$this->db->insert('pa_briefing', $data_x);
				$this->check_trans_status('insert pa_briefing failed');
			}

    }
    catch(Exception $e){
      // TODO : log error to file
    }

    if ($this->db->trans_status() === FALSE)
    {
      $this->id = NULL;
			$this->nomor = NULL;
      $this->last_error_message = $this->db->error();
      $this->db->trans_rollback();
      return FALSE;
    }

    $this->db->trans_commit();

    return TRUE;
  }
}
?>