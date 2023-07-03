				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							MERCHANDISING
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_9" class="table table-bordered m-0 table-sm table-striped" style="width:100%;font-size:12px">
								<thead class="bg-primary-100">
									<tr>
										<th><?php if ($id_jenis_sales == 'SDS') { echo 'NPSN<br>&nbsp;'; } else { echo 'ID Digipos<br>&nbsp;'; } ?></th>
										<th><?php if ($id_jenis_sales == 'SDS') { echo 'Nama Lokasi<br>&nbsp;'; } else { echo 'Nama Outlet<br>&nbsp;'; } ?></th>
										<th>Status<br>&nbsp;</th>
										<th>Perdana<br>Share</th>
										<th>Voucher Fisik<br>Share</th>
										<th>Layar Toko<br>Share</th>
										<th>Poster<br>Share</th>
										<th>Neon Box<br>Share</th>
										<th>Stiker Scan QR<br>Share</th>
									</tr>
								</thead>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_9').removeAttr('width').DataTable({
							processing: true,
							serverSide: true,
							order: [],
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_9',
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