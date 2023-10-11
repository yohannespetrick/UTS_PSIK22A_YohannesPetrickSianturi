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
                                    <h2 class="card-title text-decoration-none text-primary text-center">Education</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="<?php echo $cfg_baseurl; ?>assets/images/logo-sinergi-bagi-negeri-1-17052023-035736-17052023-124306.jpg" class="w-100">
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="text-center"><font color="black">Dukungan Kami Untuk Masyarakat <br>Melalui Sinergi Bagi Negeri.</font></h4>
                                            <p class="text-justify">
                                                PT Astra Honda Motor (AHM) memiliki komitmen yang tinggi dalam mengelola perusahaan meliputi pengelolaan lingkungan, pemberdayaan masyarakat, dan tata kelola perusahaan yang baik melalui implementasi Environment, Social, and Governance (ESG).</p>
                                            <p class="text-justify">
                                                Sebagai bagian dari bangsa Indonesia, AHM senantiasa memperkuat kontribusinya di berbagai bidang, seperti pendidikan, lingkungan, kesehatan, pemberdayaan masyarakat dan keselamatan berkendara. Diharapkan perusahaan akan terus tumbuh dan berkembang bersama masyarakat dan dapat menjadi salah satu perusahaan kebanggan bangsa Indonesia.
                                            </p>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-md-12" style="margin-top: 20px;">
                              <div class="row">
                                  <div class="col-md-6">
                                      <img src="<?php echo $cfg_baseurl; ?>assets/images/ahm-pendidikan-02-min-6-17052023-125953.jpg" class="w-100" style="border-radius: 3%;">
                                  </div>
                                  <div class="col-md-6">
                                      <h4 style="margin-top: 100px;">Pendidikan</h4>
                                      <p class="text-justify" style="margin-top: 20px;">
                                          AHM Bersama jaringannya terus memperkuat komitmen dalam meningkatkan kualitas pendidikan vokasi di Tanah Air melalui program yang berkelanjutan.
                                      </p>
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