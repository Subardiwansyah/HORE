<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cluster_model extends CI_model {

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

	function save_data_cluster()
  {
    $this->db->trans_begin();
    try {

			$this->insert_data_cluster();
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

	function insert_data_cluster()
  {
		$tahun_sekarang = date('Y');
		$bulan_sekarang = date('m');

		$this->db->select('
				xx.id_cluster
				, xx.nama_cluster

				, xx.outlet_segel_prepaid
				, xx.outlet_segel_voucher
				, (xx.outlet_segel_prepaid + xx.outlet_segel_voucher) AS outlet_segel_total
				, xx.outlet_sa_ld
				, xx.outlet_sa_md
				, xx.outlet_sa_hd
				, (xx.outlet_sa_ld + xx.outlet_sa_md + xx.outlet_sa_hd) AS outlet_sa_total
				, xx.outlet_vf_ld
				, xx.outlet_vf_md
				, xx.outlet_vf_hd
				, (xx.outlet_vf_ld + xx.outlet_vf_md + xx.outlet_vf_hd) AS outlet_vf_total
				, xx.outlet_linkaja

				, xx.sekolah_segel_prepaid
				, xx.sekolah_segel_voucher
				, (xx.sekolah_segel_prepaid + xx.sekolah_segel_voucher) AS sekolah_segel_total
				, xx.sekolah_sa_ld
				, xx.sekolah_sa_md
				, xx.sekolah_sa_hd
				, (xx.sekolah_sa_ld + xx.sekolah_sa_md + xx.sekolah_sa_hd) AS sekolah_sa_total
				, xx.sekolah_vf_ld
				, xx.sekolah_vf_md
				, xx.sekolah_vf_hd
				, (xx.sekolah_vf_ld + xx.sekolah_vf_md + xx.sekolah_vf_hd) AS sekolah_vf_total
				, xx.sekolah_linkaja

				, xx.kampus_segel_prepaid
				, xx.kampus_segel_voucher
				, (xx.kampus_segel_prepaid + xx.kampus_segel_voucher) AS kampus_segel_total
				, xx.kampus_sa_ld
				, xx.kampus_sa_md
				, xx.kampus_sa_hd
				, (xx.kampus_sa_ld + xx.kampus_sa_md + xx.kampus_sa_hd) AS kampus_sa_total
				, xx.kampus_vf_ld
				, xx.kampus_vf_md
				, xx.kampus_vf_hd
				, (xx.kampus_vf_ld + xx.kampus_vf_md + xx.kampus_vf_hd) AS kampus_vf_total
				, xx.kampus_linkaja

				, xx.fakultas_segel_prepaid
				, xx.fakultas_segel_voucher
				, (xx.fakultas_segel_prepaid + xx.fakultas_segel_voucher) AS fakultas_segel_total
				, xx.fakultas_sa_ld
				, xx.fakultas_sa_md
				, xx.fakultas_sa_hd
				, (xx.fakultas_sa_ld + xx.fakultas_sa_md + xx.fakultas_sa_hd) AS fakultas_sa_total
				, xx.fakultas_vf_ld
				, xx.fakultas_vf_md
				, xx.fakultas_vf_hd
				, (xx.fakultas_vf_ld + xx.fakultas_vf_md + xx.fakultas_vf_hd) AS fakultas_vf_total
				, xx.fakultas_linkaja

				, xx.poi_segel_prepaid
				, xx.poi_segel_voucher
				, (xx.poi_segel_prepaid + xx.poi_segel_voucher) AS poi_segel_total
				, xx.poi_sa_ld
				, xx.poi_sa_md
				, xx.poi_sa_hd
				, (xx.poi_sa_ld + xx.poi_sa_md + xx.poi_sa_hd) AS poi_sa_total
				, xx.poi_vf_ld
				, xx.poi_vf_md
				, xx.poi_vf_hd
				, (xx.poi_vf_ld + xx.poi_vf_md + xx.poi_vf_hd) AS poi_vf_total
				, xx.poi_linkaja
		');
		$this->db->from('
			(
					SELECT
							c.id_cluster
							, c.nama_cluster
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "OUT"
												AND xp.id_jenis_produk IN ("SGPREPAID", "SGOTA"))
								) AS outlet_segel_prepaid
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "OUT"
												AND xp.id_jenis_produk IN ("SGVIN", "SGVGS", "SGVGG", "SGVGP"))
								) AS outlet_segel_voucher
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "OUT"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 1)
								) AS outlet_sa_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "OUT"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 2)
								) AS outlet_sa_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "OUT"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 3)
								) AS outlet_sa_hd
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "OUT"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 1)
								) AS outlet_vf_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "OUT"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 2)
								) AS outlet_vf_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "OUT"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 3)
								) AS outlet_vf_hd
							, (
										SELECT
												COALESCE(SUM(xpj.link_aja), 0)
										FROM
												jc_penjualan xpj
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "OUT")
								) AS outlet_linkaja


							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "SEK"
												AND xp.id_jenis_produk IN ("SGPREPAID", "SGOTA"))
								) AS sekolah_segel_prepaid
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "SEK"
												AND xp.id_jenis_produk IN ("SGVIN", "SGVGS", "SGVGG", "SGVGP"))
								) AS sekolah_segel_voucher
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "SEK"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 1)
								) AS sekolah_sa_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "SEK"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 2)
								) AS sekolah_sa_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "SEK"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 3)
								) AS sekolah_sa_hd
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "SEK"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 1)
								) AS sekolah_vf_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "SEK"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 2)
								) AS sekolah_vf_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "SEK"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 3)
								) AS sekolah_vf_hd
							, (
										SELECT
												COALESCE(SUM(xpj.link_aja), 0)
										FROM
												jc_penjualan xpj
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "SEK")
								) AS sekolah_linkaja


							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "KAM"
												AND xp.id_jenis_produk IN ("SGPREPAID", "SGOTA"))
								) AS kampus_segel_prepaid
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "KAM"
												AND xp.id_jenis_produk IN ("SGVIN", "SGVGS", "SGVGG", "SGVGP"))
								) AS kampus_segel_voucher
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "KAM"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 1)
								) AS kampus_sa_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "KAM"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 2)
								) AS kampus_sa_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "KAM"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 3)
								) AS kampus_sa_hd
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "KAM"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 1)
								) AS kampus_vf_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "KAM"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 2)
								) AS kampus_vf_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "KAM"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 3)
								) AS kampus_vf_hd
							, (
										SELECT
												COALESCE(SUM(xpj.link_aja), 0)
										FROM
												jc_penjualan xpj
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "KAM")
								) AS kampus_linkaja


							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "FAK"
												AND xp.id_jenis_produk IN ("SGPREPAID", "SGOTA"))
								) AS fakultas_segel_prepaid
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "FAK"
												AND xp.id_jenis_produk IN ("SGVIN", "SGVGS", "SGVGG", "SGVGP"))
								) AS fakultas_segel_voucher
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "FAK"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 1)
								) AS fakultas_sa_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "FAK"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 2)
								) AS fakultas_sa_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "FAK"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 3)
								) AS fakultas_sa_hd
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "FAK"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 1)
								) AS fakultas_vf_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "FAK"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 2)
								) AS fakultas_vf_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "FAK"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 3)
								) AS fakultas_vf_hd
							, (
										SELECT
												COALESCE(SUM(xpj.link_aja), 0)
										FROM
												jc_penjualan xpj
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "FAK")
								) AS fakultas_linkaja


							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "POI"
												AND xp.id_jenis_produk IN ("SGPREPAID", "SGOTA"))
								) AS poi_segel_prepaid
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "POI"
												AND xp.id_jenis_produk IN ("SGVIN", "SGVGS", "SGVGG", "SGVGP"))
								) AS poi_segel_voucher
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "POI"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 1)
								) AS poi_sa_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "POI"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 2)
								) AS poi_sa_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "POI"
												AND xp.id_jenis_produk IN ("INSAC")
												AND xp.id_jenis_inject = 3)
								) AS poi_sa_hd
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "POI"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 1)
								) AS poi_vf_ld
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "POI"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 2)
								) AS poi_vf_md
							, (
										SELECT
												COUNT(xpjd.id_penjualan_detail)
										FROM
												jd_penjualan_detail xpjd
												INNER JOIN jc_penjualan xpj
														ON (xpjd.no_nota = xpj.no_nota)
												INNER JOIN gb_produk xp
														ON (xpjd.id_produk = xp.id_produk)
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "POI"
												AND xp.id_jenis_produk IN ("INVIN", "INVGA")
												AND xp.id_jenis_inject = 3)
								) AS poi_vf_hd
							, (
										SELECT
												COALESCE(SUM(xpj.link_aja), 0)
										FROM
												jc_penjualan xpj
												INNER JOIN db_sales xs
														ON (xpj.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_cluster = c.id_cluster
												AND DATE_FORMAT(xpj.tgl_transaksi, "%Y") =  "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan_sekarang.'"
												AND xpj.id_jenis_lokasi = "POI")
								) AS poi_linkaja
					FROM
							bc_cluster c
			) xx
		');
		$rs = $this->db->get()->result_array();

		if (!empty($rs))
		{
			for ($x=0; $x<count($rs); $x++)
			{
				$this->db->select('1');
				$this->db->from('ak_dashboard_distribusi_cluster');
				$this->db->where('tahun', $tahun_sekarang);
				$this->db->where('bulan', (int) $bulan_sekarang);
				$this->db->where('id_cluster', $rs[$x]['id_cluster']);
				$rsx = $this->db->get()->row_array();

				if ($rsx)
				{
					$data_x = array(
						'tahun' => $tahun_sekarang,
						'bulan' => $bulan_sekarang,
						'id_cluster' => $rs[$x]['id_cluster'],

						'outlet_segel_prepaid' => $rs[$x]['outlet_segel_prepaid'],
						'outlet_segel_voucher' => $rs[$x]['outlet_segel_voucher'],
						'outlet_segel_total' => $rs[$x]['outlet_segel_total'],
						'outlet_sa_ld' => $rs[$x]['outlet_sa_ld'],
						'outlet_sa_md' => $rs[$x]['outlet_sa_md'],
						'outlet_sa_hd' => $rs[$x]['outlet_sa_hd'],
						'outlet_sa_total' => $rs[$x]['outlet_sa_total'],
						'outlet_vf_ld' => $rs[$x]['outlet_vf_ld'],
						'outlet_vf_md' => $rs[$x]['outlet_vf_md'],
						'outlet_vf_hd' => $rs[$x]['outlet_vf_hd'],
						'outlet_vf_total' => $rs[$x]['outlet_vf_total'],
						'outlet_linkaja' => $rs[$x]['outlet_linkaja'],

						'sekolah_segel_prepaid' => $rs[$x]['sekolah_segel_prepaid'],
						'sekolah_segel_voucher' => $rs[$x]['sekolah_segel_voucher'],
						'sekolah_segel_total' => $rs[$x]['sekolah_segel_total'],
						'sekolah_sa_ld' => $rs[$x]['sekolah_sa_ld'],
						'sekolah_sa_md' => $rs[$x]['sekolah_sa_md'],
						'sekolah_sa_hd' => $rs[$x]['sekolah_sa_hd'],
						'sekolah_sa_total' => $rs[$x]['sekolah_sa_total'],
						'sekolah_vf_ld' => $rs[$x]['sekolah_vf_ld'],
						'sekolah_vf_md' => $rs[$x]['sekolah_vf_md'],
						'sekolah_vf_hd' => $rs[$x]['sekolah_vf_hd'],
						'sekolah_vf_total' => $rs[$x]['sekolah_vf_total'],
						'sekolah_linkaja' => $rs[$x]['sekolah_linkaja'],

						'kampus_segel_prepaid' => $rs[$x]['kampus_segel_prepaid'],
						'kampus_segel_voucher' => $rs[$x]['kampus_segel_voucher'],
						'kampus_segel_total' => $rs[$x]['kampus_segel_total'],
						'kampus_sa_ld' => $rs[$x]['kampus_sa_ld'],
						'kampus_sa_md' => $rs[$x]['kampus_sa_md'],
						'kampus_sa_hd' => $rs[$x]['kampus_sa_hd'],
						'kampus_sa_total' => $rs[$x]['kampus_sa_total'],
						'kampus_vf_ld' => $rs[$x]['kampus_vf_ld'],
						'kampus_vf_md' => $rs[$x]['kampus_vf_md'],
						'kampus_vf_hd' => $rs[$x]['kampus_vf_hd'],
						'kampus_vf_total' => $rs[$x]['kampus_vf_total'],
						'kampus_linkaja' => $rs[$x]['kampus_linkaja'],

						'fakultas_segel_prepaid' => $rs[$x]['fakultas_segel_prepaid'],
						'fakultas_segel_voucher' => $rs[$x]['fakultas_segel_voucher'],
						'fakultas_segel_total' => $rs[$x]['fakultas_segel_total'],
						'fakultas_sa_ld' => $rs[$x]['fakultas_sa_ld'],
						'fakultas_sa_md' => $rs[$x]['fakultas_sa_md'],
						'fakultas_sa_hd' => $rs[$x]['fakultas_sa_hd'],
						'fakultas_sa_total' => $rs[$x]['fakultas_sa_total'],
						'fakultas_vf_ld' => $rs[$x]['fakultas_vf_ld'],
						'fakultas_vf_md' => $rs[$x]['fakultas_vf_md'],
						'fakultas_vf_hd' => $rs[$x]['fakultas_vf_hd'],
						'fakultas_vf_total' => $rs[$x]['fakultas_vf_total'],
						'fakultas_linkaja' => $rs[$x]['fakultas_linkaja'],

						'poi_segel_prepaid' => $rs[$x]['poi_segel_prepaid'],
						'poi_segel_voucher' => $rs[$x]['poi_segel_voucher'],
						'poi_segel_total' => $rs[$x]['poi_segel_total'],
						'poi_sa_ld' => $rs[$x]['poi_sa_ld'],
						'poi_sa_md' => $rs[$x]['poi_sa_md'],
						'poi_sa_hd' => $rs[$x]['poi_sa_hd'],
						'poi_sa_total' => $rs[$x]['poi_sa_total'],
						'poi_vf_ld' => $rs[$x]['poi_vf_ld'],
						'poi_vf_md' => $rs[$x]['poi_vf_md'],
						'poi_vf_hd' => $rs[$x]['poi_vf_hd'],
						'poi_vf_total' => $rs[$x]['poi_vf_total'],
						'poi_linkaja' => $rs[$x]['poi_linkaja']
					);

					$this->db->where('tahun', $tahun_sekarang);
					$this->db->where('bulan', (int) $bulan_sekarang);
					$this->db->where('id_cluster', $rs[$x]['id_cluster']);
					$this->db->update('ak_dashboard_distribusi_cluster', $data_x);
					$this->check_trans_status('update ak_dashboard_distribusi_cluster failed');
				}
				else
				{
					$data_x = array(
						'tahun' => $tahun_sekarang,
						'bulan' => $bulan_sekarang,
						'id_cluster' => $rs[$x]['id_cluster'],

						'outlet_segel_prepaid' => $rs[$x]['outlet_segel_prepaid'],
						'outlet_segel_voucher' => $rs[$x]['outlet_segel_voucher'],
						'outlet_segel_total' => $rs[$x]['outlet_segel_total'],
						'outlet_sa_ld' => $rs[$x]['outlet_sa_ld'],
						'outlet_sa_md' => $rs[$x]['outlet_sa_md'],
						'outlet_sa_hd' => $rs[$x]['outlet_sa_hd'],
						'outlet_sa_total' => $rs[$x]['outlet_sa_total'],
						'outlet_vf_ld' => $rs[$x]['outlet_vf_ld'],
						'outlet_vf_md' => $rs[$x]['outlet_vf_md'],
						'outlet_vf_hd' => $rs[$x]['outlet_vf_hd'],
						'outlet_vf_total' => $rs[$x]['outlet_vf_total'],
						'outlet_linkaja' => $rs[$x]['outlet_linkaja'],

						'sekolah_segel_prepaid' => $rs[$x]['sekolah_segel_prepaid'],
						'sekolah_segel_voucher' => $rs[$x]['sekolah_segel_voucher'],
						'sekolah_segel_total' => $rs[$x]['sekolah_segel_total'],
						'sekolah_sa_ld' => $rs[$x]['sekolah_sa_ld'],
						'sekolah_sa_md' => $rs[$x]['sekolah_sa_md'],
						'sekolah_sa_hd' => $rs[$x]['sekolah_sa_hd'],
						'sekolah_sa_total' => $rs[$x]['sekolah_sa_total'],
						'sekolah_vf_ld' => $rs[$x]['sekolah_vf_ld'],
						'sekolah_vf_md' => $rs[$x]['sekolah_vf_md'],
						'sekolah_vf_hd' => $rs[$x]['sekolah_vf_hd'],
						'sekolah_vf_total' => $rs[$x]['sekolah_vf_total'],
						'sekolah_linkaja' => $rs[$x]['sekolah_linkaja'],

						'kampus_segel_prepaid' => $rs[$x]['kampus_segel_prepaid'],
						'kampus_segel_voucher' => $rs[$x]['kampus_segel_voucher'],
						'kampus_segel_total' => $rs[$x]['kampus_segel_total'],
						'kampus_sa_ld' => $rs[$x]['kampus_sa_ld'],
						'kampus_sa_md' => $rs[$x]['kampus_sa_md'],
						'kampus_sa_hd' => $rs[$x]['kampus_sa_hd'],
						'kampus_sa_total' => $rs[$x]['kampus_sa_total'],
						'kampus_vf_ld' => $rs[$x]['kampus_vf_ld'],
						'kampus_vf_md' => $rs[$x]['kampus_vf_md'],
						'kampus_vf_hd' => $rs[$x]['kampus_vf_hd'],
						'kampus_vf_total' => $rs[$x]['kampus_vf_total'],
						'kampus_linkaja' => $rs[$x]['kampus_linkaja'],

						'fakultas_segel_prepaid' => $rs[$x]['fakultas_segel_prepaid'],
						'fakultas_segel_voucher' => $rs[$x]['fakultas_segel_voucher'],
						'fakultas_segel_total' => $rs[$x]['fakultas_segel_total'],
						'fakultas_sa_ld' => $rs[$x]['fakultas_sa_ld'],
						'fakultas_sa_md' => $rs[$x]['fakultas_sa_md'],
						'fakultas_sa_hd' => $rs[$x]['fakultas_sa_hd'],
						'fakultas_sa_total' => $rs[$x]['fakultas_sa_total'],
						'fakultas_vf_ld' => $rs[$x]['fakultas_vf_ld'],
						'fakultas_vf_md' => $rs[$x]['fakultas_vf_md'],
						'fakultas_vf_hd' => $rs[$x]['fakultas_vf_hd'],
						'fakultas_vf_total' => $rs[$x]['fakultas_vf_total'],
						'fakultas_linkaja' => $rs[$x]['fakultas_linkaja'],

						'poi_segel_prepaid' => $rs[$x]['poi_segel_prepaid'],
						'poi_segel_voucher' => $rs[$x]['poi_segel_voucher'],
						'poi_segel_total' => $rs[$x]['poi_segel_total'],
						'poi_sa_ld' => $rs[$x]['poi_sa_ld'],
						'poi_sa_md' => $rs[$x]['poi_sa_md'],
						'poi_sa_hd' => $rs[$x]['poi_sa_hd'],
						'poi_sa_total' => $rs[$x]['poi_sa_total'],
						'poi_vf_ld' => $rs[$x]['poi_vf_ld'],
						'poi_vf_md' => $rs[$x]['poi_vf_md'],
						'poi_vf_hd' => $rs[$x]['poi_vf_hd'],
						'poi_vf_total' => $rs[$x]['poi_vf_total'],
						'poi_linkaja' => $rs[$x]['poi_linkaja']
					);

					$this->db->insert('ak_dashboard_distribusi_cluster', $data_x);
					$this->check_trans_status('insert ak_dashboard_distribusi_cluster failed');
				}
			}
		}
	}
}
?>