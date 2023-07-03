				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							MARKET AUDIT
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_11" class="table table-bordered m-0 table-sm table-striped" style="width:100%;font-size:12px">
								<thead class="bg-primary-100">
									<tr>
										<td rowspan="2"><?php if ($id_jenis_sales == 'SDS') { echo 'NPSN<br>&nbsp;'; } else { echo 'ID Digipos<br>&nbsp;'; } ?></td>
										<td rowspan="2"><?php if ($id_jenis_sales == 'SDS') { echo 'Nama Lokasi<br>&nbsp;'; } else { echo 'Nama Outlet<br>&nbsp;'; } ?></td>
										<td rowspan="2">Status<br>&nbsp;</td>
										<td rowspan="2">Belanja<br>Share</td>
										<td colspan="3">Sales Broadband Share</td>
										<td colspan="3">Voucher Fisik Share</td>
									</tr>
									<tr>
										<td>LD</td>
										<td>MD</td>
										<td>HD</td>
										<td>LD</td>
										<td>MD</td>
										<td>HD</td>
									</tr>
								</thead>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_11').removeAttr('width').DataTable({
							processing: true,
							serverSide: true,
							order: [],
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_11',
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