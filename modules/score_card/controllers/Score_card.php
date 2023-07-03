<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Score_card extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'score_card';
		$this->daftar_display = 'List Score Card';
		$this->form_display = 'Form Score Card';
		$this->modul_display = 'Score Card';
		$this->view_list = 'score_card_list_view';
		$this->view_form = 'score_card_form_view';
		$this->load->model('Score_card_model', 'data_model');
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

	function get_data_view()
	{
		$data['id_cluster'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['id_tap'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['id_jns_sales'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['id_sales'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['tahun'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['bulan'] = $this->uri->segment(8) ? $this->uri->segment(8) : NULL;

		$this->load->view('_sf_view_view', $data);
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

			$row[] = '<div align="center">'.$field->tgl.'</div>';
			$row[] = $field->hari;

			$row[] = '<div align="right">'.format_integer($field->pjp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->actual_call_jml).'</div>';
			$row[] = '<div align="right">'.format_integer($field->actual_call_persen).'</div>';
			$row[] = '<div align="right">'.format_integer($field->effective_call_jml).'</div>';
			$row[] = '<div align="right">'.format_integer($field->effective_call_persen).'</div>';

			$row[] = '<div align="right">'.format_integer($field->uhj_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_new_rs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_limit_link_aja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->trg_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_new_rs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_limit_link_aja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->rmt_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_new_rs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_limit_link_aja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->evm_perdana).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_voucher_fisik).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_layar_toko).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_poster).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_neon_box).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_stiker).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_video).'</div>';

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

	function get_data_resume()
	{
		$data['id_cluster'] = $this->uri->segment(3) ? $this->uri->segment(3) : NULL;
		$data['id_tap'] = $this->uri->segment(4) ? $this->uri->segment(4) : NULL;
		$data['id_jns_sales'] = $this->uri->segment(5) ? $this->uri->segment(5) : NULL;
		$data['tahun'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['bulan'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;

		$this->load->view('_sf_resume_view', $data);
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

			$row[] = $field->nama;

			$row[] = '<div align="right">'.format_integer($field->pjp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->actual_call_jml).'</div>';
			$row[] = '<div align="right">'.format_integer($field->actual_call_persen).'</div>';
			$row[] = '<div align="right">'.format_integer($field->effective_call_jml).'</div>';
			$row[] = '<div align="right">'.format_integer($field->effective_call_persen).'</div>';

			$row[] = '<div align="right">'.format_integer($field->uhj_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_new_rs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->uhj_limit_link_aja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->trg_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_new_rs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->trg_limit_link_aja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->rmt_sgprepaid).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_sgota).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_sgvin).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_sgvgs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_sgvgg).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_sgvgp).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_insac_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_insac_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_insac_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invin_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invin_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invin_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invga_ld).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invga_md).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_invga_hd).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_new_rs).'</div>';
			$row[] = '<div align="right">'.format_integer($field->rmt_limit_link_aja).'</div>';

			$row[] = '<div align="right">'.format_integer($field->evm_perdana).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_voucher_fisik).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_layar_toko).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_poster).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_neon_box).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_stiker).'</div>';
			$row[] = '<div align="right">'.format_integer($field->evm_video).'</div>';

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