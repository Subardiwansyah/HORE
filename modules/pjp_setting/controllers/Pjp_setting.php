<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pjp_setting extends Base_Controller {

	function __construct()
	{
		parent::__construct($securePage=true);

		$this->modul_name = 'pjp_setting';
		$this->daftar_display = 'List Setting PJP';
		$this->form_display = 'Form Setting PJP';
		$this->modul_display = 'Setting PJP';
		$this->view_list = 'pjp_setting_list_view';
		$this->view_form = 'pjp_setting_form_view';
		$this->view_modal = 'pjp_setting_modal_view';
		$this->load->model('Pjp_setting_model', 'data_model');
	}

	function index()
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;
		$data['main_content'] = $this->view_list;

		$data['list_tgl'] = $this->data_model->get_list_tgl();

		$this->load->view('partial/template_view', $data);
	}

	function get_daftar()
	{
		//
	}

	function form($id=0)
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$data['id_jns_sales'] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		$data['id_sales'] = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		$data['id_pjp'] = $this->uri->segment(5) ? $this->uri->segment(5) : 0;
		$data['hari'] = $this->uri->segment(6) ? $this->uri->segment(6) : NULL;
		$data['tanggal'] = $this->uri->segment(7) ? $this->uri->segment(7) : NULL;
		$data['id_tap'] = $this->uri->segment(8) ? $this->uri->segment(8) : 0;

		$data['data'] = $this->data_model->get_max_no_kunjungan($data['id_sales'], $data['hari']);

		$this->load->view($this->view_form, $data);
	}

	function validasi_form()
	{
		$this->form_validation->set_rules('id_sales', 'Sales', 'required|trim');

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

	function get_list_pjp()
  {
    $result = $this->data_model->get_list_pjp();

		$response = (object) NULL;
    $response->sql = $this->db->queries;
    $response->len = count($result);

    if ($result)
		{
      for($i=0; $i<count($result); $i++)
			{
        $response->rows[$i]['id_jns_lokasi'] = $result[$i]['id_jenis_lokasi'];
        $response->rows[$i]['nm_jns_lokasi'] = $result[$i]['nama_jenis_lokasi'];
        $response->rows[$i]['id_pjp'] = $result[$i]['id_pjp'];
        $response->rows[$i]['no_kunjungan'] = $result[$i]['no_kunjungan'];
        $response->rows[$i]['id_tempat'] = $result[$i]['id_tempat'];
        $response->rows[$i]['nm_tempat'] = $result[$i]['nama_tempat'];
        $response->rows[$i]['is_delete'] = isset($result[$i]['is_delete']) ? $result[$i]['is_delete'] : 0;
        $response->rows[$i]['is_reset'] = isset($result[$i]['is_reset']) ? $result[$i]['is_reset'] : 0;
        $response->rows[$i]['max_no'] = isset($result[$i]['max_no']) ? $result[$i]['max_no'] : 0;
        $response->rows[$i]['kode'] = isset($result[$i]['kode']) ? $result[$i]['kode'] : '-';
      }
    }

		echo json_encode($response);
  }

	function update_nourut()
	{
		$response = (object) NULL;

		$a = $this->data_model->sync_nourut_a();

		if($a)
		{
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil disimpan';
			$response->error = NULL;
			$response->id = $this->data_model->id;
			$response->nomor = $this->data_model->nomor;
			$response->sql = $this->db->queries;

			$b = $this->data_model->sync_nourut_b();

			if($b)
			{
				$response->isSuccess = TRUE;
				$response->message = 'Data berhasil disimpan';
				$response->error = NULL;
				$response->id = $this->data_model->id;
				$response->nomor = $this->data_model->nomor;
				$response->sql = $this->db->queries;

				$sync = $this->data_model->sync_data_daftarpjp();

				if($sync)
				{
					$response->isSuccess = TRUE;
					$response->message = 'Data berhasil disimpan';
					$response->error = NULL;
					$response->id = $this->data_model->id;
					$response->nomor = $this->data_model->nomor;
					$response->sql = $this->db->queries;
				}
				else
				{
					$response->isSuccess = FALSE;
					$response->message = 'Data gagal disimpan';
					$response->error = $this->data_model->last_error_message;
					$response->sql = $this->db->queries;
				}
			}
			else
			{
				$response->isSuccess = FALSE;
				$response->message = 'Data gagal disimpan';
				$response->error = $this->data_model->last_error_message;
				$response->sql = $this->db->queries;
			}
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

	function hapus_pjp()
	{
		$response = (object) NULL;
		$hapus = $this->data_model->delete_data_pjp();

		if ($hapus)
		{
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil dihapus';

			$sync = $this->data_model->sync_data_daftarpjp();
		}
		else
		{
			$response->isSuccess = FALSE;
			$response->message = 'Data gagal dihapus';
			$response->error = $this->data_model->last_error_message;
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}

	function delete_history_pjp()
	{
		$response = (object) NULL;
		$hapus = $this->data_model->delete_data_historypjp();

		if ($hapus)
		{
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil dihapus';
		}
		else
		{
			$response->isSuccess = FALSE;
			$response->message = 'Data gagal dihapus';
			$response->error = $this->data_model->last_error_message;
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}
}
?>