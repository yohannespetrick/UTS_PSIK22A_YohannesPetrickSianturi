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
      $check_this_category = mysqli_query($db, "SELECT * FROM category WHERE category_id = '$post_id'");
      if (mysqli_num_rows($check_this_category) == 0) {
        header("Location: ".$cfg_baseurl."logout.php");
      } else {

        $data_this_category = mysqli_fetch_assoc($check_this_category);
        include("../../../lib/header.php");

        // JANGAN DIHAPUS INI BERPERAN PENTING //
        $maks_limit_category = 150;
        // JANGAN DIHAPUS INI BERPERAN PENTING //

        if (isset($_POST['edit'])) {
            $post_category_name = htmlspecialchars($_POST['category_name']);
            $post_slug = str_replace(" ", "-", strtolower($post_category_name));
            $post_status = htmlspecialchars($_POST['status']);

            $check_category = mysqli_query($db, "SELECT category_name FROM category WHERE category_name = '$post_category_name' AND category_id != '$post_id'");
            if (empty($post_category_name) || empty($post_status)) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Mohon mengisi semua input.<script>swal("Gagal!", "Mohon mengisi semua input.", "error");</script>';
            } else if (mysqli_num_rows($check_category) > 0) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Data '.$post_category_name.' sudah pernah terdaftar.<script>swal("Gagal!", "Data '.$post_category_name.' sudah pernah terdaftar!", "error");</script>';
            } elseif(strlen($post_category) > $maks_limit_category) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom kategori adalah '.$maks_limit_category.' karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom kategori adalah '.$maks_limit_category.' karakter!", "error");</script>';
            } else {
                $update = mysqli_query($db, "UPDATE category SET category_name = '$post_category_name', slug = '$post_slug', status = '$post_status' WHERE category_id = '$post_id'");
                if ($update == TRUE) {
                    $msg_type = "success";
                    $msg_content = '<b>Respon:</b> Berhasil!<br /><b>Pesan:</b><br />Kategori berhasil diperbarui.<script>swal("Berhasil!", "Kategori berhasil diperbarui.", "success");</script>';
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
  var url = "<?php echo $cfg_baseurl; ?>admin/category/edit/?id=<?php echo $post_id; ?>"; // URL Tujuan
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
          <a href="#kelola-category-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
          Ubah Kategori
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="kelola-category-tab">
            <form class="form-horizontal" role="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Kategori</label>
                    <input type="text" name="category_name" autocomplete="off" class="form-control" value="<?php echo $data_this_category['category_name']; ?>" placeholder="Masukkan kategori.." maxlength="<?php echo $maks_limit_category; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Status</label>
                    <select class="form-control" name="status" required>
                        <option value="<?php echo $data_this_category['status']; ?>"><?php echo $data_this_category['status']; ?> (saat ini)</option>
                        <option value="Active">Active</option>
                        <option value="Non Active">Non Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <a href="<?php echo $cfg_baseurl; ?>admin/category/" class="btn border-warning text-warning btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
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