				<div class="row">
					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<div id="grafik_poi_1" style="height:200px;"></div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<div id="grafik_poi_2" style="height:200px;"></div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<div id="grafik_poi_3" style="height:200px;"></div>
							</div>
						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						reload_grafik_poi_1();
						reload_grafik_poi_2();
						reload_grafik_poi_3();
					});

					var reload_grafik_poi_1 = function(){
						Highcharts.chart('grafik_poi_1', {
							chart: {
								type: 'column'
							},
							title: {
								text: '<span style="font-size:11px;">GRAFIK POI OPEN, CLOSE, NEW</span>'
							},
							xAxis: {
								categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
								labels: {
									style: {
										fontSize:'8px'
									}
								},
								crosshair: true
							},
							yAxis: {
								min: 0,
								title: {
									text: ' '
								},
								labels: {
									style: {
										fontSize:'8px'
									}
								}
							},
							tooltip: {
								headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
								pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
														 '<td style="padding:0"><b>{point.y}</b></td></tr>',
								footerFormat: '</table>',
								shared: true,
								useHTML: true
							},
							plotOptions: {
								column: {
									pointPadding: 0.2,
									borderWidth: 0
								}
							},
							colors: ['#00ff00', '#ff0000', '#0000ff'],
							series: [{
								name: '<span style="font-size:10px;">Open</span>',
								data: [
									<?php
										$tahun_sekarang = date('Y');
										$bulan_sekarang = (int) date('m');

										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												$where = '';

												if($pilihan !== '-')
												{
													$where = 'AND d.id_branch = "'.$pilihan.'"';
												}

												if ($tahun == $tahun_sekarang && $i > $bulan_sekarang)
												{
													$query = $this->db->query('
															SELECT 0 AS jumlah
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(d.poi_open), 0) AS jumlah
															FROM
																	ae_dashboard_coverage_branch d
															WHERE d.tahun <= "'.$tahun.'"
																	AND d.bulan <= "'.$i.'"
																	'.$where.'
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												if ($tahun == $tahun_sekarang && $i > $bulan_sekarang)
												{
													$query = $this->db->query('
															SELECT 0 AS jumlah
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(d.poi_open), 0) AS jumlah
															FROM
																	af_dashboard_coverage_cluster d
															WHERE (d.tahun <= "'.$tahun.'"
																	AND d.bulan <= "'.$i.'"
																	AND d.id_cluster = "'.$pilihan.'")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'TAP')
											{
												if ($tahun == $tahun_sekarang && $i > $bulan_sekarang)
												{
													$query = $this->db->query('
															SELECT 0 AS jumlah
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(d.poi_open), 0) AS jumlah
															FROM
																	ag_dashboard_coverage_tap d
															WHERE (d.tahun <= "'.$tahun.'"
																	AND d.bulan <= "'.$i.'"
																	AND d.id_tap = "'.$pilihan.'")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]
							}, {
								name: '<span style="font-size:10px;">Close</span>',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												$where = '';

												if($pilihan !== '-')
												{
													$where = 'AND d.id_branch = "'.$pilihan.'"';
												}

												if ($tahun == $tahun_sekarang && $i > $bulan_sekarang)
												{
													$query = $this->db->query('
															SELECT 0 AS jumlah
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(d.poi_close), 0) AS jumlah
															FROM
																	ae_dashboard_coverage_branch d
															WHERE d.tahun <= "'.$tahun.'"
																	AND d.bulan <= "'.$i.'"
																	'.$where.'
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												if ($tahun == $tahun_sekarang && $i > $bulan_sekarang)
												{
													$query = $this->db->query('
															SELECT 0 AS jumlah
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(d.poi_close), 0) AS jumlah
															FROM
																	af_dashboard_coverage_cluster d
															WHERE (d.tahun <= "'.$tahun.'"
																	AND d.bulan <= "'.$i.'"
																	AND d.id_cluster = "'.$pilihan.'")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'TAP')
											{
												if ($tahun == $tahun_sekarang && $i > $bulan_sekarang)
												{
													$query = $this->db->query('
															SELECT 0 AS jumlah
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(d.poi_close), 0) AS jumlah
															FROM
																	ag_dashboard_coverage_tap d
															WHERE (d.tahun <= "'.$tahun.'"
																	AND d.bulan <= "'.$i.'"
																	AND d.id_tap = "'.$pilihan.'")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]
							}, {
								name: '<span style="font-size:10px;">New</span>',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												$where = '';

												if($pilihan !== '-')
												{
													$where = 'AND d.id_branch = "'.$pilihan.'"';
												}

												if ($tahun == $tahun_sekarang && $i > $bulan_sekarang)
												{
													$query = $this->db->query('
															SELECT 0 AS jumlah
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(d.poi_new), 0) AS jumlah
															FROM
																	ae_dashboard_coverage_branch d
															WHERE d.tahun <= "'.$tahun.'"
																	AND d.bulan <= "'.$i.'"
																	'.$where.'
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												if ($tahun == $tahun_sekarang && $i > $bulan_sekarang)
												{
													$query = $this->db->query('
															SELECT 0 AS jumlah
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(d.poi_new), 0) AS jumlah
															FROM
																	af_dashboard_coverage_cluster d
															WHERE (d.tahun <= "'.$tahun.'"
																	AND d.bulan <= "'.$i.'"
																	AND d.id_cluster = "'.$pilihan.'")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'TAP')
											{
												if ($tahun == $tahun_sekarang && $i > $bulan_sekarang)
												{
													$query = $this->db->query('
															SELECT 0 AS jumlah
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(d.poi_new), 0) AS jumlah
															FROM
																	ag_dashboard_coverage_tap d
															WHERE (d.tahun <= "'.$tahun.'"
																	AND d.bulan <= "'.$i.'"
																	AND d.id_tap = "'.$pilihan.'")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]
							}]
						});
					}

					var reload_grafik_poi_2 = function(){
						Highcharts.chart('grafik_poi_2', {
							chart: {
								type: 'column'
							},
							title: {
								text: '<span style="font-size:11px;">GRAFIK PJP VS CLOCK IN</span>'
							},
							xAxis: {
								categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
								labels: {
									style: {
										fontSize:'8px'
									}
								},
								crosshair: true
							},
							yAxis: {
								min: 0,
								title: {
									text: ' '
								},
								labels: {
									style: {
										fontSize:'8px'
									}
								}
							},
							tooltip: {
								headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
								pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
														 '<td style="padding:0"><b>{point.y}</b></td></tr>',
								footerFormat: '</table>',
								shared: true,
								useHTML: true
							},
							plotOptions: {
								column: {
									pointPadding: 0.2,
									borderWidth: 0
								}
							},
							colors: ['#ffbf00', '#0000ff'],
							series: [{
								name: '<span style="font-size:10px;">PJP</span>',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												$where = '';

												if($pilihan !== '-')
												{
													$where = 'AND d.id_branch = "'.$pilihan.'"';
												}

												$query = $this->db->query('
														SELECT
																COALESCE(SUM(d.poi_pjp), 0) AS jumlah
														FROM
																ae_dashboard_coverage_branch d
														WHERE d.tahun = "'.$tahun.'"
																AND d.bulan = "'.$i.'"
																'.$where.'
											 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
														SELECT
																COALESCE(SUM(d.poi_pjp), 0) AS jumlah
														FROM
																af_dashboard_coverage_cluster d
														WHERE (d.tahun = "'.$tahun.'"
																AND d.bulan = "'.$i.'"
																AND d.id_cluster = "'.$pilihan.'")
											 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'TAP')
											{
												$query = $this->db->query('
														SELECT
																COALESCE(SUM(d.poi_pjp), 0) AS jumlah
														FROM
																ag_dashboard_coverage_tap d
														WHERE (d.tahun = "'.$tahun.'"
																AND d.bulan = "'.$i.'"
																AND d.id_tap = "'.$pilihan.'")
											 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]
							}, {
								name: '<span style="font-size:10px;">Clock In</span>',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												$where = '';

												if($pilihan !== '-')
												{
													$where = 'AND d.id_branch = "'.$pilihan.'"';
												}

												$query = $this->db->query('
														SELECT
																COALESCE(SUM(d.poi_clockin), 0) AS jumlah
														FROM
																ae_dashboard_coverage_branch d
														WHERE d.tahun = "'.$tahun.'"
																AND d.bulan = "'.$i.'"
																'.$where.'
											 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
														SELECT
																COALESCE(SUM(d.poi_clockin), 0) AS jumlah
														FROM
																af_dashboard_coverage_cluster d
														WHERE (d.tahun = "'.$tahun.'"
																AND d.bulan = "'.$i.'"
																AND d.id_cluster = "'.$pilihan.'")
											 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'TAP')
											{
												$query = $this->db->query('
														SELECT
																COALESCE(SUM(d.poi_clockin), 0) AS jumlah
														FROM
																ag_dashboard_coverage_tap d
														WHERE (d.tahun = "'.$tahun.'"
																AND d.bulan = "'.$i.'"
																AND d.id_tap = "'.$pilihan.'")
											 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]
							}]
						});
					}

					var reload_grafik_poi_3 = function(){
						Highcharts.chart('grafik_poi_3', {
							chart: {
								type: 'column'
							},
							title: {
								text: '<span style="font-size:11px;">COVERAGE LEVEL</span>'
							},
							xAxis: {
								categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
								labels: {
									style: {
										fontSize:'8px'
									}
								},
								crosshair: true
							},
							yAxis: {
								min: 0,
								title: {
									text: '%'
								},
								labels: {
									style: {
										fontSize:'8px'
									}
								}
							},
							tooltip: {
								headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
								pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
														 '<td style="padding:0"><b>{point.y}</b></td></tr>',
								footerFormat: '</table>',
								shared: true,
								useHTML: true
							},
							plotOptions: {
								column: {
									pointPadding: 0.2,
									borderWidth: 0
								}
							},
							colors: ['#0000ff'],
							series: [{
								name: 'Coverage Level',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												$where = '';

												if($pilihan !== '-')
												{
													$where = 'AND d.id_branch = "'.$pilihan.'"';
												}

												$query = $this->db->query('
														SELECT
																COALESCE(SUM(d.poi_coverage), 0) AS jumlah
														FROM
																ae_dashboard_coverage_branch d
														WHERE d.tahun = "'.$tahun.'"
																AND d.bulan = "'.$i.'"
																'.$where.'
											 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
														SELECT
																COALESCE(SUM(d.poi_coverage), 0) AS jumlah
														FROM
																af_dashboard_coverage_cluster d
														WHERE (d.tahun = "'.$tahun.'"
																AND d.bulan = "'.$i.'"
																AND d.id_cluster = "'.$pilihan.'")
											 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'TAP')
											{
												$query = $this->db->query('
														SELECT
																COALESCE(SUM(d.poi_coverage), 0) AS jumlah
														FROM
																ag_dashboard_coverage_tap d
														WHERE (d.tahun = "'.$tahun.'"
																AND d.bulan = "'.$i.'"
																AND d.id_tap = "'.$pilihan.'")
											 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]
							}]
						});
					}
				</script>