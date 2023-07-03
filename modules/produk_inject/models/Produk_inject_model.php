<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_inject_model extends Base_Model {

	var $fieldmap_daftar = array('kode_produk', 'nama_produk', 'nama_kabupaten', 'nama_zona', 'total_kuota', 'harga_paket');
	var $column_order = array(null, 'kode_produk', 'nama_produk', 'nama_kabupaten', 'nama_zona', 'total_kuota', 'harga_paket');
	var $column_search = array('kode_produk', 'nama_produk', 'nama_kabupaten', 'nama_zona', 'total_kuota', 'harga_paket');

	function __construct()
	{
		parent::__construct();
	}

	function build_query_daftar()
	{
		$this->db->select('
			p.id_kabupaten
			, kb.nama_kabupaten
			, p.id_zona
			, z.nama_zona
			, p.id_jenis_produk
			, jp.nama_jenis_produk
			, p.id_jenis_inject
			, ji.nama_jenis_inject
			, p.id_produk
			, p.kode_produk
			, p.nama_produk
			, p.total_kuota
			, p.harga_paket
		');
		$this->db->from('gb_produk p');
		$this->db->join('ga_jenis_produk jp', 'p.id_jenis_produk = jp.id_jenis_produk');
		$this->db->join('cb_kabupaten kb', 'p.id_kabupaten = kb.id_kabupaten');
		$this->db->join('gc_zona z', 'p.id_zona = z.id_zona');
		$this->db->join('gd_jenis_inject ji', 'p.id_jenis_inject = ji.id_jenis_inject');
	}

	function build_query_form($id=NULL)
	{
		$this->db->select('
			p.id_kabupaten
			, kb.nama_kabupaten
			, p.id_zona
			, z.nama_zona
			, p.id_jenis_produk
			, jp.nama_jenis_produk
			, p.id_jenis_inject
			, ji.nama_jenis_inject
			, p.id_produk
			, p.kode_produk
			, p.nama_produk
			, p.total_kuota
			, p.harga_paket
			, p.keterangan
		');
		$this->db->from('gb_produk p');
		$this->db->join('ga_jenis_produk jp', 'p.id_jenis_produk = jp.id_jenis_produk');
		$this->db->join('cb_kabupaten kb', 'p.id_kabupaten = kb.id_kabupaten');
		$this->db->join('gc_zona z', 'p.id_zona = z.id_zona');
		$this->db->join('gd_jenis_inject ji', 'p.id_jenis_inject = ji.id_jenis_inject');
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
				'id_kabupaten' => $this->input->post('id_kabupaten') ? $this->input->post('id_kabupaten') : NULL,
				'id_zona' => $this->input->post('id_zona') ? $this->input->post('id_zona') : NULL,
				'id_jenis_produk' => $this->input->post('id_jns_produk') ? $this->input->post('id_jns_produk') : NULL,
				'id_jenis_inject' => $this->input->post('id_jns_inject') ? $this->input->post('id_jns_inject') : NULL,
				'nama_produk' => $this->input->post('nm_produk') ? $this->input->post('nm_produk') : NULL,
				'kode_produk' => $this->input->post('kd_produk') ? $this->input->post('kd_produk') : NULL,
				'total_kuota' => $this->input->post('total_kuota') ? prepare_integer($this->input->post('total_kuota')) : 0,
				'harga_paket' => $this->input->post('harga_paket') ? prepare_currency($this->input->post('harga_paket')) : 0,
				'keterangan' => $this->input->post('keterangan') ? $this->input->post('keterangan') : NULL
			);

			$this->db->where('id_produk', $id_produk);
			$this->db->update('gb_produk', $data_x);
			$this->check_trans_status('update gb_produk failed');
		}
		else
		{
			$data_x = array(
				'id_kabupaten' => $this->input->post('id_kabupaten') ? $this->input->post('id_kabupaten') : NULL,
				'id_zona' => $this->input->post('id_zona') ? $this->input->post('id_zona') : NULL,
				'id_jenis_produk' => $this->input->post('id_jns_produk') ? $this->input->post('id_jns_produk') : NULL,
				'id_jenis_inject' => $this->input->post('id_jns_inject') ? $this->input->post('id_jns_inject') : NULL,
				'kode_produk' => $this->input->post('kd_produk') ? $this->input->post('kd_produk') : NULL,
				'nama_produk' => $this->input->post('nm_produk') ? $this->input->post('nm_produk') : NULL,
				'total_kuota' => $this->input->post('total_kuota') ? prepare_integer($this->input->post('total_kuota')) : 0,
				'harga_paket' => $this->input->post('harga_paket') ? prepare_currency($this->input->post('harga_paket')) : 0,
				'keterangan' => $this->input->post('keterangan') ? $this->input->post('keterangan') : NULL
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
		$id_produk = $this->input->post('id_produk') ? $this->input->post('id_produk') : 0;

		if ($mode == 'New')
		{
			$this->db->select('COUNT(id_produk) AS dup');
			$this->db->from('gb_produk');
			$this->db->where('id_produk', $id_produk);
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
			(SELECT COUNT(b.id_gudang) FROM ha_gudang b WHERE b.id_produk_segel = a.id_produk) AS gudang_segel_pakai,
			(SELECT COUNT(b.id_gudang) FROM ha_gudang b WHERE b.id_produk_inject = a.id_produk) AS gudang_inject_pakai
		');
		$this->db->where('a.id_produk', $id);
		$result = $this->db->get('gb_produk a')->row_array();

		return !(
			$result['gudang_segel_pakai'] > 0 ||
			$result['gudang_inject_pakai'] > 0
		);
	}
}
?>