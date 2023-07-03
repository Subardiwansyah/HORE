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
												<!-- Begin -->

												<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
													<i class="fal fa-tags"></i>&nbsp;&nbsp;
													DATA PRODUK
												</h5>

												<div class="card mb-3">
													<div class="card-body">

														<div class="form-row">
															<div class="col-md-3 col-sm-3 col-xs-12 mb-3" data-bind="validationElement: kd_produk">
																<label class="form-label" for="kd_produk">Kode Produk <span class="text-danger">*</span> </label>
																<input type="text" class="form-control form-control-sm" id="kd_produk" data-bind="disable: isEdit, value: kd_produk">
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12 mb-3" data-bind="validationElement: nm_produk">
																<label class="form-label" for="nm_produk">Nama Produk <span class="text-danger">*</span> </label>
																<input type="text" class="form-control form-control-sm" id="nm_produk" data-bind="value: nm_produk">
															</div>
															<div class="col-md-3 col-sm-3 col-xs-12 mb-3" data-bind="validationElement: id_jns_produk">
																<label class="form-label" for="nm_jns_produk">Jenis Produk <span class="text-danger">*</span> </label>
																<input type="text" style="width:100%" class="select2" id="nm_jns_produk" data-bind="value: nm_jns_produk" />
															</div>
														</div>

														<div class="form-row">
															<div class="col-md-3 col-sm-3 col-xs-12 mb-3" data-bind="validationElement: harga_bandrol">
																<label class="form-label" for="harga_bandrol">Pulsa <span class="text-danger">*</span> </label>
																<input type="text" class="form-control form-control-sm currency currencyonly text-right" id="harga_bandrol" autocomplete="off" data-bind="value: harga_bandrol">
															</div>
															<div class="col-md-3 col-sm-3 col-xs-12 mb-3" data-bind="validationElement: harga_modal">
																<label class="form-label" for="harga_modal">Harga Modal <span class="text-danger">*</span> </label>
																<input type="text" class="form-control form-control-sm currency currencyonly text-right" id="harga_modal" autocomplete="off" data-bind="value: harga_modal">
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

							$('#nm_jns_produk').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_jenis_produk',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'jns_produk': 'SEGEL',
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Jenis Produk',
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
							$('#nm_jns_produk').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_jns_produk');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);
									App.id_jns_produk(e.added ? e.added.id : '');
									App.nm_jns_produk(e.added ? e.added.nama : '');

									return false;
								}
								e.stopPropagation();
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable("<?php echo isset($data['id_produk']) ? $data['id_produk'] : 0 ?>");

							self.id_jns_produk = ko.observable("<?php echo isset($data['id_jenis_produk']) ? $data['id_jenis_produk'] : '' ?>")
								.extend({
									required: {params: true, message: 'Jenis Produk tidak boleh kosong'}
							});
							self.nm_jns_produk = ko.observable("<?php echo isset($data['nama_jenis_produk']) ? $data['nama_jenis_produk'] : '' ?>");
							self.kd_produk = ko.observable("<?php echo isset($data['kode_produk']) ? $data['kode_produk'] : '' ?>")
								.extend({
									required: {params: true, message: 'Kode Produk tidak boleh kosong'}
							});
							self.nm_produk = ko.observable("<?php echo isset($data['nama_produk']) ? $data['nama_produk'] : '' ?>")
								.extend({
									required: {params: true, message: 'Nama Produk tidak boleh kosong'}
							});
							self.harga_bandrol = ko.observable("<?php echo isset($data['harga_bandrol']) ? format_currency($data['harga_bandrol']) : '0,00' ?>")
								.extend({
									required: {params: true, message: 'Nominal Pulsa tidak boleh kosong'}
							});
							self.harga_modal = ko.observable("<?php echo isset($data['harga_modal']) ? format_currency($data['harga_modal']) : '0,00' ?>")
								.extend({
									required: {params: true, message: 'Harga Modal tidak boleh kosong'}
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

						App.back = function(){
							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"];
						}

						App.formValidation = function(){
							var errmsg = [];

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