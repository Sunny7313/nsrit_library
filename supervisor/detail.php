<?php
 session_start();
 include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: detail.php");
}

// kalau tidak ada id di query string
if( !isset($_GET['id_buku']) ){
    header('Location: buku.php');
}

//ambil id dari query string
$id = $_GET['id_buku'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM list_buku WHERE id_buku=$id";
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
    <title>Perpustakaan | Detail</title>
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
                <a class="nav-link" href="index.html">
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
                            <?php
                                $sql= "SELECT * FROM list_buku WHERE id_buku=$id";
                                $query=mysqli_query($db,$sql);
  
                                 while($buku = mysqli_fetch_array($query)){
                            ?>
                        <div class="col-lg-12">
                            <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">Detail Buku</h4>
                                    <a href='#' class='btn btn-sm btn-success col-md-2 float-right' id="tmblUbah" data-toggle='modal'  data-target='#ubahModal' 
                                        data-id_buku="<?= $buku['id_buku'];?>" data-judul="<?= $buku['judul'];?>" 
                                        data-pengarang="<?= $buku['pengarang'];?>" data-penerbit="<?= $buku['penerbit'];?>" data-thn="<?= $buku['thn_terbit'];?>" 
                                        data-indeks="<?= $buku['indeks'];?>" data-lokasi="<?= $buku['lokasi'];?>" data-stok="<?= $buku['stok'];?>" ><i class="fa fa-edit"></i> Ubah Detail</a>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <?php 
                                        if ($buku["foto"]){
                                            echo "<img src='../img/cover/".$buku['foto']."' width='300' height='450' class='m-auto' style='border : solid black 4px; box-shadow:3px 3px 3px grey;' alt='Cover buku ".$buku['judul']."'>";
                                        }else if (!$buku["foto"]){
                                            echo "<img src='../img/cover/noimage.png' width='300' height='430' class='m-auto' alt='Cover buku ".$buku['judul']."'>";
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                            <tr>
                                            <td colspan="2"><a href='#' class='btn btn-sm btn-success col-sm-12 float-right' id="pinjamBuku" data-toggle='modal'  data-target='#tambahModal' 
                                                    data-judul="<?= $buku['judul'];?>" ><i class="fa fa-plus"></i> Pinjam Buku Ini</a></td>
                                            </tr>
                                            <tr>
                                            <th>ID Buku</th>
                                            <td><?= $buku['id_buku']?></td>
                                            </tr>
                                                    <tr>
                                                        <th>Judul Buku</th>
                                                        <td id="judul"><?= $buku['judul']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Pengarang</th>
                                                        <td><?= $buku['pengarang']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Penerbit</th>
                                                        <td><?= $buku['penerbit']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tahun Terbit</th>
                                                        <td><?= $buku['thn_terbit']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Indeks Buku</th>
                                                        <td><?= $buku['indeks']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Lokasi Rak Buku</th>
                                                        <td><?= $buku['lokasi']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Stok</th>
                                                        <td><?= $buku['stok']?></td>
                                                    </tr>
                                                    <tr>
                                                    <td><a href='#' class='btn btn-sm btn-success col-sm-8 float-right' id="ubahSampul" data-toggle='modal'  data-target='#gantiCover' 
                                                    data-id_buku="<?= $buku['id_buku'];?>"  data-foto="<?= $buku['foto'];?>" ><i class="fa fa-edit"></i> Ganti Sampul</a></td>
                                                    <td><a class="btn btn-sm  btn-danger  col-sm-4" href="fungsi/hapus.php?id_buku=<?= $buku['id_buku']?>" onClick="return confirm('Hapus Data Buku Berjudul <?= $buku["judul"];?>??')" ><i class="fa fa-trash"></i> Hapus</a></td>
                                                        <td><a href="buku.php" class="btn btn-sm btn-danger col-sm-7 float-right"><i class="fa fa-sign-out-alt"> </i></a></td>
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
                                        <h5 class="modal-title " id="ubahModal">Edit Data Buku</h5>
                                    </div>
                                    <div class="modal-body" id="ubah">
                                        <form action="fungsi/proses_edit.php" method="POST" role="form" enctype="multipart/form-data">

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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" value="ubahDetail" name="ubahDetail">Ubah Detail Buku</button>
                                    </div>
                                        </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Ubah Cover-->
            <div class="modal fade" id="gantiCover" tabindex="-1" role="dialog" aria-labelledby="ubahModaltitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ubahModal">Ubah Sampul Buku</h5>
                                    </div>
                                    <div class="modal-body" id="ubahSampul">
                                        <form action="fungsi/proses_edit.php" method="POST" role="form" enctype="multipart/form-data">
                                        <?php
                                                    $sql = "SELECT * FROM list_buku WHERE id_buku=$id";
                                                    $query = mysqli_query($db, $sql);
                                                    
                                                    while($foto = mysqli_fetch_array($query)){
                                                    ?>
                                        <input type="hidden" name="id"  value="<?= $id ?>">
                                            <div class="form-group text-center">
                                                <img style="border:solid black 2px; box-shadow:2px 2px 2px rgba(0,0,0,0.8);" src="../img/cover/<?= $foto["foto"];?>" alt="" width="170px" height="250px">
                                                <br>
                                                <p class="text-sm text-gray-800">Sampul Buku <?= $foto["judul"] ?>.png</p>
                                            
                                            </div>
                                            <div class="form-group text-center">
                                                <input type="file" class="col-sm-6" name="foto" id="foto">
                                                <?php } ?>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" value="sampul" name="sampul">Ubah Sampul</button>
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
                        <!-- Modal Tambah-->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModaltitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahModal">Tambah Data Peminjaman</h5>
                                        
                                    </div>
                                    <div class="modal-body" id="edit">
                                        <form action="fungsi/proses_edit.php" method="POST" role="form">
                                            <input type="hidden" name="id_pinjam" id="id_pinjam">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="judul">Judul Buku</label>
                                                <input type="text" class="form-control col-sm-8" name="judul" id="judul" placeholder="Judul Buku yang Dipinjam">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="nama">Nama Peminjam</label>
                                                <input type="text" class="form-control col-sm-8" name="nama" id="nama" placeholder="Nama Peminjam">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="tgl_pinjam">Tanggal Pinjam</label>
                                                <input type="date" class="form-control col-sm-8" name="tgl_pinjam" id="tgl_pinjam" placeholder="Tanggal Pinjam">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="jumlah">Jumlah Buku</label>
                                                <input type="number" class="form-control col-sm-8" name="jumlah" id="jumlah" placeholder="Jumlah Buku yang Dipinjam">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" value="tambahkan" name="tambahKan">Pinjam Buku!!</button>
                                            </div>
                                        </form>
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

<script>
    $(document).on("click","#pinjamBuku", function() {
                let judul=$(this).data("judul");

                $("#edit #judul").val(judul);
            });
    $(document).on("click","#ubahSampul", function() {
                let id_buku=$(this).data("id_buku");
                let foto=$(this).data("foto");

                $("#id").val(id_buku);
                $("#ubahSampul #foto").val(foto);
            });
    $(document).on("click","#tmblUbah", function() {
                let id_buku=$(this).data("id_buku");
                let judul=$(this).data("judul");
                let pengarang=$(this).data("pengarang");
                let penerbit=$(this).data("penerbit");
                let thn=$(this).data("thn");
                let indeks=$(this).data("indeks");
                let lokasi=$(this).data("lokasi");
                let stok=$(this).data("stok");
                let foto=$(this).data("foto");

                $("#ubah #id_buku").val(id_buku);
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