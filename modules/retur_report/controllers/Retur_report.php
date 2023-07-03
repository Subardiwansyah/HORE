<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_report extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'retur_report';
		$this->daftar_display = 'List Report Retur';
		$this->form_display = 'Form Report Retur';
		$this->modul_display = 'Report Retur';
		$this->view_list = 'retur_report_list_view';
		$this->view_form = 'retur_report_form_view';
		$this->view_view = 'retur_report_view_view';
		$this->load->model('Retur_report_model', 'data_model');
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

			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = $field->nama_sales;
			$row[] = $field->nama_produk;
			$row[] = '<div class="text-right">'.format_integer($field->barang_rusak).'</div>';
			$row[] = '<div class="text-right">'.format_integer($field->penumpukan_stock).'</div>';

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
}
?>