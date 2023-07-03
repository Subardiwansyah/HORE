<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Briefing_sales extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'briefing_sales';
		$this->daftar_display = 'List Briefing';
		$this->form_display = 'Form Briefing';
		$this->modul_display = 'Briefing';
		$this->view_list = 'briefing_sales_list_view';
		$this->view_form = 'briefing_sales_form_view';
		$this->view_view = 'briefing_sales_view_view';
		$this->load->model('Briefing_sales_model', 'data_model');
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

	function briefing_sales_form()
	{
		$data['id_jns_sales'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['id_sales'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['tgl'] = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		$this->load->view('briefing_sales_form_view', $data);
	}

	function get_data_coverage()
	{
		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_coverage_view', $data);
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

			$row[] = '<center><div style="width:40px;">
					<a target="_blank" href="https://www.google.com/maps/place/'.$field->latitude.','.$field->longitude.'/@'.$field->latitude.','.$field->longitude.'">
						<button type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" id="btn-map" title="Lihat Lokasi">
							<i class="fal fa-map-marker-alt"></i>
						</button>
					</a>
				</div></center>';

			$row[] = $field->nama_lokasi;
			$row[] = "<div align='center'>".$field->clock_in."</div>";
			$row[] = "<div align='center'>".$field->clock_out."</div>";
			$row[] = "<div align='center'>".$field->durasi."</div>";
			$row[] = "<div align='center'>".$field->status_pjp."</div>";

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

	function get_data_distribusi_target_penjualan()
	{
		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_distribusi_target_penjualan_view', $data);
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

			$row[] = $field->nama_lokasi;

			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgprepaid)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgota)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgvin)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgvgs)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgvgg)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgvgp)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_insac_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_insac_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_insac_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invin_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invin_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invin_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invga_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invga_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invga_hd)."</div>";
			$row[] = "<div align='right' style='width:70px;'>".format_integer($field->penjualan_la)."</div>";

			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:50px;'>0</div>";
			$row[] = "<div align='right' style='width:70px;'>0</div>";

			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgprepaid)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgota)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgvin)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgvgs)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgvgg)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_sgvgp)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_insac_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_insac_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_insac_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invin_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invin_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invin_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invga_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invga_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->penjualan_invga_hd)."</div>";
			$row[] = "<div align='right' style='width:70px;'>".format_integer($field->penjualan_la)."</div>";

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

	function get_data_distribusi_history_order()
	{
		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_distribusi_history_order_view', $data);
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

			$row[] = $field->nama_lokasi;

			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_sgprepaid)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_sgota)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_sgvin)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_sgvgs)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_sgvgg)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_sgvgp)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_insac_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_insac_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_insac_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_invin_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_invin_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_invin_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_invga_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_invga_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w1_invga_hd)."</div>";
			$row[] = "<div align='right' style='width:70px;'>".format_integer($field->w1_la)."</div>";

			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_sgprepaid)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_sgota)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_sgvin)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_sgvgs)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_sgvgg)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_sgvgp)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_insac_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_insac_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_insac_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_invin_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_invin_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_invin_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_invga_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_invga_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w2_invga_hd)."</div>";
			$row[] = "<div align='right' style='width:70px;'>".format_integer($field->w2_la)."</div>";

			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_sgprepaid)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_sgota)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_sgvin)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_sgvgs)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_sgvgg)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_sgvgp)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_insac_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_insac_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_insac_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_invin_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_invin_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_invin_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_invga_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_invga_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w3_invga_hd)."</div>";
			$row[] = "<div align='right' style='width:70px;'>".format_integer($field->w3_la)."</div>";

			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_sgprepaid)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_sgota)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_sgvin)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_sgvgs)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_sgvgg)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_sgvgp)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_insac_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_insac_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_insac_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_invin_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_invin_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_invin_hd)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_invga_ld)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_invga_md)."</div>";
			$row[] = "<div align='right' style='width:50px;'>".format_integer($field->w4_invga_hd)."</div>";
			$row[] = "<div align='right' style='width:70px;'>".format_integer($field->w4_la)."</div>";

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

	function get_data_merchandising_perdana()
	{
		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_merchandising_perdana_view', $data);
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

			$row[] = $field->nama_lokasi;

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_total)."</div>";

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

	function get_data_merchandising_voucher_fisik()
	{
		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_merchandising_voucher_fisik_view', $data);
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

			$row[] = $field->nama_lokasi;

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_total)."</div>";

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

	function get_data_merchandising_spanduk()
	{
		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_merchandising_spanduk_view', $data);
	}

	function get_daftar_6()
	{
		$list = $this->data_model->get_datatables_6();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_6;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama_lokasi;

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_total)."</div>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_6(),
			"recordsFiltered" => $this->data_model->count_filtered_6(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_merchandising_poster()
	{
		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_merchandising_poster_view', $data);
	}

	function get_daftar_7()
	{
		$list = $this->data_model->get_datatables_7();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_7;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama_lokasi;

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_total)."</div>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_7(),
			"recordsFiltered" => $this->data_model->count_filtered_7(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_merchandising_papan_nama()
	{
		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_merchandising_papan_nama_view', $data);
	}

	function get_daftar_8()
	{
		$list = $this->data_model->get_datatables_8();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_8;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama_lokasi;

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_total)."</div>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_8(),
			"recordsFiltered" => $this->data_model->count_filtered_8(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_merchandising_backdrop()
	{
		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_merchandising_backdrop_view', $data);
	}

	function get_daftar_9()
	{
		$list = $this->data_model->get_datatables_9();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_9;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama_lokasi;

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w1_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w2_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w3_total)."</div>";

			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_telkomsel)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_isat)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_xl)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_axis)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_other)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_smartfren)."</div>";
			$row[] = "<div align='right' style='width:60px;'>".format_integer($field->w4_total)."</div>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_9(),
			"recordsFiltered" => $this->data_model->count_filtered_9(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_promotion()
	{
		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_jenis_sales'] = $id_jenis_sales;
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$data['list_program_w1'] = $this->data_model->list_program_w1($data['tgl']);
		$data['list_program_w2'] = $this->data_model->list_program_w2($data['tgl']);
		$data['list_program_w3'] = $this->data_model->list_program_w3($data['tgl']);
		$data['list_program_w4'] = $this->data_model->list_program_w4($data['tgl']);

		$this->load->view('_promotion_view', $data);
	}

	function get_daftar_10()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : 0;
		$tgl = $this->input->post('tgl') ? $this->input->post('tgl') : date('Y-m-d');

		$res_program = $this->data_model->daftar_program($id_sales, $tgl);

		$list = $this->data_model->get_datatables_10();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_10;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = $field->nama_lokasi;

			$total_w1 = 0; $total_w2 = 0; $total_w3 = 0; $total_w4 = 0;

			for ($i=0; $i<count($res_program['week1']); $i++)
			{
				$program = 'program_w1_'.$i;

				$row[] = "<div align='right' style='width:60px;'>".format_integer($field->$program)."</div>";

				$total_w1 = $total_w1 + $field->$program;
			}

			if (count($res_program['week1']) > 0) { $row[] = "<div align='right' style='width:60px;'>".$total_w1."</div>"; }

			for ($i=0; $i<count($res_program['week2']); $i++)
			{
				$program = 'program_w2_'.$i;

				$row[] = "<div align='right' style='width:60px;'>".format_integer($field->$program)."</div>";

				$total_w2 = $total_w2 + $field->$program;
			}

			if (count($res_program['week2']) > 0) { $row[] = "<div align='right' style='width:60px;'>".$total_w2."</div>"; }

			for ($i=0; $i<count($res_program['week3']); $i++)
			{
				$program = 'program_w3_'.$i;

				$row[] = "<div align='right' style='width:60px;'>".format_integer($field->$program)."</div>";

				$total_w3 = $total_w3 + $field->$program;
			}

			if (count($res_program['week3']) > 0) { $row[] = "<div align='right' style='width:60px;'>".$total_w3."</div>"; }

			for ($i=0; $i<count($res_program['week4']); $i++)
			{
				$program = 'program_w4_'.$i;

				$row[] = "<div align='right' style='width:60px;'>".format_integer($field->$program)."</div>";

				$total_w4 = $total_w4 + $field->$program;
			}

			if (count($res_program['week4']) > 0) { $row[] = "<div align='right' style='width:60px;'>".$total_w4."</div>"; }

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_10(),
			"recordsFiltered" => $this->data_model->count_filtered_10(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	function get_data_sales_report()
	{
		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$this->load->view('_sales_report_view', $data);
	}

	function get_daftar_11()
	{
		$list = $this->data_model->get_datatables_11();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar_11;

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			$row[] = '<center><div style="width:60px;">
				<button onClick="lihat_nota(\''.$field->no_nota.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat Nota">
						<i class="fal fa-file-alt"></i>
					</button>
					<button onClick="lihat_penjualan(\''.$field->no_nota.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat Penjualan">
						<i class="fal fa-shopping-cart"></i>
					</button>
				</div></center>';

			$row[] = $field->no_nota;
			$row[] = $field->pembayaran;
			$row[] = "<div align='right'>".format_integer($field->total_perdana)."</div>";
			$row[] = "<div align='right'>".format_currency($field->total_linkaja)."</div>";
			$row[] = "<div align='right'>".format_currency($field->total_penjualan)."</div>";
			$row[] = "<div align='right'>".format_currency($field->setoran)."</div>";
			$row[] = "<div align='center'>".$field->status_setoran."</div>";

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all_11(),
			"recordsFiltered" => $this->data_model->count_filtered_11(),
			"data" => $data,
		);

		echo json_encode($output);
	}

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

	function get_data_komitmen()
	{
		$data['modul'] = $this->modul_name;

		$id_jenis_sales = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$id_sales = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$tgl = $this->uri->segment(5) ? $this->uri->segment(5) : '-';

		if ($tgl == '-')
		{
			$data['id_sales'] = $id_sales;
			$data['tgl'] = date('Y-m-d');
		}
		else
		{
			$data['id_sales'] = $id_sales;
			$data['tgl'] = prepare_date(str_replace("-", "/", $tgl));
		}

		$data['data_komitmen'] = $this->data_model->get_data_briefing_komitmen($data['id_sales'], $data['tgl']);

		$this->load->view('_komitmen_view', $data);
	}

	function get_data_kunjungan_lokasi()
  {
    $result = $this->data_model->get_data_kunjungan_lokasi();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->jumlah = isset($result['jumlah']) ? format_integer($result['jumlah']) : 0;
    $response->dikunjungi = isset($result['dikunjungi']) ? format_integer($result['dikunjungi']) : 0;
    $response->tdk_dikunjungi = isset($result['tdk_dikunjungi']) ? format_integer($result['tdk_dikunjungi']) : 0;

		echo json_encode($response);
  }

	function get_data_total_penjualan()
  {
    $result = $this->data_model->get_data_total_penjualan();

		$response = (object) NULL;
    $response->sql = $this->db->queries;

    $response->lunas = isset($result['lunas']) ? format_currency($result['lunas']) : "0,00";
    $response->konsinyasi = isset($result['konsinyasi']) ? format_currency($result['konsinyasi']) : "0,00";
    $response->total = isset($result['total']) ? format_currency($result['total']) : "0,00";
    $response->link_aja = isset($result['link_aja']) ? format_currency($result['link_aja']) : "0,00";

		echo json_encode($response);
  }

	function proses()
	{
		$response = (object) NULL;

		$success = $this->data_model->save_data();

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