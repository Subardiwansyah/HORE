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
									</div>
									<div class="panel-container show">
										<div class="panel-content">

											<?php $id_level = $this->session->userdata('ID_LEVEL'); ?>

											<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" data-toggle="tab" href="#tab_1" role="tab" onClick="reload_tab('LIST')">
														<i class="fal fa-clipboard-list-check mr-1 text-success"></i>
														List Target Sales
													</a>
												</li>
												<?php if (in_array($id_level, array(3))){ ?>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_2" role="tab" onClick="reload_tab('SF')">
														<i class="fal fa-edit mr-1 text-danger"></i>
														Entry Target Sales SF
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_3" role="tab" onClick="reload_tab('DS')">
														<i class="fal fa-edit mr-1 text-red"></i>
														Entry Target Sales DS
													</a>
												</li>
												<?php } ?>
											</ul>
											<div class="tab-content my-3">
												<div class="tab-pane fade show active" id="tab_1" role="tabpanel">
													<!-- Begin Tab 1 -->

													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-search"></i>&nbsp;&nbsp;
														FILTER DATA
													</h5>

													<div class="card mb-3">
														<div class="card-body">
															<div class="form-row">
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="nm_cluster">Cluster </label>
																	<input type="text" style="width:100%" class="select2" id="nm_cluster" data-bind="value: nm_cluster" />
																</div>
																<div class="col-md-2 col-sm-2 col-xs-12 mb-3">
																	<label class="form-label" for="jns_sales">Jenis Sales </label>
																	<select class="select2" id="jns_sales" data-bind="value: jns_sales">
																		<option value="SSF">Sales Force</option>
																		<option value="SDS">Direct Sales</option>
																	</select>
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="periode">Bulan </label>
																	<input type="text" style="width:100%" class="select2" id="periode" data-bind="value: periode" />
																</div>
																<div class="col-md-2 col-sm-2 col-xs-12 mb-3">
																	<label class="form-label" for="minggu">Minggu </label>
																	<input type="text" style="width:100%" class="select2" id="minggu" data-bind="value: minggu" />
																</div>
																<div class="col-md-2 col-sm-2 col-xs-12 mb-3">
																	<button type="button" class="btn btn-sm btn-primary mt-4" id="btn-tampil" data-bind="click: tampil">
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

													<div id="pesan_filter" class="card mb-3">
														<div class="card-body">
															<div style="background-color: #39a1f4;" class="alert bg-info-400 text-white fade show" role="alert">
																<div class="d-flex align-items-center">
																	<div class="alert-icon">
																		<i class="fal fa-info-square"></i>
																	</div>
																	<div class="flex-1">
																		<span class="h5">Silakan pilih filter data terlebih dahulu untuk menampilkan data.</span>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div id="konten_tab_list" class="konten_tab_list"></div>

													<!-- End Tab 1 -->
												</div>
												<div class="tab-pane fade" id="tab_2" role="tabpanel">
													<!-- Begin Tab 2 -->

													<div class="card mb-3">
														<div class="card-body">
															<div id="konten_tab_entry_sf" class="konten_tab_entry_sf"></div>
														</div>
													</div>

													<!-- End Tab 2 -->
												</div>
												<div class="tab-pane fade" id="tab_3" role="tabpanel">
													<!-- Begin Tab 3 -->

													<div class="card mb-3">
														<div class="card-body">
															<div id="konten_tab_entry_ds" class="konten_tab_entry_ds"></div>
														</div>
													</div>

													<!-- End Tab 3 -->
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

						$(document).ready(function()
						{
							$('#nm_cluster').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_cluster',
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
								placeholder: 'Pilih Cluster',
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
							$('#nm_cluster').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_cluster');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_cluster(e.added ? e.added.id : '');
									App.nm_cluster(e.added ? e.added.nama : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#periode').select2({
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
							$('#periode').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('periode');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									App.periode(e.added ? e.added.id : '');
									App.tahun(e.added ? e.added.tahun : '');
									App.bulan(e.added ? e.added.bulan : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#minggu').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_minggu',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'tahun': App.tahun(),
											'bulan': App.bulan(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Minggu',
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
							$('#minggu').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('minggu');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									App.minggu(e.added ? e.added.id : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#jns_sales').select2({
								placeholder: 'Pilih Jenis Sales',
								allowClear: true
							});
							$('#jns_sales').on('change', function(e){
								var data = $('#jns_sales').val();

								App.jns_sales(data);
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);
							self.id_cluster = ko.observable("");
							self.nm_cluster = ko.observable("");
							self.jns_sales = ko.observable("SF");
							self.temp = ko.observable(0);

							self.periode = ko.observable("<?php echo date('M-Y', strtotime(date('Y-m-d'))); ?>");
							self.tahun = ko.observable("<?php echo date('Y'); ?>");
							self.bulan = ko.observable("<?php echo date('m'); ?>");
							self.minggu = ko.observable("");

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

						App.tampil = function(){
							var id_cluster = App.id_cluster();
							var tahun = App.tahun();
							var bulan = App.bulan();
							var minggu = App.minggu();
							var jns_sales = App.jns_sales();

							if (id_cluster == '')
							{
								show_warning('Silakan pilih cluster terlebih dahulu');
								return false;
							}

							if (tahun == '')
							{
								show_warning('Silakan pilih tahun terlebih dahulu');
								return false;
							}

							if (bulan == '')
							{
								show_warning('Silakan pilih bulan terlebih dahulu');
								return false;
							}

							if (minggu == '')
							{
								show_warning('Silakan pilih minggu terlebih dahulu');
								return false;
							}

							if (jns_sales == '')
							{
								show_warning('Silakan pilih jenis sales terlebih dahulu');
								return false;
							}

							$('#pesan_filter').hide();

							reload_data_tab_list();
						}

						App.download = function(){
							//
						}

						function reload_tab(target){
							if (target == 'LIST')
							{
								reload_data_tab_list();
								console.log(target, '__target');
							}
							else if (target == 'SF')
							{
								reload_data_tab_entry_sf();
								console.log(target, '__target');
							}
							else if (target == 'DS')
							{
								reload_data_tab_entry_ds();
								console.log(target, '__target');
							}
							else
							{
								$('#konten_tab_list').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
								$('#konten_tab_entry_sf').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
								$('#konten_tab_entry_ds').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
							}
						}

						function reload_data_tab_list(){
							$('#konten_tab_list').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							var id_cluster = App.id_cluster() ? App.id_cluster() : 0;
							var tahun = App.tahun() ? App.tahun() : 0;
							var bulan = App.bulan() ? App.bulan() : 0;
							var minggu = App.minggu() ? App.minggu() : 0;
							var jns_sales =  App.jns_sales() ? App.jns_sales() : 'SF';

							setTimeout(function(){
								$('#konten_tab_list').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_tab_list/' +
									id_cluster + '/' +
									tahun + '/' +
									bulan + '/' +
									minggu + '/' +
									jns_sales + '/'
								);
							}, 500);
						}

						function reload_data_tab_entry_sf(){
							$('#konten_tab_entry_sf').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							setTimeout(function(){
								$('#konten_tab_entry_sf').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_tab_entry_sf/'
								);
							}, 500);
						}

						function reload_data_tab_entry_ds(){
							$('#konten_tab_entry_ds').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							setTimeout(function(){
								$('#konten_tab_entry_ds').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_tab_entry_ds/'
								);
							}, 500);
						}

						// setTimeout(function(){
							// $('a[data-toggle="tab"]').on('show.bs.tab', function(e){
								// var x = localStorage.setItem('activeTab', $(e.target).attr('href'));
							// });

							// var activeTab = localStorage.getItem('activeTab');

							// console.log(activeTab, '__activeTab');

							// if (activeTab)
							// {
								// if (activeTab == '#tab_1') { reload_tab('LIST'); }
								// if (activeTab == '#tab_2') { reload_tab('SF'); }
								// if (activeTab == '#tab_3') { reload_tab('DS'); }
							// }
							// else
							// {
								// reload_tab('LIST');
							// }
						// }, 500);

						ko.applyBindings(App);
					</script>