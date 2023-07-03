<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_promotion extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'dashboard_promotion';
		$this->daftar_display = 'List Dashboard Promotion';
		$this->form_display = 'Form Dashboard Promotion';
		$this->modul_display = 'Dashboard Promotion';
		$this->view_list = 'dashboard_promotion_list_view';
		$this->view_form = 'dashboard_promotion_form_view';
		$this->load->model('Dashboard_promotion_model', 'data_model');
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

	function get_data_grafik_month()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;

		$data['list_program'] = $this->data_model->get_list_program();

		$this->load->view('_grafik_month_view', $data);
	}

	function get_data_grafik_week()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? (int) $this->uri->segment(6) : NULL;

		$data['list_program'] = $this->data_model->get_list_program();

		$this->load->view('_grafik_week_view', $data);
	}

	function get_data_summary_regional()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_minggu'] = $this->data_model->get_list_minggu($data['tahun'], $data['bulan']);

		$this->load->view('_summary_regional_view', $data);
	}

	function get_daftar_1()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');
		$jml_minggu = $this->input->post('jml_minggu') ? $this->input->post('jml_minggu') : 0;
		$res_minggu = $this->data_model->get_list_minggu($tahun, $bulan);
		$count_minggu = count($res_minggu);

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

			for ($x=0; $x<$count_minggu; $x++)
			{
				$a = $res_minggu[$x]->minggu;

				if ($a == 1) { $row[] = '<div align="right">'.format_integer($field->w1).'</div>'; }
				if ($a == 2) { $row[] = '<div align="right">'.format_integer($field->w2).'</div>'; }
				if ($a == 3) { $row[] = '<div align="right">'.format_integer($field->w3).'</div>'; }
				if ($a == 4) { $row[] = '<div align="right">'.format_integer($field->w4).'</div>'; }
				if ($a == 5) { $row[] = '<div align="right">'.format_integer($field->w5).'</div>'; }
			}

			if ($count_minggu == 0)
			{
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
			}

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

	function get_data_summary_branch()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_minggu'] = $this->data_model->get_list_minggu($data['tahun'], $data['bulan']);

		$this->load->view('_summary_branch_view', $data);
	}

	function get_daftar_2()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');
		$jml_minggu = $this->input->post('jml_minggu') ? $this->input->post('jml_minggu') : 0;
		$res_minggu = $this->data_model->get_list_minggu($tahun, $bulan);
		$count_minggu = count($res_minggu);

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

			for ($x=0; $x<$count_minggu; $x++)
			{
				$a = $res_minggu[$x]->minggu;

				if ($a == 1) { $row[] = '<div align="right">'.format_integer($field->w1).'</div>'; }
				if ($a == 2) { $row[] = '<div align="right">'.format_integer($field->w2).'</div>'; }
				if ($a == 3) { $row[] = '<div align="right">'.format_integer($field->w3).'</div>'; }
				if ($a == 4) { $row[] = '<div align="right">'.format_integer($field->w4).'</div>'; }
				if ($a == 5) { $row[] = '<div align="right">'.format_integer($field->w5).'</div>'; }
			}

			if ($count_minggu == 0)
			{
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
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

	function get_data_summary_cluster()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_minggu'] = $this->data_model->get_list_minggu($data['tahun'], $data['bulan']);

		$this->load->view('_summary_cluster_view', $data);
	}

	function get_daftar_3()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');
		$jml_minggu = $this->input->post('jml_minggu') ? $this->input->post('jml_minggu') : 0;
		$res_minggu = $this->data_model->get_list_minggu($tahun, $bulan);
		$count_minggu = count($res_minggu);

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

			for ($x=0; $x<$count_minggu; $x++)
			{
				$a = $res_minggu[$x]->minggu;

				if ($a == 1) { $row[] = '<div align="right">'.format_integer($field->w1).'</div>'; }
				if ($a == 2) { $row[] = '<div align="right">'.format_integer($field->w2).'</div>'; }
				if ($a == 3) { $row[] = '<div align="right">'.format_integer($field->w3).'</div>'; }
				if ($a == 4) { $row[] = '<div align="right">'.format_integer($field->w4).'</div>'; }
				if ($a == 5) { $row[] = '<div align="right">'.format_integer($field->w5).'</div>'; }
			}

			if ($count_minggu == 0)
			{
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
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

	function get_data_summary_tap()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_minggu'] = $this->data_model->get_list_minggu($data['tahun'], $data['bulan']);

		$this->load->view('_summary_tap_view', $data);
	}

	function get_daftar_4()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');
		$jml_minggu = $this->input->post('jml_minggu') ? $this->input->post('jml_minggu') : 0;
		$res_minggu = $this->data_model->get_list_minggu($tahun, $bulan);
		$count_minggu = count($res_minggu);

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

			for ($x=0; $x<$count_minggu; $x++)
			{
				$a = $res_minggu[$x]->minggu;

				if ($a == 1) { $row[] = '<div align="right">'.format_integer($field->w1).'</div>'; }
				if ($a == 2) { $row[] = '<div align="right">'.format_integer($field->w2).'</div>'; }
				if ($a == 3) { $row[] = '<div align="right">'.format_integer($field->w3).'</div>'; }
				if ($a == 4) { $row[] = '<div align="right">'.format_integer($field->w4).'</div>'; }
				if ($a == 5) { $row[] = '<div align="right">'.format_integer($field->w5).'</div>'; }
			}

			if ($count_minggu == 0)
			{
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
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

	function get_data_summary_kabupaten()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_minggu'] = $this->data_model->get_list_minggu($data['tahun'], $data['bulan']);

		$this->load->view('_summary_kabupaten_view', $data);
	}

	function get_daftar_5()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');
		$jml_minggu = $this->input->post('jml_minggu') ? $this->input->post('jml_minggu') : 0;
		$res_minggu = $this->data_model->get_list_minggu($tahun, $bulan);
		$count_minggu = count($res_minggu);

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

			for ($x=0; $x<$count_minggu; $x++)
			{
				$a = $res_minggu[$x]->minggu;

				if ($a == 1) { $row[] = '<div align="right">'.format_integer($field->w1).'</div>'; }
				if ($a == 2) { $row[] = '<div align="right">'.format_integer($field->w2).'</div>'; }
				if ($a == 3) { $row[] = '<div align="right">'.format_integer($field->w3).'</div>'; }
				if ($a == 4) { $row[] = '<div align="right">'.format_integer($field->w4).'</div>'; }
				if ($a == 5) { $row[] = '<div align="right">'.format_integer($field->w5).'</div>'; }
			}

			if ($count_minggu == 0)
			{
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
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

	function get_data_summary_kecamatan()
	{
		$data['tahun'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['bulan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;

		$data['list_minggu'] = $this->data_model->get_list_minggu($data['tahun'], $data['bulan']);

		$this->load->view('_summary_kacamatan_view', $data);
	}

	function get_daftar_6()
	{
		$tahun = $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
		$bulan = $this->input->post('bulan') ? $this->input->post('bulan') : date('m');
		$jml_minggu = $this->input->post('jml_minggu') ? $this->input->post('jml_minggu') : 0;
		$res_minggu = $this->data_model->get_list_minggu($tahun, $bulan);
		$count_minggu = count($res_minggu);

		$list = $this->data_model->get_datatables_6();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_6;

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			$row[] = $no;

			$row[] = $field->nama;

			for ($x=0; $x<$count_minggu; $x++)
			{
				$a = $res_minggu[$x]->minggu;

				if ($a == 1) { $row[] = '<div align="right">'.format_integer($field->w1).'</div>'; }
				if ($a == 2) { $row[] = '<div align="right">'.format_integer($field->w2).'</div>'; }
				if ($a == 3) { $row[] = '<div align="right">'.format_integer($field->w3).'</div>'; }
				if ($a == 4) { $row[] = '<div align="right">'.format_integer($field->w4).'</div>'; }
				if ($a == 5) { $row[] = '<div align="right">'.format_integer($field->w5).'</div>'; }
			}

			if ($count_minggu == 0)
			{
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
				$row[] = '<div align="right">&nbsp;</div>';
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
}
?>