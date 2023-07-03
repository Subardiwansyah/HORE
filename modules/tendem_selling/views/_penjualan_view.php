				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							PENCAPAIAN PENJUALAN TERENDAH - 2 NAMA SF
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsivex">

							<table id="dt_table_1" class="table table-bordered table-sm table-striped" border="1">
								<thead>
									<tr>
										<td rowspan="4" style="background-color:#8080ff; color:#FFFFFF; width:200px;">DATA</td>
										<td style="background-color:#8080ff; color:#FFFFFF;" colspan="16">TARGET 1 MINGGU</td>
										<td style="background-color:#8080ff; color:#FFFFFF;" colspan="16">PENJUALAN 1 MINGGU</td>
									</tr>
									<tr style="font-size:9px;">
										<td class="bg-primary-240" colspan="6">SEGEL</td>
										<td class="bg-primary-240" colspan="3">SA</td>
										<td class="bg-primary-240" colspan="3">VOUCHER INTERNET</td>
										<td class="bg-primary-240" colspan="3">VOUCHER GAME</td>
										<td class="bg-primary-240" rowspan="3">TOTAL</td>

										<td class="bg-primary-250" colspan="6">SEGEL</td>
										<td class="bg-primary-250" colspan="3">SA</td>
										<td class="bg-primary-250" colspan="3">VOUCHER INTERNET</td>
										<td class="bg-primary-250" colspan="3">VOUCHER GAME</td>
										<td class="bg-primary-250" rowspan="3">TOTAL</td>
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
									</tr>
								</thead>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_1').removeAttr('width').DataTable({
							// pageLength: 2,
							// scrollY: 350,
							scrollX: true,
							scrollCollapse: false,
							fixedColumns: {
								leftColumns: 1
							},
							paging: false,
							ordering: false,
							bInfo: false,
							bFilter: false,
							bLengthChange : false,
							processing: true,
							serverSide: true,
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_1',
								type: 'POST',
								data: {
									'id_tap': '<?php echo $id_tap; ?>',
									'tahun': '<?php echo $tahun; ?>',
									'bulan': '<?php echo $bulan; ?>',
									'minggu': '<?php echo $minggu; ?>'
								}
							},
							deferRender: true,
							dom: 'lfrtip'
						});
					});
				</script>