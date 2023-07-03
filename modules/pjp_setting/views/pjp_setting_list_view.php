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

												<?php $id_level = $this->session->userdata('ID_LEVEL'); ?>

												<div class="row">
													<div class="col-md-6">
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
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
															<i class="fal fa-address-card"></i>&nbsp;&nbsp;
															INFO SALES
														</h5>

														<div class="card mb-3">
															<div class="card-body" style="height:175px;">

																<div class="row">
																	<div class="col-md-2 col-sm-2 col-xs-3 mb-2">
																		<b>TAP</b>
																	</div>
																	<div class="col-md-10 col-sm-10 col-xs-9 mb-2">
																		:&nbsp;&nbsp;<span data-bind="text: nm_tap"></span>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-2 col-sm-2 col-xs-3 mb-2">
																		<b>Cluster</b>
																	</div>
																	<div class="col-md-10 col-sm-10 col-xs-9 mb-2">
																		:&nbsp;&nbsp;<span data-bind="text: nm_cluster"></span>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-2 col-sm-2 col-xs-3 mb-2">
																		<b>Branch</b>
																	</div>
																	<div class="col-md-10 col-sm-10 col-xs-9 mb-2">
																		:&nbsp;&nbsp;<span data-bind="text: nm_branch"></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<h5 class="keep-print-font fw-500 mb-3 text-primary flex-1 position-relative">
													<i class="fal fa-business-time"></i>&nbsp;&nbsp;
													SET JADWAL KUNJUNGAN
												</h5>

												<div class="card-deck">
													<div class="card border mb-g">
														<div class="card-header bg-primary-100 pr-3 d-flex align-items-center flex-wrap">
															<div class="card-title text-white">SENIN <br><small><?php echo format_date($list_tgl[0]->tanggal); ?></small></div>

															<button type="button" class="btn btn-default btn-icon rounded-circle hover-effect-dot waves-effect waves-themed ml-auto" onClick="tambah('SENIN', '<?php echo $list_tgl[0]->tanggal; ?>')" title="Tambah Tempat">
																<i class="fal fa-plus"></i>
															</button>

														</div>
														<div class="card-body">
															<div id="loading_senin" style="display:none">
																<div class="spinner-border" role="status">
																	<span class="sr-only">Loading...</span>
																</div>
															</div>
															<div id="konten_senin"></div>
														</div>
														<div class="card-footer">
															<span class="">Total Tempat : <span id="total_senin">0</span></span>
														</div>
													</div>

													<div class="card border mb-g">
														<div class="card-header bg-primary-100 pr-3 d-flex align-items-center flex-wrap">
															<div class="card-title text-white">SELASA <br><small><?php echo format_date($list_tgl[1]->tanggal); ?></small></div>

															<button type="button" class="btn btn-default btn-icon rounded-circle hover-effect-dot waves-effect waves-themed ml-auto" onClick="tambah('SELASA', '<?php echo $list_tgl[1]->tanggal; ?>')" title="Tambah Tempat">
																<i class="fal fa-plus"></i>
															</button>

														</div>
														<div class="card-body">
															<div id="loading_selasa" style="display:none">
																<div class="spinner-border" role="status">
																	<span class="sr-only">Loading...</span>
																</div>
															</div>
															<div id="konten_selasa"></div>
														</div>
														<div class="card-footer">
															<span class="">Total Tempat : <span id="total_selasa">0</span></span>
														</div>
													</div>

													<div class="card border mb-g">
														<div class="card-header bg-primary-100 pr-3 d-flex align-items-center flex-wrap">
															<div class="card-title text-white">RABU <br><small><?php echo format_date($list_tgl[2]->tanggal); ?></small></div>

															<button type="button" class="btn btn-default btn-icon rounded-circle hover-effect-dot waves-effect waves-themed ml-auto" onClick="tambah('RABU', '<?php echo $list_tgl[2]->tanggal; ?>')" title="Tambah Tempat">
																<i class="fal fa-plus"></i>
															</button>

														</div>
														<div class="card-body">
															<div id="loading_rabu" style="display:none">
																<div class="spinner-border" role="status">
																	<span class="sr-only">Loading...</span>
																</div>
															</div>
															<div id="konten_rabu"></div>
														</div>
														<div class="card-footer">
															<span class="">Total Tempat : <span id="total_rabu">0</span></span>
														</div>
													</div>
												</div>

												<div class="card-deck">
													<div class="card border mb-g">
														<div class="card-header bg-primary-100 pr-3 d-flex align-items-center flex-wrap">
															<div class="card-title text-white">KAMIS <br><small><?php echo format_date($list_tgl[3]->tanggal); ?></small></div>

															<button type="button" class="btn btn-default btn-icon rounded-circle hover-effect-dot waves-effect waves-themed ml-auto" onClick="tambah('KAMIS', '<?php echo $list_tgl[3]->tanggal; ?>')" title="Tambah Tempat">
																<i class="fal fa-plus"></i>
															</button>

														</div>
														<div class="card-body">
															<div id="loading_kamis" style="display:none">
																<div class="spinner-border" role="status">
																	<span class="sr-only">Loading...</span>
																</div>
															</div>
															<div id="konten_kamis"></div>
														</div>
														<div class="card-footer">
															<span class="">Total Tempat : <span id="total_kamis">0</span></span>
														</div>
													</div>

													<div class="card border mb-g">
														<div class="card-header bg-primary-100 pr-3 d-flex align-items-center flex-wrap">
															<div class="card-title text-white">JUMAT <br><small><?php echo format_date($list_tgl[4]->tanggal); ?></small></div>

															<button type="button" class="btn btn-default btn-icon rounded-circle hover-effect-dot waves-effect waves-themed ml-auto" onClick="tambah('JUMAT', '<?php echo $list_tgl[4]->tanggal; ?>')" title="Tambah Tempat">
																<i class="fal fa-plus"></i>
															</button>

														</div>
														<div class="card-body">
															<div id="loading_jumat" style="display:none">
																<div class="spinner-border" role="status">
																	<span class="sr-only">Loading...</span>
																</div>
															</div>
															<div id="konten_jumat"></div>
														</div>
														<div class="card-footer">
															<span class="">Total Tempat : <span id="total_jumat">0</span></span>
														</div>
													</div>

													<div class="card border mb-g">
														<div class="card-header bg-primary-100 pr-3 d-flex align-items-center flex-wrap">
															<div class="card-title text-white">SABTU <br><small><?php echo format_date($list_tgl[5]->tanggal); ?></small></div>

															<button type="button" class="btn btn-default btn-icon rounded-circle hover-effect-dot waves-effect waves-themed ml-auto" onClick="tambah('SABTU', '<?php echo $list_tgl[5]->tanggal; ?>')" title="Tambah Tempat">
																<i class="fal fa-plus"></i>
															</button>

														</div>
														<div class="card-body">
															<div id="loading_sabtu" style="display:none">
																<div class="spinner-border" role="status">
																	<span class="sr-only">Loading...</span>
																</div>
															</div>
															<div id="konten_sabtu"></div>
														</div>
														<div class="card-footer">
															<span class="">Total Tempat : <span id="total_sabtu">0</span></span>
														</div>
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
						$(document).ready(function()
						{
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
									return '<div>' + res.nama + '</div>';
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

									reload_senin();
									reload_selasa();
									reload_rabu();
									reload_kamis();
									reload_jumat();
									reload_sabtu();

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
							self.id_tap = ko.observable("");
							self.nm_tap = ko.observable("");
							self.nm_cluster = ko.observable("");
							self.nm_branch = ko.observable("");

							self.tgl_senin = ko.observable("<?php echo isset($list_tgl[0]->tanggal) ? $list_tgl[0]->tanggal : 0; ?>");
							self.tgl_selasa = ko.observable("<?php echo isset($list_tgl[1]->tanggal) ? $list_tgl[1]->tanggal : 0; ?>");
							self.tgl_rabu = ko.observable("<?php echo isset($list_tgl[2]->tanggal) ? $list_tgl[2]->tanggal : 0; ?>");
							self.tgl_kamis = ko.observable("<?php echo isset($list_tgl[3]->tanggal) ? $list_tgl[3]->tanggal : 0; ?>");
							self.tgl_jumat = ko.observable("<?php echo isset($list_tgl[4]->tanggal) ? $list_tgl[4]->tanggal : 0; ?>");
							self.tgl_sabtu = ko.observable("<?php echo isset($list_tgl[5]->tanggal) ? $list_tgl[5]->tanggal : 0; ?>");

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

						function reload_senin(){
							var html = '';
							var hari = 1;
							var nama_hari = "SENIN";
							var tgl_hari = App.tgl_senin();
							var id_sales = App.id_sales();

							$.ajax({
								type: 'POST',
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_list_pjp',
								async: false,
								dataType: 'json',
								data:{
									id_sales: id_sales,
									hari: nama_hari,
									tgl_hari: tgl_hari
								},
								success: function(response){
									var result = response.rows;
									var len = response.len;

									if (len > 0)
									{
										for (i = 0; i < len; i++)
										{
											var id_pjp = result[i]['id_pjp'];
											var id_tempat = result[i]['id_tempat'];
											var nm_tempat = result[i]['nm_tempat'];
											var id_jns_lokasi = result[i]['id_jns_lokasi'];
											var no_kunjungan = result[i]['no_kunjungan'];
											var xno = result[i]['no_kunjungan'] + '.';
											var is_delete = result[i]['is_delete'];
											var is_reset = result[i]['is_reset'];
											var max_no = result[i]['max_no'];
											var kode = result[i]['kode'];

											html +=
												" <table class='table table-clean table-sm' style='margin-bottom:1px'>" +
												"		<tbody>" +
												"			<tr>" +
												"				<td class='text-right' style='width:15px;'>" +
												"						" + xno + " " +
												"				</td>" +
												"				<td><strong>" + nm_tempat + "</strong><br>(" + kode + ")</td>" +
												"				<td>&nbsp;</td>";


											if (is_delete == 1)
											{
												if (is_reset == 1)
												{
													html +=
														"				<td class='text-right' style='width:45px;'>-</td>";
												}
												else
												{
													html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='reset(" + id_tempat + ", \"" + id_jns_lokasi + "\", \"" + tgl_hari + "\")' Title='Reset Data'>" +
														"						<i style='color:#FF0843' class='fal fa-power-off'></i>" +
														"					</a>" +
														"				</td>";
												}
											}
											else
											{
												html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='ubah(" + id_pjp + ", \"" + tgl_hari + "\")' Title='Ubah Data'>" +
														"						<i class='fal fa-edit'></i>" +
														"					</a>" +
														"					<a href='javascript:void(0);' onClick='hapus(" + id_pjp + ", \"" + tgl_hari + "\", \"" + nama_hari + "\")' Title='Hapus Data'>" +
														"						<i style='color:red' class='fal fa-trash-alt'></i>" +
														"					</a>";
														"				</td>";
											}

											html +=
												"				<td class='text-right' style='width:45px;'>";


														if (len > 1)
														{
																if (no_kunjungan == 1)	// data teratas
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
																else if (no_kunjungan == max_no) // data terbawah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>";
																}
																else // data tengah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>" +
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
														}

											html +=
												"				</td>" +
												"			</tr>" +
												"		</tbody>" +
												"	</table>";

										}
									}

									$('#total_senin').text(len);
								}
							});

							$('#konten_senin').html(html);
						}

						function reload_selasa(){
							var html = '';
							var hari = 2;
							var nama_hari = "SELASA";
							var tgl_hari = App.tgl_selasa();
							var id_sales = App.id_sales();

							$.ajax({
								type: 'POST',
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_list_pjp',
								async: false,
								dataType: 'json',
								data:{
									id_sales: id_sales,
									hari: nama_hari,
									tgl_hari: tgl_hari
								},
								success: function(response){
									var result = response.rows;
									var len = response.len;

									if (len > 0)
									{
										for (i = 0; i < len; i++)
										{
											var id_pjp = result[i]['id_pjp'];
											var id_tempat = result[i]['id_tempat'];
											var nm_tempat = result[i]['nm_tempat'];
											var id_jns_lokasi = result[i]['id_jns_lokasi'];
											var no_kunjungan = result[i]['no_kunjungan'];
											var xno = result[i]['no_kunjungan'] + '.';
											var is_delete = result[i]['is_delete'];
											var is_reset = result[i]['is_reset'];
											var max_no = result[i]['max_no'];
											var kode = result[i]['kode'];

											html +=
												" <table class='table table-clean table-sm' style='margin-bottom:1px'>" +
												"		<tbody>" +
												"			<tr>" +
												"				<td class='text-right' style='width:15px;'>" +
												"						" + xno + " " +
												"				</td>" +
												"				<td><strong>" + nm_tempat + "</strong><br>(" + kode + ")</td>" +
												"				<td>&nbsp;</td>";


											if (is_delete == 1)
											{
												if (is_reset == 1)
												{
													html +=
														"				<td class='text-right' style='width:45px;'>-</td>";
												}
												else
												{
													html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='reset(" + id_tempat + ", \"" + id_jns_lokasi + "\", \"" + tgl_hari + "\")' Title='Reset Data'>" +
														"						<i style='color:#FF0843' class='fal fa-power-off'></i>" +
														"					</a>" +
														"				</td>";
												}
											}
											else
											{
												html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='ubah(" + id_pjp + ", \"" + tgl_hari + "\")' Title='Ubah Data'>" +
														"						<i class='fal fa-edit'></i>" +
														"					</a>" +
														"					<a href='javascript:void(0);' onClick='hapus(" + id_pjp + ", \"" + tgl_hari + "\", \"" + nama_hari + "\")' Title='Hapus Data'>" +
														"						<i style='color:red' class='fal fa-trash-alt'></i>" +
														"					</a>";
														"				</td>";
											}

											html +=
												"				<td class='text-right' style='width:45px;'>";


														if (len > 1)
														{
																if (no_kunjungan == 1)	// data teratas
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
																else if (no_kunjungan == max_no) // data terbawah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>";
																}
																else // data tengah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>" +
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
														}

											html +=
												"				</td>" +
												"			</tr>" +
												"		</tbody>" +
												"	</table>";

										}
									}

									$('#total_selasa').text(len);
								}
							});

							$('#konten_selasa').html(html);
						}

						function reload_rabu(){
							var html = '';
							var hari = 3;
							var nama_hari = "RABU";
							var tgl_hari = App.tgl_rabu();
							var id_sales = App.id_sales();

							$.ajax({
								type: 'POST',
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_list_pjp',
								async: false,
								dataType: 'json',
								data:{
									id_sales: id_sales,
									hari: nama_hari,
									tgl_hari: tgl_hari
								},
								success: function(response){
									var result = response.rows;
									var len = response.len;

									if (len > 0)
									{
										for (i = 0; i < len; i++)
										{
											var id_pjp = result[i]['id_pjp'];
											var id_tempat = result[i]['id_tempat'];
											var nm_tempat = result[i]['nm_tempat'];
											var id_jns_lokasi = result[i]['id_jns_lokasi'];
											var no_kunjungan = result[i]['no_kunjungan'];
											var xno = result[i]['no_kunjungan'] + '.';
											var is_delete = result[i]['is_delete'];
											var is_reset = result[i]['is_reset'];
											var max_no = result[i]['max_no'];
											var kode = result[i]['kode'];

											html +=
												" <table class='table table-clean table-sm' style='margin-bottom:1px'>" +
												"		<tbody>" +
												"			<tr>" +
												"				<td class='text-right' style='width:15px;'>" +
												"						" + xno + " " +
												"				</td>" +
												"				<td><strong>" + nm_tempat + "</strong><br>(" + kode + ")</td>" +
												"				<td>&nbsp;</td>";


											if (is_delete == 1)
											{
												if (is_reset == 1)
												{
													html +=
														"				<td class='text-right' style='width:45px;'>-</td>";
												}
												else
												{
													html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='reset(" + id_tempat + ", \"" + id_jns_lokasi + "\", \"" + tgl_hari + "\")' Title='Reset Data'>" +
														"						<i style='color:#FF0843' class='fal fa-power-off'></i>" +
														"					</a>" +
														"				</td>";
												}
											}
											else
											{
												html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='ubah(" + id_pjp + ", \"" + tgl_hari + "\")' Title='Ubah Data'>" +
														"						<i class='fal fa-edit'></i>" +
														"					</a>" +
														"					<a href='javascript:void(0);' onClick='hapus(" + id_pjp + ", \"" + tgl_hari + "\", \"" + nama_hari + "\")' Title='Hapus Data'>" +
														"						<i style='color:red' class='fal fa-trash-alt'></i>" +
														"					</a>";
														"				</td>";
											}

											html +=
												"				<td class='text-right' style='width:45px;'>";


														if (len > 1)
														{
																if (no_kunjungan == 1)	// data teratas
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
																else if (no_kunjungan == max_no) // data terbawah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>";
																}
																else // data tengah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>" +
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
														}

											html +=
												"				</td>" +
												"			</tr>" +
												"		</tbody>" +
												"	</table>";

										}
									}

									$('#total_rabu').text(len);
								}
							});

							$('#konten_rabu').html(html);
						}

						function reload_kamis(){
							var html = '';
							var hari = 4;
							var nama_hari = "KAMIS";
							var tgl_hari = App.tgl_kamis();
							var id_sales = App.id_sales();

							$.ajax({
								type: 'POST',
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_list_pjp',
								async: false,
								dataType: 'json',
								data:{
									id_sales: id_sales,
									hari: nama_hari,
									tgl_hari: tgl_hari
								},
								success: function(response){
									var result = response.rows;
									var len = response.len;

									if (len > 0)
									{
										for (i = 0; i < len; i++)
										{
											var id_pjp = result[i]['id_pjp'];
											var id_tempat = result[i]['id_tempat'];
											var nm_tempat = result[i]['nm_tempat'];
											var id_jns_lokasi = result[i]['id_jns_lokasi'];
											var no_kunjungan = result[i]['no_kunjungan'];
											var xno = result[i]['no_kunjungan'] + '.';
											var is_delete = result[i]['is_delete'];
											var is_reset = result[i]['is_reset'];
											var max_no = result[i]['max_no'];
											var kode = result[i]['kode'];

											html +=
												" <table class='table table-clean table-sm' style='margin-bottom:1px'>" +
												"		<tbody>" +
												"			<tr>" +
												"				<td class='text-right' style='width:15px;'>" +
												"						" + xno + " " +
												"				</td>" +
												"				<td><strong>" + nm_tempat + "</strong><br>(" + kode + ")</td>" +
												"				<td>&nbsp;</td>";


											if (is_delete == 1)
											{
												if (is_reset == 1)
												{
													html +=
														"				<td class='text-right' style='width:45px;'>-</td>";
												}
												else
												{
													html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='reset(" + id_tempat + ", \"" + id_jns_lokasi + "\", \"" + tgl_hari + "\")' Title='Reset Data'>" +
														"						<i style='color:#FF0843' class='fal fa-power-off'></i>" +
														"					</a>" +
														"				</td>";
												}
											}
											else
											{
												html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='ubah(" + id_pjp + ", \"" + tgl_hari + "\")' Title='Ubah Data'>" +
														"						<i class='fal fa-edit'></i>" +
														"					</a>" +
														"					<a href='javascript:void(0);' onClick='hapus(" + id_pjp + ", \"" + tgl_hari + "\", \"" + nama_hari + "\")' Title='Hapus Data'>" +
														"						<i style='color:red' class='fal fa-trash-alt'></i>" +
														"					</a>";
														"				</td>";
											}

											html +=
												"				<td class='text-right' style='width:45px;'>";


														if (len > 1)
														{
																if (no_kunjungan == 1)	// data teratas
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
																else if (no_kunjungan == max_no) // data terbawah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>";
																}
																else // data tengah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>" +
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
														}

											html +=
												"				</td>" +
												"			</tr>" +
												"		</tbody>" +
												"	</table>";

										}
									}

									$('#total_kamis').text(len);
								}
							});

							$('#konten_kamis').html(html);
						}

						function reload_jumat(){
							var html = '';
							var hari = 5;
							var nama_hari = "JUMAT";
							var tgl_hari = App.tgl_jumat();
							var id_sales = App.id_sales();

							$.ajax({
								type: 'POST',
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_list_pjp',
								async: false,
								dataType: 'json',
								data:{
									id_sales: id_sales,
									hari: nama_hari,
									tgl_hari: tgl_hari
								},
								success: function(response){
									var result = response.rows;
									var len = response.len;

									if (len > 0)
									{
										for (i = 0; i < len; i++)
										{
											var id_pjp = result[i]['id_pjp'];
											var id_tempat = result[i]['id_tempat'];
											var nm_tempat = result[i]['nm_tempat'];
											var id_jns_lokasi = result[i]['id_jns_lokasi'];
											var no_kunjungan = result[i]['no_kunjungan'];
											var xno = result[i]['no_kunjungan'] + '.';
											var is_delete = result[i]['is_delete'];
											var is_reset = result[i]['is_reset'];
											var max_no = result[i]['max_no'];
											var kode = result[i]['kode'];

											html +=
												" <table class='table table-clean table-sm' style='margin-bottom:1px'>" +
												"		<tbody>" +
												"			<tr>" +
												"				<td class='text-right' style='width:15px;'>" +
												"						" + xno + " " +
												"				</td>" +
												"				<td><strong>" + nm_tempat + "</strong><br>(" + kode + ")</td>" +
												"				<td>&nbsp;</td>";


											if (is_delete == 1)
											{
												if (is_reset == 1)
												{
													html +=
														"				<td class='text-right' style='width:45px;'>-</td>";
												}
												else
												{
													html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='reset(" + id_tempat + ", \"" + id_jns_lokasi + "\", \"" + tgl_hari + "\")' Title='Reset Data'>" +
														"						<i style='color:#FF0843' class='fal fa-power-off'></i>" +
														"					</a>" +
														"				</td>";
												}
											}
											else
											{
												html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='ubah(" + id_pjp + ", \"" + tgl_hari + "\")' Title='Ubah Data'>" +
														"						<i class='fal fa-edit'></i>" +
														"					</a>" +
														"					<a href='javascript:void(0);' onClick='hapus(" + id_pjp + ", \"" + tgl_hari + "\", \"" + nama_hari + "\")' Title='Hapus Data'>" +
														"						<i style='color:red' class='fal fa-trash-alt'></i>" +
														"					</a>";
														"				</td>";
											}

											html +=
												"				<td class='text-right' style='width:45px;'>";


														if (len > 1)
														{
																if (no_kunjungan == 1)	// data teratas
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
																else if (no_kunjungan == max_no) // data terbawah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>";
																}
																else // data tengah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>" +
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
														}

											html +=
												"				</td>" +
												"			</tr>" +
												"		</tbody>" +
												"	</table>";

										}
									}

									$('#total_jumat').text(len);
								}
							});

							$('#konten_jumat').html(html);
						}

						function reload_sabtu(){
							var html = '';
							var hari = 6;
							var nama_hari = "SABTU";
							var tgl_hari = App.tgl_sabtu();
							var id_sales = App.id_sales();

							$.ajax({
								type: 'POST',
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_list_pjp',
								async: false,
								dataType: 'json',
								data:{
									id_sales: id_sales,
									hari: nama_hari,
									tgl_hari: tgl_hari
								},
								success: function(response){
									var result = response.rows;
									var len = response.len;

									if (len > 0)
									{
										for (i = 0; i < len; i++)
										{
											var id_pjp = result[i]['id_pjp'];
											var id_tempat = result[i]['id_tempat'];
											var nm_tempat = result[i]['nm_tempat'];
											var id_jns_lokasi = result[i]['id_jns_lokasi'];
											var no_kunjungan = result[i]['no_kunjungan'];
											var xno = result[i]['no_kunjungan'] + '.';
											var is_delete = result[i]['is_delete'];
											var is_reset = result[i]['is_reset'];
											var max_no = result[i]['max_no'];
											var kode = result[i]['kode'];

											html +=
												" <table class='table table-clean table-sm' style='margin-bottom:1px'>" +
												"		<tbody>" +
												"			<tr>" +
												"				<td class='text-right' style='width:15px;'>" +
												"						" + xno + " " +
												"				</td>" +
												"				<td><strong>" + nm_tempat + "</strong><br>(" + kode + ")</td>" +
												"				<td>&nbsp;</td>";


											if (is_delete == 1)
											{
												if (is_reset == 1)
												{
													html +=
														"				<td class='text-right' style='width:45px;'>-</td>";
												}
												else
												{
													html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='reset(" + id_tempat + ", \"" + id_jns_lokasi + "\", \"" + tgl_hari + "\")' Title='Reset Data'>" +
														"						<i style='color:#FF0843' class='fal fa-power-off'></i>" +
														"					</a>" +
														"				</td>";
												}
											}
											else
											{
												html +=
														"				<td class='text-right' style='width:45px;'>" +
														"					<a href='javascript:void(0);' onClick='ubah(" + id_pjp + ", \"" + tgl_hari + "\")' Title='Ubah Data'>" +
														"						<i class='fal fa-edit'></i>" +
														"					</a>" +
														"					<a href='javascript:void(0);' onClick='hapus(" + id_pjp + ", \"" + tgl_hari + "\", \"" + nama_hari + "\")' Title='Hapus Data'>" +
														"						<i style='color:red' class='fal fa-trash-alt'></i>" +
														"					</a>";
														"				</td>";
											}

											html +=
												"				<td class='text-right' style='width:45px;'>";


														if (len > 1)
														{
																if (no_kunjungan == 1)	// data teratas
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
																else if (no_kunjungan == max_no) // data terbawah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan Kunjungan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>";
																}
																else // data tengah
																{
																	html +=
																		"			<a href='javascript:void(0);' onClick='naik_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Naikan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-up'></i>" +
																		"			</a>" +
																		"			<a href='javascript:void(0);' onClick='turun_no(" + id_pjp + ", " + no_kunjungan + ", " + hari + ", \"" + tgl_hari + "\")' Title='Turunkan Urutan'>" +
																		"				<i class='fal fa-arrow-alt-down'></i>" +
																		"			</a>";
																}
														}

											html +=
												"				</td>" +
												"			</tr>" +
												"		</tbody>" +
												"	</table>";

										}
									}

									$('#total_sabtu').text(len);
								}
							});

							$('#konten_sabtu').html(html);
						}

						function tambah(hari, tanggal)
						{
							var id_sales = App.id_sales();

							if (id_sales == '' || id_sales == 0 || id_sales == null)
							{
								show_warning('Silakan pilih sales terlebih dahulu');
							}
							else
							{
								var id_jns_sales = App.id_jns_sales();
								var id_sales = App.id_sales();
								var id_pjp = 0;
								var hari = hari;
								var tanggal = tanggal;
								var id_tap = App.id_tap();

								show_dialog(600, 500, 'Tambah', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/form/' +
										id_jns_sales + '/' +
										id_sales + '/' +
										id_pjp +'/' +
										hari + '/' +
										tanggal + '/' +
										id_tap
								);
							}
						}

						function ubah(id_pjp, tanggal)
						{
							var id_jns_sales = App.id_jns_sales();
							var id_sales = App.id_sales();
							var id_pjp = id_pjp;
							var hari = '-';
							var id_tap = App.id_tap();

							show_dialog(600, 500, 'Ubah', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/form/' +
									id_jns_sales + '/' +
									id_sales + '/' +
									id_pjp +'/' +
									hari + '/' +
									id_tap
							);
						}

						function hapus(id_pjp, tanggal, hari)
						{
							var id_sales = App.id_sales();

							bootbox.confirm({
								closeButton: false,
								title: '<i class="fal fa-exclamation-triangle"> Peringatan',
								message: 'Apakah Anda yakin untuk menghapus?',
								size: 'small',
								buttons: {
									cancel: {
										label: '<i class="fal fa-times"></i> Tidak',
										className: 'btn btn-sm btn-primary'
									},
									confirm: {
										label: '<i class="fal fa-check"></i> Ya',
										className: 'btn btn-sm btn-primary'
									}
								},
								callback: function(result){
									if (result)
									{
										// Start looding
										var looding = bootbox.dialog({
											size: 'small',
											closeButton: false,
											message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...</div>',
											className: 'modal-looding'
										});

										$.ajax({
											type: "post",
											dataType: "json",
											url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/hapus_pjp',
											data: {
												id_pjp: id_pjp,
												tanggal: tanggal,
												hari: hari,
												id_sales: id_sales
											},
											success: function(res){
												if (res.isSuccess)
												{
													show_success(res.message);

													reload_senin();
													reload_selasa();
													reload_rabu();
													reload_kamis();
													reload_jumat();
													reload_sabtu();

													setTimeout(function(){
														bootbox.hideAll(); // Hide all bootbox
													}, 1000)
												}
												else
												{
													show_warning(res.message);

													setTimeout(function(){
														bootbox.hideAll(); // Hide all bootbox
													}, 1000)
												}
											}
										});
									}
								}
							});
						}

						function reset(id_tempat, id_jns_lokasi, tanggal)
						{
							bootbox.confirm({
								closeButton: false,
								title: '<i class="fal fa-exclamation-triangle"> Peringatan',
								message: 'Apakah Anda yakin untuk mereset data ini?',
								size: 'small',
								buttons: {
									cancel: {
										label: '<i class="fal fa-times"></i> Tidak',
										className: 'btn btn-sm btn-primary'
									},
									confirm: {
										label: '<i class="fal fa-check"></i> Ya',
										className: 'btn btn-sm btn-primary'
									}
								},
								callback: function(result){
									if (result)
									{
										// Start looding
										var looding = bootbox.dialog({
											size: 'small',
											closeButton: false,
											message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...</div>',
											className: 'modal-looding'
										});

										$.ajax({
											type: "post",
											dataType: "json",
											url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/delete_history_pjp',
											data: {
												id_sales : App.id_sales(),
												id_tempat: id_tempat,
												id_jns_lokasi: id_jns_lokasi,
												tanggal: tanggal
											},
											success: function(res){
												if (res.isSuccess)
												{
													show_success(res.message);

													reload_senin();
													reload_selasa();
													reload_rabu();
													reload_kamis();
													reload_jumat();
													reload_sabtu();

													setTimeout(function(){
														bootbox.hideAll(); // Hide all bootbox
													}, 1000)
												}
												else
												{
													show_warning(res.message);

													setTimeout(function(){
														bootbox.hideAll(); // Hide all bootbox
													}, 1000)
												}
											}
										});
									}
								}
							});
						}

						function naik_no(id_pjp, no_kunjungan, hari, tanggal)
						{
							if (hari == 1) { xhari = 'SENIN' }
							if (hari == 2) { xhari = 'SELASA' }
							if (hari == 3) { xhari = 'RABU' }
							if (hari == 4) { xhari = 'KAMIS' }
							if (hari == 5) { xhari = 'JUMAT' }
							if (hari == 6) { xhari = 'SABTU' }

							$.ajax({
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/update_nourut',
								type: 'post',
								dataType: 'json',
								data: {
									id_pjp: id_pjp,
									id_sales: App.id_sales(),
									no_kunjungan:no_kunjungan,
									hari: xhari,
									status: 'up',
									tanggal: tanggal
								},
								success: function(res, xhr){
									if (res.isSuccess)
									{
										// show_success(res.message);

										if (hari == 1) { reload_senin(); }
										if (hari == 2) { reload_selasa(); }
										if (hari == 3) { reload_rabu(); }
										if (hari == 4) { reload_kamis(); }
										if (hari == 5) { reload_jumat(); }
										if (hari == 6) { reload_sabtu(); }

										setTimeout(function(){
											bootbox.hideAll(); // Hide all bootbox
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

						function turun_no(id_pjp, no_kunjungan, hari, tanggal)
						{
							if (hari == 1) { xhari = 'SENIN' }
							if (hari == 2) { xhari = 'SELASA' }
							if (hari == 3) { xhari = 'RABU' }
							if (hari == 4) { xhari = 'KAMIS' }
							if (hari == 5) { xhari = 'JUMAT' }
							if (hari == 6) { xhari = 'SABTU' }

							$.ajax({
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/update_nourut',
								type: 'post',
								dataType: 'json',
								data: {
									id_pjp: id_pjp,
									id_sales: App.id_sales(),
									no_kunjungan:no_kunjungan,
									hari: xhari,
									status: 'down',
									tanggal: tanggal
								},
								success: function(res, xhr){
									if (res.isSuccess)
									{
										// show_success(res.message);

										if (hari == 1) { reload_senin(); }
										if (hari == 2) { reload_selasa(); }
										if (hari == 3) { reload_rabu(); }
										if (hari == 4) { reload_kamis(); }
										if (hari == 5) { reload_jumat(); }
										if (hari == 6) { reload_sabtu(); }

										setTimeout(function(){
											bootbox.hideAll(); // Hide all bootbox
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