				<div class="row">
					<div class="col-md-6">
						<div class="card mb-3">
							<div class="card-body">
								<div id="grafik_out_perdana"></div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card mb-3">
							<div class="card-body">
								<div id="grafik_out_voucher_fisik"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="card mb-3">
							<div class="card-body">
								<div id="grafik_out_spanduk"></div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card mb-3">
							<div class="card-body">
								<div id="grafik_out_poster"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="card mb-3">
							<div class="card-body">
								<div id="grafik_out_papan_nama"></div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card mb-3">
							<div class="card-body">
								<div id="grafik_out_backdrop"></div>
							</div>
						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						reload_grafik_out_perdana(); // Perdana Share
						reload_grafik_out_voucher_fisik(); // Voucher Fisik Share
						reload_grafik_out_spanduk(); // Spanduk Share
						reload_grafik_out_poster(); // Poster Share
						reload_grafik_out_papan_nama(); // Neon Box Share
						reload_grafik_out_backdrop(); // Backdrop Share
					});

					// ==============================================================================
					// BEGIN SPANDUK SHARE
					// ==============================================================================
					var reload_grafik_out_spanduk = function(){
						var colors = Highcharts.getOptions().colors.slice(0),
						dark = -0.5;
						colors[0] = '#DD0000';
						colors[1] = '#fede00';
						colors[2] = '#28166f';
						colors[3] = '#000000';
						colors[4] = '#d91d2b';
						colors[5] = '#ed008c';
						colors[6] = '#999999';

						Highcharts.chart('grafik_out_spanduk', {
							chart: {
								type: 'column'
							},
							colors: colors,
							title: {
								text: 'LAYAR TOKO SHARE'
							},
							xAxis: {
								categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
								title: {
									text: 'Month'
								},
							},
							yAxis: {
								min: 0,
								title: {
									text: 'Value'
								},
								stackLabels: {
									enabled: true,
									style: {
										fontWeight: 'bold',
										color: (
											Highcharts.defaultOptions.title.style &&
											Highcharts.defaultOptions.title.style.color
										) || 'gray'
									}
								}
							},
							legend: {
								// align: 'right',
								// x: -30,
								verticalAlign: 'top',
								// y: 25,
								// floating: true,
								backgroundColor:
									Highcharts.defaultOptions.legend.backgroundColor || 'white',
								borderColor: '#CCC',
								borderWidth: 1,
								shadow: false
							},
							tooltip: {
								headerFormat: '<b>{point.x}</b><br/>',
								pointFormat: '{series.name}: {point.y} ({point.percentage:.0f}%)<br/>Total: {point.stackTotal}'
							},
							plotOptions: {
								column: {
									stacking: 'normal',
									dataLabels: {
										enabled: false
									}
								}
							},
							series: [{
								name: 'TELKOMSEL',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
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
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'ISAT',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
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
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'XL',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
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
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'TRI',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
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
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'SMARTFREN',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
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
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'AXIS',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
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
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'OTHER',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
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
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "SPANDUK")
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
					// END SPANDUK SHARE

					// ==============================================================================
					// BEGIN POSTER SHARE
					// ==============================================================================
					var reload_grafik_out_poster = function(){
						var colors = Highcharts.getOptions().colors.slice(0),
						dark = -0.5;
						colors[0] = '#DD0000';
						colors[1] = '#fede00';
						colors[2] = '#28166f';
						colors[3] = '#000000';
						colors[4] = '#d91d2b';
						colors[5] = '#ed008c';
						colors[6] = '#999999';

						Highcharts.chart('grafik_out_poster', {
							chart: {
								type: 'column'
							},
							colors: colors,
							title: {
								text: 'POSTER SHARE'
							},
							xAxis: {
								categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
								title: {
									text: 'Month'
								},
							},
							yAxis: {
								min: 0,
								title: {
									text: 'Value'
								},
								stackLabels: {
									enabled: true,
									style: {
										fontWeight: 'bold',
										color: (
											Highcharts.defaultOptions.title.style &&
											Highcharts.defaultOptions.title.style.color
										) || 'gray'
									}
								}
							},
							legend: {
								// align: 'right',
								// x: -30,
								verticalAlign: 'top',
								// y: 25,
								// floating: true,
								backgroundColor:
									Highcharts.defaultOptions.legend.backgroundColor || 'white',
								borderColor: '#CCC',
								borderWidth: 1,
								shadow: false
							},
							tooltip: {
								headerFormat: '<b>{point.x}</b><br/>',
								pointFormat: '{series.name}: {point.y} ({point.percentage:.0f}%)<br/>Total: {point.stackTotal}'
							},
							plotOptions: {
								column: {
									stacking: 'normal',
									dataLabels: {
										enabled: false
									}
								}
							},
							series: [{
								name: 'TELKOMSEL',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
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
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'ISAT',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
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
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'XL',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
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
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'TRI',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
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
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'SMARTFREN',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
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
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'AXIS',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
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
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'OTHER',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
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
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "POSTER")
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
					// END POSTER SHARE

					// ==============================================================================
					// BEGIN NEON BOX SHARE
					// ==============================================================================
					var reload_grafik_out_papan_nama = function(){
						var colors = Highcharts.getOptions().colors.slice(0),
						dark = -0.5;
						colors[0] = '#DD0000';
						colors[1] = '#fede00';
						colors[2] = '#28166f';
						colors[3] = '#000000';
						colors[4] = '#d91d2b';
						colors[5] = '#ed008c';
						colors[6] = '#999999';

						Highcharts.chart('grafik_out_papan_nama', {
							chart: {
								type: 'column'
							},
							colors: colors,
							title: {
								text: 'NEON BOX SHARE'
							},
							xAxis: {
								categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
								title: {
									text: 'Month'
								},
							},
							yAxis: {
								min: 0,
								title: {
									text: 'Value'
								},
								stackLabels: {
									enabled: true,
									style: {
										fontWeight: 'bold',
										color: (
											Highcharts.defaultOptions.title.style &&
											Highcharts.defaultOptions.title.style.color
										) || 'gray'
									}
								}
							},
							legend: {
								// align: 'right',
								// x: -30,
								verticalAlign: 'top',
								// y: 25,
								// floating: true,
								backgroundColor:
									Highcharts.defaultOptions.legend.backgroundColor || 'white',
								borderColor: '#CCC',
								borderWidth: 1,
								shadow: false
							},
							tooltip: {
								headerFormat: '<b>{point.x}</b><br/>',
								pointFormat: '{series.name}: {point.y}  ({point.percentage:.0f}%)<br/>Total: {point.stackTotal}'
							},
							plotOptions: {
								column: {
									stacking: 'normal',
									dataLabels: {
										enabled: false
									}
								}
							},
							series: [{
								name: 'TELKOMSEL',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
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
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'ISAT',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
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
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'XL',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
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
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'TRI',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
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
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'SMARTFREN',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
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
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'AXIS',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
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
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'OTHER',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
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
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PAPAN_NAMA")
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
					// END NEON BOX SHARE

					// ==============================================================================
					// BEGIN PERDNA SHARE
					// ==============================================================================
					var reload_grafik_out_perdana = function(){
						var colors = Highcharts.getOptions().colors.slice(0),
						dark = -0.5;
						colors[0] = '#DD0000'; // telkomsel
						colors[1] = '#fede00'; // isat
						colors[2] = '#28166f'; // xl
						colors[3] = '#000000'; // tri
						colors[4] = '#d91d2b'; // smartfren
						colors[5] = '#ed008c'; // axis
						colors[6] = '#999999'; // other

						Highcharts.chart('grafik_out_perdana', {
							chart: {
								type: 'column'
							},
							colors: colors,
							title: {
								text: 'PERDANA SHARE'
							},
							xAxis: {
								categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
								title: {
									text: 'Month'
								},
							},
							yAxis: {
								min: 0,
								title: {
									text: 'Value'
								},
								stackLabels: {
									enabled: true,
									style: {
										fontWeight: 'bold',
										color: (
											Highcharts.defaultOptions.title.style &&
											Highcharts.defaultOptions.title.style.color
										) || 'gray'
									}
								}
							},
							legend: {
								// align: 'right',
								// x: -30,
								verticalAlign: 'top',
								// y: 25,
								// floating: true,
								backgroundColor:
									Highcharts.defaultOptions.legend.backgroundColor || 'white',
								borderColor: '#CCC',
								borderWidth: 1,
								shadow: false
							},
							tooltip: {
								headerFormat: '<b>{point.x}</b><br/>',
								pointFormat: '{series.name}: {point.y} ({point.percentage:.0f}%)<br/>Total: {point.stackTotal}'
							},
							plotOptions: {
								column: {
									stacking: 'normal',
									dataLabels: {
										enabled: false
												}
										}
										},
							series: [{

        dataLabels: [{
            format: ''
        }, {
            //align: 'center',
            format: '{y} points',
            inside: true
        }],

								name: 'TELKOMSEL',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
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
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'ISAT',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
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
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'XL',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
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
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'TRI',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
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
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'SMARTFREN',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
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
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'AXIS',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
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
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'OTHER',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
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
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "PERDANA")
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
					// END PERDANA SHARE

					// ==============================================================================
					// BEGIN VOUCHER FISIK SHARE
					// ==============================================================================
					var reload_grafik_out_voucher_fisik = function(){
						var colors = Highcharts.getOptions().colors.slice(0),
						dark = -0.5;
						colors[0] = '#DD0000'; // telkomsel
						colors[1] = '#fede00'; // isat
						colors[2] = '#28166f'; // xl
						colors[3] = '#000000'; // tri
						colors[4] = '#d91d2b'; // smartfren
						colors[5] = '#ed008c'; // axis
						colors[6] = '#999999'; // other

						Highcharts.chart('grafik_out_voucher_fisik', {
							chart: {
								type: 'column'
							},
							colors: colors,
							title: {
								text: 'VOUCHER FISIK SHARE'
							},
							xAxis: {
								categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
								title: {
									text: 'Month'
								},
							},
							yAxis: {
								min: 0,
								title: {
									text: 'Value'
								},
								stackLabels: {
									enabled: true,
									style: {
										fontWeight: 'bold',
										color: (
											Highcharts.defaultOptions.title.style &&
											Highcharts.defaultOptions.title.style.color
										) || 'gray'
									}
								}
							},
							legend: {
								// align: 'right',
								// x: -30,
								verticalAlign: 'top',
								// y: 25,
								// floating: true,
								backgroundColor:
									Highcharts.defaultOptions.legend.backgroundColor || 'white',
								borderColor: '#CCC',
								borderWidth: 1,
								shadow: false
							},
							tooltip: {
								headerFormat: '<b>{point.x}</b><br/>',
								pointFormat: '{series.name}: {point.y} ({point.percentage:.0f}%)<br/>Total: {point.stackTotal}'
							},
							plotOptions: {
								column: {
									stacking: 'normal',
									dataLabels: {
										enabled: false
									}
								}
							},
							series: [{
								name: 'TELKOMSEL',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
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
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'ISAT',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
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
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'XL',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
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
																	COALESCE(SUM(m.xl), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'TRI',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
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
																	COALESCE(SUM(m.tri), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'SMARTFREN',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
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
																	COALESCE(SUM(m.smartfren), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'AXIS',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
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
																	COALESCE(SUM(m.axis), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'OTHER',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
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
																	COALESCE(SUM(m.other), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "VOUCHER_FISIK")
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
					// END  VOUCHER FISIK SHARE

					// ==============================================================================
					// BEGIN BACKDROP SHARE
					// ==============================================================================
					var reload_grafik_out_backdrop = function(){
						var colors = Highcharts.getOptions().colors.slice(0),
						dark = -0.5;
						colors[0] = '#DD0000'; // telkomsel
						colors[1] = '#CCCCCC'; // isat
						Highcharts.chart('grafik_out_backdrop', {
							chart: {
								type: 'column'
							},
							colors: colors,
							title: {
								text: 'STIKER OMNI CHANNEL SHARE'
							},
							xAxis: {
								categories: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
								title: {
									text: 'Month'
								},
							},
							yAxis: {
								min: 0,
								title: {
									text: 'Value'
								},
								stackLabels: {
									enabled: true,
									style: {
										fontWeight: 'bold',
										color: (
											Highcharts.defaultOptions.title.style &&
											Highcharts.defaultOptions.title.style.color
										) || 'gray'
									}
								}
							},
							legend: {
								// align: 'right',
								// x: -30,
								verticalAlign: 'top',
								// y: 25,
								// floating: true,
								backgroundColor:
									Highcharts.defaultOptions.legend.backgroundColor || 'white',
								borderColor: '#CCC',
								borderWidth: 1,
								shadow: false
							},
							tooltip: {
								headerFormat: '<b>{point.x}</b><br/>',
								pointFormat: '{series.name}: {point.y} ({point.percentage:.0f}%)<br/>Total: {point.stackTotal}'
							},
							plotOptions: {
								column: {
									stacking: 'normal',
									dataLabels: {
										enabled: false
									}
								}
							},
							series: [{
								name: 'ADA STICKER',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "BACKDROP")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "BACKDROP")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "BACKDROP")
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
																	COALESCE(SUM(m.telkomsel), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "BACKDROP")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}, {
								name: 'TIDAK ADA STICKER',
								data: [
									<?php
										for($i=1; $i<=12; $i++)
										{
											$jumlah = 0;

											if($kategori == 'Branch')
											{
												if($pilihan == '-')
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mf_merchandising_res_regional m
															WHERE (m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "BACKDROP")
												 ');
												}
												else
												{
													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mg_merchandising_res_branch m
															WHERE (m.id_branch = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "BACKDROP")
												 ');
												}

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}
											else if($kategori == 'Cluster')
											{
												$query = $this->db->query('
															SELECT
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mh_merchandising_res_cluster m
															WHERE (m.id_cluster = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "BACKDROP")
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
																	COALESCE(SUM(m.isat), 0) AS jumlah
															FROM
																	mi_merchandising_res_tap m
															WHERE (m.id_tap = "'.$pilihan.'"
																	AND m.tahun = "'.$tahun.'"
																	AND m.bulan = "'.$i.'"
																	AND UPPER(m.id_jenis_lokasi) = "OUT"
																	AND UPPER(m.id_jenis_share) = "BACKDROP")
												 ');

												foreach ($query->result_array() as $row)
												{
													$jumlah = $row['jumlah'];
												}
											}

											echo $jumlah.",";
										}
									?>
								]}  
							]
						});
					}
					// END BACKDROP SHARE
				</script>