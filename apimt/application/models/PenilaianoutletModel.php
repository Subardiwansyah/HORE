<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenilaianoutletModel extends CI_Model {
    
    //penilaian
    public function penilaian($id_outlet)
    {
        //availability
        $query = $this->db->query("SELECT 
                                     a.id AS id_parameter, REPLACE(a.parameter, '/r/n', '') AS parameter, a.kategori, a.key_kategori
		                           FROM za_penilaian_outlet_parameter a, za_penilaian_outlet_jenis b
		                           WHERE a.id_jenis = b.id
		                                 AND a.status = 'AKTIF'
		                                 AND b.id = '1'
		                           ORDER BY b.id, a.id");
        $data = $query->result_array();
        //visibility
        $query_1 = $this->db->query("SELECT 
                                        a.id AS id_parameter, REPLACE(a.parameter, '/r/n', '') AS parameter, a.kategori, a.key_kategori
		                             FROM za_penilaian_outlet_parameter a, za_penilaian_outlet_jenis b
		                             WHERE a.id_jenis = b.id
		                                 AND a.status = 'AKTIF'
		                                 AND b.id = '2'
		                             ORDER BY b.id, a.id");
        $data_1 = $query_1->result_array();
        //advokasi
        $query_2 = $this->db->query("SELECT 
                                        a.id AS id_parameter, REPLACE(a.parameter, '/r/n', '') AS parameter, a.kategori, a.key_kategori
		                             FROM za_penilaian_outlet_parameter a, za_penilaian_outlet_jenis b
		                             WHERE a.id_jenis = b.id
		                                 AND a.status = 'AKTIF'
		                                 AND b.id = '3'
		                             ORDER BY b.id, a.id");
        $data_2 = $query_2->result_array();
        //return
        return array('status' => 200, 'id_outlet' => $id_outlet, 
                     'data' => array(
                                     'AVAILABILITY' => $data,
                                     'VISIBILITY' => $data_1,
                                     'ADVOKASI' => $data_2,
	                                )
	                );
    }
    
    
    //kirim_availability
    public function kirim_availability($data, $users_id, $role, $id_divisi)
    {
        //minggu
		$tahun = $bulan = $minggu = 0;
		$query_1 = $this->db->query("SELECT tahun, bulan, minggu
    		                         FROM ja_penjualan_tanggal
    		                         WHERE tanggal = '".date('Y-m-d')."'"); 
        foreach ($query_1->result_array() as $row_1)
		{
			$tahun = $row_1['tahun'];
			$bulan = $row_1['bulan'];
			$minggu = $row_1['minggu'];
		}
		//nama_file
		$milik = 1;
		$query_2 = $this->db->query("SELECT id
    		                         FROM za_penilaian_outlet_pavailability
    		                         ORDER BY id DESC LIMIT 1"); 
        foreach ($query_2->result_array() as $row_2)
		{
		    $milik = $row_2['id'] + 1;
		}
        //upload file fisik
	    $tipenyaaa1 = $tipenyaaa2 = '';
		$target_dir = "assets/penilaian_foto/";
		//ke satu
		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
		{
		    $uploadFile1 = $_FILES['myfile1'];
		    $extractFile1 = pathinfo($uploadFile1['name']);
		    $size1 = $_FILES['myfile1']['size'];
		    $tipe1 = $_FILES['myfile1']['type'];
		    $ftype1 = explode("/",$tipe1);
		    $ftypee1 = $ftype1[1];
	        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$id_divisi."_".$milik."_PR.".$ftypee1))
	        {
                $tipenyaaa1 = $id_divisi."_".$milik."_PR.".$ftypee1;
	        }
		}
		//ke dua
		if(is_uploaded_file($_FILES['myfile2']['tmp_name']))
	    {
		    //ke dua
		    $uploadFile2 = $_FILES['myfile2'];
		    $extractFile2 = pathinfo($uploadFile2['name']);
		    $size2 = $_FILES['myfile2']['size'];
		    $tipe2 = $_FILES['myfile2']['type'];
		    $ftype2 = explode("/",$tipe2);
		    $ftypee2 = $ftype2[1];
	        if(move_uploaded_file($uploadFile2['tmp_name'],$target_dir.$id_divisi."_".$milik."_VF.".$ftypee2))
	        {
                $tipenyaaa2 = $id_divisi."_".$milik."_VF.".$ftypee2;
	        }
	    }
        $query_3 = $this->db->query("INSERT INTO za_penilaian_outlet_pavailability
                                     (
                                      tahun, bulan, minggu, tanggal, 
                                      id_outlet, 
                                      perdana_segel, sa_ld, sa_md, sa_hd, 
                                      perdana_xl, perdana_isat, perdana_axis, perdana_tri, perdana_smartfren, perdana_others,
                                      vf_segel, vf_ld, vf_md, vf_hd,
                                      vf_xl, vf_isat, vf_axis, vf_tri, vf_smartfren, vf_others,
                                      digipos, saldo_la,
                                      foto_perdana, foto_voucher_fisik,
                                      created_by
                                     )
                                     VALUES
                                     (
                                      '".$tahun."','".$bulan."','".$minggu."','".date('Y-m-d')."',
                                      '".$this->db->escape_str($this->input->post('id_outlet'))."',
                                      '".$this->db->escape_str($this->input->post('1'))."', '".$this->db->escape_str($this->input->post('2'))."', '".$this->db->escape_str($this->input->post('3'))."', '".$this->db->escape_str($this->input->post('4'))."', 
                                      '".$this->db->escape_str($this->input->post('5'))."', '".$this->db->escape_str($this->input->post('6'))."', '".$this->db->escape_str($this->input->post('7'))."', '".$this->db->escape_str($this->input->post('8'))."', '".$this->db->escape_str($this->input->post('9'))."', '".$this->db->escape_str($this->input->post('10'))."',
                                      '".$this->db->escape_str($this->input->post('11'))."', '".$this->db->escape_str($this->input->post('12'))."', '".$this->db->escape_str($this->input->post('13'))."', '".$this->db->escape_str($this->input->post('14'))."',
                                      '".$this->db->escape_str($this->input->post('15'))."', '".$this->db->escape_str($this->input->post('16'))."', '".$this->db->escape_str($this->input->post('17'))."', '".$this->db->escape_str($this->input->post('18'))."', '".$this->db->escape_str($this->input->post('19'))."', '".$this->db->escape_str($this->input->post('20'))."',
                                      '".$this->db->escape_str($this->input->post('21'))."', '".$this->db->escape_str($this->input->post('22'))."',
                                      '".$tipenyaaa1."', '".$tipenyaaa2."',
                                      '".$users_id."'
                                     )");      
        $query_4 = $this->db->query("INSERT INTO za_mt_penilaian_outlet
                                     ( id_outlet, tanggal, keterangan, created_by )
                                     VALUES
                                     (
                                      '".$this->db->escape_str($this->input->post('id_outlet'))."',
                                      '".date('Y-m-d')."',
                                      'penilaian outlet',
                                      '".$users_id."'
                                     )");      
		return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');
    }
    
    
    //kirim_visibilty
    public function kirim_visibility($data, $users_id, $role, $id_divisi)
    {
        //minggu
		$tahun = $bulan = $minggu = 0;
		$query_1 = $this->db->query("SELECT tahun, bulan, minggu
    		                         FROM ja_penjualan_tanggal
    		                         WHERE tanggal = '".date('Y-m-d')."'"); 
        foreach ($query_1->result_array() as $row_1)
		{
			$tahun = $row_1['tahun'];
			$bulan = $row_1['bulan'];
			$minggu = $row_1['minggu'];
		}
		//nama_file
		$milik = 1;
		$query_2 = $this->db->query("SELECT id
    		                         FROM za_penilaian_outlet_pvisibility
    		                         ORDER BY id DESC LIMIT 1"); 
        foreach ($query_2->result_array() as $row_2)
		{
		    $milik = $row_2['id'] + 1;
		}
        //upload file fisik
	    $tipenyaaa1 = $tipenyaaa2 = '';
		$target_dir = "assets/penilaian_foto/";
		//ke satu
		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
		{
		    $uploadFile1 = $_FILES['myfile1'];
		    $extractFile1 = pathinfo($uploadFile1['name']);
		    $size1 = $_FILES['myfile1']['size'];
		    $tipe1 = $_FILES['myfile1']['type'];
		    $ftype1 = explode("/",$tipe1);
		    $ftypee1 = $ftype1[1];
	        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$id_divisi."_".$milik."_ET.".$ftypee1))
	        {
                $tipenyaaa1 = $id_divisi."_".$milik."_ET.".$ftypee1;
	        }
		}
		//ke dua
		if(is_uploaded_file($_FILES['myfile2']['tmp_name']))
	    {
		    //ke dua
		    $uploadFile2 = $_FILES['myfile2'];
		    $extractFile2 = pathinfo($uploadFile2['name']);
		    $size2 = $_FILES['myfile2']['size'];
		    $tipe2 = $_FILES['myfile2']['type'];
		    $ftype2 = explode("/",$tipe2);
		    $ftypee2 = $ftype2[1];
	        if(move_uploaded_file($uploadFile2['tmp_name'],$target_dir.$id_divisi."_".$milik."_PS.".$ftypee2))
	        {
                $tipenyaaa2 = $id_divisi."_".$milik."_PS.".$ftypee2;
	        }
	    }
	    //ke tiga
    	if(is_uploaded_file($_FILES['myfile3']['tmp_name']))
	    {
		    //ke tiga
		    $uploadFile3 = $_FILES['myfile3'];
		    $extractFile3 = pathinfo($uploadFile3['name']);
		    $size3 = $_FILES['myfile3']['size'];
		    $tipe3 = $_FILES['myfile3']['type'];
		    $ftype3 = explode("/",$tipe3);
		    $ftypee3 = $ftype3[1];
	        if(move_uploaded_file($uploadFile3['tmp_name'],$target_dir.$id_divisi."_".$milik."_LT.".$ftypee3))
	        {
                $tipenyaaa3 = $id_divisi."_".$milik."_LT.".$ftypee1;
	        }
	    }
        $query_3 = $this->db->query("INSERT INTO za_penilaian_outlet_pvisibility
                                     (
                                      tahun, bulan, minggu, tanggal, 
                                      id_outlet, 
                                      diamond_hotspot,
                                      poster_tsel, 
                                      poster_xl, poster_isat, poster_axis, poster_tri, poster_smartfren, poster_others,
                                      layar_toko_tsel, 
                                      layar_toko_xl, layar_toko_isat, layar_toko_axis, layar_toko_tri, layar_toko_smartfren, layar_toko_others,
                                      stiker_omni,
                                      foto_etalase, foto_poster, foto_layar_toko,
                                      created_by
                                     )
                                     VALUES
                                     (
                                      '".$tahun."','".$bulan."','".$minggu."','".date('Y-m-d')."',
                                      '".$this->input->post('id_outlet')."',
                                      '".$this->input->post('23')."',
                                      '".$this->input->post('24')."',
                                      '".$this->input->post('25')."', '".$this->input->post('26')."', '".$this->input->post('27')."', '".$this->input->post('28')."', '".$this->input->post('29')."', '".$this->input->post('30')."',
                                      '".$this->input->post('31')."',
                                      '".$this->input->post('32')."', '".$this->input->post('33')."', '".$this->input->post('34')."', '".$this->input->post('35')."', '".$this->input->post('36')."', '".$this->input->post('37')."',
                                      '".$this->input->post('38')."',
                                      '".$tipenyaaa1."', '".$tipenyaaa2."', '".$tipenyaaa3."',
                                      '".$users_id."'
                                     )");
        $query_4 = $this->db->query("INSERT INTO za_mt_penilaian_outlet
                                     ( id_outlet, tanggal, keterangan, created_by )
                                     VALUES
                                     (
                                      '".$this->db->escape_str($this->input->post('id_outlet'))."',
                                      '".date('Y-m-d')."',
                                      'penilaian outlet',
                                      '".$users_id."'
                                     )");                                  
		return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');
    }
    
    
    //kirim_advokasi
    public function kirim_advokasi($data, $users_id, $role, $id_divisi)
    {
        //minggu
		$tahun = $bulan = $minggu = 0;
		$query_1 = $this->db->query("SELECT tahun, bulan, minggu
    		                         FROM ja_penjualan_tanggal
    		                         WHERE tanggal = '".date('Y-m-d')."'"); 
        foreach ($query_1->result_array() as $row_1)
		{
			$tahun = $row_1['tahun'];
			$bulan = $row_1['bulan'];
			$minggu = $row_1['minggu'];
		}
        $query_2 = $this->db->query("SELECT 
                                        a.id AS id_parameter
		                             FROM za_penilaian_outlet_parameter a, za_penilaian_outlet_jenis b
		                             WHERE a.id_jenis = b.id
		                                 AND a.status = 'AKTIF'
		                                 AND b.id = '3'
		                             ORDER BY b.id, a.id");
        foreach ($query_2->result_array() as $row_2)
		{
            $query_3 = $this->db->query("INSERT INTO za_penilaian_outlet_padvokasi
                                        (
                                        tahun, bulan, minggu, tanggal, 
                                        id_outlet, 
                                        id_parameter,
                                        pilihan,
                                        created_by
                                        )
                                        VALUES
                                        (
                                        '".$tahun."','".$bulan."','".$minggu."','".date('Y-m-d')."',
                                        '".$this->input->post('id_outlet')."',
                                        '".$row_2['id_parameter']."',
                                        '".$this->input->post($row_2['id_parameter'])."',
                                        '".$users_id."'
                                        )");
        }
        $query_4 = $this->db->query("INSERT INTO za_mt_penilaian_outlet
                                     ( id_outlet, tanggal, keterangan, created_by )
                                     VALUES
                                     (
                                      '".$this->db->escape_str($this->input->post('id_outlet'))."',
                                      '".date('Y-m-d')."',
                                      'penilaian outlet',
                                      '".$users_id."'
                                     )");                                  
		return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');
    }
    
    
}
