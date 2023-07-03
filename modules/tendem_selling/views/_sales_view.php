				<div class="card mb-3">
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_2" class="table table-sm table-bordered table-striped" style="width:100%">
								<thead class="bg-primary-100">
									<tr>
										<th>ID</th>
										<th>Nama</th>
										<th>Jabatan</th>
										<th>ID SF</th>
										<th>Nama</th>
										<th>Hasil Penilaian</th>
										<th>Form Hasil Penilaian</th>
									</tr>
								</thead>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_2').removeAttr('width').DataTable({
							responsive: true,
							fixedHeader: true,
							processing: true,
							serverSide: true,
							order: [],
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_2',
								type: 'POST',
								data: {
									'id_tap': '<?php echo $id_tap; ?>',
									'tahun': '<?php echo $tahun; ?>',
									'bulan': '<?php echo $bulan; ?>',
									'minggu': '<?php echo $minggu; ?>'
								}
							},
							deferRender: true
						});
					});
				</script>