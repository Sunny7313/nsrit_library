<?php 
 session_start();
 include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: member.php");
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
    <title>Perpustakaan | Anggota</title>
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
                                    <h4 class="m-0 font-weight-bold text-primary col-md-7">Pengelola Member</h4>
                                    <div class="d-flex flex-row-reverse align-items-center col-md-2"><a href='#' class='btn btn-sm btn-primary col-md-12 p-2' data-toggle='modal' data-target='#tambahModal'><i class="fa fa-male"></i>    Tambah Member</a></div>
                                </div>
                                <div class="table-responsive p-3">
                                    
                                    <table class="table align-items-center table-flush" id="dataTable">
                                    <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>NISN</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tempat/Tanggal Lahir</th>
                                                <th>Alamat</th>
                                                <th>Kelas & Jurusan</th>
                                                <th>Pengaturan</th>
                                            </tr>
                                        </thead>
                                            <tbody>

                                                <?php
                                                        $query = $db->query("SELECT * FROM list_member");
                                                        $i=1;
                                                        while($member = mysqli_fetch_assoc($query)) {
                                                    ?>

                                                    <tr>
                                                    <td><a href="detail_member.php?id_member=<?= $i ?>"><?= $member["id_member"] ?></a></td>
                                                    <td><?= $member["nama"] ?></td>
                                                    <td><?= $member["nis"] ?></td>
                                                    <td><?= $member["jenis_kelamin"] ?></td>
                                                    <td><?= $member["tmpt_lahir"] ?> <br> <?= $member["tgl_lahir"] ?></td>
                                                    <td><?= $member["alamat"] ?></td>
                                                    <td><?= $member["kelas"] ?> | <?= $member["nama_jurusan"] ?></td>

                                                    <td><a href='#' class='btn btn-sm  btn-success' id="tmblUbah" data-toggle='modal'  data-target='#ubahModal' 
                                                    data-id="<?= $member['id_member'];?>" data-nama="<?= $member['nama'];?>" 
                                                    data-nis="<?= $member['nis'];?>" data-jk="<?= $jk = $member['jenis_kelamin'];?>" data-tmpt="<?= $member['tmpt_lahir'];?>" 
                                                    data-tgl="<?= $member['tgl_lahir'];?>" data-alamat="<?= $member['alamat'];?>" data-kelas="<?= $member['kelas'];?>" 
                                                    data-jurusan="<?= $member['nama_jurusan'];?>"><i class="fa fa-edit"></i></a>&nbsp;
                                                   
                                                    <a class="btn btn-sm btn-primary" value="detail" name="detail" href="detail_member.php?id_member=<?= $member['id_member'] ?>" ><i class='fa fa-eye'></i></a></td>
                                                   
                                                   <?php $i++; } ?>
                                                    </tr>
                                                </tbody>
                                    </table>

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
                                            <label><input type="radio" name="jenis_kelamin" id="jk" value="Laki-Laki" <?= ($jk == 'Laki_Laki') ? "checked": "" ?>> Laki Laki</label>
                                            <label><input type="radio" name="jenis_kelamin" id="jk" value="Perempuan" <?= ($jk == 'Perempuan ') ? "checked": "" ?>> Perempuan</label>
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
                                                <label class="col-sm-4 col-form-label" for="alamat">Alamat Rumah</label>
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
                        
                                            <!-- Modal Tambah -->
                    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahModal">Tambah Member</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="modal-body" id="tambah">
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
                                            <label  class="col-sm-4 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                            <label><input type="radio" name="jenis_kelamin" value="Laki-Laki"> Laki-laki</label>
                                            <label><input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan</label>
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
                                        <button type="submit" class="btn btn-primary" value="daftar" name="daftar">Tambah Member</button>
                                    </div>
                                        </form>
                                </div>
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


    <!-- Modal import -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="importModal">Import Data Sekolah</h5>
                                    </div>
                                    <div class="modal-body">
                                    <div class="modal-body text-center" id="import">
                                        <form action="fungsi/excel.php" method="POST" role="form" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-form-label text-success font-weight-bold" for="dataExcel">Import Data Member Dari Excel Anda</label>
                                                <label class="form-label text-danger font-weight-bolder" for="dataExcel">(Data Excel Harus berekstensi .xls!!)</label>
                                                <input type="file" class="btn btn-primary" name="dataExcel" id="dataExcel">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-primary" value="upload" name="upload">Import Data</button>
                                    </div>
                                        </form>
                                </div>
                            </div>
                        </div>

                
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
        function bgHijau(elem){
            elem.className="bg"
        }

        $(document).ready(function(){  
        $('#dataTable').DataTable();  
        });  


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
                $("#edit #jk").val(jk);
                $("#edit #tmpt_lahir").val(tmpt);
                $("#edit #tgl_lahir").val(tgl);
                $("#edit #alamat").val(alamat);
                $("#edit #kelas").val(kelas);
                $("#edit #nama_jurusan").val(jurusan);
            });
    </script>
</body>

</html>