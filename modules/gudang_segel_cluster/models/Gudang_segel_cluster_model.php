<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang_segel_cluster_model extends Base_Model {

	var $data_valid;
	var $data_invalid;
	var $row_invalid;
	var $fieldmap_daftar = array('kode_produk', 'nama_produk', 'CONCAT(g.sn_awal, " - ", g.sn_akhir)', 'qty');
	var $column_order = array(null, 'kode_produk', 'nama_produk', 'CONCAT(g.sn_awal, " - ", g.sn_akhir)', 'qty');
	var $column_search = array('kode_produk', 'nama_produk', 'CONCAT(g.sn_awal, " - ", g.sn_akhir)', 'qty');

	function __construct()
	{
		parent::__construct();
	}

	function build_query_daftar()
	{
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			g.id
			, g.id_produk
			, p.kode_produk
			, p.nama_produk
			, g.sn_awal
			, g.sn_akhir
			, CONCAT(g.sn_awal, " - ", g.sn_akhir) AS range_sn
			, g.qty
		');
		$this->db->from('xa_gudang_cluster g');
		$this->db->join('gb_produk p', 'g.id_produk = p.id_produk');
		$this->db->where('g.id_cluster', $id_divisi);
	}

	function build_query_form($id=NULL)
	{
		$this->db->select('
			g.id
			, g.id_produk
			, p.kode_produk
			, p.nama_produk
			, g.sn_awal
			, g.sn_akhir
			, CONCAT(g.sn_awal, " - ", g.sn_akhir) AS range_sn
			, g.qty
		');
		$this->db->from('xa_gudang_cluster g');
		$this->db->join('gb_produk p', 'g.id_produk = p.id_produk');
		$this->db->where('g.id', $id);
	}

	function save_validasi_data()
  {
    $this->db->trans_begin();
    try {

			$id_level = $this->session->userdata('ID_LEVEL');
			$id_divisi = $this->session->userdata('ID_DIVISI');

			$id_produk = $this->input->post('id_produk_pilih') ? $this->input->post('id_produk_pilih') : 0;
			$sn_awal = $this->input->post('sn_awal') ? $this->input->post('sn_awal') : 0;
			$sn_akhir = $this->input->post('sn_akhir') ? $this->input->post('sn_akhir') : 0;
			$qty = $this->input->post('qty') ? (int) $this->input->post('qty') : 0;

			$data_valid = 0;
			$data_invalid = 0;
			$row_invalid = array();

			$this->db->select('COUNT(id_gudang) AS x_invalid');
			$this->db->from('ha_gudang');
			$this->db->where('serial_number BETWEEN "'.$sn_awal.'" AND "'.$sn_akhir.'"');
			$this->db->where('id_cluster', $id_divisi);
			$this->db->where('status_sn', 'NOT AVAILABLE');
			$rs = $this->db->get()->row_array();

			$data_invalid = isset($rs['x_invalid']) ? $rs['x_invalid'] : 0;
			$data_valid = $qty - $data_invalid;


			if ($data_invalid > 0)
			{
				$this->db->select('GROUP_CONCAT(serial_number SEPARATOR ",") AS list_sn');
				$this->db->from('ha_gudang');
				$this->db->where('serial_number BETWEEN "'.$sn_awal.'" AND "'.$sn_akhir.'"');
				$this->db->where('id_cluster', $id_divisi);
				$this->db->where('status_sn', 'NOT AVAILABLE');
				$rs = $this->db->get()->row_array();

				$list_sn = isset($rs['list_sn']) ? $rs['list_sn'] : '';

				$row_invalid[] = explode(',', $list_sn);

				$data_valid = $qty - count($row_invalid);
			}

			$this->data_valid = $data_valid;
			$this->data_invalid = $data_invalid;
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

	function save_detail()
	{
		$this->update_gudang();
		$this->update_gudang_cluster();
		$this->update_gudang_tap();
	}

	function update_gudang()
	{
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$id_tap = $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL;
		$id_produk = $this->input->post('id_produk_pilih') ? $this->input->post('id_produk_pilih') : NULL;
		$sn_awal = $this->input->post('sn_awal') ? $this->input->post('sn_awal') : 0;
		$sn_akhir = $this->input->post('sn_akhir') ? $this->input->post('sn_akhir') : 0;

		$this->db->select('
			harga_modal
			, harga_bandrol
		');
		$this->db->from('gb_produk');
		$this->db->where('id_produk', $id_produk);
		$rs = $this->db->get()->row_array();
		$harga_modal = isset($rs['harga_modal']) ? $rs['harga_modal'] : 0;
		$harga_bandrol = isset($rs['harga_bandrol']) ? $rs['harga_bandrol'] : 0;

		$this->db->select('1');
		$this->db->from('bd_tap');
		$this->db->where('id_cluster', $id_divisi);
		$this->db->where('id_tap', $id_tap);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$data_x = array(
				'tgl_distribusi_ke_tap' => date('Y-m-d H:i:s'),
				'id_tap' => $id_tap,
				'harga_modal_cluster' => $harga_modal,
				'harga_bandrol_cluster' => $harga_bandrol,
				'total_modal' => $harga_modal
			);

			$this->db->where('serial_number >=', $sn_awal);
			$this->db->where('serial_number <=', $sn_akhir);
			$this->db->update('ha_gudang', $data_x);
			$this->check_trans_status('update ha_gudang failed');

			$this->bd_main_tap(
				$modul = 'gudang_segel_cluster',
				$aksi = 'UPDATE | TABLE : ha_gudang',
				$aktivitas = 'UPDATE GUDANG | TAP : '.$id_tap.' | SN AWAL : '.$sn_awal.' SN AKHIR : '.$sn_akhir.' | HARGA MODAL : '.$harga_modal.' | HARGA BANDROL : '.$harga_bandrol. ' | TOTAL MODAL : '.$harga_modal,
				$created_by = $id_divisi
			);
		}
	}

	function update_gudang_cluster()
	{
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$id = $this->input->post('id') ? $this->input->post('id') : 0;

		$id_produk = $this->input->post('id_produk_pilih') ? $this->input->post('id_produk_pilih') : NULL;
		$kd_produk = $this->input->post('kd_produk_pilih') ? $this->input->post('kd_produk_pilih') : NULL;
		$sn_awal = $this->input->post('sn_awal') ? (int) $this->input->post('sn_awal') : NULL;
		$sn_akhir = $this->input->post('sn_akhir') ? (int) $this->input->post('sn_akhir') : NULL;
		$qty = $this->input->post('qty') ? $this->input->post('qty') : 0;

		$qty_pilih = $this->input->post('qty_pilih') ? prepare_integer($this->input->post('qty_pilih')) : 0;
		$sn_awal_pilih = $this->input->post('sn_awal_pilih') ? (int) $this->input->post('sn_awal_pilih') : NULL;
		$sn_akhir_pilih = $this->input->post('sn_akhir_pilih') ? (int) $this->input->post('sn_akhir_pilih') : NULL;

		$x_kode = substr($kd_produk, 0, 1);

		$this->db->where('id', $id);
		$this->db->delete('xa_gudang_cluster');
		$this->check_trans_status('delete xa_gudang_cluster failed');

		if ($sn_awal == $sn_awal_pilih && $sn_akhir < $sn_akhir_pilih)
		{
			$x_sn_awal = $sn_akhir + 1;
			$x_sn_akhir = $sn_akhir_pilih;
			$x_qty = $qty_pilih - $qty;

			if ($x_kode == 'V')
			{
				$x_sn_awal = $this->check_length_sn($x_sn_awal, 12);
				$x_sn_akhir = $this->check_length_sn($x_sn_akhir, 12);
			}
			else
			{
				$x_sn_awal = $this->check_length_sn($x_sn_awal, 16);
				$x_sn_akhir = $this->check_length_sn($x_sn_akhir, 16);
			}

			$data_x = array(
				'id_cluster' => $id_divisi,
				'id_produk' => $id_produk,
				'kode' => $id_divisi.'-'.$id_produk.'-'.date('YmdHis'),
				'sn_awal' => $x_sn_awal,
				'sn_akhir' => $x_sn_akhir,
				'qty' => $x_qty
			);

			$this->db->insert('xa_gudang_cluster', $data_x);
			$this->check_trans_status('insert xa_gudang_cluster failed');
		}
		else if ($sn_awal > $sn_awal_pilih &&  $sn_akhir < $sn_akhir_pilih)
		{
			$x_sn_awal_1 = $sn_awal_pilih;
			$x_sn_akhir_1 = $sn_awal - 1;
			$x_qty_1 = $x_sn_akhir_1 - $x_sn_awal_1 + 1;

			$x_sn_awal_2 = $sn_akhir + 1;
			$x_sn_akhir_2 = $sn_akhir_pilih;
			$x_qty_2 = $x_sn_akhir_2 - $x_sn_awal_2 + 1;

			if ($x_kode == 'V')
			{
				$x_sn_awal_1 = $this->check_length_sn($x_sn_awal_1, 12);
				$x_sn_akhir_1 = $this->check_length_sn($x_sn_akhir_1, 12);

				$x_sn_awal_2 = $this->check_length_sn($x_sn_awal_2, 12);
				$x_sn_akhir_2 = $this->check_length_sn($x_sn_akhir_2, 12);
			}
			else
			{
				$x_sn_awal_1 = $this->check_length_sn($x_sn_awal_1, 16);
				$x_sn_akhir_1 = $this->check_length_sn($x_sn_akhir_1, 16);

				$x_sn_awal_2 = $this->check_length_sn($x_sn_awal_2, 16);
				$x_sn_akhir_2 = $this->check_length_sn($x_sn_akhir_2, 16);
			}

			$data_x = array(
				'id_cluster' => $id_divisi,
				'id_produk' => $id_produk,
				'kode' => $id_divisi.'-'.$id_produk.'-'.date('YmdHis'),
				'sn_awal' => $x_sn_awal_1,
				'sn_akhir' => $x_sn_akhir_1,
				'qty' => $x_qty_1
			);

			$this->db->insert('xa_gudang_cluster', $data_x);
			$this->check_trans_status('insert xa_gudang_cluster failed');


			$data_x = array(
				'id_cluster' => $id_divisi,
				'id_produk' => $id_produk,
				'kode' => $id_divisi.'-'.$id_produk.'-'.date('YmdHis'),
				'sn_awal' => $x_sn_awal_2,
				'sn_akhir' => $x_sn_akhir_2,
				'qty' => $x_qty_2
			);

			$this->db->insert('xa_gudang_cluster', $data_x);
			$this->check_trans_status('insert xa_gudang_cluster failed');
		}
		else if ($sn_awal > $sn_awal_pilih &&  $sn_akhir == $sn_akhir_pilih) // JIKA YANG DIAMBIL SN TENGAH S/D AKHIR
		{
			$x_sn_awal = $sn_awal_pilih;
			$x_sn_akhir = $sn_awal - 1;
			$x_qty = $qty_pilih - $qty;

			if ($x_kode == 'V')
			{
				$x_sn_awal = $this->check_length_sn($x_sn_awal, 12);
				$x_sn_akhir = $this->check_length_sn($x_sn_akhir, 12);
			}
			else
			{
				$x_sn_awal = $this->check_length_sn($x_sn_awal, 16);
				$x_sn_akhir = $this->check_length_sn($x_sn_akhir, 16);
			}

			$data_x = array(
				'id_cluster' => $id_divisi,
				'id_produk' => $id_produk,
				'kode' => $id_divisi.'-'.$id_produk.'-'.date('YmdHis'),
				'sn_awal' => $x_sn_awal,
				'sn_akhir' => $x_sn_akhir,
				'qty' => $x_qty
			);

			$this->db->insert('xa_gudang_cluster', $data_x);
			$this->check_trans_status('insert xa_gudang_cluster failed');
		}
	}

	function update_gudang_tap()
	{
		$id_tap = $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL;
		$id_produk = $this->input->post('id_produk_pilih') ? $this->input->post('id_produk_pilih') : 0;
		$sn_awal = $this->input->post('sn_awal') ? $this->input->post('sn_awal') : NULL;
		$sn_akhir = $this->input->post('sn_akhir') ? $this->input->post('sn_akhir') : NULL;
		$qty = $this->input->post('qty') ? $this->input->post('qty') : 0;

		$this->db->select('harga_modal');
		$this->db->from('gb_produk');
		$this->db->where('id_produk', $id_produk);
		$rs = $this->db->get()->row_array();
		$harga_modal = isset($rs['harga_modal']) ? $rs['harga_modal'] : 0;

		$data_x = array(
			'id_tap' => $id_tap,
			'id_produk' => $id_produk,
			'kode' => $id_tap.'-'.$id_produk.'-'.date('YmdHis'),
			'sn_awal' => $sn_awal,
			'sn_akhir' => $sn_akhir,
			'qty' => $qty,
			'modal' => $harga_modal
		);

		$this->db->insert('xb_gudang_tap', $data_x);
		$this->check_trans_status('insert xb_gudang_tap failed');
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
}
?>