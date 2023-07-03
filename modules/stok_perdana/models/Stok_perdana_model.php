<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_perdana_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_data_distribusi()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$tgl = $this->input->post('tgl') ? prepare_date($this->input->post('tgl')) : date('Y-m-d');

		$this->db->select('
			xx.total
			, xx.terjual
			, xx.belum_terjual
		');
		$this->db->from('
			(
				SELECT
						COUNT(d.id_distribusi) AS total
						, (
									SELECT
											COUNT(xpd.id_penjualan_detail) AS terjual
									FROM
											jd_penjualan_detail xpd
											INNER JOIN jc_penjualan xp
													ON (xpd.no_nota = xp.no_nota)
											INNER JOIN ia_distribusi_perdana xd
													ON (xpd.serial_number = xd.serial_number)
									WHERE (xp.tgl_transaksi = "'.$tgl.'"
											AND xd.status_distribusi = "AVAILABLE"
											AND xd.status_penjualan = "TERJUAL"
											AND xp.id_sales = d.id_sales)
							) AS terjual
						, (
									SELECT
											COUNT(xd.id_distribusi)
									FROM
											ia_distribusi_perdana xd
									WHERE (xd.id_sales = d.id_sales
											AND xd.status_distribusi = "AVAILABLE"
											AND xd.status_penjualan = "BELUM TERJUAL"
											AND xd.tgl_distribusi <= "'.$tgl.'")
							) AS belum_terjual
				FROM
						ia_distribusi_perdana d
				WHERE (d.id_sales = "'.$id_sales.'"
						AND d.tgl_distribusi <= "'.$tgl.'")
			) xx
		');

    $result = $this->db->get();

    return $result->row_array();
	}

	var $fieldmap_daftar_1 = array('serial_number', 'nama_produk', 'tgl_terjual', 'nama_pembeli');
	var $column_order_1 = array(null, 'serial_number', 'nama_produk', 'tgl_terjual', 'nama_pembeli');
	var $column_search_1 = array('serial_number', 'nama_produk', 'tgl_terjual', 'nama_pembeli');

	function build_query_daftar_1()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');

		$this->db->select('
			xx.serial_number
			, xx.kode_produk
			, xx.nama_produk
			, xx.tgl_terjual
			, xx.nama_pembeli
		');
		$this->db->from('
			(
				SELECT
						pjd.serial_number
						, p.kode_produk
						, p.nama_produk
						, pj.tgl_transaksi AS tgl_terjual
						, pj.nama_pembeli
				FROM
						jd_penjualan_detail pjd
						INNER JOIN jc_penjualan pj
								ON (pjd.no_nota = pj.no_nota)
						INNER JOIN ia_distribusi_perdana d
								ON (pjd.serial_number = d.serial_number)
						INNER JOIN gb_produk p
								ON (pjd.id_produk = p.id_produk)
				WHERE (pj.tgl_transaksi = "'.$tgl.'"
						AND pj.id_sales = "'.$id_sales.'"
						AND d.status_distribusi = "AVAILABLE"
						AND d.status_penjualan = "TERJUAL")
			) xx
		');
	}

	var $fieldmap_daftar_2 = array('serial_number', 'nama_produk');
	var $column_order_2 = array(null, 'serial_number', 'nama_produk');
	var $column_search_2 = array('serial_number', 'nama_produk');

	function build_query_daftar_2()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');

		$this->db->select('
			xx.serial_number
			, xx.kode_produk
			, xx.nama_produk
		');
		$this->db->from('
			(
				SELECT
						d.serial_number
						, p.kode_produk
						, p.nama_produk
				FROM
						ia_distribusi_perdana d
						INNER JOIN gb_produk p
								ON (d.id_produk = p.id_produk)
				WHERE (d.id_sales = "'.$id_sales.'"
						AND d.tgl_distribusi <= "'.$tgl.'"
						AND d.status_distribusi = "AVAILABLE"
						AND d.status_penjualan = "BELUM TERJUAL")
			) xx
		');
	}
}
?>