<?php
session_start();
require("../../../mainconfig.php");

if (isset($_SESSION['user'])) {
    $sess_username = $_SESSION['user']['username'];
    $check_user = mysqli_query($db, "SELECT user_id,username,level,status FROM users WHERE username = '$sess_username'");
    $data_user = mysqli_fetch_assoc($check_user);
    $user_id = $data_user['user_id'];
    if (mysqli_num_rows($check_user) == 0) {
        header("Location: ".$cfg_baseurl."logout.php");
    } else if ($data_user['status'] == "Suspended") {
        header("Location: ".$cfg_baseurl."logout.php");
    } else if ($data_user['level'] != "Admin" && $data_user['level'] != "Staff") {
        header("Location: ".$cfg_baseurl."logout.php");
    } else {

        // JANGAN DIHAPUS INI BERPERAN PENTING //
        $maks_limit_fullname = 100;
        $maks_limit_username = 100;
        $maks_limit_email = 255;
        $maks_limit_password = 100;
        // JANGAN DIHAPUS INI BERPERAN PENTING //
        
        if (isset($_POST['add'])) {
            $post_level = htmlspecialchars($_POST['level']);
            $post_fullname = htmlspecialchars($_POST['fullname']);
            $post_username = htmlspecialchars($_POST['username']);
            $post_password = htmlspecialchars($_POST['password']);
            $post_email = htmlspecialchars($_POST["email"]);
            $post_status = htmlspecialchars($_POST["status"]);

            $check_account = mysqli_query($db, "SELECT username FROM users WHERE username = '$post_username'");
            if (empty($post_level) || empty($post_fullname) || empty($post_username) || empty($post_password) || empty($post_email) || empty($post_status)) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Mohon mengisi semua input.<script>swal("Gagal!", "Mohon mengisi semua input.", "error");</script>';
            } else if (mysqli_num_rows($check_account) > 0) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Data '.$post_username.' sudah pernah terdaftar.<script>swal("Gagal!", "Data '.$post_username.' sudah pernah terdaftar!", "error");</script>';
            } elseif(strlen($post_fullname) > $maks_limit_fullname) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom nama lengkap adalah '.$maks_limit_fullname.' karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom nama lengkap adalah '.$maks_limit_fullname.' karakter!", "error");</script>';
            } elseif(strlen($post_username) > $maks_limit_username) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom username adalah '.$maks_limit_username.' karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom username adalah '.$maks_limit_username.' karakter!", "error");</script>';
            } elseif(strlen($post_email) > $maks_limit_email) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom email adalah '.$maks_limit_email.' karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom email adalah '.$maks_limit_email.' karakter!", "error");</script>';
            } elseif(strlen($post_password) > $maks_limit_password) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom password adalah '.$maks_limit_password.' karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom password adalah '.$maks_limit_password.' karakter!", "error");</script>';
            } else {
                $hash_password = md5($post_password);
                $insert = mysqli_query($db, "INSERT INTO users (fullname, username, email, password, level, registered, status, uplink) VALUES ('$post_fullname', '$post_username', '$post_email',  '$hash_password', '$post_level', '$date', '$post_status', '$sess_username')");
                if ($insert == TRUE) {
                    $msg_type = "success";
                    $msg_content = '<b>Respon:</b> Berhasil!<br /><b>Pesan:</b><br />Pengguna berhasil ditambahkan.<script>swal("Berhasil!", "Pengguna berhasil ditambahkan.", "success");</script>';
                } else {
                    $msg_type = "error";
                    $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Sistem bermasalah, hubungi tim IT.<script>swal("Gagal!", "Sistem bermasalah, hubungi tim IT!", "error");</script>';
                }
            }
        }

    include("../../../lib/header.php");
?>
<div class="row">
  <div class="col-lg-12">
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
  <div class="col-lg-12">
    <div class="card-box">
      <ul class="nav nav-tabs tabs-bordered">
        <li class="nav-item">
          <a href="#kelola-users-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
          Tambah Pengguna
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="kelola-users-tab">
            <form class="form-horizontal" role="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Level Akses</label>
                    <select class="form-control" name="level" required>
                        <option value="0">Pilih level..</option>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Nama Lengkap</label>
                    <input type="text" name="fullname" autocomplete="off" class="form-control" placeholder="Masukkan nama lengkap.." maxlength="<?php echo $maks_limit_fullname; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Username</label>
                    <input type="text" name="username" autocomplete="off" class="form-control" placeholder="Masukkan username.." maxlength="<?php echo $maks_limit_username; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" name="password" autocomplete="off" class="form-control" placeholder="Masukkan password.." maxlength="<?php echo $maks_limit_password; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="email" name="email" autocomplete="off" class="form-control" placeholder="Masukkan email.." maxlength="<?php echo $maks_limit_email; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Status Akun</label>
                    <select class="form-control" name="status" required>
                        <option value="0">Pilih status akun..</option>
                        <option value="Active">Active</option>
                        <option value="Suspended">Suspended</option>
                    </select>
                </div>
                <div class="form-group">
                    <a href="<?php echo $cfg_baseurl; ?>admin/users/" class="btn border-warning text-warning btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
                    <div class="pull-right">
                        <button type="reset" class="btn btn-dark btn-bordered waves-effect w-md waves-light">Reset</button>
                        <button type="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light" name="add">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- END panel-->
      </div>
    </div>
  </div>
</div>
<!-- end row -->
<?php
    include("../../../lib/footer.php");
    }
} else {
    header("Location: ".$cfg_baseurl);
}
?>