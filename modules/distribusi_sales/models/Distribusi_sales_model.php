<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribusi_sales_model extends Base_Model {

	var $fieldmap_daftar = array('id_sales', 'nama_sales', 'nama_jenis_sales', 'nama_tap', 'nama_cluster', 'qty_available');
	var $column_order = array(null, 'id_sales', 'nama_sales', 'nama_jenis_sales', 'nama_tap', 'nama_cluster', 'qty_available');
	var $column_search = array('id_sales', 'nama_sales', 'nama_jenis_sales', 'nama_tap', 'nama_cluster', 'qty_available');

	function __construct()
	{
		parent::__construct();
	}

	function build_query_daftar()
	{
		$this->db->select('
			xx.id_sales
			, xx.nama_sales
			, xx.nama_jenis_sales
			, xx.nama_tap
			, xx.nama_cluster
			, xx.qty_available
		');
		$this->db->from('
			(
				SELECT
						sl.id_sales
						, sl.nama_sales
						, js.nama_jenis_sales
						, tp.nama_tap
						, cl.nama_cluster
						, (
									SELECT
											COUNT(dp.id_distribusi)
									FROM
											ia_distribusi_perdana dp
									WHERE (dp.id_sales = sl.id_sales
											AND UPPER(dp.status_distribusi) = "AVAILABLE"
											AND UPPER(dp.status_penjualan) = "BELUM TERJUAL")
							) AS qty_available
				FROM
						db_sales sl
						INNER JOIN da_jenis_sales js
								ON (sl.id_jenis_sales = js.id_jenis_sales)
						INNER JOIN bd_tap tp
								ON (sl.id_tap = tp.id_tap)
						INNER JOIN bc_cluster cl
								ON (tp.id_cluster = cl.id_cluster)
				WHERE (UPPER(sl.status) = "AKTIF")
				ORDER BY js.nama_jenis_sales ASC, sl.nama_sales ASC
			) xx
		');
	}

	function get_list_produk_available()
	{
		$sales = $this->input->post('sales') ? strtoupper($this->input->post('sales')) : 0;
		$produk = $this->input->post('produk') ? strtoupper($this->input->post('produk')) : NULL;
		$sn = $this->input->post('sn') ? strtoupper($this->input->post('sn')) : NULL;

		$this->db->select('
			xx.id_produk
			, xx.nama_produk
			, xx.qty
			, xx.serial_number
		');
		$this->db->from("
			(
				SELECT DISTINCT
						dp.id_produk
						, pd.nama_produk
						, (
									SELECT
											COUNT(xdp.id_distribusi) AS qty
									FROM
											ia_distribusi_perdana xdp
									WHERE (xdp.id_sales = '".$sales."'
											AND xdp.id_produk = dp.id_produk
											AND xdp.status_distribusi = 'AVAILABLE'
											AND xdp.status_penjualan = 'BELUM TERJUAL')
							) AS qty
						, (
									SELECT
											GROUP_CONCAT(xdp.serial_number SEPARATOR ',')
									FROM
											ia_distribusi_perdana xdp
									WHERE (xdp.serial_number LIKE '%".$sn."%'
											AND UPPER(xdp.id_sales) = '".$sales."'
											AND xdp.id_produk = dp.id_produk
											AND UPPER(xdp.status_distribusi) = 'AVAILABLE'
											AND UPPER(xdp.status_penjualan) = 'BELUM TERJUAL')
							) AS serial_number
				FROM
						ia_distribusi_perdana dp
						INNER JOIN gb_produk pd
								ON (dp.id_produk = pd.id_produk)
				WHERE (UPPER(dp.id_sales) = '".$sales."'
						AND (UPPER(dp.id_produk) LIKE '%".$produk."%' OR UPPER(pd.nama_produk) LIKE '%".$produk."%')
						AND UPPER(dp.serial_number) LIKE '%".$sn."%'
						AND UPPER(dp.status_distribusi) = 'AVAILABLE'
						AND UPPER(dp.status_penjualan) = 'BELUM TERJUAL')
			) xx
		");

		$result = $this->db->get()->result_array();

		return $result;
	}
}
?>