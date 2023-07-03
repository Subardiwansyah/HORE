<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten_model extends CI_model {

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

	function save_data_kabupaten()
  {
    $this->db->trans_begin();
    try {
			$this->select_penjualan_tanggal();
			$this->insert_data_outlet();
			$this->insert_data_sekolah();
			$this->insert_data_kampus();
			$this->insert_data_fakultas();
			$this->insert_data_poi();
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
			tahun
			, bulan
			, minggu
			, tgl_mulai
			, tgl_selesai
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
					FROM
							ja_penjualan_tanggal p
					WHERE (p.tanggal = "'.$tanggal_sekarang.'")
			) xx
		');
		$rs = $this->db->get()->row_array();

		$this->tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$this->bulan = isset($rs['bulan']) ? $rs['bulan'] : 0;
		$this->minggu = isset($rs['minggu']) ? $rs['minggu'] : 0;
		$this->tgl_mulai = isset($rs['tgl_mulai']) ? $rs['tgl_mulai'] : 0;
		$this->tgl_selesai = isset($rs['tgl_selesai']) ? $rs['tgl_selesai'] : 0;
	}

	function insert_data_outlet()
  {
		$id_jenis_lokasi = 'OUT';

		$this->db->select('*');
		$this->db->from('cb_kabupaten');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_kabupaten = $rs_a[$a]['id_kabupaten'] ? $rs_a[$a]['id_kabupaten'] : 0;

				$this->db->select('id_jenis_weekly');
				$this->db->from('nb_promotion_jenis_weekly');
				$this->db->where('tahun', $this->tahun);
				$this->db->where('bulan', $this->bulan);
				$this->db->where('minggu', $this->minggu);
				$rs_b = $this->db->get()->result_array();

				for ($b=0; $b<count($rs_b); $b++)
				{
					$id_jenis_weekly = $rs_b[$b]['id_jenis_weekly'] ? $rs_b[$b]['id_jenis_weekly'] : 0;

					$this->db->select('xx.total');
					$this->db->from('
						(
							SELECT
									COUNT(p.id_promotion) AS total
							FROM
									nc_promotion_outlet p
									INNER JOIN eb_outlet o
											ON (p.id_outlet = o.id_outlet)
									INNER JOIN cd_kelurahan kl
											ON (o.id_kelurahan = kl.id_kelurahan)
									INNER JOIN cc_kecamatan kc
											ON (kl.id_kecamatan = kc.id_kecamatan)
							WHERE (kc.id_kabupaten = "'.$id_kabupaten.'"
									AND p.tgl BETWEEN "'.$this->tgl_mulai.'" AND "'.$this->tgl_selesai.'"
									AND p.id_jenis_weekly = "'.$id_jenis_weekly.'")
						) xx
					');
					$rs_c = $this->db->get()->row_array();

					$total = isset($rs_c['total']) ? $rs_c['total'] : 0;

					$this->db->select('xx.total_pjp');
					$this->db->from('
						(
							SELECT
									COUNT(d.id_daftar_pjp) AS total_pjp
							FROM
									fe_daftar_pjp d
									INNER JOIN eb_outlet o
											ON (d.id_tempat = o.id_outlet)
									INNER JOIN cd_kelurahan kl
											ON (o.id_kelurahan = kl.id_kelurahan)
									INNER JOIN cc_kecamatan kc
											ON (kl.id_kecamatan = kc.id_kecamatan)
							WHERE (kc.id_kabupaten = "'.$id_kabupaten.'"
									AND d.tanggal BETWEEN "'.$this->tgl_mulai.'" AND "'.$this->tgl_selesai.'"
									AND d.id_jenis_lokasi = "'.$id_jenis_lokasi.'")
						) xx
					');
					$rs_d = $this->db->get()->row_array();

					$total_pjp = isset($rs_d['total_pjp']) ? $rs_d['total_pjp'] : 0;

					$this->db->select('1');
					$this->db->from('nl_promotion_res_kabupaten');
					$this->db->where('id_kabupaten', $id_kabupaten);
					$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
					$this->db->where('id_jenis_weekly', $id_jenis_weekly);

					$rs_e = $this->db->get()->row_array();

					if ($rs_e)
					{
						$data_x = array(
							'id_kabupaten' => $id_kabupaten,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_weekly' => $id_jenis_weekly,
							'total' => $total,
							'total_pjp' => $total_pjp
						);

						$this->db->where('id_kabupaten', $id_kabupaten);
						$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
						$this->db->where('id_jenis_weekly', $id_jenis_weekly);
						$this->db->update('nl_promotion_res_kabupaten', $data_x);
						$this->check_trans_status('update nl_promotion_res_kabupaten failed');
					}
					else
					{
						$data_x = array(
							'id_kabupaten' => $id_kabupaten,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_weekly' => $id_jenis_weekly,
							'total' => $total,
							'total_pjp' => $total_pjp
						);

						$this->db->insert('nl_promotion_res_kabupaten', $data_x);
						$this->check_trans_status('insert nl_promotion_res_kabupaten failed');
					}
				}
			}
		}
	}

	function insert_data_sekolah()
  {
		$id_jenis_lokasi = 'SEK';

		$this->db->select('*');
		$this->db->from('cb_kabupaten');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_kabupaten = $rs_a[$a]['id_kabupaten'] ? $rs_a[$a]['id_kabupaten'] : 0;

				$this->db->select('id_jenis_weekly');
				$this->db->from('nb_promotion_jenis_weekly');
				$this->db->where('tahun', $this->tahun);
				$this->db->where('bulan', $this->bulan);
				$this->db->where('minggu', $this->minggu);
				$rs_b = $this->db->get()->result_array();

				for ($b=0; $b<count($rs_b); $b++)
				{
					$id_jenis_weekly = $rs_b[$b]['id_jenis_weekly'] ? $rs_b[$b]['id_jenis_weekly'] : 0;

					$this->db->select('xx.total');
					$this->db->from('
						(
							SELECT
									COUNT(p.id_promotion) AS total
							FROM
									nd_promotion_sekolah p
									INNER JOIN ec_sekolah o
											ON (p.id_sekolah = o.id_sekolah)
									INNER JOIN cd_kelurahan kl
											ON (o.id_kelurahan = kl.id_kelurahan)
									INNER JOIN cc_kecamatan kc
											ON (kl.id_kecamatan = kc.id_kecamatan)
							WHERE (kc.id_kabupaten = "'.$id_kabupaten.'"
									AND p.tgl BETWEEN "'.$this->tgl_mulai.'" AND "'.$this->tgl_selesai.'"
									AND p.id_jenis_weekly = "'.$id_jenis_weekly.'")
						) xx
					');
					$rs_c = $this->db->get()->row_array();

					$total = isset($rs_c['total']) ? $rs_c['total'] : 0;

					$this->db->select('xx.total_pjp');
					$this->db->from('
						(
							SELECT
									COUNT(d.id_daftar_pjp) AS total_pjp
							FROM
									fe_daftar_pjp d
									INNER JOIN ec_sekolah o
											ON (d.id_tempat = o.id_sekolah)
									INNER JOIN cd_kelurahan kl
											ON (o.id_kelurahan = kl.id_kelurahan)
									INNER JOIN cc_kecamatan kc
											ON (kl.id_kecamatan = kc.id_kecamatan)
							WHERE (kc.id_kabupaten = "'.$id_kabupaten.'"
									AND d.tanggal BETWEEN "'.$this->tgl_mulai.'" AND "'.$this->tgl_selesai.'"
									AND d.id_jenis_lokasi = "'.$id_jenis_lokasi.'")
						) xx
					');
					$rs_d = $this->db->get()->row_array();

					$total_pjp = isset($rs_d['total_pjp']) ? $rs_d['total_pjp'] : 0;

					$this->db->select('1');
					$this->db->from('nl_promotion_res_kabupaten');
					$this->db->where('id_kabupaten', $id_kabupaten);
					$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
					$this->db->where('id_jenis_weekly', $id_jenis_weekly);

					$rs_e = $this->db->get()->row_array();

					if ($rs_e)
					{
						$data_x = array(
							'id_kabupaten' => $id_kabupaten,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_weekly' => $id_jenis_weekly,
							'total' => $total,
							'total_pjp' => $total_pjp
						);

						$this->db->where('id_kabupaten', $id_kabupaten);
						$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
						$this->db->where('id_jenis_weekly', $id_jenis_weekly);
						$this->db->update('nl_promotion_res_kabupaten', $data_x);
						$this->check_trans_status('update nl_promotion_res_kabupaten failed');
					}
					else
					{
						$data_x = array(
							'id_kabupaten' => $id_kabupaten,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_weekly' => $id_jenis_weekly,
							'total' => $total,
							'total_pjp' => $total_pjp
						);

						$this->db->insert('nl_promotion_res_kabupaten', $data_x);
						$this->check_trans_status('insert nl_promotion_res_kabupaten failed');
					}
				}
			}
		}
	}

	function insert_data_kampus()
  {
		$id_jenis_lokasi = 'KAM';

		$this->db->select('*');
		$this->db->from('cb_kabupaten');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_kabupaten = $rs_a[$a]['id_kabupaten'] ? $rs_a[$a]['id_kabupaten'] : 0;

				$this->db->select('id_jenis_weekly');
				$this->db->from('nb_promotion_jenis_weekly');
				$this->db->where('tahun', $this->tahun);
				$this->db->where('bulan', $this->bulan);
				$this->db->where('minggu', $this->minggu);
				$rs_b = $this->db->get()->result_array();

				for ($b=0; $b<count($rs_b); $b++)
				{
					$id_jenis_weekly = $rs_b[$b]['id_jenis_weekly'] ? $rs_b[$b]['id_jenis_weekly'] : 0;

					$this->db->select('xx.total');
					$this->db->from('
						(
							SELECT
									COUNT(p.id_promotion) AS total
							FROM
									ne_promotion_kampus p
									INNER JOIN ed_kampus o
											ON (p.id_universitas = o.id_universitas)
									INNER JOIN cd_kelurahan kl
											ON (o.id_kelurahan = kl.id_kelurahan)
									INNER JOIN cc_kecamatan kc
											ON (kl.id_kecamatan = kc.id_kecamatan)
							WHERE (kc.id_kabupaten = "'.$id_kabupaten.'"
									AND p.tgl BETWEEN "'.$this->tgl_mulai.'" AND "'.$this->tgl_selesai.'"
									AND p.id_jenis_weekly = "'.$id_jenis_weekly.'")
						) xx
					');
					$rs_c = $this->db->get()->row_array();

					$total = isset($rs_c['total']) ? $rs_c['total'] : 0;

					$this->db->select('xx.total_pjp');
					$this->db->from('
						(
							SELECT
									COUNT(d.id_daftar_pjp) AS total_pjp
							FROM
									fe_daftar_pjp d
									INNER JOIN ed_kampus o
											ON (d.id_tempat = o.id_universitas)
									INNER JOIN cd_kelurahan kl
											ON (o.id_kelurahan = kl.id_kelurahan)
									INNER JOIN cc_kecamatan kc
											ON (kl.id_kecamatan = kc.id_kecamatan)
							WHERE (kc.id_kabupaten = "'.$id_kabupaten.'"
									AND d.tanggal BETWEEN "'.$this->tgl_mulai.'" AND "'.$this->tgl_selesai.'"
									AND d.id_jenis_lokasi = "'.$id_jenis_lokasi.'")
						) xx
					');
					$rs_d = $this->db->get()->row_array();

					$total_pjp = isset($rs_d['total_pjp']) ? $rs_d['total_pjp'] : 0;

					$this->db->select('1');
					$this->db->from('nl_promotion_res_kabupaten');
					$this->db->where('id_kabupaten', $id_kabupaten);
					$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
					$this->db->where('id_jenis_weekly', $id_jenis_weekly);

					$rs_e = $this->db->get()->row_array();

					if ($rs_e)
					{
						$data_x = array(
							'id_kabupaten' => $id_kabupaten,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_weekly' => $id_jenis_weekly,
							'total' => $total,
							'total_pjp' => $total_pjp
						);

						$this->db->where('id_kabupaten', $id_kabupaten);
						$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
						$this->db->where('id_jenis_weekly', $id_jenis_weekly);
						$this->db->update('nl_promotion_res_kabupaten', $data_x);
						$this->check_trans_status('update nl_promotion_res_kabupaten failed');
					}
					else
					{
						$data_x = array(
							'id_kabupaten' => $id_kabupaten,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_weekly' => $id_jenis_weekly,
							'total' => $total,
							'total_pjp' => $total_pjp
						);

						$this->db->insert('nl_promotion_res_kabupaten', $data_x);
						$this->check_trans_status('insert nl_promotion_res_kabupaten failed');
					}
				}
			}
		}
	}

	function insert_data_fakultas()
  {
		$id_jenis_lokasi = 'FAK';

		$this->db->select('*');
		$this->db->from('cb_kabupaten');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_kabupaten = $rs_a[$a]['id_kabupaten'] ? $rs_a[$a]['id_kabupaten'] : 0;

				$this->db->select('id_jenis_weekly');
				$this->db->from('nb_promotion_jenis_weekly');
				$this->db->where('tahun', $this->tahun);
				$this->db->where('bulan', $this->bulan);
				$this->db->where('minggu', $this->minggu);
				$rs_b = $this->db->get()->result_array();

				for ($b=0; $b<count($rs_b); $b++)
				{
					$id_jenis_weekly = $rs_b[$b]['id_jenis_weekly'] ? $rs_b[$b]['id_jenis_weekly'] : 0;

					$this->db->select('xx.total');
					$this->db->from('
						(
							SELECT
									COUNT(p.id_promotion) AS total
							FROM
									nf_promotion_fakultas p
									INNER JOIN ee_fakultas o
											ON (p.id_fakultas = o.id_fakultas)
									INNER JOIN cd_kelurahan kl
											ON (o.id_kelurahan = kl.id_kelurahan)
									INNER JOIN cc_kecamatan kc
											ON (kl.id_kecamatan = kc.id_kecamatan)
							WHERE (kc.id_kabupaten = "'.$id_kabupaten.'"
									AND p.tgl BETWEEN "'.$this->tgl_mulai.'" AND "'.$this->tgl_selesai.'"
									AND p.id_jenis_weekly = "'.$id_jenis_weekly.'")
						) xx
					');
					$rs_c = $this->db->get()->row_array();

					$total = isset($rs_c['total']) ? $rs_c['total'] : 0;

					$this->db->select('xx.total_pjp');
					$this->db->from('
						(
							SELECT
									COUNT(d.id_daftar_pjp) AS total_pjp
							FROM
									fe_daftar_pjp d
									INNER JOIN ee_fakultas o
											ON (d.id_tempat = o.id_fakultas)
									INNER JOIN cd_kelurahan kl
											ON (o.id_kelurahan = kl.id_kelurahan)
									INNER JOIN cc_kecamatan kc
											ON (kl.id_kecamatan = kc.id_kecamatan)
							WHERE (kc.id_kabupaten = "'.$id_kabupaten.'"
									AND d.tanggal BETWEEN "'.$this->tgl_mulai.'" AND "'.$this->tgl_selesai.'"
									AND d.id_jenis_lokasi = "'.$id_jenis_lokasi.'")
						) xx
					');
					$rs_d = $this->db->get()->row_array();

					$total_pjp = isset($rs_d['total_pjp']) ? $rs_d['total_pjp'] : 0;

					$this->db->select('1');
					$this->db->from('nl_promotion_res_kabupaten');
					$this->db->where('id_kabupaten', $id_kabupaten);
					$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
					$this->db->where('id_jenis_weekly', $id_jenis_weekly);

					$rs_e = $this->db->get()->row_array();

					if ($rs_e)
					{
						$data_x = array(
							'id_kabupaten' => $id_kabupaten,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_weekly' => $id_jenis_weekly,
							'total' => $total,
							'total_pjp' => $total_pjp
						);

						$this->db->where('id_kabupaten', $id_kabupaten);
						$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
						$this->db->where('id_jenis_weekly', $id_jenis_weekly);
						$this->db->update('nl_promotion_res_kabupaten', $data_x);
						$this->check_trans_status('update nl_promotion_res_kabupaten failed');
					}
					else
					{
						$data_x = array(
							'id_kabupaten' => $id_kabupaten,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_weekly' => $id_jenis_weekly,
							'total' => $total,
							'total_pjp' => $total_pjp
						);

						$this->db->insert('nl_promotion_res_kabupaten', $data_x);
						$this->check_trans_status('insert nl_promotion_res_kabupaten failed');
					}
				}
			}
		}
	}

	function insert_data_poi()
  {
		$id_jenis_lokasi = 'POI';

		$this->db->select('*');
		$this->db->from('cb_kabupaten');
		$rs_a = $this->db->get()->result_array();

		if (!empty($rs_a))
		{
			for ($a=0; $a<count($rs_a); $a++)
			{
				$id_kabupaten = $rs_a[$a]['id_kabupaten'] ? $rs_a[$a]['id_kabupaten'] : 0;

				$this->db->select('id_jenis_weekly');
				$this->db->from('nb_promotion_jenis_weekly');
				$this->db->where('tahun', $this->tahun);
				$this->db->where('bulan', $this->bulan);
				$this->db->where('minggu', $this->minggu);
				$rs_b = $this->db->get()->result_array();

				for ($b=0; $b<count($rs_b); $b++)
				{
					$id_jenis_weekly = $rs_b[$b]['id_jenis_weekly'] ? $rs_b[$b]['id_jenis_weekly'] : 0;

					$this->db->select('xx.total');
					$this->db->from('
						(
							SELECT
									COUNT(p.id_promotion) AS total
							FROM
									nf_promotion_poi p
									INNER JOIN ef_poi o
											ON (p.id_poi = o.id_poi)
									INNER JOIN cd_kelurahan kl
											ON (o.id_kelurahan = kl.id_kelurahan)
									INNER JOIN cc_kecamatan kc
											ON (kl.id_kecamatan = kc.id_kecamatan)
							WHERE (kc.id_kabupaten = "'.$id_kabupaten.'"
									AND p.tgl BETWEEN "'.$this->tgl_mulai.'" AND "'.$this->tgl_selesai.'"
									AND p.id_jenis_weekly = "'.$id_jenis_weekly.'")
						) xx
					');
					$rs_c = $this->db->get()->row_array();

					$total = isset($rs_c['total']) ? $rs_c['total'] : 0;

					$this->db->select('xx.total_pjp');
					$this->db->from('
						(
							SELECT
									COUNT(d.id_daftar_pjp) AS total_pjp
							FROM
									fe_daftar_pjp d
									INNER JOIN ef_poi o
											ON (d.id_tempat = o.id_poi)
									INNER JOIN cd_kelurahan kl
											ON (o.id_kelurahan = kl.id_kelurahan)
									INNER JOIN cc_kecamatan kc
											ON (kl.id_kecamatan = kc.id_kecamatan)
							WHERE (kc.id_kabupaten = "'.$id_kabupaten.'"
									AND d.tanggal BETWEEN "'.$this->tgl_mulai.'" AND "'.$this->tgl_selesai.'"
									AND d.id_jenis_lokasi = "'.$id_jenis_lokasi.'")
						) xx
					');
					$rs_d = $this->db->get()->row_array();

					$total_pjp = isset($rs_d['total_pjp']) ? $rs_d['total_pjp'] : 0;

					$this->db->select('1');
					$this->db->from('nl_promotion_res_kabupaten');
					$this->db->where('id_kabupaten', $id_kabupaten);
					$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
					$this->db->where('id_jenis_weekly', $id_jenis_weekly);

					$rs_e = $this->db->get()->row_array();

					if ($rs_e)
					{
						$data_x = array(
							'id_kabupaten' => $id_kabupaten,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_weekly' => $id_jenis_weekly,
							'total' => $total,
							'total_pjp' => $total_pjp
						);

						$this->db->where('id_kabupaten', $id_kabupaten);
						$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
						$this->db->where('id_jenis_weekly', $id_jenis_weekly);
						$this->db->update('nl_promotion_res_kabupaten', $data_x);
						$this->check_trans_status('update nl_promotion_res_kabupaten failed');
					}
					else
					{
						$data_x = array(
							'id_kabupaten' => $id_kabupaten,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'id_jenis_weekly' => $id_jenis_weekly,
							'total' => $total,
							'total_pjp' => $total_pjp
						);

						$this->db->insert('nl_promotion_res_kabupaten', $data_x);
						$this->check_trans_status('insert nl_promotion_res_kabupaten failed');
					}
				}
			}
		}
	}
}
?>