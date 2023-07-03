										<script src="<?php echo base_url(); ?>assets/vendor/Highcharts/highcharts.js"></script>
										<script src="<?php echo base_url(); ?>assets/vendor/Highcharts/highcharts-3d.js"></script>
										<script src="<?php echo base_url(); ?>assets/vendor/Highcharts/exporting.js"></script>


										<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
											<li class="nav-item">
												<a class="nav-link fs-xs active" data-toggle="tab" href="#tab_availability" onClick="reload_tab('availability')">
													<i class="fal fa-ballot-check mr-1 text-success"></i>
													AVAILABILITY
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link fs-xs" data-toggle="tab" href="#tab_visibility" onClick="reload_tab('visibility')">
													<i class="fal fa-ballot-check mr-1 text-primary"></i>
													VISIBILITY
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link fs-xs" data-toggle="tab" href="#tab_advokasi" onClick="reload_tab('advokasi')">
													<i class="fal fa-ballot-check mr-1 text-danger"></i>
													ADVOKASI
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link fs-xs" data-toggle="tab" href="#tab_survey" onClick="reload_tab('survey')">
													<i class="fal fa-ballot-check mr-1 text-primary"></i>
													DATA SURVEY
												</a>
											</li>
										</ul>
										<div class="tab-content my-3">
											<div class="tab-pane fade show active" id="tab_availability" role="tabpanel">
												<!-- BEGIN AVAILABILITY -->

												<div id="konten_grafik_availability"></div>

												<!-- END AVAILABILITY -->
											</div>
											<div class="tab-pane fade" id="tab_visibility" role="tabpanel">
												<!-- BEGIN VISIBILITY -->

												<div id="konten_grafik_visibility"></div>

												<!-- END VISIBILITY -->
											</div>
											<div class="tab-pane fade" id="tab_advokasi" role="tabpanel">
												<!-- BEGIN ADVOKASI -->

											<div id="konten_grafik_advokasi"></div>

												<!-- END ADVOKASI -->
											</div>
										</div>

										<input type="hidden" class="" id="x_id_tap" value="<?php echo $id_tap; ?>">
										<input type="hidden" class="" id="x_pilperiode" value="<?php echo $pilperiode; ?>">
										<input type="hidden" class="" id="x_tahun_kuartal" value="<?php echo $tahun_kuartal; ?>">
										<input type="hidden" class="" id="x_bulan_kuartal" value="<?php echo $bulan_kuartal; ?>">
										<input type="hidden" class="" id="x_tahun" value="<?php echo $tahun; ?>">
										<input type="hidden" class="" id="x_bulan" value="<?php echo $bulan; ?>">
										<input type="hidden" class="" id="x_minggu" value="<?php echo $minggu; ?>">
										<input type="hidden" class="" id="x_tab" value="availability">

										<script>
											$(document).ready(function()
											{
												var x_id_tap = $('#x_id_tap').val();
												var x_pilperiode = $('#x_pilperiode').val();
												var x_tahun_kuartal = $('#x_tahun_kuartal').val();
												var x_bulan_kuartal = $('#x_bulan_kuartal').val();
												var x_tahun = $('#x_tahun').val();
												var x_bulan =  $('#x_bulan').val();
												var x_minggu =  $('#x_minggu').val();
												var x_tab =  $('#x_tab').val();

												reload_tab(x_tab);
											});

											function reload_tab(tab)
											{
												$('#x_tab').val(tab);

												var x_id_tap = $('#x_id_tap').val();
												var x_pilperiode = $('#x_pilperiode').val();
												var x_tahun_kuartal = $('#x_tahun_kuartal').val();
												var x_bulan_kuartal = $('#x_bulan_kuartal').val();
												var x_tahun = $('#x_tahun').val();
												var x_bulan =  $('#x_bulan').val();
												var x_minggu =  $('#x_minggu').val();
												var x_tab =  $('#x_tab').val();

												if (x_tab == 'availability')
												{
													$('#konten_grafik_availability').load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_grafik_availability/' +
														x_id_tap + '/' +
														x_pilperiode + '/' +
														x_tahun_kuartal + '/' +
														x_bulan_kuartal + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/'
													);
												}
												else if (x_tab == 'visibility')
												{
													$('#konten_grafik_visibility').load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_grafik_visibility/' +
														x_id_tap + '/' +
														x_pilperiode + '/' +
														x_tahun_kuartal + '/' +
														x_bulan_kuartal + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/'
													);
												}
												else if (x_tab == 'advokasi')
												{
													$('#konten_grafik_advokasi').load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_grafik_advokasi/' +
														x_id_tap + '/' +
														x_pilperiode + '/' +
														x_tahun_kuartal + '/' +
														x_bulan_kuartal + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/'
													);
												}
											}
										</script>