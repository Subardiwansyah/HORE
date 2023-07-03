<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BottommenudistribusiModel extends CI_Model {
    
    //distribusi list
    public function distribusi_list($tglawal,$tglakhir,$page,$users_id)
    {
        $total = 0;
        $query_1 = $this->db->query("SELECT 
                                        jc.no_nota
		                             FROM jc_penjualan jc, fa_pjp fa
		                             WHERE jc.id_lokasi = fa.id_tempat
		                                   AND fa.id_sales = '".$this->db->escape_str($users_id)."'
		                                   AND jc.tgl_transaksi >= '".$this->db->escape_str($tglawal)."'
		                                   AND jc.tgl_transaksi <= '".$this->db->escape_str($tglakhir)."'
		                             GROUP BY jc.no_nota");
        $total = $query_1->num_rows();
        $limitpage = 50;
        $limitawal = ($page-1)*$limitpage;
        $query_2 = $this->db->query("SELECT 
                                        jc.no_nota, jc.tgl_transaksi, jc.nama_pembeli, jc.no_hp_pembeli
		                             FROM jc_penjualan jc, fa_pjp fa
		                             WHERE jc.id_lokasi = fa.id_tempat
		                                   AND fa.id_sales = '".$this->db->escape_str($users_id)."'
		                                   AND jc.tgl_transaksi >= '".$this->db->escape_str($tglawal)."'
		                                   AND jc.tgl_transaksi <= '".$this->db->escape_str($tglakhir)."'
		                             GROUP BY jc.no_nota
		                             ORDER BY jc.no_nota DESC LIMIT ".$limitawal.",".$limitpage."");
        $data = $query_2->result_array();
        return array('status' => 201, 'total' => $total, 'limit_per_halaman' => $limitpage, 'data' => $data);
    }
    

    //distribusi list cari
    public function distribusi_list_cari($params,$users_id)
    {
        $query = $this->db->query("SELECT 
                                        jc.no_nota, jc.tgl_transaksi, jc.nama_pembeli, jc.no_hp_pembeli
		                            FROM jc_penjualan jc, fa_pjp fa
		                            WHERE jc.id_lokasi = fa.id_tempat
		                                 AND fa.id_sales = '".$this->db->escape_str($users_id)."'
		                                 AND jc.tgl_transaksi >= '".$this->db->escape_str($params['tglawal'])."'
		                                 AND jc.tgl_transaksi <= '".$this->db->escape_str($params['tglakhir'])."'
		                                 AND ((jc.nama_pembeli LIKE '%".$this->db->escape_str($params['cari'])."%')
		                                       OR (jc.no_hp_pembeli LIKE '%".$this->db->escape_str($params['cari'])."%'))
		                           GROUP BY jc.no_nota
		                           ORDER BY jc.no_nota DESC");
        return $query->result_array();
    }
    
    //distribusi nota
    public function distribusi_nota($no_nota)
    {
        //data pembeli
		$query_1 = $this->db->query("SELECT 
		                               bc.mitra_ad,
		                               db.nama_sales,
	                                   jc.tgl_transaksi, 
		                               ea.nama_jenis_lokasi,
		                               jc.nama_pembeli,
		                               jc.no_hp_pembeli,
		                               jc.pembayaran
		                             FROM jc_penjualan jc
		                             INNER JOIN db_sales db ON db.id_sales = jc.id_sales
		                             INNER JOIN bd_tap bd ON db.id_tap = bd.id_tap
		                             INNER JOIN bc_cluster bc ON bd.id_cluster = bc.id_cluster
		                             INNER JOIN ea_jenis_lokasi ea ON jc.id_jenis_lokasi = ea.id_jenis_lokasi
		                             WHERE jc.no_nota = '".$this->db->escape_str($no_nota)."'");
        $data_pembeli = $query_1->result_array();
        //data produk
        $query_2 = $this->db->query("SELECT 
		                               gb.id_produk,
		                               gb.nama_produk,
		                               jd.harga_jual,
		                               COUNT(jd.serial_number) AS qty
		                             FROM jd_penjualan_detail jd
		                             INNER JOIN gb_produk gb ON jd.id_produk = gb.id_produk
		                             INNER JOIN jc_penjualan jc ON jd.no_nota = jc.no_nota
		                             WHERE jc.no_nota = '".$this->db->escape_str($no_nota)."'");
		$data_produk = $query_2->result_array();       
		//link aja
        $query_3 = $this->db->query("SELECT 
		                               jc.link_aja
		                             FROM jc_penjualan jc
		                             WHERE jc.no_nota = '".$this->db->escape_str($no_nota)."'");
		$data_link_aja = $query_3->result_array();     
        return array('status' => 200, 'data_pembeli' => $data_pembeli, 'data_produk' => $data_produk, 'data_link_aja' => $data_link_aja);
    }
    
}
