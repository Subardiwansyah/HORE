<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClockinmarketauditModel extends CI_Model {

    //marketaudit create belanja
    public function marketaudit_create_belanja($users_id)
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
		//tempat
		$id_tempat = '';
        $query_2 = $this->db->query("SELECT id_jenis_lokasi, id_tempat
		                             FROM fb_histroy_pjp
		                             WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
		foreach($query_2->result_array() as $row_2)
		{
		    $id_tempat = $row_2['id_tempat'];
		}
		//upload foto			
        $tipenyaaa1 = '';
		$target_dir = "assets/marketaudit_foto/";
		if(is_uploaded_file($_FILES['myfile1']['tmp_name']))
		{
		    $uploadFile1 = $_FILES['myfile1'];
		    $extractFile1 = pathinfo($uploadFile1['name']);
		    $size1 = $_FILES['myfile1']['size'];
		    $tipe1 = $_FILES['myfile1']['type'];
		    $ftype1 = explode("/",$tipe1);
		    $ftypee1 = $ftype1[1];
	        if(move_uploaded_file($uploadFile1['tmp_name'],$target_dir.$this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share').".".$ftypee1))
	        {
                $tipenyaaa1 = $this->input->post('id_history_pjp')."_".$this->input->post('id_jenis_share').".".$ftypee1;
                $query_3 = $this->db->query("INSERT INTO ob_market_audit_outlet
                                             (
                                              tahun, bulan, minggu, tgl, 
                                              id_outlet, 
                                              id_jenis_share, 
                                              id_history_pjp,
                                              telkomsel, 
                                              isat, 
                                              xl, 
                                              tri, 
                                              smartfren, 
                                              axis, 
                                              other,
                                              foto_belanja,
                                              created_by
                                             )
                                             VALUES
                                             (
                                              '".$this->db->escape_str($tahun)."','".$this->db->escape_str($bulan)."','".$this->db->escape_str($minggu)."','".date('Y-m-d')."',
                                              '".$this->db->escape_str($id_tempat)."','".$this->db->escape_str($this->input->post('id_jenis_share'))."',
                                              '".$this->db->escape_str($this->input->post('id_history_pjp'))."',
                                              '".$this->db->escape_str($this->input->post('telkomsel'))."',
                                              '".$this->db->escape_str($this->input->post('isat'))."',
                                              '".$this->db->escape_str($this->input->post('xl'))."',
                                              '".$this->db->escape_str($this->input->post('tri'))."',
                                              '".$this->db->escape_str($this->input->post('smartfren'))."',
                                              '".$this->db->escape_str($this->input->post('axis'))."',
                                              '".$this->db->escape_str($this->input->post('other'))."',
                                              '".$this->db->escape_str($tipenyaaa1)."',
                                              '".$this->db->escape_str($users_id)."'
                                             )");
                $query_4 = $this->db->query("UPDATE fb_histroy_pjp 
	                                         SET foto_marketaudit_belanja = 'completed'
	                                         WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
		    return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'foto berhasil di upload');
	        }else{
		    return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'foto yang di upload gagal');
	        }
		}else{
    		    return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'foto yang di upload gagal');
		}  
    }
    
    //marketaudit create sales_voucher
    public function marketaudit_create_broadband_voucher($params, $users_id)
    {
        //tempat
		$id_tempat = '';
        $query_1 = $this->db->query("SELECT id_jenis_lokasi, id_tempat
		                             FROM fb_histroy_pjp
		                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
		foreach($query_1->result_array() as $row_1)
		{
		    $id_tempat = $row_1['id_tempat'];
		}
        if($params['id_jenis_share'] == 'SALES_BROADBAND')
        {
            $params['id_outlet'] = $id_tempat;
		    $this->db->insert('ob_market_audit_outlet',$params);
            $query_2 = $this->db->query("UPDATE fb_histroy_pjp 
		                               SET data_marketaudit_broadband = 'completed'
		                               WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
        }
        if($params['id_jenis_share'] == 'VOUCHER_FISIK')
        {
            $params['id_outlet'] = $id_tempat;
		    $this->db->insert('ob_market_audit_outlet',$params);
            $query_2 = $this->db->query("UPDATE fb_histroy_pjp 
		                               SET data_marketaudit_voucher = 'completed'
		                               WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
        }
        return array('status' => 200, 'message' => 'Data has been created.');
    }
    
    
    
    //marketaudit create quisioner
    public function marketaudit_create_quisioner($params, $users_id)
    {
        //tempat
		$id_tempat = $id_jenis_lokasi = '';
        $query_1 = $this->db->query("SELECT id_jenis_lokasi, id_tempat
		                             FROM fb_histroy_pjp
		                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
		foreach($query_1->result_array() as $row_1)
		{
		    $id_tempat = $row_1['id_tempat'];
		    $id_jenis_lokasi = $row_1['id_jenis_lokasi'];
		}
		if($id_jenis_lokasi == 'SEK')
		{
            $params['id_sekolah'] = $id_tempat;
	        $this->db->insert('oj_market_audit_res_sekolah',$params);
		}
		if($id_jenis_lokasi == 'KAM')
		{
            $params['id_universitas'] = $id_tempat;
            $this->db->insert('ol_market_audit_res_kampus',$params);
		}
		if($id_jenis_lokasi == 'FAK')
		{
            $params['id_fakultas'] = $id_tempat;
            $this->db->insert('ok_market_audit_res_fakultas',$params);
		}
        $query_2 = $this->db->query("UPDATE fb_histroy_pjp 
	                                 SET data_marketaudit_quisioner = 'completed'
	                                 WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
        return array('status' => 200, 'message' => 'Data has been created.');
    }
    
	
}