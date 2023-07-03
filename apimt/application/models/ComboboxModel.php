<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComboboxModel extends CI_Model {
    
    //cluster
    public function cluster($role,$users_id,$id_divisi)
    {
        if($role == '1')
        {
    		$query = $this->db->query("SELECT id_cluster, nama_cluster
    		                           FROM bc_cluster
    		                           ORDER by id_cluster");
        }
        if($role == '2')
        {
    		$query = $this->db->query("SELECT id_cluster, nama_cluster
    		                           FROM bc_cluster
    		                           WHERE id_branch = '".$this->db->escape_str($id_divisi)."'
    		                           ORDER by id_cluster");
        }
        if($role == '3')
        {
    		$query = $this->db->query("SELECT id_cluster, nama_cluster
    		                           FROM bc_cluster
    		                           WHERE id_cluster = '".$this->db->escape_str($id_divisi)."'
    		                           ORDER by id_cluster");
        }
        if($role == '4')
        {
    		$query = $this->db->query("SELECT a.id_cluster, a.nama_cluster
    		                           FROM bc_cluster a, bd_tap b
    		                           WHERE a.id_cluster = b.id_cluster
    		                                 AND b.id_tap = '".$this->db->escape_str($id_divisi)."'
    		                           ORDER by a.id_cluster");
        }
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    
    //tap
    public function tap($params)
    {
		$query = $this->db->query("SELECT 
		                               id_tap, nama_tap
		                           FROM bd_tap
		                           WHERE id_cluster = '".$this->db->escape_str($params['id_cluster'])."'
		                           ORDER by id_tap");
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    
    //sales
    public function sales($params)
    {
		$query = $this->db->query("SELECT 
		                             id_sales, nama_sales
		                           FROM db_sales
		                           WHERE id_tap = '".$this->db->escape_str($params['id_tap'])."'
		                                 AND id_jenis_sales = 'SSF'
		                           ORDER by nama_sales");
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    
    //outlet
    public function outlet($params)
    {
		$query = $this->db->query("SELECT 
                                      b.id_outlet, b.id_digipos, b.nama_outlet
		                           FROM fa_pjp a, db_sales db, eb_outlet b
		                           WHERE a.id_tempat = b.id_outlet
		                                 AND a.id_jenis_lokasi = 'OUT'
		                                 AND a.id_sales = db.id_sales
		                                 AND b.status = 'OPEN'
		                                 AND a.id_sales = '".$this->db->escape_str($params['id_sales'])."'
		                          GROUP BY b.id_outlet");
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    

    //cluster
    public function select_cluster($id_tap)
    {
		$query = $this->db->query("SELECT 
		                               a.id_cluster, a.nama_cluster
		                           FROM bc_cluster a, bd_tap b
		                           WHERE a.id_cluster = b.id_cluster
		                                 AND b.id_tap = '".$this->db->escape_str($id_tap)."'
		                           GROUP BY a.id_cluster
		                           ORDER by a.nama_cluster");
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    
    //tap
    public function select_tap($id_sales)
    {
		$query = $this->db->query("SELECT 
		                               a.id_tap, a.nama_tap
		                           FROM bd_tap a, db_sales b
		                           WHERE a.id_tap = b.id_tap
		                                 AND b.id_sales = '".$this->db->escape_str($id_sales)."'
		                           GROUP BY a.id_tap
		                           ORDER by a.id_tap");
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    
    //sales
    public function select_sales($id_sales)
    {
		$query = $this->db->query("SELECT 
		                             id_sales, nama_sales
		                           FROM db_sales
		                           WHERE id_sales = '".$this->db->escape_str($id_sales)."'
		                                 AND id_jenis_sales = 'SSF'
		                           ORDER by nama_sales");
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    
    //outlet
    public function select_outlet($id_outlet)
    {
		$query = $this->db->query("SELECT 
                                      b.id_outlet, b.id_digipos, b.nama_outlet
		                           FROM fa_pjp a, db_sales db, eb_outlet b
		                           WHERE a.id_tempat = b.id_outlet
		                                 AND a.id_jenis_lokasi = 'OUT'
		                                 AND a.id_sales = db.id_sales
		                                 AND b.status = 'OPEN'
		                                 AND b.id_outlet = '".$this->db->escape_str($id_outlet)."'
		                          GROUP BY b.id_outlet");
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    
    
    
    //cari_outlet
    public function cari_outlet($params,$users_id,$role,$id_divisi)
    {
        if($role == '1')
        {
    		$query = $this->db->query("SELECT 
    		                                eb.id_outlet, eb.id_digipos, eb.nama_outlet, eb.no_rs, db.id_sales, db.nama_sales,
    		                                eb.longitude, eb.latitude, e.radius_clock_in
    		                           FROM eb_outlet eb, fa_pjp fa, db_sales db, cd_kelurahan c, cc_kecamatan d, cb_kabupaten e
    		                           WHERE eb.id_outlet = fa.id_tempat
    		                                 AND fa.id_sales = db.id_sales
    		                                 AND (
        		                                    (eb.id_digipos LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                    OR (eb.no_rs LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                    OR (eb.nama_outlet LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                 )
        		                            AND eb.status = 'OPEN'
		                                    AND eb.id_kelurahan = c.id_kelurahan
		                                    AND c.id_kecamatan = d.id_kecamatan
		                                    AND d.id_kabupaten = e.id_kabupaten
    		                           ORDER by eb.id_digipos, eb.nama_outlet");
        }
        if($role == '2')
        {
    		$query = $this->db->query("SELECT 
    		                                eb.id_outlet, eb.id_digipos, eb.nama_outlet, eb.no_rs, db.id_sales, db.nama_sales,
    		                                eb.longitude, eb.latitude, e.radius_clock_in
    		                           FROM eb_outlet eb, fa_pjp fa, db_sales db, bd_tap bd, bc_cluster bc, cd_kelurahan c, cc_kecamatan d, cb_kabupaten e
    		                           WHERE eb.id_outlet = fa.id_tempat
    		                                 AND fa.id_sales = db.id_sales
    		                                 AND db.id_tap = bd.id_tap
    		                                 AND bd.id_cluster = bc.id_cluster
    		                                 AND (
        		                                    (eb.id_digipos LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                    OR (eb.no_rs LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                    OR (eb.nama_outlet LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                 )
        		                             AND bc.id_branch = '".$this->db->escape_str($id_divisi)."'
        		                             AND eb.status = 'OPEN'
        		                             AND eb.id_kelurahan = c.id_kelurahan
		                                     AND c.id_kecamatan = d.id_kecamatan
		                                     AND d.id_kabupaten = e.id_kabupaten
    		                           ORDER by eb.id_digipos, eb.nama_outlet");
        }
        if($role == '3')
        {
    		$query = $this->db->query("SELECT 
    		                                eb.id_outlet, eb.id_digipos, eb.nama_outlet, eb.no_rs, db.id_sales, db.nama_sales,
    		                                eb.longitude, eb.latitude, e.radius_clock_in
    		                           FROM eb_outlet eb, fa_pjp fa, db_sales db, bd_tap bd, bc_cluster bc, cd_kelurahan c, cc_kecamatan d, cb_kabupaten e
    		                           WHERE eb.id_outlet = fa.id_tempat
    		                                 AND fa.id_sales = db.id_sales
    		                                 AND db.id_tap = bd.id_tap
    		                                 AND (
        		                                    (eb.id_digipos LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                    OR (eb.no_rs LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                    OR (eb.nama_outlet LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                 )
        		                             AND bd.id_cluster = '".$this->db->escape_str($id_divisi)."'
        		                             AND eb.status = 'OPEN'
        		                             AND eb.id_kelurahan = c.id_kelurahan
		                                     AND c.id_kecamatan = d.id_kecamatan
		                                     AND d.id_kabupaten = e.id_kabupaten
    		                           ORDER by eb.id_digipos, eb.nama_outlet");
        }
        if($role == '4')
        {
    		$query = $this->db->query("SELECT 
    		                                eb.id_outlet, eb.id_digipos, eb.nama_outlet, eb.no_rs, db.id_sales, db.nama_sales,
    		                                eb.longitude, eb.latitude, e.radius_clock_in
    		                           FROM eb_outlet eb, fa_pjp fa, db_sales db, bd_tap bd, bc_cluster bc, cd_kelurahan c, cc_kecamatan d, cb_kabupaten e
    		                           WHERE eb.id_outlet = fa.id_tempat
    		                                 AND fa.id_sales = db.id_sales
    		                                 AND db.id_tap = bd.id_tap
    		                                 AND (
        		                                    (eb.id_digipos LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                    OR (eb.no_rs LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                    OR (eb.nama_outlet LIKE '%".$this->db->escape_str($params['cari'])."%')
        		                                 )
        		                             AND bd.id_tap = '".$this->db->escape_str($id_divisi)."'
        		                             AND eb.status = 'OPEN'
        		                             AND eb.id_kelurahan = c.id_kelurahan
		                                     AND c.id_kecamatan = d.id_kecamatan
		                                     AND d.id_kabupaten = e.id_kabupaten
    		                           ORDER by eb.id_digipos, eb.nama_outlet");
        }
        
		return $query->result_array();
    }
  
}
