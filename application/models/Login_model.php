<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model Extends CI_model
{
	function do_login($U, $P)
	{
		$result = 1;

		$username = $this->security->xss_clean($U);
		$password = $this->security->xss_clean($P);

		if ($U)
		{
			$this->db->select('u.*');
			$this->db->from('ab_users u');
			$this->db->where('u.username', $username);
			$this->db->where('u.password',sha1(md5($password)));

			$query = $this->db->get();

			if ($query->num_rows() == 1)
			{
				foreach ($query->result() as $row)
				{
					if($row->status == 'AKTIF')
					{
						$result = 1;
					}
					else
					{
						$result = 2;
					}
				}
			}
			else
			{
				$result = 3;
			}
		}

		return $result;
	}

	function get_data_user($username)
  {
		$this->db->select('
			u.id_level
			, l.level AS nama_level
			, u.id_divisi
			, CASE u.id_level
						WHEN 1 THEN (SELECT a.nama_regional FROM ba_regional a WHERE (a.id_regional = u.id_divisi))
						WHEN 2 THEN (SELECT a.nama_branch FROM bb_branch a WHERE (a.id_branch = u.id_divisi))
						WHEN 3 THEN (SELECT a.nama_cluster FROM bc_cluster a WHERE (a.id_cluster = u.id_divisi))
						WHEN 4 THEN (SELECT a.nama_tap FROM bd_tap a WHERE (a.id_tap = u.id_divisi))
						ELSE NULL
				END AS nama_divisi
			, CASE u.id_level
						WHEN 4 THEN (SELECT a.level_tap FROM bd_tap a WHERE (a.id_tap = u.id_divisi))
						ELSE NULL
				END AS level_tap
			, u.username
			, u.password
			, u.pin
			, u.email
			, u.kode_verifikasi
			, u.status
			, u.lastmodified
		');
		$this->db->from('ab_users u');
		$this->db->join('aa_users_level l', 'u.id_level = l.id_level');
		$this->db->where('u.username', $username);

    $result = $this->db->get();

    return $result->row_array();
  }
}