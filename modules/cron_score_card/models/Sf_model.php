<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sf_model extends CI_model {

	function __construct()
	{
		parent::__construct();

		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '2048M');
	}

	function check_trans_status($exception)
  {
    if ($this->db->trans_status() === FALSE) {
      throw new Exception($exception);
    }
  }

	function save_data_sf()
  {
    $this->db->trans_begin();
    try {
			$this->select_penjualan_tanggal();
			$this->insert_data_sf();
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
		$tanggal_sekarang = date('Y-m-d');
		
		$this->db->select('
			tanggal
			, DATE_FORMAT(tanggal, "%d") AS tgl
			, hari
			, tahun
			, bulan
			, minggu
		');
		$this->db->from('ja_penjualan_tanggal');
		$this->db->where('tanggal', $tanggal_sekarang);
		$rs = $this->db->get()->row_array();

		$this->tanggal = isset($rs['tanggal']) ? $rs['tanggal'] : NULL;
		$this->tgl = isset($rs['tgl']) ? $rs['tgl'] : NULL;
		$this->hari = isset($rs['hari']) ? $rs['hari'] : NULL;
		$this->tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$this->bulan = isset($rs['bulan']) ? $rs['bulan'] : 0;
		$this->minggu = isset($rs['minggu']) ? $rs['minggu'] : 0;
	}

	function insert_data_sf()
  {
		$this->db->select('*');
		$this->db->from('db_sales');
		$this->db->where('id_jenis_sales', 'SSF');
		$this->db->where('status', 'AKTIF');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_sales = $rs_a[$a]['id_sales'] ? $rs_a[$a]['id_sales'] : 0;
				
				$this->db->select('COUNT(id_daftar_pjp) AS pjp');
				$this->db->from('fe_daftar_pjp');
				$this->db->where('id_sales', $id_sales);
				$this->db->where('id_jenis_lokasi', 'OUT');
				$this->db->where('tanggal', $this->tanggal);
				$rs = $this->db->get()->row_array();
				
				$pjp = isset($rs['pjp']) ? $rs['pjp'] : 0;
				
				$this->db->select('COUNT(id_history_pjp) AS actual_call_jml');
				$this->db->from('fb_histroy_pjp');
				$this->db->where('id_sales', $id_sales);
				$this->db->where('id_jenis_lokasi', 'OUT');
				$this->db->where('tanggal', $this->tanggal);
				$this->db->where('jam_clock_in <> ', '00:00:00');
				$rs = $this->db->get()->row_array();

				$actual_call_jml = isset($rs['actual_call_jml']) ? $rs['actual_call_jml'] : 0;

				if ($pjp > 0)
				{
					$actual_call_persen = ($actual_call_jml / $pjp) * 100;
				}
				else
				{
					$actual_call_persen = 0;
				}
				
				$this->db->select('COUNT(no_nota) AS effective_call_jml');
				$this->db->from('jc_penjualan');
				$this->db->where('id_sales', $id_sales);
				$this->db->where('id_jenis_lokasi', 'OUT');
				$this->db->where('tgl_transaksi', $this->tanggal);
				$rs = $this->db->get()->row_array();

				$effective_call_jml = isset($rs['effective_call_jml']) ? $rs['effective_call_jml'] : 0;

				if ($pjp > 0)
				{
					$effective_call_persen = ($effective_call_jml / $pjp) * 100;
				}
				else
				{
					$effective_call_persen = 0;
				}
				
				$this->db->select('
					xx.uhj_sgprepaid
					, xx.uhj_sgota
					, xx.uhj_sgvin
					, xx.uhj_sgvgs
					, xx.uhj_sgvgg
					, xx.uhj_sgvgp
					, xx.uhj_insac_ld
					, xx.uhj_insac_md
					, xx.uhj_insac_hd
					, xx.uhj_invin_ld
					, xx.uhj_invin_md
					, xx.uhj_invin_hd
					, xx.uhj_invga_ld
					, xx.uhj_invga_md
					, xx.uhj_invga_hd
				');
				$this->db->from('
					(
							SELECT
									COUNT(pjd.id_penjualan_detail) AS uhj_sgprepaid
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
																ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
																ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "SGOTA"
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_sgota
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
																ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
																ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "SGVIN"
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_SGVIN
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
																ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
																ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "SGVGS"
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_sgvgs
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
																ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
																ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "SGVGG"
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_sgvgg
									, (
											SELECT
													COUNT(xpjd.id_penjualan_detail)
											FROM
													jd_penjualan_detail xpjd
													INNER JOIN jc_penjualan xpj
															ON (xpjd.no_nota = xpj.no_nota)
													INNER JOIN gb_produk xp
															ON (xpjd.id_produk = xp.id_produk)
											WHERE (xp.id_jenis_produk = "SGVGP"
													AND xpj.id_sales = pj.id_sales
													AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
													AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_sgvgp
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
																ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
																ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "INSAC"
														AND xp.id_jenis_inject = 1
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_insac_ld
									, (
											SELECT
													COUNT(xpjd.id_penjualan_detail)
											FROM
													jd_penjualan_detail xpjd
													INNER JOIN jc_penjualan xpj
															ON (xpjd.no_nota = xpj.no_nota)
													INNER JOIN gb_produk xp
															ON (xpjd.id_produk = xp.id_produk)
											WHERE (xp.id_jenis_produk = "INSAC"
													AND xp.id_jenis_inject = 2
													AND xpj.id_sales = pj.id_sales
													AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
													AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_insac_md
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
																ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
																ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "INSAC"
														AND xp.id_jenis_inject = 2
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_insac_hd
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
																ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
																ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "INVIN"
														AND xp.id_jenis_inject = 1
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_invin_ld
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
																ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
																ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "INVIN"
														AND xp.id_jenis_inject = 2
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_invin_md
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
																ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
																ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "INVIN"
														AND xp.id_jenis_inject = 3
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_invin_hd
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
																ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
																ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "INVGA"
														AND xp.id_jenis_inject = 1
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_invga_ld
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
																ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
																ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "INVGA"
														AND xp.id_jenis_inject = 2
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_invga_md
									, (
												SELECT
														COUNT(xpjd.id_penjualan_detail)
												FROM
														jd_penjualan_detail xpjd
														INNER JOIN jc_penjualan xpj
													ON (xpjd.no_nota = xpj.no_nota)
														INNER JOIN gb_produk xp
													ON (xpjd.id_produk = xp.id_produk)
												WHERE (xp.id_jenis_produk = "INVGA"
														AND xp.id_jenis_inject = 3
														AND xpj.id_sales = pj.id_sales
														AND xpj.id_jenis_lokasi = pj.id_jenis_lokasi
														AND xpj.tgl_transaksi = pj.tgl_transaksi)
										) AS uhj_invga_hd
							FROM
									jd_penjualan_detail pjd
									INNER JOIN jc_penjualan pj
											ON (pjd.no_nota = pj.no_nota)
									INNER JOIN gb_produk p
											ON (pjd.id_produk = p.id_produk)
							WHERE (p.id_jenis_produk = "SGPREPAID"
									AND pj.id_sales = "'.$id_sales.'"
									AND pj.id_jenis_lokasi = "OUT"
									AND pj.tgl_transaksi = "'.$this->tanggal.'")
					) xx
				');
				$rs = $this->db->get()->row_array();

				$uhj_sgprepaid = isset($rs['uhj_sgprepaid']) ? $rs['uhj_sgprepaid'] : 0;
				$uhj_sgota = isset($rs['uhj_sgota']) ? $rs['uhj_sgota'] : 0;
				$uhj_sgvin = isset($rs['uhj_sgvin']) ? $rs['uhj_sgvin'] : 0;
				$uhj_sgvgs = isset($rs['uhj_sgvgs']) ? $rs['uhj_sgvgs'] : 0;
				$uhj_sgvgg = isset($rs['uhj_sgvgg']) ? $rs['uhj_sgvgg'] : 0;
				$uhj_sgvgp = isset($rs['uhj_sgvgp']) ? $rs['uhj_sgvgp'] : 0;
				$uhj_insac_ld = isset($rs['uhj_insac_ld']) ? $rs['uhj_insac_ld'] : 0;
				$uhj_insac_md = isset($rs['uhj_insac_md']) ? $rs['uhj_insac_md'] : 0;
				$uhj_insac_hd = isset($rs['uhj_insac_hd']) ? $rs['uhj_insac_hd'] : 0;
				$uhj_invin_ld = isset($rs['uhj_invin_ld']) ? $rs['uhj_invin_ld'] : 0;
				$uhj_invin_md = isset($rs['uhj_invin_md']) ? $rs['uhj_invin_md'] : 0;
				$uhj_invin_hd = isset($rs['uhj_invin_hd']) ? $rs['uhj_invin_hd'] : 0;
				$uhj_invga_ld = isset($rs['uhj_invga_ld']) ? $rs['uhj_invga_ld'] : 0;
				$uhj_invga_md = isset($rs['uhj_invga_md']) ? $rs['uhj_invga_md'] : 0;
				$uhj_invga_hd = isset($rs['uhj_invga_hd']) ? $rs['uhj_invga_hd'] : 0;

				$uhj_new_rs = 0;
				$uhj_la = 0;

				$trg_sgprepaid = 0;
				$trg_sgota = 0;
				$trg_sgvin = 0;
				$trg_sgvgs = 0;
				$trg_sgvgg = 0;
				$trg_sgvgp = 0;
				$trg_insac_ld = 0;
				$trg_insac_md = 0;
				$trg_insac_hd = 0;
				$trg_invin_ld = 0;
				$trg_invin_md = 0;
				$trg_invin_hd = 0;
				$trg_invga_ld = 0;
				$trg_invga_md = 0;
				$trg_invga_hd = 0;
				$trg_new_rs = 0;
				$trg_la = 0;

				$rmt_sgprepaid = 0;
				$rmt_sgota = 0;
				$rmt_sgvin = 0;
				$rmt_sgvgs = 0;
				$rmt_sgvgg = 0;
				$rmt_sgvgp = 0;
				$rmt_insac_ld = 0;
				$rmt_insac_md = 0;
				$rmt_insac_hd = 0;
				$rmt_invin_ld = 0;
				$rmt_invin_md = 0;
				$rmt_invin_hd = 0;
				$rmt_invga_ld = 0;
				$rmt_invga_md = 0;
				$rmt_invga_hd = 0;
				$rmt_new_rs = 0;
				$rmt_la = 0;

				$evm_perdana = 0;
				$evm_voucher_fisik = 0;
				$evm_layar_toko = 0;
				$evm_poster = 0;
				$evm_neon_box = 0;
				$evm_stiker = 0;
				$evm_video = 0;
				
				$this->db->select('1');
				$this->db->from('la_score_card');
				$this->db->where('id_sales', $id_sales);
				$this->db->where('tahun', $this->tahun);
				$this->db->where('bulan', $this->bulan);
				$this->db->where('tgl', (int) $this->tgl);

				$rs_cek = $this->db->get()->row_array();

				if ($rs_cek)
				{
					$data_x = array(
						'id_sales' => $id_sales,

						'tahun' => $this->tahun,
						'bulan' => $this->bulan,
						'tgl' => $this->tgl,
						'hari' => $this->hari,

						'pjp' => $pjp,
						'actual_call_jml' => $actual_call_jml,
						'actual_call_persen' => $actual_call_persen,
						'effective_call_jml' => $effective_call_jml,
						'effective_call_persen' => $effective_call_persen,

						'uhj_sgprepaid' => $uhj_sgprepaid,
						'uhj_sgota' => $uhj_sgota,
						'uhj_sgvin' => $uhj_sgvin,
						'uhj_sgvgs' => $uhj_sgvgs,
						'uhj_sgvgg' => $uhj_sgvgg,
						'uhj_sgvgp' => $uhj_sgvgp,
						'uhj_insac_ld' => $uhj_insac_ld,
						'uhj_insac_md' => $uhj_insac_md,
						'uhj_insac_hd' => $uhj_insac_hd,
						'uhj_invin_ld' => $uhj_invin_ld,
						'uhj_invin_md' => $uhj_invin_md,
						'uhj_invin_hd' => $uhj_invin_hd,
						'uhj_invga_ld' => $uhj_invga_ld,
						'uhj_invga_md' => $uhj_invga_md,
						'uhj_invga_hd' => $uhj_invga_hd,
						'uhj_new_rs' => $uhj_new_rs,
						'uhj_limit_link_aja' => $uhj_la,

						'trg_sgprepaid' => $trg_sgprepaid,
						'trg_sgota' => $trg_sgota,
						'trg_sgvin' => $trg_sgvin,
						'trg_sgvgs' => $trg_sgvgs,
						'trg_sgvgg' => $trg_sgvgg,
						'trg_sgvgp' => $trg_sgvgp,
						'trg_insac_ld' => $trg_insac_ld,
						'trg_insac_md' => $trg_insac_md,
						'trg_insac_hd' => $trg_insac_hd,
						'trg_invin_ld' => $trg_invin_ld,
						'trg_invin_md' => $trg_invin_md,
						'trg_invin_hd' => $trg_invin_hd,
						'trg_invga_ld' => $trg_invga_ld,
						'trg_invga_md' => $trg_invga_md,
						'trg_invga_hd' => $trg_invga_hd,
						'trg_new_rs' => $trg_new_rs,
						'trg_limit_link_aja' => $trg_la,

						'rmt_sgprepaid' => $rmt_sgprepaid,
						'rmt_sgota' => $rmt_sgota,
						'rmt_sgvin' => $rmt_sgvin,
						'rmt_sgvgs' => $rmt_sgvgs,
						'rmt_sgvgg' => $rmt_sgvgg,
						'rmt_sgvgp' => $rmt_sgvgp,
						'rmt_insac_ld' => $rmt_insac_ld,
						'rmt_insac_md' => $rmt_insac_md,
						'rmt_insac_hd' => $rmt_insac_hd,
						'rmt_invin_ld' => $rmt_invin_ld,
						'rmt_invin_md' => $rmt_invin_md,
						'rmt_invin_hd' => $rmt_invin_hd,
						'rmt_invga_ld' => $rmt_invga_ld,
						'rmt_invga_md' => $rmt_invga_md,
						'rmt_invga_hd' => $rmt_invga_hd,
						'rmt_new_rs' => $rmt_new_rs,
						'rmt_limit_link_aja' => $rmt_la,

						'evm_perdana' => $evm_perdana,
						'evm_voucher_fisik' => $evm_voucher_fisik,
						'evm_layar_toko' => $evm_layar_toko,
						'evm_poster' => $evm_poster,
						'evm_neon_box' => $evm_neon_box,
						'evm_stiker' => $evm_stiker,
						'evm_video' => $evm_video
					);

					$this->db->where('id_sales', $id_sales);
					$this->db->where('tahun', $this->tahun);
					$this->db->where('bulan', $this->bulan);
					$this->db->where('tgl', $this->tgl);
					$this->db->update('la_score_card', $data_x);
					$this->check_trans_status('update la_score_card failed');
				}
				else
				{
					$data_x = array(
						'id_sales' => $id_sales,

						'tahun' => $this->tahun,
						'bulan' => $this->bulan,
						'tgl' => $this->tgl,
						'hari' => $this->hari,

						'pjp' => $pjp,
						'actual_call_jml' => $actual_call_jml,
						'actual_call_persen' => $actual_call_persen,
						'effective_call_jml' => $effective_call_jml,
						'effective_call_persen' => $effective_call_persen,

						'uhj_sgprepaid' => $uhj_sgprepaid,
						'uhj_sgota' => $uhj_sgota,
						'uhj_sgvin' => $uhj_sgvin,
						'uhj_sgvgs' => $uhj_sgvgs,
						'uhj_sgvgg' => $uhj_sgvgg,
						'uhj_sgvgp' => $uhj_sgvgp,
						'uhj_insac_ld' => $uhj_insac_ld,
						'uhj_insac_md' => $uhj_insac_md,
						'uhj_insac_hd' => $uhj_insac_hd,
						'uhj_invin_ld' => $uhj_invin_ld,
						'uhj_invin_md' => $uhj_invin_md,
						'uhj_invin_hd' => $uhj_invin_hd,
						'uhj_invga_ld' => $uhj_invga_ld,
						'uhj_invga_md' => $uhj_invga_md,
						'uhj_invga_hd' => $uhj_invga_hd,
						'uhj_new_rs' => $uhj_new_rs,
						'uhj_limit_link_aja' => $uhj_la,

						'trg_sgprepaid' => $trg_sgprepaid,
						'trg_sgota' => $trg_sgota,
						'trg_sgvin' => $trg_sgvin,
						'trg_sgvgs' => $trg_sgvgs,
						'trg_sgvgg' => $trg_sgvgg,
						'trg_sgvgp' => $trg_sgvgp,
						'trg_insac_ld' => $trg_insac_ld,
						'trg_insac_md' => $trg_insac_md,
						'trg_insac_hd' => $trg_insac_hd,
						'trg_invin_ld' => $trg_invin_ld,
						'trg_invin_md' => $trg_invin_md,
						'trg_invin_hd' => $trg_invin_hd,
						'trg_invga_ld' => $trg_invga_ld,
						'trg_invga_md' => $trg_invga_md,
						'trg_invga_hd' => $trg_invga_hd,
						'trg_new_rs' => $trg_new_rs,
						'trg_limit_link_aja' => $trg_la,

						'rmt_sgprepaid' => $rmt_sgprepaid,
						'rmt_sgota' => $rmt_sgota,
						'rmt_sgvin' => $rmt_sgvin,
						'rmt_sgvgs' => $rmt_sgvgs,
						'rmt_sgvgg' => $rmt_sgvgg,
						'rmt_sgvgp' => $rmt_sgvgp,
						'rmt_insac_ld' => $rmt_insac_ld,
						'rmt_insac_md' => $rmt_insac_md,
						'rmt_insac_hd' => $rmt_insac_hd,
						'rmt_invin_ld' => $rmt_invin_ld,
						'rmt_invin_md' => $rmt_invin_md,
						'rmt_invin_hd' => $rmt_invin_hd,
						'rmt_invga_ld' => $rmt_invga_ld,
						'rmt_invga_md' => $rmt_invga_md,
						'rmt_invga_hd' => $rmt_invga_hd,
						'rmt_new_rs' => $rmt_new_rs,
						'rmt_limit_link_aja' => $rmt_la,

						'evm_perdana' => $evm_perdana,
						'evm_voucher_fisik' => $evm_voucher_fisik,
						'evm_layar_toko' => $evm_layar_toko,
						'evm_poster' => $evm_poster,
						'evm_neon_box' => $evm_neon_box,
						'evm_stiker' => $evm_stiker,
						'evm_video' => $evm_video
					);

					$this->db->insert('la_score_card', $data_x);
					$this->check_trans_status('insert la_score_card failed');
				}
			}
		}
	}
}
?>