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
    <link href="../img/logo/library.png" rel="icon">
    <title>Library | Members</title>
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
            <li class="nav-item active">
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
                                <img class="img-profile rounded-circle" src="../img/photos/<?= $_SESSION['photo'];?>" style="max-width: 60px">

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
                                    <h4 class="m-0 font-weight-bold text-primary col-md-7">Member Management</h4>
                                    <div class="d-flex flex-row-reverse align-items-center col-md-3"><a href='#' class='btn btn-sm btn-success col-md-9 p-2' data-toggle='modal' data-target='#importModal'><i class="fa fa-file"></i>  Import Member Data</a></div>
                                    <div class="d-flex flex-row-reverse align-items-center col-md-2"><a href='#' class='btn btn-sm btn-primary col-md-12 p-2' data-toggle='modal' data-target='#addModal'><i class="fa fa-male"></i>    Add Member</a></div>
                                </div>
                                <div class="table-responsive p-3">
                                    
                                    <table class="table align-items-center table-flush" id="dataTable">
                                    <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>NISN</th>
                                                <th>Gender</th>
                                                <th>Place/Date of Birth</th>
                                                <th>Address</th>
                                                <th>Class & Major</th>
                                                <th>Settings</th>
                                            </tr>
                                        </thead>
                                            <tbody>

                                                <?php
                                                        $query = $db->query("SELECT * FROM member_list");
                                                        $i=1;
                                                        while($member = mysqli_fetch_assoc($query)) {
                                                    ?>

                                                    <tr>
                                                    <td><a href="member_detail.php?id_member=<?= $i ?>"><?= $member["member_id"] ?></a></td>
                                                    <td><?= $member["name"] ?></td>
                                                    <td><?= $member["nis"] ?></td>
                                                    <td><?= $member["gender"] ?></td>
                                                    <td><?= $member["birth_place"] ?> <br> <?= $member["birth_date"] ?></td>
                                                    <td><?= $member["address"] ?></td>
                                                    <td><?= $member["class"] ?> | <?= $member["major_name"] ?></td>

                                                    <td><a href='#' class='btn btn-sm  btn-success' id="editButton" data-toggle='modal'  data-target='#editModal' 
                                                    data-id="<?= $member['member_id'];?>" data-name="<?= $member['name'];?>" 
                                                    data-nis="<?= $member['nis'];?>" data-gender="<?= $gender = $member['gender'];?>" data-birth_place="<?= $member['birth_place'];?>" 
                                                    data-birth_date="<?= $member['birth_date'];?>" data-address="<?= $member['address'];?>" data-class="<?= $member['class'];?>" 
                                                    data-major="<?= $member['major_name'];?>"><i class="fa fa-edit"></i></a>&nbsp;
                                                   
                                                    <a class="btn btn-sm btn-primary" value="detail" name="detail" href="member_detail.php?id_member=<?= $member['member_id'] ?>" ><i class='fa fa-eye'></i></a></td>
                                                   
                                                   <?php $i++; } ?>
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
                                        <h5 class="modal-title" id="editModal">Edit Member Data</h5>
                                        
                                    </div>
                                    <div class="modal-body" id="edit">
                                        <form action="functions/process_edit.php" method="post" role="form">
                                        <input type="hidden" name="id_member" id="id_member" >
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="name">Full Name</label>
                                                <input type="text" class="form-control col-sm-8" name="name" id="name" placeholder="Full Name">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="nis">NISN</label>
                                                <input type="text" class="form-control col-sm-8" name="nis" id="nis" placeholder="NISN" >
                                            </div>
                                            <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="gender">Gender  </label>
                                            <label><input type="radio" name="gender" id="gender" value="Male" <?= ($gender == 'Male') ? "checked": "" ?>> Male</label>
                                            <label><input type="radio" name="gender" id="gender" value="Female" <?= ($gender == 'Female') ? "checked": "" ?>> Female</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="birth_place">Place of Birth</label>
                                                <input type="text" class="form-control col-sm-8" name="birth_place" id="birth_place" placeholder="City/County Name">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="birth_date">Date of Birth</label>
                                                <input type="text" class="form-control col-sm-8" name="birth_date" id="birth_date" placeholder="1999-06-14" >
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="address">Home Address</label>
                                                <input type="text" class="form-control col-sm-8" name="address" id="address" placeholder="Home Address">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="class">Class</label>
                                                <input type="text" class="form-control col-sm-8" name="class" id="class" placeholder="Class">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="major_name">Major</label>
                                                <input type="text" class="form-control col-sm-8" name="major_name" id="major_name" placeholder="Major Name">
                                            </div>
                                         
                                       
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" value="Edit" name="edit">Save Changes</button>
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
                                            <img src="../img/logo/library.png" alt="" width="20px" height="27px">
                                            <b><i class="fa fa-pencil-alt"> </i> Library Profile |</b>
                                        </h6>
                                        <h2 class="text-center"><img class="img-profile rounded-circle" src="../img/photos/<?= $_SESSION['photo'];?>" style="max-width: 175px; border: solid black 2px;"></h2>
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

                        <!-- Add Modal -->
                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalTitle">Add Member</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="functions/process_add.php" method="post" role="form">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="name">Full Name</label>
                                                <input type="text" class="form-control col-sm-8" name="name" id="name" placeholder="Full Name">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="nis">NISN</label>
                                                <input type="text" class="form-control col-sm-8" name="nis" id="nis" placeholder="NISN">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="gender">Gender</label>
                                                <label><input type="radio" name="gender" value="Male"> Male</label>
                                                <label><input type="radio" name="gender" value="Female"> Female</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="birth_place">Place of Birth</label>
                                                <input type="text" class="form-control col-sm-8" name="birth_place" id="birth_place" placeholder="City/County Name">
                                            </div>
                                            <div class="form-group row"></div>
                                                <label class="col-sm-4 col-form-label" for="birth_date">Date of Birth</label>
                                                <input type="text" class="form-control col-sm-8" name="birth_date" id="birth_date" placeholder="1999-06-14">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="address">Home Address</label>
                                                <input type="text" class="form-control col-sm-8" name="address" id="address" placeholder="Home Address">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="class">Class</label>
                                                <input type="text" class="form-control col-sm-8" name="class" id="class" placeholder="Class">
                                            </div>
                                            <div class="form-group row"></div>
                                                <label class="col-sm-4 col-form-label" for="major_name">Major</label>
                                                <input type="text" class="form-control col-sm-8" name="major_name" id="major_name" placeholder="Major Name">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" value="add" name="add">Add Member</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Logout Modal -->
                        <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logoutModalTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="logoutModalTitle">Oops!!</h5>
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

                        <!-- Import Modal -->
                        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="importModalTitle">Import School Data</h5>
                                    </div>
                                    <div class="modal-body text-center">
                                        <form action="functions/excel.php" method="POST" role="form" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-form-label text-success font-weight-bold" for="dataExcel">Import Member Data From Your Excel</label>
                                                <label class="form-label text-danger font-weight-bolder" for="dataExcel">(Excel Data Must Have .xls Extension!!)</label>
                                                <input type="file" class="btn btn-primary" name="dataExcel" id="dataExcel">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
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
        function bgGreen(elem){
            elem.className="bg"
        }

        $(document).ready(function(){  
        $('#dataTable').DataTable();  
        });  


        $(document).on("click","#editButton", function() {
            let id=$(this).data("id");
            let name=$(this).data("name");
            let nis=$(this).data("nis");
            let gender=$(this).data("gender");
            let birth_place=$(this).data("birth_place");
            let birth_date=$(this).data("birth_date");
            let address=$(this).data("address");
            let class=$(this).data("class");
            let major=$(this).data("major");

            $("#id_member").val(id);
            $("#edit #name").val(name);
            $("#edit #nis").val(nis);
            $("#edit #gender").val(gender);
            $("#edit #birth_place").val(birth_place);
            $("#edit #birth_date").val(birth_date);
            $("#edit #address").val(address);
            $("#edit #class").val(class);
            $("#edit #major_name").val(major);
            });
    </script>
</body>

</html>