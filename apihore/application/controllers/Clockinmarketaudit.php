<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clockinmarketaudit extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }

    //marketaudit create belanja
    public function marketaudit_create_belanja()
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
						$resp = array('status' => 400,'message' =>  'Field wajib diisi.');
					} else {
		        		$resp = $this->ClockinmarketauditModel->marketaudit_create_belanja($users_id);
					}
					json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
	//marketaudit create broadband_voucher
    public function marketaudit_create_broadband_voucher()
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
					if ($params['telkomsel_ld'] == "" || $params['telkomsel_md'] == "" || $params['telkomsel_hd'] == "" ) 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  $params['telkomsel_ld']);
					} else {
						$tahun = $bulan = $minggu = 0;
						$query_1 = $this->db->query("SELECT tahun, bulan, minggu
                    		                         FROM ja_penjualan_tanggal
                    		                         WHERE tanggal = '".date('Y-m-d')."'"); 
                        foreach ($query_1->result_array() as $row_1)
                		{
							$tahun = $row_1['tahun'];
							$bulan = $row_1['bulan'];
							$minggu = $row_1['minggu'];
						}
						$params['tgl'] = date('Y-m-d');
						$params['tahun'] = $tahun;
						$params['bulan'] = $bulan;
						$params['minggu'] = $minggu;
						$params['created_by'] = $users_id;
		        		$resp = $this->ClockinmarketauditModel->marketaudit_create_broadband_voucher($params, $users_id);
					}
					json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
	
	
	
	
	//marketaudit create quisioner
    public function marketaudit_create_quisioner()
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
					$tahun = $bulan = $minggu = 0;
					$query_1 = $this->db->query("SELECT tahun, bulan, minggu
                		                         FROM ja_penjualan_tanggal
                		                         WHERE tanggal = '".date('Y-m-d')."'"); 
                    foreach ($query_1->result_array() as $row_1)
            		{
						$tahun = $row_1['tahun'];
						$bulan = $row_1['bulan'];
						$minggu = $row_1['minggu'];
					}
					$params['tgl'] = date('Y-m-d');
					$params['tahun'] = $tahun;
					$params['bulan'] = $bulan;
					$params['minggu'] = $minggu;
					$params['created_by'] = $users_id;
	        		$resp = $this->ClockinmarketauditModel->marketaudit_create_quisioner($params, $users_id);
					json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    
}
