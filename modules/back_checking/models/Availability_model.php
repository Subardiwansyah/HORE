<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Availability_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_list_availability_vpt($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			, xx.total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_jenis
							, p.parameter AS nama
							, p.kategori
							, CASE p.id
										WHEN 1 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_segel), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 2 THEN
										(
											SELECT
													COALESCE(SUM(xp.sa_ld), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 3 THEN
										(
											SELECT
													COALESCE(SUM(xp.sa_md), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 4 THEN
										(
											SELECT
													COALESCE(SUM(xp.sa_hd), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (1, 2, 3, 4)
							AND p.id_jenis = 1
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_availability_vpt($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
					SELECT
							CASE p.id
										WHEN 1 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_segel), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 2 THEN
										(
											SELECT
													COALESCE(SUM(xp.sa_ld), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 3 THEN
										(
											SELECT
													COALESCE(SUM(xp.sa_md), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 4 THEN
										(
											SELECT
													COALESCE(SUM(xp.sa_hd), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (1, 2, 3, 4)
							AND p.id_jenis = 1
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_availability_pao($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			, xx.total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_jenis
							, p.parameter AS nama
							, p.kategori
							, CASE p.id
										WHEN 5 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_xl), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 6 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_isat), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 7 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_axis), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 8 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_tri), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 9 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_smartfren), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 10 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_others), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (5, 6, 7, 8, 9, 10)
							AND p.id_jenis = 1
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_availability_pao($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
					SELECT
							CASE p.id
										WHEN 5 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_xl), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 6 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_isat), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 7 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_axis), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 8 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_tri), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 9 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_smartfren), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 10 THEN
										(
											SELECT
													COALESCE(SUM(xp.perdana_others), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (5, 6, 7, 8, 9, 10)
							AND p.id_jenis = 1
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_availability_vvft($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			, xx.total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_jenis
							, p.parameter AS nama
							, p.kategori
							, CASE p.id
										WHEN 11 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_segel), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 12 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_ld), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 13 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_md), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 14 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_hd), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (11, 12, 13, 14)
							AND p.id_jenis = 1
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_availability_vvft($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
					SELECT
							CASE p.id
										WHEN 11 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_segel), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 12 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_ld), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 13 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_md), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 14 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_hd), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (11, 12, 13, 14)
							AND p.id_jenis = 1
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_availability_vfao($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			, xx.total
		');
		$this->db->from('
			(
					SELECT
							p.id
							, p.id_jenis
							, p.parameter AS nama
							, p.kategori
							, CASE p.id
										WHEN 15 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_xl), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 16 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_isat), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 17 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_axis), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 18 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_tri), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 19 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_smartfren), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 20 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_others), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (15, 16, 17, 18, 19, 20)
							AND p.id_jenis = 1
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_availability_vfao($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
					SELECT
							CASE p.id
										WHEN 15 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_xl), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 16 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_isat), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 17 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_axis), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 18 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_tri), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 19 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_smartfren), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 20 THEN
										(
											SELECT
													COALESCE(SUM(xp.vf_others), 0)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (15, 16, 17, 18, 19, 20)
							AND p.id_jenis = 1
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_availability_udigipos($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			, xx.total
		');
		$this->db->from('
			(
				(
						SELECT
								p.id
								, p.id_jenis
								, "Ya" AS nama
								, p.kategori
								, (
											SELECT
													COUNT(xp.digipos)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND UPPER(xp.digipos) = "YA")
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (21)
								AND p.id_jenis = 1
								AND p.status = "AKTIF")
				)

				UNION ALL

				(
						SELECT
								p.id
								, p.id_jenis
								, "Tidak" AS nama
								, p.kategori
								, (
											SELECT
													COUNT(xp.digipos)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND (UPPER(xp.digipos) = "TIDAK" OR xp.digipos IS NULL OR xp.digipos = ""))
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (21)
								AND p.id_jenis = 1
								AND p.status = "AKTIF")
				)
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_availability_udigipos($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
				(
						SELECT
								p.id
								, p.id_jenis
								, "Ya" AS nama
								, p.kategori
								, (
											SELECT
													COUNT(xp.digipos)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND UPPER(xp.digipos) = "YA")
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (21)
								AND p.id_jenis = 1
								AND p.status = "AKTIF")
				)

				UNION ALL

				(
						SELECT
								p.id
								, p.id_jenis
								, "Tidak" AS nama
								, p.kategori
								, (
											SELECT
													COUNT(xp.digipos)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND (UPPER(xp.digipos) = "TIDAK" OR xp.digipos IS NULL OR xp.digipos = ""))
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (21)
								AND p.id_jenis = 1
								AND p.status = "AKTIF")
				)
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_availability_sladigipos($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			, xx.total
		');
		$this->db->from('
			(
				(
						SELECT
								p.id
								, p.id_jenis
								, "Ya" AS nama
								, p.kategori
								, (
											SELECT
													COUNT(xp.saldo_la)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND UPPER(xp.saldo_la) = "YA")
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (21)
								AND p.id_jenis = 1
								AND p.status = "AKTIF")
				)

				UNION ALL

				(
						SELECT
								p.id
								, p.id_jenis
								, "Tidak" AS nama
								, p.kategori
								, (
											SELECT
													COUNT(xp.saldo_la)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND (UPPER(xp.saldo_la) = "TIDAK" OR xp.saldo_la IS NULL OR xp.saldo_la = ""))
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (22)
								AND p.id_jenis = 1
								AND p.status = "AKTIF")
				)
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_availability_sladigipos($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			COALESCE(SUM(xx.total), 0) AS x_total
		');
		$this->db->from('
			(
				(
						SELECT
								p.id
								, p.id_jenis
								, "Ya" AS nama
								, p.kategori
								, (
											SELECT
													COUNT(xp.saldo_la)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND UPPER(xp.saldo_la) = "YA")
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (22)
								AND p.id_jenis = 1
								AND p.status = "AKTIF")
				)

				UNION ALL

				(
						SELECT
								p.id
								, p.id_jenis
								, "Tidak" AS nama
								, p.kategori
								, (
											SELECT
													COUNT(xp.saldo_la)
											FROM
													za_penilaian_outlet_pavailability xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND (UPPER(xp.saldo_la) = "TIDAK" OR xp.saldo_la IS NULL OR xp.saldo_la = ""))
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (22)
								AND p.id_jenis = 1
								AND p.status = "AKTIF")
				)
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}
}
?>