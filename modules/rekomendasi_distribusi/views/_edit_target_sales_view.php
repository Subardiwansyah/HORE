				<div class="card mb-3">
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_5" class="table table-bordered table-sm m-0 table-striped">
								<thead class="bg-primary-100">
									<tr>
										<td class="bg-primary-100" rowspan="3"><div align="center" style="margin-top:40px;"><strong>NO</strong></div></td>
										<td class="bg-primary-100" rowspan="3"><div align="center" style="margin-top:40px;width:70px;"><strong>ID DIGIPOS</strong></div></td>
										<td class="bg-primary-100" rowspan="3"><div align="center" style="margin-top:40px;width:150px;"><strong>NAMA OUTLET</strong></div></td>
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
								<tfoot>
									<tr style="background-color:#f2f2f2">
										<!--<td>-</td>
										<td>-</td> -->
										<td colspan="3"><div align="center"><strong>GRAND TOTAL</strong></div></td>

										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_sgprepaid']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_sgota']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_sgvin']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_sgvgs']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_sgvgg']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_sgvgp']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_insac_ld']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_insac_md']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_insac_hd']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_invin_ld']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_invin_md']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_invin_hd']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_invga_ld']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_invga_md']); ?></strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong><?php echo format_integer($data['total_invga_hd']); ?></strong></div></td>
										<!--
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										<td><div align="right" style="margin-right:15px"><strong>0</strong></div></td>
										-->
									</tr>
								</tfoot>
							</table>

						</div>

						<div id="show_button" class="form-row">
							<div class="col-md-12 col-sm-12 col-xs-12 mt-3 mb-3 text-right">
								<button type="button" class="btn btn-sm btn-primary" id="btn-simpanx">
									<i class="fal fa-save"></i>
									Simpan
								</button>
							</div>
						</div>

					</div>
				</div>


				<script>
					$(document).ready(function(){

						$('#dt_table_5').dataTable(
						{
							pageLength: 25,
							scrollY: 400,
							scrollX: true,
							scrollCollapse: true,
							ordering: false,
							processing: true,
							fixedColumns: {
								leftColumns: 3
							},
							bInfo: true,
							bFilter: true,
							bLengthChange : false,
							paging: true,
							serverSide: true,
							// stateSave: true,
							ajax: {
								url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar',
								type: 'POST'
							},
							deferRender: true,

							drawCallback: function(settings)
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

							},
							initComplete: function(settings, json)
							{
								// console.log(json.recordsTotal, '__json');

								// $("#btn-simpanx").click(function(){

									// var data = table.$('input, select').serialize();

									// console.log(data);
								// });
							}
						});

					});



					function keyup_aksi(text){
						console.log(text, '_____text');
						// console.log(text.id, '__val');

						var id = $('#id_'+text.id).val();
						var nilai = $('#'+text.id).val();

						console.log(id, '_____id');
						console.log(nilai, '_____nilai');
					}

				</script>