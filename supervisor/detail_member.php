<?php
 session_start();
 include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

// kalau tidak ada id di query string
if( !isset($_GET['id_member']) ){
    header('Location: detail_member.php');
}

//ambil id dari query string
$id = $_GET['id_member'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM list_member WHERE id_member=$id";
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
            <li class="nav-item active">
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
                    <div class="row mb-3">
                    <div class="col-lg-12">
                    <div class="card-mb-3">
                    <div class="card-header font-weight-bold text-center text-white align-items-center justify-content-between bg-primary">
                    <img src='../img/logo/fatahillah.png' width='60' height='60' class='m-auto float-left' alt='Foto Member <?=$member['nama']?>'>
                    <h4 >E-PERPUSTAKAAN </h4>
                    <h6>SMK FATAHILLAH</h6>
                    <hr class="btn-warning">
                    </div>
                    </div>
                    </div>
                        <!-- Datatables -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                            <div class="card-header align-items-center justify-content-between">
                                <h6 class="m-0 text-center font-weight-bold text-primary">KARTU MEMBER E-PERPUSTAKAAN</h6>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                    <?php
                                        $sql= "SELECT * FROM list_member WHERE id_member=$id";
                                        $query=mysqli_query($db,$sql);
  
                                        while($member = mysqli_fetch_array($query)){
                                            ?>
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <img src='../img/cover/noimage.png' width='275' height='360' class='m-auto' alt='Cover member <?=$member['judul']?>'>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                            <tr>
                                            <th>ID member</th>
                                            <td><?= $member['id_member']?></td>
                                            </tr>
                                                    <tr>
                                                        <th>Nama Lengkap</th>
                                                        <td id="nama"><?= $member['nama']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jenis Kelamin</th>
                                                        <td><?= $member['jenis_kelamin']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th> NIS Member</th>
                                                        <td><?= $member['nis']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tempat/Tanggal Lahir</th>
                                                        <td><?= $member['tmpt_lahir']?>/ <?= $member['tgl_lahir'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Alamat Rumah</th>
                                                        <td><?= $member['alamat']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Kelas</th>
                                                        <td><?= $member['kelas']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Nama Jurusan</th>
                                                        <td><?= $member['nama_jurusan']?></td>
                                                    </tr>
                                                    <tr>
                                                    <td><a href='#' class='btn btn-sm float-right btn-success' id="tmblUbah" data-toggle='modal'  data-target='#ubahModal' 
                                                    data-id="<?= $member['id_member'];?> " data-nama="<?= $member['nama'];?> " 
                                                    data-nis="<?= $member['nis'];?> " data-jk="<?= $member['jenis_kelamin'];?> " data-tmpt="<?= $member['tmpt_lahir'];?> " 
                                                    data-tgl="<?= $member['tgl_lahir'];?>" data-alamat="<?= $member['alamat'];?> " data-kelas="<?= $member['kelas'];?> " 
                                                    data-jurusan="<?= $member['nama_jurusan'];?> " ><i class="fa fa-edit"></i> Edit Detail</a></td>
                                                    <td><a class="btn btn-sm  btn-danger  col-sm-4" href="fungsi/hapus.php?id_member=<?= $buku['id_member']?>" onClick="return confirm('Hapus Data Member Bernama <?= $member["nama"];?>??')" ><i class="fa fa-trash"></i> Hapus</a></td>
                                                        <td><a href="member.php" class="btn btn-sm btn-danger col-sm-7 float-right"><i class="fa fa-sign-out-alt"> </i></a></td>
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
                                        
                                    </div>
                                    <div class="modal-body" id="edit">
                                        <form action="fungsi/proses_edit.php" method="post" role="form">
                                        <input type="hidden" name="id_member" id="id_member" >
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="nama">Nama Lengkap</label>
                                                <input type="text" class="form-control col-sm-8" name="nama" id="nama" placeholder="Nama Lengkap">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="klsMem">NISN</label>
                                                <input type="text" class="form-control col-sm-8" name="nis" id="nis" placeholder="NISN" >
                                            </div>
                                            <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="jenis_kelamin">Jenis Kelamin  </label>
                                            <?php $jk = $siswa['jenis_kelamin']; ?>
                                            <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki" <?= ($jk == 'Laki_Laki') ? "checked": "" ?>> Laki Laki</label>
                                            <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan" <?= ($jk == 'Perempuan') ? "checked": "" ?>> Perempuan</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="tmpt_lahir">Tempat Lahir</label>
                                                <input type="text" class="form-control col-sm-8" name="tmpt_lahir" id="tmpt_lahir" placeholder="Nama Kota/Kabupaten">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="tgl_lahir">Tanggal Lahir</label>
                                                <input type="text" class="form-control col-sm-8" name="tgl_lahir" id="tgl_lahir" placeholder="1999-06-14" >
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="almtMem">Alamat Rumah</label>
                                                <input type="text" class="form-control col-sm-8" name="alamat" id="alamat" placeholder="Alamat Rumah">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="kelas">Kelas</label>
                                                <input type="text" class="form-control col-sm-8" name="kelas" id="kelas" placeholder="Kelas">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="nama_jurusan">Jurusan</label>
                                                <input type="text" class="form-control col-sm-8" name="nama_jurusan" id="nama_jurusan" placeholder="Nama Jurusan">
                                            </div>
                                         
                                       
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" value="Edit" name="edit">Simpan Perubahan</button>
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
  $(document).on("click","#tmblUbah", function() {
                let id=$(this).data("id");
                let nama=$(this).data("nama");
                let nis=$(this).data("nis");
                let jk=$(this).data("jk");
                let tmpt=$(this).data("tmpt");
                let tgl=$(this).data("tgl");
                let alamat=$(this).data("alamat");
                let kelas=$(this).data("kelas");
                let jurusan=$(this).data("jurusan");

                $("#id_member").val(id);
                $("#edit #nama").val(nama);
                $("#edit #nis").val(nis);
                $("#edit #jenis_kelamin").val(jk);
                $("#edit #tmpt_lahir").val(tmpt);
                $("#edit #tgl_lahir").val(tgl);
                $("#edit #alamat").val(alamat);
                $("#edit #kelas").val(kelas);
                $("#edit #nama_jurusan").val(jurusan);
            });
</script>
</body>

</html>