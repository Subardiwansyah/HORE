<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClockindistribusiModel extends CI_Model {

    //penjualan daftar produk
    public function penjualan_daftar_produk($users_id)
    {
		$query = $this->db->query("SELECT 
		                              ia.id_produk,
		                              gb.nama_produk,
		                              ia.harga_jual,
		                              ia.harga_modal,
                                      COUNT(CASE WHEN ia.status_penjualan = 'BELUM TERJUAL' THEN 1 ELSE null END ) AS jumlah_stock
                                   FROM ia_distribusi_perdana ia
                                   INNER JOIN gb_produk gb ON ia.id_produk = gb.id_produk
                                   WHERE ia.id_sales = '".$this->db->escape_str($users_id)."'
                                         AND ia.status_distribusi = 'AVAILABLE'
                                         AND ia.status_penjualan = 'BELUM TERJUAL'
                                   GROUP BY ia.id_produk
								   ORDER BY gb.lastmodified");
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    
    //penjualan daftar sn
    public function penjualan_daftar_sn($params,$users_id)
    {
        if(empty($params['sn_akhir']))
        {
    		$query = $this->db->query("SELECT 
                                          id_produk,
    		                              harga_jual,
    		                              harga_modal,
                                          serial_number
                                       FROM ia_distribusi_perdana
                                       WHERE id_sales = '".$this->db->escape_str($users_id)."'
                                             AND id_produk = '".$this->db->escape_str($params['id_produk'])."'
                                             AND status_distribusi = 'AVAILABLE'
                                             AND status_penjualan = 'BELUM TERJUAL'
                                             AND serial_number = '".$this->db->escape_str($params['sn_awal'])."'");
        }else{
            $query = $this->db->query("SELECT 
                                          id_produk,
    		                              harga_jual,
    		                              harga_modal,
                                          serial_number
                                       FROM ia_distribusi_perdana
                                       WHERE id_sales = '".$this->db->escape_str($users_id)."'
                                             AND id_produk = '".$this->db->escape_str($params['id_produk'])."'
                                             AND status_distribusi = 'AVAILABLE'
                                             AND status_penjualan = 'BELUM TERJUAL'
                                             AND serial_number >= '".$this->db->escape_str($params['sn_awal'])."'
                                             AND serial_number <= '".$this->db->escape_str($params['sn_akhir'])."'");
        }
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    
    //penjualan daftar sn all
    public function penjualan_daftar_sn_all($params,$users_id)
    {
		$query = $this->db->query("SELECT 
                                      id_produk,
		                              harga_jual,
		                              harga_modal,
                                      serial_number
                                   FROM ia_distribusi_perdana
                                   WHERE id_sales = '".$this->db->escape_str($users_id)."'
                                         AND id_produk = '".$this->db->escape_str($params['id_produk'])."'
                                         AND status_distribusi = 'AVAILABLE'
                                         AND status_penjualan = 'BELUM TERJUAL'");
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    
    //penjualan limit link aja
    public function penjualan_limit_linkaja($users_id)
    {
        $limit_link_aja = 0;
        $link_aja = 0;
        $sisa_link_aja = 0;
		$query_1 = $this->db->query("SELECT limit_link_aja
		                             FROM db_sales
		                             WHERE id_sales = '".$this->db->escape_str($users_id)."'");
        foreach($query_1->result_array() as $row_1)
        {
            $limit_link_aja = $row_1['limit_link_aja'];
        }
        $query_2 = $this->db->query("SELECT 
                                        SUM(link_aja) AS link_aja
		                             FROM jc_penjualan
		                             WHERE id_sales = '".$this->db->escape_str($users_id)."'
    		                               AND tgl_transaksi = '".date('Y-m-d')."'");
        foreach($query_2->result_array() as $row_2)
        {
            $link_aja = $row_2['link_aja'];
        }
        $sisa_link_aja = $limit_link_aja - $link_aja;
        return array('status' => 200, 'data' => $sisa_link_aja);
    }
    
    //penjualan bayar lunas
    public function penjualan_bayar_lunas($params,$users_id)
    {
        //nota terakhir
        $id_terakhir = 0;
        $id_milik = 0;
        $query_1 = $this->db->query("SELECT no_nota
	                                 FROM jc_penjualan
	                                 WHERE id_sales = '".$this->db->escape_str($users_id)."'
	                                 ORDER BY no_urut DESC LIMIT 1");
        foreach($query_1->result_array() as $row_1)
        {
            $explode = explode("-",$row_1['no_nota']);
            $id_terakhir = $explode[1];
        }
        $id_milik = $id_terakhir + 1;
        //nota penjualan
        $no_nota_lunas = $users_id."L-".$id_milik;
        
        
        $query_2 = $this->db->query("INSERT INTO jc_penjualan
                                        (
                                          id_sales, 
                                          id_jenis_lokasi, 
                                          id_lokasi, 
                                          nama_pembeli, 
                                          no_hp_pembeli, 
                                          no_nota, 
                                          tgl_transaksi, 
                                          link_aja, 
                                          pembayaran, 
                                          no_urut
                                        )
                                     VALUES
                                        (
                                           '".$this->db->escape_str($users_id)."', 
                                           '".$this->db->escape_str($params['id_jenis_lokasi'])."', 
                                           '".$this->db->escape_str($params['id_tempat'])."', 
                                           '".$this->db->escape_str($params['nama_pembeli'])."', 
                                           '".$this->db->escape_str($params['no_hp_pembeli'])."', 
                                           '".$this->db->escape_str($no_nota_lunas)."',
                                           '".date('Y-m-d')."', 
                                           '".$this->db->escape_str($params['link_aja'])."',
                                           'LUNAS',
                                           '".$this->db->escape_str($id_milik)."'
                                        )"); 
        //insert sn
        for($i=0; $i<count($params['data']); $i++)
        {
            $query_3 = $this->db->query("INSERT INTO jd_penjualan_detail
                                         (
                                              no_nota, 
                                              serial_number, 
                                              id_produk, 
                                              harga_modal, 
                                              harga_jual
                                         )
                                         VALUES
                                         (
                                               '".$no_nota_lunas."', 
                                               '".$this->db->escape_str($params['data'][$i]['serial_number'])."',
                                               '".$this->db->escape_str($params['data'][$i]['id_produk'])."', 
                                               '".$this->db->escape_str($params['data'][$i]['harga_modal'])."', 
                                               '".$this->db->escape_str($params['data'][$i]['harga_jual'])."'
                                            )"); 
            //update distribusi perdana
            $query_4 = $this->db->query("UPDATE ia_distribusi_perdana
                                          SET status_penjualan = 'TERJUAL'
                                          WHERE serial_number = '".$this->db->escape_str($params['data'][$i]['serial_number'])."'
                                                AND id_sales = '".$this->db->escape_str($users_id)."'
                                                AND status_penjualan = 'BELUM TERJUAL'");
        }
		$query_5 = $this->db->query("SELECT a.no_nota
									 FROM jd_penjualan_detail a, jc_penjualan b
									 WHERE a.no_nota = b.no_nota
										  AND a.no_nota = '".$this->db->escape_str($no_nota_lunas)."'
										  AND b.id_sales = '".$this->db->escape_str($users_id)."'
										  AND b.id_lokasi = '".$this->db->escape_str($params['id_tempat'])."'");
		if($query_5->num_rows() > 0)
		{
			return array('status' => 1, 'ket' => 'sukses : 1, gagal : 0');
		}else{
			return array('status' => 0, 'ket' => 'sukses : 1, gagal : 0');
		}
    }
    
    //penjualan bayar konsinyasi
    public function penjualan_bayar_konsinyasi($params,$users_id)
    {
        //nota terakhir
        $id_terakhir = 0;
        $id_milik = 0;
        $query_1 = $this->db->query("SELECT no_nota
	                                 FROM jc_penjualan
	                                 WHERE id_sales = '".$this->db->escape_str($users_id)."'
	                                 ORDER BY no_urut DESC LIMIT 1");
        foreach($query_1->result_array() as $row_1)
        {
            $explode = explode("-",$row_1['no_nota']);
            $id_terakhir = $explode[1];
        }
        $id_milik = $id_terakhir + 1;
        //nota penjualan
        $no_nota_konsinyasi = $users_id."K-".$id_milik;
        $query_2 = $this->db->query("INSERT INTO jc_penjualan
                                        (
                                          id_sales, 
                                          id_jenis_lokasi, 
                                          id_lokasi, 
                                          nama_pembeli, 
                                          no_hp_pembeli, 
                                          no_nota, 
                                          tgl_transaksi, 
                                          link_aja, 
                                          pembayaran, 
                                          no_urut
                                        )
                                     VALUES
                                        (
                                           '".$this->db->escape_str($users_id)."', 
                                           '".$this->db->escape_str($params['id_jenis_lokasi'])."', 
                                           '".$this->db->escape_str($params['id_tempat'])."', 
                                           '".$this->db->escape_str($params['nama_pembeli'])."', 
                                           '".$this->db->escape_str($params['no_hp_pembeli'])."', 
                                           '".$this->db->escape_str($no_nota_konsinyasi)."',
                                           '".date('Y-m-d')."', 
                                           '".$this->db->escape_str($params['link_aja'])."',
                                           'KONSINYASI',
                                           '".$this->db->escape_str($id_milik)."'
                                        )"); 
        //insert sn
        for($i=0; $i<count($params['data']); $i++)
        {
            $query_3 = $this->db->query("INSERT INTO jd_penjualan_detail
                                         (
                                              no_nota, 
                                              serial_number, 
                                              id_produk, 
                                              harga_modal, 
                                              harga_jual
                                         )
                                         VALUES
                                         (
                                               '".$this->db->escape_str($no_nota_konsinyasi)."', 
                                               '".$this->db->escape_str($params['data'][$i]['serial_number'])."',
                                               '".$this->db->escape_str($params['data'][$i]['id_produk'])."', 
                                               '".$this->db->escape_str($params['data'][$i]['harga_modal'])."', 
                                               '".$this->db->escape_str($params['data'][$i]['harga_jual'])."'
                                            )"); 
            //update distribusi perdana
            $query_4 = $this->db->query("UPDATE ia_distribusi_perdana
                                          SET status_penjualan = 'TERJUAL'
                                          WHERE serial_number = '".$this->db->escape_str($params['data'][$i]['serial_number'])."'
                                                AND id_sales = '".$this->db->escape_str($users_id)."'
                                                AND status_penjualan = 'BELUM TERJUAL'");
        }
		$query_5 = $this->db->query("SELECT a.no_nota
		                             FROM jd_penjualan_detail a, jc_penjualan b
		                             WHERE a.no_nota = b.no_nota
									       AND a.no_nota = '".$this->db->escape_str($no_nota_konsinyasi)."'
									       AND b.id_sales = '".$this->db->escape_str($users_id)."'
										   AND b.id_lokasi = '".$params['id_tempat']."'");
		if($query_5->num_rows() > 0)
		{
			return array('status' => 1, 'ket' => 'sukses : 1, gagal : 0');
		}else{
			return array('status' => 0, 'ket' => 'sukses : 1, gagal : 0');
		}
    }
    
    //distribusi daftar nota
    public function distribusi_daftar_nota($id_lokasi,$tgl_transaksi,$id_jenis_lokasi, $users_id)
    {
		$query = $this->db->query("SELECT 
		                              no_nota, pembayaran
		                           FROM jc_penjualan
		                           WHERE id_jenis_lokasi = '".$this->db->escape_str($id_jenis_lokasi)."'
		                                 AND id_lokasi = '".$this->db->escape_str($id_lokasi)."'
		                                 AND tgl_transaksi = '".$this->db->escape_str($tgl_transaksi)."'
		                                 AND id_sales = '".$this->db->escape_str($users_id)."'
		                           ORDER BY no_urut ASC");
        $data = $query->result_array();
        return array('status' => 200, 'data' => $data);
    }
    
    //distribusi detail nota
    public function distribusi_detail_nota($no_nota)
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
    
    //distribusi history rekomendasi
    public function distribusi_history_rekomendasi($params,$users_id)
    {
        //cari minggu
		$year = date('Y');
		$month = date('m');
		$date = date('Ymd');
		$query_1 = $this->db->query("SELECT tahun,bulan,minggu 
		                             FROM ja_penjualan_tanggal 
		                             WHERE tanggal_merge = '".$this->db->escape_str($date)."'");
		foreach ($query_1->result_array() as $row_1)
		{ 
			$year_now = $row_1['tahun'];
			$month_now = $row_1['bulan'];
			$week_now = $row_1['minggu']; 
		}
		//WEEK-1
		if($week_now == 1)
		{
			if($month_now == 1)
			{
				$year_1 = $year_now - 1;
				$month_1 = 12;
			}
			if($month_now > 1)
			{
				$year_1 = $year_now;
				$month_1 = $month_now-1;
			}
			$query_2 = $this->db->query("SELECT minggu 
			                             FROM ja_penjualan_tanggal 
			                             WHERE tahun = '".$this->db->escape_str($year_1)."' 
			                                   AND bulan = '".$this->db->escape_str($month_1)."' 
			                             GROUP BY minggu 
			                             ORDER BY minggu DESC LIMIT 1");
			foreach ($query_2->result_array() as $row_2)
			{ 
			    $week_1 = $row_2['minggu']; 
			}
		}
		if($week_now > 1)
		{
			$year_1 = $year_now;
			$month_1 = $month_now;
			$week_1 = $week_now-1;
		}
		//WEEK-2
		if($week_now == 1)
		{
			if($month_now == 1)
			{
				$year_2 = $year_now - 1;
				$month_2 = 12;
			}
			if($month_now > 1)
			{
				$year_2 = $year_now;
				$month_2 = $month_now - 1;
			}
			$query_3 = $this->db->query("SELECT minggu 
			                             FROM ja_penjualan_tanggal 
			                             WHERE tahun = '".$this->db->escape_str($year_2)."' 
			                                   AND bulan = '".$this->db->escape_str($month_2)."' 
			                             GROUP BY minggu 
			                             ORDER BY minggu DESC LIMIT 1,1");
			foreach ($query_3->result_array() as $row_3)
			{ 
			    $week_2 = $row_3['minggu']; 
			}
		}
		if($week_now == 2)
		{
			if($month_now == 1)
			{
				$year_2 = $year_now - 1;
				$month_2 = 12;
			}
			if($month_now > 1)
			{
				$year_2 = $year_now;
				$month_2 = $month_now - 1;
			}
			$query_4 = $this->db->query("SELECT minggu 
			                             FROM ja_penjualan_tanggal 
			                             WHERE tahun = '".$this->db->escape_str($year_2)."' 
			                                   AND bulan = '".$this->db->escape_str($month_2)."' 
			                             GROUP BY minggu 
			                             ORDER BY minggu DESC LIMIT 1");
			foreach ($query_4->result_array() as $row_4)
			{ 
			    $week_2 = $row_4['minggu']; 
			}
		}
		if($week_now > 2)
		{
			$year_2 = $year_now;
			$month_2 = $month_now;
			$week_2 = $week_now-2;
		}
		//WEEK-3
		if($week_now == 1)
		{
			if($month_now == 1)
			{
				$year_3 = $year_now - 1;
				$month_3 = 12;
			}
			if($month_now > 1)
			{
				$year_3 = $year_now;
				$month_3 = $month_now - 1;
			}
			$query_5 = $this->db->query("SELECT minggu 
			                             FROM ja_penjualan_tanggal 
			                             WHERE tahun = '".$this->db->escape_str($year_3)."' 
			                                   AND bulan = '".$this->db->escape_str($month_3)."' 
			                             GROUP BY minggu 
			                             ORDER BY minggu DESC LIMIT 2,1");
			foreach ($query_5->result_array() as $row_5)
			{ 
			    $week_3 = $row_5['minggu']; 
			}
		}
		if($week_now == 2)
		{
			if($month_now == 1)
			{
				$year_3 = $year_now - 1;
				$month_3 = 12;
			}
			if($month_now > 1)
			{
				$year_3 = $year_now;
				$month_3 = $month_now - 1;
			}
			$query_6 = $this->db->query("SELECT minggu 
			                             FROM ja_penjualan_tanggal 
			                             WHERE tahun = '".$this->db->escape_str($year_3)."' 
			                                   AND bulan = '".$this->db->escape_str($month_3)."' 
			                             GROUP BY minggu 
			                             ORDER BY minggu DESC LIMIT 1,1");
			foreach ($query_6->result_array() as $row_6)
			{ 
			    $week_3 = $row_6['minggu'];
			}
		}
		if($week_now == 3)
		{
			if($month_now == 1)
			{
				$year_3 = $year_now - 1;
				$month_3 = 12;
			}
			if($month_now > 1)
			{
				$year_3 = $year_now;
				$month_3 = $month_now - 1;
			}
			$query_7 = $this->db->query("SELECT minggu 
			                             FROM ja_penjualan_tanggal 
			                             WHERE tahun = '".$this->db->escape_str($year_3)."' 
			                                   AND bulan = '".$this->db->escape_str($month_3)."' 
			                             GROUP BY minggu 
			                             ORDER BY minggu DESC LIMIT 1");
			foreach ($query_7->result_array() as $row_7)
			{ 
			    $week_3 = $row_7['minggu'];
			}
		}
		if($week_now > 3)
		{
			$year_3 = $year_now;
			$month_3 = $month_now;
			$week_3 = $week_now-3;
		}
		//WEEK-4
		if($week_now == 1)
		{
			if($month_now == 1)
			{
				$year_4 = $year_now - 1;
				$month_4 = 12;
			}
			if($month_now > 1)
			{
				$year_4 = $year_now;
				$month_4 = $month_now - 1;
			}
			$query_8 = $this->db->query("SELECT minggu 
			                             FROM ja_penjualan_tanggal 
			                             WHERE tahun = '".$this->db->escape_str($year_4)."' 
			                                   AND bulan = '".$this->db->escape_str($month_4)."' 
			                             GROUP BY minggu 
			                             ORDER BY minggu DESC LIMIT 3,1");
			foreach ($query_8->result_array() as $row_8)
			{ 
			    $week_4 = $row_8['minggu']; 
			}
		}
		if($week_now == 2)
		{
			if($month_now == 1)
			{
				$year_4 = $year_now - 1;
				$month_4 = 12;
			}
			if($month_now > 1)
			{
				$year_4 = $year_now;
				$month_4 = $month_now - 1;
			}
			$query_9 = $this->db->query("SELECT minggu 
			                             FROM ja_penjualan_tanggal 
			                             WHERE tahun = '".$this->db->escape_str($year_4)."' 
			                                   AND bulan = '".$this->db->escape_str($month_4)."' 
			                             GROUP BY minggu 
			                             ORDER BY minggu DESC LIMIT 2,1");
			foreach ($query_9->result_array() as $row_9)
			{ 
			    $week_4 = $row_9['minggu'];
			}
		}
		if($week_now == 3)
		{
			if($month_now == 1)
			{
				$year_4 = $year_now - 1;
				$month_4 = 12;
			}
			if($month_now > 1)
			{
				$year_4 = $year_now;
				$month_4 = $month_now - 1;
			}
			$query_10 = $this->db->query("SELECT minggu 
			                              FROM ja_penjualan_tanggal 
			                              WHERE tahun = '".$this->db->escape_str($year_3)."' 
			                                   AND bulan = '".$this->db->escape_str($month_3)."' 
			                              GROUP BY minggu 
			                              ORDER BY minggu DESC LIMIT 1,1");
			foreach ($query_10->result_array() as $row_10)
			{ 
			    $week_4 = $row_10['minggu'];
			}
		}
		if($week_now == 4)
		{
			if($month_now == 1)
			{
				$year_4 = $year_now - 1;
				$month_4 = 12;
			}
			if($month_now > 1)
			{
				$year_4 = $year_now;
				$month_4 = $month_now - 1;
			}
			$query_11 = $this->db->query("SELECT minggu 
			                              FROM ja_penjualan_tanggal 
			                              WHERE tahun = '".$this->db->escape_str($year_3)."' 
			                                   AND bulan = '".$this->db->escape_str($month_3)."' 
			                              GROUP BY minggu 
			                              ORDER BY minggu DESC LIMIT 1");
			foreach ($query_11->result_array() as $row_11)
			{ 
			    $week_4 = $row_11['minggu'];
			}
		}
		if($week_now > 4)
		{
			$year_4 = $year_now;
			$month_4 = $month_now;
			$week_4 = $week_now-4;
		}
		//variabel
		$perdana_prepaid_w1 = 0;
	    $perdana_prepaid_w2 = 0;
	    $perdana_prepaid_w3 = 0;
	    $perdana_prepaid_w4 = 0;
	    $rekomendasi_perdana_prepaid = 0;
	    $perdana_ota_w1 = 0;
	    $perdana_ota_w2 = 0;
	    $perdana_ota_w3 = 0;
	    $perdana_ota_w4 = 0;
	    $rekomendasi_perdana_ota = 0;
	    $segel_vogsilver_w1 = 0;
	    $segel_vogsilver_w2 = 0;
	    $segel_vogsilver_w3 = 0;
	    $segel_vogsilver_w4 = 0;
	    $rekomendasi_segel_vogsilver = 0;
	    $segel_voggold_w1 = 0;
	    $segel_voggold_w2 = 0;
	    $segel_voggold_w3 = 0;
	    $segel_voggold_w4 = 0;
	    $rekomendasi_segel_voggold = 0;
	    $segel_vogplatinum_w1 = 0;
	    $segel_vogplatinum_w2 = 0;
	    $segel_vogplatinum_w3 = 0;
	    $segel_vogplatinum_w4 = 0;
	    $rekomendasi_segel_vogplatinum = 0;
	    $segel_vointernet_w1 = 0;
	    $segel_vointernet_w2 = 0;
	    $segel_vointernet_w3 = 0;
	    $segel_vointernet_w4 = 0;
	    $rekomendasi_segel_vointernet = 0;
	    $sa_ld_w1 = 0;
	    $sa_ld_w2 = 0;
	    $sa_ld_w3 = 0;
	    $sa_ld_w4 = 0;
	    $rekomensasi_sa_ld = 0;
	    $sa_md_w1 = 0;
	    $sa_md_w2 = 0;
	    $sa_md_w3 = 0;
	    $sa_md_w4 = 0;
	    $rekomendasi_sa_md = 0;
	    $sa_hd_w1 = 0;
	    $sa_hd_w2 = 0;
	    $sa_hd_w3 = 0;
	    $sa_hd_w4 = 0;
	    $rekomendasi_sa_hd = 0;
	    $vointernet_ld_w1 = 0;
	    $vointernet_ld_w2 = 0;
	    $vointernet_ld_w3 = 0;
	    $vointernet_ld_w4 = 0;
	    $rekomendasi_vointernet_ld = 0;
	    $vointernet_md_w1 = 0;
	    $vointernet_md_w2 = 0;
	    $vointernet_md_w3 = 0;
	    $vointernet_md_w4 = 0;
	    $rekomendasi_vointernet_md = 0;
	    $vointernet_hd_w1 = 0;
	    $vointernet_hd_w2 = 0;
	    $vointernet_hd_w3 = 0;
	    $vointernet_hd_w4 = 0;
	    $rekomendasi_vointernet_hd = 0;
	    $vogames_ld_w1 = 0;
	    $vogames_ld_w2 = 0;
	    $vogames_ld_w3 = 0;
	    $vogames_ld_w4 = 0;
	    $rekomendasi_vogames_ld = 0;
	    $vogames_md_w1 = 0;
	    $vogames_md_w2 = 0;
	    $vogames_md_w3 = 0;
	    $vogames_md_w4 = 0;
	    $rekomendasi_vogames_md = 0;
	    $vogames_hd_w1 = 0;
	    $vogames_hd_w2 = 0;
	    $vogames_hd_w3 = 0;
	    $vogames_hd_w4 = 0;
	    $rekomendasi_vogames_hd = 0;
		//tampilkan segel PRODUK SEGEL PREPAID
		$query_12 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS perdana_prepaid_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'PRODUK SEGEL PREPAID'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$this->db->escape_str($params['id_tempat'])."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS perdana_prepaid_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'PRODUK SEGEL PREPAID'
		                                    AND jd.no_nota = jc.no_nota     
		                                    AND jc.id_lokasi = '".$this->db->escape_str($params['id_tempat'])."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS perdana_prepaid_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'PRODUK SEGEL PREPAID'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$this->db->escape_str($params['id_tempat'])."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS perdana_prepaid_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'PRODUK SEGEL PREPAID'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$this->db->escape_str($params['id_tempat'])."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    perdana_prepaid AS rekomendasi_perdana_prepaid
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$this->db->escape_str($params['id_tempat'])."' 
		                                    AND tahun = '".$this->db->escape_str($year_now)."'
		                                    AND bulan = '".$this->db->escape_str($month_now)."'
		                                    AND minggu = '".$this->db->escape_str($week_now)."'
		                              ) e");
		foreach ($query_12->result_array() as $row_12)
		{ 
		    $perdana_prepaid_w1 = $row_12['perdana_prepaid_w1'];
    	    $perdana_prepaid_w2 = $row_12['perdana_prepaid_w2'];
    	    $perdana_prepaid_w3 = $row_12['perdana_prepaid_w3'];
    	    $perdana_prepaid_w4 = $row_12['perdana_prepaid_w4'];
    	    $rekomendasi_perdana_prepaid = $row_12['rekomendasi_perdana_prepaid'];
		}
		$querx_12 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS perdana_ota_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'PRODUK SEGEL OTA'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$this->db->escape_str($params['id_tempat'])."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$this->db->escape_str($year_1)."'
		                                                                   AND bulan = '".$this->db->escape_str($month_1)."'
		                                                                   AND minggu = '".$this->db->escape_str($week_1)."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS perdana_ota_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'PRODUK SEGEL OTA'
		                                    AND jd.no_nota = jc.no_nota     
		                                    AND jc.id_lokasi = '".$this->db->escape_str($params['id_tempat'])."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$this->db->escape_str($year_2)."'
		                                                                   AND bulan = '".$this->db->escape_str($month_2)."'
		                                                                   AND minggu = '".$this->db->escape_str($week_2)."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS perdana_ota_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'PRODUK SEGEL OTA'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS perdana_ota_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'PRODUK SEGEL OTA'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    perdana_ota AS rekomendasi_perdana_ota
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($querx_12->result_array() as $rox_12)
		{ 
		    $perdana_ota_w1 = $rox_12['perdana_ota_w1'];
    	    $perdana_ota_w2 = $rox_12['perdana_ota_w2'];
    	    $perdana_ota_w3 = $rox_12['perdana_ota_w3'];
    	    $perdana_ota_w4 = $rox_12['perdana_ota_w4'];
    	    $rekomendasi_perdana_ota = $rox_12['rekomendasi_perdana_ota'];
		}
		//tampilkan segel vogsilver
		$query_15 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogsilver_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'SILVER'
		                                    AND jd.no_nota = jc.no_nota  
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogsilver_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'SILVER'
		                                    AND jd.no_nota = jc.no_nota     
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogsilver_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'SILVER'
		                                    AND jd.no_nota = jc.no_nota     
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogsilver_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'SILVER'
		                                    AND jd.no_nota = jc.no_nota  
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    segel_vog_silver AS rekomendasi_segel_vogsilver
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_15->result_array() as $row_15)
		{ 
		    $segel_vogsilver_w1 = $row_15['segel_vogsilver_w1'];
    	    $segel_vogsilver_w2 = $row_15['segel_vogsilver_w2'];
    	    $segel_vogsilver_w3 = $row_15['segel_vogsilver_w3'];
    	    $segel_vogsilver_w4 = $row_15['segel_vogsilver_w4'];
    	    $rekomendasi_segel_vogsilver = $row_15['rekomendasi_segel_vogsilver'];
		}
		//tampilkan segel voggold
		$query_16 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_voggold_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'GOLD'
		                                    AND jd.no_nota = jc.no_nota     
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_voggold_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'GOLD'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_voggold_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'GOLD'
		                                    AND jd.no_nota = jc.no_nota     
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_voggold_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'GOLD'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    segel_vog_gold AS rekomendasi_segel_voggold
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_16->result_array() as $row_16)
		{ 
		    $segel_voggold_w1 = $row_16['segel_voggold_w1'];
    	    $segel_voggold_w2 = $row_16['segel_voggold_w2'];
    	    $segel_voggold_w3 = $row_16['segel_voggold_w3'];
    	    $segel_voggold_w4 = $row_16['segel_voggold_w4'];
    	    $rekomendasi_segel_voggold = $row_16['rekomendasi_segel_voggold'];
		}
		//tampilkan segel vogplatinum
		$query_17 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogplatinum_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'PLATINUM'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogplatinum_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'PLATINUM'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogplatinum_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'PLATINUM'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogplatinum_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND ga.subjenis_produk = 'PLATINUM'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    segel_vog_platinum AS rekomendasi_segel_vogplatinum
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_17->result_array() as $row_17)
		{ 
		    $segel_vogplatinum_w1 = $row_17['segel_vogplatinum_w1'];
    	    $segel_vogplatinum_w2 = $row_17['segel_vogplatinum_w2'];
    	    $segel_vogplatinum_w3 = $row_17['segel_vogplatinum_w3'];
    	    $segel_vogplatinum_w4 = $row_17['segel_vogplatinum_w4'];
    	    $rekomendasi_segel_vogplatinum = $row_17['rekomendasi_segel_vogplatinum'];
		}
		//tampilkan segel vointernet
		$query_18 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'SEGEL'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    segel_vointernet AS rekomendasi_segel_vointernet
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_18->result_array() as $row_18)
		{ 
		    $segel_vointernet_w1 = $row_18['segel_vointernet_w1'];
    	    $segel_vointernet_w2 = $row_18['segel_vointernet_w2'];
    	    $segel_vointernet_w3 = $row_18['segel_vointernet_w3'];
    	    $segel_vointernet_w4 = $row_18['segel_vointernet_w4'];
    	    $rekomendasi_segel_vointernet = $row_18['rekomendasi_segel_vointernet'];
		}
		//tampilkan segel sa_ld
		$query_19 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_ld_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_ld_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_ld_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_ld_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota     
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    sa_ld AS rekomendasi_segel_sa_ld
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_19->result_array() as $row_19)
		{ 
		    $segel_sa_ld_w1 = $row_19['segel_sa_ld_w1'];
    	    $segel_sa_ld_w2 = $row_19['segel_sa_ld_w2'];
    	    $segel_sa_ld_w3 = $row_19['segel_sa_ld_w3'];
    	    $segel_sa_ld_w4 = $row_19['segel_sa_ld_w4'];
    	    $rekomendasi_segel_sa_ld = $row_19['rekomendasi_segel_sa_ld'];
		}
		//tampilkan segel sa_md
		$query_20 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_md_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_md_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_md_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_md_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    sa_md AS rekomendasi_segel_sa_md
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_20->result_array() as $row_20)
		{ 
		    $segel_sa_md_w1 = $row_20['segel_sa_md_w1'];
    	    $segel_sa_md_w2 = $row_20['segel_sa_md_w2'];
    	    $segel_sa_md_w3 = $row_20['segel_sa_md_w3'];
    	    $segel_sa_md_w4 = $row_20['segel_sa_md_w4'];
    	    $rekomendasi_segel_sa_md = $row_20['rekomendasi_segel_sa_md'];
		}
		//tampilkan segel sa_hd
		$query_21 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_hd_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota     
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_hd_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_hd_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_sa_hd_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'SA'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    sa_hd AS rekomendasi_segel_sa_hd
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_21->result_array() as $row_21)
		{ 
		    $segel_sa_hd_w1 = $row_21['segel_sa_hd_w1'];
    	    $segel_sa_hd_w2 = $row_21['segel_sa_hd_w2'];
    	    $segel_sa_hd_w3 = $row_21['segel_sa_hd_w3'];
    	    $segel_sa_hd_w4 = $row_21['segel_sa_hd_w4'];
    	    $rekomendasi_segel_sa_hd = $row_21['rekomendasi_segel_sa_hd'];
		}
		//tampilkan segel vointernet_ld
		$query_22 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_ld_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_ld_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_ld_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_ld_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    voi_ld AS rekomendasi_segel_vointernet_ld
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_22->result_array() as $row_22)
		{ 
		    $segel_vointernet_ld_w1 = $row_22['segel_vointernet_ld_w1'];
    	    $segel_vointernet_ld_w2 = $row_22['segel_vointernet_ld_w2'];
    	    $segel_vointernet_ld_w3 = $row_22['segel_vointernet_ld_w3'];
    	    $segel_vointernet_ld_w4 = $row_22['segel_vointernet_ld_w4'];
    	    $rekomendasi_segel_vointernet_ld = $row_22['rekomendasi_segel_vointernet_ld'];
		}
		//tampilkan segel vointernet_md
		$query_23 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_md_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota  
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_md_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota 
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_md_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota     
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_md_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    voi_md AS rekomendasi_segel_vointernet_md
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_23->result_array() as $row_23)
		{ 
		    $segel_vointernet_md_w1 = $row_23['segel_vointernet_md_w1'];
    	    $segel_vointernet_md_w2 = $row_23['segel_vointernet_md_w2'];
    	    $segel_vointernet_md_w3 = $row_23['segel_vointernet_md_w3'];
    	    $segel_vointernet_md_w4 = $row_23['segel_vointernet_md_w4'];
    	    $rekomendasi_segel_vointernet_md = $row_23['rekomendasi_segel_vointernet_md'];
		}
		//tampilkan segel vointernet_hd
		$query_24 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_hd_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_hd_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_hd_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vointernet_hd_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER INTERNET'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    voi_hd AS rekomendasi_segel_vointernet_hd
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_24->result_array() as $row_24)
		{ 
		    $segel_vointernet_hd_w1 = $row_24['segel_vointernet_hd_w1'];
    	    $segel_vointernet_hd_w2 = $row_24['segel_vointernet_hd_w2'];
    	    $segel_vointernet_hd_w3 = $row_24['segel_vointernet_hd_w3'];
    	    $segel_vointernet_hd_w4 = $row_24['segel_vointernet_hd_w4'];
    	    $rekomendasi_segel_vointernet_hd = $row_24['rekomendasi_segel_vointernet_hd'];
		}
		//tampilkan segel vogames_ld
		$query_25 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_ld_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_ld_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_ld_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_ld_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '1'
		                                    AND jd.no_nota = jc.no_nota      
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    vog_ld AS rekomendasi_segel_vogames_ld
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_25->result_array() as $row_25)
		{ 
		    $segel_vogames_ld_w1 = $row_25['segel_vogames_ld_w1'];
    	    $segel_vogames_ld_w2 = $row_25['segel_vogames_ld_w2'];
    	    $segel_vogames_ld_w3 = $row_25['segel_vogames_ld_w3'];
    	    $segel_vogames_ld_w4 = $row_25['segel_vogames_ld_w4'];
    	    $rekomendasi_segel_vogames_ld = $row_25['rekomendasi_segel_vogames_ld'];
		}
		//tampilkan segel vogames_md
		$query_26 = $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_md_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_md_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_md_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota 
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_md_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '2'
		                                    AND jd.no_nota = jc.no_nota  
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    vog_md AS rekomendasi_segel_vogames_md
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_26->result_array() as $row_26)
		{ 
		    $segel_vogames_md_w1 = $row_26['segel_vogames_md_w1'];
    	    $segel_vogames_md_w2 = $row_26['segel_vogames_md_w2'];
    	    $segel_vogames_md_w3 = $row_26['segel_vogames_md_w3'];
    	    $segel_vogames_md_w4 = $row_26['segel_vogames_md_w4'];
    	    $rekomendasi_segel_vogames_md = $row_26['rekomendasi_segel_vogames_md'];
		}
		//tampilkan segel vogames_hd
		$query_27= $this->db->query("SELECT * FROM
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_hd_w1
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_1."'
		                                                                   AND bulan = '".$month_1."'
		                                                                   AND minggu = '".$week_1."')
		                              ) a,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_hd_w2
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota    
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_2."'
		                                                                   AND bulan = '".$month_2."'
		                                                                   AND minggu = '".$week_2."')
		                              ) b,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_hd_w3
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota     
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_3."'
		                                                                   AND bulan = '".$month_3."'
		                                                                   AND minggu = '".$week_3."')
		                              ) c,
		                              (
		                                SELECT 
		                                    COUNT(jd.serial_number) AS segel_vogames_hd_w4
		                                FROM 
		                                    jd_penjualan_detail jd,
		                                    gb_produk gb,
		                                    ga_jenis_produk ga,
		                                    jc_penjualan jc
		                                WHERE
		                                    jd.id_produk = gb.id_produk
		                                    AND gb.id_jenis_produk = ga.id_jenis_produk 
		                                    AND ga.kategori_produk = 'INJECT'
		                                    AND ga.nama_jenis_produk = 'VOUCHER GAMES'
		                                    AND gb.id_jenis_inject = '3'
		                                    AND jd.no_nota = jc.no_nota   
		                                    AND jc.id_lokasi = '".$params['id_tempat']."'
		                                    AND jc.tgl_transaksi IN (SELECT ja.tanggal 
		                                                             FROM ja_penjualan_tanggal ja
		                                                             WHERE tahun = '".$year_4."'
		                                                                   AND bulan = '".$month_4."'
		                                                                   AND minggu = '".$week_4."')
		                              ) d,
		                              (
		                                SELECT 
		                                    vog_hd AS rekomendasi_segel_vogames_hd
		                                FROM 
		                                    kc_rekomendasi_outlet
		                                WHERE
		                                    id_outlet = '".$params['id_tempat']."' 
		                                    AND tahun = '".$year_now."'
		                                    AND bulan = '".$month_now."'
		                                    AND minggu = '".$week_now."'
		                              ) e");
		foreach ($query_27->result_array() as $row_27)
		{ 
		    $segel_vogames_hd_w1 = $row_27['segel_vogames_hd_w1'];
    	    $segel_vogames_hd_w2 = $row_27['segel_vogames_hd_w2'];
    	    $segel_vogames_hd_w3 = $row_27['segel_vogames_hd_w3'];
    	    $segel_vogames_hd_w4 = $row_27['segel_vogames_hd_w4'];
    	    $rekomendasi_segel_vogames_hd = $row_27['rekomendasi_segel_vogames_hd'];
		}
		return array('status' => 200, 'data' => array(
		                                        'segel' => array(array('nama' => 'PRODUK SEGEL PREPAID', 
        		                                                           'w1' => $perdana_prepaid_w1, 
        		                                                           'w2' => $perdana_prepaid_w2, 
        		                                                           'w3' => $perdana_prepaid_w3, 
        		                                                           'w4' => $perdana_prepaid_w4,
        		                                                           'rekomendasi' => $rekomendasi_perdana_prepaid),
        		                                                 array('nama' => 'PRODUK SEGEL OTA', 
        		                                                           'w1' => $perdana_ota_w1, 
        		                                                           'w2' => $perdana_ota_w2, 
        		                                                           'w3' => $perdana_ota_w3, 
        		                                                           'w4' => $perdana_ota_w4,
        		                                                           'rekomendasi' => $rekomendasi_perdana_ota),
        		                                                 array('nama' => 'VoG Silver', 
        		                                                           'w1' => $segel_vogsilver_w1, 
        		                                                           'w2' => $segel_vogsilver_w2, 
        		                                                           'w3' => $segel_vogsilver_w3, 
        		                                                           'w4' => $segel_vogsilver_w4,
        		                                                           'rekomendasi' => $rekomendasi_segel_vogsilver),
        		                                                 array('nama' => 'VoG Gold', 
        		                                                           'w1' => $segel_voggold_w1, 
        		                                                           'w2' => $segel_voggold_w2, 
        		                                                           'w3' => $segel_voggold_w3, 
        		                                                           'w4' => $segel_voggold_w4,
        		                                                           'rekomendasi' => $rekomendasi_segel_voggold),
        		                                                 array('nama' => 'VoG Platinum', 
        		                                                           'w1' => $segel_vogplatinum_w1, 
        		                                                           'w2' => $segel_vogplatinum_w2, 
        		                                                           'w3' => $segel_vogplatinum_w3, 
        		                                                           'w4' => $segel_vogplatinum_w4,
        		                                                           'rekomendasi' => $rekomendasi_segel_vogplatinum),
        		                                                array('nama' => 'VoG Internet', 
        		                                                           'w1' => $segel_vointernet_w1, 
        		                                                           'w2' => $segel_vointernet_w2, 
        		                                                           'w3' => $segel_vointernet_w3, 
        		                                                           'w4' => $segel_vointernet_w4,
        		                                                           'rekomendasi' => $rekomendasi_segel_vointernet),
		                                                         ),
		                                        'sa' => array(array('nama' => 'LD', 
        		                                                       'w1' => $sa_ld_w1, 
        		                                                       'w2' => $sa_ld_w2, 
        		                                                       'w3' => $sa_ld_w3, 
        		                                                       'w4' => $sa_ld_w4,
        		                                                       'rekomendasi' => $rekomensasi_sa_ld),
        		                                              array('nama' => 'MD', 
        		                                                       'w1' => $sa_md_w1, 
        		                                                       'w2' => $sa_md_w2, 
        		                                                       'w3' => $sa_md_w3, 
        		                                                       'w4' => $sa_md_w4,
        		                                                       'rekomendasi' => $rekomendasi_sa_md),
        		                                              array('nama' => 'HD', 
        		                                                       'w1' => $sa_hd_w1, 
        		                                                       'w2' => $sa_hd_w2, 
        		                                                       'w3' => $sa_hd_w3, 
        		                                                       'w4' => $sa_hd_w4,
        		                                                       'rekomendasi' => $rekomendasi_sa_hd),
        		                                              ),
        		                              'vointernet' => array(array('nama' => 'LD', 
        		                                                             'w1' => $vointernet_ld_w1, 
        		                                                             'w2' => $vointernet_ld_w2, 
        		                                                             'w3' => $vointernet_ld_w3, 
        		                                                             'w4' => $vointernet_ld_w4,
        		                                                             'rekomendasi' => $rekomendasi_vointernet_ld),
        		                                                   array('nama' => 'MD', 
        		                                                            'w1' => $vointernet_md_w1, 
        		                                                            'w2' => $vointernet_md_w2, 
        		                                                            'w3' => $vointernet_md_w3, 
        		                                                            'w4' => $vointernet_md_w4,
        		                                                            'rekomendasi' => $rekomendasi_vointernet_md),
        		                                                   array('nama' => 'HD', 
        		                                                            'w1' => $vointernet_hd_w1, 
        		                                                            'w2' => $vointernet_hd_w2, 
        		                                                            'w3' => $vointernet_hd_w3, 
        		                                                            'w4' => $vointernet_hd_w4,
        		                                                            'rekomendasi' => $rekomendasi_vointernet_hd),
        		                                              ),
        		                              'vogames' => array(array('nama' => 'LD', 
        		                                                          'w1' => $vogames_ld_w1, 
        		                                                          'w2' => $vogames_ld_w2, 
        		                                                          'w3' => $vogames_ld_w3, 
        		                                                          'w4' => $vogames_ld_w4,
        		                                                          'rekomendasi' => $rekomendasi_vogames_ld),
        		                                                 array('nama' => 'MD', 
        		                                                          'w1' => $vogames_md_w1, 
        		                                                          'w2' => $vogames_md_w2, 
        		                                                          'w3' => $vogames_md_w3, 
        		                                                          'w4' => $vogames_md_w4,
        		                                                          'rekomendasi' => $rekomendasi_vogames_md),
        		                                                 array('nama' => 'HD', 
        		                                                          'w1' => $vogames_hd_w1, 
        		                                                          'w2' => $vogames_hd_w2, 
        		                                                          'w3' => $vogames_hd_w3, 
        		                                                          'w4' => $vogames_hd_w4,
        		                                                          'rekomendasi' => $rekomendasi_vogames_hd),
        		                                              ),
        		                              
        		                              ));
    } 
    
    //distribusi foto
    public function distribusi_foto($users_id)
    {
	    $tipenyaaa1 = '';
		$target_dir = "assets/distribusi_foto/";
		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
		{
		    $uploadFile1 = $_FILES['myfile1'];
		    $extractFile1 = pathinfo($uploadFile1['name']);
		    $size1 = $_FILES['myfile1']['size'];
		    $tipe1 = $_FILES['myfile1']['type'];
		    $ftype1 = explode("/",$tipe1);
		    $ftypee1 = $ftype1[1];
	        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp').".".$ftypee1))
	        {
                $tipenyaaa1 = $this->input->post('id_history_pjp').".".$ftypee1;
                $query = $this->db->query("UPDATE fb_histroy_pjp
                                           SET foto_distribusi = '".$tipenyaaa1."'
                                           WHERE id_history_pjp = '".$this->input->post('id_history_pjp')."'");
		    return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'foto berhasil di upload');
	        }else{
		    return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'foto yang di upload gagal');
	        }
		}else{
    		    return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'foto yang di upload gagal');
		}  
    }
        

}
