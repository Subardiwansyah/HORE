<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_setoran_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	var $fieldmap_daftar = array('id_sales', 'nama_sales', 'nama_tap', 'nama_cluster', 'penjualan', '(xx.penjualan - xx.belum_bayar)', 'belum_bayar');
	var $column_order = array(null, 'id_sales', 'nama_sales', 'nama_tap', 'nama_cluster', 'penjualan', '(xx.penjualan - xx.belum_bayar)', 'belum_bayar');
	var $column_search = array('id_sales', 'nama_sales', 'nama_tap', 'nama_cluster', 'penjualan', '(xx.penjualan - xx.belum_bayar)', 'belum_bayar');

	function build_query_daftar()
	{
		$bulan = $this->input->post('bulan') ? strlen($this->input->post('bulan')) == 1 ? '0'.$this->input->post('bulan') : $this->input->post('bulan') : date('m');
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');

		$this->db->select('
			xx.id_sales
			, xx.nama_sales
			, xx.nama_tap
			, xx.nama_cluster
			, xx.penjualan
			, (xx.penjualan - xx.belum_bayar) AS sudah_bayar
			, xx.belum_bayar
		');
		$this->db->from('
			(
				SELECT
						p.id_sales
						, s.nama_sales
						, t.nama_tap
						, c.nama_cluster
						, COUNT(p.no_nota) AS penjualan
						, (
					SELECT
							COUNT(xpj.no_nota)
					FROM
							jc_penjualan xpj
					WHERE DATE_FORMAT(xpj.tgl_transaksi, "%Y") = "'.$tahun.'"
							AND DATE_FORMAT(xpj.tgl_transaksi, "%m") = "'.$bulan.'"
							AND xpj.id_sales = p.id_sales
							AND (xpj.link_aja + (SELECT SUM(xpjd.harga_jual) FROM jd_penjualan_detail xpjd WHERE xpjd.no_nota = xpj.no_nota)) <> xpj.setoran
						) AS belum_bayar
				FROM
						jc_penjualan p
						INNER JOIN db_sales s
								ON (p.id_sales = s.id_sales)
						INNER JOIN bd_tap t
								ON (s.id_tap = t.id_tap)
						INNER JOIN bc_cluster c
								ON (t.id_cluster = c.id_cluster)
				WHERE (DATE_FORMAT(p.tgl_transaksi, "%Y") = "'.$tahun.'"
					 AND DATE_FORMAT(p.tgl_transaksi, "%m") = "'.$bulan.'")
				GROUP BY p.id_sales, s.nama_sales, t.nama_tap, c.nama_cluster
			) xx
		');
	}

	function get_list_nota($id_sales, $tahun, $bulan)
	{
		$this->db->select('
			xx.no_nota
			, xx.nama_sales
			, xx.tgl_transaksi
			, xx.nama_lokasi
			, xx.nama_pembeli
			, xx.no_hp_pembeli
			, xx.pembayaran
			, xx.link_aja
			, xx.perdana
			, (xx.link_aja + xx.perdana) AS total
			, xx.setoran
			, (xx.link_aja + xx.perdana) - xx.setoran AS sisa
		');
    $this->db->from('
			(
				SELECT
						p.no_nota
						, s.nama_sales
						, p.tgl_transaksi
						, p.nama_pembeli
						, p.no_hp_pembeli
						, p.pembayaran
						, p.link_aja
						, (SELECT SUM(xpd.harga_jual) FROM jd_penjualan_detail xpd WHERE xpd.no_nota = p.no_nota) AS perdana
						, CASE p.id_jenis_lokasi
									WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = p.id_lokasi))
									WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = p.id_lokasi))
									WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = p.id_lokasi))
									WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = p.id_lokasi))
									WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = p.id_lokasi))
									ELSE NULL
							END AS nama_lokasi
						, p.setoran
				FROM
						jc_penjualan p
						INNER JOIN db_sales s
								ON (p.id_sales = s.id_sales)
				WHERE DATE_FORMAT(p.tgl_transaksi, "%Y") = "'.$tahun.'"
						AND DATE_FORMAT(p.tgl_transaksi, "%m") = "'.$bulan.'"
						AND p.id_sales = "'.$id_sales.'"
						AND (p.link_aja + (SELECT SUM(pd.harga_jual) FROM jd_penjualan_detail pd WHERE pd.no_nota = p.no_nota)) <> p.setoran
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_sales($id_sales)
	{
		$this->db->select('*');
		$this->db->from('db_sales');
		$this->db->where('id_sales', $id_sales);

		$result = $this->db->get()->row_array();

    return $result;
	}
}
?>