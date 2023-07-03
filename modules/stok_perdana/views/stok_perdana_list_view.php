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
									</div>
									<div class="panel-container show">
										<form id="frm" method="post" action="<?php echo base_url().$modul; ?>/proses">
											<div class="panel-content">
											
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
																	<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
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
															<div class="col-md-4">
																<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
																	<i class="fal fa-barcode-alt"></i>&nbsp;&nbsp;
																	SUDAH TERJUAL
																</h5>

																<div class="card" style="height:130px;">
																	<div class="card-body">
																		<div class="p-5 bg-primary-200 rounded overflow-hidden position-relative text-white mb-g">
																			<div class="">
																				<h3 class="display-5 d-block l-h-n m-0 fw-500">
																					<span data-bind="text: terjual">721</span>
																					<small class="m-0 l-h-n">PCS</small>
																				</h3>
																			</div>
																			<i class="fal fa-cart-arrow-down position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
																		</div>
																	</div>
																</div>

															</div>
															<div class="col-md-4">
																<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
																	<i class="fal fa-barcode-alt"></i>&nbsp;&nbsp;
																	BELUM TERJUAL
																</h5>

																<div class="card" style="height:130px;">
																	<div class="card-body">
																		<div class="p-5 bg-primary-210 rounded overflow-hidden position-relative text-white mb-g">
																			<div class="">
																				<h3 class="display-5 d-block l-h-n m-0 fw-500">
																					<span data-bind="text: belum_terjual">721</span>
																					<small class="m-0 l-h-n">PCS</small>
																				</h3>
																			</div>
																			<i class="fal fa-cart-plus position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
																		</div>
																	</div>
																</div>

															</div>
															<div class="col-md-4">
																<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
																	<i class="fal fa-barcode-alt"></i>&nbsp;&nbsp;
																	TOTAL
																</h5>

																<div class="card" style="height:130px;">
																	<div class="card-body">
																		<div class="p-5 bg-info-500 rounded overflow-hidden position-relative text-white mb-g">
																			<div class="">
																				<h3 class="display-5 d-block l-h-n m-0 fw-500">
																					<span data-bind="text: total">721</span>
																					<small class="m-0 l-h-n">PCS</small>
																				</h3>
																			</div>
																			<i class="fal fa-shopping-cart position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
																		</div>
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
												
												<div id="konten_perdana_terjual" class="konten_perdana"></div>
												<div id="konten_perdana_belum_terjual" class="konten_perdana"></div>
												
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

							self.terjual = ko.observable(0);
							self.belum_terjual = ko.observable(0);
							self.total = ko.observable(0);

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
							
							$('#pesan_filter').hide();

							reload_daftar_perdana();
							reload_distribusi();
						}

						function reload_daftar_perdana(){
							var id_sales = App.id_sales() ? App.id_sales() : 0;
							var tgl = App.tgl() ? App.tgl() : '-';
							tgl = tgl.replace('/', '-').replace('/', '-');
							var arr_summ = ['terjual', 'belum_terjual'];
							var arr_summ_length = arr_summ.length;

							for (var i = 0; i < arr_summ_length; i++)
							{
								$('#konten_perdana_' + arr_summ[i]).load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_perdana_' + arr_summ[i] + '/' +
									id_sales + '/' +
									tgl + '/'
								);
							}
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
									App.total(response.total);
									App.terjual(response.terjual);
									App.belum_terjual(response.belum_terjual);
								}
							});
						}

						ko.applyBindings(App);
					</script>