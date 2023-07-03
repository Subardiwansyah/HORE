					<div class="panel-content">
					<div id="konten1">
						<div class="row">
							<div class="col-md-6">
								<div class="card mb-3">
									<div class="card-body">
										<div class="p-4 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
											<div class="">
												TRANSAKSI
											</div>
											<i class="fal fa-home position-absolute pos-right pos-bottom opacity-25  mb-n1 mr-n7" style="font-size: 4rem;"></i>
										</div>

										<?php $jenis_sales = isset($data['jenis_sales']) ? $data['jenis_sales'] : ''; ?>

										<table class="table table-hover table-clean table-sm">
											<tbody>
												<tr>
													<td><?php if ($jenis_sales == 'SDS') { echo 'NPSN'; } else { echo 'ID Digipos'; } ?></td>
													<td>:</td>
													<td><?php echo isset($data['kode_lokasi']) ? $data['kode_lokasi'] : ''; ?></td>
												</tr>
												<tr>
													<td><?php if ($jenis_sales == 'SDS') { echo 'Nama Lokasi'; } else { echo 'Nama Outlet'; } ?></td>
													<td>:</td>
													<td><?php echo isset($data['nama_lokasi']) ? $data['nama_lokasi'] : ''; ?></td>
												</tr>
												<tr>
													<td>Tanggal</td>
													<td>:</td>
													<td><?php echo isset($data['tgl']) ? format_date($data['tgl']) : ''; ?></td>
												</tr>
												<tr>
													<td>Petugas</td>
													<td>:</td>
													<td><?php echo isset($data['nama_sales']) ? $data['nama_sales'] : ''; ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<button id="btn-image" type="button" class="btn btn-sm btn-primary">
									<i class="fal fa-image-polaroid"></i>
									Lihat Foto
								</button>
							</div>
							<div class="col-md-6">
								<div class="card mb-3">
									<div class="card-body">
										<div class="p-4 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
											<div class="">

												<?php
													if ($jenis_share == 'PERDANA') { $share = 'PERDANA SHARE'; }
													if ($jenis_share == 'VOUCHER_FISIK') { $share = 'VOUCHER FISIK SHARE'; }
													if ($jenis_share == 'SPANDUK') { $share = 'LAYAR TOKO SHARE'; }
													if ($jenis_share == 'POSTER') { $share = 'POSTER SHARE'; }
													if ($jenis_share == 'PAPAN_NAMA') { $share = 'NEON BOX SHARE'; }
													if ($jenis_share == 'BACKDROP') { $share = 'STIKER SCAN QR SHARE'; }
												?>

												<?php echo $share; ?>

											</div>
											<i class="fal fa-tag position-absolute pos-right pos-bottom opacity-25  mb-n1 mr-n7" style="font-size: 4rem;"></i>
										</div>

										<table class="table table-hover table-clean table-sm">
											<tbody>
												<tr>
													<td>TELKOMSEL</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['telkomsel']) ? format_integer($data['telkomsel']) : 0; ?></div></td>
													<td style="width:50px;">&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['persen_telkomsel']) ? format_currency($data['persen_telkomsel']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>ISAT</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['isat']) ? format_integer($data['isat']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['persen_isat']) ? format_currency($data['persen_isat']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>XL</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['xl']) ? format_integer($data['xl']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['persen_xl']) ? format_currency($data['persen_xl']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>TRI</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['tri']) ? format_integer($data['tri']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['persen_tri']) ? format_currency($data['persen_tri']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>SMARTFREN</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['smartfren']) ? format_integer($data['smartfren']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['persen_smartfren']) ? format_currency($data['persen_smartfren']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>AXIS</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['axis']) ? format_integer($data['axis']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['persen_axis']) ? format_currency($data['persen_axis']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>OTHER</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['other']) ? format_integer($data['other']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['persen_other']) ? format_currency($data['persen_other']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>TOTAL</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['total']) ? format_integer($data['total']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data['persen_total']) ? format_currency($data['persen_total']) : 0; ?> %</div></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="konten2" style="display: none;">
						<div class="row">
							<div class="col-md-12">
								<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
									<i class="fal fa-images"></i>
									FOTO <?php echo $share; ?>
								</h5>

								<div class="card mb-3">
									<div class="card-body">
										<div class="form-row">
											<div class="col-md-12 col-sm-12 col-xs-12 mb-2 text-right">
												<button type="button" class="btn btn-sm btn-primary" id="btn-download" onClick="download_image()">
													<i class="fal fa-download"></i>
													Download
												</button>
											</div>
										</div>
										<input type="hidden" class="form-control form-control-sm" id="foto1">
										<input type="hidden" class="form-control form-control-sm" id="foto2">
										<input type="hidden" class="form-control form-control-sm" id="foto3">
										<div id="x_loading_merchandising" style="display:none">
											<div class="spinner-border" role="status">
												<span class="sr-only">Loading...</span>
											</div>
										</div>
										<div id="x_konten_merchandising">&nbsp;</div>
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
							$('#btn-image').click(function(){
								$('#konten1').hide();
								$('#konten2').show();

								reload_data();
							});

							$('#btn-xbatal').click(function(){
								bootbox.hideAll(); // Hide all bootbox
							});
						});

						function download_image(){
							// var path = 'http://localhost/horev2/apihore/assets/merchandising_foto/';
							// var path = 'http://horedev.com/apihore/assets/merchandising_foto/';
							var path = 'https://sihore.com/apihore/assets/merchandising_foto/';

							var foto1 = $('#foto1').val() ? $('#foto1').val() : 0;
							var foto2 = $('#foto2').val() ? $('#foto2').val() : 0;
							var foto3 = $('#foto3').val() ? $('#foto3').val() : 0;

							if (foto1 !== 0) {var a = $("<a>").attr("href", path+foto1).attr("download", foto1).appendTo("body"); a[0].click(); a.remove();}
							if (foto2 !== 0) {var a = $("<a>").attr("href", path+foto2).attr("download", foto2).appendTo("body"); a[0].click(); a.remove();}
							if (foto3 !== 0) {var a = $("<a>").attr("href", path+foto3).attr("download", foto3).appendTo("body"); a[0].click(); a.remove();}
						}

						function reload_data(){
							var html = '';
							var no = 0;
							// var path = 'http://localhost/horev2/apihore/assets/merchandising_foto/';
							// var path = 'http://horedev.com/apihore/assets/merchandising_foto/';
							var path = 'https://sihore.com/apihore/assets/merchandising_foto/';

							$('#x_loading_merchandising').show();
							$('#x_konten_merchandising').hide();

							$.ajax({
								type: 'POST',
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_merchandising_attac',
								async: false,
								dataType: 'json',
								data:{
									tgl: '<?php echo $tgl; ?>',
									sales: '<?php echo $sales; ?>',
									jenis_lokasi: '<?php echo $jenis_lokasi; ?>',
									lokasi: '<?php echo $lokasi; ?>',
									jenis_share: '<?php echo $jenis_share; ?>'
								},
								success: function(response){
									var foto_1 = response.foto_1 ? response.foto_1 : 0;
									var foto_2 = response.foto_2 ? response.foto_2 : 0;
									var foto_3 = response.foto_3 ? response.foto_3 : 0;

									if (foto_1 == 0 && foto_2 == 0 && foto_3 == 0 )
									{
										html += 'No Image';
									}
									else
									{
										html +=
											" <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>" +
											" 	<ol class='carousel-indicators'>";

											if (foto_1 !== 0)
											{
												if (no == 0) { var aktif = 'active'; } else { var aktif = ''; }

												html += " <li data-target='#carouselExampleIndicators' data-slide-to='"+ no +"' class='" + aktif + "'></li>";

												no++;
											}

											if (foto_2 !== 0)
											{
												if (no == 0) { var aktif = 'active'; } else { var aktif = ''; }

												html += " <li data-target='#carouselExampleIndicators' data-slide-to='"+ no +"' class='" + aktif + "'></li>";

												no++;
											}

											if (foto_3 !== 0)
											{
												if (no == 0) { var aktif = 'active'; } else { var aktif = ''; }

												html += " <li data-target='#carouselExampleIndicators' data-slide-to='"+ no +"' class='" + aktif + "'></li>";

												no++;
											}

										html +=
											"		</ol>" +
											"	<div class='carousel-inner'>";

											no = 0;

											if (foto_1 !== 0)
											{
												if (no == 0) { var aktif = 'active'; } else { var aktif = ''; }

												$('#foto1').val(foto_1);

												html +=
													" <div class='carousel-item " + aktif + "'>" +
													"		<img class='d-block w-100' src='" + path + "" + foto_1 + "'>" +
													" </div>";

												no++;
											}

											if (foto_2 !== 0)
											{
												if (no == 0) { var aktif = 'active'; } else { var aktif = ''; }

												$('#foto2').val(foto_2);

												html +=
													" <div class='carousel-item " + aktif + "'>" +
													"		<img class='d-block w-100' src='" + path + "" + foto_2 + "'>" +
													" </div>";

												no++;
											}

											if (foto_3 !== 0)
											{
												if (no == 0) { var aktif = 'active'; } else { var aktif = ''; }

												$('#foto3').val(foto_3);

												html +=
													" <div class='carousel-item " + aktif + "'>" +
													"		<img class='d-block w-100' src='" + path + "" + foto_3 + "'>" +
													" </div>";

												no++;
											}

										html +=
											" 	</div>" +
											"		<a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>" +
											"			<span class='carousel-control-prev-icon' aria-hidden='true'></span>" +
											"			<span class='sr-only'>Previous</span>" +
											"		</a>" +
											"		<a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>" +
											"			<span class='carousel-control-next-icon' aria-hidden='true'></span>" +
											"			<span class='sr-only'>Next</span>" +
											" 	</a>" +
											"	</div>";
									}
								}
							});

							$('#x_loading_merchandising').hide();
							$('#x_konten_merchandising').show();
							$('#x_konten_merchandising').html(html);
						}
					</script>