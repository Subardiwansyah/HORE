<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_radius extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'setting_radius';
		$this->daftar_display = 'List Setting Radius';
		$this->form_display = 'Form Setting Radius';
		$this->modul_display = 'Setting Radius';
		$this->view_list = 'setting_radius_list_view';
		$this->view_form = 'setting_radius_form_view';
		$this->load->model('Setting_radius_model', 'data_model');
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
		$id_level = $this->session->userdata('ID_LEVEL');

		$list = $this->data_model->get_datatables();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			if ($id_level == 4)
			{
				$row[] = '&nbsp;';
			}
			else
			{
				$row[] = '<center><button onClick="ubah(\''.$field->id_kabupaten.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Ubah"><i class="fal fa-edit"></i></button></center>';
			}

			$row[] = $field->nama_provinsi;
			$row[] = $field->nama_kabupaten;
			$row[] = "<div align='center'>".$field->radius_clock_in."</div>";

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