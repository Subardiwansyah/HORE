<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Market_audit_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	var $fieldmap_daftar_1 = array();
	var $column_order_1 = array();
	var $column_search_1 = array();

	function build_query_daftar_1()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');
		$this->db->from('
			(
				SELECT
						m.id_market_audit
						, m.id_regional
						, r.nama_regional AS nama

						, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
						, COALESCE(SUM(m.isat), 0) AS isat
						, COALESCE(SUM(m.xl), 0) AS xl
						, COALESCE(SUM(m.tri), 0) AS tri
						, COALESCE(SUM(m.smartfren), 0) AS smartfren
						, COALESCE(SUM(m.axis), 0) AS axis
						, COALESCE(SUM(m.other), 0) AS other
						, COALESCE(SUM(m.total), 0) AS total

						, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
						, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
						, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
						, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
						, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
						, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
						, COALESCE(SUM(m.other_ld), 0) AS other_ld
						, COALESCE(SUM(m.total_ld), 0) AS total_ld

						, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
						, COALESCE(SUM(m.isat_md), 0) AS isat_md
						, COALESCE(SUM(m.xl_md), 0) AS xl_md
						, COALESCE(SUM(m.tri_md), 0) AS tri_md
						, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
						, COALESCE(SUM(m.axis_md), 0) AS axis_md
						, COALESCE(SUM(m.other_md), 0) AS other_md
						, COALESCE(SUM(m.total_md), 0) AS total_md

						, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
						, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
						, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
						, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
						, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
						, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
						, COALESCE(SUM(m.other_hd), 0) AS other_hd
						, COALESCE(SUM(m.total_hd), 0) AS total_hd

						, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
						, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
						, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
						, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
						, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
						, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
						, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
						, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

						, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
						, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
						, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
						, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
						, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
						, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
						, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
						, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

						, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
						, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
						, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
						, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
						, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
						, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
						, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
						, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
					FROM
							oz_maket_audit_res_regional m
							INNER JOIN ba_regional r
									ON (m.id_regional = r.id_regional)
					WHERE (m.tahun = "'.$tahun.'"
							AND m.bulan = "'.$bulan.'"
							AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
							AND m.id_jenis_share = "'.$jenis_share.'")
					GROUP BY m.id_regional
			) xx
		');
	}

	var $fieldmap_daftar_2 = array();
	var $column_order_2 = array();
	var $column_search_2 = array();

	function build_query_daftar_2()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');
		$this->db->from('
			(
					SELECT
							m.id_market_audit
							, m.id_branch
							, b.nama_branch AS nama

							, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
							, COALESCE(SUM(m.isat), 0) AS isat
							, COALESCE(SUM(m.xl), 0) AS xl
							, COALESCE(SUM(m.tri), 0) AS tri
							, COALESCE(SUM(m.smartfren), 0) AS smartfren
							, COALESCE(SUM(m.axis), 0) AS axis
							, COALESCE(SUM(m.other), 0) AS other
							, COALESCE(SUM(m.total), 0) AS total

							, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
							, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
							, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
							, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
							, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
							, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
							, COALESCE(SUM(m.other_ld), 0) AS other_ld
							, COALESCE(SUM(m.total_ld), 0) AS total_ld

							, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
							, COALESCE(SUM(m.isat_md), 0) AS isat_md
							, COALESCE(SUM(m.xl_md), 0) AS xl_md
							, COALESCE(SUM(m.tri_md), 0) AS tri_md
							, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
							, COALESCE(SUM(m.axis_md), 0) AS axis_md
							, COALESCE(SUM(m.other_md), 0) AS other_md
							, COALESCE(SUM(m.total_md), 0) AS total_md

							, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
							, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
							, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
							, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
							, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
							, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
							, COALESCE(SUM(m.other_hd), 0) AS other_hd
							, COALESCE(SUM(m.total_hd), 0) AS total_hd

							, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
							, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
							, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
							, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
							, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
							, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
							, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
							, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

							, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
							, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
							, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
							, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
							, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
							, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
							, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
							, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

							, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
							, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
							, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
							, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
							, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
							, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
							, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
							, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
					FROM
							oz_maket_audit_res_branch m
							INNER JOIN bb_branch b
									ON (m.id_branch = b.id_branch)
					WHERE (m.tahun = "'.$tahun.'"
							AND m.bulan = "'.$bulan.'"
							AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
							AND m.id_jenis_share = "'.$jenis_share.'"
							AND m.id_branch LIKE "'.'%'.$pilihan.'%'.'")
					GROUP BY m.id_branch
			) xx
		');
	}

	var $fieldmap_daftar_3 = array();
	var $column_order_3 = array();
	var $column_search_3 = array();

	function build_query_daftar_3()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_cluster
								, c.nama_cluster AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_cluster m
								INNER JOIN bc_cluster c
										ON (m.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_cluster
				) xx
			');
		}
		else
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_cluster
								, c.nama_cluster AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_cluster m
								INNER JOIN bc_cluster c
										ON (m.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND m.id_cluster = "'.$pilihan.'")
						GROUP BY m.id_cluster
				) xx
			');
		}
	}

	var $fieldmap_daftar_4 = array();
	var $column_order_4 = array();
	var $column_search_4 = array();

	function build_query_daftar_4()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT DISTINCT
								m.id_market_audit
								, m.id_kabupaten
								, kb.nama_kabupaten AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_kabupaten m
								INNER JOIN cb_kabupaten kb
										ON (m.id_kabupaten = kb.id_kabupaten)
								INNER JOIN cc_kecamatan kc
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_kabupaten
				) xx
			');
		}
		else
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_kabupaten
								, kb.nama_kabupaten AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_kabupaten m
								INNER JOIN cb_kabupaten kb
										ON (m.id_kabupaten = kb.id_kabupaten)
								INNER JOIN cc_kecamatan kc
										ON (kc.id_kabupaten = kb.id_kabupaten)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND kc.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_kabupaten
				) xx
			');
		}
	}

	var $fieldmap_daftar_5 = array();
	var $column_order_5 = array();
	var $column_search_5 = array();

	function build_query_daftar_5()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_kecamatan
								, kc.nama_kecamatan AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_kecamatan m
								INNER JOIN cc_kecamatan kc
										ON (m.id_kecamatan = kc.id_kecamatan)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_kecamatan
				) xx
			');
		}
		else
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_kecamatan
								, kc.nama_kecamatan AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_kecamatan m
								INNER JOIN cc_kecamatan kc
										ON (m.id_kecamatan = kc.id_kecamatan)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND kc.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_kecamatan
				) xx
			');
		}
	}

	var $fieldmap_daftar_6 = array();
	var $column_order_6 = array();
	var $column_search_6 = array();

	function build_query_daftar_6()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_tap
								, t.nama_tap AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_tap m
								INNER JOIN bd_tap t
										ON (m.id_tap = t.id_tap)
								INNER JOIN bc_cluster c
										ON (t.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_tap
				) xx
			');
		}
		else if ($kategori == 'Cluster')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_tap
								, t.nama_tap AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_tap m
								INNER JOIN bd_tap t
										ON (m.id_tap = t.id_tap)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND t.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_tap
				) xx
			');
		}
		else if ($kategori == 'TAP')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_tap
								, t.nama_tap AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_tap m
								INNER JOIN bd_tap t
										ON (m.id_tap = t.id_tap)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND m.id_tap LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_tap
				) xx
			');
		}
	}

	var $fieldmap_daftar_7 = array();
	var $column_order_7 = array();
	var $column_search_7 = array();

	function build_query_daftar_7()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';
		$jenis_sales = '"SSF", "SCS"';

		$this->db->select('xx.*');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_sales
								, s.nama_sales AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_sales m
								INNER JOIN db_sales s
										ON (m.id_sales = s.id_sales)
								INNER JOIN bd_tap t
										ON (s.id_tap = t.id_tap)
								INNER JOIN bc_cluster c
										ON (t.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_sales
				) xx
			');
		}
		else if ($kategori == 'Cluster')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_sales
								, s.nama_sales AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_sales m
								INNER JOIN db_sales s
										ON (m.id_sales = s.id_sales)
								INNER JOIN bd_tap t
										ON (s.id_tap = t.id_tap)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND t.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_sales
				) xx
			');
		}
		else if ($kategori == 'TAP')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_sales
								, s.nama_sales AS nama

								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total

								, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
								, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
								, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
								, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
								, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
								, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
								, COALESCE(SUM(m.other_ld), 0) AS other_ld
								, COALESCE(SUM(m.total_ld), 0) AS total_ld

								, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
								, COALESCE(SUM(m.isat_md), 0) AS isat_md
								, COALESCE(SUM(m.xl_md), 0) AS xl_md
								, COALESCE(SUM(m.tri_md), 0) AS tri_md
								, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
								, COALESCE(SUM(m.axis_md), 0) AS axis_md
								, COALESCE(SUM(m.other_md), 0) AS other_md
								, COALESCE(SUM(m.total_md), 0) AS total_md

								, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
								, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
								, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
								, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
								, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
								, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
								, COALESCE(SUM(m.other_hd), 0) AS other_hd
								, COALESCE(SUM(m.total_hd), 0) AS total_hd

								, (COALESCE(SUM(m.telkomsel_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS telkomsel_ld_persen
								, (COALESCE(SUM(m.isat_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS isat_ld_persen
								, (COALESCE(SUM(m.xl_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS xl_ld_persen
								, (COALESCE(SUM(m.tri_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS tri_ld_persen
								, (COALESCE(SUM(m.smartfren_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS smartfren_ld_persen
								, (COALESCE(SUM(m.axis_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS axis_ld_persen
								, (COALESCE(SUM(m.other_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS other_ld_persen
								, (COALESCE(SUM(m.total_ld), 0) / COALESCE(SUM(m.total_ld), 0)) * 100 AS total_ld_persen

								, (COALESCE(SUM(m.telkomsel_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS telkomsel_md_persen
								, (COALESCE(SUM(m.isat_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS isat_md_persen
								, (COALESCE(SUM(m.xl_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS xl_md_persen
								, (COALESCE(SUM(m.tri_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS tri_md_persen
								, (COALESCE(SUM(m.smartfren_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS smartfren_md_persen
								, (COALESCE(SUM(m.axis_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS axis_md_persen
								, (COALESCE(SUM(m.other_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS other_md_persen
								, (COALESCE(SUM(m.total_md), 0) / COALESCE(SUM(m.total_md), 0)) * 100 AS total_md_persen

								, (COALESCE(SUM(m.telkomsel_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS telkomsel_hd_persen
								, (COALESCE(SUM(m.isat_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS isat_hd_persen
								, (COALESCE(SUM(m.xl_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS xl_hd_persen
								, (COALESCE(SUM(m.tri_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS tri_hd_persen
								, (COALESCE(SUM(m.smartfren_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS smartfren_hd_persen
								, (COALESCE(SUM(m.axis_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS axis_hd_persen
								, (COALESCE(SUM(m.other_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS other_hd_persen
								, (COALESCE(SUM(m.total_hd), 0) / COALESCE(SUM(m.total_hd), 0)) * 100 AS total_hd_persen
						FROM
								oz_maket_audit_res_sales m
								INNER JOIN db_sales s
										ON (m.id_sales = s.id_sales)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND s.id_tap LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_sales
				) xx
			');
		}
	}

	var $fieldmap_daftar_8 = array();
	var $column_order_8 = array();
	var $column_search_8 = array();

	function build_query_daftar_8()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');
		$this->db->from('
			(
				SELECT
						m.id_market_audit
						, m.id_regional
						, r.nama_regional AS nama
						, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
						, COALESCE(SUM(m.isat), 0) AS isat
						, COALESCE(SUM(m.xl), 0) AS xl
						, COALESCE(SUM(m.tri), 0) AS tri
						, COALESCE(SUM(m.smartfren), 0) AS smartfren
						, COALESCE(SUM(m.axis), 0) AS axis
						, COALESCE(SUM(m.other), 0) AS other
						, COALESCE(SUM(m.total), 0) AS total
					FROM
							oz_maket_audit_res_regional m
							INNER JOIN ba_regional r
									ON (m.id_regional = r.id_regional)
					WHERE (m.tahun = "'.$tahun.'"
							AND m.bulan = "'.$bulan.'"
							AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
							AND m.id_jenis_share = "'.$jenis_share.'")
					GROUP BY m.id_regional
			) xx
		');
	}

	var $fieldmap_daftar_9 = array();
	var $column_order_9 = array();
	var $column_search_9 = array();

	function build_query_daftar_9()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');
		$this->db->from('
			(
					SELECT
							m.id_market_audit
							, m.id_branch
							, b.nama_branch AS nama
							, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
							, COALESCE(SUM(m.isat), 0) AS isat
							, COALESCE(SUM(m.xl), 0) AS xl
							, COALESCE(SUM(m.tri), 0) AS tri
							, COALESCE(SUM(m.smartfren), 0) AS smartfren
							, COALESCE(SUM(m.axis), 0) AS axis
							, COALESCE(SUM(m.other), 0) AS other
							, COALESCE(SUM(m.total), 0) AS total
					FROM
							oz_maket_audit_res_branch m
							INNER JOIN bb_branch b
									ON (m.id_branch = b.id_branch)
					WHERE (m.tahun = "'.$tahun.'"
							AND m.bulan = "'.$bulan.'"
							AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
							AND m.id_jenis_share = "'.$jenis_share.'"
							AND m.id_branch LIKE "'.'%'.$pilihan.'%'.'")
					GROUP BY m.id_branch
			) xx
		');
	}

	var $fieldmap_daftar_10 = array();
	var $column_order_10 = array();
	var $column_search_10 = array();

	function build_query_daftar_10()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_cluster
								, c.nama_cluster AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_cluster m
								INNER JOIN bc_cluster c
										ON (m.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_cluster
				) xx
			');
		}
		else
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_cluster
								, c.nama_cluster AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_cluster m
								INNER JOIN bc_cluster c
										ON (m.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND m.id_cluster = "'.$pilihan.'")
						GROUP BY m.id_cluster
				) xx
			');
		}
	}

	var $fieldmap_daftar_11 = array();
	var $column_order_11 = array();
	var $column_search_11 = array();

	function build_query_daftar_11()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT DISTINCT
								m.id_market_audit
								, m.id_kabupaten
								, kb.nama_kabupaten AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_kabupaten m
								INNER JOIN cb_kabupaten kb
										ON (m.id_kabupaten = kb.id_kabupaten)
								INNER JOIN cc_kecamatan kc
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_kabupaten
				) xx
			');
		}
		else
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_kabupaten
								, kb.nama_kabupaten AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_kabupaten m
								INNER JOIN cb_kabupaten kb
										ON (m.id_kabupaten = kb.id_kabupaten)
								INNER JOIN cc_kecamatan kc
										ON (kc.id_kabupaten = kb.id_kabupaten)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND kc.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_kabupaten
				) xx
			');
		}
	}

	var $fieldmap_daftar_12 = array();
	var $column_order_12 = array();
	var $column_search_12 = array();

	function build_query_daftar_12()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_kecamatan
								, kc.nama_kecamatan AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_kecamatan m
								INNER JOIN cc_kecamatan kc
										ON (m.id_kecamatan = kc.id_kecamatan)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_kecamatan
				) xx
			');
		}
		else
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_kecamatan
								, kc.nama_kecamatan AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_kecamatan m
								INNER JOIN cc_kecamatan kc
										ON (m.id_kecamatan = kc.id_kecamatan)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND kc.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_kecamatan
				) xx
			');
		}
	}

	var $fieldmap_daftar_13 = array();
	var $column_order_13 = array();
	var $column_search_13 = array();

	function build_query_daftar_13()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';

		$this->db->select('xx.*');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_tap
								, t.nama_tap AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_tap m
								INNER JOIN bd_tap t
										ON (m.id_tap = t.id_tap)
								INNER JOIN bc_cluster c
										ON (t.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_tap
				) xx
			');
		}
		else if ($kategori == 'Cluster')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_tap
								, t.nama_tap AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_tap m
								INNER JOIN bd_tap t
										ON (m.id_tap = t.id_tap)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND t.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_tap
				) xx
			');
		}
		else if ($kategori == 'TAP')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_tap
								, t.nama_tap AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_tap m
								INNER JOIN bd_tap t
										ON (m.id_tap = t.id_tap)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND m.id_tap LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_tap
				) xx
			');
		}
	}

	var $fieldmap_daftar_14 = array();
	var $column_order_14 = array();
	var $column_search_14 = array();

	function build_query_daftar_14()
	{
		$kategori = $this->input->post('kategori') ? $this->input->post('kategori') : '';
		$pilihan = $this->input->post('pilihan') !== '-' ? $this->input->post('pilihan') : '';
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : '';
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : '';
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : '';
		$jenis_share = $this->input->post('jenis_share') ? strtoupper($this->input->post('jenis_share')) : '';
		$jenis_sales = '"SSF", "SCS"';

		$this->db->select('xx.*');

		if ($kategori == 'Branch')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_sales
								, s.nama_sales AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_sales m
								INNER JOIN db_sales s
										ON (m.id_sales = s.id_sales)
								INNER JOIN bd_tap t
										ON (s.id_tap = t.id_tap)
								INNER JOIN bc_cluster c
										ON (t.id_cluster = c.id_cluster)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND c.id_branch LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_sales
				) xx
			');
		}
		else if ($kategori == 'Cluster')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_sales
								, s.nama_sales AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_sales m
								INNER JOIN db_sales s
										ON (m.id_sales = s.id_sales)
								INNER JOIN bd_tap t
										ON (s.id_tap = t.id_tap)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND t.id_cluster LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_sales
				) xx
			');
		}
		else if ($kategori == 'TAP')
		{
			$this->db->from('
				(
						SELECT
								m.id_market_audit
								, m.id_sales
								, s.nama_sales AS nama
								, COALESCE(SUM(m.telkomsel), 0) AS telkomsel
								, COALESCE(SUM(m.isat), 0) AS isat
								, COALESCE(SUM(m.xl), 0) AS xl
								, COALESCE(SUM(m.tri), 0) AS tri
								, COALESCE(SUM(m.smartfren), 0) AS smartfren
								, COALESCE(SUM(m.axis), 0) AS axis
								, COALESCE(SUM(m.other), 0) AS other
								, COALESCE(SUM(m.total), 0) AS total
						FROM
								oz_maket_audit_res_sales m
								INNER JOIN db_sales s
										ON (m.id_sales = s.id_sales)
						WHERE (m.tahun = "'.$tahun.'"
								AND m.bulan = "'.$bulan.'"
								AND m.minggu LIKE "'.'%'.$minggu.'%'.'"
								AND m.id_jenis_share = "'.$jenis_share.'"
								AND s.id_tap LIKE "'.'%'.$pilihan.'%'.'")
						GROUP BY m.id_sales
				) xx
			');
		}
	}
}
?>