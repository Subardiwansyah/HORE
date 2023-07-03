<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_list_program($tahun=0, $bulan=0, $minggu=0)
	{
		$this->db->select('
			a.id_jenis AS id
			, b.nama_jenis AS nama
		');
		$this->db->distinct();
		$this->db->from('nb_promotion_jenis_weekly a');
		$this->db->join('na_promotion_jenis b', 'a.id_jenis = b.id_jenis');
		$this->db->where('a.tahun', $tahun);
		$this->db->where('a.bulan', $bulan);
		$this->db->where('b.status', 'AKTIF');

		if ($minggu > 0)
		{
			$this->db->where('a.minggu LIKE "'.'%'.$minggu.'%'.'"');
		}

		$result = $this->db->get();

		return $result->result();
	}

	var $fieldmap_daftar_1 = array();
	var $column_order_1 = array();
	var $column_search_1 = array();

	function build_query_daftar_1()
	{
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;
		$program = $this->input->post('program') ? $this->input->post('program') : 0;

		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : 'OUT';

		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';

		$arr_program = '';

		if ($total_program > 0)
		{
			$arr_program = explode(',', $program);
		}

		$select_1 = '
			xx.id
			, xx.nama
		';

		$select_2 = '';
		for ($i=0; $i<$total_program; $i++)
		{
			$select_2 .= '
				, xx.program_'.$i.'
			';
		}

		$select_3 = '
			, xx.total
		';

		$from_1 = '
			SELECT
					rg.id_regional AS id
					, rg.nama_regional AS nama
		';

		$from_2 = '';

		for ($i=0; $i<$total_program; $i++)
		{
			$this->db->select('xx.xid');
			$this->db->from('
				(
						SELECT
								GROUP_CONCAT(id_jenis_weekly) AS xid
						FROM
								nb_promotion_jenis_weekly
						WHERE (tahun = "'.$tahun.'"
								AND bulan = "'.$bulan.'"
								AND minggu LIKE "'.'%'.$minggu.'%'.'"
								AND id_jenis = "'.$arr_program[$i].'")
				) xx
			');
			$rsx = $this->db->get()->row_array();
			$jenis_weekly = isset($rsx['xid']) ? $rsx['xid'] : 0;

			$from_2 .= '
					, (
								SELECT
										COALESCE(SUM(total), 0) AS total
								FROM
										ng_promotion_res_regional
								WHERE (id_jenis_lokasi = "'.$jenis_lokasi.'"
										AND id_jenis_weekly IN ('.$jenis_weekly.'))
						) AS program_'.$i.'
			';
		}

		$from_3 = '
					, (
								SELECT
										COALESCE(SUM(p.total), 0)
								FROM
										ng_promotion_res_regional p
										INNER JOIN nb_promotion_jenis_weekly j
												ON (p.id_jenis_weekly = j.id_jenis_weekly)
								WHERE (p.id_regional = rg.id_regional
										AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
										AND j.tahun = "'.$tahun.'"
										AND j.bulan = "'.$bulan.'"
										AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
						) AS total
			FROM
					ba_regional rg
		';

		$this->db->select($select_1.$select_2.$select_3);
		$this->db->from('('.$from_1.$from_2.$from_3.') xx');
	}

	var $fieldmap_daftar_2 = array();
	var $column_order_2 = array();
	var $column_search_2 = array();

	function build_query_daftar_2()
	{
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;
		$program = $this->input->post('program') ? $this->input->post('program') : 0;

		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : 'OUT';

		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';

		$arr_program = '';

		if ($total_program > 0)
		{
			$arr_program = explode(',', $program);
		}

		$select_1 = '
			xx.id
			, xx.nama
		';

		$select_2 = '';
		for ($i=0; $i<$total_program; $i++)
		{
			$select_2 .= '
				, xx.program_'.$i.'
			';
		}

		$select_3 = '
			, xx.total
		';

		$from_1 = '
			SELECT
					br.id_branch AS id
					, br.nama_branch AS nama
		';

		$from_2 = '';

		for ($i=0; $i<$total_program; $i++)
		{
			$this->db->select('xx.xid');
			$this->db->from('
				(
						SELECT
								GROUP_CONCAT(id_jenis_weekly) AS xid
						FROM
								nb_promotion_jenis_weekly
						WHERE (tahun = "'.$tahun.'"
								AND bulan = "'.$bulan.'"
								AND minggu LIKE "'.'%'.$minggu.'%'.'"
								AND id_jenis = "'.$arr_program[$i].'")
				) xx
			');
			$rsx = $this->db->get()->row_array();
			$jenis_weekly = isset($rsx['xid']) ? $rsx['xid'] : 0;

			$from_2 .= '
					, (
								SELECT
										COALESCE(SUM(p.total), 0) AS total
								FROM
										nh_promotion_res_branch p
								WHERE (p.id_jenis_lokasi = "'.$jenis_lokasi.'"
										AND p.id_branch = br.id_branch
										AND p.id_jenis_weekly IN ('.$jenis_weekly.'))
						) AS program_'.$i.'
			';
		}

		$from_3 = '
					, (
								SELECT
										COALESCE(SUM(p.total), 0)
								FROM
										nh_promotion_res_branch p
										INNER JOIN nb_promotion_jenis_weekly j
												ON (p.id_jenis_weekly = j.id_jenis_weekly)
								WHERE (p.id_branch = br.id_branch
										AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
										AND j.tahun = "'.$tahun.'"
										AND j.bulan = "'.$bulan.'"
										AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
						) AS total
			FROM
					bb_branch br
			WHERE (br.id_branch LIKE "'.'%'.$pilihan.'%'.'")
		';

		$this->db->select($select_1.$select_2.$select_3);
		$this->db->from('('.$from_1.$from_2.$from_3.') xx');
	}

	var $fieldmap_daftar_3 = array();
	var $column_order_3 = array();
	var $column_search_3 = array();

	function build_query_daftar_3()
	{
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;
		$program = $this->input->post('program') ? $this->input->post('program') : 0;

		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : 'OUT';

		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';

		$arr_program = '';

		if ($total_program > 0)
		{
			$arr_program = explode(',', $program);
		}

		$select_1 = '
			xx.id
			, xx.nama
		';

		$select_2 = '';
		for ($i=0; $i<$total_program; $i++)
		{
			$select_2 .= '
				, xx.program_'.$i.'
			';
		}

		$select_3 = '
			, xx.total
		';

		$from_1 = '
			SELECT
					cl.id_cluster AS id
					, cl.nama_cluster AS nama
		';

		$from_2 = '';

		for ($i=0; $i<$total_program; $i++)
		{
			$this->db->select('xx.xid');
			$this->db->from('
				(
						SELECT
								GROUP_CONCAT(id_jenis_weekly) AS xid
						FROM
								nb_promotion_jenis_weekly
						WHERE (tahun = "'.$tahun.'"
								AND bulan = "'.$bulan.'"
								AND minggu LIKE "'.'%'.$minggu.'%'.'"
								AND id_jenis = "'.$arr_program[$i].'")
				) xx
			');
			$rsx = $this->db->get()->row_array();
			$jenis_weekly = isset($rsx['xid']) ? $rsx['xid'] : 0;

			$from_2 .= '
					, (
								SELECT
										COALESCE(SUM(p.total), 0) AS total
								FROM
										ni_promotion_res_cluster p
								WHERE (p.id_jenis_lokasi = "'.$jenis_lokasi.'"
										AND p.id_cluster = cl.id_cluster
										AND p.id_jenis_weekly IN ('.$jenis_weekly.'))
						) AS program_'.$i.'
			';
		}

		if ($kategori == 'Branch')
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											ni_promotion_res_cluster p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_cluster = cl.id_cluster
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
						, (
									SELECT
											COALESCE(SUM(b.total_pjp), 0)
									FROM
											ni_promotion_res_cluster b
									WHERE (b.id_cluster = cl.id_cluster
											AND b.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND b.id_jenis_weekly IN ('.$program.'))
							) AS total_pjp
				FROM
						bc_cluster cl
				WHERE (cl.id_branch LIKE "'.'%'.$pilihan.'%'.'")
			';
		}
		else
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											ni_promotion_res_cluster p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_cluster = cl.id_cluster
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
				FROM
						bc_cluster cl
				WHERE (cl.id_cluster = "'.$pilihan.'")
			';
		}

		$this->db->select($select_1.$select_2.$select_3);
		$this->db->from('('.$from_1.$from_2.$from_3.') xx');
	}

	var $fieldmap_daftar_4 = array();
	var $column_order_4 = array();
	var $column_search_4 = array();

	function build_query_daftar_4()
	{
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;
		$program = $this->input->post('program') ? $this->input->post('program') : 0;

		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : 'OUT';

		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';

		$arr_program = '';

		if ($total_program > 0)
		{
			$arr_program = explode(',', $program);
		}

		$select_1 = '
			xx.id
			, xx.nama
		';

		$select_2 = '';
		for ($i=0; $i<$total_program; $i++)
		{
			$select_2 .= '
				, xx.program_'.$i.'
			';
		}

		$select_3 = '
			, xx.total
		';

		$from_1 = '
			SELECT DISTINCT
					kc.id_kabupaten AS id
					, kb.nama_kabupaten AS nama
		';

		$from_2 = '';

		for ($i=0; $i<$total_program; $i++)
		{
			$this->db->select('xx.xid');
			$this->db->from('
				(
						SELECT
								GROUP_CONCAT(id_jenis_weekly) AS xid
						FROM
								nb_promotion_jenis_weekly
						WHERE (tahun = "'.$tahun.'"
								AND bulan = "'.$bulan.'"
								AND minggu LIKE "'.'%'.$minggu.'%'.'"
								AND id_jenis = "'.$arr_program[$i].'")
				) xx
			');
			$rsx = $this->db->get()->row_array();
			$jenis_weekly = isset($rsx['xid']) ? $rsx['xid'] : 0;

			$from_2 .= '
					, (
								SELECT
										COALESCE(SUM(p.total), 0) AS total
								FROM
										nl_promotion_res_kabupaten p
								WHERE (p.id_jenis_lokasi = "'.$jenis_lokasi.'"
										AND p.id_kabupaten = kc.id_kabupaten
										AND p.id_jenis_weekly IN ('.$jenis_weekly.'))
						) AS program_'.$i.'
			';
		}

		if ($kategori == 'Branch')
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											nl_promotion_res_kabupaten p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_kabupaten = kc.id_kabupaten
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
				FROM
						cc_kecamatan kc
						INNER JOIN cb_kabupaten kb
								ON (kc.id_kabupaten = kb.id_kabupaten)
						INNER JOIN bc_cluster cl
								ON (kc.id_cluster = cl.id_cluster)
				WHERE (cl.id_branch LIKE "'.'%'.$pilihan.'%'.'")
			';
		}
		else
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											nl_promotion_res_kabupaten p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_kabupaten = kc.id_kabupaten
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
				FROM
						cc_kecamatan kc
						INNER JOIN cb_kabupaten kb
								ON (kc.id_kabupaten = kb.id_kabupaten)
				WHERE (kc.id_cluster = "'.$pilihan.'")
			';
		}

		$this->db->select($select_1.$select_2.$select_3);
		$this->db->from('('.$from_1.$from_2.$from_3.') xx');
	}

	var $fieldmap_daftar_5 = array();
	var $column_order_5 = array();
	var $column_search_5 = array();

	function build_query_daftar_5()
	{
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;
		$program = $this->input->post('program') ? $this->input->post('program') : 0;

		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : 'OUT';

		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';

		$arr_program = '';

		if ($total_program > 0)
		{
			$arr_program = explode(',', $program);
		}

		$select_1 = '
			xx.id
			, xx.nama
		';

		$select_2 = '';
		for ($i=0; $i<$total_program; $i++)
		{
			$select_2 .= '
				, xx.program_'.$i.'
			';
		}

		$select_3 = '
			, xx.total
		';

		$from_1 = '
			SELECT
					kc.id_kecamatan AS id
					, kc.nama_kecamatan AS nama
		';

		$from_2 = '';

		for ($i=0; $i<$total_program; $i++)
		{
			$this->db->select('xx.xid');
			$this->db->from('
				(
						SELECT
								GROUP_CONCAT(id_jenis_weekly) AS xid
						FROM
								nb_promotion_jenis_weekly
						WHERE (tahun = "'.$tahun.'"
								AND bulan = "'.$bulan.'"
								AND minggu LIKE "'.'%'.$minggu.'%'.'"
								AND id_jenis = "'.$arr_program[$i].'")
				) xx
			');
			$rsx = $this->db->get()->row_array();
			$jenis_weekly = isset($rsx['xid']) ? $rsx['xid'] : 0;

			$from_2 .= '
					, (
								SELECT
										COALESCE(SUM(p.total), 0) AS total
								FROM
										nm_promotion_res_kecamatan p
								WHERE (p.id_jenis_lokasi = "'.$jenis_lokasi.'"
										AND p.id_kecamatan = kc.id_kecamatan
										AND p.id_jenis_weekly IN ('.$jenis_weekly.'))
						) AS program_'.$i.'
			';
		}

		if ($kategori == 'Branch')
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											nm_promotion_res_kecamatan p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_kecamatan = kc.id_kecamatan
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
				FROM
						cc_kecamatan kc
						INNER JOIN bc_cluster cl
								ON (kc.id_cluster = cl.id_cluster)
				WHERE (cl.id_branch LIKE "'.'%'.$pilihan.'%'.'")
			';
		}
		else
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											nm_promotion_res_kecamatan p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_kecamatan = kc.id_kecamatan
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
				FROM
						cc_kecamatan kc
				WHERE (kc.id_cluster = "'.$pilihan.'")
			';
		}

		$this->db->select($select_1.$select_2.$select_3);
		$this->db->from('('.$from_1.$from_2.$from_3.') xx');
	}

	var $fieldmap_daftar_6 = array();
	var $column_order_6 = array();
	var $column_search_6 = array();

	function build_query_daftar_6()
	{
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;
		$program = $this->input->post('program') ? $this->input->post('program') : 0;

		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : 'OUT';

		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';

		$arr_program = '';

		if ($total_program > 0)
		{
			$arr_program = explode(',', $program);
		}

		$select_1 = '
			xx.id
			, xx.nama
		';

		$select_2 = '';
		for ($i=0; $i<$total_program; $i++)
		{
			$select_2 .= '
				, xx.program_'.$i.'
			';
		}

		$select_3 = '
			, xx.total
		';

		$from_1 = '
			SELECT
					tp.id_tap AS id
					, tp.nama_tap AS nama
		';

		$from_2 = '';

		for ($i=0; $i<$total_program; $i++)
		{
			$this->db->select('xx.xid');
			$this->db->from('
				(
						SELECT
								GROUP_CONCAT(id_jenis_weekly) AS xid
						FROM
								nb_promotion_jenis_weekly
						WHERE (tahun = "'.$tahun.'"
								AND bulan = "'.$bulan.'"
								AND minggu LIKE "'.'%'.$minggu.'%'.'"
								AND id_jenis = "'.$arr_program[$i].'")
				) xx
			');
			$rsx = $this->db->get()->row_array();
			$jenis_weekly = isset($rsx['xid']) ? $rsx['xid'] : 0;

			$from_2 .= '
					, (
								SELECT
										COALESCE(SUM(p.total), 0) AS total
								FROM
										nj_promotion_res_tap p
								WHERE (p.id_jenis_lokasi = "'.$jenis_lokasi.'"
										AND p.id_tap = tp.id_tap
										AND p.id_jenis_weekly IN ('.$jenis_weekly.'))
						) AS program_'.$i.'
			';
		}

		if ($kategori == 'Branch')
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											nj_promotion_res_tap p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_tap = tp.id_tap
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
				FROM
						bd_tap tp
						INNER JOIN bc_cluster cl
								ON (tp.id_cluster = cl.id_cluster)
				WHERE (cl.id_branch LIKE "'.'%'.$pilihan.'%'.'")
			';
		}
		else if ($kategori == 'Cluster')
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											nj_promotion_res_tap p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_tap = tp.id_tap
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
				FROM
						bd_tap tp
				WHERE (tp.id_cluster = "'.$pilihan.'")
			';
		}
		else
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											nj_promotion_res_tap p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_tap = tp.id_tap
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
				FROM
						bd_tap tp
				WHERE (tp.id_tap = "'.$pilihan.'")
			';
		}

		$this->db->select($select_1.$select_2.$select_3);
		$this->db->from('('.$from_1.$from_2.$from_3.') xx');
	}

	var $fieldmap_daftar_7 = array();
	var $column_order_7 = array();
	var $column_search_7 = array();

	function build_query_daftar_7()
	{
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;
		$program = $this->input->post('program') ? $this->input->post('program') : 0;

		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$jenis_lokasi = $this->input->post('jenis_lokasi') ? strtoupper($this->input->post('jenis_lokasi')) : 'OUT';

		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';

		if ($jenis_lokasi == 'OUT') // Outlet
		{
			$jenis_sales = '"SSF", "SCS"';
		}
		else
		{
			$jenis_sales = '"SDS", "SCS"';
		}

		$arr_program = '';

		if ($total_program > 0)
		{
			$arr_program = explode(',', $program);
		}

		$select_1 = '
			xx.id
			, xx.nama
		';

		$select_2 = '';
		for ($i=0; $i<$total_program; $i++)
		{
			$select_2 .= '
				, xx.program_'.$i.'
			';
		}

		$select_3 = '
			, xx.total
		';

		$from_1 = '
			SELECT
					sl.id_sales AS id
					, sl.nama_sales AS nama
		';

		$from_2 = '';

		for ($i=0; $i<$total_program; $i++)
		{
			$this->db->select('xx.xid');
			$this->db->from('
				(
						SELECT
								GROUP_CONCAT(id_jenis_weekly) AS xid
						FROM
								nb_promotion_jenis_weekly
						WHERE (tahun = "'.$tahun.'"
								AND bulan = "'.$bulan.'"
								AND minggu LIKE "'.'%'.$minggu.'%'.'"
								AND id_jenis = "'.$arr_program[$i].'")
				) xx
			');
			$rsx = $this->db->get()->row_array();
			$jenis_weekly = isset($rsx['xid']) ? $rsx['xid'] : 0;

			$from_2 .= '
					, (
								SELECT
										COALESCE(SUM(p.total), 0) AS total
								FROM
										nk_promotion_res_sales p
								WHERE (p.id_jenis_lokasi = "'.$jenis_lokasi.'"
										AND p.id_sales = sl.id_sales
										AND p.id_jenis_weekly IN ('.$jenis_weekly.'))
						) AS program_'.$i.'
			';
		}

		if ($kategori == 'Branch')
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											nk_promotion_res_sales p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_sales = sl.id_sales
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
				FROM
						db_sales sl
						INNER JOIN bd_tap tp
								ON (sl.id_tap = tp.id_tap)
						INNER JOIN bc_cluster cl
								ON (tp.id_cluster = cl.id_cluster)
				WHERE (cl.id_branch LIKE "'.'%'.$pilihan.'%'.'"
						AND sl.id_jenis_sales IN ('.$jenis_sales.'))
				ORDER BY sl.nama_sales ASC
			';
		}
		else if ($kategori == 'Cluster')
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											nk_promotion_res_sales p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_sales = sl.id_sales
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
				FROM
						db_sales sl
						INNER JOIN bd_tap tp
								ON (sl.id_tap = tp.id_tap)
				WHERE (tp.id_cluster = "'.$pilihan.'"
						AND sl.id_jenis_sales IN ('.$jenis_sales.'))
				ORDER BY sl.nama_sales ASC
			';
		}
		else
		{
			$from_3 = '
						, (
									SELECT
											COALESCE(SUM(p.total), 0)
									FROM
											nk_promotion_res_sales p
											INNER JOIN nb_promotion_jenis_weekly j
													ON (p.id_jenis_weekly = j.id_jenis_weekly)
									WHERE (p.id_sales = sl.id_sales
											AND p.id_jenis_lokasi = "'.$jenis_lokasi.'"
											AND j.tahun = "'.$tahun.'"
											AND j.bulan = "'.$bulan.'"
											AND j.minggu LIKE "'.'%'.$minggu.'%'.'")
							) AS total
				FROM
						db_sales sl
						INNER JOIN bd_tap tp
								ON (sl.id_tap = tp.id_tap)
				WHERE (sl.id_tap = "'.$pilihan.'"
						AND sl.id_jenis_sales IN ('.$jenis_sales.'))
				ORDER BY sl.nama_sales ASC
			';
		}

		$this->db->select($select_1.$select_2.$select_3);
		$this->db->from('('.$from_1.$from_2.$from_3.') xx');
	}
}
?>