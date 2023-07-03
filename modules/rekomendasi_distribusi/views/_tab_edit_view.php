					<!--
					<style>
						div.scrol-x-table {
							width: 100%;
							overflow-x: scroll;
						}
					</style>
					-->

					<form id="frm_target" method="post" action="<?php echo base_url().$modul; ?>/proses_target">

						<!-- <div class="scrol-x-table"> -->

							<table id="dt_table_target" class="table table-bordered m-0 table-sm">
								<thead class="bg-primary-100">
									<tr>
										<td class="bg-primary-100" rowspan="3"><div align="center" style="margin-top:40px"><strong>NO</strong></div></td>
										<td class="bg-primary-100" rowspan="3"><div align="center" style="margin-top:40px;width:180px;"><strong>NAMA OUTLET</strong></div></td>
										<td colspan="6"><div align="center"><strong>SEGEL</strong></div></td>
										<td colspan="3"><div align="center"><strong>SA</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER INTERNET</strong></div></td>
										<td colspan="3"><div align="center"><strong>VOUCHER GAME</strong></div></td>
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
									<?php
										$start = 0; $no = 1; $is_simpan = 0;

										$total_sgprepaid = 0; $total_sgota = 0;
										$total_sgvin = 0;
										$total_sgvgs = 0; $total_sgvgp = 0; $total_sgvgg = 0;
										$total_insac_ld = 0; $total_insac_md = 0; $total_insac_hd = 0;
										$total_invin_ld = 0; $total_invin_md = 0; $total_invin_hd = 0;
										$total_invga_ld = 0; $total_invga_md = 0; $total_invga_hd = 0;
									?>

									<?php $total_data = count($list); ?>

									<?php foreach($list as $row) { ?>

									<?php $is_simpan = $row->is_simpan; ?>

									<tr>
										<td><div align="right"><?php echo $no; ?></div></td> <!-- NO -->
										<td>
											<input type="hidden" name="id_rt_<?php echo $start; ?>" value="<?php echo isset($row->id_rekomendasi) ? $row->id_rekomendasi : 0; ?>">
											<?php echo $row->nama_outlet; ?>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right sgprepaid" name="sgprepaid_<?php echo $start; ?>" id="sgprepaid_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_sgprepaid) ? format_integer($row->target_sgprepaid) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right sgota" name="sgota_<?php echo $start; ?>" id="sgota_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_sgota) ? format_integer($row->target_sgota) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right sgvin" name="sgvin_<?php echo $start; ?>" id="sgvin_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_sgvin) ? format_integer($row->target_sgvin) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right sgvgs" name="sgvgs_<?php echo $start; ?>" id="sgvgs_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_sgvgs) ? format_integer($row->target_sgvgs) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right sgvgg" name="sgvgg_<?php echo $start; ?>" id="sgvgg_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_sgvgg) ? format_integer($row->target_sgvgg) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right sgvgp" name="sgvgp_<?php echo $start; ?>" id="sgvgp_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_sgvgp) ? format_integer($row->target_sgvgp) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right insac_ld" name="insac_ld_<?php echo $start; ?>" id="insac_ld_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_insac_ld) ? format_integer($row->target_insac_ld) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right insac_md" name="insac_md_<?php echo $start; ?>" id="insac_md_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_insac_md) ? format_integer($row->target_insac_md) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right insac_hd" name="insac_hd_<?php echo $start; ?>" id="insac_hd_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_insac_hd) ? format_integer($row->target_insac_hd) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right invin_ld" name="invin_ld_<?php echo $start; ?>" id="invin_ld_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_invin_ld) ? format_integer($row->target_invin_ld) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right invin_md" name="invin_md_<?php echo $start; ?>" id="invin_md_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_invin_md) ? format_integer($row->target_invin_md) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right invin_hd" name="invin_hd_<?php echo $start; ?>" id="invin_hd_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_invin_hd) ? format_integer($row->target_invin_hd) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right invga_ld" name="invga_ld_<?php echo $start; ?>" id="invga_ld_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_invga_ld) ? format_integer($row->target_invga_ld) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right invga_md" name="invga_md_<?php echo $start; ?>" id="invga_md_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_invga_md) ? format_integer($row->target_invga_md) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
										<td>
											<div align="right">
												<input style="width:70px;height:26px;" type="text" class="form-control integer integeronly text-right invga_hd" name="invga_hd_<?php echo $start; ?>" id="invga_hd_<?php echo $start; ?>" autocomplete="off" value="<?php echo isset($row->target_invga_hd) ? format_integer($row->target_invga_hd) : 0 ?>" onkeyup="hitung_total_new_rs()">
											</div>
										</td>
									</tr>

									<?php $start++; $no++; ?>

									<?php
										$total_sgprepaid = $total_sgprepaid + $row->target_sgprepaid;
										$total_sgota = $total_sgota + $row->target_sgota;
										$total_sgvin = $total_sgvin + $row->target_sgvin;
										$total_sgvgs = $total_sgvgs + $row->target_sgvgs;
										$total_sgvgg = $total_sgvgg + $row->target_sgvgg;
										$total_sgvgp = $total_sgvgp + $row->target_sgvgp;
										$total_insac_ld = $total_insac_ld + $row->target_insac_ld;
										$total_insac_md = $total_insac_md + $row->target_insac_md;
										$total_insac_hd = $total_insac_hd + $row->target_insac_hd;
										$total_invin_ld = $total_invin_ld + $row->target_invin_ld;
										$total_invin_md = $total_invin_md + $row->target_invin_md;
										$total_invin_hd = $total_invin_hd + $row->target_invin_hd;
										$total_invga_ld = $total_invga_ld + $row->target_invga_ld;
										$total_invga_md = $total_invga_md + $row->target_invga_md;
										$total_invga_hd = $total_invga_hd + $row->target_invga_hd;
									?>

									<?php } ?>
								</tbody>
								<tfoot>
									<tr style="background-color:#f2f2f2">
										<td colspan="2"><div align="center"><strong>GRAND TOTAL</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_sgprepaid); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_sgota); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_sgvin); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_sgvgs); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_sgvgg); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_sgvgp); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_insac_ld); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_insac_md); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_insac_hd); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_invin_ld); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_invin_md); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_invin_hd); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_invga_ld); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_invga_md); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($total_invga_hd); ?></strong></div></td>
									</tr>
								</tfoot>
							</table>

						<!-- </div> --> <!-- // End scrol-x-table -->

						<div id="show_button" class="form-row">
							<div class="col-md-12 col-sm-12 col-xs-12 mt-2 mb-3 text-right">
								<button type="button" class="btn btn-sm btn-primary" id="btn-simpan-target">
									<i class="fal fa-save"></i>
									Simpan
								</button>
							</div>
						</div>

						<?php if ($is_simpan == 0) { ?>

						<?php $hari_ini = date('l'); ?>

						<?php if (in_array($hari_ini, array('Wednesday', 'Thursday', 'Friday'))) { ?>

						<!--<div id="show_button" class="form-row">
							<div class="col-md-12 col-sm-12 col-xs-12 mt-2 mb-3 text-right">
								<button type="button" class="btn btn-sm btn-primary" id="btn-simpan-target">
									<i class="fal fa-save"></i>
									Simpan
								</button>
							</div>
						</div> -->

						<?php } ?>

						<?php } ?>

						<input type="hidden" class="form-control form-control-sm" name="total_data" value="<?php echo $total_data-1; ?>">

					</form>

					<script>
						$(document).ready(function()
						{
							var table = $('#dt_table_target').DataTable( {
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

							$("#btn-simpan").click(function(){
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

											$('#konten_tab_entry_sf').load(
												GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_tab_entry_sf/'
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

						function hitung_total_new_rs(){
							var sum = 0;

							$("input[class *= 'new_rs']").each(function(){
								sum += + parseInt(accounting.unformat($(this).val()));
							});

							var table = $('#dt_table_sf').DataTable();
							var column = table.column(23);

							$(column.footer()).html('<div align="right"><strong><div id="newrs" style="margin-right:15px">' + accounting.formatNumber(sum) + '</div></strong></div>');

							// console.log(sum, '__total_newrs');
						}
					</script>