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

												<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
													<i class="fal fa-user-plus"></i>&nbsp;&nbsp;
													DATA SALES
												</h5>

												<div class="card mb-3">
													<div class="card-body">
														<div class="form-row">
															<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: nm_sales">
																<label class="form-label" for="nm_sales">Nama <span class="text-danger">*</span> </label>
																<input type="text" class="form-control form-control-sm" id="nm_sales" data-bind="disable: true, value: nm_sales">
															</div>
														</div>

														<div class="form-row">
															<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: email">
																<label class="form-label" for="email">Email <span class="text-danger">*</span> </label>
																<input type="email" class="form-control form-control-sm" id="email" data-bind="disable: true, value: email">
															</div>
														</div>

														<div class="form-row">
															<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: id_tap">
																<label class="form-label" for="nm_tap">TAP <span class="text-danger">*</span> </label>
																<input type="text" style="width:100%" class="select2" id="nm_tap" data-bind="disable: true, value: nm_tap" />
															</div>
														</div>

														<div class="form-row" data-bind="visible: App.id() === '0'">
															<div class="col-md-2 col-sm-2 col-xs-12 mb-3">
																<label class="form-label" for="opsi_new">Pengganti </label>
																<div class="custom-control custom-radio">
																	<input type="radio" class="custom-control-input" id="opsi_new" name="pengganti" value="1" data-bind="disable: true, checked: pengganti">
																	<label class="custom-control-label" for="opsi_new">New</label>
																</div>
															</div>
															<div class="col-md-2 col-sm-2 col-xs-12 mb-3">
																<label class="form-label" for="opsi_rotasi">&nbsp;</label>
																<div class="custom-control custom-radio">
																	<input type="radio" class="custom-control-input" id="opsi_rotasi" name="pengganti" value="2" data-bind="disable: true, checked: pengganti">
																	<label class="custom-control-label" for="opsi_rotasi">Rotasi</label>
																</div>
															</div>
														</div>

														<div class="form-row">
															<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																<label class="form-label" for="status">Status </label>
																<select class="form-control form-control-sm" id="status" data-bind="disable: true, options: list_status, optionsValue:'id', optionsText:'uraian', value: status"></select>
															</div>
															<div class="col-md-3 col-sm-3 col-xs-12 mb-3" data-bind="visible: App.id() === '0'">
																<label class="form-label" for="tgl_masuk">Tgl Masuk </label>
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control form-control-sm datepicker" id="tgl_masuk" data-bind="disable: true, value: tgl_masuk" value="<?php echo isset($data['tgl_masuk']) ? format_date($data['tgl_masuk']) : date('d/m/Y'); ?>">
																	<div class="input-group-append">
																		<span class="input-group-text fs-xl">
																			<i class="fal fa-calendar-alt"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="col-md-3 col-sm-3 col-xs-12 mb-3" data-bind="visible: App.status() === 'TIDAK AKTIF'">
																<label class="form-label" for="tgl_keluar">Tgl Keluar </label>
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control form-control-sm datepicker" id="tgl_keluar" data-bind="disable: true, value: tgl_keluar" value="<?php echo isset($data['tgl_keluar']) ? format_date($data['tgl_keluar']) : date('d/m/Y'); ?>">
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

												<?php $id_sales = isset($data['id_sales']) ? $data['id_sales'] : 0; ?>
												<?php if ($id_sales == 0) { ?>

												<div id="div_rotasi" data-bind="visible: App.pengganti() === '2'">
													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-user-times"></i>&nbsp;&nbsp;
														DATA ROTASI
													</h5>

													<div class="card mb-3">
														<div class="card-body">
															<div class="form-row">
																<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
																	<label class="form-label" for="nm_sales_lama">Nama <span class="text-danger">*</span> </label>
																	<input type="text" style="width:100%" class="select2" id="nm_sales_lama" data-bind="disable: true, value: nm_sales_lama" />
																</div>
															</div>

															<div class="form-row">
																<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
																	<label class="form-label" for="email_lama">Email </label>
																	<input type="email" class="form-control form-control-sm" id="email_lama" data-bind="disable: true, value: email_lama">
																</div>
															</div>

															<div class="form-row">
																<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
																	<label class="form-label" for="nm_tap_lama">TAP </label>
																	<input type="text" class="form-control form-control-sm" id="nm_tap_lama" data-bind="disable: true, value: nm_tap_lama">
																</div>
															</div>

															<div class="form-row">
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="status_lama">Status </label>
																	<select class="form-control form-control-sm" id="status_lama" data-bind="disable: true, options: list_status_lama, optionsValue:'id', optionsText:'uraian', value: status_lama"></select>
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="tgl_keluar_lama">Tgl Keluar</label>
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control form-control-sm datepicker" id="tgl_keluar_lama" data-bind="disable: true, value: tgl_keluar_lama" value="<?php echo isset($data['tgl_keluar']) ? format_date($data['tgl_keluar']) : date('d/m/Y'); ?>">
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

												<?php } ?>

												<!-- End -->
											</div>
											<div class="panel-content py-3 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right">
												<button type="button" class="btn btn-sm btn-primary" id="btn-batal" data-bind="click: back"><i class="fal fa-times"></i> Tutup</button>
											</div>
										</form>
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

						var patterns = {
							email:  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
							phone: /^\d[\d -]*\d$/,
							postcode: /^([a-zA-Z]{1,2}[0-9][0-9]?[a-zA-Z\s]?\s*[0-9][a-zA-Z]{2,2})|(GIR 0AA)$/
						};

						var controls = {
							leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
							rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
            }

						$(document).ready(function()
						{
							$('.datepicker').datepicker(
							{
								orientation: "top left",
								todayHighlight: true,
								templates: controls,
								format: "dd/mm/yyyy",
								autoclose: true
							});

							$('#nm_tap').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_tap',
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

									App.id_sales_lama('');
									App.nm_sales_lama('');
									App.email_lama('');
									App.nm_tap_lama('');

									$('#nm_sales_lama').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_sales_lama').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_sales_by_tap',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_jns_sales': 'SDS',
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
							$('#nm_sales_lama').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_sales_lama');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_sales_lama(e.added ? e.added.id : '');
									App.nm_sales_lama(e.added ? e.added.nama : '');
									App.email_lama(e.added ? e.added.email : '');
									App.nm_tap_lama(e.added ? e.added.nm_tap : '');

									return false;
								}
								e.stopPropagation();
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable("<?php echo isset($data['id_sales']) ? $data['id_sales'] : 0 ?>");
							self.nm_sales = ko.observable("<?php echo isset($data['nama_sales']) ? $data['nama_sales'] : '' ?>")
								.extend({
									required: {params: true, message: 'Nama tidak boleh kosong'}
							});
							self.email = ko.observable("<?php echo isset($data['email']) ? $data['email'] : '' ?>")
								.extend({
									required: {params: true, message: 'Email tidak boleh kosong'},
									pattern:  patterns.email
							});
							self.id_tap = ko.observable("<?php echo isset($data['id_tap']) ? $data['id_tap'] : '' ?>")
								.extend({
									required: {params: true, message: 'TAP tidak boleh kosong'}
							});
							self.nm_tap = ko.observable("<?php echo isset($data['nama_tap']) ? $data['nama_tap'] : '' ?>");
							self.pengganti = ko.observable("<?php echo isset($data['pengganti']) ? $data['pengganti'] : 1 ?>");
							self.status = ko.observable("<?php echo isset($data['status']) ? $data['status'] : 'AKTIF' ?>");
							self.list_status = ko.observableArray([
								new opsi('AKTIF', 'AKTIF'),
								new opsi('TIDAK AKTIF', 'TIDAK AKTIF')
							]);
							self.tgl_masuk = ko.observable("<?php echo isset($data['tgl_masuk']) ? format_date($data['tgl_masuk']) : date('d/m/Y') ?>");
							self.tgl_keluar = ko.observable("<?php echo isset($data['tgl_keluar']) ? format_date($data['tgl_keluar']) : date('d/m/Y') ?>");

							self.id_sales_lama = ko.observable("<?php echo isset($data['id_sales_lama']) ? $data['id_sales_lama'] : '' ?>");
							self.nm_sales_lama = ko.observable("<?php echo isset($data['nama_sales_lama']) ? $data['nama_sales_lama'] : '' ?>");
							self.email_lama = ko.observable("<?php echo isset($data['email_lama']) ? $data['email_lama'] : '' ?>");
							self.nm_tap_lama = ko.observable("<?php echo isset($data['nama_tap_lama']) ? $data['nama_tap_lama'] : '' ?>");
							self.status_lama = ko.observable("<?php echo isset($data['status_lama']) ? $data['status_lama'] : 'TIDAK AKTIF' ?>");
							self.list_status_lama = ko.observableArray([
								new opsi('AKTIF', 'AKTIF'),
								new opsi('TIDAK AKTIF', 'TIDAK AKTIF')
							]);
							self.tgl_keluar_lama = ko.observable("<?php echo isset($data['tgl_keluar_lama']) ? format_date($data['tgl_keluar_lama']) : date('d/m/Y') ?>");

							self.mode = ko.computed(function(){
								return self.id() != 0 ? 'edit' : 'new';
							});

							self.title = ko.computed(function(){
								return (self.mode() === 'edit' ? 'Lihat ' : 'Tambah ') + self.modul;
							});

							self.isEdit = ko.computed(function(){
								return self.mode() === 'edit';
							});

							self.errors = ko.validation.group(self);
						}

						var App = new ModelForm();

						App.back = function(){
							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"];
						}

						App.formValidation = function(){
							var errmsg = [];
							var pengganti = App.pengganti();
							var id_sales_lama = App.id_sales_lama() ? 1 : 0;
							var tgl_masuk = $('#tgl_masuk').val();
							var tgl_keluar = $('#tgl_keluar').val();

							App.tgl_masuk(tgl_masuk);
							App.tgl_keluar(tgl_keluar);

							if (pengganti == 2)
							{
								if (id_sales_lama == 0)
								{
									errmsg.push('Silakan pilih sales yang akan dirotasi.');
								}
							}

							if (!App.isValid())
							{
								errmsg.push('Ada kolom yang belum diisi dengan benar. Silakan diperbaiki.');
								App.errors.showAllMessages();
							}

							if (errmsg.length > 0)
							{
								show_warning(errmsg.join('</br>'));

								return false;
							}

							return true;
						}

						App.save = function(){
							if (!App.formValidation())
							{
								return false;
							}

							// Start looding
							var looding = bootbox.dialog({
								size: 'small',
								closeButton: false,
								message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...</div>',
								className: 'modal-looding'
							});

							var $frm = $('#frm'),
							data = JSON.parse(ko.toJSON(App));

							$.ajax({
								url: $frm.attr('action'),
								type: 'post',
								dataType: 'json',
								data: data,
								success: function(res, xhr){
									if (res.isSuccess)
									{
										show_success(res.message);

										setTimeout(function(){
											// bootbox.hideAll(); // Hide all bootbox
											location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"];
										}, 1500)
									}
									else
									{
										show_warning(res.message);
										setTimeout(function(){
											bootbox.hideAll(); // Hide all bootbox
										}, 1500)
									}
								}
							});
						}

						ko.applyBindings(App);
					</script>