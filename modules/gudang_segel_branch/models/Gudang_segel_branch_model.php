<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang_segel_branch_model extends Base_Model {

	var $data_valid;
	var $data_invalid;
	var $row_invalid;
	var $fieldmap_daftar = array('nama_cluster', 'qty');
	var $column_order = array(null, 'nama_cluster', 'qty');
	var $column_search = array('nama_cluster', 'qty');

	function __construct()
	{
		parent::__construct();
	}

	function build_query_daftar()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				t.id_cluster
				, c.nama_cluster
				, SUM(t.qty) AS qty
			');
			$this->db->from('xa_gudang_cluster t');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->group_by('t.id_cluster, c.nama_cluster');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				t.id_cluster
				, c.nama_cluster
				, COALESCE(SUM(t.qty), 0) AS qty
			');
			$this->db->from('xa_gudang_cluster t');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->where('c.id_branch', $id_divisi);
			$this->db->group_by('t.id_cluster, c.nama_cluster');
		}
	}

	function insert_gudang()
	{
		$id_cluster = $this->input->post('id_cluster') ? $this->input->post('id_cluster') : NULL;

		$id_produk = $this->input->post('id_produk') ? $this->input->post('id_produk') : NULL;
		$kd_produk = $this->input->post('kd_produk') ? $this->input->post('kd_produk') : NULL;
		$sn_awal = $this->input->post('sn_awal') ? (int) $this->input->post('sn_awal') : NULL;
		$sn_akhir = $this->input->post('sn_akhir') ? (int) $this->input->post('sn_akhir') : NULL;
		$qty = $this->input->post('qty') ? prepare_integer($this->input->post('qty')) : 0;

		$this->db->select('harga_modal, harga_bandrol');
		$this->db->from('gb_produk');
		$this->db->where('id_produk', $id_produk);
		$rs = $this->db->get()->row_array();
		$harga_modal = $rs['harga_modal'] ? $rs['harga_modal'] : 0;
		$harga_bandrol = $rs['harga_bandrol'] ? $rs['harga_bandrol'] : 0;

		$x_kode = substr($kd_produk, 0, 1);

		$data = array();

		for ($i=$sn_awal; $i<=$sn_akhir; $i++)
		{
			if ($x_kode == 'V')
			{
				$sn = $this->check_length_sn($i, 12);
			}
			else
			{
				$sn = $this->check_length_sn($i, 16);
			}

			$data_x = array(
				'tgl_sn_dibentuk' => date('Y-m-d H:i:s'),
				'id_cluster' => $id_cluster,
				'id_produk_segel' => $id_produk,
				'serial_number' => $sn,
				'harga_modal_branch' => $harga_modal,
				'harga_bandrol_branch' => $harga_bandrol,
				'total_modal' => $harga_modal
			);

			$data[] = $data_x;
		}

		$this->db->insert_batch('ha_gudang', $data);
		$this->check_trans_status('insert ha_gudang failed');
	}

	function update_gudang_cluster()
	{
		$id_cluster = $this->input->post('id_cluster') ? $this->input->post('id_cluster') : 0;
		$id_produk = $this->input->post('id_produk') ? $this->input->post('id_produk') : 0;
		$sn_awal = $this->input->post('sn_awal') ? $this->input->post('sn_awal') : NULL;
		$sn_akhir = $this->input->post('sn_akhir') ? $this->input->post('sn_akhir') : NULL;
		$qty = $this->input->post('qty') ? $this->input->post('qty') : 0;

		$data_x = array(
			'id_cluster' => $id_cluster,
			'id_produk' => $id_produk,
			'kode' => $id_cluster.'-'.$id_produk.'-'.date('YmdHis'),
			'sn_awal' => $sn_awal,
			'sn_akhir' => $sn_akhir,
			'qty' => $qty
		);

		$this->db->insert('xa_gudang_cluster', $data_x);
		$this->check_trans_status('insert xa_gudang_cluster failed');
	}

	function update_gudang_available()
	{
		$id_cluster = $this->input->post('id_cluster') ? $this->input->post('id_cluster') : 0;

		$this->db->query("CALL gudang_available_segel('".$id_cluster."')");
	}

	function save_detail()
	{
		$this->insert_gudang();
		$this->update_gudang_cluster();
	}

	function cek_exist()
	{
		return TRUE;
	}

	function check_duplikasi()
	{
		return TRUE;
	}

	function check_dependency($id)
	{
		return TRUE;
	}

	function get_list_produk_available()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$id_cluster = $this->input->post('id_cluster') ? $this->input->post('id_cluster') : 0;
		$produk = $this->input->post('produk') ? $this->input->post('produk') : NULL;
		$sn = $this->input->post('sn') ? $this->input->post('sn') : NULL;

		$this->db->select('
			xx.id_produk
			, xx.nama_produk
			, xx.sn_awal
			, xx.sn_akhir
			, xx.qty
			, CONCAT(xx.sn_awal, " - ", xx.sn_akhir) AS range_sn
		');
		$this->db->from("
			(
				SELECT
						t.id_produk
						, p.nama_produk
						, t.sn_awal
						, t.sn_akhir
						, t.qty
				FROM
						xa_gudang_cluster t
						INNER JOIN gb_produk p
								ON (t.id_produk = p.id_produk)
				WHERE (t.id_cluster = '".$id_cluster."'
						AND UPPER(p.nama_produk) LIKE '".strtoupper('%'.$produk.'%')."'
						AND (t.sn_awal LIKE '".strtoupper('%'.$sn.'%')."' OR t.sn_akhir LIKE '".strtoupper('%'.$sn.'%')."'
									OR (t.sn_awal <= '".$sn."' AND t.sn_akhir >= '".$sn."')))
			) xx
		");

		$result = $this->db->get()->result_array();

		return $result;
	}

	function save_validasi_data()
  {
    $this->db->trans_begin();
    try {

			$id_level = $this->session->userdata('ID_LEVEL');
			$id_divisi = $this->session->userdata('ID_DIVISI');

			$id_produk = $this->input->post('id_produk') ? $this->input->post('id_produk') : 0;
			$sn_awal = $this->input->post('sn_awal') ? $this->input->post('sn_awal') : 0;
			$sn_akhir = $this->input->post('sn_akhir') ? $this->input->post('sn_akhir') : 0;
			$qty = $this->input->post('qty') ? (int) $this->input->post('qty') : 0;

			$data_valid = 0;
			$data_invalid = 0;
			$row_invalid = array();
			$row = array();

			$this->db->select('COUNT(id_gudang) AS x_invalid');
			$this->db->from('ha_gudang');
			$this->db->where('serial_number BETWEEN "'.$sn_awal.'" AND "'.$sn_akhir.'"');
			$rs = $this->db->get()->row_array();

			$data_invalid = isset($rs['x_invalid']) ? $rs['x_invalid'] : 0;
			$data_valid = $qty - $data_invalid;

			if ($data_invalid > 0)
			{
				$this->db->select('GROUP_CONCAT(serial_number SEPARATOR ",") AS list_sn');
				$this->db->from('ha_gudang');
				$this->db->where('serial_number BETWEEN "'.$sn_awal.'" AND "'.$sn_akhir.'"');
				$rs = $this->db->get()->row_array();

				$list_sn = isset($rs['list_sn']) ? $rs['list_sn'] : '';

				$row_invalid[] = explode(',', $list_sn);
			}

			$this->data_valid = $data_valid;
			$this->data_invalid = (int) $data_invalid;
			$this->row_invalid = $row_invalid;

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
}
?>