<?php 
session_start();

include('../config.php');
error_reporting(1);
if (isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
	$result = mysqli_query($db, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		if($row['level']=="Admin"){


			$_SESSION['nama'] = $row['nama'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['telepon'] = $row['telepon'];
			$_SESSION['foto'] = $row['foto'];
			$_SESSION['level'] = $row['level'];

			echo "<script>alert('Selamat Datang Kembali,".$username."!!');
			document.href.location='index.php'</script>";
			header("Location: ../admin/index.php");
		} 
		else if($row['level']=="Pengawas"){
		
			$_SESSION['nama'] = $row['nama'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['telepon'] = $row['telepon'];
			$_SESSION['foto'] = $row['foto'];
			$_SESSION['level'] = $row['level'];

			echo "<script>alert('Selamat Datang Kembali,".$username."!!');
			document.href.location='index.php'</script>";
			header("Location: ../pengawas/index.php");
		}
		else if($row['level']=="User"){
		
			$_SESSION['nama'] = $row['nama'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['telepon'] = $row['telepon'];
			$_SESSION['foto'] = $row['foto'];
			$_SESSION['level'] = $row['level'];
	
			echo "<script>alert('Selamat Datang Kembali,".$username."!!');
			document.href.location='index.php'</script>";
			header("Location: ../user/index.php");
		} else {
			header("location: ../index.php?pesan=username password salah");
		}
	} else {
		echo "<script>alert('Ups,Username atau Password yang Anda Masukkan Salah!.');
		document.href.location='../index.php'</script>";
		header("location: ../index.php");
	}
}


?>