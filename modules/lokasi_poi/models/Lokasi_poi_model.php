<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi_poi_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	var $fieldmap_daftar_1 = array('nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_order_1 = array(null, 'nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_search_1 = array('nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch');

	function build_query_daftar_1()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'OPEN');
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'OPEN');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'OPEN');
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'OPEN');
			$this->db->where('po.id_tap', $id_divisi);
		}
	}

	var $fieldmap_daftar_2 = array('nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_order_2 = array(null, 'nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_search_2 = array('nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch');

	function build_query_daftar_2()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'WAITING APPROVAL');
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'WAITING APPROVAL');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'WAITING APPROVAL');
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'WAITING APPROVAL');
			$this->db->where('po.id_tap', $id_divisi);
		}
	}

	var $fieldmap_daftar_3 = array('nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_order_3 = array(null, 'nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch');
	var $column_search_3 = array('nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch');

	function build_query_daftar_3()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'REJECTED');
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'REJECTED');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'REJECTED');
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'REJECTED');
			$this->db->where('po.id_tap', $id_divisi);
		}
	}

	var $fieldmap_daftar_4 = array('nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch', 'tgl_close');
	var $column_order_4 = array(null, 'nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch', 'tgl_close');
	var $column_search_4 = array('nama_poi', 'nama_kecamatan', 'nama_cluster', 'nama_branch', 'tgl_close');

	function build_query_daftar_4()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
				, po.tgl_close
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'CLOSE');
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
				, po.tgl_close
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'CLOSE');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
				, po.tgl_close
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'CLOSE');
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				po.id_poi
				, po.nama_poi
				, kc.nama_kecamatan
				, po.longitude
				, po.latitude
				, cl.nama_cluster
				, br.nama_branch
				, po.tgl_close
			');
			$this->db->from('ef_poi po');
			$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->where('UPPER(po.status)', 'CLOSE');
			$this->db->where('po.id_tap', $id_divisi);
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
						AND UPPER(hp.id_jenis_lokasi) = "POI")
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
											AND UPPER(xpj.id_jenis_lokasi) = "POI"
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
											AND UPPER(xpj.id_jenis_lokasi) = "POI"
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
						AND UPPER(p.id_jenis_lokasi) = "POI")
				GROUP BY p.tgl_transaksi, p.id_sales
			) xx
		');
	}

	var $fieldmap_daftar_7 = array('tanggal', 'nama_sales');
	var $column_order_7 = array(null, 'tanggal', 'nama_sales');
	var $column_search_7 = array('tanggal', 'nama_sales');

	function build_query_daftar_7()
	{
		$id_lokasi = $this->input->post('id_lokasi') ? $this->input->post('id_lokasi') : 0;

		$this->db->select('
			xx.tgl
			, xx.tanggal
			, xx.id_sales
			, xx.nama_sales
		');
		$this->db->distinct();
		$this->db->from('
			(
				SELECT DISTINCT
						m.tgl
						, DATE_FORMAT(m.tgl, "%d/%m/%Y") AS tanggal
						, m.created_by AS id_sales
						, sl.nama_sales
				FROM
						mb_merchandising_outlet m
						INNER JOIN db_sales sl
								ON (m.created_by = sl.id_sales)
				WHERE (m.id_outlet = "'.$id_lokasi.'")
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
						nf_promotion_poi p
						INNER JOIN db_sales sl
								ON (p.created_by = sl.id_sales)
				WHERE (p.id_poi = "'.$id_lokasi.'")
				GROUP BY p.tgl, id_sales, sl.nama_sales
			) xx
		');
	}

	function build_query_form($id=NULL)
	{
		$this->db->select('
			po.id_kelurahan
			, kl.nama_kelurahan
			, kl.id_kecamatan
			, kc.nama_kecamatan
			, kc.id_kabupaten
			, kb.nama_kabupaten
			, kb.id_provinsi
			, pr.nama_provinsi
			, po.id_tap
			, tp.nama_tap
			, tp.id_cluster
			, cl.nama_cluster
			, cl.id_branch
			, br.nama_branch
			, po.id_poi
			, po.nama_poi
			, po.alamat_poi
			, po.longitude
			, po.latitude
			, po.status
			, po.tgl_open
			, po.tgl_close
			, po.tgl_waiting
			, po.tgl_approval
			, po.created_by
			, po.approval_by
			, po.lastmodified
		');
		$this->db->from('ef_poi po');
		$this->db->join('cd_kelurahan kl', 'po.id_kelurahan = kl.id_kelurahan');
		$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
		$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
		$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
		$this->db->join('bd_tap tp', 'po.id_tap = tp.id_tap');
		$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
		$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
		$this->db->where('po.id_poi', $id);
	}

	function build_query_hapus($id=NULL)
	{
		$this->db->where('id_poi', $id);
		$this->db->delete('ef_poi');
		$this->check_trans_status('delete ef_poi failed');
	}

	function insert_lokasi()
	{
		$id_poi = $this->input->post('id') ? $this->input->post('id') : NULL;

		$this->db->select('1');
		$this->db->from('ef_poi');
		$this->db->where('id_poi', $id_poi);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$status = $this->input->post('status') ? $this->input->post('status') : NULL;

			if ($status == 'CLOSE')
			{
				$data_x = array(
					'nama_poi' => $this->input->post('nm_poi') ? $this->input->post('nm_poi') : NULL,
					'id_kelurahan' => $this->input->post('id_kel') ? $this->input->post('id_kel') : NULL,
					'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
					'alamat_poi' => $this->input->post('alamat') ? $this->input->post('alamat') : NULL,
					'longitude' => $this->input->post('longitude') ? $this->input->post('longitude') : NULL,
					'latitude' => $this->input->post('latitude') ? $this->input->post('latitude') : NULL,
					'status' => $this->input->post('status') ? $this->input->post('status') : NULL,
					'tgl_close' => $this->input->post('tgl_close') ? prepare_date($this->input->post('tgl_close')) : NULL
				);
			}
			else
			{
				$data_x = array(
					'nama_poi' => $this->input->post('nm_poi') ? $this->input->post('nm_poi') : NULL,
					'id_kelurahan' => $this->input->post('id_kel') ? $this->input->post('id_kel') : NULL,
					'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
					'alamat_poi' => $this->input->post('alamat') ? $this->input->post('alamat') : NULL,
					'longitude' => $this->input->post('longitude') ? $this->input->post('longitude') : NULL,
					'latitude' => $this->input->post('latitude') ? $this->input->post('latitude') : NULL,
					'status' => $this->input->post('status') ? $this->input->post('status') : NULL
				);
			}

			$this->db->where('id_poi', $id_poi);
			$this->db->update('ef_poi', $data_x);
			$this->check_trans_status('update ef_poi failed');
		}
		else
		{
			$data_x = array(
				'nama_poi' => $this->input->post('nm_poi') ? $this->input->post('nm_poi') : NULL,
				'id_kelurahan' => $this->input->post('id_kel') ? $this->input->post('id_kel') : NULL,
				'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
				'alamat_poi' => $this->input->post('alamat') ? $this->input->post('alamat') : NULL,
				'longitude' => $this->input->post('longitude') ? $this->input->post('longitude') : NULL,
				'latitude' => $this->input->post('latitude') ? $this->input->post('latitude') : NULL,
				'status' => $this->input->post('status') ? $this->input->post('status') : NULL,
				'tgl_open' => $this->input->post('tgl_open') ? prepare_date($this->input->post('tgl_open')) : NULL
			);

			$this->db->insert('ef_poi', $data_x);
			$this->check_trans_status('insert ef_poi failed');
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
			$this->db->select('COUNT(id_poi) AS data_exists');
			$this->db->from('ef_poi');
			$this->db->where('id_poi', $this->input->post('id'));
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
		$id_poi = $this->input->post('id_poi') ? $this->input->post('id_poi') : 0;

		if ($mode == 'New')
		{
			$this->db->select('COUNT(id_poi) AS dup');
			$this->db->from('ef_poi');
			$this->db->where('id_poi', $id_poi);
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
			(SELECT COUNT(b.no_nota) FROM jc_penjualan b WHERE b.id_lokasi = a.id_outlet AND UPPER(b.id_jenis_lokasi) = "POI") AS penjualan_pakai
		');
		$this->db->where('a.id_outlet', $id);
		$result = $this->db->get('eb_outlet a')->row_array();

		return !(
			$result['penjualan_pakai'] > 0
		);
	}

	function save_data_reject()
  {
    $this->db->trans_begin();
    try {

			$id_poi = $this->input->post('id_poi') ? $this->input->post('id_poi') : NULL;

			$this->db->select('1');
			$this->db->from('ef_poi');
			$this->db->where('id_poi', $id_poi);
			$rs = $this->db->get()->row_array();

			if ($rs)
			{
				$data_x = array(
					'status' => 'REJECTED',
					'tgl_approval' => date('Y-m-d'),
					'approval_by' => $this->session->userdata('ID_USER')
				);

				$this->db->where('id_poi', $id_poi);
				$this->db->update('ef_poi', $data_x);
				$this->check_trans_status('update ef_poi failed');
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

			$id_poi = $this->input->post('id_poi') ? $this->input->post('id_poi') : NULL;

			$this->db->select('1');
			$this->db->from('ef_poi');
			$this->db->where('id_poi', $id_poi);
			$rs = $this->db->get()->row_array();

			if ($rs)
			{
				$data_x = array(
					'status' => 'OPEN',
					'tgl_open' => date('Y-m-d'),
					'tgl_approval' => date('Y-m-d'),
					'approval_by' => $this->session->userdata('ID_USER')
				);

				$this->db->where('id_poi', $id_poi);
				$this->db->update('ef_poi', $data_x);
				$this->check_trans_status('update ef_poi failed');
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
		$this->db->where('UPPER(pj.id_jenis_lokasi)', 'POI');
		$this->db->where('pj.id_lokasi', $id_lokasi);
		$this->db->where('pj.tgl_transaksi', $tgl);

		if ($jns_produk == 'voucher') { $this->db->where_in('p.id_jenis_produk', array("INSAC", "INVIN", "INVGA")); }
		if ($jns_produk == 'perdana') { $this->db->where_in('p.id_jenis_produk', array("SGPREPAID", "SGOTA", "SGVIN", "SGVGS", "SGVGG", "SGVGP")); }

		$query = $this->db->get();

		return $query->result();
	}

	function get_data_merchandising()
	{

	}

	function get_list_promotion($tgl=NULL, $id_sales=0, $id_lokasi=0)
	{
		$this->db->select('
			p.id_jenis_weekly
			, pjw.id_jenis
			, pj.nama_jenis
			, p.id_promotion
			, p.file_video
		');
    $this->db->from('nf_promotion_poi p');
    $this->db->join('nb_promotion_jenis_weekly pjw', 'p.id_jenis_weekly = pjw.id_jenis_weekly');
    $this->db->join('na_promotion_jenis pj', 'pjw.id_jenis = pj.id_jenis');
		$this->db->where('p.id_poi', $id_lokasi);
		$this->db->where('p.created_by', $id_sales);
		$this->db->where('p.tgl', $tgl);

		$query = $this->db->get();

		return $query->result();
	}
}
?>