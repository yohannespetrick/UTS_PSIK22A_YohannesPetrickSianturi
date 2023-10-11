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
      
    if (isset($_GET['id'])) {
      $post_id = $_GET['id'];
      $check_this_account = mysqli_query($db, "SELECT * FROM users WHERE user_id = '$post_id'");
      if (mysqli_num_rows($check_this_account) == 0) {
        header("Location: ".$cfg_baseurl."logout.php");
      } else {

        $data_this_account = mysqli_fetch_assoc($check_this_account);
        include("../../../lib/header.php");
          
          if (isset($_POST['delete'])) {
              $check_account = mysqli_query($db, "SELECT user_id FROM users WHERE user_id = '$post_id'");
              if (mysqli_num_rows($check_account) == 0) {
                  $msg_type = "error";
                  $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Data tidak ditemukan.<script>swal("Gagal!", "Data tidak ditemukan.", "error");</script>';
              } else {
                  $delete = mysqli_query($db, "DELETE FROM users WHERE user_id = '$post_id'");
                  if ($delete == TRUE) {
                      $msg_type = "success";
                      $msg_content = '<b>Respon:</b> Berhasil!<br /><b>Pesan:</b><br />- Pengguna berhasil dihapus.<script>swal("Berhasil!", "Pengguna berhasil dihapus.", "success");</script>';
                  } else {
                      $msg_type = "error";
                      $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Sistem bermasalah, hubungi tim IT.<script>swal("Gagal!", "Sistem bermasalah, hubungi tim IT!", "error");</script>';
                  }
              }
          }
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
  var url = "<?php echo $cfg_baseurl; ?>admin/users/"; // URL Tujuan
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
  </div>
  <div class="col-lg-12">
    <div class="card-box">
      <ul class="nav nav-tabs tabs-bordered">
        <li class="nav-item">
          <a href="#kelola-users-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
          Hapus Pengguna
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="kelola-users-tab">
            <form class="form-horizontal" role="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Username</label>
                    <input type="text" name="username" autocomplete="off" class="form-control" value="<?php echo $data_this_account['username']; ?>" readonly>
                </div>
                <div class="form-group">
                    <a href="<?php echo $cfg_baseurl; ?>admin/users/" class="btn border-warning text-warning btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light" name="delete">Ya Hapus</button>
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
      header("Location: ".$cfg_baseurl."logout.php");
    }
  }
} else {
  header("Location: ".$cfg_baseurl);
}
?>