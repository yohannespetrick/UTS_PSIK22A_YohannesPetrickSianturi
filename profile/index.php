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

if ($_GET['u']) {
  $data = htmlspecialchars($_GET['u']);
  $query_profile_filter = "SELECT username,profile_name,email,image,description FROM profile WHERE username = '$data' LIMIT 1"; // edit
  $exec_profile_filter = mysqli_query($db, $query_profile_filter);
  if(mysqli_num_rows($exec_profile_filter) == 0){
    header("Location: ".$cfg_baseurl."");
  } else {
  	$msg_type = "nothing";
  	include("../lib/header.php");
    $data_profile_filter = mysqli_fetch_assoc($exec_profile_filter);
?>
                        <div class="row">
                          <div class="col-md-4" style="margin-top: 10px; margin-bottom: 10px;">
                            <div class="wow animate__animated animate__fadeIn">
                              <div class="text-decoration-none wow animate__bounceIn" style="visibility: visible;">
                                <div class="card border border-primary">
                               	  <div class="card-body">
                               	  	<img class="img-fluid img-circle-new  border border-primary" src="<?php echo $cfg_baseurl; ?>assets/images/profile/<?php echo $data_profile_filter['image']; ?>">
                               	  </div>
                                  <div class="card-footer">
                                    <h4 class="text-center text-primary">@<?php echo $data_profile_filter['username']; ?></h4>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8" style="margin-top: 10px; margin-bottom: 10px;">
                            <div class="wow animate__animated animate__fadeIn">
                              <div class="text-decoration-none wow animate__bounceIn" style="visibility: visible;">
                                <div class="card border border-primary">
                                  <div class="card-body">
                                    <h4 class="card-title text-decoration-none text-primary text-justify"><?php echo $data_profile_filter['profile_name']; ?></h4>
                                    <p class="card-text text-muted medium text-justify"><font color="black"><?php echo nl2br($data_profile_filter['description']); ?></font></span></p>
                                    <p><small class="text-muted">Email : <i><?php echo $data_profile_filter['email']; ?></i></small></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end col -->
                          <div class="col-md-12 text-center">
                          <hr>
                            <h3 class="badge badge-primary text-white">Berita Lainnya</h3>
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
                              <a class="text-decoration-none wow animate__bounceIn" href="<?php echo $cfg_baseurl; ?>news/?p=<?php echo $data_news_related['tautan']; ?>" style="visibility: visible;">
                                <div class="card">
                                  <img class="card-img-top img-fluid" src="<?php echo $cfg_baseurl; ?>assets/images/news/<?php echo $data_news_related['image']; ?>">
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
                    </div>
                    <!-- end container -->
                </div>
                <!-- end content -->
              </div>
<?php
  }
} else {
	header("Location: ".$cfg_baseurl."");
}
include("../lib/footer.php");
?>