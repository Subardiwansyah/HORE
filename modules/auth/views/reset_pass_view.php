<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>- Hore -</title>
	<link href="<?php echo base_url(); ?>assets/login/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/login/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/login/css/responsive.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/login/css/color-switcher-design.css" rel="stylesheet">
	<link rel="icon" type="image/png" sizes="70x70" href="<?php echo base_url(); ?>data/img/logo/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" media="screen, print" href="<?php echo base_url(); ?>assets/css/notifications/sweetalert2/sweetalert2.bundle.css">
</head>

<body>
	<div class="page-wrapper">
		<div class="preloader"></div>
		<section class="about-section">
			<div class="anim-icons full-width">
				<span class="icon icon-circle-blue wow fadeIn"></span>
				<span class="icon icon-dots wow fadeInleft"></span>
				<span class="icon icon-circle-1 wow zoomIn"></span>
			</div>
			<div class="auto-container">
				<div class="row">
					<div class="content-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner-column">
							<div class="sec-title">
                                <div id="form-1">
    								<div align="center">
                                        <img style="width:75%;" src="<?php echo base_url(); ?>data/img/bg/bg-tengah-1.png">
                                    </div>
                                    <span class="title">RESET PASSWORD</span>
									<h8>Kode akan dikirimkan ke email terdaftar</h8><br><br>
									<div class="form-group">
										<label class="form-label" for="username">Username</label>
										<input type="text" id="username" class="form-control" placeholder="" autofocus="" autocomplete="off">
									</div>
									<div class="row no-gutters">
										<div class="col-lg-6">
											<button id="btn-reset" type="button" class="btn btn-primary">Kirim Kode Verifikasi</button>
										</div>
										<div class="col-lg-6 text-right">
    									    <a href="<?php echo base_url(); ?>login" class="btn" style="border:1px solid #8B8B8B;"><font color="#8B8B8B">Kembali Login</font></a>
    									</div>
									</div>
								</div>
								<br>
								<div id="form-2" style="display:none">
                                    <span class="title">RESET PASSWORD</span>
									<h8>Kode sudah terkirim ke email terdaftar</h8><br><br>
									<div class="form-row">
										<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
											<label class="form-label" for="kode">Enter Kode Verifikasi</label>
											<input type="text" class="form-control" id="kode">
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
											<label class="form-label" for="pass">Password Baru</label>
											<input type="password" class="form-control" id="pass">
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-12 col-sm-12 col-xs-12 mb-3">
											<label class="form-label" for="konf-pass">Konfirmasi Password Baru</label>
											<input type="password" class="form-control" id="konf-pass">
										</div>
									</div>
									<div class="row no-gutters">
										<div class="col-lg-6">
											<button id="btn-kirim" type="button" class="btn btn-primary"> Submit </button>
										</div>
										<div class="col-lg-6 text-right">
    									    <a href="<?php echo base_url(); ?>login" class="btn" style="border:1px solid #8B8B8B;"><font color="#8B8B8B">Kembali Login</font></a>
    									</div>
									</div>
									<br><br><br>
								</div>
							</div>
						</div>
					</div>
					<div class="image-column col-lg-6 col-md-12 col-sm-12">
						<div class="image-box">
							<figure class="image wow fadeIn"><img src="<?php echo base_url();?>assets/login/images/resource/logo600x600.png" style="border:10px solid #F1B602;width:370px;height:370px;"></figure>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<script src="<?php echo base_url();?>assets/login/js/jquery.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/popper.min.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/jquery-ui.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/jquery.fancybox.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/appear.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/owl.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/jquery.countdown.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/wow.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/script.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/color-settings.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/notifications/sweetalert2/sweetalert2.bundle.js"></script>

	<script>
		$("#btn-reset").click(function()
		{
			var username = $('#username').val();

			if (username == '')
			{
				$('#username').focus();
				Swal.fire('Username tidak boleh kosong', '', 'warning');
			}
			else
			{
				// $('#form-1').hide(); // Hanya digunakan dilocal
				// $('#form-2').show(); // Hanya digunakan dilocal

				$.ajax({
					type: 'POST',
					url: "<?php echo base_url().$modul.'/check_account/' ?>",
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
								url: "<?php echo base_url().$modul.'/process_code/' ?>",
								type: 'post',
								dataType: 'json',
								data:{username: username},
								success: function(res, xhr){
									if (res.isSuccess)
									{
										$('#form-1').hide();
										$('#form-2').show();
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

		$("#btn-kirim").click(function()
		{
			var username = $('#username').val();
			var kode = $('#kode').val();
			var pass_1 = $('#pass').val();
			var pass_2 = $('#konf-pass').val();

			if (kode == '')
			{
				$('#kode').focus();
				Swal.fire('Kode Verifikasi tidak boleh kosong', '', 'warning');
			}
			else if (pass_1 == '')
			{
				$('#pass').focus();
				Swal.fire('Password Baru tidak boleh kosong', '', 'warning');
			}
			else if (pass_2 == '')
			{
				$('#konf-pass').focus();
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
						url: "<?php echo base_url().$modul.'/check_code' ?>",
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
									url: "<?php echo base_url().$modul.'/process_reset' ?>",
									type: 'post',
									dataType: 'json',
									data:{
										username: username,
										kode: kode,
										pass: pass_1
										// username: 'tap001',
										// kode: 'WT8O0',
										// pass: '1234'
									},
									success: function(res, xhr){
										if (res.isSuccess)
										{
											window.location = '<?php echo base_url(); ?>dashboard';
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
	</script>
</body>
</html>