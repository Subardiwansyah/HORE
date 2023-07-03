				<div class="card mb-3">
					<div class="card-body">
						
						<div id="x_pesan_dt" style="display:none">
							<div style="background-color: #39a1f4;" class="alert bg-info-400 text-white fade show" role="alert">
								<div class="d-flex align-items-center">
									<div class="alert-icon">
										<i class="fal fa-info-square"></i>
									</div>
									<div class="flex-1">
										<span class="h5">Tidak ada target sales untuk filter yang dipilih (<span id="x_pesan"></span> data)</span>
									</div>
								</div>
							</div>
						</div>
					
					
						<div class="table-responsive">

							<table id="dt_table_1" class="table table-sm table-bordered table-striped">
								<thead class="bg-primary-100">
									<tr>
										<td class="bg-primary-100" rowspan="3"><div align="center" style="margin-top:40px"><strong>NO</strong></div></td>
										<td class="bg-primary-100" rowspan="3"><div align="center" style="margin-top:40px;width:180px;"><strong>TAP/SALES</strong></div></td>
										<td colspan="6"><div align="center"><strong>SEGEL</strong></div></td>
										<td colspan="3"><div align="center"><strong>SA</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER INTERNET</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER GAME</strong></div></td>
										<td rowspan="3"><div align="center" style="margin-top:40px"><strong>NEW RS <br>PER HARI</strong></div></td>
										<td rowspan="3"><div align="center" style="margin-top:40px"><strong>LIMIT <br>LINK AJA</strong></div></td>
									</tr>
									<tr>
										<td colspan="2"><div align="center"><strong>PERDANA</strong></div></td>
										<td rowspan="2"><div align="center"><strong>VOUCHER INTERNET</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER GAME</strong></div></td>
										<td rowspan="2"><div align="center"><strong>LD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>MD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>HD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>LD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>MD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>HD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>LD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>MD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>HD</strong></div></td>
									</tr>
									<tr>
										<td><div align="center"><strong>PREPAID</strong></div></td>
										<td><div align="center"><strong>USIM</strong></div></td>
										<td><div align="center"><strong>SILVER</strong></div></td>
										<td><div align="center"><strong>GOLD</strong></div></td>
										<td><div align="center"><strong>PLATINUM</strong></div></td>
									</tr>
								</thead>
								<tfoot class="bg-primary-100">
									<tr>
										<td class="bg-primary-100" colspan="2"><div align="center"><strong>TOTAL</strong></div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
										<td><div align="right">0</div></td>
									</tr>
								</tfoot>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_1').removeAttr('width').DataTable({
							pageLength: 25,
							scrollY: 350,
							scrollX: true,
							scrollCollapse: true,
							fixedColumns: {
								leftColumns: 2
							},
							paging: true,
							ordering: false,
							bInfo: true,
							bFilter: false,
							bLengthChange : false,
							processing: true,
							serverSide: true,
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_1',
								type: 'POST',
								data: {
									'id_cluster': '<?php echo isset($id_cluster) ? $id_cluster : 0; ?>',
									'tahun': '<?php echo isset($tahun) ? $tahun : 0; ?>',
									'bulan': '<?php echo isset($bulan) ? $bulan : 0; ?>',
									'minggu': '<?php echo isset($minggu) ? $minggu : 0; ?>',
									'jns_sales': '<?php echo isset($jns_sales) ? $jns_sales : "SSF"; ?>'
								}
							},
							deferRender: true,
							initComplete: function(settings, json){
								var x_data = json.recordsTotal;
								
								if (x_data > 0)
								{
									$('#x_pesan_dt').hide();
								}
								else
								{
									$('#x_pesan_dt').show();
									$('#x_pesan').text(json.recordsTotal);
								}
							}
						});
					});
				</script>