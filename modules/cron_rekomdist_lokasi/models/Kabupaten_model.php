<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten_model extends CI_model {

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

	function save_data_kabupaten()
  {
    $this->db->trans_begin();
    try {

			$this->insert_data_kabupaten();
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

	function insert_data_kabupaten()
  {
		$tahun_sekarang = date('Y');
		$bulan_sekarang = date('m');

		$this->db->select('
				xx.id_kabupaten
				, xx.nama_kabupaten
				, xx.outlet_open
				, xx.outlet_close
				, (xx.outlet_open + xx.outlet_close) AS outlet_total
				, xx.outlet_new
				, xx.outlet_device
				, xx.outlet_reguler
				, xx.outlet_pareto
				, xx.outlet_pjp
				, xx.outlet_clockin
				, xx.outlet_pjp AS outlet_target
				, ROUND(COALESCE(((xx.outlet_clockin / xx.outlet_pjp) * 100), 0), 2) AS outlet_coverage
				
				, xx.sekolah_open
				, xx.sekolah_close
				, (xx.sekolah_open + xx.sekolah_close) AS sekolah_total
				, xx.sekolah_new
				, xx.sekolah_pjp
				, xx.sekolah_clockin
				, xx.sekolah_pjp AS sekolah_target
				, ROUND(COALESCE(((xx.sekolah_clockin / xx.sekolah_pjp) * 100), 0), 2) AS sekolah_coverage
				
				, xx.kampus_open
				, xx.kampus_close
				, (xx.kampus_open + xx.kampus_close) AS kampus_total
				, xx.kampus_new
				, xx.kampus_pjp
				, xx.kampus_clockin
				, xx.kampus_pjp AS kampus_target
				, ROUND(COALESCE(((xx.kampus_clockin / xx.kampus_pjp) * 100), 0), 2) AS kampus_coverage
				
				, xx.fakultas_open
				, xx.fakultas_close
				, (xx.fakultas_open + xx.fakultas_close) AS fakultas_total
				, xx.fakultas_new
				, xx.fakultas_pjp
				, xx.fakultas_clockin
				, xx.fakultas_pjp AS fakultas_target
				, ROUND(COALESCE(((xx.fakultas_clockin / xx.fakultas_pjp) * 100), 0), 2) AS fakultas_coverage
				
				, xx.poi_open
				, xx.poi_close
				, (xx.poi_open + xx.poi_close) AS poi_total
				, xx.poi_new
				, xx.poi_pjp
				, xx.poi_clockin
				, xx.poi_pjp AS poi_target
				, ROUND(COALESCE(((xx.poi_clockin / xx.poi_pjp) * 100), 0), 2) AS poi_coverage
		');
		$this->db->from('
			(
					SELECT
							kb.id_kabupaten
							, kb.nama_kabupaten
							, (
										SELECT
												COUNT(xl.id_outlet)
										FROM
												eb_outlet xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "OPEN")
								) AS outlet_open
							,(
										SELECT
												COUNT(xl.id_outlet)
										FROM
												eb_outlet xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_close, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_close, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "CLOSE")
								) AS outlet_close
							, (
										SELECT
												COUNT(xl.id_outlet)
										FROM
												eb_outlet xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "WAITING APPROVAL")
								) AS outlet_new
							, (
										SELECT
												COUNT(xl.id_outlet)
										FROM
												eb_outlet xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.id_jenis_outlet = 1
												AND xl.status = "OPEN")
								) AS outlet_device
							, (
										SELECT
												COUNT(xl.id_outlet)
										FROM
												eb_outlet xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.id_jenis_outlet = 2
												AND xl.status = "OPEN")
								) AS outlet_reguler
							, (
										SELECT
												COUNT(xl.id_outlet)
										FROM
												eb_outlet xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.id_jenis_outlet = 3
												AND xl.status = "OPEN")
								) AS outlet_pareto
							, (
										SELECT
												COUNT(xd.id_daftar_pjp)
										FROM
												fe_daftar_pjp xd
												INNER JOIN db_sales xs
														ON (xd.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xd.tanggal, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xd.tanggal, "%m") = "'.$bulan_sekarang.'"
												AND xd.id_jenis_lokasi = "OUT")
								) AS outlet_pjp
							, (
										SELECT
												COUNT(xh.id_history_pjp)
										FROM
												fb_histroy_pjp xh
												INNER JOIN db_sales xs
														ON (xh.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xh.tanggal, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xh.tanggal, "%m") = "'.$bulan_sekarang.'"
												AND xh.jam_clock_in <> "00:00:00"
												AND xh.id_jenis_lokasi = "OUT")
								) AS outlet_clockin
							
							
							, (
										SELECT
												COUNT(xl.id_sekolah)
										FROM
												ec_sekolah xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "OPEN")
								) AS sekolah_open
							,(
										SELECT
												COUNT(xl.id_sekolah)
										FROM
												ec_sekolah xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_close, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_close, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "CLOSE")
								) AS sekolah_close
							, (
										SELECT
												COUNT(xl.id_sekolah)
										FROM
												ec_sekolah xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "WAITING APPROVAL")
								) AS sekolah_new
							, (
										SELECT
												COUNT(xd.id_daftar_pjp)
										FROM
												fe_daftar_pjp xd
												INNER JOIN db_sales xs
														ON (xd.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xd.tanggal, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xd.tanggal, "%m") = "'.$bulan_sekarang.'"
												AND xd.id_jenis_lokasi = "SEK")
								) AS sekolah_pjp
							, (
										SELECT
												COUNT(xh.id_history_pjp)
										FROM
												fb_histroy_pjp xh
												INNER JOIN db_sales xs
														ON (xh.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xh.tanggal, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xh.tanggal, "%m") = "'.$bulan_sekarang.'"
												AND xh.jam_clock_in <> "00:00:00"
												AND xh.id_jenis_lokasi = "SEK")
								) AS sekolah_clockin
								
							
							, (
										SELECT
												COUNT(xl.id_universitas)
										FROM
												ed_kampus xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "OPEN")
								) AS kampus_open
							,(
										SELECT
												COUNT(xl.id_universitas)
										FROM
												ed_kampus xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_close, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_close, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "CLOSE")
								) AS kampus_close
							, (
										SELECT
												COUNT(xl.id_universitas)
										FROM
												ed_kampus xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "WAITING APPROVAL")
								) AS kampus_new
							, (
										SELECT
												COUNT(xd.id_daftar_pjp)
										FROM
												fe_daftar_pjp xd
												INNER JOIN db_sales xs
														ON (xd.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xd.tanggal, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xd.tanggal, "%m") = "'.$bulan_sekarang.'"
												AND xd.id_jenis_lokasi = "KAM")
								) AS kampus_pjp
							, (
										SELECT
												COUNT(xh.id_history_pjp)
										FROM
												fb_histroy_pjp xh
												INNER JOIN db_sales xs
														ON (xh.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xh.tanggal, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xh.tanggal, "%m") = "'.$bulan_sekarang.'"
												AND xh.jam_clock_in <> "00:00:00"
												AND xh.id_jenis_lokasi = "KAM")
								) AS kampus_clockin
								
							, (
										SELECT
												COUNT(xl.id_fakultas)
										FROM
												ee_fakultas xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "OPEN")
								) AS fakultas_open
							,(
										SELECT
												COUNT(xl.id_fakultas)
										FROM
												ee_fakultas xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_close, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_close, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "CLOSE")
								) AS fakultas_close
							, (
										SELECT
												COUNT(xl.id_fakultas)
										FROM
												ee_fakultas xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "WAITING APPROVAL")
								) AS fakultas_new
							, (
										SELECT
												COUNT(xd.id_daftar_pjp)
										FROM
												fe_daftar_pjp xd
												INNER JOIN db_sales xs
														ON (xd.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xd.tanggal, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xd.tanggal, "%m") = "'.$bulan_sekarang.'"
												AND xd.id_jenis_lokasi = "FAK")
								) AS fakultas_pjp
							, (
										SELECT
												COUNT(xh.id_history_pjp)
										FROM
												fb_histroy_pjp xh
												INNER JOIN db_sales xs
														ON (xh.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xh.tanggal, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xh.tanggal, "%m") = "'.$bulan_sekarang.'"
												AND xh.jam_clock_in <> "00:00:00"
												AND xh.id_jenis_lokasi = "FAK")
								) AS fakultas_clockin

							, (
										SELECT
												COUNT(xl.id_poi)
										FROM
												ef_poi xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "OPEN")
								) AS poi_open
							,(
										SELECT
												COUNT(xl.id_poi)
										FROM
												ef_poi xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_close, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_close, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "CLOSE")
								) AS poi_close
							, (
										SELECT
												COUNT(xl.id_poi)
										FROM
												ef_poi xl
												INNER JOIN cd_kelurahan xkl
														ON (xl.id_kelurahan = xkl.id_kelurahan)
												INNER JOIN cc_kecamatan xkc
														ON (xkl.id_kecamatan = xkc.id_kecamatan)
										WHERE (xkc.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xl.tgl_open, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xl.tgl_open, "%m") = "'.$bulan_sekarang.'"
												AND xl.status = "WAITING APPROVAL")
								) AS poi_new
							, (
										SELECT
												COUNT(xd.id_daftar_pjp)
										FROM
												fe_daftar_pjp xd
												INNER JOIN db_sales xs
														ON (xd.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xd.tanggal, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xd.tanggal, "%m") = "'.$bulan_sekarang.'"
												AND xd.id_jenis_lokasi = "POI" )
								) AS poi_pjp
							, (
										SELECT
												COUNT(xh.id_history_pjp)
										FROM
												fb_histroy_pjp xh
												INNER JOIN db_sales xs
														ON (xh.id_sales = xs.id_sales)
												INNER JOIN bd_tap xt
														ON (xs.id_tap = xt.id_tap)
										WHERE (xt.id_kabupaten = kb.id_kabupaten
												AND DATE_FORMAT(xh.tanggal, "%Y") = "'.$tahun_sekarang.'"
												AND DATE_FORMAT(xh.tanggal, "%m") = "'.$bulan_sekarang.'"
												AND xh.jam_clock_in <> "00:00:00"
												AND xh.id_jenis_lokasi = "POI")
								) AS poi_clockin
					FROM
							cb_kabupaten kb
			) xx
		');
		$rs = $this->db->get()->result_array();

		if (!empty($rs))
		{
			for ($x=0; $x<count($rs); $x++)
			{
				$this->db->select('1');
				$this->db->from('ah_dashboard_coverage_kabupaten');
				$this->db->where('tahun', $tahun_sekarang);
				$this->db->where('bulan', (int) $bulan_sekarang);
				$this->db->where('id_kabupaten', $rs[$x]['id_kabupaten']);
				$rsx = $this->db->get()->row_array();

				if ($rsx)
				{
					$data_x = array(
						'tahun' => $tahun_sekarang,
						'bulan' => $bulan_sekarang,
						'id_kabupaten' => $rs[$x]['id_kabupaten'],
						'outlet_open' => $rs[$x]['outlet_open'],
						'outlet_close' => $rs[$x]['outlet_close'],
						'outlet_total' => $rs[$x]['outlet_total'],
						'outlet_new' => $rs[$x]['outlet_new'],
						'outlet_device' => $rs[$x]['outlet_device'],
						'outlet_reguler' => $rs[$x]['outlet_reguler'],
						'outlet_pareto' => $rs[$x]['outlet_pareto'],
						'outlet_pjp' => $rs[$x]['outlet_pjp'],
						'outlet_clockin' => $rs[$x]['outlet_clockin'],
						'outlet_target' => $rs[$x]['outlet_target'],
						'outlet_coverage' => $rs[$x]['outlet_coverage'],
						
						'sekolah_open' => $rs[$x]['sekolah_open'],
						'sekolah_close' => $rs[$x]['sekolah_close'],
						'sekolah_total' => $rs[$x]['sekolah_total'],
						'sekolah_new' => $rs[$x]['sekolah_new'],
						'sekolah_pjp' => $rs[$x]['sekolah_pjp'],
						'sekolah_clockin' => $rs[$x]['sekolah_clockin'],
						'sekolah_target' => $rs[$x]['sekolah_target'],
						'sekolah_coverage' => $rs[$x]['sekolah_coverage'],
						
						'kampus_open' => $rs[$x]['kampus_open'],
						'kampus_close' => $rs[$x]['kampus_close'],
						'kampus_total' => $rs[$x]['kampus_total'],
						'kampus_new' => $rs[$x]['kampus_new'],
						'kampus_pjp' => $rs[$x]['kampus_pjp'],
						'kampus_clockin' => $rs[$x]['kampus_clockin'],
						'kampus_target' => $rs[$x]['kampus_target'],
						'kampus_coverage' => $rs[$x]['kampus_coverage'],
						
						'fakultas_open' => $rs[$x]['fakultas_open'],
						'fakultas_close' => $rs[$x]['fakultas_close'],
						'fakultas_total' => $rs[$x]['fakultas_total'],
						'fakultas_new' => $rs[$x]['fakultas_new'],
						'fakultas_pjp' => $rs[$x]['fakultas_pjp'],
						'fakultas_clockin' => $rs[$x]['fakultas_clockin'],
						'fakultas_target' => $rs[$x]['fakultas_target'],
						'fakultas_coverage' => $rs[$x]['fakultas_coverage'],
						
						'sekolah_open' => $rs[$x]['sekolah_open'],
						'sekolah_close' => $rs[$x]['sekolah_close'],
						'sekolah_total' => $rs[$x]['sekolah_total'],
						'sekolah_new' => $rs[$x]['sekolah_new'],
						'sekolah_pjp' => $rs[$x]['sekolah_pjp'],
						'sekolah_clockin' => $rs[$x]['sekolah_clockin'],
						'sekolah_target' => $rs[$x]['sekolah_target'],
						'sekolah_coverage' => $rs[$x]['sekolah_coverage'],
					);

					$this->db->where('tahun', $tahun_sekarang);
					$this->db->where('bulan', (int) $bulan_sekarang);
					$this->db->where('id_kabupaten', $rs[$x]['id_kabupaten']);
					$this->db->update('ah_dashboard_coverage_kabupaten', $data_x);
					$this->check_trans_status('update ah_dashboard_coverage_kabupaten failed');
				}
				else
				{
					$data_x = array(
						'tahun' => $tahun_sekarang,
						'bulan' => $bulan_sekarang,
						'id_kabupaten' => $rs[$x]['id_kabupaten'],
						'outlet_open' => $rs[$x]['outlet_open'],
						'outlet_close' => $rs[$x]['outlet_close'],
						'outlet_total' => $rs[$x]['outlet_total'],
						'outlet_new' => $rs[$x]['outlet_new'],
						'outlet_device' => $rs[$x]['outlet_device'],
						'outlet_reguler' => $rs[$x]['outlet_reguler'],
						'outlet_pareto' => $rs[$x]['outlet_pareto'],
						'outlet_pjp' => $rs[$x]['outlet_pjp'],
						'outlet_clockin' => $rs[$x]['outlet_clockin'],
						'outlet_target' => $rs[$x]['outlet_target'],
						'outlet_coverage' => $rs[$x]['outlet_coverage'],
						
						'sekolah_open' => $rs[$x]['sekolah_open'],
						'sekolah_close' => $rs[$x]['sekolah_close'],
						'sekolah_total' => $rs[$x]['sekolah_total'],
						'sekolah_new' => $rs[$x]['sekolah_new'],
						'sekolah_pjp' => $rs[$x]['sekolah_pjp'],
						'sekolah_clockin' => $rs[$x]['sekolah_clockin'],
						'sekolah_target' => $rs[$x]['sekolah_target'],
						'sekolah_coverage' => $rs[$x]['sekolah_coverage'],
						
						'kampus_open' => $rs[$x]['kampus_open'],
						'kampus_close' => $rs[$x]['kampus_close'],
						'kampus_total' => $rs[$x]['kampus_total'],
						'kampus_new' => $rs[$x]['kampus_new'],
						'kampus_pjp' => $rs[$x]['kampus_pjp'],
						'kampus_clockin' => $rs[$x]['kampus_clockin'],
						'kampus_target' => $rs[$x]['kampus_target'],
						'kampus_coverage' => $rs[$x]['kampus_coverage'],
						
						'fakultas_open' => $rs[$x]['fakultas_open'],
						'fakultas_close' => $rs[$x]['fakultas_close'],
						'fakultas_total' => $rs[$x]['fakultas_total'],
						'fakultas_new' => $rs[$x]['fakultas_new'],
						'fakultas_pjp' => $rs[$x]['fakultas_pjp'],
						'fakultas_clockin' => $rs[$x]['fakultas_clockin'],
						'fakultas_target' => $rs[$x]['fakultas_target'],
						'fakultas_coverage' => $rs[$x]['fakultas_coverage'],
						
						'sekolah_open' => $rs[$x]['sekolah_open'],
						'sekolah_close' => $rs[$x]['sekolah_close'],
						'sekolah_total' => $rs[$x]['sekolah_total'],
						'sekolah_new' => $rs[$x]['sekolah_new'],
						'sekolah_pjp' => $rs[$x]['sekolah_pjp'],
						'sekolah_clockin' => $rs[$x]['sekolah_clockin'],
						'sekolah_target' => $rs[$x]['sekolah_target'],
						'sekolah_coverage' => $rs[$x]['sekolah_coverage'],
					);

					$this->db->insert('ah_dashboard_coverage_kabupaten', $data_x);
					$this->check_trans_status('insert ah_dashboard_coverage_kabupaten failed');
				}
			}
		}
	}
}
?>