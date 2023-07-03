<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BottommenumerchandisingModel extends CI_Model {
    
    //merchandising list
    public function merchandising_list($tglawal,$tglakhir,$page,$users_id,$role)
    {
        $total = 0;
        if($role == '5' || $role == '6' || $role == '8')
        {
            $query_1 = $this->db->query("SELECT 
                                            eb.nama_outlet, mb.tgl, eb.id_outlet, fa.id_jenis_lokasi
    		                             FROM mb_merchandising_outlet mb, eb_outlet eb, fa_pjp fa
    		                             WHERE mb.id_outlet = eb.id_outlet
    		                                   AND eb.id_outlet = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'OUT'
    		                                   AND mb.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND mb.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND mb.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY mb.id_outlet, mb.tgl");
            $total = $query_1->num_rows();
            $limitpage = 50;
            $limitawal = ($page-1)*$limitpage;
            $query_2 = $this->db->query("SELECT 
                                            eb.nama_outlet, mb.tgl, eb.id_outlet, fa.id_jenis_lokasi
    		                             FROM mb_merchandising_outlet mb, eb_outlet eb, fa_pjp fa
    		                             WHERE mb.id_outlet = eb.id_outlet
    		                                   AND eb.id_outlet = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'OUT'
    		                                   AND mb.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND mb.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND mb.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY mb.id_outlet, mb.tgl
    		                             ORDER BY mb.tgl DESC LIMIT ".$limitawal.",".$limitpage."");
        }
        if($role == '7')
        {
            $query_1 = $this->db->query("SELECT 
                                            ec.nama_sekolah as nama, mc.tgl as tanggal, ec.id_sekolah as id_tempat, fa.id_jenis_lokasi
    		                             FROM mc_merchandising_sekolah mc, ec_sekolah ec, fa_pjp fa
    		                             WHERE mc.id_sekolah = ec.id_sekolah
    		                                   AND ec.id_sekolah = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'SEK'
    		                                   AND mc.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND mc.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND mc.tgl <= '".$this->db->escape_str($tglakhir)."'
		                             GROUP BY mc.id_sekolah, mc.tgl
		                             UNION
		                             SELECT 
                                           ed.nama_universitas as nama, md.tgl as tanggal, ed.id_universitas as id_tempat, fa.id_jenis_lokasi
    		                             FROM md_merchandising_kampus md, ed_kampus ed, fa_pjp fa
    		                             WHERE md.id_universitas = ed.id_universitas
    		                                   AND ed.id_universitas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'KAM'
    		                                   AND md.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND md.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND md.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY md.id_universitas, md.tgl
    		                        UNION
    		                        SELECT 
                                           CONCAT(ee.nama_fakultas, ed.nama_universitas) as nama, me.tgl as tanggal, ee.id_fakultas as id_tempat, fa.id_jenis_lokasi
    		                             FROM me_merchandising_fakultas me, ed_kampus ed, ee_fakultas ee, fa_pjp fa
    		                             WHERE me.id_fakultas = ee.id_fakultas
    		                                   AND ee.id_universitas = ed.id_universitas
    		                                   AND me.id_fakultas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'FAK'
    		                                   AND me.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND me.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND me.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY me.id_fakultas, me.tgl");
            $total = $query_1->num_rows();
            $limitpage = 50;
            $limitawal = ($page-1)*$limitpage;
            $query_2 = $this->db->query("SELECT 
                                            ec.nama_sekolah as nama, mc.tgl as tanggal, ec.id_sekolah as id_tempat, fa.id_jenis_lokasi
    		                             FROM mc_merchandising_sekolah mc, ec_sekolah ec, fa_pjp fa
    		                             WHERE mc.id_sekolah = ec.id_sekolah
    		                                   AND ec.id_sekolah = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'SEK'
    		                                   AND mc.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND mc.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND mc.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY mc.id_sekolah, mc.tgl
    		                             UNION
    		                             SELECT 
                                           ed.nama_universitas as nama, md.tgl as tanggal, ed.id_universitas as id_tempat, fa.id_jenis_lokasi
    		                             FROM md_merchandising_kampus md, ed_kampus ed, fa_pjp fa
    		                             WHERE md.id_universitas = ed.id_universitas
    		                                   AND ed.id_universitas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'KAM'
    		                                   AND md.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND md.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND md.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY md.id_universitas, md.tgl
    		                             UNION
    		                             SELECT 
                                           CONCAT(ee.nama_fakultas, ed.nama_universitas) as nama, me.tgl as tanggal, ee.id_fakultas as id_tempat, fa.id_jenis_lokasi
    		                             FROM me_merchandising_fakultas me, ed_kampus ed, ee_fakultas ee, fa_pjp fa
    		                             WHERE me.id_fakultas = ee.id_fakultas
    		                                   AND ee.id_universitas = ed.id_universitas
    		                                   AND me.id_fakultas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'FAK'
    		                                   AND me.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND me.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND me.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY me.id_fakultas, me.tgl
    		                             ORDER BY tanggal DESC LIMIT ".$limitawal.",".$limitpage."");
        }
        $data = $query_2->result_array();
        return array('status' => 201, 'total' => $total, 'limit_per_halaman' => $limitpage, 'data' => $data);
    }
    

    //merchandising list cari
    public function merchandising_list_cari($params,$users_id,$role)
    {
        if($role == '5' || $role == '6' || $role == '8')
        {
            $query = $this->db->query("SELECT 
                                           eb.nama_outlet, mb.tgl, eb.id_outlet, fa.id_jenis_lokasi
    	                               FROM mb_merchandising_outlet mb, eb_outlet eb, fa_pjp fa
    	                               WHERE mb.id_outlet = eb.id_outlet
    	                                     AND eb.id_outlet = fa.id_tempat
    	                                     AND fa.id_jenis_lokasi = 'OUT'
    		                                 AND mb.created_by = '".$this->db->escape_str($users_id)."'
    		                                 AND mb.tgl >= '".$this->db->escape_str($params['tglawal'])."'
    		                                 AND mb.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
    		                                 AND ((eb.id_digipos LIKE '%".$this->db->escape_str($params['cari'])."%')
    		                                       OR (eb.no_rs LIKE '%".$this->db->escape_str($params['cari'])."%')
    		                                       OR (eb.nama_outlet LIKE '%".$this->db->escape_str($params['cari'])."%'))
    		                          GROUP BY mb.id_outlet, mb.tgl
    		                          ORDER BY mb.tgl DESC");
        }
        if($role == '7')
        {
            $query = $this->db->query("SELECT 
                                            ec.nama_sekolah as nama, mc.tgl as tanggal, ec.id_sekolah as id_tempat, fa.id_jenis_lokasi
    		                           FROM mc_merchandising_sekolah mc, ec_sekolah ec, fa_pjp fa
    		                           WHERE mc.id_sekolah = ec.id_sekolah
    		                                 AND ec.id_sekolah = fa.id_tempat
    		                                 AND fa.id_jenis_lokasi = 'SEK'
    		                                 AND mc.created_by = '".$this->db->escape_str($users_id)."'
    		                                 AND mc.tgl >= '".$this->db->escape_str($params['tglawal'])."'
    		                                 AND mc.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
    		                                 AND ec.nama_sekolah LIKE '%".$this->db->escape_str($params['cari'])."%'
    		                           GROUP BY mc.id_sekolah, mc.tgl
    		                           UNION
    		                           SELECT 
                                           ed.nama_universitas as nama, md.tgl as tanggal, ed.id_universitas as id_tempat, fa.id_jenis_lokasi
    		                           FROM md_merchandising_kampus md, ed_kampus ed, fa_pjp fa
    		                           WHERE md.id_universitas = ed.id_universitas
    		                                 AND ed.id_universitas = fa.id_tempat
    		                                 AND fa.id_jenis_lokasi = 'KAM'
    		                                 AND md.created_by = '".$this->db->escape_str($users_id)."'
    		                                 AND md.tgl >= '".$this->db->escape_str($params['tglawal'])."'
    		                                 AND md.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
    		                                 AND ed.nama_universitas LIKE '%".$this->db->escape_str($params['cari'])."%'
    		                           GROUP BY md.id_universitas, md.tgl
    		                           UNION
    		                           SELECT 
                                           CONCAT(ee.nama_fakultas, ed.nama_universitas) as nama, me.tgl as tanggal, ee.id_fakultas as id_tempat, fa.id_jenis_lokasi
    		                           FROM me_merchandising_fakultas me, ed_kampus ed, ee_fakultas ee, fa_pjp fa
    		                           WHERE me.id_fakultas = ee.id_fakultas
    		                                 AND ee.id_universitas = ed.id_universitas
    		                                 AND me.id_fakultas = fa.id_tempat
    		                                 AND fa.id_jenis_lokasi = 'FAK'
    		                                 AND me.created_by = '".$this->db->escape_str($users_id)."'
    		                                 AND me.tgl >= '".$this->db->escape_str($params['tglawal'])."'
    		                                 AND me.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
    		                                 AND ee.nama_fakultas LIKE '%".$this->db->escape_str($params['cari'])."%'
    		                           GROUP BY me.id_fakultas, me.tgl
    		                           ORDER BY tanggal DESC");
        }
        return $query->result_array();
    }
    
    //merchandising detail
    public function merchandising_detail($id, $id_jenis_lokasi, $tgl, $users_id, $role)
    {
        if($role == '5' || $role == '6' || $role == '8')
        {
            if($id_jenis_lokasi == 'OUT')
            {
                $query = $this->db->query("SELECT 
                                              id_jenis_share,
        		                              telkomsel,
        		                              isat,
        		                              xl,
        		                              tri,
        		                              smartfren,
        		                              axis,
        		                              other,
        		                              case when LENGTH(foto_1) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_1 ) else null end  AS foto_1,
        		                              case when LENGTH(foto_2) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_2) else null end AS foto_2,
        		                              case when LENGTH(foto_3) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_3) else null end AS foto_3
        		                             FROM mb_merchandising_outlet
        		                             WHERE id_outlet = '".$this->db->escape_str($id)."'
        		                                   AND tgl = '".$this->db->escape_str($tgl)."'
        		                                   AND created_by = '".$this->db->escape_str($users_id)."'");
            }
        }
        if($role == '7')
        {
            if($id_jenis_lokasi == 'SEK')
            {
               $query = $this->db->query("SELECT 
                                              id_jenis_share,
        		                              telkomsel,
        		                              isat,
        		                              xl,
        		                              tri,
        		                              smartfren,
        		                              axis,
        		                              other,
        		                              case when LENGTH(foto_1) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_1 ) else null end  AS foto_1,
        		                              case when LENGTH(foto_2) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_2) else null end AS foto_2,
        		                              case when LENGTH(foto_3) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_3) else null end AS foto_3
        		                          FROM mc_merchandising_sekolah
        		                          WHERE id_sekolah = '".$this->db->escape_str($id)."'
        		                                AND tgl = '".$this->db->escape_str($tgl)."'
        		                                AND created_by = '".$this->db->escape_str($users_id)."'");
            }elseif($id_jenis_lokasi == 'KAM'){
                $query = $this->db->query("SELECT 
                                              id_jenis_share,
        		                              telkomsel,
        		                              isat,
        		                              xl,
        		                              tri,
        		                              smartfren,
        		                              axis,
        		                              other,
        		                              case when LENGTH(foto_1) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_1 ) else null end  AS foto_1,
        		                              case when LENGTH(foto_2) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_2) else null end AS foto_2,
        		                              case when LENGTH(foto_3) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_3) else null end AS foto_3
        		                           FROM md_merchandising_kampus
        		                           WHERE id_universitas = '".$this->db->escape_str($id)."'
        		                                 AND tgl = '".$this->db->escape_str($tgl)."'
        		                                 AND created_by = '".$this->db->escape_str($users_id)."'");
            }elseif($id_jenis_lokasi == 'FAK'){
                $query = $this->db->query("SELECT 
                                              id_jenis_share,
        		                              telkomsel,
        		                              isat,
        		                              xl,
        		                              tri,
        		                              smartfren,
        		                              axis,
        		                              other,
        		                              case when LENGTH(foto_1) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_1 ) else null end  AS foto_1,
        		                              case when LENGTH(foto_2) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_2) else null end AS foto_2,
        		                              case when LENGTH(foto_3) > 0 then CONCAT('".base_url()."assets/merchandising_foto/',foto_3) else null end AS foto_3
        		                           FROM me_merchandising_fakultas
        		                           WHERE id_fakultas = '".$this->db->escape_str($id)."'
        		                                 AND tgl = '".$this->db->escape_str($tgl)."'
        		                                 AND created_by = '".$this->db->escape_str($users_id)."'");
            }
        }
		$data = $query->result_array();       
        return array('status' => 200, 'data' => $data);
    }
    
}
