<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Combobox extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	//outlet jenis
	public function outlet_jenis()
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
	        		    $resp = $this->ComboboxModel->outlet_jenis($role);
	    				json_output($respStatus,$resp);
		        	}
			}
		}
	}
	
	
	//provinsi
	public function provinsi()
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
	        		    $resp = $this->ComboboxModel->provinsi($id_cluster);
	    				json_output($respStatus,$resp);
		        	}
			}
		}
	}
	
	
	//kabupaten
	public function kabupaten()
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
		        		$resp = $this->ComboboxModel->kabupaten($params,$id_cluster);
					    json_output($respStatus,$resp);
		        	}
			}
		}
	}
	
	
	//kecamatan
	public function kecamatan()
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
		        		$resp = $this->ComboboxModel->kecamatan($params,$id_cluster);
					    json_output($respStatus,$resp);
		        	}
			}
		}
	}
	
	//kelurahan
	public function kelurahan()
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
		        		$resp = $this->ComboboxModel->kelurahan($params,$id_cluster);
					    json_output($respStatus,$resp);
		        	}
			}
		}
	}

    //retur alasan
	public function retur_alasan()
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
                    $nama_sales  = $this->input->get_request_header('Nama-Sales', TRUE);
                    $id_tap  = $this->input->get_request_header('Id-Tap', TRUE);
                    $nama_tap  = $this->input->get_request_header('Nama-Tap', TRUE);
                    $id_cluster  = $this->input->get_request_header('Id-Cluster', TRUE);
                    $nama_cluster  = $this->input->get_request_header('Nama-Cluster', TRUE);
                    $token     = $this->input->get_request_header('Auth-session', TRUE);
		        	$response = $this->AuthModel->auth();
		        	if($response['status'] == 200)
		        	{
		        		$resp = $this->ComboboxModel->retur_alasan();
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	
	//provinsi
	public function select_provinsi($id_kabupaten)
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
                    $nama_sales  = $this->input->get_request_header('Nama-Sales', TRUE);
                    $id_tap  = $this->input->get_request_header('Id-Tap', TRUE);
                    $nama_tap  = $this->input->get_request_header('Nama-Tap', TRUE);
                    $id_cluster  = $this->input->get_request_header('Id-Cluster', TRUE);
                    $nama_cluster  = $this->input->get_request_header('Nama-Cluster', TRUE);
                    $token     = $this->input->get_request_header('Auth-session', TRUE);
		        	$response = $this->AuthModel->auth();
		        	if($response['status'] == 200)
		        	{
	        		    $resp = $this->ComboboxModel->select_provinsi($id_kabupaten);
	    				json_output($response['status'],$resp);
		        	}
			}
		}
	}
	
	
	//kabupaten
	public function select_kabupaten($id_kecamatan)
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
                    $nama_sales  = $this->input->get_request_header('Nama-Sales', TRUE);
                    $id_tap  = $this->input->get_request_header('Id-Tap', TRUE);
                    $nama_tap  = $this->input->get_request_header('Nama-Tap', TRUE);
                    $id_cluster  = $this->input->get_request_header('Id-Cluster', TRUE);
                    $nama_cluster  = $this->input->get_request_header('Nama-Cluster', TRUE);
                    $token     = $this->input->get_request_header('Auth-session', TRUE);
    	        	$response = $this->AuthModel->auth();
		        	if($response['status'] == 200)
		        	{
		        		$resp = $this->ComboboxModel->select_kabupaten($id_kecamatan);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	
	
	//kecamatan
	public function select_kecamatan($id_kelurahan)
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
                    $nama_sales  = $this->input->get_request_header('Nama-Sales', TRUE);
                    $id_tap  = $this->input->get_request_header('Id-Tap', TRUE);
                    $nama_tap  = $this->input->get_request_header('Nama-Tap', TRUE);
                    $id_cluster  = $this->input->get_request_header('Id-Cluster', TRUE);
                    $nama_cluster  = $this->input->get_request_header('Nama-Cluster', TRUE);
                    $token     = $this->input->get_request_header('Auth-session', TRUE);
    	        	$response = $this->AuthModel->auth();
		        	if($response['status'] == 200)
		        	{
		        		$resp = $this->ComboboxModel->select_kecamatan($id_kelurahan);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	
	//universitas
	public function universitas()
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
	        		    $resp = $this->ComboboxModel->universitas($role);
	    				json_output($respStatus,$resp);
		        	}
			}
		}
	}
	
	
	
	//frekuensi paket
	public function frekuensi_paket()
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
	        		    $resp = $this->ComboboxModel->frekuensi_paket($role);
	    				json_output($respStatus,$resp);
		        	}
			}
		}
	}
	
	
	//provider
	public function provider()
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
	        		    $resp = $this->ComboboxModel->provider($role);
	    				json_output($respStatus,$resp);
		        	}
			}
		}
	}
	
	
	
}
