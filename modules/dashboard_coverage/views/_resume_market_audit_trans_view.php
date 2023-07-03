					<div class="panel-content">


						<div class="card mb-3">
							<div class="card-body">
								<div class="p-4 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
									<div class="">

										<?php
											if ($jenis_share == 'BELANJA') { $share = 'BELANJA SHARE'; }
											if ($jenis_share == 'SALES_BROADBAND') { $share = 'SALES BROADBAND SHARE'; }
											if ($jenis_share == 'VOUCHER_FISIK') { $share = 'VOUCHER FISIK SHARE'; }

											if ($kategori == '') { $x_kategori = 'TRANSAKSI'; } else { $x_kategori = $kategori; }
										?>

										<?php echo $share; ?>

									</div>
									<i class="fal fa-tag position-absolute pos-right pos-bottom opacity-25  mb-n1 mr-n7" style="font-size: 4rem;"></i>
								</div>

								<div class="table-responsive">
									<table id="dt_table_1" class="table table-bordered m-0 table-sm table-striped">
										<thead>
											<tr>
												<td colspan="8" style="background-color:#7b737c; color:#FFFFFF;"><div align="center"><strong><?php echo $x_kategori; ?></strong></div></td>
											</tr>
											<tr>
												<td style="background-color:#DD0000; color:#FFFFFF; width:60px;"><div align="center"><strong>TELKOMSEL</strong></div></td>
												<td style="background-color:#fede00; color:#000000; width:60px;"><div align="center"><strong>ISAT</strong></div></td>
												<td style="background-color:#28166f; color:#FFFFFF; width:60px;"><div align="center"><strong>XL</strong></div></td>
												<td style="background-color:#000000; color:#FFFFFF; width:60px;"><div align="center"><strong>TRI</strong></div></td>
												<td style="background-color:#d91d2b; color:#FFFFFF; width:60px;"><div align="center"><strong>SMARTFREN</strong></div></td>
												<td style="background-color:#ed008c; color:#FFFFFF; width:60px;"><div align="center"><strong>AXIS</strong></div></td>
												<td style="background-color:#999999; color:#FFFFFF; width:60px;"><div align="center"><strong>OTHER</strong></div></td>
												<td style="background-color:#f89912; color:#FFFFFF; width:60px;"><div align="center"><strong>TOTAL</strong></div></td>
											</tr>
										</thead>
										<tbody>

											<?php
												if ($kategori == '')
												{
													$total = $data['telkomsel'] + $data['isat'] + $data['xl'] + $data['tri'] + $data['smartfren'] + $data['axis'] +	$data['other'];
												}
												else
												{
													$total = $data['telkomsel_'.strtolower($kategori)] + $data['isat_'.strtolower($kategori)] + $data['xl_'.strtolower($kategori)] + $data['tri_'.strtolower($kategori)] + $data['smartfren_'.strtolower($kategori)] + $data['axis_'.strtolower($kategori)] +	$data['other_'.strtolower($kategori)];
												}

												if ($total > 0) { $total = $total; } else { $total = 1; }
											?>

											<?php if ($kategori == '') { ?>
											<tr>
												<td><div align="right"><?php echo format_currency(($data['telkomsel'] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['isat'] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['xl'] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['tri'] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['smartfren'] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['axis'] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['other'] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($total / $total) * 100); ?> %</div></td>
											</tr>
											<?php } else { ?>
											<tr>
												<td><div align="right"><?php echo format_currency(($data['telkomsel_'.strtolower($kategori)] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['isat_'.strtolower($kategori)] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['xl_'.strtolower($kategori)] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['tri_'.strtolower($kategori)] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['smartfren_'.strtolower($kategori)] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['axis_'.strtolower($kategori)] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($data['other_'.strtolower($kategori)] / $total) * 100); ?> %</div></td>
												<td><div align="right"><?php echo format_currency(($total / $total) * 100); ?> %</div></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>

					<div class="panel-content py-3 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right">
						<button type="button" class="btn btn-sm btn-primary" id="btn-xbatal"><i class="fal fa-times"></i> Tutup</button>
					</div>

					<script>
						$(document).ready(function()
						{
							$('#btn-xbatal').click(function(){
								bootbox.hideAll(); // Hide all bootbox
							});
						});
					</script>