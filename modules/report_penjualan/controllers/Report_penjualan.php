<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_penjualan extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'report_penjualan';
		$this->daftar_display = 'List Report Penjualan';
		$this->form_display = 'Form Report Penjualan';
		$this->modul_display = 'Report Penjualan';
		$this->view_list = 'report_penjualan_list_view';
		$this->view_form = 'report_penjualan_form_view';
		$this->view_view = 'report_penjualan_view_view';
		$this->load->model('Report_penjualan_model', 'data_model');
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

	/**
	 *  Fungsi	: Menampilkan data distribusi sales
	 *  Module	: -
	 */
	function get_data_distribusi()
  {
    $result = $this->data_model->get_data_distribusi();

		$response = (object) NULL;
    $response->sql = $this->db->queries;

    $response->lunas = isset($result['lunas']) ? format_currency($result['lunas']) : "0,00";
    $response->konsinyasi = isset($result['konsinyasi']) ? format_currency($result['konsinyasi']) : "0,00";
    $response->total = isset($result['total']) ? format_currency($result['total']) : "0,00";
    $response->link_aja = isset($result['link_aja']) ? format_currency($result['link_aja']) : "0,00";

		echo json_encode($response);
  }

	/**
	 *  Fungsi	: Menampilkan daftar
	 *  Module	: -
	 */
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
			// $row[] = $no;

			$row[] = '<center>
					<button onClick="lihat_nota(\''.$field->no_nota.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat Nota">
						<i class="fal fa-file-alt"></i>
					</button>
					<button onClick="lihat_penjualan(\''.$field->no_nota.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat Penjualan">
						<i class="fal fa-shopping-cart"></i>
					</button>
				</center>';

			$row[] = '<div align="center">'.$field->no_nota.'</div>';
			$row[] = '<div align="center">'.format_date($field->tgl_transaksi).'</div>';
			$row[] = $field->pembayaran;
			$row[] = '<div align="right">'.format_currency($field->total_perdana).'</div>';
			$row[] = '<div align="right">'.format_currency($field->total_linkaja).'</div>';

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

	/**
	 *  Fungsi	: Menampilkan nota pembayaran
	 *  Module	: -
	 */
	function lihat_nota_penjualan()
	{
		$data['nota'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$data['data_penjualan'] = $this->data_model->get_data_penjualan($data['nota']);
		$data['list_penjualan'] = $this->data_model->get_list_penjualan($data['nota']);

		$this->load->view('_nota_penjualan_view', $data);
	}

	function lihat_penjualan_perdana()
	{
		$data['id'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_view;

		$this->load->view('_penjualan_perdana_view', $data);
	}

	/**
	 *  Fungsi	: Menampilkan penjualan perdana + serial number
	 *  Module	: -
	 */
	function get_list_penjualan_perdana()
  {
    $result = $this->data_model->get_list_penjualan_perdana();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->len = count($result);

    if ($result)
		{
      for($i=0; $i<count($result); $i++)
			{
        $response->rows[$i]['id_produk'] = $result[$i]['id_produk'];
        $response->rows[$i]['nama_produk'] = isset($result[$i]['nama_produk']) ? $result[$i]['nama_produk'] : '';
        $response->rows[$i]['qty'] = isset($result[$i]['qty']) ? prepare_integer($result[$i]['qty']) : 0;
        $response->rows[$i]['serial_number'] = isset($result[$i]['serial_number']) ? explode(',', $result[$i]['serial_number']) : '';
      }
    }

		echo json_encode($response);
  }
}
?>