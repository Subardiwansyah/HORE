<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComboboxModel extends CI_Model {
    
    //outlet jenis
    public function outlet_jenis($role)
    {
        if($role == '5' || $role == '6' || $role == '8')
        {
    		$query = $this->db->query("SELECT 
    		                               eh.id_jenis_outlet, eh.nama_jenis_outlet
    		                           FROM eh_jenis_outlet eh
    		                           ORDER by eh.id_jenis_outlet");
            return $query->result_array();
        }else{
            return array('status' => 200, 'message' => 'role denied');
        }
    }
    
    //provinsi
    public function provinsi($id_cluster)
    {
		$query = $this->db->query("SELECT 
		                               ca.*
		                           FROM ca_provinsi ca, cb_kabupaten cb, cc_kecamatan cc
		                           WHERE ca.id_provinsi = cb.id_provinsi
		                                 AND cb.id_kabupaten = cc.id_kabupaten
		                                 AND cc.id_cluster = '".$this->db->escape_str($id_cluster)."'
		                           GROUP BY ca.id_provinsi
		                           ORDER by ca.nama_provinsi");
        return $query->result_array();
    }
    
    //kabupaten
    public function kabupaten($params,$id_cluster)
    {
		$query = $this->db->query("SELECT 
		                               cb.id_kabupaten, cb.nama_kabupaten
		                           FROM cb_kabupaten cb, cc_kecamatan cc
		                           WHERE cb.id_kabupaten = cc.id_kabupaten
		                                 AND cc.id_cluster = '".$this->db->escape_str($id_cluster)."'
		                                 AND cb.id_provinsi = '".$this->db->escape_str($params['id_provinsi'])."'
		                           GROUP BY cb.id_kabupaten
		                           ORDER by cb.nama_kabupaten");
        return $query->result_array();
    }
    
    //kecamatan
    public function kecamatan($params,$id_cluster)
    {
		$query = $this->db->query("SELECT 
		                                cc.id_kecamatan, cc.nama_kecamatan
		                           FROM cc_kecamatan cc
		                           WHERE cc.id_cluster = '".$this->db->escape_str($id_cluster)."'
		                                 AND cc.id_kabupaten = '".$this->db->escape_str($params['id_kabupaten'])."'
		                           GROUP BY cc.id_kecamatan
		                           ORDER by cc.nama_kecamatan");
        return $query->result_array();
    }
    
    //kelurahan
    public function kelurahan($params,$id_cluster)
    {
		$query = $this->db->query("SELECT 
		                                cd.id_kelurahan, cd.nama_kelurahan
		                           FROM cd_kelurahan cd, cc_kecamatan cc
		                           WHERE cd.id_kecamatan = cc.id_kecamatan
		                                 AND cc.id_cluster = '".$this->db->escape_str($id_cluster)."'
		                                 AND cc.id_kecamatan = '".$this->db->escape_str($params['id_kecamatan'])."'
		                           GROUP BY cd.id_kelurahan
		                           ORDER by cd.nama_kelurahan");
        return $query->result_array();
    }
    
    //retur alasan
    public function retur_alasan()
    {
        $query = $this->db->query("SELECT 
		                               id_alasan, nama_alasan
		                           FROM hd_alasan_retur
		                           ORDER BY id_alasan");
        return $query->result_array();
    }
    
    //provinsi
    public function select_provinsi($id_kabupaten)
    {
		$query = $this->db->query("SELECT 
		                               ca.*
		                           FROM ca_provinsi ca, cb_kabupaten cb
		                           WHERE ca.id_provinsi = cb.id_provinsi
		                                 AND cb.id_kabupaten = '".$this->db->escape_str($id_kabupaten)."'
		                           GROUP BY ca.id_provinsi
		                           ORDER by ca.nama_provinsi");
        return $query->result_array();
    }
    
    //kabupaten
    public function select_kabupaten($id_kecamatan)
    {
		$query = $this->db->query("SELECT 
		                               cb.id_kabupaten, cb.nama_kabupaten
		                           FROM cb_kabupaten cb, cc_kecamatan cc
		                           WHERE cb.id_kabupaten = cc.id_kabupaten
		                                 AND cc.id_kecamatan = '".$this->db->escape_str($id_kecamatan)."'
		                           GROUP BY cb.id_kabupaten
		                           ORDER by cb.nama_kabupaten");
        return $query->result_array();
    }
    
    //kecamatan
    public function select_kecamatan($id_kelurahan)
    {
		$query = $this->db->query("SELECT 
		                                cc.id_kecamatan, cc.nama_kecamatan
		                           FROM cc_kecamatan cc, cd_kelurahan cd
		                           WHERE cc.id_kecamatan = cd.id_kecamatan
		                                 AND cd.id_kelurahan = '".$this->db->escape_str($id_kelurahan)."'
		                           GROUP BY cc.id_kecamatan
		                           ORDER by cc.nama_kecamatan");
        return $query->result_array();
    }
    
    //universitas
    public function universitas($role)
    {
        if($role == '7')
        {
    		$query = $this->db->query("SELECT 
    		                                id_universitas, nama_universitas
    		                           FROM ed_kampus 
    		                           WHERE status = 'OPEN'
    		                           ORDER by nama_universitas");
            return $query->result_array();
        }else{
            return array('status' => 200, 'message' => 'role denied');
        }
    }
    
    
    //frekuensi paket
    public function frekuensi_paket($role)
    {
        if($role == '7')
        {
    		$query = $this->db->query("SELECT  *
    		                           FROM ot_master_frekuensi_beli_paket ot");
            return $query->result_array();
        }else{
            return array('status' => 200, 'message' => 'role denied');
        }
    }
    
    
    //provider
    public function provider($role)
    {
        if($role == '7')
        {
    		$query = $this->db->query("SELECT  *
    		                           FROM ou_master_provider");
            return $query->result_array();
        }else{
            return array('status' => 200, 'message' => 'role denied');
        }
    }

}
