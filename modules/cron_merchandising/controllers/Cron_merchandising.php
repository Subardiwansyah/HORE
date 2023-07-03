<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_merchandising extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Regional_model', 'regional_model');
		$this->load->model('Branch_model', 'branch_model');
		$this->load->model('Cluster_model', 'cluster_model');
		$this->load->model('Tap_model', 'tap_model');
		$this->load->model('Sales_model', 'sales_model');
		$this->load->model('Kabupaten_model', 'kabupaten_model');
		$this->load->model('Kecamatan_model', 'kecamatan_model');
	}

	function index()
	{
		$this->regional_model->save_data_regional();
		$this->branch_model->save_data_branch();
		$this->cluster_model->save_data_cluster();
		$this->tap_model->save_data_tap();
		$this->sales_model->save_data_sales();
		$this->kabupaten_model->save_data_kabupaten();
		$this->kecamatan_model->save_data_kecamatan();
	}

	function proses()
	{
		$response = (object) NULL;

		$success_regional = $this->regional_model->save_data_regional();

		if($success_regional)
		{
			$response->isSuccess = TRUE;
			$response->message = 'Data berhasil disimpan';
			$response->error = NULL;
			$response->sql = $this->db->queries;

			$success_branch = $this->branch_model->save_data_branch();

			if($success_branch)
			{
				$response->isSuccess = TRUE;
				$response->message = 'Data berhasil disimpan';
				$response->error = NULL;
				$response->sql = $this->db->queries;

				$success_cluster = $this->cluster_model->save_data_cluster();

				if($success_cluster)
				{
					$response->isSuccess = TRUE;
					$response->message = 'Data berhasil disimpan';
					$response->error = NULL;
					$response->sql = $this->db->queries;

					$success_tap = $this->tap_model->save_data_tap();

					if($success_tap)
					{
						$response->isSuccess = TRUE;
						$response->message = 'Data berhasil disimpan';
						$response->error = NULL;
						$response->sql = $this->db->queries;

						$success_kabupaten = $this->kabupaten_model->save_data_kabupaten();

						if($success_kabupaten)
						{
							$response->isSuccess = TRUE;
							$response->message = 'Data berhasil disimpan';
							$response->error = NULL;
							$response->sql = $this->db->queries;

							$success_kecamatan = $this->kecamatan_model->save_data_kecamatan();

							if($success_kecamatan)
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