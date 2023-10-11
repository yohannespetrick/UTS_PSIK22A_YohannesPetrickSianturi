<?php 
session_start();
require("../../mainconfig.php");
header("Location: ".$cfg_baseurl."user/logout.php");
?>
<?php ?>