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
        $maks_limit_category = 150;
        // JANGAN DIHAPUS INI BERPERAN PENTING //
        
        if (isset($_POST['add'])) {
            $post_category_name = htmlspecialchars($_POST['category_name']);
            $post_slug = str_replace(" ", "-", strtolower($post_category_name));
            $post_status = htmlspecialchars($_POST['status']);

            $check_category = mysqli_query($db, "SELECT category_name FROM category WHERE category_name = '$post_category_name'");
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
                $insert = mysqli_query($db, "INSERT INTO category (category_name, slug, status, update_at, update_by) VALUES ('$post_category_name', '$post_slug', '$post_status',  '$date', '$user_id')");
                if ($insert == TRUE) {
                    $msg_type = "success";
                    $msg_content = '<b>Respon:</b> Berhasil!<br /><b>Pesan:</b><br />Kategori berhasil disimpan.<script>swal("Berhasil!", "Kategori berhasil disimpan.", "success");</script>';
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
          <a href="#kelola-category-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
          Tambah Kategori
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="kelola-category-tab">
            <form class="form-horizontal" role="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Kategori</label>
                    <input type="text" name="category_name" autocomplete="off" class="form-control" placeholder="Masukkan kategori.." maxlength="<?php echo $maks_limit_category; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Status</label>
                    <select class="form-control" name="status" required>
                        <option value="0">Pilih kategori..</option>
                        <option value="Active">Active</option>
                        <option value="Non Active">Non Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <a href="<?php echo $cfg_baseurl; ?>admin/category/" class="btn border-warning text-warning btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
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