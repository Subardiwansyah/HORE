<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClockinmenuModel extends CI_Model {

    //pjp clockin menu status
    public function pjp_clockin_menu_status($params,$users_id)
    {
        $query = $this->db->query("SELECT 
                                        status,
                                        clockin_distribusi, 
                                        clockin_merchandising, 
                                        clockin_promotion, 
                                        clockin_marketaudit, 
                                        clockin_report_mt
    		                       FROM fb_histroy_pjp
    		                       WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
        return $query->result_array();
    }

    //pjp clockin menu start
    public function pjp_clockin_menu_start($params,$users_id)
    {
        if($params['menu_clockin'] == 'DISTRIBUTION')
        {
            $query = $this->db->query("SELECT id_history_pjp
    		                           FROM fb_histroy_pjp
    		                           WHERE (clockin_merchandising = 'START'
    		                                 OR clockin_promotion = 'START'
    		                                 OR clockin_marketaudit = 'START'
    		                                 OR clockin_report_mt = 'START')
    		                                 AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
    		                                 AND status = 'OPEN'");
            if($query->num_rows() == 0)
            {
                $query_1 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_distribusi = 'START'
                                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");
                $query_2 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_merchandising = 'DISABLED'
                                             WHERE clockin_merchandising = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                       AND status = 'OPEN'");   
                $query_3 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_promotion = 'DISABLED'
                                             WHERE clockin_promotion = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_4 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_marketaudit = 'DISABLED'
                                             WHERE clockin_marketaudit = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");                                         
                $query_5 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_report_mt = 'DISABLED'
                                             WHERE clockin_report_mt = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'"); 
                return array('status' => 201,'message' => 'Data has been updated.');
            }else{
                return array('status' => 201,'message' => 'menu lain masih ada yang start');
            }
        }
        if($params['menu_clockin'] == 'MERCHANDISING')
        {
            $query = $this->db->query("SELECT id_history_pjp
    		                           FROM fb_histroy_pjp
    		                           WHERE (clockin_distribusi = 'START'
    		                                 OR clockin_promotion = 'START'
    		                                 OR clockin_marketaudit = 'START'
    		                                 OR clockin_report_mt = 'START')
    		                                 AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
    		                                 AND status = 'OPEN'");
            if($query->num_rows() == 0)
            {
                $query_1 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_merchandising = 'START'
                                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");
                $query_2 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_distribusi = 'DISABLED'
                                             WHERE clockin_distribusi = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_3 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_promotion = 'DISABLED'
                                             WHERE clockin_promotion = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_4 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_marketaudit = 'DISABLED'
                                             WHERE clockin_marketaudit = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");                                         
                $query_5 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_report_mt = 'DISABLED'
                                             WHERE clockin_report_mt = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                return array('status' => 201,'message' => 'Data has been updated.');
            }else{
                return array('status' => 201,'message' => 'menu lain masih ada yang start');
            }
        }
        if($params['menu_clockin'] == 'PROMOTION')
        {
            $query = $this->db->query("SELECT id_history_pjp
    		                           FROM fb_histroy_pjp
    		                           WHERE (clockin_distribusi = 'START'
    		                                 OR clockin_merchandising = 'START'
    		                                 OR clockin_marketaudit = 'START'
    		                                 OR clockin_report_mt = 'START')
    		                                 AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
    		                                 AND status = 'OPEN'");
            if($query->num_rows() == 0)
            {
                $query_1 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_promotion = 'START'
                                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");
                $query_2 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_distribusi = 'DISABLED'
                                             WHERE clockin_distribusi = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_3 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_merchandising = 'DISABLED'
                                             WHERE clockin_merchandising = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_4 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_marketaudit = 'DISABLED'
                                             WHERE clockin_marketaudit = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");                                         
                $query_5 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_report_mt = 'DISABLED'
                                             WHERE clockin_report_mt = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                return array('status' => 201,'message' => 'Data has been updated.');
            }else{
                return array('status' => 201,'message' => 'menu lain masih ada yang start');
            }
        }
        if($params['menu_clockin'] == 'MARKET AUDIT')
        {
            $query = $this->db->query("SELECT id_history_pjp
    		                           FROM fb_histroy_pjp
    		                           WHERE (clockin_distribusi = 'START'
    		                                 OR clockin_merchandising = 'START'
    		                                 OR clockin_promotion = 'START'
    		                                 OR clockin_report_mt = 'START')
    		                                 AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
    		                                 AND status = 'OPEN'");
            if($query->num_rows() == 0)
            {
                $query_1 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_marketaudit = 'START'
                                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");
                $query_2 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_distribusi = 'DISABLED'
                                             WHERE clockin_distribusi = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_3 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_merchandising = 'DISABLED'
                                             WHERE clockin_merchandising = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_4 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_promotion = 'DISABLED'
                                             WHERE clockin_promotion = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");                                         
                $query_5 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_report_mt = 'DISABLED'
                                             WHERE clockin_report_mt = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                return array('status' => 201,'message' => 'Data has been updated.');
            }else{
                return array('status' => 201,'message' => 'menu lain masih ada yang start');
            }
        }
        if($params['menu_clockin'] == 'REPORT MT')
        {
            $query = $this->db->query("SELECT id_history_pjp
    		                           FROM fb_histroy_pjp
    		                           WHERE (clockin_distribusi = 'START'
    		                                 OR clockin_merchandising = 'START'
    		                                 OR clockin_promotion = 'START'
    		                                 OR clockin_market_audit = 'START')
    		                                 AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
    		                                 AND status = 'OPEN'");
            if($query->num_rows() == 0)
            {
                $query_1 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_report_mt = 'START'
                                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");
                $query_2 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_distribusi = 'DISABLED'
                                             WHERE clockin_distribusi = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_3 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_merchandising = 'DISABLED'
                                             WHERE clockin_merchandising = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_4 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_promotion = 'DISABLED'
                                             WHERE clockin_promotion = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");                                         
                $query_5 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_market_audit = 'DISABLED'
                                             WHERE clockin_market_audit = 'ENABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                return array('status' => 201,'message' => 'Data has been updated.');
            }else{
                return array('status' => 201,'message' => 'menu lain masih ada yang start');
            }
        }
    }

    //pjp clockin menu finish
    public function pjp_clockin_menu_finish($params,$users_id,$role)
    {
        if($params['menu_clockin'] == 'DISTRIBUTION')
        {
            $query = $this->db->query("SELECT id_history_pjp
    		                           FROM fb_histroy_pjp
    		                           WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
    		                                 AND status = 'OPEN'
    		                                 AND foto_distribusi <> ''");
            if($query->num_rows() > 0)
            {
                $query_1 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_distribusi = 'FINISH'
                                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");
                $query_2 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_merchandising = 'ENABLED'
                                             WHERE clockin_merchandising = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                       AND status = 'OPEN'");   
                $query_3 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_promotion = 'ENABLED'
                                             WHERE clockin_promotion = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_4 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_marketaudit = 'ENABLED'
                                             WHERE clockin_marketaudit = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");                                         
                $query_5 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_report_mt = 'ENABLED'
                                             WHERE clockin_report_mt = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'"); 
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Finish berhasil.');
            }else{
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Mohon lengkapi data anda untuk menyelesaikan proses ini.');
            }
        }
        
        if($params['menu_clockin'] == 'MERCHANDISING')
        {
            $id_jenis_lokasi = '';
            $query_a = $this->db->query("SELECT id_jenis_lokasi
    		                             FROM fb_histroy_pjp
    		                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'");
    		foreach($query_a->result_array() as $row_a)
    		{
    		    $id_jenis_lokasi = $row_a['id_jenis_lokasi'];
    		}
    		if($id_jenis_lokasi == 'OUT')    
    		{
                $query_b = $this->db->query("SELECT id_history_pjp
        		                             FROM fb_histroy_pjp
        		                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
        		                                   AND status = 'OPEN'
        		                                   AND foto_merchandising_perdana = 'completed'
        		                                   AND foto_merchandising_voucher_fisik = 'completed'
        		                                   AND foto_merchandising_poster = 'completed'");
    		}
    		if($id_jenis_lokasi == 'SEK' || $id_jenis_lokasi == 'KAM' || $id_jenis_lokasi == 'FAK')    
    		{
                $query_b = $this->db->query("SELECT id_history_pjp
        		                             FROM fb_histroy_pjp
        		                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
        		                                   AND status = 'OPEN'
        		                                   AND foto_merchandising_poster = 'completed'
        		                                   AND foto_merchandising_spanduk = 'completed'");
    		}
            if($query_b->num_rows() > 0)
            {
                $query_1 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_merchandising = 'FINISH'
                                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");
                $query_2 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_distribusi = 'ENABLED'
                                             WHERE clockin_distribusi = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                       AND status = 'OPEN'");   
                $query_3 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_promotion = 'ENABLED'
                                             WHERE clockin_promotion = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_4 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_marketaudit = 'ENABLED'
                                             WHERE clockin_marketaudit = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");                                         
                $query_5 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_report_mt = 'ENABLED'
                                             WHERE clockin_report_mt = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'"); 
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Finish berhasil.');
            }else{
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'Mohon lengkapi data anda untuk menyelesaikan proses ini.');
            }
        }
        if($params['menu_clockin'] == 'PROMOTION')
        {
            $query = $this->db->query("SELECT id_history_pjp
    		                           FROM fb_histroy_pjp
    		                           WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
    		                                 AND status = 'OPEN'
    		                                 AND video_promotion = 'completed'");
            if($query->num_rows() > 0)
            {
                $query_1 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_promotion = 'FINISH'
                                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");
                $query_2 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_distribusi = 'ENABLED'
                                             WHERE clockin_distribusi = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                       AND status = 'OPEN'");   
                $query_3 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_merchandising = 'ENABLED'
                                             WHERE clockin_merchandising = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_4 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_marketaudit = 'ENABLED'
                                             WHERE clockin_marketaudit = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");                                         
                $query_5 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_report_mt = 'ENABLED'
                                             WHERE clockin_report_mt = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'"); 
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Finish berhasil.');
            }else{
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'mohon lengkapi data anda untuk menyelesaikan proses ini.');
            }
        }
        if($params['menu_clockin'] == 'MARKET AUDIT')
        {
    		if($role == '7')
    		{
                $query = $this->db->query("SELECT id_history_pjp
        		                           FROM fb_histroy_pjp
        		                           WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
        		                                 AND status = 'OPEN'
        		                                 AND data_marketaudit_quisioner = 'completed'");
    		}else{
    		    $query = $this->db->query("SELECT id_history_pjp
        		                           FROM fb_histroy_pjp
        		                           WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
        		                                 AND status = 'OPEN'
        		                                 AND foto_marketaudit_belanja = 'completed'
        		                                 AND data_marketaudit_broadband = 'completed'
        		                                 AND data_marketaudit_voucher = 'completed'");
    		}
            if($query->num_rows() > 0)
            {
                $query_1 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_marketaudit = 'FINISH'
                                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");
                $query_2 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_distribusi = 'ENABLED'
                                             WHERE clockin_distribusi = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                       AND status = 'OPEN'");   
                $query_3 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_merchandising = 'ENABLED'
                                             WHERE clockin_merchandising = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_4 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_promotion = 'ENABLED'
                                             WHERE clockin_promotion = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");                                         
                $query_5 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_report_mt = 'ENABLED'
                                             WHERE clockin_report_mt = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'"); 
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Finish berhasil.');
            }else{
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'mohon lengkapi data anda untuk menyelesaikan proses ini.');
            }
        }
        if($params['menu_clockin'] == 'REPORT MT')
        {
            $query = $this->db->query("SELECT id_history_pjp
    		                           FROM fb_histroy_pjp
    		                           WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
    		                                 AND status = 'OPEN'");
            if($query->num_rows() > 0)
            {
                $query_1 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_report_mt = 'FINISH'
                                             WHERE id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");
                $query_2 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_distribusi = 'ENABLED'
                                             WHERE clockin_distribusi = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                       AND status = 'OPEN'");   
                $query_3 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_merchandising = 'ENABLED'
                                             WHERE clockin_merchandising = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");   
                $query_4 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_promotion = 'ENABLED'
                                             WHERE clockin_promotion = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'");                                         
                $query_5 = $this->db->query("UPDATE fb_histroy_pjp
                                             SET clockin_marketaudit = 'ENABLED'
                                             WHERE clockin_marketaudit = 'DISABLED'
                                                   AND id_history_pjp = '".$this->db->escape_str($params['id_history_pjp'])."'
                                                   AND status = 'OPEN'"); 
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '1', 'message' => 'Finish berhasil.');
            }else{
                return array('ket' => '0 :gagal, 1:sukses', 'status' => '0', 'message' => 'mohon lengkapi data anda untuk menyelesaikan proses ini.');
            }
        }
    }

}