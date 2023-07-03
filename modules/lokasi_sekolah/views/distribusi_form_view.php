					<div class="panel-content">
						<div class="row">
							<div class="col-md-12">

								<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
									<i class="fal fa-barcode-read"></i>
									LIST SERIAL NUMBER
								</h5>

								<div class="card mb-3">
									<div class="card-body">

										<div class="row">
											<?php $no=1; foreach($list_distribusi as $distribusi) { ?>
											<div class="col-md-3">
												<span class="d-inline-flex border border-primary text-primary width-1 height-1 rounded-circle fw-500 mr-2 mb-1 align-items-center justify-content-center">
													<?php echo $no; ?>
												</span>

												<?php echo $distribusi->serial_number; ?>
											</div>
											<?php $no++; } ?>
										</div>

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