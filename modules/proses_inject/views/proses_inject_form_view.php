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
															<i class="fal fa-tag"></i>&nbsp;&nbsp;
															PRODUK SEGEL
														</h5>

														<div class="card mb-3">
															<div class="card-body">

																<div class="form-row">
																	<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																		<label class="form-label" for="kd_produk_pilih">ID Segel </label>
																		<input type="text" class="form-control form-control-sm" id="kd_produk_pilih" data-bind="disable: true, value: kd_produk_pilih">
																	</div>
																	<div class="col-md-5 col-sm-5 col-xs-12 mb-3">
																		<label class="form-label" for="nm_produk_pilih">Nama Produk </label>
																		<input type="text" class="form-control form-control-sm" id="nm_produk_pilih" data-bind="disable: true, value: nm_produk_pilih">
																	</div>
																	<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																		<label class="form-label" for="harga_modal_pilih">Harga Modal </label>
																		<input type="text" class="form-control form-control-sm currency currencyonly text-right" id="harga_modal_pilih" autocomplete="off" data-bind="disable: true, value: harga_modal_pilih">
																	</div>
																</div>

																<div class="form-row">
																	<div class="col-md-5 col-sm-5 col-xs-12 mb-3">
																		<label class="form-label" for="sn_awal_pilih">Range Serial Number </label>
																		<input type="text" class="form-control form-control-sm integeronly text-right" id="sn_awal_pilih" data-bind="disable: true, value: sn_awal_pilih">
																	</div>
																	<div class="col-md-1 col-sm-1 col-xs-12 mb-3 mt-5 text-center">
																		<label class="form-label" for="-">s/d </label>
																	</div>
																	<div class="col-md-5 col-sm-5 col-xs-12 mb-3 mt-4">
																		<input type="text" class="form-control form-control-sm integeronly text-right" id="sn_akhir_pilih" data-bind="disable: true, value: sn_akhir_pilih">
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
															<i class="fal fa-calculator-alt"></i>&nbsp;&nbsp;
															QTY SEGEL
														</h5>

														<div class="card" style="height:178px;">
															<div class="card-body">
																<div class="p-5 bg-info-500 rounded overflow-hidden position-relative text-white mb-g">
																	<div class="">
																		<h3 class="display-4 d-block l-h-n m-0 fw-500">
																			<span data-bind="text: qty_pilih"></span>
																			<small class="m-0 l-h-n">DATA</small>
																		</h3>
																	</div>
																	<i class="fal fa-calculator position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-8">
														<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
															<i class="fal fa-tag"></i>&nbsp;&nbsp;
															PRODUK INJECT
														</h5>

														<div class="card mb-3">
															<div class="card-body">
																<div class="form-row">
																	<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
																		<label class="form-label" for="nm_tap">TAP</label>
																		<input type="text" class="form-control form-control-sm" id="nm_tap" data-bind="disable: true, value: nm_tap">
																	</div>
																</div>

																<div class="form-row">
																	<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: id_produk">
																		<label class="form-label" for="nm_produk">Produk Inject <span class="text-danger">*</span> </label>
																		<input type="text" style="width:100%" class="select2" id="nm_produk" data-bind="value: nm_produk" />
																	</div>
																</div>

																<div class="form-row">
																	<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																		<label class="form-label" for="modal_bulk">Modal Bulk </label>
																		<input type="text" class="form-control form-control-sm currency currencyonly text-right" id="modal_bulk" autocomplete="off" data-bind="disable: true, value: modal_bulk">
																	</div>
																	<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																		<label class="form-label" for="jml_bulk">Jumlah Bulk </label>
																		<input type="text" class="form-control form-control-sm integer integeronly text-right" id="jml_bulk" autocomplete="off" data-bind="disable: true, value: jml_bulk">
																	</div>
																	<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
																		<label class="form-label" for="total_modal">Total Modal </label>
																		<input type="text" class="form-control form-control-sm currency currencyonly text-right" id="total_modal" autocomplete="off" data-bind="disable: true, value: total_modal">
																	</div>
																</div>

																<div class="form-row">
																	<div class="col-md-5 col-sm-5 col-xs-12 mb-3" data-bind="validationElement: sn_awal">
																		<label class="form-label" for="sn_awal">Range Serial Number <span class="text-danger">*</span> </label>
																		<input type="text" class="form-control form-control-sm integeronly text-right" id="sn_awal" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" data-bind="event: {'keyup': hitung_qty_a}, value: sn_awal">
																	</div>
																	<div class="col-md-1 col-sm-1 col-xs-12 mb-3 mt-5 text-center">
																		<label class="form-label" for="-">s/d </label>
																	</div>
																	<div class="col-md-5 col-sm-5 col-xs-12 mb-3 mt-4" data-bind="validationElement: sn_akhir">
																		<input type="text" class="form-control form-control-sm integeronly text-right" id="sn_akhir" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" data-bind="event: {'keyup': hitung_qty_b}, value: sn_akhir">
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
															<i class="fal fa-calculator-alt"></i>&nbsp;&nbsp;
															QTY INJECT
														</h5>

														<div class="card" style="height:178px;">
															<div class="card-body">
																<div class="p-5 bg-info-500 rounded overflow-hidden position-relative text-white mb-g">
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

											<span data-bind="text: display_error"></span>

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
							var fmtCurrency = {colorize:false, symbol: '', decimalSymbol: ',', digitGroupSymbol:'.', roundToDecimalPlace:2};

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

							$('.currency').blur(function(){
								if ($(this).val() == ''){
									$(this).val('0,00');
								}

								$(this).formatCurrency(fmtCurrency);
							})

							$('.currency').focus(function(){
								if ($(this).val() == 0 || $(this).val() == '0,00' || $(this).val() <= 0){
									$(this).val('');
								}

								$(this).toNumber(fmtCurrency);
							});

							$('.currencyonly').keydown(function (e) {
								var isModifierkeyPressed = (e.metaKey || e.ctrlKey || e.shiftKey);
								var isCursorMoveOrDeleteAction = ([46,8,37,38,39,40,188,9].indexOf(e.keyCode) != -1);
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

							$('#nm_produk').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_produk_ininject',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_jns_produk': App.id_jns_produk_pilih(),
											'id_kab': App.id_kab(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Produk Inject',
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
							$('#nm_produk').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_produk');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_produk(e.added ? e.added.id : '');
									App.nm_produk(e.added ? e.added.nama : '');
									App.harga_modal(e.added ? e.added.harga : 0);

									// Hitung bulk
									var harga_segel = accounting.unformat(App.harga_modal_pilih());
									var harga_inject = e.added ? e.added.harga : 0;
									var jml_bulk = 0;
									var modal_bulk = 0;
									var total_bulk = 0;

									jml_bulk = harga_inject - harga_segel;
									modal_bulk = (97 * jml_bulk) / 100;
									total_modal = parseFloat(modal_bulk) + parseFloat(harga_segel);

									App.modal_bulk(accounting.formatMoney(modal_bulk));
									App.jml_bulk(accounting.formatMoney(jml_bulk));
									App.total_modal(accounting.formatMoney(total_modal));

									return false;
								}
								e.stopPropagation();
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable("<?php echo isset($data['id']) ? $data['id'] : 0 ?>");
							self.id_produk_pilih = ko.observable("<?php echo isset($data['id_produk']) ? $data['id_produk'] : '' ?>");
							self.kd_produk_pilih = ko.observable("<?php echo isset($data['kode_produk']) ? $data['kode_produk'] : '' ?>");
							self.id_jns_produk_pilih = ko.observable("<?php echo isset($data['id_jenis_produk']) ? $data['id_jenis_produk'] : '' ?>");
							self.nm_produk_pilih = ko.observable("<?php echo isset($data['nama_produk']) ? $data['nama_produk'] : '' ?>");
							self.harga_modal_pilih = ko.observable("<?php echo isset($data['harga_modal']) ? format_currency($data['harga_modal']) : '0,00' ?>")
							self.sn_awal_pilih = ko.observable("<?php echo isset($data['sn_awal']) ? $data['sn_awal'] : '' ?>");
							self.sn_akhir_pilih = ko.observable("<?php echo isset($data['sn_akhir']) ? $data['sn_akhir'] : '' ?>");
							self.qty_pilih = ko.observable("<?php echo isset($data['qty']) ? format_integer($data['qty']) : 0 ?>");
							self.id_tap = ko.observable("<?php echo $this->session->userdata('ID_DIVISI'); ?>");
							self.nm_tap = ko.observable("<?php echo $this->session->userdata('NAMA_DIVISI'); ?>");

							self.id_kab = ko.observable("<?php echo isset($kab['id_kabupaten']) ? $kab['id_kabupaten'] : 0 ?>");

							self.id_produk = ko.observable("")
								.extend({
									required: {params: true, message: 'Produk Segel tidak boleh kosong'}
							});
							self.kd_produk = ko.observable("");
							self.nm_produk = ko.observable("");
							self.modal_bulk = ko.observable("0,00");
							self.jml_bulk = ko.observable("0,00");
							self.total_modal = ko.observable("0,00");
							self.sn_awal = ko.observable("")
								.extend({
									required: {params: true, message: 'Range SN Awal tidak boleh kosong'}
							});
							self.sn_akhir = ko.observable("")
								.extend({
									required: {params: true, message: 'Range SN Akhir tidak boleh kosong'}
							});
							self.qty = ko.observable(0);
							self.harga_modal = ko.observable(0);

							self.display_error = ko.observable("");

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

						App.back = function(){
							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"];
						}

						App.formValidation = function(){
							var errmsg = [];
							var sn_awal = App.sn_awal() ? App.sn_awal() : 0;
							var sn_akhir = App.sn_akhir() ? App.sn_akhir() : 0;
							var qty = App.qty() ? App.qty() : 0;
							var sn_awal_pilih = App.sn_awal_pilih() ? App.sn_awal_pilih() : 0;
							var sn_akhir_pilih = App.sn_akhir_pilih() ? App.sn_akhir_pilih() : 0;

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

							if (parseInt(sn_awal) >= parseInt(sn_awal_pilih) && parseInt(sn_akhir) <= parseInt(sn_akhir_pilih))
							{
								//
							}
							else
							{
								show_warning('Serial number yang diinput diluar range serial number yang dipilih');
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
												"						<div class='p-2 bg-danger-600 rounded overflow-hidden position-relative text-white mb-g'>" +
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
							var qty = 0;

							if (sn_akhir == 0)
							{
								sn_akhir = sn_awal;
							}

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

						ko.applyBindings(App);
					</script>