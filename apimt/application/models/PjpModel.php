<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PjpModel extends CI_Model {
    
    //pjp jumlah
    public function pjp_jumlah($id_sales)
    {
        $query = $this->db->query("SELECT 
                                     COUNT(id_pjp) AS jumlah_pjp
		                           FROM fa_pjp
		                           WHERE id_sales = '".$this->db->escape_str($id_sales)."'");
        $data = $query->result_array();
        return array('status' => 200, 'id_sales' => $id_sales,'data' => $data);
    }
    
    //pjp daftar
    public function pjp_daftar($id_sales)
    {
        $query = $this->db->query("SELECT 
                                      b.id_outlet, b.id_digipos, b.nama_outlet, b.no_rs, db.id_sales, db.nama_sales,
                                      b.longitude, b.latitude, e.radius_clock_in
		                           FROM fa_pjp a, db_sales db, eb_outlet b, cd_kelurahan c, cc_kecamatan d, cb_kabupaten e
		                           WHERE a.id_tempat = b.id_outlet
		                                 AND a.id_jenis_lokasi = 'OUT'
		                                 AND a.id_sales = db.id_sales
		                                 AND b.id_kelurahan = c.id_kelurahan
		                                 AND c.id_kecamatan = d.id_kecamatan
		                                 AND d.id_kabupaten = e.id_kabupaten
		                                 AND b.status = 'OPEN'
		                                 AND a.id_sales = '".$this->db->escape_str($id_sales)."'
		                          GROUP BY b.id_outlet");
        $data = $query->result_array();
        //cek sf
        $sudah_nilai = '0';
        $query_1 = $this->db->query("SELECT id_sales
		                             FROM za_mt_penilaian_sf
		                             WHERE tanggal = '".$this->db->escape_str(date('Y-m-d'))."'
		                                 AND id_sales = '".$this->db->escape_str($id_sales)."'
		                           GROUP BY id_sales");
		if($query_1->num_rows() > 0)
		{
		    $sudah_nilai = '1';
		}
		
		return array('ket' => '0:belum, 1:sudah', 'status' => $sudah_nilai, 'id_sales' => $id_sales, 'data' => $data);
    }
    
}
