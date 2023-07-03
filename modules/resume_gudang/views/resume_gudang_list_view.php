


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
										<div class="panel-toolbar">
											<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
										</div>
									</div>
									<div class="panel-container show">
										<div class="panel-content">

											<?php $id_level = $this->session->userdata('ID_LEVEL'); ?>

											<ul class="nav nav-tabs nav-tabs-clean" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab">
														<i class="fal fa-address-card mr-1 text-danger"></i>
														Resume Per&nbsp;<?php if (in_array($id_level, array(1, 2))) { echo 'Cluster'; } else if (in_array($id_level, array(3))) { echo 'TAP'; } else if (in_array($id_level, array(4))) { echo 'Sales'; } ?>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab-2" role="tab">
														<i class="fal fa-barcode-read mr-1 text-success"></i>
														Resume SN Produk
													</a>
												</li>
											</ul>
											<div class="tab-content my-3">
												<div class="tab-pane fade show active" id="tab-1" role="tabpanel">
													<!-- Begin Tab 1 -->

													<?php if (in_array($id_level, array(1, 2))){ ?>
													<!-- Login Regional atau Branch -->
													
													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-search"></i>&nbsp;&nbsp;
														FILTER DATA
													</h5>
													
													<div class="card mb-3">
														<div class="card-body">
														
															<div class="form-row">
																<div class="col-md-6 col-sm-6 col-xs-12 mb-3">
																	<label class="form-label" for="nm_cluster">Cluster </label>
																	<input type="text" style="width:100%" class="select2" id="nm_cluster" data-bind="value: nm_cluster" />
																</div>
															</div>

															<div class="form-row">
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="tgl_awal_tab1_1_2">Tgl Awal </label>
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control form-control-sm datepicker" id="tgl_awal_tab1_1_2" data-bind="value: tgl_awal_tab1_1_2" value="<?php echo date('d/m/Y') ?>">
																		<div class="input-group-append">
																			<span class="input-group-text fs-xl">
																				<i class="fal fa-calendar-alt"></i>
																			</span>
																		</div>
																	</div>
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="tgl_akhir_tab1_1_2">Tgl Akhir </label>
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control form-control-sm datepicker" id="tgl_akhir_tab1_1_2" data-bind="value: tgl_akhir_tab1_1_2" value="<?php echo date('d/m/Y') ?>">
																		<div class="input-group-append">
																			<span class="input-group-text fs-xl">
																				<i class="fal fa-calendar-alt"></i>
																			</span>
																		</div>
																	</div>
																</div>
															</div>

															<div class="form-row">
																<div class="col-md-6 col-sm-6 col-xs-12 mb-3 text-right">
																	<button type="button" class="btn btn-sm btn-primary" id="btn-download-1" data-bind="click: download_tab1_1_2"><i class="fal fa-download"></i> Download</button>
																</div>
															</div>
														
														</div>
													</div>
													
													<?php } else if (in_array($id_level, array(3))){ ?>
													<!-- Login Cluster -->
													
													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-search"></i>&nbsp;&nbsp;
														FILTER DATA
													</h5>
													
													<div class="card mb-3">
														<div class="card-body">
														
															<div class="form-row">
																<div class="col-md-6 col-sm-6 col-xs-12 mb-3">
																	<label class="form-label" for="nm_tap">TAP </label>
																	<input type="text" style="width:100%" class="select2" id="nm_tap" data-bind="value: nm_tap" />
																</div>
															</div>

															<div class="form-row">
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="tgl_awal_tab1_3">Tgl Awal </label>
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control form-control-sm datepicker" id="tgl_awal_tab1_3" data-bind="value: tgl_awal_tab1_3" value="<?php echo date('d/m/Y') ?>">
																		<div class="input-group-append">
																			<span class="input-group-text fs-xl">
																				<i class="fal fa-calendar-alt"></i>
																			</span>
																		</div>
																	</div>
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="tgl_akhir_tab1_3">Tgl Akhir </label>
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control form-control-sm datepicker" id="tgl_akhir_tab1_3" data-bind="value: tgl_akhir_tab1_3" value="<?php echo date('d/m/Y') ?>">
																		<div class="input-group-append">
																			<span class="input-group-text fs-xl">
																				<i class="fal fa-calendar-alt"></i>
																			</span>
																		</div>
																	</div>
																</div>
															</div>

															<div class="form-row">
																<div class="col-md-6 col-sm-6 col-xs-12 mb-3 text-right">
																	<button type="button" class="btn btn-sm btn-primary" id="btn-download-2" data-bind="click: download_tab1_3"><i class="fal fa-download"></i> Download</button>
																</div>
															</div>
														
														</div>
													</div>
													
													<?php } else if (in_array($id_level, array(4))){ ?>
													<!-- Login TAP -->
													
													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-search"></i>&nbsp;&nbsp;
														FILTER DATA
													</h5>
													
													<div class="card mb-3">
														<div class="card-body">
														
															<div class="form-row">
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="nm_jns_sales">Jenis Sales </label>
																	<input type="text" style="width:100%" class="select2" id="nm_jns_sales" data-bind="value: nm_jns_sales" />
																</div>
																<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																	<label class="form-label" for="nm_sales">Nama Sales </label>
																	<input type="text" style="width:100%" class="select2" id="nm_sales" data-bind="value: nm_sales" />
																</div>
															</div>

															<div class="form-row">
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="tgl_awal_tab1_4">Tgl Awal </label>
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control form-control-sm datepicker" id="tgl_awal_tab1_4" data-bind="value: tgl_awal_tab1_4" value="<?php echo date('d/m/Y') ?>">
																		<div class="input-group-append">
																			<span class="input-group-text fs-xl">
																				<i class="fal fa-calendar-alt"></i>
																			</span>
																		</div>
																	</div>
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="tgl_akhir_tab1_4">Tgl Akhir </label>
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control form-control-sm datepicker" id="tgl_akhir_tab1_4" data-bind="value: tgl_akhir_tab1_4" value="<?php echo date('d/m/Y') ?>">
																		<div class="input-group-append">
																			<span class="input-group-text fs-xl">
																				<i class="fal fa-calendar-alt"></i>
																			</span>
																		</div>
																	</div>
																</div>
															</div>

															<div class="form-row">
																<div class="col-md-6 col-sm-6 col-xs-12 mb-3 text-right">
																	<button type="button" class="btn btn-sm btn-primary" id="btn-download-3" data-bind="click: download_tab1_4"><i class="fal fa-download"></i> Download</button>
																</div>
															</div>
														
														</div>
													</div>
													
													<?php } ?>

													<!-- End Tab 1 -->
												</div>
												<div class="tab-pane fade" id="tab-2" role="tabpanel">
													<!-- Begin Tab 2 -->
													
													<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
														<i class="fal fa-search"></i>&nbsp;&nbsp;
														FILTER DATA
													</h5>
													
													<div class="card mb-3">
														<div class="card-body">
														
															<div class="form-row">
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="tgl_awal_tab2">Tgl Awal </label>
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control form-control-sm datepicker-2" id="tgl_awal_tab2" data-bind="value: tgl_awal_tab2" value="<?php echo date('d/m/Y') ?>">
																		<div class="input-group-append">
																			<span class="input-group-text fs-xl">
																				<i class="fal fa-calendar-alt"></i>
																			</span>
																		</div>
																	</div>
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																	<label class="form-label" for="tgl_akhir_tab2">Tgl Akhir </label>
																	<div class="input-group input-group-sm">
																		<input type="text" class="form-control form-control-sm datepicker-2" id="tgl_akhir_tab2" data-bind="value: tgl_akhir_tab2" value="<?php echo date('d/m/Y') ?>">
																		<div class="input-group-append">
																			<span class="input-group-text fs-xl">
																				<i class="fal fa-calendar-alt"></i>
																			</span>
																		</div>
																	</div>
																</div>
															</div>
															<!--
															<div class="form-group row">
																<label class="col-form-label col-12 col-lg-3 form-label text-lg-right">Minimum Setup</label>
																<div class="col-12 col-lg-6 ">
																	<input type="text" class="form-control" id="datepicker-1" placeholder="Select date" value="01/01/2018 - 01/15/2018">
																</div>
															</div>
															-->

															<div class="form-row">
																<div class="col-md-6 col-sm-6 col-xs-12 mb-3 text-right">
																	<button type="button" class="btn btn-sm btn-primary" id="btn-download-4" data-bind="click: download_tab2"><i class="fal fa-download"></i> Download</button>
																</div>
															</div>
														
														</div>
													</div>
													
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
						var controls = {
							leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
							rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
            }

						$(document).ready(function()
						{
							$('#datepicker-1').daterangepicker(
                {
                    opens: 'left'
                }, function(start, end, label)
                {
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });

							$('.datepicker').datepicker(
							{
								orientation: "top left",
								todayHighlight: true,
								templates: controls,
								format: "dd/mm/yyyy",
								autoclose: true
							});

							$('.datepicker-2').datepicker(
							{
								orientation: "bottom left",
								todayHighlight: true,
								templates: controls,
								format: "dd/mm/yyyy",
								autoclose: true
							});

							$('#nm_cluster').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_cluster',
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

									return false;
								}
								e.stopPropagation();
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

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_jns_sales').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_jenis_sales',
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

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_sales').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_sales',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_jns_sales': App.id_jns_sales() ? App.id_jns_sales() : 0,
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

									return false;
								}
								e.stopPropagation();
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);

							self.level = ko.observable("Cluster");

							self.id_cluster = ko.observable("");
							self.nm_cluster = ko.observable("");
							self.tgl_awal_tab1_1_2 = ko.observable("<?php echo date('d/m/Y') ?>");
							self.tgl_akhir_tab1_1_2 = ko.observable("<?php echo date('d/m/Y') ?>");

							self.id_tap = ko.observable("");
							self.nm_tap = ko.observable("");
							self.tgl_awal_tab1_3 = ko.observable("<?php echo date('d/m/Y') ?>");
							self.tgl_akhir_tab1_3 = ko.observable("<?php echo date('d/m/Y') ?>");

							self.id_jns_sales = ko.observable("");
							self.nm_jns_sales = ko.observable("");
							self.id_sales = ko.observable("");
							self.nm_sales = ko.observable("");
							self.tgl_awal_tab1_4 = ko.observable("<?php echo date('d/m/Y') ?>");
							self.tgl_akhir_tab1_4 = ko.observable("<?php echo date('d/m/Y') ?>");

							self.tgl_awal_tab2 = ko.observable("<?php echo date('d/m/Y') ?>");
							self.tgl_akhir_tab2 = ko.observable("<?php echo date('d/m/Y') ?>");

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

						App.download_tab1_1_2 = function(){
							console.log('Button download tab 1 - Level Regional/Branch');
						}

						App.download_tab1_3 = function(){
							console.log('Button download tab 1 - Level Cluster');
						}

						App.download_tab1_4 = function(){
							console.log('Button download tab 1 - Level TAP');
						}

						App.download_tab2 = function(){
							console.log('Button download tab 2');
						}

						ko.applyBindings(App);
					</script>