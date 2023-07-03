<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pjp_setting_model extends Base_Model {

	var $fieldmap_daftar = array();
	var $column_order = array();
	var $column_search = array();

	function __construct()
	{
		parent::__construct();
	}

	function build_query_daftar()
	{
		//
	}

	function build_query_form($id=NULL)
	{
		//
	}

	function get_list_tgl()
  {
		$this->db->select('p.tahun, p.bulan, p.minggu');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tanggal', date('Y-m-d'));
		$rs = $this->db->get()->row_array();

		$tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$bulan = isset($rs['bulan']) ? $rs['bulan'] : 0;
		$minggu = isset($rs['minggu']) ? $rs['minggu'] : 0;

		$this->db->select('p.tanggal');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tahun', $tahun);
		$this->db->where('p.bulan', $bulan);
		$this->db->where('p.minggu', $minggu);
		$this->db->limit(6);

		$query = $this->db->get();

		return $query->result();
	}

	function get_max_no_kunjungan($id_sales, $hari)
	{
		$this->db->select('IF(MAX(p.no_kunjungan) IS NULL, 1, MAX(p.no_kunjungan)+1) AS no_kunjungan');
		$this->db->from('fa_pjp p');
		$this->db->where('p.id_sales', $id_sales);
		$this->db->where('UPPER(p.hari)', $hari);

		$result = $this->db->get()->row_array();

    return $result;
	}

	function insert_pjp()
	{
		$id_pjp = $this->input->post('id_pjp') ? $this->input->post('id_pjp') : NULL;

		$this->db->select('1');
		$this->db->from('fa_pjp');
		$this->db->where('id_pjp', $id_pjp);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$data_x = array(
				'id_tempat' => $this->input->post('id_lokasi') ? $this->input->post('id_lokasi') : NULL,
				'id_jenis_lokasi' => $this->input->post('id_jenis_lokasi') ? $this->input->post('id_jenis_lokasi') : NULL
			);

			$this->db->where('id_pjp', $id_pjp);
			$this->db->update('fa_pjp', $data_x);
			$this->check_trans_status('update fa_pjp failed');
		}
		else
		{
			$data_x = array(
				'id_sales' => $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL,
				'id_tempat' => $this->input->post('id_lokasi') ? $this->input->post('id_lokasi') : NULL,
				'id_jenis_lokasi' => $this->input->post('id_jenis_lokasi') ? $this->input->post('id_jenis_lokasi') : NULL,
				'hari' => $this->input->post('hari') ? $this->input->post('hari') : NULL,
				'no_kunjungan' => $this->input->post('no_kunjungan') ? $this->input->post('no_kunjungan') : NULL
			);

			$this->db->insert('fa_pjp', $data_x);
			$this->check_trans_status('insert fa_pjp failed');
		}
	}

	function insert_daftar_pjp()
	{
		$tanggal_sekarang = date ('Y-m-d');
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$id_lokasi = $this->input->post('id_lokasi') ? $this->input->post('id_lokasi') : NULL;
		$id_jenis_lokasi = $this->input->post('id_jenis_lokasi') ? $this->input->post('id_jenis_lokasi') : NULL;
		$hari = $this->input->post('hari') ? $this->input->post('hari') : NULL;
		$tanggal = $this->input->post('tanggal') ? $this->input->post('tanggal') : NULL;
		$no_kunjungan = $this->input->post('no_kunjungan') ? $this->input->post('no_kunjungan') : NULL;

		if ($id_jenis_lokasi == 'OUT')
		{
			$this->db->select('longitude, latitude');
			$this->db->from('eb_outlet');
			$this->db->where('id_outlet', $id_lokasi);
		}
		else if ($id_jenis_lokasi == 'SEK')
		{
			$this->db->select('longitude, latitude');
			$this->db->from('ec_sekolah');
			$this->db->where('id_sekolah', $id_lokasi);
		}
		else if ($id_jenis_lokasi == 'KAM')
		{
			$this->db->select('longitude, latitude');
			$this->db->from('ed_kampus');
			$this->db->where('id_universitas', $id_lokasi);
		}
		else if ($id_jenis_lokasi == 'FAK')
		{
			$this->db->select('longitude, latitude');
			$this->db->from('ee_fakultas');
			$this->db->where('id_fakultas', $id_lokasi);
		}
		else if ($id_jenis_lokasi == 'POI')
		{
			$this->db->select('longitude, latitude');
			$this->db->from('ef_poi');
			$this->db->where('id_poi', $id_lokasi);
		}

		$rs = $this->db->get()->row_array();

		$longitude = $rs['longitude'] ? $rs['longitude'] : 0;
		$latitude = $rs['latitude'] ? $rs['latitude'] : 0;

		$this->db->select('1');
		$this->db->from('fe_daftar_pjp');
		$this->db->where('id_sales', $id_sales);
		$this->db->where('id_tempat', $id_lokasi);
		$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
		$this->db->where('tanggal', $tanggal);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$data_x = array(
				'longitude' => $longitude,
				'latitude' => $latitude
			);

			$this->db->where('id_sales', $id_sales);
			$this->db->where('id_tempat', $id_lokasi);
			$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
			$this->db->where('tanggal', $tanggal);
			$this->db->update('fe_daftar_pjp', $data_x);
			$this->check_trans_status('update fe_daftar_pjp failed');
		}
		else
		{
			$data_x = array(
				'id_sales' => $id_sales,
				'id_tempat' => $id_lokasi,
				'id_jenis_lokasi' => $id_jenis_lokasi,
				'no_kunjungan' => $no_kunjungan,
				'hari' => $hari,
				'tanggal' => $tanggal,
				'longitude' => $longitude,
				'latitude' => $latitude
			);

			$this->db->insert('fe_daftar_pjp', $data_x);
			$this->check_trans_status('insert fe_daftar_pjp failed');
		}
	}

	function save_detail()
	{
		$this->insert_pjp();
		$this->insert_daftar_pjp();
	}

	function cek_exist()
	{
		$id = $this->input->post('id_pjp') ? $this->input->post('id_pjp') : NULL;

		if($id != NULL)
		{
			$this->db->select('COUNT(id_pjp) AS data_exists');
			$this->db->from('fa_pjp');
			$this->db->where('id_pjp', $id);
			$result = $this->db->get()->row_array();

			if($result && $result['data_exists'] > 0)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return TRUE;
		}
	}

	function check_duplikasi()
	{
		return TRUE;
	}

	function check_dependency($id)
	{
		return TRUE;
	}

	function get_list_pjp()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$hari = $this->input->post('hari') ? $this->input->post('hari') : NULL;
		$tgl_hari = $this->input->post('tgl_hari') ? $this->input->post('tgl_hari') : 0;

		$this->db->select('
			xx.id_sales
			, xx.id_tempat
			, xx.nama_tempat
			, xx.id_jenis_lokasi
			, xx.nama_jenis_lokasi
			, xx.id_pjp
			, xx.hari
			, xx.no_kunjungan
			, IF(xx.is_delete > 0, 1, 0) AS is_delete
			, IF(xx.is_reset > 0, 1, 0) AS is_reset
			, xx.max_no
			, xx.kode
		');
		$this->db->from('
			(
				SELECT
						p.id_sales
						, p.id_tempat
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = p.id_tempat))
									WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = p.id_tempat))
									ELSE NULL
							END AS nama_tempat
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.id_digipos FROM eb_outlet a WHERE (a.id_outlet = p.id_tempat))
									WHEN "SEK" THEN (SELECT a.no_npsn FROM ec_sekolah a WHERE (a.id_sekolah = p.id_tempat))
									WHEN "KAM" THEN (SELECT a.no_npsn FROM ed_kampus a WHERE (a.id_universitas = p.id_tempat))
									WHEN "FAK" THEN "-"
									WHEN "POI" THEN "-"
									ELSE NULL
							END AS kode
						, p.id_jenis_lokasi
						, j.nama_jenis_lokasi
						, p.id_pjp
						, p.hari
						, p.no_kunjungan
						, (
									SELECT
											COUNT(h.id_history_pjp)
									FROM
											fb_histroy_pjp h
									WHERE (h.id_sales = p.id_sales
											AND h.id_tempat = p.id_tempat
											AND h.id_jenis_lokasi = p.id_jenis_lokasi
											AND h.tanggal = "'.$tgl_hari.'")
							) AS is_delete
						, (
									SELECT
											COUNT(h.id_history_pjp)
									FROM
											fb_histroy_pjp h
									WHERE (h.id_sales = p.id_sales
											AND h.id_tempat = p.id_tempat
											AND h.id_jenis_lokasi = p.id_jenis_lokasi
											AND h.tanggal = "'.$tgl_hari.'"
											AND (h.clockin_distribusi = "FINISH"
													OR h.clockin_merchandising = "FINISH"
													OR h.clockin_promotion = "FINISH"
													OR h.clockin_marketaudit = "FINISH")
											AND h.status = "OPEN")
							)	AS is_reset
						, (
									SELECT
											MAX(xp.no_kunjungan)
									FROM
											fa_pjp xp
									WHERE (xp.id_sales = p.id_sales
											AND UPPER(xp.hari) = p.hari)
							) AS max_no
				FROM
						fa_pjp p
						INNER JOIN ea_jenis_lokasi j
								ON (p.id_jenis_lokasi = j.id_jenis_lokasi)
				WHERE (p.id_sales = "'.$id_sales.'"
						AND UPPER(p.hari) = "'.$hari.'")
				ORDER BY p.no_kunjungan	ASC
			) xx

		');
		$this->db->order_by('xx.no_kunjungan', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function sync_nourut_b()
  {
    $this->db->trans_begin();
    try {

			$id_pjp = $this->input->post('id_pjp') ? $this->input->post('id_pjp') : NULL;
			$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
			$no_kunjungan = $this->input->post('no_kunjungan') ? $this->input->post('no_kunjungan') : 0;
			$hari = $this->input->post('hari') ? $this->input->post('hari') : NULL;
			$status = $this->input->post('status') ? $this->input->post('status') : NULL;

			$this->db->select('1');
			$this->db->from('fa_pjp');
			$this->db->where('id_pjp', $id_pjp);
			$rs = $this->db->get()->row_array();

			if ($rs)
			{
				if ($status == 'up')
				{
					$this->db->where('id_pjp', $id_pjp);
					$this->db->update('fa_pjp', array('no_kunjungan' => $no_kunjungan - 1));
					$this->check_trans_status('update fa_pjp failed');
				}
				else
				{
					$this->db->where('id_pjp', $id_pjp);
					$this->db->update('fa_pjp', array('no_kunjungan' => $no_kunjungan + 1));
					$this->check_trans_status('update fa_pjp failed');
				}
			}
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

	function sync_nourut_a()
  {
    $this->db->trans_begin();
    try {

			$id_pjp = $this->input->post('id_pjp') ? $this->input->post('id_pjp') : NULL;
			$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
			$no_kunjungan = $this->input->post('no_kunjungan') ? $this->input->post('no_kunjungan') : 0;
			$hari = $this->input->post('hari') ? $this->input->post('hari') : NULL;
			$status = $this->input->post('status') ? $this->input->post('status') : NULL;

			$this->db->select('1');
			$this->db->from('fa_pjp');
			$this->db->where('id_pjp', $id_pjp);
			$rs = $this->db->get()->row_array();

			if ($rs)
			{
				if ($status == 'up')
				{
					$this->db->select('*');
					$this->db->from('fa_pjp');
					$this->db->where('id_sales', $id_sales);
					$this->db->where('hari', $hari);
					$this->db->where('no_kunjungan >= ', $no_kunjungan - 1);
					$this->db->where('id_pjp <> ', $id_pjp);
					$this->db->order_by('no_kunjungan', 'asc');
					$rs = $this->db->get()->result_array();

					$no = 1;
					$start = $no_kunjungan - 1;
					for ($x = 0; $x < count($rs); $x++)
					{
						$this->db->where('id_pjp', $rs[$x]['id_pjp']);
						$this->db->update('fa_pjp', array('no_kunjungan' => $start + $no));
						$this->check_trans_status('update fa_pjp failed');

						$no++;
					}
				}
				else
				{
					$this->db->select('*');
					$this->db->from('fa_pjp');
					$this->db->where('id_sales', $id_sales);
					$this->db->where('hari', $hari);
					$this->db->where('no_kunjungan >= ', $no_kunjungan);
					$this->db->where('id_pjp <> ', $id_pjp);
					$this->db->order_by('no_kunjungan', 'asc');
					$this->db->limit(1);
					$rs = $this->db->get()->result_array();

					for ($x = 0; $x < count($rs); $x++)
					{
						$this->db->where('id_pjp', $rs[$x]['id_pjp']);
						$this->db->update('fa_pjp', array('no_kunjungan' => $rs[$x]['no_kunjungan'] - 1));
						$this->check_trans_status('update fa_pjp failed');
					}
				}
			}
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

	function delete_data_pjp()
  {
    $this->db->trans_begin();
    try {

			$this->delete_pjp();

    }
    catch(Exception $e){
      // TODO : log error to file
    }

    if ($this->db->trans_status() === FALSE)
    {
			$this->last_error_message = $this->db->error();
      $this->db->trans_rollback();
      return FALSE;
    }

    $this->db->trans_commit();
    return TRUE;
  }

	function delete_pjp()
	{
		$id_pjp = $this->input->post('id_pjp') ? $this->input->post('id_pjp') : NULL;

		$this->db->select('*');
		$this->db->from('fa_pjp');
		$this->db->where('id_pjp', $id_pjp);
		$this->db->order_by('no_kunjungan', 'asc');
		$rs = $this->db->get()->row_array();

		$id_sales = $rs['id_sales'] ? $rs['id_sales'] : 0;
		$hari = $rs['hari'] ? $rs['hari'] : NULL;

		$this->id_sales = $id_sales;
		$this->hari = $hari;

		$this->db->where('id_pjp', $id_pjp);
		$this->db->delete('fa_pjp');
		$this->check_trans_status('delete fa_pjp failed');

		$this->db->select('*');
		$this->db->from('fa_pjp');
		$this->db->where('id_sales', $id_sales);
		$this->db->where('hari', $hari);
		$this->db->order_by('no_kunjungan', 'asc');
		$rs = $this->db->get()->result_array();

		$no = 1;
		for ($x = 0; $x < count($rs); $x++)
		{
			$this->db->where('id_pjp', $rs[$x]['id_pjp']);
			$this->db->update('fa_pjp', array('no_kunjungan' => $no));
			$this->check_trans_status('update fa_pjp failed');

			$no++;
		}
	}

	function delete_data_historypjp()
  {
    $this->db->trans_begin();
    try {

			$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
			$id_tempat = $this->input->post('id_tempat') ? $this->input->post('id_tempat') : NULL;
			$id_jns_lokasi = $this->input->post('id_jns_lokasi') ? $this->input->post('id_jns_lokasi') : NULL;
			$tanggal = $this->input->post('tanggal') ? $this->input->post('tanggal') : NULL;

			$this->db->where('id_sales', $id_sales);
			$this->db->where('id_tempat', $id_tempat);
			$this->db->where('id_jenis_lokasi', $id_jns_lokasi);
			$this->db->where('tanggal', $tanggal);
			$this->db->delete('fb_histroy_pjp');
			$this->check_trans_status('delete fb_histroy_pjp failed');

    }
    catch(Exception $e){
      // TODO : log error to file
    }

    if ($this->db->trans_status() === FALSE)
    {
			$this->last_error_message = $this->db->error();
      $this->db->trans_rollback();
      return FALSE;
    }

    $this->db->trans_commit();
    return TRUE;
  }

	function sync_data_daftarpjp()
  {
    $this->db->trans_begin();
    try {

			$this->delete_daftarpjp();
			$this->insert_daftarpjp();

    }
    catch(Exception $e){
      // TODO : log error to file
    }

    if ($this->db->trans_status() === FALSE)
    {
			$this->last_error_message = $this->db->error();
      $this->db->trans_rollback();
      return FALSE;
    }

    $this->db->trans_commit();
    return TRUE;
  }

	function delete_daftarpjp()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$hari = $this->input->post('hari') ? $this->input->post('hari') : NULL;
		$tanggal = $this->input->post('tanggal') ? $this->input->post('tanggal') : NULL;

		$this->db->where('hari', $hari);
		$this->db->where('tanggal >= ', $tanggal);
		$this->db->where('id_sales', $id_sales);
		$this->db->delete('fe_daftar_pjp');
		$this->check_trans_status('delete fe_daftar_pjp failed');
	}

	function insert_daftarpjp()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$hari = $this->input->post('hari') ? $this->input->post('hari') : NULL;
		$tanggal = $this->input->post('tanggal') ? $this->input->post('tanggal') : NULL;

		$this->db->select('*');
		$this->db->from('fa_pjp');
		$this->db->where('id_sales', $id_sales);
		$this->db->where('hari', $hari);
		$rs = $this->db->get()->result_array();

		if (!empty($rs))
		{
			for ($x=0; $x<count($rs); $x++)
			{
				$id_jenis_lokasi = $rs[$x]['id_jenis_lokasi'] ? $rs[$x]['id_jenis_lokasi'] : 0;
				$id_tempat = $rs[$x]['id_tempat'] ? $rs[$x]['id_tempat'] : 0;

				if ($id_jenis_lokasi == 'OUT')
				{
					$this->db->select('longitude, latitude');
					$this->db->from('eb_outlet');
					$this->db->where('id_outlet', $id_tempat);
				}
				else if ($id_jenis_lokasi == 'SEK')
				{
					$this->db->select('longitude, latitude');
					$this->db->from('ec_sekolah');
					$this->db->where('id_sekolah', $id_tempat);
				}
				else if ($id_jenis_lokasi == 'SEK')
				{
					$this->db->select('longitude, latitude');
					$this->db->from('ed_kampus');
					$this->db->where('id_universitas', $id_tempat);
				}
				else if ($id_jenis_lokasi == 'SEK')
				{
					$this->db->select('longitude, latitude');
					$this->db->from('ee_fakultas');
					$this->db->where('id_fakultas', $id_tempat);
				}

				$rs_longlat = $this->db->get()->row_array();

				$longitude = $rs_longlat['longitude'] ? $rs_longlat['longitude'] : NULL;
				$latitude = $rs_longlat['latitude'] ? $rs_longlat['latitude'] : NULL;

				$data_x = array (
					'id_sales' => $rs[$x]['id_sales'],
					'id_tempat' => $rs[$x]['id_tempat'],
					'id_jenis_lokasi' => $rs[$x]['id_jenis_lokasi'],
					'no_kunjungan' => $rs[$x]['no_kunjungan'],
					'hari' => $rs[$x]['hari'],
					'tanggal' => $tanggal,
					'longitude' => $longitude,
					'latitude' => $latitude
				);

				$this->db->insert('fe_daftar_pjp', $data_x);
				$this->check_trans_status('insert fe_daftar_pjp failed');
			}
		}
	}
}
?>