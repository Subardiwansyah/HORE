<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_setoran extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'daftar_setoran';
		$this->daftar_display = 'List Daftar Setoran';
		$this->form_display = 'Form Daftar Setoran';
		$this->modul_display = 'Daftar Setoran';
		$this->view_list = 'daftar_setoran_list_view';
		$this->view_form = 'daftar_setoran_form_view';
		$this->view_view = 'daftar_setoran_view_view';
		$this->load->model('Daftar_setoran_model', 'data_model');
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
			$row[] = '<div align="right">'.$no.'</div>';

			$row[] = $field->id_sales;
			$row[] = $field->nama_sales;
			$row[] = $field->nama_tap;
			$row[] = $field->nama_cluster;
			$row[] = '<div align="right">'.format_integer($field->penjualan).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sudah_bayar).'</div>';

			if ($field->belum_bayar > 0)
			{
				$row[] = '<a href="javascript:void(0);" onClick="lihat_nota(\''.$field->id_sales.'\')">
									<div align="right">'.format_integer($field->belum_bayar).'</div>
								</a>';
			}
			else
			{
				$row[] = '<div align="right">'.format_integer($field->belum_bayar).'</div>';
			}

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

	function nota_belum_disetor()
	{
		$id_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$tahun = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$bulan = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;

		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$data['data_sales'] = $this->data_model->get_data_sales($id_sales);
		$data['list_nota'] = $this->data_model->get_list_nota($id_sales, $tahun, $bulan);

		$this->load->view('_nota_belum_disetor_view', $data);
	}
}
?>