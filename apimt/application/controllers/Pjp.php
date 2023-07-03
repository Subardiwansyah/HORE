<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pjp extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }
    
    
    //pjp_jumlah
	public function pjp_jumlah($id_sales)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET')
		{
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
	        		$resp = $this->PjpModel->pjp_jumlah($id_sales);
				    json_output($response['status'],$resp);
	        	}
			}
		}
	}
    
    //pjp_daftar
	public function pjp_daftar($id_sales)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET')
		{
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
	        		$resp = $this->PjpModel->pjp_daftar($id_sales);
				    json_output($response['status'],$resp);
	        	}
			}
		}
	}
	
}
