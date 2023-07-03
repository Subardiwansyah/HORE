				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							CLUSTER
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_3" class="table table-bordered m-0 table-sm table-striped">
								<thead>
									<tr>
										<td style="background-color:#8080ff; color:#FFFFFF; width:170px;"><div align="center"><strong>DATA</strong></div></td>
										<td style="background-color:#DD0000; color:#FFFFFF; width:60px;"><div align="center"><strong>TELKOMSEL</strong></div></td>
										<td style="background-color:#fede00; color:#000000; width:60px;"><div align="center"><strong>ISAT</strong></div></td>
										<td style="background-color:#28166f; color:#FFFFFF; width:60px;"><div align="center"><strong>XL</strong></div></td>
										<td style="background-color:#000000; color:#FFFFFF; width:60px;"><div align="center"><strong>TRI</strong></div></td>
										<td style="background-color:#d91d2b; color:#FFFFFF; width:60px;"><div align="center"><strong>SMARTFREN</strong></div></td>
										<td style="background-color:#ed008c; color:#FFFFFF; width:60px;"><div align="center"><strong>AXIS</strong></div></td>
										<td style="background-color:#999999; color:#FFFFFF; width:60px;"><div align="center"><strong>OTHER</strong></div></td>
										<td style="background-color:#f89912; color:#FFFFFF; width:60px;"><div align="center"><strong>TOTAL</strong></div></td>
										<td style="background-color:#DD0000; color:#FFFFFF; width:60px;"><div align="center"><strong>TELKOMSEL</strong></div></td>
										<td style="background-color:#fede00; color:#000000; width:60px;"><div align="center"><strong>ISAT</strong></div></td>
										<td style="background-color:#28166f; color:#FFFFFF; width:60px;"><div align="center"><strong>XL</strong></div></td>
										<td style="background-color:#000000; color:#FFFFFF; width:60px;"><div align="center"><strong>TRI</strong></div></td>
										<td style="background-color:#d91d2b; color:#FFFFFF; width:60px;"><div align="center"><strong>SMARTFREN</strong></div></td>
										<td style="background-color:#ed008c; color:#FFFFFF; width:60px;"><div align="center"><strong>AXIS</strong></div></td>
										<td style="background-color:#999999; color:#FFFFFF; width:60px;"><div align="center"><strong>OTHER</strong></div></td>
										<td style="background-color:#f89912; color:#FFFFFF; width:60px;"><div align="center"><strong>TOTAL</strong></div></td>
										<td style="background-color:#1cbf28; color:#FFFFFF; width:60px;"><div align="center"><strong>M-1</strong></div></td>
										<td style="background-color:#1cbf28; color:#FFFFFF; width:60px;"><div align="center"><strong>M-2</strong></div></td>
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
										<td style="background-color:#DD0000; color:#FFFFFF;"><div align="right"><strong>TELKOMSEL</strong></div></td>
										<td style="background-color:#fede00; color:#000000;"><div align="right"><strong>ISAT</strong></div></td>
										<td style="background-color:#28166f; color:#FFFFFF;"><div align="right"><strong>XL</strong></div></td>
										<td style="background-color:#000000; color:#FFFFFF;"><div align="right"><strong>TRI</strong></div></td>
										<td style="background-color:#d91d2b; color:#FFFFFF;"><div align="right"><strong>SMARTFREN</strong></div></td>
										<td style="background-color:#ed008c; color:#FFFFFF;"><div align="right"><strong>AXIS</strong></div></td>
										<td style="background-color:#999999; color:#FFFFFF;"><div align="right"><strong>OTHER</strong></div></td>
										<td style="background-color:#f89912; color:#FFFFFF;"><div align="right"><strong>TOTAL</strong></div></td>
										<td style="background-color:#1cbf28; color:#FFFFFF;"><div align="right"><strong>M-1</strong></div></td>
										<td style="background-color:#1cbf28; color:#FFFFFF;"><div align="right"><strong>M-1</strong></div></td>
									</tr>
								</tfoot>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_3').removeAttr('width').DataTable({
							// responsive: true,
							// scroller: true,
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
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_3',
								type: 'POST',
								data: {
									'kategori': '<?php echo $kategori; ?>',
									'pilihan': '<?php echo $pilihan; ?>',
									'tahun': '<?php echo $tahun; ?>',
									'bulan': '<?php echo $bulan; ?>',
									'minggu': '<?php echo $minggu; ?>',
									'jenis_lokasi': '<?php echo $jenis_lokasi; ?>',
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

								var telkomsel = api
										.column(1)
										.data()
										.reduce(function (a, b){
											var b = b;

											b = b.replace('<div align="right">', '');
											b = b.replace('</div>', '');
											b = accounting.unformat(b);

											return intVal(a) + intVal(b);
										}, 0);

								var isat = api
										.column(2)
										.data()
										.reduce(function (a, b){
											var b = b;

											b = b.replace('<div align="right">', '');
											b = b.replace('</div>', '');
											b = accounting.unformat(b);

											return intVal(a) + intVal(b);
										}, 0);

								var xl = api
										.column(3)
										.data()
										.reduce(function (a, b){
											var b = b;

											b = b.replace('<div align="right">', '');
											b = b.replace('</div>', '');
											b = accounting.unformat(b);

											return intVal(a) + intVal(b);
										}, 0);

								var tri = api
										.column(4)
										.data()
										.reduce(function (a, b){
											var b = b;

											b = b.replace('<div align="right">', '');
											b = b.replace('</div>', '');
											b = accounting.unformat(b);

											return intVal(a) + intVal(b);
										}, 0);

								var smartfren = api
										.column(5)
										.data()
										.reduce(function (a, b){
											var b = b;

											b = b.replace('<div align="right">', '');
											b = b.replace('</div>', '');
											b = accounting.unformat(b);

											return intVal(a) + intVal(b);
										}, 0);

								var axis = api
										.column(6)
										.data()
										.reduce(function (a, b){
											var b = b;

											b = b.replace('<div align="right">', '');
											b = b.replace('</div>', '');
											b = accounting.unformat(b);

											return intVal(a) + intVal(b);
										}, 0);

								var other = api
										.column(7)
										.data()
										.reduce(function (a, b){
											var b = b;

											b = b.replace('<div align="right">', '');
											b = b.replace('</div>', '');
											b = accounting.unformat(b);

											return intVal(a) + intVal(b);
										}, 0);

								var total = api
										.column(8)
										.data()
										.reduce(function (a, b){
											var b = b;

											b = b.replace('<div align="right">', '');
											b = b.replace('</div>', '');
											b = accounting.unformat(b);

											return intVal(a) + intVal(b);
										}, 0);

								var m_1 = api
										.column(17)
										.data()
										.reduce(function (a, b){
											var b = b;

											b = b.replace('<div align="right">', '');
											b = b.replace('</div>', '');
											b = accounting.unformat(b);

											return intVal(a) + intVal(b);
										}, 0);

								var m_2 = api
										.column(18)
										.data()
										.reduce(function (a, b){
											var b = b;

											b = b.replace('<div align="right">', '');
											b = b.replace('</div>', '');
											b = accounting.unformat(b);

											return intVal(a) + intVal(b);
										}, 0);

								var bagi = total ? total : 1;
								var telkomsel_persen = (telkomsel / bagi) * 100;
								var isat_persen = (isat / bagi) * 100;
								var xl_persen = (xl / bagi) * 100;
								var tri_persen = (tri / bagi) * 100;
								var smartfren_persen = (smartfren / bagi) * 100;
								var axis_persen = (axis / bagi) * 100;
								var other_persen = (other / bagi) * 100;
								var total_persen = (total / bagi) * 100;

								$(api.column(1).footer()).html('<div align="right"><strong>' + accounting.formatNumber(telkomsel) + '</strong></div>');
								$(api.column(2).footer()).html('<div align="right"><strong>' + accounting.formatNumber(isat) + '</strong></div>');
								$(api.column(3).footer()).html('<div align="right"><strong>' + accounting.formatNumber(xl) + '</strong></div>');
								$(api.column(4).footer()).html('<div align="right"><strong>' + accounting.formatNumber(tri) + '</strong></div>');
								$(api.column(5).footer()).html('<div align="right"><strong>' + accounting.formatNumber(smartfren) + '</strong></div>');
								$(api.column(6).footer()).html('<div align="right"><strong>' + accounting.formatNumber(axis) + '</strong></div>');
								$(api.column(7).footer()).html('<div align="right"><strong>' + accounting.formatNumber(other) + '</strong></div>');
								$(api.column(8).footer()).html('<div align="right"><strong>' + accounting.formatNumber(total) + '</strong></div>');
								$(api.column(9).footer()).html('<div align="right"><strong>' + accounting.formatMoney(telkomsel_persen) + ' %</strong></div>');
								$(api.column(10).footer()).html('<div align="right"><strong>' + accounting.formatMoney(isat_persen) + ' %</strong></div>');
								$(api.column(11).footer()).html('<div align="right"><strong>' + accounting.formatMoney(xl_persen) + ' %</strong></div>');
								$(api.column(12).footer()).html('<div align="right"><strong>' + accounting.formatMoney(tri_persen) + ' %</strong></div>');
								$(api.column(13).footer()).html('<div align="right"><strong>' + accounting.formatMoney(smartfren_persen) + ' %</strong></div>');
								$(api.column(14).footer()).html('<div align="right"><strong>' + accounting.formatMoney(axis_persen) + ' %</strong></div>');
								$(api.column(15).footer()).html('<div align="right"><strong>' + accounting.formatMoney(other_persen) + ' %</strong></div>');
								$(api.column(16).footer()).html('<div align="right"><strong>' + accounting.formatMoney(total_persen) + ' %</strong></div>');
								$(api.column(17).footer()).html('<div align="right"><strong>' + accounting.formatMoney(m_1) + ' %</strong></div>');
								$(api.column(18).footer()).html('<div align="right"><strong>' + accounting.formatMoney(m_2) + ' %</strong></div>');

							}
						});
					});
				</script>