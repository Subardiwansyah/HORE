<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-03-23 00:04:27 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 00:04:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT
											COUNT(id) AS jum
										FROM
											za_penilaian_out' at line 6 - Invalid query: SELECT `xx`.*
FROM (
					SELECT
							 b.id, `b`.`id_jenis`, `b`.`keterangan`, `b`.`bobot`, CASE b.id
							   WHEN 1 THEN
										SELECT
											COUNT(id) AS jum
										FROM
											za_penilaian_outlet_pavailability xp
										INNER JOIN eb_outlet xo
													ON (xp.id_outlet = xo.id_outlet)
										WHERE (xp.tahun = "2022"
												AND xo.id_tap = "TAP001")
								ELSE 0
							END AS id_share, , CASE b.id
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
																WHERE (xp.tahun = "2022"
																		AND xo.id_tap = "TAP001")
														) 
													), 2
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
														)
													), 2
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_ld), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_md), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_hd), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001"
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001"
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
ERROR - 2022-03-23 00:04:38 --> Severity: error --> Exception: Call to a member function result() on bool /var/www/html/hore/modules/kpi_ava/models/Kpi_ava_model.php 481
ERROR - 2022-03-23 00:05:53 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 00:06:15 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 00:06:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT
											COUNT(id) AS jum
										FROM
											za_penilaian_out' at line 6 - Invalid query: SELECT `xx`.*
FROM (
					SELECT
							 b.id, `b`.`id_jenis`, `b`.`keterangan`, `b`.`bobot`, CASE b.id
							   WHEN 1 THEN
										SELECT
											COUNT(id) AS jum
										FROM
											za_penilaian_outlet_pavailability xp
										INNER JOIN eb_outlet xo
													ON (xp.id_outlet = xo.id_outlet)
										WHERE (xp.tahun = "2022"
												AND xo.id_tap = "TAP001")
								ELSE 0
							END AS id_share, CASE b.id
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
																WHERE (xp.tahun = "2022"
																		AND xo.id_tap = "TAP001")
														) 
													), 2
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
														)
													), 2
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_ld), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_md), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_hd), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001"
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001"
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
ERROR - 2022-03-23 00:06:24 --> Severity: error --> Exception: Call to a member function result() on bool /var/www/html/hore/modules/kpi_ava/models/Kpi_ava_model.php 481
ERROR - 2022-03-23 00:11:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 00:11:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT
											COUNT(id) AS jum
										FROM
											za_penilaian_out' at line 6 - Invalid query: SELECT `xx`.*
FROM (
					SELECT
							 b.id, `b`.`id_jenis`, `b`.`keterangan`, `b`.`bobot`, CASE b.id_jenis
							   WHEN 1 THEN
										SELECT
											COUNT(id) AS jum
										FROM
											za_penilaian_outlet_pavailability xp
										INNER JOIN eb_outlet xo
													ON (xp.id_outlet = xo.id_outlet)
										WHERE (xp.tahun = "2022"
												AND xo.id_tap = "TAP001")
								ELSE 0
							END AS id_share, CASE b.id
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
																WHERE (xp.tahun = "2022"
																		AND xo.id_tap = "TAP001")
														) 
													), 2
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
														)
													), 2
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_ld), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_md), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_hd), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001"
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001"
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
ERROR - 2022-03-23 00:11:20 --> Severity: error --> Exception: Call to a member function result() on bool /var/www/html/hore/modules/kpi_ava/models/Kpi_ava_model.php 481
ERROR - 2022-03-23 00:12:37 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 00:12:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT
											COUNT(id)
										FROM
											za_penilaian_outlet_pav' at line 6 - Invalid query: SELECT `xx`.*
FROM (
					SELECT
							 b.id, `b`.`id_jenis`, `b`.`keterangan`, `b`.`bobot`, CASE b.id_jenis
							   WHEN 1 THEN
										SELECT
											COUNT(id)
										FROM
											za_penilaian_outlet_pavailability xp
										INNER JOIN eb_outlet xo
													ON (xp.id_outlet = xo.id_outlet)
										WHERE (xp.tahun = "2022"
												AND xo.id_tap = "TAP001")
								ELSE 0
							END AS id_share, CASE b.id
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
																WHERE (xp.tahun = "2022"
																		AND xo.id_tap = "TAP001")
														) 
													), 2
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.perdana_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
														)
													), 2
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_ld), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_md), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_hd), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_xl), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_isat), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_axis), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_tri), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_smartfren), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
															) +
															(
																	SELECT
																			COALESCE(SUM(xp.vf_others), 0)
																	FROM
																			za_penilaian_outlet_pavailability xp
																			INNER JOIN eb_outlet xo
																					ON (xp.id_outlet = xo.id_outlet)
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001"
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001"
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
																	WHERE (xp.tahun = "2022"
																			AND xo.id_tap = "TAP001")
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
ERROR - 2022-03-23 00:12:45 --> Severity: error --> Exception: Call to a member function result() on bool /var/www/html/hore/modules/kpi_ava/models/Kpi_ava_model.php 481
ERROR - 2022-03-23 00:28:28 --> Severity: error --> Exception: syntax error, unexpected end of file /var/www/html/hore/modules/kpi_ava/views/kpi_ava_form_view.php 588
ERROR - 2022-03-23 00:31:41 --> 404 Page Not Found: /index
ERROR - 2022-03-23 00:34:58 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /var/www/html/hore/modules/kpi_ava/views/kpi_ava_form_view.php 243
ERROR - 2022-03-23 01:07:23 --> 404 Page Not Found: /index
ERROR - 2022-03-23 01:55:29 --> 404 Page Not Found: /index
ERROR - 2022-03-23 02:00:33 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 02:30:48 --> 404 Page Not Found: /index
ERROR - 2022-03-23 02:42:25 --> 404 Page Not Found: /index
ERROR - 2022-03-23 02:52:12 --> 404 Page Not Found: /index
ERROR - 2022-03-23 02:52:13 --> 404 Page Not Found: /index
ERROR - 2022-03-23 02:52:17 --> 404 Page Not Found: /index
ERROR - 2022-03-23 03:22:08 --> 404 Page Not Found: /index
ERROR - 2022-03-23 04:31:24 --> 404 Page Not Found: /index
ERROR - 2022-03-23 05:03:47 --> 404 Page Not Found: /index
ERROR - 2022-03-23 05:30:30 --> 404 Page Not Found: /index
ERROR - 2022-03-23 06:24:50 --> 404 Page Not Found: /index
ERROR - 2022-03-23 07:01:04 --> 404 Page Not Found: /index
ERROR - 2022-03-23 07:32:50 --> 404 Page Not Found: /index
ERROR - 2022-03-23 07:35:14 --> 404 Page Not Found: /index
ERROR - 2022-03-23 07:52:39 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 07:52:39 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:03:43 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:07:20 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:12:43 --> 404 Page Not Found: /index
ERROR - 2022-03-23 08:24:42 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:33:53 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:36:22 --> Severity: error --> Exception: Unable to locate the model you have specified: Cs_model /var/www/html/hore/system/core/Loader.php 348
ERROR - 2022-03-23 08:36:31 --> Severity: error --> Exception: Unable to locate the model you have specified: Cs_model /var/www/html/hore/system/core/Loader.php 348
ERROR - 2022-03-23 08:42:51 --> 404 Page Not Found: /index
ERROR - 2022-03-23 08:42:55 --> 404 Page Not Found: /index
ERROR - 2022-03-23 08:42:57 --> 404 Page Not Found: /index
ERROR - 2022-03-23 08:43:11 --> 404 Page Not Found: /index
ERROR - 2022-03-23 08:43:11 --> 404 Page Not Found: /index
ERROR - 2022-03-23 08:43:12 --> 404 Page Not Found: /index
ERROR - 2022-03-23 08:49:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:49:43 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:50:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:50:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:50:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:51:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:51:41 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:58:17 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:58:19 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:58:19 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:58:19 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:58:20 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 08:58:20 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:02:33 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:02:33 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:02:34 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:02:36 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:02:36 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:09:37 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:09:45 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:11:50 --> 404 Page Not Found: /index
ERROR - 2022-03-23 09:15:21 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:18:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:18:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:18:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:18:21 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:19:51 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:24:50 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:24:50 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:26:17 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:26:17 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:27:24 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:27:31 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:28:47 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:30:21 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:30:21 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:30:21 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:33:57 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:34:47 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:35:50 --> Query error: Unknown column 'rt.limit_link_aja' in 'field list' - Invalid query: SELECT `xx`.`id_rekomendasi`, `xx`.`id_tap`, `xx`.`id_sales`, `xx`.`nama`, `xx`.`sgprepaid`, `xx`.`sgota`, `xx`.`sgvin`, `xx`.`sgvgs`, `xx`.`sgvgg`, `xx`.`sgvgp`, `xx`.`insac_ld`, `xx`.`insac_md`, `xx`.`insac_hd`, `xx`.`invin_ld`, `xx`.`invin_md`, `xx`.`invin_hd`, `xx`.`invga_ld`, `xx`.`invga_md`, `xx`.`invga_hd`, `xx`.`new_rs`, `xx`.`limit_link_aja`, `xx`.`is_simpan`, `xx`.`x_urut`, `xx`.`x_parent`
FROM (
				SELECT
						rt.id_rekomendasi, `rt`.`id_tap`, `rt`.`id_sales`, IF (rt.id_sales IS NULL, `tp`.`nama_tap`, sl.nama_sales) AS nama, `rt`.`sgprepaid`, `rt`.`sgota`, `rt`.`sgvin`, `rt`.`sgvgs`, `rt`.`sgvgg`, `rt`.`sgvgp`, `rt`.`insac_ld`, `rt`.`insac_md`, `rt`.`insac_hd`, `rt`.`invin_ld`, `rt`.`invin_md`, `rt`.`invin_hd`, `rt`.`invga_ld`, `rt`.`invga_md`, `rt`.`invga_hd`, `rt`.`new_rs`, `rt`.`limit_link_aja`, `rt`.`is_simpan`, CONCAT(rt.id_tap, IF(rt.id_sales IS NULL, "SSF0000", rt.id_sales)) AS x_urut, IF (sl.id_sales IS NULL, 0, 1) AS x_parent
				FROM
						kg_rekomendasi_tap rt
						INNER JOIN bd_tap tp
								ON (rt.id_tap = tp.id_tap)
						LEFT JOIN db_sales sl
								ON (rt.id_sales = sl.id_sales)
				WHERE (UPPER(rt.target_sales) = "SF"
						AND rt.tahun = "2022"
						AND rt.bulan = "3"
						AND rt.minggu = "4"
						AND tp.id_cluster = "CTR001")
				 ORDER BY CONCAT(rt.id_tap, IF(rt.id_sales IS NULL, "SSF0000", rt.id_sales)) ASC
			) xx
ORDER BY `xx`.`x_urut` ASC
ERROR - 2022-03-23 09:35:50 --> Severity: error --> Exception: Call to a member function result() on bool /var/www/html/hore/modules/target_sales/models/Target_sales_model.php 168
ERROR - 2022-03-23 09:42:43 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:43:06 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:43:06 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:43:06 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:44:10 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:45:47 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:47:45 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:52:10 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:53:41 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:54:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:57:07 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:57:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:57:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:58:46 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:59:01 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 09:59:04 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:05:43 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:08:51 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:08:51 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:19:40 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:19:46 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:22:04 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:25:39 --> 404 Page Not Found: /index
ERROR - 2022-03-23 10:27:01 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:35:34 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:39:07 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:39:42 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:40:40 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:40:51 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:41:04 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-03-23 10:41:04 --> Severity: error --> Exception: Call to a member function row_array() on bool /var/www/html/hore/modules/pjp_setting/models/Pjp_setting_model.php 623
ERROR - 2022-03-23 10:41:08 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:42:29 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:47:26 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:48:56 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:51:23 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:53:00 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:54:29 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 10:55:26 --> 404 Page Not Found: /index
ERROR - 2022-03-23 11:05:51 --> 404 Page Not Found: /index
ERROR - 2022-03-23 11:10:30 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:12:57 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:13:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:15:03 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:21:00 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:21:00 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:21:05 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-03-23 11:21:05 --> Severity: error --> Exception: Call to a member function row_array() on bool /var/www/html/hore/modules/pjp_setting/models/Pjp_setting_model.php 623
ERROR - 2022-03-23 11:36:27 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:50:10 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:50:10 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:54:15 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:54:15 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:54:15 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 11:56:45 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:00:19 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:01:23 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:06:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:07:03 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:07:04 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:07:34 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:07:34 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:07:36 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:07:37 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:09:28 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:20:36 --> 404 Page Not Found: /index
ERROR - 2022-03-23 12:22:07 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:29:47 --> 404 Page Not Found: /index
ERROR - 2022-03-23 12:30:41 --> 404 Page Not Found: /index
ERROR - 2022-03-23 12:30:56 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:31:48 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:43:00 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:43:03 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:43:03 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:48:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:48:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:48:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:50:51 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 12:52:27 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:04:31 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:05:53 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:07:42 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:07:42 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:08:30 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:11:16 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:13:22 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:13:22 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:16:36 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:16:39 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:21:43 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:25:31 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:27:40 --> 404 Page Not Found: /index
ERROR - 2022-03-23 13:30:50 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:31:14 --> 404 Page Not Found: /index
ERROR - 2022-03-23 13:31:47 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:33:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:33:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:34:35 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:35:23 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:43:19 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 13:44:56 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 14:01:49 --> 404 Page Not Found: /index
ERROR - 2022-03-23 14:01:49 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 14:11:49 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 14:11:49 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 14:22:23 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 14:30:45 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 14:34:40 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 14:40:02 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 14:40:02 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 14:40:02 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 14:45:10 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:10:01 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:11:00 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:17:23 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:20:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:24:31 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:24:31 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:25:24 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:26:34 --> 404 Page Not Found: /index
ERROR - 2022-03-23 15:27:23 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:28:16 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:28:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:28:18 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:28:21 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:29:08 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:29:09 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:29:41 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:30:01 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:30:02 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:30:36 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:35:06 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:37:13 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:37:59 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:38:00 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:38:04 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:50:38 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:51:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:51:53 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:51:55 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:52:49 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:52:57 --> 404 Page Not Found: /index
ERROR - 2022-03-23 15:54:54 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:54:55 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:54:55 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:57:19 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:59:04 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 15:59:04 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:16:25 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:17:37 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:17:37 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:17:37 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:18:01 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:18:04 --> Query error: No tables used - Invalid query: SELECT *
ORDER BY `s`.`nama_sales` ASC
ERROR - 2022-03-23 16:18:04 --> Severity: error --> Exception: Call to a member function result_array() on bool /var/www/html/hore/modules/pilih/models/Pilih_model.php 1517
ERROR - 2022-03-23 16:18:05 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:18:45 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:18:48 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:18:48 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:18:56 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:18:56 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:19:54 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:19:56 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:20:07 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:20:07 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:20:07 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:20:07 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:20:15 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:26:15 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:26:21 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:37:12 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:37:40 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:37:40 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:38:17 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:38:17 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:39:23 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:40:38 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:40:38 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:40:55 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:44:09 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:44:13 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:44:32 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:45:51 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:47:17 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:47:17 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:47:17 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:47:17 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:47:48 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:49:57 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:50:16 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:50:16 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:50:16 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:51:42 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 16:53:12 --> 404 Page Not Found: /index
ERROR - 2022-03-23 16:55:47 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 17:00:09 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 17:00:32 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 17:01:08 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 17:02:03 --> 404 Page Not Found: /index
ERROR - 2022-03-23 17:02:03 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 17:09:14 --> 404 Page Not Found: /index
ERROR - 2022-03-23 17:14:53 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 17:16:12 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 17:17:58 --> 404 Page Not Found: /index
ERROR - 2022-03-23 18:45:46 --> 404 Page Not Found: /index
ERROR - 2022-03-23 18:56:50 --> 404 Page Not Found: /index
ERROR - 2022-03-23 18:56:50 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 18:56:59 --> 404 Page Not Found: /index
ERROR - 2022-03-23 19:09:27 --> 404 Page Not Found: /index
ERROR - 2022-03-23 19:09:59 --> 404 Page Not Found: /index
ERROR - 2022-03-23 19:21:23 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 19:33:19 --> 404 Page Not Found: /index
ERROR - 2022-03-23 20:22:51 --> 404 Page Not Found: /index
ERROR - 2022-03-23 20:49:31 --> 404 Page Not Found: /index
ERROR - 2022-03-23 21:02:45 --> 404 Page Not Found: /index
ERROR - 2022-03-23 22:24:04 --> 404 Page Not Found: /index
ERROR - 2022-03-23 22:29:54 --> 404 Page Not Found: /index
ERROR - 2022-03-23 22:44:24 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 22:45:11 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 22:45:19 --> 404 Page Not Found: /index
ERROR - 2022-03-23 22:45:19 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-03-23 23:04:17 --> Query error: Lock wait timeout exceeded; try restarting transaction - Invalid query: UPDATE `nm_promotion_res_kecamatan` SET `id_kecamatan` = 'KEC001', `id_jenis_lokasi` = 'OUT', `id_jenis_weekly` = '78', `total` = '0', `total_pjp` = '20'
WHERE `id_kecamatan` = 'KEC001'
AND `id_jenis_lokasi` = 'OUT'
AND `id_jenis_weekly` = '78'
ERROR - 2022-03-23 23:05:10 --> 404 Page Not Found: /index
ERROR - 2022-03-23 23:30:01 --> 404 Page Not Found: /index
ERROR - 2022-03-23 23:47:43 --> 404 Page Not Found: /index
ERROR - 2022-03-23 23:47:45 --> 404 Page Not Found: /index
ERROR - 2022-03-23 23:47:47 --> 404 Page Not Found: /index
ERROR - 2022-03-23 23:47:49 --> 404 Page Not Found: /index
ERROR - 2022-03-23 23:47:50 --> 404 Page Not Found: /index
ERROR - 2022-03-23 23:47:53 --> 404 Page Not Found: /index
ERROR - 2022-03-23 23:47:54 --> 404 Page Not Found: /index
ERROR - 2022-03-23 23:48:00 --> 404 Page Not Found: /index
ERROR - 2022-03-23 23:48:05 --> 404 Page Not Found: /index
