<?php
session_start();
require("../mainconfig.php");
$msg_type = "nothing";

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

include("../lib/header.php");

?>
                        <div class="row">
                          <div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px;">
                            <div class="wow animate__animated animate__fadeIn">
                              <div class="text-decoration-none wow animate__bounceIn" style="visibility: visible;">
                                <div class="card">
                                  <div class="card-body">
                                    <h2 class="card-title text-decoration-none text-primary text-center">Experiences</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="<?php echo $cfg_baseurl; ?>assets/images/words-of-mouth-award-1.jpg" class="w-100">
                                        </div>
                                        <div class="col-md-2">
                                            <img src="<?php echo $cfg_baseurl; ?>assets/images/logo-top-brand-2021-1-27042021-120841.jpg" class="w-100">
                                        </div>
                                        <div class="col-md-2">
                                            <img src="<?php echo $cfg_baseurl; ?>assets/images/logo-award-2021-11102021-112850.jpg" class="w-100">
                                        </div>
                                        <div class="col-md-2">
                                            <img src="<?php echo $cfg_baseurl; ?>assets/images/ibba2020-platinum-1.jpg" class="w-100">
                                        </div>
                                        <div class="col-md-2">
                                            <img src="<?php echo $cfg_baseurl; ?>assets/images/wow-brand-2019-2.jpg" class="w-100">
                                        </div>
                                        <div class="col-md-2">
                                            <img src="<?php echo $cfg_baseurl; ?>assets/images/indonesias-most-admired-companies-1-200x200.jpg" class="w-100">
                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                            <p class="medium text-justify"><font color="black">Astra Honda Motor sukses mendapatkan banyak penghargaan yang tercapai dihampir setiap tahunnya. Sebagai bagian dari bangsa Indonesia, PT Astra Honda Motor senantiasa memperkuat kontribusinya di berbagai bidang, seperti keselamatan berkendara, pendidikan, lingkungan, dan pemberdayaan masyarakat. Diharapkan perusahaan akan terus tumbuh dan berkembang bersama masyarakat dan dapat menjadi salah satu perusahaan kebanggaan bangsa Indonesia.</font></p>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-md-12 text-center">
                          <hr>
                            <h3 class="badge badge-primary text-white">Artikel</h3>
                          </div>
                          <?php
                          $query_news_related = "SELECT title,image,publish_at,category_id,description,tautan FROM news ORDER BY rand() LIMIT 4"; // edit
                          $exec_news_related = mysqli_query($db, $query_news_related);
                          if(mysqli_num_rows($exec_news_related) > 0){
                            while($data_news_related = mysqli_fetch_assoc($exec_news_related)){
                              $gettitle = $data_news_related['title'];
                              $title = substr($gettitle, 0, 50);
                          ?>
                          <div class="col-md-3" style="margin-top: 10px; margin-bottom: 10px">
                            <div class="wow animate__animated animate__fadeIn">
                              <a class="text-decoration-none wow animate__bounceIn" href="<?php echo $cfg_baseurl; ?>article/?p=<?php echo $data_news_related['tautan']; ?>" style="visibility: visible;">
                                <div class="card">
                                  <img class="card-img-top card-img-bottom img-fluid" src="<?php echo $cfg_baseurl; ?>assets/images/news/<?php echo $data_news_related['image']; ?>">
                                  <div class="card-body">
                                    <h6 class="card-title text-decoration-none"><font color="black"><?php echo $title; ?>....</font></h6>
                                    <p class="card-text small text-right text-primary"><i><?php echo format_date($data_news_related['publish_at']); ?></i></p>
                                  </div>
                                </div>
                              </a>
                            </div>
                          </div>
                          <!-- end col -->
                          <?php
                            }
                          }
                          ?>
                        </div>
                        <!-- end row -->
                    <!-- end container -->
                </div>
                <!-- end content -->
              </div>
<?php
include("../lib/footer.php");
?>