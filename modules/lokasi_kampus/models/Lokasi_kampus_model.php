<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi_kampus_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}


	var $fieldmap_daftar_1 = array('no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_order_1 = array(null, 'no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_search_1 = array('no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch');

	function build_query_daftar_1()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'OPEN');
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'OPEN');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'OPEN');
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'OPEN');
			$this->db->where('km.id_tap', $id_divisi);
		}
	}

	var $fieldmap_daftar_2 = array('no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_order_2 = array(null, 'no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_search_2 = array('no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch');

	function build_query_daftar_2()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'WAITING APPROVAL');
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'WAITING APPROVAL');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'WAITING APPROVAL');
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'WAITING APPROVAL');
			$this->db->where('km.id_tap', $id_divisi);
		}
	}

	var $fieldmap_daftar_3 = array('no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_order_3 = array(null, 'no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_search_3 = array('no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch');

	function build_query_daftar_3()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'REJECTED');
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'REJECTED');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'REJECTED');
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'REJECTED');
			$this->db->where('km.id_tap', $id_divisi);
		}
	}

	var $fieldmap_daftar_4 = array('no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch', 'tgl_close');
	var $column_order_4 = array(null, 'no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch', 'tgl_close');
	var $column_search_4 = array('no_npsn', 'nama_universitas', 'nama_kecamatan', 'nama_cluster', 'nama_branch', 'tgl_close');

	function build_query_daftar_4()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
				, km.tgl_close
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'CLOSE');
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
				, km.tgl_close
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'CLOSE');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
				, km.tgl_close
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'CLOSE');
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				km.id_universitas
				, km.no_npsn
				, km.nama_universitas
				, kc.nama_kecamatan
				, cl.nama_cluster
				, br.nama_branch
				, km.longitude
				, km.latitude
				, km.tgl_close
			');
			$this->db->from('ed_kampus km');
			$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(km.status)', 'CLOSE');
			$this->db->where('km.id_tap', $id_divisi);
		}
	}

	var $fieldmap_daftar_5 = array('tanggal', 'jam_clock_in', 'jam_clock_out', 'durasi', 'status', 'nama_sales');
	var $column_order_5 = array('tanggal', 'jam_clock_in', 'jam_clock_out', 'durasi', 'status', 'nama_sales');
	var $column_search_5 = array('tanggal', 'jam_clock_in', 'jam_clock_out', 'durasi', 'status', 'nama_sales');

	function build_query_daftar_5()
	{
		$id_lokasi = $this->input->post('id_lokasi') ? $this->input->post('id_lokasi') : 0;

		$this->db->select('
			xx.id_history_pjp
			, xx.tanggal
			, xx.jam_clock_in
			, xx.jam_clock_out
			, xx.durasi
			, xx.status
			, xx.nama_sales
		');
		$this->db->from('
			(
				SELECT
						hp.id_history_pjp
						, DATE_FORMAT(hp.tanggal, "%d/%m/%Y") AS tanggal
						, hp.jam_clock_in
						, IF(hp.jam_clock_out = "00:00:00", "", hp.jam_clock_out) AS jam_clock_out
						, IF(hp.jam_clock_out = "00:00:00", 0, FORMAT(((TIME_TO_SEC(hp.jam_clock_out) - TIME_TO_SEC(hp.jam_clock_in)) / 60), 0)) AS durasi
						, hp.status
						, sl.nama_sales
				FROM
						fb_histroy_pjp hp
						INNER JOIN db_sales sl
								ON (hp.id_sales = sl.id_sales)
				WHERE (hp.id_tempat = "'.$id_lokasi.'"
						AND UPPER(hp.id_jenis_lokasi) = "KAM")
			) xx
		');
	}

	var $fieldmap_daftar_6 = array('tanggal', 'nama_sales', 'total_perdana', 'total_voucher');
	var $column_order_6 = array(null, 'tanggal', 'nama_sales', 'total_perdana', 'total_voucher');
	var $column_search_6 = array('tanggal', 'nama_sales', 'total_perdana', 'total_voucher');

	function build_query_daftar_6()
	{
		$id_lokasi = $this->input->post('id_lokasi') ? $this->input->post('id_lokasi') : 0;

		$this->db->select('
			xx.tanggal
			, xx.tgl_transaksi
			, xx.id_sales
			, xx.nama_sales
			, xx.total
			, xx.total_perdana
			, xx.total_voucher
		');
		$this->db->from('
			(
				SELECT
						DATE_FORMAT(p.tgl_transaksi, "%d/%m/%Y") AS tanggal
						, p.tgl_transaksi
						, p.id_sales
						, sl.nama_sales
						, (SUM(p.link_aja) + SUM(pd.harga_jual)) AS total
						, (
									SELECT
											COUNT(xpjd.id_penjualan_detail)
									FROM
											jc_penjualan xpj
											INNER JOIN jd_penjualan_detail xpjd
													ON (xpj.no_nota = xpjd.no_nota)
											INNER JOIN gb_produk xp
													ON (xpjd.id_produk = xp.id_produk)
									WHERE (xpj.id_lokasi = "'.$id_lokasi.'"
											AND UPPER(xpj.id_jenis_lokasi) = "KAM"
											AND xpj.id_sales = p.id_sales
											AND xpj.tgl_transaksi = p.tgl_transaksi
											AND xp.id_jenis_produk IN ("SGPREPAID", "SGOTA", "SGVIN", "SGVGS", "SGVGG", "SGVGP"))
							) AS total_perdana
						, (
									SELECT
											COUNT(xpjd.id_penjualan_detail)
									FROM
											jc_penjualan xpj
											INNER JOIN jd_penjualan_detail xpjd
													ON (xpj.no_nota = xpjd.no_nota)
											INNER JOIN gb_produk xp
													ON (xpjd.id_produk = xp.id_produk)
									WHERE (xpj.id_lokasi = "'.$id_lokasi.'"
											AND UPPER(xpj.id_jenis_lokasi) = "KAM"
											AND xpj.id_sales = p.id_sales
											AND xpj.tgl_transaksi = p.tgl_transaksi
											AND xp.id_jenis_produk IN ("INSAC", "INVIN", "INVGA"))
							) AS total_voucher
				FROM
						jd_penjualan_detail pd
						INNER JOIN jc_penjualan p
								ON (pd.no_nota = p.no_nota)
						INNER JOIN db_sales sl
								ON (p.id_sales = sl.id_sales)
				WHERE (p.id_lokasi = "'.$id_lokasi.'"
						AND UPPER(p.id_jenis_lokasi) = "KAM")
				GROUP BY p.tgl_transaksi, p.id_sales
			) xx
		');
	}

	var $fieldmap_daftar_7 = array('tanggal', 'nama_sales', 'total_perdana', 'total_voucher_fisik', 'total_spanduk', 'total_poster', 'total_papan_nama', 'total_backdrop');
	var $column_order_7 = array(null, 'tanggal', 'nama_sales', 'total_perdana', 'total_voucher_fisik', 'total_spanduk', 'total_poster', 'total_papan_nama', 'total_backdrop');
	var $column_search_7 = array('tanggal', 'nama_sales', 'total_perdana', 'total_voucher_fisik', 'total_spanduk', 'total_poster', 'total_papan_nama', 'total_backdrop');

	function build_query_daftar_7()
	{
		$id_lokasi = $this->input->post('id_lokasi') ? $this->input->post('id_lokasi') : 0;

		$this->db->select('
			xx.tgl
			, xx.tanggal
			, xx.id_sales
			, xx.nama_sales
			, xx.total_perdana
			, xx.total_voucher_fisik
			, xx.total_spanduk
			, xx.total_poster
			, xx.total_papan_nama
			, xx.total_backdrop
		');
		$this->db->distinct();
		$this->db->from('
			(
				SELECT DISTINCT
						m.tgl
						, DATE_FORMAT(m.tgl, "%d/%m/%Y") AS tanggal
						, m.created_by AS id_sales
						, sl.nama_sales
						, (
								ROUND((((
									SELECT
											COALESCE(SUM(xo.telkomsel), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "PERDANA"
											AND xo.created_by = m.created_by)
								) /
								(
									SELECT
											COALESCE(SUM(xo.total), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "PERDANA"
											AND xo.created_by = m.created_by)
								)) * 100), 2)
							) AS total_perdana
						, (
								ROUND((((
									SELECT
											COALESCE(SUM(xo.telkomsel), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "VOUCHER_FISIK"
											AND xo.created_by = m.created_by)
								) /
								(
									SELECT
											COALESCE(SUM(xo.total), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "VOUCHER_FISIK"
											AND xo.created_by = m.created_by)
								)) * 100), 2)
							) AS total_voucher_fisik
						, (
								ROUND((((
									SELECT
											COALESCE(SUM(xo.telkomsel), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "SPANDUK"
											AND xo.created_by = m.created_by)
								) /
								(
									SELECT
											COALESCE(SUM(xo.total), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "SPANDUK"
											AND xo.created_by = m.created_by)
								)) * 100), 2)
							) AS total_spanduk
						, (
								ROUND((((
									SELECT
											COALESCE(SUM(xo.telkomsel), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "POSTER"
											AND xo.created_by = m.created_by)
								) /
								(
									SELECT
											COALESCE(SUM(xo.total), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "POSTER"
											AND xo.created_by = m.created_by)
								)) * 100), 2)
							) AS total_poster
						, (
								ROUND((((
									SELECT
											COALESCE(SUM(xo.telkomsel), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "PAPAN_NAMA"
											AND xo.created_by = m.created_by)
								) /
								(
									SELECT
											COALESCE(SUM(xo.total), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "PAPAN_NAMA"
											AND xo.created_by = m.created_by)
								)) * 100), 2)
							) AS total_papan_nama
						, (
								ROUND((((
									SELECT
											COALESCE(SUM(xo.telkomsel), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "BACKDROP"
											AND xo.created_by = m.created_by)
								) /
								(
									SELECT
											COALESCE(SUM(xo.total), 0)
									FROM
											md_merchandising_kampus xo
									WHERE (xo.tgl = m.tgl
											AND xo.id_universitas = m.id_universitas
											AND UPPER(xo.id_jenis_share) = "BACKDROP"
											AND xo.created_by = m.created_by)
								)) * 100), 2)
							) AS total_backdrop
				FROM
						md_merchandising_kampus m
						INNER JOIN db_sales sl
								ON (m.created_by = sl.id_sales)
				WHERE (m.id_universitas = "'.$id_lokasi.'")
			) xx
		');
	}

	var $fieldmap_daftar_8 = array('tanggal', 'nama_sales', 'jml_promotion');
	var $column_order_8 = array(null, 'tanggal', 'nama_sales', 'jml_promotion');
	var $column_search_8 = array('tanggal', 'nama_sales', 'jml_promotion');

	function build_query_daftar_8()
	{
		$id_lokasi = $this->input->post('id_lokasi') ? $this->input->post('id_lokasi') : 0;

		$this->db->select('
			xx.tgl
			, xx.tanggal
			, xx.id_sales
			, xx.nama_sales
			, xx.jml_promotion
		');
		$this->db->from('
			(
				SELECT
						p.tgl
						, DATE_FORMAT(p.tgl, "%d/%m/%Y") AS tanggal
						, p.created_by AS id_sales
						, sl.nama_sales
						, COUNT(p.id_jenis_weekly) AS jml_promotion
				FROM
						ne_promotion_kampus p
						INNER JOIN db_sales sl
								ON (p.created_by = sl.id_sales)
				WHERE (p.id_universitas = "'.$id_lokasi.'")
				GROUP BY p.tgl, id_sales, sl.nama_sales
			) xx
		');
	}

	function build_query_form($id=NULL)
	{
		$this->db->select('
			km.id_kelurahan
			, kl.nama_kelurahan
			, kl.id_kecamatan
			, kc.nama_kecamatan
			, kc.id_kabupaten
			, kb.nama_kabupaten
			, kb.id_provinsi
			, pr.nama_provinsi
			, km.id_tap
			, tp.nama_tap
			, tp.id_cluster
			, cl.nama_cluster
			, cl.id_branch
			, br.nama_branch
			, km.id_universitas
			, km.no_npsn
			, km.nama_universitas
			, km.alamat_universitas
			, km.longitude
			, km.latitude
			, km.status
			, km.nama_rektor
			, km.no_hp_rektor
			, km.tgl_lahir_rektor
			, km.hobi_rektor
			, km.akun_fb_rektor
			, km.akun_ig_rektor
			, km.nama_pic
			, km.no_hp_pic
			, km.tgl_lahir_pic
			, km.hobi_pic
			, km.akun_fb_pic
			, km.akun_ig_pic
			, km.tgl_open
			, km.tgl_close
			, km.tgl_waiting
			, km.tgl_approval
			, km.created_by
			, km.approval_by
			, km.lastmodified
		');
		$this->db->from('ed_kampus km');
		$this->db->join('cd_kelurahan kl', 'km.id_kelurahan = kl.id_kelurahan');
		$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
		$this->db->join('cb_kabupaten kb', 'kl.id_kecamatan = kc.id_kecamatan');
		$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
		$this->db->join('bd_tap tp', 'km.id_tap = tp.id_tap');
		$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
		$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
		$this->db->where('km.id_universitas', $id);
	}

	function build_query_hapus($id=NULL)
	{
		$this->db->where('id_universitas', $id);
		$this->db->delete('ed_kampus');
		$this->check_trans_status('delete ed_kampus failed');
	}

	function insert_lokasi()
	{
		$id_universitas = $this->input->post('id') ? $this->input->post('id') : NULL;

		$this->db->select('1');
		$this->db->from('ed_kampus');
		$this->db->where('id_universitas', $id_universitas);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$status = $this->input->post('status') ? $this->input->post('status') : NULL;

			if ($status == 'CLOSE')
			{
				$data_x = array(
					'id_kelurahan' => $this->input->post('id_kel') ? $this->input->post('id_kel') : NULL,
					'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
					'no_npsn' => $this->input->post('npsn') ? $this->input->post('npsn') : NULL,
					'nama_universitas' => $this->input->post('nm_universitas') ? $this->input->post('nm_universitas') : NULL,
					'alamat_universitas' => $this->input->post('alamat') ? $this->input->post('alamat') : NULL,
					'longitude' => $this->input->post('longitude') ? $this->input->post('longitude') : NULL,
					'latitude' => $this->input->post('latitude') ? $this->input->post('latitude') : NULL,
					'status' => $this->input->post('status') ? $this->input->post('status') : NULL,
					'nama_rektor' => $this->input->post('nm_owner') ? $this->input->post('nm_owner') : NULL,
					'no_hp_rektor' => $this->input->post('no_hp_owner') ? $this->input->post('no_hp_owner') : NULL,
					'tgl_lahir_rektor' => $this->input->post('tgl_lahir_owner') ? prepare_date($this->input->post('tgl_lahir_owner')) : NULL,
					'hobi_rektor' => $this->input->post('hobi_owner') ? $this->input->post('hobi_owner') : NULL,
					'akun_fb_rektor' => $this->input->post('akun_fb_owner') ? $this->input->post('akun_fb_owner') : NULL,
					'akun_ig_rektor' => $this->input->post('akun_ig_owner') ? $this->input->post('akun_ig_owner') : NULL,
					'nama_pic' => $this->input->post('nm_pic') ? $this->input->post('nm_pic') : NULL,
					'no_hp_pic' => $this->input->post('no_hp_pic') ? $this->input->post('no_hp_pic') : NULL,
					'tgl_lahir_pic' => $this->input->post('tgl_lahir_pic') ? prepare_date($this->input->post('tgl_lahir_pic')) : NULL,
					'hobi_pic' => $this->input->post('hobi_pic') ? $this->input->post('hobi_pic') : NULL,
					'akun_fb_pic' => $this->input->post('akun_fb_pic') ? $this->input->post('akun_fb_pic') : NULL,
					'akun_ig_pic' => $this->input->post('akun_ig_pic') ? $this->input->post('akun_ig_pic') : NULL,
					'tgl_close' => $this->input->post('tgl_close') ? prepare_date($this->input->post('tgl_close')) : NULL
				);
			}
			else
			{
				$data_x = array(
					'id_kelurahan' => $this->input->post('id_kel') ? $this->input->post('id_kel') : NULL,
					'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
					'no_npsn' => $this->input->post('npsn') ? $this->input->post('npsn') : NULL,
					'nama_universitas' => $this->input->post('nm_universitas') ? $this->input->post('nm_universitas') : NULL,
					'alamat_universitas' => $this->input->post('alamat') ? $this->input->post('alamat') : NULL,
					'longitude' => $this->input->post('longitude') ? $this->input->post('longitude') : NULL,
					'latitude' => $this->input->post('latitude') ? $this->input->post('latitude') : NULL,
					'status' => $this->input->post('status') ? $this->input->post('status') : NULL,
					'nama_rektor' => $this->input->post('nm_owner') ? $this->input->post('nm_owner') : NULL,
					'no_hp_rektor' => $this->input->post('no_hp_owner') ? $this->input->post('no_hp_owner') : NULL,
					'tgl_lahir_rektor' => $this->input->post('tgl_lahir_owner') ? prepare_date($this->input->post('tgl_lahir_owner')) : NULL,
					'hobi_rektor' => $this->input->post('hobi_owner') ? $this->input->post('hobi_owner') : NULL,
					'akun_fb_rektor' => $this->input->post('akun_fb_owner') ? $this->input->post('akun_fb_owner') : NULL,
					'akun_ig_rektor' => $this->input->post('akun_ig_owner') ? $this->input->post('akun_ig_owner') : NULL,
					'nama_pic' => $this->input->post('nm_pic') ? $this->input->post('nm_pic') : NULL,
					'no_hp_pic' => $this->input->post('no_hp_pic') ? $this->input->post('no_hp_pic') : NULL,
					'tgl_lahir_pic' => $this->input->post('tgl_lahir_pic') ? prepare_date($this->input->post('tgl_lahir_pic')) : NULL,
					'hobi_pic' => $this->input->post('hobi_pic') ? $this->input->post('hobi_pic') : NULL,
					'akun_fb_pic' => $this->input->post('akun_fb_pic') ? $this->input->post('akun_fb_pic') : NULL,
					'akun_ig_pic' => $this->input->post('akun_ig_pic') ? $this->input->post('akun_ig_pic') : NULL
				);
			}

			$this->db->where('id_universitas', $id_universitas);
			$this->db->update('ed_kampus', $data_x);
			$this->check_trans_status('update ed_kampus failed');
		}
		else
		{
			$data_x = array(
				'id_kelurahan' => $this->input->post('id_kel') ? $this->input->post('id_kel') : NULL,
				'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
				'no_npsn' => $this->input->post('npsn') ? $this->input->post('npsn') : NULL,
				'nama_universitas' => $this->input->post('nm_universitas') ? $this->input->post('nm_universitas') : NULL,
				'alamat_universitas' => $this->input->post('alamat') ? $this->input->post('alamat') : NULL,
				'longitude' => $this->input->post('longitude') ? $this->input->post('longitude') : NULL,
				'latitude' => $this->input->post('latitude') ? $this->input->post('latitude') : NULL,
				'status' => $this->input->post('status') ? $this->input->post('status') : NULL,
				'nama_rektor' => $this->input->post('nm_owner') ? $this->input->post('nm_owner') : NULL,
				'no_hp_rektor' => $this->input->post('no_hp_owner') ? $this->input->post('no_hp_owner') : NULL,
				'tgl_lahir_rektor' => $this->input->post('tgl_lahir_owner') ? prepare_date($this->input->post('tgl_lahir_owner')) : NULL,
				'hobi_rektor' => $this->input->post('hobi_owner') ? $this->input->post('hobi_owner') : NULL,
				'akun_fb_rektor' => $this->input->post('akun_fb_owner') ? $this->input->post('akun_fb_owner') : NULL,
				'akun_ig_rektor' => $this->input->post('akun_ig_owner') ? $this->input->post('akun_ig_owner') : NULL,
				'nama_pic' => $this->input->post('nm_pic') ? $this->input->post('nm_pic') : NULL,
				'no_hp_pic' => $this->input->post('no_hp_pic') ? $this->input->post('no_hp_pic') : NULL,
				'tgl_lahir_pic' => $this->input->post('tgl_lahir_pic') ? prepare_date($this->input->post('tgl_lahir_pic')) : NULL,
				'hobi_pic' => $this->input->post('hobi_pic') ? $this->input->post('hobi_pic') : NULL,
				'akun_fb_pic' => $this->input->post('akun_fb_pic') ? $this->input->post('akun_fb_pic') : NULL,
				'akun_ig_pic' => $this->input->post('akun_ig_pic') ? $this->input->post('akun_ig_pic') : NULL,
				'tgl_open' => $this->input->post('tgl_open') ? prepare_date($this->input->post('tgl_open')) : NULL
			);

			$this->db->insert('ed_kampus', $data_x);
			$this->check_trans_status('insert ed_kampus failed');
		}
	}

	function save_detail()
	{
		$this->insert_lokasi();
	}

	function cek_exist()
	{
		$id = $this->input->post('id') ? $this->input->post('id') : NULL;

		if($id != NULL)
		{
			$this->db->select('COUNT(id_universitas) AS data_exists');
			$this->db->from('ed_kampus');
			$this->db->where('id_universitas', $this->input->post('id'));
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
		$this->db->select('
			(SELECT COUNT(b.id_universitas) FROM ee_fakultas b WHERE b.id_universitas = a.id_universitas) AS fakultas_pakai
		');
		$this->db->where('a.id_universitas', $id);
		$result = $this->db->get('ed_kampus a')->row_array();

		return !(
			$result['fakultas_pakai'] > 0
		);
	}

	function get_data_promotion($id)
  {
    $this->db->select('hp.*');
		$this->db->from('fb_histroy_pjp hp');
		$this->db->where('hp.id_history_pjp', $id);
    $result = $this->db->get()->row_array();

    return $result;
  }

	function save_data_reject()
  {
    $this->db->trans_begin();
    try {

			$id_universitas = $this->input->post('id_universitas') ? $this->input->post('id_universitas') : NULL;

			$this->db->select('1');
			$this->db->from('ed_kampus');
			$this->db->where('id_universitas', $id_universitas);
			$rs = $this->db->get()->row_array();

			if ($rs)
			{
				$data_x = array(
					'status' => 'REJECTED',
					'tgl_approval' => date('Y-m-d'),
					'approval_by' => $this->session->userdata('ID_USER')
				);

				$this->db->where('id_universitas', $id_universitas);
				$this->db->update('ed_kampus', $data_x);
				$this->check_trans_status('update ed_kampus failed');
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

	function save_data_approved()
  {
    $this->db->trans_begin();
    try {

			$id_universitas = $this->input->post('id_universitas') ? $this->input->post('id_universitas') : NULL;
			$no_npsn = $this->input->post('no_npsn') ? $this->input->post('no_npsn') : NULL;

			$this->db->select('1');
			$this->db->from('ed_kampus');
			$this->db->where('id_universitas', $id_universitas);
			$rs = $this->db->get()->row_array();

			if ($rs)
			{
				$data_x = array(
					'no_npsn' => $no_npsn,
					'status' => 'OPEN',
					'tgl_open' => date('Y-m-d'),
					'tgl_approval' => date('Y-m-d'),
					'approval_by' => $this->session->userdata('ID_USER')
				);

				$this->db->where('id_universitas', $id_universitas);
				$this->db->update('ed_kampus', $data_x);
				$this->check_trans_status('update ed_kampus failed');
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

	function get_list_distribusi($tgl, $id_sales, $id_lokasi, $jns_produk)
	{
		$this->db->select('pjd.serial_number');
    $this->db->from('jc_penjualan pj');
    $this->db->join('jd_penjualan_detail pjd', 'pj.no_nota = pjd.no_nota');
    $this->db->join('gb_produk p', 'pjd.id_produk = p.id_produk');
		$this->db->where('pj.id_sales', $id_sales);
		$this->db->where('UPPER(pj.id_jenis_lokasi)', 'OUT');
		$this->db->where('pj.id_lokasi', $id_lokasi);
		$this->db->where('pj.tgl_transaksi', $tgl);

		if ($jns_produk == 'voucher') { $this->db->where_in('p.id_jenis_produk', array("INSAC", "INVIN", "INVGA")); }
		if ($jns_produk == 'perdana') { $this->db->where_in('p.id_jenis_produk', array("SGPREPAID", "SGOTA", "SGVIN", "SGVGS", "SGVGG", "SGVGP")); }

		$query = $this->db->get();

		return $query->result();
	}

	function get_data_merchandising()
	{
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : NULL;
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$id_lokasi = $this->input->post('id_lokasi') ? $this->input->post('id_lokasi') : NULL;
		$id_jns_share = $this->input->post('id_jns_share') ? $this->input->post('id_jns_share') : NULL;

		$this->db->select('m.*');
		$this->db->from('md_merchandising_kampus m');
		$this->db->where('m.tgl', $tgl);
		$this->db->where('m.id_universitas', $id_lokasi);
		$this->db->where('m.id_jenis_share', $id_jns_share);
		$this->db->where('m.created_by', $id_sales);

    $result = $this->db->get();

    return $result->row_array();
	}

	function get_list_promotion($tgl, $id_sales, $id_lokasi)
	{
		$this->db->select('
			p.id_jenis_weekly
			, pjw.id_jenis
			, p.nama_jenis
			, p.id_promotion
			, p.file_video
		');
    $this->db->from('ne_promotion_kampus p');
    $this->db->join('nb_promotion_jenis_weekly pjw', 'p.id_jenis_weekly = pjw.id_jenis_weekly');
    $this->db->join('na_promotion_jenis pj', 'pjw.id_jenis = pj.id_jenis');
		$this->db->where('p.id_universitas', $id_lokasi);
		$this->db->where('p.created_by', $id_sales);
		$this->db->where('p.tgl', $tgl);

		$query = $this->db->get();

		return $query->result();
	}

	function get_data_merchandising_res($tgl, $id_lokasi, $id_jns_share, $id_sales)
	{
		$this->db->select('
			m.id_merchandising
			, k.no_npsn
			, k.nama_universitas
			, m.tgl
			, s.nama_sales
			, js.nama_jenis_share
			, m.telkomsel
			, m.isat
			, m.xl
			, m.tri
			, m.smartfren
			, m.axis
			, m.other
			, m.total
			, ROUND(((m.telkomsel / m.total) * 100), 2) AS persen_telkomsel
			, ROUND(((m.isat / m.total) * 100), 2) AS persen_isat
			, ROUND(((m.xl / m.total) * 100), 2) AS persen_xl
			, ROUND(((m.tri / m.total) * 100), 2) AS persen_tri
			, ROUND(((m.smartfren / m.total) * 100), 2) AS persen_smartfren
			, ROUND(((m.axis / m.total) * 100), 2) AS persen_axis
			, ROUND(((m.other / m.total) * 100), 2) AS persen_other
			, ROUND(((m.total / m.total) * 100), 2) AS persen_total
		');
		$this->db->from('md_merchandising_kampus m');
		$this->db->join('ma_merchandisng_jenis_share js', 'm.id_jenis_share = js.id_jenis_share');
		$this->db->join('ed_kampus k', 'm.id_universitas = k.id_universitas');
		$this->db->join('db_sales s', 'm.created_by = s.id_sales');
		$this->db->where('m.tgl', $tgl);
		$this->db->where('m.id_universitas', $id_lokasi);
		$this->db->where('m.id_jenis_share', $id_jns_share);
		$this->db->where('m.created_by', $id_sales);

    $result = $this->db->get();

    return $result->row_array();
	}
}
?>