<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_rekomdist_sales extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Sf_model', 'sf_model');
	}

	function index()
	{
		$this->sf_model->save_data_sf();
	}

	function proses()
	{
		$response = (object) NULL;

		$rs_sf = $this->sf_model->save_data_sf();

		if($rs_sf)
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