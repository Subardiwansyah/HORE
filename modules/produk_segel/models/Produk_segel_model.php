<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_segel_model extends Base_Model {

	var $fieldmap_daftar = array('kode_produk', 'nama_produk', 'nama_jenis_produk', 'harga_modal', 'harga_bandrol');
	var $column_order = array(null, 'kode_produk', 'nama_produk', 'nama_jenis_produk', 'harga_modal', 'harga_bandrol');
	var $column_search = array('kode_produk', 'nama_produk', 'nama_jenis_produk', 'harga_modal', 'harga_bandrol');

	function __construct()
	{
		parent::__construct();
	}

	function build_query_daftar()
	{
		$this->db->select('
			p.id_jenis_produk
			, j.nama_jenis_produk
			, p.id_produk
			, p.kode_produk
			, p.nama_produk
			, p.harga_modal
			, p.harga_bandrol
		');
		$this->db->from('gb_produk p');
		$this->db->join('ga_jenis_produk j', 'p.id_jenis_produk = j.id_jenis_produk');
		$this->db->where('j.kategori_produk', 'SEGEL');
	}

	function build_query_form($id=NULL)
	{
		$this->db->select('
			p.id_jenis_produk
			, j.nama_jenis_produk
			, p.id_produk
			, p.kode_produk
			, p.nama_produk
			, p.harga_modal
			, p.harga_bandrol
		');
		$this->db->from('gb_produk p');
		$this->db->join('ga_jenis_produk j', 'p.id_jenis_produk = j.id_jenis_produk');
		$this->db->where('p.id_produk', $id);
	}

	function build_query_hapus($id=NULL)
	{
		$this->db->where('id_produk', $id);
		$this->db->delete('gb_produk');
		$this->check_trans_status('delete gb_produk failed');
	}

	function insert_produk()
	{
		$id_produk = $this->input->post('id') ? $this->input->post('id') : NULL;

		$this->db->select('1');
		$this->db->from('gb_produk');
		$this->db->where('id_produk', $id_produk);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$data_x = array(
				'id_jenis_produk' => $this->input->post('id_jns_produk') ? $this->input->post('id_jns_produk') : NULL,
				'kode_produk' => $this->input->post('kd_produk') ? $this->input->post('kd_produk') : NULL,
				'nama_produk' => $this->input->post('nm_produk') ? $this->input->post('nm_produk') : NULL,
				'harga_modal' => $this->input->post('harga_modal') ? prepare_currency($this->input->post('harga_modal')) : 0,
				'harga_bandrol' => $this->input->post('harga_bandrol') ? prepare_currency($this->input->post('harga_bandrol')) : 0
			);

			$this->db->where('id_produk', $id_produk);
			$this->db->update('gb_produk', $data_x);
			$this->check_trans_status('update gb_produk failed');
		}
		else
		{
			$data_x = array(
				'id_jenis_produk' => $this->input->post('id_jns_produk') ? $this->input->post('id_jns_produk') : NULL,
				'kode_produk' => $this->input->post('kd_produk') ? $this->input->post('kd_produk') : NULL,
				'nama_produk' => $this->input->post('nm_produk') ? $this->input->post('nm_produk') : NULL,
				'harga_modal' => $this->input->post('harga_modal') ? prepare_currency($this->input->post('harga_modal')) : 0,
				'harga_bandrol' => $this->input->post('harga_bandrol') ? prepare_currency($this->input->post('harga_bandrol')) : 0
			);

			$this->db->insert('gb_produk', $data_x);
			$this->check_trans_status('insert gb_produk failed');
		}
	}

	function save_detail()
	{
		$this->insert_produk();
	}

	function cek_exist()
	{
		$id = $this->input->post('id') ? $this->input->post('id') : NULL;

		if($id != NULL)
		{
			$this->db->select('COUNT(id_produk) AS data_exists');
			$this->db->from('gb_produk');
			$this->db->where('id_produk', $this->input->post('id'));
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
		$result = TRUE;

		$mode = $this->input->post('id') ? 'Edit' : 'New';
		$id = $this->input->post('id_produk') ? $this->input->post('id_produk') : 0;
		$kode = $this->input->post('kd_produk') ? $this->input->post('kd_produk') : NULL;

		if ($mode == 'New')
		{
			$this->db->select('COUNT(id_produk) AS dup');
			$this->db->from('gb_produk');
			$this->db->where('id_produk <> ', $id);
			$this->db->where('kode_produk', $kode);
			$result = $this->db->get()->row_array();

			if ($result && $result['dup'] > 0)
			{
				$result = FALSE;
			}
			else
			{
				$result = TRUE;
			}
		}

		return $result;
	}

	function check_dependency($id)
	{
		$this->db->select('
			(SELECT COUNT(b.id_gudang) FROM ha_gudang b WHERE b.id_produk_segel = a.id_produk) AS gudang_segel_pakai
		');
		$this->db->where('a.id_produk', $id);
		$result = $this->db->get('gb_produk a')->row_array();

		return !(
			$result['gudang_segel_pakai'] > 0
		);
	}
}
?>