<?php 
$CustomConfig = new \Config\CustomConfig();
$Apps = $CustomConfig->apps;

$SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();

$USERNAME = isset($SESSION_LOGIN->USERNAME) ? $SESSION_LOGIN->USERNAME:"";
$NAME = isset($SESSION_LOGIN->NAME) ? $SESSION_LOGIN->NAME:"";
$EMAIL = isset($SESSION_LOGIN->EMAIL) ? $SESSION_LOGIN->EMAIL:"";
$NOHP = isset($SESSION_LOGIN->NOHP) ? $SESSION_LOGIN->NOHP:"";
$LEVEL = isset($SESSION_LOGIN->LEVEL) ? $SESSION_LOGIN->LEVEL:"";
?>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 row-input">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th colspan="2" style="text-align: left;">
									<h3 style="font-weight: bold;">Info Akun</h3>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td width="150">Username</td>
								<td style="text-align: left;"><?php echo $USERNAME ?></td>
							</tr>
							<tr>
								<td>Nama Lengkap</td>
								<td style="text-align: left;"><?php echo $NAME ?></td>
							</tr>
							<tr>
								<td>No. Telp/HP</td>
								<td style="text-align: left;"><?php echo $NOHP ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td style="text-align: left;"><?php echo $EMAIL ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 row-input">
				<form name="formData" id="formData" data-url="<?php echo base_url('changepassword/updatedata') ?>" method="post" action="javascript:void(0)">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 row-input">
									<h3 style="font-weight: bold;">Form Password</h3>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 row-input">
									Password Baru
								</div>
								<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 row-input">
									<input type="password" name="password2" id="password2" class="form-control form-input">
								</div>
							</div>
							<div class="row">
								<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 row-input">
									Ulangi Password Baru
								</div>
								<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 row-input">
									<input type="password" name="password3" id="password3" class="form-control form-input">
								</div>
							</div>
							<div class="row">
								<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 row-input"></div>
								<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 row-input">
									<input type="checkbox" id="chk_pass" onchange="checkpass()">
									<span id="show_hide_pass">Show password</span>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 row-input"></div>
								<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 row-input">
									<button class="btn btn-primary" type="button" onclick="submitform()">
										<i class="fa fa-save"></i> Update
									</button>&nbsp;
									<button class="btn btn-danger" type="reset">
										<i class="fa fa-refresh"></i> Reset
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
