<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_order_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
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

	var $fieldmap_daftar_1 = array();
	var $column_order_1 = array(null);
	var $column_search_1 = array();

	function build_query_daftar_1()
	{
		$id_tap = $this->input->post('id_tap') ? $this->input->post('id_tap') : '';
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : '';
		$id_jns_sales = $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : '';
		$id_jns_lokasi = $this->input->post('id_jns_lokasi') ? $this->input->post('id_jns_lokasi') : 'OUT';
		$hari = $this->input->post('hari') !== '-' ? $this->input->post('hari') : '';

		$w1_tgl_mulai = NULL;
		$w1_tgl_selesai = NULL;
		$w2_tgl_mulai = NULL;
		$w2_tgl_selesai = NULL;
		$w3_tgl_mulai = NULL;
		$w3_tgl_selesai = NULL;

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

		if (!empty($rs))
		{
			$w1_tgl_mulai = isset($rs[0]['tgl_mulai']) ? $rs[0]['tgl_mulai'] : NULL;
			$w1_tgl_selesai = isset($rs[0]['tgl_selesai']) ? $rs[0]['tgl_selesai'] : NULL;

			$w2_tgl_mulai = isset($rs[1]['tgl_mulai']) ? $rs[1]['tgl_mulai'] : NULL;
			$w2_tgl_selesai = isset($rs[1]['tgl_selesai']) ? $rs[1]['tgl_selesai'] : NULL;

			$w3_tgl_mulai = isset($rs[2]['tgl_mulai']) ? $rs[2]['tgl_mulai'] : NULL;
			$w3_tgl_selesai = isset($rs[2]['tgl_selesai']) ? $rs[2]['tgl_selesai'] : NULL;
		}

		$this->db->select('
			xx.id
			, xx.nama_lokasi
			, xx.w1_sgprepaid
			, xx.w1_sgota
			, xx.w1_sgvin
			, xx.w1_sgvgs
			, xx.w1_sgvgg
			, xx.w1_sgvgp
			, xx.w1_insac_ld
			, xx.w1_insac_md
			, xx.w1_insac_hd
			, xx.w1_invin_ld
			, xx.w1_invin_md
			, xx.w1_invin_hd
			, xx.w1_invga_ld
			, xx.w1_invga_md
			, xx.w1_invga_hd
			, xx.w1_la

			, xx.w2_sgprepaid
			, xx.w2_sgota
			, xx.w2_sgvin
			, xx.w2_sgvgs
			, xx.w2_sgvgg
			, xx.w2_sgvgp
			, xx.w2_insac_ld
			, xx.w2_insac_md
			, xx.w2_insac_hd
			, xx.w2_invin_ld
			, xx.w2_invin_md
			, xx.w2_invin_hd
			, xx.w2_invga_ld
			, xx.w2_invga_md
			, xx.w2_invga_hd
			, xx.w2_la

			, xx.w3_sgprepaid
			, xx.w3_sgota
			, xx.w3_sgvin
			, xx.w3_sgvgs
			, xx.w3_sgvgg
			, xx.w3_sgvgp
			, xx.w3_insac_ld
			, xx.w3_insac_md
			, xx.w3_insac_hd
			, xx.w3_invin_ld
			, xx.w3_invin_md
			, xx.w3_invin_hd
			, xx.w3_invga_ld
			, xx.w3_invga_md
			, xx.w3_invga_hd
			, xx.w3_la
		');

		if ($id_jns_lokasi == 'OUT')
		{
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id
							, l.nama_outlet AS nama_lokasi

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w1_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w1_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w1_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w1_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w1_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w1_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w1_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w1_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w1_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w1_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w1_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w1_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w1_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w1_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w1_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w1_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w2_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w2_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w2_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w2_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w2_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w2_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w2_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w2_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w2_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w2_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w2_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w2_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w2_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w2_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w2_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w2_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_mulai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w3_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_mulai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w3_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w3_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w3_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w3_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w3_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w3_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w3_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w3_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w3_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w3_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w3_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w3_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w3_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w3_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w3_la
					FROM
							fe_daftar_pjp d
							INNER JOIN eb_outlet l
									ON (d.id_tempat = l.id_outlet)
					WHERE (d.id_sales = "'.$id_sales.'"
						 AND d.id_jenis_lokasi = "OUT"
						 AND l.status = "OPEN")
					GROUP BY id, nama_lokasi
				) xx
			');
		}
		if ($id_jns_lokasi == 'SEK')
		{
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id
							, l.nama_sekolah AS nama_lokasi

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w1_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w1_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w1_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w1_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w1_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w1_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w1_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w1_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w1_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w1_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w1_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w1_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w1_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w1_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w1_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w1_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w2_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w2_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w2_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w2_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w2_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w2_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w2_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w2_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w2_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w2_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w2_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w2_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w2_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w2_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w2_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w2_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w3_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w3_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w3_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w3_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w3_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w3_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w3_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w3_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w3_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w3_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w3_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w3_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w3_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w3_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w3_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w3_la
					FROM
							fe_daftar_pjp d
							INNER JOIN ec_sekolah l
									ON (d.id_tempat = l.id_sekolah)
					WHERE (d.id_sales = "'.$id_sales.'"
						 AND d.id_jenis_lokasi = "SEK"
						 AND l.status = "OPEN")
					GROUP BY id, nama_lokasi
				) xx
			');
		}
		if ($id_jns_lokasi == 'KAM')
		{
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id
							, l.nama_universitas AS nama_lokasi

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w1_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w1_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w1_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w1_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w1_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w1_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w1_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w1_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w1_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w1_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w1_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w1_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w1_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w1_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w1_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w1_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w2_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w2_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w2_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w2_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w2_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w2_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w2_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w2_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w2_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w2_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w2_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w2_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w2_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w2_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w2_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w2_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w3_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w3_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w3_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w3_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w3_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w3_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w3_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w3_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w3_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w3_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w3_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w3_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w3_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w3_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w3_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w3_la
					FROM
							fe_daftar_pjp d
							INNER JOIN ed_kampus l
									ON (d.id_tempat = l.id_universitas)
					WHERE (d.id_sales = "'.$id_sales.'"
						 AND d.id_jenis_lokasi = "KAM"
						 AND l.status = "OPEN")
					GROUP BY id, nama_lokasi
				) xx
			');
		}
		if ($id_jns_lokasi == 'FAK')
		{
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id
							, l.nama_fakultas AS nama_lokasi

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w1_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w1_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w1_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w1_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w1_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w1_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w1_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w1_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w1_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w1_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w1_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w1_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w1_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w1_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w1_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w1_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w2_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w2_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w2_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w2_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w2_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w2_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w2_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w2_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w2_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w2_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w2_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w2_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w2_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w2_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w2_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w2_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w3_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w3_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w3_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w3_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w3_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w3_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w3_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w3_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w3_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w3_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w3_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w3_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w3_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w3_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w3_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w3_la
					FROM
							fe_daftar_pjp d
							INNER JOIN ee_fakultas l
									ON (d.id_tempat = l.id_fakultas)
					WHERE (d.id_sales = "'.$id_sales.'"
						 AND d.id_jenis_lokasi = "FAK"
						 AND l.status = "OPEN")
					GROUP BY id, nama_lokasi
				) xx
			');
		}
		if ($id_jns_lokasi == 'POI')
		{
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id
							, l.nama_poi AS nama_lokasi

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w1_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w1_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w1_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w1_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w1_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w1_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w1_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w1_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w1_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w1_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w1_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w1_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w1_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w1_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w1_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w1_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w2_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w2_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w2_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w2_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w2_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w2_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w2_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w2_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w2_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w2_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w2_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w2_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w2_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w2_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w2_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w2_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w3_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w3_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w3_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w3_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w3_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w3_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w3_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w3_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w3_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w3_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w3_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w3_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w3_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w3_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w3_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w3_la
					FROM
							fe_daftar_pjp d
							INNER JOIN ef_poi l
									ON (d.id_tempat = l.id_poi)
					WHERE (d.id_sales = "'.$id_sales.'"
						 AND d.id_jenis_lokasi = "POI"
						 AND l.status = "OPEN")
					GROUP BY id, nama_lokasi
				) xx
			');
		}
	}

	var $fieldmap_daftar_2 = array();
	var $column_order_2 = array(null);
	var $column_search_2 = array();

	function build_query_daftar_2()
	{
		$id_tap = $this->input->post('id_tap') ? $this->input->post('id_tap') : '';
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : '';
		$id_jns_sales = $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : '';
		$id_jns_lokasi = $this->input->post('id_jns_lokasi') ? $this->input->post('id_jns_lokasi') : 'OUT';
		$hari = $this->input->post('hari') !== '-' ? $this->input->post('hari') : '';

		$w1_tgl_mulai = NULL;
		$w1_tgl_selesai = NULL;
		$w2_tgl_mulai = NULL;
		$w2_tgl_selesai = NULL;
		$w3_tgl_mulai = NULL;
		$w3_tgl_selesai = NULL;

		$this->db->select('p.tahun, p.bulan, p.minggu');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tanggal', date('Y-m-d'));
		$rs = $this->db->get()->row_array();

		$tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$bulan = isset($rs['bulan']) ? $rs['bulan'] : 0;
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
				WHERE p.tahun <= "'.$tahun.'"
						AND p.bulan < "'.$bulan.'"
				GROUP BY p.tahun, p.bulan
				ORDER BY p.tanggal_merge DESC
				LIMIT 3
			) xx
		');
		$rs = $this->db->get()->result_array();

		if (!empty($rs))
		{
			$w1_tgl_mulai = isset($rs[0]['tgl_mulai']) ? $rs[0]['tgl_mulai'] : NULL;
			$w1_tgl_selesai = isset($rs[0]['tgl_selesai']) ? $rs[0]['tgl_selesai'] : NULL;

			$w2_tgl_mulai = isset($rs[1]['tgl_mulai']) ? $rs[1]['tgl_mulai'] : NULL;
			$w2_tgl_selesai = isset($rs[1]['tgl_selesai']) ? $rs[1]['tgl_selesai'] : NULL;

			$w3_tgl_mulai = isset($rs[2]['tgl_mulai']) ? $rs[2]['tgl_mulai'] : NULL;
			$w3_tgl_selesai = isset($rs[2]['tgl_selesai']) ? $rs[2]['tgl_selesai'] : NULL;
		}

		$this->db->select('
			xx.id
			, xx.nama_lokasi

			, xx.w1_sgprepaid
			, xx.w1_sgota
			, xx.w1_sgvin
			, xx.w1_sgvgs
			, xx.w1_sgvgg
			, xx.w1_sgvgp
			, xx.w1_insac_ld
			, xx.w1_insac_md
			, xx.w1_insac_hd
			, xx.w1_invin_ld
			, xx.w1_invin_md
			, xx.w1_invin_hd
			, xx.w1_invga_ld
			, xx.w1_invga_md
			, xx.w1_invga_hd
			, xx.w1_la

			, xx.w2_sgprepaid
			, xx.w2_sgota
			, xx.w2_sgvin
			, xx.w2_sgvgs
			, xx.w2_sgvgg
			, xx.w2_sgvgp
			, xx.w2_insac_ld
			, xx.w2_insac_md
			, xx.w2_insac_hd
			, xx.w2_invin_ld
			, xx.w2_invin_md
			, xx.w2_invin_hd
			, xx.w2_invga_ld
			, xx.w2_invga_md
			, xx.w2_invga_hd
			, xx.w2_la

			, xx.w3_sgprepaid
			, xx.w3_sgota
			, xx.w3_sgvin
			, xx.w3_sgvgs
			, xx.w3_sgvgg
			, xx.w3_sgvgp
			, xx.w3_insac_ld
			, xx.w3_insac_md
			, xx.w3_insac_hd
			, xx.w3_invin_ld
			, xx.w3_invin_md
			, xx.w3_invin_hd
			, xx.w3_invga_ld
			, xx.w3_invga_md
			, xx.w3_invga_hd
			, xx.w3_la

			, FORMAT(((xx.w1_sgprepaid + xx.w2_sgprepaid + xx.w3_sgprepaid) / 3), 2) AS avg_sgprepaid
			, FORMAT(((xx.w1_sgota + xx.w2_sgota + xx.w3_sgota) / 3), 2) AS avg_sgota
			, FORMAT(((xx.w1_sgvin + xx.w2_sgvin + xx.w3_sgvin) / 3), 2) AS avg_sgvin
			, FORMAT(((xx.w1_sgvgs + xx.w2_sgvgs + xx.w3_sgvgs) / 3), 2) AS avg_sgvgs
			, FORMAT(((xx.w1_sgvgg + xx.w2_sgvgg + xx.w3_sgvgg) / 3), 2) AS avg_sgvgg
			, FORMAT(((xx.w1_sgvgp + xx.w2_sgvgp + xx.w3_sgvgp) / 3), 2) AS avg_sgvgp
			, FORMAT(((xx.w1_insac_ld + xx.w2_insac_ld + xx.w3_insac_ld) / 3), 2) AS avg_insac_ld
			, FORMAT(((xx.w1_insac_md + xx.w2_insac_md + xx.w3_insac_md) / 3), 2) AS avg_insac_md
			, FORMAT(((xx.w1_insac_hd + xx.w2_insac_hd + xx.w3_insac_hd) / 3), 2) AS avg_insac_hd
			, FORMAT(((xx.w1_invin_ld + xx.w2_invin_ld + xx.w3_invin_ld) / 3), 2) AS avg_invin_ld
			, FORMAT(((xx.w1_invin_md + xx.w2_invin_md + xx.w3_invin_md) / 3), 2) AS avg_invin_md
			, FORMAT(((xx.w1_invin_hd + xx.w2_invin_hd + xx.w3_invin_hd) / 3), 2) AS avg_invin_hd
			, FORMAT(((xx.w1_invga_ld + xx.w2_invga_ld + xx.w3_invga_ld) / 3), 2) AS avg_invga_ld
			, FORMAT(((xx.w1_invga_md + xx.w2_invga_md + xx.w3_invga_md) / 3), 2) AS avg_invga_md
			, FORMAT(((xx.w1_invga_hd + xx.w2_invga_hd + xx.w3_invga_hd) / 3), 2) AS avg_invga_hd
			, FORMAT(((xx.w1_la + xx.w2_la + xx.w3_la) / 3), 2) AS avg_la
		');

		if ($id_jns_lokasi == 'OUT')
		{
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id
							, l.nama_outlet AS nama_lokasi

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w1_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w1_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w1_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w1_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w1_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w1_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w1_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w1_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w1_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w1_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w1_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w1_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w1_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w1_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w1_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w1_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w2_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w2_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w2_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w2_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w2_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w2_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w2_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w2_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w2_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w2_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w2_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w2_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w2_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w2_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w2_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w2_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w3_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w3_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w3_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w3_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w3_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w3_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w3_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w3_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w3_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w3_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w3_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w3_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w3_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w3_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w3_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "OUT"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w3_la
					FROM
							fe_daftar_pjp d
							INNER JOIN eb_outlet l
									ON (d.id_tempat = l.id_outlet)
					WHERE (d.id_sales = "'.$id_sales.'"
						 AND d.id_jenis_lokasi = "OUT"
						 AND l.status = "OPEN")
					GROUP BY id, nama_lokasi
				) xx
			');
		}
		if ($id_jns_lokasi == 'SEK')
		{
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id
							, l.nama_sekolah AS nama_lokasi

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w1_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w1_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w1_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w1_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w1_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w1_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w1_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w1_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w1_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w1_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w1_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w1_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w1_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w1_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w1_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w1_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w2_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w2_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w2_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w2_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w2_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w2_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w2_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w2_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w2_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w2_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w2_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w2_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w2_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w2_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w2_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w2_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w3_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w3_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w3_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w3_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w3_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w3_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w3_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w3_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w3_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w3_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w3_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w3_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w3_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w3_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w3_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "SEK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w3_la
					FROM
							fe_daftar_pjp d
							INNER JOIN ec_sekolah l
									ON (d.id_tempat = l.id_sekolah)
					WHERE (d.id_sales = "'.$id_sales.'"
						 AND d.id_jenis_lokasi = "SEK"
						 AND l.status = "OPEN")
					GROUP BY id, nama_lokasi
				) xx
			');
		}
		if ($id_jns_lokasi == 'KAM')
		{
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id
							, l.nama_universitas AS nama_lokasi

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w1_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w1_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w1_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w1_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w1_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w1_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w1_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w1_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w1_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w1_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w1_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w1_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w1_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w1_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w1_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w1_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w2_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w2_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w2_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w2_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w2_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w2_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w2_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w2_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w2_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w2_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w2_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w2_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w2_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w2_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w2_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w2_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w3_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w3_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w3_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w3_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w3_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w3_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w3_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w3_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w3_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w3_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w3_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w3_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w3_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w3_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w3_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "KAM"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w3_la
					FROM
							fe_daftar_pjp d
							INNER JOIN ed_kampus l
									ON (d.id_tempat = l.id_universitas)
					WHERE (d.id_sales = "'.$id_sales.'"
						 AND d.id_jenis_lokasi = "KAM"
						 AND l.status = "OPEN")
					GROUP BY id, nama_lokasi
				) xx
			');
		}
		if ($id_jns_lokasi == 'FAK')
		{
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id
							, l.nama_fakultas AS nama_lokasi

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w1_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w1_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w1_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w1_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w1_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w1_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w1_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w1_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w1_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w1_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w1_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w1_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w1_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w1_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w1_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w1_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w2_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w2_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w2_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w2_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w2_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w2_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w2_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w2_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w2_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w2_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w2_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w2_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w2_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w2_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w2_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w2_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w3_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w3_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w3_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w3_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w3_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w3_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w3_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w3_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w3_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w3_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w3_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w3_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w3_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w3_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w3_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "FAK"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w3_la
					FROM
							fe_daftar_pjp d
							INNER JOIN ee_fakultas l
									ON (d.id_tempat = l.id_fakultas)
					WHERE (d.id_sales = "'.$id_sales.'"
						 AND d.id_jenis_lokasi = "FAK"
						 AND l.status = "OPEN")
					GROUP BY id, nama_lokasi
				) xx
			');
		}
		if ($id_jns_lokasi == 'POI')
		{
			$this->db->from('
				(
					SELECT
							d.id_tempat AS id
							, l.nama_poi AS nama_lokasi

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w1_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w1_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w1_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w1_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w1_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w1_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w1_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w1_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w1_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w1_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w1_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w1_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w1_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w1_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w1_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w1_tgl_mulai.'" AND "'.$w1_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w1_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w2_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w2_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w2_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w2_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w2_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w2_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w2_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w2_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w2_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w2_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w2_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w2_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w2_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w2_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w2_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w2_tgl_mulai.'" AND "'.$w2_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w2_la

							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
								) AS w3_sgprepaid
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGOTA")
								) AS w3_sgota
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVIN")
								) AS w3_sgvin
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGS")
								) AS w3_sgvgs
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGG")
								) AS w3_sgvgg
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "SGVGP")
								) AS w3_sgvgp
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 1)
								) AS w3_insac_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 2)
								) AS w3_insac_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INSAC"
												AND pd.id_jenis_inject = 3)
								) AS w3_insac_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 1)
								) AS w3_invin_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 2)
								) AS w3_invin_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVIN"
												AND pd.id_jenis_inject = 3)
								) AS w3_invin_hd
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 1)
								) AS w3_invga_ld
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 2)
								) AS w3_invga_md
							, (
										SELECT
												COUNT(xpd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpd
												INNER JOIN jc_penjualan xp
														ON (xpd.no_nota = xp.no_nota)
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
												INNER JOIN gb_produk pd
														ON (xpd.id_produk = pd.id_produk)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND UPPER(pd.id_jenis_produk) = "INVGA"
												AND pd.id_jenis_inject = 3)
								) AS w3_invga_hd
							, (
										SELECT
												COALESCE(SUM(xp.link_aja), 0)
										FROM
												jc_penjualan xp
												INNER JOIN db_sales sl
														ON (xp.id_sales = sl.id_sales)
										WHERE (xp.id_sales = "'.$id_sales.'"
												AND UPPER(xp.id_jenis_lokasi) = "POI"
												AND xp.id_lokasi = id
												AND xp.tgl_transaksi BETWEEN "'.$w3_tgl_mulai.'" AND "'.$w3_tgl_selesai.'"
												AND DATE_FORMAT(xp.tgl_transaksi, "%W") LIKE "'.'%'.$hari.'%'.'"
												AND xp.link_aja IS NOT NULL)
								) AS w3_la
					FROM
							fe_daftar_pjp d
							INNER JOIN ef_poi l
									ON (d.id_tempat = l.id_poi)
					WHERE (d.id_sales = "'.$id_sales.'"
						 AND d.id_jenis_lokasi = "POI"
						 AND l.status = "OPEN")
					GROUP BY id, nama_lokasi
				) xx
			');
		}
	}
}
?>