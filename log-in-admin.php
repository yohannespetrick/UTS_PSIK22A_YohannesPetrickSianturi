<?php
session_start();
require("mainconfig.php");
$msg_type = "nothing";

// DIBUAT OLEH YOHANNES PETRICK SIANTURI
// INSTITUT TEKNOLOGI DAN BISNIS BINA SARANA GLOBAL - TEKNIK INFORMATIKA
// JUNIOR WEB DEVELOPER - POLITEKNIK NEGERI PADANG

if (isset($_SESSION['user'])) {
	header("Location: ".$cfg_baseurl);
} else {
	if (isset($_POST['login'])) {
		$post_username = mysqli_real_escape_string($db, trim($_POST['username']));
		$post_password = mysqli_real_escape_string($db, trim($_POST['password']));
		if (empty($post_username) || empty($post_password)) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Mohon mengisi semua input.<script>swal("Error!", "Mohon mengisi semua input.", "error");</script>';
		} else {
			$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$post_username'");
			if (mysqli_num_rows($check_user) == 0) {
				$msg_type = "error";
				$msg_content = '<b>Gagal:</b> Username tidak ditemukan.<script>swal("Error!", "Username tidak ditemukan.", "error");</script>';
			} else {
				$data_user = mysqli_fetch_assoc($check_user);
				if (md5($post_password) <> $data_user['password']) {
					$msg_type = "error";
					$msg_content = '<b>Gagal:</b> Password salah.<script>swal("Error!", "Password salah.", "error");</script>';
				} else if ($data_user['status'] == "Suspended") {
					$msg_type = "error";
					$msg_content = '<b>Gagal:</b> Akun telah dinonaktifkan.<script>swal("Error!", "Akun telah dinonaktifkan.", "error");</script>';
				} else {
				    $msg_type = "success";
					$msg_content = '<b>Berhasil:</b> Login Berhasil!<script>swal("Success", "Login Berhasil!", "success");</script>';
					$_SESSION['user'] = $data_user;
				}
			}
		}
	}
}

include("lib/header.php");
?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="card-title text-center">
                                    Please <span class="text-primary">LOGIN</span>
                                    </h4>
                                    <hr>
									<?php
									if ($msg_type == "success") {
									?>
									<div class="alert alert-success">
									    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                          <i class="fa fa-check-circle"></i>
                                          <?php echo $msg_content; ?>
                                    </div>
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                                    <script>
                                    var url = "<?php echo $cfg_baseurl; ?>"; // URL Tujuan
                                    var count = 1; // dalam detik
                                    function countDown() {
                                        if (count > 0) {
                                            count--;
                                            var waktu = count + 1;
                                            $('#respon').html('<b>Memuat halaman dalam ' + waktu + ' Detik.');
                                            setTimeout("countDown()", 1000);
                                        } else {
                                            window.location.href = url;
                                        }
                                    }
                                    countDown();
                                    </script>
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
									        <div class="col-md-12">
									            <input type="text" name="username" class="form-control" placeholder="Username">
									        </div>
									    </div>
									    <div class="form-group">
									        <div class="col-md-12">
									            <input type="password" name="password" class="form-control" placeholder="Password">
											</div>
										</div>
										<div class="form-group">
										    <div class="col-md-12">
										        <input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">Remember me</label>
										    </div>
										</div>
										<div class="form-group">
										    <button type="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light btn-block" name="login">Masuk</button>
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
?>