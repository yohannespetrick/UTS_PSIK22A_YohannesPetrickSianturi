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
  ?>                        
                        <div class="row" id="loadtable" style="margin-top: 20px; margin-bottom: 20px;">
                          <div class="col-md-12">
                              <h3 class="text-primary card-title">Galeri</h3>
                          </div>
                          <?php
                          $last_gallery = '';
                          $exec_gallery = mysqli_query($db, "SELECT * FROM gallery ORDER BY gallery_id ASC LIMIT 3");
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
                          }
                          ?>
                        </div>
                        <!-- end row -->
                        <div id="remove" class="row">
                            <div class="col-md-12 text-center">
                              <button type="submit" name="seemore" id="seemore" data-no="<?php echo $last_gallery; ?>" class="btn border-dark btn-sm waves-effect">See More..</button>
                            </div>
                        </div>
                        <br>
    <script>
    $(document).ready(function(){  
          $(document).on('click', '#seemore', function(){  
               var lastgallery = $(this).data('no');  
               $('#seemore').html('Loading...');  
               $.ajax({  
                    url:"look_data.php",  
                    method:"POST",  
                    data:{
                        lastgallery:lastgallery,
                    },  
                    dataType:"text",  
                    success:function(data)  
                    {  
                         if(data != '')  
                         {  
                              $('#remove').remove();  
                              $('#loadtable').append(data);  
                         }  
                         else 
                         {  
                              $('#seemore').html('No more data to show');  
                         }  
                    }  
               });  
          });  
     }); 
</script>  
<?php
include("../lib/footer.php");
?>