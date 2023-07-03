<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryModel extends CI_Model {
    
    //penilaian_outlet
    public function penilaian_outlet($tglawal,$tglakhir, $users_id, $role, $id_divisi)
    {
        //penilaian_outlet
        $query = $this->db->query("SELECT 
                                        b.id_digipos, b.nama_outlet, a.lastmodified, a.keterangan
		                           FROM za_mt_penilaian_outlet a,
		                                eb_outlet b
		                           WHERE a.id_outlet = b.id_outlet
		                                 AND a.tanggal >= '".$this->db->escape_str($tglawal)."' AND a.tanggal <= '".$this->db->escape_str($tglakhir)."'
		                                 AND a.created_by = '".$this->db->escape_str($users_id)."'
		                           GROUP BY a.id_outlet, a.lastmodified, a.keterangan");
		$data = $query->result_array();       
        return array('status' => 200, 'data' => $data);
    }
    
    //penilaian_sf
    public function penilaian_sf($tglawal,$tglakhir, $users_id, $role, $id_divisi)
    {
        //penilaian_sf
        $query = $this->db->query("SELECT 
                                        b.id_sales, b.nama_sales, a.lastmodified, a.keterangan
		                           FROM za_mt_penilaian_sf a,
		                                db_sales b
		                           WHERE a.id_sales = b.id_sales
		                                 AND a.tanggal >= '".$this->db->escape_str($tglawal)."' AND a.tanggal <= '".$this->db->escape_str($tglakhir)."'
		                                 AND a.created_by = '".$this->db->escape_str($users_id)."'
		                           GROUP BY a.id_sales, a.lastmodified, a.keterangan");
		$data = $query->result_array();       
        return array('status' => 200, 'data' => $data);
    }
    
}
