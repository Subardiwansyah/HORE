					<div class="card mb-3">
						<div class="card-header bg-primary-100 py-1">
							<div class="card-title" style="font-size:13px;color:#FFFFFF">
								Voice of Reseller - Survey
							</div>
						</div>
						<div class="card-body">

							<div class="table-responsive">
								<table id="dt_table" class="table table-bordered table-sm table-striped" style="width:100%;">
									<thead class="bg-primary-100">
										<tr>
											<td style="width:10px">No</td>
											<td>Nama Team Survey</td>
											<td>Jabatan</td>
											<td>ID Digipos</td>
											<td>Nama Outlet</td>
											<td>Nama SF</td>
											<td>Video</td>
										</tr>
									</thead>
								</table>
							</div>

						</div>
					</div>

					<script>
						$(document).ready(function(){
							$('#dt_table').removeAttr('width').DataTable({
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar',
									type: 'POST',
									data: {
										'id_tap': '<?php echo $id_tap; ?>',
										'pilperiode': '<?php echo $pilperiode; ?>',
										'tahun_kuartal': '<?php echo $tahun_kuartal; ?>',
										'bulan_kuartal': '<?php echo $bulan_kuartal; ?>',
										'tahun': '<?php echo $tahun; ?>',
										'bulan': '<?php echo $bulan; ?>',
										'minggu': '<?php echo $minggu; ?>'
									}
								},
								deferRender: true
							});
						});

						function lihat(id)
						{
							show_dialog_large(600, 500, 'Video Voice of Reseller', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/video_voice_of_reseller_form/' + id);
						}
					</script>