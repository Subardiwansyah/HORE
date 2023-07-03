<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_sn extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'check_sn';
		$this->daftar_display = 'List Check SN';
		$this->form_display = 'Form Check SN';
		$this->modul_display = 'Check SN';
		$this->view_list = 'check_sn_list_view';
		$this->view_form = 'check_sn_form_view';
		$this->view_view = 'check_sn_view_view';
		$this->load->model('Check_sn_model', 'data_model');
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

	function validasi_form()
	{
		$this->form_validation->set_rules('id', 'ID', 'required|trim');

		$this->form_validation->set_message('required', '%s tidak boleh kosong.');
		$this->form_validation->set_message('min_length', 'Minimal %s tiga (3) karakter.');
		$this->form_validation->set_message('max_length', '%s tidak boleh melebihi %s karakter.');
		$this->form_validation->set_message('integer', '%s harus angka.');
		$this->form_validation->set_message('_cek_duplikasi', '%s sudah ada.');
	}

	function _cek_duplikasi()
	{
		return $this->data_model->check_duplikasi();
	}

	function get_data_gudang_segel()
  {
    $result = $this->data_model->get_data_gudang_segel();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->tgl = isset($result['tgl']) ? $result['tgl'] : '';
    $response->nm_produk = isset($result['nama_produk']) ? $result['nama_produk'] : '';
    $response->harga_modal = isset($result['harga_modal']) ? format_currency($result['harga_modal']) : '0,00';
    $response->harga_bandrol = isset($result['harga_bandrol']) ? format_currency($result['harga_bandrol']) : '0,00';
    $response->nm_branch = isset($result['nama_branch']) ? $result['nama_branch'] : '';
    $response->nm_cluster = isset($result['nama_cluster']) ? $result['nama_cluster'] : '';

		echo json_encode($response);
  }

	function get_data_proses_inject()
  {
    $result = $this->data_model->get_data_proses_inject();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->tgl = isset($result['tgl']) ? $result['tgl'] : '';
    $response->nm_produk = isset($result['nama_produk']) ? $result['nama_produk'] : '';
    $response->nm_tap = isset($result['nama_tap']) ? $result['nama_tap'] : '';
    $response->modal_bulk = isset($result['modal_bulk']) ? format_currency($result['modal_bulk']) : '0,00';
    $response->jml_bulk = isset($result['jml_bulk']) ? format_integer($result['jml_bulk']) : 0;
    $response->total_modal = isset($result['total_modal']) ? format_currency($result['total_modal']) : '0,00';

		echo json_encode($response);
  }

	function get_data_product_booking()
  {
    $result = $this->data_model->get_data_product_booking();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->tgl = isset($result['tgl']) ? $result['tgl'] : '';
    $response->nm_jns_sales = isset($result['nama_jenis_sales']) ? $result['nama_jenis_sales'] : '';
    $response->nm_sales = isset($result['nama_sales']) ? $result['nama_sales'] : '';
    $response->nm_jns_produk = isset($result['nama_jenis_produk']) ? $result['nama_jenis_produk'] : '';
    $response->harga_jual = isset($result['harga_jual']) ? format_currency($result['harga_jual']) : '0,00';

		echo json_encode($response);
  }

	function get_data_distribusi()
  {
    $result = $this->data_model->get_data_distribusi();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->tgl_distribusi = isset($result['tgl']) ? $result['tgl'] : '';
    $response->nm_lokasi = isset($result['nama_lokasi']) ? $result['nama_lokasi'] : '';
    $response->nm_pembeli = isset($result['nama_pembeli']) ? $result['nama_pembeli'] : '';
    $response->telp_pembeli = isset($result['no_hp_pembeli']) ? $result['no_hp_pembeli'] : '';
    $response->no_nota = isset($result['no_nota']) ? $result['no_nota'] : '';
    $response->status_pembayaran = isset($result['pembayaran']) ? $result['pembayaran'] : '';

		echo json_encode($response);
  }
}
?>