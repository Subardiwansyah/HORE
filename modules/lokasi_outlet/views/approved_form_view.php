					<div class="panel-content">
						<div class="form-row">
							<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
								<label class="form-label" for="id_digipos">ID Digipos</label>
								<input type="text" class="form-control form-control-sm" id="id_digipos">
							</div>
						</div>
						<input type="hidden" class="form-control form-control-sm" id="id_outlet" value="<?php echo isset($id_outlet) ? $id_outlet : ''; ?>" />
					</div>
					<div class="panel-content py-3 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right">
						<button type="button" class="btn btn-sm btn-primary" id="btn-batal"><i class="fal fa-times"></i> Batal</button>
						<button type="button" class="btn btn-sm btn-primary" id="btn-simpan"><i class="fal fa-save"></i> Simpan</button>
					</div>

					<script>
						$(document).ready(function()
						{
							$('#btn-batal').click(function(){
								bootbox.hideAll(); // Hide all bootbox
							});

							$('#btn-simpan').click(function(){
								var id_outlet = $('#id_outlet').val();
								var id_digipos = $('#id_digipos').val();

								// Start looding
								var looding = bootbox.dialog({
									size: 'small',
									closeButton: false,
									message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...</div>',
									className: 'modal-looding'
								});

								$.ajax({
									url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/proses_approved',
									type: 'post',
									dataType: 'json',
									data: {
										id_outlet:id_outlet,
										id_digipos:id_digipos
									},
									success: function(res, xhr){
										if (res.isSuccess)
										{
											show_success(res.message);
											$('#dt_table_1').DataTable().ajax.reload();
											$('#dt_table_2').DataTable().ajax.reload();
											$('#dt_table_3').DataTable().ajax.reload();

											setTimeout(function(){
												bootbox.hideAll(); // Hide all bootbox
											}, 1500)
										}
										else
										{
											show_warning(res.message);
											setTimeout(function(){
												looding.hide();
												// bootbox.hideAll(); // Hide all bootbox
											}, 1500)
										}
									}
								});
							});
						});
					</script>