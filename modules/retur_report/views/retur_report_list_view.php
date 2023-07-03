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
									</div>
									<div class="panel-container show">
										<div class="panel-content">
										    <div class = "table-responsive">
    											<table id="dt_table_0" class="table table-bordered table-striped table-sm" style="width:100%;font-size:12px;" border="1">
    												<thead class="bg-primary-100">
    													<tr>
    														<td rowspan="2">No</td>
    														<td rowspan="2">Sales</td>
    														<td rowspan="2">Nama Produk</td>
    														<td colspan="2">Retur Barang</td>
    													</tr>
															<tr>
    														<td>Barang Rusak</td>
    														<td>Penumpukan Stock</td>
    													</tr>
    												</thead>
														<tfoot class="bg-primary-100">
															<tr>
																<td class="bg-primary-100" colspan="3"><div align="center"><strong>Total</strong></div></td>
																<td>0</td>
																<td>0</td>
															</tr>
														</tfoot>
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
							$('#dt_table_0').dataTable(
							{
								responsive: true,
								fixedHeader: true,
								processing: true,
								serverSide: true,
								order: [],
								ajax: {
									'url': GLOBAL_MAIN_VARS['BASE_URL'] + GLOBAL_MAIN_VARS['MODUL'] + '/get_daftar',
									'type': 'POST'
								},
								footerCallback: function(row, data, start, end, display){
									var api = this.api(), data;

									var intVal = function(i){
										return typeof i === 'string' ?
											i.replace(/[\$,]/g, '') * 1 :
											typeof i === 'number' ?
											i : 0;
									};

									var no = 3;
									var x_value = ['barang_rusak', 'penumpukan_stock'];
									var x_length = x_value.length;

									for (x=0; x<x_length; x++)
									{
										var x_total = x_value[x];

										x_total = api
											.column(no)
											.data()
											.reduce(function (a, b){
												var b = b;

												b = b.replace('<div class="text-right">', '');
												b = b.replace('</div>', '');
												b = accounting.unformat(b);

												return intVal(a) + intVal(b);
											}, 0);

										$(api.column(no).footer()).html('<div align="right"><strong>' + accounting.formatNumber(x_total) + '</strong></div>');

										no++;
									}
								}
							});
						});
					</script>