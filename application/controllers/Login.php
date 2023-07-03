<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Login_model');
	}

	function index()
	{
		$is_login = $this->session->userdata('logged_in') ? $this->session->userdata('logged_in') : 0;

		if($is_login == 0)
		{
			$this->load->view('login_view');
		}
		else
		{
			redirect('');
		}
	}

	function do_login()
	{
		date_default_timezone_set('Asia/Jakarta');

		$username = $this->input->post('t_username') ? $this->input->post('t_username') : '';
		$password = $this->input->post('t_password') ? $this->input->post('t_password') : '';

		if ($username == '')
		{
			redirect ('login');
		}
		else if ($password == '')
		{
			redirect ('login');
		}
		else
		{
			$do_login = $this->Login_model->do_login($username, $password);

			if ($do_login == 1)
			{
				$data_user = $this->Login_model->get_data_user($username);

				$id_level = isset($data_user['id_level']) ? $data_user['id_level'] : 0;
				$nm_level = isset($data_user['nama_level']) ? $data_user['nama_level'] : NULL;
				$id_divisi = isset($data_user['id_divisi']) ? $data_user['id_divisi'] : 0;
				$nm_divisi = isset($data_user['nama_divisi']) ? $data_user['nama_divisi'] : NULL;
				$id_user = isset($data_user['username']) ? $data_user['username'] : NULL;
				$nm_user = isset($data_user['username']) ? $data_user['username'] : NULL;
				$id_divisi = isset($data_user['id_divisi']) ? $data_user['id_divisi'] : NULL;
				$level_tap = isset($data_user['level_tap']) ? $data_user['level_tap'] : NULL;

				$data_session = array(
					'logged_in' => 1,
					'ID_LEVEL' => $id_level,
					'NAMA_LEVEL' => $nm_level,
					'ID_DIVISI' => $id_divisi,
					'NAMA_DIVISI' => $nm_divisi,
					'ID_USER' => $id_user,
					'NAMA_USER'  => $nm_user,
					'LEVEL_TAP'  => $level_tap
				);

				$this->session->set_userdata($data_session);

				echo json_encode(array('status'=>'success', 'content'=> 'Login berhasil', 'id_level'=>$id_level));
			}
			else if ($do_login == 2)
			{
				echo json_encode(array('status'=>'failed', 'content'=> 'Akun sudah tidak aktif', 'id_level'=>0));
			}
			else
			{
				echo json_encode(array('status'=>'failed', 'content'=> 'Username atau password salah', 'id_level'=>0));
			}
		}
	}

	function do_logout()
	{
		$this->session->set_userdata('logged_in', 0);
		$this->session->sess_destroy();
		redirect(base_url());
	}
}