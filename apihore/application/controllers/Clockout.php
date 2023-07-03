<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clockout extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }
    
    //pjp upload foto 
	public function pjp_upload_foto()
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
	        	    $query = $this->db->query("SELECT status
                                               FROM fb_histroy_pjp
                                               WHERE id_history_pjp = '".$this->input->post('id_history_pjp')."'
                                                     AND status = 'CLOSE'");
                    if($query->num_rows() > 0)
                    {
    	        		$resp = $this->ClockoutModel->pjp_upload_foto($users_id);
    				    json_output($response['status'],$resp);
                    }else{
                        json_output(400,array('status' => 400,'message' => 'Upload foto yang untuk pjp yang tutup.'));
                    }
	        	}
			}
		}
	}

    //pjp clockout 
	public function pjp_clockout()
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
	        		$resp = $this->ClockoutModel->pjp_clockout($params, $users_id, $role);
				    json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
}