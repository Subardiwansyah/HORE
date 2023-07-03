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

														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="nm_tap">TAP </label>
															<input type="text" style="width:100%" class="select2" id="nm_tap" data-bind="value: nm_tap" />
														</div>
													</div>

													<div class="form-row">
														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="nm_sales">Sales </label>
															<input type="text" style="width:100%" class="select2" id="nm_sales" data-bind="value: nm_sales" />
														</div>

														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="nm_jns_lokasi">Jenis Lokasi </label>
															<input type="text" style="width:100%" class="select2" id="nm_jns_lokasi" data-bind="value: nm_jns_lokasi" />
														</div>

														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="hari">Hari </label>
															<select class="select2" id="hari" data-bind="value: hari">
																<option></option>
																<option value="-">-Semua-</option>
																<option value="Monday">Senin</option>
																<option value="Tuesday">Selasa</option>
																<option value="Wednesday">Rabu</option>
																<option value="Thursday">Kamis</option>
																<option value="Friday">Jumat</option>
																<option value="Saturday">Sabtu</option>
															</select>
														</div>

														<div class="col-md-2 col-sm-2 col-xs-12 mb-3">
															<button type="button" class="btn btn-sm btn-primary mt-4" id="btn-tampil-1" data-bind="click: tampil">
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
											
											<div id="konten_history_order"></div>
											
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

									App.id_tap('');
									App.nm_tap('');
									App.id_sales('');
									App.nm_sales('');
									App.id_jns_sales('');
									App.id_jns_lokasi('');
									App.nm_jns_lokasi('');

									$('#nm_tap').select2('val', null);
									$('#nm_sales').select2('val', null);
									$('#nm_jns_lokasi').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_tap').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_tap_incluster',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_cluster': App.id_cluster(),
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
							$('#nm_tap').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_tap');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_tap(e.added ? e.added.id : '');
									App.nm_tap(e.added ? e.added.nama : '');

									App.id_sales('');
									App.nm_sales('');
									App.id_jns_sales('');
									App.id_jns_lokasi('');
									App.nm_jns_lokasi('');

									$('#nm_sales').select2('val', null);
									$('#nm_jns_lokasi').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_sales').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_sales_by_tap',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_tap': App.id_tap(),
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
							$('#nm_sales').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_sales');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_sales(e.added ? e.added.id : '');
									App.nm_sales(e.added ? e.added.nama : '');
									App.id_jns_sales(e.added ? e.added.id_jns_sales : '');

									App.id_jns_lokasi('');
									App.nm_jns_lokasi('');

									$('#nm_jns_lokasi').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_jns_lokasi').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_jenis_lokasi_by_history_order',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_jns_sales': App.id_jns_sales(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Jenis Lokasi',
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
							$('#nm_jns_lokasi').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_jns_lokasi');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									App.id_jns_lokasi(e.added ? e.added.id : '');
									App.nm_jns_lokasi(e.added ? e.added.nama : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#hari').select2({
								placeholder: 'Pilih Hari',
								allowClear: true
							});
							$('#hari').on('change', function(e){
								var data = $('#hari').val();

								App.hari(data);
							});

						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);

							self.id_cluster = ko.observable('');
							self.nm_cluster = ko.observable('');
							self.id_tap = ko.observable('');
							self.nm_tap = ko.observable('');
							self.id_sales = ko.observable('');
							self.nm_sales = ko.observable('');
							self.id_jns_sales = ko.observable('');
							self.id_jns_lokasi = ko.observable('');
							self.nm_jns_lokasi = ko.observable('');
							self.hari = ko.observable('');

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
							var id_tap = App.id_tap();
							var id_sales = App.id_sales();
							var id_jns_sales = App.id_jns_sales();
							var id_jns_lokasi = App.id_jns_lokasi();
							var hari = App.hari() ? App.hari() : 0;

							if (id_cluster == '')
							{
								show_warning('Silakan pilih Cluster terlebih dahulu');
								return false;
							}

							if (id_tap == '')
							{
								show_warning('Silakan pilih TAP terlebih dahulu');
								return false;
							}

							if (id_sales == '')
							{
								show_warning('Silakan pilih Sales terlebih dahulu');
								return false;
							}

							if (id_jns_lokasi == '')
							{
								show_warning('Silakan pilih Jenis Lokasi terlebih dahulu');
								return false;
							}

							if (hari == '')
							{
								show_warning('Silakan pilih Hari terlebih dahulu');
								return false;
							}
							
							$('#pesan_filter').hide();
							
							$('#konten_history_order').load(
								GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/history_order_form/' +
								id_tap + '/' +
								id_sales + '/' +
								id_jns_sales + '/' +
								id_jns_lokasi + '/' +
								hari + '/'
							);
						}

						ko.applyBindings(App);
					</script>