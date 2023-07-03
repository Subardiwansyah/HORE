        <div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							SALES - KUNJUNGAN
						</div>
					</div>
					<div class="card-body">							
						 <div class = "table-responsivex">
							<table id="dt_table_6" class="table table-bordered m-0 table-sm table-striped" style="font-size:12px">
								<thead class="bg-primary-200">
									<tr>
										<td class="bg-primary-200"><div align="center"><strong>NO</strong></div></td>
										<td class="bg-primary-200"><div align="center"><strong>ID SALES</strong></div></td>
										<td class="bg-primary-200"><div align="center"><strong>NAMA</strong></div></td>
										<td class="bg-primary-200"><div align="center"><strong>TAP</strong></div></td>
										<td class="bg-primary-200"><div align="center"><strong>CLUSTER</strong></div></td>
										<td class="bg-primary-200"><div align="center"><strong>CLOCK IN</strong></div></td>
										<td class="bg-primary-200"><div align="center"><strong>TOTAL PJP</strong></div></td>
										<td class="bg-primary-200"><div align="center"><strong>STATUS</strong></div></td>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_6').removeAttr('width').DataTable({
							processing: true,
							serverSide: true,							
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_6',
								type: 'POST',
								data: {
									'tgl': '<?php echo $tgl; ?>'
								}
							},
							deferRender: true
						});
					});
				</script>