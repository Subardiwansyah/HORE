<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }
    
    //select tracking
	public function select_tracking()
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
	        	    $params['id_sales'] = $users_id;
        		    $resp = $this->TrackingModel->select_tracking($params,$users_id);
			        json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
    //tracking pjp
	public function tracking_pjp()
	{
		$method = $_SERVER['REQUEST_METHOD'];
	    if($method != 'POST')
		{
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
        	$respStatus = '200';
    	    $params = json_decode(file_get_contents('php://input'), TRUE);
    	    $params['tanggal'] = date('Y-m-d');
    	    $params['jam'] = date('H:i:s');
		    $resp = $this->TrackingModel->tracking_pjp($params);
	        json_output($respStatus,$resp);
		}
	}
	
}