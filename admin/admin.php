<?php 
 session_start();
 include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
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
    <link href="../img/logo/library.png" rel="icon">
    <title>Library | Administrator</title>
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
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="../img/logo/library.png">
                </div>
                <div class="sidebar-brand-text mx-3">E-Library</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-school"></i>
                    <span>Main Menu</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="books.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Book Management</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="members.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Member Management</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="borrow.php">
                    <i class="fas fa-fw fa-cart-plus"></i>
                    <span>Borrowing Data</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fines.php">
                    <i class="fas fa-fw fa-money-check-alt"></i>
                    <span>Fine Processing</span></a>
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
                                <img class="img-profile rounded-circle" src="../img/photo/<?= $_SESSION['photo'];?>" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small" id="userName"><?php echo $_SESSION['name'];?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#profileModal" id="#modalCenter">
                                    <i class="fa fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                                </a>
                                <a class="dropdown-item" href="admin.php" >
                                    <i class="fa fa-user-alt fa-sm fa-fw mr-2 text-gray-400"></i> Admin Data
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
                                    <h4 class="m-0 font-weight-bold text-primary">Admin Management</h4>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush" id="dataTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Profile Photo</th>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Level</th>
                                                <th>Settings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = $db->query("SELECT * FROM user");
                                            while($admin = mysqli_fetch_assoc($query)) {
                                            ?>
                                            <tr>
                                                <td><img class="img-profile rounded-circle online" src="../img/photo/<?= $admin["photo"] ?>" alt="Photo <?= $admin["name"];?>" height="60px" width="80px"></td>
                                                <td><?= $admin["name"] ?></td>
                                                <td><?= $admin["username"] ?></td>
                                                <td><?= $admin["email"] ?></td>
                                                <td><?= $admin["phone"] ?></td>
                                                <td><?= $admin["level"] ?></td>
                                                <td><a href='#' class='btn btn-sm btn-success' id="editButton" data-toggle='modal' data-target='#editModal' data-name="<?= $admin['name'];?>" 
                                                data-username="<?= $admin['username'];?>" data-password="<?= $admin['password'];?>" data-email="<?= $admin['email'];?>" data-phone="<?= $admin['phone'];?>" 
                                                data-level="<?= $admin['level'];?>" data-photo="<?= $admin['photo'];?>" ><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-danger" href="functions/delete.php?name=<?= $admin["name"]?>" onClick="return confirm('Delete user data with name <?= $admin ['name']?>??')" ><i class="fa fa-trash"></i></a>
                                                </td>
                                            <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Edit Modal-->
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModal">Edit User Data</h5>
                                    </div>
                                    <div class="modal-body" id="edit">
                                        <form action="functions/process_edit.php" method="post" role="form" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="username">Username</label>
                                                <input type="text" class="form-control col-sm-8" name="username" id="username" placeholder="Username">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="name">Full Name</label>
                                                <input type="text" class="form-control col-sm-8" name="name" id="name" placeholder="Full Name">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="email">Email Address</label>
                                                <input type="text" class="form-control col-sm-8" name="email" id="email" placeholder="Email Address">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="phone">Phone Number</label>
                                                <input type="text" class="form-control col-sm-8" name="phone" id="phone" placeholder="Phone Number">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="level">Level</label>
                                                <input type="text" class="form-control col-sm-8" name="level" id="level" placeholder="User Level">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" value="editAdmin" name="editAdmin">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                         <!-- Profile Modal -->
                        <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="profileModalTitle">Hello, <?= $_SESSION['level']?> <span id="usName"><?php echo $_SESSION['name'];?>!!</span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <h6 class="text-center">
                                            <b>|</b>
                                            <img src="../img/logo/library1.png" alt="" width="20px" height="27px">
                                            <b><i class="fa fa-pencil-alt"> </i> Library Profile |</b>
                                        </h6>
                                        <h2 class="text-center"><img class="img-profile rounded-circle" src="../img/photo/<?= $_SESSION['photo'];?>" style="max-width: 175px; border: solid black 2px; "></h2>
                                        <h5 class="text-center text-secondary font-underline font-weight-bold"><?= $_SESSION['name'];?></h5>
                                        <p>Your Username: <?php echo $_SESSION['username'];?></p>
                                        <p>Your Email: <?php echo $_SESSION['email'];?></p>
                                        <p>Your Phone Number: <i class="fa fa-icon fa-phone text-success"></i> <?php echo $_SESSION['phone'];?></p>
                                        <p>Your Level: <i class="fa fa-icon fa-security text-warning"></i> <?php echo $_SESSION['level'];?></p>
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
                                        <h5 class="modal-title" id="exampleModalLabelLogout">Oops!!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to logout, <?php echo $_SESSION['name'];?>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                        <a href="../logout.php" class="btn btn-primary">Logout</a>
                                    </div>
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

        $(document).ready(function() {
            $('#dataTable').DataTable(); // ID From dataTable 
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });

        $(document).on("click","#editButton", function() {
            let name=$(this).data("name");
            let username=$(this).data("username");
            let password=$(this).data("password");
            let email=$(this).data("email");
            let phone=$(this).data("phone");
            let level=$(this).data("level");
            let photo=$(this).data("photo");

            $("#edit #name").val(name);
            $("#edit #username").val(username);
            $("#edit #password").val(password);
            $("#edit #email").val(email);
            $("#edit #phone").val(phone);
            $("#edit #level").val(level);
            $("#edit #photo").val(photo);
            });
    </script>
</body>

</html>