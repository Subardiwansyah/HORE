					<table id="dt_table_2" class="table table-bordered m-0 table-sm table-striped">
						<thead class="bg-primary-100" >
							<tr style="font-size:11px;">
								<td class="bg-primary-100" rowspan="4"><div style="width:170px">NAMA</div></td>
								<td rowspan="4">PJP</td>
								<td rowspan="2" colspan="2">ACTUAL CALL</td>
								<td rowspan="2" colspan="2">EFFECTIVE CALL</td>
								<td colspan="17">UNIT HASIL JUALAN</td>
								<td colspan="17">TARGET</td>
								<td colspan="17">REMAINING TARGET</td>
								<td colspan="7">EVALUASI MERCHANDISING</td>
							</tr>
							<tr style="font-size:11px;">
								<td colspan="6">SEGEL</td>
								<td colspan="3">SA</td>
								<td colspan="3">VOUCHER INTERNET</td>
								<td colspan="3">VOUCHER GAME</td>
								<td rowspan="3">NEW RS PER HARI</td>
								<td rowspan="3">LIMIT LINK AJA</td>
								<td colspan="6">SEGEL</td>
								<td colspan="3">SA</td>
								<td colspan="3">VOUCHER INTERNET</td>
								<td colspan="3">VOUCHER GAME</td>
								<td rowspan="3">NEW RS PER HARI</td>
								<td rowspan="3">LIMIT LINK AJA</td>
								<td colspan="6">SEGEL</td>
								<td colspan="3">SA</td>
								<td colspan="3">VOUCHER INTERNET</td>
								<td colspan="3">VOUCHER GAME</td>
								<td rowspan="3">NEW RS PER HARI</td>
								<td rowspan="3">LIMIT LINK AJA</td>
								<td>PERDANA SHARE</td>
								<td>VOUCHER FISIK SHARE</td>
								<td>LAYAR TOKO SHARE</td>
								<td>POSTER SHARE</td>
								<td>NEON BOX SHARE</td>
								<td>STIKER SCAN QR SHARE</td>
								<td rowspan="3">VIDEO SHARE</td>
							</tr>
							<tr style="font-size:11px;">
								<td class="bg-primary-100" rowspan="2">JUMLAH</td>
								<td class="bg-primary-100" rowspan="2">%</td>
								<td class="bg-primary-100" rowspan="2">JUMLAH</td>
								<td class="bg-primary-100" rowspan="2">%</td>
								<td colspan="2">PERDANA</td>
								<td rowspan="2">VOUCHER INTERNET</td>
								<td colspan="3">VOUCHER GAME</td>
								<td rowspan="2">LD</td>
								<td rowspan="2">MD</td>
								<td rowspan="2">HD</td>
								<td rowspan="2">LD</td>
								<td rowspan="2">MD</td>
								<td rowspan="2">HD</td>
								<td rowspan="2">LD</td>
								<td rowspan="2">MD</td>
								<td rowspan="2">HD</td>
								<td colspan="2">PERDANA</td>
								<td rowspan="2">VOUCHER INTERNET</td>
								<td colspan="3">VOUCHER GAME</td>
								<td rowspan="2">LD</td>
								<td rowspan="2">MD</td>
								<td rowspan="2">HD</td>
								<td rowspan="2">LD</td>
								<td rowspan="2">MD</td>
								<td rowspan="2">HD</td>
								<td rowspan="2">LD</td>
								<td rowspan="2">MD</td>
								<td rowspan="2">HD</td>
								<td colspan="2">PERDANA</td>
								<td rowspan="2">VOUCHER INTERNET</td>
								<td colspan="3">VOUCHER GAME</td>
								<td rowspan="2">LD</td>
								<td rowspan="2">MD</td>
								<td rowspan="2">HD</td>
								<td rowspan="2">LD</td>
								<td rowspan="2">MD</td>
								<td rowspan="2">HD</td>
								<td rowspan="2">LD</td>
								<td rowspan="2">MD</td>
								<td rowspan="2">HD</td>
								<td rowspan="2">TSEL</td>
								<td rowspan="2">TSEL</td>
								<td rowspan="2">TSEL</td>
								<td rowspan="2">TSEL</td>
								<td rowspan="2">TSEL</td>
								<td rowspan="2">TSEL</td>
							</tr>
							<tr style="font-size:11px;">
								<td>PREPAID</td>
								<td>USIM</td>
								<td>SILVER</td>
								<td>GOLD</td>
								<td>PLATINUM</td>
								<td>PREPAID</td>
								<td>USIM</td>
								<td>SILVER</td>
								<td>GOLD</td>
								<td>PLATINUM</td>
								<td>PREPAID</td>
								<td>USIM</td>
								<td>SILVER</td>
								<td>GOLD</td>
								<td>PLATINUM</td>
							</tr>
						</thead>
					</table>

					<script>
					$(document).ready(function(){
						$('#dt_table_2').removeAttr('width').DataTable({
							pageLength: 25,
							scrollY: 400,
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
									'id_cluster': '<?php echo isset($id_cluster) ? $id_cluster : 0; ?>',
									'id_tap': '<?php echo isset($id_tap) ? $id_tap : 0; ?>',
									'id_jns_sales': '<?php echo isset($id_jns_sales) ? $id_jns_sales : 0; ?>',
									'id_sales': '<?php echo isset($id_sales) ? $id_sales : 0; ?>',
									'tahun': '<?php echo isset($tahun) ? $tahun : 0; ?>',
									'bulan': '<?php echo isset($bulan) ? $bulan : 0; ?>'
								}
							},
							deferRender: true
						});
					});
				</script>