<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-21 08:38:58 --> Query error: Incorrect DATE value: '2022 -04-16' - Invalid query: SELECT `xx`.`jumlah`, `xx`.`dikunjungi`, (xx.jumlah - xx.dikunjungi) AS tdk_dikunjungi
FROM (
				SELECT
						COUNT(d.id_daftar_pjp) AS jumlah, (
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
				WHERE (d.id_sales = "SSF0433"
						AND d.tanggal = "2022 -04-16")
			) xx
ERROR - 2022-04-21 08:38:58 --> Severity: error --> Exception: Call to a member function row_array() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/pjp_tracking/models/Pjp_tracking_model.php 44
ERROR - 2022-04-21 12:02:02 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '//LIMIT 1' at line 9 - Invalid query: 
										SELECT
												longitude
												, latitude
										FROM
												fc_tracking_sales
										WHERE id_sales = "SSF0433"
												AND tanggal = "2022-04-15"
										ORDER BY lastmodified DESC
										//LIMIT 1
								
ERROR - 2022-04-21 12:02:02 --> Severity: error --> Exception: Call to a member function num_rows() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/pjp_tracking/views/_map_view.php 20
ERROR - 2022-04-21 12:02:04 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '//LIMIT 1' at line 9 - Invalid query: 
										SELECT
												longitude
												, latitude
										FROM
												fc_tracking_sales
										WHERE id_sales = "SSF0433"
												AND tanggal = "2022-04-16"
										ORDER BY lastmodified DESC
										//LIMIT 1
								
ERROR - 2022-04-21 12:02:04 --> Severity: error --> Exception: Call to a member function num_rows() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/pjp_tracking/views/_map_view.php 20
ERROR - 2022-04-21 12:02:07 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '//LIMIT 1' at line 9 - Invalid query: 
										SELECT
												longitude
												, latitude
										FROM
												fc_tracking_sales
										WHERE id_sales = ""
												AND tanggal = "2022-04-21"
										ORDER BY lastmodified DESC
										//LIMIT 1
								
ERROR - 2022-04-21 12:02:07 --> Severity: error --> Exception: Call to a member function num_rows() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/pjp_tracking/views/_map_view.php 20
ERROR - 2022-04-21 12:02:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '//LIMIT 1' at line 9 - Invalid query: 
										SELECT
												longitude
												, latitude
										FROM
												fc_tracking_sales
										WHERE id_sales = "SSF0433"
												AND tanggal = "2022-04-21"
										ORDER BY lastmodified DESC
										//LIMIT 1
								
ERROR - 2022-04-21 12:02:12 --> Severity: error --> Exception: Call to a member function num_rows() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/pjp_tracking/views/_map_view.php 20
ERROR - 2022-04-21 12:02:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '//LIMIT 1' at line 9 - Invalid query: 
										SELECT
												longitude
												, latitude
										FROM
												fc_tracking_sales
										WHERE id_sales = "SSF0433"
												AND tanggal = "2022-04-16"
										ORDER BY lastmodified DESC
										//LIMIT 1
								
ERROR - 2022-04-21 12:02:17 --> Severity: error --> Exception: Call to a member function num_rows() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/pjp_tracking/views/_map_view.php 20
ERROR - 2022-04-21 12:02:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '//LIMIT 1' at line 9 - Invalid query: 
										SELECT
												longitude
												, latitude
										FROM
												fc_tracking_sales
										WHERE id_sales = ""
												AND tanggal = "2022-04-21"
										ORDER BY lastmodified DESC
										//LIMIT 1
								
ERROR - 2022-04-21 12:02:21 --> Severity: error --> Exception: Call to a member function num_rows() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/pjp_tracking/views/_map_view.php 20
ERROR - 2022-04-21 12:25:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/ORDER BY lastmodified DESC' at line 9 - Invalid query: 
													SELECT
															longitude
												, latitude

													FROM
															fc_tracking_sales t
													WHERE t.id_sales = "SSF0433"
															AND t.tanggal = "2022-04-15"
													//ORDER BY lastmodified DESC
										 
ERROR - 2022-04-21 12:25:56 --> Severity: error --> Exception: Call to a member function result_array() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/pjp_tracking/views/_map_view.php 56
ERROR - 2022-04-21 12:25:58 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/ORDER BY lastmodified DESC' at line 9 - Invalid query: 
													SELECT
															longitude
												, latitude

													FROM
															fc_tracking_sales t
													WHERE t.id_sales = "SSF0433"
															AND t.tanggal = "2022-04-16"
													//ORDER BY lastmodified DESC
										 
ERROR - 2022-04-21 12:25:58 --> Severity: error --> Exception: Call to a member function result_array() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/pjp_tracking/views/_map_view.php 56
ERROR - 2022-04-21 12:25:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/ORDER BY lastmodified DESC' at line 9 - Invalid query: 
													SELECT
															longitude
												, latitude

													FROM
															fc_tracking_sales t
													WHERE t.id_sales = ""
															AND t.tanggal = "2022-04-21"
													//ORDER BY lastmodified DESC
										 
ERROR - 2022-04-21 12:25:59 --> Severity: error --> Exception: Call to a member function result_array() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/pjp_tracking/views/_map_view.php 56
ERROR - 2022-04-21 12:26:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '/ORDER BY lastmodified DESC' at line 9 - Invalid query: 
													SELECT
															longitude
												, latitude

													FROM
															fc_tracking_sales t
													WHERE t.id_sales = "SSF0433"
															AND t.tanggal = "2022-04-21"
													//ORDER BY lastmodified DESC
										 
ERROR - 2022-04-21 12:26:06 --> Severity: error --> Exception: Call to a member function result_array() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/pjp_tracking/views/_map_view.php 56
