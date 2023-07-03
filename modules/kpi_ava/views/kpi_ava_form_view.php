					<div class="card mb-3">
						<div class="card-body">

							<div class="row">
								<div class="col-md-7">

									<h6>&nbsp;</h6>

									<table class="table table-bordered m-0 table-sm">
										<tbody>

											<!-- AVAILABILITY -->

											<tr>
												<td class="text-center" style="background-color:#393939;color:#ffffff"><strong>AVAILABILITY (35%)</strong></td>
												<td class="text-center" style="width:80px;background-color:#F7A06C"><strong>Bobot</strong></td>
												<td class="text-center" style="width:80px;background-color:#7E79DB"><strong>Share</strong></td>
												<td class="text-center" style="width:80px;background-color:#F7A06C"><strong>Score</strong></td>
												<td class="text-center" style="width:80px;background-color:#38CE6A"><strong>Final Score</strong></td>
											</tr>

											<?php $total_availability = 0; ?>

											<?php foreach($list_availability as $availability) { ?>

											<?php
												$id = $availability->id;
												$keterangan = $availability->keterangan;
												$bobot = $availability->bobot;
												$nilai = $availability->nilai_share;
												$id_share = $availability->id_share;
												$skor = 0;
												$final_skor = 0;

												if ($id == 1)
												{
													if($availability->nilai_share == 0){ $nilai = 0;}
													if($availability->nilai_share == 1){ $nilai = 25;}
													if($availability->nilai_share == 2){ $nilai = 50;}
													if($availability->nilai_share == 3){ $nilai = 75;}
													if($availability->nilai_share == 4){ $nilai = 100;}
													if ((int) $nilai == 0) { if($id_share > 0 ){ $skor = 1; }else{ $skor = 0;} }
													if ((int) $nilai == 25) { $skor = 2; }
													if ((int) $nilai == 50) { $skor = 3; }
													if ((int) $nilai == 75) { $skor = 4; }
													if ((int) $nilai == 100) { $skor = 5; }
												}

												if ($id == 2)
												{
													if ((int) $nilai == 0) { if($id_share > 0 ){ $skor = 1; }else{ $skor = 0;} }
													if ((int) $nilai >= 10 && (int) $nilai <= 19) { $skor = 2; }
													if ((int) $nilai >= 20 && (int) $nilai <= 29) { $skor = 3; }
													if ((int) $nilai >= 30 && (int) $nilai <= 39) { $skor = 4; }
													if ((int) $nilai >= 40) { $skor = 5; }
												}

												if ($id == 3)
												{
													if($availability->nilai_share == 0){ $nilai = 0;}
													if($availability->nilai_share == 1){ $nilai = 25;}
													if($availability->nilai_share == 2){ $nilai = 50;}
													if($availability->nilai_share == 3){ $nilai = 75;}
													if($availability->nilai_share == 4){ $nilai = 100;}
													if ((int) $nilai == 0) { if($id_share > 0 ){ $skor = 1; }else{ $skor = 0;} }
													if ((int) $nilai == 25) { $skor = 2; }
													if ((int) $nilai == 50) { $skor = 3; }
													if ((int) $nilai == 75) { $skor = 4; }
													if ((int) $nilai == 100) { $skor = 5; }
												}

												if ($id == 4)
												{
													if ((int) $nilai >= 0 && (int) $nilai <= 9) { if($id_share > 0 ){ $skor = 1; }else{ $skor = 0;} }
													if ((int) $nilai >= 10 && (int) $nilai <= 19) { $skor = 2; }
													if ((int) $nilai >= 20 && (int) $nilai <= 29) { $skor = 3; }
													if ((int) $nilai >= 30 && (int) $nilai <= 39) { $skor = 4; }
													if ((int) $nilai >= 40) { $skor = 5; }
												}

												if ($id == 5)
												{
													if ((int) $nilai >= 0 && (int) $nilai <= 30) { if($id_share > 0 ){ $skor = 1; }else{ $skor = 0;} }
													if ((int) $nilai >= 31 && (int) $nilai <= 39) { $skor = 2; }
													if ((int) $nilai >= 40 && (int) $nilai <= 49) { $skor = 3; }
													if ((int) $nilai >= 50 && (int) $nilai <= 69) { $skor = 4; }
													if ((int) $nilai >= 70) { $skor = 5; }
												}

												if ($id == 6)
												{
													if ((int) $nilai >= 0 && (int) $nilai <= 30) { if($id_share > 0 ){ $skor = 1; }else{ $skor = 0;}}
													if ((int) $nilai >= 31 && (int) $nilai <= 39) { $skor = 2; }
													if ((int) $nilai >= 40 && (int) $nilai <= 49) { $skor = 3; }
													if ((int) $nilai >= 50 && (int) $nilai <= 69) { $skor = 4; }
													if ((int) $nilai >= 70) { $skor = 5; }
												}
											?>

											<tr>
												<td><?php echo $keterangan; ?></td>
												<td class="text-right"><?php echo format_integer($bobot); ?>%</td>
												<td class="text-right"><?php echo format_currency($nilai); ?>%</td>
												<td class="text-right"><?php echo $skor; ?></td>
												<td class="text-right">
													<?php
														$final_skor = ($bobot/100) * $skor;

														echo format_currency($final_skor);
													?>
												</td>
											</tr>

											<?php
													$total_availability = $total_availability + $final_skor;
												}
											?>

											<tr>
												<td class="text-center" colspan="4" style="background-color:#89ACF3"><strong>FINAL SCORE AVAILABILITY</strong></td>
												<td class="text-right" style="background-color:#89ACF3"><strong><?php echo format_currency(($total_availability)*35/100); ?></strong></td>
											</tr>

											<!-- VISIBILITY -->

											<tr>
												<td class="text-center" style="background-color:#393939;color:#ffffff"><strong>VISIBILITY (35%)</strong></td>
												<td class="text-center" style="background-color:#F7A06C"><strong>Bobot</strong></td>
												<td class="text-center" style="background-color:#7E79DB"><strong>Share</strong></td>
												<td class="text-center" style="background-color:#F7A06C"><strong>Score</strong></td>
												<td class="text-center" style="background-color:#38CE6A"><strong>Final Score</strong></td>
											</tr>

											<?php $total_visibility = 0; ?>

											<?php foreach($list_visibility as $visibility) { ?>

											<?php
												$id = $visibility->id;
												$keterangan = $visibility->keterangan;
												$bobot = $visibility->bobot;
												$nilai = $visibility->nilai_share;
												$id_share = $visibility->id_share;
												$skor = 0;
												$final_skor = 0;

												if ((int) $nilai >= 0 && (int) $nilai <= 9) { if($id_share > 0 ){ $skor = 1; }else{ $skor = 0;} }
												if ((int) $nilai >= 10 && (int) $nilai <= 19) { $skor = 2; }
												if ((int) $nilai >= 20 && (int) $nilai <= 29) { $skor = 3; }
												if ((int) $nilai >= 30 && (int) $nilai <= 39) { $skor = 4; }
												if ((int) $nilai >= 40) { $skor = 5; }

												if ($id == 11)
												{
													if ((int) $nilai >= 0 && (int) $nilai <= 30) { if($id_share > 0 ){ $skor = 1; }else{ $skor = 0;} }
													if ((int) $nilai >= 31 && (int) $nilai <= 39) { $skor = 2; }
													if ((int) $nilai >= 40 && (int) $nilai <= 49) { $skor = 3; }
													if ((int) $nilai >= 50 && (int) $nilai <= 69) { $skor = 4; }
													if ((int) $nilai >= 70) { $skor = 5; }
												}
											?>

											<tr>
												<td><?php echo $keterangan; ?></td>
												<td class="text-right"><?php echo format_integer($bobot); ?>%</td>
												<td class="text-right"><?php echo format_currency($nilai); ?>%</td>
												<td class="text-right"><?php echo $skor; ?></td>
												<td class="text-right">
													<?php
														$final_skor = ($bobot/100) * $skor;

														echo format_currency($final_skor);
													?>
												</td>
											</tr>

											<?php
													$total_visibility = $total_visibility + $final_skor;
												}
											?>

											<tr>
												<td class="text-center" colspan="4" style="background-color:#89ACF3"><strong>FINAL SCORE VISIBILITY</strong></td>
												<td class="text-right" style="background-color:#89ACF3"><strong><?php echo format_currency($total_visibility*35/100); ?></strong></td>
											</tr>

											<!-- ADVOKASI -->

											<tr>
												<td class="text-center" style="background-color:#393939;color:#ffffff"><strong>ADVOKASI (30%)</strong></td>
												<td class="text-center" style="background-color:#F7A06C"><strong>Bobot</strong></td>
												<td class="text-center" style="background-color:#7E79DB"><strong>Share</strong></td>
												<td class="text-center" style="background-color:#F7A06C"><strong>Score</strong></td>
												<td class="text-center" style="background-color:#38CE6A"><strong>Final Score</strong></td>
											</tr>

											<?php $total_advokasi = 0; ?>

											<?php foreach($list_advokasi as $advokasi) { ?>

											<?php
												$id = $advokasi->id;
												$keterangan = $advokasi->keterangan;
												$bobot = $advokasi->bobot;
												$nilai = $advokasi->nilai_share;
												$id_share = $advokasi->id_share;
												$skor = 0;
												$final_skor = 0;

												if ((int) $nilai == 0) { $skor = 0;} 
												if ((int) $nilai >= 20 && (int) $nilai <= 29) { $skor = 1; }
												if ((int) $nilai >= 30 && (int) $nilai <= 39) { $skor = 2; }
												if ((int) $nilai >= 40 && (int) $nilai <= 49) { $skor = 3; }
												if ((int) $nilai >= 50 && (int) $nilai <= 59) { $skor = 4; }
												if ((int) $nilai >= 60) { $skor = 5; }

												if ($id == 18)
												{
													if ((int) $nilai >= 0 && (int) $nilai <= 14) { if($id_share > 0 ){ $skor = 1; }else{ $skor = 0;} }
													if ((int) $nilai >= 15 && (int) $nilai <= 19) { $skor = 2; }
													if ((int) $nilai >= 20 && (int) $nilai <= 24) { $skor = 3; }
													if ((int) $nilai >= 25 && (int) $nilai <= 29) { $skor = 4; }
													if ((int) $nilai >= 30) { $skor = 5; }
												}
											?>

											<tr>
												<td><?php echo $keterangan; ?></td>
												<td class="text-right"><?php echo format_integer($bobot); ?>%</td>
												<td class="text-right"><?php echo format_currency($nilai); ?></td>
												<td class="text-right"><?php echo $skor; ?></td>
												<td class="text-right">
													<?php
														$final_skor = ($bobot/100) * $skor;

														echo format_currency($final_skor);
													?>
												</td>
											</tr>

											<?php
													$total_advokasi = $total_advokasi + $final_skor;
												}
											?>

											<tr>
												<td class="text-center" colspan="4" style="background-color:#89ACF3"><strong>FINAL SCORE ADVOKASI</strong></td>
												<td class="text-right" style="background-color:#89ACF3"><strong><?php echo format_currency($total_advokasi*30/100); ?></strong></td>
											</tr>

											<!-- FINAL SCORE AVA -->
											<?php
											$total_all = 0;
											$total_all = (($total_availability)*35/100) + (($total_visibility)*35/100) + (($total_advokasi)*30/100) ;
											?>
											<tr>
												<td class="text-center" colspan="4" style="background-color:#38CE6A"><strong>FINAL SCORE AVA</strong></td>
												<td class="text-right" style="background-color:#38CE6A"><strong><?php echo format_currency($total_all); ?></strong></td>
											</tr>

										</tbody>
									</table>

								</div>

								<div class="col-md-5">
									<h6>METODE PENENTUAN SCORE</h6>

									<div class="table-responsive">
										<table class="table table-bordered m-0 table-sm" style="width:200%">
											<tbody>
												<tr>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
												</tr>
												<tr>
													<td class="text-center">4 variant (100%)</td>
													<td class="text-center">5</td>
													<td class="text-center">3 variant (75%)</td>
													<td class="text-center">4</td>
													<td class="text-center">2 variant (50%)</td>
													<td class="text-center">3</td>
													<td class="text-center">1 variant (25%)</td>
													<td class="text-center">2</td>
													<td class="text-center">0 variant (0%)</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 40%</td>
													<td class="text-center">5</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">4</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">3</td>
													<td class="text-center">10%-19%</td>
													<td class="text-center">2</td>
													<td class="text-center">0%-9%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">4 variant (100%)</td>
													<td class="text-center">5</td>
													<td class="text-center">3 variant (75%)</td>
													<td class="text-center">4</td>
													<td class="text-center">2 variant (50%)</td>
													<td class="text-center">3</td>
													<td class="text-center">1 variant (25%)</td>
													<td class="text-center">2</td>
													<td class="text-center">0 variant (0%)</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 40%</td>
													<td class="text-center">5</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">4</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">3</td>
													<td class="text-center">10%-19%</td>
													<td class="text-center">2</td>
													<td class="text-center">0%-9%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 70%</td>
													<td class="text-center">5</td>
													<td class="text-center">50%-69%</td>
													<td class="text-center">4</td>
													<td class="text-center">40%-49%</td>
													<td class="text-center">3</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">2</td>
													<td class="text-center">0%-30%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 70%</td>
													<td class="text-center">5</td>
													<td class="text-center">50%-69%</td>
													<td class="text-center">4</td>
													<td class="text-center">40%-49%</td>
													<td class="text-center">3</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">2</td>
													<td class="text-center">0%-30%</td>
													<td class="text-center">1</td>
												</tr>
											</tbody>
										</table>
									</div>

									<div class="table-responsive" style="margin-top:12px;">
										<table class="table table-bordered m-0 table-sm" style="width:200%">
											<tbody>
												<tr>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
												</tr>
												<tr>
													<td class="text-center">>= 40%</td>
													<td class="text-center">5</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">4</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">3</td>
													<td class="text-center">10%-19%</td>
													<td class="text-center">2</td>
													<td class="text-center">0%-9%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 40%</td>
													<td class="text-center">5</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">4</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">3</td>
													<td class="text-center">10%-19%</td>
													<td class="text-center">2</td>
													<td class="text-center">0%-9%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 40%</td>
													<td class="text-center">5</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">4</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">3</td>
													<td class="text-center">10%-19%</td>
													<td class="text-center">2</td>
													<td class="text-center">0%-9%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 40%</td>
													<td class="text-center">5</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">4</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">3</td>
													<td class="text-center">10%-19%</td>
													<td class="text-center">2</td>
													<td class="text-center">0%-9%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 70%</td>
													<td class="text-center">5</td>
													<td class="text-center">50%-69%</td>
													<td class="text-center">4</td>
													<td class="text-center">40%-49%</td>
													<td class="text-center">3</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">2</td>
													<td class="text-center">0%-30%</td>
													<td class="text-center">1</td>
												</tr>
											</tbody>
										</table>
									</div>

									<div class="table-responsive" style="margin-top:12px;">
										<table class="table table-bordered m-0 table-sm" style="width:200%">
											<tbody>
												<tr>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
													<td class="text-center" style="width:100px;background-color:#7E79DB"><strong>Share</strong></td>
													<td class="text-center" style="width:100px;background-color:#F7A06C"><strong>Score</strong></td>
												</tr>
												<tr>
													<td class="text-center">>= 60%</td>
													<td class="text-center">5</td>
													<td class="text-center">50%-59%</td>
													<td class="text-center">4</td>
													<td class="text-center">40%-49%</td>
													<td class="text-center">3</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">2</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 60%</td>
													<td class="text-center">5</td>
													<td class="text-center">50%-59%</td>
													<td class="text-center">4</td>
													<td class="text-center">40%-49%</td>
													<td class="text-center">3</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">2</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 60%</td>
													<td class="text-center">5</td>
													<td class="text-center">50%-59%</td>
													<td class="text-center">4</td>
													<td class="text-center">40%-49%</td>
													<td class="text-center">3</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">2</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 60%</td>
													<td class="text-center">5</td>
													<td class="text-center">50%-59%</td>
													<td class="text-center">4</td>
													<td class="text-center">40%-49%</td>
													<td class="text-center">3</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">2</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 60%</td>
													<td class="text-center">5</td>
													<td class="text-center">50%-59%</td>
													<td class="text-center">4</td>
													<td class="text-center">40%-49%</td>
													<td class="text-center">3</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">2</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 60%</td>
													<td class="text-center">5</td>
													<td class="text-center">50%-59%</td>
													<td class="text-center">4</td>
													<td class="text-center">40%-49%</td>
													<td class="text-center">3</td>
													<td class="text-center">30%-39%</td>
													<td class="text-center">2</td>
													<td class="text-center">20%-29%</td>
													<td class="text-center">1</td>
												</tr>
												<tr>
													<td class="text-center">>= 30%</td>
													<td class="text-center">5</td>
													<td class="text-center">25%-29%</td>
													<td class="text-center">4</td>
													<td class="text-center">20%-24%</td>
													<td class="text-center">3</td>
													<td class="text-center">15%-19%</td>
													<td class="text-center">2</td>
													<td class="text-center">0%-14%</td>
													<td class="text-center">1</td>
												</tr>
											</tbody>
										</table>
									</div>

								</div>
							</div>
						</div>
					</div>

					<input type="hidden" class="" id="x_id_tap" value="<?php echo $id_tap; ?>">
					<input type="hidden" class="" id="x_pilperiode" value="<?php echo $pilperiode; ?>">
					<input type="hidden" class="" id="x_tahun_kuartal" value="<?php echo $tahun_kuartal; ?>">
					<input type="hidden" class="" id="x_bulan_kuartal" value="<?php echo $bulan_kuartal; ?>">
					<input type="hidden" class="" id="x_tahun" value="<?php echo $tahun; ?>">
					<input type="hidden" class="" id="x_bulan" value="<?php echo $bulan; ?>">
					<input type="hidden" class="" id="x_minggu" value="<?php echo $minggu; ?>">

					<script>
						$(document).ready(function()
						{
							// var arr = [
								// 'pertanyaan_1',
								// 'pertanyaan_2',
								// 'pertanyaan_3',
								// 'pertanyaan_4',
								// 'pertanyaan_5',
								// 'pertanyaan_6',
								// 'pertanyaan_7'
							// ];
							// var arr_length = arr.length;

							// for (var i = 0; i < arr_length; i++)
							// {
								// var x_id_tap = $('#x_id_tap').val();
								// var x_pilperiode = $('#x_pilperiode').val();
								// var x_tahun_kuartal = $('#x_tahun_kuartal').val();
								// var x_bulan_kuartal = $('#x_bulan_kuartal').val();
								// var x_tahun = $('#x_tahun').val();
								// var x_bulan =  $('#x_bulan').val();
								// var x_minggu =  $('#x_minggu').val();

								// $('#grafik_'+arr[i]).load(
									// GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_grafik_' + arr[i] + '/' +
									// x_id_tap + '/' +
									// x_pilperiode + '/' +
									// x_tahun_kuartal + '/' +
									// x_bulan_kuartal + '/' +
									// x_tahun + '/' +
									// x_bulan + '/' +
									// x_minggu + '/'
								// );
							// }
						});
					</script>