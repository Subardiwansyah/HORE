<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_setting_pjp_model extends CI_model {

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

	function save_data_settingpjp()
  {
    $this->db->trans_begin();
    try {

			$this->insert_data_settingpjp();
			
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

	function insert_data_settingpjp()
  {
		$tanggal_sekarang = date('Y-m-d');
		
		$this->db->select('tahun, bulan, minggu');
		$this->db->from('ja_penjualan_tanggal');
		$this->db->where('tanggal', $tanggal_sekarang);
		$rs = $this->db->get()->row_array();

		$tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$bulan = isset($rs['bulan']) ? (strlen((string) $rs['bulan']) == 1 ? '0'.$rs['bulan'] : $rs['bulan']) : 0;
		$minggu = isset($rs['minggu']) ? $rs['minggu'] : 0;
		
		$this->db->select('tahun, bulan, minggu');
		$this->db->from('ja_penjualan_tanggal');
		$this->db->where('CONCAT(tahun, (IF(LENGTH(bulan) = 1, CONCAT("0", bulan), bulan)), minggu) > ', $tahun.$bulan.$minggu);
		$this->db->order_by('tanggal_merge', 'asc');
		$this->db->limit(1);
		$rs = $this->db->get()->row_array();

		$tahun = isset($rs['tahun']) ? $rs['tahun'] : 0;
		$bulan = isset($rs['bulan']) ? (strlen((string) $rs['bulan']) == 1 ? '0'.$rs['bulan'] : $rs['bulan']) : 0;
		$minggu = isset($rs['minggu']) ? $rs['minggu'] : 0;
		
		$this->db->select('tanggal, hari');
		$this->db->from('ja_penjualan_tanggal');
		$this->db->where('tahun', $tahun);
		$this->db->where('bulan', $bulan);
		$this->db->where('minggu', $minggu);
		$this->db->where('hari <> ', 'minggu');
		$rs = $this->db->get()->result_array();

		if (!empty($rs))
		{
			for ($i=0; $i<count($rs); $i++)
			{
				$hari = $rs[$i]['hari'] ? $rs[$i]['hari'] : NULL;
				$tanggal = $rs[$i]['tanggal'] ? $rs[$i]['tanggal'] : NULL;
				
				$this->db->select('*');
				$this->db->from('fa_pjp');
				$this->db->where('hari', $hari);
				$rspjp = $this->db->get()->result_array();

				for ($p=0; $p<count($rspjp); $p++)
				{
					$id_sales = $rspjp[$p]['id_sales'] ? $rspjp[$p]['id_sales'] : NULL;
					$id_tempat = $rspjp[$p]['id_tempat'] ? $rspjp[$p]['id_tempat'] : NULL;
					$id_jenis_lokasi = $rspjp[$p]['id_jenis_lokasi'] ? $rspjp[$p]['id_jenis_lokasi'] : NULL;
					$no_kunjungan = $rspjp[$p]['no_kunjungan'] ? $rspjp[$p]['no_kunjungan'] : NULL;
					
					$longitude = NULL;
					$latitude = NULL;

					if ($id_jenis_lokasi == 'OUT')
					{
						$this->db->select('longitude, latitude');
						$this->db->from('eb_outlet');
						$this->db->where('id_outlet', $id_tempat);

						$rslonglat = $this->db->get()->row_array();

						$longitude = isset($rslonglat['longitude']) ? $rslonglat['longitude'] : NULL;
						$latitude = isset($rslonglat['latitude']) ? $rslonglat['latitude'] : NULL;
					}
					else if ($id_jenis_lokasi == 'SEK')
					{
						$this->db->select('longitude, latitude');
						$this->db->from('ec_sekolah');
						$this->db->where('id_sekolah', $id_tempat);

						$rslonglat = $this->db->get()->row_array();

						$longitude = isset($rslonglat['longitude']) ? $rslonglat['longitude'] : NULL;
						$latitude = isset($rslonglat['latitude']) ? $rslonglat['latitude'] : NULL;
					}
					else if ($id_jenis_lokasi == 'SEK')
					{
						$this->db->select('longitude, latitude');
						$this->db->from('ed_kampus');
						$this->db->where('id_universitas', $id_tempat);

						$rslonglat = $this->db->get()->row_array();

						$longitude = isset($rslonglat['longitude']) ? $rslonglat['longitude'] : NULL;
						$latitude = isset($rslonglat['latitude']) ? $rslonglat['latitude'] : NULL;
					}
					else if ($id_jenis_lokasi == 'SEK')
					{
						$this->db->select('longitude, latitude');
						$this->db->from('ee_fakultas');
						$this->db->where('id_fakultas', $id_tempat);

						$rslonglat = $this->db->get()->row_array();

						$longitude = isset($rslonglat['longitude']) ? $rslonglat['longitude'] : NULL;
						$latitude = isset($rslonglat['latitude']) ? $rslonglat['latitude'] : NULL;
					}
					
					$this->db->select('1');
					$this->db->from('fe_daftar_pjp');
					$this->db->where('id_sales', $id_sales);
					$this->db->where('id_tempat', $id_tempat);
					$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
					$this->db->where('tanggal', $tanggal);
					$rscek = $this->db->get()->row_array();

					if ($rscek)
					{
						$data_x = array(
							'id_sales' => $id_sales,
							'id_tempat' => $id_tempat,
							'id_jenis_lokasi' => $id_jenis_lokasi,
							'no_kunjungan' => $no_kunjungan,
							'hari' => $hari,
							'tanggal' => $tanggal,
							'longitude' => $longitude,
							'latitude' => $latitude
						);

						$this->db->where('id_sales', $id_sales);
						$this->db->where('id_tempat', $id_tempat);
						$this->db->where('id_jenis_lokasi', $id_jenis_lokasi);
						$this->db->where('tanggal', $tanggal);
						$this->db->update('fe_daftar_pjp', $data_x);
						$this->check_trans_status('update fe_daftar_pjp failed');
					}
					else
					{
						$data_x = array(
							'id_sales' => $id_sales,
							'id_tempat' => $id_tempat,
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
			}
		}
	}
}
?>