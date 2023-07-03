<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {
    
    public function __contruct()
    {
         parent::__construct();
         $this->load->helper('json_output_helper');
    }
    
    //outlet create
    public function outlet_create()
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
        		    $params['id_tap'] = $id_tap;
                    $params['created_by'] = $users_id;
                    $params['status'] = "WAITING APPROVAL";
                    $params['tgl_waiting'] = date('Y-m-d');
					if ($params['id_kelurahan'] == "" || $params['id_jenis_outlet'] == "" || $params['nama_outlet'] == "" || $params['alamat_outlet'] == "" || $params['longitude'] == "" || $params['latitude'] == "" || $params['no_rs'] == ""  || $params['nama_owner'] == "" || $params['no_hp_owner'] == "" || $params['tgl_lahir_owner'] == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Field wajib diisi.');
					} else {
					    //cek kelurahan dan tap dalam 1 cluster
					    $id_cluster_klh = '';
                		$query_1 = $this->db->query("SELECT cc.id_cluster
                    		                         FROM cc_kecamatan cc, cd_kelurahan cd
                    		                         WHERE cc.id_kecamatan = cd.id_kecamatan
                    		                               AND cd.id_kelurahan = '".$params['id_kelurahan']."'"); 
                        foreach ($query_1->result_array() as $row_1)
                		{
                		    $id_cluster_klh = $row_1['id_cluster'];
                		}
                		if($id_cluster_klh != $id_cluster)
                		{
                		    $respStatus = 400;
					    	$resp = array('status' => 400,'message' =>  'Kelurahan tidak terdaftar di cluster sales.');
                		}else{
		        			$resp = $this->LokasiModel->outlet_create($params, $users_id, $role);
                		}
					}
					json_output($respStatus,$resp);
	        	}
			}
		}
	}
    
    //outlet update
    public function outlet_update($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE)
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
					if ($params['id_kelurahan'] == "" || $params['id_jenis_outlet'] == "" || $params['nama_outlet'] == "" || $params['alamat_outlet'] == "" || $params['longitude'] == "" || $params['latitude'] == "" || $params['no_rs'] == ""  || $params['nama_owner'] == "" || $params['no_hp_owner'] == "" || $params['tgl_lahir_owner'] == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Field wajib diisi.');
					} else {
					    //cek kelurahan dan tap dalam 1 cluster
					    $id_cluster_klh = '';
                		$query_1 = $this->db->query("SELECT cc.id_cluster
                    		                         FROM cc_kecamatan cc, cd_kelurahan cd
                    		                         WHERE cc.id_kecamatan = cd.id_kecamatan
                    		                               AND cd.id_kelurahan = '".$params['id_kelurahan']."'"); 
                        foreach ($query_1->result_array() as $row_1)
                		{
                		    $id_cluster_klh = $row_1['id_cluster'];
                		}
                		if($id_cluster_klh != $id_cluster)
                		{
                		    $respStatus = 400;
					    	$resp = array('status' => 400,'message' =>  'Kelurahan tidak terdaftar di cluster sales.');
                		}else{
	        			    $resp = $this->LokasiModel->outlet_update($id, $params, $users_id, $role);
	        			    $query_2 = $this->db->query("UPDATE fe_daftar_pjp
	        			                                 SET longitude = '".$params['longitude']."', latitude = '".$params['latitude']."'
                    		                             WHERE tanggal = '".date('Y-m-d')."'
                    		                                   AND id_tempat = '".$id."'
                    		                                   AND id_jenis_lokasi = 'OUT'
                    		                                   AND id_sales = '".$users_id."'"); 
                		}
					}
					json_output($respStatus,$resp);
	       		}
			}
		}
	}
    
    //sekolah create
    public function sekolah_create()
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
        		    $params['id_tap'] = $id_tap;
                    $params['created_by'] = $users_id;
                    $params['status'] = "WAITING APPROVAL";
                    $params['tgl_waiting'] = date('Y-m-d');
					if ($params['id_kelurahan'] == "" || $params['no_npsn'] == "" || $params['nama_sekolah'] == "" || $params['alamat_sekolah'] == "" || $params['longitude'] == "" || $params['latitude'] == "" || $params['jenjang'] == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Field wajib diisi.');
					} else {
					    //cek kelurahan dan tap dalam 1 cluster
					    $id_cluster_klh = '';
                		$query_1 = $this->db->query("SELECT cc.id_cluster
                    		                         FROM cc_kecamatan cc, cd_kelurahan cd
                    		                         WHERE cc.id_kecamatan = cd.id_kecamatan
                    		                               AND cd.id_kelurahan = '".$params['id_kelurahan']."'"); 
                        foreach ($query_1->result_array() as $row_1)
                		{
                		    $id_cluster_klh = $row_1['id_cluster'];
                		}
                		if($id_cluster_klh != $id_cluster)
                		{
                		    $respStatus = 400;
					    	$resp = array('status' => 400,'message' =>  'Kelurahan tidak terdaftar di cluster sales.');
                		}else{
		        			$resp = $this->LokasiModel->sekolah_create($params, $users_id, $role);
                		}
					}
					json_output($respStatus,$resp);
	        	}
			}
		}
	}
    
    //sekolah update
    public function sekolah_update($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE)
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
					if ($params['id_kelurahan'] == "" || $params['no_npsn'] == "" || $params['nama_sekolah'] == "" || $params['alamat_sekolah'] == "" || $params['longitude'] == "" || $params['latitude'] == "" || $params['jenjang'] == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Field wajib diisi.');
					} else {
					    //cek kelurahan dan tap dalam 1 cluster
					    $id_cluster_klh = '';
                		$query_1 = $this->db->query("SELECT cc.id_cluster
                    		                         FROM cc_kecamatan cc, cd_kelurahan cd
                    		                         WHERE cc.id_kecamatan = cd.id_kecamatan
                    		                               AND cd.id_kelurahan = '".$params['id_kelurahan']."'"); 
                        foreach ($query_1->result_array() as $row_1)
                		{
                		    $id_cluster_klh = $row_1['id_cluster'];
                		}
                		if($id_cluster_klh != $id_cluster)
                		{
                		    $respStatus = 400;
					    	$resp = array('status' => 400,'message' =>  'Kelurahan tidak terdaftar di cluster sales.');
                		}else{
	        			    $resp = $this->LokasiModel->sekolah_update($id, $params, $users_id, $role);
	        			    $query_2 = $this->db->query("UPDATE fe_daftar_pjp
	        			                                 SET longitude = '".$params['longitude']."', latitude = '".$params['latitude']."'
                    		                             WHERE tanggal = '".date('Y-m-d')."'
                    		                                   AND id_tempat = '".$id."'
                    		                                   AND id_jenis_lokasi = 'SEK'
                    		                                   AND id_sales = '".$users_id."'"); 
                		}
					}
					json_output($respStatus,$resp);
	       		}
			}
		}
	}
    
    //kampus create
    public function kampus_create()
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
        		    $params['id_tap'] = $id_tap;
                    $params['created_by'] = $users_id;
                    $params['status'] = "WAITING APPROVAL";
                    $params['tgl_waiting'] = date('Y-m-d');
					if ($params['id_kelurahan'] == "" || $params['no_npsn'] == "" || $params['nama_universitas'] == "" || $params['alamat_universitas'] == "" || $params['longitude'] == "" || $params['latitude'] == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Field wajib diisi.');
					} else {
					    //cek kelurahan dan tap dalam 1 cluster
					    $id_cluster_klh = '';
                		$query_1 = $this->db->query("SELECT cc.id_cluster
                    		                         FROM cc_kecamatan cc, cd_kelurahan cd
                    		                         WHERE cc.id_kecamatan = cd.id_kecamatan
                    		                               AND cd.id_kelurahan = '".$params['id_kelurahan']."'"); 
                        foreach ($query_1->result_array() as $row_1)
                		{
                		    $id_cluster_klh = $row_1['id_cluster'];
                		}
                		if($id_cluster_klh != $id_cluster)
                		{
                		    $respStatus = 400;
					    	$resp = array('status' => 400,'message' =>  'Kelurahan tidak terdaftar di cluster sales.');
                		}else{
		        			$resp = $this->LokasiModel->kampus_create($params, $users_id, $role);
                		}
					}
					json_output($respStatus,$resp);
	        	}
			}
		}
	}
    
    //kampus update
    public function kampus_update($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE)
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
					if ($params['id_kelurahan'] == "" || $params['no_npsn'] == "" || $params['nama_universitas'] == "" || $params['alamat_universitas'] == "" || $params['longitude'] == "" || $params['latitude'] == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Field wajib diisi.');
					} else {
					    //cek kelurahan dan tap dalam 1 cluster
					    $id_cluster_klh = '';
                		$query_1 = $this->db->query("SELECT cc.id_cluster
                    		                         FROM cc_kecamatan cc, cd_kelurahan cd
                    		                         WHERE cc.id_kecamatan = cd.id_kecamatan
                    		                               AND cd.id_kelurahan = '".$params['id_kelurahan']."'"); 
                        foreach ($query_1->result_array() as $row_1)
                		{
                		    $id_cluster_klh = $row_1['id_cluster'];
                		}
                		if($id_cluster_klh != $id_cluster)
                		{
                		    $respStatus = 400;
					    	$resp = array('status' => 400,'message' =>  'Kelurahan tidak terdaftar di cluster sales.');
                		}else{
	        			    $resp = $this->LokasiModel->kampus_update($id, $params, $users_id, $role);
	        			    $query_2 = $this->db->query("UPDATE fe_daftar_pjp
	        			                                 SET longitude = '".$params['longitude']."', latitude = '".$params['latitude']."'
                    		                             WHERE tanggal = '".date('Y-m-d')."'
                    		                                   AND id_tempat = '".$id."'
                    		                                   AND id_jenis_lokasi = 'KAM'
                    		                                   AND id_sales = '".$users_id."'"); 
                		}
					}
					json_output($respStatus,$resp);
	       		}
			}
		}
	}
	
	//fakultas create
    public function fakultas_create()
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
        		    $params['id_tap'] = $id_tap;
                    $params['created_by'] = $users_id;
                    $params['status'] = "WAITING APPROVAL";
                    $params['tgl_waiting'] = date('Y-m-d');
					if ($params['id_kelurahan'] == "" || $params['id_universitas'] == "" || $params['nama_fakultas'] == "" || $params['alamat_fakultas'] == "" || $params['longitude'] == "" || $params['latitude'] == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Field wajib diisi.');
					} else {
					    //cek kelurahan dan tap dalam 1 cluster
					    $id_cluster_klh = '';
                		$query_1 = $this->db->query("SELECT cc.id_cluster
                    		                         FROM cc_kecamatan cc, cd_kelurahan cd
                    		                         WHERE cc.id_kecamatan = cd.id_kecamatan
                    		                               AND cd.id_kelurahan = '".$params['id_kelurahan']."'"); 
                        foreach ($query_1->result_array() as $row_1)
                		{
                		    $id_cluster_klh = $row_1['id_cluster'];
                		}
                		if($id_cluster_klh != $id_cluster)
                		{
                		    $respStatus = 400;
					    	$resp = array('status' => 400,'message' =>  'Kelurahan tidak terdaftar di cluster sales.');
                		}else{
		        			$resp = $this->LokasiModel->fakultas_create($params, $users_id, $role);
                		}
					}
					json_output($respStatus,$resp);
	        	}
			}
		}
	}
    
    //fakultas update
    public function fakultas_update($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE)
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
					if ($params['id_kelurahan'] == "" || $params['id_universitas'] == "" || $params['nama_fakultas'] == "" || $params['alamat_fakultas'] == "" || $params['longitude'] == "" || $params['latitude'] == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Field wajib diisi.');
					} else {
					    //cek kelurahan dan tap dalam 1 cluster
					    $id_cluster_klh = '';
                		$query_1 = $this->db->query("SELECT cc.id_cluster
                    		                         FROM cc_kecamatan cc, cd_kelurahan cd
                    		                         WHERE cc.id_kecamatan = cd.id_kecamatan
                    		                               AND cd.id_kelurahan = '".$params['id_kelurahan']."'"); 
                        foreach ($query_1->result_array() as $row_1)
                		{
                		    $id_cluster_klh = $row_1['id_cluster'];
                		}
                		if($id_cluster_klh != $id_cluster)
                		{
                		    $respStatus = 400;
					    	$resp = array('status' => 400,'message' =>  'Kelurahan tidak terdaftar di cluster sales.');
                		}else{
	        			    $resp = $this->LokasiModel->fakultas_update($id, $params, $users_id, $role);
	        			    $query_2 = $this->db->query("UPDATE fe_daftar_pjp
	        			                                 SET longitude = '".$params['longitude']."', latitude = '".$params['latitude']."'
                    		                             WHERE tanggal = '".date('Y-m-d')."'
                    		                                   AND id_tempat = '".$id."'
                    		                                   AND id_jenis_lokasi = 'FAK'
                    		                                   AND id_sales = '".$users_id."'"); 
                		}
					}
					json_output($respStatus,$resp);
	       		}
			}
		}
	}
    
    //poi create
    public function poi_create()
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
        		    $params['id_tap'] = $id_tap;
                    $params['created_by'] = $users_id;
                    $params['status'] = "WAITING APPROVAL";
                    $params['tgl_waiting'] = date('Y-m-d');
					if ($params['id_kelurahan'] == "" || $params['nama_poi'] == "" || $params['alamat_poi'] == "" || $params['longitude'] == "" || $params['latitude'] == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Field wajib diisi.');
					} else {
					    //cek kelurahan dan tap dalam 1 cluster
					    $id_cluster_klh = '';
                		$query_1 = $this->db->query("SELECT cc.id_cluster
                    		                         FROM cc_kecamatan cc, cd_kelurahan cd
                    		                         WHERE cc.id_kecamatan = cd.id_kecamatan
                    		                               AND cd.id_kelurahan = '".$params['id_kelurahan']."'"); 
                        foreach ($query_1->result_array() as $row_1)
                		{
                		    $id_cluster_klh = $row_1['id_cluster'];
                		}
                		if($id_cluster_klh != $id_cluster)
                		{
                		    $respStatus = 400;
					    	$resp = array('status' => 400,'message' =>  'Kelurahan tidak terdaftar di cluster sales.');
                		}else{
		        			$resp = $this->LokasiModel->poi_create($params, $users_id, $role);
                		}
					}
					json_output($respStatus,$resp);
	        	}
			}
		}
	}
    
    //poi update
    public function poi_update($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE)
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
				    if ($params['id_kelurahan'] == "" || $params['nama_poi'] == "" || $params['alamat_poi'] == "" || $params['longitude'] == "" || $params['latitude'] == "") 
					{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'Field wajib diisi.');
					} else {
					    //cek kelurahan dan tap dalam 1 cluster
					    $id_cluster_klh = '';
                		$query_1 = $this->db->query("SELECT cc.id_cluster
                    		                         FROM cc_kecamatan cc, cd_kelurahan cd
                    		                         WHERE cc.id_kecamatan = cd.id_kecamatan
                    		                               AND cd.id_kelurahan = '".$params['id_kelurahan']."'"); 
                        foreach ($query_1->result_array() as $row_1)
                		{
                		    $id_cluster_klh = $row_1['id_cluster'];
                		}
                		if($id_cluster_klh != $id_cluster)
                		{
                		    $respStatus = 400;
					    	$resp = array('status' => 400,'message' =>  'Kelurahan tidak terdaftar di cluster sales.');
                		}else{
	        			    $resp = $this->LokasiModel->poi_update($id, $params, $users_id, $role);
	        			    $query_2 = $this->db->query("UPDATE fe_daftar_pjp
	        			                                 SET longitude = '".$params['longitude']."', latitude = '".$params['latitude']."'
                    		                             WHERE tanggal = '".date('Y-m-d')."'
                    		                                   AND id_tempat = '".$id."'
                    		                                   AND id_jenis_lokasi = 'POI'
                    		                                   AND id_sales = '".$users_id."'"); 
                		}
					}
					json_output($respStatus,$resp);
	       		}
			}
		}
	}
    
    //cari
	public function cari()
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
		        	    if ($params['cari'] == "") 
    					{
    						$respStatus = 400;
    						$resp = array('status' => 400,'message' =>  'Anda belum memasukkan kata kunci.');
    					} else {
	        		        $resp = $this->LokasiModel->cari($params,$users_id,$role);
    					}
	    				json_output($respStatus,$resp);
		        	}
			}
		}
	}
    
    //tampil
	public function tampil($id_jenis_lokasi,$id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' || $this->uri->segment(4) == '' || is_numeric($this->uri->segment(4)) == FALSE){
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
	        		$resp = $this->LokasiModel->tampil($id_jenis_lokasi,$id,$users_id,$role);
				    json_output($response['status'],$resp);
	        	}
			}
		}
	}
    
    //jumlah history pjp
	public function jumlah_history_pjp($id_jenis_lokasi,$id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' || $this->uri->segment(4) == '' || is_numeric($this->uri->segment(4)) == FALSE){
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
		        		$resp = $this->LokasiModel->jumlah_history_pjp($id_jenis_lokasi,$id,$users_id,$role);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
    
    //tampil history pjp
	public function tampil_history_pjp($id_jenis_lokasi,$id,$page)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET' || $this->uri->segment(5) == '' || is_numeric($this->uri->segment(5)) == FALSE){
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
		        		$resp = $this->LokasiModel->tampil_history_pjp($id_jenis_lokasi,$id,$users_id,$page,$role);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
    
    //retur sn
	public function retur_sn()
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
		        		$resp = $this->LokasiModel->retur_sn($params,$users_id);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
    
    //retur submit
	public function retur_submit()
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
		        		$resp = $this->LokasiModel->retur_submit($params,$users_id);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
    
    //retur list
	public function retur_list($tglawal,$tglakhir,$page)
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
		        		$resp = $this->LokasiModel->retur_list($tglawal,$tglakhir,$page,$users_id);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
    
    //retur list sn
	public function retur_list_sn()
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
		        		$resp = $this->LokasiModel->retur_list_sn($params,$users_id);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
    
    //pjp jumlah
	public function pjp_jumlah()
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
		        		$resp = $this->LokasiModel->pjp_jumlah($users_id);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
    
    //pjp daftar
	public function pjp_daftar()
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
		        		$resp = $this->LokasiModel->pjp_daftar($users_id);
					    json_output($response['status'],$resp);
		        	}
			}
		}
	}
    
	
}
