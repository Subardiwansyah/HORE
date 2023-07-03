<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voiceofreseller extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }
    
    
    //Voiceofreseller
	public function voiceof($id_outlet)
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
	        		$resp = $this->VoiceofresellerModel->voiceof($id_outlet);
				    json_output($response['status'],$resp);
	        	}
			}
		}
	}
	
	
	//Kirim
	public function kirim_voiceof()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST')
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
	        	$respStatus = $response['status'];
	        	if($response['status'] == 200)
	        	{
	        	    $params = json_decode(file_get_contents('php://input'), TRUE);
                    $params['tanggal'] = date('Y-m-d');
                    $resp = $this->VoiceofresellerModel->kirim_voiceof($params, $users_id, $role, $id_divisi);
	        	    json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
}
