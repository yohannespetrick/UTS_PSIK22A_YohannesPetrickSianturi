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
                                    <h2 class="card-title text-decoration-none text-primary text-center">Work</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3><font color="black">Karir</font></h3>
                                            <h4><font color="black">Pengelola Sumber Daya Manusia PT Astra Honda Motor</font></h4>
                                            <p class="text-justify">
                                                PT Astra Honda Motor adalah perusahaan manufakturing & distribusi sepeda motor terbesar di Indonesia, dengan jumlah karyawan lebih dari 20.000 orang. Sesuai dengan visi perusahaan, PT. Astra Honda Motor selalu berupaya untuk menyediakan solusi mobilitas terbaik yang mampu memenuhi kebutuhan konsumen dengan sistem manajemen kelas dunia.</p>
                                            <p class="text-justify">
                                                Untuk itu kami membutuhkan sumber daya manusia terbaik yang kreatif, inovatif, kompetitif dan siap bergabung dalam pencapaian tujuan tersebut. Dalam pengelolaan SDM, PT. Astra Honda Motor memiliki sistem manajemen pengelolaan SDM yang profesional dengan prinsip Internally Fair dan Externally Competitive disertai dengan pengembangan SDM melalui program-program pelatihan dan pengembangan lainnya serta jenjang karir yang jelas seiring dengan berkembangnya bisnis sepeda motor yang semakin meningkat.
                                            </p>
                                            <p class="text-justify">
                                                Setiap orang di PT Astra Honda Motor dihargai sesuai dengan prestasi dan potensinya, jika Anda adalah orang yang memenuhi kualifikasi yang diinginkan, kami tunggu kehadiran Anda untuk bergabung bersama PT. Astra Honda Motor.
                                            </p>
                                            <p class="text-justify">
                                                Menghadapi tantangan pasar sepeda motor di Indonesia yang semakin ketat, PT. Astra Honda Motor membutuhkan sumber daya manusia yang kreatif, kompetitif, dan inovatif. Untuk itu PT. Astra Honda Motor membuka kesempatan berkarir di perusahaan manufaktur tingkat dunia dengan sistem karir yang Internally Fair dan Externally Competitive.
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="<?php echo $cfg_baseurl; ?>assets/images/produksi-Honda-021.jpg" class="w-100">
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