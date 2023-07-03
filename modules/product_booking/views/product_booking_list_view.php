					<main class="page-content">
						<ol class="breadcrumb page-breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fal fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?><?php echo $modul; ?>"><?php echo $modul_display; ?></a></li>
							<li class="breadcrumb-item active"><?php echo $breadcrumb_daftar; ?></li>
						</ol>

						<div class="row">
							<div class="col-xl-12">
								<div id="panel-1" class="panel">
									<div class="panel-hdr">
										<h2>
											<?php echo $breadcrumb_daftar; ?>
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

											<?php if ($x_input == 1) { ?>


											<?php } else { ?>

											<div style="background-color: #39a1f4;" class="alert bg-info-400 text-white fade show" role="alert">
												<div class="d-flex align-items-center">
													<div class="alert-icon">
														<i class="fal fa-info-square"></i>
													</div>
													<div class="flex-4">
														<span class="h5">Proses distribusi serial number hanya bisa dilakukan antara pukul 08:00 s/d 15:00</span>
													</div>
												</div>
											</div>

											<?php } ?>

											<table id="dt_table_0" class="table table-bordered table-hover w-100">
												<thead class="bg-primary-100">
													<tr>
														<th width="10%">Aksi</th>
														<th>ID Produk (Segel/Inject)</th>
														<th>Nama Produk</th>
														<th>Range Serial Number</th>
														<th>Qty</th>
													</tr>
												</thead>
											</table>

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
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar',
									'type': 'POST'
								},
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							});
						});

						function pilih(id)
						{
							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/form/' + id;
						}
					</script>