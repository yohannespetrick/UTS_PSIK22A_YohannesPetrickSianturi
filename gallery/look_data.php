<?php
sleep(1);
session_start();
require("../mainconfig.php");

if (isset($_SESSION['user'])) {
  $sess_username = $_SESSION['user']['username'];
  $check_user = mysqli_query($db, "SELECT username,level,status FROM users WHERE username = '$sess_username'");
  $data_user = mysqli_fetch_assoc($check_user);
  if (mysqli_num_rows($check_user) == 0) {
    header("Location: ".$cfg_baseurl."logout.php");
  } else if ($data_user['status'] == "Suspended") {
    header("Location: ".$cfg_baseurl."logout.php");
  }

}

if(isset($_POST['lastgallery'])){
    $last_data = $_POST['lastgallery'];
    $exec_gallery = mysqli_query($db, "SELECT * FROM gallery WHERE gallery_id > '$last_data' ORDER BY gallery_id ASC LIMIT 3");
    if(mysqli_num_rows($exec_gallery) > 0){
        while($data_gallery = mysqli_fetch_assoc($exec_gallery)){
        ?>
        <div class="col-md-4" style="margin-top: 10px;">
            <div class="wow animate__animated animate__fadeIn">
                <div class="text-decoration-none wow animate__bounceIn" style="visibility: visible;">
                    <div class="card artikel-t">
                        <img class="card-img-top card-img-bottom img-fluid" src="<?php echo $cfg_baseurl; ?>assets/images/gallery/<?php echo $data_gallery['image']; ?>">
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
        <?php
        $last_gallery = $data_gallery['gallery_id'];
        }
    ?>
        <div class="col-md-12 text-center" id="remove">
            <br>
            <button type="submit" name="seemore" id="seemore" data-no="<?php echo $last_gallery; ?>" class="btn border-dark btn-sm waves-effect">Read More..</button>
        </div>
<?php
    }
}
?>