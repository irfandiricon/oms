<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>/assets/image/login.png">
	<title>Login To System</title>
	<link href="<?php echo base_url(); ?>/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/assets/fontawesome/css/all.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>/assets/Admin/js/lib/jquery/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>/assets/bootstrap/dist/js/popper.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>/assets/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>/assets/sweetalert.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>/assets/JavaScript/login.js" type="text/javascript"></script>
</head>
<body style="background: #303540;">
	<div class="container-fluid" style="padding-top: 20px;">
		<div class="row">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 form-input"></div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 form-input">
				<form name="formData" id="formData" method="post" action="javascript:void(0)" data-url="<?php echo base_url('login/check')?>">
					<div class="card">
						<div class="card-header">
							<h4 style="font-weight: bold;">Log In</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
									Username
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-input">
									<input type="text" name="username" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-input">
									Password
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 form-input">
									<div class="input-group mb-3">
										<input type="password" class="form-control" id="password" name="password">
										<div class="input-group-append">
											<span class="input-group-text" id="show-pw" style="background-color: white;cursor: pointer;">
												<i class="fa fa-eye" id="icon-password"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="card-footer">
							<div class="row" align="center">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<button class="btn btn-primary" type="button" onclick="submitform()">
										Log In
									</button>&nbsp;
									<button class="btn btn-danger" type="reset">
										Reset
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<style type="text/css">
		div.card-header{
			background-color: #303540;
			color: white;
		}

		.form-input{
			padding-top: 15px;
		}
	</style>

	<script type="text/javascript">
		$(function(){
			$('#show-pw').click(function(){
				var getshow = $(this).find('i.fa-eye');
				var gethide = $(this).find('i.fa-eye-slash');
				if(getshow.length > 0){
					$('#password').attr({'type':'text'});
					$('#icon-password').removeClass().addClass('fa fa-eye-slash');
				}

				if(gethide.length > 0){
					$('#password').attr({'type':'password'});
				$('#icon-password').removeClass().addClass('fa fa-eye');
				}
			})
		});
	</script>
</body>
</html>