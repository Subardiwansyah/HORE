<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->modul_name = 'auth';
		$this->daftar_display = 'List Authentication';
		$this->form_display = 'Form Authentication';
		$this->modul_display = 'Authentication';
		$this->load->model('Auth_model', 'data_model');
	}

	function reset_pass()
	{
		$data['breadcrumb_daftar'] = $this->daftar_display;
		$data['breadcrumb_form'] = $this->form_display;
		$data['modul'] = $this->modul_name;
		$data['modul_display'] = $this->modul_display;

		$this->load->view('reset_pass_view', $data);
	}

	function check_account()
	{
		$username = $this->input->post('username') ? $this->input->post('username') : NULL;
		$check = $this->data_model->check_account($username);

		if ($check == 1)
		{
			echo json_encode(array('status'=>'success', 'content'=> 'Akun ditemukan'));
		}
		else if ($check == 2)
		{
			echo json_encode(array('status'=>'failed', 'content'=> 'Akun sudah tidak aktif'));
		}
		else
		{
			echo json_encode(array('status'=>'failed', 'content'=> 'Username yang Anda Masukkan tidak terdaftar'));
		}
	}

	function process_code()
	{
		$response = (object) NULL;

		$success = $this->data_model->save_data_code();

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

	function check_code()
	{
		$check = $this->data_model->check_code();

		if ($check == 1)
		{
			echo json_encode(array('status'=>'success', 'content'=> 'Kode ditemukan'));
		}
		else if ($check == 2)
		{
			echo json_encode(array('status'=>'failed', 'content'=> 'Kode verifikasi tidak terdaftar'));
		}
	}

	function process_reset()
	{
		$response = (object) NULL;

		$success = $this->data_model->save_data_reset();

		if($success)
		{
			// Create session
			$data_user = $this->data_model->get_data_user();

			$id_level = isset($data_user['id_level']) ? $data_user['id_level'] : 0;
			$nm_level = isset($data_user['nama_level']) ? $data_user['nama_level'] : NULL;
			$id_divisi = isset($data_user['id_divisi']) ? $data_user['id_divisi'] : 0;
			$nm_divisi = isset($data_user['nama_divisi']) ? $data_user['nama_divisi'] : NULL;
			$id_user = isset($data_user['username']) ? $data_user['username'] : NULL;
			$nm_user = isset($data_user['username']) ? $data_user['username'] : NULL;
			$id_divisi = isset($data_user['id_divisi']) ? $data_user['id_divisi'] : NULL;

			$data_session = array(
				'logged_in' => TRUE,
				'ID_LEVEL' => $id_level,
				'NAMA_LEVEL' => $nm_level,
				'ID_DIVISI' => $id_divisi,
				'NAMA_DIVISI' => $nm_divisi,
				'ID_USER' => $id_user,
				'NAMA_USER'  => $nm_user
			);

			$this->session->set_userdata($data_session);

			$response->id_level = $id_level;
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil disimpan';
			$response->error = NULL;
			$response->sql = $this->db->queries;
		}
		else
		{
			$response->id_level = $id_level;
			$response->isSuccess = FALSE;
			$response->message = 'Data gagal disimpan';
			$response->error = $this->data_model->last_error_message;
			$response->sql = $this->db->queries;
		}

		echo json_encode($response);
	}
}
?>