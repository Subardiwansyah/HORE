<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VoiceofresellerModel extends CI_Model {
    
    //voiceoffreseller
    public function voiceof($id_outlet)
    {
        //ke-1
        $query_p1 = $this->db->query("SELECT id, pertanyaan
                                      FROM za_voiceofreseller_pertanyaaan
                                      WHERE id = '1'
                                            AND status = 'AKTIF'");
		foreach ($query_p1->result_array() as $row_p1)
		{ 
		    $id_p1 = $row_p1['id'];
		    $pertanyaan_p1 = $row_p1['pertanyaan'];
		    $query_j1 = $this->db->query("SELECT id as id_pilihan, pilihan 
                                          FROM za_voiceofreseller_pilihan
                                          WHERE id_pertanyaan = '".$this->db->escape_str($row_p1['id'])."'");
		}
		
		//ke-2
        $query_p2 = $this->db->query("SELECT id, pertanyaan
                                      FROM za_voiceofreseller_pertanyaaan
                                      WHERE id = '2'
                                            AND status = 'AKTIF'");
		foreach ($query_p2->result_array() as $row_p2)
		{ 
		    $id_p2 = $row_p2['id'];
		    $pertanyaan_p2 = $row_p2['pertanyaan'];
		    $query_j2 = $this->db->query("SELECT id as id_pilihan, pilihan 
                                          FROM za_voiceofreseller_pilihan
                                          WHERE id_pertanyaan = '".$this->db->escape_str($row_p2['id'])."'");
		}
		
		//ke-3
        $query_p3 = $this->db->query("SELECT id, pertanyaan
                                      FROM za_voiceofreseller_pertanyaaan
                                      WHERE id = '3'
                                            AND status = 'AKTIF'");
		foreach ($query_p3->result_array() as $row_p3)
		{ 
		    $id_p3 = $row_p3['id'];
		    $pertanyaan_p3 = $row_p3['pertanyaan'];
		    $query_j3 = $this->db->query("SELECT id as id_pilihan, pilihan 
                                          FROM za_voiceofreseller_pilihan
                                          WHERE id_pertanyaan = '".$this->db->escape_str($row_p3['id'])."'");
		}
		
		//ke-4
        $query_p4 = $this->db->query("SELECT id, pertanyaan
                                      FROM za_voiceofreseller_pertanyaaan
                                      WHERE id = '4'
                                            AND status = 'AKTIF'");
		foreach ($query_p4->result_array() as $row_p4)
		{ 
		    $id_p4 = $row_p4['id'];
		    $pertanyaan_p4 = $row_p4['pertanyaan'];
		    $query_j4 = $this->db->query("SELECT id as id_pilihan, pilihan 
                                          FROM za_voiceofreseller_pilihan
                                          WHERE id_pertanyaan = '".$this->db->escape_str($row_p4['id'])."'");
		}

        //ke-5
        $query_p5 = $this->db->query("SELECT id, pertanyaan
                                      FROM za_voiceofreseller_pertanyaaan
                                      WHERE id = '5'
                                            AND status = 'AKTIF'");
		foreach ($query_p5->result_array() as $row_p5)
		{ 
		    $id_p5 = $row_p5['id'];
		    $pertanyaan_p5 = $row_p5['pertanyaan'];
		    $query_j5 = $this->db->query("SELECT id as id_pilihan, pilihan 
                                          FROM za_voiceofreseller_pilihan
                                          WHERE id_pertanyaan = '".$this->db->escape_str($row_p5['id'])."'");
		}
		
		//ke-6
        $query_p6 = $this->db->query("SELECT id, pertanyaan
                                      FROM za_voiceofreseller_pertanyaaan
                                      WHERE id = '6'
                                            AND status = 'AKTIF'");
		foreach ($query_p6->result_array() as $row_p6)
		{ 
		    $id_p6 = $row_p6['id'];
		    $pertanyaan_p6 = $row_p6['pertanyaan'];
		    $query_j6 = $this->db->query("SELECT id as id_pilihan, pilihan 
                                          FROM za_voiceofreseller_pilihan
                                          WHERE id_pertanyaan = '".$this->db->escape_str($row_p6['id'])."'");
		}
		
		//ke-7
        $query_p7 = $this->db->query("SELECT id, pertanyaan
                                      FROM za_voiceofreseller_pertanyaaan
                                      WHERE id = '7'
                                            AND status = 'AKTIF'");
		foreach ($query_p7->result_array() as $row_p7)
		{ 
		    $id_p7 = $row_p7['id'];
		    $pertanyaan_p7 = $row_p7['pertanyaan'];
		    $query_j7 = $this->db->query("SELECT id as id_pilihan, pilihan 
                                          FROM za_voiceofreseller_pilihan
                                          WHERE id_pertanyaan = '".$this->db->escape_str($row_p7['id'])."'");
		}
		
		//return
        return array('status' => 200, 
                     'data' => array(
                                        '1' => array('id_pertanyaan' => $id_p1,
                                                       'pertanyaan' => $pertanyaan_p1, 
    	                                               'pilihan' => $query_j1->result_array()
    	                                              ),
    	                                '2' => array('id_pertanyaan' => $id_p2,
    	                                               'pertanyaan' => $pertanyaan_p2, 
    	                                               'pilihan' => $query_j2->result_array()
    	                                              ),
    	                                '3' => array('id_pertanyaan' => $id_p3,
    	                                               'pertanyaan' => $pertanyaan_p3, 
    	                                               'pilihan' => $query_j3->result_array()
    	                                              ),
    	                                '4' => array('id_pertanyaan' => $id_p4,
    	                                               'pertanyaan' => $pertanyaan_p4, 
    	                                               'pilihan' => $query_j4->result_array()
    	                                              ),
    	                                '5' => array('id_pertanyaan' => $id_p5,
    	                                               'pertanyaan' => $pertanyaan_p5, 
    	                                               'pilihan' => $query_j5->result_array()
    	                                              ),
    	                                '6' => array('id_pertanyaan' => $id_p6,
    	                                               'pertanyaan' => $pertanyaan_p6, 
    	                                               'pilihan' => $query_j6->result_array()
    	                                              ),
    	                                '7' => array('id_pertanyaan' => $id_p7,
    	                                               'pertanyaan' => $pertanyaan_p7, 
    	                                               'pilihan' => $query_j7->result_array()
    	                                              )
                                     )
        		    );
 
    }
    
    
    //kirim
    public function kirim_voiceof($data, $users_id, $role, $id_divisi)
    {
        //minggu
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
		//nama_file
		$milik = 1;
		$query_2 = $this->db->query("SELECT id
    		                         FROM za_voiceofreseller
    		                         ORDER BY id DESC LIMIT 1"); 
        foreach ($query_2->result_array() as $row_2)
		{
		    $milik = $row_2['id'] + 1;
		}
		//upload file fisik
	    $tipenyaaa1 = '';
		$target_dir = "assets/voiceofreseller_video/";
		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
		{
		   
		    $uploadFile1 = $_FILES['myfile1'];
		    $extractFile1 = pathinfo($uploadFile1['name']);
		    $size1 = $_FILES['myfile1']['size'];
		    $tipe1 = $_FILES['myfile1']['type'];
		    $ftype1 = explode("/",$tipe1);
		    $ftypee1 = $ftype1[1];
	        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$id_divisi."_".$milik.".".$ftypee1))
	        {
	          
                $tipenyaaa1 = $id_divisi."_".$milik.".".$ftypee1;
                $query_3 = $this->db->query("INSERT INTO za_voiceofreseller
                                             (
                                              tahun, bulan, minggu, tanggal, 
                                              id_outlet, 
                                              id_pilihan_1,
                                              id_pilihan_2,
                                              id_pilihan_3,
                                              id_pilihan_4,
                                              id_pilihan_5,
                                              id_pilihan_6,
                                              id_pilihan_7,
                                              video,
                                              created_by
                                             )
                                             VALUES
                                             (
                                              '".$tahun."','".$bulan."','".$minggu."','".date('Y-m-d')."',
                                              '".$this->db->escape_str($this->input->post('id_outlet'))."',
                                              '".$this->db->escape_str($this->input->post('1'))."',
                                              '".$this->db->escape_str($this->input->post('2'))."',
                                              '".$this->db->escape_str($this->input->post('3'))."',
                                              '".$this->db->escape_str($this->input->post('4'))."',
                                              '".$this->db->escape_str($this->input->post('5'))."',
                                              '".$this->db->escape_str($this->input->post('6'))."',
                                              '".$this->db->escape_str($this->input->post('7'))."',
                                              '".$tipenyaaa1."',
                                              '".$users_id."'
                                             )");
                $query_4 = $this->db->query("INSERT INTO za_mt_penilaian_outlet
                                             ( id_outlet, tanggal, keterangan, created_by )
                                             VALUES
                                             (
                                              '".$this->db->escape_str($this->input->post('id_outlet'))."',
                                              '".date('Y-m-d')."',
                                              'voice of reseller',
                                              '".$users_id."'
                                             )");                                              
		        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');               
            }else{
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Video gagal di upload.'); 
            }
		}
    }
    
}
