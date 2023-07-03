<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Combobox extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
	
	//cluster
	public function cluster()
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
		        	$respStatus = $response['status'];
		        	if($response['status'] == 200)
		        	{
	        		    $resp = $this->ComboboxModel->cluster($role,$users_id,$id_divisi);
	    				json_output($respStatus,$resp);
		        	}
			}
		}
	}
	
	
	//tap
	public function tap()
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
	        		$resp = $this->ComboboxModel->tap($params);
				    json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
	
	//sales
	public function sales()
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
	        		$resp = $this->ComboboxModel->sales($params);
				    json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
	//outlet
	public function outlet()
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
	        		$resp = $this->ComboboxModel->outlet($params);
				    json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
	
	//select cluster
	public function select_cluster($id_tap)
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
        		    $resp = $this->ComboboxModel->select_cluster($id_tap);
    				json_output($response['status'],$resp);
	        	}
			}
		}
	}
	
	
	//tap
	public function select_tap($id_sales)
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
	        		$resp = $this->ComboboxModel->select_tap($id_sales);
				    json_output($response['status'],$resp);
	        	}
			}
		}
	}
	
	//sales
	public function select_sales($id_sales)
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
	        		$resp = $this->ComboboxModel->select_sales($id_sales);
				    json_output($response['status'],$resp);
	        	}
			}
		}
	}
	
	//outlet
	public function select_outlet($id_sales)
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
	        		$resp = $this->ComboboxModel->select_outlet($id_sales);
				    json_output($response['status'],$resp);
	        	}
			}
		}
	}
	
	
	//cari_outlet
	public function cari_outlet()
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
	        	    if ($params['cari'] == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Anda belum memasukkan kata kunci.');
					} else {
        		        $resp = $this->ComboboxModel->cari_outlet($params,$users_id,$role,$id_divisi);
					}
    				json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
}
