											<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
												<li class="nav-item">
													<a class="nav-link fs-xs active" data-toggle="tab" href="#tab_out" onClick="reload_tab('out')">
														<i class="fal fa-map-marker-alt mr-1 text-success"></i>
														OUTLET
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_sek" onClick="reload_tab('sek')">
														<i class="fal fa-map-marker-alt mr-1 text-warning"></i>
														SEKOLAH
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_kam" onClick="reload_tab('kam')">
														<i class="fal fa-map-marker-alt mr-1 text-danger"></i>
														KAMPUS
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_fak" onClick="reload_tab('fak')">
														<i class="fal fa-map-marker-alt mr-1 text-info"></i>
														FAKULTAS
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_poi" onClick="reload_tab('poi')">
														<i class="fal fa-map-marker-alt mr-1 text-secondary"></i>
														POI
													</a>
												</li>
											</ul>
											<div class="tab-content my-3">
												<div class="tab-pane fade show active" id="tab_out" role="tabpanel">
													<!-- BEGIN OUTLET -->

													<div id="konten_tbl_regional_out" class="konten_tbl_regional"></div>
													<div id="konten_tbl_branch_out" class="konten_tbl_branch"></div>
													<div id="konten_tbl_cluster_out" class="konten_tbl_cluster"></div>
													<div id="konten_tbl_kabupaten_out" class="konten_tbl_kabupaten"></div>
													<div id="konten_tbl_kecamatan_out" class="konten_tbl_kecamatan"></div>
													<div id="konten_tbl_tap_out" class="konten_tbl_tap"></div>
													<div id="konten_tbl_sales_out" class="konten_tbl_sales"></div>

													<!-- END OUTLET -->
												</div>
												<div class="tab-pane fade" id="tab_sek" role="tabpanel">
													<!-- BEGIN SEKOLAH -->

													<div id="konten_tbl_regional_sek" class="konten_tbl_regional"></div>
													<div id="konten_tbl_branch_sek" class="konten_tbl_branch"></div>
													<div id="konten_tbl_cluster_sek" class="konten_tbl_cluster"></div>
													<div id="konten_tbl_kabupaten_sek" class="konten_tbl_kabupaten"></div>
													<div id="konten_tbl_kecamatan_sek" class="konten_tbl_kecamatan"></div>
													<div id="konten_tbl_tap_sek" class="konten_tbl_tap"></div>
													<div id="konten_tbl_sales_sek" class="konten_tbl_sales"></div>

													<!-- END SEKOLAH -->
												</div>
												<div class="tab-pane fade" id="tab_kam" role="tabpanel">
													<!-- BEGIN KAMPUS -->

													<div id="konten_tbl_regional_kam" class="konten_tbl_regional"></div>
													<div id="konten_tbl_branch_kam" class="konten_tbl_branch"></div>
													<div id="konten_tbl_cluster_kam" class="konten_tbl_cluster"></div>
													<div id="konten_tbl_kabupaten_kam" class="konten_tbl_kabupaten"></div>
													<div id="konten_tbl_kecamatan_kam" class="konten_tbl_kecamatan"></div>
													<div id="konten_tbl_tap_kam" class="konten_tbl_tap"></div>
													<div id="konten_tbl_sales_kam" class="konten_tbl_sales"></div>

													<!-- END KAMPUS -->
												</div>
												<div class="tab-pane fade" id="tab_fak" role="tabpanel">
													<!-- BEGIN FAKULTAS -->

													<div id="konten_tbl_regional_fak" class="konten_tbl_regional"></div>
													<div id="konten_tbl_branch_fak" class="konten_tbl_branch"></div>
													<div id="konten_tbl_cluster_fak" class="konten_tbl_cluster"></div>
													<div id="konten_tbl_kabupaten_fak" class="konten_tbl_kabupaten"></div>
													<div id="konten_tbl_kecamatan_fak" class="konten_tbl_kecamatan"></div>
													<div id="konten_tbl_tap_fak" class="konten_tbl_tap"></div>
													<div id="konten_tbl_sales_fak" class="konten_tbl_sales"></div>

													<!-- END FAKULTAS -->
												</div>
												<div class="tab-pane fade" id="tab_poi" role="tabpanel">
													<!-- BEGIN FAKULTAS -->

													<div id="konten_tbl_regional_poi" class="konten_tbl_regional"></div>
													<div id="konten_tbl_branch_poi" class="konten_tbl_branch"></div>
													<div id="konten_tbl_cluster_poi" class="konten_tbl_cluster"></div>
													<div id="konten_tbl_kabupaten_poi" class="konten_tbl_kabupaten"></div>
													<div id="konten_tbl_kecamatan_poi" class="konten_tbl_kecamatan"></div>
													<div id="konten_tbl_tap_poi" class="konten_tbl_tap"></div>
													<div id="konten_tbl_sales_poi" class="konten_tbl_sales"></div>

													<!-- END FAKULTAS -->
												</div>

											</div>

											<input type="hidden" class="" id="x_kategori" value="<?php echo $kategori; ?>">
											<input type="hidden" class="" id="x_pilihan" value="<?php echo $pilihan; ?>">
											<input type="hidden" class="" id="x_tahun" value="<?php echo $tahun; ?>">
											<input type="hidden" class="" id="x_bulan" value="<?php echo $bulan; ?>">
											<input type="hidden" class="" id="x_minggu" value="<?php echo $minggu; ?>">
											<input type="hidden" class="" id="x_jenis_lokasi" value="<?php echo $jenis_lokasi; ?>">

											<script>
												$(document).ready(function()
												{
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_lokasi =  $('#x_jenis_lokasi').val();

													reload_tab(x_jenis_lokasi);
												});

												function reload_tab(lokasi){
													// $('.konten_tbl_regional').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_branch').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_cluster').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_kabupaten').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_kecamatan').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_tap').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_sales').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													$('#x_jenis_lokasi').val(lokasi);

													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_lokasi =  $('#x_jenis_lokasi').val();

													if (x_kategori == 'Branch')
													{
														reload_tbl_regional();
														reload_tbl_branch();
														reload_tbl_cluster();
														reload_tbl_kabupaten();
														reload_tbl_kecamatan();
														reload_tbl_tap();
														reload_tbl_sales();
													}
													else if (x_kategori == 'Cluster')
													{
														reload_tbl_cluster();
														reload_tbl_kabupaten();
														reload_tbl_kecamatan();
														reload_tbl_tap();
														reload_tbl_sales();
													}
													else if (x_kategori == 'TAP')
													{
														reload_tbl_tap();
														reload_tbl_sales();
													}
												}

												function reload_tbl_regional(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_lokasi =  $('#x_jenis_lokasi').val();

													$('.konten_tbl_regional').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_regional_'+x_jenis_lokasi).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_regional/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/'
														);
													}, 500);
												}

												function reload_tbl_branch(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_lokasi =  $('#x_jenis_lokasi').val();

													$('.konten_tbl_branch').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_branch_'+x_jenis_lokasi).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_branch/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/'
														);
													}, 500);
												}

												function reload_tbl_cluster(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_lokasi =  $('#x_jenis_lokasi').val();

													$('.konten_tbl_cluster').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_cluster_'+x_jenis_lokasi).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_cluster/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/'
														);
													}, 500);
												}

												function reload_tbl_kabupaten(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_lokasi =  $('#x_jenis_lokasi').val();

													$('.konten_tbl_kabupaten').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_kabupaten_'+x_jenis_lokasi).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_kabupaten/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/'
														);
													}, 500);
												}

												function reload_tbl_kecamatan(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_lokasi =  $('#x_jenis_lokasi').val();

													$('.konten_tbl_kecamatan').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_kecamatan_'+x_jenis_lokasi).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_kecamatan/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/'
														);
													}, 500);
												}

												function reload_tbl_tap(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_lokasi =  $('#x_jenis_lokasi').val();

													$('.konten_tbl_tap').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_tap_'+x_jenis_lokasi).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_tap/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/'
														);
													}, 500);
												}

												function reload_tbl_sales(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_lokasi =  $('#x_jenis_lokasi').val();

													$('.konten_tbl_sales').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_sales_'+x_jenis_lokasi).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_sales/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/'
														);
													}, 500);
												}
											</script>