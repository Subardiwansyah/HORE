<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pilih extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Pilih_model', 'data_model');
	}

	function get_provinsi_inmaster()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_provinsi_inmaster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_provinsi'],
					'kode' => $result[$i]['id_provinsi'],
					'nama' => $result[$i]['nama_provinsi'],
					'text' => $result[$i]['nama_provinsi']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_kabupaten_inmaster()
	{
		$param = array(
			'id_provinsi' => $this->input->post('id_provinsi') ? $this->input->post('id_provinsi') : NULL,
			'q' => $this->input->post('q')
		);

		$result = $this->data_model->get_kabupaten_inmaster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_kabupaten'],
					'kode' => $result[$i]['id_kabupaten'],
					'nama' => $result[$i]['nama_kabupaten'],
					'text' => $result[$i]['nama_kabupaten']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_kecamatan_inmaster()
	{
		$param = array(
			'id_kab' => $this->input->post('id_kab') ? $this->input->post('id_kab') : NULL,
			'q' => $this->input->post('q')
		);

		$result = $this->data_model->get_kecamatan_inmaster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_kecamatan'],
					'kode' => $result[$i]['id_kecamatan'],
					'nama' => $result[$i]['nama_kecamatan'],
					'text' => $result[$i]['nama_kecamatan']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_kelurahan_inmaster()
	{
		$param = array(
			'id_kec' => $this->input->post('id_kec') ? $this->input->post('id_kec') : NULL,
			'q' => $this->input->post('q')
		);

		$result = $this->data_model->get_kelurahan_inmaster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_kelurahan'],
					'kode' => $result[$i]['id_kelurahan'],
					'nama' => $result[$i]['nama_kelurahan'],
					'text' => $result[$i]['nama_kelurahan']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_tahun_inmaster()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_tahun_inmaster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['tahun'],
					'kode' => '',
					'nama' => $result[$i]['tahun'],
					'text' => $result[$i]['tahun']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_periode_indasbhoard()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_periode_indasbhoard($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['periode'],
					'nama' => $result[$i]['periode'],
					'tahun' => $result[$i]['tahun'],
					'bulan' => $result[$i]['bulan'],
					'text' => $result[$i]['periode']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_periodekuartal()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_periodekuartal($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['kuartal'],
					'nama' => $result[$i]['kuartal'],
					'tahun' => $result[$i]['tahun'],
					'bulan' => $result[$i]['bulan'],
					'text' => $result[$i]['kuartal']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_pilihan_indashboard()
	{
		$param = array(
			'kategori' => $this->input->post('kategori') ? $this->input->post('kategori') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_pilihan_indashboard($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id'],
					'kode' => $result[$i]['id'],
					'nama' => $result[$i]['nama'],
					'text' => $result[$i]['nama']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_branch_inmaster()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_branch_inmaster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_branch'],
					'kode' => $result[$i]['id_branch'],
					'nama' => $result[$i]['nama_branch'],
					'text' => $result[$i]['nama_branch']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_cluster_inmaster()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_cluster_inmaster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_cluster'],
					'kode' => $result[$i]['id_cluster'],
					'nama' => $result[$i]['nama_cluster'],
					'text' => $result[$i]['nama_cluster']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_cluster_inbranch()
	{
		$param = array(
			'id_branch' => $this->input->post('id_branch') ? $this->input->post('id_branch') : 0,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_cluster_inbranch($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_cluster'],
					'kode' => $result[$i]['id_cluster'],
					'nama' => $result[$i]['nama_cluster'],
					'text' => $result[$i]['nama_cluster']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_tap_inmaster()
	{
		$param = array(
			'id_cluster' => $this->input->post('id_cluster') ? $this->input->post('id_cluster') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_tap_inmaster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_tap'],
					'kode' => $result[$i]['id_tap'],
					'nm_cluster' => $result[$i]['nama_cluster'],
					'nama' => $result[$i]['nama_tap'],
					'text' => $result[$i]['nama_tap']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_tap_incluster()
	{
		$param = array(
			'id_cluster' => $this->input->post('id_cluster') ? $this->input->post('id_cluster') : 0,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_tap_incluster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_tap'],
					'kode' => $result[$i]['id_tap'],
					'nama' => $result[$i]['nama_tap'],
					'text' => $result[$i]['nama_tap']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_bct_inmarketaudit()
	{
		$param = array(
			'kategori' => $this->input->post('kategori') ? $this->input->post('kategori') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_bct_inmarketaudit($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id'],
					'kode' => $result[$i]['id'],
					'nama' => $result[$i]['nama'],
					'text' => $result[$i]['nama']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_jenis_sales_inmaster()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_jenis_sales_inmaster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_jenis_sales'],
					'kode' => $result[$i]['id_jenis_sales'],
					'nama' => $result[$i]['nama_jenis_sales'],
					'text' => $result[$i]['nama_jenis_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_sales_intap()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL,
			'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_sales_intap($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_sales'],
					'kode' => $result[$i]['id_sales'],
					'nama' => $result[$i]['nama_sales'],
					'text' => $result[$i]['nama_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_sales_indistribution()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_sales_indistribution($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_sales'],
					'kode' => $result[$i]['id_sales'],
					'nama' => $result[$i]['nama_sales'],
					'limit_la' => isset($result[$i]['limit_link_aja']) ? format_currency($result[$i]['limit_link_aja']) : '0,00',
					'text' => $result[$i]['nama_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_sales_inrotasi()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL,
			'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_sales_inrotasi($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_sales'],
					'kode' => $result[$i]['id_sales'],
					'nama' => $result[$i]['nama_sales'],
					'email' => $result[$i]['email'],
					'nm_tap' => $result[$i]['nama_tap'],
					'text' => $result[$i]['nama_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_sales_inpjp()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_sales_inpjp($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_sales'],
					'kode' => $result[$i]['id_sales'],
					'nama' => $result[$i]['nama_sales'],
					'id_tap' => $result[$i]['id_tap'],
					'nm_tap' => $result[$i]['nama_tap'],
					'nm_cluster' => $result[$i]['nama_cluster'],
					'nm_branch' => $result[$i]['nama_branch'],
					'text' => $result[$i]['nama_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_sales_inpenjualan()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_sales_inpenjualan($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_sales'],
					'kode' => $result[$i]['id_sales'],
					'nama' => $result[$i]['nama_sales'],
					'id_tap' => $result[$i]['id_tap'],
					'nm_tap' => $result[$i]['nama_tap'],
					'nm_cluster' => $result[$i]['nama_cluster'],
					'nm_branch' => $result[$i]['nama_branch'],
					'text' => $result[$i]['nama_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_lokasi_inpjp()
	{
		$param = array(
			'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : 0,
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : 0,
			'id_sales' => $this->input->post('id_sales') ? $this->input->post('id_sales') : 0,
			'hari' => $this->input->post('hari') ? $this->input->post('hari') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_lokasi_inpjp($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_lokasi'],
					'kode' => $result[$i]['kode'],
					'nama' => $result[$i]['nama_lokasi'],
					'jenis_lokasi' => $result[$i]['jenis_lokasi'],
					'text' => $result[$i]['nama_lokasi']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_produk_inmaster()
	{
		$param = array(
			'id_jns_produk' => $this->input->post('id_jns_produk') ? $this->input->post('id_jns_produk') : 0,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_produk_inmaster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_produk'],
					'kode' => $result[$i]['kode_produk'],
					'nama' => $result[$i]['nama_produk'],
					'text' => $result[$i]['nama_produk']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_produk_ininject()
	{
		$param = array(
			'id_jns_produk' => $this->input->post('id_jns_produk') ? $this->input->post('id_jns_produk') : NULL,
			'id_kab' => $this->input->post('id_kab') ? $this->input->post('id_kab') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_produk_ininject($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_produk'],
					'kode' => $result[$i]['kode_produk'],
					'nama' => $result[$i]['nama_produk'],
					'harga' => $result[$i]['harga_paket'] ? $result[$i]['harga_paket'] : 0,
					'text' => $result[$i]['nama_produk']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_pilihan_by_dashboard()
	{
		$param = array(
			'kategori' => $this->input->post('kategori') ? $this->input->post('kategori') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_pilihan_by_dashboard($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id'],
					'kode' => $result[$i]['id'],
					'nama' => $result[$i]['nama'],
					'text' => $result[$i]['nama']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_cluster()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_cluster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_cluster'],
					'kode' => $result[$i]['id_cluster'],
					'nama' => $result[$i]['nama_cluster'],
					'text' => $result[$i]['nama_cluster']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_tap()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_tap($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_tap'],
					'kode' => $result[$i]['id_tap'],
					'nama' => $result[$i]['nama_tap'],
					'id_cluster' => $result[$i]['id_cluster'],
					'nm_cluster' => $result[$i]['nama_cluster'],
					'text' => $result[$i]['nama_tap']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_tap_by_cluster()
	{
		$param = array(
			'id_cluster' => $this->input->post('id_cluster') ? $this->input->post('id_cluster') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_tap_by_cluster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_tap'],
					'kode' => $result[$i]['id_tap'],
					'nama' => $result[$i]['nama_tap'],
					'text' => $result[$i]['nama_tap']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_tap_by_lokasi()
	{
		$param = array(
			'id_kec' => $this->input->post('id_kec') ? $this->input->post('id_kec') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_tap_by_lokasi($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_tap'],
					'kode' => $result[$i]['id_tap'],
					'nama' => $result[$i]['nama_tap'],
					'text' => $result[$i]['nama_tap']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_tap_by_master_sales()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_tap_by_master_sales($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_tap'],
					'kode' => '',
					'nama' => $result[$i]['nama_tap'],
					'nm_cluster' => $result[$i]['nama_cluster'],
					'text' => $result[$i]['nama_tap']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_provinsi()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_provinsi($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_provinsi'],
					'kode' => $result[$i]['id_provinsi'],
					'nama' => $result[$i]['nama_provinsi'],
					'text' => $result[$i]['nama_provinsi']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_kabupaten()
	{
		$param = array(
			'id_provinsi' => $this->input->post('id_provinsi') ? $this->input->post('id_provinsi') : NULL,
			'q' => $this->input->post('q')
		);

		$result = $this->data_model->get_kabupaten($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_kabupaten'],
					'kode' => $result[$i]['id_kabupaten'],
					'nama' => $result[$i]['nama_kabupaten'],
					'text' => $result[$i]['nama_kabupaten']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_kabupaten_by_produk()
	{
		$param = array(
			'q' => $this->input->post('q')
		);

		$result = $this->data_model->get_kabupaten_by_produk($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_kabupaten'],
					'kode' => $result[$i]['id_kabupaten'],
					'nama' => $result[$i]['nama_kabupaten'],
					'nm_provinsi' => $result[$i]['nama_provinsi'],
					'text' => $result[$i]['nama_kabupaten']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_kecamatan()
	{
		$param = array(
			'id_kab' => $this->input->post('id_kab') ? $this->input->post('id_kab') : NULL,
			'q' => $this->input->post('q')
		);

		$result = $this->data_model->get_kecamatan($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_kecamatan'],
					'kode' => $result[$i]['id_kecamatan'],
					'nama' => $result[$i]['nama_kecamatan'],
					'text' => $result[$i]['nama_kecamatan']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_kelurahan()
	{
		$param = array(
			'id_kec' => $this->input->post('id_kec') ? $this->input->post('id_kec') : NULL,
			'q' => $this->input->post('q')
		);

		$result = $this->data_model->get_kelurahan($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_kelurahan'],
					'kode' => $result[$i]['id_kelurahan'],
					'nama' => $result[$i]['nama_kelurahan'],
					'text' => $result[$i]['nama_kelurahan']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_jenis_sales()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_jenis_sales($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_jenis_sales'],
					'kode' => $result[$i]['id_jenis_sales'],
					'nama' => $result[$i]['nama_jenis_sales'],
					'text' => $result[$i]['nama_jenis_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_sales()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_sales($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_sales'],
					'kode' => $result[$i]['id_sales'],
					'nama' => $result[$i]['nama_sales'],
					'email' => $result[$i]['email'],
					'nm_tap' => $result[$i]['nama_tap'],
					'nm_cluster' => $result[$i]['nama_cluster'],
					'nm_branch' => $result[$i]['nama_branch'],
					'id_jns_sales' => $result[$i]['id_jenis_sales'],
					'limit_la' => isset($result[$i]['limit_link_aja']) ? format_currency($result[$i]['limit_link_aja']) : '0,00',
					'text' => $result[$i]['nama_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_sales_by_jenis_sales()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : 0,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_sales_by_jenis_sales($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_sales'],
					'kode' => $result[$i]['id_sales'],
					'nama' => $result[$i]['nama_sales'],
					'email' => $result[$i]['email'],
					'id_tap' => $result[$i]['id_tap'],
					'nm_tap' => $result[$i]['nama_tap'],
					'id_cluster' => $result[$i]['id_cluster'],
					'nm_cluster' => $result[$i]['nama_cluster'],
					'id_branch' => $result[$i]['id_branch'],
					'nm_branch' => $result[$i]['nama_branch'],
					'text' => $result[$i]['nama_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_sales_by_tap()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL,
			'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_sales_by_tap($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_sales'],
					'kode' => $result[$i]['id_sales'],
					'nama' => $result[$i]['nama_sales'],
					'id_jns_sales' => $result[$i]['id_jenis_sales'],
					'email' => $result[$i]['email'],
					'nm_tap' => $result[$i]['nama_tap'],
					'nm_cluster' => $result[$i]['nama_cluster'],
					'nm_branch' => $result[$i]['nama_branch'],
					'text' => $result[$i]['nama_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_sales_by_setting_pjp()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_sales_by_setting_pjp($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_sales'],
					'kode' => $result[$i]['id_sales'],
					'nama' => $result[$i]['nama_sales'],
					'email' => $result[$i]['email'],
					'id_tap' => $result[$i]['id_tap'],
					'nm_tap' => $result[$i]['nama_tap'],
					'nm_cluster' => $result[$i]['nama_cluster'],
					'nm_branch' => $result[$i]['nama_branch'],
					'text' => $result[$i]['nama_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_sales_by_promotion()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_sales_by_promotion($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_sales'],
					'kode' => $result[$i]['id_sales'],
					'nama' => $result[$i]['nama_sales'],
					'text' => $result[$i]['nama_sales']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_jenis_lokasi()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_jenis_lokasi($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_jenis_lokasi'],
					'kode' => $result[$i]['id_jenis_lokasi'],
					'nama' => $result[$i]['nama_jenis_lokasi'],
					'text' => $result[$i]['nama_jenis_lokasi']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_jenis_lokasi_by_merchandising()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_jenis_lokasi_by_merchandising($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_jenis_lokasi'],
					'kode' => $result[$i]['id_jenis_lokasi'],
					'nama' => $result[$i]['nama_jenis_lokasi'],
					'text' => $result[$i]['nama_jenis_lokasi']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_jenis_lokasi_by_history_order()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_jenis_lokasi_by_history_order($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_jenis_lokasi'],
					'kode' => '',
					'nama' => $result[$i]['nama_jenis_lokasi'],
					'text' => $result[$i]['nama_jenis_lokasi']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_universitas()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_universitas($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_universitas'],
					'kode' => $result[$i]['id_universitas'],
					'nama' => $result[$i]['nama_universitas'],
					'text' => $result[$i]['nama_universitas']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_tempat_by_pjp_setting()
	{
		$param = array(
			'id_jns_sales' => $this->input->post('id_jns_sales') ? $this->input->post('id_jns_sales') : 0,
			'id_sales' => $this->input->post('id_sales') ? $this->input->post('id_sales') : 0,
			'hari' => $this->input->post('hari') ? $this->input->post('hari') : NULL,
			'id_tap' => $this->input->post('id_tap') ? $this->input->post('id_tap') : 0,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_tempat_by_pjp_setting($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_tempat'],
					'kode' => $result[$i]['id_tempat'],
					'nama' => $result[$i]['nama_tempat'],
					'jenis_tempat' => $result[$i]['jenis_tempat'],
					'text' => $result[$i]['nama_tempat']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_jenis_outlet()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_jenis_outlet($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_jenis_outlet'],
					'kode' => '',
					'nama' => $result[$i]['nama_jenis_outlet'],
					'text' => $result[$i]['nama_jenis_outlet']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_no_kunjungan()
	{
		$param = array(
			'id_sales' => $this->input->post('id_sales') ? $this->input->post('id_sales') : 0,
			'hari' => $this->input->post('hari') ? $this->input->post('hari') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_no_kunjungan($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['no_kunjungan'],
					'kode' => '',
					'nama' => $result[$i]['no_kunjungan'],
					'text' => $result[$i]['no_kunjungan']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_produk()
	{
		$param = array(
			'id_jns_produk' => $this->input->post('id_jns_produk') ? $this->input->post('id_jns_produk') : 0,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_produk($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_produk'],
					'kode' => $result[$i]['kode_produk'],
					'nama' => $result[$i]['nama_produk'],
					'text' => $result[$i]['nama_produk']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_zona()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_zona($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_zona'],
					'kode' => '',
					'nama' => $result[$i]['nama_zona'],
					'text' => $result[$i]['nama_zona']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_jenis_produk()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL,
			'jns_produk' => $this->input->post('jns_produk') ? $this->input->post('jns_produk') : 'INJECT'
		);

		$result = $this->data_model->get_jenis_produk($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_jenis_produk'],
					'kode' => '',
					'nama' => $result[$i]['nama_jenis_produk'],
					'text' => $result[$i]['nama_jenis_produk']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_jenis_inject()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_jenis_inject($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_jenis_inject'],
					'kode' => '',
					'nama' => $result[$i]['nama_jenis_inject'],
					'text' => $result[$i]['nama_jenis_inject']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_produk_by_proses_inject()
	{
		$param = array(
			'jenis_produk' => $this->input->post('jenis_produk') ? $this->input->post('jenis_produk') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_produk_by_proses_inject($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_produk'],
					'kode' => $result[$i]['kode_produk'],
					'nama' => $result[$i]['nama_produk'],
					'harga' => $result[$i]['harga_paket'] ? $result[$i]['harga_paket'] : 0,
					'text' => $result[$i]['nama_produk']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_tahun()
	{
		$param = array(
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_tahun($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['tahun'],
					'kode' => '',
					'nama' => $result[$i]['tahun'],
					'text' => $result[$i]['tahun']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_bulan()
	{
		$param = array(
			'tahun' => $this->input->post('tahun') ? $this->input->post('tahun') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_bulan($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['bulan'],
					'kode' => '',
					'nama' => nama_bulan($result[$i]['bulan']),
					'text' => nama_bulan($result[$i]['bulan'])
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_minggu()
	{
		$param = array(
			'tahun' => $this->input->post('tahun') ? $this->input->post('tahun') : NULL,
			'bulan' => $this->input->post('bulan') ? $this->input->post('bulan') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_minggu($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['minggu'],
					'kode' => '',
					'nama' => $result[$i]['minggu'],
					'text' => $result[$i]['minggu']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_pilihan_by_merchandising()
	{
		$param = array(
			'kategori' => $this->input->post('kategori') ? $this->input->post('kategori') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_pilihan_by_merchandising($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id'],
					'kode' => $result[$i]['id'],
					'nama' => $result[$i]['nama'],
					'text' => $result[$i]['nama']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_pilihan_by_promotion()
	{
		$param = array(
			'kategori' => $this->input->post('kategori') ? $this->input->post('kategori') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_pilihan_by_promotion($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id'],
					'kode' => $result[$i]['id'],
					'nama' => $result[$i]['nama'],
					'text' => $result[$i]['nama']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function get_pilihan_by_market_audit()
	{
		$param = array(
			'kategori' => $this->input->post('kategori') ? $this->input->post('kategori') : NULL,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_pilihan_by_market_audit($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id'],
					'kode' => $result[$i]['id'],
					'nama' => $result[$i]['nama'],
					'text' => $result[$i]['nama']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

function get_tap_incluster_inKPI()
	{
		$param = array(
			'id_cluster' => $this->input->post('id_cluster') ? $this->input->post('id_cluster') : 0,
			'q' => $this->input->post('q') ? $this->input->post('q') : NULL
		);

		$result = $this->data_model->get_tap_incluster($param);
		$response = (object) NULL;
		$response->results = array();

		if ($result)
		{
			for($i=0; $i<count($result); $i++)
			{
				$response->results[] = array(
					'id' => $result[$i]['id_tap'],
					'kode' => $result[$i]['id_tap'],
					'nama' => $result[$i]['nama_tap'],
					'text' => $result[$i]['nama_tap']
				);
			}
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

}
?>