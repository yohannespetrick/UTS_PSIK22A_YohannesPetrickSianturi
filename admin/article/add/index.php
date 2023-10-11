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
        $maks_limit_title = 225;
        $maks_limit_description = 65535;
        // JANGAN DIHAPUS INI BERPERAN PENTING //
        
        if (isset($_POST['add'])) {
            $post_category = htmlspecialchars($_POST['category']);
            $post_title = htmlspecialchars($_POST['title']);
            $post_tautan = str_replace(" ", "-", strtolower($post_title));
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

            $check_title = mysqli_query($db, "SELECT title FROM news WHERE title = '$post_title'");
            if (empty($post_category) || empty($post_title) || empty($post_description)) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Mohon mengisi semua input.<script>swal("Gagal!", "Mohon mengisi semua input.", "error");</script>';
            } else if (mysqli_num_rows($check_title) > 0) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Data '.$post_title.' sudah pernah terdaftar.<script>swal("Gagal!", "Data '.$post_title.' sudah pernah terdaftar!", "error");</script>';
            } elseif(empty($_FILES['image']['name'])){
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Pilih gambar terlebih dahulu!.<script>swal("Gagal!", "Pilih gambar terlebih dahulu!", "error");</script>';
            } elseif(in_array($FileExtension_image, $AllowedExtension_image) == false){
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Format file bukan gambar.<script>swal("Gagal!", "Format file bukan gambar!", "error");</script>';
            } elseif(strlen($post_title) > $maks_limit_title) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom judul adalah 50 karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom judul adalah 50 karakter!", "error");</script>';
            } elseif(strlen($post_description) > $maks_limit_description) {
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Maksimal karakter pada kolom deskripsi adalah 225 karakter.<script>swal("Gagal!", "Maksimal karakter pada kolom deskripsi adalah 225 karakter!", "error");</script>';
            } else {
                if(!empty($_FILES['image']['name'])){
                    $kode_acak   = random_number(4);
                    $kode_acak_2 = random(4);
                    $kode_acak_3 = random_number(4);
                    $set_new_filename = "berita-".$kode_acak."-".$kode_acak_2."-".$kode_acak_3.".".$FileExtension_image."";
                    $path_nama_file = "../../../assets/images/news/".$set_new_filename."";
                    $upload = move_uploaded_file($tmp_file_image, $path_nama_file);
                    if($upload == TRUE){
                        $insert = mysqli_query($db, "INSERT INTO news (title, tautan, category_id, description, image, publish_at, update_at, update_by) VALUES ('$post_title', '$post_tautan', '$post_category', '$post_description', '$set_new_filename', '$date', '$date', '$user_id')");
                        if ($insert == TRUE) {
                            $msg_type = "success";
                            $msg_content = '<b>Respon:</b> Berhasil!<br /><b>Pesan:</b><br />Artikel berhasil disimpan.<script>swal("Berhasil!", "Artikel berhasil disimpan.", "success");</script>';
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
          <a href="#kelola-news-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
          Tambah Artikel
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="kelola-news-tab">
            <form class="form-horizontal" role="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Kategori</label>
                    <select class="form-control" name="category" required>
                        <option value="0">Pilih kategori..</option>
                        <?php
                        $query_category = "SELECT category_id,category_name FROM category WHERE status = 'Active' ORDER BY category_name ASC"; // edit
                        $exec_category = mysqli_query($db, $query_category);
                        if(mysqli_num_rows($exec_category) > 0){
                            while($data_category = mysqli_fetch_assoc($exec_category)){
                        ?>
                            <option value="<?php echo $data_category['category_id']; ?>"><?php echo $data_category['category_name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Judul</label>
                    <input type="text" id="title" name="title" autocomplete="off" class="form-control" placeholder="Masukkan judul.." maxlength="<?php echo $maks_limit_title; ?>" required>
                    <p id="limit_title"></p>
                </div>
                <div class="form-group">
                    <label class="control-label">Deskripsi</label>
                    <textarea name="description" id="description" rows="10" autocomplete="off" class="form-control" placeholder="Masukkan deskripsi.." maxlength="<?php echo $maks_limit_description; ?>" required></textarea>
                    <p id="limit_description"></p>
                </div>
                <div class="form-group">
                    <label class="control-label">Upload Gambar</label>
                    <input type="file" name="image" autocomplete="off" class="form-control" placeholder="Masukkan gambar.." required>
                </div>
                <div class="form-group">
                    <a href="<?php echo $cfg_baseurl; ?>admin/article/" class="btn border-warning text-warning btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
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