<?php
session_start();
require("../../mainconfig.php");

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

if (isset($_GET['s'])) {
  $data = htmlspecialchars($_GET['s']);
  $query_news_sortir = "SELECT category_id,category_name,slug FROM category WHERE status = 'Active' AND slug = '$data' LIMIT 1"; // edit
  $exec_news_sortir = mysqli_query($db, $query_news_sortir);
  if(mysqli_num_rows($exec_news_sortir) == 0){
    header("Location: ".$cfg_baseurl."");
  } else {
  	$msg_type = "nothing";
  	include("../../lib/header.php");
    $data_news_sortir = mysqli_fetch_assoc($exec_news_sortir);
    $cat_id = $data_news_sortir['category_id'];
?>
                        <div class="row" id="loadtable" style="margin-top: 20px; margin-bottom: 20px;">
                          <div class="col-md-12">
                              <div class="float-left">
                                  <medium class="badge badge-primary"><?php echo $data_news_sortir['category_name']; ?></medium>
                              </div>
                              <div class="float-right">
                                  <h4 class="badge badge-primary"><a href="<?php echo $cfg_baseurl; ?>article" class="text-white"><span><i class="fa fa-arrow-right"></i></span> Baca Artikel Lainnya</a></h4>
                              </div>
                          </div>
                          <?php
                              $lastid = '';
                              $query_news_by_category = "SELECT * FROM news WHERE category_id = '$cat_id' ORDER BY news_id DESC LIMIT 3"; // edit
                              $exec_news_by_category = mysqli_query($db, $query_news_by_category);
                              if(mysqli_num_rows($exec_news_by_category) > 0){
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
                                $lastid = $data_news_by_category['news_id'];
                                $catid = $data_news_by_category['category_id'];
                                }
                              }
                              ?>
                        </div>
                        <!-- end row -->
                        <div id="remove" class="row">
                            <div class="col-md-12 text-center">
                              <button type="submit" name="seemore" id="seemore" data-id="<?php echo $lastid; ?>" data-cat="<?php echo $catid; ?>" class="btn border-dark btn-sm waves-effect">See More..</button>
                            </div>
                        </div>
                        <br>
                    </div>
                    <!-- end container -->
                </div>
                <!-- end content -->
              </div>
    <script>
    $(document).ready(function(){
        $(document).on('click', '#seemore', function(){  
            var lastid = $(this).data('id'); 
            var catid = $(this).data('cat');
            if(lastid != ''){
                $('#seemore').html('Loading...');  
                $.ajax({ 
                    url:"load_data.php",  
                    method:"POST",  
                    data:{
                        lastid:lastid,
                        catid:catid,
                    },  
                    dataType:"text",  
                    success:function(data)  
                    {
                        if(data !== '')  
                        {
                            $('#remove').remove();
                            $('#loadtable').append(data);
                        } else if(data == ''){
                            $('#remove').remove();
                        }
                            
                    }
                });
            } else {
                $('#seemore').html('Data not found!');  
            }
        });
    }); 
    </script>
<?php
  }
} else {
	header("Location: ".$cfg_baseurl."");
}
include("../../lib/footer.php");
?>