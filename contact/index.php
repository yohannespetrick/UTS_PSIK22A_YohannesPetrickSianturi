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
                          <div class="col-md-10" style="margin-top: 10px; margin-bottom: 10px;">
                            <div class="wow animate__animated animate__fadeIn">
                              <div class="text-decoration-none wow animate__bounceIn" style="visibility: visible;">
                                <div class="card">
                                  <div class="card-body">
                                    <h3 class="text-primary card-title">Kontak Kami</h3>
                                    <?php
                                    $query_contact = "SELECT contact_name,contact_type,contact_target FROM contact ORDER BY contact_type ASC"; // edit
                                    $exec_contact = mysqli_query($db, $query_contact);
                                    if(mysqli_num_rows($exec_contact) > 0){
                                      while($data_contact = mysqli_fetch_assoc($exec_contact)){
                                        if($data_contact['contact_type'] == "ig"){
                                          $label = "Instagram";
                                          $icons = "fa fa-instagram";
                                          $text = "text-danger";
                                        } else if($data_contact['contact_type'] == "wa"){
                                          $label = "Whatsapp";
                                          $icons = "fa fa-whatsapp";
                                          $text = "text-success";
                                        } else {
                                          $icons = "fa fa-phone";
                                          $text = "text-primary";
                                        }
                                      ?>
                                      <hr>
                                      <div>
                                        <a href="<?php echo $data_contact['contact_target'];?>" target="_blank">
                                          <h5 class="<?php echo $text; ?>">
                                            <i class="<?php echo $icons; ?>"></i> <?php echo $label; ?> :
                                            <?php echo $data_contact['contact_name'];?>
                                          </h5>
                                        </a>
                                      </div>
                                    <?php
                                      }
                                    }
                                    ?>
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
                              <a class="text-decoration-none wow animate__bounceIn" href="<?php echo $cfg_baseurl; ?>news/?p=<?php echo $data_news_related['tautan']; ?>" style="visibility: visible;">
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
                          //}
                        ?>
                    </div>
                    <!-- end container -->
                </div>
                <!-- end content -->
              </div>
<?php
include("../lib/footer.php");
?>