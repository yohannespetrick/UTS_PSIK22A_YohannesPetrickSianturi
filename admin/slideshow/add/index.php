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
	    
		if (isset($_POST['add'])) {
			$post_pinned = htmlspecialchars($_POST['pinned']);

            if(!empty($_FILES['image']['name'])){
                $name_file_image        = $_FILES['image']['name'];
                $ukuran_file_image      = $_FILES['image']['size'];
                $tipe_file_image        = $_FILES['image']['type'];
                $tmp_file_image         = $_FILES['image']['tmp_name'];
                $FileName_image         = explode(".", $name_file_image);
                $FileExtension_image    = strtolower(end($FileName_image));
                $AllowedExtension_image = array('png','jpg','jpeg');
            }

			if (empty($post_pinned)) {
				$msg_type = "error";
				$msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Mohon mengisi semua input.<script>swal("Gagal!", "Mohon mengisi semua input.", "error");</script>';
            } elseif(empty($_FILES['image']['name'])){
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Pilih gambar terlebih dahulu!.<script>swal("Gagal!", "Pilih gambar terlebih dahulu!", "error");</script>';
            } elseif(in_array($FileExtension_image, $AllowedExtension_image) == false){
                $msg_type = "error";
                $msg_content = '<b>Respon:</b> Gagal!<br /><b>Pesan:</b><br />- Format file bukan gambar.<script>swal("Gagal!", "Format file bukan gambar!", "error");</script>';
			} else {
                if(!empty($_FILES['image']['name'])){
                    $kode_acak   = random_number(4);
                    $kode_acak_2 = random(4);
                    $kode_acak_3 = random_number(4);
                    $set_new_filename = "banner-".$kode_acak."-".$kode_acak_2."-".$kode_acak_3.".".$FileExtension_image."";
                    $path_nama_file = "../../../assets/images/banner/".$set_new_filename."";
                    $upload = move_uploaded_file($tmp_file_image, $path_nama_file);
                    if($upload == TRUE){
        				$insert = mysqli_query($db, "INSERT INTO banner (image, update_at, update_by, pinned) VALUES ('$set_new_filename', '$date', '$user_id','$post_pinned')");
        				if ($insert == TRUE) {
        					$msg_type = "success";
        					$msg_content = '<b>Respon:</b> Berhasil!<br /><b>Pesan:</b><br />Banner berhasil disimpan.<script>swal("Berhasil!", "Banner berhasil disimpan.", "success");</script>';
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
          <a href="#kelola-slideshow-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
          Tambah Slideshow
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="kelola-slideshow-tab">
            <form class="form-horizontal" role="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label">Upload Banner</label>
                    <input type="file" name="image" autocomplete="off" class="form-control" placeholder="Masukkan banner.." required>
                </div>
                <div class="form-group">
                    <label class="control-label">Sematkan</label>
                    <select class="form-control" name="pinned" required>
                        <option value="no">No</option>
                        <?php
                        $check_pinned = mysqli_query($db, "SELECT pinned FROM banner WHERE pinned = 'yes'");
                        if(mysqli_num_rows($check_pinned) == 0){
                        ?>
                        <option value="Yes">Yes</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <a href="<?php echo $cfg_baseurl; ?>admin/slideshow/" class="btn border-warning text-warning btn-bordered waves-effect w-md waves-light">Kembali ke daftar</a>
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