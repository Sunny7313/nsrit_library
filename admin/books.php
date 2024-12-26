<?php 
 session_start();
 include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: books.php");
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
    <title>Library | Books</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="books.php"></a>
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
                <a class="nav-link"href="fines.php">
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
                                    <h4 class="m-0 font-weight-bold text-primary">Book Management</h4>
                                    <div class="d-flex flex-row-reverse align-items-center "><a href='#' class='btn btn-sm btn-primary col-md-12 p-2' data-toggle='modal' data-target='#addModal'><i class="fa fa-book"></i>  Add Book</a></div>
                                </div>

                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush" id="dataTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Book ID</th>
                                                <th>Title</th>
                                                <th>Author</th>
                                                <th>Publisher</th>
                                                <th>Stock</th>
                                                <th>Info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = $db->query("SELECT * FROM book_list");
                                            $i=1;
                                            while($book = mysqli_fetch_assoc($query)) {
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $book['title']?></td>
                                                <td><?= $book['author']?></td>
                                                <td><?= $book['publisher']?></td>
                                                <td><?= $book['stock']?></td>
                                                <td>
                                                <a href='#?book_id=<?= $book['book_id'] ?>' class='btn btn-sm btn-success' id="editButton" data-toggle='modal'  data-target='#editModal' 
                                                data-book_id="<?= $book['book_id'];?> " data-title="<?= $book['title'];?> " 
                                                    data-author="<?= $book['author'];?> " data-publisher="<?= $book['publisher'];?> " data-year="<?= $book['publish_year'];?>" 
                                                    data-index="<?= $book['index'];?>" data-location="<?= $book['location'];?> " data-stock="<?= $book['stock'];?>" data-photo="<?= $book['photo'];?>" ><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-primary" value="detail" name="detail" href="detail.php?book_id=<?= $book['book_id'] ?> " ><i class='fa fa-eye'></i></a>
                                                </td>
                                            
                                            </tr>  
                                        <?php $i++;} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CREATE TRIGGER `returnBook` AFTER DELETE ON `borrow_list` FOR EACH ROW BEGIN UPDATE books SET stock=stock+1 WHERE book_id=OLD.book_id; END -->
                    <!-- CREATE TRIGGER `reduceStock` AFTER INSERT ON `books` FOR EACH ROW BEGIN UPDATE books SET stock =stock-1 WHERE book_id=NEW.book_id; END -->
                        <!-- Edit Modal-->
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModal">Edit Book Data</h5>
                                    </div>
                                    <div class="modal-body" id="edit">
                                        <form action="functions/process_edit.php" method="POST" role="form">
                                            <input type="hidden" name="id" id="book_id" >
                                            <div class="form-group row">
                                                <label  class="col-sm-4 col-form-label" for="title">Title : </label>
                                                <input type="text" class="form-control col-sm-8" name="title" id="title" placeholder="Title">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="author">Author : </label>
                                                <input type="text" class="form-control col-sm-8" name="author" id="author" placeholder="Author" >
                                            </div>
                                            <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="publisher">Publisher : </label>
                                            <input type="text" class="form-control col-sm-8" name="publisher" id="publisher" placeholder="Publisher" >
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="year">Year : </label>
                                                <input type="date" class="form-control col-sm-8" name="year" id="year" placeholder="2007-05-23">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="index">Index : </label>
                                                <input type="text" class="form-control col-sm-8" name="index" id="index" placeholder="Index" >
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="location">Shelf Location : </label>
                                                <input type="text" class="form-control col-sm-8" name="location" id="location" placeholder="Shelf Location">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="stock">Stock : </label>
                                                <input type="text" class="form-control col-sm-8" name="stock" id="stock" placeholder="Stock">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" value="edit" name="editDetail">Edit Book Details</button>
                                            </div>
                                        </form>
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
                                        <h2 class="text-center"><img class="img-profile rounded-circle" src="../img/photo/<?= $_SESSION['photo'];?>" style="max-width: 175px; border: solid black 2px;"></h2>
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

                        <!-- Modal Add -->
                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModal">Add Book</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="add">
                                        <form action="functions/process_add.php" method="POST" role="form" enctype="multipart/form-data">
                                            <input type="hidden" name="book_id" id="book_id">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="title">Book Title</label>
                                                <input type="text" class="form-control col-sm-8" name="title" id="title" placeholder="Book Title">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="author">Author Name</label>
                                                <input type="text" class="form-control col-sm-8" name="author" id="author" placeholder="Author Name">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="publisher">Publisher Name</label>
                                                <input type="text" class="form-control col-sm-8" name="publisher" id="publisher" placeholder="Publisher Name">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="year">Publication Year</label>
                                                <input type="date" class="form-control col-sm-8" name="year" id="year" placeholder="2007-05-23">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="index">Book Index</label>
                                                <input type="text" class="form-control col-sm-8" name="index" id="index" placeholder="Book Index">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="location">Shelf Location</label>
                                                <input type="text" class="form-control col-sm-8" name="location" id="location" placeholder="Shelf Location">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="stock">Book Stock</label>
                                                <input type="text" class="form-control col-sm-8" name="stock" id="stock" placeholder="Book Stock">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="photo">Book Cover</label>
                                                <input type="file" class="form-control col-sm-6" name="photo" id="photo">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" value="add" name="add">Add Book</button>
                                        </div>
                                    </form>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>    
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); // ID From dataTable 
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });

        $(document).on("click","#editButton", function() {
            let book_id=$(this).data("book_id");
            let title=$(this).data("title");
            let author=$(this).data("author");
            let publisher=$(this).data("publisher");
            let year=$(this).data("year");
            let index=$(this).data("index");
            let location=$(this).data("location");
            let stock=$(this).data("stock");
            let photo=$(this).data("photo");

            $("#book_id").val(book_id);
            $("#edit #title").val(title);
            $("#edit #author").val(author);
            $("#edit #publisher").val(publisher);
            $("#edit #year").val(year);
            $("#edit #index").val(index);
            $("#edit #location").val(location);
            $("#edit #stock").val(stock);
            $("#edit #photo").val(photo);
            });
    </script>
</body>
</html>