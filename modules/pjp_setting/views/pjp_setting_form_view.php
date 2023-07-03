					<form id="frmmodal" method="post" action="<?php echo base_url().$modul; ?>/proses">
						<div class="panel-content">
							<!-- Begin -->

							<div class="form-row">
								<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
									<label class="form-label" for="nm_lokasi">Tempat <span class="text-danger">*</span> </label>
									<input type="text" style="width:100%" class="select2" id="nm_lokasi" />
								</div>
							</div>

							<!--
							<div class="form-row">
								<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
									<label class="form-label" for="no_kunjungan">Urutan Kunjungan <span class="text-danger">*</span> </label>
									<input type="text" style="width:100%" class="select2" id="no_kunjungan" />
								</div>
							</div>
							-->

							<input type="hidden" class="form-control form-control-sm" id="id_jns_sales" value="<?php echo isset($id_jns_sales) ? $id_jns_sales : 0; ?>" />
							<input type="hidden" class="form-control form-control-sm" id="id_sales" value="<?php echo isset($id_sales) ? $id_sales : 0; ?>" />
							<input type="hidden" class="form-control form-control-sm" id="hari" value="<?php echo isset($hari) ? $hari : ''; ?>" />
							<input type="hidden" class="form-control form-control-sm" id="tanggal" value="<?php echo isset($tanggal) ? $tanggal : ''; ?>" />
							<input type="hidden" class="form-control form-control-sm" id="id_tap" value="<?php echo isset($id_tap) ? $id_tap : 0; ?>" />
							<input type="hidden" class="form-control form-control-sm" id="id_pjp" value="<?php echo isset($id_pjp) ? $id_pjp : 0; ?>" />
							<input type="hidden" class="form-control form-control-sm" id="id_jns_lokasi" value="" />
							<input type="hidden" class="form-control form-control-sm" id="no_kunjungan" value="<?php echo isset($data['no_kunjungan']) ? $data['no_kunjungan'] : 1; ?>" />

							<!-- End -->
						</div>
						<div class="panel-content py-3 rounded-bottom border-faded border-left-0 border-right-0 border-bottom-0 text-right">
							<button type="button" class="btn btn-sm btn-primary" id="btn-batal"><i class="fal fa-times"></i> Batal</button>
							<button type="button" class="btn btn-sm btn-primary" id="btn-simpan"><i class="fal fa-save"></i> Simpan</button>
						</div>
					</form>

					<script>
						$(document).ready(function()
						{
							$('#btn-batal').click(function(){
								bootbox.hideAll(); // Hide all bootbox
							});

							$('#btn-simpan').click(function(){
								var id_sales = $('#id_sales').val();
								var id_lokasi = $('#nm_lokasi').val();
								var id_jenis_lokasi = $('#id_jns_lokasi').val();
								var id_pjp = $('#id_pjp').val();
								var hari = $('#hari').val();
								var tanggal = $('#tanggal').val();
								var no_kunjungan = $('#no_kunjungan').val();

								if (id_lokasi == 0 || id_lokasi == null || id_lokasi == '')
								{
									show_warning('Silakan pilih tempat terlebih dahulu.');
									return false;
								}
								else if (no_kunjungan == 0 || no_kunjungan == null || no_kunjungan == '')
								{
									show_warning('Silakan pilih urutan kunjungan terlebih dahulu.');
									return false;
								}

								// Start looding
								var looding = bootbox.dialog({
									size: 'small',
									closeButton: false,
									message: '<div class="text-center"><i class="fal fa-spinner fa-pulse fa-lg fa-fw"></i> Loading...</div>',
									className: 'modal-looding'
								});

								$.ajax({
									url: GLOBAL_MAIN_VARS["BASE_URL"] + GLOBAL_MAIN_VARS["MODUL"] + '/proses',
									type: 'post',
									dataType: 'json',
									data: {
										id_sales: id_sales,
										id_lokasi:id_lokasi,
										id_jenis_lokasi: id_jenis_lokasi,
										id_pjp: id_pjp,
										hari: hari,
										tanggal: tanggal,
										no_kunjungan: no_kunjungan
									},
									success: function(res, xhr){
										if (res.isSuccess)
										{
											show_success(res.message);

											reload_senin();
											reload_selasa();
											reload_rabu();
											reload_kamis();
											reload_jumat();
											reload_sabtu();

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

							$('#nm_lokasi').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_lokasi_inpjp',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_tap': $('#id_tap').val(),
											'id_jns_sales': $('#id_jns_sales').val(),
											'id_sales': $('#id_sales').val(),
											'hari': $('#hari').val(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Tempat',
								allowClear: true,
								openOnEnter: false,
								dropdownAutoWidth : true,
								initSelection: function(element, callback){
									var data = {'text': element.val()};
									callback(data);
								},
								formatResult: function(res){
									// return '<div>' + res.nama + '</div>';
									return '<div><b>' + res.nama + '</b></div><div style="border-bottom:1px solid #ccc">' + res.kode + '</div>';
								}
							});
							$('#nm_lokasi').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('nm_lokasi');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									$('#id_jns_lokasi').val(e.added ? e.added.jenis_lokasi : '');

									return false;
								}
								e.stopPropagation();
							});

							/* $('#no_kunjungan').select2({
								minimumInputLength: 0,
								ajax: {
									url: GLOBAL_MAIN_VARS["BASE_URL"] + 'pilih/get_no_kunjungan',
									type: 'POST',
									dataType: 'json',
									quietMillis: 200,
									data: function(term){
										return {
											'id_sales': $('#id_sales').val(),
											'hari': $('#hari').val(),
											'q': term
										}
									},
									results: function(data){
										return {results: data.results}
									},
								},
								placeholder: 'Pilih Urutan Kunjungan',
								allowClear: true,
								openOnEnter: false,
								dropdownAutoWidth : true,
								initSelection: function(element, callback){
									var data = {'text': element.val()};
									callback(data);
								},
								formatResult: function(res){
									return '<div>' + res.nama + '</div>';
								}
							});
							$('#no_kunjungan').on('change', function(e){
								var idx = e.target.id;
								var pos = idx.indexOf('no_kunjungan');

								if (pos > -1)
								{
									var pre = idx.substring(0, pos);

									return false;
								}
								e.stopPropagation();
							}); */
						});
					</script>