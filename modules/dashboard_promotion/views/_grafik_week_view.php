				<div class="row">
					<?php $no=0; ?>
					<?php $array_id = array(); ?>
					<?php $array_name = array(); ?>
					<?php foreach($list_program as $program) { ?>


					<div class="col-md-6">
						<div class="card mb-3">
							<div class="card-body">
								<div id="grafik2_<?php echo $no; ?>" style="height:200px;"></div>
							</div>
						</div>
					</div>

					<?php array_push($array_id, $program->id_program); ?>
					<?php array_push($array_name, $program->nama_program); ?>
					<?php $no++; ?>
					<?php } ?>
				</div>

				<script>
					$(document).ready(function(){
						<?php for ($x=0; $x <= count($array_name)-1; $x++) { ?>
							Highcharts.chart('grafik2_<?php echo $x; ?>', {
								chart: {
									type: 'column'
								},
								title: {
									text: '<span style="font-size:11px;">GRAFIK <?php echo ($array_name[$x]); ?></span>'
								},
								xAxis: {
									categories: ['W1', 'W2', 'W3', 'W4', 'W5'],
									labels: {
										style: {
											fontSize:'8px'
										}
									},
									crosshair: true
								},
								yAxis: {
									
									stackLabels: {
             									enabled: true,
            									verticalAlign: 'bottom',
										crop:false,
										overflow:'none',
										y: -2
        									}

									},

								tooltip: {
									headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
									pointFormat: '<tr><td style="color:{series.color};">{series.name}: </td>' +
															 '<td style="padding:0"><b>{point.y}</b></td></tr>',
									footerFormat: '</table>',
									shared: true,
									useHTML: true
								},
								plotOptions: {
									column: {
										pointPadding: 0.2,
										borderWidth: 0,
										colorByPoint: true
									}
								},
								colors: [
									'#ff0000', '#434348', '#90ed7d', '#f7a35c', '#8085e9',
									'#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1',
									'#00ff00', '#7cb5ec'
								],
								series: [{
									name: '<?php echo ($array_name[$x]); ?>',
									data: [
										<?php
											for($i=1; $i<=5; $i++)
											{
												$jumlah = 0;

												if($kategori == 'Branch')
												{
													$where = '';

													if($pilihan !== '-')
													{
														$where = 'AND p.id_branch = "'.$pilihan.'"';
													}

													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(p.total), 0) AS jumlah
															FROM
																	nh_promotion_res_branch p
																	INNER JOIN nb_promotion_jenis_weekly j
																			ON (p.id_jenis_weekly = j.id_jenis_weekly)
															WHERE j.id_jenis = "'.$array_id[$x].'"
																	AND j.tahun = "'.$tahun.'"
																	AND j.bulan = "'.$bulan.'"
																	AND j.minggu = "'.$i.'"
																	'.$where.'
												 ');

													foreach ($query->result_array() as $row)
													{
														$jumlah = $row['jumlah'];
													}
												}
												else if($kategori == 'Cluster')
												{
													$where = '';

													if($pilihan !== '-')
													{
														$where = '';
													}

													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(p.total), 0) AS jumlah
															FROM
																	ni_promotion_res_cluster p
																	INNER JOIN nb_promotion_jenis_weekly j
																			ON (p.id_jenis_weekly = j.id_jenis_weekly)
															WHERE (j.id_jenis = "'.$array_id[$x].'"
																	AND j.tahun = "'.$tahun.'"
																	AND j.bulan = "'.$bulan.'"
																	AND j.minggu = "'.$i.'"
																	AND p.id_cluster = "'.$pilihan.'")
												 ');

													foreach ($query->result_array() as $row)
													{
														$jumlah = $row['jumlah'];
													}
												}
												else if($kategori == 'TAP')
												{
													$where = '';

													if($pilihan !== '-')
													{
														$where = '';
													}

													$query = $this->db->query('
															SELECT
																	COALESCE(SUM(p.total), 0) AS jumlah
															FROM
																	nj_promotion_res_tap p
																	INNER JOIN nb_promotion_jenis_weekly j
																			ON (p.id_jenis_weekly = j.id_jenis_weekly)
															WHERE (j.id_jenis = "'.$array_id[$x].'"
																	AND j.tahun = "'.$tahun.'"
																	AND j.bulan = "'.$bulan.'"
																	AND j.minggu = "'.$i.'"
																	AND p.id_tap = "'.$pilihan.'")
												 ');

													foreach ($query->result_array() as $row)
													{
														$jumlah = $row['jumlah'];
													}
												}
												else
												{
													$jumlah = 0;
												}

												echo $jumlah.",";
											}
										?>
									]
								}]
							});

						<?php } ?>
					});
				</script>