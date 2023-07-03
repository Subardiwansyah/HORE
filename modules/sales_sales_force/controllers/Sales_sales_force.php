<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_sales_force extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'sales_sales_force';
		$this->daftar_display = 'List Sales Force';
		$this->form_display = 'Form Sales Force';
		$this->modul_display = 'Sales Force';
		$this->view_list = 'sales_sales_force_list_view';
		$this->view_form = 'sales_sales_force_form_view';
		$this->view_view = 'sales_sales_force_view_view';
		$this->load->model('Sales_sales_force_model', 'data_model');
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

			$row[] = '<center><button onClick="lihat(\''.$field->id_sales.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat"><i class="fal fa-eye"></i></button> <button onClick="ubah(\''.$field->id_sales.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Ubah"><i class="fal fa-edit"></i></button></center>';
			$row[] = "<div align='center'>".$field->id_sales."</div>";
			$row[] = strtoupper($field->nama_sales);
			$row[] = $field->nama_tap;
			$row[] = $field->nama_cluster;

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

			$row[] = "<div align='center'>".$field->id_sales."</div>";
			$row[] = strtoupper($field->nama_sales);
			$row[] = "<div align='center'>".substr($field->tgl_masuk,8,2)."/".substr($field->tgl_masuk,5,2)."/".substr($field->tgl_masuk,0,4)."</div>";
			$row[] = "<div align='center'>".substr($field->tgl_keluar,8,2)."/".substr($field->tgl_keluar,5,2)."/".substr($field->tgl_keluar,0,4)."</div>";
			$row[] = $field->nama_tap;
			$row[] = $field->nama_cluster;

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

	function form($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_form;

		$id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		if ($id !== 0)
		{
			$data['data'] = $this->data_model->get_data_by_id($id);
		}

		$this->load->view('partial/template_view', $data);
	}

	function lihat($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_view;

		$id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		if ($id !== 0)
		{
			$data['data'] = $this->data_model->get_data_by_id($id);
		}

		$this->load->view('partial/template_view', $data);
	}

	function validasi_form()
	{
		$this->form_validation->set_rules('id', 'Id', 'required|trim');

		$this->form_validation->set_message('required', '%s tidak boleh kosong.');
		$this->form_validation->set_message('min_length', 'Minimal %s tiga (3) karakter.');
		$this->form_validation->set_message('max_length', '%s tidak boleh melebihi %s karakter.');
		$this->form_validation->set_message('integer', '%s harus angka.');
		$this->form_validation->set_message('_cek_duplikasi', '%s sudah ada.');
	}

	function _cek_duplikasi()
	{
		return $this->data_model->check_duplikasi();
	}
}
?>