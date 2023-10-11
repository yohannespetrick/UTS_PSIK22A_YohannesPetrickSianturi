<?php
session_start();
require("mainconfig.php");

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = mysqli_query($db, "SELECT username,level,status FROM users WHERE username = '$sess_username'");
	$data_user = mysqli_fetch_assoc($check_user);
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$cfg_baseurl."logout.php");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$cfg_baseurl."logout.php");
	}

	include("lib/header.php");
	$msg_type = "nothing";

	if (isset($_POST['change_pswd'])) {
		$post_password = trim($_POST['password']);
		$post_npassword = trim($_POST['npassword']);
		$post_cnpassword = trim($_POST['cnpassword']);
		
		$check_account = mysqli_query($db, "SELECT password FROM users WHERE username = '$sess_username'");
		$data_account = mysqli_fetch_assoc($check_account);
		if (empty($post_password) || empty($post_npassword) || empty($post_cnpassword)) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Mohon mengisi semua input.<script>swal("Error!", "Mohon mengisi semua input.", "error");</script>';
		} else if (md5($post_password) <> $data_account['password']) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Password saat ini salah.<script>swal("Error!", "Password saat ini salah.", "error");</script>';
		} else if (strlen($post_npassword) < 5) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Password baru telalu pendek, minimal 5 karakter.<script>swal("Error!", "Password tidak sesuai.", "error");</script>';
		} else if ($post_cnpassword <> $post_npassword) {
			$msg_type = "error";
			$msg_content = '<b>Gagal:</b> Konfirmasi password baru tidak sesuai.<script>swal("Error!", "Password tidak sesuai.", "error");</script>';
		} else {
		    $hash_password = md5($post_npassword);
			$update_user = mysqli_query($db, "UPDATE users SET password = '$hash_password' WHERE username = '$sess_username'");
			if ($update_user == TRUE) {
				$msg_type = "success";
				$msg_content = '<b>Success:</b> Password berhasil diubah.<script>swal("Success!", "Password berhasil diubah.", "success");</script>';
			} else {
				$msg_type = "error";
				$msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Sistem bermasalah, hubungi tim IT.<script>swal("Gagal!", "Sistem bermasalah, hubungi tim IT!", "error");</script>';
			}
		}
	}
?>
						<div class="row">
							<div class="col-md-12">
										<?php 
										if ($msg_type == "success") {
										?>
										<div class="alert alert-success">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
											<i class="fa fa-check-circle"></i>
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
							</div>
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h4 class="text-dark card-title m-t-0">Ubah Password</h4>
										<form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-3 control-label">Password Saat Ini</label>
												<div class="col-md-9">
													<input type="password" name="password" class="form-control" placeholder="Password">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Password Baru</label>
												<div class="col-md-9">
													<input type="password" name="npassword" class="form-control" placeholder="Password Baru">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label">Konfirmasi Password Baru</label>
												<div class="col-md-9">
													<input type="password" name="cnpassword" class="form-control" placeholder="Konfirmasi Password Baru">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-2 col-md-10">
											<button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light" name="change_pswd">Ubah Password</button>
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
} else {
	header("Location: ".$cfg_baseurl);
}
?>