					<main class="page-content">
						<ol class="breadcrumb page-breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>beranda"><i class="fal fa-home"></i> Beranda</a></li>
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
													<i class="fal fa-building"></i>&nbsp;&nbsp;
													IDENTITAS POI
												</h5>

												<div class="card mb-3">
													<div class="card-body">
														<div class="form-row">
															<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: nm_poi">
																<label class="form-label" for="nm_poi">Nama POI <span class="text-danger">*</span> </label>
																<input type="text" class="form-control form-control-sm" id="nm_poi" data-bind="value: nm_poi">
															</div>
														</div>

														<div class="form-row">
															<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="validationElement: id_provinsi">
																<label class="form-label" for="nm_provinsi">Provinsi <span class="text-danger">*</span> </label>
																<input type="text" style="width:100%" class="select2" id="nm_provinsi" data-bind="value: nm_provinsi" />
															</div>
															<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="validationElement: id_kab">
																<label class="form-label" for="nm_kab">Kota/Kab <span class="text-danger">*</span> </label>
																<input type="text" style="width:100%" class="select2" id="nm_kab" data-bind="value: nm_kab" />
															</div>
															<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="validationElement: id_kec">
																<label class="form-label" for="nm_kec">Kecamatan <span class="text-danger">*</span> </label>
																<input type="text" style="width:100%" class="select2" id="nm_kec" data-bind="value: nm_kec" />
															</div>
														</div>

														<div class="form-row">
															<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																<label class="form-label" for="nm_kel">Kelurahan </label>
																<input type="text" style="width:100%" class="select2" id="nm_kel" data-bind="value: nm_kel" />
															</div>
															<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="validationElement: alamat">
																<label class="form-label" for="alamat">Alamat <span class="text-danger">*</span> </label>
																<input type="text" class="form-control form-control-sm" id="alamat" data-bind="value: alamat">
															</div>
															<div class="col-md-2 col-sm-2 col-xs-12 mb-3" data-bind="validationElement: longitude">
																<label class="form-label" for="longitude">Longitude <span class="text-danger">*</span> </label>
																<input type="text" class="form-control form-control-sm" id="longitude" data-bind="value: longitude">
															</div>
															<div class="col-md-2 col-sm-2 col-xs-12 mb-3" data-bind="validationElement: latitude">
																<label class="form-label" for="latitude">Latitude <span class="text-danger">*</span> </label>
																<input type="text" class="form-control form-control-sm" id="latitude" data-bind="value: latitude">
															</div>
														</div>

														<div class="form-row">
															<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="validationElement: id_tap">
																<label class="form-label" for="nm_tap">TAP <span class="text-danger">*</span> </label>
																<input type="text" style="width:100%" class="select2" id="nm_tap" data-bind="value: nm_tap" />
															</div>
														</div>

														<hr>

														<div class="form-row">
															<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																<label class="form-label" for="status">Status </label>
																<select class="form-control form-control-sm" id="status" data-bind="disable: App.id() == '0', options: list_status, optionsValue:'id', optionsText:'uraian', value: status"></select>
															</div>
															<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="visible: App.id() === '0'">
																<label class="form-label" for="tgl_open">Tgl Open </label>
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control form-control-sm datepicker" id="tgl_open" data-bind="disable: true, value: tgl_open" value="<?php echo isset($data['tgl_open']) ? format_date($data['tgl_open']) : date('d/m/Y'); ?>">
																	<div class="input-group-append">
																		<span class="input-group-text fs-xl">
																			<i class="fal fa-calendar-alt"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="visible: App.status() === 'CLOSE'">
																<label class="form-label" for="tgl_close">Tgl Close </label>
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control form-control-sm datepicker" id="tgl_close" data-bind="disable: true, value: tgl_close" value="<?php echo isset($data['tgl_close']) ? format_date($data['tgl_close']) : date('d/m/Y'); ?>">
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

												<!-- End -->
											</div>
											<div class="panel-content py-3 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right">
												<button type="button" class="btn btn-sm btn-primary" id="btn-batal" data-bind="click: back"><i class="fal fa-times"></i> Batal</button>
												<button type="button" class="btn btn-sm btn-primary" id="btn-simpan" data-bind="click: save"><i class="fal fa-save"></i> Simpan</button>
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

						$(document).ready(function()
						{
							$('#nm_provinsi').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_provinsi_inmaster',
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
								placeholder: 'Pilih Provinsi',
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
							$('#nm_provinsi').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_provinsi');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_provinsi(e.added ? e.added.id : '');
									App.nm_provinsi(e.added ? e.added.nama : '');

									App.id_kab(0);
									App.nm_kab('');
									App.id_kec(0);
									App.nm_kec('');
									App.id_kel(0);
									App.nm_kel('');
									App.id_tap(0);
									App.nm_tap('');
									$('#nm_kab').select2('val', null);
									$('#nm_kec').select2('val', null);
									$('#nm_kel').select2('val', null);
									$('#nm_tap').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_kab').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_kabupaten_inmaster',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_provinsi': App.id_provinsi(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Kota/Kab',
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
							$('#nm_kab').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_kab');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_kab(e.added ? e.added.id : '');
									App.nm_kab(e.added ? e.added.nama : '');

									App.id_kec(0);
									App.nm_kec('');
									App.id_kel(0);
									App.nm_kel('');
									App.id_tap(0);
									App.nm_tap('');
									$('#nm_kec').select2('val', null);
									$('#nm_kel').select2('val', null);
									$('#nm_tap').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_kec').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_kecamatan_inmaster',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_kab': App.id_kab(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Kecamatan',
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
							$('#nm_kec').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_kec');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_kec(e.added ? e.added.id : '');
									App.nm_kec(e.added ? e.added.nama : '');

									App.id_kel(0);
									App.nm_kel('');
									App.id_tap(0);
									App.nm_tap('');
									$('#nm_kel').select2('val', null);
									$('#nm_tap').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_kel').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_kelurahan_inmaster',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_kec': App.id_kec(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Kelurahan',
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
							$('#nm_kel').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_kel');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_kel(e.added ? e.added.id : '');
									App.nm_kel(e.added ? e.added.nama : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_tap').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_tap_by_lokasi',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_kec': App.id_kec(),
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

									return false;
								}
								e.stopPropagation();
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable("<?php echo isset($data['id_poi']) ? $data['id_poi'] : 0 ?>");
							self.nm_poi = ko.observable("<?php echo isset($data['nama_poi']) ? $data['nama_poi'] : '' ?>")
								.extend({
									required: {params: true, message: 'Nama POI tidak boleh kosong'}
							});
							self.id_provinsi = ko.observable("<?php echo isset($data['id_provinsi']) ? $data['id_provinsi'] : '' ?>")
								.extend({
									required: {params: true, message: 'Provinsi tidak boleh kosong'}
							});
							self.nm_provinsi = ko.observable("<?php echo isset($data['nama_provinsi']) ? $data['nama_provinsi'] : '' ?>");
							self.id_kab = ko.observable("<?php echo isset($data['id_kabupaten']) ? $data['id_kabupaten'] : '' ?>")
								.extend({
									required: {params: true, message: 'Kota/Kab tidak boleh kosong'}
							});
							self.nm_kab = ko.observable("<?php echo isset($data['nama_kabupaten']) ? $data['nama_kabupaten'] : '' ?>");
							self.id_kec = ko.observable("<?php echo isset($data['id_kecamatan']) ? $data['id_kecamatan'] : '' ?>")
								.extend({
									required: {params: true, message: 'Kecamatan tidak boleh kosong'}
							});
							self.nm_kec = ko.observable("<?php echo isset($data['nama_kecamatan']) ? $data['nama_kecamatan'] : '' ?>");
							self.id_kel = ko.observable("<?php echo isset($data['id_kelurahan']) ? $data['id_kelurahan'] : '' ?>");
							self.nm_kel = ko.observable("<?php echo isset($data['nama_kelurahan']) ? $data['nama_kelurahan'] : '' ?>");
							self.alamat = ko.observable("<?php echo isset($data['alamat_poi']) ? $data['alamat_poi'] : '' ?>")
								.extend({
									required: {params: true, message: 'Alamat tidak boleh kosong'}
							});
							self.longitude = ko.observable("<?php echo isset($data['longitude']) ? $data['longitude'] : '' ?>")
								.extend({
									required: {params: true, message: 'Longitude tidak boleh kosong'}
							});
							self.latitude = ko.observable("<?php echo isset($data['latitude']) ? $data['latitude'] : '' ?>")
								.extend({
									required: {params: true, message: 'Latitude tidak boleh kosong'}
							});
							self.id_tap = ko.observable("<?php echo isset($data['id_tap']) ? $data['id_tap'] : '' ?>")
								.extend({
									required: {params: true, message: 'TAP tidak boleh kosong'}
							});
							self.nm_tap = ko.observable("<?php echo isset($data['nama_tap']) ? $data['nama_tap'] : '' ?>");
							self.status = ko.observable("<?php echo isset($data['status']) ? $data['status'] : 'OPEN' ?>");
							self.list_status = ko.observableArray([
								new opsi('OPEN', 'OPEN'),
								new opsi('CLOSE', 'CLOSE')
							]);
							self.tgl_open = ko.observable("<?php echo isset($data['tgl_open']) ? format_date($data['tgl_open']) : date('d/m/Y') ?>");
							self.tgl_close = ko.observable("<?php echo isset($data['tgl_close']) ? format_date($data['tgl_close']) : date('d/m/Y') ?>");

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

						App.back = function(){
							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"];
						}

						App.formValidation = function(){
							var errmsg = [];
							var tgl_open = $('#tgl_open').val();
							var tgl_close = $('#tgl_close').val();

							App.tgl_open(tgl_open);
							App.tgl_close(tgl_close);

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
											bootbox.hideAll(); // Hide all bootbox
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