				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							Acrylic/Stiker Scan QR OMNI Channel
						</div>
					</div>
					<div class="card-body">

						<div id="container_omni"></div>

					</div>
				</div>

				<script>
					$(document).ready(function(){

						Highcharts.chart('container_omni', {
							chart: {
								type: 'pie',
								options3d: {
									enabled: true,
									alpha: 45,
									beta: 0
								}
							},
							title: {
								text: 'Acrylic/Stiker Scan QR OMNI Channel '
							},
							subtitle: {
									text: ' '
							},
							tooltip: {
								pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
							},
							plotOptions: {
								pie: {
									allowPointSelect: true,
									cursor: 'pointer',
									depth: 35,
									dataLabels: {
										enabled: true,
										format: '{point.name}'
									}
								}
							},
							series: [{
								type: 'pie',
								name: 'Persentase',
								data : [

									<?php
										$no = 7;
										$x_total = $data['x_total'] ? $data['x_total'] : 1;

										foreach($list as $row)
										{
											$nama = $row->nama;
											$total = $row->total;
											$persen = number_format((($total / $x_total) * 100), 2, '.', ',');

											echo '{name : "'.$nama.'<br>'.$total.' ('.$persen.' %)", color: Highcharts.getOptions().colors['.$no.'], y : '.$persen.', sliced: true, selected: false},';

									?>

									<?php
											$no++;

										}
									?>

								]
							}]
						});

					});
				</script>