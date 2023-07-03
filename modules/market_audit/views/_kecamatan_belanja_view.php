				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							KECAMATAN
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_12" class="table table-bordered m-0 table-sm table-striped" style="width:100%">
								<thead>
									<tr>
										<td rowspan="2" style="background-color:#8080ff; color:#FFFFFF; width:170px;"><div align="center"><strong>DATA</strong></div></td>
										<td colspan="8" style="background-color:#7b737c; color:#FFFFFF;"><div align="center"><strong>TRANSAKSI</strong></div></td>
									</tr>
									<tr>
										<td style="background-color:#DD0000; color:#FFFFFF; width:60px;"><div align="center"><strong>TELKOMSEL</strong></div></td>
										<td style="background-color:#fede00; color:#000000; width:60px;"><div align="center"><strong>ISAT</strong></div></td>
										<td style="background-color:#28166f; color:#FFFFFF; width:60px;"><div align="center"><strong>XL</strong></div></td>
										<td style="background-color:#000000; color:#FFFFFF; width:60px;"><div align="center"><strong>TRI</strong></div></td>
										<td style="background-color:#d91d2b; color:#FFFFFF; width:60px;"><div align="center"><strong>SMARTFREN</strong></div></td>
										<td style="background-color:#ed008c; color:#FFFFFF; width:60px;"><div align="center"><strong>AXIS</strong></div></td>
										<td style="background-color:#999999; color:#FFFFFF; width:60px;"><div align="center"><strong>OTHER</strong></div></td>
										<td style="background-color:#f89912; color:#FFFFFF; width:60px;"><div align="center"><strong>TOTAL</strong></div></td>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<td style="background-color:#8080ff; color:#FFFFFF;"><div align="center"><strong>DATA</strong></div></td>
										<td style="background-color:#DD0000; color:#FFFFFF;"><div align="right"><strong>TELKOMSEL</strong></div></td>
										<td style="background-color:#fede00; color:#000000;"><div align="right"><strong>ISAT</strong></div></td>
										<td style="background-color:#28166f; color:#FFFFFF;"><div align="right"><strong>XL</strong></div></td>
										<td style="background-color:#000000; color:#FFFFFF;"><div align="right"><strong>TRI</strong></div></td>
										<td style="background-color:#d91d2b; color:#FFFFFF;"><div align="right"><strong>SMARTFREN</strong></div></td>
										<td style="background-color:#ed008c; color:#FFFFFF;"><div align="right"><strong>AXIS</strong></div></td>
										<td style="background-color:#999999; color:#FFFFFF;"><div align="right"><strong>OTHER</strong></div></td>
										<td style="background-color:#f89912; color:#FFFFFF;"><div align="right"><strong>TOTAL</strong></div></td>
									</tr>
								</tfoot>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_12').removeAttr('width').DataTable({
							// responsive: true,
							// scroller: true,
							"bDestroy": true,
							pageLength: 25,
							scrollY: 400,
							// scrollX: true,
							scrollCollapse: true,
							// fixedColumns: {
								// leftColumns: 1
							// },
							paging: true,
							ordering: false,
							bInfo: true,
							bFilter: false,
							bLengthChange : false,
							processing: true,
							serverSide: true,
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_12',
								type: 'POST',
								data: {
									'kategori': '<?php echo $kategori; ?>',
									'pilihan': '<?php echo $pilihan; ?>',
									'tahun': '<?php echo $tahun; ?>',
									'bulan': '<?php echo $bulan; ?>',
									'minggu': '<?php echo $minggu; ?>',
									'jenis_share': '<?php echo $jenis_share; ?>'
								}
							},
							deferRender: true,
							footerCallback: function(row, data, start, end, display){
								var api = this.api(), data;

								var intVal = function(i){
									return typeof i === 'string' ?
										i.replace(/[\$,]/g, '') * 1 :
										typeof i === 'number' ?
										i : 0;
								};

								var no = 1;

								var value_x = ['telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total'];
								var length_x = value_x.length;

								for (x=0; x<length_x; x++)
								{
									var total_x = value_x[x];

									total_x = api
										.column(no)
										.data()
										.reduce(function (a, b){
											var b = b;

											b = b.replace('<div align="right">', '');
											b = b.replace('</div>', '');
											b = accounting.unformat(b);

											return intVal(a) + intVal(b);
										}, 0);

									$(api.column(no).footer()).html('<div align="right"><strong>' + accounting.formatNumber(total_x) + '</strong></div>');

									no++;
								}
							}
						});
					});
				</script>