<?php

include("../../config.php");

if(isset($_POST['ubahSekolah'])){
//Edit Data Sekolaha
// cek apakah tombol simpan sudah diklik atau blum?

    // ambil data dari formulir
    $id=$_POST['id'];
    $nama_sekolah = $_POST['nama_sekolah'];
    $npsn = $_POST['npsn'];
    $status = $_POST['status'];
    $akreditasi = $_POST['akreditasi'];
    $bentuk_pendidikan= $_POST['bentuk_pendidikan'];
    $status_pemilik = $_POST['status_pemilik'];
    $sk_sekolah= $_POST['sk_sekolah'];
    $tgl_sk= $_POST['tgl_sk'];
    $sk_izin= $_POST['sk_izin'];
    $tgl_izin= $_POST['tgl_izin'];

    // buat query update
    $sql = "UPDATE data_sekolah SET nama_sekolah='$nama_sekolah',npsn='$npsn',status='$status',akreditasi='$akreditasi',bentuk_pendidikan='$bentuk_pendidikan',status_pemilik='$status_pemilik',sk_sekolah='$sk_sekolah',tgl_sk='$tgl_sk',sk_izin='$sk_izin',tgl_izin='$tgl_izin' WHERE id=$id";
    $query = mysqli_query($db, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman list-siswa.php
        echo '<script>
        alert("Berhasil Mengubah Data Sekolah!!");
        document.location.href="../index.php";
        </script>';
    } else {
        // kalau gagal tampilkan pesan
        var_dump($_POST);
        die();
        // header('Location: ../index.php?status=gagal');
    }

}
// UPDATE data_sekolah SET nama_sekolah=NEW.nama_sekolah,npsn=NEW.npsn,status=NEW.status,
// akreditasi=NEW.akreditasi,bentuk_pendidikan=NEW.bentuk_pendidikan,
// status_pemilik=NEW.status_pemilik,sk_sekolah=NEW.sk_sekolah,tgl_sk=NEW.tgl_sk,
// sk_izin=NEW.sk_izin,tgl_izin=NEW.tgl_izin WHERE data_sekolah.npsn=old.npsn
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
    $thn_terbit = $_POST['thn'];
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
//Edit sampul buku
else if(isset($_POST['sampul'])){
    // ambil data dari formulir
    $id = $_POST['id'];
    $foto = upFoto();

    if(!$foto){
        return false;
    }
    // buat query (judul,pengarang,penerbit,thn_terbit,indeks,lokasi,stok) VALUE ('$judul', '$pengarang', '$penerbit' ,'$thn_terbit', '$indeks','$lokasi','$stok')";
    $sql = "UPDATE list_buku SET foto='$foto' WHERE id_buku=$id";
    $query = mysqli_query($db, $sql);

 
 // apakah query simpan berhasil?
 if( $query ) {
    // kalau berhasil alihkan ke halaman index.php dengan status=sukses
    echo '<script>
    alert("Berhasil Mengubah Sampul Buku!!");
    document.location.href="../detail.php";
    </script>';
} else {
    // kalau gagal tampilkan pesan
    header('Location: ../detail.php?status=gagal');
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
    $nama = $_POST['nama'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = strtotime("+7 day", strtotime($tgl_pinjam)); // +7 hari dari tgl peminjaman
	$tgl_kembali = date('Y-m-d', $tgl_kembali); // format tgl peminjaman tahun-bulan-hari
    $jumlah =$_POST['jumlah'];
    

    // buat query
   
    $query = mysqli_query($db, "INSERT INTO list_pinjam (judul,nama,tgl_pinjam,tgl_kembali,jumlah) VALUE ('$judul','$nama','$tgl_pinjam','$tgl_kembali','$jumlah')");

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
var_dump($_POST);
    // ambil data dari formulir
    $id = $_POST['id_pinjam'];
    $judul = $_POST['judul'];
    $nama = $_POST['nama'];
    $pinjam = $_POST['pinjam'];
    $balik = $_POST['balik'];
    $balik = strtotime("+7 day", strtotime($pinjam)); // +7 hari dari tgl peminjaman
	$balik = date('Y-m-d', $balik); // format tgl peminjaman tahun-bulan-hari
    $jumlah = $_POST['jumlah'];

    // buat query
    $sql = $sql = "UPDATE list_pinjam SET judul='$judul',nama='$nama',tgl_pinjam='$pinjam',tgl_kembali='$balik',jumlah='$jumlah' WHERE id_pinjam=$id";
    $query = mysqli_query($db, $sql) or die(mysqli_error($db));

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        echo '<script>
        alert("Berhasil Mengubah Detail Peminjaman!!");
        document.location.href="../detail_pinjam.php";
        </script>';
    } else {
        // kalau gagal tampilkan pesan
        header('Location: ../pinjam.php?status=gagal');
    }
}
//Edit Data Admin
// cek apakah tombol simpan sudah diklik atau blum?

if(isset($_POST['editAdmin'])){

   // ambil data dari formulir
   $username = $_POST['username'];
   $password = md5($_POST['password']);
   $nama = $_POST['nama'];
   $email = $_POST['email'];
   $telepon = $_POST['telepon'];
   $level = $_POST['level'];

   // buat query update
   $sql = "UPDATE user SET username='$username',password='$password',nama='$nama',email='$email',telepon='$telepon',level='$level' WHERE username='$username'";
   $query = mysqli_query($db, $sql);

   // apakah query update berhasil?
   if( $query ) {
       // kalau berhasil alihkan ke halaman list-siswa.php
       echo '<script>
       alert("Berhasil Mengubah Data Admin!!");
       document.location.href="../admin.php";
       </script>';
   } else {
       // kalau gagal tampilkan pesan
       header('Location: ../admin.php?status=gagal');
   }

}

// function denda(){
//     return confirm("Kembalikan Buku '".$pinjam["judul"]."' Atas Nama'".$pinjam["nama"]."'??");
//     if ($denda > 0){
//     echo '<script>alert("'.$pinjam["nama"].' Dikenai Denda sebesar Rp.'.$denda.'Dikarenakan Terlambat '.$hari.' Dari Tanggal Kembali Buku Ini");
//     document.href.location="denda.php";</script>';
// } else {
//     header("denda.php");
// }
// }




?>
