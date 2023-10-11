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
        $maks_limit_username = 50;
        $maks_limit_profile_name = 100;
        $maks_limit_email = 225;
        $maks_limit_description = 65535;
        // JANGAN DIHAPUS INI BERPERAN PENTING //
        
        if (isset($_POST['add'])) {
            $post_username_profile = htmlspecialchars($_POST['username_profile']);
            $post_profile_name = htmlspecialchars($_POST['profile_name']);
            $post_email_profile = htmlspecialchars($_POST['email_profile']);
            $post_description = htmlspecialchars($_POST['description']);

            if(!empty($_FILES['image']['name'])){
                $name_file_image        = $_FILES['image']['name'];
                $ukuran_file_image      = $_FILES['image']['size'];
                $tipe_file_image        = $_FILES['image']['type'];
                $tmp_file_image         = $_FILES['image']['tmp_name'];
                $FileName_image         = explode(".", $name_file_image);
                $FileExtension_image    = strtolower(end($FileName_image));
                $AllowedExtension_image = array('png','jpg','jpeg');
            }

            $check_profile = mysqli_query($db, "SELECT profile_name FROM profile WHERE profile_name = '$post_profile_name'");
            if (empty($post_username_profile) || empty($post_profile_name) || empty($post_email_profile) || empty($post_description)) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Mohon mengisi semua input.<script>swal("Gagal!", "Mohon mengisi semua input.", "error");</script>';
            } else if (mysqli_num_rows($check_profile) > 0) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Data '.$post_profile_name.' sudah pernah terdaftar.<script>swal("Gagal!", "Data '.$post_profile_name.' sudah pernah terdaftar!", "error");</script>';
            } elseif(empty($_FILES['image']['name'])){
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Pilih gambar terlebih dahulu!.<script>swal("Gagal!", "Pilih gambar terlebih dahulu!", "error");</script>';
            } elseif(in_array($FileExtension_image, $AllowedExtension_image) == false){
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Format file bukan gambar.<script>swal("Gagal!", "Format file bukan gambar!", "error");</script>';
            } elseif(strlen($post_username_profile) > $maks_limit_username) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom username adalah '.$maks_limit_username.' karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom judul adalah '.$maks_limit_username.' karakter!", "error");</script>';
            } elseif(strlen($post_profile_name) > $maks_limit_profile_name) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom nama adalah '.$maks_limit_profile_name.' karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom nama adalah '.$maks_limit_profile_name.' karakter!", "error");</script>';
            } elseif(strlen($post_email_profile) > $maks_limit_email) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom email adalah '.$maks_limit_email.' karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom email adalah '.$maks_limit_email.' karakter!", "error");</script>';
            } elseif(strlen($post_description) > $maks_limit_description) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom deskripsi adalah '.$maks_limit_description.' karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom deskripsi adalah '.$maks_limit_description.' karakter!", "error");</script>';
            } else {
                if(!empty($_FILES['image']['name'])){
                    $kode_acak   = random_number(4);
                    $kode_acak_2 = random(4);
                    $kode_acak_3 = random_number(4);
                    $set_new_filename = "profile-".$kode_acak."-".$kode_acak_2."-".$kode_acak_3.".".$FileExtension_image."";
                    $path_nama_file = "../../../assets/images/profile/".$set_new_filename."";
                    $upload = move_uploaded_file($tmp_file_image, $path_nama_file);
                    if($upload == TRUE){
                        $insert = mysqli_query($db, "INSERT INTO profile (username, profile_name, description, email, image, update_at, update_by) VALUES ('$post_username_profile', '$post_profile_name', '$post_description', '$post_email_profile', '$set_new_filename', '$date', '$user_id')");
                        if ($insert == TRUE) {
                            $msg_type = "success";
                            $msg_content = '<b>Respon:</b> Berhasil!<br /><b>Pesan:</b><br />Profile berhasil disimpan.<script>swal("Berhasil!", "Profile berhasil disimpan.", "success");</script>';
                        } else {
                            $msg_type = "error";
                            $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Sistem bermasalah, hubungi tim IT.<script>swal("Gagal!", "Sistem bermasalah, hubungi tim IT!", "error");</script>';
                        }
                    }
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
          <a href="#kelola-profile-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
          Tambah Profile
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="kelola-profile-tab">
            <form class="form-horizontal" role="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Username</label>
                    <input type="text" name="username_profile" autocomplete="off" class="form-control" placeholder="Masukkan username.." maxlength="<?php echo $maks_limit_username; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Nama Lengkap</label>
                    <input type="text" name="profile_name" autocomplete="off" class="form-control" placeholder="Masukkan nama lengkap.." maxlength="<?php echo $maks_limit_profile_name; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="email" name="email_profile" autocomplete="off" class="form-control" placeholder="Masukkan email.." maxlength="<?php echo $maks_limit_email; ?>" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Deskripsi</label>
                    <textarea name="description" id="description" rows="10" autocomplete="off" class="form-control" placeholder="Masukkan deskripsi.." maxlength="<?php echo $maks_limit_description; ?>" required></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Upload Gambar</label>
                    <input type="file" name="image" autocomplete="off" class="form-control" placeholder="Masukkan gambar.." required>
                </div>
                <div class="form-group">
                    <a href="<?php echo $cfg_baseurl; ?>admin/profile/" class="btn border-warning text-warning btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
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