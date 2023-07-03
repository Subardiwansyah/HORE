<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_model {

	function __construct()
	{
		parent::__construct();
	}

	function check_account($username)
	{
		$result = 3;

		$this->db->select('*');
		$this->db->from('ab_users');
		$this->db->where('username', $username);
		$rs = $this->db->get()->row_array();
		$status = $rs['status'] ? $rs['status'] : NULL;

		if (!empty($rs))
		{
			if ($status == 'AKTIF')
			{
				$result = 1;
			}
			else
			{
				$result = 2;
			}
		}
		else
		{
			$result = 3;
		}

		return $result;
	}

	function check_trans_status($exception)
  {
    if ($this->db->trans_status() === FALSE) {
      throw new Exception($exception);
    }
  }

	function save_data_code()
  {
    $this->db->trans_begin();
    try {
			$this->update_code();
			$this->send_email();
    }
    catch(Exception $e){
      // TODO : log error to file
    }

    if ($this->db->trans_status() === FALSE)
    {
      $this->id = NULL;
			$this->nomor = NULL;
      $this->last_error_message = $this->db->error();
      $this->db->trans_rollback();
      return FALSE;
    }

    $this->db->trans_commit();

    return TRUE;
  }

	function update_code()
  {
		$username = $this->input->post('username') ? $this->input->post('username') : NULL;

		$random = array_merge(range(0, 9), range('A', 'Z'));
		$code = '';

		for($x=0; $x < 5; $x++)
		{
			$code .= $random[mt_rand(0, count($random) - 1)];
		}

		$data_x = array('kode_verifikasi' => $code);

		$this->db->where('username', $username);
		$this->db->update('ab_users', $data_x);
		$this->check_trans_status('update ab_users failed');

		$this->kode = $code;
	}

	function send_email()
  {
		$this->load->helper('form');
		$this->load->library('email');

		$username = $this->input->post('username') ? $this->input->post('username') : NULL;

		$this->db->select('email');
		$this->db->from('ab_users');
		$this->db->where('username', $username);
		$rs = $this->db->get()->row_array();

		$email = $rs['email'] ? $rs['email'] : NULL;
		$kode_verifikasi = $this->kode;

		$config = Array(
			 'protocol' => 'smtp',
			 'smtp_host' => '[SMTP HOST]',
			 'smtp_port' => 587,
			 'smtp_user' => '[USER SMTP]',
			 'smtp_pass' => '[PASSWORD SMPT]',
			 'mailtype' => 'html',
			 'charset' => 'iso-8859-1',
			 'wordwrap' => TRUE
		);

		$this->load->library('email', $config);
		$this->email->from('admin@channelsumbagsel.com', "CARD Sumbagsel");
		$this->email->to($email);
		$this->email->subject('Kode Verifikasi Reset Password Aplikasi Hore');
		$this->email->message('USERNAME : '.$username.'<br>KODE VERIFIKASI : '.$kode_verifikasi.'');
		$this->email->send();

		if($this->email->send())
		{
			$this->check_trans_status('Email berhasil dikirim');
		}
		else
		{
			$this->check_trans_status('Email gagal dikirim');
		}
	}

	function check_code()
	{
		$username = $this->input->post('username') ? $this->input->post('username') : NULL;
		$kode = $this->input->post('kode') ? $this->input->post('kode') : NULL;

		$result = 1;

		$this->db->select('*');
		$this->db->from('ab_users');
		$this->db->where('username', $username);
		$this->db->where('kode_verifikasi', $kode);
		$rs = $this->db->get()->row_array();

		if (!empty($rs))
		{
			$result = 1;
		}
		else
		{
			$result = 2;
		}

		return $result;
	}

	function save_data_reset()
  {
    $this->db->trans_begin();
    try {
			$this->update_user();
    }
    catch(Exception $e){
      // TODO : log error to file
    }

    if ($this->db->trans_status() === FALSE)
    {
      $this->id = NULL;
			$this->nomor = NULL;
      $this->last_error_message = $this->db->error();
      $this->db->trans_rollback();
      return FALSE;
    }

    $this->db->trans_commit();

    return TRUE;
  }

	function update_user()
  {
		$username = $this->input->post('username') ? $this->input->post('username') : NULL;
		$kode = $this->input->post('kode') ? $this->input->post('kode') : NULL;
		$pass = $this->input->post('pass') ? $this->input->post('pass') : NULL;

		$this->kode = $kode;

		$data_x = array(
			'password' => sha1(md5($pass)),
			'pin' => $pass,
			// 'kode_verifikasi' => NULL
		);

		$this->db->where('username', $username);
		$this->db->where('kode_verifikasi', $kode);
		$this->db->update('ab_users', $data_x);
		$this->check_trans_status('update ab_users failed');
	}

	function get_data_user()
  {
		$username = $this->input->post('username') ? $this->input->post('username') : NULL;

		$this->db->select('
			u.id_level
			, l.level AS nama_level
			, u.id_divisi
			, CASE u.id_level
						WHEN 1 THEN (SELECT a.nama_regional FROM ba_regional a WHERE (a.id_regional = u.id_divisi))
						WHEN 2 THEN (SELECT a.nama_branch FROM bb_branch a WHERE (a.id_branch = u.id_divisi))
						WHEN 3 THEN (SELECT a.nama_cluster FROM bc_cluster a WHERE (a.id_cluster = u.id_divisi))
						WHEN 4 THEN (SELECT a.nama_tap FROM bd_tap a WHERE (a.id_tap = u.id_divisi))
						ELSE NULL
				END AS nama_divisi
			, u.username
			, u.password
			, u.pin
			, u.email
			, u.kode_verifikasi
			, u.status
			, u.lastmodified
		');
		$this->db->from('ab_users u');
		$this->db->join('aa_users_level l', 'u.id_level = l.id_level');
		$this->db->where('u.username', $username);

    $result = $this->db->get();

    return $result->row_array();
  }
}
?>