<?php
session_start();
require("mainconfig.php");
$msg_type = "nothing";

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT username,level,status FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	}

	$check_order = mysqli_query($db, "SELECT SUM(price) AS total FROM orders WHERE user = '$sess_username'");
	$data_order = mysqli_fetch_assoc($check_order);
} else {
	if (isset($_POST['signup'])) {
		$post_fullname = htmlspecialchars($_POST['fullname']);
		$post_username = htmlspecialchars($_POST['username']);
		$post_email = htmlspecialchars($_POST['email']);
		$post_password = htmlspecialchars($_POST['password']);
		$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
		$check_email = mysqli_query($db, "SELECT * FROM users WHERE email = '$post_email'");
		if (empty($post_fullname) || empty($post_username) || empty($post_email) || empty($post_password)) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Mohon mengisi semua input.<script>swal("Error!", "Mohon mengisi semua input.", "error");</script>';
		} else if (mysqli_num_rows($check_user) > 0) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Username sudah terdaftar.<script>swal("Error!", "Username sudah terdaftar.", "error");</script>';
		} else if (mysqli_num_rows($check_email) > 0) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Email sudah terdaftar.<script>swal("Error!", "Email sudah terdaftar.", "error");</script>';
		} else if (strlen($post_password) < 5) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Password minimal 5 karakter.<script>swal("Error!", "Password minimal 5 karakter.", "error");</script>';
		} else {
			$enkripsi_pswd = md5($post_password);
			$insert_user = mysqli_query($db, "INSERT INTO users (fullname, username, email, password, level, registered, status, uplink) VALUES ('$post_fullname','$post_username', '$post_email', '$enkripsi_pswd', 'Staff', '$date', 'Active', 'Website')");
			if ($insert_user == true) {
				$msg_type = "success";
				$msg_content = '<b>Berhasil:</b> Akun anda berhasil didaftarkan, silahkan login.<script>swal("Success!", "Akun anda berhasil didaftarkan, silahkan login.", "success");</script>';
			} else {
				$msg_type = "error";
				$msg_content = '<b>Gagal:</b> Kesalahan sistem.<script>swal("Error!", "Kesalahan sistem.", "error");</script>';
			}
		}
	}
include("lib/header.php");
?>
						<div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                		<?php 
										if ($msg_type == "success") {
										?>
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										} else if ($msg_type == "error") {
										?>
										<div class="alert alert-danger">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-times-circle"></i>
											<?php echo $msg_content; ?>
										</div>
										<?php
										}
										?>
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-2 control-label">Nama Lengkap</label>
												<div class="col-md-10">
													<input type="text" name="fullname" class="form-control" placeholder="Masukkan nama lengkap">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Username</label>
												<div class="col-md-10">
													<input type="text" name="username" class="form-control" placeholder="Masukkan username">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Email</label>
												<div class="col-md-10">
													<input type="email" name="email" class="form-control" placeholder="Masukkan email">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Password</label>
												<div class="col-md-10">
													<input type="password" name="password" class="form-control" placeholder="Masukkan password">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
													<button type="submit" class="btn btn-danger btn-bordered waves-effect w-md waves-light btn-block" name="signup">Daftar</button>
													<div class="panel-footer">
													    <small>Sudah punya akun?  login <a href="log-in-admin" class="text-success">klik disini</a></small>
													</div>
											    </div>
											</div>
									    </form>
							    </div>
							</div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->


                    </div>
                    <!-- end container -->
                </div>
                <!-- end content -->
<?php
include("lib/footer.php");
}
?>