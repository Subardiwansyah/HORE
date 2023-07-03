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
									HASIL SURVEY
								</h2>
						</div>
									
								<div id="panel-1" class="panel">
									<div class="panel-hdr">
										<h2>
											ADVOKASI
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
    														<th>ID Digipos</th>
    														<th>Nama Outlet</th>
    														<th>Parameter</th>
    														<th>Total Ya</th>
    														<th>Total Tidak</th>
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
						});
					</script>