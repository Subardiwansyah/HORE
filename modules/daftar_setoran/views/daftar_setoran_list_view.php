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
													<div class="col-md-12">
														<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
															<i class="fal fa-file-search"></i>&nbsp;&nbsp;
															FILTER DATA
														</h5>

														<div class="card mb-3">
															<div class="card-body">
																<div class="form-row">
																	<div class="col-md-5 col-sm-5 col-xs-12 mb-3">
																		<label class="form-label" for="periode">Bulan </label>
																		<input type="text" style="width:100%" class="select2" id="periode" data-bind="value: periode" />
																	</div>
																	<div class="col-md-7 col-sm-7 col-xs-12 mb-3">
																		<button type="button" class="btn btn-sm btn-primary mt-4" id="btn-tampil-2" data-bind="click: tampil">
																			<i class="fal fa-search"></i>
																			Tampilkan
																		</button>
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
														<div class="table-responsive">
														
															<table id="dt_table" class="table table-bordered table-sm table-striped" style="width:100%;">
																<thead class="bg-primary-100">
																	<tr>
																		<th>No</th>
																		<th>ID Sales</th>
																		<th>Nama</th>
																		<th>TAP</th>
																		<th>Cluster</th>
																		<th>Penjualan</th>
																		<th>Sudah Setor</th>
																		<th>Belum Setor</th>
																	</tr>
																</thead>
															</table>
														
														</div>
													</div>
												</div>
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
										'bulan': App.bulan,
										'tahun': App.tahun
									}
								},
								deferRender: true
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);
							self.periode = ko.observable("<?php echo date('M-Y', strtotime(date('Y-m-d'))); ?>");
							self.tahun = ko.observable("<?php echo date('Y'); ?>");
							self.bulan = ko.observable("<?php echo date('m'); ?>");

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
							var bulan = App.bulan() ? App.bulan() : '';

							if (bulan == '')
							{
								show_warning('Silakan pilih bulan terlebih dahulu');
								return false;
							}

							$('#dt_table').DataTable().ajax.reload();
						}

						function lihat_nota(id_sales)
						{
							var id_sales = id_sales;
							var tahun = App.tahun();
							var bulan = App.bulan();

							show_dialog_large(600, 500, 'DAFTAR NOTA PEMBAYARAN YANG BELUM DISETOR', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/nota_belum_disetor/' + id_sales + '/' + tahun + '/' + bulan);
						}

						ko.applyBindings(App);
					</script>