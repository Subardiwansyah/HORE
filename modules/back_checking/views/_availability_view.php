				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							AVAILABILITY
						</div>
					</div>
					<div class="card-body">

						 <div id="container_availability"></div>

					</div>
				</div>

				<script>
					$(document).ready(function(){
						reload_grafik_availability();
					});

					var reload_grafik_availability = function(){
						Highcharts.chart('container_availability', {
							chart: {
								type: 'column'
							},
							title: {
								text: 'Availability'
							},
							subtitle: {
								text: ' '
							},
							xAxis: {
								categories: [
									'Grafik Availability'
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
								useHTML: true,
								enabled: false
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
							series: [{
								name: 'Variant Perdana Telkomsel Share',
								data: [49]
							}, {
								name: 'Perdana All Operator Share',
								data: [83]
							}, {
								name: 'Variant VF Telkomsel Share',
								data: [45]
							}, {
								name: 'VF All Operator Share',
								data: [76]
							}, {
								name: 'User Digipos Apps',
								data: [92]
							}, {
								name: 'Memiliki Saldo LA Digipos',
								data: [81]
							}]
						});
					}
				</script>