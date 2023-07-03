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
											<?php echo $breadcrumb_daftar; ?>
										</h2>
										<div class="panel-toolbar">
											<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
										</div>
									</div>
									<div class="panel-container show">
										<div class="panel-content">

											<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
												<i class="fal fa-search"></i>&nbsp;&nbsp;
												FILTER DATA
											</h5>

											<div class="card mb-3">
												<div class="card-body">
													<div class="form-row">
														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="tgl_awal">Tgl Awal </label>
															<div class="input-group input-group-sm">
																<input type="text" class="form-control form-control-sm datepicker" id="tgl_awal" value="<?php echo date('d/m/Y') ?>">
																<div class="input-group-append">
																	<span class="input-group-text fs-xl">
																		<i class="fal fa-calendar-alt"></i>
																	</span>
																</div>
															</div>
														</div>
														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="tgl_akhir">Tgl Akhir </label>
															<div class="input-group input-group-sm">
																<input type="text" class="form-control form-control-sm datepicker" id="tgl_akhir" value="<?php echo date('d/m/Y') ?>">
																<div class="input-group-append">
																	<span class="input-group-text fs-xl">
																		<i class="fal fa-calendar-alt"></i>
																	</span>
																</div>
															</div>
														</div>
														<div class="col-md-2 col-sm-2 col-xs-12 mt-4">
															<a class="btn btn-sm btn-primary btn-block" href="<?php echo base_url(); ?>data/file/temp/DOWNLOAD_SN_PENJUALAN.xls">
																<i class="fal fa-download"></i>
																Download
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</main>

					<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>

					<script>
						var controls = {
							leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
							rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
            }

						$(document).ready(function()
						{
							$('.datepicker').datepicker(
							{
								orientation: "bottom left",
								todayHighlight: true,
								templates: controls,
								format: "dd/mm/yyyy",
								autoclose: true
							});
						});
					</script>