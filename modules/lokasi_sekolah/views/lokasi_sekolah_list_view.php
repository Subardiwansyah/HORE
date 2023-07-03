					<main class="page-content">
						<ol class="breadcrumb page-breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fal fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?><?php echo $modul; ?>"><?php echo $modul_display; ?></a></li>
							<li class="breadcrumb-item active"><?php echo $breadcrumb_daftar; ?></li>
						</ol>

						<div class="row">
							<div class="col-xl-12">
								<div id="panel-12" class="panel">
									<div class="panel-hdr border-faded border-top-0 border-right-0 border-left-0 shadow-0">
										<h2>
											<?php echo $breadcrumb_daftar; ?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-success">OPEN</span>
										</h2>
										<div class="panel-toolbar pr-3 align-self-end">
											<ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" data-toggle="tab" href="#tab_exisiting" role="tab">
														<i class="fal fa-check-square mr-1 text-success"></i>
														Exisiting
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_waiting_approval" role="tab">
														<i class="fal fa-clock mr-1 text-default"></i>
														Waiting Approval
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_rejected" role="tab">
														<i class="fal fa-window-close mr-1" style="color: #d9534f !important;"></i>
														Rejected
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="panel-container show">
										<div class="panel-content">
											<div class="tab-content">
												<div class="tab-pane fade show active" id="tab_exisiting" role="tabpanel">
													<!-- Begin Tab Exisiting -->
													<div class = "table-responsive">
    													<table id="dt_table_1" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    														<thead class="bg-primary-100">
    															<tr>
    																<th>Aksi</th>
    																<th>NPSN</th>
    																<th>Nama Sekolah</th>
    																<th>Kecamatan</th>
    																<th>Cluster</th>
    																<th>Branch</th>
    															</tr>
    														</thead>
    													</table>
    												</div>
													<!-- End Tab Exisiting -->
												</div>
												<div class="tab-pane fade" id="tab_waiting_approval" role="tabpanel">
													<!-- Begin Tab Waiting Approval -->
													<div class = "table-responsive">
    													<table id="dt_table_2" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    														<thead class="bg-primary-100">
    															<tr>
    																<th>Aksi</th>
    																<th>NPSN</th>
    																<th>Nama Sekolah</th>
    																<th>Kecamatan</th>
    																<th>Cluster</th>
    																<th>Branch</th>
    															</tr>
    														</thead>
    													</table>
    												</div>
													<!-- End Tab Waiting Approval -->
												</div>
												<div class="tab-pane fade" id="tab_rejected" role="tabpanel">
													<!-- Begin Tab Rejected -->
													<div class = "table-responsive">
    													<table id="dt_table_3" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    														<thead class="bg-primary-100">
    															<tr>
    																<th>Aksi</th>
    																<th>NPSN</th>
    																<th>Nama Sekolah</th>
    																<th>Kecamatan</th>
    																<th>Cluster</th>
    																<th>Branch</th>
    															</tr>
    														</thead>
    													</table>
    												</div>
													<!-- End Tab Rejected -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xl-12">
								<div id="panel-1" class="panel">
									<div class="panel-hdr">
										<h2>
											<?php echo $breadcrumb_daftar; ?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-danger">CLOSE</span>
										</h2>
										<!--
										<div class="panel-toolbar">
											<button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
											<button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
										</div>
										-->
									</div>
									<div class="panel-container show">
										<div class="panel-content">
										    <div class = "table-responsive">
    											<table id="dt_table_4" class="table table-bordered table-striped table-hover" style="width:100%;font-size:12px;" border="1">
    												<thead class="bg-primary-210">
    													<tr>
    														<th>NPSN</th>
    														<th>Nama Sekolah</th>
    														<th>Kecamatan</th>
    														<th>Cluster</th>
    														<th>Branch</th>
    														<th>Close</th>
    													</tr>
    												</thead>
    											</table>
    										</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</main>

					<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>

					<script>
						$(document).ready(function()
						{
							$('#dt_table_1').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_1',
									'type': 'POST'
								},
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}],
								fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
									if (aData[1] == null)
									{
										$('td', nRow).css('background-color', 'rgba(245, 4, 15, 0.6)');
									}
								}
							});

							$('#dt_table_2').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_2',
									'type': 'POST'
								},
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							});

							$('#dt_table_3').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_3',
									'type': 'POST'
								},
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							});

							$('#dt_table_4').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								// colReorder: true,
								// select: 'single',
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_4',
									'type': 'POST'
								},
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}]
							});
						});

						function lihat(id)
						{
							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/lihat/' + id;
						}

						function ubah(id)
						{
							location.href = GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/form/' + id;
						}

						function approved(id)
						{
							show_dialog(600, 500, 'Approved', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/approved/' + id);
						}

						function rejected(id)
						{
							bootbox.confirm({
								closeButton: false,
								title: '<i class="fal fa-exclamation-triangle"> Peringatan',
								message: 'Apakah Anda yakin untuk reject lokasi ini?',
								size: 'small',
								buttons: {
									cancel: {
										label: '<i class="fal fa-times"></i> Tidak',
										className: 'btn btn-sm btn-primary'
									},
									confirm: {
										label: '<i class="fal fa-check"></i> Ya',
										className: 'btn btn-sm btn-primary'
									}
								},
								callback: function(result){
									if (result)
									{
										$.ajax({
											url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/proses_reject',
											type: 'post',
											dataType: 'json',
											data: {id_sekolah:id},
											success: function(res, xhr){
												if (res.isSuccess)
												{
													show_success(res.message);
													$('#dt_table_1').DataTable().ajax.reload();
													$('#dt_table_2').DataTable().ajax.reload();
													$('#dt_table_3').DataTable().ajax.reload();
												}
												else
												{
													show_warning(res.message);
												}
											}
										});
									}
								}
							});
						}

						function hapus(id)
						{
							bootbox.confirm({
								closeButton: false,
								title: '<i class="fal fa-exclamation-triangle"> Peringatan',
								message: 'Apakah Anda yakin untuk menghapus?',
								size: 'small',
								buttons: {
									cancel: {
										label: '<i class="fal fa-times"></i> Tidak',
										className: 'btn btn-sm btn-primary'
									},
									confirm: {
										label: '<i class="fal fa-check"></i> Ya',
										className: 'btn btn-sm btn-primary'
									}
								},
								callback: function(result){
									if (result)
									{
										$.ajax({
											type: "post",
											dataType: "json",
											url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/hapus',
											data: {id: id},
											success: function(res){
												if (res.isSuccess)
												{
													show_success(res.message);
													$('#dt_table_1').DataTable().ajax.reload();
												}
												else
												{
													show_warning(res.message);
												}
											}
										});
									}
								}
							});
						}
					</script>