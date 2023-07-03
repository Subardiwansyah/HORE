<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'promotion';
		$this->daftar_display = 'List Promotion';
		$this->form_display = 'Form Promotion';
		$this->modul_display = 'Promotion';
		$this->view_list = 'promotion_list_view';
		$this->view_form = 'promotion_form_view';
		$this->load->model('promotion_model', 'data_model');
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

	function promotion_form()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? $this->uri->segment(8) : NULL;

		$this->load->view('promotion_form_view', $data);
	}

	function get_data_regional()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';

		$data['list_program'] = $this->data_model->get_list_program($data['tahun'], $data['bulan'], $data['minggu']);

		$this->load->view('_regional_view', $data);
	}

	function get_daftar_1()
	{
		$list = $this->data_model->get_datatables_1();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_1;
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = $field->nama;

			for ($i=0; $i<$total_program; $i++)
			{
				$program = 'program_'.$i;
				$row[] = '<div align="right">'.$field->$program.'</div>';
			}

			$row[] = '<div align="right">'.$field->total.'</div>';

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
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';

		$data['list_program'] = $this->data_model->get_list_program($data['tahun'], $data['bulan'], $data['minggu']);

		$this->load->view('_branch_view', $data);
	}

	function get_daftar_2()
	{
		$list = $this->data_model->get_datatables_2();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_2;
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = $field->nama;

			for ($i=0; $i<$total_program; $i++)
			{
				$program = 'program_'.$i;
				$row[] = '<div align="right">'.$field->$program.'</div>';
			}

			$row[] = '<div align="right">'.$field->total.'</div>';

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
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';

		$data['list_program'] = $this->data_model->get_list_program($data['tahun'], $data['bulan'], $data['minggu']);

		$this->load->view('_cluster_view', $data);
	}

	function get_daftar_3()
	{
		$list = $this->data_model->get_datatables_3();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_3;
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = $field->nama;

			for ($i=0; $i<$total_program; $i++)
			{
				$program = 'program_'.$i;
				$row[] = '<div align="right">'.$field->$program.'</div>';
			}

			$row[] = '<div align="right">'.$field->total.'</div>';

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
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';

		$data['list_program'] = $this->data_model->get_list_program($data['tahun'], $data['bulan'], $data['minggu']);

		$this->load->view('_kabupaten_view', $data);
	}

	function get_daftar_4()
	{
		$list = $this->data_model->get_datatables_4();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_4;
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = $field->nama;

			for ($i=0; $i<$total_program; $i++)
			{
				$program = 'program_'.$i;
				$row[] = '<div align="right">'.$field->$program.'</div>';
			}

			$row[] = '<div align="right">'.$field->total.'</div>';

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
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';

		$data['list_program'] = $this->data_model->get_list_program($data['tahun'], $data['bulan'], $data['minggu']);

		$this->load->view('_kecamatan_view', $data);
	}

	function get_daftar_5()
	{
		$list = $this->data_model->get_datatables_5();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_5;
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = $field->nama;

			for ($i=0; $i<$total_program; $i++)
			{
				$program = 'program_'.$i;
				$row[] = '<div align="right">'.$field->$program.'</div>';
			}

			$row[] = '<div align="right">'.$field->total.'</div>';

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
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';

		$data['list_program'] = $this->data_model->get_list_program($data['tahun'], $data['bulan'], $data['minggu']);

		$this->load->view('_tap_view', $data);
	}

	function get_daftar_6()
	{
		$list = $this->data_model->get_datatables_6();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_6;
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = $field->nama;

			for ($i=0; $i<$total_program; $i++)
			{
				$program = 'program_'.$i;
				$row[] = '<div align="right">'.$field->$program.'</div>';
			}

			$row[] = '<div align="right">'.$field->total.'</div>';

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
		$data['minggu'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['jenis_lokasi'] = $this->uri->segment(8) ? strtoupper($this->uri->segment(8)) : 'OUT';

		$data['list_program'] = $this->data_model->get_list_program($data['tahun'], $data['bulan'], $data['minggu']);

		$this->load->view('_sales_view', $data);
	}

	function get_daftar_7()
	{
		$list = $this->data_model->get_datatables_7();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_7;
		$total_program = $this->input->post('total_program') ? $this->input->post('total_program') : 0;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			$row[] = $field->nama;

			for ($i=0; $i<$total_program; $i++)
			{
				$program = 'program_'.$i;
				$row[] = '<div align="right">'.$field->$program.'</div>';
			}

			$row[] = '<div align="right">'.$field->total.'</div>';

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