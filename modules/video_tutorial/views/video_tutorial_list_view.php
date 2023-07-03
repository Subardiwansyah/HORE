					<main class="page-content">
						<ol class="breadcrumb page-breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fal fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?><?php echo $modul; ?>"><?php echo $modul_display; ?></a></li>
							<li class="breadcrumb-item active"><?php echo $breadcrumb_daftar; ?></li>
						</ol>

						<div class="row">
							<div class="col-xl-12">
								<div id="panel-0" class="panel">
									<div class="panel-hdr">
										<h2>
											<?php echo $breadcrumb_daftar; ?>
										</h2>
										
										<?php $id_level = $this->session->userdata('ID_LEVEL'); ?>
										
										<div class="panel-toolbar pr-3 align-self-end">
											<ul id="demo_panel-tabs" class="nav nav-tabs border-bottom-0" role="tablist">
												<?php if (in_array($id_level, array(1))) { ?>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_regional" role="tab" onClick="reload_tab('regional')">
														<i class="fal fa-video mr-1 text-success"></i>
														Regional
													</a>
												</li>
												<?php } ?>
												<?php if (in_array($id_level, array(1, 2))) { ?>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_branch" role="tab" onClick="reload_tab('branch')">
														<i class="fal fa-video mr-1 text-warning"></i>
														Branch
													</a>
												</li>
												<?php } ?>
												<?php if (in_array($id_level, array(1, 2, 3))) { ?>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_cluster" role="tab" onClick="reload_tab('cluster')">
														<i class="fal fa-video mr-1 text-danger"></i>
														Cluster
													</a>
												</li>
												<?php } ?>
												<?php if (in_array($id_level, array(1, 2, 3, 4))) { ?>
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#tab_tap" role="tab" onClick="reload_tab('tap')">
														<i class="fal fa-video mr-1 text-info"></i>
														TAP
													</a>
												</li>
												<?php } ?>
												<li class="nav-item">
													<a class="nav-link active" data-toggle="tab" href="#tab_sales" role="tab" onClick="reload_tab('sales')">
														<i class="fal fa-video mr-1 text-secondary"></i>
														Sales (SF/DS)
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="panel-container show">
										<div class="panel-content">
											<div class="tab-content">
												<?php if (in_array($id_level, array(1, 2, 3, 4))) { ?>
												<div class="tab-pane fade" id="tab_regional" role="tabpanel">
													<div id="konten_tbl_regional" class="konten_tbl"></div>
												</div>
												<?php } ?>
												<?php if (in_array($id_level, array(1, 2))) { ?>
												<div class="tab-pane fade" id="tab_branch" role="tabpanel">
													<div id="konten_tbl_branch" class="konten_tbl"></div>
												</div>
												<?php } ?>
												<?php if (in_array($id_level, array(1, 2, 3))) { ?>
												<div class="tab-pane fade" id="tab_cluster" role="tabpanel">
													<div id="konten_tbl_cluster" class="konten_tbl"></div>
												</div>
												<?php } ?>
												<?php if (in_array($id_level, array(1, 2, 3, 4))) { ?>
												<div class="tab-pane fade" id="tab_tap" role="tabpanel">
													<div id="konten_tbl_tap" class="konten_tbl"></div>
												</div>
												<?php } ?>
												<div class="tab-pane fade show active" id="tab_sales" role="tabpanel">
													<div id="konten_tbl_sales" class="konten_tbl"></div>
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
							reload_tbl_regional();
							reload_tbl_branch();
							reload_tbl_cluster();
							reload_tbl_tap();
							reload_tbl_sales();
						});

						function reload_tab(lvl){
							if (lvl == 'regional')
							{
								reload_tbl_regional();
							}
							else if (lvl == 'branch')
							{
								reload_tbl_branch();
							}
							else if (lvl == 'cluster')
							{
								reload_tbl_cluster();
							}
							else if (lvl == 'tap')
							{
								reload_tbl_tap();
							}
							else if (lvl == 'sales')
							{
								reload_tbl_sales();
							}
						}

						function reload_tbl_regional(){
							$('.konten_tbl').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							setTimeout(function(){
								$('#konten_tbl_regional').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_regional/'
								);
							}, 500);
						}

						function reload_tbl_branch(){
							$('.konten_tbl').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							setTimeout(function(){
								$('#konten_tbl_branch').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_branch/'
								);
							}, 500);
						}

						function reload_tbl_cluster(){
							$('.konten_tbl').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							setTimeout(function(){
								$('#konten_tbl_cluster').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_cluster/'
								);
							}, 500);
						}

						function reload_tbl_tap(){
							$('.konten_tbl').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							setTimeout(function(){
								$('#konten_tbl_tap').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_tap/'
								);
							}, 500);
						}

						function reload_tbl_sales(){
							$('.konten_tbl').load(GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_blank/');

							setTimeout(function(){
								$('#konten_tbl_sales').load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_sales/'
								);
							}, 500);
						}

						function lihat(id)
						{
							show_dialog_large(600, 500, 'Video Tutorial', GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS["MODUL"] + '/video_tutorial_form/' + id);
						}
					</script>