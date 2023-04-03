<?php 
 session_start();
 include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: buku.php");
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
    <title>Perpustakaan | Buku</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="buku.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Pengelolaan Buku</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="member.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Pengelolaan Member</span></a>
            </li>
            <li class="nav-item">
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
                    <div class="row">
                        <!-- Datatables -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">Pengelola Buku</h4>
                                    <div class="d-flex flex-row-reverse align-items-center "><a href='#' class='btn btn-sm btn-primary col-md-12 p-2' data-toggle='modal' data-target='#tambahModal'><i class="fa fa-book"></i>  Tambah Buku</a></div>
                                </div>

                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush" id="dataTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID Buku</th>
                                                <th>Judul Buku</th>
                                                <th>Pengarang</th>
                                                <th>Penerbit</th>
                                                <th>Stok</th>
                                                <th>Info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = $db->query("SELECT * FROM list_buku");
                                            $i=1;
                                            while($buku = mysqli_fetch_assoc($query)) {
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $buku['judul']?></td>
                                                <td><?= $buku['pengarang']?></td>
                                                <td><?= $buku['penerbit']?></td>
                                                <td><?= $buku['stok']?></td>
                                                <td>
                                                <a href='#?id_buku=<?= $buku['id_buku'] ?>' class='btn btn-sm btn-success' id="tmblUbah" data-toggle='modal'  data-target='#ubahModal' 
                                                data-id_buku="<?= $buku['id_buku'];?> " data-judul="<?= $buku['judul'];?> " 
                                                    data-pengarang="<?= $buku['pengarang'];?> " data-penerbit="<?= $buku['penerbit'];?> " data-thn="<?= $buku['thn_terbit'];?>" 
                                                    data-indeks="<?= $buku['indeks'];?>" data-lokasi="<?= $buku['lokasi'];?> " data-stok="<?= $buku['stok'];?>" data-foto="<?= $buku['foto'];?>" ><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-primary" value="detail" name="detail" href="detail.php?id_buku=<?= $buku['id_buku'] ?> " ><i class='fa fa-eye'></i></a>
                                                </td>
                                            
                                            </tr>  
                                        <?php $i++;} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CREATE TRIGGER `balikBuku` AFTER DELETE ON `list_pinjam` FOR EACH ROW BEGIN UPDATE list_buku SET stok=stok+1 WHERE id_buku=OLD.id_buku; END -->
                    <!-- CREATE TRIGGER `kurangiStok` AFTER INSERT ON `list_buku` FOR EACH ROW BEGIN UPDATE list_buku SET stok =stok-1 WHERE id_buku=NEW.id_buku; END -->
                        <!-- Modal Ubah-->
                        <div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="ubahModaltitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ubahModal">Edit Data Buku</h5>
                                    </div>
                                    <div class="modal-body" id="ubah">
                                        <form action="fungsi/proses_edit.php" method="POST" role="form">
                                            <input type="hidden" name="id" id="id_buku" >
                                            <div class="form-group row">
                                                <label  class="col-sm-4 col-form-label" for="judul">Judul Buku : </label>
                                                <input type="text" class="form-control col-sm-8" name="judul" id="judul" placeholder="Judul Buku">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="pengarang">Nama Pengarang : </label>
                                                <input type="text" class="form-control col-sm-8" name="pengarang" id="pengarang" placeholder="Nama Pengarang" >
                                            </div>
                                            <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="penerbit">Nama Penerbit : </label>
                                            <input type="text" class="form-control col-sm-8" name="penerbit" id="penerbit" placeholder="Nama penerbit" >
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="thn">Tahun Terbit : </label>
                                                <input type="date" class="form-control col-sm-8" name="thn" id="thn" placeholder="2007-05-23">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="indeks">Indeks Buku : </label>
                                                <input type="text" class="form-control col-sm-8" name="indeks" id="indeks" placeholder="Indeks Buku" >
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="lokasi">Lokasi Rak Buku : </label>
                                                <input type="text" class="form-control col-sm-8" name="lokasi" id="lokasi" placeholder="Lokasi Rak Buku">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="stok">Stok Buku : </label>
                                                <input type="text" class="form-control col-sm-8" name="stok" id="stok" placeholder="Stok Buku">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary" value="ubah" name="ubahDetail">Ubah Detail Buku</button>
                                            </div>
                                        </form>
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

                        <!-- Modal Tambah -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahModal">Tambah Buku</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="tambah">
                                        <form action="fungsi/proses_edit.php" method="POST" role="form" enctype="multipart/form-data">
                                            <input type="hidden" name="id_buku" id="id_buku" >
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="judul">Judul Buku </label>
                                                    <input type="text" class="form-control col-sm-8" name="judul" id="judul" placeholder="Judul Buku">
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="pengarang">Nama Pengarang </label>
                                                    <input type="text" class="form-control col-sm-8" name="pengarang" id="pengarang" placeholder="Nama Pengarang" >
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="penerbit">Nama Penerbit </label>
                                                    <input type="text" class="form-control col-sm-8" name="penerbit" id="penerbit" placeholder="Nama penerbit" >
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="thn">Tahun Terbit </label>
                                                    <input type="date" class="form-control col-sm-8" name="thn" id="thn" placeholder="2007-05-23">
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="indeks">Indeks Buku </label>
                                                    <input type="text" class="form-control col-sm-8" name="indeks" id="indeks" placeholder="Indeks Buku" >
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="lokasi">Lokasi Rak Buku </label>
                                                    <input type="text" class="form-control col-sm-8" name="lokasi" id="lokasi" placeholder="Lokasi Rak Buku">
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="stok">Stok Buku </label>
                                                    <input type="text" class="form-control col-sm-8" name="stok" id="stok" placeholder="Stok Buku">
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label" for="foto">Cover Buku  </label>
                                                    <input type="file" class="form-control col-sm-6" name="foto" id="foto">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary" value="tambah" name="tambah">Tambah Buku</button>
                                            </div>
                                        </form>
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
                        <span>&copy; <script> document.write(new Date().getFullYear()); </script> Made By <a href="https://github.com/akhmdrdlo" class="font-weight-bold text-primary" target="_blank">Akhmad Ridlo</a> - 
                            <b>SMK Fatahillah Cileungsi</b>
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

        $(document).on("click","#tmblUbah", function() {
                let id=$(this).data("id_buku");
                let judul=$(this).data("judul");
                let pengarang=$(this).data("pengarang");
                let penerbit=$(this).data("penerbit");
                let thn=$(this).data("thn");
                let indeks=$(this).data("indeks");
                let lokasi=$(this).data("lokasi");
                let stok=$(this).data("stok");
                let foto=$(this).data("foto");

                $("#id_buku").val(id);
                $("#ubah #judul").val(judul);
                $("#ubah #pengarang").val(pengarang);
                $("#ubah #penerbit").val(penerbit);
                $("#ubah #thn").val(thn);
                $("#ubah #indeks").val(indeks);
                $("#ubah #lokasi").val(lokasi);
                $("#ubah #stok").val(stok);
                $("#ubah #foto").val(foto);
            });
    </script>
</body>
</html>