<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voice_of_reseller extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'voice_of_reseller';
		$this->daftar_display = 'List Voice of Reseller';
		$this->form_display = 'Form Voice of Reseller';
		$this->modul_display = 'Voice of Reseller';
		$this->view_list = 'voice_of_reseller_list_view';
		$this->view_form = 'voice_of_reseller_form_view';
		$this->load->model('Voice_of_reseller_model', 'data_model');
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

	function voice_of_reseller_form()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$this->load->view('voice_of_reseller_form_view', $data);
	}

	function get_data_grafik_pertanyaan_1()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->data_model->get_list_pertanyaan_1(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->data_model->get_data_pertanyaan_1(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_grafik_pertanyaan_1_view', $data);
	}

	function get_data_grafik_pertanyaan_2()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->data_model->get_list_pertanyaan_2(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->data_model->get_data_pertanyaan_2(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_grafik_pertanyaan_2_view', $data);
	}

	function get_data_grafik_pertanyaan_3()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->data_model->get_list_pertanyaan_3(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->data_model->get_data_pertanyaan_3(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_grafik_pertanyaan_3_view', $data);
	}

	function get_data_grafik_pertanyaan_4()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->data_model->get_list_pertanyaan_4(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->data_model->get_data_pertanyaan_4(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_grafik_pertanyaan_4_view', $data);
	}

	function get_data_grafik_pertanyaan_5()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->data_model->get_list_pertanyaan_5(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->data_model->get_data_pertanyaan_5(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_grafik_pertanyaan_5_view', $data);
	}

	function get_data_grafik_pertanyaan_6()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->data_model->get_list_pertanyaan_6(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->data_model->get_data_pertanyaan_6(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_grafik_pertanyaan_6_view', $data);
	}

	function get_data_grafik_pertanyaan_7()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->data_model->get_list_pertanyaan_7(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->data_model->get_data_pertanyaan_7(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_grafik_pertanyaan_7_view', $data);
	}

	function voice_of_reseller_survey_form()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$this->load->view('voice_of_reseller_survey_form_view', $data);
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

			$row[] = '<div align="center">'.$no.'</div>';
			$row[] = $field->nama_team;
			$row[] = $field->jabatan;
			$row[] = $field->id_digipos;
			$row[] = $field->nama_outlet;
			$row[] = $field->sales_sf;

			$row[] = '<center>
				<button onClick="lihat(\''.$field->id.'\')" type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed" title="Play">
					<i class="fal fa-video"></i>
				</button>
			</center>';

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

	function video_voice_of_reseller_form()
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