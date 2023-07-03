<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }

    //login
	public function login()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST')
		{
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true)
			{
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                if($username != '' && $password !='')
                {
                    $response = $this->AuthModel->login($username,$password);
				    json_output($response['status'],$response);
                }else{
                    json_output(400,array('status' => 400,'message' => 'Missing Parameters.'));
                }
			}
		}
	}

    //logout
	public function logout()
	{	
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST')
		{
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->AuthModel->check_auth_client();
			if($check_auth_client == true)
			{
	        	$response = $this->AuthModel->logout();
				json_output($response['status'],$response);
			}
		}
	}
	
}
