<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target_sales extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'target_sales';
		$this->daftar_display = 'List Target Sales';
		$this->form_display = 'Form Target Sales';
		$this->modul_display = 'Target Sales';
		$this->view_list = 'target_sales_list_view';
		$this->view_form = 'target_sales_form_view';
		$this->load->model('Target_sales_model', 'data_model');
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

	function get_data_tab_list()
	{
		$data['id_cluster'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['tahun'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['bulan'] = $this->uri->segment(5) ? (int) $this->uri->segment(5) : NULL;
		$data['minggu'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['jns_sales'] = $this->uri->segment(7) ? $this->uri->segment(7) : 'SF';

		$this->load->view('_tab_list_view', $data);
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

			$row[] = '<div align="right">'.format_integer($field->sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->new_rs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->link_aja).'</div>';

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

	function get_data_tab_entry_sf()
	{
		$data['modul'] = $this->modul_name;
		$data['list_target_sales_sf'] = $this->data_model->get_list_target_sales_sf();

		$this->load->view('_tab_entry_sf_view', $data);
	}

	function proses_sf()
	{
		$response = (object) NULL;

		$success = $this->data_model->save_data_sf();

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

	function get_data_tab_entry_ds()
	{
		$data['modul'] = $this->modul_name;
		$data['list_target_sales_ds'] = $this->data_model->get_list_target_sales_ds();

		$this->load->view('_tab_entry_ds_view', $data);
	}

	function proses_ds()
	{
		$response = (object) NULL;

		$success = $this->data_model->save_data_ds();

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