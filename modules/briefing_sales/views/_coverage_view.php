				<div class="card mb-3">
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_1" class="table table-bordered table-sm table-striped" style="width:100%">
								<thead class="bg-primary-100">
									<tr>
										<th>Aksi</th>
										<th>Outlet</th>
										<th>Clock In</th>
										<th>Clock Out</th>
										<th>Durasi (Menit)</th>
										<th>Status</th>
									</tr>
								</thead>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_1').removeAttr('width').DataTable({
							responsive: true,
							fixedHeader: true,
							processing: true,
							serverSide: true,
							order: [],
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_1',
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
				</script>