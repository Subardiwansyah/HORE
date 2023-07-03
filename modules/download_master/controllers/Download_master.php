<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_master extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'download_master';
		$this->daftar_display = 'List Download Master';
		$this->form_display = 'Form Download Master';
		$this->modul_display = 'Download Master';
		$this->view_list = 'download_master_list_view';
		$this->view_form = 'download_master_form_view';
		$this->load->model('Download_master_model', 'data_model');
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
			$row[] = $no;
			$row[] = "<div align='center'>".$field->id_branch."</div>";
			$row[] = $field->nama_branch;
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
			$row[] = $no;
			$row[] = "<div align='center'>".$field->id_cluster."</div>";
			$row[] = $field->nama_cluster;
			$row[] = $field->mitra_ad;
			$row[] = $field->nama_branch;
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

	function get_daftar_3()
	{
		$list = $this->data_model->get_datatables_3();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_3;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = "<div align='center'>".$field->id_tap."</div>";
			$row[] = $field->nama_tap;
			$row[] = $field->manager;
			$row[] = $field->nama_cluster;
			$row[] = $field->nama_branch;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_3(),
			"recordsFiltered" => $this->data_model->count_filtered_3(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_daftar_4()
	{
		$list = $this->data_model->get_datatables_4();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_4;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = "<div align='center'>".$field->id_sales."</div>";
			$row[] = $field->nama_sales;
			$row[] = $field->id_tap;
			$row[] = $field->nama_tap;
			$row[] = $field->id_cluster;
			$row[] = $field->id_branch;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_4(),
			"recordsFiltered" => $this->data_model->count_filtered_4(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_daftar_5()
	{
		$list = $this->data_model->get_datatables_5();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_5;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = "<div align='center'>".$field->id_sales."</div>";
			$row[] = $field->nama_sales;
			$row[] = $field->id_tap;
			$row[] = $field->nama_tap;
			$row[] = $field->id_cluster;
			$row[] = $field->id_branch;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_5(),
			"recordsFiltered" => $this->data_model->count_filtered_5(),
			"data" => $data,
		);

		echo json_encode($output);
	}



	function download()
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$nama = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;

		$data['nama'] = $nama;
		$data['list_download'] = $this->data_model->get_list_download($nama);

		$this->load->view('_download_view', $data);
	}

	function form($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_form;

		$id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		if ($id!==0)
		{
			$data['data'] = $this->data_model->get_data_by_id($id);
		}

		$this->load->view($this->view_form, $data);
	}

	function validasi_form()
	{
		$this->form_validation->set_rules('id', 'ID', 'required|trim');

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