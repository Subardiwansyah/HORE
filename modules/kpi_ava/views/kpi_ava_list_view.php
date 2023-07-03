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
															<label class="form-label" for="nm_branch">Branch </label>
															<input type="text" style="width:100%" class="select2" id="nm_branch" data-bind="value: nm_branch" />
														</div>

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
															<label class="form-label" for="pilperiode">Periode </label>
															<select class="select2" id="pilperiode" data-bind="value: pilperiode">
																<option></option>
																<option value="Yearly">Yearly</option>
																<option value="Quartely">Quartely</option>
																<option value="Monthly">Monthly</option>
																<option value="Weekly">Weekly</option>
															</select>
														</div>

														<div id="periode_tahun" style="display:none" class="col-md-2 col-sm-2 col-xs-12 mb-3">
															<label class="form-label" for="tahun">Tahun </label>
															<input type="text" style="width:100%" class="select2" id="tahun" data-bind="value: tahun" />
														</div>

														<div id="periode_kuartal" style="display:none" class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="kuartal">Kuartal </label>
															<input type="text" style="width:100%" class="select2" id="kuartal" data-bind="value: kuartal" />
														</div>

														<div id="periode_thnbulan" style="display:none" class="col-md-3 col-sm-3 col-xs-12 mb-3">
															<label class="form-label" for="thnbulan">Bulan </label>
															<input type="text" style="width:100%" class="select2" id="thnbulan" data-bind="value: thnbulan" />
														</div>

														<div id="periode_minggu" style="display:none" class="col-md-2 col-sm-2 col-xs-12 mb-3">
															<label class="form-label" for="minggu">Minggu </label>
															<input type="text" style="width:100%" class="select2" id="minggu" data-bind="value: minggu" />
														</div>

														<div class="col-md-2 col-sm-2 col-xs-12 mb-3">
															<button type="button" class="btn btn-sm btn-primary mt-4" id="btn-tampil" data-bind="click: tampil">
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

											<div id="konten_kpi_ava"></div>

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
							$('#nm_branch').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_branch_inmaster',
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
								placeholder: 'Pilih Branch',
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
							$('#nm_branch').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_branch');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_branch(e.added ? e.added.id : '');
									App.nm_branch(e.added ? e.added.nama : '');

									App.id_cluster('');
									App.nm_cluster('');
									App.id_tap('');
									App.nm_tap('');

									$('#nm_cluster').select2('val', null);
									$('#nm_tap').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_cluster').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_cluster_inbranch',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_branch': App.id_branch(),
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

									$('#nm_tap').select2('val', null);

									return false;
								}
								e.stopPropagation();
							});

							$('#nm_tap').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_tap_incluster_inKPI',
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

									return false;
								}
								e.stopPropagation();
							});


							$('#pilperiode').select2({
								placeholder: 'Pilih Periode',
								allowClear: true
							});
							$('#pilperiode').on('change', function(e){
								var data = $('#pilperiode').val();

								App.pilperiode(data);
							});

							$('#tahun').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_tahun_inmaster',
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

							$('#kuartal').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_periodekuartal',
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
								placeholder: 'Pilih Kuartal',
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
							$('#kuartal').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('kuartal');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									App.kuartal(e.added ? e.added.id : '');
									App.tahun_kuartal(e.added ? e.added.tahun : '');
									App.bulan_kuartal(e.added ? e.added.bulan : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#thnbulan').select2({
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
							$('#thnbulan').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('thnbulan');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									App.thnbulan(e.added ? e.added.id : '');
									App.tahun(e.added ? e.added.tahun : '');
									App.bulan(e.added ? e.added.bulan : '');

									return false;
								}
								e.stopPropagation();
							});

							$('#minggu').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_minggu',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'tahun': App.tahun(),
											'bulan': App.bulan(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Minggu',
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
							$('#minggu').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('minggu');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									App.minggu(e.added ? e.added.id : '');

									return false;
								}
								e.stopPropagation();
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);

							self.id_branch = ko.observable("");
							self.nm_branch = ko.observable("");
							self.id_cluster = ko.observable("");
							self.nm_cluster = ko.observable("");
							self.id_tap = ko.observable("");
							self.nm_tap = ko.observable("");

							self.pilperiode = ko.observable("");

							self.kuartal = ko.observable("");
							self.tahun_kuartal = ko.observable("");
							self.bulan_kuartal = ko.observable("");

							self.thnbulan = ko.observable("<?php echo date('M-Y', strtotime(date('Y-m-d'))); ?>");

							self.tahun = ko.observable("<?php echo date('Y'); ?>");
							self.bulan = ko.observable("<?php echo date('m'); ?>");
							self.minggu = ko.observable("");

							self.pilperiode.subscribe(function(){
								var pilih = App.pilperiode();

								if (pilih == 'Yearly')
								{
									$('#periode_tahun').show();
									$('#periode_kuartal').hide();
									$('#periode_thnbulan').hide();
									$('#periode_minggu').hide();
								}
								else if (pilih == 'Quartely')
								{
									$('#periode_tahun').hide();
									$('#periode_kuartal').show();
									$('#periode_thnbulan').hide();
									$('#periode_minggu').hide();
								}
								else if (pilih == 'Monthly')
								{
									$('#periode_tahun').hide();
									$('#periode_kuartal').hide();
									$('#periode_thnbulan').show();
									$('#periode_minggu').hide();
								}
								else if (pilih == 'Weekly')
								{
									$('#periode_tahun').hide();
									$('#periode_kuartal').hide();
									$('#periode_thnbulan').show();
									$('#periode_minggu').show();
								}
								else
								{
									$('#periode_tahun').hide();
									$('#periode_kuartal').hide();
									$('#periode_thnbulan').hide();
									$('#periode_minggu').hide();
								}
							});

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
							var id_branch = App.id_branch() ? App.id_branch() : 0;
							var id_cluster = App.id_cluster() ? App.id_cluster() : 0;
							var id_tap = App.id_tap() ? App.id_tap() : 0;
							var pilperiode = App.pilperiode() ? App.pilperiode() : 0;
							var kuartal = App.kuartal() ? App.kuartal() : 0;
							var tahun_kuartal = App.tahun_kuartal() ? App.tahun_kuartal() : 0;
							var bulan_kuartal = App.bulan_kuartal() ? App.bulan_kuartal() : 0;
							var thnbulan = App.thnbulan() ? App.thnbulan() : 0;
							var tahun = App.tahun() ? App.tahun() : 0;
							var bulan = App.bulan() ? App.bulan() : 0;
							var minggu = App.minggu() ? App.minggu() : 0;

							if (id_branch == 0)
							{
								show_warning('Silakan pilih branch terlebih dahulu');
								return false;
							}

							if (id_cluster == 0)
							{
								show_warning('Silakan pilih cluster terlebih dahulu');
								return false;
							}

							if (id_tap == 0)
							{
								show_warning('Silakan pilih tap terlebih dahulu');
								return false;
							}

							if (pilperiode == 0)
							{
								show_warning('Silakan pilih periode terlebih dahulu');
								return false;
							}

							if (pilperiode == 'Yearly')
							{
								if (tahun == 0)
								{
									show_warning('Silakan pilih tahun terlebih dahulu');
									return false;
								}
							}
							else if (pilperiode == 'Quartely')
							{
								if (kuartal == 0)
								{
									show_warning('Silakan pilih kuartal terlebih dahulu');
									return false;
								}
							}
							else if (pilperiode == 'Monthly')
							{
								if (thnbulan == 0)
								{
									show_warning('Silakan pilih bulan terlebih dahulu');
									return false;
								}
							}
							else if (pilperiode == 'Weekly')
							{
								if (tahun == 0)
								{
									show_warning('Silakan pilih bulan terlebih dahulu');
									return false;
								}

								if (minggu == 0)
								{
									show_warning('Silakan pilih minggu terlebih dahulu');
									return false;
								}
							}

							$('#pesan_filter').hide();

							$('#konten_kpi_ava').load(
								GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/konten_kpi_ava_form/' +
								id_tap + '/' +
								pilperiode + '/' +
								tahun_kuartal + '/' +
								bulan_kuartal + '/' +
								tahun + '/' +
								bulan + '/' +
								minggu + '/'
							);
						}

						ko.applyBindings(App);
					</script>