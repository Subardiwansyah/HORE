<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regional_model extends CI_model {

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

	function save_data_regional()
  {
    $this->db->trans_begin();
    try {
			$this->select_penjualan_tanggal();
			$this->insert_data_outlet();
			$this->insert_data_sekolah();
			$this->insert_data_kampus();
			$this->insert_data_fakultas();
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
		$id_jenis_lokasi = 'OUT';

		$this->db->select('*');
		$this->db->from('ba_regional');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_regional = $rs_a[$a]['id_regional'] ? $rs_a[$a]['id_regional'] : 0;

				$arr_share = array('PERDANA', 'VOUCHER_FISIK', 'SPANDUK', 'POSTER', 'PAPAN_NAMA', 'BACKDROP');

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
						, xx.total

						, ((xx.telkomsel / xx.total) * 100) AS telkomsel_persen
						, ((xx.isat / xx.total) * 100) AS isat_persen
						, ((xx.xl / xx.total) * 100) AS xl_persen
						, ((xx.tri / xx.total) * 100) AS tri_persen
						, ((xx.smartfren / xx.total) * 100) AS smartfren_persen
						, ((xx.axis / xx.total) * 100) AS axis_persen
						, ((xx.other / xx.total) * 100) AS other_persen
						, ((xx.total / xx.total) * 100) AS total_persen

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
									, COALESCE(SUM(m.total), 0) AS total
							FROM
									mb_merchandising_outlet m
									INNER JOIN eb_outlet l
											ON (m.id_outlet = l.id_outlet)
									INNER JOIN bd_tap t
											ON (l.id_tap = t.id_tap)
									INNER JOIN bc_cluster c
											ON (t.id_cluster = c.id_cluster)
									INNER JOIN bb_branch b
											ON (c.id_branch = b.id_branch)
							WHERE (b.id_regional = "'.$id_regional.'"
									AND m.tahun = "'.$this->tahun.'"
									AND m.bulan = "'.$this->bulan.'"
									AND m.minggu = "'.$this->minggu.'"
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

					$telkomsel_persen = isset($rs_c['telkomsel_persen']) ? $rs_c['telkomsel_persen'] : 0;
					$isat_persen = isset($rs_c['isat_persen']) ? $rs_c['isat_persen'] : 0;
					$xl_persen = isset($rs_c['xl_persen']) ? $rs_c['xl_persen'] : 0;
					$tri_persen = isset($rs_c['tri_persen']) ? $rs_c['tri_persen'] : 0;
					$smartfren_persen = isset($rs_c['smartfren_persen']) ? $rs_c['smartfren_persen'] : 0;
					$axis_persen = isset($rs_c['axis_persen']) ? $rs_c['axis_persen'] : 0;
					$other_persen = isset($rs_c['other_persen']) ? $rs_c['other_persen'] : 0;
					$total_persen = isset($rs_c['total_persen']) ? $rs_c['total_persen'] : 0;

					$this->db->select('1');
					$this->db->from('mf_merchandising_res_regional');
					$this->db->where('id_regional', $id_regional);
					$this->db->where('tahun', $this->tahun);
					$this->db->where('bulan', $this->bulan);
					$this->db->where('minggu', $this->minggu);
					$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
					$this->db->where('id_jenis_share', $id_jenis_share);

					$rs_d = $this->db->get()->row_array();

					if ($rs_d)
					{
						$data_x = array(
							'telkomsel' => $telkomsel,
							'isat' => $isat,
							'xl' => $xl,
							'tri' => $tri,
							'smartfren' => $smartfren,
							'axis' => $axis,
							'other' => $other,
							'total' => $total,
							'telkomsel_persen' => $telkomsel_persen,
							'isat_persen' => $isat_persen,
							'xl_persen' => $xl_persen,
							'tri_persen' => $tri_persen,
							'smartfren_persen' => $smartfren_persen,
							'axis_persen' => $axis_persen,
							'other_persen' => $other_persen,
							'total_persen' => $total_persen,
							'm_1' => 0,
							'm_2' => 0,
							'w_1' => 0,
							'w_2' => 0,
						);

						$this->db->where('id_regional', $id_regional);
						$this->db->where('tahun', $this->tahun);
						$this->db->where('bulan', $this->bulan);
						$this->db->where('minggu', $this->minggu);
						$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
						$this->db->where('id_jenis_share', $id_jenis_share);
						$this->db->update('mf_merchandising_res_regional', $data_x);
						$this->check_trans_status('update mf_merchandising_res_regional failed');
					}
					else
					{
						$data_x = array(
							'id_regional' => $id_regional,
							'tahun' => $this->tahun,
							'bulan' => $this->bulan,
							'minggu' => $this->minggu,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_share' => $id_jenis_share,
							'telkomsel' => $telkomsel,
							'isat' => $isat,
							'xl' => $xl,
							'tri' => $tri,
							'smartfren' => $smartfren,
							'axis' => $axis,
							'other' => $other,
							'total' => $total,
							'telkomsel_persen' => $telkomsel_persen,
							'isat_persen' => $isat_persen,
							'xl_persen' => $xl_persen,
							'tri_persen' => $tri_persen,
							'smartfren_persen' => $smartfren_persen,
							'axis_persen' => $axis_persen,
							'other_persen' => $other_persen,
							'total_persen' => $total_persen,
							'm_1' => 0,
							'm_2' => 0,
							'w_1' => 0,
							'w_2' => 0
						);

						$this->db->insert('mf_merchandising_res_regional', $data_x);
						$this->check_trans_status('insert mf_merchandising_res_regional failed');
					}
				}
			}
		}
	}

	function insert_data_sekolah()
  {
		$id_jenis_lokasi = 'SEK';

		$this->db->select('*');
		$this->db->from('ba_regional');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_regional = $rs_a[$a]['id_regional'] ? $rs_a[$a]['id_regional'] : 0;

				$arr_share = array('SPANDUK', 'POSTER');

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
						, xx.total

						, ((xx.telkomsel / xx.total) * 100) AS telkomsel_persen
						, ((xx.isat / xx.total) * 100) AS isat_persen
						, ((xx.xl / xx.total) * 100) AS xl_persen
						, ((xx.tri / xx.total) * 100) AS tri_persen
						, ((xx.smartfren / xx.total) * 100) AS smartfren_persen
						, ((xx.axis / xx.total) * 100) AS axis_persen
						, ((xx.other / xx.total) * 100) AS other_persen
						, ((xx.total / xx.total) * 100) AS total_persen

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
									, COALESCE(SUM(m.total), 0) AS total
							FROM
									mc_merchandising_sekolah m
									INNER JOIN ec_sekolah l
											ON (m.id_sekolah = l.id_sekolah)
									INNER JOIN bd_tap t
											ON (l.id_tap = t.id_tap)
									INNER JOIN bc_cluster c
											ON (t.id_cluster = c.id_cluster)
									INNER JOIN bb_branch b
											ON (c.id_branch = b.id_branch)
							WHERE (b.id_regional = "'.$id_regional.'"
									AND m.tahun = "'.$this->tahun.'"
									AND m.bulan = "'.$this->bulan.'"
									AND m.minggu = "'.$this->minggu.'"
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

					$telkomsel_persen = isset($rs_c['telkomsel_persen']) ? $rs_c['telkomsel_persen'] : 0;
					$isat_persen = isset($rs_c['isat_persen']) ? $rs_c['isat_persen'] : 0;
					$xl_persen = isset($rs_c['xl_persen']) ? $rs_c['xl_persen'] : 0;
					$tri_persen = isset($rs_c['tri_persen']) ? $rs_c['tri_persen'] : 0;
					$smartfren_persen = isset($rs_c['smartfren_persen']) ? $rs_c['smartfren_persen'] : 0;
					$axis_persen = isset($rs_c['axis_persen']) ? $rs_c['axis_persen'] : 0;
					$other_persen = isset($rs_c['other_persen']) ? $rs_c['other_persen'] : 0;
					$total_persen = isset($rs_c['total_persen']) ? $rs_c['total_persen'] : 0;

					$this->db->select('1');
					$this->db->from('mf_merchandising_res_regional');
					$this->db->where('id_regional', $id_regional);
					$this->db->where('tahun', $this->tahun);
					$this->db->where('bulan', $this->bulan);
					$this->db->where('minggu', $this->minggu);
					$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
					$this->db->where('id_jenis_share', $id_jenis_share);

					$rs_d = $this->db->get()->row_array();

					if ($rs_d)
					{
						$data_x = array(
							'telkomsel' => $telkomsel,
							'isat' => $isat,
							'xl' => $xl,
							'tri' => $tri,
							'smartfren' => $smartfren,
							'axis' => $axis,
							'other' => $other,
							'total' => $total,
							'telkomsel_persen' => $telkomsel_persen,
							'isat_persen' => $isat_persen,
							'xl_persen' => $xl_persen,
							'tri_persen' => $tri_persen,
							'smartfren_persen' => $smartfren_persen,
							'axis_persen' => $axis_persen,
							'other_persen' => $other_persen,
							'total_persen' => $total_persen,
							'm_1' => 0,
							'm_2' => 0,
							'w_1' => 0,
							'w_2' => 0
						);

						$this->db->where('id_regional', $id_regional);
						$this->db->where('tahun', $this->tahun);
						$this->db->where('bulan', $this->bulan);
						$this->db->where('minggu', $this->minggu);
						$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
						$this->db->where('id_jenis_share', $id_jenis_share);
						$this->db->update('mf_merchandising_res_regional', $data_x);
						$this->check_trans_status('update mf_merchandising_res_regional failed');
					}
					else
					{
						$data_x = array(
							'id_regional' => $id_regional,
							'tahun' => $this->tahun,
							'bulan' => $this->bulan,
							'minggu' => $this->minggu,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_share' => $id_jenis_share,
							'telkomsel' => $telkomsel,
							'isat' => $isat,
							'xl' => $xl,
							'tri' => $tri,
							'smartfren' => $smartfren,
							'axis' => $axis,
							'other' => $other,
							'total' => $total,
							'telkomsel_persen' => $telkomsel_persen,
							'isat_persen' => $isat_persen,
							'xl_persen' => $xl_persen,
							'tri_persen' => $tri_persen,
							'smartfren_persen' => $smartfren_persen,
							'axis_persen' => $axis_persen,
							'other_persen' => $other_persen,
							'total_persen' => $total_persen,
							'm_1' => 0,
							'm_2' => 0,
							'w_1' => 0,
							'w_2' => 0
						);

						$this->db->insert('mf_merchandising_res_regional', $data_x);
						$this->check_trans_status('insert mf_merchandising_res_regional failed');
					}
				}
			}
		}
	}

	function insert_data_kampus()
  {
		$id_jenis_lokasi = 'KAM';

		$this->db->select('*');
		$this->db->from('ba_regional');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_regional = $rs_a[$a]['id_regional'] ? $rs_a[$a]['id_regional'] : 0;

				$arr_share = array('SPANDUK', 'POSTER');

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
						, xx.total

						, ((xx.telkomsel / xx.total) * 100) AS telkomsel_persen
						, ((xx.isat / xx.total) * 100) AS isat_persen
						, ((xx.xl / xx.total) * 100) AS xl_persen
						, ((xx.tri / xx.total) * 100) AS tri_persen
						, ((xx.smartfren / xx.total) * 100) AS smartfren_persen
						, ((xx.axis / xx.total) * 100) AS axis_persen
						, ((xx.other / xx.total) * 100) AS other_persen
						, ((xx.total / xx.total) * 100) AS total_persen

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
									, COALESCE(SUM(m.total), 0) AS total
							FROM
									md_merchandising_kampus m
									INNER JOIN ed_kampus l
											ON (m.id_universitas = l.id_universitas)
									INNER JOIN bd_tap t
											ON (l.id_tap = t.id_tap)
									INNER JOIN bc_cluster c
											ON (t.id_cluster = c.id_cluster)
									INNER JOIN bb_branch b
											ON (c.id_branch = b.id_branch)
							WHERE (b.id_regional = "'.$id_regional.'"
									AND m.tahun = "'.$this->tahun.'"
									AND m.bulan = "'.$this->bulan.'"
									AND m.minggu = "'.$this->minggu.'"
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

					$telkomsel_persen = isset($rs_c['telkomsel_persen']) ? $rs_c['telkomsel_persen'] : 0;
					$isat_persen = isset($rs_c['isat_persen']) ? $rs_c['isat_persen'] : 0;
					$xl_persen = isset($rs_c['xl_persen']) ? $rs_c['xl_persen'] : 0;
					$tri_persen = isset($rs_c['tri_persen']) ? $rs_c['tri_persen'] : 0;
					$smartfren_persen = isset($rs_c['smartfren_persen']) ? $rs_c['smartfren_persen'] : 0;
					$axis_persen = isset($rs_c['axis_persen']) ? $rs_c['axis_persen'] : 0;
					$other_persen = isset($rs_c['other_persen']) ? $rs_c['other_persen'] : 0;
					$total_persen = isset($rs_c['total_persen']) ? $rs_c['total_persen'] : 0;

					$this->db->select('1');
					$this->db->from('mf_merchandising_res_regional');
					$this->db->where('id_regional', $id_regional);
					$this->db->where('tahun', $this->tahun);
					$this->db->where('bulan', $this->bulan);
					$this->db->where('minggu', $this->minggu);
					$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
					$this->db->where('id_jenis_share', $id_jenis_share);

					$rs_d = $this->db->get()->row_array();

					if ($rs_d)
					{
						$data_x = array(
							'telkomsel' => $telkomsel,
							'isat' => $isat,
							'xl' => $xl,
							'tri' => $tri,
							'smartfren' => $smartfren,
							'axis' => $axis,
							'other' => $other,
							'total' => $total,
							'telkomsel_persen' => $telkomsel_persen,
							'isat_persen' => $isat_persen,
							'xl_persen' => $xl_persen,
							'tri_persen' => $tri_persen,
							'smartfren_persen' => $smartfren_persen,
							'axis_persen' => $axis_persen,
							'other_persen' => $other_persen,
							'total_persen' => $total_persen,
							'm_1' => 0,
							'm_2' => 0,
							'w_1' => 0,
							'w_2' => 0
						);

						$this->db->where('id_regional', $id_regional);
						$this->db->where('tahun', $this->tahun);
						$this->db->where('bulan', $this->bulan);
						$this->db->where('minggu', $this->minggu);
						$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
						$this->db->where('id_jenis_share', $id_jenis_share);
						$this->db->update('mf_merchandising_res_regional', $data_x);
						$this->check_trans_status('update mf_merchandising_res_regional failed');
					}
					else
					{
						$data_x = array(
							'id_regional' => $id_regional,
							'tahun' => $this->tahun,
							'bulan' => $this->bulan,
							'minggu' => $this->minggu,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_share' => $id_jenis_share,
							'telkomsel' => $telkomsel,
							'isat' => $isat,
							'xl' => $xl,
							'tri' => $tri,
							'smartfren' => $smartfren,
							'axis' => $axis,
							'other' => $other,
							'total' => $total,
							'telkomsel_persen' => $telkomsel_persen,
							'isat_persen' => $isat_persen,
							'xl_persen' => $xl_persen,
							'tri_persen' => $tri_persen,
							'smartfren_persen' => $smartfren_persen,
							'axis_persen' => $axis_persen,
							'other_persen' => $other_persen,
							'total_persen' => $total_persen,
							'm_1' => 0,
							'm_2' => 0,
							'w_1' => 0,
							'w_2' => 0
						);

						$this->db->insert('mf_merchandising_res_regional', $data_x);
						$this->check_trans_status('insert mf_merchandising_res_regional failed');
					}
				}
			}
		}
	}

	function insert_data_fakultas()
  {
		$id_jenis_lokasi = 'FAK';

		$this->db->select('*');
		$this->db->from('ba_regional');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_regional = $rs_a[$a]['id_regional'] ? $rs_a[$a]['id_regional'] : 0;

				$arr_share = array('SPANDUK', 'POSTER');

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
						, xx.total

						, ((xx.telkomsel / xx.total) * 100) AS telkomsel_persen
						, ((xx.isat / xx.total) * 100) AS isat_persen
						, ((xx.xl / xx.total) * 100) AS xl_persen
						, ((xx.tri / xx.total) * 100) AS tri_persen
						, ((xx.smartfren / xx.total) * 100) AS smartfren_persen
						, ((xx.axis / xx.total) * 100) AS axis_persen
						, ((xx.other / xx.total) * 100) AS other_persen
						, ((xx.total / xx.total) * 100) AS total_persen

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
									, COALESCE(SUM(m.total), 0) AS total
							FROM
									me_merchandising_fakultas m
									INNER JOIN ee_fakultas l
											ON (m.id_fakultas = l.id_fakultas)
									INNER JOIN bd_tap t
											ON (l.id_tap = t.id_tap)
									INNER JOIN bc_cluster c
											ON (t.id_cluster = c.id_cluster)
									INNER JOIN bb_branch b
											ON (c.id_branch = b.id_branch)
							WHERE (b.id_regional = "'.$id_regional.'"
									AND m.tahun = "'.$this->tahun.'"
									AND m.bulan = "'.$this->bulan.'"
									AND m.minggu = "'.$this->minggu.'"
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

					$telkomsel_persen = isset($rs_c['telkomsel_persen']) ? $rs_c['telkomsel_persen'] : 0;
					$isat_persen = isset($rs_c['isat_persen']) ? $rs_c['isat_persen'] : 0;
					$xl_persen = isset($rs_c['xl_persen']) ? $rs_c['xl_persen'] : 0;
					$tri_persen = isset($rs_c['tri_persen']) ? $rs_c['tri_persen'] : 0;
					$smartfren_persen = isset($rs_c['smartfren_persen']) ? $rs_c['smartfren_persen'] : 0;
					$axis_persen = isset($rs_c['axis_persen']) ? $rs_c['axis_persen'] : 0;
					$other_persen = isset($rs_c['other_persen']) ? $rs_c['other_persen'] : 0;
					$total_persen = isset($rs_c['total_persen']) ? $rs_c['total_persen'] : 0;

					$this->db->select('1');
					$this->db->from('mf_merchandising_res_regional');
					$this->db->where('id_regional', $id_regional);
					$this->db->where('tahun', $this->tahun);
					$this->db->where('bulan', $this->bulan);
					$this->db->where('minggu', $this->minggu);
					$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
					$this->db->where('id_jenis_share', $id_jenis_share);

					$rs_d = $this->db->get()->row_array();

					if ($rs_d)
					{
						$data_x = array(
							'telkomsel' => $telkomsel,
							'isat' => $isat,
							'xl' => $xl,
							'tri' => $tri,
							'smartfren' => $smartfren,
							'axis' => $axis,
							'other' => $other,
							'total' => $total,
							'telkomsel_persen' => $telkomsel_persen,
							'isat_persen' => $isat_persen,
							'xl_persen' => $xl_persen,
							'tri_persen' => $tri_persen,
							'smartfren_persen' => $smartfren_persen,
							'axis_persen' => $axis_persen,
							'other_persen' => $other_persen,
							'total_persen' => $total_persen,
							'm_1' => 0,
							'm_2' => 0,
							'w_1' => 0,
							'w_2' => 0
						);

						$this->db->where('id_regional', $id_regional);
						$this->db->where('tahun', $this->tahun);
						$this->db->where('bulan', $this->bulan);
						$this->db->where('minggu', $this->minggu);
						$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
						$this->db->where('id_jenis_share', $id_jenis_share);
						$this->db->update('mf_merchandising_res_regional', $data_x);
						$this->check_trans_status('update mf_merchandising_res_regional failed');
					}
					else
					{
						$data_x = array(
							'id_regional' => $id_regional,
							'tahun' => $this->tahun,
							'bulan' => $this->bulan,
							'minggu' => $this->minggu,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_share' => $id_jenis_share,
							'telkomsel' => $telkomsel,
							'isat' => $isat,
							'xl' => $xl,
							'tri' => $tri,
							'smartfren' => $smartfren,
							'axis' => $axis,
							'other' => $other,
							'total' => $total,
							'telkomsel_persen' => $telkomsel_persen,
							'isat_persen' => $isat_persen,
							'xl_persen' => $xl_persen,
							'tri_persen' => $tri_persen,
							'smartfren_persen' => $smartfren_persen,
							'axis_persen' => $axis_persen,
							'other_persen' => $other_persen,
							'total_persen' => $total_persen,
							'm_1' => 0,
							'm_2' => 0,
							'w_1' => 0,
							'w_2' => 0
						);

						$this->db->insert('mf_merchandising_res_regional', $data_x);
						$this->check_trans_status('insert mf_merchandising_res_regional failed');
					}
				}
			}
		}
	}
}
?>