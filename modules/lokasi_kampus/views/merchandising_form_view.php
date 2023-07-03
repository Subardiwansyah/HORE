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

										<table class="table table-hover table-clean table-sm">
											<tbody>
												<tr>
													<td>ID Digipos</td>
													<td>:</td>
													<td><?php echo isset($data_merchandising['id_digipos']) ? $data_merchandising['id_digipos'] : ''; ?></td>
												</tr>
												<tr>
													<td>Nama Outlet</td>
													<td>:</td>
													<td><?php echo isset($data_merchandising['nama_outlet']) ? $data_merchandising['nama_outlet'] : ''; ?></td>
												</tr>
												<tr>
													<td>Tanggal</td>
													<td>:</td>
													<td><?php echo isset($data_merchandising['tgl']) ? format_date($data_merchandising['tgl']) : ''; ?></td>
												</tr>
												<tr>
													<td>Petugas</td>
													<td>:</td>
													<td><?php echo isset($data_merchandising['nama_sales']) ? $data_merchandising['nama_sales'] : ''; ?></td>
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
													if ($id_jenis_share == 'PERDANA') { $share = 'PERDANA SHARE'; }
													if ($id_jenis_share == 'VOUCHER_FISIK') { $share = 'VOUCHER FISIK SHARE'; }
													if ($id_jenis_share == 'SPANDUK') { $share = 'SPANDUK SHARE'; }
													if ($id_jenis_share == 'POSTER') { $share = 'POSTER SHARE'; }
													if ($id_jenis_share == 'PAPAN_NAMA') { $share = 'NEON BOX SHARE'; }
													if ($id_jenis_share == 'BACKDROP') { $share = 'BACKDROP SHARE'; }
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
													<td><div align="right"><?php echo isset($data_merchandising['telkomsel']) ? format_integer($data_merchandising['telkomsel']) : 0; ?></div></td>
													<td style="width:50px;">&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['persen_telkomsel']) ? format_currency($data_merchandising['persen_telkomsel']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>ISAT</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['isat']) ? format_integer($data_merchandising['isat']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['persen_isat']) ? format_currency($data_merchandising['persen_isat']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>XL</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['xl']) ? format_integer($data_merchandising['xl']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['persen_xl']) ? format_currency($data_merchandising['persen_xl']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>TRI</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['tri']) ? format_integer($data_merchandising['tri']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['persen_tri']) ? format_currency($data_merchandising['persen_tri']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>SMARTFREN</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['smartfren']) ? format_integer($data_merchandising['smartfren']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['persen_smartfren']) ? format_currency($data_merchandising['persen_smartfren']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>AXIS</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['axis']) ? format_integer($data_merchandising['axis']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['persen_axis']) ? format_currency($data_merchandising['persen_axis']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>OTHER</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['other']) ? format_integer($data_merchandising['other']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['persen_other']) ? format_currency($data_merchandising['persen_other']) : 0; ?> %</div></td>
												</tr>
												<tr>
													<td>TOTAL</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['total']) ? format_integer($data_merchandising['total']) : 0; ?></div></td>
													<td>&nbsp;</td>
													<td>Share</td>
													<td>:</td>
													<td><div align="right"><?php echo isset($data_merchandising['persen_total']) ? format_currency($data_merchandising['persen_total']) : 0; ?> %</div></td>
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
										<div id="loading_merchandising" style="display:none">
											<div class="spinner-border" role="status">
												<span class="sr-only">Loading...</span>
											</div>
										</div>
										<div id="konten_merchandising">&nbsp;</div>
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

							$('#loading_merchandising').show();
							$('#konten_merchandising').hide();

							$.ajax({
								type: 'POST',
								url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_merchandising',
								async: false,
								dataType: 'json',
								data:{
									tgl: '<?php echo $tgl; ?>',
									id_sales: '<?php echo $id_sales; ?>',
									id_lokasi: '<?php echo $id_lokasi; ?>',
									id_jns_share: '<?php echo $id_jenis_share; ?>'
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

							$('#loading_merchandising').hide();
							$('#konten_merchandising').show();
							$('#konten_merchandising').html(html);
						}
					</script>