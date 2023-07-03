					<style>
						div.scrol-x-table {
							width: 100%;
							overflow-x: scroll;
						}
					</style>

					<form id="frmtabentry" method="post" action="<?php echo base_url(); ?>rekomendasi_distribusi/proses">

						<div class="scrol-x-table">

							<table id="dt_table_1" class="table table-bordered m-0 table-sm table-striped">
								<thead class="bg-primary-100">
									<tr>
										<td rowspan="3"><div align="center" style="margin-top:40px;width:200px;"><strong>CHANNEL</strong></div></td>
										<td colspan="6"><div align="center"><strong>SEGEL</strong></div></td>
										<td colspan="3"><div align="center"><strong>SA</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER INTERNET</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER GAME</strong></div></td>
										<td rowspan="3"><div align="center" style="margin-top:40px"><strong>TOTAL</strong></div></td>
									</tr>
									<tr>
										<td colspan="2"><div align="center"><strong>PERDANA</strong></div></td>
										<td rowspan="2"><div align="center"><strong>VOUCHER INTERNET</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER GAME</strong></div></td>
										<td rowspan="2"><div align="center"><strong>LD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>MD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>HD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>LD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>MD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>HD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>LD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>MD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>HD</strong></div></td>
									</tr>
									<tr>
										<td><div align="center"><strong>PREPAID</strong></div></td>
										<td><div align="center"><strong>USIM</strong></div></td>
										<td><div align="center"><strong>SILVER</strong></div></td>
										<td><div align="center"><strong>GOLD</strong></div></td>
										<td><div align="center"><strong>PLATINUM</strong></div></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>SISA STOCK</td>

										<input type="hidden" class="form-control" name="ss_sgprepaid" id="ss_sgprepaid" value="<?php echo isset($data_ss['ss_sgprepaid']) ? $data_ss['ss_sgprepaid'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_sgota" id="ss_sgota" value="<?php echo isset($data_ss['ss_sgota']) ? $data_ss['ss_sgota'] : 0 ?>">

										<input type="hidden" class="form-control" name="ss_sgvin" id="ss_sgvin" value="<?php echo isset($data_ss['ss_sgvin']) ? $data_ss['ss_sgvin'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_sgvgs" id="ss_sgvgs" value="<?php echo isset($data_ss['ss_sgvgs']) ? $data_ss['ss_sgvgs'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_sgvgg" id="ss_sgvgg" value="<?php echo isset($data_ss['ss_sgvgg']) ? $data_ss['ss_sgvgg'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_sgvgp" id="ss_sgvgp" value="<?php echo isset($data_ss['ss_sgvgp']) ? $data_ss['ss_sgvgp'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_insac_ld" id="ss_insac_ld" value="<?php echo isset($data_ss['ss_insac_ld']) ? $data_ss['ss_insac_ld'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_insac_md" id="ss_insac_md" value="<?php echo isset($data_ss['ss_insac_md']) ? $data_ss['ss_insac_md'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_insac_hd" id="ss_insac_hd" value="<?php echo isset($data_ss['ss_insac_hd']) ? $data_ss['ss_insac_hd'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_invin_ld" id="ss_invin_ld" value="<?php echo isset($data_ss['ss_invin_ld']) ? $data_ss['ss_invin_ld'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_invin_md" id="ss_invin_md" value="<?php echo isset($data_ss['ss_invin_md']) ? $data_ss['ss_invin_md'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_invin_hd" id="ss_invin_hd" value="<?php echo isset($data_ss['ss_invin_hd']) ? $data_ss['ss_invin_hd'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_invga_ld" id="ss_invga_ld" value="<?php echo isset($data_ss['ss_invga_ld']) ? $data_ss['ss_invga_ld'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_invga_md" id="ss_invga_md" value="<?php echo isset($data_ss['ss_invga_md']) ? $data_ss['ss_invga_md'] : 0 ?>">
										<input type="hidden" class="form-control" name="ss_invga_hd" id="ss_invga_hd" value="<?php echo isset($data_ss['ss_invga_hd']) ? $data_ss['ss_invga_hd'] : 0 ?>">
										<input type="hidden" class="form-control" name="total_ss" id="total_ss" value="<?php echo isset($data_ss['total_ss']) ? $data_ss['total_ss'] : 0 ?>">

										<td><div align="right"><?php echo isset($data_ss['ss_sgprepaid']) ? format_integer($data_ss['ss_sgprepaid']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_sgota']) ? format_integer($data_ss['ss_sgota']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_sgvin']) ? format_integer($data_ss['ss_sgvin']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_sgvgs']) ? format_integer($data_ss['ss_sgvgs']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_sgvgg']) ? format_integer($data_ss['ss_sgvgg']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_sgvgp']) ? format_integer($data_ss['ss_sgvgp']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_insac_ld']) ? format_integer($data_ss['ss_insac_ld']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_insac_md']) ? format_integer($data_ss['ss_insac_md']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_insac_hd']) ? format_integer($data_ss['ss_insac_hd']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_invin_ld']) ? format_integer($data_ss['ss_invin_ld']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_invin_md']) ? format_integer($data_ss['ss_invin_md']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_invin_hd']) ? format_integer($data_ss['ss_invin_hd']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_invga_ld']) ? format_integer($data_ss['ss_invga_ld']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_invga_md']) ? format_integer($data_ss['ss_invga_md']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_ss['ss_invga_hd']) ? format_integer($data_ss['ss_invga_hd']) : 0 ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><strong><?php echo isset($data_ss['total_ss']) ? format_integer($data_ss['total_ss']) : 0 ?></strong></div></td>
									</tr>
									<tr>
										<td>DISTRIBUSI PERDANA TERBARU</td>

										<input type="hidden" class="form-control" name="dpt_sgprepaid" id="dpt_sgprepaid" value="<?php echo isset($data_dpt['dpt_sgprepaid']) ? $data_dpt['dpt_sgprepaid'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_sgota" id="dpt_sgota" value="<?php echo isset($data_dpt['dpt_sgota']) ? $data_dpt['dpt_sgota'] : 0 ?>">

										<input type="hidden" class="form-control" name="dpt_sgvin" id="dpt_sgvin" value="<?php echo isset($data_dpt['dpt_sgvin']) ? $data_dpt['dpt_sgvin'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_sgvgs" id="dpt_sgvgs" value="<?php echo isset($data_dpt['dpt_sgvgs']) ? $data_dpt['dpt_sgvgs'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_sgvgg" id="dpt_sgvgg" value="<?php echo isset($data_dpt['dpt_sgvgg']) ? $data_dpt['dpt_sgvgg'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_sgvgp" id="dpt_sgvgp" value="<?php echo isset($data_dpt['dpt_sgvgp']) ? $data_dpt['dpt_sgvgp'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_insac_ld" id="dpt_insac_ld" value="<?php echo isset($data_dpt['dpt_insac_ld']) ? $data_dpt['dpt_insac_ld'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_insac_md" id="dpt_insac_md" value="<?php echo isset($data_dpt['dpt_insac_md']) ? $data_dpt['dpt_insac_md'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_insac_hd" id="dpt_insac_hd" value="<?php echo isset($data_dpt['dpt_insac_hd']) ? $data_dpt['dpt_insac_hd'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_invin_ld" id="dpt_invin_ld" value="<?php echo isset($data_dpt['dpt_invin_ld']) ? $data_dpt['dpt_invin_ld'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_invin_md" id="dpt_invin_md" value="<?php echo isset($data_dpt['dpt_invin_md']) ? $data_dpt['dpt_invin_md'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_invin_hd" id="dpt_invin_hd" value="<?php echo isset($data_dpt['dpt_invin_hd']) ? $data_dpt['dpt_invin_hd'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_invga_ld" id="dpt_invga_ld" value="<?php echo isset($data_dpt['dpt_invga_ld']) ? $data_dpt['dpt_invga_ld'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_invga_md" id="dpt_invga_md" value="<?php echo isset($data_dpt['dpt_invga_md']) ? $data_dpt['dpt_invga_md'] : 0 ?>">
										<input type="hidden" class="form-control" name="dpt_invga_hd" id="dpt_invga_hd" value="<?php echo isset($data_dpt['dpt_invga_hd']) ? $data_dpt['dpt_invga_hd'] : 0 ?>">
										<input type="hidden" class="form-control" name="total_dpt" id="total_dpt" value="<?php echo isset($data_dpt['total_dpt']) ? $data_dpt['total_dpt'] : 0 ?>">

										<td><div align="right"><?php echo isset($data_dpt['dpt_sgprepaid']) ? format_integer($data_dpt['dpt_sgprepaid']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_sgota']) ? format_integer($data_dpt['dpt_sgota']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_sgvin']) ? format_integer($data_dpt['dpt_sgvin']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_sgvgs']) ? format_integer($data_dpt['dpt_sgvgs']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_sgvgg']) ? format_integer($data_dpt['dpt_sgvgg']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_sgvgp']) ? format_integer($data_dpt['dpt_sgvgp']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_insac_ld']) ? format_integer($data_dpt['dpt_insac_ld']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_insac_md']) ? format_integer($data_dpt['dpt_insac_md']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_insac_hd']) ? format_integer($data_dpt['dpt_insac_hd']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_invin_ld']) ? format_integer($data_dpt['dpt_invin_ld']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_invin_md']) ? format_integer($data_dpt['dpt_invin_md']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_invin_hd']) ? format_integer($data_dpt['dpt_invin_hd']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_invga_ld']) ? format_integer($data_dpt['dpt_invga_ld']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_invga_md']) ? format_integer($data_dpt['dpt_invga_md']) : 0 ?></div></td>
										<td><div align="right"><?php echo isset($data_dpt['dpt_invga_hd']) ? format_integer($data_dpt['dpt_invga_hd']) : 0 ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><strong><?php echo isset($data_dpt['total_dpt']) ? format_integer($data_dpt['total_dpt']) : 0 ?></strong></div></td>
									</tr>
									<tr style="background-color:#f2f2f2">
										<td><strong>TOTAL DISTRIBUSI</strong></td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_sgprepaid" id="td_sgprepaid" value="<?php echo $data_ss['ss_sgprepaid'] + $data_dpt['dpt_sgprepaid'] ?>">

													<?php echo format_integer($data_ss['ss_sgprepaid'] + $data_dpt['dpt_sgprepaid']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_sgota" id="td_sgota" value="<?php echo $data_ss['ss_sgota'] + $data_dpt['dpt_sgota'] ?>">
													<?php echo format_integer($data_ss['ss_sgota'] + $data_dpt['dpt_sgota']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_sgvin" id="td_sgvin" value="<?php echo $data_ss['ss_sgvin'] + $data_dpt['dpt_sgvin'] ?>">
													<?php echo format_integer($data_ss['ss_sgvin'] + $data_dpt['dpt_sgvin']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_sgvgs" id="td_sgvgs" value="<?php echo $data_ss['ss_sgvgs'] + $data_dpt['dpt_sgvgs'] ?>">
													<?php echo format_integer($data_ss['ss_sgvgs'] + $data_dpt['dpt_sgvgs']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_sgvgg" id="td_sgvgg" value="<?php echo $data_ss['ss_sgvgg'] + $data_dpt['dpt_sgvgg'] ?>">
													<?php echo format_integer($data_ss['ss_sgvgg'] + $data_dpt['dpt_sgvgg']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_sgvgp" id="td_sgvgp" value="<?php echo $data_ss['ss_sgvgp'] + $data_dpt['dpt_sgvgp'] ?>">
													<?php echo format_integer($data_ss['ss_sgvgp'] + $data_dpt['dpt_sgvgp']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_insac_ld" id="td_insac_ld" value="<?php echo $data_ss['ss_insac_ld'] + $data_dpt['dpt_insac_ld'] ?>">
													<?php echo format_integer($data_ss['ss_insac_ld'] + $data_dpt['dpt_insac_ld']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_insac_md" id="td_insac_md" value="<?php echo $data_ss['ss_insac_md'] + $data_dpt['dpt_insac_md'] ?>">
													<?php echo format_integer($data_ss['ss_insac_md'] + $data_dpt['dpt_insac_md']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_insac_hd" id="td_insac_hd" value="<?php echo $data_ss['ss_insac_hd'] + $data_dpt['dpt_insac_hd'] ?>">
													<?php echo format_integer($data_ss['ss_insac_hd'] + $data_dpt['dpt_insac_hd']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_invin_ld" id="td_invin_ld" value="<?php echo $data_ss['ss_invin_ld'] + $data_dpt['dpt_invin_ld'] ?>">
													<?php echo format_integer($data_ss['ss_invin_ld'] + $data_dpt['dpt_invin_ld']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_invin_md" id="td_invin_md" value="<?php echo $data_ss['ss_invin_md'] + $data_dpt['dpt_invin_md'] ?>">
													<?php echo format_integer($data_ss['ss_invin_md'] + $data_dpt['dpt_invin_md']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_invin_hd" id="td_invin_hd" value="<?php echo $data_ss['ss_invin_hd'] + $data_dpt['dpt_invin_hd'] ?>">
													<?php echo format_integer($data_ss['ss_invin_hd'] + $data_dpt['dpt_invin_hd']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_invga_ld" id="td_invga_ld" value="<?php echo $data_ss['ss_invga_ld'] + $data_dpt['dpt_invga_ld'] ?>">
													<?php echo format_integer($data_ss['ss_invga_ld'] + $data_dpt['dpt_invga_ld']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_invga_md" id="td_invga_md" value="<?php echo $data_ss['ss_invga_md'] + $data_dpt['dpt_invga_md'] ?>">
													<?php echo format_integer($data_ss['ss_invga_md'] + $data_dpt['dpt_invga_md']) ?>
												</strong>
											</div>
										</td>
										<td>
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="td_invga_hd" id="td_invga_hd" value="<?php echo $data_ss['ss_invga_hd'] + $data_dpt['dpt_invga_hd'] ?>">
													<?php echo format_integer($data_ss['ss_invga_hd'] + $data_dpt['dpt_invga_hd']) ?>
												</strong>
											</div>
										</td>

										<td style="background-color:#7f7585">
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="total_td" id="total_td" value="<?php echo
															$data_ss['ss_sgprepaid'] + $data_dpt['dpt_sgprepaid'] +
															$data_ss['ss_sgota'] + $data_dpt['dpt_sgota'] +
															$data_ss['ss_sgvin'] + $data_dpt['dpt_sgvin'] +
															$data_ss['ss_sgvgs'] + $data_dpt['dpt_sgvgs'] +
															$data_ss['ss_sgvgg'] + $data_dpt['dpt_sgvgg'] +
															$data_ss['ss_sgvgp'] + $data_dpt['dpt_sgvgp'] +
															$data_ss['ss_sgvgp'] + $data_dpt['dpt_sgvgp'] +
															$data_ss['ss_insac_ld'] + $data_dpt['dpt_insac_ld'] +
															$data_ss['ss_insac_md'] + $data_dpt['dpt_insac_md'] +
															$data_ss['ss_insac_hd'] + $data_dpt['dpt_insac_hd'] +
															$data_ss['ss_invin_ld'] + $data_dpt['dpt_invin_ld'] +
															$data_ss['ss_invin_md'] + $data_dpt['dpt_invin_md'] +
															$data_ss['ss_invin_hd'] + $data_dpt['dpt_invin_hd'] +
															$data_ss['ss_invga_ld'] + $data_dpt['dpt_invga_ld'] +
															$data_ss['ss_invga_md'] + $data_dpt['dpt_invga_md'] +
															$data_ss['ss_invga_hd'] + $data_dpt['dpt_invga_hd']
														?>">

													<?php echo
														format_integer(
															$data_ss['ss_sgprepaid'] + $data_dpt['dpt_sgprepaid'] +
															$data_ss['ss_sgota'] + $data_dpt['dpt_sgota'] +
															$data_ss['ss_sgvin'] + $data_dpt['dpt_sgvin'] +
															$data_ss['ss_sgvgs'] + $data_dpt['dpt_sgvgs'] +
															$data_ss['ss_sgvgg'] + $data_dpt['dpt_sgvgg'] +
															$data_ss['ss_sgvgp'] + $data_dpt['dpt_sgvgp'] +
															$data_ss['ss_sgvgp'] + $data_dpt['dpt_sgvgp'] +
															$data_ss['ss_insac_ld'] + $data_dpt['dpt_insac_ld'] +
															$data_ss['ss_insac_md'] + $data_dpt['dpt_insac_md'] +
															$data_ss['ss_insac_hd'] + $data_dpt['dpt_insac_hd'] +
															$data_ss['ss_invin_ld'] + $data_dpt['dpt_invin_ld'] +
															$data_ss['ss_invin_md'] + $data_dpt['dpt_invin_md'] +
															$data_ss['ss_invin_hd'] + $data_dpt['dpt_invin_hd'] +
															$data_ss['ss_invga_ld'] + $data_dpt['dpt_invga_ld'] +
															$data_ss['ss_invga_md'] + $data_dpt['dpt_invga_md'] +
															$data_ss['ss_invga_hd'] + $data_dpt['dpt_invga_hd']
														);
													?>
												</strong>
											</div>
										</td>
									</tr>
								</tbody>
							</table>

						</div> <!-- // End scrol-x-table -->

						<p>&nbsp;<p>

						<div class="scrol-x-table">

							<table id="dt_table_4" class="table table-bordered m-0 table-sm">
								<thead class="bg-primary-100">
									<tr>
										<td colspan="2" rowspan="3"><div align="center" style="margin-top:40px;width:200px;"><strong>CHANNEL</strong></div></td>
										<td colspan="6"><div align="center"><strong>SEGEL</strong></div></td>
										<td colspan="3"><div align="center"><strong>SA</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER INTERNET</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER GAME</strong></div></td>
										<td rowspan="3"><div align="center" style="margin-top:40px"><strong>TOTAL</strong></div></td>
									</tr>
									<tr>
										<td colspan="2"><div align="center"><strong>PERDANA</strong></div></td>
										<td rowspan="2"><div align="center"><strong>VOUCHER INTERNET</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER GAME</strong></div></td>
										<td rowspan="2"><div align="center"><strong>LD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>MD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>HD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>LD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>MD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>HD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>LD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>MD</strong></div></td>
										<td rowspan="2"><div align="center"><strong>HD</strong></div></td>
									</tr>
									<tr>
										<td><div align="center"><strong>PREPAID</strong></div></td>
										<td><div align="center"><strong>USIM</strong></div></td>
										<td><div align="center"><strong>SILVER</strong></div></td>
										<td><div align="center"><strong>GOLD</strong></div></td>
										<td><div align="center"><strong>PLATINUM</strong></div></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td rowspan="3"><div  style="margin-top:40px;width:150px;"><strong>DIRECT SALES</strong></div></td>
										<td><div style="width:90px;"><strong>SEKOLAH</strong></div></td>
										<td>
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_sgprepaid" id="ds_sek_sgprepaid" value="<?php echo isset($data_rd['ds_sek_sgprepaid']) ? $data_rd['ds_sek_sgprepaid'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'sgprepaid')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_sgprepaid']) ? format_integer($data_rd['ds_sek_sgprepaid']) : 0 ?></div> -->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_sgota"	id="ds_sek_sgota" value="<?php echo isset($data_rd['ds_sek_sgota']) ? $data_rd['ds_sek_sgota'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'sgota')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_sgota']) ? format_integer($data_rd['ds_sek_sgota']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_sgvin" id="ds_sek_sgvin" value="<?php echo isset($data_rd['ds_sek_sgvin']) ? $data_rd['ds_sek_sgvin'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'sgvin')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_sgvin']) ? format_integer($data_rd['ds_sek_sgvin']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_sgvgs" id="ds_sek_sgvgs" value="<?php echo isset($data_rd['ds_sek_sgvgs']) ? $data_rd['ds_sek_sgvgs'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'sgvgs')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_sgvgs']) ? format_integer($data_rd['ds_sek_sgvgs']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_sgvgg" id="ds_sek_sgvgg" value="<?php echo isset($data_rd['ds_sek_sgvgg']) ? $data_rd['ds_sek_sgvgg'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'sgvgg')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_sgvgg']) ? format_integer($data_rd['ds_sek_sgvgg']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_sgvgp" id="ds_sek_sgvgp" value="<?php echo isset($data_rd['ds_sek_sgvgp']) ? $data_rd['ds_sek_sgvgp'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'sgvgp')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_sgvgp']) ? format_integer($data_rd['ds_sek_sgvgp']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_insac_ld" id="ds_sek_insac_ld" value="<?php echo isset($data_rd['ds_sek_insac_ld']) ? $data_rd['ds_sek_insac_ld'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'insac_ld')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_insac_ld']) ? format_integer($data_rd['ds_sek_insac_ld']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_insac_md" id="ds_sek_insac_md" value="<?php echo isset($data_rd['ds_sek_insac_md']) ? $data_rd['ds_sek_insac_md'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'insac_md')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_insac_md']) ? format_integer($data_rd['ds_sek_insac_md']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_insac_hd" id="ds_sek_insac_hd" value="<?php echo isset($data_rd['ds_sek_insac_hd']) ? $data_rd['ds_sek_insac_hd'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'insac_hd')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_insac_hd']) ? format_integer($data_rd['ds_sek_insac_hd']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_invin_ld" id="ds_sek_invin_ld" value="<?php echo isset($data_rd['ds_sek_invin_ld']) ? $data_rd['ds_sek_invin_ld'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'invin_ld')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_invin_ld']) ? format_integer($data_rd['ds_sek_invin_ld']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_invin_md" id="ds_sek_invin_md" value="<?php echo isset($data_rd['ds_sek_invin_md']) ? $data_rd['ds_sek_invin_md'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'invin_md')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_invin_md']) ? format_integer($data_rd['ds_sek_invin_md']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_invin_hd" id="ds_sek_invin_hd" value="<?php echo isset($data_rd['ds_sek_invin_hd']) ? $data_rd['ds_sek_invin_hd'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'invin_hd')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_invin_hd']) ? format_integer($data_rd['ds_sek_invin_hd']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_invga_ld" id="ds_sek_invga_ld" value="<?php echo isset($data_rd['ds_sek_invga_ld']) ? $data_rd['ds_sek_invga_ld'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'invga_ld')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_invga_ld']) ? format_integer($data_rd['ds_sek_invga_ld']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_invga_md" id="ds_sek_invga_md" value="<?php echo isset($data_rd['ds_sek_invga_md']) ? $data_rd['ds_sek_invga_md'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'invga_md')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_invga_md']) ? format_integer($data_rd['ds_sek_invga_md']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_sek_invga_hd" id="ds_sek_invga_hd" value="<?php echo isset($data_rd['ds_sek_invga_hd']) ? $data_rd['ds_sek_invga_hd'] : 0 ?>" onkeyup="keyup_aksi('ds', 'sek', 'invga_hd')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_sek_invga_hd']) ? format_integer($data_rd['ds_sek_invga_hd']) : 0 ?></div>-->
											</div>
										</td>
										<td style="background-color:#f2f2f2">
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden"class="form-control" name="total_ds_sek" id="total_ds_sek" value="<?php echo isset($data_rd['total_ds_sek']) ? $data_rd['total_ds_sek'] : 0 ?>">
													<div id="v_total_ds_sek"><?php echo isset($data_rd['total_ds_sek']) ? format_integer($data_rd['total_ds_sek']) : 0 ?></div>
												</strong>
											</div>
										</td>
									</tr>


									<tr>
										<td><strong>KAMPUS</strong></td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_sgprepaid" id="ds_kam_sgprepaid" value="<?php echo isset($data_rd['ds_kam_sgprepaid']) ? $data_rd['ds_kam_sgprepaid'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'sgprepaid')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_sgprepaid']) ? format_integer($data_rd['ds_kam_sgprepaid']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_sgota"	id="ds_kam_sgota" value="<?php echo isset($data_rd['ds_kam_sgota']) ? $data_rd['ds_kam_sgota'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'sgota')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_sgota']) ? format_integer($data_rd['ds_kam_sgota']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_sgvin" id="ds_kam_sgvin" value="<?php echo isset($data_rd['ds_kam_sgvin']) ? $data_rd['ds_kam_sgvin'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'sgvin')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_sgvin']) ? format_integer($data_rd['ds_kam_sgvin']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_sgvgs" id="ds_kam_sgvgs" value="<?php echo isset($data_rd['ds_kam_sgvgs']) ? $data_rd['ds_kam_sgvgs'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'sgvgs')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_sgvgs']) ? format_integer($data_rd['ds_kam_sgvgs']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_sgvgg" id="ds_kam_sgvgg" value="<?php echo isset($data_rd['ds_kam_sgvgg']) ? $data_rd['ds_kam_sgvgg'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'sgvgg')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_sgvgg']) ? format_integer($data_rd['ds_kam_sgvgg']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_sgvgp" id="ds_kam_sgvgp" value="<?php echo isset($data_rd['ds_kam_sgvgp']) ? $data_rd['ds_kam_sgvgp'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'sgvgp')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_sgvgp']) ? format_integer($data_rd['ds_kam_sgvgp']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_insac_ld" id="ds_kam_insac_ld" value="<?php echo isset($data_rd['ds_kam_insac_ld']) ? $data_rd['ds_kam_insac_ld'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'insac_ld')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_insac_ld']) ? format_integer($data_rd['ds_kam_insac_ld']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_insac_md" id="ds_kam_insac_md" value="<?php echo isset($data_rd['ds_kam_insac_md']) ? $data_rd['ds_kam_insac_md'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'insac_md')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_insac_md']) ? format_integer($data_rd['ds_kam_insac_md']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_insac_hd" id="ds_kam_insac_hd" value="<?php echo isset($data_rd['ds_kam_insac_hd']) ? $data_rd['ds_kam_insac_hd'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'insac_hd')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_insac_hd']) ? format_integer($data_rd['ds_kam_insac_hd']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_invin_ld" id="ds_kam_invin_ld" value="<?php echo isset($data_rd['ds_kam_invin_ld']) ? $data_rd['ds_kam_invin_ld'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'invin_ld')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_invin_ld']) ? format_integer($data_rd['ds_kam_invin_ld']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_invin_md" id="ds_kam_invin_md" value="<?php echo isset($data_rd['ds_kam_invin_md']) ? $data_rd['ds_kam_invin_md'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'invin_md')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_invin_md']) ? format_integer($data_rd['ds_kam_invin_md']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_invin_hd" id="ds_kam_invin_hd" value="<?php echo isset($data_rd['ds_kam_invin_hd']) ? $data_rd['ds_kam_invin_hd'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'invin_hd')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_invin_hd']) ? format_integer($data_rd['ds_kam_invin_hd']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_invga_ld" id="ds_kam_invga_ld" value="<?php echo isset($data_rd['ds_kam_invga_ld']) ? $data_rd['ds_kam_invga_ld'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'invga_ld')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_invga_ld']) ? format_integer($data_rd['ds_kam_invga_ld']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_invga_md" id="ds_kam_invga_md" value="<?php echo isset($data_rd['ds_kam_invga_md']) ? $data_rd['ds_kam_invga_md'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'invga_md')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_invga_md']) ? format_integer($data_rd['ds_kam_invga_md']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_kam_invga_hd" id="ds_kam_invga_hd" value="<?php echo isset($data_rd['ds_kam_invga_hd']) ? $data_rd['ds_kam_invga_hd'] : 0 ?>" onkeyup="keyup_aksi('ds', 'kam', 'invga_hd')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_kam_invga_hd']) ? format_integer($data_rd['ds_kam_invga_hd']) : 0 ?></div>-->
											</div>
										</td>
										<td style="background-color:#f2f2f2">
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="total_ds_kam" id="total_ds_kam" value="<?php echo isset($data_rd['total_ds_kam']) ? $data_rd['total_ds_kam'] : 0 ?>">
													<div id="v_total_ds_kam"><?php echo isset($data_rd['total_ds_kam']) ? format_integer($data_rd['total_ds_kam']) : 0 ?></div>
												</strong>
											</div>
										</td>
									</tr>


									<tr>
										<td><strong>FAKULTAS</strong></td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_sgprepaid" id="ds_fak_sgprepaid" value="<?php echo isset($data_rd['ds_fak_sgprepaid']) ? $data_rd['ds_fak_sgprepaid'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'sgprepaid')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_sgprepaid']) ? format_integer($data_rd['ds_fak_sgprepaid']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_sgota"	id="ds_fak_sgota" value="<?php echo isset($data_rd['ds_fak_sgota']) ? $data_rd['ds_fak_sgota'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'sgota')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_sgota']) ? format_integer($data_rd['ds_fak_sgota']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_sgvin" id="ds_fak_sgvin" value="<?php echo isset($data_rd['ds_fak_sgvin']) ? $data_rd['ds_fak_sgvin'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'sgvin')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_sgvin']) ? format_integer($data_rd['ds_fak_sgvin']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_sgvgs" id="ds_fak_sgvgs" value="<?php echo isset($data_rd['ds_fak_sgvgs']) ? $data_rd['ds_fak_sgvgs'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'sgvgs')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_sgvgs']) ? format_integer($data_rd['ds_fak_sgvgs']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_sgvgg" id="ds_fak_sgvgg" value="<?php echo isset($data_rd['ds_fak_sgvgg']) ? $data_rd['ds_fak_sgvgg'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'sgvgg')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_sgvgg']) ? format_integer($data_rd['ds_fak_sgvgg']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_sgvgp" id="ds_fak_sgvgp" value="<?php echo isset($data_rd['ds_fak_sgvgp']) ? $data_rd['ds_fak_sgvgp'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'sgvgp')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_sgvgp']) ? format_integer($data_rd['ds_fak_sgvgp']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_insac_ld" id="ds_fak_insac_ld" value="<?php echo isset($data_rd['ds_fak_insac_ld']) ? $data_rd['ds_fak_insac_ld'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'insac_ld')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_insac_ld']) ? format_integer($data_rd['ds_fak_insac_ld']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_insac_md" id="ds_fak_insac_md" value="<?php echo isset($data_rd['ds_fak_insac_md']) ? $data_rd['ds_fak_insac_md'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'insac_md')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_insac_md']) ? format_integer($data_rd['ds_fak_insac_md']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_insac_hd" id="ds_fak_insac_hd" value="<?php echo isset($data_rd['ds_fak_insac_hd']) ? $data_rd['ds_fak_insac_hd'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'insac_hd')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_insac_hd']) ? format_integer($data_rd['ds_fak_insac_hd']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_invin_ld" id="ds_fak_invin_ld" value="<?php echo isset($data_rd['ds_fak_invin_ld']) ? $data_rd['ds_fak_invin_ld'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'invin_ld')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_invin_ld']) ? format_integer($data_rd['ds_fak_invin_ld']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_invin_md" id="ds_fak_invin_md" value="<?php echo isset($data_rd['ds_fak_invin_md']) ? $data_rd['ds_fak_invin_md'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'invin_md')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_invin_md']) ? format_integer($data_rd['ds_fak_invin_md']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_invin_hd" id="ds_fak_invin_hd" value="<?php echo isset($data_rd['ds_fak_invin_hd']) ? $data_rd['ds_fak_invin_hd'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'invin_hd')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_invin_hd']) ? format_integer($data_rd['ds_fak_invin_hd']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_invga_ld" id="ds_fak_invga_ld" value="<?php echo isset($data_rd['ds_fak_invga_ld']) ? $data_rd['ds_fak_invga_ld'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'invga_ld')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_invga_ld']) ? format_integer($data_rd['ds_fak_invga_ld']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_invga_md" id="ds_fak_invga_md" value="<?php echo isset($data_rd['ds_fak_invga_md']) ? $data_rd['ds_fak_invga_md'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'invga_md')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_invga_md']) ? format_integer($data_rd['ds_fak_invga_md']) : 0 ?></div>-->
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" autocomplete="off" class="form-control integer integeronly text-right" name="ds_fak_invga_hd" id="ds_fak_invga_hd" value="<?php echo isset($data_rd['ds_fak_invga_hd']) ? $data_rd['ds_fak_invga_hd'] : 0 ?>" onkeyup="keyup_aksi('ds', 'fak', 'invga_hd')">
												<!--<div style="margin-right:15px"><?php echo isset($data_rd['ds_fak_invga_hd']) ? format_integer($data_rd['ds_fak_invga_hd']) : 0 ?></div>-->
											</div>
										</td>
										<td style="background-color:#f2f2f2">
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="total_ds_fak" id="total_ds_fak" value="<?php echo isset($data_rd['total_ds_fak']) ? $data_rd['total_ds_fak'] : 0 ?>">
													<div id="v_total_ds_fak"><?php echo isset($data_rd['total_ds_fak']) ? format_integer($data_rd['total_ds_fak']) : 0 ?></div>
												</strong>
											</div>
										</td>
									</tr>


									<tr style="background-color:#f2f2f2">
										<td colspan="2"><strong>TOTAL DIRECT SALES</strong></td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_sgprepaid" id="tds_sgprepaid" value="<?php echo isset($data_rd['tds_sgprepaid']) ? $data_rd['tds_sgprepaid'] : 0 ?>">
												<div id="v_tds_sgprepaid" style="margin-right:15px"><?php echo isset($data_rd['tds_sgprepaid']) ? format_integer($data_rd['tds_sgprepaid']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_sgota"	id="tds_sgota" value="<?php echo isset($data_rd['tds_sgota']) ? $data_rd['tds_sgota'] : 0 ?>">
												<div id="v_tds_sgota" style="margin-right:15px"><?php echo isset($data_rd['tds_sgota']) ? format_integer($data_rd['tds_sgota']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_sgvin" id="tds_sgvin" value="<?php echo isset($data_rd['tds_sgvin']) ? $data_rd['tds_sgvin'] : 0 ?>">
												<div id="v_tds_sgvin" style="margin-right:15px"><?php echo isset($data_rd['tds_sgvin']) ? format_integer($data_rd['tds_sgvin']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_sgvgs" id="tds_sgvgs" value="<?php echo isset($data_rd['tds_sgvgs']) ? $data_rd['tds_sgvgs'] : 0 ?>">
												<div id="v_tds_sgvgs" style="margin-right:15px"><?php echo isset($data_rd['tds_sgvgs']) ? format_integer($data_rd['tds_sgvgs']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_sgvgg" id="tds_sgvgg" value="<?php echo isset($data_rd['tds_sgvgg']) ? $data_rd['tds_sgvgg'] : 0 ?>">
												<div id="v_tds_sgvgg" style="margin-right:15px"><?php echo isset($data_rd['tds_sgvgg']) ? format_integer($data_rd['tds_sgvgg']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_sgvgp" id="tds_sgvgp" value="<?php echo isset($data_rd['tds_sgvgp']) ? $data_rd['tds_sgvgp'] : 0 ?>">
												<div id="v_tds_sgvgp" style="margin-right:15px"><?php echo isset($data_rd['tds_sgvgp']) ? format_integer($data_rd['tds_sgvgp']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_insac_ld" id="tds_insac_ld" value="<?php echo isset($data_rd['tds_insac_ld']) ? $data_rd['tds_insac_ld'] : 0 ?>">
												<div id="v_tds_insac_ld" style="margin-right:15px"><?php echo isset($data_rd['tds_insac_ld']) ? format_integer($data_rd['tds_insac_ld']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_insac_md" id="tds_insac_md" value="<?php echo isset($data_rd['tds_insac_md']) ? $data_rd['tds_insac_md'] : 0 ?>">
												<div id="v_tds_insac_md" style="margin-right:15px"><?php echo isset($data_rd['tds_insac_md']) ? format_integer($data_rd['tds_insac_md']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_insac_hd" id="tds_insac_hd" value="<?php echo isset($data_rd['tds_insac_hd']) ? $data_rd['tds_insac_hd'] : 0 ?>">
												<div id="v_tds_insac_hd" style="margin-right:15px"><?php echo isset($data_rd['tds_insac_hd']) ? format_integer($data_rd['tds_insac_hd']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_invin_ld" id="tds_invin_ld" value="<?php echo isset($data_rd['tds_invin_ld']) ? $data_rd['tds_invin_ld'] : 0 ?>">
												<div id="v_tds_invin_ld" style="margin-right:15px"><?php echo isset($data_rd['tds_invin_ld']) ? format_integer($data_rd['tds_invin_ld']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_invin_md" id="tds_invin_md" value="<?php echo isset($data_rd['tds_invin_md']) ? $data_rd['tds_invin_md'] : 0 ?>">
												<div id="v_tds_invin_md" style="margin-right:15px"><?php echo isset($data_rd['tds_invin_md']) ? format_integer($data_rd['tds_invin_md']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_invin_hd" id="tds_invin_hd" value="<?php echo isset($data_rd['tds_invin_hd']) ? $data_rd['tds_invin_hd'] : 0 ?>">
												<div id="v_tds_invin_hd" style="margin-right:15px"><?php echo isset($data_rd['tds_invin_hd']) ? format_integer($data_rd['tds_invin_hd']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_invga_ld" id="tds_invga_ld" value="<?php echo isset($data_rd['tds_invga_ld']) ? $data_rd['tds_invga_ld'] : 0 ?>">
												<div id="v_tds_invga_ld" style="margin-right:15px"><?php echo isset($data_rd['tds_invga_ld']) ? format_integer($data_rd['tds_invga_ld']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_invga_md" id="tds_invga_md" value="<?php echo isset($data_rd['tds_invga_md']) ? $data_rd['tds_invga_md'] : 0 ?>">
												<div id="v_tds_invga_md" style="margin-right:15px"><?php echo isset($data_rd['tds_invga_md']) ? format_integer($data_rd['tds_invga_md']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tds_invga_hd" id="tds_invga_hd" value="<?php echo isset($data_rd['tds_invga_hd']) ? $data_rd['tds_invga_hd'] : 0 ?>">
												<div id="v_tds_invga_hd" style="margin-right:15px"><?php echo isset($data_rd['tds_invga_hd']) ? format_integer($data_rd['tds_invga_hd']) : 0 ?></div>
											</div>
										</td>
										<td style="background-color:#7f7585">
											<div align="right">
												<strong>
													<?php
														$tds_sgprepaid = isset($data_rd['tds_sgprepaid']) ? $data_rd['tds_sgprepaid'] : 0;
														$tds_sgota = isset($data_rd['tds_sgota']) ? $data_rd['tds_sgota'] : 0;

														$tds_sgvin = isset($data_rd['tds_sgvin']) ? $data_rd['tds_sgvin'] : 0;

														$tds_sgvgs = isset($data_rd['tds_sgvgs']) ? $data_rd['tds_sgvgs'] : 0;
														$tds_sgvgg = isset($data_rd['tds_sgvgg']) ? $data_rd['tds_sgvgg'] : 0;
														$tds_sgvgp = isset($data_rd['tds_sgvgp']) ? $data_rd['tds_sgvgp'] : 0;

														$tds_insac_ld = isset($data_rd['tds_insac_ld']) ? $data_rd['tds_insac_ld'] : 0;
														$tds_insac_md = isset($data_rd['tds_insac_md']) ? $data_rd['tds_insac_md'] : 0;
														$tds_insac_hd = isset($data_rd['tds_insac_hd']) ? $data_rd['tds_insac_hd'] : 0;

														$tds_invin_ld = isset($data_rd['tds_invin_ld']) ? $data_rd['tds_invin_ld'] : 0;
														$tds_invin_md = isset($data_rd['tds_invin_md']) ? $data_rd['tds_invin_md'] : 0;
														$tds_invin_hd = isset($data_rd['tds_invin_hd']) ? $data_rd['tds_invin_hd'] : 0;

														$tds_invga_ld = isset($data_rd['tds_invga_ld']) ? $data_rd['tds_invga_ld'] : 0;
														$tds_invga_md = isset($data_rd['tds_invga_md']) ? $data_rd['tds_invga_md'] : 0;
														$tds_invga_hd = isset($data_rd['tds_invga_hd']) ? $data_rd['tds_invga_hd'] : 0;

														$total_tds = $tds_sgprepaid + $tds_sgota +
																				 $tds_sgvin +
																				 $tds_sgvgs + $tds_sgvgg + $tds_sgvgp +
																				 $tds_insac_ld + $tds_insac_md + $tds_insac_hd +
																				 $tds_invin_ld + $tds_invin_md + $tds_invin_hd +
																				 $tds_invga_ld + $tds_invga_md + $tds_invga_hd;
													?>

													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="total_tds" id="total_tds" value="<?php echo$total_tds; ?>">

													<div id="v_total_tds"><?php echo format_integer($total_tds) ?></div>

												</strong>
											</div>
										</td>
									</tr>


									<tr>
										<td><strong>SALES FORCE</strong></td>
										<td><strong>OUTLET</strong></td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_sgprepaid" id="sf_out_sgprepaid" autocomplete="off" value="<?php echo isset($data_rd['sf_out_sgprepaid']) ? format_integer($data_rd['sf_out_sgprepaid']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'sgprepaid')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_sgota"	id="sf_out_sgota" autocomplete="off" value="<?php echo isset($data_rd['sf_out_sgota']) ? format_integer($data_rd['sf_out_sgota']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'sgota')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_sgvin" id="sf_out_sgvin" autocomplete="off" value="<?php echo isset($data_rd['sf_out_sgvin']) ? format_integer($data_rd['sf_out_sgvin']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'sgvin')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_sgvgs" id="sf_out_sgvgs" autocomplete="off" value="<?php echo isset($data_rd['sf_out_sgvgs']) ? format_integer($data_rd['sf_out_sgvgs']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'sgvgs')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_sgvgg" id="sf_out_sgvgg" autocomplete="off" value="<?php echo isset($data_rd['sf_out_sgvgg']) ? format_integer($data_rd['sf_out_sgvgg']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'sgvgg')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_sgvgp" id="sf_out_sgvgp" autocomplete="off" value="<?php echo isset($data_rd['sf_out_sgvgp']) ? format_integer($data_rd['sf_out_sgvgp']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'sgvgp')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_insac_ld" id="sf_out_insac_ld" autocomplete="off" value="<?php echo isset($data_rd['sf_out_insac_ld']) ? format_integer($data_rd['sf_out_insac_ld']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'insac_ld')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_insac_md" id="sf_out_insac_md" autocomplete="off" value="<?php echo isset($data_rd['sf_out_insac_md']) ? format_integer($data_rd['sf_out_insac_md']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'insac_md')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_insac_hd" id="sf_out_insac_hd" autocomplete="off" value="<?php echo isset($data_rd['sf_out_insac_hd']) ? format_integer($data_rd['sf_out_insac_hd']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', insac_hd)">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_invin_ld" id="sf_out_invin_ld" autocomplete="off" value="<?php echo isset($data_rd['sf_out_invin_ld']) ? format_integer($data_rd['sf_out_invin_ld']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'invin_ld')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_invin_md" id="sf_out_invin_md" autocomplete="off" value="<?php echo isset($data_rd['sf_out_invin_md']) ? format_integer($data_rd['sf_out_invin_md']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'invin_md')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_invin_hd" id="sf_out_invin_hd" autocomplete="off" value="<?php echo isset($data_rd['sf_out_invin_hd']) ? format_integer($data_rd['sf_out_invin_hd']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'invin_hd')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_invga_ld" id="sf_out_invga_ld" autocomplete="off" value="<?php echo isset($data_rd['sf_out_invga_ld']) ? format_integer($data_rd['sf_out_invga_ld']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'invga_ld')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_invga_md" id="sf_out_invga_md" autocomplete="off" value="<?php echo isset($data_rd['sf_out_invga_md']) ? format_integer($data_rd['sf_out_invga_md']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'invga_md')">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right" name="sf_out_invga_hd" id="sf_out_invga_hd" autocomplete="off" value="<?php echo isset($data_rd['sf_out_invga_hd']) ? format_integer($data_rd['sf_out_invga_hd']) : 0 ?>" onkeyup="keyup_aksi('sf', 'out', 'invga_hd')">
											</div>
										</td>


										<td style="background-color:#f2f2f2">
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="total_sf_out" id="total_sf_out" autocomplete="off" value="<?php echo isset($data_rd['total_sf_out']) ? format_integer($data_rd['total_sf_out']) : 0 ?>">

													<div id="v_total_sf_out"><?php echo isset($data_rd['total_sf_out']) ? format_integer($data_rd['total_sf_out']) : 0 ?></div>
												</strong>
											</div>
										</td>
									</tr>
									<tr style="background-color:#f2f2f2">
										<td colspan="2"><strong>TOTAL INDIRECT SALES</strong></td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_sgprepaid" id="tis_sgprepaid" value="<?php echo isset($data_rd['tis_sgprepaid']) ? $data_rd['tis_sgprepaid'] : 0 ?>">
												<div id="v_tis_sgprepaid" style="margin-right:15px"><?php echo isset($data_rd['tis_sgprepaid']) ? format_integer($data_rd['tis_sgprepaid']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_sgota" id="tis_sgota" value="<?php echo isset($data_rd['tis_sgota']) ? $data_rd['tis_sgota'] : 0 ?>">
												<div id="v_tis_sgota" style="margin-right:15px"><?php echo isset($data_rd['tis_sgota']) ? format_integer($data_rd['tis_sgota']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_sgvin" id="tis_sgvin" value="<?php echo isset($data_rd['tis_sgvin']) ? $data_rd['tis_sgvin'] : 0 ?>">
												<div id="v_tis_sgvin" style="margin-right:15px"><?php echo isset($data_rd['tis_sgvin']) ? format_integer($data_rd['tis_sgvin']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_sgvgs" id="tis_sgvgs" value="<?php echo isset($data_rd['tis_sgvgs']) ? $data_rd['tis_sgvgs'] : 0 ?>">
												<div id="v_tis_sgvgs" style="margin-right:15px"><?php echo isset($data_rd['tis_sgvgs']) ? format_integer($data_rd['tis_sgvgs']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_sgvgg" id="tis_sgvgg" value="<?php echo isset($data_rd['tis_sgvgg']) ? $data_rd['tis_sgvgg'] : 0 ?>">
												<div id="v_tis_sgvgg" style="margin-right:15px"><?php echo isset($data_rd['tis_sgvgg']) ? format_integer($data_rd['tis_sgvgg']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_sgvgp" id="tis_sgvgp" value="<?php echo isset($data_rd['tis_sgvgp']) ? $data_rd['tis_sgvgp'] : 0 ?>">
												<div id="v_tis_sgvgp" style="margin-right:15px"><?php echo isset($data_rd['tis_sgvgp']) ? format_integer($data_rd['tis_sgvgp']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_insac_ld" id="tis_insac_ld" value="<?php echo isset($data_rd['tis_insac_ld']) ? $data_rd['tis_insac_ld'] : 0 ?>">
												<div id="v_tis_insac_ld" style="margin-right:15px"><?php echo isset($data_rd['tis_insac_ld']) ? format_integer($data_rd['tis_insac_ld']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_insac_md" id="tis_insac_md" value="<?php echo isset($data_rd['sf_out_insac_md']) ? $data_rd['sf_out_insac_md'] : 0 ?>">
												<div id="v_tis_insac_md" style="margin-right:15px"><?php echo isset($data_rd['sf_out_insac_md']) ? format_integer($data_rd['sf_out_insac_md']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_insac_hd" id="tis_insac_hd" value="<?php echo isset($data_rd['tis_insac_hd']) ? $data_rd['tis_insac_hd'] : 0 ?>">
												<div id="v_tis_insac_hd" style="margin-right:15px"><?php echo isset($data_rd['tis_insac_hd']) ? format_integer($data_rd['tis_insac_hd']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_invin_ld" id="tis_invin_ld" value="<?php echo isset($data_rd['tis_invin_ld']) ? $data_rd['tis_invin_ld'] : 0 ?>">
												<div id="v_tis_invin_ld" style="margin-right:15px"><?php echo isset($data_rd['tis_invin_ld']) ? format_integer($data_rd['tis_invin_ld']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_invin_md" id="tis_invin_md" value="<?php echo isset($data_rd['tis_invin_md']) ? $data_rd['tis_invin_md'] : 0 ?>">
												<div id="v_tis_invin_md" style="margin-right:15px"><?php echo isset($data_rd['tis_invin_md']) ? format_integer($data_rd['tis_invin_md']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_invin_hd" id="tis_invin_hd" value="<?php echo isset($data_rd['tis_invin_hd']) ? $data_rd['tis_invin_hd'] : 0 ?>">
												<div id="v_tis_invin_hd" style="margin-right:15px"><?php echo isset($data_rd['tis_invin_hd']) ? format_integer($data_rd['tis_invin_hd']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_invga_ld" id="tis_invga_ld" value="<?php echo isset($data_rd['tis_invga_ld']) ? $data_rd['tis_invga_ld'] : 0 ?>">
												<div id="v_tis_invga_ld" style="margin-right:15px"><?php echo isset($data_rd['tis_invga_ld']) ? format_integer($data_rd['tis_invga_ld']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_invga_md" id="tis_invga_md" value="<?php echo isset($data_rd['tis_invga_md']) ? $data_rd['tis_invga_md'] : 0 ?>">
												<div id="v_tis_invga_md" style="margin-right:15px"><?php echo isset($data_rd['tis_invga_md']) ? format_integer($data_rd['tis_invga_md']) : 0 ?></div>
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="hidden" class="form-control" name="tis_invga_hd" id="tis_invga_hd" value="<?php echo isset($data_rd['tis_invga_hd']) ? $data_rd['tis_invga_hd'] : 0 ?>">
												<div id="v_tis_invga_hd" style="margin-right:15px"><?php echo isset($data_rd['tis_invga_hd']) ? format_integer($data_rd['tis_invga_hd']) : 0 ?></div>
											</div>
										</td>
										<td style="background-color:#7f7585">
											<div align="right">
												<strong>
													<input style="width:70px;height:26px;" type="hidden" class="form-control" name="total_tis" id="total_tis" value="<?php echo isset($data_rd['total_tis']) ? $data_rd['total_tis'] : 0 ?>">

													<div id="v_total_tis"><?php echo isset($data_rd['total_tis']) ? format_integer($data_rd['total_tis']) : 0 ?></div>
												</strong>
											</div>
										</td>
									</tr>
								</tbody>
							</table>

						</div> <!-- // End scrol-x-table -->

						<div class="row mt-2">
							<div class="col-md-12">
								<!--<span>Pesan : </span>--><span id="pesan" style="color: red;"></span>
							</div>
						</div>

						<div id="show_button" class="form-row">
							<div class="col-md-12 col-sm-12 col-xs-12 mt-3 mb-3 text-right">
								<button type="button" class="btn btn-sm btn-primary" id="btn-simpan">
									<i class="fal fa-save"></i>
									Simpan
								</button>
							</div>
						</div>

						<?php $show_button = isset($data_rd['show_button']) && $data_rd['show_button'] == 1 ? 1 : 0; ?>

						<?php if ($show_button == 1) { ?>

						<?php $hari_ini = date('l'); ?>

						<?php if (in_array($hari_ini, array('Monday','Tuesday','Wednesday', 'Thursday', 'Friday','Saturday','Sunday'))) { ?>
						<!--
						<div id="show_button" class="form-row">
							<div class="col-md-12 col-sm-12 col-xs-12 mt-3 mb-3 text-right">
								<button type="button" class="btn btn-sm btn-primary" id="btn-simpan">
									<i class="fal fa-save"></i>
									Simpan
								</button>
							</div>
						</div>
						-->
						<?php } ?>

						<?php } ?>

					</form>

					<script>
						$(document).ready(function()
						{
							var fmtInteger = {colorize:false, symbol: '', decimalSymbol: ',', digitGroupSymbol:'.', roundToDecimalPlace:0};

							$('.integer').blur(function(){
								if ($(this).val() == ''){
									$(this).val(0);
								}

								$(this).formatCurrency(fmtInteger);
							})

							$('.integer').focus(function(){
								if ($(this).val() == 0){
									$(this).val('');
								}

								$(this).toNumber(fmtInteger);
							});

							$('.integeronly').keydown(function (e) {
								var isModifierkeyPressed = (e.metaKey || e.ctrlKey || e.shiftKey);
								var isCursorMoveOrDeleteAction = ([46,8,37,38,39,40,9].indexOf(e.keyCode) != -1);
								var isNumKeyPressed = (e.keyCode >= 48 && e.keyCode <= 58) || (e.keyCode >=96 && e.keyCode <= 105);
								var vKey = 86, cKey = 67, aKey = 65;
								switch(true){
									case isCursorMoveOrDeleteAction:
									case isModifierkeyPressed == false && isNumKeyPressed:
									case (e.metaKey || e.ctrlKey) && ([vKey,cKey,aKey].indexOf(e.keyCode) != -1):
										break;
									default:
										e.preventDefault();
								}
							});

							$("#btn-simpan").click(function(){
								var total_td  = $('#total_td').val() ? parseInt($('#total_td').val()) : 0;
								var total_tds = $('#total_tds').val() ? parseInt($('#total_tds').val()) : 0;
								var total_tis = $('#total_tis').val() ? parseInt($('#total_tis').val()) : 0;

								var total_rekom = total_td;
								var total_dist = total_tds + total_tis;

								if (total_dist > total_rekom)
								{
									show_warning('Total distribusi tidak boleh melebihi total yang direkomendasikan');
								}
								else
								{
									// Start looding
									var looding = bootbox.dialog({
										size: 'small',
										closeButton: false,
										message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...</div>',
										className: 'modal-looding'
									});

									var $frm = $('#frmtabentry');

									$.ajax({
										url: $frm.attr('action'),
										type: 'post',
										dataType: 'json',
										data: $('#frmtabentry').serialize(),
										success: function(res, xhr){
											if (res.isSuccess)
											{
												show_success(res.message);

												$('#konten_tab_entry').load(
													GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_tab_entry/'
												);

												setTimeout(function(){
													bootbox.hideAll(); // Hide all bootbox
												}, 1500);

											}
											else
											{
												show_warning(res.message);
												setTimeout(function(){
													bootbox.hideAll(); // Hide all bootbox
												}, 1500)
											}
										}
									});
								}
							});
						});

						// Aksi input nilai kolom produk
						function keyup_aksi(channel, lokasi, produk){
							hitung_total_baris(channel, lokasi);
							hitung_total_kolom(channel, produk=produk);
							hitung_total();
							cek_limit(channel, lokasi, produk=produk);
						}

						// Menghitung total nilai deret baris
						function hitung_total_baris(channel, lokasi){
							var gabung = channel+'_'+lokasi;

							var sgprepaid = $('#'+gabung+'_sgprepaid').val() ? parseInt(accounting.unformat($('#'+gabung+'_sgprepaid').val())) : 0;
							var sgota = $('#'+gabung+'_sgota').val() ? parseInt(accounting.unformat($('#'+gabung+'_sgota').val())) : 0;
							var sgvin = $('#'+gabung+'_sgvin').val() ? parseInt(accounting.unformat($('#'+gabung+'_sgvin').val())) : 0;
							var sgvgs = $('#'+gabung+'_sgvgs').val() ? parseInt(accounting.unformat($('#'+gabung+'_sgvgs').val())) : 0;
							var sgvgg = $('#'+gabung+'_sgvgg').val() ? parseInt(accounting.unformat($('#'+gabung+'_sgvgg').val())) : 0;
							var sgvgp = $('#'+gabung+'_sgvgp').val() ? parseInt(accounting.unformat($('#'+gabung+'_sgvgp').val())) : 0;
							var insac_ld = $('#'+gabung+'_insac_ld').val() ? parseInt(accounting.unformat($('#'+gabung+'_insac_ld').val())) : 0;
							var insac_md = $('#'+gabung+'_insac_md').val() ? parseInt(accounting.unformat($('#'+gabung+'_insac_md').val())) : 0;
							var insac_hd = $('#'+gabung+'_insac_hd').val() ? parseInt(accounting.unformat($('#'+gabung+'_insac_hd').val())) : 0;
							var invin_ld = $('#'+gabung+'_invin_ld').val() ? parseInt(accounting.unformat($('#'+gabung+'_invin_ld').val())) : 0;
							var invin_md = $('#'+gabung+'_invin_md').val() ? parseInt(accounting.unformat($('#'+gabung+'_invin_md').val())) : 0;
							var invin_hd = $('#'+gabung+'_invin_hd').val() ? parseInt(accounting.unformat($('#'+gabung+'_invin_hd').val())) : 0;
							var invga_ld = $('#'+gabung+'_invga_ld').val() ? parseInt(accounting.unformat($('#'+gabung+'_invga_ld').val())) : 0;
							var invga_md = $('#'+gabung+'_invga_md').val() ? parseInt(accounting.unformat($('#'+gabung+'_invga_md').val())) : 0;
							var invga_hd = $('#'+gabung+'_invga_hd').val() ? parseInt(accounting.unformat($('#'+gabung+'_invga_hd').val())) : 0;

							var total = sgprepaid + sgota +
													sgvin +
													sgvgs + sgvgg + sgvgp +
													insac_ld + insac_md + insac_hd +
													invin_ld + invin_md + invin_hd +
													invga_ld + invga_md + invga_hd;

							$('#total_'+gabung).val(total);
							$('#v_total_'+gabung).text(accounting.formatNumber(total));
						}

						// Menghitung total nilai deret kolom
						function hitung_total_kolom(channel, produk){
							if (channel == 'ds')
							{
								var kolom_1 = $('#ds_sek_'+produk).val() ? parseInt(accounting.unformat($('#ds_sek_'+produk).val())) : 0;
								var kolom_2 = $('#ds_kam_'+produk).val() ? parseInt(accounting.unformat($('#ds_kam_'+produk).val())) : 0;
								var kolom_3 = $('#ds_fak_'+produk).val() ? parseInt(accounting.unformat($('#ds_fak_'+produk).val())) : 0;
								var total = kolom_1 + kolom_2 + kolom_3;

								$('#tds_'+produk).val(total);
								$('#v_tds_'+produk).text(accounting.formatNumber(total));
							}
							else if (channel == 'sf')
							{
								var kolom_4 = $('#sf_out_'+produk).val() ? parseInt(accounting.unformat($('#sf_out_'+produk).val())) : 0;
								var total = kolom_4;

								$('#tis_'+produk).val(total);
								$('#v_tis_'+produk).text(accounting.formatNumber(total));
							}
						}

						// Menghitung total keseluruhan
						function hitung_total(){
							// menghitung total keseluruhan dari total direct sales
							var total_tds = 0;
							var total_tis = 0;
							var list = ['sgprepaid', 'sgota', 'sgvin', 'sgvgs', 'sgvgg', 'sgvgp', 'insac_ld', 'insac_md', 'insac_hd', 'invin_ld', 'invin_md', 'invin_hd', 'invga_ld', 'invga_md', 'invga_hd'];

							for (x = 0; x < list.length; x++) // loop semua produk
							{
								total_tds += parseInt($('#tds_'+list[x]).val());
								total_tis += parseInt($('#tis_'+list[x]).val());
							}

							$('#total_tds').val(total_tds);
							$('#v_total_tds').text(accounting.formatNumber(total_tds));

							$('#total_tis').val(total_tis);
							$('#v_total_tis').text(accounting.formatNumber(total_tis));
						}

						function cek_limit(channel, lokasi, produk){
							var limit_td_sgprepaid = parseInt($('#td_sgprepaid').val()) ? parseInt($('#td_sgprepaid').val()) : 0;
							var limit_td_sgota = parseInt($('#td_sgota').val()) ? parseInt($('#td_sgota').val()) : 0;
							var limit_td_sgvin = parseInt($('#td_sgvin').val()) ? parseInt($('#td_sgvin').val()) : 0;
							var limit_td_sgvgs = parseInt($('#td_sgvgs').val()) ? parseInt($('#td_sgvgs').val()) : 0;
							var limit_td_sgvgg = parseInt($('#td_sgvgg').val()) ? parseInt($('#td_sgvgg').val()) : 0;
							var limit_td_sgvgp = parseInt($('#td_sgvgp').val()) ? parseInt($('#td_sgvgp').val()) : 0;
							var limit_td_insac_ld = parseInt($('#td_insac_ld').val()) ? parseInt($('#td_insac_ld').val()) : 0;
							var limit_td_insac_md = parseInt($('#td_insac_md').val()) ? parseInt($('#td_insac_md').val()) : 0;
							var limit_td_insac_hd = parseInt($('#td_insac_hd').val()) ? parseInt($('#td_insac_hd').val()) : 0;
							var limit_td_invin_ld = parseInt($('#td_invin_ld').val()) ? parseInt($('#td_invin_ld').val()) : 0;
							var limit_td_invin_md = parseInt($('#td_invin_md').val()) ? parseInt($('#td_invin_md').val()) : 0;
							var limit_td_invin_hd = parseInt($('#td_invin_hd').val()) ? parseInt($('#td_invin_hd').val()) : 0;
							var limit_td_invga_ld = parseInt($('#td_invga_ld').val()) ? parseInt($('#td_invga_ld').val()) : 0;
							var limit_td_invga_md = parseInt($('#td_invga_md').val()) ? parseInt($('#td_invga_md').val()) : 0;
							var limit_td_invga_hd = parseInt($('#td_invga_hd').val()) ? parseInt($('#td_invga_hd').val()) : 0;

							var limit_tds_sgprepaid = parseInt($('#tds_sgprepaid').val()) ? parseInt($('#tds_sgprepaid').val()) : 0;
							var limit_tds_sgota = parseInt($('#tds_sgota').val()) ? parseInt($('#tds_sgota').val()) : 0;
							var limit_tds_sgvin = parseInt($('#tds_sgvin').val()) ? parseInt($('#tds_sgvin').val()) : 0;
							var limit_tds_sgvgs = parseInt($('#tds_sgvgs').val()) ? parseInt($('#tds_sgvgs').val()) : 0;
							var limit_tds_sgvgg = parseInt($('#tds_sgvgg').val()) ? parseInt($('#tds_sgvgg').val()) : 0;
							var limit_tds_sgvgp = parseInt($('#tds_sgvgp').val()) ? parseInt($('#tds_sgvgp').val()) : 0;
							var limit_tds_insac_ld = parseInt($('#tds_insac_ld').val()) ? parseInt($('#tds_insac_ld').val()) : 0;
							var limit_tds_insac_md = parseInt($('#tds_insac_md').val()) ? parseInt($('#tds_insac_md').val()) : 0;
							var limit_tds_insac_hd = parseInt($('#tds_insac_hd').val()) ? parseInt($('#tds_insac_hd').val()) : 0;
							var limit_tds_invin_ld = parseInt($('#tds_invin_ld').val()) ? parseInt($('#tds_invin_ld').val()) : 0;
							var limit_tds_invin_md = parseInt($('#tds_invin_md').val()) ? parseInt($('#tds_invin_md').val()) : 0;
							var limit_tds_invin_hd = parseInt($('#tds_invin_hd').val()) ? parseInt($('#tds_invin_hd').val()) : 0;
							var limit_tds_invga_ld = parseInt($('#tds_invga_ld').val()) ? parseInt($('#tds_invga_ld').val()) : 0;
							var limit_tds_invga_md = parseInt($('#tds_invga_md').val()) ? parseInt($('#tds_invga_md').val()) : 0;
							var limit_tds_invga_hd = parseInt($('#tds_invga_hd').val()) ? parseInt($('#tds_invga_hd').val()) : 0;

							var limit_tis_sgprepaid = parseInt($('#tis_sgprepaid').val()) ? parseInt($('#tis_sgprepaid').val()) : 0;
							var limit_tis_sgota = parseInt($('#tis_sgota').val()) ? parseInt($('#tis_sgota').val()) : 0;
							var limit_tis_sgvin = parseInt($('#tis_sgvin').val()) ? parseInt($('#tis_sgvin').val()) : 0;
							var limit_tis_sgvgs = parseInt($('#tis_sgvgs').val()) ? parseInt($('#tis_sgvgs').val()) : 0;
							var limit_tis_sgvgg = parseInt($('#tis_sgvgg').val()) ? parseInt($('#tis_sgvgg').val()) : 0;
							var limit_tis_sgvgp = parseInt($('#tis_sgvgp').val()) ? parseInt($('#tis_sgvgp').val()) : 0;
							var limit_tis_insac_ld = parseInt($('#tis_insac_ld').val()) ? parseInt($('#tis_insac_ld').val()) : 0;
							var limit_tis_insac_md = parseInt($('#tis_insac_md').val()) ? parseInt($('#tis_insac_md').val()) : 0;
							var limit_tis_insac_hd = parseInt($('#tis_insac_hd').val()) ? parseInt($('#tis_insac_hd').val()) : 0;
							var limit_tis_invin_ld = parseInt($('#tis_invin_ld').val()) ? parseInt($('#tis_invin_ld').val()) : 0;
							var limit_tis_invin_md = parseInt($('#tis_invin_md').val()) ? parseInt($('#tis_invin_md').val()) : 0;
							var limit_tis_invin_hd = parseInt($('#tis_invin_hd').val()) ? parseInt($('#tis_invin_hd').val()) : 0;
							var limit_tis_invga_ld = parseInt($('#tis_invga_ld').val()) ? parseInt($('#tis_invga_ld').val()) : 0;
							var limit_tis_invga_md = parseInt($('#tis_invga_md').val()) ? parseInt($('#tis_invga_md').val()) : 0;
							var limit_tis_invga_hd = parseInt($('#tis_invga_hd').val()) ? parseInt($('#tis_invga_hd').val()) : 0;

							var pesan = '';
							var gabung = channel+'_'+lokasi+'_'+produk;

							if (produk == 'sgprepaid')
							{
								var batas = limit_td_sgprepaid;
								var pakai = limit_tds_sgprepaid + limit_tis_sgprepaid;

								var batas_rekom = limit_td_sgprepaid + limit_td_insac_ld + limit_td_insac_md + td_insac_hd;
								var pakai_dist = limit_tds_sgprepaid + limit_tis_sgprepaid +
																 limit_tds_insac_ld + limit_tds_insac_md + limit_tis_insac_hd +
																 limit_tis_insac_ld + limit_tis_insac_hd + limit_tis_insac_ld;

								if (pakai > batas)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total segel perdana prepaid yang akan didistribusikan ' +
													'tidak boleh besar dari total distribusi segel perdana prepaid ' +
													'yang direkomendasikan';

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
								else if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + pakai_dist + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + batas_rekom;

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'sgota')
							{
								var batas = limit_td_sgota;
								var pakai = limit_tds_sgota + limit_tis_sgota;

								if (pakai > batas)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total segel perdana ota yang akan didistribusikan ' +
													'tidak boleh besar dari total distribusi segel perdana ota ' +
													'yang direkomendasikan';

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'sgvin')
							{
								var batas = limit_td_sgvin;
								var pakai = limit_tds_sgvin + limit_tis_sgvin;

								var batas_rekom = limit_td_sgvin + limit_td_invin_ld + limit_td_invin_md + limit_td_invin_hd;
								var pakai_dist = limit_tds_sgvin + limit_tis_sgvin +
																 limit_tds_invin_ld + limit_tds_invin_md + limit_tis_invin_hd +
																 limit_tis_invin_ld + limit_tis_invin_md + limit_tis_invin_hd;

								if (pakai > batas)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total segel voucher internet yang akan didistribusikan ' +
													'tidak boleh besar dari total distribusi segel voucher internet ' +
													'yang direkomendasikan';

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
								else if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + accounting.formatNumber(pakai_dist) + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + accounting.formatNumber(batas_rekom);

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'sgvgs')
							{
								var batas = limit_td_sgvgs;
								var pakai = limit_tds_sgvgs + limit_tis_sgvgs;

								var batas_rekom = limit_td_sgvgs + limit_td_sgvgg + limit_td_sgvgp +
																	limit_td_invga_ld + limit_td_invga_md + limit_td_invga_hd;
								var pakai_dist = limit_tds_sgvgs + limit_tds_sgvgg + limit_tds_sgvgp +
																 limit_tds_invga_ld + limit_tds_invga_md + limit_tds_invga_hd +
																 limit_tis_invga_ld + limit_tis_invga_md + limit_tis_invga_hd;

								if (pakai > batas)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total segel voucher game silver yang akan didistribusikan ' +
													'tidak boleh besar dari total distribusi segel voucher game silver ' +
													'yang direkomendasikan';

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
								else if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + accounting.formatNumber(pakai_dist) + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + accounting.formatNumber(batas_rekom);

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'sgvgg')
							{
								var batas = limit_td_sgvgg;
								var pakai = limit_tds_sgvgg + limit_tis_sgvgg;

								var batas_rekom = limit_td_sgvgs + limit_td_sgvgg + limit_td_sgvgp +
																	limit_td_invga_ld + limit_td_invga_md + limit_td_invga_hd;
								var pakai_dist = limit_tds_sgvgs + limit_tds_sgvgg + limit_tds_sgvgp +
																 limit_tds_invga_ld + limit_tds_invga_md + limit_tds_invga_hd +
																 limit_tis_invga_ld + limit_tis_invga_md + limit_tis_invga_hd;

								if (pakai > batas)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total segel voucher game gold yang akan didistribusikan ' +
													'tidak boleh besar dari total distribusi segel voucher game gold ' +
													'yang direkomendasikan';

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
								else if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + accounting.formatNumber(pakai_dist) + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + accounting.formatNumber(batas_rekom);

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'sgvgp')
							{
								var batas = limit_td_sgvgp;
								var pakai = limit_tds_sgvgp + limit_tis_sgvgp;

								var batas_rekom = limit_td_sgvgs + limit_td_sgvgg + limit_td_sgvgp +
																	limit_td_invga_ld + limit_td_invga_md + limit_td_invga_hd;
								var pakai_dist = limit_tds_sgvgs + limit_tds_sgvgg + limit_tds_sgvgp +
																 limit_tds_invga_ld + limit_tds_invga_md + limit_tds_invga_hd +
																 limit_tis_invga_ld + limit_tis_invga_md + limit_tis_invga_hd;

								if (pakai > batas)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total segel voucher game platinum yang akan didistribusikan ' +
													'tidak boleh besar dari total distribusi segel voucher game platinum ' +
													'yang direkomendasikan';

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
								else if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + accounting.formatNumber(pakai_dist) + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + accounting.formatNumber(batas_rekom);

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'insac_ld')
							{
								var batas_rekom = limit_td_sgprepaid + limit_td_insac_ld + limit_td_insac_md + limit_td_insac_hd;
								var pakai_dist = limit_tds_sgprepaid + limit_tis_sgprepaid +
																 limit_tds_insac_ld + limit_tds_insac_md + limit_tis_insac_hd +
																 limit_tis_insac_ld + limit_tis_insac_hd + limit_tis_insac_ld;

								if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + pakai_dist + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + batas_rekom;

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'insac_md')
							{
								var batas_rekom = limit_td_sgprepaid + limit_td_insac_ld + limit_td_insac_md + limit_td_insac_hd;
								var pakai_dist = limit_tds_sgprepaid + limit_tis_sgprepaid +
																 limit_tds_insac_ld + limit_tds_insac_md + limit_tis_insac_hd +
																 limit_tis_insac_ld + limit_tis_insac_hd + limit_tis_insac_ld;

								if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + pakai_dist + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + batas_rekom;

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'insac_hd')
							{
								var batas_rekom = limit_td_sgprepaid + limit_td_insac_ld + limit_td_insac_md + limit_td_insac_hd;
								var pakai_dist = limit_tds_sgprepaid + limit_tis_sgprepaid +
																 limit_tds_insac_ld + limit_tds_insac_md + limit_tis_insac_hd +
																 limit_tis_insac_ld + limit_tis_insac_hd + limit_tis_insac_ld;

								if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + pakai_dist + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + batas_rekom;

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'invin_ld')
							{
								var batas_rekom = limit_td_sgvin + limit_td_invin_ld + limit_td_invin_md + limit_td_invin_hd;
								var pakai_dist = limit_tds_sgvin + limit_tis_sgvin +
																 limit_tds_invin_ld + limit_tds_invin_md + limit_tis_invin_hd +
																 limit_tis_invin_ld + limit_tis_invin_md + limit_tis_invin_hd;

								if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + accounting.formatNumber(pakai_dist) + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + accounting.formatNumber(batas_rekom);

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'invin_md')
							{
								var batas_rekom = limit_td_sgvin + limit_td_invin_ld + limit_td_invin_md + limit_td_invin_hd;
								var pakai_dist = limit_tds_sgvin + limit_tis_sgvin +
																 limit_tds_invin_ld + limit_tds_invin_md + limit_tis_invin_hd +
																 limit_tis_invin_ld + limit_tis_invin_md + limit_tis_invin_hd;

								if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + accounting.formatNumber(pakai_dist) + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + accounting.formatNumber(batas_rekom);

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'invin_hd')
							{
								var batas_rekom = limit_td_sgvin + limit_td_invin_ld + limit_td_invin_md + limit_td_invin_hd;
								var pakai_dist = limit_tds_sgvin + limit_tis_sgvin +
																 limit_tds_invin_ld + limit_tds_invin_md + limit_tis_invin_hd +
																 limit_tis_invin_ld + limit_tis_invin_md + limit_tis_invin_hd;

								if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + accounting.formatNumber(pakai_dist) + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + accounting.formatNumber(batas_rekom);

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'invga_ld')
							{
								var batas_rekom = limit_td_sgvgs + limit_td_sgvgg + limit_td_sgvgp +
																	limit_td_invga_ld + limit_td_invga_md + limit_td_invga_hd;
								var pakai_dist = limit_tds_sgvgs + limit_tds_sgvgg + limit_tds_sgvgp +
																 limit_tds_invga_ld + limit_tds_invga_md + limit_tds_invga_hd +
																 limit_tis_invga_ld + limit_tis_invga_md + limit_tis_invga_hd;

								if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + accounting.formatNumber(pakai_dist) + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + accounting.formatNumber(batas_rekom);

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'invga_md')
							{
								var batas_rekom = limit_td_sgvgs + limit_td_sgvgg + limit_td_sgvgp +
																	limit_td_invga_ld + limit_td_invga_md + limit_td_invga_hd;
								var pakai_dist = limit_tds_sgvgs + limit_tds_sgvgg + limit_tds_sgvgp +
																 limit_tds_invga_ld + limit_tds_invga_md + limit_tds_invga_hd +
																 limit_tis_invga_ld + limit_tis_invga_md + limit_tis_invga_hd;

								if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + accounting.formatNumber(pakai_dist) + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + accounting.formatNumber(batas_rekom);

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}
							else if (produk == 'invga_hd')
							{
								var batas_rekom = limit_td_sgvgs + limit_td_sgvgg + limit_td_sgvgp +
																	limit_td_invga_ld + limit_td_invga_md + limit_td_invga_hd;
								var pakai_dist = limit_tds_sgvgs + limit_tds_sgvgg + limit_tds_sgvgp +
																 limit_tds_invga_ld + limit_tds_invga_md + limit_tds_invga_hd +
																 limit_tis_invga_ld + limit_tis_invga_md + limit_tis_invga_hd;

								if (pakai_dist > batas_rekom)
								{
									$('#'+gabung).val(0);
									$('#'+gabung).focus();

									pesan = 'Total distribusi : ' + accounting.formatNumber(pakai_dist) + ' ' +
													'tidak boleh lebih besar dari total rekomendasi : ' + accounting.formatNumber(batas_rekom);

									// Hitung ulang total
									hitung_total_baris(channel, lokasi);
									hitung_total_kolom(channel, produk=produk);
								}
							}

							$('#pesan').text(pesan);
						}
					</script>