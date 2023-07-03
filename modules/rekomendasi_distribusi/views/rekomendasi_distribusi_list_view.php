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
											<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" data-toggle="tab" href="#tab_list" role="tab" onClick="reload_tab('list')">
														<i class="fal fa-clipboard-list-check mr-1 text-success"></i>
														List Rekomendasi
													</a>
												</li>
												<?php $id_level = $this->session->userdata('ID_LEVEL'); ?>
												<?php if (in_array($id_level, array(3))){ ?>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_entry" role="tab" onClick="reload_tab('entry')">
														<i class="fal fa-pencil mr-1 text-primary"></i>
														Entry Rekomendasi
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_edit" role="tab"  onClick="reload_tab('edit')">
														<i class="fal fa-edit mr-1 text-danger"></i>
														Edit Target Outlet
													</a>
												</li>
												<?php } ?>
											</ul>

											<div class="tab-content my-3">
												<div class="tab-pane fade show active" id="tab_list" role="tabpanel">

													<!-- BEGIN LIST REKOMENDASI -->

													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-search"></i>&nbsp;&nbsp;
														FILTER DATA
													</h5>

													<div class="card mb-3">
														<div class="card-body">
															<div class="form-row">
																<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																	<label class="form-label" for="nm_cluster">Cluster </label>
																	<input type="text" style="width:100%" class="select2" id="nm_cluster" data-bind="value: nm_cluster" />
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

													<div id="konten_list" class="konten_list"></div>

													<!-- END LIST REKOMENDASI -->
												</div>
												<div class="tab-pane fade" id="tab_entry" role="tabpanel">
													<!-- BEGIN ENTRY REKOMENDASI -->

													<div id="konten_entry" class="konten_entry"></div>

													<!-- END ENTRY REKOMENDASI -->
												</div>
												<div class="tab-pane fade" id="tab_edit" role="tabpanel">
													<!-- BEGIN EDIT TARGET OUTLET -->

													<div id="konten_edit" class="konten_edit"></div>

													<!-- END EDIT TARGET OUTLET -->
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
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_cluster_inmaster',
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

							$('#eksport_per').select2({
								placeholder: 'Pilih Eksport Per',
								allowClear: true
							});
							$('#eksport_per').on('change', function(e){
								var data = $('#eksport_per').val();

								App.eksport_per(data);
							});

						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);
							self.id_cluster = ko.observable("");
							self.nm_cluster = ko.observable("");
							self.periode = ko.observable("<?php echo date('M-Y', strtotime(date('Y-m-d'))); ?>");
							self.tahun = ko.observable("<?php echo date('Y'); ?>");
							self.bulan = ko.observable("<?php echo date('m'); ?>");
							self.minggu = ko.observable("");
							self.eksport_per = ko.observable('tap');

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
							var id_cluster = App.id_cluster() ? App.id_cluster() : 0;
							var tahun = App.tahun() ? App.tahun() : 0;
							var bulan = App.bulan() ? App.bulan() : 0;
							var minggu = App.minggu() ? App.minggu() : 0;

							if (id_cluster == 0)
							{
								show_warning('Silakan pilih cluster terlebih dahulu');
								return false;
							}

							if (tahun == 0)
							{
								show_warning('Silakan pilih tahun terlebih dahulu');
								return false;
							}

							if (bulan == 0)
							{
								show_warning('Silakan pilih bulan terlebih dahulu');
								return false;
							}

							if (minggu == 0)
							{
								show_warning('Silakan pilih minggu terlebih dahulu');
								return false;
							}

							reload_list();
						}

						function reload_tab(tab){
							if (tab == 'list') { reload_list(); }
							if (tab == 'entry') { reload_entry(); }
							if (tab == 'edit') { reload_edit(); }
						}

						function reload_list(){
							var id_cluster = App.id_cluster() ? App.id_cluster() : 0;
							var tahun = App.tahun() ? App.tahun() : 0;
							var bulan = App.bulan() ? App.bulan() : 0;
							var minggu = App.minggu() ? App.minggu() : 0;

							$('#pesan_filter').hide();

							$('#konten_list').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							setTimeout(function(){
								$('#konten_list').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/reload_list_rekomendasi/' +
									id_cluster + '/' +
									tahun + '/' +
									bulan + '/' +
									minggu + '/'
								);
							}, 200);
						}

						function reload_entry(){
							$('#konten_entry').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							setTimeout(function(){
								$('#konten_entry').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/reload_entry_rekomendasi/'
								);
							}, 200);
						}

						function reload_edit(){
							$('#konten_edit').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							setTimeout(function(){
								$('#konten_edit').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/reload_edit_target_sales/'
								);
							}, 200);
						}

						/* App.eksport = function(){
							var id_cluster = App.id_cluster() ? App.id_cluster() : 0;
							var tahun = App.tahun() ? App.tahun() : 0;
							var bulan = App.bulan() ? App.bulan() : 0;
							var minggu = App.minggu() ? App.minggu() : 0;

							if (id_cluster == 0)
							{
								show_warning('Silakan pilih cluster terlebih dahulu');
							}
							else if (tahun == 0)
							{
								show_warning('Silakan pilih tahun terlebih dahulu');
							}
							else if (bulan == 0)
							{
								show_warning('Silakan pilih bulan terlebih dahulu');
							}
							else if (minggu == 0)
							{
								show_warning('Silakan pilih minggu terlebih dahulu');
							}
							else
							{
								eksport_data();
							}
						} */


						/* function eksport_data(){
							var eksport_per = App.eksport_per() ? App.eksport_per() : 0;
							var id_cluster = App.id_cluster() ? App.id_cluster() : 0;
							var tahun = App.tahun() ? App.tahun() : 0;
							var bulan = App.bulan() ? App.bulan() : 0;
							var minggu = App.minggu() ? App.minggu() : 0;

							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/download_data/' + eksport_per + '/' + id_cluster + '/' + tahun  + '/' + bulan + '/' + minggu;
						} */

						ko.applyBindings(App);
					</script>