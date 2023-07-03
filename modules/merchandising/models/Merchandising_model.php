<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchandising_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	var $fieldmap_daftar_1 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_order_1 = array(null,
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_search_1 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);

	function build_query_daftar_1()
	{
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : '';
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('
			xx.nama
			, xx.telkomsel
			, xx.isat
			, xx.xl
			, xx.tri
			, xx.smartfren
			, xx.axis
			, xx.other
			, xx.total
			, (xx.telkomsel / xx.total) * 100 AS telkomsel_persen
			, (xx.isat / xx.total) * 100 AS isat_persen
			, (xx.xl / xx.total) * 100 AS xl_persen
			, (xx.tri / xx.total) * 100 AS tri_persen
			, (xx.smartfren / xx.total) * 100 AS smartfren_persen
			, (xx.axis / xx.total) * 100 AS axis_persen
			, (xx.other / xx.total) * 100 AS other_persen
			, xx.total_persen
			, xx.m_1
			, xx.m_2
			, xx.w_1
			, xx.w_2
		');
		$this->db->from('
			(
					SELECT
							r.nama_regional AS nama
							, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
							, COALESCE(SUM(m.isat), 0) AS isat
							, COALESCE(SUM(m.xl), 0) AS xl
							, COALESCE(SUM(m.tri), 0) AS tri
							, COALESCE(SUM(m.smartfren), 0) AS smartfren
							, COALESCE(SUM(m.axis), 0) AS axis
							, COALESCE(SUM(m.other), 0) AS other
							, COALESCE(SUM(m.total), 0) AS total
							, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
							, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
							, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
							, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
							, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
							, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
							, COALESCE(SUM(m.other_persen), 0) AS other_persen
							, COALESCE(MAX(m.total_persen), 0) AS total_persen
							, COALESCE(SUM(m.m_1), 0) AS m_1
							, COALESCE(SUM(m.m_2), 0) AS m_2
							, COALESCE(SUM(m.w_1), 0) AS w_1
							, COALESCE(SUM(m.w_2), 0) AS w_2
					FROM
							mf_merchandising_res_regional m
							INNER JOIN ba_regional r
									ON (m.id_regional = r.id_regional)
					WHERE (m.tahun = "'.$tahun.'"
							AND m.bulan = "'.$bulan.'"
							AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
							AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
							AND m.id_jenis_share = "'.$jenis_share.'")
					GROUP BY r.nama_regional
			) xx
		');
	}

	var $fieldmap_daftar_2 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_order_2 = array(null,
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_search_2 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);

	function build_query_daftar_2()
	{
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : '';
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('
			xx.nama
			, xx.telkomsel
			, xx.isat
			, xx.xl
			, xx.tri
			, xx.smartfren
			, xx.axis
			, xx.other
			, xx.total
			, (xx.telkomsel / xx.total) * 100 AS telkomsel_persen
			, (xx.isat / xx.total) * 100 AS isat_persen
			, (xx.xl / xx.total) * 100 AS xl_persen
			, (xx.tri / xx.total) * 100 AS tri_persen
			, (xx.smartfren / xx.total) * 100 AS smartfren_persen
			, (xx.axis / xx.total) * 100 AS axis_persen
			, (xx.other / xx.total) * 100 AS other_persen
			, xx.total_persen
			, xx.m_1
			, xx.m_2
			, xx.w_1
			, xx.w_2
		');
		$this->db->from('
			(
					SELECT
							b.nama_branch AS nama
							, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
							, COALESCE(SUM(m.isat), 0) AS isat
							, COALESCE(SUM(m.xl), 0) AS xl
							, COALESCE(SUM(m.tri), 0) AS tri
							, COALESCE(SUM(m.smartfren), 0) AS smartfren
							, COALESCE(SUM(m.axis), 0) AS axis
							, COALESCE(SUM(m.other), 0) AS other
							, COALESCE(SUM(m.total), 0) AS total
							, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
							, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
							, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
							, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
							, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
							, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
							, COALESCE(SUM(m.other_persen), 0) AS other_persen
							, COALESCE(MAX(m.total_persen), 0) AS total_persen
							, COALESCE(SUM(m.m_1), 0) AS m_1
							, COALESCE(SUM(m.m_2), 0) AS m_2
							, COALESCE(SUM(m.w_1), 0) AS w_1
							, COALESCE(SUM(m.w_2), 0) AS w_2
					FROM
							mg_merchandising_res_branch m
							INNER JOIN bb_branch b
									ON (m.id_branch = b.id_branch)
					WHERE (m.tahun = "'.$tahun.'"
							AND m.bulan = "'.$bulan.'"
							AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
							AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
							AND m.id_jenis_share = "'.$jenis_share.'"
							AND m.id_branch LIKE "'.'%'.$pilihan.'%'.'")
					GROUP BY b.nama_branch
			) xx
		');
	}

	var $fieldmap_daftar_3 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_order_3 = array(null,
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_search_3 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);

	function build_query_daftar_3()
	{
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : '';
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('
			xx.nama
			, xx.telkomsel
			, xx.isat
			, xx.xl
			, xx.tri
			, xx.smartfren
			, xx.axis
			, xx.other
			, xx.total
			, (xx.telkomsel / xx.total) * 100 AS telkomsel_persen
			, (xx.isat / xx.total) * 100 AS isat_persen
			, (xx.xl / xx.total) * 100 AS xl_persen
			, (xx.tri / xx.total) * 100 AS tri_persen
			, (xx.smartfren / xx.total) * 100 AS smartfren_persen
			, (xx.axis / xx.total) * 100 AS axis_persen
			, (xx.other / xx.total) * 100 AS other_persen
			, xx.total_persen
			, xx.m_1
			, xx.m_2
			, xx.w_1
			, xx.w_2
		');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								c.nama_cluster AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								mh_merchandising_res_cluster m
								INNER JOIN bc_cluster c
										ON (m.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY c.nama_cluster
				) xx
			');
		}
		else
		{
			$this->db->from('
				(
						SELECT
								c.nama_cluster AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								mh_merchandising_res_cluster m
								INNER JOIN bc_cluster c
										ON (m.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND m.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY c.nama_cluster
				) xx
			');
		}
	}

	var $fieldmap_daftar_4 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_order_4 = array(null,
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_search_4 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);

	function build_query_daftar_4()
	{
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : '';
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('
			xx.nama
			, xx.telkomsel
			, xx.isat
			, xx.xl
			, xx.tri
			, xx.smartfren
			, xx.axis
			, xx.other
			, xx.total
			, (xx.telkomsel / xx.total) * 100 AS telkomsel_persen
			, (xx.isat / xx.total) * 100 AS isat_persen
			, (xx.xl / xx.total) * 100 AS xl_persen
			, (xx.tri / xx.total) * 100 AS tri_persen
			, (xx.smartfren / xx.total) * 100 AS smartfren_persen
			, (xx.axis / xx.total) * 100 AS axis_persen
			, (xx.other / xx.total) * 100 AS other_persen
			, xx.total_persen
			, xx.m_1
			, xx.m_2
			, xx.w_1
			, xx.w_2
		');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								kb.nama_kabupaten AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								mk_merchandising_res_kabupaten m
								INNER JOIN cb_kabupaten kb
										ON (m.id_kabupaten = kb.id_kabupaten)
								INNER JOIN cc_kecamatan kc
										ON (kb.id_kabupaten = kc.id_kabupaten)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY kb.nama_kabupaten
				) xx
			');
		}
		else
		{
			$this->db->from('
				(
						SELECT
								kb.nama_kabupaten AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								mk_merchandising_res_kabupaten m
								INNER JOIN cb_kabupaten kb
										ON (m.id_kabupaten = kb.id_kabupaten)
								INNER JOIN cc_kecamatan kc
										ON (kb.id_kabupaten = kc.id_kabupaten)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND kc.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY kb.nama_kabupaten
				) xx
			');
		}
	}

	var $fieldmap_daftar_5 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_order_5 = array(null,
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_search_5 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);

	function build_query_daftar_5()
	{
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : '';
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('
			xx.nama
			, xx.telkomsel
			, xx.isat
			, xx.xl
			, xx.tri
			, xx.smartfren
			, xx.axis
			, xx.other
			, xx.total
			, (xx.telkomsel / xx.total) * 100 AS telkomsel_persen
			, (xx.isat / xx.total) * 100 AS isat_persen
			, (xx.xl / xx.total) * 100 AS xl_persen
			, (xx.tri / xx.total) * 100 AS tri_persen
			, (xx.smartfren / xx.total) * 100 AS smartfren_persen
			, (xx.axis / xx.total) * 100 AS axis_persen
			, (xx.other / xx.total) * 100 AS other_persen
			, xx.total_persen
			, xx.m_1
			, xx.m_2
			, xx.w_1
			, xx.w_2
		');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								kc.nama_kecamatan AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								ml_merchandising_res_kecamatan m
								INNER JOIN cc_kecamatan kc
										ON (m.id_kecamatan = kc.id_kecamatan)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY kc.nama_kecamatan
				) xx
			');
		}
		else
		{
			$this->db->from('
				(
						SELECT
								kc.nama_kecamatan AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								ml_merchandising_res_kecamatan m
								INNER JOIN cc_kecamatan kc
										ON (m.id_kecamatan = kc.id_kecamatan)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND kc.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY kc.nama_kecamatan
				) xx
			');
		}
	}

	var $fieldmap_daftar_6 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_order_6 = array(null,
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_search_6 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);

	function build_query_daftar_6()
	{
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : '';
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('
			xx.nama
			, xx.telkomsel
			, xx.isat
			, xx.xl
			, xx.tri
			, xx.smartfren
			, xx.axis
			, xx.other
			, xx.total
			, (xx.telkomsel / xx.total) * 100 AS telkomsel_persen
			, (xx.isat / xx.total) * 100 AS isat_persen
			, (xx.xl / xx.total) * 100 AS xl_persen
			, (xx.tri / xx.total) * 100 AS tri_persen
			, (xx.smartfren / xx.total) * 100 AS smartfren_persen
			, (xx.axis / xx.total) * 100 AS axis_persen
			, (xx.other / xx.total) * 100 AS other_persen
			, xx.total_persen
			, xx.m_1
			, xx.m_2
			, xx.w_1
			, xx.w_2
		');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								t.nama_tap AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								mi_merchandising_res_tap m
								INNER JOIN bd_tap t
										ON (m.id_tap = t.id_tap)
								INNER JOIN bc_cluster c
										ON (t.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY t.nama_tap
				) xx
			');
		}
		else if ($kategori == 'Cluster')
		{
			$this->db->from('
				(
						SELECT
								t.nama_tap AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								mi_merchandising_res_tap m
								INNER JOIN bd_tap t
										ON (m.id_tap = t.id_tap)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND t.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY t.nama_tap
				) xx
			');
		}
		else if ($kategori == 'TAP')
		{
			$this->db->from('
				(
						SELECT
								t.nama_tap AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								mi_merchandising_res_tap m
								INNER JOIN bd_tap t
										ON (m.id_tap = t.id_tap)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND m.id_tap LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY t.nama_tap
				) xx
			');
		}
	}

	var $fieldmap_daftar_7 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_order_7 = array(null,
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);
	var $column_search_7 = array(
		'nama',
		'telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total',
		'telkomsel_persen', 'isat_persen', 'xl_persen', 'tri_persen', 'smartfren_persen', 'axis_persen', 'other_persen', 'total_persen',
		'm_1', 'm_2'
	);

	function build_query_daftar_7()
	{
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : '';
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		if ($jenis_lokasi == 'OUT')
		{
			$jenis_sales = '"SSF", "SCS"';
		}
		else
		{
			$jenis_sales = '"SDS", "SCS"';
		}

		$this->db->select('
			xx.nama
			, xx.telkomsel
			, xx.isat
			, xx.xl
			, xx.tri
			, xx.smartfren
			, xx.axis
			, xx.other
			, xx.total
			, (xx.telkomsel / xx.total) * 100 AS telkomsel_persen
			, (xx.isat / xx.total) * 100 AS isat_persen
			, (xx.xl / xx.total) * 100 AS xl_persen
			, (xx.tri / xx.total) * 100 AS tri_persen
			, (xx.smartfren / xx.total) * 100 AS smartfren_persen
			, (xx.axis / xx.total) * 100 AS axis_persen
			, (xx.other / xx.total) * 100 AS other_persen
			, xx.total_persen
			, xx.m_1
			, xx.m_2
			, xx.w_1
			, xx.w_2
		');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								s.nama_sales AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								mj_merchandising_res_sales m
								INNER JOIN db_sales s
										ON (m.id_sales = s.id_sales)
								INNER JOIN bd_tap t
										ON (s.id_tap = t.id_tap)
								INNER JOIN bc_cluster c
										ON (t.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'"
								AND s.id_jenis_sales IN ('.$jenis_sales.'))
						GROUP BY s.nama_sales
				) xx
			');
		}
		else if ($kategori == 'Cluster')
		{
			$this->db->from('
				(
						SELECT
								s.nama_sales AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								mj_merchandising_res_sales m
								INNER JOIN db_sales s
										ON (m.id_sales = s.id_sales)
								INNER JOIN bd_tap t
										ON (s.id_tap = t.id_tap)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND t.id_cluster LIKE "'.'%'.$pilihan.'%'.'"
								AND s.id_jenis_sales IN ('.$jenis_sales.'))
						GROUP BY s.nama_sales
				) xx
			');
		}
		else if ($kategori == 'TAP')
		{
			$this->db->from('
				(
						SELECT
								s.nama_sales AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
								, COALESCE(SUM(m.telkomsel_persen), 0) AS telkomsel_persen
								, COALESCE(SUM(m.isat_persen), 0) AS isat_persen
								, COALESCE(SUM(m.xl_persen), 0) AS xl_persen
								, COALESCE(SUM(m.tri_persen), 0) AS tri_persen
								, COALESCE(SUM(m.smartfren_persen), 0) AS smartfren_persen
								, COALESCE(SUM(m.axis_persen), 0) AS axis_persen
								, COALESCE(SUM(m.other_persen), 0) AS other_persen
								, COALESCE(MAX(m.total_persen), 0) AS total_persen
								, COALESCE(SUM(m.m_1), 0) AS m_1
								, COALESCE(SUM(m.m_2), 0) AS m_2
								, COALESCE(SUM(m.w_1), 0) AS w_1
								, COALESCE(SUM(m.w_2), 0) AS w_2
						FROM
								mj_merchandising_res_sales m
								INNER JOIN db_sales s
										ON (m.id_sales = s.id_sales)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_lokasi = "'.$jenis_lokasi.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND s.id_tap LIKE "'.'%'.$pilihan.'%'.'"
								AND s.id_jenis_sales IN ('.$jenis_sales.'))
						GROUP BY s.nama_sales
				) xx
			');
		}
	}
}
?>