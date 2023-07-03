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

												<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
													<i class="fal fa-briefcase"></i>&nbsp;&nbsp;
													DATA PROGRAM
												</h5>

												<div class="card mb-3">
													<div class="card-body">
														<div class="form-row">
															<div class="col-md-12 col-sm-12 col-xs-12 mb-3" data-bind="validationElement: nm_jenis">
																<label class="form-label" for="nm_jenis">Nama Program <span class="text-danger">*</span> </label>
																<input type="text" class="form-control form-control-sm" id="nm_jenis" data-bind="value: nm_jenis">
															</div>
														</div>

														<div class="form-row">
															<div class="col-md-3 col-sm-3 col-xs-12 mb-3">
																<label class="form-label" for="status">Status </label>
																<select class="form-control form-control-sm" id="status" data-bind="disable: App.id() == '0', options: list_status, optionsValue:'id', optionsText:'uraian', value: status"></select>
															</div>
															<div class="col-md-3 col-sm-3 col-xs-12 mb-3" data-bind="visible: App.id() === '0'">
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
															<div class="col-md-3 col-sm-3 col-xs-12 mb-3" data-bind="visible: App.status() === 'TIDAK AKTIF'">
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

						var controls = {
							leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
							rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
            }

						$(document).ready(function()
						{
							$('.datepicker').datepicker(
							{
								orientation: "top left",
								todayHighlight: true,
								templates: controls,
								format: "dd/mm/yyyy",
								autoclose: true
							});
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable("<?php echo isset($data['id_jenis']) ? $data['id_jenis'] : 0 ?>");
							self.nm_jenis = ko.observable("<?php echo isset($data['nama_jenis']) ? $data['nama_jenis'] : '' ?>")
								.extend({
									required: {params: true, message: 'Nama Program boleh kosong'}
							});
							self.status = ko.observable("<?php echo isset($data['status']) ? $data['status'] : 'AKTIF' ?>");
							self.list_status = ko.observableArray([
								new opsi('AKTIF', 'AKTIF'),
								new opsi('TIDAK AKTIF', 'TIDAK AKTIF')
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