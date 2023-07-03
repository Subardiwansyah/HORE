<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video_tutorial extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'video_tutorial';
		$this->daftar_display = 'List Video Tutorial';
		$this->form_display = 'Form Video Tutorial';
		$this->modul_display = 'Video Tutorial';
		$this->view_list = 'video_tutorial_list_view';
		$this->view_form = 'video_tutorial_form_view';
		$this->load->model('Video_tutorial_model', 'data_model');
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

	function get_data_regional()
	{
		$this->load->view('_regional_view');
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
			$row[] = '<center>
				<button onClick="lihat(\''.$field->id.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Lihat">
					<i class="fal fa-eye"></i>
				</button>
			</center>';

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
		$this->load->view('_branch_view');
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
			$row[] = '<center>
				<button onClick="lihat(\''.$field->id.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Lihat">
					<i class="fal fa-eye"></i>
				</button>
			</center>';

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
		$this->load->view('_cluster_view');
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
			$row[] = '<center>
				<button onClick="lihat(\''.$field->id.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Lihat">
					<i class="fal fa-eye"></i>
				</button>
			</center>';

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

	function get_data_tap()
	{
		$this->load->view('_tap_view');
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
			$row[] = '<center>
				<button onClick="lihat(\''.$field->id.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Lihat">
					<i class="fal fa-eye"></i>
				</button>
			</center>';

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

	function get_data_sales()
	{
		$this->load->view('_sales_view');
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
			$row[] = '<center>
				<button onClick="lihat(\''.$field->id.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Lihat">
					<i class="fal fa-eye"></i>
				</button>
			</center>';

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

	function video_tutorial_form()
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		if ($id !== NULL)
		{
			$data['data'] = $this->data_model->get_data_video($id);
		}

		$this->load->view('_play_video_view', $data);
	}
}
?>