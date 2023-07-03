<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_perdana extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'stok_perdana';
		$this->daftar_display = 'List Stok Perdana';
		$this->form_display = 'Form Stok Perdana';
		$this->modul_display = 'Stok Perdana';
		$this->view_list = 'stok_perdana_list_view';
		$this->view_form = 'stok_perdana_form_view';
		$this->view_view = 'stok_perdana_view_view';
		$this->load->model('Stok_perdana_model', 'data_model');
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

    $response->total = format_integer($result['belum_terjual'] + $result['terjual']);
    $response->terjual = isset($result['terjual']) ? format_integer($result['terjual']) : 0;
    $response->belum_terjual = isset($result['belum_terjual']) ? format_integer($result['belum_terjual']) : 0;

		echo json_encode($response);
  }

	function get_data_perdana_terjual()
	{
		$data['id_sales'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$tgl = $this->uri->segment(4) ? $this->uri->segment(4) : '-';

		if ($tgl == '-')
		{
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_perdana_terjual_view', $data);
	}

	function get_daftar_1()
	{
		$list = $this->data_model->get_datatables_1();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_1;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = '<div align="right">'.$no.'</div>';
			$row[] = $field->serial_number;
			$row[] = $field->nama_produk;
			$row[] = '<div align="center">'.format_date($field->tgl_terjual).'</div>';
			$row[] = $field->nama_pembeli;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_1(),
			"recordsFiltered" => $this->data_model->count_filtered_1(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_perdana_belum_terjual()
	{
		$data['id_sales'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$tgl = $this->uri->segment(4) ? $this->uri->segment(4) : '-';

		if ($tgl == '-')
		{
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_perdana_belum_terjual_view', $data);
	}

	function get_daftar_2()
	{
		$list = $this->data_model->get_datatables_2();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_2;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = '<div align="right">'.$no.'</div>';
			$row[] = $field->serial_number;
			$row[] = $field->nama_produk;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_2(),
			"recordsFiltered" => $this->data_model->count_filtered_2(),
			"data" => $data,
		);

		echo json_encode($output);
	}
}
?>