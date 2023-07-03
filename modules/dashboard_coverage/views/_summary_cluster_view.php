				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							CLUSTER
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_2" class="table table-bordered m-0 table-sm table-striped" style="font-size:12px">
								<thead>
									<tr style="font-size:11px;">
										<td class="bg-primary-270" rowspan="3" style="width:40px;"><div align="center" style="margin-top:25px;"><strong>NO</strong></div></td>
										<td class="bg-primary-270" rowspan="3" style="width:170px;"><div align="center" style="margin-top:25px;"><strong>CLUSTER</strong></div></td>
										<td class="bg-primary-200" colspan="5"><div align="center"><strong>OUTLET</strong></div></td>
										<td class="bg-primary-230" colspan="5"><div align="center"><strong>SEKOLAH</strong></div></td>
										<td class="bg-primary-240" colspan="5"><div align="center"><strong>KAMPUS</strong></div></td>
										<td class="bg-primary-250" colspan="5"><div align="center"><strong>FAKULTAS</strong></div></td>
										<td class="bg-primary-260" colspan="5"><div align="center"><strong>POI</strong></div></td>
									</tr>
									<tr style="font-size:10px;">
										<td class="bg-primary-201" colspan="3"><div align="center"><strong>EXT</strong></div></td>
										<td class="bg-primary-201" rowspan="2"><div align="center" style="margin-top:15px;"><strong>TARGET</strong></div></td>
										<td class="bg-primary-201" rowspan="2"><div align="center" style="margin-top:15px;"><strong>COVERAGE LEVEL</strong></div></td>

										<td class="bg-primary-231" colspan="3"><div align="center"><strong>EXT</strong></div></td>
										<td class="bg-primary-231" rowspan="2"><div align="center" style="margin-top:15px;"><strong>TARGET</strong></div></td>
										<td class="bg-primary-231" rowspan="2"><div align="center" style="margin-top:15px;"><strong>COVERAGE LEVEL</strong></div></td>

										<td class="bg-primary-241" colspan="3"><div align="center"><strong>EXT</strong></div></td>
										<td class="bg-primary-241" rowspan="2"><div align="center" style="margin-top:15px;"><strong>TARGET</strong></div></td>
										<td class="bg-primary-241" rowspan="2"><div align="center" style="margin-top:15px;"><strong>COVERAGE LEVEL</strong></div></td>

										<td class="bg-primary-251" colspan="3"><div align="center"><strong>EXT</strong></div></td>
										<td class="bg-primary-251" rowspan="2"><div align="center" style="margin-top:15px;"><strong>TARGET</strong></div></td>
										<td class="bg-primary-251" rowspan="2"><div align="center" style="margin-top:15px;"><strong>COVERAGE LEVEL</strong></div></td>

										<td class="bg-primary-261" colspan="3"><div align="center"><strong>EXT</strong></div></td>
										<td class="bg-primary-261" rowspan="2"><div align="center" style="margin-top:15px;"><strong>TARGET</strong></div></td>
										<td class="bg-primary-261" rowspan="2"><div align="center" style="margin-top:15px;"><strong>COVERAGE LEVEL</strong></div></td>
									</tr>
									<tr style="font-size:10px;">
										<td class="bg-primary-201"><div align="center"><strong>OPEN</strong></div></td>
										<td class="bg-primary-201"><div align="center"><strong>CLOSE</strong></div></td>
										<td class="bg-primary-201"><div align="center"><strong>TOTAL</strong></div></td>

										<td class="bg-primary-231"><div align="center"><strong>OPEN</strong></div></td>
										<td class="bg-primary-231"><div align="center"><strong>CLOSE</strong></div></td>
										<td class="bg-primary-231"><div align="center"><strong>TOTAL</strong></div></td>

										<td class="bg-primary-241"><div align="center"><strong>OPEN</strong></div></td>
										<td class="bg-primary-241"><div align="center"><strong>CLOSE</strong></div></td>
										<td class="bg-primary-241"><div align="center"><strong>TOTAL</strong></div></td>

										<td class="bg-primary-251"><div align="center"><strong>OPEN</strong></div></td>
										<td class="bg-primary-251"><div align="center"><strong>CLOSE</strong></div></td>
										<td class="bg-primary-251"><div align="center"><strong>TOTAL</strong></div></td>

										<td class="bg-primary-261"><div align="center"><strong>OPEN</strong></div></td>
										<td class="bg-primary-261"><div align="center"><strong>CLOSE</strong></div></td>
										<td class="bg-primary-261"><div align="center"><strong>TOTAL</strong></div></td>
									</tr>
								</thead>
								<tbody>
								</tbody>
								<tfoot>
								</tfoot>
							</table>

						</div>
					</div>
				</div>

				<script type="text/javascript">
					$(document).ready(function(){
						$('#dt_table_2').DataTable({
							scrollX: true,
							scrollCollapse: true,
							fixedColumns: {
								leftColumns: 2
							},
							paging: true,
							pageLength: 10,
							ordering: false,
							processing: true,
							serverSide: true,
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_2',
								type: "POST",
								data: {
									'tahun': '<?php echo $tahun; ?>',
									'bulan': '<?php echo $bulan; ?>'
								}
							},
							deferRender: true
						});
					});
				</script>