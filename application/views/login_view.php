<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>
			Login Hore
		</title>
		<meta name="description" content="Login">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="msapplication-tap-highlight" content="no">
		<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/vendors.bundle.css">
		<link id="appbundle" rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/app.bundle.css">
		<link id="myskin" rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/skins/skin-master.css">
		<link rel="icon" type="image/png" sizes="70x70" href="<?php echo base_url(); ?>data/img/logo/favicon.png">
		<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/fa-brands.css">
		<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/notifications/sweetalert2/sweetalert2.bundle.css">
		<style>
			.shadow-text {
				box-shadow: 4px 4px #7a00c9;
				border: 1px solid #7a00c9;
			}
		</style>
	</head>
    <!-- BEGIN Body -->
	<body>
		<div class="page-wrapper">
			<div class="page-inner" style="background: url(<?php echo base_url(); ?>data/img/bg/bg-login-img.png) no-repeat center bottom fixed; background-size: cover;">
				<div class="page-content-wrapper bg-transparent m-0">
					<div class="flex-1">
						<div class="container-fluid" style="width: 95%">
							<div class="row">
								<div class="col-md-12 text-right">
									<img class="img-fluid" src="<?php echo base_url(); ?>data/img/bg/telkomsel.png" style="height: 55px; margin-top: 20px;">
								</div>
							</div>
							<div class="row">
								<div class="col-md-1 hidden-sm-down">&nbsp;</div>
								<div class="col-md-5">
									<img class="img-fluid" src="<?php echo base_url(); ?>data/img/bg/logo-login-img.png">
								</div>
								<div class="col-md-4">
									<div style="padding-left: 20px; padding-top: 85px; width: 85%;">
										<div id="form1">
											<div class="form-group">
												<label class="form-label" for="username" style="color: #7a00c9">USERNAME</label>
												<input type="text" id="username" class="form-control shadow-text" placeholder="Username" autofocus="" autocomplete="off">
											</div>
											<div class="form-group">
												<label class="form-label" for="password" style="color: #7a00c9">PASSWORD</label>
												<input type="password" id="password" class="form-control shadow-text" placeholder="password">
											</div>
											<div class="row mb-3">
												<div class="col-sm-5 mt-2">
													<button id="btn-login" type="button" class="btn btn-info btn-block btn-sm">Login</button>
												</div>
												<div class="col-sm-1 mt-2 hidden-sm-down">
													&nbsp;
												</div>
												<div class="col-sm-6 mt-2">
													<button id="btn-reset" type="button" class="btn btn-danger btn-block btn-sm" style="background-color: red">Reset Password</button>
												</div>
											</div>
										</div>

										<div id="form2" style="display: none">
											<h4 style="color: #7a00c9">RESET PASSWORD</h4>
											<span class="mt-2">>> Kode akan dikirimkan ke email terdaftar</span>
											<div class="form-group mt-2">
												<label class="form-label" for="username" style="color: #7a00c9">USERNAME</label>
												<input type="text" id="username-kode" class="form-control shadow-text" placeholder="Username">
											</div>
											<div class="row mb-4">
												<div class="col-sm-5 mt-2">
													<button id="btn-kembali" type="button" class="btn btn-info btn-block btn-sm">
														Kembali Login
													</button>
												</div>
												<div class="col-sm-1 mt-2 hidden-sm-down">
													&nbsp;
												</div>
												<div class="col-sm-6 mt-2">
													<button id="btn-kirim" type="button" class="btn btn-info btn-block btn-sm">
														Kirim Kode Verifikasi
													</button>
												</div>
											</div>
										</div>

										<div id="form3" style="display: none">
											<h4 style="color: #7a00c9">RESET PASSWORD</h4>
											<span class="mt-2">>> Kode sudah terkirim ke email terdaftar</span>
											<div class="form-group mt-2">
												<label class="form-label" for="username" style="color: #7a00c9">USERNAME</label>
												<input type="text" id="kode-verf" class="form-control shadow-text" placeholder="Kode Verifikasi">
											</div>
											<div class="form-group">
												<label class="form-label" for="username" style="color: #7a00c9">PASSWORD BARU</label>
												<input type="password" id="pass-baru" class="form-control shadow-text" placeholder="Password Baru">
											</div>
											<div class="form-group">
												<label class="form-label" for="username" style="color: #7a00c9">KONFIRMASI PASSWORD BARU</label>
												<input type="password" id="konf-pass-baru" class="form-control shadow-text" placeholder="Konfirmasi Password Baru">
											</div>
											<div class="row mb-4">
												<div class="col-sm-5 mt-2">
													<button id="btn-kembali-2" type="button" class="btn btn-info btn-block btn-sm">
														Kembali Login
													</button>
												</div>
												<div class="col-sm-1 mt-2 hidden-sm-down">
													&nbsp;
												</div>
												<div class="col-sm-6 mt-2">
													<button id="btn-submit" type="button" class="btn btn-info btn-block btn-sm">
														Submit
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<p id="js-color-profile" class="d-none">
			<span class="color-primary-50"></span>
			<span class="color-primary-100"></span>
			<span class="color-primary-200"></span>
			<span class="color-primary-300"></span>
			<span class="color-primary-400"></span>
			<span class="color-primary-500"></span>
			<span class="color-primary-600"></span>
			<span class="color-primary-700"></span>
			<span class="color-primary-800"></span>
			<span class="color-primary-900"></span>
			<span class="color-info-50"></span>
			<span class="color-info-100"></span>
			<span class="color-info-200"></span>
			<span class="color-info-300"></span>
			<span class="color-info-400"></span>
			<span class="color-info-500"></span>
			<span class="color-info-600"></span>
			<span class="color-info-700"></span>
			<span class="color-info-800"></span>
			<span class="color-info-900"></span>
			<span class="color-danger-50"></span>
			<span class="color-danger-100"></span>
			<span class="color-danger-200"></span>
			<span class="color-danger-300"></span>
			<span class="color-danger-400"></span>
			<span class="color-danger-500"></span>
			<span class="color-danger-600"></span>
			<span class="color-danger-700"></span>
			<span class="color-danger-800"></span>
			<span class="color-danger-900"></span>
			<span class="color-warning-50"></span>
			<span class="color-warning-100"></span>
			<span class="color-warning-200"></span>
			<span class="color-warning-300"></span>
			<span class="color-warning-400"></span>
			<span class="color-warning-500"></span>
			<span class="color-warning-600"></span>
			<span class="color-warning-700"></span>
			<span class="color-warning-800"></span>
			<span class="color-warning-900"></span>
			<span class="color-success-50"></span>
			<span class="color-success-100"></span>
			<span class="color-success-200"></span>
			<span class="color-success-300"></span>
			<span class="color-success-400"></span>
			<span class="color-success-500"></span>
			<span class="color-success-600"></span>
			<span class="color-success-700"></span>
			<span class="color-success-800"></span>
			<span class="color-success-900"></span>
			<span class="color-fusion-50"></span>
			<span class="color-fusion-100"></span>
			<span class="color-fusion-200"></span>
			<span class="color-fusion-300"></span>
			<span class="color-fusion-400"></span>
			<span class="color-fusion-500"></span>
			<span class="color-fusion-600"></span>
			<span class="color-fusion-700"></span>
			<span class="color-fusion-800"></span>
			<span class="color-fusion-900"></span>
		</p>

		<script src="<?php echo base_url(); ?>assets/js/notifications/sweetalert2/sweetalert2.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/vendors.bundle.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/app.bundle.js"></script>

		<script>
			$(document).ready(function(){
				$("#username, #password").keypress(function(e){
    			if (e.which==13){
    				$('#btn-login').click();
    				return false;
    			}
    		});

				$("#btn-login").click(function(){
    			var username = $('#username').val();
    			var password = $('#password').val();

    			if (username == '')
    			{
    				$('#username').focus();
    				Swal.fire('Username tidak boleh kosong', '', 'warning');
    			}
    			else if (password == '')
    			{
    				$('#password').focus();
    				Swal.fire('Password tidak boleh kosong', '', 'warning');
    			}
    			else
    			{
    				$.ajax({
    					type: 'POST',
    					url: "<?php echo base_url().'login/do_login/' ?>",
    					dataType: 'json',
    					data:{
    						t_username: username,
    						t_password: password
    					},
    					success: function(data)
    					{
								var id_level = data.id_level;

    						if (data.status == 'failed')
    						{
    							Swal.fire(data.content, '', 'warning');
    						}
    						else
    						{
									if (id_level == 1 || id_level == 2 || id_level == 3 || id_level == 4)
									{
										window.location = '<?php echo base_url(); ?>dashboard_coverage';
									}
									else if (id_level == 9)
									{
										window.location = '<?php echo base_url(); ?>daftar_penjualan';
									}
    						}
    					}
    				});
    			}
    		});

				$("#btn-reset").click(function(){
					$('#username-kode').val('');

					$('#form1').hide();
					$('#form2').show();
					$('#form3').hide();
				});

				$("#btn-kembali").click(function(){
					$('#username-reset').val('');

					$('#form1').show();
					$('#form2').hide();
					$('#form3').hide();
				});

				$("#btn-kirim").click(function(){
					var username = $('#username-kode').val();

					if (username == '')
					{
						$('#username-kode').focus();
						Swal.fire('Username tidak boleh kosong', '', 'warning');
					}
					else
					{
						$.ajax({
							type: 'POST',
							url: "<?php echo base_url().'auth/check_account/' ?>",
							dataType: 'json',
							data:{username: username},
							success: function(data)
							{
								if (data.status == 'failed')
								{
									Swal.fire(data.content, '', 'warning');
								}
								else
								{
									$.ajax({
										url: "<?php echo base_url().'auth/process_code/' ?>",
										type: 'post',
										dataType: 'json',
										data:{username: username},
										success: function(res, xhr){
											if (res.isSuccess)
											{
												$('#form1').show();
												$('#form2').hide();
												$('#form3').hide();
											}
											else
											{
												Swal.fire(res.message, '', 'warning');
											}
										}
									});
								}
							}
						});
					}
				});

				$("#btn-kembali-2").click(function(){
					$('#username-kode').val('');

					$('#kode-verf').val('');
					$('#pass-baru').val('');
					$('#konf-pass-baru').val('');

					$('#form1').show();
					$('#form2').hide();
					$('#form3').hide();
				});

				$("#btn-submit").click(function(){
					var username = $('#username-kode').val();
					var kode = $('#kode-verf').val();
					var pass_1 = $('#pass-baru').val();
					var pass_2 = $('#konf-pass-baru').val();

					if (kode == '')
					{
						$('#kode-verf').focus();
						Swal.fire('Kode Verifikasi tidak boleh kosong', '', 'warning');
					}
					else if (pass_1 == '')
					{
						$('#pass-baru').focus();
						Swal.fire('Password Baru tidak boleh kosong', '', 'warning');
					}
					else if (pass_2 == '')
					{
						$('#konf-pass-baru').focus();
						Swal.fire('Konfirmasi Password Baru tidak boleh kosong', '', 'warning');
					}
					else
					{
						if (pass_1 !== pass_2)
						{
							Swal.fire('Password Baru dan Konfirmasi Password Baru tidak sama', '', 'warning');
						}
						else
						{
							$.ajax({
								type: 'POST',
								url: "<?php echo base_url().'auth/check_code/' ?>",
								dataType: 'json',
								data:{
									username: username,
									kode: kode
								},
								success: function(data)
								{
									if (data.status == 'failed')
									{
										Swal.fire(data.content, '', 'warning');
									}
									else
									{
										$.ajax({
											url: "<?php echo base_url().'auth/process_reset/' ?>",
											type: 'post',
											dataType: 'json',
											data:{
												username: username,
												kode: kode,
												pass: pass_1
											},
											success: function(res, xhr){
												if (res.isSuccess)
												{
													var id_level = res.id_level;

													if (id_level == 1 || id_level == 2 || id_level == 3 || id_level == 4)
													{
														window.location = '<?php echo base_url(); ?>dashboard_coverage';
													}
													else if (id_level == 9)
													{
														window.location = '<?php echo base_url(); ?>daftar_penjualan';
													}
												}
												else
												{
													Swal.fire(res.message, '', 'warning');
												}
											}
										});
									}
								}
							});
						}
					}
				});
			});
		</script>
	</body>
</html>
