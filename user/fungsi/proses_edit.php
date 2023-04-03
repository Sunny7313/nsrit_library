<?php

include("../../config.php");

//Tambah Data Member
// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['daftar'])){

    // ambil data dari formulir
    $id_member = $_POST['id_member'];
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $jk =$_POST['jenis_kelamin'];
    $tmpt_lahir = $_POST['tmpt_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $kelas= $_POST['kelas'];
    $nama_jurusan=$_POST['nama_jurusan'];

    // buat query
    $sql = "INSERT INTO list_member (nama,nis,jenis_kelamin,tmpt_lahir,tgl_lahir,alamat,kelas,nama_jurusan) VALUE ('$nama','$nis','$jk','$tmpt_lahir','$tgl_lahir','$alamat','$kelas','$nama_jurusan')";
    $query = mysqli_query($db, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        echo '<script>
        alert("Berhasil Menambahkan Member!!");
        document.location.href="../member.php";
        </script>';
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: ../member.php?status=gagal');
    }
}

//Edit Data Member
// cek apakah tombol simpan sudah diklik atau blum?
else if(isset($_POST['edit'])){

    // ambil data dari formulir
    $id_member = $_POST['id_member'];
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $tmpt_lahir = $_POST['tmpt_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $kelas= $_POST['kelas'];
    $nama_jurusan= $_POST['nama_jurusan'];

    // buat query update
    $sql = "UPDATE list_member SET nama='$nama',nis='$nis',tmpt_lahir='$tmpt_lahir',tgl_lahir='$tgl_lahir',alamat='$alamat',kelas='$kelas',nama_jurusan='$nama_jurusan' WHERE id_member=$id_member";
    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman list-siswa.php
        echo '<script>
        alert("Berhasil Mengubah Data Member!!");
        document.location.href="../member.php";
        </script>';
    } else {
        // kalau gagal tampilkan pesan
        header('Location: ../member.php?status=gagal');
    }

}
function upfoto(){
    // Ambil Data yang Dikirim dari Form
   $nama_file = $_FILES['foto']['name'];
   $ukuran_file = $_FILES['foto']['size'];
   $tipe_file = $_FILES['foto']['type'];
   $tmp_file = $_FILES['foto']['tmp_name'];
   
   // Set path folder tempat menyimpan gambarnya
   $path = "../../img/cover/".$nama_file;
   
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
//Tambah Data Buku
if(isset($_POST['tambah'])){

    // ambil data dari formulir
    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit =$_POST['penerbit'];
    $thn_terbit = $_POST['thn_terbit'];
    $indeks = $_POST['indeks'];
    $lokasi = $_POST['lokasi'];
    $stok= $_POST['stok'];
    $foto = upfoto();
    if(!$foto){
        return false;
    }
    // buat query
    $sql = "INSERT INTO list_buku (judul,pengarang,penerbit,thn_terbit,indeks,lokasi,stok,foto) VALUE ('$judul','$pengarang','$penerbit','$thn_terbit','$indeks','$lokasi','$stok','$foto')";
    $query = mysqli_query($db, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        echo '<script>
        alert("Berhasil Menambahkan Buku!!");
        document.location.href="../buku.php";
        </script>';
    }  else {
        // kalau gagal tampilkan pesan
        header('Location: ../buku.php?status=gagal');
    }
}
 //Edit Detail buku
else if(isset($_POST['ubah'])){
    // ambil data dari formulir
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit =$_POST['penerbit'];
    $thn = $_POST['thn'];
    $indeks = $_POST['indeks'];
    $lokasi = $_POST['lokasi'];
    $stok= $_POST['stok'];
    $foto = upfoto();

    if(!$foto){
        return false;
    }

    // buat query (judul,pengarang,penerbit,thn_terbit,indeks,lokasi,stok) VALUE ('$judul', '$pengarang', '$penerbit' ,'$thn_terbit', '$indeks','$lokasi','$stok')";
    $sql = "UPDATE list_buku SET judul='$judul',pengarang='$pengarang',penerbit='$penerbit',hn_terbit='$thn',indeks='$indeks',lokasi='$lokasi',stok='$stok',foto='$foto' WHERE id_buku=$id";
    $query = mysqli_query($db, $sql);
 
 // apakah query simpan berhasil?
 if( $query ) {
    // kalau berhasil alihkan ke halaman index.php dengan status=sukses
    echo '<script>
    alert("Berhasil Mengubah Detail Buku!!");
    document.location.href="../buku.php";
    </script>';
} else {
    // kalau gagal tampilkan pesan
    header('Location: ../buku.php?status=gagal');
}
} 

 //Edit Detail buku (Tanpa Foto)
 else if(isset($_POST['ubahDetail'])){
    // ambil data dari formulir
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit =$_POST['penerbit'];
    $thn = $_POST['thn'];
    $indeks = $_POST['indeks'];
    $lokasi = $_POST['lokasi'];
    $stok= $_POST['stok'];

    // buat query (judul,pengarang,penerbit,thn_terbit,indeks,lokasi,stok) VALUE ('$judul', '$pengarang', '$penerbit' ,'$thn_terbit', '$indeks','$lokasi','$stok')";
    $sql = "UPDATE list_buku SET judul='$judul',pengarang='$pengarang',penerbit='$penerbit',thn_terbit='$thn',indeks='$indeks',lokasi='$lokasi',stok='$stok' WHERE id_buku=$id";
    $query = mysqli_query($db, $sql);
 
 // apakah query simpan berhasil?
 if( $query ) {
    // kalau berhasil alihkan ke halaman index.php dengan status=sukses
    echo '<script>
    alert("Berhasil Mengubah Detail Buku!!");
    document.location.href="../buku.php";
    </script>';
} else {
    // kalau gagal tampilkan pesan
    header('Location: ../buku.php?status=gagal');
}
} 


//Tambah Data Peminjaman
else if(isset($_POST['tambahKan'])){

    // ambil data dari formulir
    $id_pinjam = $_POST['id_pinjam'];
    $judul = $_POST['judul'];
    $id_member = $_POST['id_member'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = strtotime("+7 day", strtotime($tgl_pinjam)); // +7 hari dari tgl peminjaman
	$tgl_kembali = date('Y-m-d', $tgl_kembali); // format tgl peminjaman tahun-bulan-hari
    $jumlah =$_POST['jumlah'];
    

    // buat query
   
    $query = mysqli_query($db, "INSERT INTO list_pinjam (judul,id_member,tgl_pinjam,tgl_kembali,jumlah) VALUE ('$judul','$id_member','$tgl_pinjam','$tgl_kembali','$jumlah')");

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        echo '<script>
        alert("Berhasil Menambahkan Data Peminjaman!!");
        document.location.href="../pinjam.php";
        </script>';
    }  else {
        // kalau gagal tampilkan pesan
        header('Location: ../pinjam.php?status=gagal');
    }
}
// Edit Detail Peminjamam
else if(isset($_POST['ubahData'])){

    // ambil data dari formulir
    $id = $_POST['id_pinjam'];
    $judul = $_POST['judul'];
    $id_member =$_POST['id_member'];
    $pinjam = $_POST['pinjam'];
    $balik = $_POST['balik'];
    $balik = strtotime("+7 day", strtotime($pinjam)); // +7 hari dari tgl peminjaman
	$balik = date('Y-m-d', $balik); // format tgl peminjaman tahun-bulan-hari
    $jumlah =$_POST['jumlah'];

    // buat query
    $sql = "UPDATE list_pinjam SET judul='$judul',id_member='$id_member',tgl_pinjam='$pinjam',tgl_kembali='$balik',jumlah='$jumlah' WHERE id_pinjam=$id";
    $query = mysqli_query($db, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        echo '<script>
        alert("Berhasil Mengubah Detail Peminjaman!!");
        document.location.href="../detail_pinjam.php";
        </script>';
    } else {
        // kalau gagal tampilkan pesan
        die(mysqli_error($db));
        header('Location: ../pinjam.php?status=gagal');
    }
}

else if(isset($_POST['upload'])){

// menghubungkan dengan koneksi
include 'config.php';
// menghubungkan dengan library excel reader
include "excel_reader2.php";

// upload file xls
$target = basename($_FILES['dataExcel']['name']) ;
move_uploaded_file($_FILES['dataExcel']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['dataExcel']['name'],17777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['dataExcel']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$nama     = $data->val($i, 0);
	$npsn   = $data->val($i, 1);
	$status  = $data->val($i, 2);
    $akreditasi  = $data->val($i, 3);
    $bentukdidik  = $data->val($i, 4);
    $statpemilik  = $data->val($i, 5);
    $skberdiri  = $data->val($i, 6);
    $tgl_sk  = $data->val($i, 7);
    $skizin  = $data->val($i, 8);
    $tgl_izin  = $data->val($i, 9);




	if($nama != "" && $npsn != "" && $status != "" && $akreditasi != "" && $bentukdidik != "" && $statpemilik != "" 
        && $skberdiri != "" && $tgl_sk != "" && $skizin != "" && $tgl_izin != ""){
		// input data ke database (table data_pegawai)
		$query=mysqli_query($db,"INSERT into data_sekolah values('$nama','$snpsn','$status','$akreditasi','$bentukdidik','$statpemilik','$skberdiri','$tgl_sk','$skizin','$tgl_izin')");
        
        if ($query){
            // hapus kembali file .xls yang di upload tadi
            unlink($_FILES['dataExcel']['name']);
            // jika berhasil dialihkan ke halaman awal
            header("location:index.php?berhasil=$berhasil");
            
        } else {
            var_dump($query);
            die("Gagal Memasukkan Data........");
        
        }
    }
}



}
?>
