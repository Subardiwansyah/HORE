<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_report_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	var $fieldmap_daftar = array('nama_sales', 'nama_produk', 'barang_rusak', 'penumpukan_stock');
	var $column_order = array(null, 'nama_sales', 'nama_produk', 'barang_rusak', 'penumpukan_stock');
	var $column_search = array('nama_sales', 'nama_produk', 'barang_rusak', 'penumpukan_stock');

	function build_query_daftar()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			xx.id_sales
			, xx.nama_sales
			, xx.id_produk
			, xx.kode_produk
			, xx.nama_produk
			, xx.barang_rusak
			, xx.penumpukan_stock
		');
		$this->db->from('
			(
					SELECT DISTINCT
							r.id_sales
							, s.nama_sales
							, r.id_produk
							, p.kode_produk
							, p.nama_produk
							, (
										SELECT
												COUNT(xr.id_retur)
										FROM
												ic_retur_sales xr
										WHERE (xr.id_sales = r.id_sales
												AND xr.id_produk = r.id_produk
												AND xr.alasan = 1
												AND xr.status = "APPROVED")
								) AS barang_rusak
							, (
										SELECT
												COUNT(xr.id_retur)
										FROM
												ic_retur_sales xr
										WHERE (xr.id_sales = r.id_sales
												AND xr.id_produk = r.id_produk
												AND xr.alasan = 2
												AND xr.status = "APPROVED")
								) AS penumpukan_stock
					FROM
							ic_retur_sales r
							INNER JOIN db_sales s
									ON (r.id_sales = s.id_sales)
							INNER JOIN gb_produk p
									ON (r.id_produk = p.id_produk)
					WHERE (s.id_tap = "'.$id_divisi.'"
							AND r.status = "APPROVED")
			) xx
		');
	}
}
?>