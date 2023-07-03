<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pjp_tracking_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_data_kunjungan()
	{
		$id_sales = $this->input->post('id_sales') ? $this->input->post('id_sales') : NULL;
		$tgl = $this->input->post('tgl') ? prepare_date($this->input->post('tgl')) : date('Y-m-d');

		$this->db->select('
			xx.jumlah
			, xx.dikunjungi
			, (xx.jumlah - xx.dikunjungi) AS tdk_dikunjungi
		');
		$this->db->from('
			(
				SELECT
						COUNT(d.id_daftar_pjp) AS jumlah
						, (
								SELECT
										COUNT(h.id_history_pjp)
								FROM
										fb_histroy_pjp h
								WHERE (h.id_sales = d.id_sales
										AND h.tanggal = d.tanggal
										AND h.jam_clock_in <> "00:00:00"
										AND h.jam_clock_out <> "00:00:00")
							)  AS dikunjungi
				FROM
						fe_daftar_pjp d
				WHERE (d.id_sales = "'.$id_sales.'"
						AND d.tanggal = "'.$tgl.'")
			) xx
		');

    $result = $this->db->get();

    return $result->row_array();
	}
}
?>