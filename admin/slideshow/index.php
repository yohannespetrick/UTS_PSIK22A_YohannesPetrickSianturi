<?php
session_start();
require("../../mainconfig.php");

if (isset($_SESSION['user'])) {
    $sess_username = $_SESSION['user']['username'];
    $check_user = $db->query("SELECT user_id,fullname,username,level,status FROM users WHERE username = '$sess_username'");
    $data_user = $check_user->fetch_array(MYSQLI_ASSOC);
    if ($check_user->num_rows == 0) {
        header("Location: ".$cfg_baseurl."logout.php");
    } else if ($data_user['status'] == "Suspended") {
        header("Location: ".$cfg_baseurl."logout.php");
    } else if ($data_user['level'] != "Admin" && $data_user['level'] != "Staff") {
		header("Location: ".$cfg_baseurl."logout.php");
    }

	include("../../lib/header.php");
	$msg_type = "nothing";

?>
<div class="row">
  <div class="col-lg-12">
    <div class="card-box">
      <ul class="nav nav-tabs tabs-bordered">
        <li class="nav-item">
          <a href="#kelola-slideshow-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
          Kelola Slideshow
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="kelola-slideshow-tab">
            <div class="form-group">
                <a href="<?php echo $cfg_baseurl; ?>admin/slideshow/add/" class="btn btn-primary btn-bordered waves-effect w-md waves-light"><i class="fa fa-plus"></i> Tambah Data </a>
            </div>
                                        <div class="table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<thead>
													<tr>
													    <th>No</th>
													    <th class="text-center"><i class="mdi mdi-pin"></i></th>
														<th>Gambar</th>
														<th>Latest</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												<?php
// start paging config
$query_list = "SELECT * FROM banner ORDER BY banner_id DESC"; // edit
$records_per_page = 10; // edit

$starting_position = 0;
if(isset($_GET["page_no"])) {
	$starting_position = ($_GET["page_no"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
// end paging config
$no = 1;
												while ($data_show = mysqli_fetch_assoc($new_query)) {
													$query_empty_pin = mysqli_query($db, "SELECT * FROM banner WHERE pinned = 'yes' ORDER BY banner_id DESC"); // edit
												?>
												        <td><?php echo $no++; ?></td>
												        <?php
												        if($data_show['pinned'] == "yes"){
												        ?>
														<td class="text-center"><i class="fa fa-check"></i></td>
														<?php
														} else if(mysqli_num_rows($query_empty_pin) == 0){
														?>
														<td class="text-center"><i class="fa fa-times"></i></td>
														<?php
														} else {
														?>
														<td class="text-center">-</td>
														<?php
														}
														?>
														<td><a href="<?php echo $cfg_baseurl; ?>assets/images/banner/<?php echo $data_show['image']; ?>"><?php echo $data_show['image']; ?></a></td>
														<td><?php echo $data_show['update_at']; ?></td>
														<td align="center">
															<a href="<?php echo $cfg_baseurl; ?>admin/slideshow/edit/?id=<?php echo $data_show['banner_id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
															<a href="<?php echo $cfg_baseurl; ?>admin/slideshow/delete/?id=<?php echo $data_show['banner_id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php
												}
												?>
												</tbody>
											</table>
										</div>
										<div class="table-responsive">
										<nav class="m-t-20">
											<ul class="pagination">
											<?php
// start paging link
$self = $_SERVER['PHP_SELF'];
$query_list = mysqli_query($db, $query_list);
$total_no_of_records = mysqli_num_rows($query_list);
echo "<li class='page-item disabled'><a href='#' class='page-link'>Total: ".$total_no_of_records."</a></li>";
if($total_no_of_records > 0) {
	$total_no_of_pages = ceil($total_no_of_records/$records_per_page);
	$current_page = 1;
	if(isset($_GET["page_no"])) {
		$current_page = $_GET["page_no"];
	}
	if($current_page != 1) {
		$previous = $current_page-1;
		echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=1'>← First</a></li>";
		echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$previous."'><i class='fa fa-angle-left'></i> Previous</a></li>";
	}
	for($i=1; $i<=$total_no_of_pages; $i++) {
		if($i==$current_page) {
			echo "<li class='page-item active'><a class='page-link' href='".$self."?page_no=".$i."'>".$i."</a></li>";
		} else {
			echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$i."'>".$i."</a></li>";
		}
	}
	if($current_page!=$total_no_of_pages) {
		$next = $current_page+1;
		echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$next."'>Next <i class='fa fa-angle-right'></i></a></li>";
		echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$total_no_of_pages."'>Last →</a></li>";
	}
}
// end paging link
											?>
											</ul>
										</nav>
										</div>
		</div>
<!-- END panel-->
      </div>
    </div>
  </div>
</div>

<!-- end row -->
<?php
	include("../../lib/footer.php");
} else {
    	header("Location: ".$cfg_baseurl);
}
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>