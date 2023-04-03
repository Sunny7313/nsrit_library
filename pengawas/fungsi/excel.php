<?php

// menghubungkan dengan koneksi
include '../../config.php';

include "../../spreadsheet/php-excel-reader/excel_reader2.php";
include "../../spreadsheet/SpreadsheetReader.php";

// upload file xls
$target = basename($_FILES['dataExcel']['name']) ;
move_uploaded_file($_FILES['dataExcel']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['dataExcel']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['dataExcel']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$nama     = $data->val($i, 1);
	$nis   = $data->val($i, 2);
	$jk  = $data->val($i, 3);
  $tmpt_lahir  = $data->val($i, 4);
  $tgl_lahir  = $data->val($i, 5);
  $alamat  = $data->val($i, 6);
  $kelas  = $data->val($i, 7);
  $jurusan  = $data->val($i, 8);

 
	if($nama != "" && $nis != "" && $jk != "" && $tmpt_lahir != "" && $tgl_lahir != "" && $alamat != "" && $kelas != "" && $jurusan != ""){
		// input data ke database (table data_pegawai)
		mysqli_query($db,"INSERT into list_member values('','$nama','$nis','$jk','$tmpt_lahir','$tgl_lahir','$alamat','$kelas','$jurusan')");
		$berhasil++;
	}
}
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['dataExcel']['name']);
 
// alihkan halaman ke index.php
header("location:../index.php?berhasil=$berhasil");
?>

<!-- //  if (isset($_POST['upload'])) {

//   require('spreadsheet/php-excel-reader/excel_reader2.php');
//   require('spreadsheet/SpreadsheetReader.php');

//   //upload data excel kedalam folder uploads
//   $target_dir = "img/".basename($_FILES['dataExcel']['name']);
  
//   move_uploaded_file($_FILES['dataExcel']['tmp_name'],$target_dir);

//   $Reader = new SpreadsheetReader($target_dir);

//   foreach ($Reader as $Key => $Row)
//   {
//    // import data excel mulai baris ke-2 (karena ada header pada baris 1)
//    if ($Key < 1) continue;   
   
//    $query=mysqli_query($db,"INSERT INTO list_member(nama,nis,jenis_kelamin,tmpt_lahir,tgl_lahir,alamat,kelas,jurusan) VALUES ('".$Row[0]."','".$Row[1]."', '".$Row[2]."',".$Row[3].",".$Row[4].",'".$Row[5]."','".$Row[6]."','".$Row[7]."')");
//   }
//   if ($query) {
//     echo "Import Data Excel Berhasil";
//    }else{var_dump($query);
//    die();
//     die();
//    }
//  }
//  ?> -->