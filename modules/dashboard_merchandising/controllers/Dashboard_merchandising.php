<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_merchandising extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'dashboard_merchandising';
		$this->daftar_display = 'List Dashboard Merchandising';
		$this->form_display = 'Form Dashboard Merchandising';
		$this->modul_display = 'Dashboard Merchandising';
		$this->view_list = 'dashboard_merchandising_list_view';
		$this->view_form = 'dashboard_merchandising_form_view';
		$this->load->model('Dashboard_merchandising_model', 'data_model');
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

	function get_data_default()
	{
		$this->load->view('_default_view');
	}

	function get_data_dashboard_outlet()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_dashboard_outlet_view', $data);
	}

	function get_data_dashboard_sekolah()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_dashboard_sekolah_view', $data);
	}

	function get_data_dashboard_kampus()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_dashboard_kampus_view', $data);
	}

	function get_data_dashboard_fakultas()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_dashboard_fakultas_view', $data);
	}

	function get_data_dashboard_poi()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_dashboard_poi_view', $data);
	}

	function get_data_summary_akumulasi()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_branch'] = $this->data_model->get_list_branch($data['tahun'], $data['bulan']);

		$this->load->view('_summary_akumulasi_view', $data);
	}

	function get_data_summary_branch()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_branch'] = $this->data_model->get_list_branch($data['tahun'], $data['bulan']);

		$this->load->view('_summary_branch_view', $data);
	}

	function get_data_summary_cluster()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_cluster'] = $this->data_model->get_list_cluster($data['tahun'], $data['bulan']);

		$this->load->view('_summary_cluster_view', $data);
	}

	function get_data_summary_tap()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_tap'] = $this->data_model->get_list_tap($data['tahun'], $data['bulan']);

		$this->load->view('_summary_tap_view', $data);
	}

	function get_data_summary_kabupaten()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_kabupaten'] = $this->data_model->get_list_kabupaten($data['tahun'], $data['bulan']);

		$this->load->view('_summary_kabupaten_view', $data);
	}

	function get_data_summary_kecamatan()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_kecamatan'] = $this->data_model->get_list_kecamatan($data['tahun'], $data['bulan']);

		$this->load->view('_summary_kecamatan_view', $data);
	}
}
?>