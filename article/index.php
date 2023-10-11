<?php
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

include("../lib/header.php");
if($_GET['p']){
  $data = htmlspecialchars($_GET['p']);
  $query_news_filter = "SELECT news_id,title,image,publish_at,category_id,description,fullname FROM news,users WHERE news.update_by = users.user_id AND tautan = '$data' LIMIT 1"; // edit
  $exec_news_filter = mysqli_query($db, $query_news_filter);
  if(mysqli_num_rows($exec_news_filter) == 0){
    header("Location: ".$cfg_baseurl."");
  } else {
    $msg_type = "nothing";
    $data_news_filter = mysqli_fetch_assoc($exec_news_filter);
    $article_id = $data_news_filter['news_id'];
  ?>
                        <div class="row">
                          <center>
                          <div class="col-md-12" style="margin-top: 10px; margin-bottom: 5px;">
                            <div class="wow animate__animated animate__fadeIn">
                              <div class="text-decoration-none wow animate__bounceIn" style="visibility: visible;">
                                <div class="card">
                                  <img class="card-img-top card-img-bottom img-fluid" src="<?php echo $cfg_baseurl; ?>assets/images/news/<?php echo $data_news_filter['image']; ?>">
                                  <div class="card-body">
                                    <h4 class="card-title text-decoration-none text-primary text-justify"><?php echo $data_news_filter['title']; ?></h4>
                                    <p class="card-text text-muted medium text-justify"><font color="black"><?php echo nl2br($data_news_filter['description']); ?></font></span></p>
                                    <p class="card-text small float-left text-muted">Diposting oleh : <i class="text-primary"><?php echo $data_news_filter['fullname']; ?></i></p>
                                    <p class="card-text small float-right text-muted"><i><?php echo format_date($data_news_filter['publish_at']); ?></i></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end col -->
                          <br>
                          <div id="disqus_thread"></div>
                          <script>
                              (function() { // DON'T EDIT BELOW THIS LINE
                              var d = document, s = d.createElement('script');
                              s.src = 'https://beritainaje.disqus.com/embed.js';
                              s.setAttribute('data-timestamp', +new Date());
                              (d.head || d.body).appendChild(s);
                              })();
                          </script>
                          <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                        </center>
                        </div>
                        <div class="row">
                          <?php
                          $query_news_related = "SELECT news_id,title,image,publish_at,category_id,description,tautan FROM news WHERE news_id !='$article_id' ORDER BY rand() LIMIT 6"; // edit
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
<?php
  }
} else {
?>
                        <div class="row">
                            <div class="col-sm-12" style="margin-bottom: 10px;">
                                <div id="carouselfaded" class="carousel slide carousel-fade carousel-light" data-bs-ride="carousel" data-bs-theme="light">
                                  <div class="carousel-inner text-center">
                                    <?php
                                    $query_banner_pinned_body = "SELECT * FROM banner WHERE pinned = 'yes' LIMIT 1"; // edit
                                    $query_banner_pinned = mysqli_query($db, $query_banner_pinned_body);
                                    $data_banner_pinned = mysqli_fetch_assoc($query_banner_pinned);
                                    if(mysqli_num_rows($query_banner_pinned) > 0){
                                    ?>
                                    <div class="carousel-item active">
                                      <img src="<?php echo $cfg_baseurl; ?>assets/images/banner/<?php echo $data_banner_pinned['image']; ?>" class="content-rounded-type" width="100%" height="250">
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $query_banner_body = "SELECT * FROM banner WHERE pinned = 'no' ORDER BY rand()"; // edit
                                    $query_banner = mysqli_query($db, $query_banner_body);
                                    if(mysqli_num_rows($query_banner) > 0){
                                        while($data_banner = mysqli_fetch_assoc($query_banner)){
                                    ?>
                                    <div class="carousel-item">
                                      <img src="<?php echo $cfg_baseurl; ?>assets/images/banner/<?php echo $data_banner['image']; ?>" class="content-rounded-type" width="100%" height="250">
                                    </div>
                                    <?php 
                                        }
                                    }
                                    ?>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <?php
                          $query_category = "SELECT category_id,category_name,slug FROM category WHERE status = 'Active' ORDER BY category_name LIMIT 5"; // edit
                          $exec_category = mysqli_query($db, $query_category);
                          while($data_category = mysqli_fetch_assoc($exec_category)){
                              $cat_id = $data_category['category_id'];
                              $query_news_by_category = "SELECT title,image,publish_at,category_id,description,tautan FROM news WHERE category_id = '$cat_id' ORDER BY rand() LIMIT 3"; // edit
                              $exec_news_by_category = mysqli_query($db, $query_news_by_category);
                              if(mysqli_num_rows($exec_news_by_category) > 0){
                          ?>
                        <div class="row" style="margin-top: 20px; margin-bottom: 20px;">
                          <div class="col-md-12 bg-dark">
                            <div class="float-left">
                                <small class="text-white"><?php echo $data_category['category_name']; ?></small>
                            </div>
                            <div class="float-right">
                                <a href="<?php echo $cfg_baseurl; ?>article/sortir/?s=<?php echo $data_category['slug']; ?>" class="border border-danger img-thumbnail"><small class="text-primary"><b><i class="fa fa-chevron-right"></i></b></small></a>
                            </div>
                          </div>
                          <?php
                                while($data_news_by_category = mysqli_fetch_assoc($exec_news_by_category)){
                                  $content = $data_news_by_category['description'];
                                  $desc = substr($content, 0, 100);
                          ?>
                          <div class="col-md-4" style="margin-top: 10px;">
                            <div class="wow animate__animated animate__fadeIn">
                              <a class="text-decoration-none wow animate__bounceIn" href="<?php echo $cfg_baseurl; ?>article/?p=<?php echo $data_news_by_category['tautan']; ?>" style="visibility: visible;">
                                <div class="card artikel-t">
                                  <img class="card-img-top card-img-bottom img-fluid" src="<?php echo $cfg_baseurl; ?>assets/images/news/<?php echo $data_news_by_category['image']; ?>">
                                  <div class="card-body">
                                    <h4 class="card-title text-decoration-none"><font color="black"><?php echo $data_news_by_category['title']; ?></font></h4>
                                    <p class="card-text text-dark small"><?php echo $desc; ?>.... <span class="text-primary">(Baca Selengkapnya)</span></p>
                                    <p class="card-text small text-right text-primary"><i><?php echo format_date($data_news_by_category['publish_at']); ?></i></p>
                                  </div>
                                </div>
                              </a>
                            </div>
                          </div>
                          <!-- end col -->
                              <?php
                                }
                              ?>
                        </div>
                        <!-- end row -->
                          <?php
                            }
                          }
                          ?>
                        <br>
                    </div>
                    <!-- end container -->
                </div>
                <!-- end content -->
              </div>
<?php
}
include("../lib/footer.php");
?>