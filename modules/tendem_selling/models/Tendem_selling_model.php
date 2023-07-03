<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendem_selling_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	var $fieldmap_daftar_1 = array();
	var $column_order_1 = array();
	var $column_search_1 = array();

	function build_query_daftar_1()
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

		$this->db->select('
			xx.id_sales
			, xx.nama_sales
			, xx.sgprepaid
			, xx.sgota
			, xx.sgvin
			, xx.sgvgs
			, xx.sgvgg
			, xx.sgvgp
			, xx.sa_ld
			, xx.sa_md
			, xx.sa_hd
			, xx.invin_ld
			, xx.invin_md
			, xx.invin_hd
			, xx.invga_ld
			, xx.invga_md
			, xx.invga_hd
			, (
					xx.sgprepaid +
					xx.sgota +
					xx.sgvin +
					xx.sgvgs +
					xx.sgvgg +
					xx.sgvgp +
					xx.sa_ld + xx.sa_md + xx.sa_hd +
					xx.invin_ld + xx.invin_md + xx.invin_hd +
					xx.invga_ld + xx.invga_md + xx.invga_hd
				) AS total_penjualan
		');

		$this->db->from('
			(
					SELECT
							p.id_sales
							, s.nama_sales
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "SGPREPAID")
								) AS sgprepaid
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "SGOTA")
								) AS sgota
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "SGVIN")
								) AS sgvin
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "SGVGS")
								) AS sgvgs
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "SGVGG")
								) AS sgvgg
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "SGVGP")
								) AS sgvgp
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "INSAC"
												AND xp.id_jenis_inject = 1)
								) AS sa_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "INSAC"
												AND xp.id_jenis_inject = 2)
								) AS sa_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "INSAC"
												AND xp.id_jenis_inject = 3)
								) AS sa_hd
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "INVIN"
												AND xp.id_jenis_inject = 1)
								) AS invin_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "INVIN"
												AND xp.id_jenis_inject = 2)
								) AS invin_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "INVIN"
												AND xp.id_jenis_inject = 3)
								) AS invin_hd
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "INVGA"
												AND xp.id_jenis_inject = 1)
								) AS invga_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "INVGA"
												AND xp.id_jenis_inject = 2)
								) AS invga_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
										WHERE (xpj.id_sales = p.id_sales
												AND xpj.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"
												AND xp.id_jenis_produk = "INVGA"
												AND xp.id_jenis_inject = 3)
								) AS invga_hd
					FROM
							jc_penjualan p
							INNER JOIN db_sales s
									ON (p.id_sales = s.id_sales)
					WHERE (p.tgl_transaksi BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'" AND s.id_tap = "'.$id_tap.'")
					GROUP BY p.id_sales, s.nama_sales
			) xx
		');
		$this->db->order_by('total_penjualan', 'asc');
		$this->db->limit(2);
	}

	var $fieldmap_daftar_2 = array('id_mt', 'nama_mt', 'jabatan_mt', 'id_sales', 'nama_sales', 'total');
	var $column_order_2 = array(null, 'id_mt', 'nama_mt', 'jabatan_mt', 'id_sales', 'nama_sales', 'total');
	var $column_search_2 = array('id_mt', 'nama_mt', 'jabatan_mt', 'id_sales', 'nama_sales');

	function build_query_daftar_2()
	{
		$tahun = $this->input->post('tahun') ? (int) $this->input->post('tahun') : (int) date('Y');
		$bulan = $this->input->post('bulan') ? (int) $this->input->post('bulan') : (int) date('m');
		$minggu = $this->input->post('minggu') ? (int) $this->input->post('minggu') : 1;
		$id_tap = $this->input->post('id_tap') ? $this->input->post('id_tap') : 0;

		$this->db->select('
			 xx.*
		');
		$this->db->from('
			(
					SELECT
							p.id_sales
							, s.nama_sales
							, p.id
							, p.total
							, u.username AS id_mt
							, u.nama AS nama_mt
							, l.level AS jabatan_mt
					FROM
							za_penilaiansf p
							INNER JOIN db_sales s
									ON (p.id_sales = s.id_sales)
							LEFT JOIN za_users u
									ON (p.created_by = u.username)
							LEFT JOIN aa_users_level l
									ON (u.id_level = l.id_level)
					WHERE (p.tahun = "'.$tahun.'"
							AND p.bulan = "'.$bulan.'"
							AND p.minggu = "'.$minggu.'"
							AND s.id_tap = "'.$id_tap.'")
			) xx
		');
	}
}
?>