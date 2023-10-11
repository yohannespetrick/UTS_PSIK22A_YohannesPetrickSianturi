<?php
date_default_timezone_set('Asia/Jakarta');
error_reporting(0);

// web
$cfg_webname = "Astra Honda Motor";
$cfg_baseurl = "https://abngpetrick.com/ahm/";
$cfg_author = "Yohannes Petrick Sianturi";
$cfg_logo_txt = "A H M";
$cfg_register = "#";
$cfg_about = "PT Astra Honda Motor (AHM) merupakan pelopor industri sepeda motor di Indonesia. Didirikan pada 11 Juni 1971 dengan nama awal PT Federal Motor.";

// database
$db_server = "localhost";
$db_user = "ladangc2_ahm";
$db_password = "ladangc2_ahm";
$db_name = "ladangc2_ahm";

// date & time
$date = date("Y-m-d");
$time = date("H:i:s");
$dateandtime = date("Y-m-d H:i:s");

// require
require("lib/database.php");
require("lib/function.php");