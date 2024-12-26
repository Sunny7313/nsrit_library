<?php
 session_start();
 include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

// if there is no id in the query string
if( !isset($_GET['borrow_id']) ){
    //header('Location: borrow_detail.php');
}

// get id from query string
$id = $_GET['borrow_id'];

// create query to get data from database
$sql = "SELECT * FROM borrow_list WHERE borrow_id=$id";
$query = mysqli_query($db, $sql);
$student = mysqli_fetch_assoc($query);

// if the data to be edited is not found
if( mysqli_num_rows($query) < 1 ){
    die("data not found...");
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
    <title>Library | Borrow Detail</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="borrow.php">
                    <i class="fas fa-fw fa-cart-plus"></i>
                    <span>Borrow Data</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"href="fines.php">
                    <i class="fas fa-fw fa-money-check-alt"></i>
                    <span>Fine Process</span></a>
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
                    <div class="row mb-3">
                        <!-- Datatables -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h4 class="m-0 font-weight-bold text-primary">Borrow Details</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                    <?php
                                        $sql= "SELECT borrow_list.borrow_id, borrow_list.borrow_date, borrow_list.return_date, borrow_list.quantity, book_list.book_id, book_list.title, book_list.photo, book_list.author, member_list.member_id, member_list.name, member_list.class, member_list.major_name from borrow_list inner join book_list on borrow_list.title=book_list.title INNER JOIN member_list on borrow_list.name=member_list.name WHERE borrow_id=$id";
                                        $query=mysqli_query($db,$sql);
  
                                        while($borrow = mysqli_fetch_array($query)){
                                            // to calculate the late days
                                            $return_date = date_create($borrow['return_date']);
                                            $current_date = date_create(date('Y-m-d'));
                                            $late = date_diff($return_date, $current_date);
                                            $days = $late->format("%a");

                                            // calculate fine
                                            $fine = $days * 5000;
                                            ?>
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <img src="../img/cover/<?= $borrow["photo"]; ?>" width="275" height="395" class="m-auto">
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th>Book ID</th>
                                                        <td><?= $borrow['book_id']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Book Title</th>
                                                        <td><?= $borrow['title']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Book Author</th>
                                                        <td><?= $borrow['author']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Member ID</th>
                                                        <td><?= $borrow['member_id']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Borrower Name</th>
                                                        <td><?= $borrow['name']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Class and Major</th>
                                                        <td><?= $borrow['class']?> <?= $borrow['major_name']?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Number of Books Borrowed</th>
                                                        <td><?= $borrow['quantity']?></td>
                                                    </tr>
                                                    <tr>
                                                    <?php 
                                                     if ($current_date > $return_date) {
                                                        echo "<th>Fine Amount</th>";
                                                        echo "<td class=' text-danger font-weight-bold'>Rp.".$fine." (".$days." Days Late)</td>";
                                                     } else {
                                                        $return_date = date_create($borrow['return_date']);
                                                        $current_date = date_create(date('y-m-d'));
                                                        $grace_period = date_diff($return_date, $current_date);
                                                        $days = $grace_period->format("%a");

                                                         if($days > 2){
                                                            echo "<th class='bg-secondary text-white'>Grace Period ".$borrow['name']."</th>
                                                            <td class='text-success font-weight-bold '>".$days." Days</td>";
                                                         } else {
                                                            echo "<th class='bg-secondary text-white'>Grace Period ".$borrow['name']."</th>
                                                            <td class='text-danger font-weight-bolder'>".$days." Days</td>";
                                                         }
                                                     }
                                                    ?>
                                                    </tr>
                                                    <tr>
                                                    <td><a href='#' class='btn btn-sm btn-success col-sm-8 float-right' id="editButton" data-toggle='modal'  data-target='#editModal' 
                                                    data-id="<?= $borrow['borrow_id'];?>" data-title="<?= $borrow['title'];?>"
                                                    data-name="<?= $borrow['name'];?>" data-borrow_date="<?= $borrow['borrow_date'];?>" data-return_date="<?= $borrow['return_date'];?>" ><i class="fa fa-edit"></i> Edit Details</a></td>
                                                    <td><a class="btn btn-sm btn-warning " href="functions/delete.php?borrow_id=<?= $borrow['borrow_id']?>" onClick="return confirm('Return Book <?= $borrow["title"];?> Borrowed by <?= $borrow["name"];?>??')"> <i class="fa fa-book-open"></i> Return Book</a></td>
                                                        <td><a href="borrow.php" class="btn btn-sm btn-danger col-sm-8 float-right"><i class="fa fa-sign-out-alt"> </i></a></td>
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
                    <!-- Modal Edit-->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalTitle">Edit Borrowing Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </div>
                                <div class="modal-body" id="edit">
                                    <form action="functions/process_edit.php" method="post" role="form">
                                        <input type="hidden" name="borrow_id" id="borrow_id">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="title">Book Title</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Borrowed Book Title">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="name">Borrower Name</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Borrower Name">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="borrow_date">Borrow Date</label>
                                            <input type="date" class="form-control" name="borrow_date" id="borrow_date" placeholder="Borrow Date">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="return_date">Return Date</label>
                                            <input type="date" class="form-control" name="return_date" id="return_date" placeholder="Return Date">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" value="editData" name="editData">Save Changes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Profile -->
                    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="profileModalTitle">Hello, <?= $_SESSION['level']?> <span id="userName"><?php echo $_SESSION['name'];?>!!</span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body text-center">
                                    <h6 class="text-center">
                                        <b>|</b>
                                        <img src="../img/logo/library.png" alt="" width="20px" height="27px">
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
$(document).on("click","#editButton", function() {
                            let borrow_id=$(this).data("id");
                            let title=$(this).data("title");
                            let name=$(this).data("name");
                            let borrow_date=$(this).data("borrow_date");
                            let return_date=$(this).data("return_date");

                            $("#borrow_id").val(borrow_id);
                            $("#edit #title").val(title);
                            $("#edit #name").val(name);
                            $("#edit #borrow_date").val(borrow_date);
                            $("#edit #return_date").val(return_date);
                    });
</script>
</body>

</html>