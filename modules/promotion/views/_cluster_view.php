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
										<?php foreach($list_program as $program) { ?>
										<td style="background-color:#999999; color:#FFFFFF; width:80px; font-size:9px;"><div align="center"><strong><?php echo $program->nama; ?></strong></div></td>
										<?php } ?>
										<td style="background-color:#f89912; color:#FFFFFF;"><div align="center"><strong>TOTAL</strong></div></td>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<td style="background-color:#8080ff; color:#FFFFFF;"><div align="center"><strong>DATA</strong></div></td>
										<?php foreach($list_program as $program) { ?>
										<td style="background-color:#999999; color:#FFFFFF;"><div align="right"><strong></strong></div></td>
										<?php } ?>
										<td style="background-color:#f89912; color:#FFFFFF;"><div align="right"><strong></strong></div></td>
									</tr>
								</tfoot>
							</table>

						</div>
					</div>
				</div>

				<?php
					$total_data = count($list_program);
					$program = '';

					if ($total_data > 0)
					{
						for ($i=0; $i<$total_data; $i++)
						{
							$program .= $list_program[$i]->id.',';
						}

						$program = substr($program, 0, -1);
					}
					else
					{
						$program = 0;
					}
				?>

				<script>
					$(document).ready(function(){
						$('#dt_table_3').removeAttr('width').DataTable({
							// responsive: true,
							// scroller: true,
							"bDestroy": true,
							pageLength: 25,
							scrollY: 400,
							scrollCollapse: true,
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
									'total_program': '<?php echo $total_data; ?>',
									'program': '<?php echo $program; ?>',
									'kategori': '<?php echo $kategori; ?>',
									'pilihan': '<?php echo $pilihan; ?>',
									'jenis_lokasi': '<?php echo $jenis_lokasi; ?>',
									'tahun': '<?php echo $tahun; ?>',
									'bulan': '<?php echo $bulan; ?>',
									'minggu': '<?php echo $minggu; ?>'
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

								var total_program = <?php echo count($list_program); ?>;
								var no = 1;

								if (total_program > 0)
								{
									for (x=0; x<total_program; x++)
									{
										var program = 'program_';
										var program_x = program+x;

										program_x = api
												.column(no)
												.data()
												.reduce(function (a, b){
													// var a = a;
													var b = b;

													// a = a.replace('<div align="right">', '');
													// a = a.replace('</div>', '');

													b = b.replace('<div align="right">', '');
													b = b.replace('</div>', '');

													return intVal(a) + intVal(b);
												}, 0);

										$(api.column(no).footer()).html('<div align="right"><strong>' + program_x + '</strong></div>');

										no++;
									}
								}

								var total = api
									.column(no)
									.data()
									.reduce(function (a, b){
										// var a = a;
										var b = b;

										// a = a.replace('<div align="right">', '');
										// a = a.replace('</div>', '');

										b = b.replace('<div align="right">', '');
										b = b.replace('</div>', '');

										return intVal(a) + intVal(b);
									}, 0);

								$(api.column(no).footer()).html('<div align="right"><strong>' + accounting.formatNumber(total) + '</strong></div>');
							}
						});
					});
				</script>