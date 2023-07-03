				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							DAFTAR PERDANA BELUM TERJUAL
						</div>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table id="dt_table_2" class="table table-bordered table-sm table-striped" style="width:100%;">
								<thead class="bg-primary-210">
									<tr>
										<td class="bg-primary-210" style="width:10px"><div align="center"><strong>No</strong></div></td>
										<td class="bg-primary-210"><div align="center"><strong>Serial Number</strong></div></td>
										<td class="bg-primary-210"><div align="center"><strong>Produk</strong></div></td>
									</tr>
								</thead>
							</table>
						</div>

					</div>
				</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_2').removeAttr('width').DataTable({
							// responsive: true,
							// fixedHeader: true,
							processing: true,
							serverSide: true,
							order: [],
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_2',
								type: 'POST',
								data: {
									'id_sales': '<?php echo $id_sales; ?>',
									'tgl': '<?php echo $tgl; ?>'
								}
							},
							deferRender: true
						});
					});
				</script>