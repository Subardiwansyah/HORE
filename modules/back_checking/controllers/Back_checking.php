<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_checking extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'back_checking';
		$this->daftar_display = 'List Back Checking';
		$this->form_display = 'Form Back Checking';
		$this->modul_display = 'Back Checking';
		$this->view_list = 'back_checking_list_view';
		$this->view_form = 'back_checking_form_view';
		$this->load->model('Availability_model', 'availability_model');
		$this->load->model('Visibility_model', 'visibility_model');
		$this->load->model('Advokasi_model', 'advokasi_model');
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

	function back_checking_form()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$this->load->view('back_checking_form_view', $data);
	}

	function get_data_grafik_availability()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$this->load->view('_availability_grafik_view', $data);
	}

	function get_data_grafik_availability_varian_perdana_telkomsel()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->availability_model->get_list_availability_vpt(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->availability_model->get_data_availability_vpt(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_availability_grafik_varian_perdana_telkomsel_view', $data);
	}

	function get_data_grafik_availability_perdana_all_operator()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->availability_model->get_list_availability_pao(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->availability_model->get_data_availability_pao(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_availability_grafik_perdana_all_operator_view', $data);
	}

	function get_data_grafik_availability_varian_vf_telkomsel()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->availability_model->get_list_availability_vvft(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->availability_model->get_data_availability_vvft(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_availability_grafik_varian_vf_telkomsel_view', $data);
	}

	function get_data_grafik_availability_vf_all_operator()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->availability_model->get_list_availability_vfao(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->availability_model->get_data_availability_vfao(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_availability_grafik_vf_all_operator_view', $data);
	}

	function get_data_grafik_availability_user_digipos_apps()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->availability_model->get_list_availability_udigipos(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->availability_model->get_data_availability_udigipos(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_availability_grafik_user_digipos_apps_view', $data);
	}

	function get_data_grafik_availability_saldo_la_digipos()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->availability_model->get_list_availability_sladigipos(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->availability_model->get_data_availability_sladigipos(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_availability_grafik_saldo_la_digipos_view', $data);
	}

	function get_data_grafik_visibility()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$this->load->view('_visibility_grafik_view', $data);
	}

	function get_data_grafik_visibility_etalase()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->visibility_model->get_list_visibility_etalase(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->visibility_model->get_data_visibility_etalase(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_visibility_grafik_etalase_view', $data);
	}

	function get_data_grafik_visibility_diamond_hotspot()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->visibility_model->get_list_visibility_diamondh(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->visibility_model->get_data_visibility_diamondh(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_visibility_grafik_diamond_hotspot_view', $data);
	}

	function get_data_grafik_visibility_poster()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->visibility_model->get_list_visibility_poster(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->visibility_model->get_data_visibility_poster(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_visibility_grafik_poster_view', $data);
	}

	function get_data_grafik_visibility_layar_toko()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->visibility_model->get_list_visibility_layar_toko(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->visibility_model->get_data_visibility_layar_toko(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_visibility_grafik_layar_toko_view', $data);
	}

	function get_data_grafik_visibility_omni()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->visibility_model->get_list_visibility_omni(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$data['data'] = $this->visibility_model->get_data_visibility_omni(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_visibility_grafik_omni_view', $data);
	}

	function get_data_grafik_advokasi()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$this->load->view('_advokasi_grafik_view', $data);
	}

	function get_data_grafik_advokasi_advokasi()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['pilperiode'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['tahun_kuartal'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['bulan_kuartal'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;
		$data['minggu'] = $this->uri->segment(9) ? $this->uri->segment(9) : 0;

		$data['list'] = $this->advokasi_model->get_list_advokasi(
			$data['id_tap'], $data['pilperiode'],
			$data['tahun_kuartal'], $data['bulan_kuartal'],
			$data['tahun'], $data['bulan'], $data['minggu']
		);

		$this->load->view('_advokasi_grafik_advokasi_view', $data);
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
			$row[] = "<div align='center'>".$field->id_digipos."</div>";
			$row[] = $field->nama_outlet;
			$row[] = $field->parameter;
			$row[] = $field->total_ya;
			$row[] = $field->total_tidak;
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
}
?>