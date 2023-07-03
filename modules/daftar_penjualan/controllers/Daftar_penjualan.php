<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_penjualan extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'daftar_penjualan';
		$this->daftar_display = 'List Daftar Penjualan';
		$this->form_display = 'Form Daftar Penjualan';
		$this->modul_display = 'Daftar Penjualan';
		$this->view_list = 'daftar_penjualan_list_view';
		$this->view_form = 'daftar_penjualan_form_view';
		$this->view_view = 'daftar_penjualan_view_view';
		$this->load->model('Daftar_penjualan_model', 'data_model');
	}

	function index()
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_list;

		$this->load->view('partial/template_view', $data);
	}

	function get_data_distribusi()
  {
    $result = $this->data_model->get_data_distribusi();

		$response = (object) NULL;
    $response->sql = $this->db->queries;

    $response->lunas = isset($result['lunas']) ? format_currency($result['lunas']) : "0,00";
    $response->konsinyasi = isset($result['konsinyasi']) ? format_currency($result['konsinyasi']) : "0,00";
    $response->total = isset($result['total']) ? format_currency($result['total']) : "0,00";
    $response->link_aja = isset($result['link_aja']) ? format_currency($result['link_aja']) : "0,00";

		echo json_encode($response);
  }

	function get_data_penjualan()
	{
		$id_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$tgl = $this->uri->segment(4) ? $this->uri->segment(4) : '-';

		if ($tgl == '-')
		{
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$data['modul'] = $this->modul_name;
		$data['daftar_penjualan'] = $this->data_model->get_daftar_penjualan($data['id_sales'], $data['tgl']);

		$this->load->view('_penjualan_view', $data);
	}

	function proses()
	{
		$response = (object) NULL;

		$success = $this->data_model->save_data();

		if($success)
		{
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil disimpan';
			$response->error = NULL;
			$response->sql = $this->db->queries;
		}
		else
		{
			$response->isSuccess = FALSE;
			$response->message = 'Data gagal disimpan';
			$response->error = $this->data_model->last_error_message;
			$response->sql = $this->db->queries;
		}


		echo json_encode($response);
	}

	function lihat_nota_penjualan()
	{
		$data['nota'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$data['data_penjualan'] = $this->data_model->get_data_penjualan($data['nota']);
		$data['list_penjualan'] = $this->data_model->get_list_penjualan($data['nota']);

		$this->load->view('_nota_penjualan_view', $data);
	}

	function lihat_penjualan_perdana()
	{
		$data['id'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_view;

		$this->load->view('_penjualan_perdana_view', $data);
	}

	function get_list_penjualan_perdana()
  {
    $result = $this->data_model->get_list_penjualan_perdana();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->len = count($result);

    if ($result)
		{
      for($i=0; $i<count($result); $i++)
			{
        $response->rows[$i]['id_produk'] = $result[$i]['id_produk'];
        $response->rows[$i]['nama_produk'] = isset($result[$i]['nama_produk']) ? $result[$i]['nama_produk'] : '';
        $response->rows[$i]['qty'] = isset($result[$i]['qty']) ? prepare_integer($result[$i]['qty']) : 0;
        $response->rows[$i]['serial_number'] = isset($result[$i]['serial_number']) ? explode(',', $result[$i]['serial_number']) : '';
      }
    }

		echo json_encode($response);
  }
}
?>