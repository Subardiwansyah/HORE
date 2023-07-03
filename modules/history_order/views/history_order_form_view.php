						<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#tab_1" role="tab" onClick="reload_tab('week')">
									<i class="fal fa-history mr-1 text-danger"></i>
									History Order Weekly
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tab_2" role="tab" onClick="reload_tab('month')">
									<i class="fal fa-history mr-1 text-success"></i>
									History Order Monthly
								</a>
							</li>
						</ul>

						<div class="tab-content my-3">
							<div class="tab-pane fade show active" id="tab_1" role="tabpanel">
								<!-- Begin Tab 1 -->

								<div class="card mb-3">
									<div class="card-body">
										<div id="konten_week" class="konten_week"></div>
									</div>
								</div>

								<!-- End Tab 1 -->
							</div>
							<div class="tab-pane fade" id="tab_2" role="tabpanel">
								<!-- Begin Tab 2 -->

								<div class="card mb-3">
									<div class="card-body">
										<div id="konten_month" class="konten_month"></div>
									</div>
								</div>

								<!-- End Tab 2 -->
							</div>
						</div>
						
						<input type="hidden" class="" id="x_id_tap" value="<?php echo $id_tap; ?>">
						<input type="hidden" class="" id="x_id_sales" value="<?php echo $id_sales; ?>">
						<input type="hidden" class="" id="x_id_jns_sales" value="<?php echo $id_jns_sales; ?>">
						<input type="hidden" class="" id="x_id_jns_lokasi" value="<?php echo $id_jns_lokasi; ?>">
						<input type="hidden" class="" id="x_hari" value="<?php echo $hari; ?>">
						<input type="hidden" class="" id="x_tab" value="week">

						<script>
							$(document).ready(function()
							{
								var x_id_tap = $('#x_id_tap').val();
								var x_id_sales = $('#x_id_sales').val();
								var x_id_jns_sales = $('#x_id_jns_sales').val();
								var x_id_jns_lokasi = $('#x_id_jns_lokasi').val();
								var x_hari = $('#x_hari').val();
								var x_tab = $('#x_tab').val();

								reload_tab(x_tab);
							});

							function reload_tab(tab){
								$('#x_tab').val(tab);

								var x_id_tap = $('#x_id_tap').val();
								var x_id_sales = $('#x_id_sales').val();
								var x_id_jns_sales = $('#x_id_jns_sales').val();
								var x_id_jns_lokasi = $('#x_id_jns_lokasi').val();
								var x_hari = $('#x_hari').val();
								var x_tab = $('#x_tab').val();

								if (x_tab == 'week')
								{
									$('#konten_week').load(
										GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_week/' +
										x_id_tap + '/' +
										x_id_sales + '/' +
										x_id_jns_sales + '/' +
										x_id_jns_lokasi + '/' +
										x_hari + '/'
									);
								}
								else if (x_tab == 'month')
								{
									$('#konten_month').load(
										GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_month/' +
										x_id_tap + '/' +
										x_id_sales + '/' +
										x_id_jns_sales + '/' +
										x_id_jns_lokasi + '/' +
										x_hari + '/'
									);
								}
							}
						</script>