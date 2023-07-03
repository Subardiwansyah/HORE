<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target_sales_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	var $fieldmap_daftar_1 = array();
	var $column_order_1 = array(null);
	var $column_search_1 = array();

	function build_query_daftar_1()
	{
		$id_cluster = $this->input->post('id_cluster') ? $this->input->post('id_cluster') : 0;
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : 0;
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : 0;
		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : 0;
		$jns_sales = $this->input->post('jns_sales') ? $this->input->post('jns_sales') : "SSF";

		$this->db->select('
			xx.id_rekomendasi
			, xx.nama
			, xx.sgprepaid
			, xx.sgota
			, xx.sgvin
			, xx.sgvgs
			, xx.sgvgg
			, xx.sgvgp
			, xx.insac_ld
			, xx.insac_md
			, xx.insac_hd
			, xx.invin_ld
			, xx.invin_md
			, xx.invin_hd
			, xx.invga_ld
			, xx.invga_md
			, xx.invga_hd
			, xx.new_rs
			, xx.link_aja
		');

		$this->db->from('
			(
					SELECT
							r.id_rekomendasi
							, IF (r.id_sales IS NULL, t.nama_tap, s.nama_sales) AS nama
							, r.sgprepaid
							, r.sgota
							, r.sgvin
							, r.sgvgs
							, r.sgvgg
							, r.sgvgp
							, r.insac_ld
							, r.insac_md
							, r.insac_hd
							, r.invin_ld
							, r.invin_md
							, r.invin_hd
							, r.invga_ld
							, r.invga_md
							, r.invga_hd
							, r.new_rs
							, r.link_aja
					FROM
							kg_rekomendasi_tap r
							INNER JOIN bd_tap t
									ON (r.id_tap = t.id_tap)
							INNER JOIN db_sales s
									ON (r.id_sales = s.id_sales)
					WHERE (r.tahun = "'.$tahun.'"
							AND r.bulan = "'.$bulan.'"
							AND r.minggu = "'.$minggu.'"
							AND t.id_cluster = "'.$id_cluster.'"
							AND s.id_jenis_sales = "'.$jns_sales.'")
					ORDER BY CONCAT(r.id_tap, IF(r.id_sales IS NULL, "'.$jns_sales.'0000", r.id_sales)) ASC
			) xx
		');
	}

	function get_list_target_sales_sf()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		// Mengambil data tahun, bulan, minggu berjalan
		$this->db->select('p.tahun, p.bulan, p.minggu');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tanggal', date('Y-m-d'));
		$rs = $this->db->get()->row_array();

		$tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$bulan = isset($rs['bulan']) ? $rs['bulan'] : 0;
		$minggu = isset($rs['minggu']) ? $rs['minggu'] : 0;

		$this->db->select('
			xx.id_rekomendasi
			, xx.id_tap
			, xx.id_sales
			, xx.nama
			, xx.sgprepaid
			, xx.sgota
			, xx.sgvin
			, xx.sgvgs
			, xx.sgvgg
			, xx.sgvgp
			, xx.insac_ld
			, xx.insac_md
			, xx.insac_hd
			, xx.invin_ld
			, xx.invin_md
			, xx.invin_hd
			, xx.invga_ld
			, xx.invga_md
			, xx.invga_hd
			, xx.new_rs
			, xx.limit_link_aja
			, xx.is_simpan
			, xx.x_urut
			, xx.x_parent
		');
		$this->db->from('
			(
				SELECT
						rt.id_rekomendasi
						, rt.id_tap
						, rt.id_sales
						, IF (rt.id_sales IS NULL, tp.nama_tap, sl.nama_sales) AS nama
						, rt.sgprepaid
						, rt.sgota
						, rt.sgvin
						, rt.sgvgs
						, rt.sgvgg
						, rt.sgvgp
						, rt.insac_ld
						, rt.insac_md
						, rt.insac_hd
						, rt.invin_ld
						, rt.invin_md
						, rt.invin_hd
						, rt.invga_ld
						, rt.invga_md
						, rt.invga_hd
						, rt.new_rs
						, rt.limit_link_aja
						, rt.is_simpan
						, CONCAT(rt.id_tap, IF(rt.id_sales IS NULL, "SSF0000", rt.id_sales)) AS x_urut
						, IF (sl.id_sales IS NULL, 0, 1) AS x_parent
				FROM
						kg_rekomendasi_tap rt
						INNER JOIN bd_tap tp
								ON (rt.id_tap = tp.id_tap)
						LEFT JOIN db_sales sl
								ON (rt.id_sales = sl.id_sales)
				WHERE (UPPER(rt.target_sales) = "SF"
						AND rt.tahun = "'.$tahun.'"
						AND rt.bulan = "'.$bulan.'"
						AND rt.minggu = "'.$minggu.'"
						AND tp.id_cluster = "'.$id_divisi.'")
				 ORDER BY CONCAT(rt.id_tap, IF(rt.id_sales IS NULL, "SSF0000", rt.id_sales)) ASC
			) xx
		');
		$this->db->order_by('xx.x_urut', 'asc');
		$result = $this->db->get();

		return $result->result();
	}

	function save_data_sf()
  {
    $this->db->trans_begin();
    try {

			$total_data = $this->input->post('total_data_sf') ? $this->input->post('total_data_sf') : 0;

			for($i=0; $i<=$total_data; $i++)
			{
				$id_rt = $this->input->post('id_rt_'.$i) ? $this->input->post('id_rt_'.$i) : 0;
				$new_rs = $this->input->post('new_rs_'.$i) ? prepare_integer($this->input->post('new_rs_'.$i)) : 0;

				$data_x = array(
					'new_rs' => $new_rs,
					'is_simpan' => 1
				);

				$this->db->where('id_rekomendasi', $id_rt);
				$this->db->update('kg_rekomendasi_tap', $data_x);
				$this->check_trans_status('update kg_rekomendasi_tap failed');
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

	function get_list_target_sales_ds()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('p.tahun, p.bulan, p.minggu');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tanggal', date('Y-m-d'));
		$rs = $this->db->get()->row_array();

		$tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$bulan = isset($rs['bulan']) ? $rs['bulan'] : 0;
		$minggu = isset($rs['minggu']) ? $rs['minggu'] : 0;

		$this->db->select('
			xx.id_rekomendasi
			, xx.id_tap
			, xx.id_sales
			, xx.nama
			, xx.sgprepaid
			, xx.sgota
			, xx.sgvin
			, xx.sgvgs
			, xx.sgvgg
			, xx.sgvgp
			, xx.insac_ld
			, xx.insac_md
			, xx.insac_hd
			, xx.invin_ld
			, xx.invin_md
			, xx.invin_hd
			, xx.invga_ld
			, xx.invga_md
			, xx.invga_hd
			, xx.new_rs
			, xx.limit_link_aja
			, xx.is_simpan
			, xx.x_urut
			, xx.x_parent
		');
		$this->db->from('
			(
				SELECT
						rt.id_rekomendasi
						, rt.id_tap
						, rt.id_sales
						, IF (rt.id_sales IS NULL, tp.nama_tap, sl.nama_sales) AS nama
						, rt.sgprepaid
						, rt.sgota
						, rt.sgvin
						, rt.sgvgs
						, rt.sgvgg
						, rt.sgvgp
						, rt.insac_ld
						, rt.insac_md
						, rt.insac_hd
						, rt.invin_ld
						, rt.invin_md
						, rt.invin_hd
						, rt.invga_ld
						, rt.invga_md
						, rt.invga_hd
						, rt.new_rs
						, rt.limit_link_aja
						, rt.is_simpan
						, CONCAT(rt.id_tap, IF(rt.id_sales IS NULL, "SDS0000", rt.id_sales)) AS x_urut
						, IF (sl.id_sales IS NULL, 0, 1) AS x_parent
				FROM
						kg_rekomendasi_tap rt
						INNER JOIN bd_tap tp
								ON (rt.id_tap = tp.id_tap)
						LEFT JOIN db_sales sl
								ON (rt.id_sales = sl.id_sales)
				WHERE (UPPER(rt.target_sales) = "DS"
						AND rt.tahun = "'.$tahun.'"
						AND rt.bulan = "'.$bulan.'"
						AND rt.minggu = "'.$minggu.'"
						AND tp.id_cluster = "'.$id_divisi.'")
				 ORDER BY CONCAT(rt.id_tap, IF(rt.id_sales IS NULL, "SDS0000", rt.id_sales)) ASC
			) xx
		');
		$this->db->order_by('xx.x_urut', 'asc');
		$result = $this->db->get();

		return $result->result();
	}

	function save_data_ds()
  {
    $this->db->trans_begin();
    try {

			$total_data = $this->input->post('total_data_ds') ? $this->input->post('total_data_ds') : 0;

			for($i=0; $i<=$total_data; $i++)
			{
				$id_rt = $this->input->post('id_rt_'.$i) ? $this->input->post('id_rt_'.$i) : 0;
				$new_rs = $this->input->post('new_rs_'.$i) ? prepare_integer($this->input->post('new_rs_'.$i)) : 0;

				$data_x = array(
					'new_rs' => $new_rs,
					'is_simpan' => 1
				);

				$this->db->where('id_rekomendasi', $id_rt);
				$this->db->update('kg_rekomendasi_tap', $data_x);
				$this->check_trans_status('update kg_rekomendasi_tap failed');
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

	function get_list_target_sales($id_cluster, $tahun, $bulan, $minggu, $target_sales)
	{
		$this->db->select('
			xx.id_rekomendasi
			, xx.id_tap
			, xx.id_sales
			, xx.nama
			, xx.sgprepaid
			, xx.sgota
			, xx.sgvin
			, xx.sgvgs
			, xx.sgvgg
			, xx.sgvgp
			, xx.insac_ld
			, xx.insac_md
			, xx.insac_hd
			, xx.invin_ld
			, xx.invin_md
			, xx.invin_hd
			, xx.invga_ld
			, xx.invga_md
			, xx.invga_hd
			, xx.new_rs
			, xx.limit_link_aja
			, xx.is_simpan
			, xx.x_urut
			, xx.x_parent
		');
		$this->db->from('
			(
				SELECT
						rt.id_rekomendasi
						, rt.id_tap
						, rt.id_sales
						, IF (rt.id_sales IS NULL, tp.nama_tap, sl.nama_sales) AS nama
						, rt.sgprepaid
						, rt.sgota
						, rt.sgvin
						, rt.sgvgs
						, rt.sgvgg
						, rt.sgvgp
						, rt.insac_ld
						, rt.insac_md
						, rt.insac_hd
						, rt.invin_ld
						, rt.invin_md
						, rt.invin_hd
						, rt.invga_ld
						, rt.invga_md
						, rt.invga_hd
						, rt.new_rs
						, rt.limit_link_aja
						, rt.is_simpan
						, CONCAT(rt.id_tap, IF(rt.id_sales IS NULL, "S'.$target_sales.'0000", rt.id_sales)) AS x_urut
						, IF (sl.id_sales IS NULL, 0, 1) AS x_parent
				FROM
						kg_rekomendasi_tap rt
						INNER JOIN bd_tap tp
								ON (rt.id_tap = tp.id_tap)
						LEFT JOIN db_sales sl
								ON (rt.id_sales = sl.id_sales)
				WHERE (UPPER(rt.target_sales) = "'.$target_sales.'"
						AND rt.tahun = "'.$tahun.'"
						AND rt.bulan = "'.$bulan.'"
						AND rt.minggu = "'.$minggu.'"
						AND tp.id_cluster = "'.$id_cluster.'")
				 ORDER BY CONCAT(rt.id_tap, IF(rt.id_sales IS NULL, "S'.$target_sales.'0000", rt.id_sales)) ASC
			) xx
		');
		$this->db->order_by('xx.x_urut', 'asc');
		$result = $this->db->get();

		return $result->result();
	}
}
?>