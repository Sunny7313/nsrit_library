<?php
session_start();
include_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Library Management System Login Page">
    <meta name="author" content="YourName">
    <link href="img/logo/library2.png" rel="icon">
    <title>Library | Login</title>
    <link href="bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="bootstrap/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <style>
        .user {
            margin-top: 40px;
        }
        body {
            background-image: url("img/Originals/library1.png");
            background-size: cover;
        }
    </style>
</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center user">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h6>
                                            <b>|</b>
                                            <img src="img/logo/library1.png" alt="Library Logo" width="20px" height="27px">
                                            <b><i class="fa fa-pencil-alt"></i> Library |</b>
                                        </h6>
                                        <h6 class="h4 text-gray-900 mb-4">Please Login First!</h6>
                                    </div>
                                    <form class="user" action="./functions/validate.php" method="POST" role="form">
                                        <input type="hidden" name="csrf_token" value="<?php echo bin2hex(random_bytes(32)); ?>">
                                        <hr>
                                        <div class="form-group">
                                            <label for="username" class="sr-only">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" required placeholder="Your Username">
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="sr-only">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" required placeholder="Password" autocomplete="off">
                                        </div>
                                        <hr>
                                        <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <p class="text-gray-900 mb-4">Don't have an account? 
                                            <a class="text-success font-weight-bolder" href="register.php">Register Now!</a>
                                        </p>
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
