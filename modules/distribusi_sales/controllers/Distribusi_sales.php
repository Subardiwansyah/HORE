<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribusi_sales extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'distribusi_sales';
		$this->daftar_display = 'List Distribusi Sales';
		$this->form_display = 'Form Distribusi Sales';
		$this->modul_display = 'Distribusi Sales';
		$this->view_list = 'distribusi_sales_list_view';
		$this->view_form = 'distribusi_sales_form_view';
		$this->view_view = 'distribusi_sales_view_view';
		$this->load->model('Distribusi_sales_model', 'data_model');
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

	function get_daftar()
	{
		$list = $this->data_model->get_datatables();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = '<center>
				<button onClick="lihat(\''.$field->id_sales.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat Stok">
					<i class="fal fa-eye"></i>
				</button>
			</center>';

			$row[] = $field->id_sales;
			$row[] = $field->nama_sales;
			$row[] = $field->nama_jenis_sales;
			$row[] = $field->nama_tap;
			$row[] = $field->nama_cluster;
			$row[] = '<div class="text-right">'.format_integer($field->qty_available).'</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all(),
			"recordsFiltered" => $this->data_model->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function lihat($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_view;
		$data['id'] = $id;

		$this->load->view($this->view_view, $data);
	}

	function get_list_produk_available()
  {
    $result = $this->data_model->get_list_produk_available();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->len = count($result);

    if ($result)
		{
      for($i=0; $i<count($result); $i++)
			{
        $response->rows[$i]['id_produk'] = $result[$i]['id_produk'];
        $response->rows[$i]['nama_produk'] = $result[$i]['nama_produk'];
        $response->rows[$i]['qty'] = isset($result[$i]['qty']) ? prepare_integer($result[$i]['qty']) : 0;
        $response->rows[$i]['serial_number'] = isset($result[$i]['serial_number']) ? explode(',', $result[$i]['serial_number']) : '';
      }
    }

		echo json_encode($response);
  }
}
?>