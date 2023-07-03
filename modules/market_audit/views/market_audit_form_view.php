											<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
												<li class="nav-item">
													<a class="nav-link fs-xs active" data-toggle="tab" href="#tab_out" onClick="reload_tab('belanja')">
														<i class="fal fa-shopping-cart mr-1 text-success"></i>
														BELANJA SHARE
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_sek" onClick="reload_tab('sales_broadband')">
														<i class="fal fa-users mr-1 text-warning"></i>
														SALES BROADBAND SHARE
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_kam" onClick="reload_tab('voucher_fisik')">
														<i class="fal fa-credit-card-front mr-1 text-danger"></i>
														VOUCHER FISIK SHARE
													</a>
												</li>
											</ul>
											<div class="tab-content my-3">
												<div class="tab-pane fade show active" id="tab_out" role="tabpanel">
													<!-- BEGIN BELANJA SHARE -->

													<div id="konten_tbl_regional_belanja" class="konten_tbl_regional"></div>
													<div id="konten_tbl_branch_belanja" class="konten_tbl_branch"></div>
													<div id="konten_tbl_cluster_belanja" class="konten_tbl_cluster"></div>
													<div id="konten_tbl_kabupaten_belanja" class="konten_tbl_kabupaten"></div>
													<div id="konten_tbl_kecamatan_belanja" class="konten_tbl_kecamatan"></div>
													<div id="konten_tbl_tap_belanja" class="konten_tbl_tap"></div>
													<div id="konten_tbl_sales_belanja" class="konten_tbl_sales"></div>

													<!-- END BELANJA SHARE -->
												</div>
												<div class="tab-pane fade" id="tab_sek" role="tabpanel">
													<!-- BEGIN SALES BROADBAND SHARE -->

													<div id="konten_tbl_regional_sales_broadband" class="konten_tbl_regional"></div>
													<div id="konten_tbl_branch_sales_broadband" class="konten_tbl_branch"></div>
													<div id="konten_tbl_cluster_sales_broadband" class="konten_tbl_cluster"></div>
													<div id="konten_tbl_kabupaten_sales_broadband" class="konten_tbl_kabupaten"></div>
													<div id="konten_tbl_kecamatan_sales_broadband" class="konten_tbl_kecamatan"></div>
													<div id="konten_tbl_tap_sales_broadband" class="konten_tbl_tap"></div>
													<div id="konten_tbl_sales_sales_broadband" class="konten_tbl_sales"></div>

													<!-- END SALES BROADBAND SHARE -->
												</div>
												<div class="tab-pane fade" id="tab_kam" role="tabpanel">
													<!-- BEGIN VOUCHER FISIK SHARE -->

													<div id="konten_tbl_regional_voucher_fisik" class="konten_tbl_regional"></div>
													<div id="konten_tbl_branch_voucher_fisik" class="konten_tbl_branch"></div>
													<div id="konten_tbl_cluster_voucher_fisik" class="konten_tbl_cluster"></div>
													<div id="konten_tbl_kabupaten_voucher_fisik" class="konten_tbl_kabupaten"></div>
													<div id="konten_tbl_kecamatan_voucher_fisik" class="konten_tbl_kecamatan"></div>
													<div id="konten_tbl_tap_voucher_fisik" class="konten_tbl_tap"></div>
													<div id="konten_tbl_sales_voucher_fisik" class="konten_tbl_sales"></div>

													<!-- END VOUCHER FISIK SHARE -->
												</div>

											</div>

											<input type="hidden" class="" id="x_kategori" value="<?php echo $kategori; ?>">
											<input type="hidden" class="" id="x_pilihan" value="<?php echo $pilihan; ?>">
											<input type="hidden" class="" id="x_tahun" value="<?php echo $tahun; ?>">
											<input type="hidden" class="" id="x_bulan" value="<?php echo $bulan; ?>">
											<input type="hidden" class="" id="x_minggu" value="<?php echo $minggu; ?>">
											<input type="hidden" class="" id="x_jenis_share" value="<?php echo $jenis_share; ?>">

											<script>
												$(document).ready(function()
												{
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													reload_tab(x_jenis_share);
												});

												function reload_tab(share){
													$('.konten_tbl_regional').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													$('.konten_tbl_branch').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													$('.konten_tbl_cluster').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													$('.konten_tbl_kabupaten').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													$('.konten_tbl_kecamatan').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													$('.konten_tbl_tap').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
													$('.konten_tbl_sales').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

													$('#x_jenis_share').val(share);

													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													if (x_jenis_share == 'belanja')
													{
														if (x_kategori == 'Branch')
														{
															setTimeout(function(){
																reload_tbl_regional_belanja();
																reload_tbl_branch_belanja();
																reload_tbl_cluster_belanja();
																reload_tbl_kabupaten_belanja();
																reload_tbl_kecamatan_belanja();
																reload_tbl_tap_belanja();
																reload_tbl_sales_belanja();
															}, 700);
														}
														else if (x_kategori == 'Cluster')
														{
															setTimeout(function(){
																reload_tbl_cluster_belanja();
																reload_tbl_kabupaten_belanja();
																reload_tbl_kecamatan_belanja();
																reload_tbl_tap_belanja();
																reload_tbl_sales_belanja();
															}, 700);
														}
														else if (x_kategori == 'TAP')
														{
															setTimeout(function(){
																reload_tbl_tap_belanja();
																reload_tbl_sales_belanja();
															}, 700);
														}
													}
													else
													{
														if (x_kategori == 'Branch')
														{
															setTimeout(function(){
																reload_tbl_regional();
																reload_tbl_branch();
																reload_tbl_cluster();
																reload_tbl_kabupaten();
																reload_tbl_kecamatan();
																reload_tbl_tap();
																reload_tbl_sales();
															}, 700);
														}
														else if (x_kategori == 'Cluster')
														{
															setTimeout(function(){
																reload_tbl_cluster();
																reload_tbl_kabupaten();
																reload_tbl_kecamatan();
																reload_tbl_tap();
																reload_tbl_sales();
															}, 700);
														}
														else if (x_kategori == 'TAP')
														{
															setTimeout(function(){
																reload_tbl_tap();
																reload_tbl_sales();
															}, 700);
														}
													}
												}

												function reload_tbl_regional(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_regional_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_regional/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_branch(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_branch_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_branch/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_cluster(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_cluster_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_cluster/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_kabupaten(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_kabupaten_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_kabupaten/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_kecamatan(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_kecamatan_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_kecamatan/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_tap(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_tap_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_tap/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_sales(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_sales_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_sales/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_regional_belanja(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_regional_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_regional_belanja/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_branch_belanja(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_branch_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_branch_belanja/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_cluster_belanja(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_cluster_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_cluster_belanja/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_kabupaten_belanja(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_kabupaten_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_kabupaten_belanja/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_kecamatan_belanja(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_kecamatan_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_kecamatan_belanja/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_tap_belanja(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_tap_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_tap_belanja/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}

												function reload_tbl_sales_belanja(){
													var x_kategori = $('#x_kategori').val();
													var x_pilihan = $('#x_pilihan').val();
													var x_tahun = $('#x_tahun').val();
													var x_bulan = $('#x_bulan').val();
													var x_minggu = $('#x_minggu').val();
													var x_jenis_share =  $('#x_jenis_share').val();

													$('#konten_tbl_sales_'+x_jenis_share).load(
														GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_sales_belanja/' +
														x_kategori + '/' +
														x_pilihan + '/' +
														x_tahun + '/' +
														x_bulan + '/' +
														x_minggu + '/' +
														x_jenis_share + '/'
													);
												}
											</script>