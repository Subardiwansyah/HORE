<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sf_model extends CI_model {

	function __construct()
	{
		$this->jenis_lokasi = 'OUT';

		parent::__construct();
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
			$this->penjualan_tanggal();
			$this->insert_data_sales();
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

	function penjualan_tanggal()
  {
		$tgl = date ('Y-m-d');

		$this->w0_tahun = 0; $this->w0_bulan = 0; $this->w0_minggu = 0;
		$this->w1_tahun = 0; $this->w1_bulan = 0; $this->w1_minggu = 0;
		$this->w2_tahun = 0; $this->w2_bulan = 0; $this->w2_minggu = 0;
		$this->w3_tahun = 0; $this->w3_bulan = 0; $this->w3_minggu = 0;

		$this->w0_tgl_mulai = 0; $this->w0_tgl_selesai = 0;
		$this->w1_tgl_mulai = 0; $this->w1_tgl_selesai = 0;
		$this->w2_tgl_mulai = 0; $this->w2_tgl_selesai = 0;
		$this->w3_tgl_mulai = 0; $this->w3_tgl_selesai = 0;

		$this->db->select('p.tahun, p.bulan, p.minggu');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tanggal', $tgl);
		$rs_a = $this->db->get()->row_array();

		$tahun = isset($rs_a['tahun']) ? $rs_a['tahun'] : 0;
		$bulan = isset($rs_a['bulan']) ? (strlen((string) $rs_a['bulan']) == 1 ? '0'.$rs_a['bulan'] : $rs_a['bulan']) : 0;
		$minggu = isset($rs_a['minggu']) ? $rs_a['minggu'] : 0;

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

		$this->w0_tahun = isset($rs_b['tahun']) ? (int) $rs_b['tahun'] : 0;
		$this->w0_bulan = isset($rs_b['bulan']) ? (int) $rs_b['bulan'] : 0;
		$this->w0_minggu = isset($rs_b['minggu']) ? (int) $rs_b['minggu'] : 0;
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

	function insert_data_sales()
  {
		$this->db->select('id_sales');
		$this->db->from('db_sales');
		$this->db->where('id_jenis_sales', 'SSF');
		$this->db->where('status', 'AKTIF');

		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_sales = isset($rs_a[$a]['id_sales']) ? $rs_a[$a]['id_sales'] : 0;

				$this->db->select('xx.id_lokasi');
				$this->db->from('
					(
						SELECT
								id_tempat AS id_lokasi
						FROM
								fe_daftar_pjp
						WHERE (id_sales = "'.$id_sales.'"
								AND id_jenis_lokasi = "'.$this->jenis_lokasi.'"
								AND tanggal BETWEEN "'.$this->w0_tgl_mulai.'" AND "'.$this->w0_tgl_selesai.'")
						GROUP BY id_lokasi
					) xx
				');

				$rs_b = $this->db->get()->result_array();

				if (!empty($rs_b))
				{
					$total_sgprepaid = 0; $total_sgota = 0; $total_sgvin = 0;
					$total_sgvgs = 0; $total_sgvgg = 0; $total_sgvgp = 0;
					$total_insac_ld = 0; $total_insac_md = 0; $total_insac_hd = 0;
					$total_invin_ld = 0; $total_invin_md = 0; $total_invin_hd = 0;
					$total_invga_ld = 0; $total_invga_md = 0; $total_invga_hd = 0;

					for ($b=0; $b<count($rs_b); $b++) // LOOP DAFTAR PJP
					{
						$id_lokasi = isset($rs_b[$b]['id_lokasi']) ? $rs_b[$b]['id_lokasi'] : 0;

						$this->db->select('*');
						$this->db->from('kb_rekomendasi_outlet');
						$this->db->where('id_outlet', $id_lokasi);
						$this->db->where('tahun', $this->w0_tahun);
						$this->db->where('bulan', $this->w0_bulan);
						$this->db->where('minggu', $this->w0_minggu);

						$rs_c = $this->db->get()->row_array();

						$sgprepaid = isset($rs_c['target_edit_sgprepaid']) ? $rs_c['target_edit_sgprepaid'] : 0;
						$sgota = isset($rs_c['target_edit_sgota']) ? $rs_c['target_edit_sgota'] : 0;
						$sgvin = isset($rs_c['target_edit_sgvin']) ? $rs_c['target_edit_sgvin'] : 0;
						$sgvgs = isset($rs_c['target_edit_sgvgs']) ? $rs_c['target_edit_sgvgs'] : 0;
						$sgvgg = isset($rs_c['target_edit_sgvgg']) ? $rs_c['target_edit_sgvgg'] : 0;
						$sgvgp = isset($rs_c['target_edit_sgvgp']) ? $rs_c['target_edit_sgvgp'] : 0;
						$insac_ld = isset($rs_c['target_edit_insac_ld']) ? $rs_c['target_edit_insac_ld'] : 0;
						$insac_md = isset($rs_c['target_edit_insac_md']) ? $rs_c['target_edit_insac_md'] : 0;
						$insac_hd = isset($rs_c['target_edit_insac_hd']) ? $rs_c['target_edit_insac_hd'] : 0;
						$invin_ld = isset($rs_c['target_edit_invin_ld']) ? $rs_c['target_edit_invin_ld'] : 0;
						$invin_md = isset($rs_c['target_edit_invin_md']) ? $rs_c['target_edit_invin_md'] : 0;
						$invin_hd = isset($rs_c['target_edit_invin_hd']) ? $rs_c['target_edit_invin_hd'] : 0;
						$invga_ld = isset($rs_c['target_edit_invga_ld']) ? $rs_c['target_edit_invga_ld'] : 0;
						$invga_md = isset($rs_c['target_edit_invga_md']) ? $rs_c['target_edit_invga_md'] : 0;
						$invga_hd = isset($rs_c['target_edit_invga_hd']) ? $rs_c['target_edit_invga_hd'] : 0;

						$total_sgprepaid = $total_sgprepaid + $sgprepaid;
						$total_sgota = $total_sgota + $sgota;
						$total_sgvin = $total_sgvin + $sgvin;
						$total_sgvgs = $total_sgvgs + $sgvgs;
						$total_sgvgg = $total_sgvgg + $sgvgg;
						$total_sgvgp = $total_sgvgp + $sgvgp;
						$total_insac_ld = $total_insac_ld + $insac_ld;
						$total_insac_md = $total_insac_md + $insac_md;
						$total_insac_hd = $total_insac_hd + $insac_hd;
						$total_invin_ld = $total_invin_ld + $invin_ld;
						$total_invin_md = $total_invin_md + $invin_md;
						$total_invin_hd = $total_invin_hd + $invin_hd;
						$total_invga_ld = $total_invga_ld + $invga_ld;
						$total_invga_md = $total_invga_md + $invga_md;
						$total_invga_hd = $total_invga_hd + $invga_hd;

						$this->db->select('1');
						$this->db->from('kf_rekomendasi_sales');
						$this->db->where('id_sales', $id_sales);
						$this->db->where('id_lokasi', $id_lokasi);
						$this->db->where('id_jenis_lokasi', $this->jenis_lokasi);
						$this->db->where('tahun', $this->w0_tahun);
						$this->db->where('bulan', $this->w0_bulan);
						$this->db->where('minggu', $this->w0_minggu);

						$rs_d = $this->db->get()->row_array();

						if ($rs_d)
						{
							$data_x = array(
								'id_sales' => $id_sales,
								'id_lokasi' => $id_lokasi,
								'id_jenis_lokasi' => $this->jenis_lokasi,
								'tahun' => $this->w0_tahun,
								'bulan' => $this->w0_bulan,
								'minggu' => $this->w0_minggu,
								'sgprepaid' => $sgprepaid,
								'sgota' => $sgota,
								'sgvin' => $sgvin,
								'sgvgs' => $sgvgs,
								'sgvgg' => $sgvgg,
								'sgvgp' => $sgvgp,
								'insac_ld' => $insac_ld,
								'insac_md' => $insac_md,
								'insac_hd' => $insac_hd,
								'invin_ld' => $invin_ld,
								'invin_md' => $invin_md,
								'invin_hd' => $invin_hd,
								'invga_ld' => $invga_ld,
								'invga_md' => $invga_md,
								'invga_hd' => $invga_hd
							);

							$this->db->where('id_sales', $id_sales);
							$this->db->where('id_lokasi', $id_lokasi);
							$this->db->where('id_jenis_lokasi', $this->jenis_lokasi);
							$this->db->where('tahun', $this->w0_tahun);
							$this->db->where('bulan', $this->w0_bulan);
							$this->db->where('minggu', $this->w0_minggu);
							$this->db->update('kf_rekomendasi_sales', $data_x);
							$this->check_trans_status('update kf_rekomendasi_sales failed');
						}
						else
						{
							$data_x = array(
								'id_sales' => $id_sales,
								'id_lokasi' => $id_lokasi,
								'id_jenis_lokasi' => $this->jenis_lokasi,
								'tahun' => $this->w0_tahun,
								'bulan' => $this->w0_bulan,
								'minggu' => $this->w0_minggu,
								'sgprepaid' => $sgprepaid,
								'sgota' => $sgota,
								'sgvin' => $sgvin,
								'sgvgs' => $sgvgs,
								'sgvgg' => $sgvgg,
								'sgvgp' => $sgvgp,
								'insac_ld' => $insac_ld,
								'insac_md' => $insac_md,
								'insac_hd' => $insac_hd,
								'invin_ld' => $invin_ld,
								'invin_md' => $invin_md,
								'invin_hd' => $invin_hd,
								'invga_ld' => $invga_ld,
								'invga_md' => $invga_md,
								'invga_hd' => $invga_hd
							);

							$this->db->insert('kf_rekomendasi_sales', $data_x);
							$this->check_trans_status('insert kf_rekomendasi_sales failed');
						}
					}
				}

				$this->db->select('1');
				$this->db->from('kf_rekomendasi_sales');
				$this->db->where('id_sales', $id_sales);
				$this->db->where('id_lokasi IS NULL');
				$this->db->where('id_jenis_lokasi IS NULL');
				$this->db->where('tahun', $this->w0_tahun);
				$this->db->where('bulan', $this->w0_bulan);
				$this->db->where('minggu', $this->w0_minggu);

				$rs_e = $this->db->get()->row_array();

				if ($rs_e)
				{
					$data_x = array(
						'id_sales' => $id_sales,
						'id_lokasi' => NULL,
						'id_jenis_lokasi' => NULL,
						'tahun' => $this->w0_tahun,
						'bulan' => $this->w0_bulan,
						'minggu' => $this->w0_minggu,
						'sgprepaid' => $total_sgprepaid,
						'sgota' => $total_sgota,
						'sgvin' => $total_sgvin,
						'sgvgs' => $total_sgvgs,
						'sgvgg' => $total_sgvgg,
						'sgvgp' => $total_sgvgp,
						'insac_ld' => $total_insac_ld,
						'insac_md' => $total_insac_md,
						'insac_hd' => $total_insac_hd,
						'invin_ld' => $total_invin_ld,
						'invin_md' => $total_invin_md,
						'invin_hd' => $total_invin_hd,
						'invga_ld' => $total_invga_ld,
						'invga_md' => $total_invga_md,
						'invga_hd' => $total_invga_hd
					);

					$this->db->where('id_sales', $id_sales);
					$this->db->where('id_lokasi IS NULL');
					$this->db->where('id_jenis_lokasi IS NULL');
					$this->db->where('tahun', $this->w0_tahun);
					$this->db->where('bulan', $this->w0_bulan);
					$this->db->where('minggu', $this->w0_minggu);
					$this->db->update('kf_rekomendasi_sales', $data_x);
					$this->check_trans_status('update kf_rekomendasi_sales failed');
				}
				else
				{
					$data_x = array(
						'id_sales' => $id_sales,
						'id_lokasi' => NULL,
						'id_jenis_lokasi' => NULL,
						'tahun' => $this->w0_tahun,
						'bulan' => $this->w0_bulan,
						'minggu' => $this->w0_minggu,
						'sgprepaid' => $total_sgprepaid,
						'sgota' => $total_sgota,
						'sgvin' => $total_sgvin,
						'sgvgs' => $total_sgvgs,
						'sgvgg' => $total_sgvgg,
						'sgvgp' => $total_sgvgp,
						'insac_ld' => $total_insac_ld,
						'insac_md' => $total_insac_md,
						'insac_hd' => $total_insac_hd,
						'invin_ld' => $total_invin_ld,
						'invin_md' => $total_invin_md,
						'invin_hd' => $total_invin_hd,
						'invga_ld' => $total_invga_ld,
						'invga_md' => $total_invga_md,
						'invga_hd' => $total_invga_hd
					);

					$this->db->insert('kf_rekomendasi_sales', $data_x);
					$this->check_trans_status('insert kf_rekomendasi_sales failed');
				}
			}
		}
	}
}
?>