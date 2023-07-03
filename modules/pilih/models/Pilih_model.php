<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pilih_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_provinsi_inmaster($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('br.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('tp.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(pr.id_provinsi) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(pr.nama_provinsi) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_kabupaten_inmaster($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				kc.id_kabupaten
				, kb.nama_kabupaten
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kb.id_provinsi', $param['id_provinsi']);
			$this->db->where('br.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				kc.id_kabupaten
				, kb.nama_kabupaten
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kb.id_provinsi', $param['id_provinsi']);
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				kc.id_kabupaten
				, kb.nama_kabupaten
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kb.id_provinsi', $param['id_provinsi']);
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				kc.id_kabupaten
				, kb.nama_kabupaten
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kb.id_provinsi', $param['id_provinsi']);
			$this->db->where('tp.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(kb.id_kabupaten) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(kb.nama_kabupaten) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_kecamatan_inmaster($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				kc.id_kecamatan
				, kc.nama_kecamatan
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kc.id_kabupaten', $param['id_kab']);
			$this->db->where('br.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				kc.id_kecamatan
				, kc.nama_kecamatan
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kc.id_kabupaten', $param['id_kab']);
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				kc.id_kecamatan
				, kc.nama_kecamatan
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kc.id_kabupaten', $param['id_kab']);
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				kc.id_kecamatan
				, kc.nama_kecamatan
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kc.id_kabupaten', $param['id_kab']);
			$this->db->where('tp.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(kc.id_kecamatan) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(kc.nama_kecamatan) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_kelurahan_inmaster($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				kl.id_kelurahan
				, kl.nama_kelurahan
			');
			$this->db->from('cd_kelurahan kl');
			$this->db->where('kl.id_kecamatan', $param['id_kec']);
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				kl.id_kelurahan
				, kl.nama_kelurahan
			');
			$this->db->distinct();
			$this->db->from('cd_kelurahan kl');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->where('kl.id_kecamatan', $param['id_kec']);
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				kl.id_kelurahan
				, kl.nama_kelurahan
			');
			$this->db->distinct();
			$this->db->from('cd_kelurahan kl');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->where('kl.id_kecamatan', $param['id_kec']);
			$this->db->where('kc.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('a.id_cluster');
			$this->db->from('bd_tap a');
			$this->db->where('a.id_tap', $id_divisi);
			$rs = $this->db->get()->row_array();
			$id_cluster = isset($rs['id_cluster']) ? $rs['id_cluster'] : '';

			$this->db->select('
				kl.id_kelurahan
				, kl.nama_kelurahan
			');
			$this->db->distinct();
			$this->db->from('cd_kelurahan kl');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->where('kl.id_kecamatan', $param['id_kec']);
			$this->db->where('kc.id_cluster', $id_cluster);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(kl.id_kelurahan) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(kl.nama_kelurahan) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_tahun_inmaster($param)
	{
		$this->db->distinct();
		$this->db->select('tahun_real AS tahun');
		$this->db->from('ja_penjualan_tanggal');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(tahun) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_periode_indasbhoard($param)
	{
		$this->db->select('
			xx.tahun
			, xx.bulan
			, xx.periode
		');
		$this->db->from('
			(
				SELECT
						p.tahun_real AS tahun
						, p.bulan_real AS bulan
						, CONCAT(DATE_FORMAT(CONCAT(p.tahun_real, "-", p.bulan_real, "-", "01"), "%b"), "-", p.tahun_real) AS periode
				FROM
						ja_penjualan_tanggal p
				GROUP BY p.tahun_real, p.bulan_real
				ORDER BY CONCAT(p.tahun_real, (IF(LENGTH(p.bulan_real) = 1, CONCAT("0", p.bulan_real), p.bulan_real))) ASC
			) xx
		');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.periode) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_periodekuartal($param)
	{
		$this->db->select('
			xx.tahun
			, xx.bulan
			, xx.kuartal
		');
		$this->db->from('
			(
				(
						SELECT
								p.tahun_real AS tahun
								, "01-03" AS bulan
								, CONCAT(p.tahun_real, " - Q1") AS kuartal
						FROM
								ja_penjualan_tanggal p
						WHERE bulan_real BETWEEN 1 AND 3
						GROUP BY p.tahun_real
						ORDER BY CONCAT(p.tahun_real, (IF(LENGTH(p.bulan_real) = 1, CONCAT("0", p.bulan_real), p.bulan_real))) ASC
				)

				UNION ALL

				(
						SELECT
								p.tahun_real AS tahun
								, "04-06" AS bulan
								, CONCAT(p.tahun_real, " - Q2") AS kuartal
						FROM
								ja_penjualan_tanggal p
						WHERE bulan_real BETWEEN 4 AND 6
						GROUP BY p.tahun_real
						ORDER BY CONCAT(p.tahun_real, (IF(LENGTH(p.bulan_real) = 1, CONCAT("0", p.bulan_real), p.bulan_real))) ASC
				)

				UNION ALL

				(
						SELECT
								p.tahun_real AS tahun
								, "07-09" AS bulan
								, CONCAT(p.tahun_real, " - Q3") AS kuartal
						FROM
								ja_penjualan_tanggal p
						WHERE bulan_real BETWEEN 7 AND 9
						GROUP BY p.tahun_real
						ORDER BY CONCAT(p.tahun_real, (IF(LENGTH(p.bulan_real) = 1, CONCAT("0", p.bulan_real), p.bulan_real))) ASC
				)

				UNION ALL

				(
						SELECT
								p.tahun_real AS tahun
								, "10-12" AS bulan
								, CONCAT(p.tahun_real, " - Q4") AS kuartal
						FROM
								ja_penjualan_tanggal p
						WHERE bulan_real BETWEEN 10 AND 12
						GROUP BY p.tahun_real
						ORDER BY CONCAT(p.tahun_real, (IF(LENGTH(p.bulan_real) = 1, CONCAT("0", p.bulan_real), p.bulan_real))) ASC
				)
			) xx
		');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.periode) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_pilihan_indashboard($param)
	{
		$kategori = $param['kategori'] ? $param['kategori'] : '';
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			if ($kategori == 'Branch')
			{
				$this->db->select('
					xx.id
					, xx.nama
				');
				$this->db->from('
					(
						(
							SELECT "-" AS id, "All Branch" AS nama
						)

						UNION ALL

						(
							SELECT
									b.id_branch AS id
									, b.nama_branch AS nama
							FROM
									bb_branch b
						)
					) xx
				');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(xx.nama) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('xx.nama', 'asc');
			}
			else if ($kategori == 'Cluster')
			{
				$this->db->select('
					c.id_cluster AS id
					, c.nama_cluster AS nama
				');
				$this->db->from('bc_cluster c');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(c.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('c.nama_cluster', 'asc');
			}
			else if ($kategori == 'TAP')
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
			else // Menangani error saat dropdown kategori belum dipilih tapi user langsung pilih dropdown filter
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');
				$this->db->where('t.id_tap', 'XYZ123456789');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
		}
		elseif ($id_level == 2) // Branch
		{
			if ($kategori == 'Branch')
			{
				$this->db->select('
					b.id_branch AS id
					, b.nama_branch AS nama
				');
				$this->db->from('bb_branch b');
				$this->db->where('b.id_branch', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(b.nama_branch) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('b.nama_branch', 'asc');
			}
			else if ($kategori == 'Cluster')
			{
				$this->db->select('
					c.id_cluster AS id
					, c.nama_cluster AS nama
				');
				$this->db->from('bc_cluster c');
				$this->db->where('c.id_branch', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(c.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('c.nama_cluster', 'asc');
			}
			else if ($kategori == 'TAP')
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');
				$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
				$this->db->where('c.id_branch', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
			else // Menangani error saat dropdown kategori belum dipilih tapi user langsung pilih dropdown filter
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');
				$this->db->where('t.id_tap', 'XYZ123456789');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
		}
		elseif ($id_level == 3) // Cluster
		{
			if ($kategori == 'Cluster')
			{
				$this->db->select('
					c.id_cluster AS id
					, c.nama_cluster AS nama
				');
				$this->db->from('bc_cluster c');
				$this->db->where('c.id_cluster', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(c.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('c.nama_cluster', 'asc');
			}
			else if ($kategori == 'TAP')
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');
				$this->db->where('t.id_cluster', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
			else // Menangani error saat dropdown kategori belum dipilih tapi user langsung pilih dropdown filter
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');
				$this->db->where('t.id_tap', 'XYZ123456789');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
		}
		elseif ($id_level == 4) // TAP
		{
			if ($kategori == 'TAP')
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');
				$this->db->where('t.id_tap', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
			else // Menangani error saat dropdown kategori belum dipilih tapi user langsung pilih dropdown filter
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');
				$this->db->where('t.id_tap', 'XYZ123456789');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_branch_inmaster($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.id_branch
				, xx.nama_branch
			');
			$this->db->from('
				(
					SELECT
							b.id_branch
							, b.nama_branch
					FROM
							bb_branch b
				) xx
			');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.id_branch
				, xx.nama_branch
			');
			$this->db->from('
				(
					SELECT
							b.id_branch
							, b.nama_branch
					FROM
							bb_branch b
					WHERE (b.id_branch = "'.$id_divisi.'")
				) xx
			');
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.id_branch
				, xx.nama_branch
			');
			$this->db->from('
				(
					SELECT
							c.id_branch
							, b.nama_branch
					FROM
							bc_cluster c
							INNER JOIN bb_branch b
									ON (c.id_branch = b.id_branch)
					WHERE (c.id_cluster = "'.$id_divisi.'")
				) xx
			');
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.id_branch
				, xx.nama_branch
			');
			$this->db->from('
				(
					SELECT
							c.id_branch
							, b.nama_branch
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
							INNER JOIN bb_branch b
									ON (c.id_branch = b.id_branch)
					WHERE (t.id_tap = "'.$id_divisi.'")
				) xx
			');
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.id_branch) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(xx.nama_branch) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('xx.id_branch', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_cluster_inmaster($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.id_cluster
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							c.id_cluster
							, c.nama_cluster
					FROM
							bc_cluster c
				) xx
			');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.id_cluster
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							c.id_cluster
							, c.nama_cluster
					FROM
							bc_cluster c
					WHERE (c.id_branch = "'.$id_divisi.'")
				) xx
			');
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.id_cluster
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							c.id_cluster
							, c.nama_cluster
					FROM
							bc_cluster c
					WHERE (c.id_cluster = "'.$id_divisi.'")
				) xx
			');
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.id_cluster
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							t.id_cluster
							, c.nama_cluster
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (t.id_tap = "'.$id_divisi.'")
				) xx
			');
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.id_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(xx.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('xx.id_cluster', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_cluster_inbranch($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.id_cluster
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							c.id_cluster
							, c.nama_cluster
					FROM
							bc_cluster c
					WHERE c.id_branch = "'.$param['id_branch'].'"
				) xx
			');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.id_cluster
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							c.id_cluster
							, c.nama_cluster
					FROM
							bc_cluster c
					WHERE (c.id_branch = "'.$id_divisi.'"
							AND c.id_branch = "'.$param['id_branch'].'")
				) xx
			');
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.id_cluster
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							c.id_cluster
							, c.nama_cluster
					FROM
							bc_cluster c
					WHERE (c.id_cluster = "'.$id_divisi.'"
							AND c.id_branch = "'.$param['id_branch'].'")
				) xx
			');
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				xx.id_cluster
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							t.id_cluster
							, c.nama_cluster
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (t.id_tap = "'.$id_divisi.'"
							AND c.id_branch = "'.$param['id_branch'].'")
				) xx
			');
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.id_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(xx.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('xx.id_cluster', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_tap_inmaster($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							t.id_tap
							, t.nama_tap
							, c.nama_cluster
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
				)
			');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							t.id_tap
							, t.nama_tap
							, c.nama_cluster
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (c.id_branch = "'.$id_divisi.'")
				) xx
			');
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							t.id_tap
							, t.nama_tap
							, c.nama_cluster
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (t.id_cluster = "'.$id_divisi.'")
				) xx
			');
		}
		else if ($id_level == 4) // Tap
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
				, xx.nama_cluster
			');
			$this->db->from('
				(
					SELECT
							t.id_tap
							, t.nama_tap
							, c.nama_cluster
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (t.id_tap = "'.$id_divisi.'")
				) xx
			');
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.id_tap) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(xx.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('xx.id_tap', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_tap_incluster($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
			');
			$this->db->from('
				(
					SELECT
							t.id_tap
							, t.nama_tap
					FROM
							bd_tap t
					WHERE (t.id_cluster = "'.$param['id_cluster'].'")
				) xx
			');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
			');
			$this->db->from('
				(
					SELECT
							t.id_tap
							, t.nama_tap
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
					WHERE (t.id_cluster = "'.$param['id_cluster'].'"
							AND c.id_branch = "'.$id_divisi.'")
				) xx
			');
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
			');
			$this->db->from('
				(
					SELECT
							t.id_tap
							, t.nama_tap
					FROM
							bd_tap t
					WHERE (t.id_cluster = "'.$param['id_cluster'].'"
							AND t.id_cluster = "'.$id_divisi.'")
				) xx
			');
		}
		else if ($id_level == 4) // Tap
		{
			$this->db->select('
				xx.id_tap
				, xx.nama_tap
			');
			$this->db->from('
				(
					SELECT
							t.id_tap
							, t.nama_tap
					FROM
							bd_tap t
					WHERE (t.id_cluster = "'.$param['id_cluster'].'"
							AND t.id_tap = "'.$id_divisi.'")
				) xx
			');
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.id_tap) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(xx.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('xx.id_tap', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_bct_inmarketaudit($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$kategori = $param['kategori'] ? $param['kategori'] : '';

		if ($id_level == 1) // Regional
		{
			if ($kategori == 'Branch')
			{
				$this->db->select('
					xx.id
					, xx.nama
				');
				$this->db->from('
					(
						(
							SELECT "-" AS id, "All Branch" AS nama
						)

						UNION ALL

						(
							SELECT
									br.id_branch AS id
									, br.nama_branch AS nama
							FROM
									bb_branch br
						)
					) xx
				');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(xx.nama) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$result = $this->db->get()->result_array();

				return $result;
			}
			else if ($kategori == 'Cluster')
			{
				$this->db->select('
					cl.id_cluster AS id
					, cl.nama_cluster AS nama
				');
				$this->db->from('bc_cluster cl');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(cl.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$result = $this->db->get()->result_array();

				return $result;
			}
			else if ($kategori == 'TAP')
			{
				$this->db->select('
					tp.id_tap AS id
					, tp.nama_tap AS nama
				');
				$this->db->from('bd_tap tp');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(tp.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$result = $this->db->get()->result_array();

				return $result;
			}
		}
		else if ($id_level == 2) // Branch
		{
			if ($kategori == 'Branch')
			{
				$this->db->select('
					id_branch AS id
					, nama_branch AS nama
				');
				$this->db->from('bb_branch');
				$this->db->where('id_branch', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(id_branch) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(nama_branch) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$result = $this->db->get()->result_array();

				return $result;
			}
			else if ($kategori == 'Cluster')
			{
				$this->db->select('
					id_cluster AS id
					, nama_cluster AS nama
				');
				$this->db->from('bc_cluster');
				$this->db->where('id_branch', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(id_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$result = $this->db->get()->result_array();

				return $result;
			}
			else if ($kategori == 'TAP')
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');
				$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
				$this->db->where('c.id_branch', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.id_tap) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$result = $this->db->get()->result_array();

				return $result;
			}
		}
		else if ($id_level == 3) // Cluster
		{
			if ($kategori == 'Cluster')
			{
				$this->db->select('
					id_cluster AS id
					, nama_cluster AS nama
				');
				$this->db->from('bc_cluster');
				$this->db->where('id_cluster', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(id_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$result = $this->db->get()->result_array();

				return $result;
			}
			else if ($kategori == 'TAP')
			{
				$this->db->select('
					id_tap AS id
					, nama_tap AS nama
				');
				$this->db->from('bd_tap');
				$this->db->where('id_cluster', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(id_tap) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$result = $this->db->get()->result_array();

				return $result;
			}
		}
		else if ($id_level == 4) // Tap
		{
			$this->db->select('
				id_tap AS id
				, nama_tap AS nama
			');
			$this->db->from('bd_tap');
			$this->db->where('id_tap', $id_divisi);

			if ($param['q'] != '')
			{
				$this->db->where("(UPPER(id_tap) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
			}

			$result = $this->db->get()->result_array();

			return $result;
		}
	}

	function get_jenis_sales_inmaster($param)
	{
		$this->db->select('
			j.id_jenis_sales
			, j.nama_jenis_sales
		');
		$this->db->from('da_jenis_sales j');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(j.nama_jenis_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('j.nama_jenis_sales', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_sales_intap($param)
	{
		$this->db->select('*');
		$this->db->from('db_sales');
		$this->db->where('id_tap', $param['id_tap']);		
		$this->db->where('status', 'AKTIF');
		
		if ($param['id_jns_sales'] != '')
		{
			$this->db->where('id_jenis_sales', $param['id_jns_sales']);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(id_sales) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(nama_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_sales_indistribution($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			s.id_sales
			, s.nama_sales
			, s.limit_link_aja
		');
		$this->db->from('db_sales s');
		$this->db->where('s.id_tap', $id_divisi);
		$this->db->where('UPPER(s.status)', 'AKTIF');

		if ($param['id_jns_sales'] != '')
		{
			$this->db->where('s.id_jenis_sales', $param['id_jns_sales'] );
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(s.nama_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('s.nama_sales', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_sales_inrotasi($param)
	{
		$this->db->select('
			s.id_tap
			, t.nama_tap
			, s.id_sales
			, s.nama_sales
			, s.email
		');
		$this->db->from('db_sales s');
		$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
		$this->db->where('s.id_tap', $param['id_tap']);
		$this->db->where('s.id_jenis_sales', $param['id_jns_sales'] );
		$this->db->where('s.status', 'AKTIF');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(s.id_sales) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(s.nama_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('s.nama_sales', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_sales_inpjp($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				s.id_tap
				, t.nama_tap
				, t.id_cluster
				, c.nama_cluster
				, c.id_branch
				, b.nama_branch
				, s.id_sales
				, s.nama_sales
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', $param['id_jns_sales']);
			$this->db->where('UPPER(s.status)', 'AKTIF');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				s.id_tap
				, t.nama_tap
				, t.id_cluster
				, c.nama_cluster
				, c.id_branch
				, b.nama_branch
				, s.id_sales
				, s.nama_sales
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', $param['id_jns_sales']);
			$this->db->where('UPPER(s.status)', 'AKTIF');
			$this->db->where('c.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				s.id_tap
				, t.nama_tap
				, t.id_cluster
				, c.nama_cluster
				, c.id_branch
				, b.nama_branch
				, s.id_sales
				, s.nama_sales
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', $param['id_jns_sales']);
			$this->db->where('UPPER(s.status)', 'AKTIF');
			$this->db->where('t.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				s.id_tap
				, t.nama_tap
				, t.id_cluster
				, c.nama_cluster
				, c.id_branch
				, b.nama_branch
				, s.id_sales
				, s.nama_sales
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', $param['id_jns_sales']);
			$this->db->where('UPPER(s.status)', 'AKTIF');
			$this->db->where('s.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(s.id_sales) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(s.nama_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('s.nama_sales', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_sales_inpenjualan($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				s.id_tap
				, t.nama_tap
				, t.id_cluster
				, c.nama_cluster
				, c.id_branch
				, b.nama_branch
				, s.id_sales
				, s.nama_sales
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', $param['id_jns_sales']);
			$this->db->where('UPPER(s.status)', 'AKTIF');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				s.id_tap
				, t.nama_tap
				, t.id_cluster
				, c.nama_cluster
				, c.id_branch
				, b.nama_branch
				, s.id_sales
				, s.nama_sales
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', $param['id_jns_sales']);
			$this->db->where('UPPER(s.status)', 'AKTIF');
			$this->db->where('c.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				s.id_tap
				, t.nama_tap
				, t.id_cluster
				, c.nama_cluster
				, c.id_branch
				, b.nama_branch
				, s.id_sales
				, s.nama_sales
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', $param['id_jns_sales']);
			$this->db->where('UPPER(s.status)', 'AKTIF');
			$this->db->where('t.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				s.id_tap
				, t.nama_tap
				, t.id_cluster
				, c.nama_cluster
				, c.id_branch
				, b.nama_branch
				, s.id_sales
				, s.nama_sales
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', $param['id_jns_sales']);
			$this->db->where('UPPER(s.status)', 'AKTIF');
			$this->db->where('s.id_tap', $id_divisi);
		}
		else if ($id_level == 9) // Kasir TAP
		{
			$this->db->select('
				s.id_tap
				, t.nama_tap
				, t.id_cluster
				, c.nama_cluster
				, c.id_branch
				, b.nama_branch
				, s.id_sales
				, s.nama_sales
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', $param['id_jns_sales']);
			$this->db->where('UPPER(s.status)', 'AKTIF');
			$this->db->where('s.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(s.id_sales) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(s.nama_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('s.nama_sales', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_lokasi_inpjp($param)
	{
		$id_tap = $param['id_tap'] ? $param['id_tap'] : 0;
		$id_jns_sales = $param['id_jns_sales'] ? $param['id_jns_sales'] : 0;
		$id_sales = $param['id_sales'] ? $param['id_sales'] : 0;
		$hari = $param['hari'] ? $param['hari'] : NULL;

		if ($id_jns_sales == 'SSF') // Sales Force (SF)
		{
			$this->db->select('
				xx.id_lokasi
				, xx.nama_lokasi
				, xx.kode_lokasi
				, xx.jenis_lokasi
				, xx.total_week
				, xx.total_day
				, xx.kode
			');
			$this->db->from('
				(
					SELECT
							o.id_outlet AS id_lokasi
							, o.nama_outlet AS nama_lokasi
							, "OUTLET" AS kode_lokasi
							, "OUT" AS jenis_lokasi
							, o.id_digipos AS kode
							, (
										SELECT
												COUNT(p.id_pjp) AS total_week
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = o.id_outlet
												AND UPPER(p.id_jenis_lokasi) = "OUT"
												AND p.id_sales = "'.$id_sales.'"
												AND UPPER(s.id_jenis_sales) = "SSF")
								) AS total_week
							, (
										SELECT
												COUNT(p.id_pjp) AS total_day
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = o.id_outlet
												AND UPPER(p.id_jenis_lokasi) = "OUT"
												AND p.id_sales = "'.$id_sales.'"
												AND UPPER(s.id_jenis_sales) = "SSF"
												AND UPPER(p.hari) = "'.$hari.'")
								) AS total_day
					FROM
							eb_outlet o
					WHERE (o.id_tap = "'.$id_tap.'"
							AND UPPER(o.status) = "OPEN")
				) xx
			');
			$this->db->where('xx.total_week < ', 2);
			$this->db->where('xx.total_day < ', 1);
		}
		else if ($id_jns_sales == 'SCS') // Chennel Support (CS)
		{
			$this->db->select('
				xx.id_lokasi
				, xx.nama_lokasi
				, xx.kode_lokasi
				, xx.jenis_lokasi
				, xx.total_week
				, xx.total_day
				, xx.kode
			');
			$this->db->from('
				(
					SELECT
							o.id_outlet AS id_lokasi
							, o.nama_outlet AS nama_lokasi
							, "OUTLET" AS kode_lokasi
							, "OUT" AS jenis_lokasi
							, o.id_digipos AS kode
							, (
										SELECT
												COUNT(p.id_pjp) AS total_week
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = o.id_outlet
												AND UPPER(p.id_jenis_lokasi) = "OUT"
												AND p.id_sales = "'.$id_sales.'"
												AND UPPER(s.id_jenis_sales) = "SCS")
								) AS total_week
							, (
										SELECT
												COUNT(p.id_pjp) AS total_day
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = o.id_outlet
												AND UPPER(p.id_jenis_lokasi) = "OUT"
												AND p.id_sales = "'.$id_sales.'"
												AND UPPER(s.id_jenis_sales) = "SCS"
												AND UPPER(p.hari) = "'.$hari.'")
								) AS total_day
					FROM
						eb_outlet o
					WHERE (o.id_tap = "'.$id_tap.'"
							AND UPPER(o.status) = "OPEN")
				) xx
			');
			$this->db->where('xx.total_week < ', 2);
			$this->db->where('xx.total_day < ', 1);
		}
		else if ($id_jns_sales == 'SDS') // Direct Sales (DS)
		{
			$this->db->select('
				xx.id_lokasi
				, xx.nama_lokasi
				, xx.kode_lokasi
				, xx.jenis_lokasi
				, xx.total_week
				, xx.total_day
				, xx.kode
			');
			$this->db->from('
				(
					SELECT
							s.id_sekolah AS id_lokasi
							, s.nama_sekolah AS nama_lokasi
							, "SEKOLAH" AS kode_lokasi
							, "SEK" AS jenis_lokasi
							, s.no_npsn AS kode
							, (
										SELECT
												COUNT(p.id_pjp) AS total_week
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = s.id_sekolah
												AND UPPER(p.id_jenis_lokasi) = "SEK"
												AND p.id_sales = "'.$id_sales.'"
												AND UPPER(s.id_jenis_sales) = "SDS")
								) AS total_week
							, (
										SELECT
												COUNT(p.id_pjp) AS total_day
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = s.id_sekolah
												AND UPPER(p.id_jenis_lokasi) = "SEK"
												AND p.id_sales = "'.$id_sales.'"
												AND UPPER(s.id_jenis_sales) = "SDS"
												AND UPPER(p.hari) = "'.$hari.'")
								) AS total_day
					FROM
							ec_sekolah s
					WHERE (s.id_tap = "'.$id_tap.'"
							AND UPPER(s.status) = "OPEN")

					UNION ALL

					SELECT
							k.id_universitas AS id_lokasi
							, k.nama_universitas AS nama_lokasi
							, "KAMPUS" AS kode_lokasi
							, "KAM" AS jenis_lokasi
							, k.no_npsn AS kode
							, (
										SELECT
												COUNT(p.id_pjp) AS total_week
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = k.id_universitas
												AND UPPER(p.id_jenis_lokasi) = "KAM"
												AND p.id_sales = "'.$id_sales.'"
												AND UPPER(s.id_jenis_sales) = "SDS")
								) AS total_week
							, (
										SELECT
												COUNT(p.id_pjp) AS total_day
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = k.id_universitas
												AND p.id_jenis_lokasi = "KAM"
												AND p.id_sales = "'.$id_sales.'"
												AND UPPER(s.id_jenis_sales) = "SDS"
												AND UPPER(p.hari) = "'.$hari.'")
								) AS total_day
					FROM
							ed_kampus k
					WHERE (k.id_tap = "'.$id_tap.'"
							AND k.status = "OPEN")

					UNION ALL

					SELECT
							f.id_fakultas AS id_lokasi
							, f.nama_fakultas AS nama_lokasi
							, "FAKULTAS" AS kode_lokasi
							, "FAK" AS jenis_lokasi
							, "" AS kode
							, (
										SELECT
												COUNT(p.id_pjp) AS total_week
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = f.id_fakultas
												AND UPPER(p.id_jenis_lokasi) = "FAK"
												AND p.id_sales = "'.$id_sales.'"
												AND UPPER(s.id_jenis_sales) = "SDS")
								) AS total_week
							, (
										SELECT
												COUNT(p.id_pjp) AS total_day
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = f.id_fakultas
												AND UPPER(p.id_jenis_lokasi) = "FAK"
												AND p.id_sales = "'.$id_sales.'"
												AND UPPER(s.id_jenis_sales) = "SDS"
												AND UPPER(p.hari) = "'.$hari.'")
								) AS total_day
					FROM
							ee_fakultas f
					WHERE (f.id_tap = "'.$id_tap.'"
							AND UPPER(f.status) = "OPEN")

					UNION ALL

					SELECT
							po.id_poi AS id_lokasi
							, po.nama_poi AS nama_lokasi
							, "POI" AS kode_lokasi
							, "POI" AS jenis_lokasi
							, "" AS kode
							, (
										SELECT
												COUNT(p.id_pjp) AS total_week
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = po.id_poi
												AND p.id_jenis_lokasi = "POI"
												AND p.id_sales = "'.$id_sales.'"
												AND s.id_jenis_sales = "SDS")
								) AS total_week
							, (
										SELECT
												COUNT(p.id_pjp) AS total_day
										FROM
												fa_pjp p
												INNER JOIN db_sales s
														ON (p.id_sales = s.id_sales)
										WHERE (p.id_tempat = po.id_poi
												AND UPPER(p.id_jenis_lokasi) = "POI"
												AND p.id_sales = "'.$id_sales.'"
												AND UPPER(s.id_jenis_sales) = "SDS"
												AND UPPER(p.hari) = "'.$hari.'")
								) AS total_day
					FROM
							ef_poi po
					WHERE (po.id_tap = "'.$id_tap.'"
							AND UPPER(po.status) = "OPEN")
				) xx
			');

			$this->db->where('xx.total_day < ', 1);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.nama_lokasi) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(xx.kode) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('xx.nama_lokasi', 'asc');

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_produk_inmaster($param)
	{
		$this->db->select('p.*');
		$this->db->from('gb_produk p');
		$this->db->join('ga_jenis_produk j', 'p.id_jenis_produk = j.id_jenis_produk');
		$this->db->where('UPPER(j.kategori_produk)', 'SEGEL');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(p.kode_produk) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(p.nama_produk) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_produk_ininject($param)
	{
		$insac = array('SGPREPAID');
		$invin = array('SGVIN');
		$invga = array('SGVGS', 'SGVGG', 'SGVGP');

		$this->db->select('p.*');
		$this->db->from('gb_produk p');

		if (in_array($param['id_jns_produk'], $insac))
		{
			$this->db->where('UPPER(p.id_jenis_produk)', 'INSAC');
		}
		else if (in_array($param['id_jns_produk'], $invin))
		{
			$this->db->where('UPPER(p.id_jenis_produk)', 'INVIN');
		}
		else if (in_array($param['id_jns_produk'], $invga))
		{
			$this->db->where('UPPER(p.id_jenis_produk)', 'INVGA');
		}

		if ($param['id_kab'] != '')
		{
			$this->db->where('p.id_kabupaten', $param['id_kab']);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(p.kode_produk) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(pd.nama_produk) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_pilihan_by_dashboard($param)
	{
		$kategori = $param['kategori'] ? $param['kategori'] : '';
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			if ($kategori == 'Branch')
			{
				$this->db->select('
					xx.id
					, xx.nama
				');
				$this->db->from('
					(
						(
							SELECT "-" AS id, "All Branch" AS nama
						)

						UNION ALL

						(
							SELECT
									b.id_branch AS id
									, b.nama_branch AS nama
							FROM
									bb_branch b
						)
					) xx
				');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(xx.nama) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('xx.nama', 'asc');
			}
			else if ($kategori == 'Cluster')
			{
				$this->db->select('
					c.id_cluster AS id
					, c.nama_cluster AS nama
				');
				$this->db->from('bc_cluster c');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(c.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('c.nama_cluster', 'asc');
			}
			else if ($kategori == 'TAP')
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
		}
		elseif ($id_level == 2) // Branch
		{
			if ($kategori == 'Branch')
			{
				$this->db->select('
					b.id_branch AS id
					, b.nama_branch AS nama
				');
				$this->db->from('bb_branch b');
				$this->db->where('b.id_branch', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(b.nama_branch) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('b.nama_branch', 'asc');
			}
			else if ($kategori == 'Cluster')
			{
				$this->db->select('
					c.id_cluster AS id
					, c.nama_cluster AS nama
				');
				$this->db->from('bc_cluster c');
				$this->db->where('c.id_branch', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(c.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('c.nama_cluster', 'asc');
			}
			else if ($kategori == 'TAP')
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');
				$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
				$this->db->where('c.id_branch', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
		}
		elseif ($id_level == 3) // Cluster
		{
			if ($kategori == 'Cluster')
			{
				$this->db->select('
					c.id_cluster AS id
					, c.nama_cluster AS nama
				');
				$this->db->from('bc_cluster c');
				$this->db->where('c.id_cluster', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(c.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('c.nama_cluster', 'asc');
			}
			else if ($kategori == 'TAP')
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');
				$this->db->where('t.id_cluster', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
		}
		elseif ($id_level == 4) // TAP
		{
			if ($kategori == 'TAP')
			{
				$this->db->select('
					t.id_tap AS id
					, t.nama_tap AS nama
				');
				$this->db->from('bd_tap t');
				$this->db->where('t.id_tap', $id_divisi);

				if ($param['q'] != '')
				{
					$this->db->where("(UPPER(t.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
				}

				$this->db->order_by('t.nama_tap', 'asc');
			}
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_cluster($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('a.id_cluster');
		$this->db->from('bd_tap a');
		$this->db->where('a.id_tap', $id_divisi);
		$rs = $this->db->get()->row_array();
		$id_cluster = isset($rs['id_cluster']) ? $rs['id_cluster'] : 0;

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				cl.id_cluster
				, cl.nama_cluster
			');
			$this->db->from('bc_cluster cl');
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				cl.id_cluster
				, cl.nama_cluster
			');
			$this->db->from('bc_cluster cl');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				cl.id_cluster
				, cl.nama_cluster
			');
			$this->db->from('bc_cluster cl');
			$this->db->where('cl.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				cl.id_cluster
				, cl.nama_cluster
			');
			$this->db->from('bc_cluster cl');
			$this->db->where('cl.id_cluster', $id_cluster);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(cl.id_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(cl.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_tap($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			xx.id_cluster
			, xx.nama_cluster
			, xx.mitra_ad
			, xx.id_branch
			, xx.nama_branch
			, xx.id_regional
			, xx.nama_regional
			, xx.id_tap
			, xx.level_tap
			, xx.nama_tap
			, xx.manager
			, xx.longitude
			, xx.latitude
			, xx.lastmodified
		');
		$this->db->from('
			(
				SELECT
						tp.id_cluster
						, cl.nama_cluster
						, cl.mitra_ad
						, cl.id_branch
						, br.nama_branch
						, br.id_regional
						, rg.nama_regional
						, tp.id_tap
						, tp.level_tap
						, tp.nama_tap
						, tp.manager
						, tp.longitude
						, tp.latitude
						, tp.lastmodified
				FROM
						bd_tap tp
						INNER JOIN bc_cluster cl
								ON (tp.id_cluster = cl.id_cluster)
						INNER JOIN bb_branch br
								ON (cl.id_branch = br.id_branch)
						INNER JOIN ba_regional rg
								ON (br.id_regional = rg.id_regional)
			) xx
		');

		if ($id_level == 1) // Level Regional
		{
			$this->db->where('xx.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->where('xx.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->where('xx.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->where('xx.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.id_tap) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(xx.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_tap_by_cluster($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			tp.id_tap
			, tp.nama_tap
		');
		$this->db->from('bd_tap tp');
		$this->db->where('tp.id_cluster', $param['id_cluster']);

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(tp.id_tap) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(tp.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_tap_by_lokasi($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			tp.id_tap
			, tp.nama_tap
		');
		$this->db->from('bd_tap tp');
		$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
		$this->db->join('cc_kecamatan kc', 'kc.id_cluster = cl.id_cluster');
		$this->db->where('kc.id_kecamatan', $param['id_kec']);

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(tp.id_tap) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(tp.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_tap_by_master_sales($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				tp.id_tap
				, tp.nama_tap
				, cl.nama_cluster
			');
			$this->db->from('bd_tap tp');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				tp.id_tap
				, tp.nama_tap
				, cl.nama_cluster
			');
			$this->db->from('bd_tap tp');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				tp.id_tap
				, tp.nama_tap
				, cl.nama_cluster
			');
			$this->db->from('bd_tap tp');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				tp.id_tap
				, tp.nama_tap
				, cl.nama_cluster
			');
			$this->db->from('bd_tap tp');
			$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('tp.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(tp.id_tap) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(tp.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(cl.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_provinsi($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('br.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				kb.id_provinsi
				, pr.nama_provinsi
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('tp.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(pr.id_provinsi) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(pr.nama_provinsi) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_kabupaten($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				kc.id_kabupaten
				, kb.nama_kabupaten
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kb.id_provinsi', $param['id_provinsi']);
			$this->db->where('br.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				kc.id_kabupaten
				, kb.nama_kabupaten
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kb.id_provinsi', $param['id_provinsi']);
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				kc.id_kabupaten
				, kb.nama_kabupaten
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kb.id_provinsi', $param['id_provinsi']);
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				kc.id_kabupaten
				, kb.nama_kabupaten
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('cb_kabupaten kb', 'kc.id_kabupaten = kb.id_kabupaten');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kb.id_provinsi', $param['id_provinsi']);
			$this->db->where('tp.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(kb.id_kabupaten) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(kb.nama_kabupaten) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_kabupaten_by_produk($param)
	{
		$this->db->select('
			kb.id_provinsi
			, pr.nama_provinsi
			, kb.id_kabupaten
			, kb.nama_kabupaten
			, kb.radius_clock_in
			, kb.lastmodified
		');
		$this->db->from('cb_kabupaten kb');
		$this->db->join('ca_provinsi pr', 'kb.id_provinsi = pr.id_provinsi');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(pr.nama_provinsi) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(kb.nama_kabupaten) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_kecamatan($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				kc.id_kecamatan
				, kc.nama_kecamatan
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kc.id_kabupaten', $param['id_kab']);
			$this->db->where('br.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				kc.id_kecamatan
				, kc.nama_kecamatan
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kc.id_kabupaten', $param['id_kab']);
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				kc.id_kecamatan
				, kc.nama_kecamatan
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kc.id_kabupaten', $param['id_kab']);
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				kc.id_kecamatan
				, kc.nama_kecamatan
			');
			$this->db->distinct();
			$this->db->from('cc_kecamatan kc');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
			$this->db->join('bd_tap tp', 'tp.id_cluster = cl.id_cluster');
			$this->db->where('kc.id_kabupaten', $param['id_kab']);
			$this->db->where('tp.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(kc.id_kecamatan) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(kc.nama_kecamatan) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_kelurahan($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('a.id_cluster');
		$this->db->from('bd_tap a');
		$this->db->where('a.id_tap', $id_divisi);
		$rs = $this->db->get()->row_array();
		$id_cluster = $rs['id_cluster'] ? $rs['id_cluster'] : 0;

		if ($id_level == 1) // Level Regional
		{
			$this->db->select('
				kl.id_kelurahan
				, kl.nama_kelurahan
			');
			$this->db->from('cd_kelurahan kl');
			$this->db->where('kl.id_kecamatan', $param['id_kec']);
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->select('
				kl.id_kelurahan
				, kl.nama_kelurahan
			');
			$this->db->distinct();
			$this->db->from('cd_kelurahan kl');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->join('bc_cluster cl', 'kc.id_cluster = cl.id_cluster');
			$this->db->where('kl.id_kecamatan', $param['id_kec']);
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->select('
				kl.id_kelurahan
				, kl.nama_kelurahan
			');
			$this->db->distinct();
			$this->db->from('cd_kelurahan kl');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->where('kl.id_kecamatan', $param['id_kec']);
			$this->db->where('kc.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->select('
				kl.id_kelurahan
				, kl.nama_kelurahan
			');
			$this->db->distinct();
			$this->db->from('cd_kelurahan kl');
			$this->db->join('cc_kecamatan kc', 'kl.id_kecamatan = kc.id_kecamatan');
			$this->db->where('kl.id_kecamatan', $param['id_kec']);
			$this->db->where('kc.id_cluster', $id_cluster);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(kl.id_kelurahan) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(kl.nama_kelurahan) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_jenis_sales($param)
	{
		$this->db->select('
			js.id_jenis_sales
			, js.nama_jenis_sales
		');
		$this->db->from('da_jenis_sales js');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(js.nama_jenis_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_sales($param)
	{
		$this->db->select('
			sl.id_jenis_sales
			, sl.id_tap
			, tp.level_tap
			, tp.nama_tap
			, tp.id_cluster
			, cl.nama_cluster
			, cl.id_branch
			, br.nama_branch
			, sl.id_sales
			, sl.nama_sales
			, sl.email
			, sl.limit_link_aja
			, sl.status
			, sl.lastmodified
		');
		$this->db->from('db_sales sl');
		$this->db->join('bd_tap tp', 'sl.id_tap = tp.id_tap');
		$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
		$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
		$this->db->where('sl.status', 'AKTIF');

		if ($param['id_jns_sales'] != '')
		{
			$this->db->where('sl.id_jenis_sales', $param['id_jns_sales'] );
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(sl.nama_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_sales_by_jenis_sales($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			sl.id_jenis_sales
			, sl.id_tap
			, tp.level_tap
			, tp.nama_tap
			, tp.id_cluster
			, cl.nama_cluster
			, cl.id_branch
			, br.nama_branch
			, sl.id_sales
			, sl.nama_sales
			, sl.email
			, sl.status
			, sl.lastmodified
		');
		$this->db->from('db_sales sl');
		$this->db->join('bd_tap tp', 'sl.id_tap = tp.id_tap');
		$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
		$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
		$this->db->where('sl.status', 'AKTIF');
		$this->db->where('sl.id_jenis_sales', $param['id_jns_sales']);

		if ($id_level == 1) // Level Regional
		{
			$this->db->where('br.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->where('sl.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(sl.id_sales) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(sl.nama_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_sales_by_tap($param)
	{
		$this->db->select('
			sl.id_jenis_sales
			, sl.id_tap
			, tp.level_tap
			, tp.nama_tap
			, tp.id_cluster
			, cl.nama_cluster
			, cl.id_branch
			, br.nama_branch
			, sl.id_sales
			, sl.nama_sales
			, sl.email
			, sl.status
			, sl.lastmodified
		');
		$this->db->from('db_sales sl');
		$this->db->join('bd_tap tp', 'sl.id_tap = tp.id_tap');
		$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
		$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
		$this->db->where('sl.id_tap', $param['id_tap']);
		$this->db->where('sl.status', 'AKTIF');

		if ($param['id_jns_sales'] != '')
		{
			$this->db->where('sl.id_jenis_sales', $param['id_jns_sales'] );
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(sl.id_sales) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(sl.nama_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_sales_by_setting_pjp($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			sl.id_jenis_sales
			, sl.id_tap
			, tp.level_tap
			, tp.nama_tap
			, tp.id_cluster
			, cl.nama_cluster
			, cl.id_branch
			, br.nama_branch
			, sl.id_sales
			, sl.nama_sales
			, sl.email
			, sl.status
			, sl.lastmodified
		');
		$this->db->from('db_sales sl');
		$this->db->join('bd_tap tp', 'sl.id_tap = tp.id_tap');
		$this->db->join('bc_cluster cl', 'tp.id_cluster = cl.id_cluster');
		$this->db->join('bb_branch br', 'cl.id_branch = br.id_branch');
		$this->db->where('sl.status', 'AKTIF');
		$this->db->where('sl.id_jenis_sales', $param['id_jns_sales']);

		if ($id_level == 1) // Level Regional
		{
			$this->db->where('br.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->where('cl.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->where('tp.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->where('sl.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(sl.id_sales) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(sl.nama_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_sales_by_promotion($param)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		$this->db->select('
			xx.id_sales
			, xx.nama_sales
			, xx.id_tap
			, xx.nama_tap
			, xx.id_cluster
			, xx.nama_cluster
			, xx.id_branch
			, xx.nama_branch
			, xx.id_regional
		');
		$this->db->from('
			(
				SELECT DISTINCT
						hp.id_sales
						, sl.nama_sales
						, sl.id_tap
						, tp.nama_tap
						, tp.id_cluster
						, cl.nama_cluster
						, cl.id_branch
						, br.nama_branch
						, br.id_regional
				FROM
						fb_histroy_pjp hp
						INNER JOIN db_sales sl
								ON (hp.id_sales = sl.id_sales)
						INNER JOIN bd_tap tp
								ON (sl.id_tap = tp.id_tap)
						INNER JOIN bc_cluster cl
								ON (tp.id_cluster = cl.id_cluster)
						INNER JOIN bb_branch br
								ON (cl.id_branch = br.id_branch)
			) xx
		');

		if ($id_level == 1) // Level Regional
		{
			$this->db->where('xx.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Level Branch
		{
			$this->db->where('xx.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Level Cluster
		{
			$this->db->where('xx.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // Level TAP
		{
			$this->db->where('xx.id_tap', $id_divisi);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.nama_sales) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_jenis_lokasi($param)
	{
		$this->db->select('jl.*');
		$this->db->from('ea_jenis_lokasi jl');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(jl.nama_jenis_lokasi) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_jenis_lokasi_by_merchandising($param)
	{
		$this->db->select('
			jl.id_jenis_lokasi
			, jl.nama_jenis_lokasi
		');
		$this->db->from('ea_jenis_lokasi jl');
		$this->db->where('jl.id_jenis_lokasi <> "POI"');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(jl.nama_jenis_lokasi) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_jenis_lokasi_by_history_order($param)
	{
		$id_jns_sales = isset($param['id_jns_sales']) ? $param['id_jns_sales'] : NULL;

		if ($id_jns_sales == 'SSF')
		{
			$this->db->select('j.*');
			$this->db->from('ea_jenis_lokasi j');
			$this->db->where_in('j.id_jenis_lokasi', array('OUT'));
		}
		else if ($id_jns_sales == 'SCS')
		{
			$this->db->select('j.*');
			$this->db->from('ea_jenis_lokasi j');
			$this->db->where_in('j.id_jenis_lokasi', array('OUT'));
		}
		else if ($id_jns_sales == 'SDS')
		{
			$this->db->select('j.*');
			$this->db->from('ea_jenis_lokasi j');
			$this->db->where_in('j.id_jenis_lokasi', array('SEK', 'KAM', 'FAK', 'POI'));
		}
		else
		{
			$this->db->select('j.*');
			$this->db->from('ea_jenis_lokasi j');
			$this->db->where_in('j.id_jenis_lokasi', array('X'));
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(j.nama_jenis_lokasi) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_universitas($param)
	{
		$this->db->select('km.*');
		$this->db->from('ed_kampus km');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(km.nama_universitas) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$this->db->order_by('km.lastmodified', 'desc');
		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_tempat_by_pjp_setting($param)
	{
		$id_jns_sales = $param['id_jns_sales'] ? $param['id_jns_sales'] : 0;
		$id_sales = $param['id_sales'] ? $param['id_sales'] : 0;
		$hari = $param['hari'] ? $param['hari'] : NULL;
		$id_tap = $param['id_tap'] ? $param['id_tap'] : 0;

		if ($id_jns_sales == 'SSF') // Sales Force
		{
			$this->db->select('
				xx.id_tempat
				, xx.nama_tempat
				, xx.kode_tempat
				, xx.jenis_tempat
				, xx.total_week
				, xx.total_day
			');
			$this->db->from('
				(
					SELECT
							o.id_outlet AS id_tempat
							, o.nama_outlet AS nama_tempat
							, "OUTLET" AS kode_tempat
							, "OUT" AS jenis_tempat
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_week
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
											ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = o.id_outlet
												AND pj.id_jenis_lokasi = "OUT"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'")
								) AS total_week
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_day
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
											ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = o.id_outlet
												AND pj.id_jenis_lokasi = "OUT"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'"
												AND pj.hari = "'.$hari.'")
								) AS total_day
					FROM
						eb_outlet o
					WHERE (o.id_tap = "'.$id_tap.'"
							AND o.status = "OPEN")
				) xx
			');
			$this->db->where('xx.total_week < ', 2);
			$this->db->where('xx.total_day < ', 1);
		}
		else if ($id_jns_sales == 'SCS') // Chennel Support
		{
			$this->db->select('
				xx.id_tempat
				, xx.nama_tempat
				, xx.kode_tempat
				, xx.jenis_tempat
				, xx.total_week
				, xx.total_day
			');
			$this->db->from('
				(
					SELECT
							o.id_outlet AS id_tempat
							, o.nama_outlet AS nama_tempat
							, "OUTLET" AS kode_tempat
							, "OUT" AS jenis_tempat
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_week
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
														ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = o.id_outlet
												AND pj.id_jenis_lokasi = "OUT"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'")
								) AS total_week
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_day
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
														ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = o.id_outlet
												AND pj.id_jenis_lokasi = "OUT"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'"
												AND pj.hari = "'.$hari.'")
								) AS total_day
					FROM
						eb_outlet o
					WHERE (o.id_tap = "'.$id_tap.'"
							AND o.status = "OPEN")
				) xx
			');
			$this->db->where('xx.total_week < ', 2);
			$this->db->where('xx.total_day < ', 1);
		}
		else if ($id_jns_sales == 'SDS') // Direct Sales
		{
			$this->db->select('
				xx.id_tempat
				, xx.nama_tempat
				, xx.kode_tempat
				, xx.jenis_tempat
				, xx.total_week
				, xx.total_day
			');
			$this->db->from('
				(
					SELECT
							sk.id_sekolah AS id_tempat
							, sk.nama_sekolah AS nama_tempat
							, "SEKOLAH" AS kode_tempat
							, "SEK" AS jenis_tempat
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_week
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
														ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = sk.id_sekolah
												AND pj.id_jenis_lokasi = "SEK"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'")
								) AS total_week
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_day
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
														ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = sk.id_sekolah
												AND pj.id_jenis_lokasi = "SEK"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'"
												AND pj.hari = "'.$hari.'")
								) AS total_day
					FROM
							ec_sekolah sk
					WHERE (sk.id_tap = "'.$id_tap.'"
							AND sk.status = "OPEN")

					UNION ALL

					SELECT
							km.id_universitas AS id_tempat
							, km.nama_universitas AS nama_tempat
							, "KAMPUS" AS kode_tempat
							, "KAM" AS jenis_tempat
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_week
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
														ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = km.id_universitas
												AND pj.id_jenis_lokasi = "KAM"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'")
								) AS total_week
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_day
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
														ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = km.id_universitas
												AND pj.id_jenis_lokasi = "KAM"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'"
												AND pj.hari = "'.$hari.'")
								) AS total_day
					FROM
							ed_kampus km
					WHERE (km.id_tap = "'.$id_tap.'"
							AND km.status = "OPEN")

					UNION ALL

					SELECT
							fk.id_fakultas AS id_tempat
							, fk.nama_fakultas AS nama_tempat
							, "FAKULTAS" AS kode_tempat
							, "FAK" AS jenis_tempat
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_week
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
														ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = fk.id_fakultas
												AND pj.id_jenis_lokasi = "FAK"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'")
								) AS total_week
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_day
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
														ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = fk.id_fakultas
												AND pj.id_jenis_lokasi = "FAK"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'"
												AND pj.hari = "'.$hari.'")
								) AS total_day
					FROM
							ee_fakultas fk
					WHERE (fk.id_tap = "'.$id_tap.'"
							AND fk.status = "OPEN")

					UNION ALL

					SELECT
							po.id_poi AS id_tempat
							, po.nama_poi AS nama_tempat
							, "POI" AS kode_tempat
							, "POI" AS jenis_tempat
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_week
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
														ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = po.id_poi
												AND pj.id_jenis_lokasi = "POI"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'")
								) AS total_week
							, (
										SELECT
												COUNT(pj.id_pjp) AS total_day
										FROM
												fa_pjp pj
												INNER JOIN db_sales sl
														ON (pj.id_sales = sl.id_sales)
										WHERE (pj.id_tempat = po.id_poi
												AND pj.id_jenis_lokasi = "POI"
												AND pj.id_sales = "'.$id_sales.'"
												AND sl.id_jenis_sales = "'.$id_jns_sales.'"
												AND pj.hari = "'.$hari.'")
								) AS total_day
					FROM
							ef_poi po
					WHERE (po.id_tap = "'.$id_tap.'"
							AND po.status = "OPEN")
				) xx
			');

			$this->db->where('xx.total_day < ', 1);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.nama_tempat) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_jenis_outlet($param)
	{
		$this->db->select('
			jo.id_jenis_outlet
			, jo.nama_jenis_outlet
		');
		$this->db->from('eh_jenis_outlet jo');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(jo.nama_jenis_outlet) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_no_kunjungan($param)
	{
		$id_sales = $param['id_sales'] ? $param['id_sales'] : NULL;
		$hari = $param['hari'] ? $param['hari'] : NULL;

		$this->db->select('xx.no_kunjungan');
		$this->db->from('
			(
				SELECT
					nk.no_kunjungan
				FROM
						fd_no_kunjungan nk
				WHERE nk.no_kunjungan NOT IN (
					SELECT
							pj.no_kunjungan
					FROM
							fa_pjp pj
					WHERE (pj.id_sales = "'.$id_sales.'"
							AND pj.hari = "'.$hari.'")
				)
			) xx
		');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(xx.no_kunjungan) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_produk($param)
	{
		$this->db->select('p.*');
		$this->db->from('gb_produk p');
		$this->db->join('ga_jenis_produk jp', 'p.id_jenis_produk = jp.id_jenis_produk');
		$this->db->where('UPPER(jp.kategori_produk)', 'SEGEL');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(p.kode_produk) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(p.nama_produk) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_zona($param)
	{
		$this->db->select('
			za.id_zona
			, za.nama_zona
		');
		$this->db->from('gc_zona za');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(za.nama_zona) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_jenis_produk($param)
	{
		$this->db->select('*');
		$this->db->from('ga_jenis_produk');

		if ($param['jns_produk'] != '')
		{
			$this->db->where('UPPER(kategori_produk)', $param['jns_produk']);
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(nama_jenis_produk) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_jenis_inject($param)
	{
		$this->db->select('
			ji.id_jenis_inject
			, ji.nama_jenis_inject
		');
		$this->db->from('gd_jenis_inject ji');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(ji.nama_jenis_inject) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_produk_by_proses_inject($param)
	{
		$insac = array('SGSIM0K', 'SGSIM10K', 'SGSIM50K', 'SGSIMOTA', 'SGKAS5K', 'SGKAS25K', 'SGLOP5K', 'SGLOP25K', 'SGPREPAID');
		$invin = array('SGVIN');
		$invga = array('SGVGS', 'SGVGG', 'SGVGP');

		$this->db->select('p.*');
		$this->db->from('gb_produk p');

		if (in_array($param['jenis_produk'], $insac))
		{
			$this->db->where('UPPER(p.id_jenis_produk)', 'INSAC');
		}
		else if (in_array($param['jenis_produk'], $invin))
		{
			$this->db->where('UPPER(p.id_jenis_produk)', 'INVIN');
		}
		else if (in_array($param['jenis_produk'], $invga))
		{
			$this->db->where('UPPER(p.id_jenis_produk)', 'INVGA');
		}

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(p.kode_produk) LIKE '".strtoupper('%'.$param['q'].'%')."' OR UPPER(pd.nama_produk) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_tahun($param)
	{
		$this->db->distinct();
		$this->db->select('p.tahun');
		$this->db->from('ja_penjualan_tanggal p');

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(p.tahun) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_bulan($param)
	{
		$this->db->distinct();
		$this->db->select('p.bulan');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tahun', $param['tahun']);

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(p.bulan) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_minggu($param)
	{
		$this->db->distinct();
		$this->db->select('p.minggu');
		$this->db->from('ja_penjualan_tanggal p');
		$this->db->where('p.tahun', $param['tahun']);
		$this->db->where('p.bulan', $param['bulan']);

		if ($param['q'] != '')
		{
			$this->db->where("(UPPER(p.minggu) LIKE '".strtoupper('%'.$param['q'].'%')."')");
		}

		$result = $this->db->get()->result_array();

		return $result;
	}

	function get_pilihan_by_merchandising($param)
	{
		$kategori = $param['kategori'] ? $param['kategori'] : '';

		if ($kategori == 'Branch')
		{
			$this->db->select('
				xx.id
				, xx.nama
			');
			$this->db->from('
				(
					(
						SELECT "-" AS id, "All Branch" AS nama
					)

					UNION ALL

					(
						SELECT
								br.id_branch AS id
								, br.nama_branch AS nama
						FROM
								bb_branch br
					)
				) xx
			');

			if ($param['q'] != '')
			{
				$this->db->where("(UPPER(xx.nama) LIKE '".strtoupper('%'.$param['q'].'%')."')");
			}

			$result = $this->db->get()->result_array();

			return $result;
		}
		else if ($kategori == 'Cluster')
		{
			$this->db->select('
				cl.id_cluster AS id
				, cl.nama_cluster AS nama
			');
			$this->db->from('bc_cluster cl');

			if ($param['q'] != '')
			{
				$this->db->where("(UPPER(cl.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
			}

			$result = $this->db->get()->result_array();

			return $result;
		}
		else if ($kategori == 'TAP')
		{
			$this->db->select('
				tp.id_tap AS id
				, tp.nama_tap AS nama
			');
			$this->db->from('bd_tap tp');

			if ($param['q'] != '')
			{
				$this->db->where("(UPPER(tp.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
			}

			$result = $this->db->get()->result_array();

			return $result;
		}
	}

	function get_pilihan_by_promotion($param)
	{
		$kategori = $param['kategori'] ? $param['kategori'] : '';

		if ($kategori == 'Branch')
		{
			$this->db->select('
				xx.id
				, xx.nama
			');
			$this->db->from('
				(
					(
						SELECT "-" AS id, "All Branch" AS nama
					)

					UNION ALL

					(
						SELECT
								br.id_branch AS id
								, br.nama_branch AS nama
						FROM
								bb_branch br
					)
				) xx
			');

			if ($param['q'] != '')
			{
				$this->db->where("(UPPER(xx.nama) LIKE '".strtoupper('%'.$param['q'].'%')."')");
			}

			$result = $this->db->get()->result_array();

			return $result;
		}
		else if ($kategori == 'Cluster')
		{
			$this->db->select('
				cl.id_cluster AS id
				, cl.nama_cluster AS nama
			');
			$this->db->from('bc_cluster cl');

			if ($param['q'] != '')
			{
				$this->db->where("(UPPER(cl.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
			}

			$result = $this->db->get()->result_array();

			return $result;
		}
		else if ($kategori == 'TAP')
		{
			$this->db->select('
				tp.id_tap AS id
				, tp.nama_tap AS nama
			');
			$this->db->from('bd_tap tp');

			if ($param['q'] != '')
			{
				$this->db->where("(UPPER(tp.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
			}

			$result = $this->db->get()->result_array();

			return $result;
		}
	}

	function get_pilihan_by_market_audit($param)
	{
		$kategori = $param['kategori'] ? $param['kategori'] : '';

		if ($kategori == 'Branch')
		{
			$this->db->select('
				xx.id
				, xx.nama
			');
			$this->db->from('
				(
					(
						SELECT "-" AS id, "All Branch" AS nama
					)

					UNION ALL

					(
						SELECT
								br.id_branch AS id
								, br.nama_branch AS nama
						FROM
								bb_branch br
					)
				) xx
			');

			if ($param['q'] != '')
			{
				$this->db->where("(UPPER(xx.nama) LIKE '".strtoupper('%'.$param['q'].'%')."')");
			}

			$result = $this->db->get()->result_array();

			return $result;
		}
		else if ($kategori == 'Cluster')
		{
			$this->db->select('
				cl.id_cluster AS id
				, cl.nama_cluster AS nama
			');
			$this->db->from('bc_cluster cl');

			if ($param['q'] != '')
			{
				$this->db->where("(UPPER(cl.nama_cluster) LIKE '".strtoupper('%'.$param['q'].'%')."')");
			}

			$result = $this->db->get()->result_array();

			return $result;
		}
		else if ($kategori == 'TAP')
		{
			$this->db->select('
				tp.id_tap AS id
				, tp.nama_tap AS nama
			');
			$this->db->from('bd_tap tp');

			if ($param['q'] != '')
			{
				$this->db->where("(UPPER(tp.nama_tap) LIKE '".strtoupper('%'.$param['q'].'%')."')");
			}

			$result = $this->db->get()->result_array();

			return $result;
		}
	}


}
?>