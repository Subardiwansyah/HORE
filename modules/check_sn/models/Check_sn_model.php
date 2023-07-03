<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_sn_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_data_gudang_segel()
	{
		$serial_number = $this->input->post('serial_number') ? $this->input->post('serial_number') : NULL;

		$this->db->select('
			DATE_FORMAT(g.tgl_sn_dibentuk, "%d/%m/%Y") AS tgl
			, p.nama_produk
			, g.harga_modal_branch AS harga_modal
			, g.harga_bandrol_branch AS harga_bandrol
			, b.nama_branch
			, c.nama_cluster
		');
		$this->db->from('ha_gudang g');
		$this->db->join('gb_produk p', 'g.id_produk_segel = p.id_produk');
		$this->db->join('bc_cluster c', 'g.id_cluster = c.id_cluster');
		$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
		$this->db->where('g.serial_number', $serial_number);

    $result = $this->db->get();

    return $result->row_array();
	}

	function get_data_proses_inject()
	{
		$serial_number = $this->input->post('serial_number') ? $this->input->post('serial_number') : NULL;

		$this->db->select('
			DATE_FORMAT(g.tgl_inject, "%d/%m/%Y") AS tgl
			, p.nama_produk
			, t.nama_tap
			, g.modal_bulk
			, g.jml_bulk
			, g.total_modal
		');
		$this->db->from('ha_gudang g');
		$this->db->join('gb_produk p', 'g.id_produk_inject = p.id_produk');
		$this->db->join('bd_tap t', 'g.id_tap = t.id_tap');
		$this->db->where('g.serial_number', $serial_number);

    $result = $this->db->get();

    return $result->row_array();
	}

	function get_data_product_booking()
	{
		$serial_number = $this->input->post('serial_number') ? $this->input->post('serial_number') : NULL;

		$this->db->select('
			DATE_FORMAT(d.tgl_distribusi, "%d/%m/%Y") AS tgl
			, js.nama_jenis_sales
			, s.nama_sales
			, jp.nama_jenis_produk
			, d.harga_jual
		');
		$this->db->from('ia_distribusi_perdana d');
		$this->db->join('db_sales s', 'd.id_sales = s.id_sales');
		$this->db->join('gb_produk p', 'd.id_produk = p.id_produk');
		$this->db->join('da_jenis_sales js', 's.id_jenis_sales = js.id_jenis_sales');
		$this->db->join('ga_jenis_produk jp', 'p.id_jenis_produk = jp.id_jenis_produk');
		$this->db->where('d.serial_number', $serial_number);

    $result = $this->db->get();

    return $result->row_array();
	}

	function get_data_distribusi()
	{
		$serial_number = $this->input->post('serial_number') ? $this->input->post('serial_number') : NULL;

		$this->db->select('
			DATE_FORMAT(p.tgl_transaksi, "%d/%m/%Y") AS tgl
			, p.id_jenis_lokasi
			, p.id_lokasi
			, CASE
						WHEN UPPER(p.id_jenis_lokasi) = "OUT" THEN (SELECT nama_outlet FROM eb_outlet WHERE id_outlet = p.id_lokasi)
						WHEN UPPER(p.id_jenis_lokasi) = "SEK" THEN (SELECT nama_sekolah FROM ec_sekolah WHERE id_sekolah = p.id_lokasi)
						WHEN UPPER(p.id_jenis_lokasi) = "KAM" THEN (SELECT nama_universitas FROM ed_kampus WHERE id_universitas = p.id_lokasi)
						WHEN UPPER(p.id_jenis_lokasi) = "FAK" THEN (SELECT nama_fakultas FROM ee_fakultas WHERE id_fakultas = p.id_lokasi)
						ELSE (SELECT nama_poi FROM ef_poi WHERE id_poi = p.id_lokasi)
				END AS nama_lokasi
			, p.nama_pembeli
			, p.no_hp_pembeli
			, p.no_nota
		');
		$this->db->from('jd_penjualan_detail pd');
		$this->db->join('jc_penjualan p', 'pd.no_nota = p.no_nota');
		$this->db->where('pd.serial_number', $serial_number);

    $result = $this->db->get();

    return $result->row_array();
	}
}
?>