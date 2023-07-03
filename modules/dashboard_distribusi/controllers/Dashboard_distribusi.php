<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_distribusi extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'dashboard_distribusi';
		$this->daftar_display = 'List Dashboard Distribusi';
		$this->form_display = 'Form Dashboard Distribusi';
		$this->modul_display = 'Dashboard Distribusi';
		$this->view_list = 'dashboard_distribusi_list_view';
		$this->view_form = 'dashboard_distribusi_form_view';
		$this->load->model('Dashboard_distribusi_model', 'data_model');
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

	function get_data_grafik_outlet()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_grafik_outlet_view', $data);
	}

	function get_data_grafik_sekolah()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_grafik_sekolah_view', $data);
	}

	function get_data_grafik_kampus()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_grafik_kampus_view', $data);
	}

	function get_data_grafik_fakultas()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_grafik_fakultas_view', $data);
	}

	function get_data_grafik_poi()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_grafik_poi_view', $data);
	}

	function get_data_summary_akumulasi()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$this->load->view('_summary_akumulasi_view', $data);
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

			$row[] = $field->nama;
			$row[] = '<div align="right">'.format_integer($field->segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->linkaja).'</div>';

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

	function get_data_summary_branch()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$this->load->view('_summary_branch_view', $data);
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
			$row[] = $no;

			$row[] = $field->nama;
			$row[] = '<div align="right">'.format_integer($field->outlet_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->sekolah_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->kampus_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->fakultas_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->poi_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_linkaja).'</div>';

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

	function get_data_summary_cluster()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$this->load->view('_summary_cluster_view', $data);
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

			$row[] = $field->nama;
			$row[] = '<div align="right">'.format_integer($field->outlet_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->sekolah_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->kampus_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->fakultas_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->poi_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_linkaja).'</div>';

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

	function get_data_summary_tap()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$this->load->view('_summary_tap_view', $data);
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

			$row[] = $field->nama;
			$row[] = '<div align="right">'.format_integer($field->outlet_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->sekolah_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->kampus_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->fakultas_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->poi_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_linkaja).'</div>';

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

	function get_data_summary_kabupaten()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$this->load->view('_summary_kabupaten_view', $data);
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

			$row[] = $field->nama;
			$row[] = '<div align="right">'.format_integer($field->outlet_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->sekolah_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->kampus_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->fakultas_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->poi_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_linkaja).'</div>';

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

	function get_data_summary_kecamatan()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$this->load->view('_summary_kecamatan_view', $data);
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

			$row[] = $field->nama;
			$row[] = '<div align="right">'.format_integer($field->outlet_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->sekolah_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->kampus_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->fakultas_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_linkaja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->poi_segel_prepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_segel_voucher).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_sa_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_vf_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_linkaja).'</div>';

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
}
?>