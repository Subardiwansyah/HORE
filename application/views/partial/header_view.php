<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>
			- Hore -
		</title>
		<meta name="description" content="Hore">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="msapplication-tap-highlight" content="no">

		<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/vendors.bundle.css">
		<link id="appbundle" rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/app.bundle.css">
		<link id="myskin" rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/skins/skin-master.css">
		<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/skins/cust-theme-12.css">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>data/img/logo/favicon.png">
		<link rel="shortcut icon" href="#" />
		<link rel="icon" type="image/png" sizes="70x70" href="<?php echo base_url(); ?>data/img/logo/favicon.png">
		<link rel="mask-icon" href="<?php echo base_url(); ?>assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="stylesheet" href="<?=base_url();?>assets/css/datagrid/datatables/datatables.bundle.css"> 
		<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/notifications/toastr/toastr.css">
		<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/formplugins/select2/select2_3_5_4.css">
		<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/formplugins/select2/select2.bundle.css">
		<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css">
		<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/custom.css">
		<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/magnific-popup/magnific-popup.css">

		<script src="<?php echo base_url(); ?>assets/js/jQuery/jquery-2.1.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jQuery/jquery-ui-1.10.3.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/knockout/knockout.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/knockout/knockout.validation.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/magnific-popup/jquery.magnific-popup.js"></script>
		<script type="text/javascript">
			GLOBAL_MAIN_VARS = new Array ();
			GLOBAL_MAIN_VARS['BASE_URL']	= '<?php echo base_url(); ?>';
			GLOBAL_MAIN_VARS['ID_LEVEL']	= '<?php echo $this->session->userdata('ID_LEVEL'); ?>';
			GLOBAL_MAIN_VARS['ID_DIVISI']	= '<?php echo $this->session->userdata('ID_DIVISI'); ?>';
			GLOBAL_MAIN_VARS['ID_USER']	= '<?php echo $this->session->userdata('ID_USER'); ?>';
			GLOBAL_MAIN_VARS['LOGGED_IN']	= '<?php echo $this->session->userdata('logged_in'); ?>';
			GLOBAL_MAIN_VARS['MODUL']	= '<?php echo isset($modul) ? $modul : ''; ?>';
		</script>
	</head>

	<body class="mod-bg-1 ">
		<script>
			'use strict';

			var classHolder = document.getElementsByTagName("BODY")[0],
			themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {},
			themeURL = themeSettings.themeURL || '',
			themeOptions = themeSettings.themeOptions || '';

			if (themeSettings.themeOptions)
			{
				classHolder.className = themeSettings.themeOptions;
			}
			else
			{
				classHolder.className = 'mod-bg-1 mod-nav-link header-function-fixed nav-function-fixed';
			}

			if (themeSettings.themeURL && !document.getElementById('mytheme'))
			{
				var cssfile = document.createElement('link');
				cssfile.id = 'mytheme';
				cssfile.rel = 'stylesheet';
				cssfile.href = themeURL;
				document.getElementsByTagName('head')[0].appendChild(cssfile);
			}
			else if (themeSettings.themeURL && document.getElementById('mytheme'))
			{
				document.getElementById('mytheme').href = themeSettings.themeURL;
			}
		</script>

		<div class="page-wrapper">
			<div class="page-inner">
				<aside class="page-sidebar" style="background-image: url(<?php echo base_url(); ?>data/img/bg/page-sidebar-img.png)">
					<div class="page-logo-off">
						<img style="width:270px;" src="<?php echo base_url(); ?>data/img/bg/logo-img.png" class="logo">
					</div>
					<nav id="js-primary-nav" class="primary-nav" role="navigation">
					<div class="info-card">
						<img src="<?php echo base_url(); ?>data/img/logo/favicon.png" class="profile-image rounded-circle">
							<?php
							if($this->session->userdata('ID_LEVEL') == '1' || $this->session->userdata('ID_LEVEL') == '2' ||
									$this->session->userdata('ID_LEVEL') == '3' || $this->session->userdata('ID_LEVEL') == '4' ||
									$this->session->userdata('ID_LEVEL') == '9')
							{
								if($this->session->userdata('ID_LEVEL') == '1')
								{
									$ntabel = 'ba_regional';
									$nkolom = 'nama_regional';
									$nfk = 'id_regional';
								}
								else if($this->session->userdata('ID_LEVEL') == '2')
								{
									$ntabel = 'bb_branch';
									$nkolom = 'nama_branch';
									$nfk = 'id_branch';
								}
								else if($this->session->userdata('ID_LEVEL') == '3')
								{
									$ntabel = 'bc_cluster';
									$nkolom = 'nama_cluster';
									$nfk = 'id_cluster';
								}
								else if($this->session->userdata('ID_LEVEL') == '4' || $this->session->userdata('ID_LEVEL') == '9')
								{
									$ntabel = 'bd_tap';
									$nkolom = 'nama_tap';
									$nfk = 'id_tap';
								}

								$nquery_1 = $this->db->query("SELECT b.$nkolom as nama_user
																							FROM ab_users a, $ntabel b
																							WHERE a.id_divisi = b.$nfk
																									AND a.id_divisi = '".$this->session->userdata('ID_DIVISI')."'");
								foreach ($nquery_1->result_array() as $nrow_1)
								{
									$nama_user = $nrow_1['nama_user'];
								}
							}
					?>

					<div class="info-card-text">
						<a href="#" class="d-flex align-items-center text-white">
							<span class="text-truncate text-truncate-sm d-inline-block">
								<b><?php echo $this->session->userdata('ID_USER');?></b>
							</span>
						</a>
						<span class="d-inline-block text-truncate"><b><?php echo $nama_user;?></b></span>
					</div>
					<img src="<?php echo base_url(); ?>data/img/bg/card-cover-img.png" class="cover">
					<a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
						<i class="fal fa-angle-down"></i>
					</a>
				</div>

						<ul id="js-nav-menu" class="nav-menu">

							<!-- MENU COVERAGE -->
							<!-- BEGIN MENU COVERAGE -->

							<?php $list_coverage = array(
								'dashboard_coverage',
								'lokasi_outlet',
								'lokasi_sekolah',
								'lokasi_kampus',
								'lokasi_fakultas',
								'lokasi_poi',
								'pjp_setting',
								'pjp_tracking'
							); ?>
							<?php $list_lokasi = array(
								'lokasi_outlet',
								'lokasi_sekolah',
								'lokasi_kampus',
								'lokasi_fakultas',
								'lokasi_poi'
							); ?>
							<?php $list_pjp = array(
								'pjp_setting',
								'pjp_tracking'
							); ?>

							<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3, 4))) { ?>
							<li <?php if (in_array($this->router->fetch_class(), $list_coverage)) { echo 'class="active open"'; } ?>>
								<a href="javascript:void(0)" title="Coverage">
									<i class="fal fa-search-location"></i>
									<span class="nav-link-text">Coverage</span>
								</a>
								<ul>
									<li <?php if ($this->router->fetch_class() == 'dashboard_coverage') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>dashboard_coverage" title="Dashboard">
											<span class="nav-link-text">Dashboard</span>
										</a>
									</li>
									<li <?php if (in_array($this->router->fetch_class(), $list_lokasi)) { echo 'class="active open"'; } ?>>
										<a href="javascript:void(0);" title="Lokasi">
											<span class="nav-link-text">Lokasi</span>
										</a>
										<ul>
											<li <?php if ($this->router->fetch_class() == 'lokasi_outlet') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>lokasi_outlet" title="Outlet">
													<span class="nav-link-text">Outlet</span>
												</a>
											</li>
											<li <?php if ($this->router->fetch_class() == 'lokasi_sekolah') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>lokasi_sekolah" title="Sekolah">
													<span class="nav-link-text">Sekolah</span>
												</a>
											</li>
											<li <?php if ($this->router->fetch_class() == 'lokasi_kampus') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>lokasi_kampus" title="Kampus">
													<span class="nav-link-text">Kampus</span>
												</a>
											</li>
											<li <?php if ($this->router->fetch_class() == 'lokasi_fakultas') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>lokasi_fakultas" title="Fakultas">
													<span class="nav-link-text">Fakultas</span>
												</a>
											</li>
											<li <?php if ($this->router->fetch_class() == 'lokasi_poi') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>lokasi_poi" title="POI">
													<span class="nav-link-text">POI</span>
												</a>
											</li>
										</ul>
									</li>
									<li <?php if (in_array($this->router->fetch_class(), $list_pjp)) { echo 'class="active open"'; } ?>>
										<a href="javascript:void(0);" title="PJP">
											<span class="nav-link-text">PJP</span>
										</a>
										<ul>
											<li <?php if ($this->router->fetch_class() == 'pjp_setting') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>pjp_setting" title="Setting PJP">
													<span class="nav-link-text">Setting PJP</span>
												</a>
											</li>
											<li <?php if ($this->router->fetch_class() == 'pjp_tracking') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>pjp_tracking" title="Tracking PJP">
													<span class="nav-link-text">Tracking PJP</span>
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<?php } ?>
							<!-- END MENU COVERAGE -->


							<!-- DISTRIBUSI -->
							<!-- BEGIN MENU DISTRIBUSI -->

							<?php $list_distribusi = array(
								'dashboard_distribusi',
								'gudang_segel_branch',
								'gudang_segel_cluster',
								'proses_inject',
								'product_booking',
								'topup_la',
								'distribusi_sales',
								'resume_gudang',
								'history_order',
								'rekomendasi_distribusi',
								'target_sales',
								'score_card',
								'report_penjualan',
								'penjualan_download_sn',
								'retur_sales',
								'retur_report',
								'check_sn'
							); ?>
							<?php $list_gudang = array(
								'gudang_segel_branch',
								'gudang_segel_cluster',
								'proses_inject',
								'product_booking',
								'topup_la',
								'distribusi_sales',
								'resume_gudang'
							); ?>
							<?php $list_penjualan = array('report_penjualan','penjualan_download_sn'); ?>
							<?php $list_check_sn = array('check_sn'); ?>
							<?php $list_retur = array('retur_sales', 'retur_report'); ?>
							<?php $list_merchandising = array('merchandising_outlet', 'merchandising_sekolah'); ?>

							<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3, 4))) { ?>
							<li <?php if (in_array($this->router->fetch_class(), $list_distribusi)) { echo 'class="active open"'; } ?>>
								<a href="javascript:void(0)" title="Distribution">
									<i class="fal fa-luggage-cart"></i>
									<span class="nav-link-text">Distribution</span>
								</a>
								<ul>
									<li <?php if ($this->router->fetch_class() == 'dashboard_distribusi') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>dashboard_distribusi" title="Dashboard">
											<span class="nav-link-text">Dashboard</span>
										</a>
									</li>
									<li <?php if (in_array($this->router->fetch_class(), $list_gudang)) { echo 'class="active open"'; } ?>>
										<a href="javascript:void(0)" title="Gudang">
											<span class="nav-link-text">Gudang</span>
										</a>
										<ul>
											<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1, 2))) { ?>
											<li <?php if ($this->router->fetch_class() == 'gudang_segel_branch') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>gudang_segel_branch" title="Gudang Segel">
													<span class="nav-link-text">Gudang Segel</span>
												</a>
											</li>
											<?php } ?>
											<?php if (in_array($this->session->userdata('ID_LEVEL'), array(3))) { ?>
											<li <?php if ($this->router->fetch_class() == 'gudang_segel_cluster') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>gudang_segel_cluster" title="Gudang Segel">
													<span class="nav-link-text">Gudang Segel</span>
												</a>
											</li>
											<?php } ?>
											<?php if (in_array($this->session->userdata('ID_LEVEL'), array(4))) { ?>
											<li <?php if ($this->router->fetch_class() == 'proses_inject') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>proses_inject" title="Proses Inject">
													<span class="nav-link-text">Proses Inject</span>
												</a>
											</li>
											<?php } ?>
											<?php if (in_array($this->session->userdata('ID_LEVEL'), array(4))) { ?>
											<li <?php if ($this->router->fetch_class() == 'product_booking') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>product_booking" title="Product Booking">
													<span class="nav-link-text">Product Booking</span>
												</a>
											</li>
											<?php } ?>
											<?php if (in_array($this->session->userdata('ID_LEVEL'), array(4))) { ?>
											<li <?php if ($this->router->fetch_class() == 'topup_la') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>topup_la" title="Top Up LA">
													<span class="nav-link-text">Top Up LA</span>
												</a>
											</li>
											<?php } ?>
											<?php if (in_array($this->session->userdata('ID_LEVEL'), array(4))) { ?>
											<li <?php if ($this->router->fetch_class() == 'distribusi_sales') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>distribusi_sales" title="Distribusi Sales">
													<span class="nav-link-text">Distribusi Sales</span>
												</a>
											</li>
											<?php } ?>
										</ul>
									</li>
									<li <?php if ($this->router->fetch_class() == 'history_order') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>history_order" title="History Order">
											<span class="nav-link-text">History Order</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'rekomendasi_distribusi') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>rekomendasi_distribusi" title="Rekomendasi Distribusi">
											<span class="nav-link-text">Rekomendasi Distribusi</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'target_sales') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>target_sales" title="Target Sales">
											<span class="nav-link-text">Target Sales</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'score_card') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>score_card" title="Score Card">
											<span class="nav-link-text">Score Card</span>
										</a>
									</li>

									<?php if (in_array($this->session->userdata('ID_LEVEL'), array(4))) { ?>
									<li <?php if ($this->router->fetch_class() == 'retur_sales') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>retur_sales" title="Retur">
											<span class="nav-link-text">Retur</span>
										</a>
									</li>
									<?php } ?>

									<?php if (in_array($this->session->userdata('ID_LEVEL'), array(4))) { ?>
									<li <?php if ($this->router->fetch_class() == 'retur_report') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>retur_report" title="Report Retur">
											<span class="nav-link-text">Report Retur</span>
										</a>
									</li>
									<?php } ?>


									<li <?php if ($this->router->fetch_class() == 'check_sn') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>check_sn" title="Check Serial Number">
											<span class="nav-link-text">Check Serial Number</span>
										</a>
									</li>
								</ul>
							</li>
							<?php } ?>
							<!-- END MENU DISTRIBUSI -->


							<!-- MERCHANDISING -->
							<!-- BEGIN MENU MERCHANDISING -->

							<?php $list_merchandising = array(
								'dashboard_merchandising',
								'merchandising',
							); ?>

							<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3, 4))) { ?>
							<li <?php if (in_array($this->router->fetch_class(), $list_merchandising)) { echo 'class="active open"'; } ?>>
								<a href="javascript:void(0)" title="Merchandising">
									<i class="fal fa-cubes"></i>
									<span class="nav-link-text">Merchandising</span>
								</a>
								<ul>
									<li <?php if ($this->router->fetch_class() == 'dashboard_merchandising') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>dashboard_merchandising" title="Dashboard">
											<span class="nav-link-text">Dashboard</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'merchandising') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>merchandising" title="Share">
											<span class="nav-link-text">Share</span>
										</a>
									</li>
								</ul>
							</li>
							<?php } ?>
							<!-- END MENU MERCHANDISING -->


							<!-- PROMOTION -->
							<!-- BEGIN MENU PROMOTION -->

							<?php $list_promotion = array(
								'dashboard_promotion',
								'program',
								'promotion'
							); ?>

							<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3, 4))) { ?>
							<li <?php if (in_array($this->router->fetch_class(), $list_promotion)) { echo 'class="active open"'; } ?>>
								<a href="javascript:void(0)" title="Promotion">
									<i class="fal fa-bullhorn"></i>
									<span class="nav-link-text">Promotion</span>
								</a>
								<ul>
									<li <?php if ($this->router->fetch_class() == 'dashboard_promotion') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>dashboard_promotion" title="Dasbhoard">
											<span class="nav-link-text">Dasbhoard</span>
										</a>
									</li>
									<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1))) { ?>
									<li <?php if ($this->router->fetch_class() == 'program') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>program" title="Program">
											<span class="nav-link-text">Entry Program</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'promotion') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>promotion" title="Merchandising Sekolah">
											<span class="nav-link-text">List Promotion</span>
										</a>
									</li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<!-- END MENU PROMOTION -->


							<!-- MARKET AUDIT -->
							<!-- BEGIN MENU MARKET AUDIT -->

							<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3, 4))) { ?>
							<li <?php if ($this->router->fetch_class() == 'market_audit') { echo 'class="active"'; } ?>>
								<a href="<?php echo base_url(); ?>market_audit" title="Market Audit">
									<i class="fal fa-money-check-edit-alt"></i>
									<span class="nav-link-text">Market Audit</span>
								</a>
							</li>
							<?php } ?>
							<!-- END MENU MARKET AUDIT -->


							<!-- CDMP CONTROLLER -->
							<!-- BEGIN MENU CDMP CONTROLLER -->

							<?php $list_cdmp_controller = array(
								'briefing_sales',
								'margin_penjualan',
								'tendem_selling',
								'back_checking',
								'voice_of_reseller',
								'kpi_ava'
							); ?>

							<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3, 4))) { ?>
							<li <?php if (in_array($this->router->fetch_class(), $list_cdmp_controller)) { echo 'class="active open"'; } ?>>
								<a href="javascript:void(0)" title="CDMP Controller">
									<i class="fal fa-user-chart"></i>
									<span class="nav-link-text">CDMP Controller</span>
								</a>
								<ul>
									<li <?php if ($this->router->fetch_class() == 'briefing_sales') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>briefing_sales" title="Briefing Sales">
											<span class="nav-link-text">Briefing Sales</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'margin_penjualan') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>margin_penjualan" title="Margin">
											<span class="nav-link-text">Margin</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'tendem_selling') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>tendem_selling" title="Tendem Selling">
											<span class="nav-link-text">Tendem Selling</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'back_checking') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>back_checking" title="Back Checking">
											<span class="nav-link-text">Back Checking</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'voice_of_reseller') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>voice_of_reseller" title="Voice Of Reseller">
											<span class="nav-link-text">Voice Of Reseller</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'kpi_ava') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>kpi_ava" title="KPI AVA">
											<span class="nav-link-text">KPI AVA</span>
										</a>
									</li>
								</ul>
							</li>
							<?php } ?>
							<!-- END MENU CDMP CONTROLLER -->


							<!-- CASHIER -->
							<!-- BEGIN MENU CASHIER -->

							<?php $list_cashier = array(
								'daftar_penjualan',
								'stok_perdana',
								'daftar_setoran',
								'tren_penjualan'
							); ?>

							<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3, 4, 9))) { ?>
							<li <?php if (in_array($this->router->fetch_class(), $list_cashier)) { echo 'class="active open"'; } ?>>
								<a href="javascript:void(0)" title="Cashier">
									<i class="fal fa-money-check-alt"></i>
									<span class="nav-link-text">Cashier</span>
								</a>
								<ul>
									<li <?php if ($this->router->fetch_class() == 'daftar_penjualan') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>daftar_penjualan" title="Daftar Penjualan">
											<span class="nav-link-text">Daftar Penjualan</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'stok_perdana') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>stok_perdana" title="Stok Perdana">
											<span class="nav-link-text">Stok Perdana</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'daftar_setoran') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>daftar_setoran" title="Daftar Setoran">
											<span class="nav-link-text">Daftar Setoran</span>
										</a>
									</li>
								</ul>
							</li>
							<?php } ?>
							<!-- END MENU CASHIER -->


							<!-- CHECK SERIAL NUMBER -->
							<!-- BEGIN MENU CHECK SERIAL NUMBER -->

							<?php if (in_array($this->session->userdata('ID_LEVEL'), array(9))) { ?>
							<li <?php if ($this->router->fetch_class() == 'check_sn') { echo 'class="active"'; } ?>>
								<a href="<?php echo base_url(); ?>check_sn" title="Check Serial Number">
									<i class="fal fa-barcode-read"></i>
									<span class="nav-link-text">Check Serial Number</span>
								</a>
							</li>
							<?php } ?>
							<!-- END MENU CHECK SERIAL NUMBER -->


							<!-- MASTER DATA -->
							<!-- BEGIN MENU MASTER DATA -->

							<?php $list_master = array(
								'sales_sales_force', 'sales_channel_support', 'sales_direct_sales',
								'produk_segel', 'produk_inject',
								'setting_radius',
								'download_master'
							); ?>
							<?php $list_sales = array('sales_sales_force', 'sales_channel_support', 'sales_direct_sales'); ?>
							<?php $list_produk = array('produk_segel', 'produk_inject'); ?>

							<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3, 4))) { ?>
							<li <?php if (in_array($this->router->fetch_class(), $list_master)) { echo 'class="active open"'; } ?>>
								<a href="javascript:void(0)" title="Master Data">
									<i class="fal fa-list-alt"></i>
									<span class="nav-link-text">Master Data</span>
								</a>
								<ul>
									<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
									<li <?php if (in_array($this->router->fetch_class(), $list_sales)) { echo 'class="active open"'; } ?>>
										<a href="javascript:void(0)" title="Sales">
											<span class="nav-link-text">Sales</span>
										</a>
										<ul>
											<li <?php if ($this->router->fetch_class() == 'sales_sales_force') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>sales_sales_force" title="Sales Force">
													<span class="nav-link-text">Sales Force</span>
												</a>
											</li>
											<li <?php if ($this->router->fetch_class() == 'sales_channel_support') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>sales_channel_support" title="Channel Support">
													<span class="nav-link-text">Channel Support</span>
												</a>
											</li>
											<li <?php if ($this->router->fetch_class() == 'sales_direct_sales') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>sales_direct_sales" title="Direct Sales">
													<span class="nav-link-text">Direct Sales</span>
												</a>
											</li>
										</ul>
									</li>
									<?php } ?>
									<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1))) { ?>
									<li <?php if (in_array($this->router->fetch_class(), $list_produk)) { echo 'class="active open"'; } ?>>
										<a href="javascript:void(0)" title="Produk">
											<span class="nav-link-text">Produk</span>
										</a>
										<ul>
											<li <?php if ($this->router->fetch_class() == 'produk_segel') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>produk_segel" title="Segel">
													<span class="nav-link-text">Segel</span>
												</a>
											</li>
											<li <?php if ($this->router->fetch_class() == 'produk_inject') { echo 'class="active"'; } ?>>
												<a href="<?php echo base_url(); ?>produk_inject" title="Inject">
													<span class="nav-link-text">Inject</span>
												</a>
											</li>
										</ul>
									</li>
									<?php } ?>
									<li <?php if ($this->router->fetch_class() == 'setting_radius') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>setting_radius" title="Setting Radius">
											<span class="nav-link-text">Setting Radius</span>
										</a>
									</li>
									<li <?php if ($this->router->fetch_class() == 'download_master') { echo 'class="active"'; } ?>>
										<a href="<?php echo base_url(); ?>download_master" title="Download Master">
											<span class="nav-link-text">Download Master</span>
										</a>
									</li>
								</ul>
							</li>
							<?php } ?>
							<!-- END MENU MASTER DATA -->


							<!-- VIDEO TUTORIAL -->
							<!-- BEGIN MENU VIDEO TUTORIAL -->

							<?php if (in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3, 4))) { ?>
							<li <?php if ($this->router->fetch_class() == 'video_tutorial') { echo 'class="active"'; } ?>>
								<a href="<?php echo base_url(); ?>video_tutorial" title="Video Tutorial">
									<i class="fal fa-video"></i>
									<span class="nav-link-text">Video Tutorial</span>
								</a>
							</li>
							<?php } ?>
							<!-- END MENU VIDEO TUTORIAL -->

						</ul>
					</nav>
				</aside>

				<div class="page-content-wrapper">
					<header class="page-header" role="banner">
						<div class="hidden-md-down dropdown-icon-menu position-relative">
							<a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
								<i class="ni ni-menu"></i>
							</a>
						</div>

						<div class="hidden-lg-up">
							<a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
								<i class="ni ni-menu"></i>
							</a>
						</div>

						<div class="ml-auto d-flex">
							<div class="hidden-md-down-xs">
								<a href="<?php echo base_url(); ?>login/do_logout" class="btn btn-outline-default">
									<i class="fal fa-sign-out"></i> Logout
								</a>
							</div>
						</div>
					</header>