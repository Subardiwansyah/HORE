<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi_ava extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'kpi_ava';
		$this->daftar_display = 'List KPI AVA';
		$this->form_display = 'Form KPI AVA';
		$this->modul_display = 'KPI AVA';
		$this->view_list = 'kpi_ava_list_view';
		$this->view_form = 'kpi_ava_form_view';
		$this->load->model('Kpi_ava_model', 'data_model');
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

	function konten_kpi_ava_form()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list_availability'] = $this->data_model->get_list_availability(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['list_visibility'] = $this->data_model->get_list_visibility(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['list_advokasi'] = $this->data_model->get_list_advokasi(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('kpi_ava_form_view', $data);
	}
}
?>