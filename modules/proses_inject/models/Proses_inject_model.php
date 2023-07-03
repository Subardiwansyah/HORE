<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_inject_model extends Base_Model {

	var $data_valid;
	var $data_invalid;
	var $row_invalid;

	var $fieldmap_daftar = array('kode_produk', 'nama_produk', 'range_sn', 'qty');
	var $column_order = array(null, 'kode_produk', 'nama_produk', 'range_sn', 'qty');
	var $column_search = array('kode_produk', 'nama_produk', 'range_sn', 'qty');

	function __construct()
	{
		parent::__construct();
	}

	function build_query_daftar()
	{
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			xx.id
			, xx.id_produk
			, xx.kode_produk
			, xx.nama_produk
			, xx.sn_awal
			, xx.sn_akhir
			, xx.range_sn
			, xx.qty
		');
		$this->db->from('
			(
					SELECT
							g.id
							, g.id_produk
							, p.kode_produk
							, p.nama_produk
							, g.sn_awal
							, g.sn_akhir
							, CONCAT(g.sn_awal, " - ", g.sn_akhir) AS range_sn
							, g.qty
					FROM
							xb_gudang_tap g
							INNER JOIN gb_produk p
									ON (g.id_produk = p.id_produk)
					WHERE (g.id_tap = "'. $id_divisi.'"
							AND g.status_produk = "SEGEL"
							AND UPPER(p.id_jenis_produk) <> "SGOTA")
			) xx
		');
	}

	function build_query_form($id=NULL)
	{
		$this->db->select('
			xx.id
			, xx.id_produk
			, xx.kode_produk
			, xx.nama_produk
			, xx.id_jenis_produk
			, xx.nama_jenis_produk
			, xx.sn_awal
			, xx.sn_akhir
			, xx.range_sn
			, xx.qty
			, xx.modal
		');
		$this->db->from('
			(
					SELECT
							g.id
							, g.id_produk
							, p.kode_produk
							, p.nama_produk
							, p.id_jenis_produk
							, j.nama_jenis_produk
							, g.sn_awal
							, g.sn_akhir
							, CONCAT(g.sn_awal, " - ", g.sn_akhir) AS range_sn
							, g.qty
							, g.modal
					FROM
							xb_gudang_tap g
							INNER JOIN gb_produk p
									ON (g.id_produk = p.id_produk)
							INNER JOIN ga_jenis_produk j
									ON (p.id_jenis_produk = j.id_jenis_produk)
					WHERE (g.id = "'.$id.'")
			) xx
		');
	}

	function save_validasi_data()
  {
    $this->db->trans_begin();
    try {

			$id_level = $this->session->userdata('ID_LEVEL');
			$id_divisi = $this->session->userdata('ID_DIVISI');

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
			$this->db->where('id_tap', $id_divisi);
			$this->db->where('status_sn', 'NOT AVAILABLE');
			$rs = $this->db->get()->row_array();

			$data_invalid = isset($rs['x_invalid']) ? $rs['x_invalid'] : 0;
			$data_valid = $qty - $data_invalid;

			if ($data_invalid > 0)
			{
				$this->db->select('GROUP_CONCAT(serial_number SEPARATOR ",") AS list_sn');
				$this->db->from('ha_gudang');
				$this->db->where('serial_number BETWEEN "'.$sn_awal.'" AND "'.$sn_akhir.'"');
				$this->db->where('id_tap', $id_divisi);
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
		$this->update_gudang_segel_tap();
		$this->update_gudang_inject_tap();
	}

	function update_gudang()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$id_produk_pilih = $this->input->post('id_produk_pilih') ? $this->input->post('id_produk_pilih') : NULL;

		$id_produk = $this->input->post('id_produk') ? $this->input->post('id_produk') : NULL;
		$modal_bulk = $this->input->post('modal_bulk') ? prepare_currency($this->input->post('modal_bulk')) : 0;
		$jml_bulk = $this->input->post('jml_bulk') ? prepare_currency($this->input->post('jml_bulk')) : 0;
		$total_modal = $this->input->post('total_modal') ? prepare_currency($this->input->post('total_modal')) : 0;
		$sn_awal = $this->input->post('sn_awal') ? $this->input->post('sn_awal') : 0;
		$sn_akhir = $this->input->post('sn_akhir') ? $this->input->post('sn_akhir') : 0;

		$this->db->select('
			pd.total_kuota
			, pd.harga_paket
		');
		$this->db->from('gb_produk pd');
		$this->db->where('id_produk', $id_produk);
		$rs = $this->db->get()->row_array();

		$total_kuota = isset($rs['total_kuota']) ? $rs['total_kuota'] : 0;
		$harga_paket = isset($rs['harga_paket']) ? $rs['harga_paket'] : 0;

		$data_x = array(
			'tgl_inject' => date('Y-m-d H:i:s'),
			'id_produk_inject' => $id_produk,
			'total_kuota' => $total_kuota,
			'harga_paket' => $harga_paket,
			'modal_bulk' => $modal_bulk,
			'jml_bulk' => $jml_bulk,
			'total_modal' => $total_modal,
			'status_produk' => 'INJECT'
		);

		$this->db->where('serial_number >=', $sn_awal);
		$this->db->where('serial_number <=', $sn_akhir);
		$this->db->where('id_tap', $id_divisi);
		$this->db->update('ha_gudang', $data_x);
		$this->check_trans_status('update ha_gudang failed');

		$this->bd_main_tap(
			$modul = 'proses_inject',
			$aksi = 'UPDATE | TABLE : ha_gudang',
			$aktivitas = 'UPDATE GUDANG | TAP : '.$id_divisi.' | PRODUK SEGEL : '.$id_produk_pilih.' | PRODUK INJECT : '.$id_produk.' | SN AWAL : '.$sn_awal.' SN AKHIR : '.$sn_akhir.' | TOTAL KUOTA : '.$total_kuota.' | HARGA PAKET : '.$harga_paket.' | MODAL BULK : '.$modal_bulk.' | JUMLAH BULK : '.$jml_bulk.' | TOTAL MODAL : '.$total_modal,
			$created_by = $id_divisi
		);
	}

	function update_gudang_segel_tap()
	{
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$id = $this->input->post('id') ? $this->input->post('id') : 0;

		$id_produk_pilih = $this->input->post('id_produk_pilih') ? $this->input->post('id_produk_pilih') : NULL;
		$kd_produk_pilih = $this->input->post('kd_produk_pilih') ? $this->input->post('kd_produk_pilih') : NULL;
		$qty_pilih = $this->input->post('qty_pilih') ? prepare_integer($this->input->post('qty_pilih')) : 0;
		$sn_awal_pilih = $this->input->post('sn_awal_pilih') ? (int) $this->input->post('sn_awal_pilih') : NULL;
		$sn_akhir_pilih = $this->input->post('sn_akhir_pilih') ? (int) $this->input->post('sn_akhir_pilih') : NULL;
		$harga_modal_pilih = $this->input->post('harga_modal_pilih') ? prepare_currency($this->input->post('harga_modal_pilih')) : 0;

		$qty = $this->input->post('qty') ? prepare_integer($this->input->post('qty')) : 0;
		$sn_awal = $this->input->post('sn_awal') ? (int) $this->input->post('sn_awal') : NULL;
		$sn_akhir = $this->input->post('sn_akhir') ? (int) $this->input->post('sn_akhir') : NULL;

		$x_kode = substr($kd_produk_pilih, 0, 1);

		$this->db->where('id', $id);
		$this->db->delete('xb_gudang_tap');
		$this->check_trans_status('delete xb_gudang_tap failed');

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
				'id_tap' => $id_divisi,
				'id_produk' => $id_produk_pilih,
				'kode' => $id_divisi.'-'.$id_produk_pilih.'-'.date('YmdHis'),
				'sn_awal' => $x_sn_awal,
				'sn_akhir' => $x_sn_akhir,
				'qty' => $x_qty,
				'modal' => $harga_modal_pilih,
				'status_produk' => 'SEGEL'
			);

			$this->db->insert('xb_gudang_tap', $data_x);
			$this->check_trans_status('insert xb_gudang_tap failed');
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
				'id_tap' => $id_divisi,
				'id_produk' => $id_produk_pilih,
				'kode' => $id_divisi.'-'.$id_produk_pilih.'-'.date('YmdHis'),
				'sn_awal' => $x_sn_awal_1,
				'sn_akhir' => $x_sn_akhir_1,
				'qty' => $x_qty_1,
				'modal' => $harga_modal_pilih,
				'status_produk' => 'SEGEL'
			);

			$this->db->insert('xb_gudang_tap', $data_x);
			$this->check_trans_status('insert xb_gudang_tap failed');


			$data_x = array(
				'id_tap' => $id_divisi,
				'id_produk' => $id_produk,
				'kode' => $id_divisi.'-'.$id_produk_pilih.'-'.date('YmdHis'),
				'sn_awal' => $x_sn_awal_2,
				'sn_akhir' => $x_sn_akhir_2,
				'qty' => $x_qty_2,
				'modal' => $harga_modal_pilih,
				'status_produk' => 'SEGEL'
			);

			$this->db->insert('xb_gudang_tap', $data_x);
			$this->check_trans_status('insert xb_gudang_tap failed');
		}
		else if ($sn_awal > $sn_awal_pilih &&  $sn_akhir == $sn_akhir_pilih)
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
				'id_tap' => $id_divisi,
				'id_produk' => $id_produk_pilih,
				'kode' => $id_divisi.'-'.$id_produk_pilih.'-'.date('YmdHis'),
				'sn_awal' => $x_sn_awal,
				'sn_akhir' => $x_sn_akhir,
				'qty' => $x_qty,
				'modal' => $harga_modal_pilih,
				'status_produk' => 'SEGEL'
			);

			$this->db->insert('xb_gudang_tap', $data_x);
			$this->check_trans_status('insert xb_gudang_tap failed');
		}
	}

	function update_gudang_inject_tap()
	{
		$id_tap = $this->session->userdata('ID_DIVISI');
		$id_produk = $this->input->post('id_produk') ? $this->input->post('id_produk') : NULL;
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
			'modal' => $harga_modal,
			'status_produk' => 'INJECT'
		);

		$this->db->insert('xb_gudang_tap', $data_x);
		$this->check_trans_status('insert xb_gudang_tap failed');
	}

	function update_gudang_available()
	{
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('id_cluster');
		$this->db->from('bd_tap');
		$this->db->where('id_tap', $id_divisi);
		$rs = $this->db->get()->row_array();

		$id_cluster = isset($rs['id_cluster']) ? $rs['id_cluster'] : 0;

		$this->db->query("CALL gudang_available_segel('".$id_cluster."')");
		$this->db->query("CALL gudang_available_inject('".$id_cluster."')");
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

	function get_data_kabupaten_bytap()
  {
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('id_kabupaten');
		$this->db->from('bd_tap');
		$this->db->where('id_tap', $id_divisi);

    $result = $this->db->get()->row_array();

    return $result;
  }
}
?>