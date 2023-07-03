<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model {
    
   //outlet create
   public function outlet_create($data, $users_id, $role)
   {
	   if($role == '5' || $role == '6' || $role == '8')
	   {
		   $this->db->insert('eb_outlet',$data);
		   return array('status' => 201,'message' => 'Data has been created.');
	   }else{
		   return array('status' => 201,'message' => 'role denied.');
	   }
   }
   
   //outlet update
   public function outlet_update($id, $data, $users_id, $role)
   {
	   if($role == '5' || $role == '6' || $role == '8')
	   {
		   $this->db->where('id_outlet',$id)->update('eb_outlet',$data);
		   return array('status' => 200,'message' => 'Data has been updated.');
	   }else{
		   return array('status' => 201,'message' => 'role denied.');
	   }
   }    
   
   //sekolah create
   public function sekolah_create($data, $users_id, $role)
   {
	   if($role == '7')
	   {
		   $this->db->insert('ec_sekolah',$data);
		   return array('status' => 201,'message' => 'Data has been created.');
	   }else{
		   return array('status' => 201,'message' => 'role denied.');
	   }
   }
   
   //sekolah update
   public function sekolah_update($id, $data, $users_id, $role)
   {
	   if($role == '7')
	   {
		   $this->db->where('id_sekolah',$id)->update('ec_sekolah',$data);
		   return array('status' => 200,'message' => 'Data has been updated.');
	   }else{
		   return array('status' => 201,'message' => 'role denied.');
	   }
   }
   
   //kampus create
   public function kampus_create($data, $users_id, $role)
   {
	   if($role == '7')
	   {
		   $this->db->insert('ed_kampus',$data);
		   return array('status' => 201,'message' => 'Data has been created.');
	   }else{
		   return array('status' => 201,'message' => 'role denied.');
	   }
   }
   
   //kampus update
   public function kampus_update($id, $data, $users_id, $role)
   {
	   if($role == '7')
	   {
		   $this->db->where('id_universitas',$id)->update('ed_kampus',$data);
		   return array('status' => 200,'message' => 'Data has been updated.');
	   }else{
		   return array('status' => 201,'message' => 'role denied.');
	   }
   }   
   
   //fakultas create
   public function fakultas_create($data, $users_id, $role)
   {
	   if($role == '7')
	   {
		   $this->db->insert('ee_fakultas',$data);
		   return array('status' => 201,'message' => 'Data has been created.');
	   }else{
		   return array('status' => 201,'message' => 'role denied.');
	   }    
   }
   
   //fakultas update
   public function fakultas_update($id, $data, $users_id, $role)
   {
	   if($role == '7')
	   {
		   $this->db->where('id_fakultas',$id)->update('ee_fakultas',$data);
		   return array('status' => 200,'message' => 'Data has been updated.');
	   }else{
		   return array('status' => 201,'message' => 'role denied.');
	   }     
   }  
   
   //poi create
   public function poi_create($data, $users_id, $role)
   {
	   if($role == '7')
	   {
		   $this->db->insert('ef_poi',$data);
		   return array('status' => 201,'message' => 'Data has been created.');
	   }else{
		   return array('status' => 201,'message' => 'role denied.');
	   } 
   }
   
   //poi update
   public function poi_update($id, $data, $users_id, $role)
   {
	   if($role == '7')
	   {
		   $this->db->where('id_poi',$id)->update('ef_poi',$data);
		   return array('status' => 200,'message' => 'Data has been updated.');
	   }else{
		   return array('status' => 201,'message' => 'role denied.');
	   } 
   }   
   
   //cari
   public function cari($params,$users_id,$role)
   {
	   if($role == '5' || $role == '6' || $role == '8')
	   {
		   if($params['id_jenis_lokasi'] == 'OUT')
		   {
			   $query = $this->db->query("SELECT 
											   eb.id_outlet, eb.id_digipos, eb.nama_outlet, eb.no_rs 
										  FROM eb_outlet eb, fa_pjp fa
										  WHERE eb.id_outlet = fa.id_tempat
												AND fa.id_jenis_lokasi = '".$this->db->escape_str($params['id_jenis_lokasi'])."'
												AND fa.hari IN (SELECT hari FROM ja_penjualan_tanggal WHERE tanggal = '".date('Y-m-d')."')
												AND fa.id_sales = '".$this->db->escape_str($users_id)."'
												AND ((eb.id_digipos LIKE '%".$this->db->escape_str($params['cari'])."%')
													  OR (eb.no_rs LIKE '%".$this->db->escape_str($params['cari'])."%')
													  OR (eb.nama_outlet LIKE '%".$this->db->escape_str($params['cari'])."%'))
										  ORDER by eb.id_digipos, eb.nama_outlet");
			   return $query->result_array();
		   }else{
			   return array('status' => 200,'message' => 'pencarian harus outlet');
		   }
	   }elseif($role == '7'){
		   if($params['id_jenis_lokasi'] == 'SEK')
		   {
			   $query = $this->db->query("SELECT 
											   ec.id_sekolah, ec.no_npsn, ec.nama_sekolah
										  FROM ec_sekolah ec, fa_pjp fa
										  WHERE ec.id_sekolah = fa.id_tempat
												AND fa.id_jenis_lokasi = '".$this->db->escape_str($params['id_jenis_lokasi'])."'
												AND fa.hari IN (SELECT hari FROM ja_penjualan_tanggal WHERE tanggal = '".date('Y-m-d')."')
												AND fa.id_sales = '".$this->db->escape_str($users_id)."'
												AND ((ec.no_npsn LIKE '%".$this->db->escape_str($params['cari'])."%')
													  OR (ec.nama_sekolah LIKE '%".$this->db->escape_str($params['cari'])."%'))
										  ORDER by ec.nama_sekolah");
			   return $query->result_array();
		   }elseif($params['id_jenis_lokasi'] == 'KAM'){
			   $query = $this->db->query("SELECT 
											   ed.id_universitas, ed.no_npsn, ed.nama_universitas
										  FROM ed_kampus ed, fa_pjp fa
										  WHERE ed.id_universitas = fa.id_tempat
												AND fa.id_jenis_lokasi = '".$this->db->escape_str($params['id_jenis_lokasi'])."'
												AND fa.hari IN (SELECT hari FROM ja_penjualan_tanggal WHERE tanggal = '".date('Y-m-d')."')
												AND fa.id_sales = '".$this->db->escape_str($users_id)."'
												AND ((ed.no_npsn LIKE '%".$this->db->escape_str($params['cari'])."%')
													  OR (ed.nama_universitas LIKE '%".$this->db->escape_str($params['cari'])."%'))
										  ORDER by ed.nama_universitas");
			   return $query->result_array();
		   }elseif($params['id_jenis_lokasi'] == 'FAK'){
			   $query = $this->db->query("SELECT 
											   ee.id_fakultas, ed.nama_universitas, ee.nama_fakultas
										  FROM ee_fakultas ee, ed_kampus ed, fa_pjp fa
										  WHERE ee.id_universitas = ed.id_universitas
												AND ee.id_fakultas = fa.id_tempat
												AND fa.id_jenis_lokasi = '".$this->db->escape_str($params['id_jenis_lokasi'])."'
												AND fa.hari IN (SELECT hari FROM ja_penjualan_tanggal WHERE tanggal = '".date('Y-m-d')."')
												AND fa.id_sales = '".$this->db->escape_str($users_id)."'
												AND ((ee.nama_fakultas LIKE '%".$this->db->escape_str($params['cari'])."%')
													  OR (ed.nama_universitas LIKE '%".$this->db->escape_str($params['cari'])."%'))
										  ORDER by ee.nama_fakultas");
			   return $query->result_array();
		   }elseif($params['id_jenis_lokasi'] == 'POI'){
			   $query = $this->db->query("SELECT 
											   ef.id_poi, ef.nama_poi
										  FROM ef_poi ef, fa_pjp fa
										  WHERE ef.id_poi = fa.id_tempat
												AND fa.id_jenis_lokasi = '".$this->db->escape_str($params['id_jenis_lokasi'])."'
												AND fa.hari IN (SELECT hari FROM ja_penjualan_tanggal WHERE tanggal = '".date('Y-m-d')."')
												AND fa.id_sales = '".$this->db->escape_str($users_id)."'
												AND ef.nama_poi LIKE '%".$this->db->escape_str($params['cari'])."%'
										  ORDER by ef.nama_poi");
			   return $query->result_array();
		   }else{
			   return array('status' => 200,'message' => 'pencarian harus sekolah, kampus, fakultas, poi');
		   }
	   }else{
		   return array('status' => 200,'message' => 'role denied.');
	   }
   }
   
   //tampil
   public function tampil($id_jenis_lokasi,$id,$users_id,$role)
   {
	   if($role == '5' || $role == '6' || $role == '8')
	   {
		   if($id_jenis_lokasi == 'OUT')
		   {
			   $query = $this->db->query("SELECT 
											   eb.*
										  FROM eb_outlet eb, fa_pjp fa
										  WHERE eb.id_outlet = fa.id_tempat
												AND fa.id_jenis_lokasi = '".$this->db->escape_str($id_jenis_lokasi)."'
												AND fa.hari IN (SELECT hari FROM ja_penjualan_tanggal WHERE tanggal = '".date('Y-m-d')."')
												AND fa.id_sales = '".$this->db->escape_str($users_id)."'
												AND eb.id_outlet = '".$this->db->escape_str($id)."'");
			   return $query->result_array();
		   }else{
			   return array('status' => 200,'message' => 'pencarian harus outlet');
		   }
	   }elseif($role == '7'){
		   if($id_jenis_lokasi == 'SEK')
		   {
			   $query = $this->db->query("SELECT 
											   ec.*
										  FROM ec_sekolah ec, fa_pjp fa
										  WHERE ec.id_sekolah = fa.id_tempat
												AND fa.id_jenis_lokasi = '".$this->db->escape_str($id_jenis_lokasi)."'
												AND fa.hari IN (SELECT hari FROM ja_penjualan_tanggal WHERE tanggal = '".date('Y-m-d')."')
												AND fa.id_sales = '".$this->db->escape_str($users_id)."'
												AND ec.id_sekolah = '".$this->db->escape_str($id)."'
										  ORDER by ec.nama_sekolah");
			   return $query->result_array();
		   }elseif($id_jenis_lokasi == 'KAM'){
			   $query = $this->db->query("SELECT 
											   ed.*
										  FROM ed_kampus ed, fa_pjp fa
										  WHERE ed.id_universitas = fa.id_tempat
												AND fa.id_jenis_lokasi = '".$this->db->escape_str($id_jenis_lokasi)."'
												AND fa.hari IN (SELECT hari FROM ja_penjualan_tanggal WHERE tanggal = '".date('Y-m-d')."')
												AND fa.id_sales = '".$this->db->escape_str($users_id)."'
												AND ed.id_universitas = '".$this->db->escape_str($id)."'
										  ORDER by ed.nama_universitas");
			   return $query->result_array();
		   }elseif($id_jenis_lokasi == 'FAK'){
			   $query = $this->db->query("SELECT 
											   ee.*, ed.nama_universitas
										  FROM ee_fakultas ee, ed_kampus ed, fa_pjp fa
										  WHERE ee.id_universitas = ed.id_universitas
												AND ee.id_fakultas = fa.id_tempat
												AND fa.id_jenis_lokasi = '".$this->db->escape_str($id_jenis_lokasi)."'
												AND fa.hari IN (SELECT hari FROM ja_penjualan_tanggal WHERE tanggal = '".date('Y-m-d')."')
												AND fa.id_sales = '".$this->db->escape_str($users_id)."'
												AND ee.id_fakultas = '".$this->db->escape_str($id)."'
										  ORDER by ee.nama_fakultas");
			   return $query->result_array();
		   }elseif($id_jenis_lokasi == 'POI'){
			   $query = $this->db->query("SELECT 
											   ef.*
										  FROM ef_poi ef, fa_pjp fa
										  WHERE ef.id_poi = fa.id_tempat
												AND fa.id_jenis_lokasi = '".$this->db->escape_str($id_jenis_lokasi)."'
												AND fa.hari IN (SELECT hari FROM ja_penjualan_tanggal WHERE tanggal = '".date('Y-m-d')."')
												AND fa.id_sales = '".$this->db->escape_str($users_id)."'
												AND ef.id_poi = '".$this->db->escape_str($id)."'
										  ORDER by ef.nama_poi");
			   return $query->result_array();
		   }else{
			   return array('status' => 200,'message' => 'pencarian harus sekolah, kampus, fakultas, poi');
		   }
	   }else{
		   return array('status' => 200,'message' => 'role denied.');
	   }
   }
   
   //jumlah history pjp
   public function jumlah_history_pjp($id_jenis_lokasi,$id,$users_id,$role)
   {
	   if($role == '5' || $role == '6' || $role == '8')
	   {
		   if($id_jenis_lokasi == 'OUT')
		   {
			   $query = $this->db->query("SELECT 
											   COUNT(fb.id_history_pjp) AS jumlah_history_pjp
										  FROM fb_histroy_pjp fb
										  WHERE fb.id_sales = '".$this->db->escape_str($users_id)."'
												AND fb.id_tempat = '".$this->db->escape_str($id)."'
												AND fb.id_jenis_lokasi = '".$this->db->escape_str($id_jenis_lokasi)."'");
			   return $query->result_array();
		   }else{
			   return array('status' => 200,'message' => 'pencarian harus outlet');
		   }
	   }elseif($role == '7'){
		   if($id_jenis_lokasi == 'SEK' || $id_jenis_lokasi == 'KAM' || $id_jenis_lokasi == 'FAK' || $id_jenis_lokasi == 'POI')
		   {
			   $query = $this->db->query("SELECT 
											   COUNT(fb.id_history_pjp) AS jumlah_history_pjp
										  FROM fb_histroy_pjp fb
										  WHERE fb.id_sales = '".$this->db->escape_str($users_id)."'
												AND fb.id_tempat = '".$this->db->escape_str($id)."'
												AND fb.id_jenis_lokasi = '".$this->db->escape_str($id_jenis_lokasi)."'");
			   return $query->result_array();
		   }else{
			   return array('status' => 200,'message' => 'pencarian harus sekolah, kampus, fakultas, poi');
		   }
	   }else{
		   return array('status' => 200,'message' => 'role denied.');
	   }
   }
   
   //tampil history pjp
   public function tampil_history_pjp($id_jenis_lokasi,$id,$users_id,$page,$role)
   {
	   $limitpage = 50;
	   $limitawal = ($page-1)*$limitpage;
	   if($role == '5' || $role == '6' || $role == '8')
	   {
		   if($id_jenis_lokasi == 'OUT')
		   {
			   $query = $this->db->query("SELECT 
											   fb.tanggal,
											   fb.jam_clock_in, 
											   fb.jam_clock_out,
											   fb.status
										  FROM fb_histroy_pjp fb
										  WHERE fb.id_sales = '".$this->db->escape_str($users_id)."'
												AND fb.id_tempat = '".$this->db->escape_str($id)."'
												AND fb.id_jenis_lokasi = '".$this->db->escape_str($id_jenis_lokasi)."'
										  ORDER BY fb.tanggal,fb.jam_clock_in DESC LIMIT ".$limitawal.",".$limitpage."");
			   return $query->result_array();
		   }else{
			   return array('status' => 200,'message' => 'pencarian harus outlet');
		   }
	   }elseif($role == '7'){
		   if($id_jenis_lokasi == 'SEK' || $id_jenis_lokasi == 'KAM' || $id_jenis_lokasi == 'FAK' || $id_jenis_lokasi == 'POI')
		   {
			   $query = $this->db->query("SELECT 
											   fb.tanggal,
											   fb.jam_clock_in, 
											   fb.jam_clock_out,
											   fb.status
										  FROM fb_histroy_pjp fb
										  WHERE fb.id_sales = '".$this->db->escape_str($users_id)."'
												AND fb.id_tempat = '".$this->db->escape_str($id)."'
												AND fb.id_jenis_lokasi = '".$this->db->escape_str($id_jenis_lokasi)."'
										  ORDER BY fb.tanggal,fb.jam_clock_in DESC LIMIT ".$limitawal.",".$limitpage."");
			   return $query->result_array();
		   }else{
			   return array('status' => 200,'message' => 'pencarian harus sekolah, kampus, fakultas, poi');
		   }
	   }else{
		   return array('status' => 200,'message' => 'role denied.');
	   }
   }
   
   //retur sn
   public function retur_sn($params,$users_id)
   {
	   if(empty($params['sn_akhir']))
	   {
		   $query = $this->db->query("SELECT 
										   id_sales,
										   serial_number,
										   id_produk,
										   harga_modal,
										   harga_jual
									  FROM ia_distribusi_perdana
									  WHERE id_sales = '".$this->db->escape_str($users_id)."'
											AND status_distribusi = 'AVAILABLE'
											AND status_penjualan = 'BELUM TERJUAL'
											AND serial_number = '".$this->db->escape_str($params['sn_awal'])."'
									  ORDER BY serial_number");
	   }else{
		   $query = $this->db->query("SELECT 
										   id_sales,
										   serial_number,
										   id_produk,
										   harga_modal,
										   harga_jual
									  FROM ia_distribusi_perdana
									  WHERE id_sales = '".$this->db->escape_str($users_id)."'
											AND status_distribusi = 'AVAILABLE'
											AND status_penjualan = 'BELUM TERJUAL'
											AND serial_number >= '".$this->db->escape_str($params['sn_awal'])."'
											AND serial_number <= '".$this->db->escape_str($params['sn_akhir'])."'
									  ORDER BY serial_number");
	   }
	   return $query->result_array();
   }
   
   //retur submit
   public function retur_submit($params,$users_id)
   {
	   for($i=0; $i<count($params['data']); $i++)
	   {
		   $query_1 = $this->db->query("INSERT INTO ic_retur_sales
										(
											id_sales, 
											tgl_retur, 
											serial_number, 
											id_produk, 
											harga_modal, 
											harga_jual, 
											alasan, 
											status
										)
										VALUES
										(
											'".$users_id."',
											'".date('Y-m-d')."', 
											'".$params['data'][$i]['serial_number']."', 
											'".$params['data'][$i]['id_produk']."', 
											'".$params['data'][$i]['harga_modal']."', 
											'".$params['data'][$i]['harga_jual']."', 
											'".$params['alasan']."', 
											'WAITING APPROVAL'
										)");
		   $query_2 = $this->db->query("UPDATE ia_distribusi_perdana 
										SET status_distribusi = 'NOT AVAILABLE'
										WHERE serial_number = '".$params['data'][$i]['serial_number']."'
											  AND id_sales = '".$users_id."'");
	   }
	   return array('status' => 201,'message' => 'Data has been created.');
   }
   
   //retur list
   public function retur_list($tglawal,$tglakhir,$page,$users_id)
   {
	   $total = 0;
	   $query_1 = $this->db->query("SELECT 
									   serial_number
									FROM ic_retur_sales
									WHERE id_sales = '".$this->db->escape_str($users_id)."'
										  AND tgl_retur >= '".$this->db->escape_str($tglawal)."'
										  AND tgl_retur <= '".$this->db->escape_str($tglakhir)."'");
	   $total = $query_1->num_rows();
	   $limitpage = 50;
	   $limitawal = ($page-1)*$limitpage;
	   $query_2 = $this->db->query("SELECT 
									   serial_number, tgl_retur, tgl_approval, status
									FROM ic_retur_sales
									WHERE id_sales = '".$this->db->escape_str($users_id)."'
										AND tgl_retur >= '".$this->db->escape_str($tglawal)."'
										AND tgl_retur <= '".$this->db->escape_str($tglakhir)."'
									ORDER BY serial_number ASC LIMIT ".$limitawal.",".$limitpage."");
	   $data = $query_2->result_array();
	   
	   return array('status' => 201, 'total' => $total, 'limit_per_halaman' => $limitpage, 'data' => $data);
   }
   
   //retur list sn
   public function retur_list_sn($params,$users_id)
   {
	   $query = $this->db->query("SELECT 
									   serial_number, tgl_retur, tgl_approval, status
								  FROM ic_retur_sales
								  WHERE id_sales = '".$this->db->escape_str($users_id)."'
										AND tgl_retur >= '".$this->db->escape_str($params['tglawal'])."'
										AND tgl_retur <= '".$this->db->escape_str($params['tglakhir'])."'
										AND serial_number = '".$this->db->escape_str($params['serial_number'])."'");
	   return $query->result_array();
   }
   
   //pjp jumlah
   public function pjp_jumlah($users_id)
   {
	   $query = $this->db->query("SELECT * FROM
								  (
									   SELECT 
										   COUNT(id_history_pjp) AS jumlah_done
									   FROM fb_histroy_pjp
									   WHERE id_sales = '".$this->db->escape_str($users_id)."'
											 AND tanggal = '".date('Y-m-d')."'
											 AND (jam_clock_out <> '00:00:00')
								  )a,
								  (
									   SELECT 
										   COUNT(id_pjp) AS jumlah_pjp
									   FROM fa_pjp
									   WHERE id_sales = '".$this->db->escape_str($users_id)."'
											 AND hari IN (SELECT hari FROM ja_penjualan_tanggal WHERE tanggal = '".date('Y-m-d')."')
								  )b");
	   return $query->result_array();
   }
   
   //pjp daftar
   public function pjp_daftar($users_id)
   {
	   $query = $this->db->query("SELECT aa.*,bb.nama_kabupaten,bb.radius_clock_in,cc.jam_clock_in,cc.jam_clock_out, cc.status, cc.id_history_pjp
								  FROM 
								  (
									   SELECT 
										   a.*,b.tanggal,
										   case a.id_jenis_lokasi
											   when 'OUT' then (select nama_outlet from eb_outlet where id_outlet=a.id_tempat)
											   when 'SEK' then (select nama_sekolah from ec_sekolah where id_sekolah=a.id_tempat)
											   when 'KAM' then (select nama_universitas from ed_kampus where id_universitas=a.id_tempat)
											   when 'FAK' then (select nama_fakultas from ee_fakultas where id_fakultas=a.id_tempat)
											   when 'POI' then (select nama_poi from ef_poi where id_poi=a.id_tempat)
										   end as nama,
										   case a.id_jenis_lokasi
											   when 'OUT' then (select longitude from eb_outlet where id_outlet=a.id_tempat)
											   when 'SEK' then (select longitude from ec_sekolah where id_sekolah=a.id_tempat)
											   when 'KAM' then (select longitude from ed_kampus where id_universitas=a.id_tempat)
											   when 'FAK' then (select longitude from ee_fakultas where id_fakultas=a.id_tempat)
											   when 'POI' then (select longitude from ef_poi where id_poi=a.id_tempat)
										   end as longitude,
										   case a.id_jenis_lokasi
											   when 'OUT' then (select latitude from eb_outlet where id_outlet=a.id_tempat)
											   when 'SEK' then (select latitude from ec_sekolah where id_sekolah=a.id_tempat)
											   when 'KAM' then (select latitude from ed_kampus where id_universitas=a.id_tempat)
											   when 'FAK' then (select latitude from ee_fakultas where id_fakultas=a.id_tempat)
											   when 'POI' then (select latitude from ef_poi where id_poi=a.id_tempat)
										   end as latitude,
										   case a.id_jenis_lokasi
											   when 'OUT' then (select id_kelurahan from eb_outlet where id_outlet=a.id_tempat)
											   when 'SEK' then (select id_kelurahan from ec_sekolah where id_sekolah=a.id_tempat)
											   when 'KAM' then (select id_kelurahan from ed_kampus where id_universitas=a.id_tempat)
											   when 'FAK' then (select id_kelurahan from ee_fakultas where id_fakultas=a.id_tempat)
											   when 'POI' then (select id_kelurahan from ef_poi where id_poi=a.id_tempat)
										   end as id_kelurahan,
										   case a.id_jenis_lokasi
											   when 'OUT' then (select no_hp_owner from eb_outlet where id_outlet=a.id_tempat)
										   end as no_hp_owner
									   FROM 
										   fa_pjp a 
									   INNER JOIN 
										   (SELECT * FROM ja_penjualan_tanggal where tanggal = '".date('Y-m-d')."') b 
									   on a.id_sales = '".$this->db->escape_str($users_id)."' and a.hari = b.hari
								   ) aa
								   INNER JOIN
								   (
									   SELECT a.id_kelurahan,c.id_kabupaten,c.nama_kabupaten,c.radius_clock_in 
									   FROM cd_kelurahan a,cc_kecamatan b, cb_kabupaten c
									   WHERE a.id_kecamatan=b.id_kecamatan and b.id_kabupaten=c.id_kabupaten
								   ) bb 
								   on aa.id_kelurahan = bb.id_kelurahan
								   LEFT JOIN
								   fb_histroy_pjp cc
								   on aa.id_sales=cc.id_sales and aa.id_tempat=cc.id_tempat 
									  and aa.id_jenis_lokasi=cc.id_jenis_lokasi and aa.tanggal=cc.tanggal");
	   return $query->result_array();
   }
    
}
