<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Market_audit extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'market_audit';
		$this->daftar_display = 'List Market Audit';
		$this->form_display = 'Form Market Audit';
		$this->modul_display = 'Market Audit';
		$this->view_list = 'market_audit_list_view';
		$this->view_form = 'market_audit_form_view';
		$this->load->model('Market_audit_model', 'data_model');
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

	function market_audit_form()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_share'] = $this->uri->segment(8) ? $this->uri->segment(8) : NULL;

		$this->load->view('market_audit_form_view', $data);
	}

	function get_data_regional()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_regional_view', $data);
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

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_ld).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_md).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_hd).'</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_ld_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_md_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_hd_persen).' %</div>';

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

	function get_data_branch()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_branch_view', $data);
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

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_ld).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_md).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_hd).'</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_ld_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_md_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_hd_persen).' %</div>';

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

	function get_data_cluster()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_cluster_view', $data);
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

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_ld).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_md).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_hd).'</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_ld_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_md_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_hd_persen).' %</div>';

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

	function get_data_kabupaten()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_kabupaten_view', $data);
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

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_ld).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_md).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_hd).'</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_ld_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_md_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_hd_persen).' %</div>';

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

	function get_data_kecamatan()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_kecamatan_view', $data);
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

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_ld).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_md).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_hd).'</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_ld_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_md_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_hd_persen).' %</div>';

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

	function get_data_tap()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_tap_view', $data);
	}

	function get_daftar_6()
	{
		$list = $this->data_model->get_datatables_6();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_6;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_ld).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_md).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_hd).'</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_ld_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_md_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_hd_persen).' %</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_6(),
			"recordsFiltered" => $this->data_model->count_filtered_6(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_sales()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_sales_view', $data);
	}

	function get_daftar_7()
	{
		$list = $this->data_model->get_datatables_7();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_7;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_ld).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_md).'</div>';

			$row[] = '<div align="right">'.format_integer($field->telkomsel_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_hd).'</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_ld_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_ld_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_md_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_md_persen).' %</div>';

			$row[] = '<div align="right">'.format_currency($field->telkomsel_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_hd_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_hd_persen).' %</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_7(),
			"recordsFiltered" => $this->data_model->count_filtered_7(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_regional_belanja()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_regional_belanja_view', $data);
	}

	function get_daftar_8()
	{
		$list = $this->data_model->get_datatables_8();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_8;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total).'</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_8(),
			"recordsFiltered" => $this->data_model->count_filtered_8(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_branch_belanja()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_branch_belanja_view', $data);
	}

	function get_daftar_9()
	{
		$list = $this->data_model->get_datatables_9();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_9;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total).'</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_9(),
			"recordsFiltered" => $this->data_model->count_filtered_9(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_cluster_belanja()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_cluster_belanja_view', $data);
	}

	function get_daftar_10()
	{
		$list = $this->data_model->get_datatables_10();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_10;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total).'</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_10(),
			"recordsFiltered" => $this->data_model->count_filtered_10(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_kabupaten_belanja()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_kabupaten_belanja_view', $data);
	}

	function get_daftar_11()
	{
		$list = $this->data_model->get_datatables_11();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_11;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total).'</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_11(),
			"recordsFiltered" => $this->data_model->count_filtered_11(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_kecamatan_belanja()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_kecamatan_belanja_view', $data);
	}

	function get_daftar_12()
	{
		$list = $this->data_model->get_datatables_12();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_12;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total).'</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_12(),
			"recordsFiltered" => $this->data_model->count_filtered_12(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_tap_belanja()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_tap_belanja_view', $data);
	}

	function get_daftar_13()
	{
		$list = $this->data_model->get_datatables_13();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_13;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total).'</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_13(),
			"recordsFiltered" => $this->data_model->count_filtered_13(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_sales_belanja()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_share'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : NULL;

		$this->load->view('_sales_belanja_view', $data);
	}

	function get_daftar_14()
	{
		$list = $this->data_model->get_datatables_14();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_14;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->telkomsel).'</div>';
			$row[] = '<div align="right">'.format_integer($field->isat).'</div>';
			$row[] = '<div align="right">'.format_integer($field->xl).'</div>';
			$row[] = '<div align="right">'.format_integer($field->tri).'</div>';
			$row[] = '<div align="right">'.format_integer($field->smartfren).'</div>';
			$row[] = '<div align="right">'.format_integer($field->axis).'</div>';
			$row[] = '<div align="right">'.format_integer($field->other).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total).'</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_14(),
			"recordsFiltered" => $this->data_model->count_filtered_14(),
			"data" => $data,
		);

		echo json_encode($output);
	}
}
?>