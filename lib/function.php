<?php
// Penulis Kode CR69 - Januari 2017

function random($length) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function random_number($length) {
	$str = "";
	$characters = array_merge(range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
function format_date($date){
	$month = array (
		1 =>   'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Juni',
		'Juli',
		'Agst',
		'Sep',
		'Okt',
		'Nop',
		'Des'
	);
	$pecahkan = explode('-', $date);
	return $pecahkan[2] . ' ' . $month[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
function format_date_en($string){
    $bulanIndo = ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September' , 'October', 'November', 'December'];
 
    $date = explode(" ", $string)[0];
    $time = explode(" ", $string)[1];
    
    $tanggal = explode("-", $date)[2];
    $bulan = explode("-", $date)[1];
    $tahun = explode("-", $date)[0];
    
    
 
    return " " . $bulanIndo[abs($bulan)] . " ".$tanggal.", " . $tahun . " ";
}
function format_datetime_en($string){
    $bulanIndo = ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September' , 'October', 'November', 'December'];
 
    $date = explode(" ", $string)[0];
    $time = explode(" ", $string)[1];
    
    $tanggal = explode("-", $date)[2];
    $bulan = explode("-", $date)[1];
    $tahun = explode("-", $date)[0];
    
    
 
    return " " . $bulanIndo[abs($bulan)] . " ".$tanggal.", " . $tahun . " " . $time;
}