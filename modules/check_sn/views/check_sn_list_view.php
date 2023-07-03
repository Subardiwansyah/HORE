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
													<i class="fal fa-filter"></i>&nbsp;&nbsp;
													FILTER DATA
												</h5>

												<div class="card mb-3">
													<div class="card-body">
														<div class="form-row">
															<div class="col-6 mb-3" data-bind="validationElement: serial_number">
																<label class="form-label" for="sn">Serial Number <span class="text-danger">*</span> </label>
																<input type="text" class="form-control form-control-sm" placeholder="Ketikkan Serial Number" id="sn" data-bind="value: serial_number">
															</div>
															<div class="col-4 mt-4">
																<button type="button" class="btn btn-sm btn-primary" id="btn-cari" data-bind="click: cari"><i class="fal fa-search"></i> Tampilkan Data</button>
															</div>
														</div>
													</div>
												</div>

												<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
													<i class="fal fa-clipboard-list-check"></i>&nbsp;&nbsp;
													DETAIL DATA : <span data-bind="text: serial_number"></span>
												</h5>

												<div class="row">
													<div class="col-md-6">
														<div class="card mb-3">
															<div class="card-body">
																<div class="p-4 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
																	<div class="">
																		GUDANG SEGEL
																	</div>
																	<i class="fal fa-luggage-cart position-absolute pos-right pos-bottom opacity-25  mb-n1 mr-n7" style="font-size: 4rem;"></i>
																</div>

																<table class="table table-hover table-clean table-sm">
																	<tbody>
																		<tr>
																			<td>Tanggal</td>
																			<td>:</td>
																			<td><span data-bind="text: tgl_segel"></span></td>
																		</tr>
																		<tr>
																			<td>Nama Produk</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_produk_segel"></span></td>
																		</tr>
																		<tr>
																			<td>Harga Modal</td>
																			<td>:</td>
																			<td><span data-bind="text: harga_modal"></span></td>
																		</tr>
																		<tr>
																			<td>Harga Bandrol</td>
																			<td>:</td>
																			<td><span data-bind="text: harga_bandrol"></span></td>
																		</tr>
																		<tr>
																			<td>Branch</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_branch"></span></td>
																		</tr>
																		<tr>
																			<td>Cluster</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_cluster_segel"></span></td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="card mb-3">
															<div class="card-body">
																<div class="p-4 bg-danger-400 rounded overflow-hidden position-relative text-white mb-g">
																	<div class="">
																		PROSES INJECT
																	</div>
																	<i class="fal fa-lock-open-alt position-absolute pos-right pos-bottom opacity-25  mb-n1 mr-n7" style="font-size: 4rem;"></i>
																</div>

																<table class="table table-hover table-clean table-sm">
																	<tbody>
																		<tr>
																			<td>Tanggal</td>
																			<td>:</td>
																			<td><span data-bind="text: tgl_proses_inject"></span></td>
																		</tr>
																		<tr>
																			<td>Nama Produk</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_produk_inject"></span></td>
																		</tr>
																		<tr>
																			<td>TAP</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_tap"></span></td>
																		</tr>
																		<tr>
																			<td>Modal Bulk</td>
																			<td>:</td>
																			<td><span data-bind="text: modal_bulk"></span></td>
																		</tr>
																		<tr>
																			<td>Jumlah Bulk</td>
																			<td>:</td>
																			<td><span data-bind="text: jml_bulk"></span></td>
																		</tr>
																		<tr>
																			<td>Total Modal</td>
																			<td>:</td>
																			<td><span data-bind="text: total_modal"></span></td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div class="card mb-3">
															<div class="card-body">
																<div class="p-4 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
																	<div class="">
																		PRODUCT BOOKING
																	</div>
																	<i class="fal fa-tag position-absolute pos-right pos-bottom opacity-25  mb-n1 mr-n7" style="font-size: 4rem;"></i>
																</div>

																<table class="table table-hover table-clean table-sm mb-6">
																	<tbody>
																		<tr>
																			<td>Tanggal</td>
																			<td>:</td>
																			<td><span data-bind="text: tgl_product_booking"></span></td>
																		</tr>
																		<tr>
																			<td>Jenis Petugas</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_jns_sales"></span></td>
																		</tr>
																		<tr>
																			<td>Nama Petugas</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_sales"></span></td>
																		</tr>
																		<tr>
																			<td>Jenis Produk</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_jns_produk"></span></td>
																		</tr>
																		<tr>
																			<td>Harga Jual</td>
																			<td>:</td>
																			<td><span data-bind="text: harga_jual"></span></td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="card mb-3">
															<div class="card-body">
																<div class="p-4 bg-info-500 rounded overflow-hidden position-relative text-white mb-g">
																	<div class="">
																		DISTRIBUSI
																	</div>
																	<i class="fal fa-shopping-cart position-absolute pos-right pos-bottom opacity-25  mb-n1 mr-n7" style="font-size: 4rem;"></i>
																</div>

																<table class="table table-hover table-clean table-sm">
																	<tbody>
																		<tr>
																			<td>Tanggal</td>
																			<td>:</td>
																			<td><span data-bind="text: tgl_distribusi"></span></td>
																		</tr>
																		<tr>
																			<td>Lokasi</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_lokasi"></span></td>
																		</tr>
																		<tr>
																			<td>Nama Pembeli</td>
																			<td>:</td>
																			<td><span data-bind="text: nm_pembeli"></span></td>
																		</tr>
																		<tr>
																			<td>Telp Pembeli</td>
																			<td>:</td>
																			<td><span data-bind="text: telp_pembeli"></span></td>
																		</tr>
																		<tr>
																			<td>No Nota</td>
																			<td>:</td>
																			<td><span data-bind="text: no_nota"></span></td>
																		</tr>
																		<tr>
																			<td>Status Pembayaran</td>
																			<td>:</td>
																			<td><span data-bind="text: status_pembayaran"></span></td>
																		</tr>
																	</tbody>
																</table>
															</div>
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
						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.serial_number = ko.observable('')
								.extend({
									required: {params: true, message: 'Serial Number tidak boleh kosong'}
							});
							self.tgl_segel = ko.observable('');
							self.nm_produk_segel = ko.observable('');
							self.harga_modal = ko.observable('');
							self.harga_bandrol = ko.observable('');
							self.nm_branch = ko.observable('');
							self.nm_cluster_segel = ko.observable('');

							self.tgl_proses_inject = ko.observable('');
							self.nm_produk_inject = ko.observable('');
							self.nm_tap = ko.observable('');
							self.modal_bulk = ko.observable('');
							self.jml_bulk = ko.observable('');
							self.total_modal = ko.observable('');

							self.tgl_product_booking = ko.observable('');
							self.nm_jns_sales = ko.observable('');
							self.nm_sales = ko.observable('');
							self.nm_jns_produk = ko.observable('');
							self.harga_jual = ko.observable('');

							self.tgl_distribusi = ko.observable('');
							self.nm_lokasi = ko.observable('');
							self.nm_pembeli = ko.observable('');
							self.telp_pembeli = ko.observable('');
							self.no_nota = ko.observable('');
							self.status_pembayaran = ko.observable('');

							self.title = ko.computed(function(){
								return self.modul;
							});

							self.errors = ko.validation.group(self);
						}

						var App = new ModelForm();

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

						App.cari = function(){
							if (!App.formValidation())
							{
								return false;
							}

							App.gudang_segel();
							
							setTimeout(function(){
								App.proses_inject();
								App.product_booking();
								App.distribusi();
							}, 1500)
						}

						App.gudang_segel = function(){
							$.ajax({
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_gudang_segel',
								type: 'post',
								dataType: 'json',
								data: {serial_number:App.serial_number()},
								success: function(result){
									App.tgl_segel(result.tgl);
									App.nm_produk_segel(result.nm_produk);
									App.harga_modal(result.harga_modal);
									App.harga_bandrol(result.harga_bandrol);
									App.nm_branch(result.nm_branch);
									App.nm_cluster_segel(result.nm_cluster);
								}
							});
						}

						App.proses_inject = function(){
							$.ajax({
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_proses_inject',
								type: 'post',
								dataType: 'json',
								data: {serial_number:App.serial_number()},
								success: function(result){
									
									var cluster = App.nm_cluster_segel() ? App.nm_cluster_segel() : 0;
									
									if (cluster == 0)
									{
										App.tgl_proses_inject('');
										App.nm_produk_inject('');
										App.nm_tap('');
										App.modal_bulk('');
										App.jml_bulk('');
										App.total_modal('');
									}
									else
									{
										App.tgl_proses_inject(result.tgl);
										App.nm_produk_inject(result.nm_produk);
										App.nm_tap(result.nm_tap);
										App.modal_bulk(result.modal_bulk);
										App.jml_bulk(result.jml_bulk);
										App.total_modal(result.total_modal);
									}
									
								}
							});
						}

						App.product_booking = function(){
							$.ajax({
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_product_booking',
								type: 'post',
								dataType: 'json',
								data: {serial_number:App.serial_number()},
								success: function(result){
									
									var cluster = App.nm_cluster_segel() ? App.nm_cluster_segel() : 0;
									
									if (cluster == 0)
									{
										App.tgl_product_booking('');
										App.nm_jns_sales('');
										App.nm_sales('');
										App.nm_jns_produk('');
										App.harga_jual('');
									}
									else
									{
										App.tgl_product_booking(result.tgl);
										App.nm_jns_sales(result.nm_jns_sales);
										App.nm_sales(result.nm_sales);
										App.nm_jns_produk(result.nm_jns_produk);
										App.harga_jual(result.harga_jual);
									}
									
								}
							});
						}

						App.distribusi = function(){
							$.ajax({
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_distribusi',
								type: 'post',
								dataType: 'json',
								data: {serial_number:App.serial_number()},
								success: function(result){
									
									var cluster = App.nm_cluster_segel() ? App.nm_cluster_segel() : 0;
									
									if (cluster == 0)
									{
										App.tgl_distribusi('');
										App.nm_lokasi('');
										App.nm_pembeli('');
										App.telp_pembeli('');
										App.no_nota('');
										App.status_pembayaran('');
									}
									else
									{
										App.tgl_distribusi(result.tgl);
										App.nm_lokasi(result.nm_lokasi);
										App.nm_pembeli(result.nm_pembeli);
										App.telp_pembeli(result.telp_pembeli);
										App.no_nota(result.no_nota);
										App.status_pembayaran(result.pembayaran);										
									}
									
								}
							});
						}

						ko.applyBindings(App);
					</script>