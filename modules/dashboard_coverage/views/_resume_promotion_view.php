				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							PROMOTION
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_10" class="table table-bordered m-0 table-sm table-striped" style="width:100%;font-size:12px">
								<thead class="bg-primary-100">
									<tr>
										<th><?php if ($id_jenis_sales == 'SDS') { echo 'NPSN'; } else { echo 'ID Digipos'; } ?></th>
										<th><?php if ($id_jenis_sales == 'SDS') { echo 'Nama Lokasi'; } else { echo 'Nama Outlet'; } ?></th>
										<th>Status</th>
										<th>Jumlah Promotion</th>
									</tr>
								</thead>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_10').removeAttr('width').DataTable({
							processing: true,
							serverSide: true,
							order: [],
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_10',
								type: 'POST',
								data: {
									'id_jns_sales': '<?php echo $id_jenis_sales; ?>',
									'id_sales': '<?php echo $id_sales; ?>',
									'tgl': '<?php echo $tgl; ?>'
								}
							},
							deferRender: true
						});
					});
				</script>