<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_dashboard_distribusi extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Branch_model', 'branch_model');
		$this->load->model('Cluster_model', 'cluster_model');
		$this->load->model('Tap_model', 'tap_model');
		$this->load->model('Kabupaten_model', 'kabupaten_model');
		$this->load->model('Kecamatan_model', 'kecamatan_model');
	}

	function index()
	{
		$this->branch_model->save_data_branch();
		$this->cluster_model->save_data_cluster();
		$this->tap_model->save_data_tap();
		$this->kabupaten_model->save_data_kabupaten();
		$this->kecamatan_model->save_data_kecamatan();
	}

	function proses()
	{
		$response = (object) NULL;

		$xa = $this->branch_model->save_data_branch();

		if($xa)
		{
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil disimpan';
			$response->error = NULL;
			$response->sql = $this->db->queries;

			$xb = $this->cluster_model->save_data_cluster();

			if($xb)
			{
				$response->isSuccess = TRUE;
				$response->message = 'Data berhasil disimpan';
				$response->error = NULL;
				$response->sql = $this->db->queries;

				$xc = $this->tap_model->save_data_tap();

				if($xc)
				{
					$response->isSuccess = TRUE;
					$response->message = 'Data berhasil disimpan';
					$response->error = NULL;
					$response->sql = $this->db->queries;

					$xd = $this->kabupaten_model->save_data_kabupaten();

					if($xd)
					{
						$response->isSuccess = TRUE;
						$response->message = 'Data berhasil disimpan';
						$response->error = NULL;
						$response->sql = $this->db->queries;

						$xe = $this->kecamatan_model->save_data_kecamatan();

						if($xe)
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