<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clockinmerchandising extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }

    //merchandising create
    public function merchandising_create()
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
                $nama_sales  = $this->input->get_request_header('Nama-Sales', TRUE);
                $id_tap  = $this->input->get_request_header('Id-Tap', TRUE);
                $nama_tap  = $this->input->get_request_header('Nama-Tap', TRUE);
                $id_cluster  = $this->input->get_request_header('Id-Cluster', TRUE);
                $nama_cluster  = $this->input->get_request_header('Nama-Cluster', TRUE);
                $token     = $this->input->get_request_header('Auth-session', TRUE);
	        	$response = $this->AuthModel->auth();
	        	$respStatus = $response['status'];
	        	if($response['status'] == 200)
	        	{
	        	    $params = json_decode(file_get_contents('php://input'), TRUE);
					if ($this->input->post('telkomsel') == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Field telkomsel wajib diisi.');
					} else {
		        		$resp = $this->ClockinmerchandisingModel->merchandising_create($users_id);
					}
					json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    
}
