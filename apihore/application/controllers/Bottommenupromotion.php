<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bottommenupromotion extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }

    //promotion list
	public function promotion_list($tglawal,$tglakhir,$page)
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
		        		$resp = $this->BottommenupromotionModel->promotion_list($tglawal,$tglakhir,$page,$users_id,$role);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	
	//promotion list cari
	public function promotion_list_cari()
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
		        		$resp = $this->BottommenupromotionModel->promotion_list_cari($params,$users_id,$role);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	
	//promotion detail
    public function promotion_detail($id, $id_jenis_lokasi, $tgl)
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
		        		$resp = $this->BottommenupromotionModel->promotion_detail($id, $id_jenis_lokasi, $tgl, $users_id, $role);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
	

}
