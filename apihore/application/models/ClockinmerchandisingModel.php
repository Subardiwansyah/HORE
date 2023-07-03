<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClockinmerchandisingModel extends CI_Model {

    //merchandising create
    public function merchandising_create($users_id)
    {
        //minggu
        $tahun = $bulan = $minggu = $total = 0;
		$query_1 = $this->db->query("SELECT tahun, bulan, minggu
    		                         FROM ja_penjualan_tanggal
    		                         WHERE tanggal = '".date('Y-m-d')."'"); 
        foreach ($query_1->result_array() as $row_1)
		{
			$tahun = $row_1['tahun'];
			$bulan = $row_1['bulan'];
			$minggu = $row_1['minggu'];
		}
		//total
		$total = $this->input->post('telkomsel') + $this->input->post('isat') + $this->input->post('xl') + $this->input->post('tri') + $this->input->post('smartfren') + $this->input->post('axis') + $this->input->post('other');
		//jenis lokasi
		$id_jenis_lokasi = $id_tempat = '';
        $query_2 = $this->db->query("SELECT id_jenis_lokasi, id_tempat
		                             FROM fb_histroy_pjp
		                             WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
		foreach($query_2->result_array() as $row_2)
		{
		    $id_jenis_lokasi = $row_2['id_jenis_lokasi'];
		    $id_tempat = $row_2['id_tempat'];
		}
		if($id_jenis_lokasi == 'OUT')
		{
		    //upload file fisik
    	    $tipenyaaa1 = $tipenyaaa2 = $tipenyaaa3 = '';
    		$target_dir = "assets/merchandising_foto/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F1.".$ftypee1))
		        {
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F1.".$ftypee1;
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
		        if(move_uploaded_file($uploadFile2['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F2.".$ftypee2))
		        {
	                $tipenyaaa2 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F2.".$ftypee2;
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
		        if(move_uploaded_file($uploadFile3['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F3.".$ftypee3))
		        {
	                $tipenyaaa3 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F3.".$ftypee1;
		        }
		    }
    		$query_3 = $this->db->query("INSERT INTO mb_merchandising_outlet
    		                             (
    		                                tahun, bulan, minggu, tgl, 
    		                                id_outlet, id_jenis_share,
    		                                telkomsel, isat, 
    		                                xl, tri, 
    		                                smartfren, axis, 
    		                                other,
    		                                total,
    		                                foto_1,
    		                                foto_2,
    		                                foto_3,
    		                                created_by
    		                             )
    		                             VALUES
    		                             (
    		                                '".$this->db->escape_str($tahun)."', '".$this->db->escape_str($bulan)."', '".$this->db->escape_str($minggu)."', '".date('Y-m-d')."',
    		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_share'))."',
    		                                '".$this->db->escape_str($this->input->post('telkomsel'))."', '".$this->db->escape_str($this->input->post('isat'))."',
    		                                '".$this->db->escape_str($this->input->post('xl'))."', '".$this->db->escape_str($this->input->post('tri'))."',
    		                                '".$this->db->escape_str($this->input->post('smartfren'))."', '".$this->db->escape_str($this->input->post('axis'))."',
    		                                '".$this->db->escape_str($this->input->post('other'))."',
    		                                '".$this->db->escape_str($total)."',
    		                                '".$this->db->escape_str($tipenyaaa1)."',
    		                                '".$this->db->escape_str($tipenyaaa2)."',
    		                                '".$this->db->escape_str($tipenyaaa3)."',
    		                                '".$this->db->escape_str($users_id)."'
    		                             )");
		}
		if($id_jenis_lokasi == 'SEK')
		{
		    //upload file fisik
    	    $tipenyaaa1 = $tipenyaaa2 = $tipenyaaa3 = '';
    		$target_dir = "assets/merchandising_foto/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F1.".$ftypee1))
		        {
	                $tipenyaaa1 =$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F1.".$ftypee1;
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
		        if(move_uploaded_file($uploadFile2['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F2.".$ftypee2))
		        {
	                $tipenyaaa2 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F2.".$ftypee2;
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
		        if(move_uploaded_file($uploadFile3['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F3.".$ftypee3))
		        {
	                $tipenyaaa3 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F3.".$ftypee3;
		        }
		    }
    		$query_3 = $this->db->query("INSERT INTO mc_merchandising_sekolah
    		                             (
    		                                tahun, bulan, minggu, tgl, 
    		                                id_sekolah, id_jenis_share,
    		                                telkomsel, isat, 
    		                                xl, tri, 
    		                                smartfren, axis, 
    		                                other,
    		                                total,
    		                                foto_1,
    		                                foto_2,
    		                                foto_3,
    		                                created_by
    		                             )
    		                             VALUES
    		                             (
    		                                '".$this->db->escape_str($tahun)."', '".$this->db->escape_str($bulan)."', '".$this->db->escape_str($minggu)."', '".date('Y-m-d')."',
    		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_share'))."',
    		                                '".$this->db->escape_str($this->input->post('telkomsel'))."', '".$this->db->escape_str($this->input->post('isat'))."',
    		                                '".$this->db->escape_str($this->input->post('xl'))."', '".$this->db->escape_str($this->input->post('tri'))."',
    		                                '".$this->db->escape_str($this->input->post('smartfren'))."', '".$this->db->escape_str($this->input->post('axis'))."',
    		                                '".$this->db->escape_str($this->input->post('other'))."',
    		                                '".$this->db->escape_str($total)."',
    		                                '".$this->db->escape_str($tipenyaaa1)."',
    		                                '".$this->db->escape_str($tipenyaaa2)."',
    		                                '".$this->db->escape_str($tipenyaaa3)."',
    		                                '".$this->db->escape_str($users_id)."'
    		                             )");
		}
		if($id_jenis_lokasi == 'KAM')
		{
		    //upload file fisik
    	    $tipenyaaa1 = $tipenyaaa2 = $tipenyaaa3 = '';
    		$target_dir = "assets/merchandising_foto/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F1.".$ftypee1))
		        {
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F1.".$ftypee1;
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
		        if(move_uploaded_file($uploadFile2['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F2.".$ftypee2))
		        {
	                $tipenyaaa2 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F2.".$ftypee2;
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
		        if(move_uploaded_file($uploadFile3['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F3.".$ftypee3))
		        {
	                $tipenyaaa3 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F3.".$ftypee3;
		        }
		    }
    		$query_3 = $this->db->query("INSERT INTO md_merchandising_kampus
    		                             (
    		                                tahun, bulan, minggu, tgl, 
    		                                id_universitas, id_jenis_share,
    		                                telkomsel, isat, 
    		                                xl, tri, 
    		                                smartfren, axis, 
    		                                other,
    		                                total,
    		                                foto_1,
    		                                foto_2,
    		                                foto_3,
    		                                created_by
    		                             )
    		                             VALUES
    		                             (
    		                                '".$this->db->escape_str($tahun)."', '".$this->db->escape_str($bulan)."', '".$this->db->escape_str($minggu)."', '".date('Y-m-d')."',
    		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_share'))."',
    		                                '".$this->db->escape_str($this->input->post('telkomsel'))."', '".$this->db->escape_str($this->input->post('isat'))."',
    		                                '".$this->db->escape_str($this->input->post('xl'))."', '".$this->db->escape_str($this->input->post('tri'))."',
    		                                '".$this->db->escape_str($this->input->post('smartfren'))."', '".$this->db->escape_str($this->input->post('axis'))."',
    		                                '".$this->db->escape_str($this->input->post('other'))."',
    		                                '".$this->db->escape_str($total)."',
    		                                '".$this->db->escape_str($tipenyaaa1)."',
    		                                '".$this->db->escape_str($tipenyaaa2)."',
    		                                '".$this->db->escape_str($tipenyaaa3)."',
    		                                '".$this->db->escape_str($users_id)."'
    		                             )");
		}
		if($id_jenis_lokasi == 'FAK')
		{
		    //upload file fisik
    	    $tipenyaaa1 = $tipenyaaa2 = $tipenyaaa3 = '';
    		$target_dir = "assets/merchandising_foto/";
    		//ke satu
    		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
    		{
    		    $uploadFile1 = $_FILES['myfile1'];
    		    $extractFile1 = pathinfo($uploadFile1['name']);
    		    $size1 = $_FILES['myfile1']['size'];
    		    $tipe1 = $_FILES['myfile1']['type'];
    		    $ftype1 = explode("/",$tipe1);
    		    $ftypee1 = $ftype1[1];
		        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F1.".$ftypee1))
		        {
	                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F1.".$ftypee1;
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
		        if(move_uploaded_file($uploadFile2['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F2.".$ftypee2))
		        {
	                $tipenyaaa2 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F2.".$ftypee2;
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
		        if(move_uploaded_file($uploadFile3['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F3.".$ftypee3))
		        {
	                $tipenyaaa3 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share')."_F3.".$ftypee3;
		        }
		    }
    		$query_3 = $this->db->query("INSERT INTO me_merchandising_fakultas
    		                             (
    		                                tahun, bulan, minggu, tgl, 
    		                                id_fakultas, id_jenis_share,
    		                                telkomsel, isat, 
    		                                xl, tri, 
    		                                smartfren, axis, 
    		                                other,
    		                                total,
    		                                foto_1,
    		                                foto_2,
    		                                foto_3,
    		                                created_by
    		                             )
    		                             VALUES
    		                             (
    		                                '".$this->db->escape_str($tahun)."', '".$this->db->escape_str($bulan)."', '".$this->db->escape_str($minggu)."', '".date('Y-m-d')."',
    		                                '".$this->db->escape_str($id_tempat)."', '".$this->db->escape_str($this->input->post('id_jenis_share'))."',
    		                                '".$this->db->escape_str($this->input->post('telkomsel'))."', '".$this->db->escape_str($this->input->post('isat'))."',
    		                                '".$this->db->escape_str($this->input->post('xl'))."', '".$this->db->escape_str($this->input->post('tri'))."',
    		                                '".$this->db->escape_str($this->input->post('smartfren'))."', '".$this->db->escape_str($this->input->post('axis'))."',
    		                                '".$this->db->escape_str($this->input->post('other'))."',
    		                                '".$this->db->escape_str($total)."',
    		                                '".$this->db->escape_str($tipenyaaa1)."',
    		                                '".$this->db->escape_str($tipenyaaa2)."',
    		                                '".$this->db->escape_str($tipenyaaa3)."',
    		                                '".$this->db->escape_str($users_id)."'
    		                             )");
		}
		if($this->input->post('id_jenis_share') == 'PERDANA')
		{
		    $query_4 = $this->db->query("UPDATE fb_histroy_pjp 
		                                 SET foto_merchandising_perdana = 'completed'
		                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
		}
		if($this->input->post('id_jenis_share') == 'VOUCHER_FISIK')
		{
		    $query_4 = $this->db->query("UPDATE fb_histroy_pjp 
		                                 SET foto_merchandising_voucher_fisik = 'completed'
		                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
		}
		if($this->input->post('id_jenis_share') == 'BACKDROP')
		{
		    $query_4 = $this->db->query("UPDATE fb_histroy_pjp 
		                                 SET foto_merchandising_backdrop = 'completed'
		                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
		}
		if($this->input->post('id_jenis_share') == 'PAPAN_NAMA')
		{
		    $query_4 = $this->db->query("UPDATE fb_histroy_pjp 
		                                 SET foto_merchandising_papannama = 'completed'
		                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
		}
		if($this->input->post('id_jenis_share') == 'POSTER')
		{
		    $query_4 = $this->db->query("UPDATE fb_histroy_pjp 
		                                 SET foto_merchandising_poster = 'completed'
		                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
		}
		if($this->input->post('id_jenis_share') == 'SPANDUK')
		{
		    $query_4 = $this->db->query("UPDATE fb_histroy_pjp 
		                                 SET foto_merchandising_spanduk = 'completed'
		                                 WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
		}
		return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Data has been created.');
    }
    
	
}