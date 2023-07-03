	<div class="panel-content">
		<!-- Begin -->
		<div class="row">
			<div class="col-md-12">
			
				<div data-size="A4">
					<div class="row">
						<div class="col-sm-12">
							<div class="d-flex align-items-center mb-1">
								<h2 class="keep-print-font fw-500 mb-0 text-primary flex-1 position-relative text-center">
									STRUK PEMBAYARAN
									<small class="text-muted mb-0 fs-sm">
										SF0001-01
									</small>	
								</h2>
							</div>
						</div>
					</div>
					
					<div class="row mt-2">
						<div class="col-sm-12 d-flex">
							<div class="table-responsive">
								<table class="table table-clean table-sm align-self-end">
									<tbody>
										<tr>
											<td>Nama Petugas</td>
											<td>Budi Kesuma</td>
										</tr>
										<tr>
											<td>Tanggal</td>
											<td>20-10-2020 09:30</td>
										</tr>
										<tr>
											<td>Nama Pembeli</td>
											<td>Outlet Ponsel A</td>
										</tr>
										<tr>
											<td>Telp Pembeli</td>
											<td>08113375859</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>							
					</div>
					
					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table class="table mt-1">
									<thead>
										<tr>
											<th class="text-center border-top-0 table-scale-border-bottom fw-700">#</th>
											<th class="border-top-0 table-scale-border-bottom fw-700">Item</th>
											<th class="text-right border-top-0 table-scale-border-bottom fw-700">Total</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center fw-700">1</td>
											<td class="text-left strong">PERDANA REGULER SIMPATI 10K<br><small>3.000,00 x 1 (L)</small></td>
											<td class="text-right">3.000,00</td>
										</tr>
										<tr>
											<td class="text-center fw-700">2</td>
											<td class="text-left strong">PERDANA REGULER LOOP 5K<br><small>4.000,00 x 10 (L)</small></td>
											<td class="text-right">40.000,00</td>
										</tr>
										<tr>
											<td class="text-center fw-700">3</td>
											<td class="text-left strong">PERDANA INTERNET 6GB <br><small>4.500,00 x 10 (K)</small></td>
											<td class="text-right">45.000,00</td>
										</tr>
										<tr>
											<td class="text-center fw-700">4</td>
											<td class="text-left strong">Top Up Link Aja	(L)</td>
											<td class="text-right">100.000,00</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-9 ml-sm-auto">
							<table class="table table-clean">
								<tbody>
									<!--
									<tr>
										<td class="text-left">
											<strong>Subtotal Lunas</strong>
										</td>
										<td class="text-right">Rp. 143.000,00</td>
									</tr>
									<tr>
										<td class="text-left">
											<strong>Subtotal Konsinyasi</strong>
										</td>
										<td class="text-right">Rp. 45.000,00</td>
									</tr>
									-->
									<tr class="table-scale-border-top border-left-0 border-right-0 border-bottom-0">
										<td class="text-left keep-print-font">
											<h5 class="m-0 fw-700 h2 keep-print-font color-primary-700">Total</h5>
										</td>
										<td class="text-right keep-print-font">
											<h5 class="m-0 fw-700 h2 keep-print-font">Rp. 188.000,00</h5>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<!-- End -->
	</div>
	<div class="panel-content py-3 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right">
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