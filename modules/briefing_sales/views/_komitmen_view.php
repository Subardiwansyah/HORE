				<form id="frmkomitmen" method="post" action="<?php echo base_url().$modul; ?>/proses">
					<div class="row">
						<div class="col-md-6">
							<div class="card mb-3">
								<div class="card-body">
									<div class="p-4 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
										<div class="">
											BRIEFING PAGI
										</div>
										<i class="fal fa-sunrise position-absolute pos-right pos-bottom opacity-25  mb-n1 mr-n7" style="font-size: 4rem;"></i>
									</div>
									<div style="margin-left:10px;">
										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Coverage / PJP</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="coverage_pagi" value="<?php echo isset($data_komitmen['coverage_pagi']) ? $data_komitmen['coverage_pagi'] : '' ?>">
											</div>
										</div>

										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Distribution</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="distribution_pagi" value="<?php echo isset($data_komitmen['distribution_pagi']) ? $data_komitmen['distribution_pagi'] : '' ?>">
											</div>
										</div>

										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Merchandising</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="merchandising_pagi" value="<?php echo isset($data_komitmen['merchandising_pagi']) ? $data_komitmen['merchandising_pagi'] : '' ?>">
											</div>
										</div>

										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Promotion</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="promotion_pagi" value="<?php echo isset($data_komitmen['promotion_pagi']) ? $data_komitmen['promotion_pagi'] : '' ?>">
											</div>
										</div>

										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Issue</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="issue_pagi" value="<?php echo isset($data_komitmen['issue_pagi']) ? $data_komitmen['issue_pagi'] : '' ?>">
											</div>
										</div>

										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Need Support</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="need_support_pagi" value="<?php echo isset($data_komitmen['need_support_pagi']) ? $data_komitmen['need_support_pagi'] : '' ?>">
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card mb-3">
								<div class="card-body">
									<div class="p-4 bg-primary-400 rounded overflow-hidden position-relative text-white mb-g">
										<div class="">
											BRIEFING SORE
										</div>
										<i class="fal fa-sunset position-absolute pos-right pos-bottom opacity-25  mb-n1 mr-n7" style="font-size: 4rem;"></i>
									</div>

									<div style="margin-left:10px;">
										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Coverage / PJP</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="coverage_sore" value="<?php echo isset($data_komitmen['coverage_sore']) ? $data_komitmen['coverage_sore'] : '' ?>">
											</div>
										</div>

										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Distribution</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="distribution_sore" value="<?php echo isset($data_komitmen['distribution_sore']) ? $data_komitmen['distribution_sore'] : '' ?>">
											</div>
										</div>

										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Merchandising</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="merchandising_sore" value="<?php echo isset($data_komitmen['merchandising_sore']) ? $data_komitmen['merchandising_sore'] : '' ?>">
											</div>
										</div>

										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Promotion</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="promotion_sore" value="<?php echo isset($data_komitmen['promotion_sore']) ? $data_komitmen['promotion_sore'] : '' ?>">
											</div>
										</div>

										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Issue</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="issue_sore" value="<?php echo isset($data_komitmen['issue_sore']) ? $data_komitmen['issue_sore'] : '' ?>">
											</div>
										</div>

										<div class="form-row">
											<div class="col-4 mb-2">
												<label class="form-label">Need Support</label>
											</div>
											<div class="col-8 mb-2">
												<input type="text" class="form-control form-control-sm" id="need_support_sore" value="<?php echo isset($data_komitmen['need_support_sore']) ? $data_komitmen['need_support_sore'] : '' ?>">
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					<input type="hidden" class="form-control form-control-sm" id="xid_sales" value="<?php echo isset($id_sales) ? $id_sales : 0 ?>">
					<input type="hidden" class="form-control form-control-sm" id="xtgl" value="<?php echo isset($tgl) ? $tgl : 0 ?>">

					<div class="form-row mt-3">
						<div class="col-md-12 col-sm-12 col-xs-12 mt-1 text-right">
							<button type="button" class="btn btn-sm btn-primary" id="btn-simpan">
								<i class="fal fa-save"></i>
								Simpan
							</button>
						</div>
					</div>
				</form>

				<script>
					$(document).ready(function(){
						$("#btn-simpan").click(function(){
							// Start looding
							var looding = bootbox.dialog({
								size: 'small',
								closeButton: false,
								message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...</div>',
								className: 'modal-looding'
							});

							var $frm = $('#frmkomitmen');

							$.ajax({
								url: $frm.attr('action'),
								type: 'post',
								dataType: 'json',
								data: {
									id_sales: $('#xid_sales').val(),
									tgl: $('#xtgl').val(),
									coverage_pagi: $('#coverage_pagi').val(),
									distribution_pagi: $('#distribution_pagi').val(),
									merchandising_pagi: $('#merchandising_pagi').val(),
									promotion_pagi: $('#promotion_pagi').val(),
									issue_pagi: $('#issue_pagi').val(),
									need_support_pagi: $('#need_support_pagi').val(),
									coverage_sore: $('#coverage_sore').val(),
									distribution_sore: $('#distribution_sore').val(),
									merchandising_sore: $('#merchandising_sore').val(),
									promotion_sore: $('#promotion_sore').val(),
									issue_sore: $('#issue_sore').val(),
									need_support_sore: $('#need_support_sore').val()
								},
								success: function(res, xhr){
									if (res.isSuccess)
									{
										show_success(res.message);

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