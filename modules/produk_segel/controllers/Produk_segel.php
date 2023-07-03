<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_segel extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'produk_segel';
		$this->daftar_display = 'List Produk Segel';
		$this->form_display = 'Form Produk Segel';
		$this->modul_display = 'Produk Segel';
		$this->view_list = 'produk_segel_list_view';
		$this->view_form = 'produk_segel_form_view';
		$this->view_view = 'produk_segel_view_view';
		$this->load->model('Produk_segel_model', 'data_model');
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

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = '<center><button onClick="lihat(\''.$field->id_produk.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat"><i class="fal fa-eye"></i></button> <button onClick="ubah(\''.$field->id_produk.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Ubah"><i class="fal fa-edit"></i></button> <button onClick="hapus(\''.$field->id_produk.'\')" type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" title="Hapus"><i class="fal fa-trash-alt"></i></button></center>';
			$row[] = $field->nama_jenis_produk;
			$row[] = "<div align='center'>".$field->kode_produk."</div>";
			$row[] = $field->nama_produk;
			$row[] = '<div class="text-right">'.format_currency($field->harga_bandrol).'</div>';
			$row[] = '<div class="text-right">'.format_currency($field->harga_modal).'</div>';

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
		$this->form_validation->set_rules('id', 'Kode Produk', 'required|trim|callback__cek_duplikasi');

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