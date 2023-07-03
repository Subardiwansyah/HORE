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
											<?php echo $breadcrumb_daftar; ?></span>
										</h2>
										<div class="panel-toolbar pr-3 align-self-end">
											<ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" data-toggle="tab" href="#tab_waiting_approval" role="tab">
														<i class="fal fa-clock mr-1 text-default"></i>
														Waiting Approval
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_approved" role="tab">
														<i class="fal fa-check-square mr-1 text-success"></i>
														Approved
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
												<div class="tab-pane fade show active" id="tab_waiting_approval" role="tabpanel">
													<!-- Begin Tab Waiting Approval -->
													<table id="dt_table_1" class="table table-bordered table-hover w-100">
														<thead class="bg-primary-100">
															<tr>
																<th>Aksi</th>
																<th>Tgl Retur</th>
																<th>Sales</th>
																<th>Serial Number</th>
																<th>Nama Produk</th>
																<th>Harga Jual</th>
																<th>Alasan</th>
															</tr>
														</thead>
													</table>
													<!-- End Tab Waiting Approval -->
												</div>
												<div class="tab-pane fade" id="tab_approved" role="tabpanel">
													<!-- Begin Tab Approved -->
													<table id="dt_table_2" class="table table-bordered table-hover w-100">
														<thead class="bg-primary-100">
															<tr>
																<th>Tgl Retur</th>
																<th>Tgl Approval</th>
																<th>Sales</th>
																<th>Serial Number</th>
																<th>Nama Produk</th>
																<th>Harga Jual</th>
																<th>Alasan</th>
															</tr>
														</thead>
													</table>
													<!-- End Tab Approved -->
												</div>
												<div class="tab-pane fade" id="tab_rejected" role="tabpanel">
													<!-- Begin Tab Rejected -->
													<table id="dt_table_3" class="table table-bordered table-hover w-100">
														<thead class="bg-primary-100">
															<tr>
																<th>Tgl Retur</th>
																<th>Tgl Approval</th>
																<th>Sales</th>
																<th>Serial Number</th>
																<th>Nama Produk</th>
																<th>Harga Jual</th>
																<th>Alasan</th>
															</tr>
														</thead>
													</table>
													<!-- End Tab Rejected -->
												</div>
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
									url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_1',
									type: 'POST'
								},
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': false
								}],
								rowGroup: {dataSrc: 2}
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
									url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_2',
									type: 'POST'
								},
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': true
								}],
								rowGroup: {dataSrc: 2}
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
									url: GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar_3',
									type: 'POST'
								},
								deferRender: true,
								columnDefs: [{
									'targets': [0],
									'orderable': true
								}],
								rowGroup: {dataSrc: 2}
							});
						});

						function approved(id_retur)
						{
							bootbox.confirm({
								closeButton: false,
								title: '<i class="fal fa-exclamation-triangle"> Peringatan',
								message: 'Apakah Anda yakin untuk approved retur ini?',
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

										// Start looding
										var looding = bootbox.dialog({
											size: 'small',
											closeButton: false,
											message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...<div id="x_time"></div></div>',
											className: 'modal-looding'
										});

										var x_remaining = 0;
										var x_obj = document.getElementById("x_time");
										var x_timeout = window.setInterval(function(){
											x_remaining++;
											x_obj.innerHTML = x_remaining;
										}, 1000);


										$.ajax({
											url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/proses_approved',
											type: 'post',
											dataType: 'json',
											data: {id_retur:id_retur},
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
												}
											}
										});
									}
								}
							});
						}

						function rejected(id_retur)
						{
							bootbox.confirm({
								closeButton: false,
								title: '<i class="fal fa-exclamation-triangle"> Peringatan',
								message: 'Apakah Anda yakin untuk reject retur ini?',
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
											data: {id_retur:id_retur},
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
					</script>