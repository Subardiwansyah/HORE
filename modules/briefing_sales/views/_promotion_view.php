				<div class="card mb-3">
					<div class="card-body">
						<div class="table-responsive">

							<?php $data_w1 = count($list_program_w1); ?>
							<?php $data_w2 = count($list_program_w2); ?>
							<?php $data_w3 = count($list_program_w3); ?>
							<?php $data_w4 = count($list_program_w4); ?>

							<?php if ($data_w1 == 0) { ?>

							<div style="background-color: #ffb20e;" class="alert bg-info-400 text-white fade show" role="alert">
								<div class="d-flex align-items-center">
									<div class="alert-icon">
										<i class="fal fa-exclamation-triangle"></i>
									</div>
									<div class="flex-1">
										<span class="h5">Tidak ada program promotion di tiga (3) minggu kebelakang.</span>
									</div>
								</div>
							</div>

							<?php } else { ?>

							<table id="dt_table_10" class="table table-bordered table-sm table-striped" border="1">
								<thead>
									<tr>
										<td rowspan="2" style="background-color:#8080ff; color:#FFFFFF; width:200px;">DATA</td>
										<?php if ($data_w1 > 0) { ?><td colspan="8" style="background-color:#8080ff; color:#FFFFFF;">W</td><?php } ?>
										<?php if ($data_w2 > 0) { ?><td colspan="8" style="background-color:#8080ff; color:#FFFFFF;">W-1</td><?php } ?>
										<?php if ($data_w3 > 0) { ?><td colspan="8" style="background-color:#8080ff; color:#FFFFFF;">W-2</td><?php } ?>
										<?php if ($data_w4 > 0) { ?><td colspan="8" style="background-color:#8080ff; color:#FFFFFF;">W-3</td><?php } ?>
									</tr>
									<tr style="font-size:9px;">
										<?php foreach($list_program_w1 as $program_w1) { ?>
										<td class="bg-primary-260"><?php echo $program_w1->nama_jenis; ?></td>
										<?php } ?>

										<?php if ($data_w1 > 0) { ?>
										<td class="bg-primary-260">TOTAL</td>
										<?php } ?>

										<?php foreach($list_program_w2 as $program_w2) { ?>
										<td class="bg-primary-250"><?php echo $program_w2->nama_jenis; ?></td>
										<?php } ?>

										<?php if ($data_w2 > 0) { ?>
										<td class="bg-primary-250">TOTAL</td>
										<?php } ?>

										<?php foreach($list_program_w3 as $program_w3) { ?>
										<td class="bg-primary-240"><?php echo $program_w3->nama_jenis; ?></td>
										<?php } ?>

										<?php foreach($list_program_w4 as $program_w4) { ?>
										<td class="bg-primary-230"><?php echo $program_w4->nama_jenis; ?></td>
										<?php } ?>

										<?php if ($data_w4 > 0) { ?>
										<td class="bg-primary-240">TOTAL</td>
										<?php } ?>

									</tr>
								</thead>
							</table>

							<?php } ?>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_10').removeAttr('width').DataTable({
							pageLength: 20,
							scrollY: 300,
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
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_10',
								type: 'POST',
								data: {
									'id_jenis_sales': '<?php echo $id_jenis_sales; ?>',
									'id_sales': '<?php echo $id_sales; ?>',
									'tgl': '<?php echo $tgl; ?>'
								}
							},
							deferRender: true,
							dom: 'lfrtip'

							/* footerCallback: function(row, data, start, end, display){
								var api = this.api(), data;

								var intVal = function(i){
									return typeof i === 'string' ?
										i.replace(/[\$,]/g, '') * 1 :
										typeof i === 'number' ?
										i : 0;
								};

								var no = 1;

								var value_x = ['telkomsel', 'isat', 'xl', 'tri', 'smartfren', 'axis', 'other', 'total'];
								var value_m = ['m_1', 'm_2'];
								var length_x = value_x.length;
								var length_m = value_m.length;
								var persen_x = '_persen';

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

								for (x=0; x<length_x; x++)
								{
									var total_x = value_x[x]+persen_x;

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

									$(api.column(no).footer()).html('<div align="right"><strong>' + accounting.formatMoney(total_x) + ' %</strong></div>');

									no++;
								}

								for (x=0; x<length_m; x++)
								{
									var total_x = value_m[x];

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

									$(api.column(no).footer()).html('<div align="right"><strong>' + accounting.formatMoney(total_x) + ' %</strong></div>');

									no++;
								}
							} */
						});
					});
				</script>