<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClockoutModel extends CI_Model {

    //pjp upload foto
    public function pjp_upload_foto($users_id)
    {
	    $tipenyaaa1 = '';
		$target_dir = "assets/pjp_upload_foto/";
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
                                           SET foto_status_close = '".$this->db->escape_str($tipenyaaa1)."'
                                           WHERE id_history_pjp = '".$this->db->escape_str($this->input->post('id_history_pjp'))."'");
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Foto berhasil di upload.');
	        }else{
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => $_FILES['myfile1']);
	        }
		}else{
		    return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => $_FILES['myfile1']);
		}  
    }

    //pjp clockout
    public function pjp_clockout($params, $users_id, $role)
    {
        $query = $this->db->query("SELECT * 
                                   FROM fb_histroy_pjp
                                   WHERE id_history_pjp = '".$this->db->escape_str($this->db->escape_str($params['id_history_pjp']))."'");
        foreach($query->result_array() as $row)
        {
            if($row['status'] == 'CLOSE')
            {
                if($row['clockin_distribusi'] == 'DISABLED' && $row['clockin_merchandising'] == 'DISABLED' && $row['clockin_promotion'] == 'DISABLED' && $row['clockin_marketaudit'] == 'DISABLED' && $row['clockin_report_mt'] == 'DISABLED' && $row['foto_status_close'] != '')
                { 
                    $query = $this->db->query("UPDATE fb_histroy_pjp
                                               SET jam_clock_out = '".date('H:i:s')."'
                                               WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
                    return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Clockut berhasil.');
                }else{
                    return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Anda harus upload foto terlebih dahulu.');
                }
            }
            if($row['status'] == 'OPEN')
            {
                if($role == '5')
                {
                    if($row['clockin_distribusi'] == 'FINISH' && $row['clockin_merchandising'] == 'FINISH' && $row['clockin_promotion'] == 'FINISH' && $row['clockin_marketaudit'] == 'FINISH')
                    { 
                        $query = $this->db->query("UPDATE fb_histroy_pjp
                                                   SET jam_clock_out = '".date('H:i:s')."'
                                                   WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
                        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Clockut berhasil.');
                    }else{
                        return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Anda harus menyelesaikan distribution, merchandising, promotion, market audit terlebih dahulu.');
                    }
                }
                if($role == '6')
                {
                    if($row['clockin_distribusi'] == 'FINISH')
                    { 
                        $query = $this->db->query("UPDATE fb_histroy_pjp
                                                   SET jam_clock_out = '".date('H:i:s')."'
                                                   WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
                        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Clockut berhasil.');
                    }else{
                        return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Anda harus menyelesaikan distribusi terlebih dahulu.');
                    }
                }
                if($role == '7')
                {
                    if($row['id_jenis_lokasi'] == 'SEK' || $row['id_jenis_lokasi'] == 'KAM' || $row['id_jenis_lokasi'] == 'FAK')
                    { 
                        if($row['clockin_distribusi'] == 'FINISH' && $row['clockin_merchandising'] == 'FINISH' && $row['clockin_promotion'] == 'FINISH' && $row['clockin_marketaudit'] == 'FINISH')
                        { 
                            $query = $this->db->query("UPDATE fb_histroy_pjp
                                                       SET jam_clock_out = '".date('H:i:s')."'
                                                       WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
                            return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Clockut berhasil.');
                        }else{
                            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Anda harus menyelesaikan distribution, merchandising, promotion, market audit terlebih dahulu.');
                        }
                    }
                    if($row['id_jenis_lokasi'] == 'POI')
                    {     
                        if($row['clockin_distribusi'] == 'FINISH' && $row['clockin_promotion'] == 'FINISH')
                        { 
                            $query = $this->db->query("UPDATE fb_histroy_pjp
                                                       SET jam_clock_out = '".date('H:i:s')."'
                                                       WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
                            return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Clockut berhasil.');
                        }else{
                            return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Anda harus menyelesaikan distribusi terlebih dahulu.');
                        }
                    }
                }
                if($role == '8')
                {
                    if($row['clockin_distribusi'] == 'FINISH' && $row['clockin_report_mt'] == 'FINISH')
                    { 
                        $query = $this->db->query("UPDATE fb_histroy_pjp
                                                   SET jam_clock_out = '".date('H:i:s')."'
                                                   WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
                        return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Clockut berhasil.');
                    }else{
                        return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Anda harus menyelesaikan distribution dan report terlebih dahulu.');

                    }
                }
            }
        }
    }

}