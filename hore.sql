-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 09:27 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hore`
--

-- --------------------------------------------------------

--
-- Table structure for table `aa_users_level`
--

CREATE TABLE `aa_users_level` (
  `id_level` int(11) NOT NULL,
  `level` varchar(64) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aa_users_level`
--

INSERT INTO `aa_users_level` (`id_level`, `level`, `lastmodified`) VALUES
(1, 'REGIONAL', '2023-01-31 07:38:11'),
(2, 'BRANCH', '2023-01-31 07:38:11'),
(3, 'CLUSTER', '2023-01-31 07:38:11'),
(4, 'TAP', '2023-01-31 07:38:11'),
(5, 'SALES FORCE', '2023-01-31 07:38:11'),
(6, 'CHANNEL SUPPORT', '2023-01-31 07:38:11'),
(7, 'DIRECT SALES', '2023-01-31 07:38:11'),
(8, 'MANAGER TAP AS SALES FORCE', '2023-01-31 07:38:11'),
(9, 'KASIR TAP', '2023-01-31 07:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `ab_users`
--

CREATE TABLE `ab_users` (
  `id_level` int(11) DEFAULT NULL,
  `id_divisi` varchar(64) DEFAULT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `pin` varchar(64) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `kode_verifikasi` varchar(64) DEFAULT NULL,
  `status` enum('AKTIF','TIDAK AKTIF') DEFAULT 'AKTIF',
  `no_urut` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ab_users`
--

INSERT INTO `ab_users` (`id_level`, `id_divisi`, `username`, `password`, `pin`, `email`, `kode_verifikasi`, `status`, `no_urut`, `last_login`, `lastmodified`) VALUES
(1, 'REG001', 'REG001-CO', '4f0c7294c8d190ec96407bae65cbcf7e196410d2', 'sihoreok2022#', 'oetie.dodol@gmail.com', 'NLZT1VVVVVV', 'AKTIF', 1, NULL, '2023-01-31 07:37:18'),
(2, 'BRC001', 'BRC001', 'afa7ba48c4950cbff1dab1766b7dd7bd8b497c0d', 'BRC001', 'oetie.dodol@gmail.com', '', 'AKTIF', 2, NULL, '2023-01-31 07:37:18'),
(2, 'BRC002', 'BRC002', '0eb72fe266e64aee3d71832159f1e20f63569fce', 'BRC002', 'oetie.dodol@gmail.com', '', 'AKTIF', 3, NULL, '2023-01-31 07:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `ac_users_log`
--

CREATE TABLE `ac_users_log` (
  `username` varchar(64) DEFAULT NULL,
  `id_user_aktifitas` int(11) NOT NULL,
  `jenis` varchar(64) DEFAULT NULL,
  `aktifitas` longtext DEFAULT NULL,
  `eval_main` varchar(128) DEFAULT NULL,
  `eval_menu` varchar(128) DEFAULT NULL,
  `eval_submenu` varchar(128) DEFAULT NULL,
  `ip_address` varchar(32) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ad_users_authentication`
--

CREATE TABLE `ad_users_authentication` (
  `id` int(11) NOT NULL,
  `users_id` varchar(64) CHARACTER SET utf8 NOT NULL,
  `role` varchar(64) CHARACTER SET utf8 NOT NULL,
  `nama_sales` varchar(200) CHARACTER SET utf8 NOT NULL,
  `id_tap` varchar(64) CHARACTER SET utf8 NOT NULL,
  `nama_tap` varchar(200) CHARACTER SET utf8 NOT NULL,
  `id_cluster` varchar(64) CHARACTER SET utf8 NOT NULL,
  `nama_cluster` varchar(200) CHARACTER SET utf8 NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 NOT NULL,
  `expired_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ae_dashboard_coverage_branch`
--

CREATE TABLE `ae_dashboard_coverage_branch` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `id_branch` varchar(64) DEFAULT NULL,
  `outlet_open` int(11) DEFAULT 0 COMMENT 'OPEN',
  `outlet_close` int(11) DEFAULT 0 COMMENT 'CLOSE',
  `outlet_total` int(11) DEFAULT 0 COMMENT 'OPEN+CLOSE',
  `outlet_new` int(11) DEFAULT 0 COMMENT 'WAITING APPROVAL',
  `outlet_device` int(11) DEFAULT 0,
  `outlet_reguler` int(11) DEFAULT 0,
  `outlet_pareto` int(11) DEFAULT 0,
  `outlet_pjp` int(11) DEFAULT 0 COMMENT 'SETTING PJP',
  `outlet_clockin` int(11) DEFAULT 0 COMMENT 'SALES CLOCKIN',
  `outlet_target` int(11) DEFAULT 0 COMMENT 'SETTING PJP',
  `outlet_coverage` decimal(11,2) DEFAULT 0.00 COMMENT '(SALES CLOCKIN / SETTING PJP) * 100',
  `sekolah_open` int(11) DEFAULT 0,
  `sekolah_close` int(11) DEFAULT 0,
  `sekolah_total` int(11) DEFAULT 0,
  `sekolah_new` int(11) DEFAULT 0,
  `sekolah_pjp` int(11) DEFAULT 0,
  `sekolah_clockin` int(11) DEFAULT 0,
  `sekolah_target` int(11) DEFAULT 0,
  `sekolah_coverage` decimal(11,2) DEFAULT 0.00,
  `kampus_open` int(11) DEFAULT 0,
  `kampus_close` int(11) DEFAULT 0,
  `kampus_total` int(11) DEFAULT 0,
  `kampus_new` int(11) DEFAULT 0,
  `kampus_pjp` int(11) DEFAULT 0,
  `kampus_clockin` int(11) DEFAULT 0,
  `kampus_target` int(11) DEFAULT 0,
  `kampus_coverage` decimal(11,2) DEFAULT 0.00,
  `fakultas_open` int(11) DEFAULT 0,
  `fakultas_close` int(11) DEFAULT 0,
  `fakultas_total` int(11) DEFAULT 0,
  `fakultas_new` int(11) DEFAULT 0,
  `fakultas_pjp` int(11) DEFAULT 0,
  `fakultas_clockin` int(11) DEFAULT 0,
  `fakultas_target` int(11) DEFAULT 0,
  `fakultas_coverage` decimal(11,2) DEFAULT 0.00,
  `poi_open` int(11) DEFAULT 0,
  `poi_close` int(11) DEFAULT 0,
  `poi_total` int(11) DEFAULT 0,
  `poi_new` int(11) DEFAULT 0,
  `poi_pjp` int(11) DEFAULT 0,
  `poi_clockin` int(11) DEFAULT 0,
  `poi_target` int(11) DEFAULT 0,
  `poi_coverage` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `af_dashboard_coverage_cluster`
--

CREATE TABLE `af_dashboard_coverage_cluster` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `id_cluster` varchar(64) DEFAULT NULL,
  `outlet_open` int(11) DEFAULT 0,
  `outlet_close` int(11) DEFAULT 0,
  `outlet_total` int(11) DEFAULT 0,
  `outlet_new` int(11) DEFAULT 0,
  `outlet_device` int(11) DEFAULT 0,
  `outlet_reguler` int(11) DEFAULT 0,
  `outlet_pareto` int(11) DEFAULT 0,
  `outlet_pjp` int(11) DEFAULT 0,
  `outlet_clockin` int(11) DEFAULT 0,
  `outlet_target` int(11) DEFAULT 0,
  `outlet_coverage` decimal(11,2) DEFAULT 0.00,
  `sekolah_open` int(11) DEFAULT 0,
  `sekolah_close` int(11) DEFAULT 0,
  `sekolah_total` int(11) DEFAULT 0,
  `sekolah_new` int(11) DEFAULT 0,
  `sekolah_pjp` int(11) DEFAULT 0,
  `sekolah_clockin` int(11) DEFAULT 0,
  `sekolah_target` int(11) DEFAULT 0,
  `sekolah_coverage` decimal(11,2) DEFAULT 0.00,
  `kampus_open` int(11) DEFAULT 0,
  `kampus_close` int(11) DEFAULT 0,
  `kampus_total` int(11) DEFAULT 0,
  `kampus_new` int(11) DEFAULT 0,
  `kampus_pjp` int(11) DEFAULT 0,
  `kampus_clockin` int(11) DEFAULT 0,
  `kampus_target` int(11) DEFAULT 0,
  `kampus_coverage` decimal(11,2) DEFAULT 0.00,
  `fakultas_open` int(11) DEFAULT 0,
  `fakultas_close` int(11) DEFAULT 0,
  `fakultas_total` int(11) DEFAULT 0,
  `fakultas_new` int(11) DEFAULT 0,
  `fakultas_pjp` int(11) DEFAULT 0,
  `fakultas_clockin` int(11) DEFAULT 0,
  `fakultas_target` int(11) DEFAULT 0,
  `fakultas_coverage` decimal(11,2) DEFAULT 0.00,
  `poi_open` int(11) DEFAULT 0,
  `poi_close` int(11) DEFAULT 0,
  `poi_total` int(11) DEFAULT 0,
  `poi_new` int(11) DEFAULT 0,
  `poi_pjp` int(11) DEFAULT 0,
  `poi_clockin` int(11) DEFAULT 0,
  `poi_target` int(11) DEFAULT 0,
  `poi_coverage` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ag_dashboard_coverage_tap`
--

CREATE TABLE `ag_dashboard_coverage_tap` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `id_tap` varchar(64) DEFAULT NULL,
  `outlet_open` int(11) DEFAULT 0,
  `outlet_close` int(11) DEFAULT 0,
  `outlet_total` int(11) DEFAULT 0,
  `outlet_new` int(11) DEFAULT 0,
  `outlet_device` int(11) DEFAULT 0,
  `outlet_reguler` int(11) DEFAULT 0,
  `outlet_pareto` int(11) DEFAULT 0,
  `outlet_pjp` int(11) DEFAULT 0,
  `outlet_clockin` int(11) DEFAULT 0,
  `outlet_target` int(11) DEFAULT 0,
  `outlet_coverage` decimal(11,2) DEFAULT 0.00,
  `sekolah_open` int(11) DEFAULT 0,
  `sekolah_close` int(11) DEFAULT 0,
  `sekolah_total` int(11) DEFAULT 0,
  `sekolah_new` int(11) DEFAULT 0,
  `sekolah_pjp` int(11) DEFAULT 0,
  `sekolah_clockin` int(11) DEFAULT 0,
  `sekolah_target` int(11) DEFAULT 0,
  `sekolah_coverage` decimal(11,2) DEFAULT 0.00,
  `kampus_open` int(11) DEFAULT 0,
  `kampus_close` int(11) DEFAULT 0,
  `kampus_total` int(11) DEFAULT 0,
  `kampus_new` int(11) DEFAULT 0,
  `kampus_pjp` int(11) DEFAULT 0,
  `kampus_clockin` int(11) DEFAULT 0,
  `kampus_target` int(11) DEFAULT 0,
  `kampus_coverage` decimal(11,2) DEFAULT 0.00,
  `fakultas_open` int(11) DEFAULT 0,
  `fakultas_close` int(11) DEFAULT 0,
  `fakultas_total` int(11) DEFAULT 0,
  `fakultas_new` int(11) DEFAULT 0,
  `fakultas_pjp` int(11) DEFAULT 0,
  `fakultas_clockin` int(11) DEFAULT 0,
  `fakultas_target` int(11) DEFAULT 0,
  `fakultas_coverage` decimal(11,2) DEFAULT 0.00,
  `poi_open` int(11) DEFAULT 0,
  `poi_close` int(11) DEFAULT 0,
  `poi_total` int(11) DEFAULT 0,
  `poi_new` int(11) DEFAULT 0,
  `poi_pjp` int(11) DEFAULT 0,
  `poi_clockin` int(11) DEFAULT 0,
  `poi_target` int(11) DEFAULT 0,
  `poi_coverage` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ah_dashboard_coverage_kabupaten`
--

CREATE TABLE `ah_dashboard_coverage_kabupaten` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `id_kabupaten` varchar(64) DEFAULT NULL,
  `outlet_open` int(11) DEFAULT 0,
  `outlet_close` int(11) DEFAULT 0,
  `outlet_total` int(11) DEFAULT 0,
  `outlet_new` int(11) DEFAULT 0,
  `outlet_device` int(11) DEFAULT 0,
  `outlet_reguler` int(11) DEFAULT 0,
  `outlet_pareto` int(11) DEFAULT 0,
  `outlet_pjp` int(11) DEFAULT 0,
  `outlet_clockin` int(11) DEFAULT 0,
  `outlet_target` int(11) DEFAULT 0,
  `outlet_coverage` decimal(11,2) DEFAULT 0.00,
  `sekolah_open` int(11) DEFAULT 0,
  `sekolah_close` int(11) DEFAULT 0,
  `sekolah_total` int(11) DEFAULT 0,
  `sekolah_new` int(11) DEFAULT 0,
  `sekolah_pjp` int(11) DEFAULT 0,
  `sekolah_clockin` int(11) DEFAULT 0,
  `sekolah_target` int(11) DEFAULT 0,
  `sekolah_coverage` decimal(11,2) DEFAULT 0.00,
  `kampus_open` int(11) DEFAULT 0,
  `kampus_close` int(11) DEFAULT 0,
  `kampus_total` int(11) DEFAULT 0,
  `kampus_new` int(11) DEFAULT 0,
  `kampus_pjp` int(11) DEFAULT 0,
  `kampus_clockin` int(11) DEFAULT 0,
  `kampus_target` int(11) DEFAULT 0,
  `kampus_coverage` decimal(11,2) DEFAULT 0.00,
  `fakultas_open` int(11) DEFAULT 0,
  `fakultas_close` int(11) DEFAULT 0,
  `fakultas_total` int(11) DEFAULT 0,
  `fakultas_new` int(11) DEFAULT 0,
  `fakultas_pjp` int(11) DEFAULT 0,
  `fakultas_clockin` int(11) DEFAULT 0,
  `fakultas_target` int(11) DEFAULT 0,
  `fakultas_coverage` decimal(11,2) DEFAULT 0.00,
  `poi_open` int(11) DEFAULT 0,
  `poi_close` int(11) DEFAULT 0,
  `poi_total` int(11) DEFAULT 0,
  `poi_new` int(11) DEFAULT 0,
  `poi_pjp` int(11) DEFAULT 0,
  `poi_clockin` int(11) DEFAULT 0,
  `poi_target` int(11) DEFAULT 0,
  `poi_coverage` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ai_dashboard_coverage_kecamatan`
--

CREATE TABLE `ai_dashboard_coverage_kecamatan` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `id_kecamatan` varchar(64) DEFAULT NULL,
  `outlet_open` int(11) DEFAULT 0,
  `outlet_close` int(11) DEFAULT 0,
  `outlet_total` int(11) DEFAULT 0,
  `outlet_new` int(11) DEFAULT 0,
  `outlet_device` int(11) DEFAULT 0,
  `outlet_reguler` int(11) DEFAULT 0,
  `outlet_pareto` int(11) DEFAULT 0,
  `outlet_pjp` int(11) DEFAULT 0,
  `outlet_clockin` int(11) DEFAULT 0,
  `outlet_target` int(11) DEFAULT 0,
  `outlet_coverage` decimal(11,2) DEFAULT 0.00,
  `sekolah_open` int(11) DEFAULT 0,
  `sekolah_close` int(11) DEFAULT 0,
  `sekolah_total` int(11) DEFAULT 0,
  `sekolah_new` int(11) DEFAULT 0,
  `sekolah_pjp` int(11) DEFAULT 0,
  `sekolah_clockin` int(11) DEFAULT 0,
  `sekolah_target` int(11) DEFAULT 0,
  `sekolah_coverage` decimal(11,2) DEFAULT 0.00,
  `kampus_open` int(11) DEFAULT 0,
  `kampus_close` int(11) DEFAULT 0,
  `kampus_total` int(11) DEFAULT 0,
  `kampus_new` int(11) DEFAULT 0,
  `kampus_pjp` int(11) DEFAULT 0,
  `kampus_clockin` int(11) DEFAULT 0,
  `kampus_target` int(11) DEFAULT 0,
  `kampus_coverage` decimal(11,2) DEFAULT 0.00,
  `fakultas_open` int(11) DEFAULT 0,
  `fakultas_close` int(11) DEFAULT 0,
  `fakultas_total` int(11) DEFAULT 0,
  `fakultas_new` int(11) DEFAULT 0,
  `fakultas_pjp` int(11) DEFAULT 0,
  `fakultas_clockin` int(11) DEFAULT 0,
  `fakultas_target` int(11) DEFAULT 0,
  `fakultas_coverage` decimal(11,2) DEFAULT 0.00,
  `poi_open` int(11) DEFAULT 0,
  `poi_close` int(11) DEFAULT 0,
  `poi_total` int(11) DEFAULT 0,
  `poi_new` int(11) DEFAULT 0,
  `poi_pjp` int(11) DEFAULT 0,
  `poi_clockin` int(11) DEFAULT 0,
  `poi_target` int(11) DEFAULT 0,
  `poi_coverage` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aj_dashboard_distribusi_branch`
--

CREATE TABLE `aj_dashboard_distribusi_branch` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `id_branch` varchar(64) DEFAULT NULL,
  `outlet_segel_prepaid` int(11) DEFAULT 0,
  `outlet_segel_voucher` int(11) DEFAULT 0,
  `outlet_segel_total` int(11) DEFAULT 0,
  `outlet_sa_ld` int(11) DEFAULT 0,
  `outlet_sa_md` int(11) DEFAULT 0,
  `outlet_sa_hd` int(11) DEFAULT 0,
  `outlet_sa_total` int(11) DEFAULT 0,
  `outlet_vf_ld` int(11) DEFAULT 0,
  `outlet_vf_md` int(11) DEFAULT 0,
  `outlet_vf_hd` int(11) DEFAULT 0,
  `outlet_vf_total` int(11) DEFAULT 0,
  `outlet_linkaja` int(11) DEFAULT 0,
  `sekolah_segel_prepaid` int(11) DEFAULT 0,
  `sekolah_segel_voucher` int(11) DEFAULT 0,
  `sekolah_segel_total` int(11) DEFAULT 0,
  `sekolah_sa_ld` int(11) DEFAULT 0,
  `sekolah_sa_md` int(11) DEFAULT 0,
  `sekolah_sa_hd` int(11) DEFAULT 0,
  `sekolah_sa_total` int(11) DEFAULT 0,
  `sekolah_vf_ld` int(11) DEFAULT 0,
  `sekolah_vf_md` int(11) DEFAULT 0,
  `sekolah_vf_hd` int(11) DEFAULT 0,
  `sekolah_vf_total` int(11) DEFAULT 0,
  `sekolah_linkaja` int(11) DEFAULT 0,
  `kampus_segel_prepaid` int(11) DEFAULT 0,
  `kampus_segel_voucher` int(11) DEFAULT 0,
  `kampus_segel_total` int(11) DEFAULT 0,
  `kampus_sa_ld` int(11) DEFAULT 0,
  `kampus_sa_md` int(11) DEFAULT 0,
  `kampus_sa_hd` int(11) DEFAULT 0,
  `kampus_sa_total` int(11) DEFAULT 0,
  `kampus_vf_ld` int(11) DEFAULT 0,
  `kampus_vf_md` int(11) DEFAULT 0,
  `kampus_vf_hd` int(11) DEFAULT 0,
  `kampus_vf_total` int(11) DEFAULT 0,
  `kampus_linkaja` int(11) DEFAULT 0,
  `fakultas_segel_prepaid` int(11) DEFAULT 0,
  `fakultas_segel_voucher` int(11) DEFAULT 0,
  `fakultas_segel_total` int(11) DEFAULT 0,
  `fakultas_sa_ld` int(11) DEFAULT 0,
  `fakultas_sa_md` int(11) DEFAULT 0,
  `fakultas_sa_hd` int(11) DEFAULT 0,
  `fakultas_sa_total` int(11) DEFAULT 0,
  `fakultas_vf_ld` int(11) DEFAULT 0,
  `fakultas_vf_md` int(11) DEFAULT 0,
  `fakultas_vf_hd` int(11) DEFAULT 0,
  `fakultas_vf_total` int(11) DEFAULT 0,
  `fakultas_linkaja` int(11) DEFAULT 0,
  `poi_segel_prepaid` int(11) DEFAULT 0,
  `poi_segel_voucher` int(11) DEFAULT 0,
  `poi_segel_total` int(11) DEFAULT 0,
  `poi_sa_ld` int(11) DEFAULT 0,
  `poi_sa_md` int(11) DEFAULT 0,
  `poi_sa_hd` int(11) DEFAULT 0,
  `poi_sa_total` int(11) DEFAULT 0,
  `poi_vf_ld` int(11) DEFAULT 0,
  `poi_vf_md` int(11) DEFAULT 0,
  `poi_vf_hd` int(11) DEFAULT 0,
  `poi_vf_total` int(11) DEFAULT 0,
  `poi_linkaja` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ak_dashboard_distribusi_cluster`
--

CREATE TABLE `ak_dashboard_distribusi_cluster` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `id_cluster` varchar(64) DEFAULT NULL,
  `outlet_segel_prepaid` int(11) DEFAULT 0,
  `outlet_segel_voucher` int(11) DEFAULT 0,
  `outlet_segel_total` int(11) DEFAULT 0,
  `outlet_sa_ld` int(11) DEFAULT 0,
  `outlet_sa_md` int(11) DEFAULT 0,
  `outlet_sa_hd` int(11) DEFAULT 0,
  `outlet_sa_total` int(11) DEFAULT 0,
  `outlet_vf_ld` int(11) DEFAULT 0,
  `outlet_vf_md` int(11) DEFAULT 0,
  `outlet_vf_hd` int(11) DEFAULT 0,
  `outlet_vf_total` int(11) DEFAULT 0,
  `outlet_linkaja` int(11) DEFAULT 0,
  `sekolah_segel_prepaid` int(11) DEFAULT 0,
  `sekolah_segel_voucher` int(11) DEFAULT 0,
  `sekolah_segel_total` int(11) DEFAULT 0,
  `sekolah_sa_ld` int(11) DEFAULT 0,
  `sekolah_sa_md` int(11) DEFAULT 0,
  `sekolah_sa_hd` int(11) DEFAULT 0,
  `sekolah_sa_total` int(11) DEFAULT 0,
  `sekolah_vf_ld` int(11) DEFAULT 0,
  `sekolah_vf_md` int(11) DEFAULT 0,
  `sekolah_vf_hd` int(11) DEFAULT 0,
  `sekolah_vf_total` int(11) DEFAULT 0,
  `sekolah_linkaja` int(11) DEFAULT 0,
  `kampus_segel_prepaid` int(11) DEFAULT 0,
  `kampus_segel_voucher` int(11) DEFAULT 0,
  `kampus_segel_total` int(11) DEFAULT 0,
  `kampus_sa_ld` int(11) DEFAULT 0,
  `kampus_sa_md` int(11) DEFAULT 0,
  `kampus_sa_hd` int(11) DEFAULT 0,
  `kampus_sa_total` int(11) DEFAULT 0,
  `kampus_vf_ld` int(11) DEFAULT 0,
  `kampus_vf_md` int(11) DEFAULT 0,
  `kampus_vf_hd` int(11) DEFAULT 0,
  `kampus_vf_total` int(11) DEFAULT 0,
  `kampus_linkaja` int(11) DEFAULT 0,
  `fakultas_segel_prepaid` int(11) DEFAULT 0,
  `fakultas_segel_voucher` int(11) DEFAULT 0,
  `fakultas_segel_total` int(11) DEFAULT 0,
  `fakultas_sa_ld` int(11) DEFAULT 0,
  `fakultas_sa_md` int(11) DEFAULT 0,
  `fakultas_sa_hd` int(11) DEFAULT 0,
  `fakultas_sa_total` int(11) DEFAULT 0,
  `fakultas_vf_ld` int(11) DEFAULT 0,
  `fakultas_vf_md` int(11) DEFAULT 0,
  `fakultas_vf_hd` int(11) DEFAULT 0,
  `fakultas_vf_total` int(11) DEFAULT 0,
  `fakultas_linkaja` int(11) DEFAULT 0,
  `poi_segel_prepaid` int(11) DEFAULT 0,
  `poi_segel_voucher` int(11) DEFAULT 0,
  `poi_segel_total` int(11) DEFAULT 0,
  `poi_sa_ld` int(11) DEFAULT 0,
  `poi_sa_md` int(11) DEFAULT 0,
  `poi_sa_hd` int(11) DEFAULT 0,
  `poi_sa_total` int(11) DEFAULT 0,
  `poi_vf_ld` int(11) DEFAULT 0,
  `poi_vf_md` int(11) DEFAULT 0,
  `poi_vf_hd` int(11) DEFAULT 0,
  `poi_vf_total` int(11) DEFAULT 0,
  `poi_linkaja` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `al_dashboard_distribusi_tap`
--

CREATE TABLE `al_dashboard_distribusi_tap` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `id_tap` varchar(64) DEFAULT NULL,
  `outlet_segel_prepaid` int(11) DEFAULT 0,
  `outlet_segel_voucher` int(11) DEFAULT 0,
  `outlet_segel_total` int(11) DEFAULT 0,
  `outlet_sa_ld` int(11) DEFAULT 0,
  `outlet_sa_md` int(11) DEFAULT 0,
  `outlet_sa_hd` int(11) DEFAULT 0,
  `outlet_sa_total` int(11) DEFAULT 0,
  `outlet_vf_ld` int(11) DEFAULT 0,
  `outlet_vf_md` int(11) DEFAULT 0,
  `outlet_vf_hd` int(11) DEFAULT 0,
  `outlet_vf_total` int(11) DEFAULT 0,
  `outlet_linkaja` int(11) DEFAULT 0,
  `sekolah_segel_prepaid` int(11) DEFAULT 0,
  `sekolah_segel_voucher` int(11) DEFAULT 0,
  `sekolah_segel_total` int(11) DEFAULT 0,
  `sekolah_sa_ld` int(11) DEFAULT 0,
  `sekolah_sa_md` int(11) DEFAULT 0,
  `sekolah_sa_hd` int(11) DEFAULT 0,
  `sekolah_sa_total` int(11) DEFAULT 0,
  `sekolah_vf_ld` int(11) DEFAULT 0,
  `sekolah_vf_md` int(11) DEFAULT 0,
  `sekolah_vf_hd` int(11) DEFAULT 0,
  `sekolah_vf_total` int(11) DEFAULT 0,
  `sekolah_linkaja` int(11) DEFAULT 0,
  `kampus_segel_prepaid` int(11) DEFAULT 0,
  `kampus_segel_voucher` int(11) DEFAULT 0,
  `kampus_segel_total` int(11) DEFAULT 0,
  `kampus_sa_ld` int(11) DEFAULT 0,
  `kampus_sa_md` int(11) DEFAULT 0,
  `kampus_sa_hd` int(11) DEFAULT 0,
  `kampus_sa_total` int(11) DEFAULT 0,
  `kampus_vf_ld` int(11) DEFAULT 0,
  `kampus_vf_md` int(11) DEFAULT 0,
  `kampus_vf_hd` int(11) DEFAULT 0,
  `kampus_vf_total` int(11) DEFAULT 0,
  `kampus_linkaja` int(11) DEFAULT 0,
  `fakultas_segel_prepaid` int(11) DEFAULT 0,
  `fakultas_segel_voucher` int(11) DEFAULT 0,
  `fakultas_segel_total` int(11) DEFAULT 0,
  `fakultas_sa_ld` int(11) DEFAULT 0,
  `fakultas_sa_md` int(11) DEFAULT 0,
  `fakultas_sa_hd` int(11) DEFAULT 0,
  `fakultas_sa_total` int(11) DEFAULT 0,
  `fakultas_vf_ld` int(11) DEFAULT 0,
  `fakultas_vf_md` int(11) DEFAULT 0,
  `fakultas_vf_hd` int(11) DEFAULT 0,
  `fakultas_vf_total` int(11) DEFAULT 0,
  `fakultas_linkaja` int(11) DEFAULT 0,
  `poi_segel_prepaid` int(11) DEFAULT 0,
  `poi_segel_voucher` int(11) DEFAULT 0,
  `poi_segel_total` int(11) DEFAULT 0,
  `poi_sa_ld` int(11) DEFAULT 0,
  `poi_sa_md` int(11) DEFAULT 0,
  `poi_sa_hd` int(11) DEFAULT 0,
  `poi_sa_total` int(11) DEFAULT 0,
  `poi_vf_ld` int(11) DEFAULT 0,
  `poi_vf_md` int(11) DEFAULT 0,
  `poi_vf_hd` int(11) DEFAULT 0,
  `poi_vf_total` int(11) DEFAULT 0,
  `poi_linkaja` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `am_dashboard_distribusi_kabupaten`
--

CREATE TABLE `am_dashboard_distribusi_kabupaten` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `id_kabupaten` varchar(64) DEFAULT NULL,
  `outlet_segel_prepaid` int(11) DEFAULT 0,
  `outlet_segel_voucher` int(11) DEFAULT 0,
  `outlet_segel_total` int(11) DEFAULT 0,
  `outlet_sa_ld` int(11) DEFAULT 0,
  `outlet_sa_md` int(11) DEFAULT 0,
  `outlet_sa_hd` int(11) DEFAULT 0,
  `outlet_sa_total` int(11) DEFAULT 0,
  `outlet_vf_ld` int(11) DEFAULT 0,
  `outlet_vf_md` int(11) DEFAULT 0,
  `outlet_vf_hd` int(11) DEFAULT 0,
  `outlet_vf_total` int(11) DEFAULT 0,
  `outlet_linkaja` int(11) DEFAULT 0,
  `sekolah_segel_prepaid` int(11) DEFAULT 0,
  `sekolah_segel_voucher` int(11) DEFAULT 0,
  `sekolah_segel_total` int(11) DEFAULT 0,
  `sekolah_sa_ld` int(11) DEFAULT 0,
  `sekolah_sa_md` int(11) DEFAULT 0,
  `sekolah_sa_hd` int(11) DEFAULT 0,
  `sekolah_sa_total` int(11) DEFAULT 0,
  `sekolah_vf_ld` int(11) DEFAULT 0,
  `sekolah_vf_md` int(11) DEFAULT 0,
  `sekolah_vf_hd` int(11) DEFAULT 0,
  `sekolah_vf_total` int(11) DEFAULT 0,
  `sekolah_linkaja` int(11) DEFAULT 0,
  `kampus_segel_prepaid` int(11) DEFAULT 0,
  `kampus_segel_voucher` int(11) DEFAULT 0,
  `kampus_segel_total` int(11) DEFAULT 0,
  `kampus_sa_ld` int(11) DEFAULT 0,
  `kampus_sa_md` int(11) DEFAULT 0,
  `kampus_sa_hd` int(11) DEFAULT 0,
  `kampus_sa_total` int(11) DEFAULT 0,
  `kampus_vf_ld` int(11) DEFAULT 0,
  `kampus_vf_md` int(11) DEFAULT 0,
  `kampus_vf_hd` int(11) DEFAULT 0,
  `kampus_vf_total` int(11) DEFAULT 0,
  `kampus_linkaja` int(11) DEFAULT 0,
  `fakultas_segel_prepaid` int(11) DEFAULT 0,
  `fakultas_segel_voucher` int(11) DEFAULT 0,
  `fakultas_segel_total` int(11) DEFAULT 0,
  `fakultas_sa_ld` int(11) DEFAULT 0,
  `fakultas_sa_md` int(11) DEFAULT 0,
  `fakultas_sa_hd` int(11) DEFAULT 0,
  `fakultas_sa_total` int(11) DEFAULT 0,
  `fakultas_vf_ld` int(11) DEFAULT 0,
  `fakultas_vf_md` int(11) DEFAULT 0,
  `fakultas_vf_hd` int(11) DEFAULT 0,
  `fakultas_vf_total` int(11) DEFAULT 0,
  `fakultas_linkaja` int(11) DEFAULT 0,
  `poi_segel_prepaid` int(11) DEFAULT 0,
  `poi_segel_voucher` int(11) DEFAULT 0,
  `poi_segel_total` int(11) DEFAULT 0,
  `poi_sa_ld` int(11) DEFAULT 0,
  `poi_sa_md` int(11) DEFAULT 0,
  `poi_sa_hd` int(11) DEFAULT 0,
  `poi_sa_total` int(11) DEFAULT 0,
  `poi_vf_ld` int(11) DEFAULT 0,
  `poi_vf_md` int(11) DEFAULT 0,
  `poi_vf_hd` int(11) DEFAULT 0,
  `poi_vf_total` int(11) DEFAULT 0,
  `poi_linkaja` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `an_dashboard_distribusi_kecamatan`
--

CREATE TABLE `an_dashboard_distribusi_kecamatan` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `id_kecamatan` varchar(64) DEFAULT NULL,
  `outlet_segel_prepaid` int(11) DEFAULT 0,
  `outlet_segel_voucher` int(11) DEFAULT 0,
  `outlet_segel_total` int(11) DEFAULT 0,
  `outlet_sa_ld` int(11) DEFAULT 0,
  `outlet_sa_md` int(11) DEFAULT 0,
  `outlet_sa_hd` int(11) DEFAULT 0,
  `outlet_sa_total` int(11) DEFAULT 0,
  `outlet_vf_ld` int(11) DEFAULT 0,
  `outlet_vf_md` int(11) DEFAULT 0,
  `outlet_vf_hd` int(11) DEFAULT 0,
  `outlet_vf_total` int(11) DEFAULT 0,
  `outlet_linkaja` int(11) DEFAULT 0,
  `sekolah_segel_prepaid` int(11) DEFAULT 0,
  `sekolah_segel_voucher` int(11) DEFAULT 0,
  `sekolah_segel_total` int(11) DEFAULT 0,
  `sekolah_sa_ld` int(11) DEFAULT 0,
  `sekolah_sa_md` int(11) DEFAULT 0,
  `sekolah_sa_hd` int(11) DEFAULT 0,
  `sekolah_sa_total` int(11) DEFAULT 0,
  `sekolah_vf_ld` int(11) DEFAULT 0,
  `sekolah_vf_md` int(11) DEFAULT 0,
  `sekolah_vf_hd` int(11) DEFAULT 0,
  `sekolah_vf_total` int(11) DEFAULT 0,
  `sekolah_linkaja` int(11) DEFAULT 0,
  `kampus_segel_prepaid` int(11) DEFAULT 0,
  `kampus_segel_voucher` int(11) DEFAULT 0,
  `kampus_segel_total` int(11) DEFAULT 0,
  `kampus_sa_ld` int(11) DEFAULT 0,
  `kampus_sa_md` int(11) DEFAULT 0,
  `kampus_sa_hd` int(11) DEFAULT 0,
  `kampus_sa_total` int(11) DEFAULT 0,
  `kampus_vf_ld` int(11) DEFAULT 0,
  `kampus_vf_md` int(11) DEFAULT 0,
  `kampus_vf_hd` int(11) DEFAULT 0,
  `kampus_vf_total` int(11) DEFAULT 0,
  `kampus_linkaja` int(11) DEFAULT 0,
  `fakultas_segel_prepaid` int(11) DEFAULT 0,
  `fakultas_segel_voucher` int(11) DEFAULT 0,
  `fakultas_segel_total` int(11) DEFAULT 0,
  `fakultas_sa_ld` int(11) DEFAULT 0,
  `fakultas_sa_md` int(11) DEFAULT 0,
  `fakultas_sa_hd` int(11) DEFAULT 0,
  `fakultas_sa_total` int(11) DEFAULT 0,
  `fakultas_vf_ld` int(11) DEFAULT 0,
  `fakultas_vf_md` int(11) DEFAULT 0,
  `fakultas_vf_hd` int(11) DEFAULT 0,
  `fakultas_vf_total` int(11) DEFAULT 0,
  `fakultas_linkaja` int(11) DEFAULT 0,
  `poi_segel_prepaid` int(11) DEFAULT 0,
  `poi_segel_voucher` int(11) DEFAULT 0,
  `poi_segel_total` int(11) DEFAULT 0,
  `poi_sa_ld` int(11) DEFAULT 0,
  `poi_sa_md` int(11) DEFAULT 0,
  `poi_sa_hd` int(11) DEFAULT 0,
  `poi_sa_total` int(11) DEFAULT 0,
  `poi_vf_ld` int(11) DEFAULT 0,
  `poi_vf_md` int(11) DEFAULT 0,
  `poi_vf_hd` int(11) DEFAULT 0,
  `poi_vf_total` int(11) DEFAULT 0,
  `poi_linkaja` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ba_regional`
--

CREATE TABLE `ba_regional` (
  `id_regional` varchar(64) NOT NULL,
  `nama_regional` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bb_branch`
--

CREATE TABLE `bb_branch` (
  `id_regional` varchar(64) DEFAULT NULL,
  `id_branch` varchar(64) NOT NULL,
  `nama_branch` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bc_cluster`
--

CREATE TABLE `bc_cluster` (
  `id_branch` varchar(64) DEFAULT NULL,
  `id_cluster` varchar(64) NOT NULL,
  `nama_cluster` varchar(128) DEFAULT NULL,
  `mitra_ad` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bd_main_tap`
--

CREATE TABLE `bd_main_tap` (
  `id` int(11) NOT NULL,
  `modul` varchar(64) DEFAULT NULL,
  `aksi` varchar(128) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `ip_address` varchar(64) DEFAULT NULL,
  `created_by` varchar(64) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bd_tap`
--

CREATE TABLE `bd_tap` (
  `id_kabupaten` varchar(64) DEFAULT NULL,
  `id_cluster` varchar(64) DEFAULT NULL,
  `id_tap` varchar(64) NOT NULL,
  `level_tap` enum('TAP','MAIN TAP') DEFAULT 'TAP',
  `nama_tap` varchar(128) DEFAULT NULL,
  `manager` varchar(128) DEFAULT NULL,
  `longitude` varchar(64) DEFAULT NULL,
  `latitude` varchar(64) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `be_tap_mutasi`
--

CREATE TABLE `be_tap_mutasi` (
  `id_tap` varchar(64) DEFAULT NULL,
  `id_tap_mutasi` int(11) NOT NULL,
  `manager_lama` varchar(128) DEFAULT NULL,
  `manager_baru` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ca_provinsi`
--

CREATE TABLE `ca_provinsi` (
  `id_provinsi` varchar(64) NOT NULL,
  `nama_provinsi` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cb_kabupaten`
--

CREATE TABLE `cb_kabupaten` (
  `id_provinsi` varchar(64) DEFAULT NULL,
  `id_kabupaten` varchar(64) NOT NULL,
  `nama_kabupaten` varchar(128) DEFAULT NULL,
  `radius_clock_in` int(11) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cc_kecamatan`
--

CREATE TABLE `cc_kecamatan` (
  `id_kabupaten` varchar(64) DEFAULT NULL,
  `id_cluster` varchar(64) DEFAULT NULL,
  `id_kecamatan` varchar(64) NOT NULL,
  `nama_kecamatan` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cd_kelurahan`
--

CREATE TABLE `cd_kelurahan` (
  `id_kecamatan` varchar(64) DEFAULT NULL,
  `id_kelurahan` varchar(64) NOT NULL,
  `nama_kelurahan` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `da_jenis_sales`
--

CREATE TABLE `da_jenis_sales` (
  `id_jenis_sales` varchar(64) NOT NULL,
  `nama_jenis_sales` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `db_sales`
--

CREATE TABLE `db_sales` (
  `id_jenis_sales` varchar(64) DEFAULT NULL,
  `id_tap` varchar(64) DEFAULT NULL,
  `id_sales` varchar(64) NOT NULL,
  `nama_sales` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `limit_link_aja` decimal(11,2) NOT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `id_sales_pengganti` varchar(64) NOT NULL,
  `status` enum('AKTIF','TIDAK AKTIF') DEFAULT 'AKTIF',
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ea_jenis_lokasi`
--

CREATE TABLE `ea_jenis_lokasi` (
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `nama_jenis_lokasi` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eb_outlet`
--

CREATE TABLE `eb_outlet` (
  `id_kelurahan` varchar(64) DEFAULT NULL,
  `id_jenis_outlet` int(11) DEFAULT NULL,
  `id_tap` varchar(20) NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `id_digipos` varchar(64) DEFAULT NULL,
  `nama_outlet` varchar(128) DEFAULT NULL,
  `alamat_outlet` text DEFAULT NULL,
  `longitude` varchar(64) DEFAULT NULL,
  `latitude` varchar(64) DEFAULT NULL,
  `no_rs` varchar(30) NOT NULL,
  `status` enum('OPEN','CLOSE','WAITING APPROVAL','REJECTED') DEFAULT 'WAITING APPROVAL',
  `nama_owner` varchar(128) DEFAULT NULL,
  `no_hp_owner` varchar(32) DEFAULT NULL,
  `tgl_lahir_owner` date DEFAULT NULL,
  `hobi_owner` varchar(128) DEFAULT NULL,
  `akun_fb_owner` varchar(128) DEFAULT NULL,
  `akun_ig_owner` varchar(128) DEFAULT NULL,
  `nama_pic` varchar(128) DEFAULT NULL,
  `no_hp_pic` varchar(32) DEFAULT NULL,
  `tgl_lahir_pic` date DEFAULT NULL,
  `hobi_pic` varchar(128) DEFAULT NULL,
  `akun_fb_pic` varchar(128) DEFAULT NULL,
  `akun_ig_pic` varchar(128) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `tipe_outlet` varchar(100) DEFAULT NULL,
  `fisik` varchar(100) DEFAULT NULL,
  `tipe_lokasi` varchar(100) DEFAULT NULL,
  `klasifikasi` varchar(100) DEFAULT NULL,
  `jadwal_kunjungan` varchar(100) DEFAULT NULL,
  `tgl_open` date DEFAULT NULL COMMENT 'Lokasi pertama kali ditambah',
  `tgl_close` date DEFAULT NULL COMMENT 'Lokasi tidak beroperasi lagi',
  `tgl_waiting` date DEFAULT NULL COMMENT 'Lokasi pertama kali ditambah',
  `tgl_approval` date DEFAULT NULL COMMENT 'Lokasi diapproved/rejected',
  `created_by` varchar(64) DEFAULT NULL,
  `approval_by` varchar(64) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ec_sekolah`
--

CREATE TABLE `ec_sekolah` (
  `id_kelurahan` varchar(64) DEFAULT NULL,
  `id_tap` varchar(20) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `no_npsn` varchar(64) DEFAULT NULL,
  `nama_sekolah` varchar(128) DEFAULT NULL,
  `alamat_sekolah` text DEFAULT NULL,
  `longitude` varchar(64) DEFAULT NULL,
  `latitude` varchar(64) DEFAULT NULL,
  `status` enum('OPEN','CLOSE','WAITING APPROVAL','REJECTED') DEFAULT 'WAITING APPROVAL',
  `nama_kepsek` varchar(128) DEFAULT NULL,
  `no_hp_kepsek` varchar(32) DEFAULT NULL,
  `tgl_lahir_kepsek` date DEFAULT NULL,
  `hobi_kepsek` varchar(128) DEFAULT NULL,
  `akun_fb_kepsek` varchar(128) DEFAULT NULL,
  `akun_ig_kepsek` varchar(128) DEFAULT NULL,
  `nama_pic` varchar(128) DEFAULT NULL,
  `no_hp_pic` varchar(32) DEFAULT NULL,
  `tgl_lahir_pic` date DEFAULT NULL,
  `hobi_pic` varchar(128) DEFAULT NULL,
  `akun_fb_pic` varchar(128) DEFAULT NULL,
  `akun_ig_pic` varchar(128) DEFAULT NULL,
  `jumlah_guru` int(11) DEFAULT 0,
  `jumlah_siswa` int(11) DEFAULT 0,
  `jenjang` enum('SD','SMP','SMA','PONPES') DEFAULT NULL,
  `tgl_open` date DEFAULT NULL COMMENT 'Lokasi pertama kali ditambah',
  `tgl_close` date DEFAULT NULL COMMENT 'Lokasi tidak beroperasi lagi',
  `tgl_waiting` date DEFAULT NULL COMMENT 'Lokasi pertama kali ditambah',
  `tgl_approval` date DEFAULT NULL COMMENT 'Lokasi diapproved/rejected',
  `created_by` varchar(64) DEFAULT NULL,
  `approval_by` varchar(64) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ed_kampus`
--

CREATE TABLE `ed_kampus` (
  `id_kelurahan` varchar(64) DEFAULT NULL,
  `id_tap` varchar(20) NOT NULL,
  `id_universitas` int(11) NOT NULL,
  `no_npsn` varchar(64) DEFAULT NULL,
  `nama_universitas` varchar(128) DEFAULT NULL,
  `alamat_universitas` text DEFAULT NULL,
  `longitude` varchar(64) DEFAULT NULL,
  `latitude` varchar(64) DEFAULT NULL,
  `status` enum('OPEN','CLOSE','WAITING APPROVAL','REJECTED') DEFAULT 'WAITING APPROVAL',
  `nama_rektor` varchar(128) DEFAULT NULL,
  `no_hp_rektor` varchar(32) DEFAULT NULL,
  `tgl_lahir_rektor` date DEFAULT NULL,
  `hobi_rektor` varchar(128) DEFAULT NULL,
  `akun_fb_rektor` varchar(128) DEFAULT NULL,
  `akun_ig_rektor` varchar(128) DEFAULT NULL,
  `nama_pic` varchar(128) DEFAULT NULL,
  `no_hp_pic` varchar(32) DEFAULT NULL,
  `tgl_lahir_pic` date DEFAULT NULL,
  `hobi_pic` varchar(128) DEFAULT NULL,
  `akun_fb_pic` varchar(128) DEFAULT NULL,
  `akun_ig_pic` varchar(128) DEFAULT NULL,
  `jumlah_mahasiswa` int(11) NOT NULL,
  `tgl_open` date DEFAULT NULL COMMENT 'Lokasi pertama kali ditambah',
  `tgl_close` date DEFAULT NULL COMMENT 'Lokasi tidak beroperasi lagi',
  `tgl_waiting` date DEFAULT NULL COMMENT 'Lokasi pertama kali ditambah',
  `tgl_approval` date DEFAULT NULL COMMENT 'Lokasi diapproved/rejected',
  `created_by` varchar(64) DEFAULT NULL,
  `approval_by` varchar(64) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ee_fakultas`
--

CREATE TABLE `ee_fakultas` (
  `id_kelurahan` varchar(64) DEFAULT NULL,
  `id_tap` varchar(20) NOT NULL,
  `id_universitas` int(11) DEFAULT NULL,
  `id_fakultas` int(11) NOT NULL,
  `nama_fakultas` varchar(128) DEFAULT NULL,
  `alamat_fakultas` text DEFAULT NULL,
  `longitude` varchar(64) DEFAULT NULL,
  `latitude` varchar(64) DEFAULT NULL,
  `status` enum('OPEN','CLOSE','WAITING APPROVAL','REJECTED') DEFAULT 'WAITING APPROVAL',
  `nama_dekan` varchar(128) DEFAULT NULL,
  `no_hp_dekan` varchar(32) DEFAULT NULL,
  `tgl_lahir_dekan` date DEFAULT NULL,
  `hobi_dekan` varchar(128) DEFAULT NULL,
  `akun_fb_dekan` varchar(128) DEFAULT NULL,
  `akun_ig_dekan` varchar(128) DEFAULT NULL,
  `nama_pic` varchar(128) DEFAULT NULL,
  `no_hp_pic` varchar(32) DEFAULT NULL,
  `tgl_lahir_pic` date DEFAULT NULL,
  `hobi_pic` varchar(128) DEFAULT NULL,
  `akun_fb_pic` varchar(128) DEFAULT NULL,
  `akun_ig_pic` varchar(128) DEFAULT NULL,
  `jumlah_dosen` int(11) DEFAULT 0,
  `jumlah_mahasiswa` int(11) DEFAULT 0,
  `tgl_open` date DEFAULT NULL COMMENT 'Lokasi pertama kali ditambah',
  `tgl_close` date DEFAULT NULL COMMENT 'Lokasi tidak beroperasi lagi',
  `tgl_waiting` date DEFAULT NULL COMMENT 'Lokasi pertama kali ditambah',
  `tgl_approval` date DEFAULT NULL COMMENT 'Lokasi diapproved/rejected',
  `created_by` varchar(64) DEFAULT NULL,
  `approval_by` varchar(64) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ef_poi`
--

CREATE TABLE `ef_poi` (
  `id_kelurahan` varchar(64) DEFAULT NULL,
  `id_tap` varchar(20) NOT NULL,
  `id_poi` int(11) NOT NULL,
  `nama_poi` varchar(128) DEFAULT NULL,
  `alamat_poi` text DEFAULT NULL,
  `longitude` varchar(64) DEFAULT NULL,
  `latitude` varchar(64) DEFAULT NULL,
  `status` enum('OPEN','CLOSE','WAITING APPROVAL','REJECTED') DEFAULT 'WAITING APPROVAL',
  `tgl_open` date DEFAULT NULL COMMENT 'Lokasi pertama kali ditambah',
  `tgl_close` date DEFAULT NULL COMMENT 'Lokasi tidak beroperasi lagi',
  `tgl_waiting` date DEFAULT NULL COMMENT 'Lokasi pertama kali ditambah',
  `tgl_approval` date DEFAULT NULL COMMENT 'Lokasi diapproved/rejected',
  `created_by` varchar(64) DEFAULT NULL,
  `approval_by` varchar(64) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eh_jenis_outlet`
--

CREATE TABLE `eh_jenis_outlet` (
  `id_jenis_outlet` int(11) NOT NULL,
  `nama_jenis_outlet` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fa_pjp`
--

CREATE TABLE `fa_pjp` (
  `id_sales` varchar(64) DEFAULT NULL,
  `id_tempat` varchar(64) DEFAULT NULL,
  `id_jenis_lokasi` varchar(64) DEFAULT NULL,
  `id_pjp` int(11) NOT NULL,
  `hari` enum('SENIN','SELASA','RABU','KAMIS','JUMAT','SABTU','MINGGU') DEFAULT 'SENIN',
  `no_kunjungan` int(11) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fb_histroy_pjp`
--

CREATE TABLE `fb_histroy_pjp` (
  `id_sales` varchar(64) DEFAULT NULL,
  `id_tempat` varchar(64) DEFAULT NULL,
  `id_jenis_lokasi` varchar(64) DEFAULT NULL,
  `id_history_pjp` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_clock_in` time DEFAULT '00:00:00',
  `jam_clock_out` time NOT NULL DEFAULT '00:00:00',
  `clockin_distribusi` varchar(100) DEFAULT NULL,
  `clockin_merchandising` varchar(100) DEFAULT NULL,
  `clockin_promotion` varchar(100) DEFAULT NULL,
  `clockin_marketaudit` varchar(100) DEFAULT NULL,
  `clockin_report_mt` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `foto_status_close` varchar(200) DEFAULT NULL,
  `foto_distribusi` varchar(200) DEFAULT NULL,
  `foto_merchandising_perdana` varchar(64) DEFAULT NULL,
  `foto_merchandising_voucher_fisik` varchar(64) DEFAULT NULL,
  `foto_merchandising_backdrop` varchar(64) DEFAULT NULL,
  `foto_merchandising_papannama` varchar(64) DEFAULT NULL,
  `foto_merchandising_poster` varchar(64) DEFAULT NULL,
  `foto_merchandising_spanduk` varchar(64) DEFAULT NULL,
  `video_promotion` varchar(64) DEFAULT NULL,
  `foto_marketaudit_belanja` varchar(64) DEFAULT NULL,
  `data_marketaudit_broadband` varchar(64) DEFAULT NULL,
  `data_marketaudit_voucher` varchar(64) DEFAULT NULL,
  `data_marketaudit_quisioner` varchar(64) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fc_tracking_sales`
--

CREATE TABLE `fc_tracking_sales` (
  `id_sales` varchar(64) DEFAULT NULL,
  `id_tracking_sales` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `waktu_user` varchar(100) DEFAULT NULL,
  `longitude` varchar(64) DEFAULT NULL,
  `latitude` varchar(64) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fd_no_kunjungan`
--

CREATE TABLE `fd_no_kunjungan` (
  `no_kunjungan` int(11) NOT NULL,
  `lastmodified` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fe_daftar_pjp`
--

CREATE TABLE `fe_daftar_pjp` (
  `id_sales` varchar(64) DEFAULT NULL,
  `id_tempat` int(11) DEFAULT NULL,
  `id_jenis_lokasi` varchar(64) DEFAULT NULL,
  `no_kunjungan` int(11) DEFAULT NULL,
  `id_daftar_pjp` int(11) NOT NULL,
  `hari` enum('SENIN','SELASA','RABU','KAMIS','JUMAT','SABTU') DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `longitude` varchar(64) DEFAULT NULL,
  `latitude` varchar(64) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ga_jenis_produk`
--

CREATE TABLE `ga_jenis_produk` (
  `id_jenis_produk` varchar(64) NOT NULL,
  `kategori_produk` varchar(200) DEFAULT NULL,
  `nama_jenis_produk` varchar(128) DEFAULT NULL,
  `subjenis_produk` varchar(200) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gb_produk`
--

CREATE TABLE `gb_produk` (
  `id_kabupaten` varchar(64) DEFAULT NULL COMMENT 'INJECT',
  `id_zona` int(11) DEFAULT NULL COMMENT 'INJECT',
  `id_jenis_produk` varchar(64) DEFAULT NULL,
  `id_jenis_inject` int(11) DEFAULT NULL COMMENT 'LD; MD; HD',
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(64) DEFAULT NULL,
  `nama_produk` varchar(128) DEFAULT NULL,
  `harga_modal` decimal(11,2) DEFAULT 0.00 COMMENT 'SEGEL',
  `harga_bandrol` decimal(11,2) DEFAULT 0.00 COMMENT 'SEGEL (HARGA PULSA)',
  `total_kuota` int(11) DEFAULT 0 COMMENT 'INJECT',
  `masa_paket` int(11) DEFAULT 0 COMMENT 'INJECT',
  `harga_paket` decimal(11,2) DEFAULT 0.00 COMMENT 'INJECT',
  `keterangan` text DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gc_zona`
--

CREATE TABLE `gc_zona` (
  `id_zona` int(11) NOT NULL,
  `nama_zona` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gd_jenis_inject`
--

CREATE TABLE `gd_jenis_inject` (
  `id_jenis_inject` int(11) NOT NULL,
  `nama_jenis_inject` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_gudang`
--

CREATE TABLE `ha_gudang` (
  `id_gudang` int(11) NOT NULL,
  `tgl_sn_dibentuk` datetime DEFAULT NULL,
  `id_cluster` varchar(64) DEFAULT NULL,
  `id_produk_segel` int(11) DEFAULT NULL,
  `serial_number` varchar(16) DEFAULT NULL,
  `harga_modal_branch` decimal(11,2) DEFAULT NULL,
  `harga_bandrol_branch` decimal(11,2) DEFAULT NULL,
  `status_sn` enum('AVAILABLE','NOT AVAILABLE') DEFAULT 'AVAILABLE',
  `status_distribusi` enum('DISTRIBUTION','NOT DISTRIBUTION') DEFAULT 'NOT DISTRIBUTION',
  `tgl_distribusi_ke_tap` datetime DEFAULT NULL,
  `id_tap` varchar(64) DEFAULT NULL,
  `harga_modal_cluster` decimal(11,2) DEFAULT NULL,
  `harga_bandrol_cluster` decimal(11,2) DEFAULT NULL,
  `tgl_inject` datetime DEFAULT NULL,
  `id_produk_inject` int(11) DEFAULT NULL,
  `total_kuota` decimal(11,2) DEFAULT NULL,
  `masa_paket` int(11) DEFAULT NULL,
  `harga_paket` decimal(11,2) DEFAULT NULL,
  `modal_bulk` decimal(11,2) DEFAULT NULL,
  `jml_bulk` decimal(11,2) DEFAULT NULL,
  `total_modal` decimal(11,2) DEFAULT NULL,
  `status_produk` enum('SEGEL','INJECT') DEFAULT 'SEGEL',
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hb_retur_tap`
--

CREATE TABLE `hb_retur_tap` (
  `id_retur` int(11) NOT NULL,
  `tgl_retur` date DEFAULT NULL,
  `id_tap` varchar(64) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `alasan` int(11) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hc_retur_detail`
--

CREATE TABLE `hc_retur_detail` (
  `id_retur` int(11) DEFAULT NULL,
  `id_retur_detail` int(11) NOT NULL,
  `serial_number` varchar(16) DEFAULT NULL,
  `tgl_distribusi_ke_tap` datetime DEFAULT NULL,
  `tgl_inject` date DEFAULT NULL,
  `total_kuota` decimal(11,2) DEFAULT NULL,
  `harga_paket` decimal(11,2) DEFAULT NULL,
  `modal_bulk` decimal(11,2) DEFAULT NULL,
  `jml_bulk` int(11) DEFAULT NULL,
  `total_modal` decimal(11,2) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hd_alasan_retur`
--

CREATE TABLE `hd_alasan_retur` (
  `id_alasan` int(11) NOT NULL,
  `nama_alasan` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ia_distribusi_perdana`
--

CREATE TABLE `ia_distribusi_perdana` (
  `id_sales` varchar(64) DEFAULT NULL,
  `id_distribusi` int(11) NOT NULL,
  `tgl_distribusi` date DEFAULT NULL,
  `serial_number` varchar(64) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga_modal` decimal(11,2) DEFAULT NULL,
  `harga_jual` decimal(11,2) DEFAULT NULL,
  `status_distribusi` enum('AVAILABLE','NOT AVAILABLE') DEFAULT 'AVAILABLE',
  `status_penjualan` enum('TERJUAL','BELUM TERJUAL') DEFAULT 'BELUM TERJUAL',
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ib_distribusi_la`
--

CREATE TABLE `ib_distribusi_la` (
  `id_sales` varchar(64) DEFAULT NULL,
  `id_distribusi` int(11) NOT NULL,
  `tgl_distribusi` date DEFAULT NULL,
  `limit_la` decimal(11,2) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ic_retur_sales`
--

CREATE TABLE `ic_retur_sales` (
  `id_sales` varchar(64) DEFAULT NULL,
  `id_retur` int(11) NOT NULL,
  `tgl_retur` date DEFAULT NULL,
  `serial_number` varchar(16) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga_modal` decimal(11,2) DEFAULT NULL,
  `harga_jual` decimal(11,2) DEFAULT NULL,
  `alasan` int(11) DEFAULT NULL,
  `status` enum('WAITING APPROVAL','APPROVED','REJECTED') DEFAULT 'WAITING APPROVAL',
  `tgl_approval` date DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ja_penjualan_tanggal`
--

CREATE TABLE `ja_penjualan_tanggal` (
  `tanggal_merge` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `hari` varchar(50) NOT NULL,
  `tahun_real` int(11) DEFAULT NULL,
  `bulan_real` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jc_penjualan`
--

CREATE TABLE `jc_penjualan` (
  `id_sales` varchar(64) DEFAULT NULL,
  `id_jenis_lokasi` varchar(64) DEFAULT NULL,
  `id_lokasi` varchar(64) DEFAULT NULL,
  `nama_pembeli` varchar(128) DEFAULT NULL,
  `no_hp_pembeli` varchar(16) DEFAULT NULL,
  `no_nota` varchar(64) NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `link_aja` decimal(11,2) DEFAULT NULL,
  `pembayaran` enum('LUNAS','KONSINYASI') DEFAULT 'LUNAS',
  `no_urut` int(11) NOT NULL,
  `setoran` decimal(11,2) DEFAULT 0.00,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jd_penjualan_detail`
--

CREATE TABLE `jd_penjualan_detail` (
  `no_nota` varchar(64) DEFAULT NULL,
  `id_penjualan_detail` int(11) NOT NULL,
  `serial_number` varchar(16) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga_modal` decimal(11,2) DEFAULT NULL,
  `harga_jual` decimal(11,2) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ka_rekomendasi`
--

CREATE TABLE `ka_rekomendasi` (
  `id_rekomendasi` int(11) NOT NULL,
  `id_cluster` varchar(64) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `ss_sgprepaid` int(11) DEFAULT 0,
  `ss_sgota` int(11) DEFAULT 0,
  `ss_sgvin` int(11) DEFAULT 0,
  `ss_sgvgs` int(11) DEFAULT 0,
  `ss_sgvgg` int(11) DEFAULT 0,
  `ss_sgvgp` int(11) DEFAULT 0,
  `ss_insac_ld` int(11) DEFAULT 0,
  `ss_insac_md` int(11) DEFAULT 0,
  `ss_insac_hd` int(11) DEFAULT 0,
  `ss_invin_ld` int(11) DEFAULT 0,
  `ss_invin_md` int(11) DEFAULT 0,
  `ss_invin_hd` int(11) DEFAULT 0,
  `ss_invga_ld` int(11) DEFAULT 0,
  `ss_invga_md` int(11) DEFAULT 0,
  `ss_invga_hd` int(11) DEFAULT 0,
  `total_ss` int(11) DEFAULT 0,
  `dpt_sgprepaid` int(11) DEFAULT 0,
  `dpt_sgota` int(11) DEFAULT 0,
  `dpt_sgvin` int(11) DEFAULT 0,
  `dpt_sgvgs` int(11) DEFAULT 0,
  `dpt_sgvgg` int(11) DEFAULT 0,
  `dpt_sgvgp` int(11) DEFAULT 0,
  `dpt_insac_ld` int(11) DEFAULT 0,
  `dpt_insac_md` int(11) DEFAULT 0,
  `dpt_insac_hd` int(11) DEFAULT 0,
  `dpt_invin_ld` int(11) DEFAULT 0,
  `dpt_invin_md` int(11) DEFAULT 0,
  `dpt_invin_hd` int(11) DEFAULT 0,
  `dpt_invga_ld` int(11) DEFAULT 0,
  `dpt_invga_md` int(11) DEFAULT 0,
  `dpt_invga_hd` int(11) DEFAULT 0,
  `total_dpt` int(11) DEFAULT 0,
  `td_sgprepaid` int(11) DEFAULT 0,
  `td_sgota` int(11) DEFAULT 0,
  `td_sgvin` int(11) DEFAULT 0,
  `td_sgvgs` int(11) DEFAULT 0,
  `td_sgvgg` int(11) DEFAULT 0,
  `td_sgvgp` int(11) DEFAULT 0,
  `td_insac_ld` int(11) DEFAULT 0,
  `td_insac_md` int(11) DEFAULT 0,
  `td_insac_hd` int(11) DEFAULT 0,
  `td_invin_ld` int(11) DEFAULT 0,
  `td_invin_md` int(11) DEFAULT 0,
  `td_invin_hd` int(11) DEFAULT 0,
  `td_invga_ld` int(11) DEFAULT 0,
  `td_invga_md` int(11) DEFAULT 0,
  `td_invga_hd` int(11) DEFAULT 0,
  `total_td` int(11) DEFAULT 0,
  `ds_sek_sgprepaid` int(11) DEFAULT 0,
  `ds_sek_sgota` int(11) DEFAULT 0,
  `ds_sek_sgvin` int(11) DEFAULT 0,
  `ds_sek_sgvgs` int(11) DEFAULT 0,
  `ds_sek_sgvgg` int(11) DEFAULT 0,
  `ds_sek_sgvgp` int(11) DEFAULT 0,
  `ds_sek_insac_ld` int(11) DEFAULT 0,
  `ds_sek_insac_md` int(11) DEFAULT 0,
  `ds_sek_insac_hd` int(11) DEFAULT 0,
  `ds_sek_invin_ld` int(11) DEFAULT 0,
  `ds_sek_invin_md` int(11) DEFAULT 0,
  `ds_sek_invin_hd` int(11) DEFAULT 0,
  `ds_sek_invga_ld` int(11) DEFAULT 0,
  `ds_sek_invga_md` int(11) DEFAULT 0,
  `ds_sek_invga_hd` int(11) DEFAULT 0,
  `total_ds_sek` int(11) DEFAULT 0,
  `ds_kam_sgprepaid` int(11) DEFAULT 0,
  `ds_kam_sgota` int(11) DEFAULT 0,
  `ds_kam_sgvin` int(11) DEFAULT 0,
  `ds_kam_sgvgs` int(11) DEFAULT 0,
  `ds_kam_sgvgg` int(11) DEFAULT 0,
  `ds_kam_sgvgp` int(11) DEFAULT 0,
  `ds_kam_insac_ld` int(11) DEFAULT 0,
  `ds_kam_insac_md` int(11) DEFAULT 0,
  `ds_kam_insac_hd` int(11) DEFAULT 0,
  `ds_kam_invin_ld` int(11) DEFAULT 0,
  `ds_kam_invin_md` int(11) DEFAULT 0,
  `ds_kam_invin_hd` int(11) DEFAULT 0,
  `ds_kam_invga_ld` int(11) DEFAULT 0,
  `ds_kam_invga_md` int(11) DEFAULT 0,
  `ds_kam_invga_hd` int(11) DEFAULT 0,
  `total_ds_kam` int(11) DEFAULT 0,
  `ds_fak_sgprepaid` int(11) DEFAULT 0,
  `ds_fak_sgota` int(11) DEFAULT 0,
  `ds_fak_sgvin` int(11) DEFAULT 0,
  `ds_fak_sgvgs` int(11) DEFAULT 0,
  `ds_fak_sgvgg` int(11) DEFAULT 0,
  `ds_fak_sgvgp` int(11) DEFAULT 0,
  `ds_fak_insac_ld` int(11) DEFAULT 0,
  `ds_fak_insac_md` int(11) DEFAULT 0,
  `ds_fak_insac_hd` int(11) DEFAULT 0,
  `ds_fak_invin_ld` int(11) DEFAULT 0,
  `ds_fak_invin_md` int(11) DEFAULT 0,
  `ds_fak_invin_hd` int(11) DEFAULT 0,
  `ds_fak_invga_ld` int(11) DEFAULT 0,
  `ds_fak_invga_md` int(11) DEFAULT 0,
  `ds_fak_invga_hd` int(11) DEFAULT 0,
  `total_ds_fak` int(11) DEFAULT 0,
  `ds_poi_sgprepaid` int(11) DEFAULT 0,
  `ds_poi_sgota` int(11) DEFAULT 0,
  `ds_poi_sgvin` int(11) DEFAULT 0,
  `ds_poi_sgvgs` int(11) DEFAULT 0,
  `ds_poi_sgvgg` int(11) DEFAULT 0,
  `ds_poi_sgvgp` int(11) DEFAULT 0,
  `ds_poi_insac_ld` int(11) DEFAULT 0,
  `ds_poi_insac_md` int(11) DEFAULT 0,
  `ds_poi_insac_hd` int(11) DEFAULT 0,
  `ds_poi_invin_ld` int(11) DEFAULT 0,
  `ds_poi_invin_md` int(11) DEFAULT 0,
  `ds_poi_invin_hd` int(11) DEFAULT 0,
  `ds_poi_invga_ld` int(11) DEFAULT 0,
  `ds_poi_invga_md` int(11) DEFAULT 0,
  `ds_poi_invga_hd` int(11) DEFAULT 0,
  `total_ds_poi` int(11) DEFAULT 0,
  `tds_sgprepaid` int(11) DEFAULT 0,
  `tds_sgota` int(11) DEFAULT 0,
  `tds_sgvin` int(11) DEFAULT 0,
  `tds_sgvgs` int(11) DEFAULT 0,
  `tds_sgvgg` int(11) DEFAULT 0,
  `tds_sgvgp` int(11) DEFAULT 0,
  `tds_insac_ld` int(11) DEFAULT 0,
  `tds_insac_md` int(11) DEFAULT 0,
  `tds_insac_hd` int(11) DEFAULT 0,
  `tds_invin_ld` int(11) DEFAULT 0,
  `tds_invin_md` int(11) DEFAULT 0,
  `tds_invin_hd` int(11) DEFAULT 0,
  `tds_invga_ld` int(11) DEFAULT 0,
  `tds_invga_md` int(11) DEFAULT 0,
  `tds_invga_hd` int(11) DEFAULT 0,
  `total_tds` int(11) DEFAULT 0,
  `sf_out_sgprepaid` int(11) DEFAULT 0,
  `sf_out_sgota` int(11) DEFAULT 0,
  `sf_out_sgvin` int(11) DEFAULT 0,
  `sf_out_sgvgs` int(11) DEFAULT 0,
  `sf_out_sgvgg` int(11) DEFAULT 0,
  `sf_out_sgvgp` int(11) DEFAULT 0,
  `sf_out_insac_ld` int(11) DEFAULT 0,
  `sf_out_insac_md` int(11) DEFAULT 0,
  `sf_out_insac_hd` int(11) DEFAULT 0,
  `sf_out_invin_ld` int(11) DEFAULT 0,
  `sf_out_invin_md` int(11) DEFAULT 0,
  `sf_out_invin_hd` int(11) DEFAULT 0,
  `sf_out_invga_ld` int(11) DEFAULT 0,
  `sf_out_invga_md` int(11) DEFAULT 0,
  `sf_out_invga_hd` int(11) DEFAULT 0,
  `total_sf_out` int(11) DEFAULT 0,
  `tis_sgprepaid` int(11) DEFAULT 0,
  `tis_sgota` int(11) DEFAULT 0,
  `tis_sgvin` int(11) DEFAULT 0,
  `tis_sgvgs` int(11) DEFAULT 0,
  `tis_sgvgg` int(11) DEFAULT 0,
  `tis_sgvgp` int(11) DEFAULT 0,
  `tis_insac_ld` int(11) DEFAULT 0,
  `tis_insac_md` int(11) DEFAULT 0,
  `tis_insac_hd` int(11) DEFAULT 0,
  `tis_invin_ld` int(11) DEFAULT 0,
  `tis_invin_md` int(11) DEFAULT 0,
  `tis_invin_hd` int(11) DEFAULT 0,
  `tis_invga_ld` int(11) DEFAULT 0,
  `tis_invga_md` int(11) DEFAULT 0,
  `tis_invga_hd` int(11) DEFAULT 0,
  `total_tis` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kb_rekomendasi_outlet`
--

CREATE TABLE `kb_rekomendasi_outlet` (
  `id_rekomendasi` int(11) NOT NULL,
  `id_outlet` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `avg_sgprepaid` int(11) DEFAULT 0,
  `avg_sgota` int(11) DEFAULT 0,
  `avg_sgvin` int(11) DEFAULT 0,
  `avg_sgvgs` int(11) DEFAULT 0,
  `avg_sgvgg` int(11) DEFAULT 0,
  `avg_sgvgp` int(11) DEFAULT 0,
  `avg_insac_ld` int(11) DEFAULT 0,
  `avg_insac_md` int(11) DEFAULT 0,
  `avg_insac_hd` int(11) DEFAULT 0,
  `avg_invin_ld` int(11) DEFAULT 0,
  `avg_invin_md` int(11) DEFAULT 0,
  `avg_invin_hd` int(11) DEFAULT 0,
  `avg_invga_ld` int(11) DEFAULT 0,
  `avg_invga_md` int(11) DEFAULT 0,
  `avg_invga_hd` int(11) DEFAULT 0,
  `bobot_sgprepaid` decimal(11,2) DEFAULT 0.00,
  `bobot_sgota` decimal(11,2) DEFAULT 0.00,
  `bobot_sgvin` decimal(11,2) DEFAULT 0.00,
  `bobot_sgvgs` decimal(11,2) DEFAULT 0.00,
  `bobot_sgvgg` decimal(11,2) DEFAULT 0.00,
  `bobot_sgvgp` decimal(11,2) DEFAULT 0.00,
  `bobot_insac_ld` decimal(11,2) DEFAULT 0.00,
  `bobot_insac_md` decimal(11,2) DEFAULT 0.00,
  `bobot_insac_hd` decimal(11,2) DEFAULT 0.00,
  `bobot_invin_ld` decimal(11,2) DEFAULT 0.00,
  `bobot_invin_md` decimal(11,2) DEFAULT 0.00,
  `bobot_invin_hd` decimal(11,2) DEFAULT 0.00,
  `bobot_invga_ld` decimal(11,2) DEFAULT 0.00,
  `bobot_invga_md` decimal(11,2) DEFAULT 0.00,
  `bobot_invga_hd` decimal(11,2) DEFAULT 0.00,
  `target_sgprepaid` int(11) DEFAULT 0,
  `target_sgota` int(11) DEFAULT 0,
  `target_sgvin` int(11) DEFAULT 0,
  `target_sgvgs` int(11) DEFAULT 0,
  `target_sgvgg` int(11) DEFAULT 0,
  `target_sgvgp` int(11) DEFAULT 0,
  `target_insac_ld` int(11) DEFAULT 0,
  `target_insac_md` int(11) DEFAULT 0,
  `target_insac_hd` int(11) DEFAULT 0,
  `target_invin_ld` int(11) DEFAULT 0,
  `target_invin_md` int(11) DEFAULT 0,
  `target_invin_hd` int(11) DEFAULT 0,
  `target_invga_ld` int(11) DEFAULT 0,
  `target_invga_md` int(11) DEFAULT 0,
  `target_invga_hd` int(11) DEFAULT 0,
  `target_edit_sgprepaid` int(11) DEFAULT 0,
  `target_edit_sgota` int(11) DEFAULT 0,
  `target_edit_sgvin` int(11) DEFAULT 0,
  `target_edit_sgvgs` int(11) DEFAULT 0,
  `target_edit_sgvgg` int(11) DEFAULT 0,
  `target_edit_sgvgp` int(11) DEFAULT 0,
  `target_edit_insac_ld` int(11) DEFAULT 0,
  `target_edit_insac_md` int(11) DEFAULT 0,
  `target_edit_insac_hd` int(11) DEFAULT 0,
  `target_edit_invin_ld` int(11) DEFAULT 0,
  `target_edit_invin_md` int(11) DEFAULT 0,
  `target_edit_invin_hd` int(11) DEFAULT 0,
  `target_edit_invga_ld` int(11) DEFAULT 0,
  `target_edit_invga_md` int(11) DEFAULT 0,
  `target_edit_invga_hd` int(11) DEFAULT 0,
  `is_simpan` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kc_rekomendasi_sekolah`
--

CREATE TABLE `kc_rekomendasi_sekolah` (
  `id_rekomendasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kd_rekomendasi_kampus`
--

CREATE TABLE `kd_rekomendasi_kampus` (
  `id_rekomendasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ke_rekomendasi_fakultas`
--

CREATE TABLE `ke_rekomendasi_fakultas` (
  `id_rekomendasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kf_rekomendasi_sales`
--

CREATE TABLE `kf_rekomendasi_sales` (
  `id_rekomendasi` int(11) NOT NULL,
  `id_sales` varchar(64) DEFAULT NULL,
  `id_lokasi` varchar(64) DEFAULT NULL,
  `id_jenis_lokasi` varchar(64) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `sgprepaid` decimal(11,2) DEFAULT 0.00,
  `sgota` decimal(11,2) DEFAULT 0.00,
  `sgvin` decimal(11,2) DEFAULT 0.00,
  `sgvgs` decimal(11,2) DEFAULT 0.00,
  `sgvgg` decimal(11,2) DEFAULT 0.00,
  `sgvgp` decimal(11,2) DEFAULT 0.00,
  `insac_ld` decimal(11,2) DEFAULT 0.00,
  `insac_md` decimal(11,2) DEFAULT 0.00,
  `insac_hd` decimal(11,2) DEFAULT 0.00,
  `invin_ld` decimal(11,2) DEFAULT 0.00,
  `invin_md` decimal(11,2) DEFAULT 0.00,
  `invin_hd` decimal(11,2) DEFAULT 0.00,
  `invga_ld` decimal(11,2) DEFAULT 0.00,
  `invga_md` decimal(11,2) DEFAULT 0.00,
  `invga_hd` decimal(11,2) DEFAULT 0.00,
  `link_aja` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kg_rekomendasi_tap`
--

CREATE TABLE `kg_rekomendasi_tap` (
  `id_rekomendasi` int(11) NOT NULL,
  `id_tap` varchar(64) DEFAULT NULL,
  `id_sales` varchar(64) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `sgprepaid` decimal(11,2) DEFAULT 0.00,
  `sgota` decimal(11,2) DEFAULT 0.00,
  `sgvin` decimal(11,2) DEFAULT 0.00,
  `sgvgs` decimal(11,2) DEFAULT 0.00,
  `sgvgg` decimal(11,2) DEFAULT 0.00,
  `sgvgp` decimal(11,2) DEFAULT 0.00,
  `insac_ld` decimal(11,2) DEFAULT 0.00,
  `insac_md` decimal(11,2) DEFAULT 0.00,
  `insac_hd` decimal(11,2) DEFAULT 0.00,
  `invin_ld` decimal(11,2) DEFAULT 0.00,
  `invin_md` decimal(11,2) DEFAULT 0.00,
  `invin_hd` decimal(11,2) DEFAULT 0.00,
  `invga_ld` decimal(11,2) DEFAULT 0.00,
  `invga_md` decimal(11,2) DEFAULT 0.00,
  `invga_hd` decimal(11,2) DEFAULT 0.00,
  `link_aja` decimal(11,2) DEFAULT 0.00,
  `new_rs` decimal(11,2) DEFAULT 0.00,
  `is_simpan` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `la_score_card`
--

CREATE TABLE `la_score_card` (
  `id_score_card` int(11) NOT NULL,
  `id_sales` varchar(64) DEFAULT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tgl` int(11) DEFAULT NULL,
  `hari` enum('SENIN','SELASA','RABU','KAMIS','JUMAT','SABTU','MINGGU') DEFAULT 'SENIN',
  `pjp` int(11) DEFAULT 0,
  `actual_call_jml` int(11) DEFAULT 0,
  `actual_call_persen` decimal(11,2) DEFAULT 0.00,
  `effective_call_jml` int(11) DEFAULT 0,
  `effective_call_persen` decimal(11,2) DEFAULT 0.00,
  `uhj_sgprepaid` int(11) DEFAULT 0,
  `uhj_sgota` int(11) DEFAULT 0,
  `uhj_sgvin` int(11) DEFAULT 0,
  `uhj_sgvgs` int(11) DEFAULT 0,
  `uhj_sgvgg` int(11) DEFAULT 0,
  `uhj_sgvgp` int(11) DEFAULT 0,
  `uhj_insac_ld` int(11) DEFAULT 0,
  `uhj_insac_md` int(11) DEFAULT 0,
  `uhj_insac_hd` int(11) DEFAULT 0,
  `uhj_invin_ld` int(11) DEFAULT 0,
  `uhj_invin_md` int(11) DEFAULT 0,
  `uhj_invin_hd` int(11) DEFAULT 0,
  `uhj_invga_ld` int(11) DEFAULT 0,
  `uhj_invga_md` int(11) DEFAULT 0,
  `uhj_invga_hd` int(11) DEFAULT 0,
  `uhj_new_rs` int(11) DEFAULT 0,
  `uhj_limit_link_aja` decimal(11,2) DEFAULT 0.00,
  `trg_sgprepaid` int(11) DEFAULT 0,
  `trg_sgota` int(11) DEFAULT 0,
  `trg_sgvin` int(11) DEFAULT 0,
  `trg_sgvgs` int(11) DEFAULT 0,
  `trg_sgvgg` int(11) DEFAULT 0,
  `trg_sgvgp` int(11) DEFAULT 0,
  `trg_insac_ld` int(11) DEFAULT 0,
  `trg_insac_md` int(11) DEFAULT 0,
  `trg_insac_hd` int(11) DEFAULT 0,
  `trg_invin_ld` int(11) DEFAULT 0,
  `trg_invin_md` int(11) DEFAULT 0,
  `trg_invin_hd` int(11) DEFAULT 0,
  `trg_invga_ld` int(11) DEFAULT 0,
  `trg_invga_md` int(11) DEFAULT 0,
  `trg_invga_hd` int(11) DEFAULT 0,
  `trg_new_rs` int(11) DEFAULT 0,
  `trg_limit_link_aja` decimal(11,2) DEFAULT 0.00,
  `rmt_sgprepaid` int(11) DEFAULT 0,
  `rmt_sgota` int(11) DEFAULT 0,
  `rmt_sgvin` int(11) DEFAULT 0,
  `rmt_sgvgs` int(11) DEFAULT 0,
  `rmt_sgvgg` int(11) DEFAULT 0,
  `rmt_sgvgp` int(11) DEFAULT 0,
  `rmt_insac_ld` int(11) DEFAULT 0,
  `rmt_insac_md` int(11) DEFAULT 0,
  `rmt_insac_hd` int(11) DEFAULT 0,
  `rmt_invin_ld` int(11) DEFAULT 0,
  `rmt_invin_md` int(11) DEFAULT 0,
  `rmt_invin_hd` int(11) DEFAULT 0,
  `rmt_invga_ld` int(11) DEFAULT 0,
  `rmt_invga_md` int(11) DEFAULT 0,
  `rmt_invga_hd` int(11) DEFAULT 0,
  `rmt_new_rs` int(11) DEFAULT 0,
  `rmt_limit_link_aja` decimal(11,2) DEFAULT 0.00,
  `evm_perdana` int(11) DEFAULT 0,
  `evm_voucher_fisik` int(11) DEFAULT 0,
  `evm_layar_toko` int(11) DEFAULT 0,
  `evm_poster` int(11) DEFAULT 0,
  `evm_neon_box` int(11) DEFAULT 0,
  `evm_stiker` int(11) DEFAULT 0,
  `evm_video` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ma_merchandisng_jenis_share`
--

CREATE TABLE `ma_merchandisng_jenis_share` (
  `id_jenis_share` varchar(64) NOT NULL,
  `nama_jenis_share` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mb_merchandising_outlet`
--

CREATE TABLE `mb_merchandising_outlet` (
  `id_merchandising` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `id_jenis_share` varchar(64) NOT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `foto_1` varchar(64) DEFAULT NULL,
  `foto_2` varchar(64) DEFAULT NULL,
  `foto_3` varchar(64) DEFAULT NULL,
  `created_by` varchar(64) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mc_merchandising_sekolah`
--

CREATE TABLE `mc_merchandising_sekolah` (
  `id_merchandising` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `id_jenis_share` varchar(64) NOT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `foto_1` varchar(64) NOT NULL,
  `foto_2` varchar(64) NOT NULL,
  `foto_3` varchar(64) NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `md_merchandising_kampus`
--

CREATE TABLE `md_merchandising_kampus` (
  `id_merchandising` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_universitas` int(11) NOT NULL,
  `id_jenis_share` varchar(64) NOT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `foto_1` varchar(64) NOT NULL,
  `foto_2` varchar(64) NOT NULL,
  `foto_3` varchar(64) NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `me_merchandising_fakultas`
--

CREATE TABLE `me_merchandising_fakultas` (
  `id_merchandising` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `id_jenis_share` varchar(64) NOT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `foto_1` varchar(64) NOT NULL,
  `foto_2` varchar(64) NOT NULL,
  `foto_3` varchar(64) NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mf_merchandising_res_regional`
--

CREATE TABLE `mf_merchandising_res_regional` (
  `id_merchandising` int(11) NOT NULL,
  `id_regional` varchar(64) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_share` varchar(64) NOT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_persen` decimal(11,2) DEFAULT 0.00,
  `isat_persen` decimal(11,2) DEFAULT 0.00,
  `xl_persen` decimal(11,2) DEFAULT 0.00,
  `tri_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_persen` decimal(11,2) DEFAULT 0.00,
  `axis_persen` decimal(11,2) DEFAULT 0.00,
  `other_persen` decimal(11,2) DEFAULT 0.00,
  `total_persen` decimal(11,2) DEFAULT 0.00,
  `m_1` decimal(11,2) DEFAULT 0.00,
  `m_2` decimal(11,2) DEFAULT 0.00,
  `w_1` decimal(11,2) DEFAULT 0.00,
  `w_2` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mg_merchandising_res_branch`
--

CREATE TABLE `mg_merchandising_res_branch` (
  `id_merchandising` int(11) NOT NULL,
  `id_branch` varchar(64) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_share` varchar(64) NOT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_persen` decimal(11,2) DEFAULT 0.00,
  `isat_persen` decimal(11,2) DEFAULT 0.00,
  `xl_persen` decimal(11,2) DEFAULT 0.00,
  `tri_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_persen` decimal(11,2) DEFAULT 0.00,
  `axis_persen` decimal(11,2) DEFAULT 0.00,
  `other_persen` decimal(11,2) DEFAULT 0.00,
  `total_persen` decimal(11,2) DEFAULT 0.00,
  `m_1` decimal(11,2) DEFAULT 0.00,
  `m_2` decimal(11,2) DEFAULT 0.00,
  `w_1` decimal(11,2) DEFAULT 0.00,
  `w_2` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mh_merchandising_res_cluster`
--

CREATE TABLE `mh_merchandising_res_cluster` (
  `id_merchandising` int(11) NOT NULL,
  `id_cluster` varchar(64) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_share` varchar(64) NOT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_persen` decimal(11,2) DEFAULT 0.00,
  `isat_persen` decimal(11,2) DEFAULT 0.00,
  `xl_persen` decimal(11,2) DEFAULT 0.00,
  `tri_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_persen` decimal(11,2) DEFAULT 0.00,
  `axis_persen` decimal(11,2) DEFAULT 0.00,
  `other_persen` decimal(11,2) DEFAULT 0.00,
  `total_persen` decimal(11,2) DEFAULT 0.00,
  `m_1` decimal(11,2) DEFAULT 0.00,
  `m_2` decimal(11,2) DEFAULT 0.00,
  `w_1` decimal(11,2) DEFAULT 0.00,
  `w_2` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mi_merchandising_res_tap`
--

CREATE TABLE `mi_merchandising_res_tap` (
  `id_merchandising` int(11) NOT NULL,
  `id_tap` varchar(64) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_share` varchar(64) NOT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_persen` decimal(11,2) DEFAULT 0.00,
  `isat_persen` decimal(11,2) DEFAULT 0.00,
  `xl_persen` decimal(11,2) DEFAULT 0.00,
  `tri_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_persen` decimal(11,2) DEFAULT 0.00,
  `axis_persen` decimal(11,2) DEFAULT 0.00,
  `other_persen` decimal(11,2) DEFAULT 0.00,
  `total_persen` decimal(11,2) DEFAULT 0.00,
  `m_1` decimal(11,2) DEFAULT 0.00,
  `m_2` decimal(11,2) DEFAULT 0.00,
  `w_1` decimal(11,2) DEFAULT 0.00,
  `w_2` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mj_merchandising_res_sales`
--

CREATE TABLE `mj_merchandising_res_sales` (
  `id_merchandising` int(11) NOT NULL,
  `id_sales` varchar(64) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `id_jenis_lokasi` varchar(64) DEFAULT NULL,
  `id_jenis_share` varchar(64) DEFAULT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_persen` decimal(11,2) DEFAULT 0.00,
  `isat_persen` decimal(11,2) DEFAULT 0.00,
  `xl_persen` decimal(11,2) DEFAULT 0.00,
  `tri_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_persen` decimal(11,2) DEFAULT 0.00,
  `axis_persen` decimal(11,2) DEFAULT 0.00,
  `other_persen` decimal(11,2) DEFAULT 0.00,
  `total_persen` decimal(11,2) DEFAULT 0.00,
  `m_1` decimal(11,2) DEFAULT 0.00,
  `m_2` decimal(11,2) DEFAULT 0.00,
  `w_1` decimal(11,2) DEFAULT 0.00,
  `w_2` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mk_merchandising_res_kabupaten`
--

CREATE TABLE `mk_merchandising_res_kabupaten` (
  `id_merchandising` int(11) NOT NULL,
  `id_kabupaten` varchar(64) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_share` varchar(64) NOT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_persen` decimal(11,2) DEFAULT 0.00,
  `isat_persen` decimal(11,2) DEFAULT 0.00,
  `xl_persen` decimal(11,2) DEFAULT 0.00,
  `tri_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_persen` decimal(11,2) DEFAULT 0.00,
  `axis_persen` decimal(11,2) DEFAULT 0.00,
  `other_persen` decimal(11,2) DEFAULT 0.00,
  `total_persen` decimal(11,2) DEFAULT 0.00,
  `m_1` decimal(11,2) DEFAULT 0.00,
  `m_2` decimal(11,2) DEFAULT 0.00,
  `w_1` decimal(11,2) DEFAULT 0.00,
  `w_2` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ml_merchandising_res_kecamatan`
--

CREATE TABLE `ml_merchandising_res_kecamatan` (
  `id_merchandising` int(11) NOT NULL,
  `id_kecamatan` varchar(64) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_share` varchar(64) NOT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_persen` decimal(11,2) DEFAULT 0.00,
  `isat_persen` decimal(11,2) DEFAULT 0.00,
  `xl_persen` decimal(11,2) DEFAULT 0.00,
  `tri_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_persen` decimal(11,2) DEFAULT 0.00,
  `axis_persen` decimal(11,2) DEFAULT 0.00,
  `other_persen` decimal(11,2) DEFAULT 0.00,
  `total_persen` decimal(11,2) DEFAULT 0.00,
  `m_1` decimal(11,2) DEFAULT 0.00,
  `m_2` decimal(11,2) DEFAULT 0.00,
  `w_1` decimal(11,2) DEFAULT 0.00,
  `w_2` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `na_promotion_jenis`
--

CREATE TABLE `na_promotion_jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(200) NOT NULL,
  `status` enum('AKTIF','TIDAK AKTIF') NOT NULL DEFAULT 'AKTIF',
  `tgl_open` date NOT NULL,
  `tgl_close` date DEFAULT NULL,
  `lastmodified` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `na_promotion_jenis`
--

INSERT INTO `na_promotion_jenis` (`id_jenis`, `nama_jenis`, `status`, `tgl_open`, `tgl_close`, `lastmodified`) VALUES
(1, 'OMNI CHANNEL', 'AKTIF', '2020-12-09', NULL, '2020-12-07 01:26:00'),
(2, 'IJO-IJO', 'AKTIF', '2020-12-09', NULL, '2020-12-09 05:14:57'),
(3, 'FLASH SALE SELL OUT', 'AKTIF', '2020-12-09', NULL, '2020-12-09 05:15:26'),
(4, 'DIGISTAR (SA & RENEWAL)', 'AKTIF', '2020-12-09', NULL, '2020-12-09 05:16:20'),
(5, 'SELL OUT VOUCHER FISIK', 'AKTIF', '2020-12-09', NULL, '2020-12-09 05:23:54'),
(6, 'PAKET VOICE', 'AKTIF', '2020-12-09', NULL, '2020-12-09 05:24:03'),
(7, 'DIGITAL PROGRAM (PRODI & GODI)', 'AKTIF', '2020-12-09', NULL, '2020-12-09 05:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `nb_promotion_jenis_weekly`
--

CREATE TABLE `nb_promotion_jenis_weekly` (
  `id_jenis_weekly` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nc_promotion_outlet`
--

CREATE TABLE `nc_promotion_outlet` (
  `id_outlet` int(11) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `id_history_pjp` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `nama_program_lokal` varchar(200) NOT NULL,
  `file_video` varchar(100) NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nd_promotion_sekolah`
--

CREATE TABLE `nd_promotion_sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `id_history_pjp` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `nama_program_lokal` varchar(200) NOT NULL,
  `file_video` varchar(100) NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ne_promotion_kampus`
--

CREATE TABLE `ne_promotion_kampus` (
  `id_universitas` int(11) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `id_history_pjp` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `nama_program_lokal` varchar(200) NOT NULL,
  `file_video` varchar(100) NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nf_promotion_fakultas`
--

CREATE TABLE `nf_promotion_fakultas` (
  `id_fakultas` int(11) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `id_history_pjp` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `nama_program_lokal` varchar(200) NOT NULL,
  `file_video` varchar(100) NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nf_promotion_poi`
--

CREATE TABLE `nf_promotion_poi` (
  `id_poi` int(11) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `id_history_pjp` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `nama_program_lokal` varchar(200) NOT NULL,
  `file_video` varchar(100) NOT NULL,
  `created_by` varchar(64) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ng_promotion_res_regional`
--

CREATE TABLE `ng_promotion_res_regional` (
  `id_promotion` int(11) NOT NULL,
  `id_regional` varchar(64) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `total_pjp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nh_promotion_res_branch`
--

CREATE TABLE `nh_promotion_res_branch` (
  `id_promotion` int(11) NOT NULL,
  `id_branch` varchar(64) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `total_pjp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ni_promotion_res_cluster`
--

CREATE TABLE `ni_promotion_res_cluster` (
  `id_promotion` int(11) NOT NULL,
  `id_cluster` varchar(64) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `total_pjp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nj_promotion_res_tap`
--

CREATE TABLE `nj_promotion_res_tap` (
  `id_promotion` int(11) NOT NULL,
  `id_tap` varchar(64) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `total_pjp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nk_promotion_res_sales`
--

CREATE TABLE `nk_promotion_res_sales` (
  `id_promotion` int(11) NOT NULL,
  `id_sales` varchar(64) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `total_pjp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nl_promotion_res_kabupaten`
--

CREATE TABLE `nl_promotion_res_kabupaten` (
  `id_promotion` int(11) NOT NULL,
  `id_kabupaten` varchar(64) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `total_pjp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_promotion_res_kecamatan`
--

CREATE TABLE `nm_promotion_res_kecamatan` (
  `id_promotion` int(11) NOT NULL,
  `id_kecamatan` varchar(64) NOT NULL,
  `id_jenis_lokasi` varchar(64) NOT NULL,
  `id_jenis_weekly` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `total_pjp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oa_market_audit_jenis_share`
--

CREATE TABLE `oa_market_audit_jenis_share` (
  `id_jenis_share` varchar(64) NOT NULL,
  `nama_jenis_share` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ob_market_audit_outlet`
--

CREATE TABLE `ob_market_audit_outlet` (
  `id_market_audit` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `id_jenis_share` varchar(64) NOT NULL,
  `id_history_pjp` int(11) NOT NULL,
  `telkomsel` int(11) DEFAULT NULL,
  `isat` int(11) DEFAULT NULL,
  `xl` int(11) DEFAULT NULL,
  `tri` int(11) DEFAULT NULL,
  `smartfren` int(11) DEFAULT NULL,
  `axis` int(11) DEFAULT NULL,
  `other` int(11) DEFAULT NULL,
  `telkomsel_ld` int(11) DEFAULT 0,
  `telkomsel_md` int(11) DEFAULT 0,
  `telkomsel_hd` int(11) DEFAULT 0,
  `isat_ld` int(11) DEFAULT 0,
  `isat_md` int(11) DEFAULT 0,
  `isat_hd` int(11) DEFAULT 0,
  `xl_ld` int(11) DEFAULT 0,
  `xl_md` int(11) DEFAULT 0,
  `xl_hd` int(11) DEFAULT 0,
  `tri_ld` int(11) DEFAULT 0,
  `tri_md` int(11) DEFAULT 0,
  `tri_hd` int(11) DEFAULT 0,
  `smartfren_ld` int(11) DEFAULT 0,
  `smartfren_md` int(11) DEFAULT 0,
  `smartfren_hd` int(11) DEFAULT 0,
  `axis_ld` int(11) DEFAULT 0,
  `axis_md` int(11) DEFAULT 0,
  `axis_hd` int(11) DEFAULT 0,
  `other_ld` int(11) DEFAULT 0,
  `other_md` int(11) DEFAULT 0,
  `other_hd` int(11) DEFAULT 0,
  `foto_belanja` varchar(64) DEFAULT NULL,
  `created_by` varchar(64) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oj_market_audit_res_sekolah`
--

CREATE TABLE `oj_market_audit_res_sekolah` (
  `id_market_audit` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `id_history_pjp` int(11) NOT NULL,
  `nama_pelanggan` varchar(400) NOT NULL,
  `op_telepon` varchar(100) NOT NULL,
  `msisdn_telepon` varchar(100) NOT NULL,
  `op_internet` varchar(100) NOT NULL,
  `msisdn_internet` varchar(100) NOT NULL,
  `op_digital` varchar(100) NOT NULL,
  `msisdn_digital` varchar(100) NOT NULL,
  `frekuensi_beli_paket` varchar(100) NOT NULL,
  `kuota_per_bulan` varchar(100) NOT NULL,
  `pulsa_per_bulan` varchar(100) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ok_market_audit_res_fakultas`
--

CREATE TABLE `ok_market_audit_res_fakultas` (
  `id_market_audit` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `id_history_pjp` int(11) NOT NULL,
  `nama_pelanggan` varchar(400) NOT NULL,
  `op_telepon` varchar(100) NOT NULL,
  `msisdn_telepon` varchar(100) NOT NULL,
  `op_internet` varchar(100) NOT NULL,
  `msisdn_internet` varchar(100) NOT NULL,
  `op_digital` varchar(100) NOT NULL,
  `msisdn_digital` varchar(100) NOT NULL,
  `frekuensi_beli_paket` varchar(100) NOT NULL,
  `kuota_per_bulan` varchar(100) NOT NULL,
  `pulsa_per_bulan` varchar(100) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ol_market_audit_res_kampus`
--

CREATE TABLE `ol_market_audit_res_kampus` (
  `id_market_audit` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `id_universitas` int(11) NOT NULL,
  `id_history_pjp` int(11) NOT NULL,
  `nama_pelanggan` varchar(400) NOT NULL,
  `op_telepon` varchar(100) NOT NULL,
  `msisdn_telepon` varchar(100) NOT NULL,
  `op_internet` varchar(100) NOT NULL,
  `msisdn_internet` varchar(100) NOT NULL,
  `op_digital` varchar(100) NOT NULL,
  `msisdn_digital` varchar(100) NOT NULL,
  `frekuensi_beli_paket` varchar(100) NOT NULL,
  `kuota_per_bulan` varchar(100) NOT NULL,
  `pulsa_per_bulan` varchar(100) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ot_master_frekuensi_beli_paket`
--

CREATE TABLE `ot_master_frekuensi_beli_paket` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ou_master_provider`
--

CREATE TABLE `ou_master_provider` (
  `id` int(11) NOT NULL,
  `provider` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oz_maket_audit_res_branch`
--

CREATE TABLE `oz_maket_audit_res_branch` (
  `id_market_audit` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `id_branch` varchar(64) DEFAULT NULL,
  `id_jenis_share` varchar(64) DEFAULT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_ld` int(11) DEFAULT 0,
  `isat_ld` int(11) DEFAULT 0,
  `xl_ld` int(11) DEFAULT 0,
  `tri_ld` int(11) DEFAULT 0,
  `smartfren_ld` int(11) DEFAULT 0,
  `axis_ld` int(11) DEFAULT 0,
  `other_ld` int(11) DEFAULT 0,
  `total_ld` int(11) DEFAULT 0,
  `telkomsel_md` int(11) DEFAULT 0,
  `isat_md` int(11) DEFAULT 0,
  `xl_md` int(11) DEFAULT 0,
  `tri_md` int(11) DEFAULT 0,
  `smartfren_md` int(11) DEFAULT 0,
  `axis_md` int(11) DEFAULT 0,
  `other_md` int(11) DEFAULT 0,
  `total_md` int(11) DEFAULT 0,
  `telkomsel_hd` int(11) DEFAULT 0,
  `isat_hd` int(11) DEFAULT 0,
  `xl_hd` int(11) DEFAULT 0,
  `tri_hd` int(11) DEFAULT 0,
  `smartfren_hd` int(11) DEFAULT 0,
  `axis_hd` int(11) DEFAULT 0,
  `other_hd` int(11) DEFAULT 0,
  `total_hd` int(11) DEFAULT 0,
  `telkomsel_ld_persen` decimal(11,2) DEFAULT 0.00,
  `isat_ld_persen` decimal(11,2) DEFAULT 0.00,
  `xl_ld_persen` decimal(11,2) DEFAULT 0.00,
  `tri_ld_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_ld_persen` decimal(11,2) DEFAULT 0.00,
  `axis_ld_persen` decimal(11,2) DEFAULT 0.00,
  `other_ld_persen` decimal(11,2) DEFAULT 0.00,
  `total_ld_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_md_persen` decimal(11,2) DEFAULT 0.00,
  `isat_md_persen` decimal(11,2) DEFAULT 0.00,
  `xl_md_persen` decimal(11,2) DEFAULT 0.00,
  `tri_md_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_md_persen` decimal(11,2) DEFAULT 0.00,
  `axis_md_persen` decimal(11,2) DEFAULT 0.00,
  `other_md_persen` decimal(11,2) DEFAULT 0.00,
  `total_md_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_hd_persen` decimal(11,2) DEFAULT 0.00,
  `isat_hd_persen` decimal(11,2) DEFAULT 0.00,
  `xl_hd_persen` decimal(11,2) DEFAULT 0.00,
  `tri_hd_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_hd_persen` decimal(11,2) DEFAULT 0.00,
  `axis_hd_persen` decimal(11,2) DEFAULT 0.00,
  `other_hd_persen` decimal(11,2) DEFAULT 0.00,
  `total_hd_persen` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oz_maket_audit_res_cluster`
--

CREATE TABLE `oz_maket_audit_res_cluster` (
  `id_market_audit` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `id_cluster` varchar(64) DEFAULT NULL,
  `id_jenis_share` varchar(64) DEFAULT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_ld` int(11) DEFAULT 0,
  `isat_ld` int(11) DEFAULT 0,
  `xl_ld` int(11) DEFAULT 0,
  `tri_ld` int(11) DEFAULT 0,
  `smartfren_ld` int(11) DEFAULT 0,
  `axis_ld` int(11) DEFAULT 0,
  `other_ld` int(11) DEFAULT 0,
  `total_ld` int(11) DEFAULT 0,
  `telkomsel_md` int(11) DEFAULT 0,
  `isat_md` int(11) DEFAULT 0,
  `xl_md` int(11) DEFAULT 0,
  `tri_md` int(11) DEFAULT 0,
  `smartfren_md` int(11) DEFAULT 0,
  `axis_md` int(11) DEFAULT 0,
  `other_md` int(11) DEFAULT 0,
  `total_md` int(11) DEFAULT 0,
  `telkomsel_hd` int(11) DEFAULT 0,
  `isat_hd` int(11) DEFAULT 0,
  `xl_hd` int(11) DEFAULT 0,
  `tri_hd` int(11) DEFAULT 0,
  `smartfren_hd` int(11) DEFAULT 0,
  `axis_hd` int(11) DEFAULT 0,
  `other_hd` int(11) DEFAULT 0,
  `total_hd` int(11) DEFAULT 0,
  `telkomsel_ld_persen` decimal(11,2) DEFAULT 0.00,
  `isat_ld_persen` decimal(11,2) DEFAULT 0.00,
  `xl_ld_persen` decimal(11,2) DEFAULT 0.00,
  `tri_ld_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_ld_persen` decimal(11,2) DEFAULT 0.00,
  `axis_ld_persen` decimal(11,2) DEFAULT 0.00,
  `other_ld_persen` decimal(11,2) DEFAULT 0.00,
  `total_ld_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_md_persen` decimal(11,2) DEFAULT 0.00,
  `isat_md_persen` decimal(11,2) DEFAULT 0.00,
  `xl_md_persen` decimal(11,2) DEFAULT 0.00,
  `tri_md_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_md_persen` decimal(11,2) DEFAULT 0.00,
  `axis_md_persen` decimal(11,2) DEFAULT 0.00,
  `other_md_persen` decimal(11,2) DEFAULT 0.00,
  `total_md_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_hd_persen` decimal(11,2) DEFAULT 0.00,
  `isat_hd_persen` decimal(11,2) DEFAULT 0.00,
  `xl_hd_persen` decimal(11,2) DEFAULT 0.00,
  `tri_hd_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_hd_persen` decimal(11,2) DEFAULT 0.00,
  `axis_hd_persen` decimal(11,2) DEFAULT 0.00,
  `other_hd_persen` decimal(11,2) DEFAULT 0.00,
  `total_hd_persen` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oz_maket_audit_res_kabupaten`
--

CREATE TABLE `oz_maket_audit_res_kabupaten` (
  `id_market_audit` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `id_kabupaten` varchar(64) DEFAULT NULL,
  `id_jenis_share` varchar(64) DEFAULT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_ld` int(11) DEFAULT 0,
  `isat_ld` int(11) DEFAULT 0,
  `xl_ld` int(11) DEFAULT 0,
  `tri_ld` int(11) DEFAULT 0,
  `smartfren_ld` int(11) DEFAULT 0,
  `axis_ld` int(11) DEFAULT 0,
  `other_ld` int(11) DEFAULT 0,
  `total_ld` int(11) DEFAULT 0,
  `telkomsel_md` int(11) DEFAULT 0,
  `isat_md` int(11) DEFAULT 0,
  `xl_md` int(11) DEFAULT 0,
  `tri_md` int(11) DEFAULT 0,
  `smartfren_md` int(11) DEFAULT 0,
  `axis_md` int(11) DEFAULT 0,
  `other_md` int(11) DEFAULT 0,
  `total_md` int(11) DEFAULT 0,
  `telkomsel_hd` int(11) DEFAULT 0,
  `isat_hd` int(11) DEFAULT 0,
  `xl_hd` int(11) DEFAULT 0,
  `tri_hd` int(11) DEFAULT 0,
  `smartfren_hd` int(11) DEFAULT 0,
  `axis_hd` int(11) DEFAULT 0,
  `other_hd` int(11) DEFAULT 0,
  `total_hd` int(11) DEFAULT 0,
  `telkomsel_ld_persen` decimal(11,2) DEFAULT 0.00,
  `isat_ld_persen` decimal(11,2) DEFAULT 0.00,
  `xl_ld_persen` decimal(11,2) DEFAULT 0.00,
  `tri_ld_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_ld_persen` decimal(11,2) DEFAULT 0.00,
  `axis_ld_persen` decimal(11,2) DEFAULT 0.00,
  `other_ld_persen` decimal(11,2) DEFAULT 0.00,
  `total_ld_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_md_persen` decimal(11,2) DEFAULT 0.00,
  `isat_md_persen` decimal(11,2) DEFAULT 0.00,
  `xl_md_persen` decimal(11,2) DEFAULT 0.00,
  `tri_md_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_md_persen` decimal(11,2) DEFAULT 0.00,
  `axis_md_persen` decimal(11,2) DEFAULT 0.00,
  `other_md_persen` decimal(11,2) DEFAULT 0.00,
  `total_md_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_hd_persen` decimal(11,2) DEFAULT 0.00,
  `isat_hd_persen` decimal(11,2) DEFAULT 0.00,
  `xl_hd_persen` decimal(11,2) DEFAULT 0.00,
  `tri_hd_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_hd_persen` decimal(11,2) DEFAULT 0.00,
  `axis_hd_persen` decimal(11,2) DEFAULT 0.00,
  `other_hd_persen` decimal(11,2) DEFAULT 0.00,
  `total_hd_persen` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oz_maket_audit_res_kecamatan`
--

CREATE TABLE `oz_maket_audit_res_kecamatan` (
  `id_market_audit` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `id_kecamatan` varchar(64) DEFAULT NULL,
  `id_jenis_share` varchar(64) DEFAULT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_ld` int(11) DEFAULT 0,
  `isat_ld` int(11) DEFAULT 0,
  `xl_ld` int(11) DEFAULT 0,
  `tri_ld` int(11) DEFAULT 0,
  `smartfren_ld` int(11) DEFAULT 0,
  `axis_ld` int(11) DEFAULT 0,
  `other_ld` int(11) DEFAULT 0,
  `total_ld` int(11) DEFAULT 0,
  `telkomsel_md` int(11) DEFAULT 0,
  `isat_md` int(11) DEFAULT 0,
  `xl_md` int(11) DEFAULT 0,
  `tri_md` int(11) DEFAULT 0,
  `smartfren_md` int(11) DEFAULT 0,
  `axis_md` int(11) DEFAULT 0,
  `other_md` int(11) DEFAULT 0,
  `total_md` int(11) DEFAULT 0,
  `telkomsel_hd` int(11) DEFAULT 0,
  `isat_hd` int(11) DEFAULT 0,
  `xl_hd` int(11) DEFAULT 0,
  `tri_hd` int(11) DEFAULT 0,
  `smartfren_hd` int(11) DEFAULT 0,
  `axis_hd` int(11) DEFAULT 0,
  `other_hd` int(11) DEFAULT 0,
  `total_hd` int(11) DEFAULT 0,
  `telkomsel_ld_persen` decimal(11,2) DEFAULT 0.00,
  `isat_ld_persen` decimal(11,2) DEFAULT 0.00,
  `xl_ld_persen` decimal(11,2) DEFAULT 0.00,
  `tri_ld_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_ld_persen` decimal(11,2) DEFAULT 0.00,
  `axis_ld_persen` decimal(11,2) DEFAULT 0.00,
  `other_ld_persen` decimal(11,2) DEFAULT 0.00,
  `total_ld_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_md_persen` decimal(11,2) DEFAULT 0.00,
  `isat_md_persen` decimal(11,2) DEFAULT 0.00,
  `xl_md_persen` decimal(11,2) DEFAULT 0.00,
  `tri_md_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_md_persen` decimal(11,2) DEFAULT 0.00,
  `axis_md_persen` decimal(11,2) DEFAULT 0.00,
  `other_md_persen` decimal(11,2) DEFAULT 0.00,
  `total_md_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_hd_persen` decimal(11,2) DEFAULT 0.00,
  `isat_hd_persen` decimal(11,2) DEFAULT 0.00,
  `xl_hd_persen` decimal(11,2) DEFAULT 0.00,
  `tri_hd_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_hd_persen` decimal(11,2) DEFAULT 0.00,
  `axis_hd_persen` decimal(11,2) DEFAULT 0.00,
  `other_hd_persen` decimal(11,2) DEFAULT 0.00,
  `total_hd_persen` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oz_maket_audit_res_regional`
--

CREATE TABLE `oz_maket_audit_res_regional` (
  `id_market_audit` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `id_regional` varchar(64) DEFAULT NULL,
  `id_jenis_share` varchar(64) DEFAULT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_ld` int(11) DEFAULT 0,
  `isat_ld` int(11) DEFAULT 0,
  `xl_ld` int(11) DEFAULT 0,
  `tri_ld` int(11) DEFAULT 0,
  `smartfren_ld` int(11) DEFAULT 0,
  `axis_ld` int(11) DEFAULT 0,
  `other_ld` int(11) DEFAULT 0,
  `total_ld` int(11) DEFAULT 0,
  `telkomsel_md` int(11) DEFAULT 0,
  `isat_md` int(11) DEFAULT 0,
  `xl_md` int(11) DEFAULT 0,
  `tri_md` int(11) DEFAULT 0,
  `smartfren_md` int(11) DEFAULT 0,
  `axis_md` int(11) DEFAULT 0,
  `other_md` int(11) DEFAULT 0,
  `total_md` int(11) DEFAULT 0,
  `telkomsel_hd` int(11) DEFAULT 0,
  `isat_hd` int(11) DEFAULT 0,
  `xl_hd` int(11) DEFAULT 0,
  `tri_hd` int(11) DEFAULT 0,
  `smartfren_hd` int(11) DEFAULT 0,
  `axis_hd` int(11) DEFAULT 0,
  `other_hd` int(11) DEFAULT 0,
  `total_hd` int(11) DEFAULT 0,
  `telkomsel_ld_persen` decimal(11,2) DEFAULT 0.00,
  `isat_ld_persen` decimal(11,2) DEFAULT 0.00,
  `xl_ld_persen` decimal(11,2) DEFAULT 0.00,
  `tri_ld_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_ld_persen` decimal(11,2) DEFAULT 0.00,
  `axis_ld_persen` decimal(11,2) DEFAULT 0.00,
  `other_ld_persen` decimal(11,2) DEFAULT 0.00,
  `total_ld_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_md_persen` decimal(11,2) DEFAULT 0.00,
  `isat_md_persen` decimal(11,2) DEFAULT 0.00,
  `xl_md_persen` decimal(11,2) DEFAULT 0.00,
  `tri_md_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_md_persen` decimal(11,2) DEFAULT 0.00,
  `axis_md_persen` decimal(11,2) DEFAULT 0.00,
  `other_md_persen` decimal(11,2) DEFAULT 0.00,
  `total_md_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_hd_persen` decimal(11,2) DEFAULT 0.00,
  `isat_hd_persen` decimal(11,2) DEFAULT 0.00,
  `xl_hd_persen` decimal(11,2) DEFAULT 0.00,
  `tri_hd_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_hd_persen` decimal(11,2) DEFAULT 0.00,
  `axis_hd_persen` decimal(11,2) DEFAULT 0.00,
  `other_hd_persen` decimal(11,2) DEFAULT 0.00,
  `total_hd_persen` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oz_maket_audit_res_sales`
--

CREATE TABLE `oz_maket_audit_res_sales` (
  `id_market_audit` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `id_sales` varchar(64) DEFAULT NULL,
  `id_jenis_share` varchar(64) DEFAULT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_ld` int(11) DEFAULT 0,
  `isat_ld` int(11) DEFAULT 0,
  `xl_ld` int(11) DEFAULT 0,
  `tri_ld` int(11) DEFAULT 0,
  `smartfren_ld` int(11) DEFAULT 0,
  `axis_ld` int(11) DEFAULT 0,
  `other_ld` int(11) DEFAULT 0,
  `total_ld` int(11) DEFAULT 0,
  `telkomsel_md` int(11) DEFAULT 0,
  `isat_md` int(11) DEFAULT 0,
  `xl_md` int(11) DEFAULT 0,
  `tri_md` int(11) DEFAULT 0,
  `smartfren_md` int(11) DEFAULT 0,
  `axis_md` int(11) DEFAULT 0,
  `other_md` int(11) DEFAULT 0,
  `total_md` int(11) DEFAULT 0,
  `telkomsel_hd` int(11) DEFAULT 0,
  `isat_hd` int(11) DEFAULT 0,
  `xl_hd` int(11) DEFAULT 0,
  `tri_hd` int(11) DEFAULT 0,
  `smartfren_hd` int(11) DEFAULT 0,
  `axis_hd` int(11) DEFAULT 0,
  `other_hd` int(11) DEFAULT 0,
  `total_hd` int(11) DEFAULT 0,
  `telkomsel_ld_persen` decimal(11,2) DEFAULT 0.00,
  `isat_ld_persen` decimal(11,2) DEFAULT 0.00,
  `xl_ld_persen` decimal(11,2) DEFAULT 0.00,
  `tri_ld_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_ld_persen` decimal(11,2) DEFAULT 0.00,
  `axis_ld_persen` decimal(11,2) DEFAULT 0.00,
  `other_ld_persen` decimal(11,2) DEFAULT 0.00,
  `total_ld_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_md_persen` decimal(11,2) DEFAULT 0.00,
  `isat_md_persen` decimal(11,2) DEFAULT 0.00,
  `xl_md_persen` decimal(11,2) DEFAULT 0.00,
  `tri_md_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_md_persen` decimal(11,2) DEFAULT 0.00,
  `axis_md_persen` decimal(11,2) DEFAULT 0.00,
  `other_md_persen` decimal(11,2) DEFAULT 0.00,
  `total_md_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_hd_persen` decimal(11,2) DEFAULT 0.00,
  `isat_hd_persen` decimal(11,2) DEFAULT 0.00,
  `xl_hd_persen` decimal(11,2) DEFAULT 0.00,
  `tri_hd_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_hd_persen` decimal(11,2) DEFAULT 0.00,
  `axis_hd_persen` decimal(11,2) DEFAULT 0.00,
  `other_hd_persen` decimal(11,2) DEFAULT 0.00,
  `total_hd_persen` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oz_maket_audit_res_tap`
--

CREATE TABLE `oz_maket_audit_res_tap` (
  `id_market_audit` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `minggu` int(11) DEFAULT NULL,
  `id_tap` varchar(64) DEFAULT NULL,
  `id_jenis_share` varchar(64) DEFAULT NULL,
  `telkomsel` int(11) DEFAULT 0,
  `isat` int(11) DEFAULT 0,
  `xl` int(11) DEFAULT 0,
  `tri` int(11) DEFAULT 0,
  `smartfren` int(11) DEFAULT 0,
  `axis` int(11) DEFAULT 0,
  `other` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `telkomsel_ld` int(11) DEFAULT 0,
  `isat_ld` int(11) DEFAULT 0,
  `xl_ld` int(11) DEFAULT 0,
  `tri_ld` int(11) DEFAULT 0,
  `smartfren_ld` int(11) DEFAULT 0,
  `axis_ld` int(11) DEFAULT 0,
  `other_ld` int(11) DEFAULT 0,
  `total_ld` int(11) DEFAULT 0,
  `telkomsel_md` int(11) DEFAULT 0,
  `isat_md` int(11) DEFAULT 0,
  `xl_md` int(11) DEFAULT 0,
  `tri_md` int(11) DEFAULT 0,
  `smartfren_md` int(11) DEFAULT 0,
  `axis_md` int(11) DEFAULT 0,
  `other_md` int(11) DEFAULT 0,
  `total_md` int(11) DEFAULT 0,
  `telkomsel_hd` int(11) DEFAULT 0,
  `isat_hd` int(11) DEFAULT 0,
  `xl_hd` int(11) DEFAULT 0,
  `tri_hd` int(11) DEFAULT 0,
  `smartfren_hd` int(11) DEFAULT 0,
  `axis_hd` int(11) DEFAULT 0,
  `other_hd` int(11) DEFAULT 0,
  `total_hd` int(11) DEFAULT 0,
  `telkomsel_ld_persen` decimal(11,2) DEFAULT 0.00,
  `isat_ld_persen` decimal(11,2) DEFAULT 0.00,
  `xl_ld_persen` decimal(11,2) DEFAULT 0.00,
  `tri_ld_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_ld_persen` decimal(11,2) DEFAULT 0.00,
  `axis_ld_persen` decimal(11,2) DEFAULT 0.00,
  `other_ld_persen` decimal(11,2) DEFAULT 0.00,
  `total_ld_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_md_persen` decimal(11,2) DEFAULT 0.00,
  `isat_md_persen` decimal(11,2) DEFAULT 0.00,
  `xl_md_persen` decimal(11,2) DEFAULT 0.00,
  `tri_md_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_md_persen` decimal(11,2) DEFAULT 0.00,
  `axis_md_persen` decimal(11,2) DEFAULT 0.00,
  `other_md_persen` decimal(11,2) DEFAULT 0.00,
  `total_md_persen` decimal(11,2) DEFAULT 0.00,
  `telkomsel_hd_persen` decimal(11,2) DEFAULT 0.00,
  `isat_hd_persen` decimal(11,2) DEFAULT 0.00,
  `xl_hd_persen` decimal(11,2) DEFAULT 0.00,
  `tri_hd_persen` decimal(11,2) DEFAULT 0.00,
  `smartfren_hd_persen` decimal(11,2) DEFAULT 0.00,
  `axis_hd_persen` decimal(11,2) DEFAULT 0.00,
  `other_hd_persen` decimal(11,2) DEFAULT 0.00,
  `total_hd_persen` decimal(11,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pa_briefing`
--

CREATE TABLE `pa_briefing` (
  `id_briefing` int(11) NOT NULL,
  `id_sales` varchar(64) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `coverage_pagi` varchar(128) DEFAULT NULL,
  `distribution_pagi` varchar(128) DEFAULT NULL,
  `merchandising_pagi` varchar(128) DEFAULT NULL,
  `promotion_pagi` varchar(128) DEFAULT NULL,
  `issue_pagi` varchar(128) DEFAULT NULL,
  `need_support_pagi` varchar(128) DEFAULT NULL,
  `coverage_sore` varchar(128) DEFAULT NULL,
  `distribution_sore` varchar(128) DEFAULT NULL,
  `merchandising_sore` varchar(128) DEFAULT NULL,
  `promotion_sore` varchar(128) DEFAULT NULL,
  `issue_sore` varchar(128) DEFAULT NULL,
  `need_support_sore` varchar(128) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qa_video_tutorial`
--

CREATE TABLE `qa_video_tutorial` (
  `id` int(11) NOT NULL,
  `kategori` enum('REGIONAL','BRANCH','CLUSTER','TAP','SALES') DEFAULT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_lampiran` varchar(128) DEFAULT NULL,
  `file_ext` varchar(64) DEFAULT NULL,
  `file_size` decimal(11,2) DEFAULT 0.00,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qb_upload_sn`
--

CREATE TABLE `qb_upload_sn` (
  `id` int(11) NOT NULL,
  `id_branch` varchar(64) DEFAULT NULL,
  `id_cluster` varchar(64) DEFAULT NULL,
  `id_tap` varchar(64) DEFAULT NULL,
  `file_excel` varchar(64) DEFAULT NULL,
  `file_ext` varchar(64) DEFAULT NULL,
  `file_size` decimal(11,2) DEFAULT 0.00,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_ha_gudang`
--

CREATE TABLE `temporary_ha_gudang` (
  `id_cluster` varchar(64) DEFAULT NULL,
  `id_tap` varchar(64) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `serial_number` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `v_briefing_distribusi_ho_outlet`
--

CREATE TABLE `v_briefing_distribusi_ho_outlet` (
  `id_lokasi` varchar(64) DEFAULT NULL,
  `kode_lokasi` varchar(64) DEFAULT NULL,
  `nama_lokasi` varchar(128) DEFAULT NULL,
  `w1_sgprepaid` bigint(20) DEFAULT NULL,
  `w1_sgota` bigint(20) DEFAULT NULL,
  `w1_sgvin` bigint(20) DEFAULT NULL,
  `w1_sgvgs` bigint(20) DEFAULT NULL,
  `w1_sgvgg` bigint(20) DEFAULT NULL,
  `w1_sgvgp` bigint(20) DEFAULT NULL,
  `w1_insac_ld` bigint(20) DEFAULT NULL,
  `w1_insac_md` bigint(20) DEFAULT NULL,
  `w1_insac_hd` bigint(20) DEFAULT NULL,
  `w1_invin_ld` bigint(20) DEFAULT NULL,
  `w1_invin_md` bigint(20) DEFAULT NULL,
  `w1_invin_hd` bigint(20) DEFAULT NULL,
  `w1_invga_ld` bigint(20) DEFAULT NULL,
  `w1_invga_md` bigint(20) DEFAULT NULL,
  `w1_invga_hd` bigint(20) DEFAULT NULL,
  `w1_la` decimal(33,2) DEFAULT NULL,
  `w2_sgprepaid` bigint(20) DEFAULT NULL,
  `w2_sgota` bigint(20) DEFAULT NULL,
  `w2_sgvin` bigint(20) DEFAULT NULL,
  `w2_sgvgs` bigint(20) DEFAULT NULL,
  `w2_sgvgg` bigint(20) DEFAULT NULL,
  `w2_sgvgp` bigint(20) DEFAULT NULL,
  `w2_insac_ld` bigint(20) DEFAULT NULL,
  `w2_insac_md` bigint(20) DEFAULT NULL,
  `w2_insac_hd` bigint(20) DEFAULT NULL,
  `w2_invin_ld` bigint(20) DEFAULT NULL,
  `w2_invin_md` bigint(20) DEFAULT NULL,
  `w2_invin_hd` bigint(20) DEFAULT NULL,
  `w2_invga_ld` bigint(20) DEFAULT NULL,
  `w2_invga_md` bigint(20) DEFAULT NULL,
  `w2_invga_hd` bigint(20) DEFAULT NULL,
  `w2_la` decimal(33,2) DEFAULT NULL,
  `w3_sgprepaid` bigint(20) DEFAULT NULL,
  `w3_sgota` bigint(20) DEFAULT NULL,
  `w3_sgvin` bigint(20) DEFAULT NULL,
  `w3_sgvgs` bigint(20) DEFAULT NULL,
  `w3_sgvgg` bigint(20) DEFAULT NULL,
  `w3_sgvgp` bigint(20) DEFAULT NULL,
  `w3_insac_ld` bigint(20) DEFAULT NULL,
  `w3_insac_md` bigint(20) DEFAULT NULL,
  `w3_insac_hd` bigint(20) DEFAULT NULL,
  `w3_invin_ld` bigint(20) DEFAULT NULL,
  `w3_invin_md` bigint(20) DEFAULT NULL,
  `w3_invin_hd` bigint(20) DEFAULT NULL,
  `w3_invga_ld` bigint(20) DEFAULT NULL,
  `w3_invga_md` bigint(20) DEFAULT NULL,
  `w3_invga_hd` bigint(20) DEFAULT NULL,
  `w3_la` decimal(33,2) DEFAULT NULL,
  `w4_sgprepaid` bigint(20) DEFAULT NULL,
  `w4_sgota` bigint(20) DEFAULT NULL,
  `w4_sgvin` bigint(20) DEFAULT NULL,
  `w4_sgvgs` bigint(20) DEFAULT NULL,
  `w4_sgvgg` bigint(20) DEFAULT NULL,
  `w4_sgvgp` bigint(20) DEFAULT NULL,
  `w4_insac_ld` bigint(20) DEFAULT NULL,
  `w4_insac_md` bigint(20) DEFAULT NULL,
  `w4_insac_hd` bigint(20) DEFAULT NULL,
  `w4_invin_ld` bigint(20) DEFAULT NULL,
  `w4_invin_md` bigint(20) DEFAULT NULL,
  `w4_invin_hd` bigint(20) DEFAULT NULL,
  `w4_invga_ld` bigint(20) DEFAULT NULL,
  `w4_invga_md` bigint(20) DEFAULT NULL,
  `w4_invga_hd` bigint(20) DEFAULT NULL,
  `w4_la` decimal(33,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `v_briefing_distribusi_tp_outlet`
--

CREATE TABLE `v_briefing_distribusi_tp_outlet` (
  `id_lokasi` varchar(64) DEFAULT NULL,
  `kode_lokasi` varchar(64) DEFAULT NULL,
  `nama_lokasi` varchar(128) DEFAULT NULL,
  `penjualan_sgprepaid` bigint(20) DEFAULT NULL,
  `penjualan_sgota` bigint(20) DEFAULT NULL,
  `penjualan_sgvin` bigint(20) DEFAULT NULL,
  `penjualan_sgvgs` bigint(20) DEFAULT NULL,
  `penjualan_sgvgg` bigint(20) DEFAULT NULL,
  `penjualan_sgvgp` bigint(20) DEFAULT NULL,
  `penjualan_insac_ld` bigint(20) DEFAULT NULL,
  `penjualan_insac_md` bigint(20) DEFAULT NULL,
  `penjualan_insac_hd` bigint(20) DEFAULT NULL,
  `penjualan_invin_ld` bigint(20) DEFAULT NULL,
  `penjualan_invin_md` bigint(20) DEFAULT NULL,
  `penjualan_invin_hd` bigint(20) DEFAULT NULL,
  `penjualan_invga_ld` bigint(20) DEFAULT NULL,
  `penjualan_invga_md` bigint(20) DEFAULT NULL,
  `penjualan_invga_hd` bigint(20) DEFAULT NULL,
  `penjualan_la` decimal(33,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `v_rekomdist_dpt`
--

CREATE TABLE `v_rekomdist_dpt` (
  `sgprepaid` decimal(32,0) DEFAULT NULL,
  `sgota` decimal(32,0) DEFAULT NULL,
  `sgvin` decimal(32,0) DEFAULT NULL,
  `sgvgs` decimal(32,0) DEFAULT NULL,
  `sgvgg` decimal(32,0) DEFAULT NULL,
  `sgvgp` decimal(32,0) DEFAULT NULL,
  `insac_ld` decimal(32,0) DEFAULT NULL,
  `insac_md` decimal(32,0) DEFAULT NULL,
  `insac_hd` decimal(32,0) DEFAULT NULL,
  `invin_ld` decimal(32,0) DEFAULT NULL,
  `invin_md` decimal(32,0) DEFAULT NULL,
  `invin_hd` decimal(32,0) DEFAULT NULL,
  `invga_ld` decimal(32,0) DEFAULT NULL,
  `invga_md` decimal(32,0) DEFAULT NULL,
  `invga_hd` decimal(32,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `v_rekomdist_ss`
--

CREATE TABLE `v_rekomdist_ss` (
  `sgprepaid` decimal(32,0) DEFAULT NULL,
  `sgota` decimal(32,0) DEFAULT NULL,
  `sgvin` decimal(32,0) DEFAULT NULL,
  `sgvgs` decimal(32,0) DEFAULT NULL,
  `sgvgg` decimal(32,0) DEFAULT NULL,
  `sgvgp` decimal(32,0) DEFAULT NULL,
  `insac_ld` decimal(32,0) DEFAULT NULL,
  `insac_md` decimal(32,0) DEFAULT NULL,
  `insac_hd` decimal(32,0) DEFAULT NULL,
  `invin_ld` decimal(32,0) DEFAULT NULL,
  `invin_md` decimal(32,0) DEFAULT NULL,
  `invin_hd` decimal(32,0) DEFAULT NULL,
  `invga_ld` decimal(32,0) DEFAULT NULL,
  `invga_md` decimal(32,0) DEFAULT NULL,
  `invga_hd` decimal(32,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `xa_gudang_cluster`
--

CREATE TABLE `xa_gudang_cluster` (
  `id` int(11) NOT NULL,
  `id_cluster` varchar(64) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `kode` varchar(128) DEFAULT NULL,
  `sn_awal` varchar(16) DEFAULT NULL,
  `sn_akhir` varchar(16) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xb_gudang_tap`
--

CREATE TABLE `xb_gudang_tap` (
  `id` int(11) NOT NULL,
  `id_tap` varchar(64) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `kode` varchar(128) DEFAULT NULL,
  `sn_awal` varchar(16) DEFAULT NULL,
  `sn_akhir` varchar(16) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `modal` decimal(11,2) DEFAULT 0.00,
  `status_produk` enum('SEGEL','INJECT') DEFAULT 'SEGEL'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xc_gudang_available`
--

CREATE TABLE `xc_gudang_available` (
  `id_gudang` varchar(64) NOT NULL,
  `id_cluster` varchar(64) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `jenis_produk` enum('SEGEL','INJECT') DEFAULT 'SEGEL'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xe_retur_temp`
--

CREATE TABLE `xe_retur_temp` (
  `id` int(11) NOT NULL,
  `kode` varchar(128) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `id_tap` varchar(64) DEFAULT NULL,
  `id_sales` varchar(64) DEFAULT NULL,
  `id_produk` varchar(64) DEFAULT NULL,
  `sn_awal` int(11) DEFAULT NULL,
  `sn_akhir` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `id_alasan_retur` int(11) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  `created_by` varchar(64) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `approval_by` varchar(64) DEFAULT NULL,
  `approval_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_bobot_kpi_ava`
--

CREATE TABLE `za_bobot_kpi_ava` (
  `id` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `bobot` int(11) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `za_mt_penilaian_outlet`
--

CREATE TABLE `za_mt_penilaian_outlet` (
  `id` int(11) NOT NULL,
  `id_outlet` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_mt_penilaian_sf`
--

CREATE TABLE `za_mt_penilaian_sf` (
  `id` int(11) NOT NULL,
  `id_sales` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_penilaiansf`
--

CREATE TABLE `za_penilaiansf` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_sales` varchar(40) NOT NULL,
  `id_pilihan_1` int(11) NOT NULL,
  `id_pilihan_2` int(11) NOT NULL,
  `id_pilihan_3` int(11) NOT NULL,
  `id_pilihan_4` int(11) NOT NULL,
  `id_pilihan_5` int(11) NOT NULL,
  `id_pilihan_6` int(11) NOT NULL,
  `id_pilihan_7` int(11) NOT NULL,
  `id_pilihan_8` int(11) NOT NULL,
  `id_pilihan_9` int(11) NOT NULL,
  `id_pilihan_10` int(11) NOT NULL,
  `id_pilihan_11` int(11) NOT NULL,
  `id_pilihan_12` int(11) NOT NULL,
  `total` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_penilaiansf_jenis`
--

CREATE TABLE `za_penilaiansf_jenis` (
  `id` int(11) NOT NULL,
  `jenis` varchar(400) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_penilaiansf_parameter`
--

CREATE TABLE `za_penilaiansf_parameter` (
  `id` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `parameter` varchar(400) NOT NULL,
  `bobot` float NOT NULL,
  `status` varchar(100) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_penilaiansf_pilihan`
--

CREATE TABLE `za_penilaiansf_pilihan` (
  `id` int(11) NOT NULL,
  `pilihan` varchar(400) NOT NULL,
  `angka` int(11) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_penilaian_outlet_jenis`
--

CREATE TABLE `za_penilaian_outlet_jenis` (
  `id` int(11) NOT NULL,
  `jenis` varchar(200) NOT NULL,
  `bobot` int(11) DEFAULT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_penilaian_outlet_padvokasi`
--

CREATE TABLE `za_penilaian_outlet_padvokasi` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `id_parameter` int(11) NOT NULL,
  `pilihan` varchar(100) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_penilaian_outlet_parameter`
--

CREATE TABLE `za_penilaian_outlet_parameter` (
  `id` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `parameter` varchar(600) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `key_kategori` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_penilaian_outlet_pavailability`
--

CREATE TABLE `za_penilaian_outlet_pavailability` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `perdana_segel` int(11) DEFAULT NULL,
  `sa_ld` int(11) DEFAULT NULL,
  `sa_md` int(11) DEFAULT NULL,
  `sa_hd` int(11) DEFAULT NULL,
  `perdana_xl` int(11) DEFAULT NULL,
  `perdana_isat` int(11) DEFAULT NULL,
  `perdana_axis` int(11) DEFAULT NULL,
  `perdana_tri` int(11) DEFAULT NULL,
  `perdana_smartfren` int(11) DEFAULT NULL,
  `perdana_others` int(11) DEFAULT NULL,
  `vf_segel` int(11) DEFAULT NULL,
  `vf_ld` int(11) DEFAULT NULL,
  `vf_md` int(11) DEFAULT NULL,
  `vf_hd` int(11) DEFAULT NULL,
  `vf_xl` int(11) DEFAULT NULL,
  `vf_isat` int(11) DEFAULT NULL,
  `vf_axis` int(11) DEFAULT NULL,
  `vf_tri` int(11) DEFAULT NULL,
  `vf_smartfren` int(11) DEFAULT NULL,
  `vf_others` int(11) DEFAULT NULL,
  `digipos` varchar(10) DEFAULT NULL,
  `saldo_la` varchar(10) DEFAULT NULL,
  `foto_perdana` varchar(64) DEFAULT NULL,
  `foto_voucher_fisik` varchar(64) DEFAULT NULL,
  `created_by` varchar(200) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_penilaian_outlet_pvisibility`
--

CREATE TABLE `za_penilaian_outlet_pvisibility` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `diamond_hotspot` varchar(10) DEFAULT NULL,
  `poster_tsel` int(11) DEFAULT NULL,
  `poster_xl` int(11) DEFAULT NULL,
  `poster_isat` int(11) DEFAULT NULL,
  `poster_axis` int(11) DEFAULT NULL,
  `poster_tri` int(11) DEFAULT NULL,
  `poster_smartfren` int(11) DEFAULT NULL,
  `poster_others` int(11) DEFAULT NULL,
  `layar_toko_tsel` int(11) DEFAULT NULL,
  `layar_toko_xl` int(11) DEFAULT NULL,
  `layar_toko_isat` int(11) DEFAULT NULL,
  `layar_toko_axis` int(11) DEFAULT NULL,
  `layar_toko_tri` int(11) DEFAULT NULL,
  `layar_toko_smartfren` int(11) DEFAULT NULL,
  `layar_toko_others` int(11) DEFAULT NULL,
  `stiker_omni` varchar(10) DEFAULT NULL,
  `foto_etalase` varchar(100) DEFAULT NULL,
  `foto_poster` varchar(100) DEFAULT NULL,
  `foto_layar_toko` varchar(100) DEFAULT NULL,
  `created_by` varchar(200) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_users`
--

CREATE TABLE `za_users` (
  `id_level` int(11) DEFAULT NULL,
  `id_divisi` varchar(64) DEFAULT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `pin` varchar(64) DEFAULT NULL,
  `nama` varchar(300) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `kode_verifikasi` varchar(64) DEFAULT NULL,
  `status` enum('AKTIF','TIDAK AKTIF') DEFAULT 'AKTIF',
  `no_urut` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_users_authentication`
--

CREATE TABLE `za_users_authentication` (
  `id` int(11) NOT NULL,
  `users_id` varchar(64) CHARACTER SET utf8 NOT NULL,
  `role` varchar(64) CHARACTER SET utf8 NOT NULL,
  `id_divisi` varchar(100) NOT NULL,
  `nama` varchar(400) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 NOT NULL,
  `expired_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_voiceofreseller`
--

CREATE TABLE `za_voiceofreseller` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_outlet` int(11) NOT NULL,
  `id_pilihan_1` int(11) NOT NULL,
  `id_pilihan_2` int(11) NOT NULL,
  `id_pilihan_3` int(11) NOT NULL,
  `id_pilihan_4` int(11) NOT NULL,
  `id_pilihan_5` int(11) NOT NULL,
  `id_pilihan_6` int(11) NOT NULL,
  `id_pilihan_7` int(11) NOT NULL,
  `video` varchar(100) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_voiceofreseller_pertanyaaan`
--

CREATE TABLE `za_voiceofreseller_pertanyaaan` (
  `id` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `za_voiceofreseller_pilihan`
--

CREATE TABLE `za_voiceofreseller_pilihan` (
  `id` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `pilihan` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `lastmodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aa_users_level`
--
ALTER TABLE `aa_users_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `ab_users`
--
ALTER TABLE `ab_users`
  ADD PRIMARY KEY (`no_urut`),
  ADD KEY `a_busers_ibfk_1` (`id_level`);

--
-- Indexes for table `ac_users_log`
--
ALTER TABLE `ac_users_log`
  ADD PRIMARY KEY (`id_user_aktifitas`),
  ADD KEY `a_cusers_log_ibfk_1` (`username`);

--
-- Indexes for table `ad_users_authentication`
--
ALTER TABLE `ad_users_authentication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ae_dashboard_coverage_branch`
--
ALTER TABLE `ae_dashboard_coverage_branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_branch` (`id_branch`);

--
-- Indexes for table `af_dashboard_coverage_cluster`
--
ALTER TABLE `af_dashboard_coverage_cluster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_branch` (`id_cluster`);

--
-- Indexes for table `ag_dashboard_coverage_tap`
--
ALTER TABLE `ag_dashboard_coverage_tap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tap` (`id_tap`);

--
-- Indexes for table `ah_dashboard_coverage_kabupaten`
--
ALTER TABLE `ah_dashboard_coverage_kabupaten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kabupaten` (`id_kabupaten`);

--
-- Indexes for table `ai_dashboard_coverage_kecamatan`
--
ALTER TABLE `ai_dashboard_coverage_kecamatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indexes for table `aj_dashboard_distribusi_branch`
--
ALTER TABLE `aj_dashboard_distribusi_branch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_branch` (`id_branch`);

--
-- Indexes for table `ak_dashboard_distribusi_cluster`
--
ALTER TABLE `ak_dashboard_distribusi_cluster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cluster` (`id_cluster`);

--
-- Indexes for table `al_dashboard_distribusi_tap`
--
ALTER TABLE `al_dashboard_distribusi_tap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tap` (`id_tap`);

--
-- Indexes for table `am_dashboard_distribusi_kabupaten`
--
ALTER TABLE `am_dashboard_distribusi_kabupaten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tap` (`id_kabupaten`);

--
-- Indexes for table `an_dashboard_distribusi_kecamatan`
--
ALTER TABLE `an_dashboard_distribusi_kecamatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tap` (`id_kecamatan`);

--
-- Indexes for table `ba_regional`
--
ALTER TABLE `ba_regional`
  ADD PRIMARY KEY (`id_regional`);

--
-- Indexes for table `bb_branch`
--
ALTER TABLE `bb_branch`
  ADD PRIMARY KEY (`id_branch`),
  ADD KEY `b_bbranch_ibfk_1` (`id_regional`);

--
-- Indexes for table `bc_cluster`
--
ALTER TABLE `bc_cluster`
  ADD PRIMARY KEY (`id_cluster`),
  ADD KEY `b_ccluster_ibfk_1` (`id_branch`);

--
-- Indexes for table `bd_main_tap`
--
ALTER TABLE `bd_main_tap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bd_tap`
--
ALTER TABLE `bd_tap`
  ADD PRIMARY KEY (`id_tap`),
  ADD KEY `b_dtap_ibfk_1` (`id_cluster`),
  ADD KEY `id_kabupaten` (`id_kabupaten`);

--
-- Indexes for table `be_tap_mutasi`
--
ALTER TABLE `be_tap_mutasi`
  ADD PRIMARY KEY (`id_tap_mutasi`),
  ADD KEY `b_dtap_mutasi_ibfk_1` (`id_tap`);

--
-- Indexes for table `ca_provinsi`
--
ALTER TABLE `ca_provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- Indexes for table `cb_kabupaten`
--
ALTER TABLE `cb_kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indexes for table `cc_kecamatan`
--
ALTER TABLE `cc_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`),
  ADD KEY `id_cluster` (`id_cluster`),
  ADD KEY `b_gkecamatan_ibfk_1` (`id_kabupaten`);

--
-- Indexes for table `cd_kelurahan`
--
ALTER TABLE `cd_kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indexes for table `da_jenis_sales`
--
ALTER TABLE `da_jenis_sales`
  ADD PRIMARY KEY (`id_jenis_sales`);

--
-- Indexes for table `db_sales`
--
ALTER TABLE `db_sales`
  ADD PRIMARY KEY (`id_sales`),
  ADD KEY `c_bsales_ibfk_1` (`id_jenis_sales`),
  ADD KEY `c_bsales_ibfk_2` (`id_tap`),
  ADD KEY `id_sales_pengganti` (`id_sales_pengganti`);

--
-- Indexes for table `ea_jenis_lokasi`
--
ALTER TABLE `ea_jenis_lokasi`
  ADD PRIMARY KEY (`id_jenis_lokasi`);

--
-- Indexes for table `eb_outlet`
--
ALTER TABLE `eb_outlet`
  ADD PRIMARY KEY (`id_outlet`),
  ADD KEY `id_kelurahan` (`id_kelurahan`),
  ADD KEY `id_jenis_outlet` (`id_jenis_outlet`),
  ADD KEY `id_tap` (`id_tap`),
  ADD KEY `no_rs` (`no_rs`);

--
-- Indexes for table `ec_sekolah`
--
ALTER TABLE `ec_sekolah`
  ADD PRIMARY KEY (`id_sekolah`),
  ADD KEY `id_kelurahan` (`id_kelurahan`),
  ADD KEY `id_tap` (`id_tap`);

--
-- Indexes for table `ed_kampus`
--
ALTER TABLE `ed_kampus`
  ADD PRIMARY KEY (`id_universitas`),
  ADD KEY `id_kelurahan` (`id_kelurahan`),
  ADD KEY `id_tap` (`id_tap`);

--
-- Indexes for table `ee_fakultas`
--
ALTER TABLE `ee_fakultas`
  ADD PRIMARY KEY (`id_fakultas`),
  ADD KEY `id_universitas` (`id_universitas`),
  ADD KEY `id_kelurahan` (`id_kelurahan`),
  ADD KEY `id_tap` (`id_tap`);

--
-- Indexes for table `ef_poi`
--
ALTER TABLE `ef_poi`
  ADD PRIMARY KEY (`id_poi`),
  ADD KEY `id_kelurahan` (`id_kelurahan`) USING BTREE,
  ADD KEY `id_tap` (`id_tap`) USING BTREE;

--
-- Indexes for table `eh_jenis_outlet`
--
ALTER TABLE `eh_jenis_outlet`
  ADD PRIMARY KEY (`id_jenis_outlet`);

--
-- Indexes for table `fa_pjp`
--
ALTER TABLE `fa_pjp`
  ADD PRIMARY KEY (`id_pjp`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`),
  ADD KEY `no_kunjungan` (`no_kunjungan`);

--
-- Indexes for table `fb_histroy_pjp`
--
ALTER TABLE `fb_histroy_pjp`
  ADD PRIMARY KEY (`id_history_pjp`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`);

--
-- Indexes for table `fc_tracking_sales`
--
ALTER TABLE `fc_tracking_sales`
  ADD PRIMARY KEY (`id_tracking_sales`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indexes for table `fd_no_kunjungan`
--
ALTER TABLE `fd_no_kunjungan`
  ADD PRIMARY KEY (`no_kunjungan`);

--
-- Indexes for table `fe_daftar_pjp`
--
ALTER TABLE `fe_daftar_pjp`
  ADD PRIMARY KEY (`id_daftar_pjp`),
  ADD KEY `Id_tempat` (`id_tempat`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indexes for table `ga_jenis_produk`
--
ALTER TABLE `ga_jenis_produk`
  ADD PRIMARY KEY (`id_jenis_produk`);

--
-- Indexes for table `gb_produk`
--
ALTER TABLE `gb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kabupaten` (`id_kabupaten`),
  ADD KEY `id_zona` (`id_zona`),
  ADD KEY `id_jenis_inject` (`id_jenis_produk`),
  ADD KEY `id_jenis_inject_2` (`id_jenis_inject`);

--
-- Indexes for table `gc_zona`
--
ALTER TABLE `gc_zona`
  ADD PRIMARY KEY (`id_zona`);

--
-- Indexes for table `gd_jenis_inject`
--
ALTER TABLE `gd_jenis_inject`
  ADD PRIMARY KEY (`id_jenis_inject`);

--
-- Indexes for table `ha_gudang`
--
ALTER TABLE `ha_gudang`
  ADD PRIMARY KEY (`id_gudang`),
  ADD KEY `id_cluster` (`id_cluster`),
  ADD KEY `id_produk_segel` (`id_produk_segel`),
  ADD KEY `id_tap` (`id_tap`),
  ADD KEY `id_produk_inject` (`id_produk_inject`),
  ADD KEY `status_sn` (`status_sn`) USING BTREE,
  ADD KEY `status_distribusi` (`status_distribusi`) USING BTREE,
  ADD KEY `status_produk` (`status_produk`) USING BTREE,
  ADD KEY `id_tap_2` (`id_tap`,`id_produk_segel`,`status_sn`,`status_produk`) USING BTREE,
  ADD KEY `serial_number` (`serial_number`);

--
-- Indexes for table `hb_retur_tap`
--
ALTER TABLE `hb_retur_tap`
  ADD PRIMARY KEY (`id_retur`),
  ADD KEY `id_tap` (`id_tap`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `alasan` (`alasan`);

--
-- Indexes for table `hc_retur_detail`
--
ALTER TABLE `hc_retur_detail`
  ADD PRIMARY KEY (`id_retur_detail`),
  ADD KEY `id_retur` (`id_retur`);

--
-- Indexes for table `hd_alasan_retur`
--
ALTER TABLE `hd_alasan_retur`
  ADD PRIMARY KEY (`id_alasan`);

--
-- Indexes for table `ia_distribusi_perdana`
--
ALTER TABLE `ia_distribusi_perdana`
  ADD PRIMARY KEY (`id_distribusi`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `serial_number` (`serial_number`);

--
-- Indexes for table `ib_distribusi_la`
--
ALTER TABLE `ib_distribusi_la`
  ADD PRIMARY KEY (`id_distribusi`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indexes for table `ic_retur_sales`
--
ALTER TABLE `ic_retur_sales`
  ADD PRIMARY KEY (`id_retur`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `alasan` (`alasan`);

--
-- Indexes for table `ja_penjualan_tanggal`
--
ALTER TABLE `ja_penjualan_tanggal`
  ADD PRIMARY KEY (`tanggal_merge`),
  ADD KEY `tanggal` (`tanggal`),
  ADD KEY `hari` (`hari`),
  ADD KEY `minggu` (`minggu`);

--
-- Indexes for table `jc_penjualan`
--
ALTER TABLE `jc_penjualan`
  ADD PRIMARY KEY (`no_nota`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`);

--
-- Indexes for table `jd_penjualan_detail`
--
ALTER TABLE `jd_penjualan_detail`
  ADD PRIMARY KEY (`id_penjualan_detail`),
  ADD KEY `no_nota` (`no_nota`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `ka_rekomendasi`
--
ALTER TABLE `ka_rekomendasi`
  ADD PRIMARY KEY (`id_rekomendasi`),
  ADD KEY `id_cluster` (`id_cluster`);

--
-- Indexes for table `kb_rekomendasi_outlet`
--
ALTER TABLE `kb_rekomendasi_outlet`
  ADD PRIMARY KEY (`id_rekomendasi`),
  ADD KEY `id_tap` (`id_outlet`);

--
-- Indexes for table `kc_rekomendasi_sekolah`
--
ALTER TABLE `kc_rekomendasi_sekolah`
  ADD PRIMARY KEY (`id_rekomendasi`);

--
-- Indexes for table `kd_rekomendasi_kampus`
--
ALTER TABLE `kd_rekomendasi_kampus`
  ADD PRIMARY KEY (`id_rekomendasi`);

--
-- Indexes for table `ke_rekomendasi_fakultas`
--
ALTER TABLE `ke_rekomendasi_fakultas`
  ADD PRIMARY KEY (`id_rekomendasi`);

--
-- Indexes for table `kf_rekomendasi_sales`
--
ALTER TABLE `kf_rekomendasi_sales`
  ADD PRIMARY KEY (`id_rekomendasi`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`);

--
-- Indexes for table `kg_rekomendasi_tap`
--
ALTER TABLE `kg_rekomendasi_tap`
  ADD PRIMARY KEY (`id_rekomendasi`),
  ADD KEY `id_tap` (`id_tap`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indexes for table `la_score_card`
--
ALTER TABLE `la_score_card`
  ADD PRIMARY KEY (`id_score_card`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indexes for table `ma_merchandisng_jenis_share`
--
ALTER TABLE `ma_merchandisng_jenis_share`
  ADD PRIMARY KEY (`id_jenis_share`);

--
-- Indexes for table `mb_merchandising_outlet`
--
ALTER TABLE `mb_merchandising_outlet`
  ADD PRIMARY KEY (`id_merchandising`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `mc_merchandising_sekolah`
--
ALTER TABLE `mc_merchandising_sekolah`
  ADD PRIMARY KEY (`id_merchandising`),
  ADD KEY `id_sekolah` (`id_sekolah`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `md_merchandising_kampus`
--
ALTER TABLE `md_merchandising_kampus`
  ADD PRIMARY KEY (`id_merchandising`),
  ADD KEY `id_universitas` (`id_universitas`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `me_merchandising_fakultas`
--
ALTER TABLE `me_merchandising_fakultas`
  ADD PRIMARY KEY (`id_merchandising`),
  ADD KEY `id_fakultas` (`id_fakultas`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `minggu` (`minggu`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `mf_merchandising_res_regional`
--
ALTER TABLE `mf_merchandising_res_regional`
  ADD PRIMARY KEY (`id_merchandising`),
  ADD KEY `id_fakultas` (`id_jenis_lokasi`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `minggu` (`minggu`),
  ADD KEY `jenis_share` (`id_jenis_share`(1)),
  ADD KEY `id_regional` (`id_regional`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `mg_merchandising_res_branch`
--
ALTER TABLE `mg_merchandising_res_branch`
  ADD PRIMARY KEY (`id_merchandising`),
  ADD KEY `id_fakultas` (`id_jenis_lokasi`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `minggu` (`minggu`),
  ADD KEY `jenis_share` (`id_jenis_share`(1)),
  ADD KEY `id_regional` (`id_branch`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `mh_merchandising_res_cluster`
--
ALTER TABLE `mh_merchandising_res_cluster`
  ADD PRIMARY KEY (`id_merchandising`),
  ADD KEY `id_fakultas` (`id_jenis_lokasi`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `minggu` (`minggu`),
  ADD KEY `jenis_share` (`id_jenis_share`(1)),
  ADD KEY `id_regional` (`id_cluster`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `mi_merchandising_res_tap`
--
ALTER TABLE `mi_merchandising_res_tap`
  ADD PRIMARY KEY (`id_merchandising`),
  ADD KEY `id_fakultas` (`id_jenis_lokasi`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `minggu` (`minggu`),
  ADD KEY `jenis_share` (`id_jenis_share`(1)),
  ADD KEY `id_regional` (`id_tap`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `mj_merchandising_res_sales`
--
ALTER TABLE `mj_merchandising_res_sales`
  ADD PRIMARY KEY (`id_merchandising`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `mk_merchandising_res_kabupaten`
--
ALTER TABLE `mk_merchandising_res_kabupaten`
  ADD PRIMARY KEY (`id_merchandising`),
  ADD KEY `id_fakultas` (`id_jenis_lokasi`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `minggu` (`minggu`),
  ADD KEY `jenis_share` (`id_jenis_share`(1)),
  ADD KEY `id_regional` (`id_kabupaten`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `ml_merchandising_res_kecamatan`
--
ALTER TABLE `ml_merchandising_res_kecamatan`
  ADD PRIMARY KEY (`id_merchandising`),
  ADD KEY `id_fakultas` (`id_jenis_lokasi`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `minggu` (`minggu`),
  ADD KEY `jenis_share` (`id_jenis_share`),
  ADD KEY `id_regional` (`id_kecamatan`);

--
-- Indexes for table `na_promotion_jenis`
--
ALTER TABLE `na_promotion_jenis`
  ADD PRIMARY KEY (`id_jenis`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `nb_promotion_jenis_weekly`
--
ALTER TABLE `nb_promotion_jenis_weekly`
  ADD PRIMARY KEY (`id_jenis_weekly`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `nc_promotion_outlet`
--
ALTER TABLE `nc_promotion_outlet`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_promotion` (`id_promotion`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`),
  ADD KEY `id_history_pjp` (`id_history_pjp`);

--
-- Indexes for table `nd_promotion_sekolah`
--
ALTER TABLE `nd_promotion_sekolah`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_promotion` (`id_promotion`),
  ADD KEY `id_sekolah` (`id_sekolah`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`),
  ADD KEY `id_history_pjp` (`id_history_pjp`);

--
-- Indexes for table `ne_promotion_kampus`
--
ALTER TABLE `ne_promotion_kampus`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_universitas` (`id_universitas`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`),
  ADD KEY `id_history_pjp` (`id_history_pjp`);

--
-- Indexes for table `nf_promotion_fakultas`
--
ALTER TABLE `nf_promotion_fakultas`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_fakultas` (`id_fakultas`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`),
  ADD KEY `id_history_pjp` (`id_history_pjp`);

--
-- Indexes for table `nf_promotion_poi`
--
ALTER TABLE `nf_promotion_poi`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_fakultas` (`id_poi`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`),
  ADD KEY `id_history_pjp` (`id_history_pjp`);

--
-- Indexes for table `ng_promotion_res_regional`
--
ALTER TABLE `ng_promotion_res_regional`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_regional` (`id_regional`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`);

--
-- Indexes for table `nh_promotion_res_branch`
--
ALTER TABLE `nh_promotion_res_branch`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_branch` (`id_branch`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`);

--
-- Indexes for table `ni_promotion_res_cluster`
--
ALTER TABLE `ni_promotion_res_cluster`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_cluster` (`id_cluster`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`);

--
-- Indexes for table `nj_promotion_res_tap`
--
ALTER TABLE `nj_promotion_res_tap`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_tap` (`id_tap`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`);

--
-- Indexes for table `nk_promotion_res_sales`
--
ALTER TABLE `nk_promotion_res_sales`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`);

--
-- Indexes for table `nl_promotion_res_kabupaten`
--
ALTER TABLE `nl_promotion_res_kabupaten`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_kabupaten` (`id_kabupaten`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`);

--
-- Indexes for table `nm_promotion_res_kecamatan`
--
ALTER TABLE `nm_promotion_res_kecamatan`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_jenis_lokasi` (`id_jenis_lokasi`),
  ADD KEY `id_jenis_weekly` (`id_jenis_weekly`);

--
-- Indexes for table `oa_market_audit_jenis_share`
--
ALTER TABLE `oa_market_audit_jenis_share`
  ADD PRIMARY KEY (`id_jenis_share`);

--
-- Indexes for table `ob_market_audit_outlet`
--
ALTER TABLE `ob_market_audit_outlet`
  ADD PRIMARY KEY (`id_market_audit`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_jenis_share` (`id_jenis_share`),
  ADD KEY `id_history_pjp` (`id_history_pjp`);

--
-- Indexes for table `oj_market_audit_res_sekolah`
--
ALTER TABLE `oj_market_audit_res_sekolah`
  ADD PRIMARY KEY (`id_market_audit`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `minggu` (`minggu`),
  ADD KEY `tanggal` (`tgl`),
  ADD KEY `id_konsumsi_internet` (`op_digital`),
  ADD KEY `id_biaya_internet` (`msisdn_digital`),
  ADD KEY `id_aplikasi_favorit` (`frekuensi_beli_paket`),
  ADD KEY `id_cara_beli_paket` (`kuota_per_bulan`),
  ADD KEY `id_paket_favorit` (`pulsa_per_bulan`),
  ADD KEY `id_sekolah` (`id_sekolah`),
  ADD KEY `insertby` (`created_by`),
  ADD KEY `id_history_pjp` (`id_history_pjp`);

--
-- Indexes for table `ok_market_audit_res_fakultas`
--
ALTER TABLE `ok_market_audit_res_fakultas`
  ADD PRIMARY KEY (`id_market_audit`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `minggu` (`minggu`),
  ADD KEY `tanggal` (`tgl`),
  ADD KEY `id_konsumsi_internet` (`op_digital`),
  ADD KEY `id_biaya_internet` (`msisdn_digital`),
  ADD KEY `id_aplikasi_favorit` (`frekuensi_beli_paket`),
  ADD KEY `id_cara_beli_paket` (`kuota_per_bulan`),
  ADD KEY `id_paket_favorit` (`pulsa_per_bulan`),
  ADD KEY `id_sekolah` (`id_fakultas`),
  ADD KEY `insertby` (`created_by`),
  ADD KEY `id_history_pjp` (`id_history_pjp`);

--
-- Indexes for table `ol_market_audit_res_kampus`
--
ALTER TABLE `ol_market_audit_res_kampus`
  ADD PRIMARY KEY (`id_market_audit`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `minggu` (`minggu`),
  ADD KEY `tanggal` (`tgl`),
  ADD KEY `id_konsumsi_internet` (`op_digital`),
  ADD KEY `id_biaya_internet` (`msisdn_digital`),
  ADD KEY `id_aplikasi_favorit` (`frekuensi_beli_paket`),
  ADD KEY `id_cara_beli_paket` (`kuota_per_bulan`),
  ADD KEY `id_paket_favorit` (`pulsa_per_bulan`),
  ADD KEY `id_sekolah` (`id_universitas`),
  ADD KEY `insertby` (`created_by`),
  ADD KEY `id_history_pjp` (`id_history_pjp`);

--
-- Indexes for table `ot_master_frekuensi_beli_paket`
--
ALTER TABLE `ot_master_frekuensi_beli_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ou_master_provider`
--
ALTER TABLE `ou_master_provider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oz_maket_audit_res_branch`
--
ALTER TABLE `oz_maket_audit_res_branch`
  ADD PRIMARY KEY (`id_market_audit`),
  ADD KEY `id_branch` (`id_branch`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `oz_maket_audit_res_cluster`
--
ALTER TABLE `oz_maket_audit_res_cluster`
  ADD PRIMARY KEY (`id_market_audit`),
  ADD KEY `id_cluster` (`id_cluster`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `oz_maket_audit_res_kabupaten`
--
ALTER TABLE `oz_maket_audit_res_kabupaten`
  ADD PRIMARY KEY (`id_market_audit`),
  ADD KEY `id_kabupaten` (`id_kabupaten`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `oz_maket_audit_res_kecamatan`
--
ALTER TABLE `oz_maket_audit_res_kecamatan`
  ADD PRIMARY KEY (`id_market_audit`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `oz_maket_audit_res_regional`
--
ALTER TABLE `oz_maket_audit_res_regional`
  ADD PRIMARY KEY (`id_market_audit`),
  ADD KEY `id_regional` (`id_regional`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `oz_maket_audit_res_sales`
--
ALTER TABLE `oz_maket_audit_res_sales`
  ADD PRIMARY KEY (`id_market_audit`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `oz_maket_audit_res_tap`
--
ALTER TABLE `oz_maket_audit_res_tap`
  ADD PRIMARY KEY (`id_market_audit`),
  ADD KEY `id_tap` (`id_tap`),
  ADD KEY `id_jenis_share` (`id_jenis_share`);

--
-- Indexes for table `pa_briefing`
--
ALTER TABLE `pa_briefing`
  ADD PRIMARY KEY (`id_briefing`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indexes for table `qa_video_tutorial`
--
ALTER TABLE `qa_video_tutorial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qb_upload_sn`
--
ALTER TABLE `qb_upload_sn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xa_gudang_cluster`
--
ALTER TABLE `xa_gudang_cluster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_cluster` (`id_cluster`);

--
-- Indexes for table `xb_gudang_tap`
--
ALTER TABLE `xb_gudang_tap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_tap` (`id_tap`);

--
-- Indexes for table `xc_gudang_available`
--
ALTER TABLE `xc_gudang_available`
  ADD PRIMARY KEY (`id_gudang`),
  ADD KEY `id_cluster` (`id_cluster`,`jenis_produk`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `xe_retur_temp`
--
ALTER TABLE `xe_retur_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tap` (`id_tap`),
  ADD KEY `id_sales` (`id_sales`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_alasan_retur` (`id_alasan_retur`);

--
-- Indexes for table `za_bobot_kpi_ava`
--
ALTER TABLE `za_bobot_kpi_ava`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_mt_penilaian_outlet`
--
ALTER TABLE `za_mt_penilaian_outlet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_mt_penilaian_sf`
--
ALTER TABLE `za_mt_penilaian_sf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_penilaiansf`
--
ALTER TABLE `za_penilaiansf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_penilaiansf_jenis`
--
ALTER TABLE `za_penilaiansf_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_penilaiansf_parameter`
--
ALTER TABLE `za_penilaiansf_parameter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_penilaiansf_pilihan`
--
ALTER TABLE `za_penilaiansf_pilihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_penilaian_outlet_jenis`
--
ALTER TABLE `za_penilaian_outlet_jenis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis` (`jenis`);

--
-- Indexes for table `za_penilaian_outlet_padvokasi`
--
ALTER TABLE `za_penilaian_outlet_padvokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_penilaian_outlet_parameter`
--
ALTER TABLE `za_penilaian_outlet_parameter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `parameter` (`parameter`),
  ADD KEY `kategori` (`kategori`);

--
-- Indexes for table `za_penilaian_outlet_pavailability`
--
ALTER TABLE `za_penilaian_outlet_pavailability`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `foto_voucher_fisik` (`foto_voucher_fisik`),
  ADD UNIQUE KEY `foto_perdana` (`foto_perdana`);

--
-- Indexes for table `za_penilaian_outlet_pvisibility`
--
ALTER TABLE `za_penilaian_outlet_pvisibility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_users`
--
ALTER TABLE `za_users`
  ADD PRIMARY KEY (`no_urut`),
  ADD KEY `a_busers_ibfk_1` (`id_level`);

--
-- Indexes for table `za_users_authentication`
--
ALTER TABLE `za_users_authentication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_voiceofreseller`
--
ALTER TABLE `za_voiceofreseller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_voiceofreseller_pertanyaaan`
--
ALTER TABLE `za_voiceofreseller_pertanyaaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `za_voiceofreseller_pilihan`
--
ALTER TABLE `za_voiceofreseller_pilihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aa_users_level`
--
ALTER TABLE `aa_users_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ab_users`
--
ALTER TABLE `ab_users`
  MODIFY `no_urut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=820;

--
-- AUTO_INCREMENT for table `ac_users_log`
--
ALTER TABLE `ac_users_log`
  MODIFY `id_user_aktifitas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ad_users_authentication`
--
ALTER TABLE `ad_users_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36368;

--
-- AUTO_INCREMENT for table `ae_dashboard_coverage_branch`
--
ALTER TABLE `ae_dashboard_coverage_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `af_dashboard_coverage_cluster`
--
ALTER TABLE `af_dashboard_coverage_cluster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `ag_dashboard_coverage_tap`
--
ALTER TABLE `ag_dashboard_coverage_tap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `ah_dashboard_coverage_kabupaten`
--
ALTER TABLE `ah_dashboard_coverage_kabupaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `ai_dashboard_coverage_kecamatan`
--
ALTER TABLE `ai_dashboard_coverage_kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3121;

--
-- AUTO_INCREMENT for table `aj_dashboard_distribusi_branch`
--
ALTER TABLE `aj_dashboard_distribusi_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ak_dashboard_distribusi_cluster`
--
ALTER TABLE `ak_dashboard_distribusi_cluster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `al_dashboard_distribusi_tap`
--
ALTER TABLE `al_dashboard_distribusi_tap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `am_dashboard_distribusi_kabupaten`
--
ALTER TABLE `am_dashboard_distribusi_kabupaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `an_dashboard_distribusi_kecamatan`
--
ALTER TABLE `an_dashboard_distribusi_kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2341;

--
-- AUTO_INCREMENT for table `bd_main_tap`
--
ALTER TABLE `bd_main_tap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19967;

--
-- AUTO_INCREMENT for table `be_tap_mutasi`
--
ALTER TABLE `be_tap_mutasi`
  MODIFY `id_tap_mutasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eb_outlet`
--
ALTER TABLE `eb_outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31583;

--
-- AUTO_INCREMENT for table `ec_sekolah`
--
ALTER TABLE `ec_sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1543;

--
-- AUTO_INCREMENT for table `ed_kampus`
--
ALTER TABLE `ed_kampus`
  MODIFY `id_universitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `ee_fakultas`
--
ALTER TABLE `ee_fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ef_poi`
--
ALTER TABLE `ef_poi`
  MODIFY `id_poi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2145;

--
-- AUTO_INCREMENT for table `eh_jenis_outlet`
--
ALTER TABLE `eh_jenis_outlet`
  MODIFY `id_jenis_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fa_pjp`
--
ALTER TABLE `fa_pjp`
  MODIFY `id_pjp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25524;

--
-- AUTO_INCREMENT for table `fb_histroy_pjp`
--
ALTER TABLE `fb_histroy_pjp`
  MODIFY `id_history_pjp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63133;

--
-- AUTO_INCREMENT for table `fc_tracking_sales`
--
ALTER TABLE `fc_tracking_sales`
  MODIFY `id_tracking_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=776192;

--
-- AUTO_INCREMENT for table `fe_daftar_pjp`
--
ALTER TABLE `fe_daftar_pjp`
  MODIFY `id_daftar_pjp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=492401;

--
-- AUTO_INCREMENT for table `gb_produk`
--
ALTER TABLE `gb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1936;

--
-- AUTO_INCREMENT for table `gc_zona`
--
ALTER TABLE `gc_zona`
  MODIFY `id_zona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gd_jenis_inject`
--
ALTER TABLE `gd_jenis_inject`
  MODIFY `id_jenis_inject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ha_gudang`
--
ALTER TABLE `ha_gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158523648;

--
-- AUTO_INCREMENT for table `hb_retur_tap`
--
ALTER TABLE `hb_retur_tap`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hc_retur_detail`
--
ALTER TABLE `hc_retur_detail`
  MODIFY `id_retur_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hd_alasan_retur`
--
ALTER TABLE `hd_alasan_retur`
  MODIFY `id_alasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ia_distribusi_perdana`
--
ALTER TABLE `ia_distribusi_perdana`
  MODIFY `id_distribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2915099;

--
-- AUTO_INCREMENT for table `ib_distribusi_la`
--
ALTER TABLE `ib_distribusi_la`
  MODIFY `id_distribusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT for table `ic_retur_sales`
--
ALTER TABLE `ic_retur_sales`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `jd_penjualan_detail`
--
ALTER TABLE `jd_penjualan_detail`
  MODIFY `id_penjualan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=976119;

--
-- AUTO_INCREMENT for table `ka_rekomendasi`
--
ALTER TABLE `ka_rekomendasi`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kb_rekomendasi_outlet`
--
ALTER TABLE `kb_rekomendasi_outlet`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kc_rekomendasi_sekolah`
--
ALTER TABLE `kc_rekomendasi_sekolah`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kd_rekomendasi_kampus`
--
ALTER TABLE `kd_rekomendasi_kampus`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ke_rekomendasi_fakultas`
--
ALTER TABLE `ke_rekomendasi_fakultas`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kf_rekomendasi_sales`
--
ALTER TABLE `kf_rekomendasi_sales`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140620;

--
-- AUTO_INCREMENT for table `kg_rekomendasi_tap`
--
ALTER TABLE `kg_rekomendasi_tap`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `la_score_card`
--
ALTER TABLE `la_score_card`
  MODIFY `id_score_card` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26429;

--
-- AUTO_INCREMENT for table `mb_merchandising_outlet`
--
ALTER TABLE `mb_merchandising_outlet`
  MODIFY `id_merchandising` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143058;

--
-- AUTO_INCREMENT for table `mc_merchandising_sekolah`
--
ALTER TABLE `mc_merchandising_sekolah`
  MODIFY `id_merchandising` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15734;

--
-- AUTO_INCREMENT for table `md_merchandising_kampus`
--
ALTER TABLE `md_merchandising_kampus`
  MODIFY `id_merchandising` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `me_merchandising_fakultas`
--
ALTER TABLE `me_merchandising_fakultas`
  MODIFY `id_merchandising` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `mf_merchandising_res_regional`
--
ALTER TABLE `mf_merchandising_res_regional`
  MODIFY `id_merchandising` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `mg_merchandising_res_branch`
--
ALTER TABLE `mg_merchandising_res_branch`
  MODIFY `id_merchandising` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT for table `mh_merchandising_res_cluster`
--
ALTER TABLE `mh_merchandising_res_cluster`
  MODIFY `id_merchandising` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1057;

--
-- AUTO_INCREMENT for table `mi_merchandising_res_tap`
--
ALTER TABLE `mi_merchandising_res_tap`
  MODIFY `id_merchandising` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7975;

--
-- AUTO_INCREMENT for table `mj_merchandising_res_sales`
--
ALTER TABLE `mj_merchandising_res_sales`
  MODIFY `id_merchandising` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41083;

--
-- AUTO_INCREMENT for table `mk_merchandising_res_kabupaten`
--
ALTER TABLE `mk_merchandising_res_kabupaten`
  MODIFY `id_merchandising` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5761;

--
-- AUTO_INCREMENT for table `ml_merchandising_res_kecamatan`
--
ALTER TABLE `ml_merchandising_res_kecamatan`
  MODIFY `id_merchandising` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74881;

--
-- AUTO_INCREMENT for table `na_promotion_jenis`
--
ALTER TABLE `na_promotion_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nb_promotion_jenis_weekly`
--
ALTER TABLE `nb_promotion_jenis_weekly`
  MODIFY `id_jenis_weekly` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `nc_promotion_outlet`
--
ALTER TABLE `nc_promotion_outlet`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29012;

--
-- AUTO_INCREMENT for table `nd_promotion_sekolah`
--
ALTER TABLE `nd_promotion_sekolah`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2952;

--
-- AUTO_INCREMENT for table `ne_promotion_kampus`
--
ALTER TABLE `ne_promotion_kampus`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `nf_promotion_fakultas`
--
ALTER TABLE `nf_promotion_fakultas`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nf_promotion_poi`
--
ALTER TABLE `nf_promotion_poi`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2483;

--
-- AUTO_INCREMENT for table `ng_promotion_res_regional`
--
ALTER TABLE `ng_promotion_res_regional`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT for table `nh_promotion_res_branch`
--
ALTER TABLE `nh_promotion_res_branch`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2101;

--
-- AUTO_INCREMENT for table `ni_promotion_res_cluster`
--
ALTER TABLE `ni_promotion_res_cluster`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4621;

--
-- AUTO_INCREMENT for table `nj_promotion_res_tap`
--
ALTER TABLE `nj_promotion_res_tap`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33181;

--
-- AUTO_INCREMENT for table `nk_promotion_res_sales`
--
ALTER TABLE `nk_promotion_res_sales`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236636;

--
-- AUTO_INCREMENT for table `nl_promotion_res_kabupaten`
--
ALTER TABLE `nl_promotion_res_kabupaten`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25201;

--
-- AUTO_INCREMENT for table `nm_promotion_res_kecamatan`
--
ALTER TABLE `nm_promotion_res_kecamatan`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327601;

--
-- AUTO_INCREMENT for table `ob_market_audit_outlet`
--
ALTER TABLE `ob_market_audit_outlet`
  MODIFY `id_market_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83332;

--
-- AUTO_INCREMENT for table `oj_market_audit_res_sekolah`
--
ALTER TABLE `oj_market_audit_res_sekolah`
  MODIFY `id_market_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3067;

--
-- AUTO_INCREMENT for table `ok_market_audit_res_fakultas`
--
ALTER TABLE `ok_market_audit_res_fakultas`
  MODIFY `id_market_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ol_market_audit_res_kampus`
--
ALTER TABLE `ol_market_audit_res_kampus`
  MODIFY `id_market_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `oz_maket_audit_res_branch`
--
ALTER TABLE `oz_maket_audit_res_branch`
  MODIFY `id_market_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `oz_maket_audit_res_cluster`
--
ALTER TABLE `oz_maket_audit_res_cluster`
  MODIFY `id_market_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT for table `oz_maket_audit_res_kabupaten`
--
ALTER TABLE `oz_maket_audit_res_kabupaten`
  MODIFY `id_market_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2161;

--
-- AUTO_INCREMENT for table `oz_maket_audit_res_kecamatan`
--
ALTER TABLE `oz_maket_audit_res_kecamatan`
  MODIFY `id_market_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28081;

--
-- AUTO_INCREMENT for table `oz_maket_audit_res_regional`
--
ALTER TABLE `oz_maket_audit_res_regional`
  MODIFY `id_market_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `oz_maket_audit_res_sales`
--
ALTER TABLE `oz_maket_audit_res_sales`
  MODIFY `id_market_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20302;

--
-- AUTO_INCREMENT for table `oz_maket_audit_res_tap`
--
ALTER TABLE `oz_maket_audit_res_tap`
  MODIFY `id_market_audit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2845;

--
-- AUTO_INCREMENT for table `pa_briefing`
--
ALTER TABLE `pa_briefing`
  MODIFY `id_briefing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `qa_video_tutorial`
--
ALTER TABLE `qa_video_tutorial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `qb_upload_sn`
--
ALTER TABLE `qb_upload_sn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=362;

--
-- AUTO_INCREMENT for table `xa_gudang_cluster`
--
ALTER TABLE `xa_gudang_cluster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92528;

--
-- AUTO_INCREMENT for table `xb_gudang_tap`
--
ALTER TABLE `xb_gudang_tap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58399;

--
-- AUTO_INCREMENT for table `xe_retur_temp`
--
ALTER TABLE `xe_retur_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `za_bobot_kpi_ava`
--
ALTER TABLE `za_bobot_kpi_ava`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `za_mt_penilaian_outlet`
--
ALTER TABLE `za_mt_penilaian_outlet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `za_mt_penilaian_sf`
--
ALTER TABLE `za_mt_penilaian_sf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `za_penilaiansf`
--
ALTER TABLE `za_penilaiansf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `za_penilaiansf_jenis`
--
ALTER TABLE `za_penilaiansf_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `za_penilaiansf_parameter`
--
ALTER TABLE `za_penilaiansf_parameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `za_penilaiansf_pilihan`
--
ALTER TABLE `za_penilaiansf_pilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `za_penilaian_outlet_jenis`
--
ALTER TABLE `za_penilaian_outlet_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `za_penilaian_outlet_padvokasi`
--
ALTER TABLE `za_penilaian_outlet_padvokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=561;

--
-- AUTO_INCREMENT for table `za_penilaian_outlet_parameter`
--
ALTER TABLE `za_penilaian_outlet_parameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `za_penilaian_outlet_pavailability`
--
ALTER TABLE `za_penilaian_outlet_pavailability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `za_penilaian_outlet_pvisibility`
--
ALTER TABLE `za_penilaian_outlet_pvisibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `za_users`
--
ALTER TABLE `za_users`
  MODIFY `no_urut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `za_users_authentication`
--
ALTER TABLE `za_users_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `za_voiceofreseller`
--
ALTER TABLE `za_voiceofreseller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `za_voiceofreseller_pertanyaaan`
--
ALTER TABLE `za_voiceofreseller_pertanyaaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `za_voiceofreseller_pilihan`
--
ALTER TABLE `za_voiceofreseller_pilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ae_dashboard_coverage_branch`
--
ALTER TABLE `ae_dashboard_coverage_branch`
  ADD CONSTRAINT `ae_dashboard_coverage_branch_ibfk_1` FOREIGN KEY (`id_branch`) REFERENCES `bb_branch` (`id_branch`);

--
-- Constraints for table `af_dashboard_coverage_cluster`
--
ALTER TABLE `af_dashboard_coverage_cluster`
  ADD CONSTRAINT `af_dashboard_coverage_cluster_ibfk_1` FOREIGN KEY (`id_cluster`) REFERENCES `bc_cluster` (`id_cluster`);

--
-- Constraints for table `ag_dashboard_coverage_tap`
--
ALTER TABLE `ag_dashboard_coverage_tap`
  ADD CONSTRAINT `ag_dashboard_coverage_tap_ibfk_1` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`);

--
-- Constraints for table `aj_dashboard_distribusi_branch`
--
ALTER TABLE `aj_dashboard_distribusi_branch`
  ADD CONSTRAINT `aj_dashboard_distribusi_branch_ibfk_1` FOREIGN KEY (`id_branch`) REFERENCES `bb_branch` (`id_branch`);

--
-- Constraints for table `ak_dashboard_distribusi_cluster`
--
ALTER TABLE `ak_dashboard_distribusi_cluster`
  ADD CONSTRAINT `ak_dashboard_distribusi_cluster_ibfk_1` FOREIGN KEY (`id_cluster`) REFERENCES `bc_cluster` (`id_cluster`);

--
-- Constraints for table `al_dashboard_distribusi_tap`
--
ALTER TABLE `al_dashboard_distribusi_tap`
  ADD CONSTRAINT `al_dashboard_distribusi_tap_ibfk_1` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`);

--
-- Constraints for table `bb_branch`
--
ALTER TABLE `bb_branch`
  ADD CONSTRAINT `bb_branch_ibfk_1` FOREIGN KEY (`id_regional`) REFERENCES `ba_regional` (`id_regional`);

--
-- Constraints for table `bc_cluster`
--
ALTER TABLE `bc_cluster`
  ADD CONSTRAINT `bc_cluster_ibfk_1` FOREIGN KEY (`id_branch`) REFERENCES `bb_branch` (`id_branch`);

--
-- Constraints for table `bd_tap`
--
ALTER TABLE `bd_tap`
  ADD CONSTRAINT `bd_tap_ibfk_1` FOREIGN KEY (`id_kabupaten`) REFERENCES `cb_kabupaten` (`id_kabupaten`),
  ADD CONSTRAINT `bd_tap_ibfk_2` FOREIGN KEY (`id_cluster`) REFERENCES `bc_cluster` (`id_cluster`);

--
-- Constraints for table `be_tap_mutasi`
--
ALTER TABLE `be_tap_mutasi`
  ADD CONSTRAINT `be_tap_mutasi_ibfk_1` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`);

--
-- Constraints for table `cb_kabupaten`
--
ALTER TABLE `cb_kabupaten`
  ADD CONSTRAINT `cb_kabupaten_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `ca_provinsi` (`id_provinsi`);

--
-- Constraints for table `cc_kecamatan`
--
ALTER TABLE `cc_kecamatan`
  ADD CONSTRAINT `cc_kecamatan_ibfk_1` FOREIGN KEY (`id_kabupaten`) REFERENCES `cb_kabupaten` (`id_kabupaten`),
  ADD CONSTRAINT `cc_kecamatan_ibfk_2` FOREIGN KEY (`id_cluster`) REFERENCES `bc_cluster` (`id_cluster`);

--
-- Constraints for table `cd_kelurahan`
--
ALTER TABLE `cd_kelurahan`
  ADD CONSTRAINT `cd_kelurahan_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `cc_kecamatan` (`id_kecamatan`);

--
-- Constraints for table `db_sales`
--
ALTER TABLE `db_sales`
  ADD CONSTRAINT `db_sales_ibfk_1` FOREIGN KEY (`id_jenis_sales`) REFERENCES `da_jenis_sales` (`id_jenis_sales`),
  ADD CONSTRAINT `db_sales_ibfk_2` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`);

--
-- Constraints for table `eb_outlet`
--
ALTER TABLE `eb_outlet`
  ADD CONSTRAINT `eb_outlet_ibfk_1` FOREIGN KEY (`id_kelurahan`) REFERENCES `cd_kelurahan` (`id_kelurahan`),
  ADD CONSTRAINT `eb_outlet_ibfk_2` FOREIGN KEY (`id_jenis_outlet`) REFERENCES `eh_jenis_outlet` (`id_jenis_outlet`),
  ADD CONSTRAINT `eb_outlet_ibfk_3` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`);

--
-- Constraints for table `ec_sekolah`
--
ALTER TABLE `ec_sekolah`
  ADD CONSTRAINT `ec_sekolah_ibfk_1` FOREIGN KEY (`id_kelurahan`) REFERENCES `cd_kelurahan` (`id_kelurahan`),
  ADD CONSTRAINT `ec_sekolah_ibfk_2` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`);

--
-- Constraints for table `ed_kampus`
--
ALTER TABLE `ed_kampus`
  ADD CONSTRAINT `ed_kampus_ibfk_1` FOREIGN KEY (`id_kelurahan`) REFERENCES `cd_kelurahan` (`id_kelurahan`),
  ADD CONSTRAINT `ed_kampus_ibfk_2` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`);

--
-- Constraints for table `ee_fakultas`
--
ALTER TABLE `ee_fakultas`
  ADD CONSTRAINT `ee_fakultas_ibfk_1` FOREIGN KEY (`id_kelurahan`) REFERENCES `cd_kelurahan` (`id_kelurahan`),
  ADD CONSTRAINT `ee_fakultas_ibfk_2` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`),
  ADD CONSTRAINT `ee_fakultas_ibfk_3` FOREIGN KEY (`id_universitas`) REFERENCES `ed_kampus` (`id_universitas`);

--
-- Constraints for table `ef_poi`
--
ALTER TABLE `ef_poi`
  ADD CONSTRAINT `ef_poi_ibfk_2_copy` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`);

--
-- Constraints for table `fa_pjp`
--
ALTER TABLE `fa_pjp`
  ADD CONSTRAINT `fa_pjp_ibfk_1` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`),
  ADD CONSTRAINT `fa_pjp_ibfk_2` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`);

--
-- Constraints for table `fb_histroy_pjp`
--
ALTER TABLE `fb_histroy_pjp`
  ADD CONSTRAINT `fb_histroy_pjp_ibfk_1` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`),
  ADD CONSTRAINT `fb_histroy_pjp_ibfk_2` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`);

--
-- Constraints for table `fc_tracking_sales`
--
ALTER TABLE `fc_tracking_sales`
  ADD CONSTRAINT `fc_tracking_sales_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`);

--
-- Constraints for table `fe_daftar_pjp`
--
ALTER TABLE `fe_daftar_pjp`
  ADD CONSTRAINT `fe_daftar_pjp_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`),
  ADD CONSTRAINT `fe_daftar_pjp_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`);

--
-- Constraints for table `gb_produk`
--
ALTER TABLE `gb_produk`
  ADD CONSTRAINT `gb_produk_ibfk_2` FOREIGN KEY (`id_zona`) REFERENCES `gc_zona` (`id_zona`),
  ADD CONSTRAINT `gb_produk_ibfk_3` FOREIGN KEY (`id_jenis_produk`) REFERENCES `ga_jenis_produk` (`id_jenis_produk`),
  ADD CONSTRAINT `gb_produk_ibfk_4` FOREIGN KEY (`id_jenis_inject`) REFERENCES `gd_jenis_inject` (`id_jenis_inject`),
  ADD CONSTRAINT `gb_produk_ibfk_5` FOREIGN KEY (`id_kabupaten`) REFERENCES `cb_kabupaten` (`id_kabupaten`);

--
-- Constraints for table `ha_gudang`
--
ALTER TABLE `ha_gudang`
  ADD CONSTRAINT `ha_gudang_ibfk_1` FOREIGN KEY (`id_cluster`) REFERENCES `bc_cluster` (`id_cluster`),
  ADD CONSTRAINT `ha_gudang_ibfk_2` FOREIGN KEY (`id_produk_segel`) REFERENCES `gb_produk` (`id_produk`),
  ADD CONSTRAINT `ha_gudang_ibfk_3` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`),
  ADD CONSTRAINT `ha_gudang_ibfk_4` FOREIGN KEY (`id_produk_inject`) REFERENCES `gb_produk` (`id_produk`);

--
-- Constraints for table `hb_retur_tap`
--
ALTER TABLE `hb_retur_tap`
  ADD CONSTRAINT `hb_retur_tap_ibfk_1` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hb_retur_tap_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `gb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hb_retur_tap_ibfk_3` FOREIGN KEY (`alasan`) REFERENCES `hd_alasan_retur` (`id_alasan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hc_retur_detail`
--
ALTER TABLE `hc_retur_detail`
  ADD CONSTRAINT `hc_retur_detail_ibfk_1` FOREIGN KEY (`id_retur`) REFERENCES `hb_retur_tap` (`id_retur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ia_distribusi_perdana`
--
ALTER TABLE `ia_distribusi_perdana`
  ADD CONSTRAINT `ia_distribusi_perdana_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ia_distribusi_perdana_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `gb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ib_distribusi_la`
--
ALTER TABLE `ib_distribusi_la`
  ADD CONSTRAINT `ib_distribusi_la_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ic_retur_sales`
--
ALTER TABLE `ic_retur_sales`
  ADD CONSTRAINT `ic_retur_sales_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ic_retur_sales_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `gb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ic_retur_sales_ibfk_3` FOREIGN KEY (`alasan`) REFERENCES `hd_alasan_retur` (`id_alasan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jc_penjualan`
--
ALTER TABLE `jc_penjualan`
  ADD CONSTRAINT `jc_penjualan_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`),
  ADD CONSTRAINT `jc_penjualan_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`);

--
-- Constraints for table `jd_penjualan_detail`
--
ALTER TABLE `jd_penjualan_detail`
  ADD CONSTRAINT `jd_penjualan_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `gb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jd_penjualan_detail_ibfk_3` FOREIGN KEY (`no_nota`) REFERENCES `jc_penjualan` (`no_nota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ka_rekomendasi`
--
ALTER TABLE `ka_rekomendasi`
  ADD CONSTRAINT `ka_rekomendasi_ibfk_1` FOREIGN KEY (`id_cluster`) REFERENCES `bc_cluster` (`id_cluster`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kb_rekomendasi_outlet`
--
ALTER TABLE `kb_rekomendasi_outlet`
  ADD CONSTRAINT `kb_rekomendasi_outlet_ibfk_1` FOREIGN KEY (`id_outlet`) REFERENCES `eb_outlet` (`id_outlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kf_rekomendasi_sales`
--
ALTER TABLE `kf_rekomendasi_sales`
  ADD CONSTRAINT `kf_rekomendasi_sales_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kf_rekomendasi_sales_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kg_rekomendasi_tap`
--
ALTER TABLE `kg_rekomendasi_tap`
  ADD CONSTRAINT `kg_rekomendasi_tap_ibfk_1` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kg_rekomendasi_tap_ibfk_2` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `la_score_card`
--
ALTER TABLE `la_score_card`
  ADD CONSTRAINT `la_score_card_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`);

--
-- Constraints for table `mb_merchandising_outlet`
--
ALTER TABLE `mb_merchandising_outlet`
  ADD CONSTRAINT `mb_merchandising_outlet_ibfk_2` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`),
  ADD CONSTRAINT `mb_merchandising_outlet_ibfk_3` FOREIGN KEY (`id_outlet`) REFERENCES `eb_outlet` (`id_outlet`),
  ADD CONSTRAINT `mb_merchandising_outlet_ibfk_4` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `mc_merchandising_sekolah`
--
ALTER TABLE `mc_merchandising_sekolah`
  ADD CONSTRAINT `mc_merchandising_sekolah_ibfk_2` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`),
  ADD CONSTRAINT `mc_merchandising_sekolah_ibfk_3` FOREIGN KEY (`id_sekolah`) REFERENCES `ec_sekolah` (`id_sekolah`);

--
-- Constraints for table `md_merchandising_kampus`
--
ALTER TABLE `md_merchandising_kampus`
  ADD CONSTRAINT `md_merchandising_kampus_ibfk_4` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`),
  ADD CONSTRAINT `md_merchandising_kampus_ibfk_5` FOREIGN KEY (`id_universitas`) REFERENCES `ed_kampus` (`id_universitas`);

--
-- Constraints for table `me_merchandising_fakultas`
--
ALTER TABLE `me_merchandising_fakultas`
  ADD CONSTRAINT `me_merchandising_fakultas_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `ee_fakultas` (`id_fakultas`),
  ADD CONSTRAINT `me_merchandising_fakultas_ibfk_2` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `mf_merchandising_res_regional`
--
ALTER TABLE `mf_merchandising_res_regional`
  ADD CONSTRAINT `mf_merchandising_res_regional_ibfk_3` FOREIGN KEY (`id_regional`) REFERENCES `ba_regional` (`id_regional`),
  ADD CONSTRAINT `mf_merchandising_res_regional_ibfk_4` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`),
  ADD CONSTRAINT `mf_merchandising_res_regional_ibfk_5` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `mg_merchandising_res_branch`
--
ALTER TABLE `mg_merchandising_res_branch`
  ADD CONSTRAINT `mg_merchandising_res_branch_ibfk_1` FOREIGN KEY (`id_branch`) REFERENCES `bb_branch` (`id_branch`),
  ADD CONSTRAINT `mg_merchandising_res_branch_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`),
  ADD CONSTRAINT `mg_merchandising_res_branch_ibfk_3` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `mh_merchandising_res_cluster`
--
ALTER TABLE `mh_merchandising_res_cluster`
  ADD CONSTRAINT `mh_merchandising_res_cluster_ibfk_1` FOREIGN KEY (`id_cluster`) REFERENCES `bc_cluster` (`id_cluster`),
  ADD CONSTRAINT `mh_merchandising_res_cluster_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`),
  ADD CONSTRAINT `mh_merchandising_res_cluster_ibfk_3` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `mi_merchandising_res_tap`
--
ALTER TABLE `mi_merchandising_res_tap`
  ADD CONSTRAINT `mi_merchandising_res_tap_ibfk_4` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`),
  ADD CONSTRAINT `mi_merchandising_res_tap_ibfk_5` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`),
  ADD CONSTRAINT `mi_merchandising_res_tap_ibfk_6` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `mj_merchandising_res_sales`
--
ALTER TABLE `mj_merchandising_res_sales`
  ADD CONSTRAINT `mj_merchandising_res_sales_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`),
  ADD CONSTRAINT `mj_merchandising_res_sales_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`),
  ADD CONSTRAINT `mj_merchandising_res_sales_ibfk_3` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `mk_merchandising_res_kabupaten`
--
ALTER TABLE `mk_merchandising_res_kabupaten`
  ADD CONSTRAINT `mk_merchandising_res_kabupaten_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`),
  ADD CONSTRAINT `mk_merchandising_res_kabupaten_ibfk_3` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`),
  ADD CONSTRAINT `mk_merchandising_res_kabupaten_ibfk_4` FOREIGN KEY (`id_kabupaten`) REFERENCES `cb_kabupaten` (`id_kabupaten`);

--
-- Constraints for table `ml_merchandising_res_kecamatan`
--
ALTER TABLE `ml_merchandising_res_kecamatan`
  ADD CONSTRAINT `ml_merchandising_res_kecamatan_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`),
  ADD CONSTRAINT `ml_merchandising_res_kecamatan_ibfk_3` FOREIGN KEY (`id_jenis_share`) REFERENCES `ma_merchandisng_jenis_share` (`id_jenis_share`),
  ADD CONSTRAINT `ml_merchandising_res_kecamatan_ibfk_4` FOREIGN KEY (`id_kecamatan`) REFERENCES `cc_kecamatan` (`id_kecamatan`);

--
-- Constraints for table `nb_promotion_jenis_weekly`
--
ALTER TABLE `nb_promotion_jenis_weekly`
  ADD CONSTRAINT `nb_promotion_jenis_weekly_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `na_promotion_jenis` (`id_jenis`);

--
-- Constraints for table `nc_promotion_outlet`
--
ALTER TABLE `nc_promotion_outlet`
  ADD CONSTRAINT `nc_promotion_outlet_ibfk_2` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nc_promotion_outlet_ibfk_4` FOREIGN KEY (`id_outlet`) REFERENCES `eb_outlet` (`id_outlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nd_promotion_sekolah`
--
ALTER TABLE `nd_promotion_sekolah`
  ADD CONSTRAINT `nd_promotion_sekolah_FK` FOREIGN KEY (`id_sekolah`) REFERENCES `ec_sekolah` (`id_sekolah`),
  ADD CONSTRAINT `nd_promotion_sekolah_ibfk_2` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ne_promotion_kampus`
--
ALTER TABLE `ne_promotion_kampus`
  ADD CONSTRAINT `ne_promotion_kampus_FK` FOREIGN KEY (`id_universitas`) REFERENCES `ed_kampus` (`id_universitas`),
  ADD CONSTRAINT `ne_promotion_kampus_ibfk_2` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nf_promotion_fakultas`
--
ALTER TABLE `nf_promotion_fakultas`
  ADD CONSTRAINT `nf_promotion_fakultas_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `ee_fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nf_promotion_fakultas_ibfk_2` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nf_promotion_poi`
--
ALTER TABLE `nf_promotion_poi`
  ADD CONSTRAINT `nf_promotion_poi_ibfk_2` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nf_promotion_poi_ibfk_3` FOREIGN KEY (`id_poi`) REFERENCES `ef_poi` (`id_poi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ng_promotion_res_regional`
--
ALTER TABLE `ng_promotion_res_regional`
  ADD CONSTRAINT `ng_promotion_res_regional_ibfk_1` FOREIGN KEY (`id_regional`) REFERENCES `ba_regional` (`id_regional`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ng_promotion_res_regional_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ng_promotion_res_regional_ibfk_3` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nh_promotion_res_branch`
--
ALTER TABLE `nh_promotion_res_branch`
  ADD CONSTRAINT `nh_promotion_res_branch_ibfk_1` FOREIGN KEY (`id_branch`) REFERENCES `bb_branch` (`id_branch`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nh_promotion_res_branch_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nh_promotion_res_branch_ibfk_3` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ni_promotion_res_cluster`
--
ALTER TABLE `ni_promotion_res_cluster`
  ADD CONSTRAINT `ni_promotion_res_cluster_ibfk_1` FOREIGN KEY (`id_cluster`) REFERENCES `bc_cluster` (`id_cluster`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ni_promotion_res_cluster_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ni_promotion_res_cluster_ibfk_3` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nj_promotion_res_tap`
--
ALTER TABLE `nj_promotion_res_tap`
  ADD CONSTRAINT `nj_promotion_res_tap_ibfk_1` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nj_promotion_res_tap_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nj_promotion_res_tap_ibfk_3` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nk_promotion_res_sales`
--
ALTER TABLE `nk_promotion_res_sales`
  ADD CONSTRAINT `nk_promotion_res_sales_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nk_promotion_res_sales_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nk_promotion_res_sales_ibfk_3` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nl_promotion_res_kabupaten`
--
ALTER TABLE `nl_promotion_res_kabupaten`
  ADD CONSTRAINT `nl_promotion_res_kabupaten_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nl_promotion_res_kabupaten_ibfk_3` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nl_promotion_res_kabupaten_ibfk_4` FOREIGN KEY (`id_kabupaten`) REFERENCES `cb_kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nm_promotion_res_kecamatan`
--
ALTER TABLE `nm_promotion_res_kecamatan`
  ADD CONSTRAINT `nm_promotion_res_kecamatan_ibfk_2` FOREIGN KEY (`id_jenis_lokasi`) REFERENCES `ea_jenis_lokasi` (`id_jenis_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nm_promotion_res_kecamatan_ibfk_3` FOREIGN KEY (`id_jenis_weekly`) REFERENCES `nb_promotion_jenis_weekly` (`id_jenis_weekly`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nm_promotion_res_kecamatan_ibfk_4` FOREIGN KEY (`id_kecamatan`) REFERENCES `cc_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ob_market_audit_outlet`
--
ALTER TABLE `ob_market_audit_outlet`
  ADD CONSTRAINT `ob_market_audit_outlet_ibfk_2` FOREIGN KEY (`id_jenis_share`) REFERENCES `oa_market_audit_jenis_share` (`id_jenis_share`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ob_market_audit_outlet_ibfk_4` FOREIGN KEY (`id_history_pjp`) REFERENCES `fc_tracking_sales` (`id_tracking_sales`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oj_market_audit_res_sekolah`
--
ALTER TABLE `oj_market_audit_res_sekolah`
  ADD CONSTRAINT `oj_market_audit_res_sekolah_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `ec_sekolah` (`id_sekolah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oj_market_audit_res_sekolah_ibfk_2` FOREIGN KEY (`id_history_pjp`) REFERENCES `fb_histroy_pjp` (`id_history_pjp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ok_market_audit_res_fakultas`
--
ALTER TABLE `ok_market_audit_res_fakultas`
  ADD CONSTRAINT `ok_market_audit_res_fakultas_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `ee_fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ok_market_audit_res_fakultas_ibfk_2` FOREIGN KEY (`id_history_pjp`) REFERENCES `fb_histroy_pjp` (`id_history_pjp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ol_market_audit_res_kampus`
--
ALTER TABLE `ol_market_audit_res_kampus`
  ADD CONSTRAINT `ol_market_audit_res_kampus_ibfk_1` FOREIGN KEY (`id_universitas`) REFERENCES `ed_kampus` (`id_universitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ol_market_audit_res_kampus_ibfk_2` FOREIGN KEY (`id_history_pjp`) REFERENCES `fb_histroy_pjp` (`id_history_pjp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oz_maket_audit_res_branch`
--
ALTER TABLE `oz_maket_audit_res_branch`
  ADD CONSTRAINT `oz_maket_audit_res_branch_ibfk_1` FOREIGN KEY (`id_branch`) REFERENCES `bb_branch` (`id_branch`),
  ADD CONSTRAINT `oz_maket_audit_res_branch_ibfk_2` FOREIGN KEY (`id_jenis_share`) REFERENCES `oa_market_audit_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `oz_maket_audit_res_cluster`
--
ALTER TABLE `oz_maket_audit_res_cluster`
  ADD CONSTRAINT `oz_maket_audit_res_cluster_ibfk_1` FOREIGN KEY (`id_cluster`) REFERENCES `bc_cluster` (`id_cluster`),
  ADD CONSTRAINT `oz_maket_audit_res_cluster_ibfk_2` FOREIGN KEY (`id_jenis_share`) REFERENCES `oa_market_audit_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `oz_maket_audit_res_kabupaten`
--
ALTER TABLE `oz_maket_audit_res_kabupaten`
  ADD CONSTRAINT `oz_maket_audit_res_kabupaten_ibfk_1` FOREIGN KEY (`id_kabupaten`) REFERENCES `cb_kabupaten` (`id_kabupaten`),
  ADD CONSTRAINT `oz_maket_audit_res_kabupaten_ibfk_2` FOREIGN KEY (`id_jenis_share`) REFERENCES `oa_market_audit_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `oz_maket_audit_res_kecamatan`
--
ALTER TABLE `oz_maket_audit_res_kecamatan`
  ADD CONSTRAINT `oz_maket_audit_res_kecamatan_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `cc_kecamatan` (`id_kecamatan`),
  ADD CONSTRAINT `oz_maket_audit_res_kecamatan_ibfk_2` FOREIGN KEY (`id_jenis_share`) REFERENCES `oa_market_audit_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `oz_maket_audit_res_regional`
--
ALTER TABLE `oz_maket_audit_res_regional`
  ADD CONSTRAINT `oz_maket_audit_res_regional_ibfk_1` FOREIGN KEY (`id_regional`) REFERENCES `ba_regional` (`id_regional`),
  ADD CONSTRAINT `oz_maket_audit_res_regional_ibfk_2` FOREIGN KEY (`id_jenis_share`) REFERENCES `oa_market_audit_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `oz_maket_audit_res_sales`
--
ALTER TABLE `oz_maket_audit_res_sales`
  ADD CONSTRAINT `oz_maket_audit_res_sales_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`),
  ADD CONSTRAINT `oz_maket_audit_res_sales_ibfk_2` FOREIGN KEY (`id_jenis_share`) REFERENCES `oa_market_audit_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `oz_maket_audit_res_tap`
--
ALTER TABLE `oz_maket_audit_res_tap`
  ADD CONSTRAINT `oz_maket_audit_res_tap_ibfk_1` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`),
  ADD CONSTRAINT `oz_maket_audit_res_tap_ibfk_2` FOREIGN KEY (`id_jenis_share`) REFERENCES `oa_market_audit_jenis_share` (`id_jenis_share`);

--
-- Constraints for table `pa_briefing`
--
ALTER TABLE `pa_briefing`
  ADD CONSTRAINT `pa_briefing_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `db_sales` (`id_sales`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `xa_gudang_cluster`
--
ALTER TABLE `xa_gudang_cluster`
  ADD CONSTRAINT `xa_gudang_cluster_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `gb_produk` (`id_produk`),
  ADD CONSTRAINT `xa_gudang_cluster_ibfk_2` FOREIGN KEY (`id_cluster`) REFERENCES `bc_cluster` (`id_cluster`);

--
-- Constraints for table `xb_gudang_tap`
--
ALTER TABLE `xb_gudang_tap`
  ADD CONSTRAINT `xb_gudang_tap_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `gb_produk` (`id_produk`),
  ADD CONSTRAINT `xb_gudang_tap_ibfk_2` FOREIGN KEY (`id_tap`) REFERENCES `bd_tap` (`id_tap`);

--
-- Constraints for table `xc_gudang_available`
--
ALTER TABLE `xc_gudang_available`
  ADD CONSTRAINT `xc_gudang_available_ibfk_1` FOREIGN KEY (`id_cluster`) REFERENCES `bc_cluster` (`id_cluster`),
  ADD CONSTRAINT `xc_gudang_available_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `gb_produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
