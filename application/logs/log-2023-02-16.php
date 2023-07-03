<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-02-16 03:18:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY `xx`.`id_tap` ASC' at line 10 - Invalid query: SELECT `xx`.`id_tap`, `xx`.`nama_tap`, `xx`.`nama_cluster`
FROM (
					SELECT
							t.id_tap, `t`.`nama_tap`, c.nama_cluster
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
				)
ORDER BY `xx`.`id_tap` ASC
ERROR - 2023-02-16 03:18:00 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\Hore\modules\pilih\models\Pilih_model.php 1035
ERROR - 2023-02-16 03:18:35 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'ORDER BY `xx`.`id_tap` ASC' at line 10 - Invalid query: SELECT `xx`.`id_tap`, `xx`.`nama_tap`, `xx`.`nama_cluster`
FROM (
					SELECT
							t.id_tap, `t`.`nama_tap`, c.nama_cluster
					FROM
							bd_tap t
							INNER JOIN bc_cluster c
									ON (t.id_cluster = c.id_cluster)
				)
ORDER BY `xx`.`id_tap` ASC
ERROR - 2023-02-16 03:18:35 --> Severity: error --> Exception: Call to a member function result_array() on boolean C:\xampp\htdocs\Hore\modules\pilih\models\Pilih_model.php 1035
