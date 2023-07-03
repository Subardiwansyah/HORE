					<form id="frm" method="post" action="<?php echo base_url().$modul; ?>/proses">
						<div class="panel-content">
							<!-- Begin -->

							<div class="form-row">
								<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
									<label class="form-label" for="nm_provinsi">Provinsi </label>
									<input type="text" class="form-control form-control-sm" id="nm_provinsi" data-bind="disable: true, value: nm_provinsi">
								</div>
							</div>

							<div class="form-row">
								<div class="col-md-4 col-sm-4 col-xs-12 mb-3">
									<label class="form-label" for="nm_provinsi">ID Kabupaten </label>
									<input type="text" class="form-control form-control-sm" id="id_kabupaten" data-bind="disable: true, value: id_kabupaten">
								</div>
								<div class="col-md-8 col-sm-8 col-xs-12 mb-3">
									<label class="form-label" for="nm_provinsi">Nama Kabupaten </label>
									<input type="text" class="form-control form-control-sm" id="nm_kabupaten" data-bind="disable: true, value: nm_kabupaten">
								</div>
							</div>

							<div class="form-row">
								<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: radius">
									<label class="form-label" for="nm_provinsi">Radius (Meter) </label>
									<input type="text" class="form-control form-control-sm integer integeronly text-right" id="radius" autocomplete="off" data-bind="value: radius">
								</div>
							</div>

							<!-- End -->
						</div>
						<div class="panel-content py-3 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right">
							<button type="button" class="btn btn-sm btn-primary" id="btn-batal" data-bind="click: back"><i class="fal fa-times"></i> Batal</button>
							<button type="button" class="btn btn-sm btn-primary" id="btn-simpan" data-bind="click: save"><i class="fal fa-save"></i> Simpan</button>
						</div>
					</form>

					<script>
						$(document).ready(function()
						{
							var fmtCurrency = {colorize:false, symbol: '', decimalSymbol: ',', digitGroupSymbol:'.', roundToDecimalPlace:2};

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
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable("<?php echo isset($data['id_kabupaten']) ? $data['id_kabupaten'] : 0 ?>");
							self.nm_provinsi = ko.observable("<?php echo isset($data['nama_provinsi']) ? $data['nama_provinsi'] : '' ?>");
							self.id_kabupaten = ko.observable("<?php echo isset($data['id_kabupaten']) ? $data['id_kabupaten'] : '' ?>");
							self.nm_kabupaten = ko.observable("<?php echo isset($data['nama_kabupaten']) ? $data['nama_kabupaten'] : '' ?>");
							self.radius = ko.observable("<?php echo isset($data['radius_clock_in']) ? format_integer($data['radius_clock_in']) : '25' ?>")
								.extend({
									required: {params: true, message: 'Radius tidak boleh kosong'}
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
							bootbox.hideAll(); // Hide all bootbox
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
										$('#dt_table_0').DataTable().ajax.reload();

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