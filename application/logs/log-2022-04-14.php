<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-04-14 11:20:43 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-04-14 11:20:43 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-04-14 11:21:16 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-04-14 11:21:16 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-04-14 11:21:16 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-04-14 11:21:20 --> Severity: Warning --> Use of undefined constant id_level - assumed 'id_level' (this will throw an Error in a future version of PHP) /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 578
ERROR - 2022-04-14 11:21:20 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-14 11:21:20 --> Severity: error --> Exception: Call to a member function result() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 1091
ERROR - 2022-04-14 11:21:23 --> Severity: Warning --> Use of undefined constant id_level - assumed 'id_level' (this will throw an Error in a future version of PHP) /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 578
ERROR - 2022-04-14 11:21:23 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-14 11:21:23 --> Severity: error --> Exception: Call to a member function result() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 1091
ERROR - 2022-04-14 11:21:34 --> Severity: Warning --> Use of undefined constant id_level - assumed 'id_level' (this will throw an Error in a future version of PHP) /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 578
ERROR - 2022-04-14 11:21:34 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-14 11:21:34 --> Severity: error --> Exception: Call to a member function result() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 1091
ERROR - 2022-04-14 11:21:35 --> Severity: Warning --> Use of undefined constant id_level - assumed 'id_level' (this will throw an Error in a future version of PHP) /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 578
ERROR - 2022-04-14 11:21:35 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-14 11:21:35 --> Severity: error --> Exception: Call to a member function result() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 1091
ERROR - 2022-04-14 11:21:35 --> Severity: Warning --> Use of undefined constant id_level - assumed 'id_level' (this will throw an Error in a future version of PHP) /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 578
ERROR - 2022-04-14 11:21:35 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-14 11:21:35 --> Severity: error --> Exception: Call to a member function result() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 1091
ERROR - 2022-04-14 11:32:40 --> Severity: Warning --> Use of undefined constant id_level - assumed 'id_level' (this will throw an Error in a future version of PHP) /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 578
ERROR - 2022-04-14 11:32:40 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-14 11:32:40 --> Severity: error --> Exception: Call to a member function result() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 1091
ERROR - 2022-04-14 12:47:39 --> Severity: Core Warning --> Module 'mbstring' already loaded Unknown 0
ERROR - 2022-04-14 12:47:45 --> Severity: Warning --> Use of undefined constant id_level - assumed 'id_level' (this will throw an Error in a future version of PHP) /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 578
ERROR - 2022-04-14 12:47:45 --> Query error: No tables used - Invalid query: SELECT *
ERROR - 2022-04-14 12:47:45 --> Severity: error --> Exception: Call to a member function result() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 1091
ERROR - 2022-04-14 13:04:53 --> Query error: Unknown column 'd.id_cluster' in 'on clause' - Invalid query: SELECT `s`.`id_sales`, `s`.`nama_sales`, `b`.`id_branch`, `c`.`id_cluster`, `t`.`id_tap`, `t`.`nama_tap`
FROM `db_sales` `s`
JOIN `bd_tap` `t` ON `s`.`id_tap` = `t`.`id_tap`
JOIN `bc_cluster` `c` ON `t`.`id_cluster` = `d`.`id_cluster`
JOIN `bb_branch` `b` ON `c`.`id_branch` = `b`.`id_branch`
WHERE `b`.`id_regional` = 'REG001'
AND `s`.`id_jenis_sales` = 'SSF'
ERROR - 2022-04-14 13:04:53 --> Severity: error --> Exception: Call to a member function result() on bool /mnt/md0/heero/ftp/upload/hore/hore-dummy/modules/download_master/models/Download_master_model.php 1165
