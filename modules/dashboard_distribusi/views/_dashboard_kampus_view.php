				<div class="row">
					<div class="col-md-3">
						<div class="card">
							<div class="card-body">
								<div id="grafik_kampus_1" style="height:200px;"></div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card">
							<div class="card-body">
								<div id="grafik_kampus_2" style="height:200px;"></div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card">
							<div class="card-body">
								<div id="grafik_kampus_3" style="height:200px;"></div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card">
							<div class="card-body">
								<div id="grafik_kampus_4" style="height:200px;"></div>
							</div>
						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						reload_grafik_kampus_1();
						reload_grafik_kampus_2();
						reload_grafik_kampus_3();
						reload_grafik_kampus_4();
					});

					var reload_grafik_kampus_1 = function(){
						Highcharts.chart('grafik_kampus_1', {
							chart: {
								type: 'column'
							},
							title: {
								text: '<span style="font-size:11px;">GRAFIK PENJUALAN PRODUK</span>'
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
								name: '<span style="font-size:10px;">Segel</span>',
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
																COALESCE(SUM(d.kampus_segel_total), 0) AS jumlah
														FROM
																aj_dashboard_distribusi_branch d
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
																COALESCE(SUM(d.kampus_segel_total), 0) AS jumlah
														FROM
																ak_dashboard_distribusi_cluster d
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
																COALESCE(SUM(d.kampus_segel_total), 0) AS jumlah
														FROM
																al_dashboard_distribusi_tap d
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
								name: '<span style="font-size:10px;">SA</span>',
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
																COALESCE(SUM(d.kampus_sa_total), 0) AS jumlah
														FROM
																aj_dashboard_distribusi_branch d
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
																COALESCE(SUM(d.kampus_sa_total), 0) AS jumlah
														FROM
																ak_dashboard_distribusi_cluster d
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
																COALESCE(SUM(d.kampus_sa_total), 0) AS jumlah
														FROM
																al_dashboard_distribusi_tap d
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
								name: '<span style="font-size:10px;">Voucher Fisik</span>',
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
																COALESCE(SUM(d.kampus_vf_total), 0) AS jumlah
														FROM
																aj_dashboard_distribusi_branch d
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
																COALESCE(SUM(d.kampus_vf_total), 0) AS jumlah
														FROM
																ak_dashboard_distribusi_cluster d
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
																COALESCE(SUM(d.kampus_vf_total), 0) AS jumlah
														FROM
																al_dashboard_distribusi_tap d
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

					var reload_grafik_kampus_2 = function(){
						Highcharts.chart('grafik_kampus_2', {
							chart: {
								type: 'column'
							},
							title: {
								text: '<span style="font-size:11px;">GRAFIK PENJUALAN PRODUK SEGEL</span>'
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
								name: '<span style="font-size:10px;">Prepaid</span>',
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
																COALESCE(SUM(d.kampus_segel_prepaid), 0) AS jumlah
														FROM
																aj_dashboard_distribusi_branch d
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
																COALESCE(SUM(d.kampus_segel_prepaid), 0) AS jumlah
														FROM
																ak_dashboard_distribusi_cluster d
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
																COALESCE(SUM(d.kampus_segel_prepaid), 0) AS jumlah
														FROM
																al_dashboard_distribusi_tap d
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
								name: '<span style="font-size:10px;">Voucher Fisik</span>',
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
																COALESCE(SUM(d.kampus_segel_voucher), 0) AS jumlah
														FROM
																aj_dashboard_distribusi_branch d
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
																COALESCE(SUM(d.kampus_segel_voucher), 0) AS jumlah
														FROM
																ak_dashboard_distribusi_cluster d
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
																COALESCE(SUM(d.kampus_segel_voucher), 0) AS jumlah
														FROM
																al_dashboard_distribusi_tap d
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

					var reload_grafik_kampus_3 = function(){
						Highcharts.chart('grafik_kampus_3', {
							chart: {
								type: 'column'
							},
							title: {
								text: '<span style="font-size:11px;">GRAFIK PENJUALAN PRODUK SA</span>'
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
							colors: ['#0000b3', '#e6e600', '#ff0000'],
							series: [{
								name: '<span style="font-size:10px;">LD</span>',
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
																COALESCE(SUM(d.kampus_sa_ld), 0) AS jumlah
														FROM
																aj_dashboard_distribusi_branch d
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
																COALESCE(SUM(d.kampus_sa_ld), 0) AS jumlah
														FROM
																ak_dashboard_distribusi_cluster d
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
																COALESCE(SUM(d.kampus_sa_ld), 0) AS jumlah
														FROM
																al_dashboard_distribusi_tap d
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
								name: '<span style="font-size:10px;">MD</span>',
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
																COALESCE(SUM(d.kampus_sa_md), 0) AS jumlah
														FROM
																aj_dashboard_distribusi_branch d
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
																COALESCE(SUM(d.kampus_sa_md), 0) AS jumlah
														FROM
																ak_dashboard_distribusi_cluster d
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
																COALESCE(SUM(d.kampus_sa_md), 0) AS jumlah
														FROM
																al_dashboard_distribusi_tap d
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
								name: '<span style="font-size:10px;">HD</span>',
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
																COALESCE(SUM(d.kampus_sa_hd), 0) AS jumlah
														FROM
																aj_dashboard_distribusi_branch d
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
																COALESCE(SUM(d.kampus_sa_hd), 0) AS jumlah
														FROM
																ak_dashboard_distribusi_cluster d
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
																COALESCE(SUM(d.kampus_sa_hd), 0) AS jumlah
														FROM
																al_dashboard_distribusi_tap d
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

					var reload_grafik_kampus_4 = function(){
						Highcharts.chart('grafik_kampus_4', {
							chart: {
								type: 'column'
							},
							title: {
								text: '<span style="font-size:11px;">GRAFIK PENJUALAN PRODUK VOUCHER FISIK</span>'
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
							colors: ['#ff6600', '#00cc44', '#e600e6'],
							series: [{
								name: '<span style="font-size:10px;">LD</span>',
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
																COALESCE(SUM(d.kampus_vf_ld), 0) AS jumlah
														FROM
																aj_dashboard_distribusi_branch d
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
																COALESCE(SUM(d.kampus_vf_ld), 0) AS jumlah
														FROM
																ak_dashboard_distribusi_cluster d
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
																COALESCE(SUM(d.kampus_vf_ld), 0) AS jumlah
														FROM
																al_dashboard_distribusi_tap d
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
								name: '<span style="font-size:10px;">MD</span>',
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
																COALESCE(SUM(d.kampus_vf_md), 0) AS jumlah
														FROM
																aj_dashboard_distribusi_branch d
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
																COALESCE(SUM(d.kampus_vf_md), 0) AS jumlah
														FROM
																ak_dashboard_distribusi_cluster d
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
																COALESCE(SUM(d.kampus_vf_md), 0) AS jumlah
														FROM
																al_dashboard_distribusi_tap d
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
								name: '<span style="font-size:10px;">HD</span>',
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
																COALESCE(SUM(d.kampus_vf_hd), 0) AS jumlah
														FROM
																aj_dashboard_distribusi_branch d
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
																COALESCE(SUM(d.kampus_vf_hd), 0) AS jumlah
														FROM
																ak_dashboard_distribusi_cluster d
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
																COALESCE(SUM(d.kampus_vf_hd), 0) AS jumlah
														FROM
																al_dashboard_distribusi_tap d
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