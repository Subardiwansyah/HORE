					<div class="row">
						<div class="col-md-6">
							<div id="grafik_pertanyaan_1"></div>
						</div>
						<div class="col-md-6">
							<div id="grafik_pertanyaan_2"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div id="grafik_pertanyaan_3"></div>
						</div>
						<div class="col-md-6">
							<div id="grafik_pertanyaan_4"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div id="grafik_pertanyaan_5"></div>
						</div>
						<div class="col-md-6">
							<div id="grafik_pertanyaan_6"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div id="grafik_pertanyaan_7"></div>
						</div>
						<div class="col-md-6">
							&nbsp;
						</div>
					</div>

					<input type="hidden" class="" id="x_id_tap" value="<?php echo $id_tap; ?>">
					<input type="hidden" class="" id="x_pilperiode" value="<?php echo $pilperiode; ?>">
					<input type="hidden" class="" id="x_tahun_kuartal" value="<?php echo $tahun_kuartal; ?>">
					<input type="hidden" class="" id="x_bulan_kuartal" value="<?php echo $bulan_kuartal; ?>">
					<input type="hidden" class="" id="x_tahun" value="<?php echo $tahun; ?>">
					<input type="hidden" class="" id="x_bulan" value="<?php echo $bulan; ?>">
					<input type="hidden" class="" id="x_minggu" value="<?php echo $minggu; ?>">

					<script>
						$(document).ready(function()
						{
							var arr = [
								'pertanyaan_1',
								'pertanyaan_2',
								'pertanyaan_3',
								'pertanyaan_4',
								'pertanyaan_5',
								'pertanyaan_6',
								'pertanyaan_7'
							];
							var arr_length = arr.length;

							for (var i = 0; i < arr_length; i++)
							{
								var x_id_tap = $('#x_id_tap').val();
								var x_pilperiode = $('#x_pilperiode').val();
								var x_tahun_kuartal = $('#x_tahun_kuartal').val();
								var x_bulan_kuartal = $('#x_bulan_kuartal').val();
								var x_tahun = $('#x_tahun').val();
								var x_bulan =  $('#x_bulan').val();
								var x_minggu =  $('#x_minggu').val();

								$('#grafik_'+arr[i]).load(
									GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/get_data_grafik_' + arr[i] + '/' +
									x_id_tap + '/' +
									x_pilperiode + '/' +
									x_tahun_kuartal + '/' +
									x_bulan_kuartal + '/' +
									x_tahun + '/' +
									x_bulan + '/' +
									x_minggu + '/'
								);
							}
						});
					</script>