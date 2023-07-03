				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							DAFTAR PENJUALAN
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_0" class="table table-bordered m-0 table-sm table-striped">
								<thead class="bg-primary-100">
									<tr>
										<td class="bg-primary-100" rowspan="2" style="width:40px;"><div align="center" style="margin-top:15px;"><strong>NO</strong></div></td>
										<td class="bg-primary-100" rowspan="2" style="width:170px;"><div align="center" style="margin-top:15px;"><strong>BRANCH</strong></div></td>
										<td class="bg-primary-100" colspan="2"><div align="center"><strong>SEGEL</strong></div></td>
										<td class="bg-primary-100" colspan="3"><div align="center"><strong>SA</strong></div></td>
										<td class="bg-primary-100" colspan="3"><div align="center"><strong>VOUCHER FISIK</strong></div></td>
										<td class="bg-primary-100"rowspan="2"><div align="center"><strong>LA</strong></div></td>
									</tr>
									<tr>
										<td class="bg-primary-100"><div align="center"><strong>PREPAID</strong></div></td>
										<td class="bg-primary-100"><div align="center"><strong>VOUCHER FISIK</strong></div></td>
										<td class="bg-primary-100"><div align="center"><strong>LD</strong></div></td>
										<td class="bg-primary-100"><div align="center"><strong>MD</strong></div></td>
										<td class="bg-primary-100"><div align="center"><strong>HD</strong></div></td>
										<td class="bg-primary-100"><div align="center"><strong>LD</strong></div></td>
										<td class="bg-primary-100"><div align="center"><strong>MD</strong></div></td>
										<td class="bg-primary-100"><div align="center"><strong>HD</strong></div></td>
									</tr>
									<tfoot>
										<tr class="bg-primary-100">
											<td colspan="2"><div align="center"><strong>TOTAL</strong></div></td>
											<td><div align="right"><strong>0</strong></div></td>
											<td><div align="right"><strong>0</strong></div></td>
											<td><div align="right"><strong>0</strong></div></td>
											<td><div align="right"><strong>0</strong></div></td>
											<td><div align="right"><strong>0</strong></div></td>
											<td><div align="right"><strong>0</strong></div></td>
											<td><div align="right"><strong>0</strong></div></td>
											<td><div align="right"><strong>0</strong></div></td>
											<td><div align="right"><strong>0</strong></div></td>
										</tr>
									</tfoot>
								</thead>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_0').dataTable({
							responsive: true,
							ordering: false,
							paging: false,
							bInfo: false,
							ordering: false,
							scrollY: 350,
							scrollCollapse: true,
							processing: true,
							serverSide: true,
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar',
								type: 'POST',
								data: {
									'tahun': '<?php echo $tahun; ?>',
									'bulan': '<?php echo $bulan; ?>'
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

								var no = 2;

								var value_x = ['segel_prepaid', 'segel_voucher', 'sa_ld', 'sa_md', 'sa_hd', 'vf_ld', 'vf_md', 'vf_hd', 'linkaja'];
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