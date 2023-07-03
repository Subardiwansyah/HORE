					<div class="panel-content">
						<div class="row">
							<div class="col-md-4">

								<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
									<i class="fal fa-list-alt"></i>
									LIST PROGRAM
								</h5>

								<div class="card mb-3">
									<div class="card-body">

										<div class="panel-tag">
											Pilih program untuk menayangkan video.
										</div>

										<table class="table table-hover table-clean table-sm">
											<tbody>
												<?php $no=1; foreach($list_promotion as $promotion) { ?>
												<tr>
													<td>
														<span class="d-inline-flex border border-primary text-primary width-1 height-1 rounded-circle fw-500 mr-2 mb-1 align-items-center justify-content-center">
															<?php echo $no; ?>
														</span>
													</td>
													<td><a href="javascript:void(0);" onClick="pilih_video('<?php echo $promotion->file_video; ?>')"><?php echo $promotion->nama_jenis; ?></a></td>
												</tr>
												<?php $no++; } ?>
											</tbody>
										</table>

									</div>
								</div>
							</div>
							<div class="col-md-8">

								<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
									<i class="fal fa-video"></i>&nbsp;&nbsp;
									PLAY VIDEO
								</h5>

								<div class="card mb-3">
									<div class="card-body">

										<div id="loading_video" style="display:none">
											<div class="spinner-border" role="status">
												<span class="sr-only">Loading...</span>
											</div>
										</div>
										<div id="konten_video"></div>

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

						function pilih_video(file){
							var html = '';
							// var path = 'http://localhost/horev2/apihore/assets/promotion_video/';
							// var path = 'http://horedev.com/apihore/assets/promotion_video/';
							var path = 'https://sihore.com/apihore/assets/promotion_video/';

							$('#loading_video').show();
							$('#konten_video').hide();

							html +=
								" <video height='400px;' width='100%' controls>" +
								"		<source src='" + path + "" + file + "' type='video/mp4'>" +
								" </video>";

							$('#loading_video').hide();
							$('#konten_video').show();
							$('#konten_video').html(html);
						}
					</script>