<?php
session_start();

include('../config.php');


// Admin Register
if (isset($_SESSION['username'])) {
    header("Location: login.php");
}

function upfoto(){
    // Ambil Data yang Dikirim dari Form
   $nama_file = $_FILES['foto']['name'];
   $ukuran_file = $_FILES['foto']['size'];
   $tipe_file = $_FILES['foto']['type'];
   $tmp_file = $_FILES['foto']['tmp_name'];
   
   // Set path folder tempat menyimpan gambarnya
   $path = "../img/foto/".$nama_file;
   
   if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
       // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
       if($ukuran_file <= 1000000){ // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
           // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
           // Proses upload
           if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
               
           return $nama_file;
           }else{
               // Jika gambar gagal diupload, Lakukan :
                echo '<script>
                alert("Terjadi Kesalahan, Gambar Gagal Di Upload");
                </script>';
           }
       }else{
           // Jika ukuran file lebih dari 1MB, lakukan :
            echo '<script>
            alert("Ukuran Gambar Terlalu Besar!! (max>1MB)");
            </script>';
       }
   }else{
       // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
        echo '<script>
        alert("Tipe Gambar Harus berekstensi JPG/PNG/JPEG!!");
        </script>';
   }
}
if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	$foto = upfoto();

	if (!$foto){
		return false;
	}

	if ($password == $cpassword) {
		$sql = "SELECT * FROM user WHERE username='$username'";
		$result = mysqli_query($db, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO user (nama, username, password , foto,level)
					VALUES ('$nama','$username', '$password','$foto','Pengawas')";
			$result = mysqli_query($db, $sql);
			if ($result) {
				echo "<script>alert('Selamat Datang di PerpusWeb,".$nama."!!');
                document.location.href='../index.php';</script>";
				$username = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
                
			} else {
				echo "<script>alert('Upss, Sepertinya ada Masalah')
                document.location.href='../register.php';</script>";
			}
		} else {
			echo "<script>alert('Oh!! Username Yang Sama Sudah Terdaftar!')
            document.location.href='../register.php';</script>";
		}
		
	} else {
		echo "<script>alert('Username atau Password Anda Salah!!')
        document.location.href='../register.php';</script>";
	}
}

?>