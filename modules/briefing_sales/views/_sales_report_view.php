				<div class="card mb-3">
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_11" class="table table-bordered table-sm table-striped" style="width:100%">
								<thead class="bg-primary-100">
									<tr>
										<th style="padding-bottom:15px" class="bg-primary-100">Aksi</th>
										<th style="padding-bottom:15px" class="bg-primary-100">Nota</th>
										<th style="padding-bottom:15px">Status</th>
										<th>Total Penjualan<br>(Rp)</th>
										<th>Total Link Aja<br>(Rp)</th>
										<th>Total<br>(Rp)</th>
										<th>Setor<br>Penjualan</th>
										<th style="padding-bottom:15px">Status Setor</th>
									</tr>
								</thead>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_11').removeAttr('width').DataTable({
							responsive: true,
							fixedHeader: true,
							processing: true,
							serverSide: true,
							order: [],
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_11',
								type: 'POST',
								data: {
									'id_sales': '<?php echo $id_sales; ?>',
									'tgl': '<?php echo $tgl; ?>'
								}
							},
							deferRender: true,
							columnDefs: [{
								'targets': [0],
								'orderable': false
							}]
						});
					});

					function lihat_nota(id)
					{
						show_dialog(600, 500, 'Nota Pembayaran', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/lihat_nota_penjualan/' + id);
					}

					function lihat_penjualan(id)
					{
						show_dialog_large(600, 500, 'Penjualan Perdana', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/lihat_penjualan_perdana/' + id);
					}
				</script>