					<div class="panel-content">
						<div class="form-row">
							<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
								<label class="form-label" for="no_npsn">NPSN <span class="text-danger">*</span> </label>
								<input type="text" class="form-control form-control-sm" id="no_npsn">
							</div>
						</div>
						<input type="hidden" class="form-control form-control-sm" id="id_universitas" value="<?php echo isset($id_universitas) ? $id_universitas : ''; ?>" />
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
								var id_universitas = $('#id_universitas').val();
								var no_npsn = $('#no_npsn').val();

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
										id_universitas:id_universitas,
										no_npsn:no_npsn
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
												bootbox.hideAll(); // Hide all bootbox
											}, 1500)
										}
									}
								});
							});
						});
					</script>