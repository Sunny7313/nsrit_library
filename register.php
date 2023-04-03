<?php
session_start();
include('config.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/perpus2.png" rel="icon">
    <title>Perpustakaan | Daftar</title>
    <link href="bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="bootstrap/css/ruang-admin.min.css" rel="stylesheet">
    <style>
    .user {
        margin-top : -30px;
    } 
    body {
        background-image :url("img/Originals/perpus1.png") ;
        background-size : cover;
    }
    </style>
</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center user">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-lg my-5 ">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h6>
                                            <b>|</b>
                                            <img src="img/logo/perpus1.png" alt="" width="20px" height="27px">
                                            <b><i class="fa fa-pencil-alt" > </i> Perpustakaan |</b>
                                        </h6>
                                        <h1 class="h4 text-gray-900 mb-4">Ayo Mendaftar!!</h1>
                                    </div>
                                    <form class="user" action="fungsi/proses_regis.php" role="form" method="POST" enctype="multipart/form-data">
                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="foto">Nama Lengkap</label>
                                            <input type="text" class="form-control col-sm-9" id="nama" name="nama" placeholder="Nama Lengkap Anda">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="foto">Username</label>
                                            <input type="text" class="form-control col-sm-9" id="username" name="username" placeholder="Username Akun Anda">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="foto">Password</label>
                                            <input type="password" class="form-control col-sm-9" id="password" name="password" placeholder="Password Akun Anda">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="foto"></label>
                                            <input type="password" class="form-control col-sm-9" id="cpassword" name="cpassword" placeholder="Konfirmasi Password Akun Anda">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="foto">Foto Profil</label>
                                            <input type="file" class="col-sm-9" id="foto" name="foto">
                                        </div>
                                        <hr>

                                        <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />
                                        <hr>
                                       
                                    </form>
                                    <div class="text-center">
                                    <p class="text-center text-gray-900 mb-4">Anda Sudah Mendaftar? <a class="text-primary font-weight-bolder" href="index.php">Yuk Login!</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
    <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="bootstrap/js/ruang-admin.min.js"></script>
</body>

</html>