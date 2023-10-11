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
//menyertakan file fpdf, file fpdf.php di dalam folder FPDF yang diekstrak
include "../../lib_pdf/fpdf.php";

//membuat objek baru bernama pdf dari class FPDF
//dan melakukan setting kertas l : landscape, A5 : ukuran kertas
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// menyetel font yang digunakan, font yang digunakan adalah arial, bold dengan ukuran 16
$pdf->SetFont('Arial','B',16);
// judul
$pdf->Cell(190,7,'LAPORAN ARTIKEL',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,''.$cfg_webname.'',0,1,'C');
 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'NO',1,0);
$pdf->Cell(25,6,'KATEGORI',1,0);
$pdf->Cell(125,6,'JUDUL',1,0);
$pdf->Cell(25,6,'PUBLISH',1,1);
 
$pdf->SetFont('Arial','',10);
 
//koneksi ke database
$no = 1;
$tampil = mysqli_query($db, "select category_name,title,publish_at from news,category WHERE news.category_id = category.category_id ORDER BY publish_at ASC");
while ($hasil = mysqli_fetch_array($tampil)){
    $pdf->Cell(10,6,$no++,1,0);
    $pdf->Cell(25,6,$hasil['category_name'],1,0);
    $pdf->Cell(125,6,$hasil['title'],1,0);
    $pdf->Cell(25,6,$hasil['publish_at'],1,1); 
}
 
$pdf->Output();

} else {
    	header("Location: ".$cfg_baseurl);
}
?>