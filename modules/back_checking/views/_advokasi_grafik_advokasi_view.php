				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							Grafik Advokasi
						</div>
					</div>
					<div class="card-body">

						<div id="container_advokasi"></div>

					</div>
				</div>

				<script>
					$(document).ready(function(){

						Highcharts.chart('container_advokasi', {
							colors: ['#25DF69', '#F13645'],
							chart: {
								type: 'column'
							},
							title: {
								text: 'Grafik Advokasi'
							},
							subtitle: {
								text: 'Apakah sudah mengerti Program ?'
							},
							xAxis: {
								categories: [
									<?php
										$total_ya = '';
										$total_tidak = '';

										foreach($list as $row)
										{
											$nama = $row->nama;
											$total_ya .= $row->total_ya.',';
											$total_tidak .= $row->total_tidak.',';

											echo "'".$nama."',";

										}
									?>
								],
								crosshair: true
							},
							yAxis: {
								min: 0,
								title: {
									text: ' '
								}
							},
							tooltip: {
								headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
								pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
										'<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
								footerFormat: '</table>',
								shared: true,
								useHTML: true
							},
							legend: {
								align: 'right',
								verticalAlign: 'middle',
								layout: 'vertical',
								itemMarginBottom: 10,
								itemStyle: {
									fontWeight: 'normal'
								}
							},
							plotOptions: {
								column: {
									pointPadding: 0.2,
									borderWidth: 0
								},
								series: {
									borderWidth: 0,
									dataLabels: {
										enabled: true
									}
								}
							},
							series: [
								{
									name: 'Ya',
									data: [<?php echo $total_ya; ?>]
								},
								{
									name: 'Tidak',
									data: [<?php echo $total_tidak; ?>]
								}
							]
						});

					});
				</script>