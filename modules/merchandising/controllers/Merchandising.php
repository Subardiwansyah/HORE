<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchandising extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'merchandising';
		$this->daftar_display = 'List Merchandising';
		$this->form_display = 'Form Merchandising';
		$this->modul_display = 'Merchandising';
		$this->view_list = 'merchandising_list_view';
		$this->view_form = 'merchandising_form_view';
		$this->load->model('Merchandising_model', 'data_model');
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

	function merchandising_form_out()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;

		$data['jenis_lokasi'] = 'out';

		$this->load->view('merchandising_lokasi_outlet_view', $data);
	}

	function merchandising_form_sek()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;

		$data['jenis_lokasi'] = 'sek';

		$this->load->view('merchandising_lokasi_other_view', $data);
	}

	function merchandising_form_kam()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;

		$data['jenis_lokasi'] = 'kam';

		$this->load->view('merchandising_lokasi_other_view', $data);
	}

	function merchandising_form_fak()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;

		$data['jenis_lokasi'] = 'fak';

		$this->load->view('merchandising_lokasi_other_view', $data);
	}

	function get_data_regional()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';
		$data['jenis_share'] = $this->uri->segment(9) ? strtoupper($this->uri->segment(9)) : NULL;

		$this->load->view('_regional_view', $data);
	}

	function get_daftar_1()
	{
		$list = $this->data_model->get_datatables_1();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_1;

		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : 0;

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

			$row[] = '<div align="right">'.format_currency($field->telkomsel_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_persen).' %</div>';
			/*
			if ($minggu == 0)
			{
				$row[] = '<div align="right">'.format_currency($field->m_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->m_2).' %</div>';
			}
			else
			{
				$row[] = '<div align="right">'.format_currency($field->w_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->w_2).' %</div>';
			} */

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
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';
		$data['jenis_share'] = $this->uri->segment(9) ? strtoupper($this->uri->segment(9)) : NULL;

		$this->load->view('_branch_view', $data);
	}

	function get_daftar_2()
	{
		$list = $this->data_model->get_datatables_2();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_2;

		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : 0;

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

			$row[] = '<div align="right">'.format_currency($field->telkomsel_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_persen).' %</div>';

			if ($minggu == 0)
			{
				$row[] = '<div align="right">'.format_currency($field->m_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->m_2).' %</div>';
			}
			else
			{
				$row[] = '<div align="right">'.format_currency($field->w_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->w_2).' %</div>';
			}

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
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';
		$data['jenis_share'] = $this->uri->segment(9) ? strtoupper($this->uri->segment(9)) : NULL;

		$this->load->view('_cluster_view', $data);
	}

	function get_daftar_3()
	{
		$list = $this->data_model->get_datatables_3();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_3;

		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : 0;

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

			$row[] = '<div align="right">'.format_currency($field->telkomsel_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_persen).' %</div>';

			if ($minggu == 0)
			{
				$row[] = '<div align="right">'.format_currency($field->m_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->m_2).' %</div>';
			}
			else
			{
				$row[] = '<div align="right">'.format_currency($field->w_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->w_2).' %</div>';
			}

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
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';
		$data['jenis_share'] = $this->uri->segment(9) ? strtoupper($this->uri->segment(9)) : NULL;

		$this->load->view('_kabupaten_view', $data);
	}

	function get_daftar_4()
	{
		$list = $this->data_model->get_datatables_4();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_4;

		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : 0;

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

			$row[] = '<div align="right">'.format_currency($field->telkomsel_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_persen).' %</div>';

			if ($minggu == 0)
			{
				$row[] = '<div align="right">'.format_currency($field->m_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->m_2).' %</div>';
			}
			else
			{
				$row[] = '<div align="right">'.format_currency($field->w_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->w_2).' %</div>';
			}

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
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';
		$data['jenis_share'] = $this->uri->segment(9) ? strtoupper($this->uri->segment(9)) : NULL;

		$this->load->view('_kecamatan_view', $data);
	}

	function get_daftar_5()
	{
		$list = $this->data_model->get_datatables_5();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_5;

		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : 0;

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

			$row[] = '<div align="right">'.format_currency($field->telkomsel_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_persen).' %</div>';

			if ($minggu == 0)
			{
				$row[] = '<div align="right">'.format_currency($field->m_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->m_2).' %</div>';
			}
			else
			{
				$row[] = '<div align="right">'.format_currency($field->w_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->w_2).' %</div>';
			}

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
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';
		$data['jenis_share'] = $this->uri->segment(9) ? strtoupper($this->uri->segment(9)) : NULL;

		$this->load->view('_tap_view', $data);
	}

	function get_daftar_6()
	{
		$list = $this->data_model->get_datatables_6();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_6;

		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : 0;

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

			$row[] = '<div align="right">'.format_currency($field->telkomsel_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_persen).' %</div>';

			if ($minggu == 0)
			{
				$row[] = '<div align="right">'.format_currency($field->m_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->m_2).' %</div>';
			}
			else
			{
				$row[] = '<div align="right">'.format_currency($field->w_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->w_2).' %</div>';
			}

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
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';
		$data['jenis_share'] = $this->uri->segment(9) ? strtoupper($this->uri->segment(9)) : NULL;

		$this->load->view('_sales_view', $data);
	}

	function get_daftar_7()
	{
		$list = $this->data_model->get_datatables_7();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_7;

		$minggu = $this->input->post('minggu') ? $this->input->post('minggu') : 0;

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

			$row[] = '<div align="right">'.format_currency($field->telkomsel_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->isat_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->xl_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->tri_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->smartfren_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->axis_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->other_persen).' %</div>';
			$row[] = '<div align="right">'.format_currency($field->total_persen).' %</div>';

			if ($minggu == 0)
			{
				$row[] = '<div align="right">'.format_currency($field->m_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->m_2).' %</div>';
			}
			else
			{
				$row[] = '<div align="right">'.format_currency($field->w_1).' %</div>';
				$row[] = '<div align="right">'.format_currency($field->w_2).' %</div>';
			}

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
}
?>