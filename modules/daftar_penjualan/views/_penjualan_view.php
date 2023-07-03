				<div class="card mb-3">
					<div class="card-body">

						<form id="frm_setoran" method="post" action="<?php echo base_url().$modul; ?>/proses">
							<div class="row">
								<div class="col-md-12">
									<table id="dt_table" class="table table-bordered table-sm table-striped" style="width:100%">
										<thead class="bg-primary-100">
											<tr class="bg-primary-100">
												<th style="padding-bottom:15px" class="bg-primary-100">Aksi</th>
												<th style="padding-bottom:15px" class="bg-primary-100">Nota</th>
												<th style="padding-bottom:15px">Status</th>
												<th>Total Perdana<br>(Rp)</th>
												<th>Total Link Aja<br>(Rp)</th>
												<th>Total<br>Penjualan</th>
												<th>Setor<br>Penjualan</th>
												<th style="padding-bottom:15px">Status Setor</th>
											</tr>
										</thead>
										<tbody>
											<?php $start = 0; ?>
											<?php $total_data = count($daftar_penjualan); ?>
											<?php foreach($daftar_penjualan as $penjualan) { ?>
											<tr>
												<td style="width:90px">
													<div align="center" >
														<button onClick="lihat_nota('<?php echo $penjualan->no_nota; ?>')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat Nota">
															<i class="fal fa-file-alt"></i>
														</button>
														<button onClick="lihat_penjualan('<?php echo $penjualan->no_nota; ?>')" type="button" class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" title="Lihat Penjualan">
															<i class="fal fa-shopping-cart"></i>
														</button>
													</div>
												</td>
												<td style="width:120px"><?php echo $penjualan->no_nota; ?></td>
												<td style="width:100px"><?php echo $penjualan->pembayaran; ?></td>
												<td style="width:110px"><div align="right"><?php echo format_currency($penjualan->total_perdana); ?></div></td>
												<td style="width:110px"><div align="right"><?php echo format_currency($penjualan->total_linkaja); ?></div></td>
												<td style="width:110px"><div align="right"><?php echo format_currency($penjualan->total_penjualan); ?></div></td>
												<td style="width:110px">
													<div align="center">
														<?php
														if ($penjualan->setoran > 0) { $setoran = format_currency($penjualan->setoran); }
														if ($penjualan->setoran == 0) { $setoran = format_currency($penjualan->total_penjualan); }
														?>

														<input type="hidden" name="id_<?php echo $start; ?>" value="<?php echo isset($penjualan->no_nota) ? $penjualan->no_nota : 0; ?>">

														<input style="width:110px;height:30px;" type="text" class="form-control form-control-sm currency currencyonly text-right setoran" name="setoran_<?php echo $start; ?>" id="setoran_<?php echo $start; ?>" autocomplete="off" value="<?php echo $setoran ?>">
													</div>
												</td>
												<td>
													<?php
													if ($penjualan->setoran >= $penjualan->total_penjualan)
													{
														echo '<div align="center"><span class="badge badge-success badge-pill">completed</span></div>';
													}
													else
													{
														echo '<div align="center"><span class="badge badge-warning badge-pill">not completed</span></div>';
													}
													?>

												</td>
											</tr>
											<?php $start++; ?>
											<?php } ?>
										</tbody>
									</table>

									<input type="hidden" class="form-control form-control-sm" name="total_data" value="<?php echo $total_data-1; ?>">

									<div class="form-row mt-3">
										<div class="col-md-12 col-sm-12 col-xs-12 mt-2 mb-3 text-right">
											<button type="button" class="btn btn-sm btn-primary" id="btn-simpan">
												<i class="fal fa-save"></i>
												Simpan
											</button>
										</div>
									</div>
								</div>
							</div>
						</form>

					</div>
				</div>

				<script>
					$(document).ready(function(){
						var fmtCurrency = {colorize:false, symbol: '', decimalSymbol: ',', digitGroupSymbol:'.', roundToDecimalPlace:2};

						$('.currency').blur(function(){
							if ($(this).val() == ''){
								$(this).val('0,00');
							}

							$(this).formatCurrency(fmtCurrency);
						})

						$('.currency').focus(function(){
							if ($(this).val() == 0 || $(this).val() == '0,00' || $(this).val() <= 0){
								$(this).val('');
							}

							$(this).toNumber(fmtCurrency);
						});

						$('.currencyonly').keydown(function (e) {
							var isModifierkeyPressed = (e.metaKey || e.ctrlKey || e.shiftKey);
							var isCursorMoveOrDeleteAction = ([46,8,37,38,39,40,188,9].indexOf(e.keyCode) != -1);
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

						var table = $('#dt_table').removeAttr('width').DataTable({
							fixedHeader: true,
							colReorder: true,
							scrollX: true,
							scrollCollapse: true,
							// fixedColumns: {
								// leftColumns: 2
							// },
							ordering: false,
							processing: true,
							serverSide: false,
							bFilter: false,
							paging: false,
						});

						$("#btn-simpan").click(function(){
								// Start looding
							var looding = bootbox.dialog({
								size: 'small',
								closeButton: false,
								message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...</div>',
								className: 'modal-looding'
							});

							var frm = $('#frm_setoran');

							$.ajax({
								url: frm.attr('action'),
								type: 'post',
								dataType: 'json',
								data: $('#frm_setoran').serialize(),
								success: function(res, xhr){
									if (res.isSuccess)
									{
										show_success(res.message);

										var id_sales = '<?php echo $id_sales; ?>';
										var tgl = '<?php echo format_date($tgl); ?>';
										tgl = tgl.replace('/', '-').replace('/', '-');

										$('#konten_penjualan').load(
											GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_penjualan/' +
											id_sales + '/' +
											tgl + '/'
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
						});
					});
				</script>