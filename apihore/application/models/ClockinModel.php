<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClockinModel extends CI_Model {

    //pjp clockin
    public function pjp_clockin($data, $users_id)
    {
        $id_history_pjp = '';
        $query_1 = $this->db->query("SELECT id_history_pjp
    		                         FROM fb_histroy_pjp
    		                         WHERE id_sales = '".$this->db->escape_str($users_id)."'
    		                              AND id_tempat = '".$this->db->escape_str($data['id_tempat'])."'
                                          AND id_jenis_lokasi = '".$this->db->escape_str($data['id_jenis_lokasi'])."'
    		                              AND tanggal = '".date('Y-m-d')."'
    		                         ORDER BY id_history_pjp DESC LIMIT 1"); 
        if($query_1->num_rows() > 0)
		{
		    foreach ($query_1->result_array() as $row_1)
    		{
    		    $id_history_pjp = $row_1['id_history_pjp'];
    		}
		    return array('status' => 201, 'message' => 'no update', 'id_history_pjp' => $id_history_pjp);
		}else{
            $this->db->insert('fb_histroy_pjp',$data);
            $query_2 = $this->db->query("SELECT id_history_pjp
        		                         FROM fb_histroy_pjp
        		                         WHERE id_sales = '".$this->db->escape_str($users_id)."'
        		                             AND id_tempat = '".$this->db->escape_str($data['id_tempat'])."'
        		                             AND id_jenis_lokasi = '".$this->db->escape_str($data['id_jenis_lokasi'])."'
        		                             AND tanggal = '".date('Y-m-d')."'
        		                         ORDER BY id_history_pjp DESC LIMIT 1"); 
            foreach ($query_2->result_array() as $row)
    		{
    		    $id_history_pjp = $row['id_history_pjp'];
    		}
            return array('status' => 201, 'message' => 'Data has been created.', 'id_history_pjp' => $id_history_pjp);
		}
    }
    
    
    //pjp clockin status
    public function pjp_clockin_status($params,$users_id)
    {
        $status = '0';
        $query = $this->db->query("SELECT 
                                        status
    		                       FROM fb_histroy_pjp
    		                       WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
    	foreach ($query->result_array() as $row)
		{
		    if($row['status'] == 'OPEN')
    		{
    		    $status = '1';
    		}elseif($row['status'] == 'CLOSE'){
    		    $status = '2';
    		}
		}
        return array('status' => 201, 'message' => '0 : belum clockin, 1 : OPEN, 2 : CLOSE', 'status' => $status);
    }

}