<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BottommenumarketauditModel extends CI_Model {
    
    //marketaudit list
    public function marketaudit_list($tglawal,$tglakhir,$page,$users_id,$role)
    {
        $total = 0;
        if($role == '5' || $role == '6' || $role == '8')
        {
            $query_1 = $this->db->query("SELECT 
                                            eb.nama_outlet, ob.tgl, ob.id_outlet
    		                             FROM ob_market_audit_outlet ob, eb_outlet eb, fa_pjp fa
    		                             WHERE ob.id_outlet = eb.id_outlet
    		                                   AND eb.id_outlet = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'OUT'
    		                                   AND ob.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND ob.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND ob.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY ob.id_outlet, ob.tgl");
            $total = $query_1->num_rows();
            $limitpage = 50;
            $limitawal = ($page-1)*$limitpage;
            $query_2 = $this->db->query("SELECT 
                                            eb.nama_outlet, ob.tgl, ob.id_outlet
    		                             FROM ob_market_audit_outlet ob, eb_outlet eb, fa_pjp fa
    		                             WHERE ob.id_outlet = eb.id_outlet
    		                                   AND eb.id_outlet = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'OUT'
    		                                   AND ob.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND ob.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND ob.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY ob.id_outlet, ob.tgl
    		                             ORDER BY ob.tgl DESC LIMIT ".$limitawal.",".$limitpage."");
        }
        if($role == '7')
        {
            $query_1 = $this->db->query("SELECT 
                                            ec.nama_sekolah AS nama, oj.tgl, oj.id_sekolah AS id, fa.id_jenis_lokasi
    		                             FROM oj_market_audit_res_sekolah oj, ec_sekolah ec, fa_pjp fa
    		                             WHERE oj.id_sekolah = ec.id_sekolah
    		                                   AND ec.id_sekolah = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'SEK'
    		                                   AND oj.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND oj.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND oj.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY oj.id_sekolah, oj.tgl
    		                             UNION
    		                             SELECT 
                                            ee.nama_fakultas AS nama, ok.tgl, ok.id_fakultas AS id, fa.id_jenis_lokasi
    		                             FROM ok_market_audit_res_fakultas ok, ee_fakultas ee, fa_pjp fa
    		                             WHERE ok.id_fakultas = ee.id_fakultas
    		                                   AND ee.id_fakultas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'FAK'
    		                                   AND ok.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND ok.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND ok.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY ok.id_fakultas, ok.tgl
    		                             UNION
    		                             SELECT 
                                            ed.nama_universitas AS nama, ol.tgl, ol.id_universitas AS id, fa.id_jenis_lokasi
    		                             FROM ol_market_audit_res_kampus ol, ed_kampus ed, fa_pjp fa
    		                             WHERE ol.id_universitas = ed.id_universitas
    		                                   AND ed.id_universitas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'KAM'
    		                                   AND ol.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND ol.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND ol.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY ol.id_universitas, ol.tgl");
            $total = $query_1->num_rows();
            $limitpage = 50;
            $limitawal = ($page-1)*$limitpage;
            $query_2 = $this->db->query("SELECT 
                                            ec.nama_sekolah AS nama, oj.tgl, oj.id_sekolah AS id, fa.id_jenis_lokasi
    		                             FROM oj_market_audit_res_sekolah oj, ec_sekolah ec, fa_pjp fa
    		                             WHERE oj.id_sekolah = ec.id_sekolah
    		                                   AND ec.id_sekolah = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'SEK'
    		                                   AND oj.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND oj.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND oj.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY oj.id_sekolah, oj.tgl
    		                             UNION
    		                             SELECT 
                                            ee.nama_fakultas AS nama, ok.tgl, ok.id_fakultas AS id, fa.id_jenis_lokasi
    		                             FROM ok_market_audit_res_fakultas ok, ee_fakultas ee, fa_pjp fa
    		                             WHERE ok.id_fakultas = ee.id_fakultas
    		                                   AND ee.id_fakultas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'FAK'
    		                                   AND ok.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND ok.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND ok.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY ok.id_fakultas, ok.tgl
    		                             UNION
    		                             SELECT 
                                            ed.nama_universitas AS nama, ol.tgl, ol.id_universitas AS id, fa.id_jenis_lokasi
    		                             FROM ol_market_audit_res_kampus ol, ed_kampus ed, fa_pjp fa
    		                             WHERE ol.id_universitas = ed.id_universitas
    		                                   AND ed.id_universitas = fa.id_tempat
    		                                   AND fa.id_jenis_lokasi = 'KAM'
    		                                   AND ol.created_by = '".$this->db->escape_str($users_id)."'
    		                                   AND ol.tgl >= '".$this->db->escape_str($tglawal)."'
    		                                   AND ol.tgl <= '".$this->db->escape_str($tglakhir)."'
    		                             GROUP BY ol.id_universitas, ol.tgl
    		                             ORDER BY tgl DESC LIMIT ".$limitawal.",".$limitpage."");
        }
        $data = $query_2->result_array();
        return array('status' => 201, 'total' => $total, 'limit_per_halaman' => $limitpage, 'data' => $data);
    }
    

    //marketaudit list cari
    public function marketaudit_list_cari($params,$users_id,$role)
    {
        if($role == '5' || $role == '6' || $role == '8')
        {
            $query = $this->db->query("SELECT 
                                            eb.nama_outlet, ob.tgl, ob.id_outlet
    		                           FROM ob_market_audit_outlet ob, eb_outlet eb, fa_pjp fa
    		                           WHERE ob.id_outlet = eb.id_outlet
    		                                 AND eb.id_outlet = fa.id_tempat
    		                                 AND fa.id_jenis_lokasi = 'OUT'
    		                                 AND ob.created_by = '".$this->db->escape_str($users_id)."'
    		                                 AND ob.tgl >= '".$this->db->escape_str($params['tglawal'])."'
    		                                 AND ob.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
    		                                 AND ((eb.id_digipos LIKE '%".$this->db->escape_str($params['cari'])."%')
    		                                       OR (eb.no_rs LIKE '%".$this->db->escape_str($params['cari'])."%')
    		                                       OR (eb.nama_outlet LIKE '%".$this->db->escape_str($params['cari'])."%'))
    		                          GROUP BY ob.id_outlet, ob.tgl
    		                          ORDER BY ob.tgl DESC");
        }
        if($role == '7')
        {
            $query = $this->db->query("SELECT 
                                            ec.nama_sekolah AS nama, oj.tgl, oj.id_sekolah AS id, fa.id_jenis_lokasi
		                             FROM oj_market_audit_res_sekolah oj, ec_sekolah ec, fa_pjp fa
		                             WHERE oj.id_sekolah = ec.id_sekolah
		                                   AND ec.id_sekolah = fa.id_tempat
		                                   AND fa.id_jenis_lokasi = 'SEK'
		                                   AND oj.created_by = '".$this->db->escape_str($users_id)."'
		                                   AND oj.tgl >= '".$this->db->escape_str($params['tglawal'])."'
		                                   AND oj.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
		                                   AND ec.nama_sekolah LIKE '%".$this->db->escape_str($params['cari'])."%'
		                             GROUP BY oj.id_sekolah, oj.tgl
		                             UNION
		                             SELECT 
                                        ee.nama_fakultas AS nama, ok.tgl, ok.id_fakultas AS id, fa.id_jenis_lokasi
		                             FROM ok_market_audit_res_fakultas ok, ee_fakultas ee, fa_pjp fa
		                             WHERE ok.id_fakultas = ee.id_fakultas
		                                   AND ee.id_fakultas = fa.id_tempat
		                                   AND fa.id_jenis_lokasi = 'FAK'
		                                   AND ok.created_by = '".$this->db->escape_str($users_id)."'
		                                   AND ok.tgl >= '".$this->db->escape_str($params['tglawal'])."'
		                                   AND ok.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
		                                   AND ee.nama_fakultas LIKE '%".$this->db->escape_str($params['cari'])."%'
		                             GROUP BY ok.id_fakultas, ok.tgl
		                             UNION
		                             SELECT 
                                        ed.nama_universitas AS nama, ol.tgl, ol.id_universitas AS id, fa.id_jenis_lokasi
		                             FROM ol_market_audit_res_kampus ol, ed_kampus ed, fa_pjp fa
		                             WHERE ol.id_universitas = ed.id_universitas
		                                   AND ed.id_universitas = fa.id_tempat
		                                   AND fa.id_jenis_lokasi = 'KAM'
		                                   AND ol.created_by = '".$this->db->escape_str($users_id)."'
		                                   AND ol.tgl >= '".$this->db->escape_str($params['tglawal'])."'
		                                   AND ol.tgl <= '".$this->db->escape_str($params['tglakhir'])."'
		                                   AND ed.nama_universitas LIKE '%".$this->db->escape_str($params['cari'])."%'
		                             GROUP BY ol.id_universitas, ol.tgl
    		                         ORDER BY tgl DESC");
        }
        return $query->result_array();
    }
    
    //marketaudit detail
    public function marketaudit_detail($id_jenis_share,$id_outlet,$tgl, $users_id, $role)
    {
        if($role == '5' || $role == '6' || $role == '8')
        {
            if($id_jenis_share == 'BELANJA')
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
        		                              CONCAT('".base_url()."assets/marketaudit_foto/',foto_belanja) AS foto_belanja
        		                             FROM ob_market_audit_outlet
        		                             WHERE id_outlet = '".$this->db->escape_str($id_outlet)."'
        		                                   AND tgl = '".$this->db->escape_str($tgl)."'
        		                                   AND created_by = '".$this->db->escape_str($users_id)."'
        		                                   AND id_jenis_share = 'BELANJA'");
            }
            if($id_jenis_share == 'SALES_BROADBAND')
            {
                $query = $this->db->query("SELECT 
                                              id_jenis_share,
        		                              telkomsel_ld,
        		                              telkomsel_md,
        		                              telkomsel_hd,
        		                              isat_ld,
        		                              isat_md,
        		                              isat_hd,
        		                              xl_ld,
        		                              xl_md,
        		                              xl_hd,
        		                              tri_ld,
        		                              tri_md,
        		                              tri_hd,
        		                              smartfren_ld,
        		                              smartfren_md,
        		                              smartfren_hd,
        		                              axis_ld,
        		                              axis_md,
        		                              axis_hd,
        		                              other_ld,
        		                              other_md,
        		                              other_hd
        		                             FROM ob_market_audit_outlet
        		                             WHERE id_outlet = '".$this->db->escape_str($id_outlet)."'
        		                                   AND tgl = '".$this->db->escape_str($tgl)."'
        		                                   AND created_by = '".$this->db->escape_str($users_id)."'
        		                                   AND id_jenis_share = 'SALES_BROADBAND'");
            }
            if($id_jenis_share == 'VOUCHER_FISIK')
            {
                $query = $this->db->query("SELECT 
                                              id_jenis_share,
        		                              telkomsel_ld,
        		                              telkomsel_md,
        		                              telkomsel_hd,
        		                              isat_ld,
        		                              isat_md,
        		                              isat_hd,
        		                              xl_ld,
        		                              xl_md,
        		                              xl_hd,
        		                              tri_ld,
        		                              tri_md,
        		                              tri_hd,
        		                              smartfren_ld,
        		                              smartfren_md,
        		                              smartfren_hd,
        		                              axis_ld,
        		                              axis_md,
        		                              axis_hd,
        		                              other_ld,
        		                              other_md,
        		                              other_hd
        		                             FROM ob_market_audit_outlet
        		                             WHERE id_outlet = '".$this->db->escape_str($id_outlet)."'
        		                                   AND tgl = '".$this->db->escape_str($tgl)."'
        		                                   AND created_by = '".$this->db->escape_str($users_id)."'
        		                                   AND id_jenis_share = 'VOUCHER_FISIK'");
            }
        }
		$data = $query->result_array();       
        return array('status' => 200, 'data' => $data);
    }
    
    
    //marketaudit detail quisioner
    public function marketaudit_detail_quisioner($id_jenis_lokasi,$id,$tgl, $users_id, $role)
    {
        if($role == '7')
        {
            if($id_jenis_lokasi == 'SEK')
            {
                $query = $this->db->query("SELECT 
                                              a.nama_pelanggan,
                                              b.provider AS op_telepon,
                                              a.msisdn_telepon,
                                              c.provider AS op_internet,
                                              a.msisdn_internet,
                                              d.provider AS op_digital,
                                              a.msisdn_digital,
                                              e.jenis,
                                              a.kuota_per_bulan,
                                              a.pulsa_per_bulan
        		                           FROM oj_market_audit_res_sekolah a
        		                           INNER JOIN ou_master_provider b ON a.op_telepon = b.id
        		                           INNER JOIN ou_master_provider c ON a.op_internet = c.id
        		                           INNER JOIN ou_master_provider d ON a.op_digital = d.id
        		                           INNER JOIN ot_master_frekuensi_beli_paket e ON a.frekuensi_beli_paket = e.id
        		                           WHERE id_sekolah = '".$this->db->escape_str($id)."'
        		                                 AND tgl = '".$this->db->escape_str($tgl)."'
        		                                 AND created_by = '".$this->db->escape_str($users_id)."'");
            }
            if($id_jenis_lokasi == 'FAK')
            {
                $query = $this->db->query("SELECT 
                                              a.nama_pelanggan,
                                              b.provider AS op_telepon,
                                              a.msisdn_telepon,
                                              c.provider AS op_internet,
                                              a.msisdn_internet,
                                              d.provider AS op_digital,
                                              a.msisdn_digital,
                                              e.jenis,
                                              a.kuota_per_bulan,
                                              a.pulsa_per_bulan
        		                           FROM ok_market_audit_res_fakultas a
        		                           INNER JOIN ou_master_provider b ON a.op_telepon = b.id
        		                           INNER JOIN ou_master_provider c ON a.op_internet = c.id
        		                           INNER JOIN ou_master_provider d ON a.op_digital = d.id
        		                           INNER JOIN ot_master_frekuensi_beli_paket e ON a.frekuensi_beli_paket = e.id
        		                           WHERE id_fakultas = '".$this->db->escape_str($id)."'
        		                                 AND tgl = '".$this->db->escape_str($tgl)."'
        		                                 AND created_by = '".$this->db->escape_str($users_id)."'");
            }
            if($id_jenis_lokasi == 'KAM')
            {
                $query = $this->db->query("SELECT 
                                              a.nama_pelanggan,
                                              b.provider AS op_telepon,
                                              a.msisdn_telepon,
                                              c.provider AS op_internet,
                                              a.msisdn_internet,
                                              d.provider AS op_digital,
                                              a.msisdn_digital,
                                              e.jenis,
                                              a.kuota_per_bulan,
                                              a.pulsa_per_bulan
        		                           FROM ol_market_audit_res_kampus a
        		                           INNER JOIN ou_master_provider b ON a.op_telepon = b.id
        		                           INNER JOIN ou_master_provider c ON a.op_internet = c.id
        		                           INNER JOIN ou_master_provider d ON a.op_digital = d.id
        		                           INNER JOIN ot_master_frekuensi_beli_paket e ON a.frekuensi_beli_paket = e.id
        		                           WHERE id_universitas = '".$this->db->escape_str($id)."'
        		                                 AND tgl = '".$this->db->escape_str($tgl)."'
        		                                 AND created_by = '".$this->db->escape_str($users_id)."'");
            }
        }
		$data = $query->result_array();       
        return array('status' => 200, 'data' => $data);
    }
    
}
