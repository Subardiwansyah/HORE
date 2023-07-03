<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BottommenupromotionModel extends CI_Model {
    
    //promotion list
    public function promotion_list($tglawal,$tglakhir,$page,$users_id,$role)
    {
        $total = 0;
        if($role == '5' || $role == '6' || $role == '8')
        {
            $query_1 = $this->db->query("SELECT 
                                            eb.nama_outlet, nc.tgl, eb.id_outlet, fa.id_jenis_lokasi
    		                             FROM nc_promotion_outlet nc, eb_outlet eb, fa_pjp fa
    		                             WHERE nc.id_outlet = eb.id_outlet
    		                                   AND eb.id_outlet = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'OUT'
    		                                   AND nc.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND nc.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND nc.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY nc.id_outlet, nc.tgl");
            $total = $query_1->num_rows();
            $limitpage = 50;
            $limitawal = ($page-1)*$limitpage;
            $query_2 = $this->db->query("SELECT 
                                            eb.nama_outlet, nc.tgl, eb.id_outlet, fa.id_jenis_lokasi
    		                             FROM nc_promotion_outlet nc, eb_outlet eb, fa_pjp fa
    		                             WHERE nc.id_outlet = eb.id_outlet
    		                                   AND eb.id_outlet = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'OUT'
    		                                   AND nc.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND nc.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND nc.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY nc.id_outlet, nc.tgl
    		                             ORDER BY nc.tgl DESC LIMIT ".$limitawal.",".$limitpage."");
        }
        if($role == '7')
        {
                $query_1 = $this->db->query("SELECT 
                                                ec.nama_sekolah as nama, nd.tgl as tanggal, ec.id_sekolah as id_tempat, fa.id_jenis_lokasi
        		                             FROM nd_promotion_sekolah nd, ec_sekolah ec, fa_pjp fa
        		                             WHERE nd.id_sekolah = ec.id_sekolah
        		                                   AND ec.id_sekolah = fa.id_tempat
        		                                   AND fa.id_jenis_lokasi = 'SEK'
        		                                   AND nd.created_by = '".$this->db->escape_str($users_id)."'
        		                                   AND nd.tgl >= '".$this->db->escape_str($tglawal)."'
        		                                   AND nd.tgl <= '".$this->db->escape_str($tglakhir)."'
        		                             GROUP BY nd.id_sekolah, nd.tgl
        		                             UNION
        		                             SELECT 
                                               ed.nama_universitas as nama, ne.tgl as tanggal, ed.id_universitas as id_tempat, fa.id_jenis_lokasi
        		                             FROM ne_promotion_kampus ne, ed_kampus ed, fa_pjp fa
        		                             WHERE ne.id_universitas = ed.id_universitas
        		                                   AND ed.id_universitas = fa.id_tempat
        		                                   AND fa.id_jenis_lokasi = 'KAM'
        		                                   AND ne.created_by = '".$this->db->escape_str($users_id)."'
        		                                   AND ne.tgl >= '".$this->db->escape_str($tglawal)."'
        		                                   AND ne.tgl <= '".$this->db->escape_str($tglakhir)."'
        		                             GROUP BY ne.id_universitas, ne.tgl
            		                         UNION       
            		                         SELECT 
                                               CONCAT(ee.nama_fakultas, ed.nama_universitas) as nama, nf.tgl as tanggal, ee.id_fakultas as id_tempat, fa.id_jenis_lokasi
        		                             FROM nf_promotion_fakultas nf, ed_kampus ed, ee_fakultas ee, fa_pjp fa
        		                             WHERE nf.id_fakultas = ee.id_fakultas
        		                                   AND ee.id_universitas = ed.id_universitas
        		                                   AND nf.id_fakultas = fa.id_tempat
        		                                   AND fa.id_jenis_lokasi = 'FAK'
        		                                   AND nf.created_by = '".$this->db->escape_str($users_id)."'
        		                                   AND nf.tgl >= '".$this->db->escape_str($tglawal)."'
        		                                   AND nf.tgl <= '".$this->db->escape_str($tglakhir)."'
        		                             GROUP BY nf.id_fakultas, nf.tgl
        		                             UNION
        		                             SELECT 
                                               ef.nama_poi as nama, nf.tgl as tanggal, ef.id_poi as id_tempat, fa.id_jenis_lokasi
        		                             FROM nf_promotion_poi nf, ef_poi ef, fa_pjp fa
        		                             WHERE nf.id_poi = ef.id_poi
        		                                   AND fa.id_jenis_lokasi = 'POI'
        		                                   AND nf.created_by = '".$this->db->escape_str($users_id)."'
        		                                   AND nf.tgl >= '".$this->db->escape_str($tglawal)."'
        		                                   AND nf.tgl <= '".$this->db->escape_str($tglakhir)."'
        		                             GROUP BY nf.id_poi, nf.tgl
        		                             ORDER BY tanggal");
            $total = $query_1->num_rows();
            $limitpage = 50;
            $limitawal = ($page-1)*$limitpage;
            $query_2 = $this->db->query("SELECT 
                                            ec.nama_sekolah as nama, nd.tgl as tanggal, ec.id_sekolah as id_tempat, fa.id_jenis_lokasi
    		                             FROM nd_promotion_sekolah nd, ec_sekolah ec, fa_pjp fa
    		                             WHERE nd.id_sekolah = ec.id_sekolah
    		                                   AND ec.id_sekolah = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'SEK'
    		                                   AND nd.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND nd.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND nd.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY nd.id_sekolah, nd.tgl
    		                             UNION
    		                             SELECT 
                                           ed.nama_universitas as nama, ne.tgl as tanggal, ed.id_universitas as id_tempat, fa.id_jenis_lokasi
    		                             FROM ne_promotion_kampus ne, ed_kampus ed, fa_pjp fa
    		                             WHERE ne.id_universitas = ed.id_universitas
    		                                   AND ed.id_universitas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'KAM'
    		                                   AND ne.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND ne.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND ne.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY ne.id_universitas, ne.tgl
        		                         UNION       
        		                         SELECT 
                                           CONCAT(ee.nama_fakultas, ed.nama_universitas) as nama, nf.tgl as tanggal, ee.id_fakultas as id_tempat, fa.id_jenis_lokasi
    		                             FROM nf_promotion_fakultas nf, ed_kampus ed, ee_fakultas ee, fa_pjp fa
    		                             WHERE nf.id_fakultas = ee.id_fakultas
    		                                   AND ee.id_universitas = ed.id_universitas
    		                                   AND nf.id_fakultas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'FAK'
    		                                   AND nf.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND nf.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND nf.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY nf.id_fakultas, nf.tgl
    		                             UNION
    		                             SELECT 
                                           ef.nama_poi as nama, nf.tgl as tanggal, ef.id_poi as id_tempat, fa.id_jenis_lokasi
    		                             FROM nf_promotion_poi nf, ef_poi ef, fa_pjp fa
    		                             WHERE nf.id_poi = ef.id_poi
    		                                   AND fa.id_jenis_lokasi = 'POI'
    		                                   AND nf.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND nf.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND nf.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY nf.id_poi, nf.tgl
    		                             ORDER BY tanggal DESC LIMIT ".$limitawal.",".$limitpage."");
        }
        $data = $query_2->result_array();
        return array('status' => 201, 'total' => $total, 'limit_per_halaman' => $limitpage, 'data' => $data);
    }
    

    //promotion list cari
    public function promotion_list_cari($params,$users_id,$role)
    {
        if($role == '5' || $role == '6' || $role == '8')
        {
            $query = $this->db->query("SELECT 
                                           eb.nama_outlet, nc.tgl, eb.id_outlet, fa.id_jenis_lokasi
    	                               FROM nc_promotion_outlet nc, eb_outlet eb, fa_pjp fa
    	                               WHERE nc.id_outlet = eb.id_outlet
    	                                     AND eb.id_outlet = fa.id_tempat
    	                                     AND fa.id_jenis_lokasi = 'OUT'
    		                                 AND nc.created_by = '".$this->db->escape_str($users_id)."'
    		                                 AND nc.tgl >= '".$this->db->escape_str($params['tglawal'])."'
    		                                 AND nc.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
    		                                 AND ((eb.id_digipos LIKE '%".$this->db->escape_str($params['cari'])."%')
    		                                       OR (eb.no_rs LIKE '%".$this->db->escape_str($params['cari'])."%')
    		                                       OR (eb.nama_outlet LIKE '%".$this->db->escape_str($params['cari'])."%'))
    		                          GROUP BY nc.id_outlet, nc.tgl
    		                          ORDER BY nc.tgl DESC");
        }
        if($role == '7')
        {
            $query = $this->db->query("SELECT 
                                            ec.nama_sekolah as nama, nd.tgl as tanggal, ec.id_sekolah as id_tempat, fa.id_jenis_lokasi
    		                             FROM nd_promotion_sekolah nd, ec_sekolah ec, fa_pjp fa
    		                             WHERE nd.id_sekolah = ec.id_sekolah
    		                                   AND ec.id_sekolah = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'SEK'
    		                                   AND nd.created_by = '".$this->db->escape_str($users_id)."'
		                                       AND nd.tgl >= '".$this->db->escape_str($params['tglawal'])."'
		                                       AND nd.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
		                                       AND ec.nama_sekolah LIKE '%".$this->db->escape_str($params['cari'])."%'
		                                 GROUP BY nd.id_sekolah, nd.tgl
		                                 UNION
		                                 SELECT 
                                           ed.nama_universitas as nama, ne.tgl as tanggal, ed.id_universitas as id_tempat, fa.id_jenis_lokasi
    		                             FROM ne_promotion_kampus ne, ed_kampus ed, fa_pjp fa
    		                             WHERE ne.id_universitas = ed.id_universitas
    		                                   AND ed.id_universitas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'KAM'
    		                                   AND ne.created_by = '".$this->db->escape_str($users_id)."'
		                                       AND ne.tgl >= '".$this->db->escape_str($params['tglawal'])."'
		                                       AND ne.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
		                                       AND ed.nama_universitas LIKE '%".$this->db->escape_str($params['cari'])."%'
    		                             GROUP BY ne.id_universitas, ne.tgl
    		                             UNION
    		                             SELECT 
                                           CONCAT(ee.nama_fakultas, ed.nama_universitas) as nama, nf.tgl as tanggal, ee.id_fakultas as id_tempat, fa.id_jenis_lokasi
    		                             FROM nf_promotion_fakultas nf, ed_kampus ed, ee_fakultas ee, fa_pjp fa
    		                             WHERE nf.id_fakultas = ee.id_fakultas
    		                                   AND ee.id_universitas = ed.id_universitas
    		                                   AND nf.id_fakultas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'FAK'
    		                                   AND nf.created_by = '".$this->db->escape_str($users_id)."'
		                                       AND nf.tgl >= '".$this->db->escape_str($params['tglawal'])."'
		                                       AND nf.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
		                                       AND ee.nama_fakultas LIKE '%".$this->db->escape_str($params['cari'])."%'
    		                             GROUP BY nf.id_fakultas, nf.tgl
    		                             UNION
    		                             SELECT 
                                           ef.nama_poi as nama, nf.tgl as tanggal, ef.id_poi as id_tempat, fa.id_jenis_lokasi
    		                             FROM nf_promotion_poi nf, ef_poi ef, fa_pjp fa
    		                             WHERE nf.id_poi = ef.id_poi
    		                                   AND fa.id_jenis_lokasi = 'POI'
    		                                   AND nf.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND nf.tgl >= '".$this->db->escape_str($params['tglawal'])."'
    		                                   AND nf.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
    		                                   AND ef.nama_poi LIKE '%".$this->db->escape_str($params['cari'])."%'
    		                             GROUP BY nf.id_poi, nf.tgl
    		                             ORDER BY tanggal DESC");
        }
        return $query->result_array();
    }
    
    //promotion detail
    public function promotion_detail($id, $id_jenis_lokasi, $tgl, $users_id, $role)
    {
        if($role == '5' || $role == '6' || $role == '8')
        {
            if($id_jenis_lokasi == 'OUT')
            {
                $query = $this->db->query("SELECT 
                                              nc.id_promotion,
        		                              na.nama_jenis,
        		                              nc.nama_program_lokal,
        		                              CONCAT('".base_url()."assets/promotion_video/',file_video) AS file_video
        		                             FROM nc_promotion_outlet nc, nb_promotion_jenis_weekly nb, na_promotion_jenis na
        		                             WHERE nc.id_jenis_weekly = nb.id_jenis_weekly
        		                                   AND nb.id_jenis = na.id_jenis
        		                                   AND nc.id_outlet = '".$this->db->escape_str($id)."'
        		                                   AND nc.tgl = '".$this->db->escape_str($tgl)."'
        		                                   AND nc.created_by = '".$this->db->escape_str($users_id)."'");
            }
        }
        if($role == '7')
        {
            if($id_jenis_lokasi == 'SEK')
            {
                $query = $this->db->query("SELECT 
                                               nd.id_promotion,
        		                               na.nama_jenis,
        		                               nd.nama_program_lokal,
        		                               CONCAT('".base_url()."assets/promotion_video/',file_video) AS file_video
        		                            FROM nd_promotion_sekolah nd, nb_promotion_jenis_weekly nb, na_promotion_jenis na
        		                            WHERE nd.id_jenis_weekly = nb.id_jenis_weekly
        		                                   AND nb.id_jenis = na.id_jenis
        		                                   AND nd.id_sekolah = '".$this->db->escape_str($id)."'
        		                                   AND nd.tgl = '".$this->db->escape_str($tgl)."'
        		                                   AND nd.created_by = '".$this->db->escape_str($users_id)."'");
            }elseif($id_jenis_lokasi == 'KAM'){
                $query = $this->db->query("SELECT 
                                               ne.id_promotion,
        		                               na.nama_jenis,
        		                               ne.nama_program_lokal,
        		                               CONCAT('".base_url()."assets/promotion_video/',file_video) AS file_video
        		                            FROM ne_promotion_kampus ne, nb_promotion_jenis_weekly nb, na_promotion_jenis na
        		                            WHERE ne.id_jenis_weekly = nb.id_jenis_weekly
        		                                   AND nb.id_jenis = na.id_jenis
        		                                   AND ne.id_universitas = '".$this->db->escape_str($id)."'
        		                                   AND ne.tgl = '".$this->db->escape_str($tgl)."'
        		                                   AND ne.created_by = '".$this->db->escape_str($users_id)."'");
            }elseif($id_jenis_lokasi == 'FAK'){
                $query = $this->db->query("SELECT 
                                               nf.id_promotion,
        		                               na.nama_jenis,
        		                               nf.nama_program_lokal,
        		                               CONCAT('".base_url()."assets/promotion_video/',file_video) AS file_video
        		                           FROM nf_promotion_fakultas nf, nb_promotion_jenis_weekly nb, na_promotion_jenis na
        		                           WHERE nf.id_jenis_weekly = nb.id_jenis_weekly
        		                                   AND nb.id_jenis = na.id_jenis
        		                                   AND nf.id_universitas = '".$this->db->escape_str($id)."'
        		                                   AND nf.tgl = '".$this->db->escape_str($tgl)."'
        		                                   AND nf.created_by = '".$this->db->escape_str($users_id)."'");
            }elseif($id_jenis_lokasi == 'POI'){
                $query = $this->db->query("SELECT 
                                               nf.id_promotion,
        		                               na.nama_jenis,
        		                               nf.nama_program_lokal,
        		                               CONCAT('".base_url()."assets/promotion_video/',file_video) AS file_video
        		                           FROM nf_promotion_poi nf, nb_promotion_jenis_weekly nb, na_promotion_jenis na
        		                           WHERE nf.id_jenis_weekly = nb.id_jenis_weekly
        		                                   AND nb.id_jenis = na.id_jenis
        		                                   AND nf.id_poi = '".$this->db->escape_str($id)."'
        		                                   AND nf.tgl = '".$this->db->escape_str($tgl)."'
        		                                   AND nf.created_by = '".$this->db->escape_str($users_id)."'");
            }
        }
		$data = $query->result_array();       
        return array('status' => 200, 'data' => $data);
    }
    
}
