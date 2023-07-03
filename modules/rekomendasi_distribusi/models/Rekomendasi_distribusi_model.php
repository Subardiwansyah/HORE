<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekomendasi_distribusi_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function penjualan_tanggal($tgl)
	{
		$this->w1_tahun = 0; $this->w1_bulan = 0; $this->w1_minggu = 0;
		$this->w2_tahun = 0; $this->w2_bulan = 0; $this->w2_minggu = 0;
		$this->w3_tahun = 0; $this->w3_bulan = 0; $this->w3_minggu = 0;

		$this->w0_tgl_mulai = 0; $this->w0_tgl_selesai = 0;
		$this->w1_tgl_mulai = 0; $this->w1_tgl_selesai = 0;
		$this->w2_tgl_mulai = 0; $this->w2_tgl_selesai = 0;
		$this->w3_tgl_mulai = 0; $this->w3_tgl_selesai = 0;

		$this->tahun_penjualan = 0; $this->bulan_penjualan = 0; $this->minggu_penjualan = 0;

		$this->db->select('p.tahun, p.bulan, p.minggu');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tanggal', $tgl);
		$rs_a = $this->db->get()->row_array();

		$tahun = isset($rs_a['tahun']) ? $rs_a['tahun'] : 0;
		$bulan = isset($rs_a['bulan']) ? (strlen((string) $rs_a['bulan']) == 1 ? '0'.$rs_a['bulan'] : $rs_a['bulan']) : 0;
		$minggu = isset($rs_a['minggu']) ? $rs_a['minggu'] : 0;

		$this->tahun_penjualan = (int) $tahun; $this->bulan_penjualan = (int) $bulan; $this->minggu_penjualan = (int) $minggu;

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
				WHERE CONCAT(p.tahun, (IF(LENGTH(p.bulan) = 1, CONCAT("0", p.bulan), p.bulan)), p.minggu) = "'.$tahun.$bulan.$minggu.'"
				GROUP BY p.tahun, p.bulan, p.minggu
			) xx
		');
		$rs_b = $this->db->get()->row_array();

		$this->w0_tgl_mulai = isset($rs_b['tgl_mulai']) ? $rs_b['tgl_mulai'] : 0;
		$this->w0_tgl_selesai = isset($rs_b['tgl_selesai']) ? $rs_b['tgl_selesai'] : 0;

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
		$rs_c = $this->db->get()->result_array();

		if (!empty($rs_c))
		{
			$total = count($rs_c);

			if ($total == 3)
			{
				$this->w1_tahun = isset($rs_c[0]['tahun']) ? $rs_c[0]['tahun'] : 0;
				$this->w1_bulan = isset($rs_c[0]['bulan']) ? $rs_c[0]['bulan'] : 0;
				$this->w1_minggu = isset($rs_c[0]['minggu']) ? $rs_c[0]['minggu'] : 0;
				$this->w2_tahun = isset($rs_c[1]['tahun']) ? $rs_c[1]['tahun'] : 0;
				$this->w2_bulan = isset($rs_c[1]['bulan']) ? $rs_c[1]['bulan'] : 0;
				$this->w2_minggu = isset($rs_c[1]['minggu']) ? $rs_c[1]['minggu'] : 0;
				$this->w3_tahun = isset($rs_c[2]['tahun']) ? $rs_c[2]['tahun'] : 0;
				$this->w3_bulan = isset($rs_c[2]['bulan']) ? $rs_c[2]['bulan'] : 0;
				$this->w3_minggu = isset($rs_c[2]['minggu']) ? $rs_c[2]['minggu'] : 0;

				$this->w1_tgl_mulai = isset($rs_c[0]['tgl_mulai']) ? $rs_c[0]['tgl_mulai'] : 0;
				$this->w1_tgl_selesai = isset($rs_c[0]['tgl_selesai']) ? $rs_c[0]['tgl_selesai'] : 0;
				$this->w2_tgl_mulai = isset($rs_c[1]['tgl_mulai']) ? $rs_c[1]['tgl_mulai'] : 0;
				$this->w2_tgl_selesai = isset($rs_c[1]['tgl_selesai']) ? $rs_c[1]['tgl_selesai'] : 0;
				$this->w3_tgl_mulai = isset($rs_c[2]['tgl_mulai']) ? $rs_c[2]['tgl_mulai'] : 0;
				$this->w3_tgl_selesai = isset($rs_c[2]['tgl_selesai']) ? $rs_c[2]['tgl_selesai'] : 0;
			}
			else if ($total == 2)
			{
				$this->w1_tahun = isset($rs_c[0]['tahun']) ? $rs_c[0]['tahun'] : 0;
				$this->w1_bulan = isset($rs_c[0]['bulan']) ? $rs_c[0]['bulan'] : 0;
				$this->w1_minggu = isset($rs_c[0]['minggu']) ? $rs_c[0]['minggu'] : 0;
				$this->w2_tahun = isset($rs_c[1]['tahun']) ? $rs_c[1]['tahun'] : 0;
				$this->w2_bulan = isset($rs_c[1]['bulan']) ? $rs_c[1]['bulan'] : 0;
				$this->w2_minggu = isset($rs_c[1]['minggu']) ? $rs_c[1]['minggu'] : 0;

				$this->w1_tgl_mulai = isset($rs_c[0]['tgl_mulai']) ? $rs_c[0]['tgl_mulai'] : 0;
				$this->w1_tgl_selesai = isset($rs_c[0]['tgl_selesai']) ? $rs_c[0]['tgl_selesai'] : 0;
				$this->w2_tgl_mulai = isset($rs_c[1]['tgl_mulai']) ? $rs_c[1]['tgl_mulai'] : 0;
				$this->w2_tgl_selesai = isset($rs_c[1]['tgl_selesai']) ? $rs_c[1]['tgl_selesai'] : 0;
			}
			else if ($total == 1)
			{
				$this->w1_tahun = isset($rs_c[0]['tahun']) ? $rs_c[0]['tahun'] : 0;
				$this->w1_bulan = isset($rs_c[0]['bulan']) ? $rs_c[0]['bulan'] : 0;
				$this->w1_minggu = isset($rs_c[0]['minggu']) ? $rs_c[0]['minggu'] : 0;

				$this->w1_tgl_mulai = isset($rs_c[0]['tgl_mulai']) ? $rs_c[0]['tgl_mulai'] : 0;
				$this->w1_tgl_selesai = isset($rs_c[0]['tgl_selesai']) ? $rs_c[0]['tgl_selesai'] : 0;
			}
		}
	}

	function get_data_list_rekomendasi($id_cluster, $tahun, $bulan, $minggu)
	{
		$this->db->select('r.*');
		$this->db->from('ka_rekomendasi r');
		$this->db->where('r.id_cluster', $id_cluster);
		$this->db->where('r.tahun', $tahun);
		$this->db->where('r.bulan', $bulan);
		$this->db->where('r.minggu', $minggu);

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_data_ss()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->penjualan_tanggal(date('Y-m-d'));

		$this->db->select('1');
		$this->db->from('ka_rekomendasi');
		$this->db->where('id_cluster', $id_divisi);
		$this->db->where('tahun', $this->tahun_penjualan);
		$this->db->where('bulan', $this->bulan_penjualan);
		$this->db->where('minggu', $this->minggu_penjualan);

		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$this->db->select('*');
			$this->db->from('ka_rekomendasi');
			$this->db->where('id_cluster', $id_divisi);
			$this->db->where('tahun', $this->tahun_penjualan);
			$this->db->where('bulan', $this->bulan_penjualan);
			$this->db->where('minggu', $this->minggu_penjualan);
		}
		else
		{
			$this->db->select('
				xx.ss_sgprepaid
				, xx.ss_sgota
				, xx.ss_sgvin
				, xx.ss_sgvgs
				, xx.ss_sgvgg
				, xx.ss_sgvgp
				, xx.ss_insac_ld
				, xx.ss_insac_md
				, xx.ss_insac_hd
				, xx.ss_invin_ld
				, xx.ss_invin_md
				, xx.ss_invin_hd
				, xx.ss_invga_ld
				, xx.ss_invga_md
				, xx.ss_invga_hd
				, xx.total_ss
			');
			$this->db->from('
				(
					SELECT
							SUM(v.sgprepaid) AS ss_sgprepaid
							, SUM(v.sgota) AS ss_sgota
							, SUM(v.sgvin) AS ss_sgvin
							, SUM(v.sgvgs) AS ss_sgvgs
							, SUM(v.sgvgg) AS ss_sgvgg
							, SUM(v.sgvgp) AS ss_sgvgp
							, SUM(v.insac_ld) AS ss_insac_ld
							, SUM(v.insac_md) AS ss_insac_md
							, SUM(v.insac_hd) AS ss_insac_hd
							, SUM(v.invin_ld) AS ss_invin_ld
							, SUM(v.invin_md) AS ss_invin_md
							, SUM(v.invin_hd) AS ss_invin_hd
							, SUM(v.invga_ld) AS ss_invga_ld
							, SUM(v.invga_md) AS ss_invga_md
							, SUM(v.invga_hd) AS ss_invga_hd
							, (
										SUM(v.sgprepaid) + SUM(v.sgota) +
										SUM(v.sgvin) +
										SUM(v.sgvgs) + SUM(v.sgvgg) + SUM(v.sgvgp) +
										SUM(v.insac_ld) + SUM(v.insac_md) + SUM(v.insac_hd) +
										SUM(v.invin_ld) + SUM(v.invin_md) + SUM(v.invin_hd) +
										SUM(v.invga_ld) + SUM(v.invga_md) + SUM(v.invga_hd)
								) AS total_ss
					FROM
							(SELECT @id_cluster:="'.$id_divisi.'") x_id_cluster,
							(SELECT @w0_tgl_mulai:="'.$this->w0_tgl_mulai.'") x_w0_tgl_mulai,
							(SELECT @w0_tgl_selesai:="'.$this->w0_tgl_selesai.'") x_w0_tgl_selesai,
							v_rekomdist_ss v
				) xx
			');
		}

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_data_dpt()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->penjualan_tanggal(date('Y-m-d'));

		$this->db->select('1');
		$this->db->from('ka_rekomendasi');
		$this->db->where('id_cluster', $id_divisi);
		$this->db->where('tahun', $this->tahun_penjualan);
		$this->db->where('bulan', $this->bulan_penjualan);
		$this->db->where('minggu', $this->minggu_penjualan);

		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$this->db->select('*');
			$this->db->from('ka_rekomendasi');
			$this->db->where('id_cluster', $id_divisi);
			$this->db->where('tahun', $this->tahun_penjualan);
			$this->db->where('bulan', $this->bulan_penjualan);
			$this->db->where('minggu', $this->minggu_penjualan);
		}
		else
		{
			$this->db->select('
				xx.dpt_sgprepaid
				, xx.dpt_sgota
				, xx.dpt_sgvin
				, xx.dpt_sgvgs
				, xx.dpt_sgvgg
				, xx.dpt_sgvgp
				, xx.dpt_insac_ld
				, xx.dpt_insac_md
				, xx.dpt_insac_hd
				, xx.dpt_invin_ld
				, xx.dpt_invin_md
				, xx.dpt_invin_hd
				, xx.dpt_invga_ld
				, xx.dpt_invga_md
				, xx.dpt_invga_hd
				, xx.total_dpt
			');
			$this->db->from('
				(
					SELECT
							SUM(v.sgprepaid) AS dpt_sgprepaid
							, SUM(v.sgota) AS dpt_sgota
							, SUM(v.sgvin) AS dpt_sgvin
							, SUM(v.sgvgs) AS dpt_sgvgs
							, SUM(v.sgvgg) AS dpt_sgvgg
							, SUM(v.sgvgp) AS dpt_sgvgp
							, SUM(v.insac_ld) AS dpt_insac_ld
							, SUM(v.insac_md) AS dpt_insac_md
							, SUM(v.insac_hd) AS dpt_insac_hd
							, SUM(v.invin_ld) AS dpt_invin_ld
							, SUM(v.invin_md) AS dpt_invin_md
							, SUM(v.invin_hd) AS dpt_invin_hd
							, SUM(v.invga_ld) AS dpt_invga_ld
							, SUM(v.invga_md) AS dpt_invga_md
							, SUM(v.invga_hd) AS dpt_invga_hd
							, (
										SUM(v.sgprepaid) + SUM(v.sgota) +
										SUM(v.sgvin) +
										SUM(v.sgvgs) + SUM(v.sgvgg) + SUM(v.sgvgp) +
										SUM(v.insac_ld) + SUM(v.insac_md) + SUM(v.insac_hd) +
										SUM(v.invin_ld) + SUM(v.invin_md) + SUM(v.invin_hd) +
										SUM(v.invga_ld) + SUM(v.invga_md) + SUM(v.invga_hd)
								) AS total_dpt
					FROM
							(SELECT @id_cluster:="'.$id_divisi.'") x_id_cluster,
							(SELECT @w0_tgl_mulai:="'.$this->w0_tgl_mulai.'") x_w0_tgl_mulai,
							(SELECT @w0_tgl_selesai:="'.$this->w0_tgl_selesai.'") x_w0_tgl_selesai,
							v_rekomdist_dpt v
				) xx
			');
		}

    $result = $this->db->get()->row_array();

    return $result;
	}

	function get_data_rd()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->penjualan_tanggal(date('Y-m-d'));

		$this->db->select('1');
		$this->db->from('ka_rekomendasi');
		$this->db->where('id_cluster', $id_divisi);
		$this->db->where('tahun', $this->tahun_penjualan);
		$this->db->where('bulan', $this->bulan_penjualan);
		$this->db->where('minggu', $this->minggu_penjualan);

		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$this->db->select('0 AS show_button, r.*');
			$this->db->from('ka_rekomendasi r');
			$this->db->where('r.id_cluster', $id_divisi);
			$this->db->where('r.tahun', $this->tahun_penjualan);
			$this->db->where('r.bulan', $this->bulan_penjualan);
			$this->db->where('r.minggu', $this->minggu_penjualan);
		}
		else
		{
			$this->db->select('1 AS show_button, r.*');
			$this->db->from('ka_rekomendasi r');
			$this->db->where('r.id_cluster', $id_divisi);
			$this->db->where('r.tahun', $this->tahun_penjualan);
			$this->db->where('r.bulan', $this->bulan_penjualan);
			$this->db->where('r.minggu', $this->minggu_penjualan);
		}

		$result = $this->db->get()->row_array();

    return $result;
	}

	function save_data_entry_rekomendasi()
  {
    $this->db->trans_begin();
    try {

			$this->insert_entry_rekomendasi();
			$this->db->trans_complete();

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
    else {
    $this->db->trans_commit();

    return TRUE;
  }
  }

	function insert_entry_rekomendasi()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->penjualan_tanggal(date('Y-m-d'));

		$data_x = array (
			'id_cluster' => $id_divisi,
			'tahun' => $this->tahun_penjualan,
			'bulan' => $this->bulan_penjualan,
			'minggu' => $this->minggu_penjualan,

			'ss_sgprepaid' => $this->input->post('ss_sgprepaid') ? $this->input->post('ss_sgprepaid') : 0,
			'ss_sgota' => $this->input->post('ss_sgota') ? $this->input->post('ss_sgota') : 0,
			'ss_sgvin' => $this->input->post('ss_sgvin') ? $this->input->post('ss_sgvin') : 0,
			'ss_sgvgs' => $this->input->post('ss_sgvgs') ? $this->input->post('ss_sgvgs') : 0,
			'ss_sgvgg' => $this->input->post('ss_sgvgg') ? $this->input->post('ss_sgvgg') : 0,
			'ss_sgvgp' => $this->input->post('ss_sgvgp') ? $this->input->post('ss_sgvgp') : 0,
			'ss_insac_ld' => $this->input->post('ss_insac_ld') ? $this->input->post('ss_insac_ld') : 0,
			'ss_insac_md' => $this->input->post('ss_insac_md') ? $this->input->post('ss_insac_md') : 0,
			'ss_insac_hd' => $this->input->post('ss_insac_hd') ? $this->input->post('ss_insac_hd') : 0,
			'ss_invin_ld' => $this->input->post('ss_invin_ld') ? $this->input->post('ss_invin_ld') : 0,
			'ss_invin_md' => $this->input->post('ss_invin_md') ? $this->input->post('ss_invin_md') : 0,
			'ss_invin_hd' => $this->input->post('ss_invin_hd') ? $this->input->post('ss_invin_hd') : 0,
			'ss_invga_ld' => $this->input->post('ss_invga_ld') ? $this->input->post('ss_invga_ld') : 0,
			'ss_invga_md' => $this->input->post('ss_invga_md') ? $this->input->post('ss_invga_md') : 0,
			'ss_invga_hd' => $this->input->post('ss_invga_hd') ? $this->input->post('ss_invga_hd') : 0,
			'total_ss' => $this->input->post('total_ss') ? $this->input->post('total_ss') : 0,

			'dpt_sgprepaid' => $this->input->post('dpt_sgprepaid') ? $this->input->post('dpt_sgprepaid') : 0,
			'dpt_sgota' => $this->input->post('dpt_sgota') ? $this->input->post('dpt_sgota') : 0,
			'dpt_sgvin' => $this->input->post('dpt_sgvin') ? $this->input->post('dpt_sgvin') : 0,
			'dpt_sgvgs' => $this->input->post('dpt_sgvgs') ? $this->input->post('dpt_sgvgs') : 0,
			'dpt_sgvgg' => $this->input->post('dpt_sgvgg') ? $this->input->post('dpt_sgvgg') : 0,
			'dpt_sgvgp' => $this->input->post('dpt_sgvgp') ? $this->input->post('dpt_sgvgp') : 0,
			'dpt_insac_ld' => $this->input->post('dpt_insac_ld') ? $this->input->post('dpt_insac_ld') : 0,
			'dpt_insac_md' => $this->input->post('dpt_insac_md') ? $this->input->post('dpt_insac_md') : 0,
			'dpt_insac_hd' => $this->input->post('dpt_insac_hd') ? $this->input->post('dpt_insac_hd') : 0,
			'dpt_invin_ld' => $this->input->post('dpt_invin_ld') ? $this->input->post('dpt_invin_ld') : 0,
			'dpt_invin_md' => $this->input->post('dpt_invin_md') ? $this->input->post('dpt_invin_md') : 0,
			'dpt_invin_hd' => $this->input->post('dpt_invin_hd') ? $this->input->post('dpt_invin_hd') : 0,
			'dpt_invga_ld' => $this->input->post('dpt_invga_ld') ? $this->input->post('dpt_invga_ld') : 0,
			'dpt_invga_md' => $this->input->post('dpt_invga_md') ? $this->input->post('dpt_invga_md') : 0,
			'dpt_invga_hd' => $this->input->post('dpt_invga_hd') ? $this->input->post('dpt_invga_hd') : 0,
			'total_dpt' => $this->input->post('total_dpt') ? $this->input->post('total_dpt') : 0,

			'td_sgprepaid' => $this->input->post('td_sgprepaid') ? $this->input->post('td_sgprepaid') : 0,
			'td_sgota' => $this->input->post('td_sgota') ? $this->input->post('td_sgota') : 0,
			'td_sgvin' => $this->input->post('td_sgvin') ? $this->input->post('td_sgvin') : 0,
			'td_sgvgs' => $this->input->post('td_sgvgs') ? $this->input->post('td_sgvgs') : 0,
			'td_sgvgg' => $this->input->post('td_sgvgg') ? $this->input->post('td_sgvgg') : 0,
			'td_sgvgp' => $this->input->post('td_sgvgp') ? $this->input->post('td_sgvgp') : 0,
			'td_insac_ld' => $this->input->post('td_insac_ld') ? $this->input->post('td_insac_ld') : 0,
			'td_insac_md' => $this->input->post('td_insac_md') ? $this->input->post('td_insac_md') : 0,
			'td_insac_hd' => $this->input->post('td_insac_hd') ? $this->input->post('td_insac_hd') : 0,
			'td_invin_ld' => $this->input->post('td_invin_ld') ? $this->input->post('td_invin_ld') : 0,
			'td_invin_md' => $this->input->post('td_invin_md') ? $this->input->post('td_invin_md') : 0,
			'td_invin_hd' => $this->input->post('td_invin_hd') ? $this->input->post('td_invin_hd') : 0,
			'td_invga_ld' => $this->input->post('td_invga_ld') ? $this->input->post('td_invga_ld') : 0,
			'td_invga_md' => $this->input->post('td_invga_md') ? $this->input->post('td_invga_md') : 0,
			'td_invga_hd' => $this->input->post('td_invga_hd') ? $this->input->post('td_invga_hd') : 0,
			'total_td' => $this->input->post('total_td') ? $this->input->post('total_td') : 0,

			'ds_sek_sgprepaid' => $this->input->post('ds_sek_sgprepaid') ? $this->input->post('ds_sek_sgprepaid') : 0,
			'ds_sek_sgota' => $this->input->post('ds_sek_sgota') ? $this->input->post('ds_sek_sgota') : 0,
			'ds_sek_sgvin' => $this->input->post('ds_sek_sgvin') ? $this->input->post('ds_sek_sgvin') : 0,
			'ds_sek_sgvgs' => $this->input->post('ds_sek_sgvgs') ? $this->input->post('ds_sek_sgvgs') : 0,
			'ds_sek_sgvgg' => $this->input->post('ds_sek_sgvgg') ? $this->input->post('ds_sek_sgvgg') : 0,
			'ds_sek_sgvgp' => $this->input->post('ds_sek_sgvgp') ? $this->input->post('ds_sek_sgvgp') : 0,
			'ds_sek_insac_ld' => $this->input->post('ds_sek_insac_ld') ? $this->input->post('ds_sek_insac_ld') : 0,
			'ds_sek_insac_md' => $this->input->post('ds_sek_insac_md') ? $this->input->post('ds_sek_insac_md') : 0,
			'ds_sek_insac_hd' => $this->input->post('ds_sek_insac_hd') ? $this->input->post('ds_sek_insac_hd') : 0,
			'ds_sek_invin_ld' => $this->input->post('ds_sek_invin_ld') ? $this->input->post('ds_sek_invin_ld') : 0,
			'ds_sek_invin_md' => $this->input->post('ds_sek_invin_md') ? $this->input->post('ds_sek_invin_md') : 0,
			'ds_sek_invin_hd' => $this->input->post('ds_sek_invin_hd') ? $this->input->post('ds_sek_invin_hd') : 0,
			'ds_sek_invga_ld' => $this->input->post('ds_sek_invga_ld') ? $this->input->post('ds_sek_invga_ld') : 0,
			'ds_sek_invga_md' => $this->input->post('ds_sek_invga_md') ? $this->input->post('ds_sek_invga_md') : 0,
			'ds_sek_invga_hd' => $this->input->post('ds_sek_invga_hd') ? $this->input->post('ds_sek_invga_hd') : 0,
			'total_ds_sek' => $this->input->post('total_ds_sek') ? $this->input->post('total_ds_sek') : 0,

			'ds_kam_sgprepaid' => $this->input->post('ds_kam_sgprepaid') ? $this->input->post('ds_kam_sgprepaid') : 0,
			'ds_kam_sgota' => $this->input->post('ds_kam_sgota') ? $this->input->post('ds_kam_sgota') : 0,
			'ds_kam_sgvin' => $this->input->post('ds_kam_sgvin') ? $this->input->post('ds_kam_sgvin') : 0,
			'ds_kam_sgvgs' => $this->input->post('ds_kam_sgvgs') ? $this->input->post('ds_kam_sgvgs') : 0,
			'ds_kam_sgvgg' => $this->input->post('ds_kam_sgvgg') ? $this->input->post('ds_kam_sgvgg') : 0,
			'ds_kam_sgvgp' => $this->input->post('ds_kam_sgvgp') ? $this->input->post('ds_kam_sgvgp') : 0,
			'ds_kam_insac_ld' => $this->input->post('ds_kam_insac_ld') ? $this->input->post('ds_kam_insac_ld') : 0,
			'ds_kam_insac_md' => $this->input->post('ds_kam_insac_md') ? $this->input->post('ds_kam_insac_md') : 0,
			'ds_kam_insac_hd' => $this->input->post('ds_kam_insac_hd') ? $this->input->post('ds_kam_insac_hd') : 0,
			'ds_kam_invin_ld' => $this->input->post('ds_kam_invin_ld') ? $this->input->post('ds_kam_invin_ld') : 0,
			'ds_kam_invin_md' => $this->input->post('ds_kam_invin_md') ? $this->input->post('ds_kam_invin_md') : 0,
			'ds_kam_invin_hd' => $this->input->post('ds_kam_invin_hd') ? $this->input->post('ds_kam_invin_hd') : 0,
			'ds_kam_invga_ld' => $this->input->post('ds_kam_invga_ld') ? $this->input->post('ds_kam_invga_ld') : 0,
			'ds_kam_invga_md' => $this->input->post('ds_kam_invga_md') ? $this->input->post('ds_kam_invga_md') : 0,
			'ds_kam_invga_hd' => $this->input->post('ds_kam_invga_hd') ? $this->input->post('ds_kam_invga_hd') : 0,
			'total_ds_kam' => $this->input->post('total_ds_kam') ? $this->input->post('total_ds_kam') : 0,

			'ds_fak_sgprepaid' => $this->input->post('ds_fak_sgprepaid') ? $this->input->post('ds_fak_sgprepaid') : 0,
			'ds_fak_sgota' => $this->input->post('ds_fak_sgota') ? $this->input->post('ds_fak_sgota') : 0,
			'ds_fak_sgvin' => $this->input->post('ds_fak_sgvin') ? $this->input->post('ds_fak_sgvin') : 0,
			'ds_fak_sgvgs' => $this->input->post('ds_fak_sgvgs') ? $this->input->post('ds_fak_sgvgs') : 0,
			'ds_fak_sgvgg' => $this->input->post('ds_fak_sgvgg') ? $this->input->post('ds_fak_sgvgg') : 0,
			'ds_fak_sgvgp' => $this->input->post('ds_fak_sgvgp') ? $this->input->post('ds_fak_sgvgp') : 0,
			'ds_fak_insac_ld' => $this->input->post('ds_fak_insac_ld') ? $this->input->post('ds_fak_insac_ld') : 0,
			'ds_fak_insac_md' => $this->input->post('ds_fak_insac_md') ? $this->input->post('ds_fak_insac_md') : 0,
			'ds_fak_insac_hd' => $this->input->post('ds_fak_insac_hd') ? $this->input->post('ds_fak_insac_hd') : 0,
			'ds_fak_invin_ld' => $this->input->post('ds_fak_invin_ld') ? $this->input->post('ds_fak_invin_ld') : 0,
			'ds_fak_invin_md' => $this->input->post('ds_fak_invin_md') ? $this->input->post('ds_fak_invin_md') : 0,
			'ds_fak_invin_hd' => $this->input->post('ds_fak_invin_hd') ? $this->input->post('ds_fak_invin_hd') : 0,
			'ds_fak_invga_ld' => $this->input->post('ds_fak_invga_ld') ? $this->input->post('ds_fak_invga_ld') : 0,
			'ds_fak_invga_md' => $this->input->post('ds_fak_invga_md') ? $this->input->post('ds_fak_invga_md') : 0,
			'ds_fak_invga_hd' => $this->input->post('ds_fak_invga_hd') ? $this->input->post('ds_fak_invga_hd') : 0,
			'total_ds_fak' => $this->input->post('total_ds_fak') ? $this->input->post('total_ds_fak') : 0,

			'tds_sgprepaid' => $this->input->post('tds_sgprepaid') ? $this->input->post('tds_sgprepaid') : 0,
			'tds_sgota' => $this->input->post('tds_sgota') ? $this->input->post('tds_sgota') : 0,
			'tds_sgvin' => $this->input->post('tds_sgvin') ? $this->input->post('tds_sgvin') : 0,
			'tds_sgvgs' => $this->input->post('tds_sgvgs') ? $this->input->post('tds_sgvgs') : 0,
			'tds_sgvgg' => $this->input->post('tds_sgvgg') ? $this->input->post('tds_sgvgg') : 0,
			'tds_sgvgp' => $this->input->post('tds_sgvgp') ? $this->input->post('tds_sgvgp') : 0,
			'tds_insac_ld' => $this->input->post('tds_insac_ld') ? $this->input->post('tds_insac_ld') : 0,
			'tds_insac_md' => $this->input->post('tds_insac_md') ? $this->input->post('tds_insac_md') : 0,
			'tds_insac_hd' => $this->input->post('tds_insac_hd') ? $this->input->post('tds_insac_hd') : 0,
			'tds_invin_ld' => $this->input->post('tds_invin_ld') ? $this->input->post('tds_invin_ld') : 0,
			'tds_invin_md' => $this->input->post('tds_invin_md') ? $this->input->post('tds_invin_md') : 0,
			'tds_invin_hd' => $this->input->post('tds_invin_hd') ? $this->input->post('tds_invin_hd') : 0,
			'tds_invga_ld' => $this->input->post('tds_invga_ld') ? $this->input->post('tds_invga_ld') : 0,
			'tds_invga_md' => $this->input->post('tds_invga_md') ? $this->input->post('tds_invga_md') : 0,
			'tds_invga_hd' => $this->input->post('tds_invga_hd') ? $this->input->post('tds_invga_hd') : 0,
			'total_tds' => $this->input->post('total_tds') ? $this->input->post('total_tds') : 0,

			'sf_out_sgprepaid' => $this->input->post('sf_out_sgprepaid') ? prepare_integer($this->input->post('sf_out_sgprepaid')) : 0,
			'sf_out_sgota' => $this->input->post('sf_out_sgota') ? prepare_integer($this->input->post('sf_out_sgota')) : 0,
			'sf_out_sgvin' => $this->input->post('sf_out_sgvin') ? prepare_integer($this->input->post('sf_out_sgvin')) : 0,
			'sf_out_sgvgs' => $this->input->post('sf_out_sgvgs') ? prepare_integer($this->input->post('sf_out_sgvgs')) : 0,
			'sf_out_sgvgg' => $this->input->post('sf_out_sgvgg') ? prepare_integer($this->input->post('sf_out_sgvgg')) : 0,
			'sf_out_sgvgp' => $this->input->post('sf_out_sgvgp') ? prepare_integer($this->input->post('sf_out_sgvgp')) : 0,
			'sf_out_insac_ld' => $this->input->post('sf_out_insac_ld') ? prepare_integer($this->input->post('sf_out_insac_ld')) : 0,
			'sf_out_insac_md' => $this->input->post('sf_out_insac_md') ? prepare_integer($this->input->post('sf_out_insac_md')) : 0,
			'sf_out_insac_hd' => $this->input->post('sf_out_insac_hd') ? prepare_integer($this->input->post('sf_out_insac_hd')) : 0,
			'sf_out_invin_ld' => $this->input->post('sf_out_invin_ld') ? prepare_integer($this->input->post('sf_out_invin_ld')) : 0,
			'sf_out_invin_md' => $this->input->post('sf_out_invin_md') ? prepare_integer($this->input->post('sf_out_invin_md')) : 0,
			'sf_out_invin_hd' => $this->input->post('sf_out_invin_hd') ? prepare_integer($this->input->post('sf_out_invin_hd')) : 0,
			'sf_out_invga_ld' => $this->input->post('sf_out_invga_ld') ? prepare_integer($this->input->post('sf_out_invga_ld')) : 0,
			'sf_out_invga_md' => $this->input->post('sf_out_invga_md') ? prepare_integer($this->input->post('sf_out_invga_md')) : 0,
			'sf_out_invga_hd' => $this->input->post('sf_out_invga_hd') ? prepare_integer($this->input->post('sf_out_invga_hd')) : 0,
			'total_sf_out' => $this->input->post('total_sf_out') ? prepare_integer($this->input->post('total_sf_out')) : 0,

			'tis_sgprepaid' => $this->input->post('tis_sgprepaid') ? $this->input->post('tis_sgprepaid') : 0,
			'tis_sgota' => $this->input->post('tis_sgota') ? $this->input->post('tis_sgota') : 0,
			'tis_sgvin' => $this->input->post('tis_sgvin') ? $this->input->post('tis_sgvin') : 0,
			'tis_sgvgs' => $this->input->post('tis_sgvgs') ? $this->input->post('tis_sgvgs') : 0,
			'tis_sgvgg' => $this->input->post('tis_sgvgg') ? $this->input->post('tis_sgvgg') : 0,
			'tis_sgvgp' => $this->input->post('tis_sgvgp') ? $this->input->post('tis_sgvgp') : 0,
			'tis_insac_ld' => $this->input->post('tis_insac_ld') ? $this->input->post('tis_insac_ld') : 0,
			'tis_insac_md' => $this->input->post('tis_insac_md') ? $this->input->post('tis_insac_md') : 0,
			'tis_insac_hd' => $this->input->post('tis_insac_hd') ? $this->input->post('tis_insac_hd') : 0,
			'tis_invin_ld' => $this->input->post('tis_invin_ld') ? $this->input->post('tis_invin_ld') : 0,
			'tis_invin_md' => $this->input->post('tis_invin_md') ? $this->input->post('tis_invin_md') : 0,
			'tis_invin_hd' => $this->input->post('tis_invin_hd') ? $this->input->post('tis_invin_hd') : 0,
			'tis_invga_ld' => $this->input->post('tis_invga_ld') ? $this->input->post('tis_invga_ld') : 0,
			'tis_invga_md' => $this->input->post('tis_invga_md') ? $this->input->post('tis_invga_md') : 0,
			'tis_invga_hd' => $this->input->post('tis_invga_hd') ? $this->input->post('tis_invga_hd') : 0,
			'total_tis' => $this->input->post('total_tis') ? $this->input->post('total_tis') : 0
		);

		$this->db->insert('ka_rekomendasi', $data_x);
		$this->check_trans_status('insert ka_rekomendasi failed');
	}

	function get_total_data()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->penjualan_tanggal(date('Y-m-d'));

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
					SUM(r.target_edit_sgprepaid) AS total_sgprepaid
					, SUM(r.target_edit_sgota) AS total_sgota
					, SUM(r.target_edit_sgvin) AS total_sgvin
					, SUM(r.target_edit_sgvgs) AS total_sgvgs
					, SUM(r.target_edit_sgvgg) AS total_sgvgg
					, SUM(r.target_edit_sgvgp) AS total_sgvgp
					, SUM(r.target_edit_insac_ld) AS total_insac_ld
					, SUM(r.target_edit_insac_md) AS total_insac_md
					, SUM(r.target_edit_insac_hd) AS total_insac_hd
					, SUM(r.target_edit_invin_ld) AS total_invin_ld
					, SUM(r.target_edit_invin_md) AS total_invin_md
					, SUM(r.target_edit_invin_hd) AS total_invin_hd
					, SUM(r.target_edit_invga_ld) AS total_invga_ld
					, SUM(r.target_edit_invga_md) AS total_invga_md
					, SUM(r.target_edit_invga_hd) AS total_invga_hd
			FROM
					kb_rekomendasi_outlet r
					INNER JOIN eb_outlet o
							ON (r.id_outlet = o.id_outlet)
					INNER JOIN bd_tap t
							ON (o.id_tap = t.id_tap)
			WHERE (t.id_cluster = "'.$id_divisi.'"
					AND r.tahun = "'.$this->tahun_penjualan.'"
					AND r.bulan = "'.$this->bulan_penjualan.'"
					AND r.minggu = "'.$this->minggu_penjualan.'")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_outlet()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->penjualan_tanggal(date('Y-m-d'));

		$this->db->select('
			xx.id_rekomendasi
			, xx.id_lokasi
			, xx.kode_lokasi
			, xx.nama_lokasi
			, xx.target_edit_sgprepaid
			, xx.target_edit_sgota
			, xx.target_edit_sgvin
			, xx.target_edit_sgvgs
			, xx.target_edit_sgvgg
			, xx.target_edit_sgvgp
			, xx.target_edit_insac_ld
			, xx.target_edit_insac_md
			, xx.target_edit_insac_hd
			, xx.target_edit_invin_ld
			, xx.target_edit_invin_md
			, xx.target_edit_invin_hd
			, xx.target_edit_invga_ld
			, xx.target_edit_invga_md
			, xx.target_edit_invga_hd
			, xx.is_simpan
		');
		$this->db->from('
			(
				SELECT
						r.id_rekomendasi
						, r.id_outlet AS id_lokasi
						, l.id_digipos AS kode_lokasi
						, l.nama_outlet AS nama_lokasi
						, r.target_edit_sgprepaid
						, r.target_edit_sgota
						, r.target_edit_sgvin
						, r.target_edit_sgvgs
						, r.target_edit_sgvgg
						, r.target_edit_sgvgp
						, r.target_edit_insac_ld
						, r.target_edit_insac_md
						, r.target_edit_insac_hd
						, r.target_edit_invin_ld
						, r.target_edit_invin_md
						, r.target_edit_invin_hd
						, r.target_edit_invga_ld
						, r.target_edit_invga_md
						, r.target_edit_invga_hd
						, r.is_simpan
				FROM
						kb_rekomendasi_outlet r
						INNER JOIN eb_outlet l
								ON (r.id_outlet = l.id_outlet)
						INNER JOIN bd_tap t
								ON (l.id_tap = t.id_tap)
				WHERE (t.id_cluster = "'.$id_divisi.'"
						AND r.tahun = "'.$this->tahun_penjualan.'"
						AND r.bulan = "'.$this->bulan_penjualan.'"
						AND r.minggu = "'.$this->minggu_penjualan.'")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	var $fieldmap_daftar = array('id_digipos', 'nama_outlet');
	var $column_order = array(null, 'id_digipos', 'nama_outlet');
	var $column_search = array('id_digipos', 'nama_outlet');

	function build_query_daftar()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->penjualan_tanggal(date('Y-m-d'));

		$this->db->select('
			r.*
			, o.id_digipos
			, o.nama_outlet
		');
		$this->db->from('kb_rekomendasi_outlet r');
		$this->db->join('eb_outlet o', 'r.id_outlet = o.id_outlet');
		$this->db->join('bd_tap t', 'o.id_tap = t.id_tap');
		$this->db->where('t.id_cluster', $id_divisi);
		$this->db->where('r.tahun', $this->tahun_penjualan);
		$this->db->where('r.bulan', $this->bulan_penjualan);
		$this->db->where('r.minggu', $this->minggu_penjualan);
	}

	function get_total_rekomendasi()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->penjualan_tanggal(date('Y-m-d'));

		$this->db->select('
				r.* 
		');
		$this->db->from('ka_rekomendasi r');
		//$this->db->join('eb_outlet o', 'r.id_outlet = o.id_outlet');
		//$this->db->join('bd_tap t', 'o.id_tap = t.id_tap');
		$this->db->where('r.id_cluster', $id_divisi);
		$this->db->where('r.tahun', $this->tahun_penjualan);
		$this->db->where('r.bulan', $this->bulan_penjualan);
		$this->db->where('r.minggu', $this->minggu_penjualan);

		$result = $this->db->get();
    		return $result;
	}
	
	// ------------------------------------------------------------------------------------------------------
	
	function x_get_data_ss($id_cluster, $tahun, $bulan, $minggu)
	{
		$this->db->select('1');
		$this->db->from('ka_rekomendasi');
		$this->db->where('id_cluster', $id_cluster);
		$this->db->where('tahun', $tahun);
		$this->db->where('bulan', $bulan);
		$this->db->where('minggu', $minggu);

		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$this->db->select('*');
			$this->db->from('ka_rekomendasi');
			$this->db->where('id_cluster', $id_cluster);
			$this->db->where('tahun', $tahun);
			$this->db->where('bulan', $bulan);
			$this->db->where('minggu', $minggu);
		}
		else
		{
			
			$this->db->select('MIN(tanggal) AS tgl_mulai, MAX(tanggal) AS tgl_selesai');
			$this->db->from('ja_penjualan_tanggal');
			$this->db->where('tahun', $tahun);
			$this->db->where('bulan', $bulan);
			$this->db->where('minggu', $minggu);
			$rs_a = $this->db->get()->row_array();

			$tgl_mulai = isset($rs_a['tgl_mulai']) ? $rs_a['tgl_mulai'] : 0;
			$tgl_selesai = isset($rs_a['tgl_selesai']) ? $rs_a['tgl_selesai'] : 0;
			
			
			$this->db->select('
				xx.ss_sgprepaid
				, xx.ss_sgota
				, xx.ss_sgvin
				, xx.ss_sgvgs
				, xx.ss_sgvgg
				, xx.ss_sgvgp
				, xx.ss_insac_ld
				, xx.ss_insac_md
				, xx.ss_insac_hd
				, xx.ss_invin_ld
				, xx.ss_invin_md
				, xx.ss_invin_hd
				, xx.ss_invga_ld
				, xx.ss_invga_md
				, xx.ss_invga_hd
				, xx.total_ss
			');
			$this->db->from('
				(
					SELECT
							SUM(v.sgprepaid) AS ss_sgprepaid
							, SUM(v.sgota) AS ss_sgota
							, SUM(v.sgvin) AS ss_sgvin
							, SUM(v.sgvgs) AS ss_sgvgs
							, SUM(v.sgvgg) AS ss_sgvgg
							, SUM(v.sgvgp) AS ss_sgvgp
							, SUM(v.insac_ld) AS ss_insac_ld
							, SUM(v.insac_md) AS ss_insac_md
							, SUM(v.insac_hd) AS ss_insac_hd
							, SUM(v.invin_ld) AS ss_invin_ld
							, SUM(v.invin_md) AS ss_invin_md
							, SUM(v.invin_hd) AS ss_invin_hd
							, SUM(v.invga_ld) AS ss_invga_ld
							, SUM(v.invga_md) AS ss_invga_md
							, SUM(v.invga_hd) AS ss_invga_hd
							, (
										SUM(v.sgprepaid) + SUM(v.sgota) +
										SUM(v.sgvin) +
										SUM(v.sgvgs) + SUM(v.sgvgg) + SUM(v.sgvgp) +
										SUM(v.insac_ld) + SUM(v.insac_md) + SUM(v.insac_hd) +
										SUM(v.invin_ld) + SUM(v.invin_md) + SUM(v.invin_hd) +
										SUM(v.invga_ld) + SUM(v.invga_md) + SUM(v.invga_hd)
								) AS total_ss
					FROM
							(SELECT @id_cluster:="'.$id_cluster.'") x_id_cluster,
							(SELECT @w0_tgl_mulai:="'.$tgl_mulai.'") x_w0_tgl_mulai,
							(SELECT @w0_tgl_selesai:="'.$tgl_selesai.'") x_w0_tgl_selesai,
							v_rekomdist_ss v
				) xx
			');
		}

		$result = $this->db->get()->row_array();

    return $result;
	}

	function x_get_data_dpt($id_cluster, $tahun, $bulan, $minggu)
	{
		$this->db->select('1');
		$this->db->from('ka_rekomendasi');
		$this->db->where('id_cluster', $id_cluster);
		$this->db->where('tahun', $tahun);
		$this->db->where('bulan', $bulan);
		$this->db->where('minggu', $minggu);

		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$this->db->select('*');
			$this->db->from('ka_rekomendasi');
			$this->db->where('id_cluster', $id_divisi);
			$this->db->where('tahun', $tahun);
			$this->db->where('bulan', $bulan);
			$this->db->where('minggu', $minggu);
		}
		else
		{
			
			$this->db->select('MIN(tanggal) AS tgl_mulai, MAX(tanggal) AS tgl_selesai');
			$this->db->from('ja_penjualan_tanggal');
			$this->db->where('tahun', $tahun);
			$this->db->where('bulan', $bulan);
			$this->db->where('minggu', $minggu);
			$rs_a = $this->db->get()->row_array();

			$tgl_mulai = isset($rs_a['tgl_mulai']) ? $rs_a['tgl_mulai'] : 0;
			$tgl_selesai = isset($rs_a['tgl_selesai']) ? $rs_a['tgl_selesai'] : 0;
			
			$this->db->select('
				xx.dpt_sgprepaid
				, xx.dpt_sgota
				, xx.dpt_sgvin
				, xx.dpt_sgvgs
				, xx.dpt_sgvgg
				, xx.dpt_sgvgp
				, xx.dpt_insac_ld
				, xx.dpt_insac_md
				, xx.dpt_insac_hd
				, xx.dpt_invin_ld
				, xx.dpt_invin_md
				, xx.dpt_invin_hd
				, xx.dpt_invga_ld
				, xx.dpt_invga_md
				, xx.dpt_invga_hd
				, xx.total_dpt
			');
			$this->db->from('
				(
					SELECT
							SUM(v.sgprepaid) AS dpt_sgprepaid
							, SUM(v.sgota) AS dpt_sgota
							, SUM(v.sgvin) AS dpt_sgvin
							, SUM(v.sgvgs) AS dpt_sgvgs
							, SUM(v.sgvgg) AS dpt_sgvgg
							, SUM(v.sgvgp) AS dpt_sgvgp
							, SUM(v.insac_ld) AS dpt_insac_ld
							, SUM(v.insac_md) AS dpt_insac_md
							, SUM(v.insac_hd) AS dpt_insac_hd
							, SUM(v.invin_ld) AS dpt_invin_ld
							, SUM(v.invin_md) AS dpt_invin_md
							, SUM(v.invin_hd) AS dpt_invin_hd
							, SUM(v.invga_ld) AS dpt_invga_ld
							, SUM(v.invga_md) AS dpt_invga_md
							, SUM(v.invga_hd) AS dpt_invga_hd
							, (
										SUM(v.sgprepaid) + SUM(v.sgota) +
										SUM(v.sgvin) +
										SUM(v.sgvgs) + SUM(v.sgvgg) + SUM(v.sgvgp) +
										SUM(v.insac_ld) + SUM(v.insac_md) + SUM(v.insac_hd) +
										SUM(v.invin_ld) + SUM(v.invin_md) + SUM(v.invin_hd) +
										SUM(v.invga_ld) + SUM(v.invga_md) + SUM(v.invga_hd)
								) AS total_dpt
					FROM
							(SELECT @id_cluster:="'.$id_cluster.'") x_id_cluster,
							(SELECT @w0_tgl_mulai:="'.$tgl_mulai.'") x_w0_tgl_mulai,
							(SELECT @w0_tgl_selesai:="'.$tgl_selesai.'") x_w0_tgl_selesai,
							v_rekomdist_dpt v
				) xx
			');
		}

    $result = $this->db->get()->row_array();

    return $result;
	}
}
?>