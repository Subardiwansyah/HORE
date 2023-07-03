<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenilaiansfModel extends CI_Model {
    
    //penilaian
    public function penilaian($id_sales)
    {
        //Personality
        $query_p1 = $this->db->query("SELECT id AS id_parameter, parameter
                                      FROM za_penilaiansf_parameter
                                      WHERE id_jenis = '1'
                                            AND status = 'AKTIF'");
		
		//Distribution
        $query_p2 = $this->db->query("SELECT id AS id_parameter, parameter
                                      FROM za_penilaiansf_parameter
                                      WHERE id_jenis = '2'
                                            AND status = 'AKTIF'");
		
		//Merchandising
        $query_p3 = $this->db->query("SELECT id AS id_parameter, parameter
                                      FROM za_penilaiansf_parameter
                                      WHERE id_jenis = '3'
                                            AND status = 'AKTIF'");
		
		//Promotion
        $query_p4 = $this->db->query("SELECT id AS id_parameter, parameter
                                      FROM za_penilaiansf_parameter
                                      WHERE id_jenis = '4'
                                            AND status = 'AKTIF'");
		
		//return
        return array('status' => 200, 
                     'data' => array(
                                        'Personality' => array('parameter' => $query_p1->result_array()),
    	                                'Distribution' => array('parameter' => $query_p2->result_array()),
            	                        'Merchandising' => array('parameter' => $query_p3->result_array()),
            	                        'Promotion' => array('parameter' => $query_p4->result_array()),                         
                                     )
        		    );
    }
    
    
    //pilihan
    public function pilihan()
    {
		//Pilihan
		$query_pl = $this->db->query("SELECT id as id_pilihan, pilihan, angka
                                      FROM za_penilaiansf_pilihan");
	
		//return
        return array('status' => 200, 
                     'data' => $query_pl->result_array()
        		    );
    }
    
    //cek
    public function cek_penilaian()
    {
		//Pilihan
		$total = 0;
		$query_1 = $this->db->query("SELECT * FROM
		                             (SELECT (a.angka*(b.bobot/100)) AS pilihan_1 
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '1'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('1')).") as a,
		                             (SELECT (a.angka*(b.bobot/100)) AS pilihan_2 
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '2'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('2')).") as b,
                                    (SELECT (a.angka*(b.bobot/100)) AS pilihan_3
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '3'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('3')).") as c,
                                    (SELECT (a.angka*(b.bobot/100)) AS pilihan_4 
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '4'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('4')).") as d,
		                            (SELECT (a.angka*(b.bobot/100)) AS pilihan_5 
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '5'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('5')).") as e,
		                            (SELECT (a.angka*(b.bobot/100)) AS pilihan_6 
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '6'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('6')).") as f,
		                            (SELECT (a.angka*(b.bobot/100)) AS pilihan_7 
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '7'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('7')).") as g,
		                            (SELECT (a.angka*(b.bobot/100)) AS pilihan_8 
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '8'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('8')).") as h,
		                            (SELECT (a.angka*(b.bobot/100)) AS pilihan_9
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '9'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('9')).") as i,
		                            (SELECT (a.angka*(b.bobot/100)) AS pilihan_10
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '10'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('10')).") as j,
		                            (SELECT (a.angka*(b.bobot/100)) AS pilihan_11 
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '11'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('11')).") as k,
		                            (SELECT (a.angka*(b.bobot/100)) AS pilihan_12 
		                              FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
		                              WHERE b.id = '12'
		                                    AND a.id = ".$this->db->escape_str($this->input->post('12')).") as l");
        foreach ($query_1->result_array() as $row_1)
		{
			$total = $row_1['pilihan_1'] + $row_1['pilihan_2'] + $row_1['pilihan_3'] + $row_1['pilihan_4'] + $row_1['pilihan_5'] +
			         $row_1['pilihan_6'] + $row_1['pilihan_7'] + $row_1['pilihan_8'] + $row_1['pilihan_9'] + $row_1['pilihan_10'] + 
			         $row_1['pilihan_11'] + $row_1['pilihan_12'];
		}
		//return
        return array('status' => 200, 
                     'data' => $total
        		    );
    }
    
   //kirim
   public function kirim_penilaian($data, $users_id, $role, $id_divisi)
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
           $total = 0;
           $query_11 = $this->db->query("SELECT * FROM
                                        (SELECT (a.angka*(b.bobot/100)) AS pilihan_1 
                                         FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                         WHERE b.id = '1'
                                               AND a.id = ".$this->db->escape_str($this->input->post('1')).") as a,
                                        (SELECT (a.angka*(b.bobot/100)) AS pilihan_2 
                                         FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                         WHERE b.id = '2'
                                               AND a.id = ".$this->db->escape_str($this->input->post('2')).") as b,
                                       (SELECT (a.angka*(b.bobot/100)) AS pilihan_3
                                             FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                             WHERE b.id = '3'
                                                   AND a.id = ".$this->db->escape_str($this->input->post('3')).") as c,
                                       (SELECT (a.angka*(b.bobot/100)) AS pilihan_4 
                                         FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                         WHERE b.id = '4'
                                               AND a.id = ".$this->db->escape_str($this->input->post('4')).") as d,
                                       (SELECT (a.angka*(b.bobot/100)) AS pilihan_5 
                                         FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                         WHERE b.id = '5'
                                               AND a.id = ".$this->db->escape_str($this->input->post('5')).") as e,
                                       (SELECT (a.angka*(b.bobot/100)) AS pilihan_6 
                                         FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                         WHERE b.id = '6'
                                               AND a.id = ".$this->db->escape_str($this->input->post('6')).") as f,
                                       (SELECT (a.angka*(b.bobot/100)) AS pilihan_7 
                                         FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                         WHERE b.id = '7'
                                               AND a.id = ".$this->db->escape_str($this->input->post('7')).") as g,
                                       (SELECT (a.angka*(b.bobot/100)) AS pilihan_8 
                                         FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                         WHERE b.id = '8'
                                               AND a.id = ".$this->db->escape_str($this->input->post('8')).") as h,
                                       (SELECT (a.angka*(b.bobot/100)) AS pilihan_9
                                         FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                         WHERE b.id = '9'
                                               AND a.id = ".$this->db->escape_str($this->input->post('9')).") as i,
                                       (SELECT (a.angka*(b.bobot/100)) AS pilihan_10
                                         FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                         WHERE b.id = '10'
                                               AND a.id = ".$this->db->escape_str($this->input->post('10')).") as j,
                                       (SELECT (a.angka*(b.bobot/100)) AS pilihan_11 
                                         FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                         WHERE b.id = '11'
                                               AND a.id = ".$this->db->escape_str($this->input->post('11')).") as k,
                                       (SELECT (a.angka*(b.bobot/100)) AS pilihan_12 
                                         FROM za_penilaiansf_pilihan a, za_penilaiansf_parameter b
                                         WHERE b.id = '12'
                                               AND a.id = ".$this->db->escape_str($this->input->post('12')).") as l");
           foreach ($query_11->result_array() as $row_11)
           {
                 $total = $row_11['pilihan_1'] + $row_11['pilihan_2'] + $row_11['pilihan_3'] + $row_11['pilihan_4'] + $row_11['pilihan_5'] +
                          $row_11['pilihan_6'] + $row_11['pilihan_7'] + $row_11['pilihan_8'] + $row_11['pilihan_9'] + $row_11['pilihan_10'] + 
                          $row_11['pilihan_11'] + $row_11['pilihan_12'];
           }    
       $query_3 = $this->db->query("INSERT INTO za_penilaiansf
                                    (
                                     tahun, bulan, minggu, tanggal, 
                                     id_sales, 
                                     id_pilihan_1,
                                     id_pilihan_2,
                                     id_pilihan_3,
                                     id_pilihan_4,
                                     id_pilihan_5,
                                     id_pilihan_6,
                                     id_pilihan_7,
                                     id_pilihan_8,
                                     id_pilihan_9,
                                     id_pilihan_10,
                                     id_pilihan_11,
                                     id_pilihan_12,
                                     total,
                                     message,
                                     created_by
                                    )
                                    VALUES
                                    (
                                     '".$tahun."','".$bulan."','".$minggu."','".date('Y-m-d')."',
                                     '".$this->db->escape_str($this->input->post('id_sales'))."',
                                     '".$this->db->escape_str($this->input->post('1'))."',
                                     '".$this->db->escape_str($this->input->post('2'))."',
                                     '".$this->db->escape_str($this->input->post('3'))."',
                                     '".$this->db->escape_str($this->input->post('4'))."',
                                     '".$this->db->escape_str($this->input->post('5'))."',
                                     '".$this->db->escape_str($this->input->post('6'))."',
                                     '".$this->db->escape_str($this->input->post('7'))."',
                                     '".$this->db->escape_str($this->input->post('8'))."',
                                     '".$this->db->escape_str($this->input->post('9'))."',
                                     '".$this->db->escape_str($this->input->post('10'))."',
                                     '".$this->db->escape_str($this->input->post('11'))."',
                                     '".$this->db->escape_str($this->input->post('12'))."',
                                     '".$total."',
                                     '".$this->db->escape_str($this->input->post('message'))."',
                                     '".$users_id."'
                                    )");
                                  
       $query_4 = $this->db->query("INSERT INTO za_mt_penilaian_sf
                                    ( id_sales, tanggal, keterangan, created_by )
                                    VALUES
                                    (
                                     '".$this->db->escape_str($this->input->post('id_sales'))."',
                                     '".date('Y-m-d')."',
                                     'penilaian sf',
                                     '".$users_id."'
                                    )");                                       
       return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');
   }
    
}
