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
      $check_this_contact = mysqli_query($db, "SELECT * FROM contact WHERE contact_id = '$post_id'");
      if (mysqli_num_rows($check_this_contact) == 0) {
        header("Location: ".$cfg_baseurl."logout.php");
      } else {

        $data_this_contact = mysqli_fetch_assoc($check_this_contact);
        if($data_this_contact['contact_type'] == "wa"){
            $tampilnya = "Whatsapp";
        } elseif($data_this_contact['contact_type'] == "ig"){
            $tampilnya = "Instagram";
        }
        include("../../../lib/header.php");

        // JANGAN DIHAPUS INI BERPERAN PENTING //
        $maks_limit_contact_name = 100;
        $maks_limit_contact_target = 100;
        // JANGAN DIHAPUS INI BERPERAN PENTING //

        if (isset($_POST['edit'])) {
            $post_contact_type = htmlspecialchars($_POST['contact_type']);
            $post_contact_name = htmlspecialchars($_POST['contact_name']);
            $post_contact_target = htmlspecialchars($_POST['contact_target']);

            $check_contact = mysqli_query($db, "SELECT contact_name FROM contact WHERE contact_name = '$post_contact_name' AND contact_id != '$post_id'");
            if (empty($post_contact_type) || empty($post_contact_name) || empty($post_contact_target)) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Mohon mengisi semua input.<script>swal("Gagal!", "Mohon mengisi semua input.", "error");</script>';
            } else if (mysqli_num_rows($check_contact) > 0) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Data '.$post_contact_name.' sudah pernah terdaftar.<script>swal("Gagal!", "Data '.$post_contact_name.' sudah pernah terdaftar!", "error");</script>';
            } elseif(strlen($post_contact_name) > $maks_limit_contact_name) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom nama kontak adalah '.$maks_limit_contact_name.' karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom nama kontak adalah '.$maks_limit_contact_name.' karakter!", "error");</script>';
            } elseif(strlen($post_contact_target) > $maks_limit_contact_target) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom target kontak adalah '.$maks_limit_contact_target.' karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom target kontak adalah '.$maks_limit_contact_target.' karakter!", "error");</script>';
            } else {
                $update = mysqli_query($db, "UPDATE contact SET contact_name = '$post_contact_name', contact_type = '$post_contact_type', contact_target = '$post_contact_target' WHERE contact_id = '$post_id'");
                if ($update == TRUE) {
                    $msg_type = "success";
                    $msg_content = '<b>Respon:</b> Berhasil!<br /><b>Pesan:</b><br />Kontak berhasil diperbarui.<script>swal("Berhasil!", "Kontak berhasil diperbarui.", "success");</script>';
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
  var url = "<?php echo $cfg_baseurl; ?>admin/contact/edit/?id=<?php echo $post_id; ?>"; // URL Tujuan
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
          <a href="#kelola-contact-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
          Ubah Kontak
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="kelola-contact-tab">
            <form class="form-horizontal" role="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Tipe</label>
                    <select class="form-control" name="contact_type" required>
                        <option value="<?php echo $data_this_contact['contact_type']; ?>"><?php echo $tampilnya; ?> (saat ini)</option>
                        <option value="wa">Whatsapp</option>
                        <option value="ig">Instagram</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Kontak (Teks yang tampil)</label>
                    <input type="text" name="contact_name" autocomplete="off" class="form-control" value="<?php echo $data_this_contact['contact_name']; ?>" placeholder="Masukkan nama kontak.." maxlength="<?php echo $maks_limit_contact_name; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Link/Target Kontak</label>
                    <input type="text" name="contact_target" autocomplete="off" class="form-control" value="<?php echo $data_this_contact['contact_target']; ?>" placeholder="Masukkan target kontak.." maxlength="<?php echo $maks_limit_contact_target; ?>" required>
                </div>
                <div class="form-group">
                    <a href="<?php echo $cfg_baseurl; ?>admin/contact/" class="btn border-warning text-warning btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light" name="edit">Simpan Perubahan</button>
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