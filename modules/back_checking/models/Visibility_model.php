<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visibility_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_list_visibility_etalase($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
			xx.nama
			, xx.total
		');
		$this->db->from('
			(
				(
						SELECT
								"Ya" AS nama
								, COUNT(xp.foto_etalase) AS total
						FROM
								za_penilaian_outlet_pvisibility xp
								INNER JOIN eb_outlet xo
										ON (xp.id_outlet = xo.id_outlet)
						WHERE ('.$where.'
								AND xo.id_tap = "'.$id_tap.'"
								AND foto_etalase <> "")
				)

				UNION ALL

				(
						SELECT
								"Tidak" AS nama
								, COUNT(xp.foto_etalase) AS total
						FROM
								za_penilaian_outlet_pvisibility xp
								INNER JOIN eb_outlet xo
										ON (xp.id_outlet = xo.id_outlet)
						WHERE ('.$where.'
								AND xo.id_tap = "'.$id_tap.'"
								AND foto_etalase = "")
				)
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_visibility_etalase($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
								"Ya" AS nama
								, COUNT(xp.foto_etalase) AS total
						FROM
								za_penilaian_outlet_pvisibility xp
								INNER JOIN eb_outlet xo
										ON (xp.id_outlet = xo.id_outlet)
						WHERE ('.$where.'
								AND xo.id_tap = "'.$id_tap.'"
								AND foto_etalase <> "")
				)

				UNION ALL

				(
						SELECT
								"Tidak" AS nama
								, COUNT(xp.foto_etalase) AS total
						FROM
								za_penilaian_outlet_pvisibility xp
								INNER JOIN eb_outlet xo
										ON (xp.id_outlet = xo.id_outlet)
						WHERE ('.$where.'
								AND xo.id_tap = "'.$id_tap.'"
								AND foto_etalase = "")
				)
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_visibility_diamondh($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
													COUNT(xp.diamond_hotspot)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND UPPER(xp.diamond_hotspot) = "YA")
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (23)
								AND p.id_jenis = 2
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
													COUNT(xp.diamond_hotspot)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND (UPPER(xp.diamond_hotspot) = "TIDAK" OR xp.diamond_hotspot IS NULL OR xp.diamond_hotspot = ""))
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (23)
								AND p.id_jenis = 2
								AND p.status = "AKTIF")
				)
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_visibility_diamondh($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
													COUNT(xp.diamond_hotspot)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND UPPER(xp.diamond_hotspot) = "YA")
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (23)
								AND p.id_jenis = 2
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
													COUNT(xp.diamond_hotspot)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND (UPPER(xp.diamond_hotspot) = "TIDAK" OR xp.diamond_hotspot IS NULL OR xp.diamond_hotspot = ""))
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (23)
								AND p.id_jenis = 2
								AND p.status = "AKTIF")
				)
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_visibility_poster($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
										WHEN 23 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_tsel), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 25 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_xl), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 26 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_isat), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 27 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_axis), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 28 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_tri), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 29 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_smartfren), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 30 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_others), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (24, 25, 26, 27, 28, 29, 30)
							AND p.id_jenis = 2
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_visibility_poster($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
										WHEN 23 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_tsel), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 25 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_xl), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 26 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_isat), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 27 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_axis), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 28 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_tri), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 29 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_smartfren), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 30 THEN
										(
											SELECT
													COALESCE(SUM(xp.poster_others), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (24, 25, 26, 27, 28, 29, 30)
							AND p.id_jenis = 2
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_visibility_layar_toko($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
										WHEN 31 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_tsel), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 32 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_xl), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 33 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_isat), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 34 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_axis), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 35 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_tri), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 36 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_smartfren), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 37 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_others), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (31, 32, 33, 34, 37)
							AND p.id_jenis = 2
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_visibility_layar_toko($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
										WHEN 31 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_tsel), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 32 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_xl), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 33 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_isat), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 34 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_axis), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 35 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_tri), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 36 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_smartfren), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										WHEN 37 THEN
										(
											SELECT
													COALESCE(SUM(xp.layar_toko_others), 0)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'")
										)
										ELSE NULL
							END AS total
					FROM
							za_penilaian_outlet_parameter p
					WHERE (p.id IN (31, 32, 33, 34, 37)
							AND p.id_jenis = 2
							AND p.status = "AKTIF")
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}

	function get_list_visibility_omni($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
													COUNT(xp.stiker_omni)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND UPPER(xp.stiker_omni) = "YA")
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (38)
								AND p.id_jenis = 2
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
													COUNT(xp.stiker_omni)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND (UPPER(xp.stiker_omni) = "TIDAK" OR xp.stiker_omni IS NULL OR xp.stiker_omni = ""))
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (38)
								AND p.id_jenis = 2
								AND p.status = "AKTIF")
				)
			) xx
		');

		$result = $this->db->get();

		return $result->result();
	}

	function get_data_visibility_omni($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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
													COUNT(xp.stiker_omni)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND UPPER(xp.stiker_omni) = "YA")
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (38)
								AND p.id_jenis = 2
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
													COUNT(xp.stiker_omni)
											FROM
													za_penilaian_outlet_pvisibility xp
													INNER JOIN eb_outlet xo
															ON (xp.id_outlet = xo.id_outlet)
											WHERE ('.$where.'
													AND xo.id_tap = "'.$id_tap.'"
													AND (UPPER(xp.stiker_omni) = "TIDAK" OR xp.stiker_omni IS NULL OR xp.stiker_omni = ""))
								) AS total
						FROM
								za_penilaian_outlet_parameter p
						WHERE (p.id IN (38)
								AND p.id_jenis = 2
								AND p.status = "AKTIF")
				)
			) xx
		');

		$result = $this->db->get()->row_array();

    return $result;
	}
}
?>