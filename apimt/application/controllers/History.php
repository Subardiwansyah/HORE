<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }

    //penilaian_outlet
	public function penilaian_outlet($tglawal,$tglakhir)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true)
			{
			        $users_id  = $this->input->get_request_header('User-ID', TRUE);
                    $role  = $this->input->get_request_header('Id-Level', TRUE);
                    $id_divisi  = $this->input->get_request_header('Id-Divisi', TRUE);
                    $nama  = $this->input->get_request_header('Nama', TRUE);
                    $email = $this->input->get_request_header('Email', TRUE);
                    $token     = $this->input->get_request_header('Auth-session', TRUE);
		        	$response = $this->AuthModel->auth();
		        	if($response['status'] == 200)
		        	{
		        		$resp = $this->HistoryModel->penilaian_outlet($tglawal,$tglakhir, $users_id, $role, $id_divisi);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	
	//penilaian_sf
	public function penilaian_sf($tglawal,$tglakhir)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true)
			{
			        $users_id  = $this->input->get_request_header('User-ID', TRUE);
                    $role  = $this->input->get_request_header('Id-Level', TRUE);
                    $id_divisi  = $this->input->get_request_header('Id-Divisi', TRUE);
                    $nama  = $this->input->get_request_header('Nama', TRUE);
                    $email = $this->input->get_request_header('Email', TRUE);
                    $token     = $this->input->get_request_header('Auth-session', TRUE);
		        	$response = $this->AuthModel->auth();
		        	if($response['status'] == 200)
		        	{
		        		$resp = $this->HistoryModel->penilaian_sf($tglawal,$tglakhir, $users_id, $role, $id_divisi);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	

}
