					<main class="page-content">
						<ol class="breadcrumb page-breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>beranda"><i class="fal fa-home"></i> Beranda</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?><?php echo $modul; ?>"><?php echo $modul_display; ?></a></li>
							<li class="breadcrumb-item active"><?php echo $breadcrumb_form; ?></li>
						</ol>

						<div class="row">
							<div class="col-xl-12">
								<div id="panel-1" class="panel">
									<div class="panel-hdr">
										<h2>
											Resume PJP
										</h2>
									</div>
									<div class="panel-container show">
										<div class="panel-content">

											<div id="konten_distribusi" class="konten_resume"></div>
											<div id="konten_merchandising" class="konten_resume"></div>
											<div id="konten_promotion" class="konten_resume"></div>
											<div id="konten_market_audit" class="konten_resume"></div>

										</div>
										<div class="panel-content py-3 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right">
											<button type="button" class="btn btn-sm btn-primary" id="btn-batal" data-bind="click: back"><i class="fal fa-times"></i> Tutup</button>
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
							reload_data();
						});

						var ModelForm = function(){
							var self = this;

							self.modul = '<?php echo $modul_display; ?>';
							self.id = ko.observable(0);

							self.id_jns_sales = ko.observable("<?php echo isset($data['id_jenis_sales']) ? $data['id_jenis_sales'] : 0 ?>");
							self.id_sales = ko.observable("<?php echo isset($data['id_sales']) ? $data['id_sales'] : 0 ?>");
							self.nm_sales = ko.observable("<?php echo isset($data['nama_sales']) ? $data['nama_sales'] : '' ?>");
							self.tgl = ko.observable("<?php echo $tgl ?>");

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

						function reload_data(){
							var id_sales = App.id_sales();
							var x_tgl = $('#x_tgl').val();
							var arr_resume = ['distribusi', 'merchandising', 'promotion', 'market_audit'];
							var arr_resume_length = arr_resume.length;

							for (var i = 0; i < arr_resume_length; i++)
							{
								$('#konten_' + arr_resume[i]).load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_' + arr_resume[i] + '/' +
									App.id_jns_sales() + '/' +
									App.id_sales() + '/' +
									App.tgl() + '/'
								);
							}
						}

						function lihat_distribusi(tgl, jenis_lokasi, lokasi, jenis_produk){
							// TANGGAL | SALES | JENIS LOKASI | LOKASI | JENIS PRODUK

							var sales = App.id_sales();

							show_dialog_large(600, 500, 'Distribusi', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/distribusi/' +
									tgl + '/' +
									sales + '/' +
									jenis_lokasi + '/' +
									lokasi + '/' +
									jenis_produk
								);
						}

						function lihat_merchandising(tgl, jenis_lokasi, lokasi, jenis_share){
							// TANGGAL | SALES | JENIS LOKASI | LOKASI | JENIS SHARE

							var sales = App.id_sales();

							show_dialog_large(600, 500, 'Merchandising', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/merchandising/' +
									tgl + '/' +
									sales + '/' +
									jenis_lokasi + '/' +
									lokasi + '/' +
									jenis_share
								);
						}

						function lihat_promotion(tgl, jenis_lokasi, lokasi){
							// TANGGAL | SALES | JENIS LOKASI | LOKASI

							var sales = App.id_sales();

							show_dialog_large(600, 500, 'Promotion', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/promotion/' +
									tgl + '/' +
									sales + '/' +
									jenis_lokasi + '/' +
									lokasi
								);
						}

						function lihat_market_audit(tgl, jenis_lokasi, lokasi, jenis_share, kategori){
							// TANGGAL | SALES | JENIS LOKASI | LOKASI | JENIS SHARE | KATEGORI (LD/MD/HD)

							var sales = App.id_sales();

							show_dialog_large(600, 500, 'Market Audit', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/market_audit/' +
									tgl + '/' +
									sales + '/' +
									jenis_lokasi + '/' +
									lokasi + '/' +
									jenis_share + '/' +
									kategori
								);
						}

						ko.applyBindings(App);
					</script>