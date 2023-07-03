<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_penjualan_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_data_distribusi()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$tgl = $this->input->post('tgl') ? prepare_date($this->input->post('tgl')) : date('Y-m-d');

		$this->db->select('
			xx.lunas
			, xx.konsinyasi
			, xx.total
			, xx.link_aja
		');
		$this->db->from('
			(
				SELECT
							(
									SELECT
											COALESCE(SUM(xpd.harga_jual), 0)
									FROM
											jd_penjualan_detail xpd
											INNER JOIN jc_penjualan xp
													ON (xpd.no_nota = xp.no_nota)
									WHERE (xp.id_sales = p.id_sales
											AND xp.tgl_transaksi = p.tgl_transaksi
											AND xp.pembayaran = "LUNAS")
							) AS lunas
						, (
									SELECT
											COALESCE(SUM(xpd.harga_jual), 0)
									FROM
											jd_penjualan_detail xpd
											INNER JOIN jc_penjualan xp
													ON (xpd.no_nota = xp.no_nota)
									WHERE (xp.id_sales = p.id_sales
											AND xp.tgl_transaksi = p.tgl_transaksi
											AND xp.pembayaran = "KONSINYASI")
								) AS konsinyasi
							, (
									SELECT
											COALESCE(SUM(xpd.harga_jual), 0)
									FROM
											jd_penjualan_detail xpd
											INNER JOIN jc_penjualan xp
													ON (xpd.no_nota = xp.no_nota)
									WHERE (xp.id_sales = p.id_sales
											AND xp.tgl_transaksi = p.tgl_transaksi)
								) AS total
							, COALESCE(SUM(p.link_aja), 0) AS link_aja
				FROM
						jc_penjualan p
				WHERE (p.id_sales = "'.$id_sales.'"
						AND p.tgl_transaksi = "'.$tgl.'")
			) xx
		');

    $result = $this->db->get();

    return $result->row_array();
	}

	function get_daftar_penjualan($id_sales, $tgl)
	{
		$this->db->select('
			xx.no_nota
			, xx.tgl_transaksi
			, xx.pembayaran
			, xx.total_perdana
			, xx.total_linkaja
			, xx.total_penjualan
			, xx.setoran
		');
		$this->db->from('
			(
				SELECT
						p.no_nota
						, p.tgl_transaksi
						, p.pembayaran
						, COALESCE(SUM(pd.harga_jual), 0) AS total_perdana
						, p.link_aja AS total_linkaja
						, COALESCE(SUM(pd.harga_jual), 0) + p.link_aja AS total_penjualan
						, p.setoran
				FROM
						jd_penjualan_detail pd
						INNER JOIN jc_penjualan p
								ON (pd.no_nota = p.no_nota)
				WHERE (p.tgl_transaksi = "'.$tgl.'"
						AND p.id_sales = "'.$id_sales.'")
				GROUP BY p.no_nota, p.tgl_transaksi, p.pembayaran
			) xx
		');
		$result = $this->db->get();

		return $result->result();
	}

	function save_data()
  {
    $this->db->trans_begin();
    try {

			$total_data = $this->input->post('total_data') ? $this->input->post('total_data') : 0;

			for($i=0; $i<=$total_data; $i++)
			{
				$id = $this->input->post('id_'.$i) ? $this->input->post('id_'.$i) : 0;
				$setoran = $this->input->post('setoran_'.$i) ? prepare_currency($this->input->post('setoran_'.$i)) : 0;

				$data_x = array(
					'setoran' => $setoran
				);

				$this->db->where('no_nota', $id);
				$this->db->update('jc_penjualan', $data_x);
				$this->check_trans_status('update jc_penjualan failed');
			}

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

	function get_data_penjualan($nota=0)
	{
		$this->db->select('
			pj.no_nota
			, sl.nama_sales
			, DATE_FORMAT(pj.tgl_transaksi, "%d/%m/%Y") AS tanggal
			, jl.nama_jenis_lokasi
			, CASE pj.id_jenis_lokasi
						WHEN "OUT" THEN (SELECT a.nama_outlet FROM eb_outlet a WHERE (a.id_outlet = pj.id_lokasi))
						WHEN "SEK" THEN (SELECT a.nama_sekolah FROM ec_sekolah a WHERE (a.id_sekolah = pj.id_lokasi))
						WHEN "KAM" THEN (SELECT a.nama_universitas FROM ed_kampus a WHERE (a.id_universitas = pj.id_lokasi))
						WHEN "FAK" THEN (SELECT a.nama_fakultas FROM ee_fakultas a WHERE (a.id_fakultas = pj.id_lokasi))
						WHEN "POI" THEN (SELECT a.nama_poi FROM ef_poi a WHERE (a.id_poi = pj.id_lokasi))
						ELSE NULL
				END AS nama_lokasi
			, pj.nama_pembeli
			, pj.no_hp_pembeli
			, pj.pembayaran
			, pj.link_aja
		');
    $this->db->from('jc_penjualan pj');
    $this->db->join('db_sales sl', 'pj.id_sales = sl.id_sales');
    $this->db->join('ea_jenis_lokasi jl', 'pj.id_jenis_lokasi = jl.id_jenis_lokasi');
    $this->db->where('pj.no_nota', $nota);
		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_penjualan($id=0)
	{
		$this->db->select('
			pd.nama_produk
			, pjd.harga_jual
			, COUNT(pjd.id_penjualan_detail) AS jml_jual
			, (pjd.harga_jual * COUNT(pjd.id_penjualan_detail)) AS total
		');
    $this->db->from('jd_penjualan_detail pjd');
    $this->db->join('gb_produk pd', 'pjd.id_produk = pd.id_produk');
		$this->db->where('pjd.no_nota', $id);
		$this->db->group_by('pd.nama_produk, pjd.harga_jual');

		$result = $this->db->get();

		return $result->result();
	}

	function get_list_penjualan_perdana()
	{
		$id = $this->input->post('id') ? strtoupper($this->input->post('id')) : 0;
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
						pd.id_produk
						, p.nama_produk
						, COUNT(pd.id_penjualan_detail) AS qty
						, (
									SELECT
											GROUP_CONCAT(xpd.serial_number SEPARATOR ',')
									FROM
											jd_penjualan_detail xpd
									WHERE (xpd.no_nota = pd.no_nota
											AND xpd.serial_number LIKE '%".$sn."%')
							) AS serial_number
				FROM
						jd_penjualan_detail pd
						INNER JOIN gb_produk p
								ON (pd.id_produk = p.id_produk)
				WHERE (pd.no_nota = '".$id."'
					AND (UPPER(pd.id_produk) LIKE '%".$produk."%' OR UPPER(p.nama_produk) LIKE '%".$produk."%')
					AND UPPER(pd.serial_number) LIKE '%".$sn."%')
			) xx
		");

		$result = $this->db->get()->result_array();

		return $result;
	}
}
?>