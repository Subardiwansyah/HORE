											<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
												<li class="nav-item">
													<a class="nav-link fs-xs active" data-toggle="tab" href="#tab_spanduk" onClick="reload_tab('spanduk')">
														<i class="fal fa-image mr-1 text-danger"></i>
														LAYAR TOKO SHARE
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_poster" onClick="reload_tab('poster')">
														<i class="fal fa-photo-video mr-1 text-info"></i>
														POSTER SHARE
													</a>
												</li>
											</ul>
											<div class="tab-content my-3">
												<div class="tab-pane fade show active" id="tab_spanduk" role="tabpanel">
													<!-- BEGIN SPANDUK SHARE -->

													<div id="konten_tbl_regional_spanduk" class="konten_tbl_regional"></div>
													<div id="konten_tbl_branch_spanduk" class="konten_tbl_branch"></div>
													<div id="konten_tbl_cluster_spanduk" class="konten_tbl_cluster"></div>
													<div id="konten_tbl_kabupaten_spanduk" class="konten_tbl_kabupaten"></div>
													<div id="konten_tbl_kecamatan_spanduk" class="konten_tbl_kecamatan"></div>
													<div id="konten_tbl_tap_spanduk" class="konten_tbl_tap"></div>
													<div id="konten_tbl_sales_spanduk" class="konten_tbl_sales"></div>

													<!-- END SPANDUK SHARE -->
												</div>
												<div class="tab-pane fade" id="tab_poster" role="tabpanel">
													<!-- BEGIN POSTER SHARE -->

													<div id="konten_tbl_regional_poster" class="konten_tbl_regional"></div>
													<div id="konten_tbl_branch_poster" class="konten_tbl_branch"></div>
													<div id="konten_tbl_cluster_poster" class="konten_tbl_cluster"></div>
													<div id="konten_tbl_kabupaten_poster" class="konten_tbl_kabupaten"></div>
													<div id="konten_tbl_kecamatan_poster" class="konten_tbl_kecamatan"></div>
													<div id="konten_tbl_tap_poster" class="konten_tbl_tap"></div>
													<div id="konten_tbl_sales_poster" class="konten_tbl_sales"></div>

													<!-- END POSTER SHARE -->
												</div>

											</div>

											<input type="hidden" class="form-control form-control-sm" id="x_kategori" value="<?php echo $kategori; ?>">
											<input type="hidden" class="form-control form-control-sm" id="x_pilihan" value="<?php echo $pilihan; ?>">
											<input type="hidden" class="form-control form-control-sm" id="x_tahun" value="<?php echo $tahun; ?>">
											<input type="hidden" class="form-control form-control-sm" id="x_bulan" value="<?php echo $bulan; ?>">
											<input type="hidden" class="form-control form-control-sm" id="x_minggu" value="<?php echo $minggu; ?>">
											<input type="hidden" class="form-control form-control-sm" id="x_jenis_lokasi" value="<?php echo $jenis_lokasi; ?>">
											<input type="hidden" class="form-control form-control-sm" id="x_jenis_share" value="spanduk">


											<script>
												$(document).ready(function()
												{
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_lokasi =  $('#x_jenis_lokasi').val();
													var x_jenis_share = $('#x_jenis_share').val();

													reload_tab(x_jenis_share);
												});

												function reload_tab(share){
													// $('.konten_tbl_regional').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_branch').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_cluster').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_kabupaten').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_kecamatan').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_tap').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													// $('.konten_tbl_sales').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													$('#x_jenis_share').val(share);

													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_lokasi =  $('#x_jenis_lokasi').val();
													var x_jenis_share = $('#x_jenis_share').val();

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
													var x_jenis_share = $('#x_jenis_share').val();

													$('.konten_tbl_regional').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_regional_'+x_jenis_share).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_regional/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/' +
															x_jenis_share + '/'
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
													var x_jenis_share = $('#x_jenis_share').val();

													$('.konten_tbl_branch').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_branch_'+x_jenis_share).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_branch/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/' +
															x_jenis_share + '/'
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
													var x_jenis_share = $('#x_jenis_share').val();

													$('.konten_tbl_cluster').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_cluster_'+x_jenis_share).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_cluster/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/' +
															x_jenis_share + '/'
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
													var x_jenis_share = $('#x_jenis_share').val();

													$('.konten_tbl_kabupaten').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_kabupaten_'+x_jenis_share).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_kabupaten/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/' +
															x_jenis_share + '/'
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
													var x_jenis_share = $('#x_jenis_share').val();

													$('.konten_tbl_kecamatan').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_kecamatan_'+x_jenis_share).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_kecamatan/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/' +
															x_jenis_share + '/'
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
													var x_jenis_share = $('#x_jenis_share').val();

													$('.konten_tbl_tap').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_tap_'+x_jenis_share).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_tap/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/' +
															x_jenis_share + '/'
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
													var x_jenis_share = $('#x_jenis_share').val();

													$('.konten_tbl_sales').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													setTimeout(function(){
														$('#konten_tbl_sales_'+x_jenis_share).load(
															GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_sales/' +
															x_kategori + '/' +
															x_pilihan + '/' +
															x_tahun + '/' +
															x_bulan + '/' +
															x_minggu + '/' +
															x_jenis_lokasi + '/' +
															x_jenis_share + '/'
														);
													}, 500);
												}
											</script>