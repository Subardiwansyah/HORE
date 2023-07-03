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
														
														<!--
														<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="bulan">Bulan </label>
															<select class="select2" id="bulan" data-bind="value: bulan">
																<option></option>
																<option value="01">Januari</option>
																<option value="02">Februari</option>
																<option value="03">Maret</option>
																<option value="04">April</option>
																<option value="05">Mei</option>
																<option value="06">Juni</option>
																<option value="07">Juli</option>
																<option value="08">Agustus</option>
																<option value="9">September</option>
																<option value="10">Oktober</option>
																<option value="11">November</option>
																<option value="12">Desember</option>
															</select>
														</div>
														-->

														<div class="col-md-2 col-sm-2 col-xs-12 mb-3">
															<button type="button" class="btn btn-sm btn-primary mt-4" id="btn-tampil-1" data-bind="click: tampil_dashboard">
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
														Dashboard Merchandising Outlet Tahun <span class="xbulan"></span> <span data-bind="text: tahun"></span>
													</div>
												</div>
												<div class="card-body">
													<div id="konten_dashboard_outlet" class="konten_dashboard_outlet"></div>
												</div>
											</div>

											<div class="card mb-3">
												<div class="card-header bg-primary-100 py-1">
													<div class="card-title" style="font-size:13px;color:#FFFFFF">
														Dashboard Merchandising Sekolah Tahun <span class="xbulan"></span> <span data-bind="text: tahun"></span>
													</div>
												</div>
												<div class="card-body">
													<div id="konten_dashboard_sekolah" class="konten_dashboard_sekolah"></div>
												</div>
											</div>

											<div class="card mb-3">
												<div class="card-header bg-primary-100 py-1">
													<div class="card-title" style="font-size:13px;color:#FFFFFF">
														Dashboard Merchandising Kampus Tahun <span class="xbulan"></span> <span data-bind="text: tahun"></span>
													</div>
												</div>
												<div class="card-body">
													<div id="konten_dashboard_kampus" class="konten_dashboard_kampus"></div>
												</div>
											</div>

											<div class="card mb-3">
												<div class="card-header bg-primary-100 py-1">
													<div class="card-title" style="font-size:13px;color:#FFFFFF">
														Dashboard Merchandising Fakultas Tahun <span class="xbulan"></span> <span data-bind="text: tahun"></span>
													</div>
												</div>
												<div class="card-body">
													<div id="konten_dashboard_fakultas" class="konten_dashboard_fakultas"></div>
												</div>
											</div>
											
											<!--
											<div class="card mb-3">
												<div class="card-header bg-primary-100 py-1">
													<div class="card-title" style="font-size:13px;color:#FFFFFF">
														Dashboard Merchandising POI Bulan <span class="xbulan"></span> <span data-bind="text: tahun"></span>
													</div>
												</div>
												<div class="card-body">
													<div id="konten_dashboard_poi" class="konten_dashboard_poi"></div>
												</div>
											</div>
											-->
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

						const monthNames = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

						$(document).ready(function()
						{
							$('.xbulan').text(monthNames[App.bulan()]);

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
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_pilihan_indashboard',
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

							$('#bulan').select2({
								placeholder: 'Pilih Bulan',
								allowClear: true
							});
							$('#bulan').on('change', function(e){
								var data = $('#bulan').val();

								App.bulan(data);
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

						App.tampil_dashboard = function(){
							var kategori = App.kategori();
							var pilihan = App.pilihan();
							var tahun = App.tahun();
							var bulan = App.bulan() ? parseInt(App.bulan()) : '';

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

							reload_tab_dashboard();
						}

						function reload_tab_dashboard(){
							var kategori = App.kategori() ? App.kategori() : 0;
							var pilihan = App.pilihan() ? App.pilihan() : 0;
							var tahun = App.tahun() ? App.tahun() : 0;
							var bulan = App.bulan() ? App.bulan() : 0;
							var arr_dash = ['outlet', 'sekolah', 'kampus', 'fakultas'];
							var arr_dash_length = arr_dash.length;

							for (var i = 0; i < arr_dash_length; i++)
							{
								$('#konten_dashboard_' + arr_dash[i]).load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_dashboard_' + arr_dash[i] + '/' +
									kategori + '/' +
									pilihan + '/' +
									tahun + '/' +
									bulan + '/'
								);								
							}
						}

						setTimeout(function(){
							reload_tab_dashboard();
						}, 700);

						ko.applyBindings(App);
					</script>