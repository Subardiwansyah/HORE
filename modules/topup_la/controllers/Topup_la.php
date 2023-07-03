<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup_la extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'topup_la';
		$this->daftar_display = 'List Top Up LA';
		$this->form_display = 'Form Top Up LA';
		$this->modul_display = 'Top Up LA';
		$this->view_list = 'topup_la_list_view';
		$this->view_form = 'topup_la_form_view';
		$this->load->model('Topup_la_model', 'data_model');
	}

	function index()
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_form;

		$this->load->view('partial/template_view', $data);
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

	function get_limit_existing()
  {
    $result = $this->data_model->get_limit_existing();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->limit_existing = isset($result['limit_existing']) ? format_currency($result['limit_existing']) : '0,00';

		echo json_encode($response);
  }
}
?>