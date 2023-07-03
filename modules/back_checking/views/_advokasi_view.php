				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							ADVOKASI
						</div>
					</div>
					<div class="card-body">

						 <div id="container_advokasi"></div>

					</div>
				</div>

				<script>
					$(document).ready(function(){
						reload_grafik_availability();
					});

					var reload_grafik_availability = function(){
						Highcharts.chart('container_advokasi', {
							chart: {
								type: 'column'
							},
							title: {
								text: 'Advokasi'
							},
							subtitle: {
								text: ' '
							},
							xAxis: {
								categories: [
									'Grafik Advokasi'
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
								name: 'Ijo - Ijo',
								data: [128]
							}, {
								name: 'Combo Sakti',
								data: [84]
							}, {
								name: 'Aktivasi Paket via Scan QR',
								data: [37]
							}, {
								name: 'Bundling NEW IMEI',
								data: [65]
							}, {
								name: 'Flash Sale',
								data: [34]
							}, {
								name: 'Scan Sell Out Barcode',
								data: [14]
							}]
						});
					}
				</script>