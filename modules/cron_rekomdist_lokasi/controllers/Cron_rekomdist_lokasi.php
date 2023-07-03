<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_rekomdist_lokasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Outlet_model', 'outlet_model');
	}

	function index()
	{
		$this->outlet_model->save_data_outlet();
	}

	function proses()
	{
		$response = (object) NULL;
		
		$res_outlet = $this->outlet_model->save_data_outlet();
		
		if($res_outlet)
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