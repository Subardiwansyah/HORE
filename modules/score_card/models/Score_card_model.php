<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Score_card_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	var $fieldmap_daftar_1 = array();
	var $column_order_1 = array();
	var $column_search_1 = array();

	function build_query_daftar_1()
	{
		$id_cluster = $this->input->post('id_cluster') ? $this->input->post('id_cluster') : NULL;
		$id_tap = $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL;
		$id_jns_sales = $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL;
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : NULL;
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : NULL;

		$this->db->select('*');
		$this->db->from('la_score_card');
		$this->db->where('id_sales', $id_sales);
		$this->db->where('tahun', $tahun);
		$this->db->where('bulan', $bulan);
	}

	var $fieldmap_daftar_2 = array();
	var $column_order_2 = array();
	var $column_search_2 = array();

	function build_query_daftar_2()
	{
		$id_cluster = $this->input->post('id_cluster') ? $this->input->post('id_cluster') : NULL;
		$id_tap = $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL;
		$id_jns_sales = $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL;
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : NULL;
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : NULL;

		$this->db->select('xx.*');
		$this->db->from('
			(
					SELECT
							sl.nama_sales AS nama
							, tp.nama_tap
							, COUNT(sc.id_score_card) AS total
							, SUM(sc.pjp) AS pjp
							, SUM(sc.actual_call_jml) AS actual_call_jml
							, SUM(sc.actual_call_persen) / COUNT(sc.id_score_card) AS actual_call_persen
							, SUM(sc.effective_call_jml) AS effective_call_jml
							, SUM(sc.effective_call_persen) / COUNT(sc.id_score_card) AS effective_call_persen
							, SUM(sc.uhj_sgprepaid) AS uhj_sgprepaid
							, SUM(sc.uhj_sgota) AS uhj_sgota
							, SUM(sc.uhj_sgvin) AS uhj_sgvin
							, SUM(sc.uhj_sgvgs) AS uhj_sgvgs
							, SUM(sc.uhj_sgvgg) AS uhj_sgvgg
							, SUM(sc.uhj_sgvgp) AS uhj_sgvgp
							, SUM(sc.uhj_insac_ld) AS uhj_insac_ld
							, SUM(sc.uhj_insac_md) AS uhj_insac_md
							, SUM(sc.uhj_insac_hd) AS uhj_insac_hd
							, SUM(sc.uhj_invin_ld) AS uhj_invin_ld
							, SUM(sc.uhj_invin_md) AS uhj_invin_md
							, SUM(sc.uhj_invin_hd) AS uhj_invin_hd
							, SUM(sc.uhj_invga_ld) AS uhj_invga_ld
							, SUM(sc.uhj_invga_md) AS uhj_invga_md
							, SUM(sc.uhj_invga_hd) AS uhj_invga_hd
							, SUM(sc.uhj_new_rs) AS uhj_new_rs
							, SUM(sc.uhj_limit_link_aja) AS uhj_limit_link_aja

							, SUM(sc.trg_sgprepaid) AS trg_sgprepaid
							, SUM(sc.trg_sgota) AS trg_sgota
							, SUM(sc.trg_sgvin) AS trg_sgvin
							, SUM(sc.trg_sgvgs) AS trg_sgvgs
							, SUM(sc.trg_sgvgg) AS trg_sgvgg
							, SUM(sc.trg_sgvgp) AS trg_sgvgp
							, SUM(sc.trg_insac_ld) AS trg_insac_ld
							, SUM(sc.trg_insac_md) AS trg_insac_md
							, SUM(sc.trg_insac_hd) AS trg_insac_hd
							, SUM(sc.trg_invin_ld) AS trg_invin_ld
							, SUM(sc.trg_invin_md) AS trg_invin_md
							, SUM(sc.trg_invin_hd) AS trg_invin_hd
							, SUM(sc.trg_invga_ld) AS trg_invga_ld
							, SUM(sc.trg_invga_md) AS trg_invga_md
							, SUM(sc.trg_invga_hd) AS trg_invga_hd
							, SUM(sc.trg_new_rs) AS trg_new_rs
							, SUM(sc.trg_limit_link_aja) AS trg_limit_link_aja

							, SUM(sc.rmt_sgprepaid) AS rmt_sgprepaid
							, SUM(sc.rmt_sgota) AS rmt_sgota
							, SUM(sc.rmt_sgvin) AS rmt_sgvin
							, SUM(sc.rmt_sgvgs) AS rmt_sgvgs
							, SUM(sc.rmt_sgvgg) AS rmt_sgvgg
							, SUM(sc.rmt_sgvgp) AS rmt_sgvgp
							, SUM(sc.rmt_insac_ld) AS rmt_insac_ld
							, SUM(sc.rmt_insac_md) AS rmt_insac_md
							, SUM(sc.rmt_insac_hd) AS rmt_insac_hd
							, SUM(sc.rmt_invin_ld) AS rmt_invin_ld
							, SUM(sc.rmt_invin_md) AS rmt_invin_md
							, SUM(sc.rmt_invin_hd) AS rmt_invin_hd
							, SUM(sc.rmt_invga_ld) AS rmt_invga_ld
							, SUM(sc.rmt_invga_md) AS rmt_invga_md
							, SUM(sc.rmt_invga_hd) AS rmt_invga_hd
							, SUM(sc.rmt_new_rs) AS rmt_new_rs
							, SUM(sc.rmt_limit_link_aja) AS rmt_limit_link_aja

							, SUM(sc.evm_perdana) AS evm_perdana
							, SUM(sc.evm_voucher_fisik) AS evm_voucher_fisik
							, SUM(sc.evm_layar_toko) AS evm_layar_toko
							, SUM(sc.evm_poster) AS evm_poster
							, SUM(sc.evm_neon_box) AS evm_neon_box
							, SUM(sc.evm_stiker) AS evm_stiker
							, SUM(sc.evm_video) AS evm_video
					FROM
							la_score_card sc
							INNER JOIN db_sales sl
									ON (sc.id_sales = sl.id_sales)
							INNER JOIN bd_tap tp
									ON (sl.id_tap = tp.id_tap)
					WHERE (sl.id_tap = "'.$id_tap.'"
							AND sc.tahun = "'.$tahun.'"
							AND sc.bulan = "'.$bulan.'"
							AND sl.id_jenis_sales = "'.$id_jns_sales.'")
					GROUP BY sl.nama_sales, tp.nama_tap, sc.tahun, sc.bulan
					ORDER BY sl.nama_sales ASC
			) xx
		');
	}
}
?>