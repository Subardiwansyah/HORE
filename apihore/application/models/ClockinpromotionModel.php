<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClockinpromotionModel extends CI_Model {

    //promotion jenis
    public function promotion_jenis()
    {
		$query = $this->db->query("SELECT 
		                              nb.id_jenis_weekly,
                                      na.nama_jenis
                                   FROM 
                                      nb_promotion_jenis_weekly nb,
                                      na_promotion_jenis na,
                                      ja_penjualan_tanggal ja
                                   WHERE 
                                      nb.id_jenis = na.id_jenis
                                      AND ja.tahun = nb.tahun
                                      AND ja.bulan = nb.bulan
                                      AND ja.minggu = nb.minggu
                                      AND ja.tanggal = '".date('Y-m-d')."'
                                   GROUP BY nb.id_jenis_weekly");
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }

    //promotion create
    public function promotion_create($params,$users_id)
    {
        //jenis lokasi
		$id_jenis_lokasi = $id_tempat = $status = '';
        $query_1 = $this->db->query("SELECT id_jenis_lokasi, id_tempat
		                             FROM fb_histroy_pjp
		                             WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
		foreach($query_1->result_array() as $row_1)
		{
		    $id_jenis_lokasi = $row_1['id_jenis_lokasi'];
		    $id_tempat = $row_1['id_tempat'];
		}
		if($id_jenis_lokasi == 'OUT')
		{
		    //upload file fisik
    	    $tipenyaaa1 = '';
    		$target_dir = "assets/promotion_video/";
    		//ke satu
    	
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		   
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1))
		        {
		          
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1;
	                $query_2 = $this->db->query("INSERT INTO nc_promotion_outlet
    		                             (
    		                                tgl, 
    		                                id_outlet, id_jenis_weekly,
    		                                id_history_pjp,
    		                                nama_program_lokal,
    		                                file_video,
    		                                created_by
    		                             )
    		                             VALUES
    		                             (
    		                                '".date('Y-m-d')."',
    		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_weekly'))."',
    		                                '".$this->db->escape_str($this->input->post('id_history_pjp'))."',
    		                                '".$this->db->escape_str($this->input->post('nama_program_lokal'))."',
    		                                '".$this->db->escape_str($tipenyaaa1)."',
    		                                '".$this->db->escape_str($users_id)."'
    		                             )");
    		        $query_3 = $this->db->query("UPDATE fb_histroy_pjp 
            	                                 SET video_promotion = 'completed'
            	                                 WHERE id_history_pjp = '".$this->input->post('id_history_pjp')."'");
        	        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created. $strdebug');               
		        }else{
		            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
		        }
    		}
    		
		}
		if($id_jenis_lokasi == 'SEK')
		{
		    //upload file fisik
    	    $tipenyaaa1 = '';
    		$target_dir = "assets/promotion_video/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1))
		        {
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1;
	                $query_2 = $this->db->query("INSERT INTO nd_promotion_sekolah
            		                             (
            		                                tgl, 
            		                                id_sekolah, id_jenis_weekly,
            		                                id_history_pjp,
            		                                nama_program_lokal,
            		                                file_video,
            		                                created_by
            		                             )
            		                             VALUES
            		                             (
            		                                '".date('Y-m-d')."',
            		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_weekly'))."',
            		                                '".$this->db->escape_str($this->input->post('id_history_pjp'))."',
            		                                '".$this->db->escape_str($this->input->post('nama_program_lokal'))."',
            		                                '".$this->db->escape_str($tipenyaaa1)."',
            		                                '".$this->db->escape_str($users_id)."'
            		                             )");
    		        $query_3 = $this->db->query("UPDATE fb_histroy_pjp 
            	                                 SET video_promotion = 'completed'
            	                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
        	        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');                      
		        }else{
		            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
		        }
    		}
    		
    		
		}
		if($id_jenis_lokasi == 'KAM')
		{
		    //upload file fisik
    	    $tipenyaaa1 = '';
    		$target_dir = "assets/promotion_video/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1))
		        {
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1;
	                $query_2 = $this->db->query("INSERT INTO ne_promotion_kampus
            		                             (
            		                                tgl, 
            		                                id_universitas, id_jenis_weekly,
            		                                id_history_pjp,
            		                                nama_program_lokal,
            		                                file_video,
            		                                created_by
            		                             )
            		                             VALUES
            		                             (
            		                                '".date('Y-m-d')."',
            		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_weekly'))."',
            		                                '".$this->db->escape_str($this->input->post('id_history_pjp'))."',
            		                                '".$this->db->escape_str($this->input->post('nama_program_lokal'))."',
            		                                '".$this->db->escape_str($tipenyaaa1)."',
            		                                '".$this->db->escape_str($users_id)."'
            		                             )");
    		        $query_3 = $this->db->query("UPDATE fb_histroy_pjp 
            	                                 SET video_promotion = 'completed'
            	                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
        	        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');                       
		        }else{
		            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
		        }
    		}
		}
		if($id_jenis_lokasi == 'FAK')
		{
		    //upload file fisik
    	    $tipenyaaa1 = '';
    		$target_dir = "assets/promotion_video/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1))
		        {
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1;
	                $query_2 = $this->db->query("INSERT INTO nf_promotion_fakultas
            		                             (
            		                                tgl, 
            		                                id_fakultas, id_jenis_weekly,
            		                                id_history_pjp,
            		                                nama_program_lokal,
            		                                file_video,
            		                                created_by
            		                             )
            		                             VALUES
            		                             (
            		                                '".date('Y-m-d')."',
            		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_weekly'))."',
            		                                '".$this->db->escape_str($this->input->post('id_history_pjp'))."',
            		                                '".$this->db->escape_str($this->input->post('nama_program_lokal'))."',
            		                                '".$this->db->escape_str($tipenyaaa1)."',
            		                                '".$this->db->escape_str($users_id)."'
            		                             )");
    		        $query_3 = $this->db->query("UPDATE fb_histroy_pjp 
            	                                 SET video_promotion = 'completed'
            	                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
        	        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');                      
		        }else{
		            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
		        }
    		}
    		
		}
		if($id_jenis_lokasi == 'POI')
		{
		    //upload file fisik
    	    $tipenyaaa1 = '';
    		$target_dir = "assets/promotion_video/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1))
		        {
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1;
	                $query_2 = $this->db->query("INSERT INTO nf_promotion_poi
            		                             (
            		                                tgl, 
            		                                id_poi, id_jenis_weekly,
            		                                id_history_pjp,
            		                                nama_program_lokal,
            		                                file_video,
            		                                created_by
            		                             )
            		                             VALUES
            		                             (
            		                                '".date('Y-m-d')."',
            		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_weekly'))."',
            		                                '".$this->db->escape_str($this->input->post('id_history_pjp'))."',
            		                                '".$this->db->escape_str($this->input->post('nama_program_lokal'))."',
            		                                '".$this->db->escape_str($tipenyaaa1)."',
            		                                '".$this->db->escape_str($users_id)."'
            		                             )");
    		          $query_3 = $this->db->query("UPDATE fb_histroy_pjp 
            	                                   SET video_promotion = 'completed'
            	                                   WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
        	          return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');               
		        }else{
		            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
		        }
    		}
		}
		 return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
    }
    
	//promotion list
    public function promotion_list($params)
    {
        $id_jenis_lokasi = '';
        $query_1 = $this->db->query("SELECT id_jenis_lokasi
		                             FROM fb_histroy_pjp
		                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
		foreach($query_1->result_array() as $row_1)
		{
		    $id_jenis_lokasi = $row_1['id_jenis_lokasi'];
		}
		if($id_jenis_lokasi == 'OUT')
        {
    		$query = $this->db->query("SELECT 
    		                              id_jenis_weekly
                                       FROM 
                                          nc_promotion_outlet
                                       WHERE 
                                          id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
        }
        if($id_jenis_lokasi == 'SEK')
        {
    		$query = $this->db->query("SELECT 
    		                              id_jenis_weekly
                                       FROM 
                                          nd_promotion_sekolah
                                       WHERE 
                                          id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
        }
        if($id_jenis_lokasi == 'KAM')
        {
    		$query = $this->db->query("SELECT 
    		                              id_jenis_weekly
                                       FROM 
                                          ne_promotion_kampus
                                       WHERE 
                                          id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
        }
        if($id_jenis_lokasi == 'FAK')
        {
    		$query = $this->db->query("SELECT 
    		                              id_jenis_weekly
                                       FROM 
                                          nf_promotion_fakultas
                                       WHERE 
                                          id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
        }
        if($id_jenis_lokasi == 'POI')
        {
    		$query = $this->db->query("SELECT 
    		                              id_jenis_weekly
                                       FROM 
                                          nf_promotion_poi
                                       WHERE 
                                          id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
        }
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }


	//promotion create
    public function promotion_create_test($params,$users_id)
    {
        //jenis lokasi
		$id_jenis_lokasi = $id_tempat = $status = $id_promotion = '';
        $query_1 = $this->db->query("SELECT id_jenis_lokasi, id_tempat
		                             FROM fb_histroy_pjp
		                             WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
		foreach($query_1->result_array() as $row_1)
		{
		    $id_jenis_lokasi = $row_1['id_jenis_lokasi'];
		    $id_tempat = $row_1['id_tempat'];
		}
		$query_12 = $this->db->query("SELECT id_promotion
		                             FROM nc_promotion_outlet
									 ORDER BY id_promotion DESC LIMIT 1");
		foreach($query_12->result_array() as $row_12)
		{
		    $id_promotion = $row_12['id_promotion'];
		}
		if($id_jenis_lokasi == 'OUT')
		{
		    //upload file fisik
    	    $tipenyaaa1 = '';
    		$target_dir = "assets/promotion_video/";
    		//ke satu
    	
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		   
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').$id_promotion.".".$ftypee1))
		        {
		          
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').$id_promotion.".".$ftypee1;
	                $query_2 = $this->db->query("INSERT INTO nc_promotion_outlet
    		                             (
    		                                tgl, 
    		                                id_outlet, id_jenis_weekly,
    		                                id_history_pjp,
    		                                nama_program_lokal,
    		                                file_video,
    		                                created_by
    		                             )
    		                             VALUES
    		                             (
    		                                '".date('Y-m-d')."',
    		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_weekly'))."',
    		                                '".$this->db->escape_str($this->input->post('id_history_pjp'))."',
    		                                '".$this->db->escape_str($this->input->post('nama_program_lokal'))."',
    		                                '".$this->db->escape_str($tipenyaaa1)."',
    		                                '".$this->db->escape_str($users_id)."'
    		                             )");
    		        $query_3 = $this->db->query("UPDATE fb_histroy_pjp 
            	                                 SET video_promotion = 'completed'
            	                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
        	        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created. $strdebug');               
		        }else{
		            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
		        }
    		}
    		
		}
		if($id_jenis_lokasi == 'SEK')
		{
		    //upload file fisik
    	    $tipenyaaa1 = '';
    		$target_dir = "assets/promotion_video/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1))
		        {
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1;
	                $query_2 = $this->db->query("INSERT INTO nd_promotion_sekolah
            		                             (
            		                                tgl, 
            		                                id_sekolah, id_jenis_weekly,
            		                                id_history_pjp,
            		                                nama_program_lokal,
            		                                file_video,
            		                                created_by
            		                             )
            		                             VALUES
            		                             (
            		                                '".date('Y-m-d')."',
            		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_weekly'))."',
            		                                '".$this->db->escape_str($this->input->post('id_history_pjp'))."',
            		                                '".$this->db->escape_str($this->input->post('nama_program_lokal'))."',
            		                                '".$this->db->escape_str($tipenyaaa1)."',
            		                                '".$this->db->escape_str($users_id)."'
            		                             )");
    		        $query_3 = $this->db->query("UPDATE fb_histroy_pjp 
            	                                 SET video_promotion = 'completed'
            	                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
        	        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');                      
		        }else{
		            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
		        }
    		}
    		
    		
		}
		if($id_jenis_lokasi == 'KAM')
		{
		    //upload file fisik
    	    $tipenyaaa1 = '';
    		$target_dir = "assets/promotion_video/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1))
		        {
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1;
	                $query_2 = $this->db->query("INSERT INTO ne_promotion_kampus
            		                             (
            		                                tgl, 
            		                                id_kampus, id_jenis_weekly,
            		                                id_history_pjp,
            		                                nama_program_lokal,
            		                                file_video,
            		                                created_by
            		                             )
            		                             VALUES
            		                             (
            		                                '".date('Y-m-d')."',
            		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_weekly'))."',
            		                                '".$this->db->escape_str($this->input->post('id_history_pjp'))."',
            		                                '".$this->db->escape_str($this->input->post('nama_program_lokal'))."',
            		                                '".$this->db->escape_str($tipenyaaa1)."',
            		                                '".$this->db->escape_str($users_id)."'
            		                             )");
    		        $query_3 = $this->db->query("UPDATE fb_histroy_pjp 
            	                                 SET video_promotion = 'completed'
            	                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
        	        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');                       
		        }else{
		            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
		        }
    		}
		}
		if($id_jenis_lokasi == 'FAK')
		{
		    //upload file fisik
    	    $tipenyaaa1 = '';
    		$target_dir = "assets/promotion_video/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1))
		        {
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1;
	                $query_2 = $this->db->query("INSERT INTO nf_promotion_fakultas
            		                             (
            		                                tgl, 
            		                                id_fakultas, id_jenis_weekly,
            		                                id_history_pjp,
            		                                nama_program_lokal,
            		                                file_video,
            		                                created_by
            		                             )
            		                             VALUES
            		                             (
            		                                '".date('Y-m-d')."',
            		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_weekly'))."',
            		                                '".$this->db->escape_str($this->input->post('id_history_pjp'))."',
            		                                '".$this->db->escape_str($this->input->post('nama_program_lokal'))."',
            		                                '".$this->db->escape_str($tipenyaaa1)."',
            		                                '".$this->db->escape_str($users_id)."'
            		                             )");
    		        $query_3 = $this->db->query("UPDATE fb_histroy_pjp 
            	                                 SET video_promotion = 'completed'
            	                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
        	        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');                      
		        }else{
		            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
		        }
    		}
    		
		}
		if($id_jenis_lokasi == 'POI')
		{
		    //upload file fisik
    	    $tipenyaaa1 = '';
    		$target_dir = "assets/promotion_video/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1))
		        {
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_weekly').".".$ftypee1;
	                $query_2 = $this->db->query("INSERT INTO nf_promotion_poi
            		                             (
            		                                tgl, 
            		                                id_poi, id_jenis_weekly,
            		                                id_history_pjp,
            		                                nama_program_lokal,
            		                                file_video,
            		                                created_by
            		                             )
            		                             VALUES
            		                             (
            		                                '".date('Y-m-d')."',
            		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_weekly'))."',
            		                                '".$this->db->escape_str($this->input->post('id_history_pjp'))."',
            		                                '".$this->db->escape_str($this->input->post('nama_program_lokal'))."',
            		                                '".$this->db->escape_str($tipenyaaa1)."',
            		                                '".$this->db->escape_str($users_id)."'
            		                             )");
    		          $query_3 = $this->db->query("UPDATE fb_histroy_pjp 
            	                                   SET video_promotion = 'completed'
            	                                   WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
        	          return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');               
		        }else{
		            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
		        }
    		}
		}
		 return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
    }
}