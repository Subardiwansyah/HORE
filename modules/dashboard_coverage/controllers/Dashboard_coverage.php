<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_coverage extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'dashboard_coverage';
		$this->daftar_display = 'List Dashboard Coverage';
		$this->form_display = 'Form Dashboard Coverage';
		$this->modul_display = 'Dashboard Coverage';
		$this->view_list = 'dashboard_coverage_list_view';
		$this->view_form = 'dashboard_coverage_form_view';
		$this->load->model('Dashboard_coverage_model', 'data_model');
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

	// ====================================================================================================
	// TAB SALES
	// ====================================================================================================
	/**
	 *  Fungsi	: Reload sales sales melakukan kunjungan
	 *  Module	: -
	 */
	function get_data_sales_kunjungan()
	{
		$tgl = $this->uri->segment(3) ? $this->uri->segment(3) : '-';

		if ($tgl == '-')
		{
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_sales_kunjungan_view', $data);
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

			$row[] = '<div align="right">'.$no.'</div>';
			$row[] = '<div style="width:55px">'.$field->id_sales.'</div>';
			$row[] = '<div style="width:130px">'.$field->nama_sales.'</div>';
			$row[] = '<div style="width:130px">'.$field->nama_tap.'</div>';
			$row[] = '<div style="width:110px">'.$field->nama_cluster.'</div>';

			if ($field->dikunjungi > 0)
			{
				$row[] = '<a href="javascript:void(0);" onClick="lihat_pjp(\''.$field->id_sales.'\')">
									<div align="right">'.format_integer($field->dikunjungi).'</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">'.format_integer($field->dikunjungi).'</div>';
			}


			// $row[] = '<div align="right">'.format_integer($field->dikunjungi).'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_pjp).'</div>';

			if($field->dikunjungi == $field->total_pjp)
			{
				$row[] = '<div align="center"><span class="badge badge-success badge-pill">Completed</span></div>';
			}
			else
			{
				$row[] = '<div align="center"><span class="badge badge-warning badge-pill">Not Completed</span></div>';
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

	/**
	 *  Fungsi	: Reload sales sales tidak melakukan kunjungan
	 *  Module	: -
	 */
	function get_data_sales_tdk_kunjungan()
	{
		$tgl = $this->uri->segment(3) ? $this->uri->segment(3) : '-';

		if ($tgl == '-')
		{
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_sales_tdk_kunjungan_view', $data);
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

			$row[] = '<div align="right">'.$no.'</div>';
			$row[] = '<div style="width:55px">'.$field->id_sales.'</div>';
			$row[] = '<div style="width:130px">'.$field->nama_sales.'</div>';
			$row[] = '<div style="width:130px">'.$field->nama_tap.'</div>';
			$row[] = '<div style="width:110px">'.$field->nama_cluster.'</div>';
			$row[] = '<div align="right">'.format_integer($field->total_pjp).'</div>';

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

	// ====================================================================================================
	// TAB GRAFIK
	// ====================================================================================================

	/**
	 *  Fungsi	: Reload grafik outlet
	 *  Module	: -
	 */
	function get_data_grafik_outlet()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_grafik_outlet_view', $data);
	}

	/**
	 *  Fungsi	: Reload grafik sekolah
	 *  Module	: -
	 */
	function get_data_grafik_sekolah()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_grafik_sekolah_view', $data);
	}

	/**
	 *  Fungsi	: Reload grafik kampus
	 *  Module	: -
	 */
	function get_data_grafik_kampus()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_grafik_kampus_view', $data);
	}

	/**
	 *  Fungsi	: Reload grafik fakultas
	 *  Module	: -
	 */
	function get_data_grafik_fakultas()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_grafik_fakultas_view', $data);
	}

	/**
	 *  Fungsi	: Reload grafik poi
	 *  Module	: -
	 */
	function get_data_grafik_poi()
	{
		$data['kategori'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['pilihan'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tahun'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['bulan'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;

		$this->load->view('_grafik_poi_view', $data);
	}

	// ====================================================================================================
	// TAB SUMMARY
	// ====================================================================================================

	/**
	 *  Fungsi	: Reload summary branch
	 *  Module	: -
	 */
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
			// $row[] = $no;

			$row[] = '<div align="right">'.$no.'</div>';
			$row[] = $field->nama;
			$row[] = '<div align="right">'.format_integer($field->outlet_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->sekolah_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->kampus_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->fakultas_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->poi_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_coverage).' %</div>';

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

	/**
	 *  Fungsi	: Reload summary cluster
	 *  Module	: -
	 */
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
			// $row[] = $no;

			$row[] = '<div align="right">'.$no.'</div>';
			$row[] = $field->nama;
			$row[] = '<div align="right">'.format_integer($field->outlet_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->sekolah_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->kampus_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->fakultas_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->poi_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_coverage).' %</div>';

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

	/**
	 *  Fungsi	: Reload summary tap
	 *  Module	: -
	 */
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
			// $row[] = $no;

			$row[] = '<div align="right">'.$no.'</div>';
			$row[] = $field->nama;
			$row[] = '<div align="right">'.format_integer($field->outlet_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->sekolah_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->kampus_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->fakultas_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->poi_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_coverage).' %</div>';

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

	/**
	 *  Fungsi	: Reload summary kabupaten
	 *  Module	: -
	 */
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
			// $row[] = $no;

			$row[] = '<div align="right">'.$no.'</div>';
			$row[] = $field->nama;
			$row[] = '<div align="right">'.format_integer($field->outlet_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->sekolah_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->kampus_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->fakultas_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->poi_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_coverage).' %</div>';

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

	/**
	 *  Fungsi	: Reload summary kecamatan
	 *  Module	: -
	 */
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
			// $row[] = $no;

			$row[] = '<div align="right">'.$no.'</div>';
			$row[] = $field->nama;
			$row[] = '<div align="right">'.format_integer($field->outlet_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->outlet_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->sekolah_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sekolah_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->kampus_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->kampus_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->fakultas_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->fakultas_coverage).' %</div>';

			$row[] = '<div align="right">'.format_integer($field->poi_open).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_close).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_total).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_target).'</div>';
			$row[] = '<div align="right">'.format_integer($field->poi_coverage).' %</div>';

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

	/**
	 *  Fungsi	: Manampilkan form resume pjp
	 *  Module	: -
	 */
	function form($id = 0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_form;

		$id_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$tgl = $this->uri->segment(4) ? $this->uri->segment(4) : 0;

		if ($tgl == '-')
		{
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$data['data'] = $this->data_model->get_data_sales($id_sales);

		$this->load->view('partial/template_view', $data);
	}

	/**
	 *  Fungsi	: Reload datatables distribusi
	 *  Module	: -
	 */
	function get_data_distribusi()
	{
		$data['id_jenis_sales'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['id_sales'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tgl'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;

		$this->load->view('_resume_distribusi_view', $data);
	}

	function get_daftar_8()
	{
		$list = $this->data_model->get_datatables_8();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_8;

		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : '';

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->kode_lokasi;
			$row[] = $field->nama_lokasi;
			$row[] = $field->status;
			$row[] = '';

			if ($field->total_perdana > 0)
			{
				$row[] = '<a href="javascript:void(0);" onClick="lihat_distribusi(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'perdana\')">
										<div align="right">'.format_integer($field->total_perdana).'</div>
									</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->total_voucher > 0)
			{
				$row[] = '<a href="javascript:void(0);" onClick="lihat_distribusi(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'voucher\')">
										<div align="right">'.format_integer($field->total_voucher).'</div>
									</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

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

	function distribusi()
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$tgl = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$jenis_lokasi = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$lokasi = $this->uri->segment(6) ? $this->uri->segment(6) : '';
		$jenis_produk = $this->uri->segment(7) ? $this->uri->segment(7) : 'perdana';

		$data['list_distribusi'] = $this->data_model->get_list_distribusi($tgl, $sales, $jenis_lokasi, $lokasi, $jenis_produk);

		$this->load->view('_resume_distribusi_listsn_view', $data);
	}

	/**
	 *  Fungsi	: Reload datatables merchandising
	 *  Module	: -
	 */
	function get_data_merchandising()
	{
		$data['id_jenis_sales'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['id_sales'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tgl'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;

		$this->load->view('_resume_merchandising_view', $data);
	}

	function get_daftar_9()
	{
		$list = $this->data_model->get_datatables_9();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_9;

		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : '';

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->kode_lokasi;
			$row[] = $field->nama_lokasi;
			$row[] = $field->status;

			if ($field->total_perdana > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_merchandising(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'PERDANA\')">
										<div align="right">'.format_currency($field->total_perdana).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->total_voucher_fisik > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_merchandising(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'VOUCHER_FISIK\')">
										<div align="right">'.format_currency($field->total_voucher_fisik).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->total_spanduk > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_merchandising(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'SPANDUK\')">
										<div align="right">'.format_currency($field->total_spanduk).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->total_poster > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_merchandising(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'POSTER\')">
										<div align="right">'.format_currency($field->total_poster).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->total_papan_nama > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_merchandising(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'PAPAN_NAMA\')">
										<div align="right">'.format_currency($field->total_papan_nama).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->total_backdrop > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_merchandising(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'BACKDROP\')">
										<div align="right">'.format_currency($field->total_backdrop).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

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

	function merchandising($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$tgl = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$jenis_lokasi = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$lokasi = $this->uri->segment(6) ? $this->uri->segment(6) : '';
		$jenis_share = $this->uri->segment(7) ? $this->uri->segment(7) : '';

		$data['data'] = $this->data_model->get_data_merchandising_trans($tgl, $sales, $jenis_lokasi, $lokasi, $jenis_share);

		$data['tgl'] = $tgl; $data['sales'] = $sales; $data['jenis_lokasi'] = $jenis_lokasi;
		$data['lokasi'] = $lokasi; $data['jenis_share'] = $jenis_share;

		$this->load->view('_resume_merchandising_trans_view', $data);
	}

	function get_data_merchandising_attac()
  {
    $result = $this->data_model->get_data_merchandising_attac();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->foto_1 = isset($result['foto_1']) ? $result['foto_1'] : 0;
    $response->foto_2 = isset($result['foto_2']) ? $result['foto_2'] : 0;
    $response->foto_3 = isset($result['foto_3']) ? $result['foto_3'] : 0;

		echo json_encode($response);
  }

	/**
	 *  Fungsi	: Reload datatables promotion
	 *  Module	: -
	 */
	function get_data_promotion()
	{
		$data['id_jenis_sales'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['id_sales'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tgl'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;

		$this->load->view('_resume_promotion_view', $data);
	}

	function get_daftar_10()
	{
		$list = $this->data_model->get_datatables_10();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_10;

		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : '';

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->kode_lokasi;
			$row[] = $field->nama_lokasi;
			$row[] = $field->status;

			if ($field->total > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_promotion(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\')">
										<div align="right">'.format_integer($field->total).'</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

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

	function promotion($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$tgl = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$jenis_lokasi = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$lokasi = $this->uri->segment(6) ? $this->uri->segment(6) : '';

		$data['list_promotion'] = $this->data_model->get_list_promotion($tgl, $sales, $jenis_lokasi, $lokasi);

		$this->load->view('_resume_promotion_progr_view', $data);
	}

	/**
	 *  Fungsi	: Reload datatables market audit
	 *  Module	: -
	 */
	function get_data_market_audit()
	{
		$data['id_jenis_sales'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['id_sales'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tgl'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;

		$this->load->view('_resume_market_audit_view', $data);
	}

	function get_daftar_11()
	{
		$list = $this->data_model->get_datatables_11();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_11;

		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : '';

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->kode_lokasi;
			$row[] = $field->nama_lokasi;
			$row[] = $field->status;

			if ($field->belanja > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_market_audit(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'BELANJA\', \'-\')">
										<div align="right">'.format_currency($field->belanja).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->sales_broadband_ld > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_market_audit(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'SALES_BROADBAND\', \'LD\')">
										<div align="right">'.format_currency($field->sales_broadband_ld).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->sales_broadband_md > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_market_audit(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'SALES_BROADBAND\', \'MD\')">
										<div align="right">'.format_currency($field->sales_broadband_md).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->sales_broadband_hd > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_market_audit(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'SALES_BROADBAND\', \'HD\')">
										<div align="right">'.format_currency($field->sales_broadband_hd).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->voucher_fisik_ld > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_market_audit(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'VOUCHER_FISIK\', \'LD\')">
										<div align="right">'.format_currency($field->voucher_fisik_ld).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->voucher_fisik_md > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_market_audit(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'VOUCHER_FISIK\', \'MD\')">
										<div align="right">'.format_currency($field->voucher_fisik_md).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

			if ($field->voucher_fisik_hd > 0)
			{
				$row[] = '<a href="javascript:void(0);"
									onClick="lihat_market_audit(\''.$tgl.'\', \''.$field->jenis_lokasi.'\', \''.$field->id_lokasi.'\', \'VOUCHER_FISIK\', \'HD\')">
										<div align="right">'.format_currency($field->voucher_fisik_hd).' %</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">0</div>';
			}

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

	function market_audit($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$tgl = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$jenis_lokasi = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$lokasi = $this->uri->segment(6) ? $this->uri->segment(6) : '';
		$jenis_share = $this->uri->segment(7) ? $this->uri->segment(7) : '';
		$kategori = $this->uri->segment(8) !== '-' ? $this->uri->segment(8) : '';

		$data['data'] = $this->data_model->get_data_market_audit_trans($tgl, $sales, $jenis_lokasi, $lokasi, $jenis_share, $kategori);

		$data['tgl'] = $tgl; $data['sales'] = $sales; $data['jenis_lokasi'] = $jenis_lokasi;
		$data['lokasi'] = $lokasi; $data['jenis_share'] = $jenis_share; $data['kategori'] = $kategori;

		$this->load->view('_resume_market_audit_trans_view', $data);
	}
}
?>