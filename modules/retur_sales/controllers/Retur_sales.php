<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_sales extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'retur_sales';
		$this->daftar_display = 'List Retur';
		$this->form_display = 'Form Retur';
		$this->modul_display = 'Retur';
		$this->view_list = 'retur_sales_list_view';
		$this->view_form = 'retur_sales_form_view';
		$this->view_view = 'retur_sales_view_view';
		$this->load->model('Retur_sales_model', 'data_model');
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

			$row[] = '<center>
				<button onClick="approved(\''.$field->id_retur.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Approved">
					<i class="fal fa-check-square"></i>
				</button>
				<button onClick="rejected(\''.$field->id_retur.'\')" type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" title="Rejected">
					<i class="fal fa-window-close"></i>
				</button>
			</center>';

			$row[] = $field->tgl_retur;
			$row[] = $field->nama_sales;
			$row[] = $field->serial_number;
			$row[] = $field->nama_produk;
			$row[] = '<div class="text-right">'.format_currency($field->harga_jual).'</div>';
			$row[] = $field->nama_alasan;

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

			$row[] = $field->tgl_retur;
			$row[] = $field->tgl_approval;
			$row[] = $field->nama_sales;
			$row[] = $field->serial_number;
			$row[] = $field->nama_produk;
			$row[] = '<div class="text-right">'.format_currency($field->harga_jual).'</div>';
			$row[] = $field->nama_alasan;

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

			$row[] = $field->tgl_retur;
			$row[] = $field->tgl_approval;
			$row[] = $field->nama_sales;
			$row[] = $field->serial_number;
			$row[] = $field->nama_produk;
			$row[] = '<div class="text-right">'.format_currency($field->harga_jual).'</div>';
			$row[] = $field->nama_alasan;

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
	
	function proses_approved()
	{
		$response = (object) NULL;
		$success = $this->data_model->save_data_approved();

		if($success)
		{
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil disimpan';
			$response->error = NULL;
			$response->sql = $this->db->queries;
		}
		else
		{
			$response->isSuccess = FALSE;
			$response->message = 'Data gagal disimpan';
			$response->error = $this->data_model->last_error_message;
			$response->sql = $this->db->queries;
		}

		echo json_encode($response);
	}
	
	function proses_reject()
	{
		$response = (object) NULL;
		$success = $this->data_model->save_data_reject();

		if($success)
		{
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil disimpan';
			$response->error = NULL;
			$response->sql = $this->db->queries;
		}
		else
		{
			$response->isSuccess = FALSE;
			$response->message = 'Data gagal disimpan';
			$response->error = $this->data_model->last_error_message;
			$response->sql = $this->db->queries;
		}

		echo json_encode($response);
	}
}
?>