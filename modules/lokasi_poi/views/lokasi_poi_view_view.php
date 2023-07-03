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

												<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
													<li class="nav-item">
														<a class="nav-link active" data-toggle="tab" href="#tab_profile" role="tab">
															<i class="fal fa-user mr-1 text-primary"></i>
															Profile
														</a>
													</li>
													<?php $flat = isset($data['status']) ? $data['status'] : 'OPEN'; ?>
													<?php if ($flat !== 'WAITING APPROVAL' && $flat !== 'REJECTED') { ?>
													<li class="nav-item">
														<a class="nav-link" data-toggle="tab" href="#tab_coverage" role="tab">
															<i class="fal fa-search-location mr-1 text-success"></i>
															Coverage
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-toggle="tab" href="#tab_distribusi" role="tab">
															<i class="fal fa-luggage-cart mr-1 text-danger"></i>
															Distribusi
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-toggle="tab" href="#tab_promotion" role="tab">
															<i class="fal fa-bullhorn mr-1 text-dark"></i>
															Promotion
														</a>
													</li>
													<?php } ?>
												</ul>
												<div class="tab-content my-3">
													<div class="tab-pane fade show active" id="tab_profile" role="tabpanel">
														<!-- Begin Tab Profile -->
														<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
															<i class="fal fa-building"></i>&nbsp;&nbsp;
															IDENTITAS POI
														</h5>

														<div class="card mb-3">
															<div class="card-body">
																<div class="form-row">
																	<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="validationElement: id_poi">
																		<label class="form-label" for="id_poi">ID POI <span class="text-danger">*</span> </label>
																		<input type="text" class="form-control form-control-sm" id="id_poi" data-bind="disable: true, value: id_poi">
																	</div>
																	<div class="col-md-8 col-sm-8 col-xs-12 mb-3" data-bind="validationElement: nm_poi">
																		<label class="form-label" for="nm_poi">Nama POI <span class="text-danger">*</span> </label>
																		<input type="text" class="form-control form-control-sm" id="nm_poi" data-bind="disable: true, value: nm_poi">
																	</div>
																</div>

																<div class="form-row">
																	<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="validationElement: id_provinsi">
																		<label class="form-label" for="nm_provinsi">Provinsi <span class="text-danger">*</span> </label>
																		<input type="text" style="width:100%" class="select2" id="nm_provinsi" data-bind="disable: true, value: nm_provinsi" />
																	</div>
																	<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="validationElement: id_kab">
																		<label class="form-label" for="nm_kab">Kota/Kab <span class="text-danger">*</span> </label>
																		<input type="text" style="width:100%" class="select2" id="nm_kab" data-bind="disable: true, value: nm_kab" />
																	</div>
																	<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="validationElement: id_kec">
																		<label class="form-label" for="nm_kec">Kecamatan <span class="text-danger">*</span> </label>
																		<input type="text" style="width:100%" class="select2" id="nm_kec" data-bind="disable: true, value: nm_kec" />
																	</div>
																</div>

																<div class="form-row">
																	<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																		<label class="form-label" for="nm_kel">Kelurahan </label>
																		<input type="text" style="width:100%" class="select2" id="nm_kel" data-bind="disable: true, value: nm_kel" />
																	</div>
																	<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="validationElement: alamat">
																		<label class="form-label" for="alamat">Alamat <span class="text-danger">*</span> </label>
																		<input type="text" class="form-control form-control-sm" id="alamat" data-bind="disable: true, value: alamat">
																	</div>
																	<div class="col-md-2 col-sm-2 col-xs-12 mb-3" data-bind="validationElement: longitude">
																		<label class="form-label" for="longitude">Longitude <span class="text-danger">*</span> </label>
																		<input type="text" class="form-control form-control-sm" id="longitude" data-bind="disable: true, value: longitude">
																	</div>
																	<div class="col-md-2 col-sm-2 col-xs-12 mb-3" data-bind="validationElement: latitude">
																		<label class="form-label" for="latitude">Latitude <span class="text-danger">*</span> </label>
																		<input type="text" class="form-control form-control-sm" id="latitude" data-bind="disable: true, value: latitude">
																	</div>
																</div>

																<div class="form-row">
																		<div class="col-md-4 col-sm-4 col-xs-12 mb-3" data-bind="validationElement: id_tap">
																			<label class="form-label" for="nm_tap">TAP <span class="text-danger">*</span> </label>
																			<input type="text" style="width:100%" class="select2" id="nm_tap" data-bind="disable: true, value: nm_tap" />
																		</div>
																	</div>

																	<hr>

																<div class="form-row">
																	<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																		<label class="form-label" for="status">Status </label>
																		<select class="form-control form-control-sm" id="status" data-bind="disable: true, options: list_status, optionsValue:'id', optionsText:'uraian', value: status"></select>
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
														<!-- End Tab Profile -->
													</div>
													<div class="tab-pane fade" id="tab_coverage" role="tabpanel">
														<!-- Begin Tab Coverage -->
														<div class="form-row">
															<div class="col-md-12 col-sm-12 col-xs-12 mb-2 text-right">
																<a target="_blank" href="https://www.google.com/maps/place/'<?php echo $data['latitude']; ?>,<?php echo $data['longitude']; ?>'/@'<?php echo $data['latitude']; ?>','<?php echo $data['longitude']; ?>'">
																	<button type="button" class="btn btn-sm btn-primary" id="btn-tampil-lokasi">
																		<i class="fal fa-map-marker-alt"></i>
																		Lihat Lokasi
																	</button>
																</a>
															</div>
														</div>
														<br>
                                                        <div class = "table-responsive">
    														<table id="dt_table_5" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    															<thead class="bg-primary-100">
    																<tr>
    																	<th>Tanggal</th>
    																	<th>Petugas</th>
    																	<th>Clock In</th>
    																	<th>Clock Out</th>
    																	<th>Durasi (Menit)</th>
    																	<th>Status</th>
    																</tr>
    															</thead>
    														</table>
    													</div>
														<!-- End Tab Coverage -->
													</div>
													<div class="tab-pane fade" id="tab_distribusi" role="tabpanel">
														<!-- Begin Tab Distribusi -->
														<div id ="div_table_distribusi">
														    <div class = "table-responsive">
    															<table id="dt_table_6" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    																<thead class="bg-primary-100">
    																	<tr>
    																		<!-- <th>Aksi</th> -->
    																		<th>Tanggal</th>
    																		<th>Petugas</th>
    																		<th>Total Perdana</th>
    																		<th>Total Voucher</th>
    																	</tr>
    																</thead>
    															</table>
    														</div>
														</div>

														<div id ="div_table_distribusi_nota" style="display:none">
															<button type="button" class="btn btn-sm btn-primary mb-3" id="btn-kembali" data-bind="click: kembali"><i class="fal fa-arrow-alt-left"></i> Kembali</button>

															<div id="loading_nota" style="display:none">
																<div class="spinner-border" role="status">
																	<span class="sr-only">Loading...</span>
																</div>
															</div>
															<div id="konten_nota"></div>
														</div>
														<!-- End Tab Distribusi -->
													</div>
													<div class="tab-pane fade" id="tab_merchandising" role="tabpanel">
														<!-- Begin Tab Merchandising -->
														<div class = "table-responsive">
    														<table id="dt_table_7" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    															<thead class="bg-primary-100">
    																<tr>
    																	<th>Aksi</th>
    																	<th>Tanggal</th>
    																	<th>Petugas</th>
    																</tr>
    															</thead>
    														</table>
    													</div>
														<!-- End Tab Merchandising -->
													</div>
													<div class="tab-pane fade" id="tab_promotion" role="tabpanel">
														<!-- Begin Tab Promotion -->
														<div class = "table-responsive">
    														<table id="dt_table_8" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    															<thead class="bg-primary-100">
    																<tr>
    																	<th>Tanggal</th>
    																	<th>Petugas</th>
    																	<th>Jumlah Promotion</th>
    																</tr>
    															</thead>
    														</table>
    													</div>
														<!-- End Tab Promotion -->
													</div>
												</div>

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

						$(document).ready(function()
						{
							$('#nm_provinsi').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_provinsi',
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
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_kabupaten',
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
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_kecamatan',
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
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_kelurahan',
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

							$('#dt_table_5').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_5',
									'type': 'POST',
									'data': {'id_lokasi': App.id}
								},
								deferRender: true
							});

							$('#dt_table_6').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_6',
									type: 'POST',
									data: {'id_lokasi': App.id}
								},
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							});

							/* $('#dt_table_7').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_7',
									type: 'POST',
									data: {'id_lokasi': App.id}
								},
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							}); */

							$('#dt_table_8').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_8',
									type: 'POST',
									data: {'id_lokasi': App.id}
								},
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
							self.id = ko.observable("<?php echo isset($data['id_poi']) ? $data['id_poi'] : 0 ?>");
							self.id_poi = ko.observable("<?php echo isset($data['id_poi']) ? $data['id_poi'] : '' ?>")
								.extend({
									required: {params: true, message: 'ID POI tidak boleh kosong'}
							});
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
								return (self.mode() === 'edit' ? 'Lihat ' : 'Tambah ') + self.modul;
							});

							self.isEdit = ko.computed(function(){
								return self.mode() === 'edit';
							});

							self.errors = ko.validation.group(self);
						}

						var App = new ModelForm();

						App.kembali = function(){
							$('#div_table_distribusi').show();
							$('#div_table_distribusi_nota').hide();
						}

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

						/* function lihat_distribusi_foto(tgl, id_sales)
						{
							show_dialog(600, 500, 'Distribusi Foto', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/distribusi_foto/' + tgl + '/' + id_sales + '/' + App.id());
						} */

						/* function lihat_distribusi_nota(tgl, id_sales)
						{
							$('#div_table_distribusi').hide();
							$('#div_table_distribusi_nota').show();

							reload_distribusi_nota(tgl, id_sales);
						} */

						/* function reload_distribusi_nota(tgl, id_sales){
							var html = '';
							var no = 1;

							$('#loading_nota').show();
							$('#konten_nota').hide();

							html +=
								" <table id='dt_table_nota' class='table table-bordered table-hover w-100'>" +
								"		<thead class='bg-primary-100'>" +
								"			<tr>" +
								"				<th>Aksi</th>" +
								"				<th>No Nota</th>" +
								"				<th>Produk <br>Amout (Rp)</th>" +
								"				<th>Link Aja <br>Amout (Rp)</th>" +
								"				<th>Total <br>Amout (Rp)</th>" +
								"			</tr>" +
								"		</thead>" +
								"		<tbody>";

							$.ajax({
								type: 'POST',
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_list_distribusi_nota',
								async: false,
								dataType: 'json',
								data:{
									tgl: tgl,
									id_sales: id_sales,
									id_lokasi: App.id(),
								},
								success: function(response){
									var result = response.rows;
									var len = response.len;

									if (len > 0)
									{
										for (i = 0; i < len; i++)
										{
											html +=
												" <tr>" +
												"		<td>" +
												"			<div align='center'>" +
												"				<button onClick='lihat_nota(\"" + result[i]['no_nota'] + "\")' type='button' class='btn btn-primary btn-sm btn-icon waves-effect waves-themed' title='Lihat Nota'>" +
												"					<i class='fal fa-eye'></i>" +
												"				</button>" +
												"				<button onClick='download_sn(\"" + result[i]['no_nota'] + "\")' type='button' class='btn btn-primary btn-sm btn-icon waves-effect waves-themed' title='Download SN'>" +
												"					<i class='fal fa-download'></i>" +
												"				</button>" +
												"			</div>" +
												"		</td>" +
												"		<td>" + result[i]['no_nota'] + "</td>" +
												"		<td><div align='right'>" + result[i]['amount_produk'] + "</div></td>" +
												"		<td><div align='right'>" + result[i]['amount_la'] + "</div></td>" +
												"		<td><div align='right'>" + result[i]['total_amount'] + "</div></td>" +
												"	</tr>";
										}
									}
									else
									{
										html +=
												" <tr>" +
												"		<td>&nbsp;</td>" +
												"		<td>&nbsp;</td>" +
												"		<td>&nbsp;</td>" +
												"		<td>&nbsp;</td>" +
												"		<td>&nbsp;</td>" +
												"	</tr>";
									}
								}
							});

							html +=
								"		</tbody>" +
								"	</table>";

							$('#loading_nota').hide();
							$('#konten_nota').show();
							$('#konten_nota').html(html);
						} */

						/* function lihat_nota(nota)
						{
							show_dialog(600, 500, 'Nota Pembayaran', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/download_distribusi_nota/' + nota);
						} */

						/* function download_sn(nota)
						{
							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/download_distribusi_sn/' + nota;
						}
 */
						function lihat_distribusi(tgl, id_sales, jns_produk)
						{
							show_dialog_large(600, 500, 'Distribusi', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/distribusi/' + tgl + '/' + id_sales + '/' + App.id() + '/' + jns_produk);
						}

						function lihat_merchandising(tgl, id_sales, jns_share)
						{
							show_dialog_large(600, 500, 'Merchandising', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/merchandising/' + tgl + '/' + id_sales + '/' + App.id() + '/' + jns_share);
						}

						function lihat_promotion(tgl, id_sales)
						{
							show_dialog_large(600, 500, 'Promotion', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/promotion/' + tgl + '/' + id_sales + '/' + App.id());
						}

						ko.applyBindings(App);
					</script>