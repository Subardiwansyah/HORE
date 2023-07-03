<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_direct_sales_model extends Base_Model {

	var $fieldmap_daftar_1 = array('id_sales', 'nama_sales', 'nama_tap', 'nama_cluster');
	var $column_order_1 = array(null, 'id_sales', 'nama_sales', 'nama_tap', 'nama_cluster');
	var $column_search_1 = array('id_sales', 'nama_sales', 'nama_tap', 'nama_cluster');

	var $column_order_2 = array('id_sales', 'nama_sales', 'tgl_masuk', 'tgl_keluar', 'nama_tap', 'nama_cluster');
	var $fieldmap_daftar_2 = array('id_sales', 'nama_sales', 'tgl_masuk', 'tgl_keluar', 'nama_tap', 'nama_cluster');
	var $column_search_2 = array('id_sales', 'nama_sales', 'tgl_masuk', 'tgl_keluar', 'nama_tap', 'nama_cluster');

	function __construct()
	{
		parent::__construct();
	}

	function build_query_daftar_1()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				s.id_sales
				, s.nama_sales
				, t.nama_tap
				, c.nama_cluster
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', 'SDS');
			$this->db->where('UPPER(s.status)', 'AKTIF');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				s.id_sales
				, s.nama_sales
				, t.nama_tap
				, c.nama_cluster
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', 'SDS');
			$this->db->where('UPPER(s.status)', 'AKTIF');
			$this->db->where('c.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				s.id_sales
				, s.nama_sales
				, t.nama_tap
				, c.nama_cluster
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', 'SDS');
			$this->db->where('UPPER(s.status)', 'AKTIF');
			$this->db->where('t.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				s.id_sales
				, s.nama_sales
				, t.nama_tap
				, c.nama_cluster
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', 'SDS');
			$this->db->where('UPPER(s.status)', 'AKTIF');
			$this->db->where('s.id_tap', $id_divisi);
		}
	}

	function build_query_daftar_2()
	{
		$id_level = $this->session->userdata('ID_LEVEL');
		$id_divisi = $this->session->userdata('ID_DIVISI');

		if ($id_level == 1) // Regional
		{
			$this->db->select('
				s.id_sales
				, s.nama_sales
				, t.nama_tap
				, c.nama_cluster
				, s.tgl_masuk
				, s.tgl_keluar
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', 'SDS');
			$this->db->where('UPPER(s.status)', 'TIDAK AKTIF');
		}
		else if ($id_level == 2) // Branch
		{
			$this->db->select('
				s.id_sales
				, s.nama_sales
				, t.nama_tap
				, c.nama_cluster
				, s.tgl_masuk
				, s.tgl_keluar
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', 'SDS');
			$this->db->where('UPPER(s.status)', 'TIDAK AKTIF');
			$this->db->where('c.id_branch', $id_divisi);
		}
		else if ($id_level == 3) // Cluster
		{
			$this->db->select('
				s.id_sales
				, s.nama_sales
				, t.nama_tap
				, c.nama_cluster
				, s.tgl_masuk
				, s.tgl_keluar
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', 'SDS');
			$this->db->where('UPPER(s.status)', 'TIDAK AKTIF');
			$this->db->where('t.id_cluster', $id_divisi);
		}
		else if ($id_level == 4) // TAP
		{
			$this->db->select('
				s.id_sales
				, s.nama_sales
				, t.nama_tap
				, c.nama_cluster
				, s.tgl_masuk
				, s.tgl_keluar
			');
			$this->db->from('db_sales s');
			$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
			$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
			$this->db->join('bb_branch b', 'c.id_branch = b.id_branch');
			$this->db->where('UPPER(s.id_jenis_sales)', 'SDS');
			$this->db->where('UPPER(s.status)', 'TIDAK AKTIF');
			$this->db->where('s.id_tap', $id_divisi);
		}
	}

	function build_query_form($id=NULL)
	{
		$this->db->select('
			s.id_jenis_sales
			, s.id_tap
			, t.nama_tap
			, t.id_cluster
			, c.nama_cluster
			, s.id_sales
			, s.nama_sales
			, s.email
			, s.limit_link_aja
			, s.tgl_masuk
			, s.tgl_keluar
			, s.id_sales_pengganti
			, s.status
			, s.lastmodified
		');
		$this->db->from('db_sales s');
		$this->db->join('bd_tap t', 's.id_tap = t.id_tap');
		$this->db->join('bc_cluster c', 't.id_cluster = c.id_cluster');
		$this->db->where('s.id_sales', $id);
	}

	function build_query_hapus($id=NULL)
	{
		$this->db->where('id_sales', $id);
		$this->db->delete('db_sales');
		$this->check_trans_status('delete db_sales failed');
	}

	function penomoran()
	{
		$this->db->select('MAX(CAST(RIGHT(s.id_sales, 4) AS UNSIGNED)) AS max_no');
		$this->db->from('db_sales s');
		$this->db->where('UPPER(LEFT(s.id_sales, 3)) = ', 'SDS');
		$rs = $this->db->get()->row_array();

		$max_no = $rs['max_no'] ? $rs['max_no'] + 1 : 1;
		$max_no = $this->format_nomor($max_no, 4);

		$this->nomor = 'SDS'.$max_no;
	}

	function insert_sales()
	{
		$id_sales = $this->input->post('id') ? $this->input->post('id') : NULL;

		$this->db->select('1');
		$this->db->from('db_sales');
		$this->db->where('id_sales', $id_sales);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$status = $this->input->post('status') ? $this->input->post('status') : NULL;

			if ($status == 'TIDAK AKTIF')
			{
				$data_x = array(
					'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
					'nama_sales' => $this->input->post('nm_sales') ? $this->input->post('nm_sales') : NULL,
					'email' => $this->input->post('email') ? $this->input->post('email') : NULL,
					'tgl_keluar' => $this->input->post('tgl_keluar') ? prepare_date($this->input->post('tgl_keluar')) : NULL,
					'status' => $this->input->post('status') ? $this->input->post('status') : NULL
				);
			}
			else
			{
				$data_x = array(
					'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
					'nama_sales' => $this->input->post('nm_sales') ? $this->input->post('nm_sales') : NULL,
					'email' => $this->input->post('email') ? $this->input->post('email') : NULL,
					'status' => $this->input->post('status') ? $this->input->post('status') : NULL
				);
			}

			$this->db->where('id_sales', $id_sales);
			$this->db->update('db_sales', $data_x);
			$this->check_trans_status('update db_sales failed');
		}
		else
		{
			$data_x = array(
				'id_jenis_sales' => 'SDS',
				'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
				'id_sales' => $this->nomor,
				'nama_sales' => $this->input->post('nm_sales') ? $this->input->post('nm_sales') : NULL,
				'email' => $this->input->post('email') ? $this->input->post('email') : NULL,
				'tgl_masuk' => $this->input->post('tgl_masuk') ? prepare_date($this->input->post('tgl_masuk')) : NULL,
				'status' => $this->input->post('status') ? $this->input->post('status') : NULL
			);

			$this->db->insert('db_sales', $data_x);
			$this->check_trans_status('insert db_sales failed');

			$id_sales = $this->nomor;
		}

		$this->id = $id_sales;
	}

	function update_sales()
	{
		$mode = $this->input->post('id') ? 'Edit' : 'New';
		$pengganti = $this->input->post('pengganti') ? $this->input->post('pengganti') : 1; // 1 : New; 2 : Rotasi
		$sales_lama = $this->input->post('id_sales_lama') ? $this->input->post('id_sales_lama') : NULL;
		$sales_baru = $this->nomor;

		if ($mode == 'New')
		{
			$data_x = array(
				'id_sales_pengganti' => $sales_baru,
				'tgl_keluar' => $this->input->post('tgl_keluar_lama') ? prepare_date($this->input->post('tgl_keluar_lama')) : NULL,
				'status' => $this->input->post('status_lama') ? $this->input->post('status_lama') : NULL
			);

			$this->db->where('id_sales', $sales_lama);
			$this->db->update('db_sales', $data_x);
			$this->check_trans_status('update db_sales failed');
		}

		if ($pengganti == 2)
		{
			$this->db->where('id_divisi', $sales_lama);
			$this->db->where('id_level', 7);
			$this->db->update('ab_users', array('status' => 'TIDAK AKTIF'));
			$this->check_trans_status('update ab_users failed');
		}
	}

	function insert_user()
	{
		$email = $this->input->post('email') ? $this->input->post('email') : NULL;
		$sales_lama = $this->input->post('id_sales_lama') ? $this->input->post('id_sales_lama') : NULL;
		$status = $this->input->post('status') ? $this->input->post('status') : NULL;

		$this->db->select('1');
		$this->db->from('ab_users');
		$this->db->where('id_divisi', $this->id);
		$this->db->where('id_level', 7);
		$rs = $this->db->get()->row_array();

		if ($rs)
		{
			$data_x = array(
				'email' => $email,
				'status' => $status
			);

			$this->db->where('id_divisi', $this->id);
			$this->db->where('id_level', 7);
			$this->db->update('ab_users', $data_x);
			$this->check_trans_status('update ab_users failed');
		}
		else
		{
			$data_x = array(
				'id_level' => 7,
				'id_divisi' => $this->id,
				'username' => $this->id,
				'password' => sha1(md5($this->id)),
				'pin' => $this->id,
				'email' => $email
			);

			$this->db->insert('ab_users', $data_x);
			$this->check_trans_status('insert ab_users failed');
		}
	}

	function save_detail()
	{
		$this->penomoran();
		$this->insert_sales();
		$this->update_sales();
		$this->insert_user();
	}

	function cek_exist()
	{
		$id = $this->input->post('id') ? $this->input->post('id') : NULL;

		if($id != NULL)
		{
			$this->db->select('COUNT(id_sales) AS data_exists');
			$this->db->from('db_sales');
			$this->db->where('id_sales', $this->input->post('id'));
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
		return TRUE;
	}
}
?>