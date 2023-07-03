<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clockin extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }
    
    //pjp clockin
	public function pjp_clockin()
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
	        	    $params['tanggal'] = date('Y-m-d');
	        	    $params['jam_clock_in'] = date('H:i:s');
	        	    if($params['status'] == 'CLOSE')
                    {
                        $params['clockin_distribusi'] = 'DISABLED';
                        $params['clockin_merchandising'] = 'DISABLED';
                        $params['clockin_promotion'] = 'DISABLED';
                        $params['clockin_marketaudit'] = 'DISABLED';
                        $params['clockin_report_mt'] = 'DISABLED';
                    }
                    if($params['status'] == 'OPEN')
                    {
                        $params['clockin_distribusi'] = 'ENABLED';
                        $params['clockin_merchandising'] = 'ENABLED';
                        $params['clockin_promotion'] = 'ENABLED';
                        $params['clockin_marketaudit'] = 'ENABLED';
                        $params['clockin_report_mt'] = 'ENABLED';
                    }  
                    //cek lokasi
                    $id_tempat = '';
                    $query = $this->db->query("SELECT 
                                                    a.id_tempat
                                               FROM 
                                                    fa_pjp a 
                                               INNER JOIN 
                                                    (SELECT * FROM ja_penjualan_tanggal where tanggal = '".date('Y-m-d')."') b 
                                               ON a.id_sales = '".$this->db->escape_str($users_id)."' 
                                                  and a.hari = b.hari and a.id_tempat = '".$params['id_tempat']."' and a.id_jenis_lokasi = '".$params['id_jenis_lokasi']."'");
                    if($query->num_rows() > 0)
                    {
	        		    $resp = $this->ClockinModel->pjp_clockin($params,$users_id);
				        json_output($respStatus,$resp);
                    }else{
                        json_output(400,array('status' => 400,'message' => 'pjp tidak terdaftar'));
                    }
	        	}
			}
		}
	}
	
	//pjp clockin status
	public function pjp_clockin_status()
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
        		    $resp = $this->ClockinModel->pjp_clockin_status($params,$users_id);
			        json_output($respStatus,$resp);
	        	}
			}
		}
	}
	
}