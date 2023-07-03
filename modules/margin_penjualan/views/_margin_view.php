				<div class="card mb-3">
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table" class="table table-sm table-bordered table-striped" style="width:100%">
								<thead class="bg-primary-100">
									<tr>
										<th>Kode Produk</th>
										<th>Nama Produk</th>
										<th>Harga Modal</th>
										<th>Harga Jual</th>
										<th>@Margin</th>
										<th>Penjualan</th>
										<th>Total Margin</th>
									</tr>
								</thead>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table').removeAttr('width').DataTable({
							responsive: true,
							fixedHeader: true,
							processing: true,
							serverSide: true,
							order: [],
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar',
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