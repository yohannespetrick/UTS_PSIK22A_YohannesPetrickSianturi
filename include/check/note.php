<?php
require("../../mainconfig.php");

if (isset($_POST['services'])) {
	$post_sid = mysqli_real_escape_string($db, $_POST['services']);
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
	    $service = $data_service['service'];
	    if($service == "ANGSURAN"){
	?>
        <div class="form-group">
		  <label>Angsuran ke</label>
		  <select class="form-control" id="angsuran_ke" name="angsuran_ke">
		      <option value="0">Pilih salah satu</option>
		      <option value="1">1</option>
		      <option value="2">2</option>
		      <option value="3">3</option>
		      <option value="4">4</option>
		      <option value="5">5</option>
		      <option value="6">6</option>
		      <option value="7">7</option>
		      <option value="8">8</option>
		      <option value="9">9</option>
		      <option value="10">10</option>
		      <option value="11">11</option>
		      <option value="12">12</option>
        	</select>
        </div>
    <?php
	    }
	    if($service == "PERSEMESTER"){
	?>
	    <div class="form-group">
        	<label>Untuk Semester</label>
        	<select class="form-control" id="untuk_semester" name="untuk_semester">
		      <option value="0">Pilih salah satu</option>
		      <option value="2">2</option>
		      <option value="3">3</option>
		      <option value="4">4</option>
		      <option value="5">5</option>
		      <option value="6">6</option>
		      <option value="7">7</option>
		      <option value="8">8</option>
        	</select>
        </div>
    <?php
	    }
    ?>

<?php
	} else {
	    header("Location: ".$cfg_baseurl."logout.php");
	    
	}
} else {
    header("Location: ".$cfg_baseurl."logout.php");
}
?>