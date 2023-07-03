<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_setting_pjp extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Cron_setting_pjp_model', 'settingpjp_model');
	}

	function index()
	{
		$this->settingpjp_model->save_data_settingpjp();
	}

	function proses()
	{
		$response = (object) NULL;

		$success = $this->settingpjp_model->save_data_settingpjp();

		if ($success)
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
			$response->error = $this->settingpjp_model->last_error_message;
			$response->sql = $this->db->queries;
		}

		echo json_encode($response);
	}
}
?>