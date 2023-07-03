					<main class="page-content">
						<ol class="breadcrumb page-breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fal fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?><?php echo $modul; ?>"><?php echo $modul_display; ?></a></li>
							<li class="breadcrumb-item active"><?php echo $breadcrumb_daftar; ?></li>
						</ol>

						<div class="row">
							<div class="col-xl-12">
								<div id="panel-0" class="panel">
									<div class="panel-hdr">
										<h2>
											MASTER
										</h2>
										<!--
										<div class="panel-toolbar">
											<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
										</div> 
										-->
									</div>
									<div class="panel-container show">
										<div class="panel-content">
										    <div class = "table-responsive">
    											<table id="dt_table_0" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    												<thead class="bg-primary-100">
    													<tr>
    														<th width="5%">No</th>
    														<th>Keterangan</th>
    														<th width="25%">File</th>
    													</tr>
    												</thead>
    												<tbody>
    													<?php $no = 1; ?>
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Branch</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/branch"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Cluster</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/cluster"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3, 4))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Tap</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/tap"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Sales Force</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/salesforce"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Direct Sales</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/directsales"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Channel Support</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/channelsupport"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>
 														<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Outlet</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/outlet"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>   													
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master User Management</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/usermanagement"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Kabupaten</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/kabupaten"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Kecamatan</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/kecamatan"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Kelurahan</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/kelurahan"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Jenjang Sekolah</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/jenjang"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>
    													<?php if(in_array($this->session->userdata('ID_LEVEL'), array(1, 2, 3))) { ?>
    													<tr>
    														<td align="center"><?php echo $no; $no ++; ?></td>
    														<td>Master Universitas</td>
    														<td><center><a href="<?php echo base_url(); ?><?php echo $modul; ?>/download/Universitas"><i class="fal fa-download"></i> Download</a><center></td>
    													</tr>
    													<?php } ?>


    												</tbody>
    											</table>
    										</div>
										</div>
									</div>
								</div>

								<div id="panel-1" class="panel">
									<div class="panel-hdr">
										<h2>
											BRANCH
										</h2>
										<!--
										<div class="panel-toolbar">
											<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
										</div>
										-->
									</div>
									<div class="panel-container show">
										<div class="panel-content">
										    <div class = "table-responsive">
    											<table id="dt_table_1" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    												<thead class="bg-primary-100">
    													<tr>
    														<th width="5%">NO</th>
    														<th>ID Branch</th>
    														<th>Branch</th>
    													</tr>
    												</thead>
    											</table>
    										</div>
										</div>
									</div>
								</div>

								<div id="panel-2" class="panel">
									<div class="panel-hdr">
										<h2>
											CLUSTER
										</h2>
										<!--
										<div class="panel-toolbar">
											<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
										</div>
										-->
									</div>
									<div class="panel-container show">
										<div class="panel-content">
										    <div class = "table-responsive">
    											<table id="dt_table_2" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    												<thead class="bg-primary-100">
    													<tr>
    														<th width="5%">NO</th>
    														<th>ID Cluster</th>
    														<th>Cluster</th>
    														<th>Mitra AD</th>
    														<th>Branch</th>
    													</tr>
    												</thead>
    											</table>
    										</div>
										</div>
									</div>
								</div>

								<div id="panel-3" class="panel">
									<div class="panel-hdr">
										<h2>
											TAP
										</h2>
										<!--
										<div class="panel-toolbar">
											<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
										</div>
										-->
									</div>
									<div class="panel-container show">
										<div class="panel-content">
										    <div class = "table-responsive">
    											<table id="dt_table_3" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    												<thead class="bg-primary-100">
    													<tr>
    														<th width="5%">NO</th>
    														<th>ID Tap</th>
    														<th>Tap</th>
    														<th>Manager</th>
    														<th>Cluster</th>
    														<th>Branch</th>
    													</tr>
    												</thead>
    											</table>
    										</div>
										</div>
									</div>
								</div>

								<div id="panel-4" class="panel">
									<div class="panel-hdr">
										<h2>
											SALESFORCE
										</h2>
										<!--
										<div class="panel-toolbar">
											<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
										</div>
										-->
									</div>
									<div class="panel-container show">
										<div class="panel-content">
										    <div class = "table-responsive">
    											<table id="dt_table_4" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    												<thead class="bg-primary-100">
    													<tr>
    														<th width="5%">NO</th>
    														<th>ID SALES</th>
    														<th>Nama Sales</th>
    														<th>ID TAP</th>
    														<th>Nama TAP</th>
    														<th>ID Cluster</th>
    														<th>ID Branch</th>
    													</tr>
    												</thead>
    											</table>
    										</div>
										</div>
									</div>
								</div>

								<div id="panel-5" class="panel">
									<div class="panel-hdr">
										<h2>
											DIRECT SALES
										</h2>
										<!--
										<div class="panel-toolbar">
											<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
										</div>
										-->
									</div>
									<div class="panel-container show">
										<div class="panel-content">
										    <div class = "table-responsive">
    											<table id="dt_table_5" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    												<thead class="bg-primary-100">
    													<tr>
    														<th width="5%">NO</th>
    														<th>ID SALES</th>
    														<th>Nama Sales</th>
    														<th>ID TAP</th>
    														<th>Nama TAP</th>
    														<th>ID Cluster</th>
    														<th>ID Branch</th>
    													</tr>
    												</thead>
    											</table>
    										</div>
										</div>
									</div>
								</div>



							</div>
						</div>
					</main>

					<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>

					<script>
						$(document).ready(function()
						{
							$('#dt_table_0').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								colReorder: true,
								ordering: false
							});

							$('#dt_table_1').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar',
									'type': 'POST'
								},
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							});

							$('#dt_table_2').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_2',
									'type': 'POST'
								},
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							});

							$('#dt_table_3').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_3',
									'type': 'POST'
								},
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							});

							$('#dt_table_4').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_4',
									'type': 'POST'
								},
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							});

							$('#dt_table_5').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_5',
									'type': 'POST'
								},
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							});


						});
					</script>