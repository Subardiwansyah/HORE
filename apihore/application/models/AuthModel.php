<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    var $client_service = "frontendclienthore";
    var $auth_key       = "restapihore";

    //login
    public function check_auth_client()
    {
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
        if($client_service == $this->client_service && $auth_key == $this->auth_key)
        {
            return true;
        } else {
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        }
    }

    //login
    public function login($username,$password)
    {
        $q  = $this->db->select('ab.username, ab.password, ab.id_level, db.nama_sales, bd.id_tap, bd.nama_tap, bc.id_cluster, bc.nama_cluster')->from('ab_users ab')->join('db_sales db','ab.username = db.id_sales')->join('bd_tap bd','db.id_tap = bd.id_tap')->join('bc_cluster bc','bd.id_cluster = bc.id_cluster')->where('ab.username',$username)->where('ab.status','AKTIF')->get()->row();
        if($q == "")
        {
            return array('status' => 401,'message' => 'Username not found.');
        } else {
            $hashed_password = $q->password;
            $id              = $q->username;
            $id_level        = $q->id_level;
            $nama_sales      = $q->nama_sales;
            $id_tap          = $q->id_tap;
            $nama_tap        = $q->nama_tap;
            $id_cluster      = $q->id_cluster;
            $nama_cluster    = $q->nama_cluster;
            
            if ($hashed_password == sha1(md5($password))) 
            {
               $last_login = date('Y-m-d H:i:s');
               $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
               $token = md5('test'.$username.$expired_at);
               $this->db->trans_start();
               $this->db->where('username',$id)->update('ab_users',array('last_login' => $last_login));
               $this->db->insert('ad_users_authentication',array('users_id' => $id, 'role' => $id_level, 'nama_sales' => $nama_sales, 'id_tap' => $id_tap, 'nama_tap' => $nama_tap, 'id_cluster' => $id_cluster, 'nama_cluster' => $nama_cluster, 'token' => $token, 'expired_at' => $expired_at));
               if ($this->db->trans_status() === FALSE)
               {
                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Internal server error.');
               } else {
                  $this->db->trans_commit();
                  return array('status' => 200,'message' => 'Successfully login.','id' => $id, 'role' => $id_level, 'nama_sales' => $nama_sales, 'id_tap' => $id_tap, 'nama_tap' => $nama_tap, 'id_cluster' => $id_cluster, 'nama_cluster' => $nama_cluster, 'token' => $token);
               }
            } else {
               return array('status' => 401,'message' => 'Wrong password.');
            }
        }
    }

    //login
    public function auth()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $role  = $this->input->get_request_header('Id-Level', TRUE);
        $nama_sales  = $this->input->get_request_header('Nama-Sales', TRUE);
        $id_tap  = $this->input->get_request_header('Id-Tap', TRUE);
        $nama_tap  = $this->input->get_request_header('Nama-Tap', TRUE);
        $id_cluster  = $this->input->get_request_header('Id-Cluster', TRUE);
        $nama_cluster  = $this->input->get_request_header('Nama-Cluster', TRUE);
        $token     = $this->input->get_request_header('Auth-session', TRUE);
        $q  = $this->db->select('*')->from('ad_users_authentication')->where('users_id',$users_id)->where('token',$token)->get()->row();
        if($q == "")
        {
            return json_output(401,array('status' => 401,'message' => $token));
        } else {
            if($q->expired_at < date('Y-m-d H:i:s'))
            {
                return json_output(401,array('status' => 401,'message' => 'Your session has been expired.'));
            } else {
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('users_id',$users_id)->where('token',$token)->update('ad_users_authentication',array('expired_at' => $expired_at,'updated_at' => $updated_at));
                return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }
    
    //logout
    public function logout()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $role  = $this->input->get_request_header('Id-Level', TRUE);
        $nama_sales  = $this->input->get_request_header('Nama-Sales', TRUE);
        $id_tap  = $this->input->get_request_header('Id-Tap', TRUE);
        $nama_tap  = $this->input->get_request_header('Nama-Tap', TRUE);
        $id_cluster  = $this->input->get_request_header('Id-Cluster', TRUE);
        $nama_cluster  = $this->input->get_request_header('Nama-Cluster', TRUE);
        $token     = $this->input->get_request_header('Auth-session', TRUE);
        $this->db->where('users_id',$users_id)->where('token',$token)->delete('ad_users_authentication');
        return array('status' => 200,'message' => 'Successfully logout.');
    }
    
}
