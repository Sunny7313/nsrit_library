<?php
 session_start();
 include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

// kalau tidak ada id di query string
if( !isset($_GET['id_pinjam']) ){
    header('Location: detail_pinjam.php');
}

//ambil id dari query string
$id = $_GET['id_pinjam'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM list_pinjam WHERE id_pinjam=$id";
$query = mysqli_query($db, $sql);
$siswa = mysqli_fetch_assoc($query);

// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    die("data tidak ditemukan...");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../img/logo/perpus2.png" rel="icon">
    <title>Perpustakaan | Detail Pinjam</title>
    <link href="../bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar  sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="../img/logo/perpus.png">
                </div>
                <div class="sidebar-brand-text mx-3">E-Librarie</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-school"></i>
                    <span>Menu Utama</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="buku.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Pengelolaan Buku</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="member.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Pengelolaan Member</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="pinjam.php">
                    <i class="fas fa-fw fa-cart-plus"></i>
                    <span>Data Peminjaman</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"href="denda.php">
                    <i class="fas fa-fw fa-money-check-alt"></i>
                    <span>Proses Denda</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">LOGOUT</div>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logout">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="version" id="version-ruangadmin"></div>
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
          <i class="fa fa-bars text-white"></i>
        </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle " href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="../img/foto/<?= $_SESSION['foto'];?>" style="max-width: 60px">

                                <span class="ml-2 d-none d-lg-inline text-white small" id="userName"><?php echo $_SESSION['nama'];?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#dataDiri" id="#modalCenter">
                                    <i class="fa fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i> Data Diri
                                </a>
                                <a class="dropdown-item" href="admin.php" >
                                    <i class="fa fa-user-alt fa-sm fa-fw mr-2 text-gray-400"></i> Data Admin
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="row mb-3">
                        <!-- Datatables -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">Detail Peminjaman</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                    <?php
                                        $sql= "SELECT list_pinjam.id_pinjam,list_pinjam.tgl_pinjam,list_pinjam.tgl_kembali,list_pinjam.jumlah,list_buku.id_buku,list_buku.judul,list_buku.foto,list_buku.pengarang,list_member.id_member,list_member.nama,list_member.kelas,list_member.nama_jurusan from list_pinjam inner join list_buku on list_pinjam.judul=list_buku.judul INNER JOIN list_member on list_pinjam.nama=list_member.nama WHERE id_pinjam=$id";
                                        $query=mysqli_query($db,$sql);
  
                                        while($pinjam = mysqli_fetch_array($query)){
                                            // untuk menghitung selisih hari terlambat
					                        $tgl_kembali = date_create($pinjam['tgl_kembali']);
					                        $tgl_sekarang = date_create(date('Y-m-d'));
					                        $terlambat = date_diff($tgl_kembali, $tgl_sekarang);
					                        $hari = $terlambat->format("%a");

					                        // menghitung denda
					                        $denda = $hari * 5000;
                                            ?>
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <img src="../img/cover/<?= $pinjam["foto"]; ?>" width="275" height="395" class="m-auto">
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th>ID Buku</th>
                                                        <td><?= $pinjam['id_buku']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Judul Buku</th>
                                                        <td><?= $pinjam['judul']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Pengarang Buku</th>
                                                        <td><?= $pinjam['pengarang']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>ID Member</th>
                                                        <td><?= $pinjam['id_member']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nama Peminjam</th>
                                                        <td><?= $pinjam['nama']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Kelas dan Jurusan</th>
                                                        <td><?= $pinjam['kelas']?> <?= $pinjam['nama_jurusan']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jumlah Buku yang Dipinjam</th>
                                                        <td><?= $pinjam['jumlah']?></td>
                                                    </tr>
                                                    <tr>
                                                    <?php 
                                                     if ($tgl_sekarang > $tgl_kembali) {
                                                        echo "<th>Nominal Denda</th>";
                                                        echo "<td class=' text-danger font-weight-bold'>Rp.".$denda." (".$hari." Hari Terlambat)</td>";
                                                     } else {
                                                        $tgl_kembali = date_create($pinjam['tgl_kembali']);
                                                        $tgl_sekarang = date_create(date('y-m-d'));
                                                        $tenggang = date_diff($tgl_kembali, $tgl_sekarang);
                                                        $hari = $tenggang->format("%a");

                                                         if($hari > 2){
                                                            echo "<th class='bg-secondary text-white'>Tenggang Waktu ".$pinjam['nama']."</th>
                                                            <td class='text-success font-weight-bold '>".$hari." Hari</td>";
                                                         } else {
                                                            echo "<th class='bg-secondary text-white'>Tenggang Waktu ".$pinjam['nama']."</th>
                                                            <td class='text-danger font-weight-bolder'>".$hari." Hari</td>";
                                                         }
                                                     }
                                                    ?>
                                                    </tr>
                                                    <tr>
                                                    <td><a href='#' class='btn btn-sm btn-success col-sm-8 float-right' id="tmblUbah" data-toggle='modal'  data-target='#ubahModal' 
                                                    data-id="<?= $pinjam['id_pinjam'];?>" data-id_buku="<?= $pinjam['id_buku'];?>"
                                                    data-id_member="<?= $pinjam['id_member'];?>" data-tgl_pinjam="<?= $pinjam['tgl_pinjam'];?>" data-tgl_kembali="<?= $pinjam['tgl_kembali'];?>" ><i class="fa fa-edit"></i> Edit Detail</a></td>
                                                    <td><a class="btn btn-sm  btn-warning " href="fungsi/hapus.php?id_pinjam=<?= $pinjam['id_pinjam']?>" onClick="return confirm('Kembalikan Buku??')" ><i class="fa fa-book-open"></i> Kembalikan Buku</a></td>
                                                        <td><a href="pinjam.php" class="btn btn-sm btn-danger col-sm-8 float-right"><i class="fa fa-sign-out-alt"> </i></a></td>
                                                    </tr>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                      <!-- Modal Ubah-->
            <div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="ubahModaltitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ubahModal">Edit Data Member</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    </div>
                                    <div class="modal-body" id="ubah">
                                        <form action="fungsi/proses_edit.php" method="post" role="form">
                                        <input type="hidden" name="id_pinjam" id="id_pinjam" >
                                        <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="judul">JUdul Buku</label>
                                                <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul buku yang Dipinjam" >
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="id_member">ID Member</label>
                                                <input type="text" class="form-control" name="id_member" id="id_member" placeholder="ID Member" >
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="tgl_pinjam">Tanggal Pinjam</label>
                                                <input type="date" class="form-control" name="pinjam" id="tgl_pinjam" placeholder="23-12-2021">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="tgl_kembali">Tanggal Kembali</label>
                                                <input type="date" class="form-control" name="balik" id="tgl_kembali" placeholder="23-12-2021">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" value="ubahData" name="ubahData">Simpan Perubahan</button>
                                    </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>

                         <!-- Modal Profil -->
 <div class="modal fade" id="dataDiri" tabindex="-1" role="dialog" aria-labelledby="dataDiriTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dataDiriTitle">Halo, <?= $_SESSION['level']?> <span id="usName"><?php echo $_SESSION['nama'];?>!!</span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body  text-center">
                                        <h6 class="text-center">
                                            <b>|</b>
                                            <img src="../img/logo/perpus1.png" alt="" width="20px" height="27px">
                                            <b><i class="fa fa-pencil-alt" > </i> Profil Perpustakaan |</b>
                                        </h6>
                                        <h2 class="text-center"><img class="img-profile rounded-circle" src="../img/foto/<?= $_SESSION['foto'];?>" style="max-width: 175px; border: solid black 2px; "></h2>
                                        <h5 class="text-center text-secondary font-underline font-weight-bold"><?= $_SESSION['nama'];?></h5>
                                        <p>Username Anda : <?php echo $_SESSION['username'];?></p>
                                        <p>Email Anda : <?php echo $_SESSION['email'];?></p>
                                        <p>Nomor Telepon Anda : <i class="fa fa-icon fa-phone text-success"></i> <?php echo $_SESSION['telepon'];?></p>
                                        <p>Tingkatan Level Anda : <i class="fa fa-icon fa-security text-warning"></i> <?php echo $_SESSION['level'];?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">OK!</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Modal Logout -->
                    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabelLogout">Upss!!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apa kamu yakin ingin Logout, <?php echo $_SESSION['nama'];?> ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                                        <a href="../logout.php" class="btn btn-primary">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>&copy; <script> document.write(new Date().getFullYear()); </script> Made By Akhmad Ridlo - 
              <b><a href="https://indrijunanda.gitlab.io/" target="_blank">SMK Fatahillah Cileungsi</a></b>
            </span>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="../bootstrap/vendor/jquery/jquery.min.js"></script>
    <script src="../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../bootstrap/js/ruang-admin.min.js"></script>

<script>
  $(document).on("click","#tmblUbah", function() {
                let id=$(this).data("id_pinjam");
                let id_buku=$(this).data("id_buku");
                let id_member=$(this).data("id_member");
                let tgl_pinjam=$(this).data("tgl_pinjam");
                let tgl_kembali=$(this).data("tgl_kembali");

                $("#id_pinjam").val(id);
                $("#ubah #id_buku").val(id_buku);
                $("#ubah #id_member").val(id_member);
                $("#ubah #tgl_pinjam").val(tgl_pinjam);
                $("#ubah #tgl_kembali").val(tgl_kembali);
            });
</script>
</body>

</html>