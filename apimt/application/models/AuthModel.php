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
        $q  = $this->db->select('za.username, za.password, za.id_level, za.nama, za.email, za.id_divisi')
                       ->from('za_users za')
                       ->where('za.username',$username)
                       ->where('za.status','AKTIF')->get()->row();
        if($q == "")
        {
            return array('status' => 401,'message' => 'Username not found.');
        } else {
            $hashed_password = $q->password;
            $id              = $q->username;
            $id_level        = $q->id_level;
            $nama            = $q->nama;
            $email           = $q->email;
            $id_divisi       = $q->id_divisi;
            
            if ($hashed_password == sha1(md5($password))) 
            {
               $last_login = date('Y-m-d H:i:s');
               $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
               $token = md5('test'.$username.$expired_at);
               $this->db->trans_start();
               $this->db->where('username',$id)->update('za_users',array('last_login' => $last_login));
               $this->db->insert('za_users_authentication',array('users_id' => $id, 'role' => $id_level, 'id_divisi' => $id_divisi, 'nama' => $nama, 'email' => $email, 'token' => $token, 'expired_at' => $expired_at));
               if ($this->db->trans_status() === FALSE)
               {
                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Internal server error.');
               } else {
                  $this->db->trans_commit();
                  return array('status' => 200,'message' => 'Successfully login.','id' => $id, 'role' => $id_level, 'id_divisi' => $id_divisi, 'nama' => $nama, 'email' => $email, 'token' => $token);
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
        $id_divisi  = $this->input->get_request_header('Id-Divisi', TRUE);
        $nama  = $this->input->get_request_header('Nama', TRUE);
        $email  = $this->input->get_request_header('Email', TRUE);
        $token     = $this->input->get_request_header('Auth-session', TRUE);
        $q  = $this->db->select('*')->from('za_users_authentication')
                       ->where('users_id',$users_id)
                       ->where('token',$token)
                       ->get()->row();
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
                $this->db->where('users_id',$users_id)
                         ->where('token',$token)
                         ->update('za_users_authentication',array('expired_at' => $expired_at,'updated_at' => $updated_at));
                return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }
    
    //logout
    public function logout()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $role  = $this->input->get_request_header('Id-Level', TRUE);
        $nama  = $this->input->get_request_header('Nama', TRUE);
        $email  = $this->input->get_request_header('Email', TRUE);
        $id_divisi  = $this->input->get_request_header('Id-Divisi', TRUE);
        $token     = $this->input->get_request_header('Auth-session', TRUE);
        $this->db->where('users_id',$users_id)->where('token',$token)->delete('za_users_authentication');
        return array('status' => 200,'message' => 'Successfully logout.');
    }
    
}
