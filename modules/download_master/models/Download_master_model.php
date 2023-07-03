<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_master_model extends Base_Model {

	var $fieldmap_daftar = array('id_branch', 'nama_branch');
	var $column_order = array(null, 'id_branch','nama_branch');
	var $column_search = array('id_branch','nama_branch');
	var $fieldmap_daftar_2 = array('id_cluster', 'nama_cluster', 'mitra_ad', 'nama_branch');
	var $column_order_2 = array(null, 'id_cluster','nama_cluster', 'mitra_ad', 'nama_branch');
	var $column_search_2 = array('id_cluster','nama_cluster', 'mitra_ad', 'nama_branch');
	var $fieldmap_daftar_3 = array('id_tap', 'nama_tap', 'manager', 'nama_cluster', 'nama_branch');
	var $column_order_3 = array(null, 'id_tap', 'nama_tap', 'manager', 'nama_cluster', 'nama_branch');
	var $column_search_3 = array('id_tap', 'nama_tap', 'manager', 'nama_cluster', 'nama_branch');
	var $fieldmap_daftar_4 = array('id_sales', 'nama_sales', 'id_tap', 'nama_tap', 'id_cluster','id_branch');
	var $column_order_4 = array(null, 'id_sales', 'nama_sales', 'id_tap', 'nama_tap', 'id_cluster','id_branch');
	var $column_search_4 = array('id_sales', 'nama_sales', 'id_tap', 'nama_tap', 'id_cluster','id_branch');
	var $fieldmap_daftar_5 = array('id_sales', 'nama_sales', 'id_tap', 'nama_tap', 'id_cluster','id_branch');
	var $column_order_5 = array(null, 'id_sales', 'nama_sales', 'id_tap', 'nama_tap', 'id_cluster','id_branch');
	var $column_search_5 = array('id_sales', 'nama_sales', 'id_tap', 'nama_tap', 'id_cluster','id_branch');


	function __construct()
	{
		parent::__construct();
	}

	function build_query_daftar()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				b.id_branch
				, b.nama_branch
			');
			$this->db->from('bb_branch b');
			$this->db->where('b.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				b.id_branch
				, b.nama_branch
			');
			$this->db->from('bb_branch b');
			$this->db->where('b.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				c.id_branch
				, b.nama_branch
			');
			$this->db->distinct();
			$this->db->from('bc_cluster c');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('c.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				c.id_branch
				, b.nama_branch
			');
			$this->db->distinct();
			$this->db->from('bd_tap t');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('t.id_tap', $id_divisi);
		}
	}

	function build_query_daftar_2()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				c.id_branch
				, b.nama_branch
				, c.id_cluster
				, c.nama_cluster
				, c.mitra_ad
			');
			$this->db->from('bc_cluster c');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('b.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				c.id_branch
				, b.nama_branch
				, c.id_cluster
				, c.nama_cluster
				, c.mitra_ad
			');
			$this->db->from('bc_cluster c');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('c.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				c.id_branch
				, b.nama_branch
				, c.id_cluster
				, c.nama_cluster
				, c.mitra_ad
			');
			$this->db->from('bc_cluster c');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('c.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				t.id_cluster
				, c.nama_cluster
				, c.mitra_ad
				, c.id_branch
				, b.nama_branch
			');
			$this->db->distinct();
			$this->db->from('bd_tap t');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('t.id_tap', $id_divisi);
		}
	}

	function build_query_daftar_3()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				t.id_cluster
				, c.nama_cluster
				, c.mitra_ad
				, c.id_branch
				, b.nama_branch
				, t.id_tap
				, t.level_tap
				, t.nama_tap
				, t.manager
			');
			$this->db->from('bd_tap t');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('b.id_regional', $id_divisi);
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				t.id_cluster
				, c.nama_cluster
				, c.mitra_ad
				, c.id_branch
				, b.nama_branch
				, t.id_tap
				, t.level_tap
				, t.nama_tap
				, t.manager
			');
			$this->db->from('bd_tap t');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('c.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				t.id_cluster
				, c.nama_cluster
				, c.mitra_ad
				, c.id_branch
				, b.nama_branch
				, t.id_tap
				, t.level_tap
				, t.nama_tap
				, t.manager
			');
			$this->db->from('bd_tap t');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('t.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				t.id_cluster
				, c.nama_cluster
				, c.mitra_ad
				, c.id_branch
				, b.nama_branch
				, t.id_tap
				, t.level_tap
				, t.nama_tap
				, t.manager
			');
			$this->db->from('bd_tap t');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('t.id_tap', $id_divisi);
		}
	}

	function build_query_daftar_4()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
							
					s.id_sales
					, s.nama_sales
	                , s.id_tap
	                , t.nama_tap
					, b.id_branch
					, c.id_cluster	
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('b.id_regional', $id_divisi);
			$this->db->where('s.id_jenis_sales','SSF');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
							
					s.id_sales
					, s.nama_sales
	                , s.id_tap
	                , t.nama_tap
					, b.id_branch
					, c.id_cluster	
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('c.id_branch', $id_divisi);
			$this->db->where('s.id_jenis_sales','SSF');

		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
							
					s.id_sales
					, s.nama_sales
	                , s.id_tap
	                , t.nama_tap
					, b.id_branch
					, c.id_cluster	
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('t.id_cluster', $id_divisi);
			$this->db->where('s.id_jenis_sales','SSF');

		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
							
					s.id_sales
					, s.nama_sales
	                , s.id_tap
	                , t.nama_tap
					, b.id_branch
					, c.id_cluster	
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('t.id_tap', $id_divisi);
			$this->db->where('s.id_jenis_sales','SSF');

		}
	}

	function build_query_daftar_5()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
							
					s.id_sales
					, s.nama_sales
	                , s.id_tap
	                , t.nama_tap
					, b.id_branch
					, c.id_cluster	
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('t.id_tap', $id_divisi);
			$this->db->where('s.id_jenis_sales','SDS');
		}

 if ($id_level == 2) // Branch
		{
			$this->db->select('
							
					s.id_sales
					, s.nama_sales
	                , s.id_tap
	                , t.nama_tap
					, b.id_branch
					, c.id_cluster	
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('c.id_branch', $id_divisi);
			$this->db->where('s.id_jenis_sales','SDS');
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
							
					s.id_sales
					, s.nama_sales
	                , s.id_tap
	                , t.nama_tap
					, b.id_branch
					, c.id_cluster	
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('t.id_cluster', $id_divisi);
			$this->db->where('s.id_jenis_sales','SDS');
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
							
					s.id_sales
					, s.nama_sales
	                , s.id_tap
	                , t.nama_tap
					, b.id_branch
					, c.id_cluster	
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('t.id_tap', $id_divisi);
			$this->db->where('s.id_jenis_sales','SDS');
		}
	}


	function cek_exist()
	{
		return TRUE;
	}

	function check_duplikasi()
	{
		return TRUE;
	}

	function check_dependency($id)
	{
		return TRUE;
	}

	function get_list_download($table=NULL)
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($table == 'branch') // Download Master Branch
		{
			if ($id_level == 1) // Regional
			{
				$this->db->select('
					b.id_branch
					, b.nama_branch
				');
				$this->db->from('bb_branch b');
				$this->db->where('b.id_regional', $id_divisi);
			}
			else if ($id_level == 2) // Branch
			{
				$this->db->select('
					b.id_branch
					, b.nama_branch
				');
				$this->db->from('bb_branch b');
				$this->db->where('b.id_branch', $id_divisi);
			}
			else if ($id_level == 3) // Cluster
			{
				$this->db->select('
					c.id_branch
					, b.nama_branch
				');
				$this->db->distinct();
				$this->db->from('bc_cluster c');
				$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
				$this->db->where('c.id_cluster', $id_divisi);
			}
			else if ($id_level == 4) // TAP
			{
				$this->db->select('
					c.id_branch
					, b.nama_branch
				');
				$this->db->distinct();
				$this->db->from('bd_tap t');
				$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
				$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
				$this->db->where('t.id_tap', $id_divisi);
			}
		}
		else if ($table == 'cluster') // Download Master Cluster
		{
			if ($id_level == 1) // Regional
			{
				$this->db->select('
					c.id_branch
					, b.nama_branch
					, c.id_cluster
					, c.nama_cluster
					, c.mitra_ad
				');
				$this->db->from('bc_cluster c');
				$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
				$this->db->where('b.id_regional', $id_divisi);
			}
			else if ($id_level == 2) // Branch
			{
				$this->db->select('
					c.id_branch
					, b.nama_branch
					, c.id_cluster
					, c.nama_cluster
					, c.mitra_ad
				');
				$this->db->from('bc_cluster c');
				$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
				$this->db->where('c.id_branch', $id_divisi);
			}
			else if ($id_level == 3) // Cluster
			{
				$this->db->select('
					c.id_branch
					, b.nama_branch
					, c.id_cluster
					, c.nama_cluster
					, c.mitra_ad
				');
				$this->db->from('bc_cluster c');
				$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
				$this->db->where('c.id_cluster', $id_divisi);
			}
			else if ($id_level == 4) // TAP
			{
				$this->db->select('
					t.id_cluster
					, c.nama_cluster
					, c.mitra_ad
					, c.id_branch
					, b.nama_branch
				');
				$this->db->distinct();
				$this->db->from('bd_tap t');
				$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
				$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
				$this->db->where('t.id_tap', $id_divisi);
			}
		}
		else if ($table == 'tap') // Download Master TAP
		{
			if ($id_level == 1) // Regional
			{
				$this->db->select('
					t.id_cluster
					, c.nama_cluster
					, c.mitra_ad
					, c.id_branch
					, b.nama_branch
					, t.id_tap
					, t.level_tap
					, t.nama_tap
					, t.manager
				');
				$this->db->from('bd_tap t');
				$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
				$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
				$this->db->where('b.id_regional', $id_divisi);
			}
			else if ($id_level == 2) // Branch
			{
				$this->db->select('
					t.id_cluster
					, c.nama_cluster
					, c.mitra_ad
					, c.id_branch
					, b.nama_branch
					, t.id_tap
					, t.level_tap
					, t.nama_tap
					, t.manager
				');
				$this->db->from('bd_tap t');
				$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
				$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
				$this->db->where('c.id_branch', $id_divisi);
			}
			else if ($id_level == 3) // Cluster
			{
				$this->db->select('
					t.id_cluster
					, c.nama_cluster
					, c.mitra_ad
					, c.id_branch
					, b.nama_branch
					, t.id_tap
					, t.level_tap
					, t.nama_tap
					, t.manager
				');
				$this->db->from('bd_tap t');
				$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
				$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
				$this->db->where('t.id_cluster', $id_divisi);
			}
			else if ($id_level == 4) // TAP
			{
				$this->db->select('
					t.id_cluster
					, c.nama_cluster
					, c.mitra_ad
					, c.id_branch
					, b.nama_branch
					, t.id_tap
					, t.level_tap
					, t.nama_tap
					, t.manager
				');
				$this->db->from('bd_tap t');
				$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
				$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
				$this->db->where('t.id_tap', $id_divisi);
			}
		}

		else if ($table == "salesforce") // Download Master Salesforce
		{
			if ($id_level ==1) //Regional
			{
				$this->db->select('
					s.id_sales
					, s.nama_sales
					, b.id_branch
					, c.id_cluster
					, t.id_tap
					, t.nama_tap

				');
				$this->db->from('db_sales s');
				$this->db->join ('bd_tap t','s.id_tap = t.id_tap');
				$this->db->join('bc_cluster c','t.id_cluster = d.id_cluster');
				$this->db->join('bb_branch b','c.id_branch = b.id_branch');
				$this->db->where('b.id_regional', $id_divisi);
				$this->db->where('s.id_jenis_sales','SSF');
			}
			else if ($id_level == 2) // Branch
			{
				$this->db->select('
					s.id_sales
					, s.nama_sales
					, b.id_branch
					, c.id_cluster
					, t.id_tap
					, t.nama_tap

				');
				$this->db->from('db_sales s');
				$this->db->join ('bd_tap t','s.id_tap = t.id_tap');
				$this->db->join('bc_cluster c','t.id_cluster = d.id_cluster');
				$this->db->join('bb_branch b','c.id_branch = b.id_branch');
				$this->db->where('c.id_branch', $id_divisi);
				$this->db->where('s.id_jenis_sales','SSF');
			}
			else if ($id_level == 3) // Cluster
			{
				$this->db->select('
					s.id_sales
					, s.nama_sales
					, b.id_branch
					, c.id_cluster
					, t.id_tap
					, t.nama_tap

				');
				$this->db->from('db_sales s');
				$this->db->join ('bd_tap t','s.id_tap = t.id_tap');
				$this->db->join('bc_cluster c','t.id_cluster = d.id_cluster');
				$this->db->join('bb_branch b','c.id_branch = b.id_branch');
				$this->db->where('t.id_cluster', $id_divisi);
				$this->db->where('s.id_jenis_sales','SSF');
			}
			else if ($id_level == 4) // TAP
			{
				$this->db->select('
					s.id_sales
					, s.nama_sales
					, b.id_branch
					, c.id_cluster
					, t.id_tap
					, t.nama_tap

				');
				$this->db->from('db_sales s');
				$this->db->join ('bd_tap t','s.id_tap = t.id_tap');
				$this->db->join('bc_cluster c','t.id_cluster = d.id_cluster');
				$this->db->join('bb_branch b','c.id_branch = b.id_branch');
				$this->db->where('t.id_tap', $id_divisi);
				$this->db->where('s.id_jenis_sales','SSF');
			}
		}
		
		else if ($table == "directsales") // Download Master Directsales
		{
			if ($id_level ==1) //Regional
			{
				$this->db->select('
					s.id_sales
					, s.nama_sales
					, b.id_branch
					, c.id_cluster
					, t.id_tap
					, t.nama_tap

				');
				$this->db->from('db_sales s');
				$this->db->join ('bd_tap t','s.id_tap = t.id_tap');
				$this->db->join('bc_cluster c','t.id_cluster = d.id_cluster');
				$this->db->join('bb_branch b','c.id_branch = b.id_branch');
				$this->db->where('b.id_regional', $id_divisi);
				$this->db->where('s.id_jenis_sales','SDS');
			}
			else if ($id_level == 2) // Branch
			{
				$this->db->select('
					s.id_sales
					, s.nama_sales
					, b.id_branch
					, c.id_cluster
					, t.id_tap
					, t.nama_tap

				');
				$this->db->from('db_sales s');
				$this->db->join ('bd_tap t','s.id_tap = t.id_tap');
				$this->db->join('bc_cluster c','t.id_cluster = d.id_cluster');
				$this->db->join('bb_branch b','c.id_branch = b.id_branch');
				$this->db->where('c.id_branch', $id_divisi);
				$this->db->where('s.id_jenis_sales','SDS');
			}
			else if ($id_level == 3) // Cluster
			{
				$this->db->select('
					s.id_sales
					, s.nama_sales
					, b.id_branch
					, c.id_cluster
					, t.id_tap
					, t.nama_tap

				');
				$this->db->from('db_sales s');
				$this->db->join ('bd_tap t','s.id_tap = t.id_tap');
				$this->db->join('bc_cluster c','t.id_cluster = d.id_cluster');
				$this->db->join('bb_branch b','c.id_branch = b.id_branch');
				$this->db->where('t.id_cluster', $id_divisi);
				$this->db->where('s.id_jenis_sales','SDS');
			}
			else if ($id_level == 4) // TAP
			{
				$this->db->select('
					s.id_sales
					, s.nama_sales
					, b.id_branch
					, c.id_cluster
					, t.id_tap
					, t.nama_tap

				');
				$this->db->from('db_sales s');
				$this->db->join ('bd_tap t','s.id_tap = t.id_tap');
				$this->db->join('bc_cluster c','t.id_cluster = d.id_cluster');
				$this->db->join('bb_branch b','c.id_branch = b.id_branch');
				$this->db->where('t.id_tap', $id_divisi);
				$this->db->where('s.id_jenis_sales','SDS');
			}
		}

		else if ($table == 'kabupaten') // Download Master Kabupaten
		{
			if ($id_level == 1) // Regional
			{
				$this->db->select('
					xx.id_kabupaten
					, xx.nama_kabupaten
					, xx.nama_provinsi
				');
				$this->db->from('
					(
						SELECT DISTINCT
							kc.id_kabupaten
							, kb.nama_kabupaten
							, pr.nama_provinsi
						FROM
								cc_kecamatan kc
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						ORDER BY kc.id_kabupaten ASC
					) xx
				');
			}

			else if ($id_level == 2) // Branch
			{
				$this->db->select('
					xx.id_kabupaten
					, xx.nama_kabupaten
					, xx.nama_provinsi
				');
				$this->db->from('
					(
						SELECT DISTINCT
							kc.id_kabupaten
							, kb.nama_kabupaten
							, pr.nama_provinsi
						FROM
								cc_kecamatan kc
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						WHERE (c.id_branch = "'.$id_divisi.'")
						ORDER BY kc.id_kabupaten ASC
					) xx
				');
			}
			else if ($id_level == 3) // Cluster
			{
				$this->db->select('
					xx.id_kabupaten
					, xx.nama_kabupaten
					, xx.nama_provinsi
				');
				$this->db->from('
					(
						SELECT DISTINCT
							kc.id_kabupaten
							, kb.nama_kabupaten
							, pr.nama_provinsi
						FROM
								cc_kecamatan kc
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						WHERE (c.id_cluster = "'.$id_divisi.'")
						ORDER BY kc.id_kabupaten ASC
					) xx
				');
			}
			else if ($id_level == 4) // TAP
			{
				$this->db->select('a.id_cluster');
				$this->db->from('bd_tap a');
				$this->db->where('a.id_tap', $id_divisi);
				$rs = $this->db->get()->row_array();
				$id_cluster = isset($rs['id_cluster']) ? $rs['id_cluster'] : 0;

				$this->db->select('
					xx.id_kabupaten
					, xx.nama_kabupaten
					, xx.nama_provinsi
				');
				$this->db->from('
					(
						SELECT DISTINCT
							kc.id_kabupaten
							, kb.nama_kabupaten
							, pr.nama_provinsi
						FROM
								cc_kecamatan kc
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						WHERE (c.id_cluster = "'.$id_cluster.'")
						ORDER BY kc.id_kabupaten ASC
					) xx
				');
			}
		}
		else if ($table == 'kecamatan') // Download Master Kecamatan
		{
			if ($id_level == 1) // Regional
			{
				$this->db->select('
					xx.id_kecamatan
					, xx.nama_kecamatan
					, xx.nama_kabupaten
					, xx.nama_provinsi
					, xx.nama_cluster
					, xx.nama_branch
				');
				$this->db->from('
					(
						SELECT
								kc.id_kecamatan
								, kc.nama_kecamatan
								, kb.nama_kabupaten
								, pr.nama_provinsi
								, c.nama_cluster
								, b.nama_branch
						FROM
								cc_kecamatan kc
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						ORDER BY kc.id_kecamatan ASC
					) xx
				');
			}
			else if ($id_level == 2) // Branch
			{
				$this->db->select('
					xx.id_kecamatan
					, xx.nama_kecamatan
					, xx.nama_kabupaten
					, xx.nama_provinsi
					, xx.nama_cluster
					, xx.nama_branch
				');
				$this->db->from('
					(
						SELECT
								kc.id_kecamatan
								, kc.nama_kecamatan
								, kb.nama_kabupaten
								, pr.nama_provinsi
								, c.nama_cluster
								, b.nama_branch
						FROM
								cc_kecamatan kc
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						WHERE (c.id_branch = "'.$id_divisi.'")
						ORDER BY kc.id_kecamatan ASC
					) xx
				');
			}
			else if ($id_level == 3) // Cluster
			{
				$this->db->select('
					xx.id_kecamatan
					, xx.nama_kecamatan
					, xx.nama_kabupaten
					, xx.nama_provinsi
					, xx.nama_cluster
					, xx.nama_branch
				');
				$this->db->from('
					(
						SELECT
								kc.id_kecamatan
								, kc.nama_kecamatan
								, kb.nama_kabupaten
								, pr.nama_provinsi
								, c.nama_cluster
								, b.nama_branch
						FROM
								cc_kecamatan kc
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						WHERE (c.id_cluster = "'.$id_divisi.'")
						ORDER BY kc.id_kecamatan ASC
					) xx
				');
			}
			else if ($id_level == 4) // TAP
			{
				$this->db->select('a.id_cluster');
				$this->db->from('bd_tap a');
				$this->db->where('a.id_tap', $id_divisi);
				$rs = $this->db->get()->row_array();
				$id_cluster = isset($rs['id_cluster']) ? $rs['id_cluster'] : 0;

				$this->db->select('
					xx.id_kecamatan
					, xx.nama_kecamatan
					, xx.nama_kabupaten
					, xx.nama_provinsi
					, xx.nama_cluster
					, xx.nama_branch
				');
				$this->db->from('
					(
						SELECT
								kc.id_kecamatan
								, kc.nama_kecamatan
								, kb.nama_kabupaten
								, pr.nama_provinsi
								, c.nama_cluster
								, b.nama_branch
						FROM
								cc_kecamatan kc
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						WHERE (c.id_cluster = "'.$id_cluster.'")
						ORDER BY kc.id_kecamatan ASC
					) xx
				');
			}
		}
		else if ($table == 'kelurahan') // Download Master Kelurahan
		{
			if ($id_level == 1) // Regional
			{
				$this->db->select('
					xx.id_kelurahan
					, xx.nama_kelurahan
					, xx.nama_kecamatan
					, xx.nama_kabupaten
					, xx.nama_provinsi
					, xx.nama_cluster
					, xx.nama_branch
				');
				$this->db->from('
					(
						SELECT
								kl.id_kelurahan
								, kl.nama_kelurahan
								, kc.nama_kecamatan
								, kb.nama_kabupaten
								, pr.nama_provinsi
								, c.nama_cluster
								, b.nama_branch
						FROM
								cd_kelurahan kl
								INNER JOIN cc_kecamatan kc
										ON (kl.id_kecamatan = kc.id_kecamatan)
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						ORDER BY kl.id_kelurahan ASC
					) xx
				');
			}
			else if ($id_level == 2) // Branch
			{
				$this->db->select('
					xx.id_kelurahan
					, xx.nama_kelurahan
					, xx.nama_kecamatan
					, xx.nama_kabupaten
					, xx.nama_provinsi
					, xx.nama_cluster
					, xx.nama_branch
				');
				$this->db->from('
					(
						SELECT
								kl.id_kelurahan
								, kl.nama_kelurahan
								, kc.nama_kecamatan
								, kb.nama_kabupaten
								, pr.nama_provinsi
								, c.nama_cluster
								, b.nama_branch
						FROM
								cd_kelurahan kl
								INNER JOIN cc_kecamatan kc
										ON (kl.id_kecamatan = kc.id_kecamatan)
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						WHERE (c.id_branch = "'.$id_divisi.'")
						ORDER BY kl.id_kelurahan ASC
					) xx
				');
			}
			else if ($id_level == 3) // Cluster
			{
				$this->db->select('
					xx.id_kelurahan
					, xx.nama_kelurahan
					, xx.nama_kecamatan
					, xx.nama_kabupaten
					, xx.nama_provinsi
					, xx.nama_cluster
					, xx.nama_branch
				');
				$this->db->from('
					(
						SELECT
								kl.id_kelurahan
								, kl.nama_kelurahan
								, kc.nama_kecamatan
								, kb.nama_kabupaten
								, pr.nama_provinsi
								, c.nama_cluster
								, b.nama_branch
						FROM
								cd_kelurahan kl
								INNER JOIN cc_kecamatan kc
										ON (kl.id_kecamatan = kc.id_kecamatan)
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						WHERE (c.id_cluster = "'.$id_divisi.'")
						ORDER BY kl.id_kelurahan ASC
					) xx
				');
			}
			else if ($id_level == 4) // TAP
			{
				$this->db->select('a.id_cluster');
				$this->db->from('bd_tap a');
				$this->db->where('a.id_tap', $id_divisi);
				$rs = $this->db->get()->row_array();
				$id_cluster = isset($rs['id_cluster']) ? $rs['id_cluster'] : 0;

				$this->db->select('
					xx.id_kelurahan
					, xx.nama_kelurahan
					, xx.nama_kecamatan
					, xx.nama_kabupaten
					, xx.nama_provinsi
					, xx.nama_cluster
					, xx.nama_branch
				');
				$this->db->from('
					(
						SELECT
								kl.id_kelurahan
								, kl.nama_kelurahan
								, kc.nama_kecamatan
								, kb.nama_kabupaten
								, pr.nama_provinsi
								, c.nama_cluster
								, b.nama_branch
						FROM
								cd_kelurahan kl
								INNER JOIN cc_kecamatan kc
										ON (kl.id_kecamatan = kc.id_kecamatan)
								INNER JOIN cb_kabupaten kb
										ON (kc.id_kabupaten = kb.id_kabupaten)
								INNER JOIN ca_provinsi pr
										ON (kb.id_provinsi = pr.id_provinsi)
								INNER JOIN bc_cluster c
										ON (kc.id_cluster = c.id_cluster)
								INNER JOIN bb_branch b
										ON (c.id_branch = b.id_branch)
						WHERE (c.id_cluster = "'.$id_cluster.'")
						ORDER BY kl.id_kelurahan ASC
					) xx
				');
			}
		}
		else if ($table == 'jenjang') // Download Master Sekolah - Jenjang
		{
			$this->db->select('
				s.jenjang
			');
			$this->db->distinct();
			$this->db->from('ec_sekolah s');
			$this->db->where('s.jenjang IS NOT NULL');
		}

		$query = $this->db->get();

		return $query->result();
	}
}
?>