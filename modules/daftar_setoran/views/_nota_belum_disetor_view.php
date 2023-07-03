					<div class="panel-content mb-3">
						<div class="row">
							<div class="col-md-12">

								<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative text-right">
									<i class="fal fa-user text-danger"></i>&nbsp;
									Petugas : <?php echo isset($data_sales['nama_sales']) ? $data_sales['nama_sales'] : '' ?>
								</h5>

								<table id="dt_xx" class="table table-bordered m-0 table-sm table-striped" style="width:100%">
									<thead class="bg-primary-100">
										<tr>
											<th>No</th>
											<th>Tanggal</th>
											<th>Pembeli</th>
											<th>Status</th>
											<th>Total</th>
											<th>Jumlah Setor</th>
											<th>Belum Setor</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; ?>
										<?php foreach($list_nota as $nota) { ?>
										<tr>
											<td><div align="right" style="width:40px"><?php echo $no; ?></div></th>
											<td><?php echo isset($nota->tgl_transaksi) ? format_date($nota->tgl_transaksi) : ''; ?></td>
											<td><div style="width:120px"><?php echo isset($nota->nama_pembeli) ? $nota->nama_pembeli : ''; ?></div></td>
											<td><?php echo isset($nota->pembayaran) ? $nota->pembayaran : ''; ?></td>
											<td><div align="right" style="width:100px"><?php echo isset($nota->total) ? format_currency($nota->total) : ''; ?></div></td>
											<td><div align="right" style="width:100px"><?php echo isset($nota->setoran) ? format_currency($nota->setoran) : ''; ?></div></td>
											<td><div align="right" style="width:100px"><?php echo isset($nota->sisa) ? format_currency($nota->sisa) : ''; ?></div></td>
										</tr>
										<?php $no++; ?>
										<?php } ?>
									</tbody>
								</table>

							</div>
						</div>
						
					</div>
					<div class="panel-content py-2 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right">
						<button type="button" class="btn btn-sm btn-primary" id="btn-xbatal"><i class="fal fa-times"></i> Tutup</button>
					</div>

					<script>
						$(document).ready(function()
						{
							$('#dt_xx').removeAttr('width').DataTable({
								responsive: true,
								paging: true,
								pageLength: 5,
								ordering: false,
								bInfo: true,
								bFilter: true,
								bLengthChange : false
							});

							$('#btn-xbatal').click(function(){
								bootbox.hideAll(); // Hide all bootbox
							});
						});
					</script>