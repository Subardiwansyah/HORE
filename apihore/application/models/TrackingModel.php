<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TrackingModel extends CI_Model {

    //select tracking
    public function select_tracking($params, $users_id)
    {
        $query = $this->db->query("SELECT jam, longitude, latitude 
                                   FROM fc_tracking_sales
                                   WHERE id_sales = '".$this->db->escape_str($users_id)."'
                                         AND tanggal = '".$this->db->escape_str($params['tanggal'])."'");
        return $query->result_array();
    }

    //tracking pjp
    public function tracking_pjp($data)
    {
        $this->db->insert('fc_tracking_sales',$data);
        return array('status' => 201, 'message' => 'Data has been created.');
    }

}