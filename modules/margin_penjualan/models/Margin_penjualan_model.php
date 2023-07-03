<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Margin_penjualan_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	var $fieldmap_daftar = array('kode_produk', 'nama_produk', 'harga_modal', 'harga_jual', 'margin', 'penjualan', 'total_margin');
	var $column_order = array(null, 'kode_produk', 'nama_produk', 'harga_modal', 'harga_jual', 'margin', 'penjualan', 'total_margin');
	var $column_search = array('kode_produk', 'nama_produk', 'harga_modal', 'harga_jual', 'margin', 'penjualan', 'total_margin');

	function build_query_daftar()
	{
		$tahun = $this->input->post('tahun') ? (int) $this->input->post('tahun') : (int) date('Y');
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : (int) date('m');
		$minggu = $this->input->post('minggu') ? (int) $this->input->post('minggu') : 1;
		$id_tap = $this->input->post('id_tap') ? $this->input->post('id_tap') : 0;

		$this->db->select('
			MIN(tanggal) AS tgl_awal
			, MAX(tanggal) AS tgl_akhir
		');
		$this->db->from('ja_penjualan_tanggal');
		$this->db->where('tahun', $tahun);
		$this->db->where('bulan', $bulan);
		$this->db->where('minggu', $minggu);
		$rs = $this->db->get()->row_array();

		$tgl_awal = isset($rs['tgl_awal']) ? $rs['tgl_awal'] : 0;
		$tgl_akhir = isset($rs['tgl_akhir']) ? $rs['tgl_akhir'] : 0;

		$this->db->select('xx.*');
		$this->db->from('
			(
					SELECT
							pjd.id_produk
							, p.kode_produk
							, p.nama_produk
							, MAX(pjd.harga_modal) AS  harga_modal
							, pjd.harga_jual
							, (pjd.harga_jual - p.harga_modal) AS margin
							, COALESCE(SUM(pjd.harga_jual), 0) AS penjualan
							, ((COALESCE(SUM(pjd.harga_jual), 0)) - (COALESCE(SUM(pjd.harga_modal), 0))) AS total_margin
					FROM
							jd_penjualan_detail pjd
							INNER JOIN jc_penjualan pj
									ON (pjd.no_nota = pj.no_nota)
							INNER JOIN db_sales s
									ON (pj.id_sales = s.id_sales)
							INNER JOIN gb_produk p
									ON (pjd.id_produk = p.id_produk)
					WHERE (s.id_tap = "'.$id_tap.'"
							AND pj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'")
					GROUP BY pjd.id_produk, p.kode_produk, p.nama_produk
			) xx
		');
	}

	function get_data_history_weekly()
  {
		$this->db->select('p.tahun, p.bulan, p.minggu');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tanggal', date('Y-m-d'));
		$rs = $this->db->get()->row_array();

		$tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$bulan = isset($rs['bulan']) ? (strlen((string) $rs['bulan']) == 1 ? '0'.$rs['bulan'] : $rs['bulan']) : 0;
		$minggu = isset($rs['minggu']) ? $rs['minggu'] : 0;

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
				WHERE CONCAT(p.tahun, (IF(LENGTH(p.bulan) = 1, CONCAT("0", p.bulan), p.bulan)), p.minggu) < "'.$tahun.$bulan.$minggu.'"
				GROUP BY p.tahun, p.bulan, p.minggu
				ORDER BY p.tanggal_merge DESC
				LIMIT 3
			) xx
		');
		$rs = $this->db->get()->result_array();

    return $rs;
  }

	function get_data_history_monthly()
  {
		$this->db->select('p.tahun, p.bulan, p.minggu');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tanggal', date('Y-m-d'));
		$rs = $this->db->get()->row_array();

		$tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$bulan = isset($rs['bulan']) ? (strlen((string) $rs['bulan']) == 1 ? '0'.$rs['bulan'] : $rs['bulan']) : 0;
		$minggu = isset($rs['minggu']) ? $rs['minggu'] : 0;

		$this->db->select('
			xx.tahun
			, xx.bulan
			, xx.tgl_mulai
			, xx.tgl_selesai
		');
		$this->db->from('
			(
				SELECT
					p.tahun
					, p.bulan
					, (
								SELECT
										MIN(xp.tanggal)
								FROM
										ja_penjualan_tanggal xp
								WHERE (xp.tahun = p.tahun
										AND xp.bulan = p.bulan)
						) AS tgl_mulai
					, (
								SELECT
										MAX(xp.tanggal)
								FROM
										ja_penjualan_tanggal xp
								WHERE (xp.tahun = p.tahun
										AND xp.bulan = p.bulan)
						) AS tgl_selesai
				FROM ja_penjualan_tanggal p
				WHERE CONCAT(p.tahun, (IF(LENGTH(p.bulan) = 1, CONCAT("0", p.bulan), p.bulan))) < "'.$tahun.$bulan.'"
				GROUP BY p.tahun, p.bulan
				ORDER BY p.tanggal_merge DESC
				LIMIT 3
			) xx
		');
		$rs = $this->db->get()->result_array();

    return $rs;
  }
}
?>