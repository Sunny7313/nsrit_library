<?php 
    session_start();
    include('../config.php');

    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
    }
    $user = $_SESSION['username'];
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
    <title>Library | Main</title>
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
                    <img src="../img/logo/library.png">
                </div>
                <div class="sidebar-brand-text mx-3">E-Library</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
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
            <div class="sidebar-heading">PAGES</div>
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
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#profileModal" >
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 align-items-center">Welcome to E-Library, <?php echo $_SESSION['name'];?>!</h1>
                    </div>

                    <div class="row mb-3">
                       
                        <!-- total borrowed books card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Borrowed Books</div>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <?php $sql=mysqli_query($db,"SELECT SUM(quantity) FROM borrow_list");
                                            while($stock = mysqli_fetch_array($sql)) {
                                                    echo  "".$stock['SUM(quantity)']." Books";
                                                ?>      
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Members Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Members</div>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <?php $sql=mysqli_query($db,"SELECT count(*) FROM member_list");
                                            while($stock = mysqli_fetch_array($sql)) {
                                                ?>
                                                <?= $stock['count(*)']?> Members
                                            </div>
                                            <?php }?>  
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Books Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
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

                        <!-- Late Return Books Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <?php
                                        $sql = "SELECT *,SUM(quantity) from borrow_list";
                                        $query =mysqli_query($db,$sql);
                                        while($late = mysqli_fetch_array($query)){
                                            $return_date = date_create($late['return_date']);
                                            $current_date = date_create(date('Y-m-d'));
                                            $overdue = date_diff($return_date, $current_date);
                                            if($current_date > $return_date){
                                        ?>
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Late Returns</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?= $late['SUM(quantity)'] ?> Books
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book-dead fa-2x text-danger"></i>
                                        </div>
                                        <?php } else{  
                                        ?>
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                No Late Returns
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check fa-2x text-success"></i>
                                        </div>                                        
                                        <?php }
                                        }  ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid" id="container-wrapper">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <?php 
                                    $query = $db->query("SELECT * FROM college_data");
                                    while($data = mysqli_fetch_assoc($query)) {
                                        ?>
                                <h1 class="h3 mb-0 text-gray-800">School Data</h1>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 mb-4">
                                    <div class="card">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h5 class="font-weight-bolder">Logo <?= $data['college_name']?></h5>
                                        </div>
                                        <div class="card-body py-3 d-flex flex-row align-items-center justify-content-between">
                                            <img src="../img/logo/<?= $data['logo']?>" alt="Logo <?= $data['college_name']?>" width="230px" height="200px" >
                                        </div> 
                                        <img src="../img/logo/bgcard.png" alt="" srcset="" width="auto" height="170px">
                                    </div>
                                </div>      
                                <div class="col-lg-9 mb-4">
                                    <!-- Simple Tables -->
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">
                                                <tbody>
                                                    <tr>
                                                        <th>School Name</th>
                                                        <td><?= $data['college_name'];?></td> 
                                                    </tr>
                                                    <tr>
                                                        <th>NPSN</th>
                                                        <td><?= $data['npsn'];?></td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td><?= $data['status'];?></td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Accreditation</th>
                                                        <td><?= $data['accreditation'];?></td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Education Type</th>
                                                        <td><?= $data['education_type'];?></td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Ownership Status</th>
                                                        <td><?= $data['ownership_status'];?></td> 
                                                    </tr>
                                                    <tr>
                                                        <th>School Establishment Decree</th>
                                                        <td><?= $data['establishment_decree'];?></td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Establishment Decree Date</th>
                                                        <td><?= $data['decree_date'];?></td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Operational Permit Decree</th>
                                                        <td><?= $data['operational_permit'];?></td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Operational Permit Date</th>
                                                        <td><?= $data['permit_date'];?></td> 
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <?php ;} ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Row-->
                        <!-- Modal Profile -->
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
                                        <h5 class="modal-title" id="exampleModalLabelLogout"><b>|</b> Oops!! <i class="fas fa-sign-out-alt fa-sm fa-fw text-danger"></i><b>|</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to Logout, <?php echo $_SESSION['name'];?> ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                        <a href="../logout.php" class="btn btn-outline-danger">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModal">Edit School Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="modal-body" id="edit">
                                    <form action="functions/process_edit.php" method="POST" role="form" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                <label class=" col-form-label" for="college_name">School Name</label>
                                                <input type="text" class="form-control" name="college_name" id="college_name" placeholder="Full School Name">
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label" for="npsn">School NPSN</label>
                                                <input type="text" class="form-control" name="npsn" id="npsn" placeholder="School NPSN" >
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label" for="status">School Status</label>
                                                <input type="text" class="form-control" name="status" id="status" placeholder="School Status">
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label" for="accreditation">School Accreditation</label>
                                                <input type="text" class="form-control" name="accreditation" id="accreditation" placeholder="Current School Accreditation" >
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label" for="education_type">Education Type</label>
                                                <input type="text" class="form-control" name="education_type" id="education_type" placeholder="Current Education Type">
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label" for="ownership_status">Ownership Status</label>
                                                <input type="text" class="form-control" name="ownership_status" id="ownership_status" placeholder="School Ownership Status">
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label" for="establishment_decree">School Establishment Decree</label>
                                                <input type="text" class="form-control" name="establishment_decree" id="establishment_decree" placeholder="School Establishment Decree">
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label" for="decree_date">Establishment Decree Date</label>
                                                <input type="text" class="form-control" name="decree_date" id="decree_date" placeholder="Establishment Decree Date">
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label" for="operational_permit">Operational Permit Decree</label>
                                                <input type="text" class="form-control" name="operational_permit" id="operational_permit" placeholder="School Operational Permit Decree">
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label" for="permit_date">Operational Permit Date</label>
                                                <input type="text" class="form-control" name="permit_date" id="permit_date" placeholder="Operational Permit Date">
                                            </div>
                                            <div class="form-group">
                                                <label class=" col-form-label" for="photo">School Logo</label>
                                                <input type="file" class="form-control" name="photo" id="photo">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" value="editSchool" name="editSchool">Edit Data</button>
                                    </div>
                                        </form>
                                </div>
                            </div>
                        </div>  

                    </div>
                    </div>
                    <!---Container Fluid-->
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
        <script src="../bootstrap/vendor/chart.js/Chart.min.js"></script>
        <script src="../bootstrap/js/demo/chart-area-demo.js"></script>
        <script>
         $(document).on("click","#editData", function() {
                let id=$(this).data("id");

                $("#id").val(id);
            });
        </script>
</body>

</html>