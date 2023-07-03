<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advokasi_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_list_advokasi($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
	{
		$where = '';

		if ($pilperiode == 'Yearly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'"';
		}
		else if ($pilperiode == 'Quartely')
		{
			if ($bulan_kuartal == '01-03')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (1, 2, 3)';
			}
			else if ($bulan_kuartal == '04-06')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (4, 5, 6)';
			}
			else if ($bulan_kuartal == '07-09')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (7, 8, 9)';
			}
			else if ($bulan_kuartal == '10-12')
			{
				$where .= 'xp.tahun = "'.(int) $tahun_kuartal.'" AND xp.bulan IN (10, 11, 12)';
			}
		}
		else if ($pilperiode == 'Monthly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'"';
		}
		else if ($pilperiode == 'Weekly')
		{
			$where .= 'xp.tahun = "'.(int) $tahun.'" AND xp.bulan = "'.(int) $bulan.'" AND xp.minggu = "'.(int) $minggu.'"';
		}

		$this->db->select('
			xx.id
			, xx.id_jenis
			, xx.nama
			, xx.kategori
			, xx.total_ya
			, xx.total_tidak
		');
		$this->db->from('
			(
				SELECT
						p.id
						, p.id_jenis
						, p.parameter AS nama
						, p.kategori
						, (
									SELECT
											COUNT(xp.id)
									FROM
											za_penilaian_outlet_padvokasi xp
											INNER JOIN eb_outlet xo
													ON (xp.id_outlet = xo.id_outlet)
									WHERE ('.$where.'
											AND xp.id_parameter = p.id
											AND xo.id_tap = "'.$id_tap.'"
											AND UPPER(xp.pilihan) = "YA")
							) AS total_ya
						, (
									SELECT
											COUNT(xp.id)
									FROM
											za_penilaian_outlet_padvokasi xp
											INNER JOIN eb_outlet xo
													ON (xp.id_outlet = xo.id_outlet)
									WHERE ('.$where.'
											AND xp.id_parameter = p.id
											AND xo.id_tap = "'.$id_tap.'"
											AND (UPPER(xp.pilihan) = "TIDAK" OR xp.pilihan IS NULL OR xp.pilihan = ""))
							)	AS total_tidak
				FROM
						za_penilaian_outlet_parameter p
				WHERE (p.id IN (39, 40, 41, 42, 43, 44, 45)
						AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}
}
?>