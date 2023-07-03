					<script src="<?php echo base_url(); ?>assets/js/highcharts/highcharts.js"></script>
					<script src="<?php echo base_url(); ?>assets/js/highcharts/exporting.js"></script>
					<script src="<?php echo base_url(); ?>assets/js/highcharts/export-data.js"></script>
					<script src="<?php echo base_url(); ?>assets/js/highcharts/accessibility.js"></script>

					<main class="page-content">
						<ol class="breadcrumb page-breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fal fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?><?php echo $modul; ?>"><?php echo $modul_display; ?></a></li>
							<li class="breadcrumb-item active"><?php echo $breadcrumb_daftar; ?></li>
						</ol>

						<div class="row">
							<div class="col-xl-12">

								<div id="panel-2" class="panel">
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
											<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" data-toggle="tab" href="#tab_grafik" role="tab" onClick="reload_tab('grafik')">
														<i class="fal fa-chart-line mr-1 text-success"></i>
														Grafik
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_summary" onClick="reload_tab('summary')">
														<i class="fal fa-table mr-1 text-warning"></i>
														Summary
													</a>
												</li>
											</ul>
											<div class="tab-content p-3">
												<div class="tab-pane fade show active" id="tab_grafik" role="tabpanel">
													<!-- BEGIN TAB GRAFIK -->

													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-search"></i>&nbsp;&nbsp;
														FILTER DATA
													</h5>

													<div class="card mb-3">
														<div class="card-body">
															<div class="form-row">
																<div class="col-md-3 col-sm-3 col-xs-12 mb-2">
																	<label class="form-label" for="kategori">Kategori </label>
																	<select class="select2" id="kategori" data-bind="value: kategori">
																		<option></option>
																		<?php $id_level = $this->session->userdata('ID_LEVEL'); ?>
																		<?php if ($id_level == 1 || $id_level == 2) { ?>
																		<option value="Branch">Branch</option>
																		<?php } ?>
																		<?php if ($id_level == 1 || $id_level == 2 || $id_level == 3) { ?>
																		<option value="Cluster">Cluster</option>
																		<?php } ?>
																		<option value="TAP">TAP</option>
																	</select>
																</div>

																<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																	<label class="form-label" for="pilihan">Filter </label>
																	<input type="text" style="width:100%" class="select2" id="pilihan" data-bind="value: pilihan" />
																</div>
																
																<div class="col-md-2 col-sm-2 col-xs-12 mb-3">
																	<label class="form-label" for="tahun">Tahun </label>
																	<input type="text" style="width:100%" class="select2" id="tahun" data-bind="value: tahun" />
																</div>

																<div class="col-md-2 col-sm-2 col-xs-12 mb-3">
																	<button type="button" class="btn btn-sm btn-primary mt-4" id="btn-tampil-1" data-bind="click: tampil_grafik">
																		<i class="fal fa-search"></i>
																		Tampilkan
																	</button>
																</div>
															</div>
														</div>
													</div>

													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-clipboard-list-check"></i>&nbsp;&nbsp;
														HASIL FILTER
													</h5>

													<div class="card mb-3">
														<div class="card-header bg-primary-100 py-1">
															<div class="card-title" style="font-size:13px;color:#FFFFFF">
																Daftar Penjualan Outlet Tahun <span data-bind="text: tahun"></span>
															</div>
														</div>
														<div class="card-body">
															<div id="konten_grafik_outlet" class="konten_grafik_outlet"></div>
														</div>
													</div>

													<div class="card mb-3">
														<div class="card-header bg-primary-100 py-1">
															<div class="card-title" style="font-size:13px;color:#FFFFFF">
																Daftar Penjualan Sekolah Tahun <span data-bind="text: tahun"></span>
															</div>
														</div>
														<div class="card-body">
															<div id="konten_grafik_sekolah" class="konten_grafik_sekolah"></div>
														</div>
													</div>

													<div class="card mb-3">
														<div class="card-header bg-primary-100 py-1">
															<div class="card-title" style="font-size:13px;color:#FFFFFF">
																Daftar Penjualan Kampus Tahun <span data-bind="text: tahun"></span>
															</div>
														</div>
														<div class="card-body">
															<div id="konten_grafik_kampus" class="konten_grafik_kampus"></div>
														</div>
													</div>

													<div class="card mb-3">
														<div class="card-header bg-primary-100 py-1">
															<div class="card-title" style="font-size:13px;color:#FFFFFF">
																Daftar Penjualan Fakultas Tahun <span data-bind="text: tahun"></span>
															</div>
														</div>
														<div class="card-body">
															<div id="konten_grafik_fakultas" class="konten_grafik_fakultas"></div>
														</div>
													</div>

													<div class="card mb-3">
														<div class="card-header bg-primary-100 py-1">
															<div class="card-title" style="font-size:13px;color:#FFFFFF">
																Daftar Penjualan POI Tahun <span data-bind="text: tahun"></span>
															</div>
														</div>
														<div class="card-body">
															<div id="konten_grafik_poi" class="konten_grafik_poi"></div>
														</div>
													</div>

													<!-- END TAB GRAFIK -->
												</div>
												<div class="tab-pane fade" id="tab_summary" role="tabpanel">
													<!-- BEGIN TAB SUMMARY -->

													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-search"></i>&nbsp;&nbsp;
														FILTER DATA
													</h5>

													<div class="card mb-3">
														<div class="card-body">
															<div class="form-row">																
																<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																	<label class="form-label" for="periode2">Bulan </label>
																	<input type="text" style="width:100%" class="select2" id="periode2" data-bind="value: periode2" />
																</div>

																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<button type="button" class="btn btn-sm btn-primary mt-4" id="btn-tampil-2" data-bind="click: tampil_summary">
																		<i class="fal fa-search"></i>
																		Tampilkan
																	</button>
																</div>
															</div>
														</div>
													</div>

													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-clipboard-list-check"></i>&nbsp;&nbsp;
														HASIL FILTER
													</h5>
													
													<div id="konten_summary_akumulasi" class="konten_summary"></div>
													<div id="konten_summary_branch" class="konten_summary"></div>
													<div id="konten_summary_cluster" class="konten_summary"></div>
													<div id="konten_summary_tap" class="konten_summary"></div>
													<div id="konten_summary_kabupaten" class="konten_summary"></div>
													<div id="konten_summary_kecamatan" class="konten_summary"></div>

													<!-- END TAB SUMMARY -->
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
						var opsi = function(id, uraian){
							this.id = id;
							this.uraian = uraian;
						}

						var controls = {
							leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
							rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
            }

						$(document).ready(function()
						{
							$('#kategori').select2({
								placeholder: 'Pilih Kategori',
								allowClear: true
							});
							$('#kategori').on('change', function(e){
								var data = $('#kategori').val();

								App.kategori(data);

								App.pilihan('');

								$('#pilihan').select2('val', null);
							});

							$('#pilihan').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_pilihan_by_dashboard',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'kategori': App.kategori(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Pilihan',
								allowClear: true,
								openOnEnter: false,
								dropdownAutoWidth : true,
								initSelection: function(element, callback){
									var data = {'text': element.val()};
									callback(data);
								},
								formatResult: function(res){
									return '<div><b>' + res.nama + '</b></div><div style="border-bottom:1px solid #ccc">' + res.kode + '</div>';
								}
							});
							$('#pilihan').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('pilihan');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.pilihan(e.added ? e.added.id : '');

									return false;
								}
								e.stopPropagation();
							});
							
							$('#tahun').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_tahun',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Tahun',
								allowClear: true,
								openOnEnter: false,
								dropdownAutoWidth : true,
								initSelection: function(element, callback){
									var data = {'text': element.val()};
									callback(data);
								},
								formatResult: function(res){
									return '<div>' + res.nama + '</div>';
								}
							});
							$('#tahun').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('tahun');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									App.tahun(e.added ? e.added.id : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#periode2').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_periode_indasbhoard',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Bulan',
								allowClear: true,
								openOnEnter: false,
								dropdownAutoWidth : true,
								initSelection: function(element, callback){
									var data = {'text': element.val()};
									callback(data);
								},
								formatResult: function(res){
									return '<div>' + res.nama + '</div>';
								}
							});
							$('#periode2').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('periode2');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									App.periode2(e.added ? e.added.id : '');
									App.tahun2(e.added ? e.added.tahun : '');
									App.bulan2(e.added ? e.added.bulan : '');

									return false;
								}
								e.stopPropagation();
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);

							self.kategori = ko.observable("");							
							self.pilihan = ko.observable("");
							self.tahun = ko.observable("<?php echo date('Y'); ?>");
							self.bulan = ko.observable("<?php echo date('m'); ?>");
							
							self.periode2 = ko.observable("<?php echo date('M-Y', strtotime(date('Y-m-d'))); ?>");
							self.tahun2 = ko.observable("<?php echo date('Y'); ?>");
							self.bulan2 = ko.observable("<?php echo date('m'); ?>");

							self.mode = ko.computed(function(){
								return self.id() != 0 ? 'edit' : 'new';
							});

							self.title = ko.computed(function(){
								return (self.mode() === 'edit' ? 'Ubah ' : 'Tambah ') + self.modul;
							});

							self.isEdit = ko.computed(function(){
								return self.mode() === 'edit';
							});

							self.errors = ko.validation.group(self);
						}

						var App = new ModelForm();

						App.tampil_grafik = function(){
							var kategori = App.kategori();
							var pilihan = App.pilihan();
							var tahun = App.tahun();
							if (kategori == '')
							{
								show_warning('Silakan pilih kategori terlebih dahulu');
								return false;
							}

							if (pilihan == '')
							{
								show_warning('Silakan pilih pilihan terlebih dahulu');
								return false;
							}

							if (tahun == '')
							{
								show_warning('Silakan pilih tahun terlebih dahulu');
								return false;
							}

							reload_tab_grafik();
						}

						App.tampil_summary = function(){
							var bulan = App.bulan2();

							if (bulan == '')
							{
								show_warning('Silakan pilih bulan terlebih dahulu');
								return false;
							}

							reload_tab_summary();
						}

						function reload_tab_grafik(){
							var kategori = App.kategori() ? App.kategori() : 0;
							var pilihan = App.pilihan() ? App.pilihan() : 0;
							var tahun = App.tahun() ? App.tahun() : 0;
							var bulan = App.bulan() ? App.bulan() : 0;
							var arr_dash = ['outlet', 'sekolah', 'kampus', 'fakultas', 'poi'];
							var arr_dash_length = arr_dash.length;

							for (var i = 0; i < arr_dash_length; i++)
							{
								$('#konten_grafik_' + arr_dash[i]).load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_grafik_' + arr_dash[i] + '/' +
									kategori + '/' +
									pilihan + '/' +
									tahun + '/' +
									bulan + '/'
								);
							}
						}

						function reload_tab_summary(){
							var tahun = App.tahun2() ? App.tahun2() : 0;
							var bulan = App.bulan2() ? App.bulan2() : 0;
							var arr_summ = ['akumulasi', 'branch', 'cluster', 'tap', 'kabupaten', 'kecamatan'];
							var arr_summ_length = arr_summ.length;
							
							// $('.konten_summary').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							for (var i = 0; i < arr_summ_length; i++)
							{
								$('#konten_summary_' + arr_summ[i]).load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_summary_' + arr_summ[i] + '/' +
									tahun + '/' +
									bulan + '/'
								);
							}
						}

						function reload_tab(tab){
							if (tab == 'grafik')
							{
								reload_tab_grafik();
							}
							else if (tab == 'summary')
							{
								reload_tab_summary();
							}
						}

						setTimeout(function(){
							reload_tab_grafik();
							reload_tab_summary();
						}, 700);

						ko.applyBindings(App);
					</script>