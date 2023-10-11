<?php
require("../../mainconfig.php");

if (isset($_POST['service'])) {
	$post_sid = mysqli_real_escape_string($db, $_POST['service']);
	$check_service = mysqli_query($db, "SELECT * FROM services WHERE id = '$post_sid' AND status = 'Active'");
	if (mysqli_num_rows($check_service) == 1) {
		$data_service = mysqli_fetch_assoc($check_service);
		$price = $data_service['total_price'];
	?>   
	                                <div class="form-row">
	                                    <div class="form-group col-md-6">
                                		<label>Keterangan</label>
                                		<div class="form-control" style="height: auto !important;"><?php echo $data_service['note']; ?></div>
                                	</div>
                                		<div class="form-group col-md-6">
                                			<label>Biaya</label>
                                			<div class="input-group">
                                				<div class="input-group-prepend">
                                					<span class="input-group-text">Rp</span>
                                				</div>
                                				<span class="form-control" id="price"><?php echo number_format($price,0,',','.'); ?></span>
                                			</div>
                                		</div>
                                	</div>
<?php
	} else {
	    header("Location: ".$cfg_baseurl."logout.php");
	    
	}
} else {
    header("Location: ".$cfg_baseurl."logout.php");
}
?>