<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tap_model extends CI_model {

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

	function save_data_tap()
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
		$this->db->select('tahun, bulan, minggu');
		$this->db->from('ja_penjualan_tanggal');
		$this->db->where('tanggal', date('Y-m-d'));
		$rs = $this->db->get()->row_array();

		$this->tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$this->bulan = isset($rs['bulan']) ? $rs['bulan'] : 0;
		$this->minggu = isset($rs['minggu']) ? $rs['minggu'] : 0;
	}

	function insert_data_outlet()
  {
		$this->db->select('*');
		$this->db->from('bd_tap');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_tap = $rs_a[$a]['id_tap'] ? $rs_a[$a]['id_tap'] : 0;

				$arr_share = array('BELANJA', 'SALES_BROADBAND', 'VOUCHER_FISIK');

				for ($b=0; $b<count($arr_share); $b++)
				{
					$id_jenis_share = $arr_share[$b];

					$this->db->select('
						xx.telkomsel
						, xx.isat
						, xx.xl
						, xx.tri
						, xx.smartfren
						, xx.axis
						, xx.other
						, (
									xx.telkomsel +
									xx.xl +
									xx.tri +
									xx.smartfren +
									xx.axis +
									xx.other
							) AS total

						, xx.telkomsel_ld
						, xx.isat_ld
						, xx.xl_ld
						, xx.tri_ld
						, xx.smartfren_ld
						, xx.axis_ld
						, xx.other_ld
						, (
									xx.telkomsel_ld +
									xx.isat_ld +
									xx.xl_ld +
									xx.tri_ld +
									xx.smartfren_ld +
									xx.axis_ld +
									xx.other_ld
							) AS total_ld

						, xx.telkomsel_md
						, xx.isat_md
						, xx.xl_md
						, xx.tri_md
						, xx.smartfren_md
						, xx.axis_md
						, xx.other_md
						, (
									xx.telkomsel_md +
									xx.isat_md +
									xx.xl_md +
									xx.tri_md +
									xx.smartfren_md +
									xx.axis_md +
									xx.other_md
							) AS total_md

						, xx.telkomsel_hd
						, xx.isat_hd
						, xx.xl_hd
						, xx.tri_hd
						, xx.smartfren_hd
						, xx.axis_hd
						, xx.other_hd
						, (
									xx.telkomsel_hd +
									xx.isat_hd +
									xx.xl_hd +
									xx.tri_hd +
									xx.smartfren_hd +
									xx.axis_hd +
									xx.other_hd
							) AS total_hd


						, ((xx.telkomsel_ld /
									(
											xx.telkomsel_ld +
											xx.isat_ld +
											xx.xl_ld +
											xx.tri_ld +
											xx.smartfren_ld +
											xx.axis_ld +
											xx.other_ld
									)) * 100
							) AS telkomsel_ld_persen
						, ((xx.isat_ld /
									(
											xx.telkomsel_ld +
											xx.isat_ld +
											xx.xl_ld +
											xx.tri_ld +
											xx.smartfren_ld +
											xx.axis_ld +
											xx.other_ld
									)) * 100
							) AS isat_ld_persen
						, ((xx.xl_ld /
									(
											xx.telkomsel_ld +
											xx.isat_ld +
											xx.xl_ld +
											xx.tri_ld +
											xx.smartfren_ld +
											xx.axis_ld +
											xx.other_ld
									)) * 100
							) AS xl_ld_persen
						, ((xx.tri_ld /
									(
											xx.telkomsel_ld +
											xx.isat_ld +
											xx.xl_ld +
											xx.tri_ld +
											xx.smartfren_ld +
											xx.axis_ld +
											xx.other_ld
									)) * 100
							) AS tri_ld_persen
						, ((xx.smartfren_ld /
									(
											xx.telkomsel_ld +
											xx.isat_ld +
											xx.xl_ld +
											xx.tri_ld +
											xx.smartfren_ld +
											xx.axis_ld +
											xx.other_ld
									)) * 100
							) AS smartfren_ld_persen
						, ((xx.axis_ld /
									(
											xx.telkomsel_ld +
											xx.isat_ld +
											xx.xl_ld +
											xx.tri_ld +
											xx.smartfren_ld +
											xx.axis_ld +
											xx.other_ld
									)) * 100
							) AS axis_ld_persen
						, ((xx.other_ld /
									(
											xx.telkomsel_ld +
											xx.isat_ld +
											xx.xl_ld +
											xx.tri_ld +
											xx.smartfren_ld +
											xx.axis_ld +
											xx.other_ld
									)) * 100
							) AS other_ld_persen
						,	(
									((xx.telkomsel_ld /
											(
													xx.telkomsel_ld +
													xx.isat_ld +
													xx.xl_ld +
													xx.tri_ld +
													xx.smartfren_ld +
													xx.axis_ld +
													xx.other_ld
											)) * 100
									) +
									((xx.isat_ld /
											(
													xx.telkomsel_ld +
													xx.isat_ld +
													xx.xl_ld +
													xx.tri_ld +
													xx.smartfren_ld +
													xx.axis_ld +
													xx.other_ld
											)) * 100
									) +
									((xx.xl_ld /
											(
													xx.telkomsel_ld +
													xx.isat_ld +
													xx.xl_ld +
													xx.tri_ld +
													xx.smartfren_ld +
													xx.axis_ld +
													xx.other_ld
											)) * 100
									) +
									((xx.tri_ld /
											(
													xx.telkomsel_ld +
													xx.isat_ld +
													xx.xl_ld +
													xx.tri_ld +
													xx.smartfren_ld +
													xx.axis_ld +
													xx.other_ld
											)) * 100
									) +
									((xx.smartfren_ld /
											(
													xx.telkomsel_ld +
													xx.isat_ld +
													xx.xl_ld +
													xx.tri_ld +
													xx.smartfren_ld +
													xx.axis_ld +
													xx.other_ld
											)) * 100
									) +
									((xx.axis_ld /
											(
													xx.telkomsel_ld +
													xx.isat_ld +
													xx.xl_ld +
													xx.tri_ld +
													xx.smartfren_ld +
													xx.axis_ld +
													xx.other_ld
											)) * 100
									) +
									((xx.other_ld /
											(
													xx.telkomsel_ld +
													xx.isat_ld +
													xx.xl_ld +
													xx.tri_ld +
													xx.smartfren_ld +
													xx.axis_ld +
													xx.other_ld
											)) * 100
									)
							) AS total_ld_persen


						, ((xx.telkomsel_md /
									(
											xx.telkomsel_md +
											xx.isat_md +
											xx.xl_md +
											xx.tri_md +
											xx.smartfren_md +
											xx.axis_md +
											xx.other_md
									)) * 100
							) AS telkomsel_md_persen
						, ((xx.isat_md /
									(
											xx.telkomsel_md +
											xx.isat_md +
											xx.xl_md +
											xx.tri_md +
											xx.smartfren_md +
											xx.axis_md +
											xx.other_md
									)) * 100
							) AS isat_md_persen
						, ((xx.xl_md /
									(
											xx.telkomsel_md +
											xx.isat_md +
											xx.xl_md +
											xx.tri_md +
											xx.smartfren_md +
											xx.axis_md +
											xx.other_md
									)) * 100
							) AS xl_md_persen
						, ((xx.tri_md /
									(
											xx.telkomsel_md +
											xx.isat_md +
											xx.xl_md +
											xx.tri_md +
											xx.smartfren_md +
											xx.axis_md +
											xx.other_md
									)) * 100
							) AS tri_md_persen
						, ((xx.smartfren_md /
									(
											xx.telkomsel_md +
											xx.isat_md +
											xx.xl_md +
											xx.tri_md +
											xx.smartfren_md +
											xx.axis_md +
											xx.other_md
									)) * 100
							) AS smartfren_md_persen
						, ((xx.axis_md /
									(
											xx.telkomsel_md +
											xx.isat_md +
											xx.xl_md +
											xx.tri_md +
											xx.smartfren_md +
											xx.axis_md +
											xx.other_md
									)) * 100
							) AS axis_md_persen
						, ((xx.other_md /
									(
											xx.telkomsel_md +
											xx.isat_md +
											xx.xl_md +
											xx.tri_md +
											xx.smartfren_md +
											xx.axis_md +
											xx.other_md
									)) * 100
							) AS other_md_persen
						,	(
									((xx.telkomsel_md /
											(
													xx.telkomsel_md +
													xx.isat_md +
													xx.xl_md +
													xx.tri_md +
													xx.smartfren_md +
													xx.axis_md +
													xx.other_md
											)) * 100
									) +
									((xx.isat_md /
											(
													xx.telkomsel_md +
													xx.isat_md +
													xx.xl_md +
													xx.tri_md +
													xx.smartfren_md +
													xx.axis_md +
													xx.other_md
											)) * 100
									) +
									((xx.xl_md /
											(
													xx.telkomsel_md +
													xx.isat_md +
													xx.xl_md +
													xx.tri_md +
													xx.smartfren_md +
													xx.axis_md +
													xx.other_md
											)) * 100
									) +
									((xx.tri_md /
											(
													xx.telkomsel_md +
													xx.isat_md +
													xx.xl_md +
													xx.tri_md +
													xx.smartfren_md +
													xx.axis_md +
													xx.other_md
											)) * 100
									) +
									((xx.smartfren_md /
											(
													xx.telkomsel_md +
													xx.isat_md +
													xx.xl_md +
													xx.tri_md +
													xx.smartfren_md +
													xx.axis_md +
													xx.other_md
											)) * 100
									) +
									((xx.axis_md /
											(
													xx.telkomsel_md +
													xx.isat_md +
													xx.xl_md +
													xx.tri_md +
													xx.smartfren_md +
													xx.axis_md +
													xx.other_md
											)) * 100
									) +
									((xx.other_md /
											(
													xx.telkomsel_md +
													xx.isat_md +
													xx.xl_md +
													xx.tri_md +
													xx.smartfren_md +
													xx.axis_md +
													xx.other_md
											)) * 100
									)
							) AS total_md_persen


						, ((xx.telkomsel_hd /
									(
											xx.telkomsel_hd +
											xx.isat_hd +
											xx.xl_hd +
											xx.tri_hd +
											xx.smartfren_hd +
											xx.axis_hd +
											xx.other_hd
									)) * 100
							) AS telkomsel_hd_persen
						, ((xx.isat_hd /
									(
											xx.telkomsel_hd +
											xx.isat_hd +
											xx.xl_hd +
											xx.tri_hd +
											xx.smartfren_hd +
											xx.axis_hd +
											xx.other_hd
									)) * 100
							) AS isat_hd_persen
						, ((xx.xl_hd /
									(
											xx.telkomsel_hd +
											xx.isat_hd +
											xx.xl_hd +
											xx.tri_hd +
											xx.smartfren_hd +
											xx.axis_hd +
											xx.other_hd
									)) * 100
							) AS xl_hd_persen
						, ((xx.tri_hd /
									(
											xx.telkomsel_hd +
											xx.isat_hd +
											xx.xl_hd +
											xx.tri_hd +
											xx.smartfren_hd +
											xx.axis_hd +
											xx.other_hd
									)) * 100
							) AS tri_hd_persen
						, ((xx.smartfren_hd /
									(
											xx.telkomsel_hd +
											xx.isat_hd +
											xx.xl_hd +
											xx.tri_hd +
											xx.smartfren_hd +
											xx.axis_hd +
											xx.other_hd
									)) * 100
							) AS smartfren_hd_persen
						, ((xx.axis_hd /
									(
											xx.telkomsel_hd +
											xx.isat_hd +
											xx.xl_hd +
											xx.tri_hd +
											xx.smartfren_hd +
											xx.axis_hd +
											xx.other_hd
									)) * 100
							) AS axis_hd_persen
						, ((xx.other_hd /
									(
											xx.telkomsel_hd +
											xx.isat_hd +
											xx.xl_hd +
											xx.tri_hd +
											xx.smartfren_hd +
											xx.axis_hd +
											xx.other_hd
									)) * 100
							) AS other_hd_persen
						,	(
									((xx.telkomsel_hd /
											(
													xx.telkomsel_hd +
													xx.isat_hd +
													xx.xl_hd +
													xx.tri_hd +
													xx.smartfren_hd +
													xx.axis_hd +
													xx.other_hd
											)) * 100
									) +
									((xx.isat_hd /
											(
													xx.telkomsel_hd +
													xx.isat_hd +
													xx.xl_hd +
													xx.tri_hd +
													xx.smartfren_hd +
													xx.axis_hd +
													xx.other_hd
											)) * 100
									) +
									((xx.xl_hd /
											(
													xx.telkomsel_hd +
													xx.isat_hd +
													xx.xl_hd +
													xx.tri_hd +
													xx.smartfren_hd +
													xx.axis_hd +
													xx.other_hd
											)) * 100
									) +
									((xx.tri_hd /
											(
													xx.telkomsel_hd +
													xx.isat_hd +
													xx.xl_hd +
													xx.tri_hd +
													xx.smartfren_hd +
													xx.axis_hd +
													xx.other_hd
											)) * 100
									) +
									((xx.smartfren_hd /
											(
													xx.telkomsel_hd +
													xx.isat_hd +
													xx.xl_hd +
													xx.tri_hd +
													xx.smartfren_hd +
													xx.axis_hd +
													xx.other_hd
											)) * 100
									) +
									((xx.axis_hd /
											(
													xx.telkomsel_hd +
													xx.isat_hd +
													xx.xl_hd +
													xx.tri_hd +
													xx.smartfren_hd +
													xx.axis_hd +
													xx.other_hd
											)) * 100
									) +
									((xx.other_hd /
											(
													xx.telkomsel_hd +
													xx.isat_hd +
													xx.tri_hd +
													xx.xl_hd +
													xx.smartfren_hd +
													xx.axis_hd +
													xx.other_hd
											)) * 100
									)
							) AS total_hd_persen
					');
					$this->db->from('
						(
								SELECT
										COALESCE(SUM(m.telkomsel), 0) AS telkomsel
										, COALESCE(SUM(m.isat), 0) AS isat
										, COALESCE(SUM(m.xl), 0) AS xl
										, COALESCE(SUM(m.tri), 0) AS tri
										, COALESCE(SUM(m.smartfren), 0) AS smartfren
										, COALESCE(SUM(m.axis), 0) AS axis
										, COALESCE(SUM(m.other), 0) AS other

										, COALESCE(SUM(m.telkomsel_ld), 0) AS telkomsel_ld
										, COALESCE(SUM(m.isat_ld), 0) AS isat_ld
										, COALESCE(SUM(m.xl_ld), 0) AS xl_ld
										, COALESCE(SUM(m.tri_ld), 0) AS tri_ld
										, COALESCE(SUM(m.smartfren_ld), 0) AS smartfren_ld
										, COALESCE(SUM(m.axis_ld), 0) AS axis_ld
										, COALESCE(SUM(m.other_ld), 0) AS other_ld

										, COALESCE(SUM(m.telkomsel_md), 0) AS telkomsel_md
										, COALESCE(SUM(m.isat_md), 0) AS isat_md
										, COALESCE(SUM(m.xl_md), 0) AS xl_md
										, COALESCE(SUM(m.tri_md), 0) AS tri_md
										, COALESCE(SUM(m.smartfren_md), 0) AS smartfren_md
										, COALESCE(SUM(m.axis_md), 0) AS axis_md
										, COALESCE(SUM(m.other_md), 0) AS other_md

										, COALESCE(SUM(m.telkomsel_hd), 0) AS telkomsel_hd
										, COALESCE(SUM(m.isat_hd), 0) AS isat_hd
										, COALESCE(SUM(m.xl_hd), 0) AS xl_hd
										, COALESCE(SUM(m.tri_hd), 0) AS tri_hd
										, COALESCE(SUM(m.smartfren_hd), 0) AS smartfren_hd
										, COALESCE(SUM(m.axis_hd), 0) AS axis_hd
										, COALESCE(SUM(m.other_hd), 0) AS other_hd
								FROM
										ob_market_audit_outlet m
										INNER JOIN eb_outlet l
												ON (m.id_outlet = l.id_outlet)
								WHERE (m.tahun = "'.$this->tahun.'"
										AND m.bulan = "'.$this->bulan.'"
										AND m.minggu = "'.$this->minggu.'"
										AND l.id_tap = "'.$id_tap.'"
										AND m.id_jenis_share = "'.$id_jenis_share.'")
						) xx
					');

					$rs_c = $this->db->get()->row_array();

					$telkomsel = isset($rs_c['telkomsel']) ? $rs_c['telkomsel'] : 0;
					$isat = isset($rs_c['isat']) ? $rs_c['isat'] : 0;
					$xl = isset($rs_c['xl']) ? $rs_c['xl'] : 0;
					$tri = isset($rs_c['tri']) ? $rs_c['tri'] : 0;
					$smartfren = isset($rs_c['smartfren']) ? $rs_c['smartfren'] : 0;
					$axis = isset($rs_c['axis']) ? $rs_c['axis'] : 0;
					$other = isset($rs_c['other']) ? $rs_c['other'] : 0;
					$total = isset($rs_c['total']) ? $rs_c['total'] : 0;

					$telkomsel_ld = isset($rs_c['telkomsel_ld']) ? $rs_c['telkomsel_ld'] : 0;
					$isat_ld = isset($rs_c['isat_ld']) ? $rs_c['isat_ld'] : 0;
					$xl_ld = isset($rs_c['xl_ld']) ? $rs_c['xl_ld'] : 0;
					$tri_ld = isset($rs_c['tri_ld']) ? $rs_c['tri_ld'] : 0;
					$smartfren_ld = isset($rs_c['smartfren_ld']) ? $rs_c['smartfren_ld'] : 0;
					$axis_ld = isset($rs_c['axis_ld']) ? $rs_c['axis_ld'] : 0;
					$other_ld = isset($rs_c['other_ld']) ? $rs_c['other_ld'] : 0;
					$total_ld = isset($rs_c['total_ld']) ? $rs_c['total_ld'] : 0;

					$telkomsel_md = isset($rs_c['telkomsel_md']) ? $rs_c['telkomsel_md'] : 0;
					$isat_md = isset($rs_c['isat_md']) ? $rs_c['isat_md'] : 0;
					$xl_md = isset($rs_c['xl_md']) ? $rs_c['xl_md'] : 0;
					$tri_md = isset($rs_c['tri_md']) ? $rs_c['tri_md'] : 0;
					$smartfren_md = isset($rs_c['smartfren_md']) ? $rs_c['smartfren_md'] : 0;
					$axis_md = isset($rs_c['axis_md']) ? $rs_c['axis_md'] : 0;
					$other_md = isset($rs_c['other_md']) ? $rs_c['other_md'] : 0;
					$total_md = isset($rs_c['total_md']) ? $rs_c['total_md'] : 0;

					$telkomsel_hd = isset($rs_c['telkomsel_hd']) ? $rs_c['telkomsel_hd'] : 0;
					$isat_hd = isset($rs_c['isat_hd']) ? $rs_c['isat_hd'] : 0;
					$xl_hd = isset($rs_c['xl_hd']) ? $rs_c['xl_hd'] : 0;
					$tri_hd = isset($rs_c['tri_hd']) ? $rs_c['tri_hd'] : 0;
					$smartfren_hd = isset($rs_c['smartfren_hd']) ? $rs_c['smartfren_hd'] : 0;
					$axis_hd = isset($rs_c['axis_hd']) ? $rs_c['axis_hd'] : 0;
					$other_hd = isset($rs_c['other_hd']) ? $rs_c['other_hd'] : 0;
					$total_hd = isset($rs_c['total_hd']) ? $rs_c['total_hd'] : 0;

					$telkomsel_ld_persen = isset($rs_c['telkomsel_ld_persen']) ? $rs_c['telkomsel_ld_persen'] : 0;
					$isat_ld_persen = isset($rs_c['isat_ld_persen']) ? $rs_c['isat_ld_persen'] : 0;
					$xl_ld_persen = isset($rs_c['xl_ld_persen']) ? $rs_c['xl_ld_persen'] : 0;
					$tri_ld_persen = isset($rs_c['tri_ld_persen']) ? $rs_c['tri_ld_persen'] : 0;
					$smartfren_ld_persen = isset($rs_c['smartfren_ld_persen']) ? $rs_c['smartfren_ld_persen'] : 0;
					$axis_ld_persen = isset($rs_c['axis_ld_persen']) ? $rs_c['axis_ld_persen'] : 0;
					$other_ld_persen = isset($rs_c['other_ld_persen']) ? $rs_c['other_ld_persen'] : 0;
					$total_ld_persen = isset($rs_c['total_ld_persen']) ? $rs_c['total_ld_persen'] : 0;

					$telkomsel_md_persen = isset($rs_c['telkomsel_md_persen']) ? $rs_c['telkomsel_md_persen'] : 0;
					$isat_md_persen = isset($rs_c['isat_md_persen']) ? $rs_c['isat_md_persen'] : 0;
					$xl_md_persen = isset($rs_c['xl_md_persen']) ? $rs_c['xl_md_persen'] : 0;
					$tri_md_persen = isset($rs_c['tri_md_persen']) ? $rs_c['tri_md_persen'] : 0;
					$smartfren_md_persen = isset($rs_c['smartfren_md_persen']) ? $rs_c['smartfren_md_persen'] : 0;
					$axis_md_persen = isset($rs_c['axis_md_persen']) ? $rs_c['axis_md_persen'] : 0;
					$other_md_persen = isset($rs_c['other_md_persen']) ? $rs_c['other_md_persen'] : 0;
					$total_md_persen = isset($rs_c['total_md_persen']) ? $rs_c['total_md_persen'] : 0;

					$telkomsel_hd_persen = isset($rs_c['telkomsel_hd_persen']) ? $rs_c['telkomsel_hd_persen'] : 0;
					$isat_hd_persen = isset($rs_c['isat_hd_persen']) ? $rs_c['isat_hd_persen'] : 0;
					$xl_hd_persen = isset($rs_c['xl_hd_persen']) ? $rs_c['xl_hd_persen'] : 0;
					$tri_hd_persen = isset($rs_c['tri_hd_persen']) ? $rs_c['tri_hd_persen'] : 0;
					$smartfren_hd_persen = isset($rs_c['smartfren_hd_persen']) ? $rs_c['smartfren_hd_persen'] : 0;
					$axis_hd_persen = isset($rs_c['axis_hd_persen']) ? $rs_c['axis_hd_persen'] : 0;
					$other_hd_persen = isset($rs_c['other_hd_persen']) ? $rs_c['other_hd_persen'] : 0;
					$total_hd_persen = isset($rs_c['total_hd_persen']) ? $rs_c['total_hd_persen'] : 0;

					$this->db->select('1');
					$this->db->from('oz_maket_audit_res_tap');
					$this->db->where('tahun', $this->tahun);
					$this->db->where('bulan', $this->bulan);
					$this->db->where('minggu', $this->minggu);
					$this->db->where('id_tap', $id_tap);
					$this->db->where('id_jenis_share', $id_jenis_share);

					$rs_d = $this->db->get()->row_array();

					if ($rs_d)
					{
						$data_x = array(
							'tahun' => $this->tahun,
							'bulan' => $this->bulan,
							'minggu' => $this->minggu,
							'id_tap' => $id_tap,
							'id_jenis_share' => $id_jenis_share,

							'telkomsel' => $telkomsel,
							'isat' => $isat,
							'xl' => $xl,
							'tri' => $tri,
							'smartfren' => $smartfren,
							'axis' => $axis,
							'other' => $other,
							'total' => $total,

							'telkomsel_ld' => $telkomsel_ld,
							'isat_ld' => $isat_ld,
							'xl_ld' => $xl_ld,
							'tri_ld' => $tri_ld,
							'smartfren_ld' => $smartfren_ld,
							'axis_ld' => $axis_ld,
							'other_ld' => $other_ld,
							'total_ld' => $total_ld,

							'telkomsel_md' => $telkomsel_md,
							'isat_md' => $isat_md,
							'xl_md' => $xl_md,
							'tri_md' => $tri_md,
							'smartfren_md' => $smartfren_md,
							'axis_md' => $axis_md,
							'other_md' => $other_md,
							'total_md' => $total_md,

							'telkomsel_hd' => $telkomsel_hd,
							'isat_hd' => $isat_hd,
							'xl_hd' => $xl_hd,
							'tri_hd' => $tri_hd,
							'smartfren_hd' => $smartfren_hd,
							'axis_hd' => $axis_hd,
							'other_hd' => $other_hd,
							'total_hd' => $total_hd,

							'telkomsel_ld_persen' => $telkomsel_ld_persen,
							'isat_ld_persen' => $isat_ld_persen,
							'xl_ld_persen' => $xl_ld_persen,
							'tri_ld_persen' => $tri_ld_persen,
							'smartfren_ld_persen' => $smartfren_ld_persen,
							'axis_ld_persen' => $axis_ld_persen,
							'other_ld_persen' => $other_ld_persen,
							'total_ld_persen' => $total_ld_persen,

							'telkomsel_md_persen' => $telkomsel_md_persen,
							'isat_md_persen' => $isat_md_persen,
							'xl_md_persen' => $xl_md_persen,
							'tri_md_persen' => $tri_md_persen,
							'smartfren_md_persen' => $smartfren_md_persen,
							'axis_md_persen' => $axis_md_persen,
							'other_md_persen' => $other_md_persen,
							'total_md_persen' => $total_md_persen,

							'telkomsel_hd_persen' => $telkomsel_hd_persen,
							'isat_hd_persen' => $isat_hd_persen,
							'xl_hd_persen' => $xl_hd_persen,
							'tri_hd_persen' => $tri_hd_persen,
							'smartfren_hd_persen' => $smartfren_hd_persen,
							'axis_hd_persen' => $axis_hd_persen,
							'other_hd_persen' => $other_hd_persen,
							'total_hd_persen' => $total_hd_persen
						);

						$this->db->where('tahun', $this->tahun);
						$this->db->where('bulan', $this->bulan);
						$this->db->where('minggu', $this->minggu);
						$this->db->where('id_tap', $id_tap);
						$this->db->where('id_jenis_share', $id_jenis_share);
						$this->db->update('oz_maket_audit_res_tap', $data_x);
						$this->check_trans_status('update oz_maket_audit_res_tap failed');
					}
					else
					{
						$data_x = array(
							'tahun' => $this->tahun,
							'bulan' => $this->bulan,
							'minggu' => $this->minggu,
							'id_tap' => $id_tap,
							'id_jenis_share' => $id_jenis_share,

							'telkomsel' => $telkomsel,
							'isat' => $isat,
							'xl' => $xl,
							'tri' => $tri,
							'smartfren' => $smartfren,
							'axis' => $axis,
							'other' => $other,
							'total' => $total,

							'telkomsel_ld' => $telkomsel_ld,
							'isat_ld' => $isat_ld,
							'xl_ld' => $xl_ld,
							'tri_ld' => $tri_ld,
							'smartfren_ld' => $smartfren_ld,
							'axis_ld' => $axis_ld,
							'other_ld' => $other_ld,
							'total_ld' => $total_ld,

							'telkomsel_md' => $telkomsel_md,
							'isat_md' => $isat_md,
							'xl_md' => $xl_md,
							'tri_md' => $tri_md,
							'smartfren_md' => $smartfren_md,
							'axis_md' => $axis_md,
							'other_md' => $other_md,
							'total_md' => $total_md,

							'telkomsel_hd' => $telkomsel_hd,
							'isat_hd' => $isat_hd,
							'xl_hd' => $xl_hd,
							'tri_hd' => $tri_hd,
							'smartfren_hd' => $smartfren_hd,
							'axis_hd' => $axis_hd,
							'other_hd' => $other_hd,
							'total_hd' => $total_hd,

							'telkomsel_ld_persen' => $telkomsel_ld_persen,
							'isat_ld_persen' => $isat_ld_persen,
							'xl_ld_persen' => $xl_ld_persen,
							'tri_ld_persen' => $tri_ld_persen,
							'smartfren_ld_persen' => $smartfren_ld_persen,
							'axis_ld_persen' => $axis_ld_persen,
							'other_ld_persen' => $other_ld_persen,
							'total_ld_persen' => $total_ld_persen,

							'telkomsel_md_persen' => $telkomsel_md_persen,
							'isat_md_persen' => $isat_md_persen,
							'xl_md_persen' => $xl_md_persen,
							'tri_md_persen' => $tri_md_persen,
							'smartfren_md_persen' => $smartfren_md_persen,
							'axis_md_persen' => $axis_md_persen,
							'other_md_persen' => $other_md_persen,
							'total_md_persen' => $total_md_persen,

							'telkomsel_hd_persen' => $telkomsel_hd_persen,
							'isat_hd_persen' => $isat_hd_persen,
							'xl_hd_persen' => $xl_hd_persen,
							'tri_hd_persen' => $tri_hd_persen,
							'smartfren_hd_persen' => $smartfren_hd_persen,
							'axis_hd_persen' => $axis_hd_persen,
							'other_hd_persen' => $other_hd_persen,
							'total_hd_persen' => $total_hd_persen
						);

						$this->db->insert('oz_maket_audit_res_tap', $data_x);
						$this->check_trans_status('insert oz_maket_audit_res_tap failed');
					}
				}
			}
		}
	}
}
?>