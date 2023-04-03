<?php 
 session_start();
 include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: denda.php");
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
    <title>Perpustakaan | Denda</title>
    <link href="../bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
   
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
                    <span>Daftar Buku</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pinjam.php">
                    <i class="fas fa-fw fa-cart-plus"></i>
                    <span>Data Peminjaman</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="denda.php">
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
                    <div class="row">
                        <!-- Datatables -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">Pengelola Denda</h4>
                                </div>
                                <div class="card-body py-3 d-flex flex-row align-items-center justify-content-between">
                                     <!-- Notif Denda Per Hari -->
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Nominal Denda</div>
                                                            <div class="h6 mb-0 font-weight-bold text-gray-800">Rp.5.000/Hari</div>
                                                        </div>
                                                        <div class="col-auto">
                                                        <i class="fas fa-money-bill-wave-alt fa-2x text-success"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                    <!-- New User Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Tenggat Pinjam</div>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">7 Hari</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-alt fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Buku</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php $sql=mysqli_query($db,"SELECT SUM(stok) FROM list_buku");
                                            while($stok = mysqli_fetch_array($sql)) {
                                                ?>
                                                <?= $stok['SUM(stok)']?> Buku
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book-open fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    
                                </div>
                                 
                                <div class="table-responsive p-3">
                                    
                                    <table class="table align-items-center table-flush" id="dataTable">
                                    <thead class="thead-light">
                                            <tr>
                                            <th>ID Pinjam</th>
                                            <th>Nama Peminjam</th>
                                            <th>Buku Pinjaman</th>
					                        <th>Tgl. Peminjaman</th>
					                        <th>Tgl. Pengembalian</th>
					                        <th>Terlambat (Hari)</th>
					                        <th>Total Denda</th>
                                            <th></th>
                                            </tr>
                                        </thead>
				<?php

                // hanya menampilkan data yang terlambat
				$sql = $db->query("SELECT list_pinjam.id_pinjam,list_pinjam.tgl_pinjam,list_pinjam.tgl_kembali,list_buku.id_buku,list_buku.judul,list_member.id_member,list_member.nama,list_member.kelas,list_member.nama_jurusan from list_pinjam inner join list_buku on list_pinjam.judul=list_buku.judul INNER JOIN list_member on list_pinjam.nama=list_member.nama WHERE CURDATE() > tgl_kembali");

				while($pinjam = $sql->fetch_assoc()) {
					// untuk menghitung selisih hari terlambat
					$kembali = date_create($pinjam['tgl_kembali']);
					$sekarang = date_create(date('Y-m-d'));
					$terlambat = date_diff($kembali, $sekarang);
					$hari = $terlambat->format("%a");

					// menghitung denda
					$denda = $hari * 5000;
                    
				?>



				<tr>
                <?="<td><a value='detail' name='detail' href='detail_pinjam.php?id_pinjam=".$pinjam['id_pinjam']."' > "?><?= $pinjam['id_pinjam']?></a></td>
                    <td><?= $pinjam["nama"]?></td>
                    <td><?= $pinjam["judul"]?></td>
					<td><?= $pinjam['tgl_pinjam'] ?></td>
					<td><?= $pinjam['tgl_kembali'] ?></td>
					<td><?= $hari ?> Hari</td>
                    <!-- <a href="detail_pinjam.php?id_pinjam=<?= $pinjam['id_pinjam'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a> -->
                    <td class="text-danger font-weight-bold">Rp.<?= $denda?></td>
                    <td><a class="btn btn-sm btn-warning " href="fungsi/hapus.php?id_pinjam=<?= $pinjam['id_pinjam']?>" onClick="return confirm('Kembalikan Buku <?= $pinjam["judul"];?> Atas Nama <?= $pinjam["nama"];?>??')"> <i class="fa fa-book-open"></i></a></td>
				</tr>
                <?php
                }
				?>
                    </table>

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
                                        <a href="logout.php" class="btn btn-primary">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="../bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../bootstrap/js/ruang-admin.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>    
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>

        $(document).ready(function() {
            $('#dataTable').DataTable(); // ID From dataTable 
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });


    </script>
</body>

</html>