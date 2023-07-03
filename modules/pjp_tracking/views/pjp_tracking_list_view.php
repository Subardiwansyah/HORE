

					<main class="page-content">
						<ol class="breadcrumb page-breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fal fa-home"></i></a></li>
							<li class="breadcrumb-item active"><?php echo $breadcrumb_form; ?></li>
						</ol>

						<div class="row">
							<div class="col-xl-12">
								<div id="panel-1" class="panel">
									<div class="panel-hdr">
										<h2 data-bind="text: title">
											&nbsp;
										</h2>
										<!--
										<div class="panel-toolbar">
											<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
										</div>
										-->
									</div>
									<div class="panel-container show">
										<form id="frm" method="post" action="<?php echo base_url().$modul; ?>/proses">
											<div class="panel-content">
												<!-- Begin -->

												<div class="row">
													<div class="col-md-5">
														<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
															<i class="fal fa-file-search"></i>&nbsp;&nbsp;
															FILTER DATA
														</h5>

														<div class="card mb-3" style="height:280px;">
															<div class="card-body">
																<div class="form-row">
																	<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: id_jns_sales">
																		<label class="form-label" for="nm_jns_sales">Jenis Sales <span class="text-danger">*</span> </label>
																		<input type="text" style="width:100%" class="select2" id="nm_jns_sales" data-bind="value: nm_jns_sales" />
																	</div>
																</div>
																<div class="form-row">
																	<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: id_sales">
																		<label class="form-label" for="nm_sales">Sales <span class="text-danger">*</span> </label>
																		<input type="text" style="width:100%" class="select2" id="nm_sales" data-bind="value: nm_sales" />
																	</div>
																</div>
																<div class="form-row">
																	<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: tgl">
																		<label class="form-label" for="tgl">Tanggal <span class="text-danger">*</span> </label>
																		<div class="input-group input-group-sm">
																			<input type="text" class="form-control form-control-sm datepicker" id="tgl" data-bind="value: tgl" value="<?php echo date('d/m/Y'); ?>">
																			<div class="input-group-append">
																				<span class="input-group-text fs-xl">
																					<i class="fal fa-calendar-alt"></i>
																				</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-7">
														<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
															<i class="fal fa-address-card"></i>&nbsp;&nbsp;
															INFO SALES
														</h5>

														<div class="card mb-3">
															<div class="card-body">
																<table class="table table-sm table-striped m-0">
																	<tbody>
																		<tr>
																			<td style="width:110px;">TAP</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_tap"></span></td>
																		</tr>
																		<tr>
																			<td>Cluster</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_cluster"></span></td>
																		</tr>
																		<tr>
																			<td>Branch</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_branch"></span></td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>

														<div class="row">
															<div class="col-md-7">
																<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
																	<i class="fal fa-location"></i>&nbsp;&nbsp;
																	KUNJUNGAN LOKASI
																</h5>

																<div class="card mb-3" style="height:120px;">
																	<div class="card-body">
																		<table class="table table-sm table-striped m-0">
																			<tbody>
																				<tr>
																					<td>Jumlah <span data-bind="text: title_lokasi_1"></span></td>
																					<td>:</td>
																					<td><span data-bind="text: jumlah"></span></td>
																				</tr>
																				<tr>
																					<td>Jumlah <span data-bind="text: title_lokasi_2"></span> Dikunjungi</td>
																					<td>:</td>
																					<td><span data-bind="text: dikunjungi"></span></td>
																				</tr>
																				<tr>
																					<td>Jumlah <span data-bind="text: title_lokasi_3"></span> Tidak Dikunjungi</td>
																					<td>:</td>
																					<td><span data-bind="text: tdk_dikunjungi"></span></td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
															<div class="col-md-5">
																<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
																	<i class="fal fa-palette"></i>&nbsp;&nbsp;
																	KETERANGAN WARNA
																</h5>

																<div class="card mb-3" style="height:120px;">
																	<div class="card-body">

																		<div class="row">
																			<div class="col-md-2 col-sm-2 col-xs-3 mb-2">
																				<span style="height:15px;width:15px;background-color:green" class="rounded-circle d-block bg-successx"></span>
																			</div>
																			<div class="col-md-10 col-sm-10 col-xs-9 mb-2">
																				Lokasi sudah dikunjungi
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-md-2 col-sm-2 col-xs-3 mb-2">
																				<span style="height:15px;width:15px;background-color:red" class="rounded-circle d-block bg-dangerx"></span>
																			</div>
																			<div class="col-md-10 col-sm-10 col-xs-9 mb-2">
																				Lokasi belum dikunjungi
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<h5 class="keep-print-font fw-500 mb-3 text-primary flex-1 position-relative">
													<i class="fal fa-map-marker-alt"></i>&nbsp;&nbsp;
													MAP
												</h5>

												<div class="card mb-3">
													<div class="card-body">
														<div id="konten_map"></div>
													</div>
												</div>
												<!-- End -->
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</main>

					<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>

					<script>
						var controls = {
							leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
							rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
						}

						$(document).ready(function()
						{
							reload_map();

							$('.datepicker').datepicker({
								orientation: "bottom left",
								todayHighlight: true,
								templates: controls,
								format: "dd/mm/yyyy",
								autoclose: true,
								onSelect: function(dateText){
									console.log("Selected date: " + dateText + "; input's current value: " + this.value);
								}
							});

							$('#nm_jns_sales').select2({
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
							$('#nm_jns_sales').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_jns_sales');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_jns_sales(e.added ? e.added.id : '');
									App.nm_jns_sales(e.added ? e.added.nama : '');

									App.id_sales('');
									App.nm_sales('');
									$('#nm_sales').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_sales').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_sales_inpjp',
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
								var nmSales = $('#nm_sales').val();

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_sales(e.added ? e.added.id : '');
									App.nm_sales(e.added ? e.added.nama : '');
									App.id_tap(e.added ? e.added.id_tap : '');
									App.nm_tap(e.added ? e.added.nm_tap : '');
									App.nm_cluster(e.added ? e.added.nm_cluster : '');
									App.nm_branch(e.added ? e.added.nm_branch : '');
									App.tgl($('#tgl').val());

									reload_map();
									reload_jumlah();

									return false;
								}
								e.stopPropagation();
							});

							$('#tgl').on('change', function(e){
								App.tgl($('#tgl').val());

								reload_map();
								reload_jumlah();
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);

							self.id_jns_sales = ko.observable("")
								.extend({
									required: {params: true, message: 'Jenis Sales tidak boleh kosong'}
							});
							self.nm_jns_sales = ko.observable("");
							self.id_sales = ko.observable("")
								.extend({
									required: {params: true, message: 'Sales tidak boleh kosong'}
							});
							self.nm_sales = ko.observable("");
							self.tgl = ko.observable("<?php echo date('d/m/Y'); ?>")
								.extend({
									required: {params: true, message: 'Tanggal tidak boleh kosong'}
							});
							self.id_tap = ko.observable("");
							self.nm_tap = ko.observable("");
							self.nm_cluster = ko.observable("");
							self.nm_branch = ko.observable("");
							self.jumlah = ko.observable(0);
							self.dikunjungi = ko.observable(0);
							self.tdk_dikunjungi = ko.observable(0);

							self.title_lokasi_1 = ko.computed(function(){
								return self.id_jns_sales() == 'SDS' || self.id_jns_sales() == 'SCS' ? 'Lokasi' : 'Outlet';
							});

							self.title_lokasi_2 = ko.computed(function(){
								return self.id_jns_sales() == 'SDS' || self.id_jns_sales() == 'SCS' ? 'Lokasi' : 'Outlet';
							});

							self.title_lokasi_3 = ko.computed(function(){
								return self.id_jns_sales() == 'SDS' || self.id_jns_sales() == 'SCS' ? 'Lokasi' : 'Outlet';
							});

							self.mode = ko.computed(function(){
								return self.id() != 0 ? 'edit' : 'new';
							});

							self.title = ko.computed(function(){
								// return (self.mode() === 'edit' ? 'Ubah ' : 'Tambah ') + self.modul;
								return self.modul;
							});

							self.isEdit = ko.computed(function(){
								return self.mode() === 'edit';
							});

							self.errors = ko.validation.group(self);
						}

						var App = new ModelForm();

						function reload_map(){
							var id_sales = App.id_sales() ? App.id_sales() : 0;
							var tgl = App.tgl() ? App.tgl() : '-';

							tgl = tgl.replace('/', '-').replace('/', '-');

							setTimeout(function(){
								$('#konten_map').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_map/' +
									id_sales + '/' +
									tgl + '/'
								);
							}, 500);
						}

						function reload_jumlah(){
							$.ajax({
								type: 'POST',
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_kunjungan',
								async: false,
								data: {
									'id_sales' : App.id_sales(),
									'tgl' : $('#tgl').val()
								},
								dataType: 'json',
								success: function(response){
									App.jumlah(response.jumlah);
									App.dikunjungi(response.dikunjungi);
									App.tdk_dikunjungi(response.tdk_dikunjungi);
								}
							});
						}

						ko.applyBindings(App);
					</script>