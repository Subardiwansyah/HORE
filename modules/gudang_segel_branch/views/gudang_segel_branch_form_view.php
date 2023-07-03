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
													<div class="col-md-8">
														<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
															<i class="fal fa-barcode-read"></i>&nbsp;&nbsp;
															PRODUK GUDANG
														</h5>

														<div class="card mb-3">
															<div class="card-body">
																<div class="form-row">
																	<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: id_cluster">
																		<label class="form-label" for="nm_cluster">Cluster <span class="text-danger">*</span> </label>
																		<input type="text" style="width:100%" class="select2" id="nm_cluster" data-bind="value: nm_cluster" />
																	</div>
																</div>

																<div class="form-row">
																	<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: id_produk">
																		<label class="form-label" for="nm_produk">Produk Segel <span class="text-danger">*</span> </label>
																		<input type="text" style="width:100%" class="select2" id="nm_produk" data-bind="value: nm_produk" />
																	</div>
																</div>

																<div class="form-row">
																	<div class="col-md-5 col-sm-5 col-xs-12 mb-3">
																		<label class="form-label" for="sn_awal">Range Serial Number <span class="text-danger">*</span> </label>
																		<input type="text" class="form-control form-control-sm integeronly text-right" id="sn_awal" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" data-bind="event: {'keyup': hitung_qty_a}, value: sn_awal">
																	</div>
																	<div class="col-md-1 col-sm-1 col-xs-1 mb-3 mt-5 text-center">
																		<label class="form-label" for="-">s/d </label>
																	</div>
																	<div class="col-md-5 col-sm-5 col-xs-12 mb-3 mt-4">
																		<input type="text" class="form-control form-control-sm integeronly text-right" id="sn_akhir" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" data-bind="event: {'keyup': hitung_qty_b}, value: sn_akhir">
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
															<i class="fal fa-calculator-alt"></i>&nbsp;&nbsp;
															QTY PRODUK
														</h5>

														<div class="card" style="height:148px">
															<div class="card-body">
																<div class="p-4 bg-info-500 rounded overflow-hidden position-relative text-white mb-g">
																	<div class="">
																		<h3 class="display-4 d-block l-h-n m-0 fw-500">
																			<span data-bind="text: qty"></span>
																			<small class="m-0 l-h-n">DATA</small>
																		</h3>
																	</div>
																	<i class="fal fa-calculator position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
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
						$(document).ready(function()
						{
							var fmtInteger = {colorize:false, symbol: '', decimalSymbol: ',', digitGroupSymbol:'.', roundToDecimalPlace:0};

							$('.integer').blur(function(){
								if ($(this).val() == ''){
									$(this).val(0);
								}

								$(this).formatCurrency(fmtInteger);
							})

							$('.integer').focus(function(){
								if ($(this).val() == 0){
									$(this).val('');
								}

								$(this).toNumber(fmtInteger);
							});

							$('.integeronly').keydown(function (e) {
								var isModifierkeyPressed = (e.metaKey || e.ctrlKey || e.shiftKey);
								var isCursorMoveOrDeleteAction = ([46,8,37,38,39,40,9].indexOf(e.keyCode) != -1);
								var isNumKeyPressed = (e.keyCode >= 48 && e.keyCode <= 58) || (e.keyCode >=96 && e.keyCode <= 105);
								var vKey = 86, cKey = 67, aKey = 65;
								switch(true){
									case isCursorMoveOrDeleteAction:
									case isModifierkeyPressed == false && isNumKeyPressed:
									case (e.metaKey || e.ctrlKey) && ([vKey,cKey,aKey].indexOf(e.keyCode) != -1):
										break;
									default:
										e.preventDefault();
								}
							});

							$('#nm_cluster').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_cluster_inmaster',
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

							$('#nm_produk').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_produk_inmaster',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											// 'id_jns_produk': 'PSL',
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Produk Segel',
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
							$('#nm_produk').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_produk');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_produk(e.added ? e.added.id : '');
									App.kd_produk(e.added ? e.added.kode : '');
									App.nm_produk(e.added ? e.added.nama : '');

									return false;
								}
								e.stopPropagation();
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);
							self.id_cluster = ko.observable("<?php echo isset($data['id_cluster']) ? $data['id_cluster'] : 0 ?>")
								.extend({
									required: {params: true, message: 'Cluster tidak boleh kosong'}
							});
							self.nm_cluster = ko.observable("");
							self.id_produk = ko.observable(0)
								.extend({
									required: {params: true, message: 'Produk Segel tidak boleh kosong'}
							});
							self.kd_produk = ko.observable("");
							self.nm_produk = ko.observable("");
							self.sn_awal = ko.observable("")
								.extend({
									required: {params: true, message: 'Serial Number Awal tidak boleh kosong'}
							});
							self.sn_akhir = ko.observable("")
								.extend({
									required: {params: true, message: 'Serial Number Akhir tidak boleh kosong'}
							});
							self.qty = ko.observable(0);

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
							var sn_awal = App.sn_awal() ? App.sn_awal() : 0;
							var sn_akhir = App.sn_akhir() ? App.sn_akhir() : 0;
							var qty = App.qty() ? App.qty() : 0;
							var length_sn_awal = sn_awal.length;
							var length_sn_akhir = sn_akhir.length;
							var kd_produk = App.kd_produk() ? App.kd_produk() : '-';
							var karakter_pertama = kd_produk.substring(0, 1);

							if (karakter_pertama == 'V' || karakter_pertama == 'v')
							{
								if (length_sn_awal !== 12)
								{
									show_warning('Serial number awal harus 12 digit');
									return false;
								}

								if (length_sn_akhir !== 12)
								{
									show_warning('Serial number akhir harus 12 digit');
									return false;
								}
							}
							else
							{
								if (length_sn_awal !== 16)
								{
									show_warning('Serial number awal harus 16 digit');
									return false;
								}

								if (length_sn_akhir !== 16)
								{
									show_warning('Serial number akhir harus 16 digit');
									return false;
								}
							}

							if (parseInt(sn_awal) > parseInt(sn_akhir))
							{
								show_warning('Serial number awal tidak boleh besar dari serial number akhir');
								return false;
							}

							if (parseInt(qty) <= 0)
							{
								show_warning('Qty tidak boleh nol (0) atau minus (-)');
								return false;
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
								message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...<div id="x_time"></div></div>',
								className: 'modal-looding'
							});

							var x_remaining = 0;
							var x_obj = document.getElementById("x_time");
							var x_timeout = window.setInterval(function(){
								x_remaining++;
								x_obj.innerHTML = x_remaining;
							}, 1000);

							var $frm = $('#frm'),
							data = JSON.parse(ko.toJSON(App));

							$.ajax({
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/proses_validasi_data',
								type: 'post',
								dataType: 'json',
								data: data,
								success: function(res, xhr){
									if (res.isSuccess)
									{
										bootbox.hideAll(); // Hide all bootbox

										var html = '';
										var sn = res.row_invalid;

											html +=
												"	<div class='d-flex align-items-center mb-3'>" +
												"		<div class='alert-icon'>" +
												"			<i class='fal fa-info-circle'></i>" +
												"		</div>" +
												"		<div class='flex-1'>" +
												"			<span class='h5'>Proses bisa dilakukan jika semua data valid</span>" +
												"		</div>" +
												"	</div>";

										if (res.data_invalid > 0)
										{
											html +=
												"		<div class='row'>" +
												"			<div class='col-md-4'>" +
												"				<div class='card mb-3' style='height:120px'>" +
												"					<div class='card-body'>" +
												"						<div class='p-2 bg-success-500 rounded overflow-hidden position-relative text-white mb-g'>" +
												"							<div class=''>" +
												"								<h3 class='display-4 d-block l-h-n m-0 fw-500'>" +
												"									 " +	res.data_valid + "" +
												"									<small class='m-0 l-h-n'>DATA VALID</small>" +
												"								</h3>" +
												"							</div>" +
												"							<i class='fal fa-shield-check position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4' style='font-size: 6rem;'></i>" +
												"						</div>" +
												"					</div>" +
												"				</div>" +
												"				<div class='card mb-3' style='height:120px'>" +
												"					<div class='card-body'>" +
												"						<div style='background-color: red' class='p-2 bg-danger-600 rounded overflow-hidden position-relative text-white mb-g'>" +
												"							<div class=''>" +
												"								<h3 class='display-4 d-block l-h-n m-0 fw-500'>" +
												"									 " +	res.data_invalid + "" +
												"									<small class='m-0 l-h-n'>DATA INVALID</small>" +
												"								</h3>" +
												"							</div>" +
												"							<i class='fal fa-exclamation-triangle position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4' style='font-size: 6rem;'></i>" +
												"						</div>" +
												"					</div>" +
												"				</div>" +
												"			</div>" +
												" 		<div class='col-md-8'>" +
												"				<h5 class='keep-print-font fw-500 mb-2 text-primary flex-1 position-relative'>" +
												"					<i class='fal fa-barcode-read'></i>&nbsp;&nbsp;" +
												"					SERIAL NUMBER INVALID" +
												"				</h5>" +
												"				<div class='card mb-3' style='height:226px'>" +
												"					<div class='card-body'>" +
												"						<div class='slim-scrool'>" +
												"							<div class='mx-3'>" +
												"								<div class='row'>";


											for (x = 0; x < res.data_invalid; x++)
											{

											html +=
												"									<div class='col-md-6'>" +
												"										- " + sn[0][x] + "" +
												"									</div>";

											}

											html +=
												"								</div>" +
												"							</div>" +
												"						</div>" +
												"					</div>" +
												"				</div>" +
												"			</div>" +
												"		</div>";
										}
										else
										{
											html +=
												"		<div class='row'>" +
												"			<div class='col-md-6'>" +
												"				<div class='card mb-3' style='height:120px'>" +
												"					<div class='card-body'>" +
												"						<div class='p-2 bg-success-500 rounded overflow-hidden position-relative text-white mb-g'>" +
												"							<div class=''>" +
												"								<h3 class='display-4 d-block l-h-n m-0 fw-500'>" +
												"									 " +	res.data_valid + "" +
												"									<small class='m-0 l-h-n'>DATA VALID</small>" +
												"								</h3>" +
												"							</div>" +
												"							<i class='fal fa-shield-check position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4' style='font-size: 6rem;'></i>" +
												"						</div>" +
												"					</div>" +
												"				</div>" +
												"			</div>" +

												"			<div class='col-md-6'>" +
												"				<div class='card mb-3' style='height:120px'>" +
												"					<div class='card-body'>" +
												"						<div style='background-color: red' class='p-2 bg-danger-600 rounded overflow-hidden position-relative text-white mb-g'>" +
												"							<div class=''>" +
												"								<h3 class='display-4 d-block l-h-n m-0 fw-500'>" +
												"									 " +	res.data_invalid + "" +
												"									<small class='m-0 l-h-n'>DATA INVALID</small>" +
												"								</h3>" +
												"							</div>" +
												"							<i class='fal fa-exclamation-triangle position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4' style='font-size: 6rem;'></i>" +
												"						</div>" +
												"					</div>" +
												"				</div>" +
												"			</div>" +
												"		</div>";
										}

										if (res.data_invalid == 0)
										{

											html +=
												"		<div class='panel-content mt-3 py-3 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right'>" +
												"			<button type='button' class='btn btn-sm btn-primary' id='btn-batalx'><i class='fal fa-times'></i> Batal</button>" +
												"			<button type='button' class='btn btn-sm btn-primary' id='btn-simpanx'><i class='fal fa-save'></i> Proses</button>" +
												"		</div>";

											bootbox.dialog({
												title: 'Info',
												size: 'medium',
												onEscape: function(){return false;},
												closeButton: false,
												message: html
											});

										}
										else
										{

											html +=
												"		<div class='panel-content mt-3 py-3 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right'>" +
												"			<button type='button' class='btn btn-sm btn-primary' id='btn-batalx'><i class='fal fa-times'></i> Tutup</button>" +
												"		</div>";


											bootbox.dialog({
												title: 'Info',
												size: 'large',
												onEscape: function(){return false;},
												closeButton: false,
												message: html
											});
										}

										$('.slim-scrool').slimScroll({
											position: 'right',
											height: '170px',
											alwaysVisible: true
										});

										$('#btn-batalx').click(function(){
											bootbox.hideAll(); // Hide all bootbox
										});

										$('#btn-simpanx').click(function(){

											// Start looding
											var looding = bootbox.dialog({
												size: 'small',
												closeButton: false,
												message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...<div id="xx_time"></div></div>',
												className: 'modal-looding'
											});

											var xx_remaining = 0;
											var xx_obj = document.getElementById("xx_time");
											var xx_timeout = window.setInterval(function(){
												xx_remaining++;
												xx_obj.innerHTML = xx_remaining;
											}, 1000);

											var $frm = $('#frm'),
											data = JSON.parse(ko.toJSON(App));

											$.ajax({
												url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/proses',
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

										});
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

						function hitung_qty_a(data, event){
							var sn_awal = $('#sn_awal').val() ? $('#sn_awal').val() : 0;
							var sn_akhir = $('#sn_akhir').val() ? $('#sn_akhir').val() : 0;

							if (sn_akhir == 0)
							{
								sn_akhir = sn_awal;
							}

							var qty = 0;

							qty = parseInt(sn_akhir) - parseInt(sn_awal);

							App.qty(qty + 1);
							App.sn_awal(sn_awal ? sn_awal : '');
							App.sn_akhir(sn_akhir ? sn_akhir : '');
						}

						function hitung_qty_b(data, event){
							var sn_awal = $('#sn_awal').val() ? $('#sn_awal').val() : 0;
							var sn_akhir = $('#sn_akhir').val() ? $('#sn_akhir').val() : 0;
							var qty = 0;

							qty = parseInt(sn_akhir) - parseInt(sn_awal);

							App.qty(qty + 1);
							App.sn_awal(sn_awal ? sn_awal : '');
							App.sn_akhir(sn_akhir ? sn_akhir : '');
						}

						// function is_positive_integer(val){
							// var n = Math.floor(Number(val));
							// return n !== Infinity && String(n) === val && n >= 0;
						// }

						ko.applyBindings(App);
					</script>