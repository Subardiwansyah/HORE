					<div class="panel-content">
						<div class="row">
							<div class="col-md-12">

								<div class="card mb-3">
									<div class="card-body">

										<table width="100%" border="0">
											<tr>
												<td><div align="center"><h4>PT. Selular Media Infotama</h4></div></td>
											</tr>
											<tr>
												<td><div align="center"><strong>NOTA PEMBAYARAN</strong></div></td>
											</tr>
											<tr>
												<td><div align="center"><strong><?php echo isset($data_penjualan['no_nota']) ? $data_penjualan['no_nota'] : ''; ?></strong></div></td>
											</tr>
										</table>

										<hr>

										<table width="100%" border="0">
											<tr>
												<td>Nama Petugas</td>
												<td>&nbsp;</td>
												<td><?php echo isset($data_penjualan['nama_sales']) ? $data_penjualan['nama_sales'] : ''; ?></td>
											</tr>
											<tr>
												<td>Tanggal</td>
												<td>&nbsp;</td>
												<td><?php echo isset($data_penjualan['tanggal']) ? $data_penjualan['tanggal'] : ''; ?></td>
											</tr>
											<tr>
												<td>Lokasi</td>
												<td>&nbsp;</td>
												<td><?php echo isset($data_penjualan['nama_lokasi']) ? $data_penjualan['nama_lokasi'] : ''; ?></td>
											</tr>
											<tr>
												<td>Nama Pembeli</td>
												<td>&nbsp;</td>
												<td><?php echo isset($data_penjualan['nama_pembeli']) ? $data_penjualan['nama_pembeli'] : ''; ?></td>
											</tr>
											<tr>
												<td>Telp Pembeli</td>
												<td>&nbsp;</td>
												<td><?php echo isset($data_penjualan['no_hp_pembeli']) ? $data_penjualan['no_hp_pembeli'] : ''; ?></td>
											</tr>
											<tr>
												<td>Status</td>
												<td>&nbsp;</td>
												<td><?php echo isset($data_penjualan['pembayaran']) ? $data_penjualan['pembayaran'] : ''; ?></td>
											</tr>
										</table>

										<hr>

										<table width="100%" border="0">
											<?php $total = 0; ?>
											<?php foreach($list_penjualan as $penjualan) { ?>
											<tr>
												<td><strong><?php echo $penjualan->nama_produk; ?></strong></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td><?php echo format_currency($penjualan->harga_jual); ?> x <?php echo format_integer($penjualan->jml_jual); ?></td>
												<td>&nbsp;</td>
												<td><div align="right">Rp. <?php echo format_currency($penjualan->total); ?></div></td>
											</tr>
											<?php $total = $total + $penjualan->total; ?>
											<?php } ?>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td><strong>Top Up Link Aja (L)</strong></td>
												<td>&nbsp;</td>
												<td><div align="right">Rp. <?php echo isset($data_penjualan['link_aja']) ? format_currency($data_penjualan['link_aja']) : '0,00'; ?></div></td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<?php $total = $total + (isset($data_penjualan['link_aja']) ? $data_penjualan['link_aja'] : 0); ?>
											<tr>
												<td><strong>Total</strong></td>
												<td>&nbsp;</td>
												<td><div align="right"><strong>Rp. <?php echo format_currency($total); ?></strong></div></td>
											</tr>
										</table>

									</div>
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