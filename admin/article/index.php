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
          <a href="#kelola-news-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
          Kelola Artikel
          </a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="kelola-news-tab">
            <div class="form-group">
                <a href="<?php echo $cfg_baseurl; ?>admin/article/add/" class="btn btn-primary btn-bordered waves-effect w-md waves-light"><i class="fa fa-plus"></i> Tambah Data </a>
                <a href="<?php echo $cfg_baseurl; ?>admin/article/cetak" class="btn btn-dark btn-bordered waves-effect w-md waves-light"><i class="fa fa-file"></i> Cetak Laporan </a>
            </div>
            <div class="form-group">
                <form method="GET">
                    <div class="input-group m-b-20">
                        <input type="text" name="search" class="form-control" placeholder="Cari judul artikel">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-info btn-bordered waves-effect waves-light"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
                                        <div class="table-responsive">
											<table class="table table-striped table-bordered table-hover m-0">
												<thead>
													<tr>
													    <th>No</th>
														<th>Kategori</th>
														<th>Judul</th>
														<th>Latest</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
												<?php
// start paging config
if (isset($_GET['search'])) {
	$search = $_GET['search'];
	$query_list = "SELECT news_id,title,tautan,news.update_at,category_name,slug FROM news,category WHERE news.category_id = category.category_id AND title LIKE '%$search%' ORDER BY publish_at DESC"; // edit
} else {
	$query_list = "SELECT news_id,title,tautan,news.update_at,category_name,slug FROM news,category WHERE news.category_id = category.category_id ORDER BY publish_at DESC"; // edit
}
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
												?>
												        <td><?php echo $no++; ?></td>
														<td><a href="<?php echo $cfg_baseurl; ?>article/sortir/?s=<?php echo $data_show['slug']; ?>"><?php echo $data_show['category_name']; ?></a></td>
														<td><a href="<?php echo $cfg_baseurl; ?>article/?p=<?php echo $data_show['tautan']; ?>"><?php echo $data_show['title']; ?></a></td>
														<td><?php echo $data_show['update_at']; ?></td>
														<td align="center">
															<a href="<?php echo $cfg_baseurl; ?>admin/article/edit/?id=<?php echo $data_show['news_id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
															<a href="<?php echo $cfg_baseurl; ?>admin/article/delete/?id=<?php echo $data_show['news_id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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