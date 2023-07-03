<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bottommenumarketaudit extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }

    //marketaudit list
	public function marketaudit_list($tglawal,$tglakhir,$page)
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
                    $nama_sales  = $this->input->get_request_header('Nama-Sales', TRUE);
                    $id_tap  = $this->input->get_request_header('Id-Tap', TRUE);
                    $nama_tap  = $this->input->get_request_header('Nama-Tap', TRUE);
                    $id_cluster  = $this->input->get_request_header('Id-Cluster', TRUE);
                    $nama_cluster  = $this->input->get_request_header('Nama-Cluster', TRUE);
                    $token     = $this->input->get_request_header('Auth-session', TRUE);
		        	$response = $this->AuthModel->auth();
		        	if($response['status'] == 200)
		        	{
		        		$resp = $this->BottommenumarketauditModel->marketaudit_list($tglawal,$tglakhir,$page,$users_id, $role);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	
	//marketaudit list cari
	public function marketaudit_list_cari()
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
		        	if($response['status'] == 200)
		        	{
		        	    $params = json_decode(file_get_contents('php://input'), TRUE);
		        		$resp = $this->BottommenumarketauditModel->marketaudit_list_cari($params,$users_id, $role);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	
	//marketaudit detail
    public function marketaudit_detail($id_jenis_share,$id,$tgl)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
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
		        		$resp = $this->BottommenumarketauditModel->marketaudit_detail($id_jenis_share,$id,$tgl, $users_id, $role);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	
	//marketaudit detail quisioner
    public function marketaudit_detail_quisioner($id_jenis_lokasi,$id,$tgl)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
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
		        		$resp = $this->BottommenumarketauditModel->marketaudit_detail_quisioner($id_jenis_lokasi,$id,$tgl, $users_id, $role);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	

}
