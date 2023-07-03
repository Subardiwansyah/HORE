<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Controller extends CI_Controller {
  var $data_model;
  var $modul_name;
  var $modul_display;
  var $view_daftar;
  var $view_form;

  function __construct()
  {
    parent::__construct();

		$is_login = $this->session->userdata('logged_in') ? $this->session->userdata('logged_in') : 0;

		if ($is_login == 0)
		{
			redirect ('login');
		}
  }

	function index()
	{
		$this->daftar();
	}

	protected function get_data_fields()
	{
		// di override di modul
	}

	protected function daftar()
	{
		// di override di modul
	}

	function form($id=0)
	{
		// di override di modul
	}

	protected function validasi_form()
	{
		return TRUE;
	}

	protected function extra_message()
  {
    return array();
  }

	function proses()
	{
		$response = (object) NULL;
		$akses = 3;

		if($akses == '3')
		{
			$this->load->library('form_validation');

			$this->validasi_form();

			if($this->form_validation->run() == TRUE)
			{
				$exist = $this->data_model->cek_exist();

				if($exist > 0)
				{
					$this->data_model->fill_data();
					$success = $this->data_model->save_data();

					if($success)
					{
						$response->isSuccess = TRUE;
						$response->message = 'Data berhasil disimpan';
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
						$response->message = 'Data gagal disimpan';
						$response->error = $this->data_model->last_error_message;
						$response->sql = $this->db->queries;
					}
				}
				else
				{
					$response->isSuccess = FALSE;
					$response->message = 'Data sudah dihapus user lain';
					$response->error = 'Hapus';
					$response->id = $this->input->post('id');
					$response->sql = $this->db->queries;
				}
			}
			else
			{
				$response->isSuccess = FALSE;
				$response->sql = $this->db->queries;
				$response->message = validation_errors();
			}
		}
		else
		{
			$response->isSuccess = FALSE;
			$response->message = 'Proses gagal, anda tidak memiliki hak akses';
		}

		echo json_encode($response);
	}

	function hapus()
	{
		$response = (object) NULL;
		$akses = 3;

		if($akses !== 3)
		{
			$response->isSuccess = FALSE;
			$response->message = 'Proses gagal, anda tidak memiliki hak akses';
			echo json_encode($response);
			return;
		}

		$id = $this->input->post('id') ? $this->input->post('id') : NULL;

		$exist = $this->data_model->cek_exist();

		if($exist > 0)
		{
			$result = $this->data_model->check_dependency($id);

			if($result)
			{
				$hapus = $this->data_model->delete_data($id);

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
			}
			else
			{
				$response->isSuccess = FALSE;
				$response->message = 'Data tidak bisa dihapus karena sudah digunakan ditransaksi lain';
			}
		}
		else
		{
			$response->isSuccess = FALSE;
			$response->message = 'Data sudah dihapus user lain';
			$response->error = 'Exist';
			$response->sql = $this->db->queries;
		}

		$response->sql = $this->db->queries;

		echo json_encode($response);
	}
}
?>
