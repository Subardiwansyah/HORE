<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_score_card extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Sf_model', 'sf_model');
	}

	function index()
	{
		$this->sf_model->save_data_sf();
	}
}
?>