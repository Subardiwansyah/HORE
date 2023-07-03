					<main class="page-content">
						<ol class="breadcrumb page-breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fal fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?><?php echo $modul; ?>"><?php echo $modul_display; ?></a></li>
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

														<div class="card mb-3">
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
																	<div class="col-md-12 col-sm-12 col-xs-12 mb-1" data-bind="validationElement: tgl">
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
																<div class="form-row">
																	<div class="col-md-12 col-sm-12 col-xs-12 mb-2">
																		<button type="button" class="btn btn-sm btn-primary mt-4" id="btn-tampil-2" data-bind="click: tampil">
																			<i class="fal fa-search"></i>
																			Tampilkan
																		</button>
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
																<table class="table table-sm table-clean">
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
															<div class="col-md-6">
																<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
																	<i class="fal fa-shopping-cart"></i>&nbsp;&nbsp;
																	TOTAL PENJUALAN
																</h5>

																<div class="card mb-3" style="height:120px;">
																	<div class="card-body">
																		<table class="table table-sm table-clean">
																			<tbody>
																				<tr>
																					<td style="width:100px;">Lunas</td>
																					<td>:</td>
																					<td class="text-right">Rp. <span data-bind="text: lunas"></span></td>
																				</tr>
																				<tr>
																					<td>Konsinyasi</td>
																					<td>:</td>
																					<td class="text-right">Rp. <span data-bind="text: konsinyasi"></span></td>
																				</tr>
																				<tr>
																					<td>Total</td>
																					<td>:</td>
																					<td class="text-right">Rp. <span data-bind="text: total"></span></td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
																	<i class="fal fa-money-check-alt"></i>&nbsp;&nbsp;
																	TOTAL LINK AJA
																</h5>

																<div class="card mb-3" style="height:120px;">
																	<div class="card-body">
																		<div style="text-align: center;font-size: 24px;margin-top: 20px;">Rp. <span data-bind="text: link_aja"></span></div>
																	</div>
																</div>
															</div>
														</div>

													</div>
												</div>

												<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
													<i class="fal fa-clipboard-list-check"></i>&nbsp;&nbsp;
													HASIL FILTER
												</h5>

												<div class="card mb-3">
													<div class="card-body">
														<table id="dt_table" class="table table-bordered table-hover w-100">
															<thead class="bg-primary-100">
																<tr>
																	<th>Aksi</th>
																	<th>Nota</th>
																	<th>Tanggal</th>
																	<th>Status</th>
																	<th>Total Perdana (Rp)</th>
																	<th>Total Link Aja (Rp)</th>
																</tr>
															</thead>
														</table>
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
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_sales_inpenjualan',
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

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_sales(e.added ? e.added.id : '');
									App.nm_sales(e.added ? e.added.nama : '');
									App.id_tap(e.added ? e.added.id_tap : '');
									App.nm_tap(e.added ? e.added.nm_tap : '');
									App.nm_cluster(e.added ? e.added.nm_cluster : '');
									App.nm_branch(e.added ? e.added.nm_branch : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#dt_table').dataTable(
							{
								responsive: true,
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar',
									type: 'POST',
									data: {
										'id_sales': App.id_sales,
										'tgl': App.tgl
									}
								},
								columns: [
										{width: '12%'},
										{width: '18%'},
										{width: '14%'},
										{width: '16%'},
										{width: '20%'},
										{width: '20%'}
								],
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
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

							self.lunas = ko.observable("0,00");
							self.konsinyasi = ko.observable("0,00");
							self.total = ko.observable("0,00");
							self.link_aja = ko.observable("0,00");

							self.mode = ko.computed(function(){
								return self.id() != 0 ? 'edit' : 'new';
							});

							self.title = ko.computed(function(){
								return self.modul;
							});

							self.isEdit = ko.computed(function(){
								return self.mode() === 'edit';
							});

							self.errors = ko.validation.group(self);
						}

						var App = new ModelForm();

						App.tampil = function(){
							App.tgl($('#tgl').val());

							var id_sales = App.id_sales() ? App.id_sales() : 0;
							var tgl = App.tgl() ? App.tgl() : 0;

							console.log(tgl, '__tgl');


							if (id_sales == 0)
							{
								show_warning('Silakan pilih sales terlebih dahulu');
								return false;
							}

							if (tgl == 0)
							{
								show_warning('Silakan pilih tanggal terlebih dahulu');
								return false;
							}

							reload_distribusi();
							$('#dt_table').DataTable().ajax.reload();
						}

						function reload_distribusi(){
							$.ajax({
								type: 'POST',
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_distribusi',
								async: false,
								data: {
									'id_sales' : App.id_sales(),
									'tgl' : App.tgl()
								},
								dataType: 'json',
								success: function(response){
									App.lunas(response.lunas);
									App.konsinyasi(response.konsinyasi);
									App.total(response.total);
									App.link_aja(response.link_aja);
								}
							});
						}

						function lihat_nota(id)
						{
							show_dialog(600, 500, 'Nota Pembayaran', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/lihat_nota_penjualan/' + id);
						}

						function lihat_penjualan(id)
						{
							show_dialog_large(600, 500, 'Penjualan Perdana', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/lihat_penjualan_perdana/' + id);
						}

						ko.applyBindings(App);
					</script>