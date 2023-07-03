<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_sales_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	var $fieldmap_daftar_1 = array('tgl_retur', 'nama_sales', 'serial_number', 'nama_produk', 'harga_jual', 'nama_alasan');
	var $column_order_1 = array(null, 'tgl_retur', 'nama_sales', 'serial_number', 'nama_produk', 'harga_jual', 'nama_alasan');
	var $column_search_1 = array('tgl_retur', 'nama_sales', 'serial_number', 'nama_produk', 'harga_jual', 'nama_alasan');

	function build_query_daftar_1()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			xx.id_sales
			, xx.nama_sales
			, xx.id_retur
			, xx.tgl_retur
			, xx.serial_number
			, xx.id_produk
			, xx.nama_produk
			, xx.harga_modal
			, xx.harga_jual
			, xx.alasan
			, xx.nama_alasan
			, xx.status
			, xx.tgl_approval
			, xx.lastmodified
		');
		$this->db->from('
			(
				SELECT
						rs.id_sales
						, sl.nama_sales
						, rs.id_retur
						, DATE_FORMAT(rs.tgl_retur, "%d/%m/%Y") AS tgl_retur
						, rs.serial_number
						, rs.id_produk
						, pd.nama_produk
						, rs.harga_modal
						, rs.harga_jual
						, rs.alasan
						, ar.nama_alasan
						, rs.status
						, DATE_FORMAT(rs.tgl_approval, "%d/%m/%Y") AS tgl_approval
						, rs.lastmodified
				FROM
						ic_retur_sales rs
						INNER JOIN db_sales sl
								ON (rs.id_sales = sl.id_sales)
						INNER JOIN gb_produk pd
								ON (rs.id_produk = pd.id_produk)
						INNER JOIN hd_alasan_retur ar
								ON (rs.alasan = ar.id_alasan)
				WHERE (sl.id_tap = "'.$id_divisi.'"
					AND UPPER(rs.status) = "WAITING APPROVAL")
			) xx
		');
	}
	
	var $fieldmap_daftar_2 = array('tgl_retur', 'tgl_approval', 'nama_sales', 'serial_number', 'nama_produk', 'harga_jual', 'nama_alasan');
	var $column_order_2 = array(null, 'tgl_retur', 'tgl_approval', 'nama_sales', 'serial_number', 'nama_produk', 'harga_jual', 'nama_alasan');
	var $column_search_2 = array('tgl_retur', 'tgl_approval', 'nama_sales', 'serial_number', 'nama_produk', 'harga_jual', 'nama_alasan');

	function build_query_daftar_2()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			xx.id_sales
			, xx.nama_sales
			, xx.id_retur
			, xx.tgl_retur
			, xx.serial_number
			, xx.id_produk
			, xx.nama_produk
			, xx.harga_modal
			, xx.harga_jual
			, xx.alasan
			, xx.nama_alasan
			, xx.status
			, xx.tgl_approval
			, xx.lastmodified
		');
		$this->db->from('
			(
				SELECT
						rs.id_sales
						, sl.nama_sales
						, rs.id_retur
						, DATE_FORMAT(rs.tgl_retur, "%d/%m/%Y") AS tgl_retur
						, rs.serial_number
						, rs.id_produk
						, pd.nama_produk
						, rs.harga_modal
						, rs.harga_jual
						, rs.alasan
						, ar.nama_alasan
						, rs.status
						, DATE_FORMAT(rs.tgl_approval, "%d/%m/%Y") AS tgl_approval
						, rs.lastmodified
				FROM
						ic_retur_sales rs
						INNER JOIN db_sales sl
								ON (rs.id_sales = sl.id_sales)
						INNER JOIN gb_produk pd
								ON (rs.id_produk = pd.id_produk)
						INNER JOIN hd_alasan_retur ar
								ON (rs.alasan = ar.id_alasan)
				WHERE (sl.id_tap = "'.$id_divisi.'"
					AND UPPER(rs.status) = "APPROVED")
			) xx
		');
	}
	
	var $fieldmap_daftar_3 = array('tgl_retur', 'tgl_approval', 'nama_sales', 'serial_number', 'nama_produk', 'harga_jual', 'nama_alasan');
	var $column_order_3 = array(null, 'tgl_retur', 'tgl_approval', 'nama_sales', 'serial_number', 'nama_produk', 'harga_jual', 'nama_alasan');
	var $column_search_3 = array('tgl_retur', 'tgl_approval', 'nama_sales', 'serial_number', 'nama_produk', 'harga_jual', 'nama_alasan');

	function build_query_daftar_3()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			xx.id_sales
			, xx.nama_sales
			, xx.id_retur
			, xx.tgl_retur
			, xx.serial_number
			, xx.id_produk
			, xx.nama_produk
			, xx.harga_modal
			, xx.harga_jual
			, xx.alasan
			, xx.nama_alasan
			, xx.status
			, xx.tgl_approval
			, xx.lastmodified
		');
		$this->db->from('
			(
				SELECT
						rs.id_sales
						, sl.nama_sales
						, rs.id_retur
						, DATE_FORMAT(rs.tgl_retur, "%d/%m/%Y") AS tgl_retur
						, rs.serial_number
						, rs.id_produk
						, pd.nama_produk
						, rs.harga_modal
						, rs.harga_jual
						, rs.alasan
						, ar.nama_alasan
						, rs.status
						, DATE_FORMAT(rs.tgl_approval, "%d/%m/%Y") AS tgl_approval
						, rs.lastmodified
				FROM
						ic_retur_sales rs
						INNER JOIN db_sales sl
								ON (rs.id_sales = sl.id_sales)
						INNER JOIN gb_produk pd
								ON (rs.id_produk = pd.id_produk)
						INNER JOIN hd_alasan_retur ar
								ON (rs.alasan = ar.id_alasan)
				WHERE (sl.id_tap = "'.$id_divisi.'"
					AND UPPER(rs.status) = "REJECTED")
			) xx
		');
	}
	
	function save_data_approved()
  {
    $this->db->trans_begin();
    try {

			$this->insert_retur_approved();
			$this->update_gudang_approved();
			$this->update_gudang_tap();

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

	function insert_retur_approved()
	{
		$id_retur = $this->input->post('id_retur') ? $this->input->post('id_retur') : 0;

		$this->db->select('1');
		$this->db->from('ic_retur_sales');
		$this->db->where('id_retur', $id_retur);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$data_x = array(
				'status' => 'APPROVED',
				'tgl_approval' => date('Y-m-d')
			);

			$this->db->where('id_retur', $id_retur);
			$this->db->update('ic_retur_sales', $data_x);
			$this->check_trans_status('update ic_retur_sales failed');
		}
	}

	function update_gudang_approved()
	{
		$id_retur = $this->input->post('id_retur') ? $this->input->post('id_retur') : 0;

		$this->db->select('*');
		$this->db->from('ic_retur_sales');
		$this->db->where('id_retur', $id_retur);
		$rs = $this->db->get()->row_array();

		$alasan = $rs['alasan'] ? $rs['alasan'] : 0;
		$sn = $rs['serial_number'] ? $rs['serial_number'] : 0;

		if ($alasan == 1)
		{

		}
		else if ($alasan == 2)
		{
			$data_x = array(
				'status_sn' => 'AVAILABLE',
				'status_distribusi' => 'NOT DISTRIBUTION'
			);

			$this->db->where('serial_number', $sn);
			$this->db->update('ha_gudang', $data_x);
			$this->check_trans_status('update ha_gudang failed');
		}
	}

	function update_gudang_tap()
	{
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$id_retur = $this->input->post('id_retur') ? $this->input->post('id_retur') : 0;

		$arr_segel = array('SGPREPAID', 'SGOTA', 'SGVIN', 'SGVGS', 'SGVGG', 'SGVGP');
		$arr_inject = array('INSAC', 'INVGA', 'INVIN');

		$this->db->select('
			r.id_retur
			, r.id_produk
			, p.kode_produk
			, p.nama_produk
			, p.id_jenis_produk
			, r.alasan
			, r.serial_number
			, r.harga_modal
		');
		$this->db->from('ic_retur_sales r');
		$this->db->join('gb_produk p', 'r.id_produk = p.id_produk');
		$this->db->where('r.id_retur', $id_retur);
		$rs_a = $this->db->get()->row_array();

		$id_produk = isset($rs_a['id_produk']) ? $rs_a['id_produk'] : NULL;
		$kd_produk = isset($rs_a['kode_produk']) ? $rs_a['kode_produk'] : NULL;
		$id_jns_produk = isset($rs_a['id_jenis_produk']) ? $rs_a['id_jenis_produk'] : NULL;
		$sn = isset($rs_a['serial_number']) ? $rs_a['serial_number'] : NULL;
		$harga_modal = isset($rs_a['harga_modal']) ? $rs_a['harga_modal'] : 0;
		$alasan = isset($rs_a['alasan']) ? $rs_a['alasan'] : 0;

		$x_kode = substr($kd_produk, 0, 1);
		
		if ($alasan == 2)
		{

			if (in_array($id_jns_produk, $arr_segel))
			{
				$sn_min = (int) $sn - 1;
				$sn_plus = (int) $sn + 1;

				if ($x_kode == 'V')
				{
					$sn_min = $this->check_length_sn($sn_min, 12);
					$sn_plus = $this->check_length_sn($sn_plus, 12);
				}
				else
				{
					$sn_min = $this->check_length_sn($sn_min, 16);
					$sn_plus = $this->check_length_sn($sn_plus, 16);
				}

				$this->db->select('*');
				$this->db->from('xb_gudang_tap');
				$this->db->where('sn_awal', $sn_min);
				$this->db->or_where('sn_akhir', $sn_plus);
				$rs_b = $this->db->get()->row_array();

				$id = isset($rs_b['id']) ? $rs_b['id'] : 0;
				$sn_awal = isset($rs_b['sn_awal']) ? $rs_b['sn_awal'] : NULL;
				$sn_akhir = isset($rs_b['sn_akhir']) ? $rs_b['sn_akhir'] : NULL;
				$qty = isset($rs_b['qty']) ? $rs_b['qty'] : 0;

				if (!empty($rs_b))
				{
					if ((int) $sn < (int) $sn_awal)
					{
						$x_sn_awal = $sn;
						$x_sn_akhir = $sn_akhir;
						$x_qty = $qty + 1;
					}
					else if ((int) $sn > (int) $sn_akhir)
					{
						$x_sn_awal = $sn_awal;
						$x_sn_akhir = $sn;
						$x_qty = $qty + 1;
					}
					else
					{
						$x_sn_awal = $sn_awal;
						$x_sn_akhir = $sn_akhir;
						$x_qty = $qty + 1;
					}
					
					$this->db->where('id', $id);
					$this->db->delete('xb_gudang_tap');
					$this->check_trans_status('delete xb_gudang_tap failed');
					
					$data_x = array(
						'id_tap' => $id_divisi,
						'id_produk' => $id_produk,
						'kode' => $id_divisi.'-'.$id_produk.'-'.date('YmdHis'),
						'sn_awal' => $x_sn_awal,
						'sn_akhir' => $x_sn_akhir,
						'qty' => $x_qty,
						'modal' => $harga_modal,
						'status_produk' => 'SEGEL'
					);

					$this->db->insert('xb_gudang_tap', $data_x);
					$this->check_trans_status('insert xb_gudang_tap failed');
				}
				else
				{
					$data_x = array(
						'id_tap' => $id_divisi,
						'id_produk' => $id_produk,
						'kode' => $id_divisi.'-'.$id_produk.'-'.date('YmdHis'),
						'sn_awal' => $sn,
						'sn_akhir' => $sn,
						'qty' => 1,
						'modal' => $harga_modal,
						'status_produk' => 'SEGEL'
					);

					$this->db->insert('xb_gudang_tap', $data_x);
					$this->check_trans_status('insert xb_gudang_tap failed');
				}
			}
			else if (in_array($id_jns_produk, $arr_inject))
			{
				$sn_min = (int) $sn - 1;
				$sn_plus = (int) $sn + 1;

				if ($x_kode == 'V')
				{
					$sn_min = $this->check_length_sn($sn_min, 12);
					$sn_plus = $this->check_length_sn($sn_plus, 12);
				}
				else
				{
					$sn_min = $this->check_length_sn($sn_min, 16);
					$sn_plus = $this->check_length_sn($sn_plus, 16);
				}

				$this->db->select('*');
				$this->db->from('xb_gudang_tap');
				$this->db->where('sn_awal', $sn_min);
				$this->db->or_where('sn_akhir', $sn_plus);
				$rs_b = $this->db->get()->row_array();

				$id = isset($rs_b['id']) ? $rs_b['id'] : 0;
				$sn_awal = isset($rs_b['sn_awal']) ? $rs_b['sn_awal'] : NULL;
				$sn_akhir = isset($rs_b['sn_akhir']) ? $rs_b['sn_akhir'] : NULL;
				$qty = isset($rs_b['qty']) ? $rs_b['qty'] : 0;

				if (!empty($rs_b))
				{
					if ((int) $sn < (int) $sn_awal)
					{
						$x_sn_awal = $sn;
						$x_sn_akhir = $sn_akhir;
						$x_qty = $qty + 1;
					}
					else if ((int) $sn > (int) $sn_akhir)
					{
						$x_sn_awal = $sn_awal;
						$x_sn_akhir = $sn;
						$x_qty = $qty + 1;
					}
					else
					{
						$x_sn_awal = $sn_awal;
						$x_sn_akhir = $sn_akhir;
						$x_qty = $qty + 1;
					}
					
					$this->db->where('id', $id);
					$this->db->delete('xb_gudang_tap');
					$this->check_trans_status('delete xb_gudang_tap failed');
					
					$data_x = array(
						'id_tap' => $id_divisi,
						'id_produk' => $id_produk,
						'kode' => $id_divisi.'-'.$id_produk.'-'.date('YmdHis'),
						'sn_awal' => $x_sn_awal,
						'sn_akhir' => $x_sn_akhir,
						'qty' => $x_qty,
						'modal' => $harga_modal,
						'status_produk' => 'INJECT'
					);

					$this->db->insert('xb_gudang_tap', $data_x);
					$this->check_trans_status('insert xb_gudang_tap failed');
				}
				else
				{
					$data_x = array(
						'id_tap' => $id_divisi,
						'id_produk' => $id_produk,
						'kode' => $id_divisi.'-'.$id_produk.'-'.date('YmdHis'),
						'sn_awal' => $sn,
						'sn_akhir' => $sn,
						'qty' => 1,
						'modal' => $harga_modal,
						'status_produk' => 'INJECT'
					);

					$this->db->insert('xb_gudang_tap', $data_x);
					$this->check_trans_status('insert xb_gudang_tap failed');
				}
			}
		}
	}
	
	function save_data_reject()
  {
    $this->db->trans_begin();
    try {

			$this->insert_retur_reject();
			$this->update_distribusi_reject();

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

	function insert_retur_reject()
	{
		$id_retur = $this->input->post('id_retur') ? $this->input->post('id_retur') : 0;

		$this->db->select('1');
		$this->db->from('ic_retur_sales');
		$this->db->where('id_retur', $id_retur);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$data_x = array(
				'status' => 'REJECTED',
				'tgl_approval' => date('Y-m-d')
			);

			$this->db->where('id_retur', $id_retur);
			$this->db->update('ic_retur_sales', $data_x);
			$this->check_trans_status('update ic_retur_sales failed');
		}
	}

	function update_distribusi_reject()
	{
		$id_retur = $this->input->post('id_retur') ? $this->input->post('id_retur') : 0;

		$this->db->select('id_sales, serial_number');
		$this->db->from('ic_retur_sales');
		$this->db->where('id_retur', $id_retur);
		$rs = $this->db->get()->row_array();

		if (!empty($rs))
		{
			$data_x = array(
				'status_distribusi' => 'AVAILABLE',
				'status_penjualan' => 'BELUM TERJUAL'
			);

			$this->db->where('id_sales', $rs['id_sales']);
			$this->db->where('serial_number', $rs['serial_number']);
			$this->db->update('ia_distribusi_perdana', $data_x);
			$this->check_trans_status('update ia_distribusi_perdana failed');
		}
	}
}
?>