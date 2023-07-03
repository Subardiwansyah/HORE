<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Margin_penjualan extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'margin_penjualan';
		$this->daftar_display = 'List Margin';
		$this->form_display = 'Form Margin';
		$this->modul_display = 'Margin';
		$this->view_list = 'margin_penjualan_list_view';
		$this->view_form = 'margin_penjualan_form_view';
		$this->load->model('Margin_penjualan_model', 'data_model');
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

	function get_data_margin()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['tahun'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['bulan'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['minggu'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;

		$this->load->view('_margin_view', $data);
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

			$row[] = $field->kode_produk;
			$row[] = $field->nama_produk;
			$row[] = '<div align="right">'.format_currency($field->harga_modal).'</div>';
			$row[] = '<div align="right">'.format_currency($field->harga_jual).'</div>';
			$row[] = '<div align="right">'.format_currency($field->margin).'</div>';
			$row[] = '<div align="right">'.format_currency($field->penjualan).'</div>';
			$row[] = '<div align="right">'.format_currency($field->total_margin).'</div>';

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

	function get_data_grafik()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['tahun'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['bulan'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['minggu'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;

		$this->load->view('_grafik_view', $data);
	}
}
?>