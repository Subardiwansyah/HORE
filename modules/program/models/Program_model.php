<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_model extends Base_Model {

	var $fieldmap_daftar_1 = array('nama_jenis');
	var $column_order_1 = array(null, 'nama_jenis');
	var $column_search_1 = array('nama_jenis');
	var $column_order_2 = array('nama_jenis', 'tgl_close');
	var $fieldmap_daftar_2 = array('nama_jenis', 'tgl_close');
	var $column_search_2 = array('nama_jenis', 'tgl_close');

	function __construct()
	{
		parent::__construct();
	}
	
	function build_query_daftar_1()
	{
		$this->db->select('p.*');
		$this->db->from('na_promotion_jenis p');
		$this->db->where('p.status', 'AKTIF');
	}
	
	function build_query_daftar_2()
	{
		$this->db->select('p.*');
		$this->db->from('na_promotion_jenis p');
		$this->db->where('p.status', 'TIDAK AKTIF');
	}

	function build_query_form($id=NULL)
	{
		$this->db->select('p.*');
		$this->db->from('na_promotion_jenis p');
		$this->db->where('p.id_jenis', $id);
	}

	function insert_program()
	{
		$id_jenis = $this->input->post('id') ? $this->input->post('id') : NULL;

		$this->db->select('1');
		$this->db->from('na_promotion_jenis');
		$this->db->where('id_jenis', $id_jenis);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$status = $this->input->post('status') ? $this->input->post('status') : NULL;

			if ($status == 'TIDAK AKTIF')
			{
				$data_x = array(
					'nama_jenis' => $this->input->post('nm_jenis') ? $this->input->post('nm_jenis') : NULL,
					'tgl_close' => $this->input->post('tgl_close') ? prepare_date($this->input->post('tgl_close')) : NULL,
					'status' => $this->input->post('status') ? $this->input->post('status') : NULL
				);
			}
			else
			{
				$data_x = array(
					'nama_jenis' => $this->input->post('nm_jenis') ? $this->input->post('nm_jenis') : NULL,
					'status' => $this->input->post('status') ? $this->input->post('status') : NULL
				);
			}

			$this->db->where('id_jenis', $id_jenis);
			$this->db->update('na_promotion_jenis', $data_x);
			$this->check_trans_status('update na_promotion_jenis failed');
		}
		else
		{
			$data_x = array(
				'nama_jenis' => $this->input->post('nm_jenis') ? $this->input->post('nm_jenis') : NULL,
				'tgl_open' => $this->input->post('tgl_open') ? prepare_date($this->input->post('tgl_open')) : NULL,
				'status' => $this->input->post('status') ? $this->input->post('status') : NULL
			);

			$this->db->insert('na_promotion_jenis', $data_x);
			$this->check_trans_status('insert na_promotion_jenis failed');

			$id_jenis = $this->db->insert_id();
		}

		$this->id = $id_jenis;
	}

	function insert_weekly()
	{
		$id_jenis = $this->input->post('id') ? $this->input->post('id') : NULL;

		$this->db->select('1');
		$this->db->from('na_promotion_jenis');
		$this->db->where('id_jenis', $id_jenis);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			//
		}
		else
		{
			$this->db->select('p.tahun, p.bulan, p.minggu');
			$this->db->from('ja_penjualan_tanggal p');
			$this->db->where('p.tanggal', date('Y-m-d'));
			$rs = $this->db->get()->row_array();

			$tahun = $rs['tahun'] ? $rs['tahun'] : 0;
			$bulan = $rs['bulan'] ? $rs['bulan'] : 0;
			$minggu = $rs['minggu'] ? $rs['minggu'] : 0;

			$data_x = array(
				'tahun' => $tahun,
				'bulan' => $bulan,
				'minggu' => $minggu,
				'id_jenis' => $this->id
			);

			$this->db->insert('nb_promotion_jenis_weekly', $data_x);
			$this->check_trans_status('insert nb_promotion_jenis_weekly failed');
		}
	}

	function save_detail()
	{
		$this->insert_program();
		$this->insert_weekly();
	}

	function cek_exist()
	{
		$id = $this->input->post('id') ? $this->input->post('id') : NULL;

		if($id != NULL)
		{
			$this->db->select('COUNT(id_jenis) AS data_exists');
			$this->db->from('na_promotion_jenis');
			$this->db->where('id_jenis', $this->input->post('id'));
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
}
?>