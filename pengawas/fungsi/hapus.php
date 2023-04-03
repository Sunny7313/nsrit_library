<?php

include("../../config.php");

// Fungsi Hapus Administrator
if( isset($_GET['id_buku']) ){

    // ambil id dari query string
    $id = $_GET['id_buku'];

    // buat query hapus
    $sql = "DELETE FROM list_buku WHERE id_buku=$id";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        header('Location: ../buku.php');
    } else {
        header('location : ../buku.php?pesan=gagal menghapus');
    }

} 
else if( isset($_GET['id_member']) ){

    // ambil id dari query string
    $id = $_GET['id_member'];

    // buat query hapus
    $sql = "DELETE FROM list_member WHERE id_member=$id";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        header('Location: ../member.php');
    } else {
        header('location : ../member.php?pesan=gagal menghapus');
    }

}else if( isset($_GET['id_pinjam']) ){

    // ambil id dari query string
    $id = $_GET['id_pinjam'];

    // buat query hapus
    $sql = "DELETE FROM list_pinjam WHERE id_pinjam=$id";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        header('Location: ../pinjam.php');
    } else {
        header('location : ../pinjam.php?pesan=gagal menghapus');
    }
}else if( isset($_GET['nama']) ){

    // ambil id dari query string
    $id = $_GET['nama'];

    // buat query hapus
    $sql = "DELETE FROM user WHERE nama=$id";
    $query = mysqli_query($db, $sql);
    // apakah query hapus berhasil?
    if( $query ){
        header('Location: .../admin.php');
    } else {
        header('location : .../admin.php?pesan=gagal menghapus');
    }
}
else {
    die("akses dilarang...");
}

// // Fungsi Hapus Pengawas
// if( isset($_GET['id_buku']) ){

//     // ambil id dari query string
//     $id = $_GET['id_buku'];

//     // buat query hapus
//     $sql = "DELETE FROM list_buku WHERE id_buku=$id";
//     $query = mysqli_query($db, $sql);

//     // apakah query hapus berhasil?
//     if( $query ){
//         header('Location: ../admin/buku.php');
//     } else {
//         die("gagal menghapus...");
//         header('location : ../buku.php');
//     }

// } 
// else if( isset($_GET['id_member']) ){

//     // ambil id dari query string
//     $id = $_GET['id_member'];

//     // buat query hapus
//     $sql = "DELETE FROM list_member WHERE id_member=$id";
//     $query = mysqli_query($db, $sql);

//     // apakah query hapus berhasil?
//     if( $query ){
//         header('Location: ../admin/member.php');
//     } else {
//         die("gagal menghapus...");
//     }

// }else if( isset($_GET['id_pinjam']) ){

//     // ambil id dari query string
//     $id = $_GET['id_pinjam'];

//     // buat query hapus
//     $sql = "DELETE FROM list_pinjam WHERE id_pinjam=$id";
//     $query = mysqli_query($db, $sql);

//     // apakah query hapus berhasil?
//     if( $query ){
//         header('Location: ../admin/pinjam.php');
//     } else {
//         die("gagal menghapus...");
//     }
// }else if( isset($_GET['username']) ){

//     // ambil id dari query string
//     $id = $_GET['username'];

//     // buat query hapus
//     $sql = "DELETE FROM user WHERE username=$id";
//     $query = mysqli_query($db, $sql);

//     // apakah query hapus berhasil?
//     if( $query ){
//         header('Location: ../admin/admin.php');
//     } else {
//         header('Location: ../admin/admin.php?gagal menghapus');
//     }
// }
// else {
//     die("akses dilarang...");
// }

?>