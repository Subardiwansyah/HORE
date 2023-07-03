<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekomendasi_distribusi extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'rekomendasi_distribusi';
		$this->daftar_display = 'List Rekomedasi Distribusi';
		$this->form_display = 'Form Rekomedasi Distribusi';
		$this->modul_display = 'Rekomedasi Distribusi';
		$this->view_list = 'rekomendasi_distribusi_list_view';
		$this->view_form = 'rekomendasi_distribusi_form_view';
		$this->load->model('Rekomendasi_distribusi_model', 'data_model');
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

	function reload_list_rekomendasi()
	{
		$id_cluster = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$tahun = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$bulan = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$minggu = $this->uri->segment(6) ? $this->uri->segment(6) : 0;

		// $data['data'] = $this->data_model->get_data_list_rekomendasi($id_cluster, $tahun, $bulan, $minggu);
		
		$data['data_ss'] = $this->data_model->x_get_data_ss($id_cluster, $tahun, $bulan, $minggu);
		$data['data_dpt'] = $this->data_model->x_get_data_dpt($id_cluster, $tahun, $bulan, $minggu);

		$this->load->view('_list_rekomendasi_view', $data);
	}

	function reload_entry_rekomendasi()
	{
		$data['data_ss'] = $this->data_model->get_data_ss();
		$data['data_dpt'] = $this->data_model->get_data_dpt();
		$data['data_rd'] = $this->data_model->get_data_rd();

		$this->load->view('_entry_rekomendasi_view', $data);
	}

	function proses_entry_rekomendasi()
	{
		$response = (object) NULL;

		$success = $this->data_model->save_data_entry_rekomendasi();

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

	function reload_edit_target_sales()
	{
		$data['modul'] = $this->modul_name;

		$data['data'] = $this->data_model->get_total_data();

		$this->load->view('_edit_target_sales_view', $data);
	}

	function get_daftar()
	{
		$list = $this->data_model->get_datatables();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar;

		$total_sgprepaid = 0;
		$nilai = 0;

		$result = $this->data_model->get_total_rekomendasi();
		$rek_sgprepaid=$result->row()->tis_sgprepaid;
		//$rek_sgprepaid= $this->data_model->get_total_rekomendasi();

		$list_outlet = $this->data_model->get_list_outlet();

		foreach ($list as $field)
		{
			$no++;
			$row = array();

			// inisialisasi pembagian sgprepaid 
			
			if ($field->target_edit_sgprepaid == 0 ){
				$nilai=ceil($rek_sgprepaid/count($list_outlet));
				$field->target_edit_sgprepaid = $nilai;
			}

			//$total_sgprepaid = $total_sgprepaid + $field->target_edit_sgprepaid;
			$row[] = $no;
			$row[] = $field->id_digipos;
			$row[] = $field->nama_outlet;

			$row[] = '<div align="right">
									<input type="hidden" name="id_sgprepaid'.$no.'" id="id_sgprepaid'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right sgprepaid" name="sgprepaid'.$no.'" id="sgprepaid'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_sgprepaid).'" onkeyup="keyup_aksi(sgprepaid'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_sgota'.$no.'" id="id_sgota'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right sgota" name="sgota'.$no.'" id="sgota'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_sgota).'" onkeyup="keyup_aksi(sgota'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_sgvin'.$no.'" id="id_sgvin'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right sgvin" name="sgvin'.$no.'" id="sgvin'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_sgvin).'" onkeyup="keyup_aksi(sgvin'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_sgvgs'.$no.'" id="id_sgvgs'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right sgvgs" name="sgvgs'.$no.'" id="sgvgs'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_sgvgs).'" onkeyup="keyup_aksi(sgvgs'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_sgvgg'.$no.'" id="id_sgvgg'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right sgvgg" name="sgvgg'.$no.'" id="sgvgg'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_sgvgg).'" onkeyup="keyup_aksi(sgvgg'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_sgvgp'.$no.'" id="id_sgvgp'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right sgvgp" name="sgvgp'.$no.'" id="sgvgp'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_sgvgp).'" onkeyup="keyup_aksi(sgvgp'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_insac_ld'.$no.'" id="id_insac_ld'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right insac_ld" name="insac_ld'.$no.'" id="insac_ld'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_insac_ld).'" onkeyup="keyup_aksi(insac_ld'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_insac_md'.$no.'" id="id_insac_md'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right insac_md" name="insac_md'.$no.'" id="insac_md'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_insac_md).'" onkeyup="keyup_aksi(insac_md'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_insac_hd'.$no.'" id="id_insac_hd'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right insac_hd" name="insac_hd'.$no.'" id="insac_hd'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_insac_hd).'" onkeyup="keyup_aksi(insac_hd'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_invin_ld'.$no.'" id="id_invin_ld'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right invin_ld" name="invin_ld'.$no.'" id="invin_ld'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_invin_ld).'" onkeyup="keyup_aksi(invin_ld'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_invin_md'.$no.'" id="id_invin_md'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right invin_md" name="invin_md'.$no.'" id="invin_md'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_invin_md).'" onkeyup="keyup_aksi(invin_md'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_invin_hd'.$no.'" id="id_invin_hd'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right invin_hd" name="invin_hd'.$no.'" id="invin_hd'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_invin_hd).'" onkeyup="keyup_aksi(invin_hd'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_invga_ld'.$no.'" id="id_invga_ld'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right invga_ld" name="invga_ld'.$no.'" id="invga_ld'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_invga_ld).'" onkeyup="keyup_aksi(invga_ld'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_invga_md'.$no.'" id="id_invga_md'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right invga_md" name="invga_md'.$no.'" id="invga_md'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_invga_md).'" onkeyup="keyup_aksi(invga_md'.$no.')">
								</div>';

			$row[] = '<div align="right">
									<input type="hidden" name="id_invga_hd'.$no.'" id="id_invga_hd'.$no.'" value="'.$field->id_rekomendasi.'">

									<input style="width:70px;height:24px;" type="text"class="form-control integer integeronly text-right invga_hd" name="invga_hd'.$no.'" id="invga_hd'.$no.'" autocomplete="off" value="'.format_integer($field->target_edit_invga_hd).'" onkeyup="keyup_aksi(invga_hd'.$no.')">
								</div>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data_model->count_all(),
			"recordsFiltered" => $this->data_model->count_filtered(),
			"data" => $data
		);

		echo json_encode($output);
	}
}
?>