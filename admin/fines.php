<?php 
 session_start();
 include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: fines.php");
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
    <title>Library | Fines</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="fines.php">
                    <i class="fas fa-fw fa-money-check-alt"></i>
                    <span>Fines Process</span></a>
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
                                    <i class="fa fa-user
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
                                                    <h4 class="m-0 font-weight-bold text-primary">Fine Management</h4>
                                                </div>
                                                <div class="card-body py-3 d-flex flex-row align-items-center justify-content-between">
                                                     <!-- Daily Fine Notification -->
                                                        <div class="col-xl-4 col-md-6 mb-4">
                                                            <div class="card h-100">
                                                                <div class="card-body">
                                                                    <div class="row align-items-center">
                                                                        <div class="col mr-2">
                                                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Fine Amount</div>
                                                                            <div class="h6 mb-0 font-weight-bold text-gray-800">$5/Day</div>
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
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Borrowing Deadline</div>
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">7 Days</div>
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
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Books</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php $sql=mysqli_query($db,"SELECT SUM(stock) FROM book_list");
                                                            while($stock = mysqli_fetch_array($sql)) {
                                                                ?>
                                                                <?= $stock['SUM(stock)']?> Books
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
                                                    <th>Borrow ID</th>
                                                    <th>Borrower Name</th>
                                                    <th>Borrowed Book</th>
                                                    <th>Borrow Date</th>
                                                    <th>Return Date</th>
                                                    <th>Late (Days)</th>
                                                    <th>Total Fine</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <?php
                                            // only display overdue data
                                            $sql = $db->query("SELECT borrow_list.borrow_id,borrow_list.borrow_date,borrow_list.return_date,book_list.book_id,book_list.title,member_list.member_id,member_list.name,member_list.class,member_list.major_name 
                                            from borrow_list inner join book_list on borrow_list.title=book_list.title INNER JOIN member_list on borrow_list.name=member_list.name WHERE CURDATE() > return_date");
                                            while($borrow = $sql->fetch_assoc()) {
                                                // to calculate the number of overdue days
                                                $return = date_create($borrow['return_date']);
                                                $now = date_create(date('Y-m-d'));
                                                $late = date_diff($return, $now);
                                                $days = $late->format("%a");
                                                // calculate fine
                                                $fine = $days * 5;
                                            ?>
                                            <tr>
                                                <?="<td><a value='detail' name='detail' href='borrow_detail.php?borrow_id=".$borrow['borrow_id']."' > "?><?= $borrow['borrow_id']?></a></td>
                                                <td><?= $borrow["name"]?></td>
                                                <td><?= $borrow["title"]?></td>
                                                <td><?= $borrow['borrow_date'] ?></td>
                                                <td><?= $borrow['return_date'] ?></td>
                                                <td><?= $days ?> Days</td>
                                                <td class="text-danger font-weight-bold">$<?= $fine?></td>
                                                <td><a class="btn btn-sm btn-warning " href="functions/delete.php?borrow_id=<?= $borrow['borrow_id']?>" onClick="return confirm('Return Book <?= $borrow["title"];?> On Behalf Of <?= $borrow["name"];?>??')"> <i class="fa fa-book-open"></i></a></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                                </table>
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
                                                    <div class="modal-body  text-center">
                                                        <h6 class="text-center">
                                                            <b>|</b>
                                                            <img src="../img/logo/library.png" alt="" width="20px" height="27px">
                                                            <b><i class="fa fa-pencil-alt" > </i> Library Profile |</b>
                                                        </h6>
                                                        <h2 class="text-center"><img class="img-profile rounded-circle" src="../img/photo/<?= $_SESSION['photo'];?>" style="max-width: 175px; border: solid black 2px; "></h2>
                                                        <h5 class="text-center text-secondary font-underline font-weight-bold"><?= $_SESSION['name'];?></h5>
                                                        <p>Your Username : <?php echo $_SESSION['username'];?></p>
                                                        <p>Your Email : <?php echo $_SESSION['email'];?></p>
                                                        <p>Your Phone Number : <i class="fa fa-icon fa-phone text-success"></i> <?php echo $_SESSION['phone'];?></p>
                                                        <p>Your Level : <i class="fa fa-icon fa-security text-warning"></i> <?php echo $_SESSION['level'];?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">OK!</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Logout Modal -->
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
                                                        <p>Are you sure you want to Logout, <?php echo $_SESSION['name'];?> ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                                        <a href="../logout.php" class="btn btn-primary">Logout</a>
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


    </script>
</body>

</html>