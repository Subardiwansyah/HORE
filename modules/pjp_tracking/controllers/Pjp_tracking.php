<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pjp_tracking extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'pjp_tracking';
		$this->daftar_display = 'List Tracking PJP';
		$this->form_display = 'Form Tracking PJP';
		$this->modul_display = 'Tracking PJP';
		$this->view_list = 'pjp_tracking_list_view';
		$this->view_form = 'pjp_tracking_form_view';
		$this->load->model('Pjp_tracking_model', 'data_model');
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

	function get_data_map()
	{
		$data['id_sales'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$tgl = $this->uri->segment(4) ? $this->uri->segment(4) : '-';

		if ($tgl == '-')
		{
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_map_view', $data);
	}

	function get_data_kunjungan()
  {
    $result = $this->data_model->get_data_kunjungan();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->jumlah = isset($result['jumlah']) ? format_integer($result['jumlah']) : 0;
    $response->dikunjungi = isset($result['dikunjungi']) ? format_integer($result['dikunjungi']) : 0;
    $response->tdk_dikunjungi = isset($result['tdk_dikunjungi']) ? format_integer($result['tdk_dikunjungi']) : 0;

		echo json_encode($response);
  }
}
?>