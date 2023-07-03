					<style>
						div.scrol-x-table {
							width: 100%;
							overflow-x: scroll;
						}
					</style>

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

					<p>&nbsp;<p>

					<table id="dt_table_2" class="table table-bordered m-0 table-sm table-striped">
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
								<td rowspan="3"><div style="margin-top:40px;width:150px;"><strong>DIRECT SALES</strong></div></td>
								<td><div style="width:90px;"><strong>SEKOLAH</strong></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_sgprepaid']) ? format_integer($data['ds_sek_sgprepaid']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_sgota']) ? format_integer($data['ds_sek_sgota']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_sgvin']) ? format_integer($data['ds_sek_sgvin']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_sgvgs']) ? format_integer($data['ds_sek_sgvgs']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_sgvgg']) ? format_integer($data['ds_sek_sgvgg']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_sgvgp']) ? format_integer($data['ds_sek_sgvgp']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_insac_ld']) ? format_integer($data['ds_sek_insac_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_insac_md']) ? format_integer($data['ds_sek_insac_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_insac_hd']) ? format_integer($data['ds_sek_insac_hd']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_invin_ld']) ? format_integer($data['ds_sek_invin_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_invin_md']) ? format_integer($data['ds_sek_invin_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_invin_hd']) ? format_integer($data['ds_sek_invin_hd']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_invga_ld']) ? format_integer($data['ds_sek_invga_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_invga_md']) ? format_integer($data['ds_sek_invga_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_sek_invga_hd']) ? format_integer($data['ds_sek_invga_hd']) : 0 ?></div></td>
								<td style="background-color:#f2f2f2"><div align="right"><strong><?php echo isset($data['total_ds_sek']) ? format_integer($data['total_ds_sek']) : 0 ?></strong></div></td>
							</tr>
							<tr>
								<td><strong>KAMPUS</strong></td>
								<td><div align="right"><?php echo isset($data['ds_kam_sgprepaid']) ? format_integer($data['ds_kam_sgprepaid']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_sgota']) ? format_integer($data['ds_kam_sgota']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_sgvin']) ? format_integer($data['ds_kam_sgvin']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_sgvgs']) ? format_integer($data['ds_kam_sgvgs']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_sgvgg']) ? format_integer($data['ds_kam_sgvgg']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_sgvgp']) ? format_integer($data['ds_kam_sgvgp']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_insac_ld']) ? format_integer($data['ds_kam_insac_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_insac_md']) ? format_integer($data['ds_kam_insac_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_insac_hd']) ? format_integer($data['ds_kam_insac_hd']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_invin_ld']) ? format_integer($data['ds_kam_invin_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_invin_md']) ? format_integer($data['ds_kam_invin_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_invin_hd']) ? format_integer($data['ds_kam_invin_hd']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_invga_ld']) ? format_integer($data['ds_kam_invga_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_invga_md']) ? format_integer($data['ds_kam_invga_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_kam_invga_hd']) ? format_integer($data['ds_kam_invga_hd']) : 0 ?></div></td>
								<td style="background-color:#f2f2f2"><div align="right"><strong><?php echo isset($data['total_ds_kam']) ? format_integer($data['total_ds_kam']) : 0 ?></strong></div></td>
							</tr>
							<tr>
								<td><strong>FAKULTAS</strong></td>
								<td><div align="right"><?php echo isset($data['ds_fak_sgprepaid']) ? format_integer($data['ds_fak_sgprepaid']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_sgota']) ? format_integer($data['ds_fak_sgota']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_sgvin']) ? format_integer($data['ds_fak_sgvin']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_sgvgs']) ? format_integer($data['ds_fak_sgvgs']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_sgvgg']) ? format_integer($data['ds_fak_sgvgg']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_sgvgp']) ? format_integer($data['ds_fak_sgvgp']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_insac_ld']) ? format_integer($data['ds_fak_insac_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_insac_md']) ? format_integer($data['ds_fak_insac_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_insac_hd']) ? format_integer($data['ds_fak_insac_hd']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_invin_ld']) ? format_integer($data['ds_fak_invin_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_invin_md']) ? format_integer($data['ds_fak_invin_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_invin_hd']) ? format_integer($data['ds_fak_invin_hd']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_invga_ld']) ? format_integer($data['ds_fak_invga_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_invga_md']) ? format_integer($data['ds_fak_invga_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['ds_fak_invga_hd']) ? format_integer($data['ds_fak_invga_hd']) : 0 ?></div></td>
								<td style="background-color:#f2f2f2"><div align="right"><strong><?php echo isset($data['total_ds_fak']) ? format_integer($data['total_ds_fak']) : 0 ?></strong></div></td>
							</tr>
							<tr style="background-color:#f2f2f2">
								<td colspan="2"><strong>TOTAL DIRECT SALES</strong></td>
								<td><div align="right"><strong><?php echo isset($data['tds_sgprepaid']) ? format_integer($data['tds_sgprepaid']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_sgota']) ? format_integer($data['tds_sgota']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_sgvin']) ? format_integer($data['tds_sgvin']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_sgvgs']) ? format_integer($data['tds_sgvgs']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_sgvgg']) ? format_integer($data['tds_sgvgg']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_sgvgp']) ? format_integer($data['tds_sgvgp']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_insac_ld']) ? format_integer($data['tds_insac_ld']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_insac_md']) ? format_integer($data['tds_insac_md']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_insac_hd']) ? format_integer($data['tds_insac_hd']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_invin_ld']) ? format_integer($data['tds_invin_ld']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_invin_md']) ? format_integer($data['tds_invin_md']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_invin_hd']) ? format_integer($data['tds_invin_hd']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_invga_ld']) ? format_integer($data['tds_invga_ld']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_invga_md']) ? format_integer($data['tds_invga_md']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tds_invga_hd']) ? format_integer($data['tds_invga_hd']) : 0 ?></strong></div></td>
								<td style="background-color:#f2f2f2"><div align="right"><strong><?php echo isset($data['total_tds']) ? format_integer($data['total_tds']) : 0 ?></strong></div></td>
							</tr>
							<tr>
								<td><strong>SALES FORCE</strong></td>
								<td><strong>OUTLET</strong></td>
								<td><div align="right"><?php echo isset($data['sf_out_sgprepaid']) ? format_integer($data['sf_out_sgprepaid']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_sgota']) ? format_integer($data['sf_out_sgota']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_sgvin']) ? format_integer($data['sf_out_sgvin']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_sgvgs']) ? format_integer($data['sf_out_sgvgs']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_sgvgg']) ? format_integer($data['sf_out_sgvgg']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_sgvgp']) ? format_integer($data['sf_out_sgvgp']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_insac_ld']) ? format_integer($data['sf_out_insac_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_insac_md']) ? format_integer($data['sf_out_insac_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_insac_hd']) ? format_integer($data['sf_out_insac_hd']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_invin_ld']) ? format_integer($data['sf_out_invin_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_invin_md']) ? format_integer($data['sf_out_invin_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_invin_hd']) ? format_integer($data['sf_out_invin_hd']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_invga_ld']) ? format_integer($data['sf_out_invga_ld']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_invga_md']) ? format_integer($data['sf_out_invga_md']) : 0 ?></div></td>
								<td><div align="right"><?php echo isset($data['sf_out_invga_hd']) ? format_integer($data['sf_out_invga_hd']) : 0 ?></div></td>
								<td style="background-color:#f2f2f2"><div align="right"><strong><?php echo isset($data['total_sf_out']) ? format_integer($data['total_sf_out']) : 0 ?></strong></div></td>
							</tr>
							<tr style="background-color:#f2f2f2">
								<td colspan="2"><strong>TOTAL INDIRECT SALES</strong></td>
								<td><div align="right"><strong><?php echo isset($data['tis_sgprepaid']) ? format_integer($data['tis_sgprepaid']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_sgota']) ? format_integer($data['tis_sgota']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_sgvin']) ? format_integer($data['tis_sgvin']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_sgvgs']) ? format_integer($data['tis_sgvgs']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_sgvgg']) ? format_integer($data['tis_sgvgg']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_sgvgp']) ? format_integer($data['tis_sgvgp']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_insac_ld']) ? format_integer($data['tis_insac_ld']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_insac_md']) ? format_integer($data['tis_insac_md']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_insac_hd']) ? format_integer($data['tis_insac_hd']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_invin_ld']) ? format_integer($data['tis_invin_ld']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_invin_md']) ? format_integer($data['tis_invin_md']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_invin_hd']) ? format_integer($data['tis_invin_hd']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_invga_ld']) ? format_integer($data['tis_invga_ld']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_invga_md']) ? format_integer($data['tis_invga_md']) : 0 ?></strong></div></td>
								<td><div align="right"><strong><?php echo isset($data['tis_invga_hd']) ? format_integer($data['tis_invga_hd']) : 0 ?></strong></div></td>
								<td style="background-color:#f2f2f2"><div align="right"><strong><?php echo isset($data['total_tis']) ? format_integer($data['total_tis']) : 0 ?></strong></div></td>
							</tr>
						</tbody>
					</table>