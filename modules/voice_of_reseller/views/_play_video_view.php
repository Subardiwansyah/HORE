					<div class="panel-content">
						<div class="row">
							<div class="col-md-12">

								<h5 class="keep-print-font fw-500 mb-2 text-primary flex-1 position-relative">
									<i class="fal fa-video"></i>&nbsp;&nbsp;
									PLAY VIDEO

								<div class="card mb-3">
									<div class="card-body">
										<video width="100%" controls>
											<source src="https://sihore.com/apimt/assets/voiceofreseller_video/<?php echo isset($data['video']) ? $data['video'] : '' ?>" type="video/mp4">
										</video>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-content py-2 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right">
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