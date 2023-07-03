<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup_la_model extends Base_Model {

	var $fieldmap_daftar = array();
	var $column_order = array();
	var $column_search = array();

	function __construct()
	{
		parent::__construct();
	}

	function get_limit_existing()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;

		$this->db->select('limit_link_aja AS limit_existing');
		$this->db->from('db_sales');
		$this->db->where('id_sales', $id_sales);

    $result = $this->db->get();

    return $result->row_array();
	}

	function update_saldo()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$limit_existing = $this->input->post('limit_existing') ? prepare_currency($this->input->post('limit_existing')) : 0;
		$limit_new = $this->input->post('limit_new') ? prepare_currency($this->input->post('limit_new')) : 0;

		$this->db->select('1');
		$this->db->from('db_sales s');
		$this->db->where('s.id_sales', $id_sales);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			if ($limit_existing !== $limit_new)
			{
				$data_x = array(
					'limit_link_aja' => $limit_new
				);

				$this->db->where('id_sales', $id_sales);
				$this->db->update('db_sales', $data_x);
				$this->check_trans_status('update db_sales failed');
			}
		}
	}

	function insert_distribusi_la()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$limit_existing = $this->input->post('limit_existing') ? prepare_currency($this->input->post('limit_existing')) : 0;
		$limit_new = $this->input->post('limit_new') ? prepare_currency($this->input->post('limit_new')) : 0;

		if ($limit_existing !== $limit_new)
		{
			$data_x = array(
				'id_sales' => $id_sales,
				'tgl_distribusi' => date('Y-m-d'),
				'limit_la' => $limit_new
			);

			$this->db->insert('ib_distribusi_la', $data_x);
			$this->check_trans_status('insert ib_distribusi_la failed');
		}
	}

	function save_detail()
	{
		$this->update_saldo();
		$this->insert_distribusi_la();
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

		$this->db->select('
			xx.id_sales
			, xx.id_tempat
			, xx.nama_tempat
			, xx.id_jenis_lokasi
			, xx.nama_jenis_lokasi
			, xx.id_pjp
			, xx.hari
			, xx.tanggal
			, xx.no_kunjungan
			, IF(xx.flag_del > 0, 0, 1) AS flag_del
			, xx.max_no
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
						, p.id_jenis_lokasi
						, j.nama_jenis_lokasi
						, p.id_pjp
						, p.hari
						, (
								SELECT
										d.tanggal
								FROM
										fe_daftar_pjp d
								WHERE (d.id_sales = p.id_sales
										AND d.id_tempat = p.id_tempat
										AND d.id_jenis_lokasi = p.id_jenis_lokasi
										AND d.no_kunjungan = p.no_kunjungan
										AND d.hari = p.hari)
							) AS tanggal
						, p.no_kunjungan
						, (
									SELECT
											COUNT(h.id_history_pjp)
									FROM
											fb_histroy_pjp h
									WHERE (h.id_sales = p.id_sales
											AND h.id_tempat = p.id_tempat
											AND h.id_jenis_lokasi = p.id_jenis_lokasi
											AND h.tanggal = "'.date('Y-m-d').'")
							) AS flag_del
						, (
									SELECT
											MAX(xp.no_kunjungan)
									FROM
											fa_pjp xp
									WHERE (xp.id_sales = "'.$id_sales.'"
											AND UPPER(xp.hari) = "'.$hari.'")
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

	function update_no_kunjungan_c()
  {
    $this->db->trans_begin();
    try {

			$id_pjp = $this->input->post('id_pjp') ? $this->input->post('id_pjp') : NULL;
			$tanggal = $this->input->post('tanggal') ? $this->input->post('tanggal') : NULL;

			$this->db->select('*');
			$this->db->from('fa_pjp');
			$this->db->where('id_pjp', $id_pjp);
			$rsx = $this->db->get()->row_array();

			$id_sales = $rsx['id_sales'] ? $rsx['id_sales'] : 0;
			$hari = $rsx['hari'] ? $rsx['hari'] : 0;


			$this->db->select('*');
			$this->db->from('fa_pjp');
			$this->db->where('id_sales', $id_sales);
			$this->db->where('hari', $hari);
			$rs = $this->db->get()->result_array();

			if (!empty($rs))
			{
				for ($x=0; $x<count($rs); $x++)
				{
					$data_x = array (
						'no_kunjungan' => $rs[$x]['no_kunjungan']
					);

					$this->db->where('id_sales', $rs[$x]['id_sales']);
					$this->db->where('id_tempat', $rs[$x]['id_tempat']);
					$this->db->where('id_jenis_lokasi', $rs[$x]['id_jenis_lokasi']);
					$this->db->where('hari', $rs[$x]['hari']);
					$this->db->where('tanggal', $tanggal);
					$this->db->update('fe_daftar_pjp', $data_x);
					$this->check_trans_status('update fe_daftar_pjp failed');
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

	function update_no_kunjungan_b()
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

	function update_no_kunjungan_a()
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
			$this->delete_daftar_pjp();
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

	function delete_daftar_pjp()
	{
		$id_pjp = $this->input->post('id_pjp') ? $this->input->post('id_pjp') : NULL;
		$tanggal = $this->input->post('tanggal') ? $this->input->post('tanggal') : NULL;

		$this->db->where('tanggal', $tanggal);
		$this->db->delete('fe_daftar_pjp');
		$this->check_trans_status('delete fe_daftar_pjp failed');

		$this->db->select('*');
		$this->db->from('fa_pjp');
		$this->db->where('id_sales', $this->id_sales);
		$this->db->where('hari', $this->hari);
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

				$rsx = $this->db->get()->row_array();

				$longitude = $rsx['longitude'] ? $rsx['longitude'] : NULL;
				$latitude = $rsx['latitude'] ? $rsx['latitude'] : NULL;

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