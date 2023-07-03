				<div class="card mb-3">
					<div class="card-header bg-primary-100 py-1">
						<div class="card-title" style="font-size:13px;color:#FFFFFF">
							VIDEO TUTORIAL LEVEL BRANCH
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">

							<table id="dt_table_2" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px">
								<thead class="bg-primary-100">
									<tr>
										<th style="width:15px">No</th>
										<th>Video</th>
										<th style="width:80px">Aksi</th>
									</tr>
								</thead>
							</table>

						</div>
					</div>
				</div>

				<script>
					$(document).ready(function(){
						$('#dt_table_2').removeAttr('width').DataTable({
							pageLength: 10,
							ordering: false,
							// bInfo: true,
							// bFilter: false,
							// bLengthChange: false,
							responsive: true,
							fixedHeader: true,
							processing: true,
							serverSide: true,
							ajax: {
								'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_2',
								'type': 'POST'
							},
							deferRender: true
						});
					});
				</script>