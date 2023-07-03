<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tendem_selling extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'tendem_selling';
		$this->daftar_display = 'List Tendem Selling';
		$this->form_display = 'Form Tendem Selling';
		$this->modul_display = 'Tendem Selling';
		$this->view_list = 'tendem_selling_list_view';
		$this->view_form = 'tendem_selling_form_view';
		$this->load->model('Tendem_selling_model', 'data_model');
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

	function get_data_blank()
	{
		$this->load->view('_blank_view');
	}

	function get_data_penjualan()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['tahun'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['bulan'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['minggu'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;

		$this->load->view('_penjualan_view', $data);
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
			// $row[] = $no;

			$row[] = $field->nama_sales;

			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';
			$row[] = '<div align="right">0</div>';

			$row[] = '<div align="right">'.format_integer($field->sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_penjualan).'</div>';

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

	function get_data_sales()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['tahun'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['bulan'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['minggu'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;

		$this->load->view('_sales_view', $data);
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
			// $row[] = $no;

			$row[] = $field->id_mt;
			$row[] = $field->nama_mt;
			$row[] = $field->jabatan_mt;
			$row[] = $field->id_sales;
			$row[] = $field->nama_sales;
			$row[] = '<div align="right">'.format_currency($field->total).'</div>';
			$row[] = ' ';

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