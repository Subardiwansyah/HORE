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

											<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
												<i class="fal fa-search"></i>&nbsp;&nbsp;
												FILTER DATA
											</h5>

											<div class="card mb-3">
												<div class="card-body">

													<div class="form-row">
														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="jenis_lokasi">Jenis Lokasi </label>
															<input type="text" style="width:100%" class="select2" id="jenis_lokasi" data-bind="value: jenis_lokasi" />
														</div>

														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="kategori">Kategori </label>
															<select class="select2" id="kategori" data-bind="value: kategori">
																<option></option>
																<option value="Branch">Branch</option>
																<option value="Cluster">Cluster</option>
																<option value="TAP">TAP</option>
															</select>
														</div>

														<div class="col-md-5 col-sm-5 col-xs-12 mb-3">
															<label class="form-label" for="pilihan">Pilihan </label>
															<input type="text" style="width:100%" class="select2" id="pilihan" data-bind="value: pilihan" />
														</div>
													</div>

													<div class="form-row">
														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="periode">Bulan </label>
															<input type="text" style="width:100%" class="select2" id="periode" data-bind="value: periode" />
														</div>

														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="minggu">Minggu </label>
															<select class="select2" id="minggu" data-bind="value: minggu">
																<option></option>
																<option value="0">All Week</option>
																<option value="1">W1</option>
																<option value="2">W2</option>
																<option value="3">W3</option>
																<option value="4">W4</option>
															</select>
														</div>
														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
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

											<div id="merchandising_konten_share"></div>

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
							$('#jenis_lokasi').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_jenis_lokasi_by_merchandising',
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
							$('#jenis_lokasi').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('jenis_lokasi');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									App.jenis_lokasi(e.added ? e.added.id : '');

									return false;
								}
								e.stopPropagation();
							});

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
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_pilihan_by_merchandising',
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
								placeholder: 'Pilih Minggu',
								allowClear: true
							});
							$('#minggu').on('change', function(e){
								var data = $('#minggu').val();

								App.minggu(data);
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);

							self.jenis_lokasi = ko.observable("");
							self.jenis_share = ko.observable("etalase");
							self.kategori = ko.observable("");
							self.pilihan = ko.observable("");

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
							var jenis_lokasi = App.jenis_lokasi();
							var kategori = App.kategori();
							var pilihan = App.pilihan();
							var tahun = App.tahun();
							var bulan = App.bulan();
							var minggu = App.minggu() ? App.minggu() : 0;

							if (jenis_lokasi == '')
							{
								show_warning('Silakan pilih jenis lokasi terlebih dahulu');
								return false;
							}

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
							
							$('#pesan_filter').hide();

							var tolowercase = jenis_lokasi.toLowerCase();

							$('#merchandising_konten_share').load(
								GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/merchandising_form_'+tolowercase + '/' +
								kategori + '/' +
								pilihan + '/' +
								tahun + '/' +
								bulan + '/' +
								minggu + '/'
							);
						}

						ko.applyBindings(App);
					</script>