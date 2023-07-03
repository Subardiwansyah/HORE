					<!--
					<style>
						div.scrol-x-table {
							width: 100%;
							overflow-x: scroll;
						}
					</style>
					-->

					<form id="frmsf" method="post" action="<?php echo base_url().$modul; ?>/proses_ds">

						<div class="scrol-x-table">

							<table id="dt_table_ds" class="table table-bordered m-0 table-sm">
								<thead class="bg-primary-100">
									<tr>
										<td class="bg-primary-100" rowspan="3"><div align="center" style="margin-top:40px"><strong>NO</strong></div></td>
										<td class="bg-primary-100" rowspan="3"><div align="center" style="margin-top:40px;width:180px;"><strong>TAP/DIRECT SALES</strong></div></td>
										<td colspan="6"><div align="center"><strong>SEGEL</strong></div></td>
										<td colspan="3"><div align="center"><strong>SA</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER INTERNET</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER GAME</strong></div></td>
										<td rowspan="3"><div align="center" style="margin-top:40px"><strong>NEW RS <br>PER HARI</strong></div></td>
										<td rowspan="3"><div align="center" style="margin-top:40px"><strong>LIMIT <br>LINK AJA</strong></div></td>
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
										<td><div align="center"><strong>OTA</strong></div></td>
										<td><div align="center"><strong>SILVER</strong></div></td>
										<td><div align="center"><strong>GOLD</strong></div></td>
										<td><div align="center"><strong>PLATINUM</strong></div></td>
									</tr>
								</thead>
								<tbody>
									<?php
										$start = 0;
										$no = 0;
										$total_sgprepaid = 0;
										$total_sgota = 0;
										$total_sgvin = 0;
										$total_sgvgs = 0;
										$total_sgvgg = 0;
										$total_sgvgp = 0;
										$total_insac_ld = 0;
										$total_insac_md = 0;
										$total_insac_hd = 0;
										$total_invin_ld = 0;
										$total_invin_md = 0;
										$total_invin_hd = 0;
										$total_invga_ld = 0;
										$total_invga_md = 0;
										$total_invga_hd = 0;
										$total_new_rs = 0;
										$total_limit_link_aja = 0;
										$is_simpan = 0;
									?>

									<?php $total_data_ds = count($list_target_sales_ds); ?>

									<?php foreach($list_target_sales_ds as $target_sales_ds) { ?>

									<input type="hidden" class="form-control form-control-sm" name="id_rt_<?php echo $start; ?>" value="<?php echo isset($target_sales_ds->id_rekomendasi) ? $target_sales_ds->id_rekomendasi : 0; ?>">

									<?php $is_simpan = $is_simpan; ?>

									<?php if ($target_sales_ds->x_parent == 0) { ?>

									<tr>
										<td style="background-color:#f2f2f2"><div align="right">&nbsp;</div></td> <!-- NO -->
										<td style="background-color:#f2f2f2"><?php echo '<strong>'.$target_sales_ds->nama.'</strong>'; ?></td> <!-- TAP/SALES -->
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->sgprepaid).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->sgota).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->sgvin).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->sgvgs).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->sgvgg).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->sgvgp).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->insac_ld).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->insac_md).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->insac_hd).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->invin_ld).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->invin_md).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->invin_hd).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->invga_ld).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->invga_md).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right"><?php echo '<strong>'.format_integer($target_sales_ds->invga_hd).'</strong>'; ?></div></td>
										<td style="background-color:#f2f2f2"><div align="right">&nbsp;</div></td>
										<td style="background-color:#f2f2f2"><div align="right">&nbsp;</div></td>
									</tr>

									<?php
										$no = 0;
										$total_sgprepaid = $total_sgprepaid + $target_sales_ds->sgprepaid;
										$total_sgota = $total_sgota + $target_sales_ds->sgota;
										$total_sgvin = $total_sgvin + $target_sales_ds->sgvin;
										$total_sgvgs = $total_sgvgs + $target_sales_ds->sgvgs;
										$total_sgvgg = $total_sgvgg + $target_sales_ds->sgvgg;
										$total_sgvgp = $total_sgvgp + $target_sales_ds->sgvgp;
										$total_insac_ld = $total_insac_ld + $target_sales_ds->insac_ld;
										$total_insac_md = $total_insac_md + $target_sales_ds->insac_md;
										$total_insac_hd = $total_insac_hd + $target_sales_ds->insac_hd;
										$total_invin_ld = $total_invin_ld + $target_sales_ds->invin_ld;
										$total_invin_md = $total_invin_md + $target_sales_ds->invin_md;
										$total_invin_hd = $total_invin_hd + $target_sales_ds->invin_hd;
										$total_invga_ld = $total_invga_ld + $target_sales_ds->invga_ld;
										$total_invga_md = $total_invga_md + $target_sales_ds->invga_md;
										$total_invga_hd = $total_invga_hd + $target_sales_ds->invga_hd;
									?>

									<?php } else { ?>

									<?php $total_new_rs = $total_new_rs + $target_sales_ds->new_rs; ?>
									<?php $total_limit_link_aja = $total_limit_link_aja + $target_sales_ds->limit_link_aja; ?>

									<tr>
										<td><div align="right"><?php echo $no; ?></div></td> <!-- NO -->
										<td><?php echo $target_sales_ds->nama; ?></td> <!-- TAP/SALES -->
										<td><div align="right"><?php echo format_integer($target_sales_ds->sgprepaid); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->sgota); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->sgvin); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->sgvgs); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->sgvgg); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->sgvgp); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->insac_ld); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->insac_md); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->insac_hd); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->invin_ld); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->invin_md); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->invin_hd); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->invga_ld); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->invga_md); ?></div></td>
										<td><div align="right"><?php echo format_integer($target_sales_ds->invga_hd); ?></div></td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right new_rs" name="new_rs_<?php echo $start; ?>" id="new_rs_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($target_sales_ds->new_rs) ? format_integer($target_sales_ds->new_rs) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td><div align="right"><?php echo format_currency($target_sales_ds->limit_link_aja); ?></div></td>
									</tr>

									<?php } ?>

									<?php $start++; $no++; ?>

									<?php } ?>
								</tbody>
								<tfoot>
									<tr style="background-color:#f2f2f2">
										<td colspan="2"><div align="center"><strong>GRAND TOTAL</strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_sgprepaid); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_sgota); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_sgvin); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_sgvgs); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_sgvgg); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_sgvgp); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_insac_ld); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_insac_md); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_insac_hd); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_invin_ld); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_invin_md); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_invin_hd); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_invga_ld); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_invga_md); ?></strong></div></td>
										<td><div align="right"><strong><?php echo format_integer($total_invga_hd); ?></strong></div></td>
										<td>
											<div align="right">
												<strong>
													<div id="newrs" style="margin-right:15px"><?php echo format_integer($total_new_rs); ?></div>
												</strong>
											</div>
										</td>
										<td><div align="right"><strong><?php echo format_currency($total_limit_link_aja); ?></strong></div></td>
									</tr>
								</tfoot>
							</table>

						</div> <!-- // End scrol-x-table -->

						<?php if ($is_simpan == 0) { ?>

						<?php $hari_ini = date('l'); ?>

						<?php if (in_array($hari_ini, array('Wednesday', 'Thursday', 'Friday'))) { ?>

						<div id="show_button" class="form-row">
							<div class="col-md-12 col-sm-12 col-xs-12 mt-2 mb-3 text-right">
								<button type="button" class="btn btn-sm btn-primary" id="btn-simpan-ds">
									<i class="fal fa-save"></i>
									Simpan
								</button>
							</div>
						</div>

						<?php } ?>

						<?php } ?>

						<input type="hidden" class="form-control form-control-sm" name="total_data_ds" value="<?php echo $total_data_ds-1; ?>">

					</form>

					<script>
						$(document).ready(function()
						{
							var table = $('#dt_table_ds').DataTable( {
								scrollY: '300px',
								scrollX: true,
								scrollCollapse: true,
								paging: false,
								fixedColumns: {
									leftColumns: 2
								},
								bFilter: false,
								bInfo: false,
								ordering: false,
								processing: true,
								serverSide: false
							});

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

							$("#btn-simpan-ds").click(function(){
								// Start looding
								var looding = bootbox.dialog({
									size: 'small',
									closeButton: false,
									message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...</div>',
									className: 'modal-looding'
								});

								var frmsf = $('#frmsf');

								$.ajax({
									url: frmsf.attr('action'),
									type: 'post',
									dataType: 'json',
									data: $('#frmsf').serialize(),
									success: function(res, xhr){
										if (res.isSuccess)
										{
											show_success(res.message);

											$('#konten_tab_entry_ds').load(
												GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_tab_entry_ds/'
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

						/**
						 *  Fungsi	: Menghitung total new rs
						 *  Module	: -
						 */
						function hitung_total_new_rs(){
							var sum = 0;

							$("input[class *= 'new_rs']").each(function(){
								sum += + parseInt(accounting.unformat($(this).val()));
							});

							var table = $('#dt_table_ds').DataTable();
							var column = table.column(23);

							$(column.footer()).html('<div align="right"><strong><div id="newrs" style="margin-right:15px">' + accounting.formatNumber(sum) + '</div></strong></div>');

							console.log(sum, '__total_newrs');
						}
					</script>