					<main class="page-content">
						<ol class="breadcrumb page-breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fal fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?><?php echo $modul; ?>"><?php echo $modul_display; ?></a></li>
							<li class="breadcrumb-item active"><?php echo $breadcrumb_daftar; ?></li>
						</ol>

						<div class="row">
							<div class="col-xl-12">
								<div id="panel-1" class="panel">
									<div class="panel-hdr">
										<h2>
											<?php echo $breadcrumb_daftar; ?>
										</h2>
									</div>
									<div class="panel-container show">
										<div class="panel-content">
											<div class="row">
												<div class="col-12 col-md-12">
													<button onClick="tambah()" type="button" class="btn btn-sm btn-primary" id="btn-tambah"><i class="fal fa-plus"></i> Tambah</button>
												</div>
											</div>

											<hr>

											<div class = "table-responsive">
												<table id="dt_table_0" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
													<thead class="bg-primary-100">
														<tr>
															<th width="12%">Aksi</th>
															<th>Jenis Produk</th>
															<th>Kode Produk</th>
															<th>Nama Produk</th>
															<th>Pulsa</th>
															<th>Harga Modal</th>
														</tr>
													</thead>
												</table>
											</div>
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
							$('#dt_table_0').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [[ 1, 'asc' ]],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar',
									'type': 'POST'
								},
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							});
						});

						function tambah()
						{
							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/form';
						}

						function lihat(id)
						{
							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/lihat/' + id;
						}

						function ubah(id)
						{
							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/form/' + id;
						}

						function hapus(id)
						{
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
										$.ajax({
											type: "post",
											dataType: "json",
											url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/hapus',
											data: {id: id},
											success: function(res){
												if (res.isSuccess)
												{
													show_success(res.message);
													$('#dt_table_0').DataTable().ajax.reload();
												}
												else
												{
													show_warning(res.message);
												}
											}
										});
									}
								}
							});
						}
					</script>