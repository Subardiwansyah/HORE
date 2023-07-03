											<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
												<li class="nav-item">
													<a class="nav-link fs-xs active" data-toggle="tab" href="#tab_coverage" onClick="reload_tab('coverage')">
														<i class="fal fa-search-location mr-1 text-success"></i>
														Coverage
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_distribusi" onClick="reload_tab('distribusi')">
														<i class="fal fa-luggage-cart mr-1 text-danger"></i>
														Distribusi
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_merchandising" onClick="reload_tab('merchandising')">
														<i class="fal fa-cubes mr-1 text-info"></i>
														Merchandising
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_promotion" onClick="reload_tab('promotion')">
														<i class="fal fa-bullhorn mr-1 text-dark"></i>
														Promotion
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_sales_report" onClick="reload_tab('sales_report')">
														<i class="fal fa-user mr-1 text-primary"></i>
														Sales Report
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fs-xs" data-toggle="tab" href="#tab_komitmen" onClick="reload_tab('komitmen')">
														<i class="fal fa-id-card-alt mr-1 text-success"></i>
														Komitmen
													</a>
												</li>
											</ul>
											<div class="tab-content my-3">
												<div class="tab-pane fade show active" id="tab_coverage" role="tabpanel">

													<div id="konten_coverage" class="konten_briefing"></div>

												</div>
												<div class="tab-pane fade" id="tab_distribusi" role="tabpanel">

													<div id="konten_distribusi_target_penjualan" class="konten_briefing"></div>
													<div id="konten_distribusi_history_order" class="konten_briefing"></div>

												</div>
												<div class="tab-pane fade" id="tab_merchandising" role="tabpanel">

													<?php if ($id_jns_sales == 'SDS') { ?>

													<div id="konten_merchandising_spanduk" class="konten_briefing"></div>
													<div id="konten_merchandising_poster" class="konten_briefing"></div>

													<?php } else { ?>

													<div id="konten_merchandising_perdana" class="konten_briefing"></div>
													<div id="konten_merchandising_voucher_fisik" class="konten_briefing"></div>
													<div id="konten_merchandising_spanduk" class="konten_briefing"></div>
													<div id="konten_merchandising_poster" class="konten_briefing"></div>
													<div id="konten_merchandising_papan_nama" class="konten_briefing"></div>
													<div id="konten_merchandising_backdrop" class="konten_briefing"></div>

													<?php } ?>

												</div>
												<div class="tab-pane fade" id="tab_promotion" role="tabpanel">
													<div id="konten_promotion" class="konten_briefing"></div>
												</div>
												<div class="tab-pane fade" id="tab_sales_report" role="tabpanel">
													<div id="konten_sales_report" class="konten_briefing"></div>
												</div>
												<div class="tab-pane fade" id="tab_komitmen" role="tabpanel">
													<div id="konten_komitmen" class="konten_briefing"></div>
												</div>
											</div>

											<input type="hidden" class="" id="x_jns_sales" value="<?php echo $id_jns_sales; ?>">
											<input type="hidden" class="" id="x_sales" value="<?php echo $id_sales; ?>">
											<input type="hidden" class="" id="x_tgl" value="<?php echo $tgl; ?>">
											<input type="hidden" class="" id="x_tab" value="coverage">

											<script>
												$(document).ready(function()
												{
													var x_jns_sales = $('#x_jns_sales').val();
													var x_sales = $('#x_sales').val();
													var x_tgl = $('#x_tgl').val();
													var x_tab = $('#x_tab').val();

													reload_tab(x_tab);
												});

												function reload_tab(tab){
													$('#x_tab').val(tab);

													var x_jns_sales = $('#x_jns_sales').val();
													var x_sales = $('#x_sales').val();
													var x_tgl = $('#x_tgl').val();
													var x_tab = $('#x_tab').val();

													console.log(x_tab, '__x_tab');

													if (x_tab == 'merchandising')
													{
														var arr = ['perdana', 'voucher_fisik', 'spanduk', 'poster', 'papan_nama', 'backdrop'];
														var arr_length = arr.length;

														for (var i = 0; i < arr_length; i++)
														{
															$('#konten_merchandising_'+arr[i]).load(
																GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_merchandising_' + arr[i] + '/' +
																x_jns_sales + '/' +
																x_sales + '/' +
																x_tgl + '/'
															);
														}
													}
													else if (x_tab == 'distribusi')
													{
														var arr = ['target_penjualan', 'history_order'];
														var arr_length = arr.length;

														for (var i = 0; i < arr_length; i++)
														{
															$('#konten_distribusi_'+arr[i]).load(
																GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_distribusi_' + arr[i] + '/' +
																x_jns_sales + '/' +
																x_sales + '/' +
																x_tgl + '/'
															);
														}
													}
													else
													{
														setTimeout(function(){
															$('#konten_'+x_tab).load(
																GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_' + x_tab + '/' +
																x_jns_sales + '/' +
																x_sales + '/' +
																x_tgl + '/'
															);
														}, 500);
													}
												}
											</script>