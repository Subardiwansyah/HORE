				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							TARGET PENJUALAN
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_2" class="table table-bordered table-sm table-striped" border="1">
								<thead>
									<tr>
										<td rowspan="4" style="background-color:#8080ff; color:#FFFFFF; width:200px;">DATA</td>
										<td style="background-color:#8080ff; color:#FFFFFF;" colspan="16">PENJUALAN</td>
										<td style="background-color:#8080ff; color:#FFFFFF;" colspan="16">TARGET</td>
										<td style="background-color:#8080ff; color:#FFFFFF;" colspan="16">GAP</td>
									</tr>
									<tr style="font-size:9px;">
										<td class="bg-primary-240" colspan="6">SEGEL</td>
										<td class="bg-primary-240" colspan="3">SA</td>
										<td class="bg-primary-240" colspan="3">VOUCHER INTERNET</td>
										<td class="bg-primary-240" colspan="3">VOUCHER GAME</td>
										<td class="bg-primary-240" rowspan="3">LA</td>

										<td class="bg-primary-250" colspan="6">SEGEL</td>
										<td class="bg-primary-250" colspan="3">SA</td>
										<td class="bg-primary-250" colspan="3">VOUCHER INTERNET</td>
										<td class="bg-primary-250" colspan="3">VOUCHER GAME</td>
										<td class="bg-primary-250" rowspan="3">LA</td>

										<td class="bg-primary-260" colspan="6">SEGEL</td>
										<td class="bg-primary-260" colspan="3">SA</td>
										<td class="bg-primary-260" colspan="3">VOUCHER INTERNET</td>
										<td class="bg-primary-260" colspan="3">VOUCHER GAME</td>
										<td class="bg-primary-260" rowspan="3">LA</td>
									</tr>
									<tr style="font-size:9px;">
										<td class="bg-primary-240" colspan="2">PERDANA</td>
										<td class="bg-primary-240" rowspan="2">VOUCHER INTERNET</td>
										<td class="bg-primary-240" colspan="3">VOUCHER GAME</td>
										<td class="bg-primary-240" rowspan="2">LD</td>
										<td class="bg-primary-240" rowspan="2">MD</td>
										<td class="bg-primary-240" rowspan="2">HD</td>
										<td class="bg-primary-240" rowspan="2">LD</td>
										<td class="bg-primary-240" rowspan="2">MD</td>
										<td class="bg-primary-240" rowspan="2">HD</td>
										<td class="bg-primary-240" rowspan="2">LD</td>
										<td class="bg-primary-240" rowspan="2">MD</td>
										<td class="bg-primary-240" rowspan="2">HD</td>

										<td class="bg-primary-250" colspan="2">PERDANA</td>
										<td class="bg-primary-250" rowspan="2">VOUCHER INTERNET</td>
										<td class="bg-primary-250" colspan="3">VOUCHER GAME</td>
										<td class="bg-primary-250" rowspan="2">LD</td>
										<td class="bg-primary-250" rowspan="2">MD</td>
										<td class="bg-primary-250" rowspan="2">HD</td>
										<td class="bg-primary-250" rowspan="2">LD</td>
										<td class="bg-primary-250" rowspan="2">MD</td>
										<td class="bg-primary-250" rowspan="2">HD</td>
										<td class="bg-primary-250" rowspan="2">LD</td>
										<td class="bg-primary-250" rowspan="2">MD</td>
										<td class="bg-primary-250" rowspan="2">HD</td>

										<td class="bg-primary-260" colspan="2">PERDANA</td>
										<td class="bg-primary-260" rowspan="2">VOUCHER INTERNET</td>
										<td class="bg-primary-260" colspan="3">VOUCHER GAME</td>
										<td class="bg-primary-260" rowspan="2">LD</td>
										<td class="bg-primary-260" rowspan="2">MD</td>
										<td class="bg-primary-260" rowspan="2">HD</td>
										<td class="bg-primary-260" rowspan="2">LD</td>
										<td class="bg-primary-260" rowspan="2">MD</td>
										<td class="bg-primary-260" rowspan="2">HD</td>
										<td class="bg-primary-260" rowspan="2">LD</td>
										<td class="bg-primary-260" rowspan="2">MD</td>
										<td class="bg-primary-260" rowspan="2">HD</td>
									</tr>
									<tr style="font-size:9px;">
										<td class="bg-primary-240">PREPAID</td>
										<td class="bg-primary-240">USIM</td>
										<td class="bg-primary-240">SILVER</td>
										<td class="bg-primary-240">GOLD</td>
										<td class="bg-primary-240">PLATINUM</td>

										<td class="bg-primary-250">PREPAID</td>
										<td class="bg-primary-250">USIM</td>
										<td class="bg-primary-250">SILVER</td>
										<td class="bg-primary-250">GOLD</td>
										<td class="bg-primary-250">PLATINUM</td>

										<td class="bg-primary-260">PREPAID</td>
										<td class="bg-primary-260">USIM</td>
										<td class="bg-primary-260">SILVER</td>
										<td class="bg-primary-260">GOLD</td>
										<td class="bg-primary-260">PLATINUM</td>
									</tr>
								</thead>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_2').removeAttr('width').DataTable({
							pageLength: 25,
							scrollY: 350,
							scrollX: true,
							scrollCollapse: true,
							fixedColumns: {
								leftColumns: 1
							},
							paging: true,
							ordering: false,
							bInfo: true,
							bFilter: false,
							bLengthChange : false,
							processing: true,
							serverSide: true,
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_2',
								type: 'POST',
								data: {
									'id_jenis_sales': '<?php echo $id_jenis_sales; ?>',
									'id_sales': '<?php echo $id_sales; ?>',
									'tgl': '<?php echo $tgl; ?>'
								}
							},
							deferRender: true,
							dom: 'lfrtip'
						});
					});
				</script>