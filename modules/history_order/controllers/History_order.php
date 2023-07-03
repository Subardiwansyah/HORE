<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_order extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'history_order';
		$this->daftar_display = 'List History Order';
		$this->form_display = 'Form History Order';
		$this->modul_display = 'History Order';
		$this->view_list = 'history_order_list_view';
		$this->view_form = 'history_order_form_view';
		$this->load->model('History_order_model', 'data_model');
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

	function history_order_form()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['id_sales'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['id_jns_sales'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['id_jns_lokasi'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['hari'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;

		$this->load->view('history_order_form_view', $data);
	}

	function get_data_week()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['id_sales'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['id_jns_sales'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['id_jns_lokasi'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['hari'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;

		$data['data_week'] = $this->data_model->get_data_history_weekly();

		$this->load->view('_week_view', $data);
	}

	function get_data_month()
	{
		$data['id_tap'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['id_sales'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['id_jns_sales'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['id_jns_lokasi'] = $this->uri->segment(6) ? $this->uri->segment(6) : 0;
		$data['hari'] = $this->uri->segment(7) ? $this->uri->segment(7) : 0;

		$data['data_month'] = $this->data_model->get_data_history_monthly();

		$this->load->view('_month_view', $data);
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

			$row[] = $field->nama_lokasi;

			$row[] = '<div align="right">'.format_integer($field->w3_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_la).'</div>';

			$row[] = '<div align="right">'.format_integer($field->w2_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_la).'</div>';

			$row[] = '<div align="right">'.format_integer($field->w1_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_la).'</div>';

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
			$row[] = $no;

			$row[] = $field->nama_lokasi;

			$row[] = '<div align="right">'.format_integer($field->w3_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w3_la).'</div>';

			$row[] = '<div align="right">'.format_integer($field->w2_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w2_la).'</div>';

			$row[] = '<div align="right">'.format_integer($field->w1_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->w1_la).'</div>';

			$row[] = '<div align="right">'.format_integer($field->avg_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->avg_la).'</div>';

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
}
?>