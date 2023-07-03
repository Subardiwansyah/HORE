<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outlet_model extends CI_model {

	function __construct()
	{
		parent::__construct();
	}

	function check_trans_status($exception)
  {
    if ($this->db->trans_status() === FALSE) {
      throw new Exception($exception);
    }
  }

	function save_data_outlet()
  {
    $this->db->trans_begin();
    try {
			$this->select_penjualan_tanggal();
			$this->insert_data_outlet();
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

	function select_penjualan_tanggal()
  {
		$this->tanggal_mulai = 0;
		$this->tanggal_selesai = 0;

		// $this->tahun_penjualan = 0;
		// $this->bulan_penjualan = 0;
		// $this->minggu_penjualan = 0;

		/* MENGAMBIL TAHUN, BULAN DAN MINGGU BERJALAN */
		$this->db->select('tahun, bulan, minggu');
		$this->db->from('ja_penjualan_tanggal');
		$this->db->where('tanggal', date('Y-m-d'));
		$rs = $this->db->get()->row_array();

		$tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$bulan = isset($rs['bulan']) ? (strlen((string) $rs['bulan']) == 1 ? '0'.$rs['bulan'] : $rs['bulan']) : 0;
		$minggu = isset($rs['minggu']) ? $rs['minggu'] : 0;

		// $this->tahun_penjualan = isset($rs['tahun']) ? $rs['tahun'] : 0;
		// $this->bulan_penjualan = isset($rs['bulan']) ? $rs['bulan'] : 0;
		// $this->minggu_penjualan = isset($rs['minggu']) ? $rs['minggu'] : 0;

		// MENGAMBIL DATA 3 MINGGU KE BELAKANG
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
			$this->tanggal_mulai = isset($rs[2]['tgl_mulai']) ? $rs[2]['tgl_mulai'] : NULL;
			$this->tanggal_selesai = isset($rs[0]['tgl_selesai']) ? $rs[0]['tgl_selesai'] : NULL;
		}

		$this->tahun = $tahun;
		$this->bulan = (int) $bulan;
		$this->minggu = $minggu;
	}

	function insert_data_outlet()
  {
		$this->db->select('*');
		$this->db->from('bc_cluster');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			$penjualan_cluster = 0;

			for ($a=0; $a<count($rs_a); $a++)
			{
				// BEGIN LOOP CLUSTER

				$id_cluster = $rs_a[$a]['id_cluster'] ? $rs_a[$a]['id_cluster'] : 0;


				$this->db->select('*');
				$this->db->from('ka_rekomendasi');
				$this->db->where('id_cluster', $id_cluster);
				$this->db->where('tahun', $this->tahun);
				$this->db->where('bulan', $this->bulan);
				$this->db->where('minggu', $this->minggu);
				$rs_rekom = $this->db->get()->row_array();

				$rekom_sgprepaid = isset($rs_rekom['sf_out_sgprepaid']) ? $rs_rekom['sf_out_sgprepaid'] : 0;
				$rekom_sgota = isset($rs_rekom['sf_out_sgota']) ? $rs_rekom['sf_out_sgota'] : 0;
				$rekom_sgvin = isset($rs_rekom['sf_out_sgvin']) ? $rs_rekom['sf_out_sgvin'] : 0;
				$rekom_sgvgs = isset($rs_rekom['sf_out_sgvgs']) ? $rs_rekom['sf_out_sgvgs'] : 0;
				$rekom_sgvgg = isset($rs_rekom['sf_out_sgvgg']) ? $rs_rekom['sf_out_sgvgg'] : 0;
				$rekom_sgvgp = isset($rs_rekom['sf_out_sgvgp']) ? $rs_rekom['sf_out_sgvgp'] : 0;
				$rekom_insac_ld = isset($rs_rekom['sf_out_insac_ld']) ? $rs_rekom['sf_out_insac_ld'] : 0;
				$rekom_insac_md = isset($rs_rekom['sf_out_insac_md']) ? $rs_rekom['sf_out_insac_md'] : 0;
				$rekom_insac_hd = isset($rs_rekom['sf_out_insac_hd']) ? $rs_rekom['sf_out_insac_hd'] : 0;
				$rekom_invin_ld = isset($rs_rekom['sf_out_invin_ld']) ? $rs_rekom['sf_out_invin_ld'] : 0;
				$rekom_invin_md = isset($rs_rekom['sf_out_invin_md']) ? $rs_rekom['sf_out_invin_md'] : 0;
				$rekom_invin_hd = isset($rs_rekom['sf_out_invin_hd']) ? $rs_rekom['sf_out_invin_hd'] : 0;
				$rekom_invga_ld = isset($rs_rekom['sf_out_invga_ld']) ? $rs_rekom['sf_out_invga_ld'] : 0;
				$rekom_invga_md = isset($rs_rekom['sf_out_invga_md']) ? $rs_rekom['sf_out_invga_md'] : 0;
				$rekom_invga_md = isset($rs_rekom['sf_out_invga_md']) ? $rs_rekom['sf_out_invga_md'] : 0;
				$rekom_invga_hd = isset($rs_rekom['sf_out_invga_hd']) ? $rs_rekom['sf_out_invga_hd'] : 0;

				if (!empty($rs_rekom)) // CRON JOB HANYA MENGHITUNG DATA CLUSTER YANG SUDAH MELAKUKAN ENTRY REKOMENDASI
				{
					// BEGIN CRON JOB

					// MENGAMBIL TOTAL PENJUALAN CLUSTER MASING-MASING PRODUK
					$this->db->select('
						xx.total_sgprepaid
						, xx.total_sgota
						, xx.total_sgvin
						, xx.total_sgvgs
						, xx.total_sgvgg
						, xx.total_sgvgp
						, xx.total_insac_ld
						, xx.total_insac_md
						, xx.total_insac_hd
						, xx.total_invin_ld
						, xx.total_invin_md
						, xx.total_invin_hd
						, xx.total_invga_ld
						, xx.total_invga_md
						, xx.total_invga_hd
					');
					$this->db->from('
						(
							SELECT
									ROUND(COUNT(pjd.id_penjualan_detail) / 3) AS total_sgprepaid
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "SGOTA"
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_sgota
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "SGVIN"
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_sgvin
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "SGVGS"
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_sgvgs
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "SGVGG"
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_sgvgg
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "SGVGP"
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_sgvgp
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "INSAC"
														AND p.id_jenis_inject = 1
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_insac_ld
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "INSAC"
														AND p.id_jenis_inject = 2
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_insac_md
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "INSAC"
														AND p.id_jenis_inject = 3
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_insac_hd
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "INVIN"
														AND p.id_jenis_inject = 1
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_invin_ld
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "INVIN"
														AND p.id_jenis_inject = 2
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_invin_md
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "INVIN"
														AND p.id_jenis_inject = 3
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_invin_hd
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "INVGA"
														AND p.id_jenis_inject = 1
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_invga_ld
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "INVGA"
														AND p.id_jenis_inject = 2
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_invga_md
									, (
												SELECT
														ROUND(COUNT(pjd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail pjd
														INNER JOIN jc_penjualan pj
																ON (pjd.no_nota = pj.no_nota)
														INNER JOIN db_sales s
																ON (pj.id_sales = s.id_sales)
														INNER JOIN bd_tap t
																ON (s.id_tap = t.id_tap)
														INNER JOIN gb_produk p
																ON (pjd.id_produk = p.id_produk)
												WHERE (t.id_cluster = "'.$id_cluster.'"
														AND pj.id_jenis_lokasi = "OUT"
														AND p.id_jenis_produk = "INVGA"
														AND p.id_jenis_inject = 3
														AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
										) AS total_invga_hd
							FROM
									jd_penjualan_detail pjd
									INNER JOIN jc_penjualan pj
											ON (pjd.no_nota = pj.no_nota)
									INNER JOIN db_sales s
											ON (pj.id_sales = s.id_sales)
									INNER JOIN bd_tap t
											ON (s.id_tap = t.id_tap)
									INNER JOIN gb_produk p
											ON (pjd.id_produk = p.id_produk)
							WHERE (t.id_cluster = "'.$id_cluster.'"
									AND pj.id_jenis_lokasi = "OUT"
									AND p.id_jenis_produk = "SGPREPAID"
									AND pj.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'")
						) xx
					');
					$rs_b = $this->db->get()->row_array();

					$total_sgprepaid = $rs_b['total_sgprepaid'] ? $rs_b['total_sgprepaid'] : 1;
					$total_sgota = $rs_b['total_sgota'] ? $rs_b['total_sgota'] : 1;
					$total_sgvin = $rs_b['total_sgvin'] ? $rs_b['total_sgvin'] : 1;
					$total_sgvgs = $rs_b['total_sgvgs'] ? $rs_b['total_sgvgs'] : 1;
					$total_sgvgg = $rs_b['total_sgvgg'] ? $rs_b['total_sgvgg'] : 1;
					$total_sgvgp = $rs_b['total_sgvgp'] ? $rs_b['total_sgvgp'] : 1;
					$total_insac_ld = $rs_b['total_insac_ld'] ? $rs_b['total_insac_ld'] : 1;
					$total_insac_md = $rs_b['total_insac_md'] ? $rs_b['total_insac_md'] : 1;
					$total_insac_hd = $rs_b['total_insac_hd'] ? $rs_b['total_insac_hd'] : 1;
					$total_invin_ld = $rs_b['total_invin_ld'] ? $rs_b['total_invin_ld'] : 1;
					$total_invin_md = $rs_b['total_invin_md'] ? $rs_b['total_invin_md'] : 1;
					$total_invin_hd = $rs_b['total_invin_hd'] ? $rs_b['total_invin_hd'] : 1;
					$total_invga_ld = $rs_b['total_invga_ld'] ? $rs_b['total_invga_ld'] : 1;
					$total_invga_md = $rs_b['total_invga_md'] ? $rs_b['total_invga_md'] : 1;
					$total_invga_md = $rs_b['total_invga_md'] ? $rs_b['total_invga_md'] : 1;
					$total_invga_hd = $rs_b['total_invga_hd'] ? $rs_b['total_invga_hd'] : 1;


					// LOOP OUTLET BY CLUSTER
					$this->db->select('
						xx.id_outlet
						, xx.avg_sgprepaid
						, xx.avg_sgota
						, xx.avg_sgvin
						, xx.avg_sgvgs
						, xx.avg_sgvgg
						, xx.avg_sgvgp
						, xx.avg_insac_ld
						, xx.avg_insac_md
						, xx.avg_insac_hd
						, xx.avg_invin_ld
						, xx.avg_invin_md
						, xx.avg_invin_hd
						, xx.avg_invga_ld
						, xx.avg_invga_md
						, xx.avg_invga_hd
					');
					$this->db->from('
						(
							SELECT
									l.id_outlet
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "SGPREPAID")
										) AS avg_sgprepaid
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "SGOTA")
										) AS avg_sgota
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "SGVIN")
										) AS avg_sgvin
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "SGVGS")
										) AS avg_sgvgs
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "SGVGG")
										) AS avg_sgvgg
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "SGVGP")
										) AS avg_sgvgp
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "INSAC"
														AND pd.id_jenis_inject = 1)
										) AS avg_insac_ld
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "INSAC"
														AND pd.id_jenis_inject = 2)
										) AS avg_insac_md
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "INSAC"
														AND pd.id_jenis_inject = 3)
										) AS avg_insac_hd
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "INVIN"
														AND pd.id_jenis_inject = 1)
										) AS avg_invin_ld
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "INVIN"
														AND pd.id_jenis_inject = 2)
										) AS avg_invin_md
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "INVIN"
														AND pd.id_jenis_inject = 3)
										) AS avg_invin_hd
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "INVGA"
														AND pd.id_jenis_inject = 1)
										) AS avg_invga_ld
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "INVGA"
														AND pd.id_jenis_inject = 2)
										) AS avg_invga_md
									, (
												SELECT
														ROUND(COUNT(xpd.id_penjualan_detail) / 3)
												FROM
														jd_penjualan_detail xpd
														INNER JOIN jc_penjualan xp
																ON (xpd.no_nota = xp.no_nota)
														INNER JOIN gb_produk pd
																ON (xpd.id_produk = pd.id_produk)
												WHERE (UPPER(xp.id_jenis_lokasi) = "OUT"
														AND xp.id_lokasi = id_outlet
														AND xp.tgl_transaksi BETWEEN "'.$this->tanggal_mulai.'" AND "'.$this->tanggal_selesai.'"
														AND UPPER(pd.id_jenis_produk) = "INVGA"
														AND pd.id_jenis_inject = 3)
										) AS avg_invga_hd
							FROM
									eb_outlet l
									INNER JOIN bd_tap t
											ON (l.id_tap = t.id_tap)
							WHERE (t.id_cluster = "'.$id_cluster.'"
									AND l.status = "OPEN")
						) xx
					');

					$rs_c = $this->db->get()->result_array();

					if (!empty($rs_c))
					{
						for ($c=0; $c<count($rs_c); $c++)
						{
							// BEGIN LOOP OUTLET

							$id_outlet = $rs_c[$c]['id_outlet'] ? $rs_c[$c]['id_outlet'] : 0;
							$avg_sgprepaid = $rs_c[$c]['avg_sgprepaid'] ? $rs_c[$c]['avg_sgprepaid'] : 0;
							$avg_sgota = $rs_c[$c]['avg_sgota'] ? $rs_c[$c]['avg_sgota'] : 0;
							$avg_sgvin = $rs_c[$c]['avg_sgvin'] ? $rs_c[$c]['avg_sgvin'] : 0;
							$avg_sgvgs = $rs_c[$c]['avg_sgvgs'] ? $rs_c[$c]['avg_sgvgs'] : 0;
							$avg_sgvgg = $rs_c[$c]['avg_sgvgg'] ? $rs_c[$c]['avg_sgvgg'] : 0;
							$avg_sgvgp = $rs_c[$c]['avg_sgvgp'] ? $rs_c[$c]['avg_sgvgp'] : 0;
							$avg_insac_ld = $rs_c[$c]['avg_insac_ld'] ? $rs_c[$c]['avg_insac_ld'] : 0;
							$avg_insac_md = $rs_c[$c]['avg_insac_md'] ? $rs_c[$c]['avg_insac_md'] : 0;
							$avg_insac_hd = $rs_c[$c]['avg_insac_hd'] ? $rs_c[$c]['avg_insac_hd'] : 0;
							$avg_invin_ld = $rs_c[$c]['avg_invin_ld'] ? $rs_c[$c]['avg_invin_ld'] : 0;
							$avg_invin_md = $rs_c[$c]['avg_invin_md'] ? $rs_c[$c]['avg_invin_md'] : 0;
							$avg_invin_hd = $rs_c[$c]['avg_invin_hd'] ? $rs_c[$c]['avg_invin_hd'] : 0;
							$avg_invga_ld = $rs_c[$c]['avg_invga_ld'] ? $rs_c[$c]['avg_invga_ld'] : 0;
							$avg_invga_md = $rs_c[$c]['avg_invga_md'] ? $rs_c[$c]['avg_invga_md'] : 0;
							$avg_invga_hd = $rs_c[$c]['avg_invga_hd'] ? $rs_c[$c]['avg_invga_hd'] : 0;

							$bobot_sgprepaid = (($avg_sgprepaid / $total_sgprepaid) * 100);
							$bobot_sgota = (($avg_sgota / $total_sgota) * 100);
							$bobot_sgvin = (($avg_sgvin / $total_sgvin) * 100);
							$bobot_sgvgs = (($avg_sgvgs / $total_sgvgs) * 100);
							$bobot_sgvgg = (($avg_sgvgg / $total_sgvgg) * 100);
							$bobot_sgvgp = (($avg_sgvgp / $total_sgvgp) * 100);
							$bobot_insac_ld = (($avg_insac_ld / $total_insac_ld) * 100);
							$bobot_insac_md = (($avg_insac_md / $total_insac_md) * 100);
							$bobot_insac_hd = (($avg_insac_hd / $total_insac_hd) * 100);
							$bobot_invin_ld = (($avg_invin_ld / $total_invin_ld) * 100);
							$bobot_invin_md = (($avg_invin_md / $total_invin_md) * 100);
							$bobot_invin_hd = (($avg_invin_hd / $total_invin_hd) * 100);
							$bobot_invga_ld = (($avg_invga_ld / $total_invga_ld) * 100);
							$bobot_invga_md = (($avg_invga_md / $total_invga_md) * 100);
							$bobot_invga_hd = (($avg_invga_hd / $total_invga_hd) * 100);

							$target_sgprepaid = FLOOR(($bobot_sgprepaid * $rekom_sgprepaid) / 100);
							$target_sgota = FLOOR(($bobot_sgota * $rekom_sgota) / 100);
							$target_sgvin = FLOOR(($bobot_sgvin * $rekom_sgvin) / 100);
							$target_sgvgs = FLOOR(($bobot_sgvgs * $rekom_sgvgs) / 100);
							$target_sgvgg = FLOOR(($bobot_sgvgg * $rekom_sgvgg) / 100);
							$target_sgvgp = FLOOR(($bobot_sgvgp * $rekom_sgvgp) / 100);
							$target_insac_ld = FLOOR(($bobot_insac_ld * $rekom_insac_ld) / 100);
							$target_insac_md = FLOOR(($bobot_insac_md * $rekom_insac_md) / 100);
							$target_insac_hd = FLOOR(($bobot_insac_hd * $rekom_insac_hd) / 100);
							$target_invin_ld = FLOOR(($bobot_invin_ld * $rekom_invin_ld) / 100);
							$target_invin_md = FLOOR(($bobot_invin_md * $rekom_invin_md) / 100);
							$target_invin_hd = FLOOR(($bobot_invin_hd * $rekom_invin_hd) / 100);
							$target_invga_ld = FLOOR(($bobot_invga_ld * $rekom_invga_ld) / 100);
							$target_invga_md = FLOOR(($bobot_invga_md * $rekom_invga_md) / 100);
							$target_invga_hd = FLOOR(($bobot_invga_hd * $rekom_invga_hd) / 100);


							$this->db->select('1');
							$this->db->from('kb_rekomendasi_outlet');
							$this->db->where('id_outlet', $id_outlet);
							$this->db->where('tahun', $this->tahun);
							$this->db->where('bulan', $this->bulan);
							$this->db->where('minggu', $this->minggu);

							$rs_d = $this->db->get()->row_array();

							if ($rs_d) // JIKA SUDAH ADA MAKA UPDATE DATANYA
							{
								$data_x = array(
									'id_outlet' => $id_outlet,
									'tahun' => $this->tahun,
									'bulan' => $this->bulan,
									'minggu' => $this->minggu,
									'avg_sgprepaid' => $avg_sgprepaid,
									'avg_sgota' => $avg_sgota,
									'avg_sgvin' => $avg_sgvin,
									'avg_sgvgs' => $avg_sgvgs,
									'avg_sgvgg' => $avg_sgvgg,
									'avg_sgvgp' => $avg_sgvgp,
									'avg_insac_ld' => $avg_insac_ld,
									'avg_insac_md' => $avg_insac_md,
									'avg_insac_hd' => $avg_insac_hd,
									'avg_invin_ld' => $avg_invin_ld,
									'avg_invin_md' => $avg_invin_md,
									'avg_invin_hd' => $avg_invin_hd,
									'avg_invga_ld' => $avg_invga_ld,
									'avg_invga_md' => $avg_invga_md,
									'avg_invga_hd' => $avg_invga_hd,

									'bobot_sgprepaid' => $bobot_sgprepaid,
									'bobot_sgota' => $bobot_sgota,
									'bobot_sgvin' => $bobot_sgvin,
									'bobot_sgvgs' => $bobot_sgvgs,
									'bobot_sgvgg' => $bobot_sgvgg,
									'bobot_sgvgp' => $bobot_sgvgp,
									'bobot_insac_ld' => $bobot_insac_ld,
									'bobot_insac_md' => $bobot_insac_md,
									'bobot_insac_hd' => $bobot_insac_hd,
									'bobot_invin_ld' => $bobot_invin_ld,
									'bobot_invin_md' => $bobot_invin_md,
									'bobot_invin_hd' => $bobot_invin_hd,
									'bobot_invga_ld' => $bobot_invga_ld,
									'bobot_invga_md' => $bobot_invga_md,
									'bobot_invga_hd' => $bobot_invga_hd,

									'target_sgprepaid' => $target_sgprepaid,
									'target_sgota' => $target_sgota,
									'target_sgvin' => $target_sgvin,
									'target_sgvgs' => $target_sgvgs,
									'target_sgvgg' => $target_sgvgg,
									'target_sgvgp' => $target_sgvgp,
									'target_insac_ld' => $target_insac_ld,
									'target_insac_md' => $target_insac_md,
									'target_insac_hd' => $target_insac_hd,
									'target_invin_ld' => $target_invin_ld,
									'target_invin_md' => $target_invin_md,
									'target_invin_hd' => $target_invin_hd,
									'target_invga_ld' => $target_invga_ld,
									'target_invga_md' => $target_invga_md,
									'target_invga_hd' => $target_invga_hd,

									'target_edit_sgprepaid' => $target_sgprepaid,
									'target_edit_sgota' => $target_sgota,
									'target_edit_sgvin' => $target_sgvin,
									'target_edit_sgvgs' => $target_sgvgs,
									'target_edit_sgvgg' => $target_sgvgg,
									'target_edit_sgvgp' => $target_sgvgp,
									'target_edit_insac_ld' => $target_insac_ld,
									'target_edit_insac_md' => $target_insac_md,
									'target_edit_insac_hd' => $target_insac_hd,
									'target_edit_invin_ld' => $target_invin_ld,
									'target_edit_invin_md' => $target_invin_md,
									'target_edit_invin_hd' => $target_invin_hd,
									'target_edit_invga_ld' => $target_invga_ld,
									'target_edit_invga_md' => $target_invga_md,
									'target_edit_invga_hd' => $target_invga_hd
								);

								$this->db->where('id_outlet', $id_outlet);
								$this->db->where('tahun', $this->tahun);
								$this->db->where('bulan', $this->bulan);
								$this->db->where('minggu', $this->minggu);
								$this->db->update('kb_rekomendasi_outlet', $data_x);
								$this->check_trans_status('update kb_rekomendasi_outlet failed');
							}
							else // JIKA BELUM ADA TAMBAH DATA BARU
							{
								$data_x = array(
									'id_outlet' => $id_outlet,
									'tahun' => $this->tahun,
									'bulan' => $this->bulan,
									'minggu' => $this->minggu,
									'avg_sgprepaid' => $avg_sgprepaid,
									'avg_sgota' => $avg_sgota,
									'avg_sgvin' => $avg_sgvin,
									'avg_sgvgs' => $avg_sgvgs,
									'avg_sgvgg' => $avg_sgvgg,
									'avg_sgvgp' => $avg_sgvgp,
									'avg_insac_ld' => $avg_insac_ld,
									'avg_insac_md' => $avg_insac_md,
									'avg_insac_hd' => $avg_insac_hd,
									'avg_invin_ld' => $avg_invin_ld,
									'avg_invin_md' => $avg_invin_md,
									'avg_invin_hd' => $avg_invin_hd,
									'avg_invga_ld' => $avg_invga_ld,
									'avg_invga_md' => $avg_invga_md,
									'avg_invga_hd' => $avg_invga_hd,

									'bobot_sgprepaid' => $bobot_sgprepaid,
									'bobot_sgota' => $bobot_sgota,
									'bobot_sgvin' => $bobot_sgvin,
									'bobot_sgvgs' => $bobot_sgvgs,
									'bobot_sgvgg' => $bobot_sgvgg,
									'bobot_sgvgp' => $bobot_sgvgp,
									'bobot_insac_ld' => $bobot_insac_ld,
									'bobot_insac_md' => $bobot_insac_md,
									'bobot_insac_hd' => $bobot_insac_hd,
									'bobot_invin_ld' => $bobot_invin_ld,
									'bobot_invin_md' => $bobot_invin_md,
									'bobot_invin_hd' => $bobot_invin_hd,
									'bobot_invga_ld' => $bobot_invga_ld,
									'bobot_invga_md' => $bobot_invga_md,
									'bobot_invga_hd' => $bobot_invga_hd,

									'target_sgprepaid' => $target_sgprepaid,
									'target_sgota' => $target_sgota,
									'target_sgvin' => $target_sgvin,
									'target_sgvgs' => $target_sgvgs,
									'target_sgvgg' => $target_sgvgg,
									'target_sgvgp' => $target_sgvgp,
									'target_insac_ld' => $target_insac_ld,
									'target_insac_md' => $target_insac_md,
									'target_insac_hd' => $target_insac_hd,
									'target_invin_ld' => $target_invin_ld,
									'target_invin_md' => $target_invin_md,
									'target_invin_hd' => $target_invin_hd,
									'target_invga_ld' => $target_invga_ld,
									'target_invga_md' => $target_invga_md,
									'target_invga_hd' => $target_invga_hd,

									'target_edit_sgprepaid' => $target_sgprepaid,
									'target_edit_sgota' => $target_sgota,
									'target_edit_sgvin' => $target_sgvin,
									'target_edit_sgvgs' => $target_sgvgs,
									'target_edit_sgvgg' => $target_sgvgg,
									'target_edit_sgvgp' => $target_sgvgp,
									'target_edit_insac_ld' => $target_insac_ld,
									'target_edit_insac_md' => $target_insac_md,
									'target_edit_insac_hd' => $target_insac_hd,
									'target_edit_invin_ld' => $target_invin_ld,
									'target_edit_invin_md' => $target_invin_md,
									'target_edit_invin_hd' => $target_invin_hd,
									'target_edit_invga_ld' => $target_invga_ld,
									'target_edit_invga_md' => $target_invga_md,
									'target_edit_invga_hd' => $target_invga_hd
								);

								$this->db->insert('kb_rekomendasi_outlet', $data_x);
								$this->check_trans_status('insert kb_rekomendasi_outlet failed');
							}

							// END LOOP OUTLET
						}
					}

					// END CRON JOB
				}

				// END LOOP CLUSTER
			}
		}
	}
}
?>