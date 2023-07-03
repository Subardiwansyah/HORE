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
													<a class="nav-link " data-toggle="tab" href="#tab_1" role="tab" onClick="reload_tab('view')">
														<i class="fal fa-eye mr-1 text-success"></i>
														View
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_2" role="tab" onClick="reload_tab('resume')">
														<i class="fal fa-clipboard-list-check mr-1 text-danger"></i>
														Resume
													</a>
												</li>
											</ul>
											<div class="tab-content my-3">
												<div class="tab-pane show fade active" id="tab_1" role="tabpanel">
													<!-- Begin Tab 1 -->

													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-search"></i>&nbsp;&nbsp;
														FILTER DATA
													</h5>

													<div class="card mb-3">
														<div class="card-body">
															<div class="form-row">
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="nm_cluster_view">Cluster </label>
																	<input type="text" style="width:100%" class="select2" id="nm_cluster_view" data-bind="value: nm_cluster_view" />
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="nm_tap_view">TAP </label>
																	<input type="text" style="width:100%" class="select2" id="nm_tap_view" data-bind="value: nm_tap_view" />
																</div>

																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="nm_jns_sales_view">Jenis Sales </label>
																	<input type="text" style="width:100%" class="select2" id="nm_jns_sales_view" data-bind="value: nm_jns_sales_view" />
																</div>

																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="nm_sales_view">Sales </label>
																	<input type="text" style="width:100%" class="select2" id="nm_sales_view" data-bind="value: nm_sales_view" />
																</div>
															</div>

															<div class="form-row">
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="periode_view">Bulan </label>
																	<input type="text" style="width:100%" class="select2" id="periode_view" data-bind="value: periode_view" />
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<button type="button" class="btn btn-sm btn-primary mt-4" id="btn-tampil" data-bind="click: tampil_view">
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

													<div id="pesan_filter_1" class="card mb-3">
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

													<div id="konten_view" class="konten_view"></div>

													<!-- End Tab 1 -->
												</div>
												<div class="tab-pane fade" id="tab_2" role="tabpanel">
													<!-- Begin Tab 2 -->

													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-search"></i>&nbsp;&nbsp;
														FILTER DATA
													</h5>

													<div class="card mb-3">
														<div class="card-body">
															<div class="form-row">
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="nm_cluster_resume">Cluster </label>
																	<input type="text" style="width:100%" class="select2" id="nm_cluster_resume" data-bind="value: nm_cluster_resume" />
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="nm_tap_resume">TAP </label>
																	<input type="text" style="width:100%" class="select2" id="nm_tap_resume" data-bind="value: nm_tap_resume" />
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="periode_resume">Bulan </label>
																	<input type="text" style="width:100%" class="select2" id="periode_resume" data-bind="value: periode_resume" />
																</div>
																<div class="col-md-2 col-sm-2 col-xs-12 mb-3">
																	<button type="button" class="btn btn-sm btn-primary mt-4" id="btn-tampil--2" data-bind="click: tampil_resume">
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

													<div id="pesan_filter_2" class="card mb-3">
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

													<div id="konten_resume" class="konten_resume"></div>

													<!-- End Tab 2 -->
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
							$('#nm_cluster_view').select2({
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
							$('#nm_cluster_view').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_cluster_view');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_cluster_view(e.added ? e.added.id : '');
									App.nm_cluster_view(e.added ? e.added.nama : '');

									App.id_tap_view('');
									App.nm_tap_view('');
									App.id_sales_view('');
									App.nm_sales_view('');

									$('#nm_tap_view').select2('val', null);
									$('#nm_sales_view').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_tap_view').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_tap_incluster',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_cluster': App.id_cluster_view(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih TAP',
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
							$('#nm_tap_view').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_tap_view');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_tap_view(e.added ? e.added.id : '');
									App.nm_tap_view(e.added ? e.added.nama : '');

									App.id_sales_view('');
									App.nm_sales_view('');

									$('#nm_sales_view').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#periode_view').select2({
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
							$('#periode_view').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('periode_view');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									App.periode_view(e.added ? e.added.id : '');
									App.tahun_view(e.added ? e.added.tahun : '');
									App.bulan_view(e.added ? e.added.bulan : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_jns_sales_view').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_jenis_sales_inmaster',
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
								placeholder: 'Pilih Jenis Sales',
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
							$('#nm_jns_sales_view').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_jns_sales_view');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_jns_sales_view(e.added ? e.added.id : '');
									App.nm_jns_sales_view(e.added ? e.added.nama : '');

									App.id_sales_view('');
									App.nm_sales_view('');
									$('#nm_sales_view').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_sales_view').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_sales_intap',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_jns_sales': App.id_jns_sales_view(),
											'id_tap': App.id_tap_view(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Sales',
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
							$('#nm_sales_view').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_sales_view');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_sales_view(e.added ? e.added.id : '');
									App.nm_sales_view(e.added ? e.added.nama : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_cluster_resume').select2({
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
							$('#nm_cluster_resume').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_cluster_resume');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_cluster_resume(e.added ? e.added.id : '');
									App.nm_cluster_resume(e.added ? e.added.nama : '');

									App.id_tap_resume('');
									App.nm_tap_resume('');

									$('#nm_tap_resume').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_tap_resume').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_tap_incluster',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_cluster': App.id_cluster_resume(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih TAP',
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
							$('#nm_tap_resume').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_tap_resume');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_tap_resume(e.added ? e.added.id : '');
									App.nm_tap_resume(e.added ? e.added.nama : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#periode_resume').select2({
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
							$('#periode_resume').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('periode_view');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									App.periode_resume(e.added ? e.added.id : '');
									App.tahun_resume(e.added ? e.added.tahun : '');
									App.bulan_resume(e.added ? e.added.bulan : '');

									return false;
								}
								e.stopPropagation();
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);

							self.id_cluster_view = ko.observable("");
							self.nm_cluster_view = ko.observable("");
							self.id_tap_view = ko.observable("");
							self.nm_tap_view = ko.observable("");


							self.id_jns_sales_view = ko.observable("");
							self.nm_jns_sales_view = ko.observable("");


							self.id_sales_view = ko.observable("");
							self.nm_sales_view = ko.observable("");
							self.periode_view = ko.observable("<?php echo date('M-Y', strtotime(date('Y-m-d'))); ?>");
							self.tahun_view = ko.observable("<?php echo date('Y'); ?>");
							self.bulan_view = ko.observable("<?php echo date('m'); ?>");

							self.id_cluster_resume = ko.observable("");
							self.nm_cluster_resume = ko.observable("");
							self.id_tap_resume = ko.observable("");
							self.nm_tap_resume = ko.observable("");
							self.jns_sales_resume = ko.observable("SSF");
							self.periode_resume = ko.observable("<?php echo date('M-Y', strtotime(date('Y-m-d'))); ?>");
							self.tahun_resume = ko.observable("<?php echo date('Y'); ?>");
							self.bulan_resume = ko.observable("<?php echo date('m'); ?>");

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

						App.tampil_view = function(){
							var id_cluster = App.id_cluster_view() ? App.id_cluster_view() : 0;
							var id_tap = App.id_tap_view() ? App.id_tap_view() : 0;
							var id_jns_sales = App.id_jns_sales_view() ? App.id_jns_sales_view() : 0;
							var id_sales = App.id_sales_view() ? App.id_sales_view() : 0;

							if (id_cluster == 0)
							{
								show_warning('Silakan pilih cluster terlebih dahulu');
								return false;
							}

							if (id_tap == 0)
							{
								show_warning('Silakan pilih tap terlebih dahulu');
								return false;
							}

							if (id_jns_sales == 0)
							{
								show_warning('Silakan pilih jenis sales terlebih dahulu');
								return false;
							}

							if (id_sales == 0)
							{
								show_warning('Silakan pilih sales terlebih dahulu');
								return false;
							}

							reload_data_view();
						}

						App.tampil_resume = function(){
							var id_cluster = App.id_cluster_resume() ? App.id_cluster_resume() : 0;
							var id_tap = App.id_tap_resume() ? App.id_tap_resume() : 0;

							if (id_cluster == 0)
							{
								show_warning('Silakan pilih cluster terlebih dahulu');
								return false;
							}

							if (id_tap == 0)
							{
								show_warning('Silakan pilih tap terlebih dahulu');
								return false;
							}
							
							reload_data_resume();
						}

						function reload_tab(tab){
							if (tab == 'view')
							{
								reload_data_view();
							}
							else if (tab == 'resume')
							{
								reload_data_resume();
							}
							else
							{
								$('#konten_view').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
								$('#konten_resume').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');
							}
						}

						function reload_data_view(){
							$('#pesan_filter_1').hide();
							$('#konten_view').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							var id_cluster = App.id_cluster_view() ? App.id_cluster_view() : 0;
							var id_tap = App.id_tap_view() ? App.id_tap_view() : 0;
							var id_jns_sales = App.id_jns_sales_view() ? App.id_jns_sales_view() : 0;
							var id_sales = App.id_sales_view() ? App.id_sales_view() : 0;
							var tahun = App.tahun_view() ? App.tahun_view() : 0;
							var bulan = App.bulan_view() ? App.bulan_view() : 0;

							setTimeout(function(){
								$('#konten_view').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_view/' +
									id_cluster + '/' +
									id_tap + '/' +
									id_jns_sales + '/' +
									id_sales + '/' +
									tahun + '/' +
									bulan + '/'
								);
							}, 500);
						}

						function reload_data_resume(){
							$('#pesan_filter_2').hide();
							$('#konten_resume').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							var id_cluster = App.id_cluster_resume() ? App.id_cluster_resume() : 0;
							var id_tap = App.id_tap_resume() ? App.id_tap_resume() : 0;
							var jns_sales = App.jns_sales_resume() ? App.jns_sales_resume() : 0;
							var tahun = App.tahun_resume() ? App.tahun_resume() : 0;
							var bulan = App.bulan_resume() ? App.bulan_resume() : 0;

							setTimeout(function(){
								$('#konten_resume').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_resume/' +
									id_cluster + '/' +
									id_tap + '/' +
									jns_sales + '/' +
									tahun + '/' +
									bulan + '/'
								);
							}, 500);
						}

						ko.applyBindings(App);
					</script>