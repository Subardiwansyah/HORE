<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi_ava_model extends Base_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_list_availability($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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

		$this->db->select('xx.*');
		$this->db->from('
			(
					SELECT
							 b.id
							 , b.id_jenis
							 , b.keterangan
							 , b.bobot
							 , CASE b.id_jenis
							   WHEN 1 THEN ROUND ((
										SELECT
											COUNT(id)
										FROM
											za_penilaian_outlet_pavailability xp
										INNER JOIN eb_outlet xo
													ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'")), 2)
								ELSE 0
							END AS id_share
							 , CASE b.id
										WHEN 1 THEN
												ROUND(
													(
														(
																SELECT
																(case when sum(perdana_segel) > 0 then 1 else 0 end) +
																(case when sum(sa_ld) > 0 then 1 else 0 end) +
																(case when sum(sa_md) > 0 then 1 else 0 end) +
																(case when sum(sa_hd) > 0 then 1 else 0 end)
																FROM
																		za_penilaian_outlet_pavailability xp
																		INNER JOIN eb_outlet xo
																				ON (xp.id_outlet = xo.id_outlet)
																WHERE ('.$where.'
																		AND xo.id_tap = "'.$id_tap.'")
														) 
													) , 2
												)
										WHEN 2 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																	WHERE (xp.tahun = 2022
																			AND xp.bulan = 3)
															)
														) /
														(
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_segel), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
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
														)
													) * 100, 2
												)
										WHEN 3 THEN
												ROUND(
													(
														(
															
																	SELECT
																		(case when sum(vf_segel) > 0 then 1 else 0 end) +
																		(case when sum(vf_ld) > 0 then 1 else 0 end) +
																		(case when sum(vf_md) > 0 then 1 else 0 end) +
																		(case when sum(vf_hd) > 0 then 1 else 0 end)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
														)
													) , 2
												)
										WHEN 4 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COALESCE(SUM(xp.vf_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
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
														) /
														(
															(
																	SELECT
																			COALESCE(SUM(xp.vf_segel), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_ld), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_md), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_hd), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
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
														)
													) * 100, 2
												)
										WHEN 5 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.digipos)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND UPPER(xp.digipos) = "YA")
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.digipos)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															)
														)
													) * 100, 2
												)
										WHEN 6 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.saldo_la)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND UPPER(xp.saldo_la) = "YA")
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.saldo_la)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															)
														)
													) * 100, 2
												)

										ELSE 0
								END AS nilai_share
						FROM
								za_bobot_kpi_ava b
						WHERE (b.id_jenis = 1)
			) xx
		');
		$result = $this->db->get();

		return $result->result();
	}

	function get_list_visibility($id_tap, $pilperiode, $tahun_kuartal, $bulan_kuartal, $tahun, $bulan, $minggu)
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

		$this->db->select('xx.*');
		$this->db->from('
			(
					SELECT
							 b.id
							 , b.id_jenis
							 , b.keterangan
							 , b.bobot
							 , CASE b.id_jenis
							   WHEN 2 THEN ROUND ((
										SELECT
											COUNT(id)
										FROM
											za_penilaian_outlet_pvisibility xp
										INNER JOIN eb_outlet xo
												ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'")), 2)
								ELSE 0
							END AS id_share
							 , CASE b.id
										WHEN 7 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.foto_etalase)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND (xp.foto_etalase <> "" OR xp.foto_etalase IS NULL))
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.foto_etalase)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															)
														)
													) * 100, 2
												)
										WHEN 8 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.diamond_hotspot)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND UPPER(xp.diamond_hotspot) = "YA")
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.diamond_hotspot)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															)
														)
													) * 100, 2
												)
										WHEN 9 THEN
												ROUND(
													(
														(
																SELECT
																		COALESCE(SUM(xp.poster_tsel), 0)
																FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
														) /
														(
															(
																	SELECT
																			COALESCE(SUM(xp.poster_tsel), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.poster_xl), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.poster_isat), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.poster_axis), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.poster_tri), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.poster_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
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
														)
													) * 100, 2
												)
										WHEN 10 THEN
												ROUND(
													(
														(
																SELECT
																		COALESCE(SUM(xp.layar_toko_tsel), 0)
																FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
														) /
														(
															(
																	SELECT
																			COALESCE(SUM(xp.layar_toko_tsel), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.layar_toko_xl), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.layar_toko_isat), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.layar_toko_axis), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.layar_toko_tri), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.layar_toko_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															) +
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
														)
													) * 100, 2
												)
									WHEN 11 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.stiker_omni)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND (xp.stiker_omni <> "" OR xp.stiker_omni IS NULL))
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.stiker_omni)
																	FROM
																			za_penilaian_outlet_pvisibility xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'")
															)
														)
													) * 100, 2
												)
							ELSE 0
							END AS nilai_share
						FROM
								za_bobot_kpi_ava b
						WHERE (b.id_jenis = 2)
			) xx
		');
		$result = $this->db->get();

		return $result->result();
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

		$this->db->select('xx.*');
		$this->db->from('
			(
					SELECT
							 b.id
							 , b.id_jenis
							 , b.keterangan
							 , b.bobot
							 , CASE b.id_jenis
							   WHEN 3 THEN ROUND ((
										SELECT
											COUNT(id)
										FROM
											za_penilaian_outlet_padvokasi xp
										INNER JOIN eb_outlet xo
												ON (xp.id_outlet = xo.id_outlet)
										WHERE ('.$where.'
												AND xo.id_tap = "'.$id_tap.'")), 2)
								ELSE 0
							END AS id_share
							 , CASE b.id
										WHEN 12 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 39
																			AND UPPER(xp.pilihan) = "YA")
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 39)
															)
														)
													) * 100, 2
												)
										WHEN 13 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 40
																			AND UPPER(xp.pilihan) = "YA")
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 40)
															)
														)
													) * 100, 2
												)
										WHEN 14 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 41
																			AND UPPER(xp.pilihan) = "YA")
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 41)
															)
														)
													) * 100, 2
												)
										WHEN 15 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 42
																			AND UPPER(xp.pilihan) = "YA")
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 42)
															)
														)
													) * 100, 2
												)
										WHEN 16 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 43
																			AND UPPER(xp.pilihan) = "YA")
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 43)
															)
														)
													) * 100, 2
												)
										WHEN 17 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 44
																			AND UPPER(xp.pilihan) = "YA")
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 44)
															)
														)
													) * 100, 2
												)
										WHEN 18 THEN
												ROUND(
													(
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 45
																			AND UPPER(xp.pilihan) = "YA")
															)
														) /
														(
															(
																	SELECT
																			COUNT(xp.id)
																	FROM
																			za_penilaian_outlet_padvokasi xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE ('.$where.'
																			AND xo.id_tap = "'.$id_tap.'"
																			AND xp.id_parameter = 45)
															)
														)
													) * 100, 2
												)

							ELSE 0
							END AS nilai_share
						FROM
								za_bobot_kpi_ava b
						WHERE (b.id_jenis = 3)
			) xx
		');
		$result = $this->db->get();

		return $result->result();
	}
}
?>