<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang_segel_cluster extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		date_default_timezone_set('Asia/Jakarta');

		$this->modul_name = 'gudang_segel_cluster';
		$this->daftar_display = 'List Gudang Segel';
		$this->form_display = 'Form Gudang Segel';
		$this->modul_display = 'Gudang Segel';
		$this->view_list = 'gudang_segel_cluster_list_view';
		$this->view_form = 'gudang_segel_cluster_form_view';
		$this->view_view = 'gudang_segel_cluster_view_view';
		$this->load->model('Gudang_segel_cluster_model', 'data_model');
	}

	function index()
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_list;

		$data['x_input'] = 1;
		// $data['x_input'] = 0;
		// $x_time = (int) date('H');

		// if (in_array($x_time, array(15, 16, 17, 18, 19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5, 6, 7, 8)))
		// {
			// $data['x_input'] = 1;
		// }

		$this->load->view('partial/template_view', $data);
	}

	function get_daftar()
	{
		$list = $this->data_model->get_datatables();
		$data = array();
		$no = $_POST['start'];

		$fields = $this->data_model->fieldmap_daftar;

		$x_input = 1;
		// $x_input = 0;
		// $x_time = (int) date('H');

		// if (in_array($x_time, array(15, 16, 17, 18, 19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5, 6, 7, 8)))
		// {
			// $x_input = 1;
		// }

		foreach ($list as $field)
		{
			$no++;
			$row = array();
			// $row[] = $no;

			if ($x_input == 1)
			{
				$row[] = '<center>
					<button onClick="pilih(\''.$field->id.'\')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Pilih Produk">
						<i class="fal fa-check-square"></i>
					</button>
				</center>';
			}
			else
			{
				$row[] = ' ';
			}

			$row[] = $field->kode_produk;
			$row[] = $field->nama_produk;
			$row[] = $field->range_sn;
			$row[] = '<div class="text-right">'.format_integer($field->qty).'</div>';

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

	function form($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_form;

		$id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		if ($id !== 0)
		{
			$data['data'] = $this->data_model->get_data_by_id($id);
		}

		$this->load->view('partial/template_view', $data);
	}

	function lihat($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_view;

		$id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

		if ($id !== 0)
		{
			// $data['data'] = $this->data_model->get_data_by_id($id);
		}

		$this->load->view($this->view_view, $data);
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

	protected function extra_message()
  {
    return array(
      'data_valid' => $this->data_model->data_valid,
      'data_invalid' => $this->data_model->data_invalid,
      'row_invalid' => $this->data_model->row_invalid
    );
  }

	/**
	 *  Fungsi	: Pengecekkan serial number apakah valid atau invalid
	 *  Module	: -
	 */
	function proses_validasi_data()
	{
		$response = (object) NULL;

		$success = $this->data_model->save_validasi_data();

		if($success)
		{
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil';
			$response->error = NULL;
			$response->id = $this->data_model->id;
			$response->nomor = $this->data_model->nomor;
			$response->sql = $this->db->queries;

			$extra = $this->extra_message();

			if (is_array($extra))
			{
				foreach($extra as $key => $value)
				{
					$response->{$key} = $value;
				}
			}
		}
		else
		{
			$response->isSuccess = FALSE;
			$response->message = 'Data gagal';
			$response->error = $this->data_model->last_error_message;
			$response->sql = $this->db->queries;
		}

		echo json_encode($response);
	}
}
?>