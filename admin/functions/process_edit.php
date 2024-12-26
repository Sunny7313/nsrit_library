<?php

include("../../config.php");

if(isset($_POST['editSchool'])){
    // Edit School Data
    // Check if the save button has been clicked

    // Get data from the form
    $id = $_POST['id'];
    $college_name = $_POST['college_name'];
    $npsn = $_POST['npsn'];
    $status = $_POST['status'];
    $accreditation = $_POST['accreditation'];
    $education_form = $_POST['education_form'];
    $owner_status = $_POST['owner_status'];
    $college_sk = $_POST['college_sk'];
    $sk_date = $_POST['sk_date'];
    $permit_sk = $_POST['permit_sk'];
    $permit_date = $_POST['permit_date'];

    // Create update query
    $sql = "UPDATE college_data SET college_name='$college_name', npsn='$npsn', status='$status', accreditation='$accreditation', education_form='$education_form', owner_status='$owner_status', college_sk='$college_sk', sk_date='$sk_date', permit_sk='$permit_sk', permit_date='$permit_date' WHERE id=$id";
    $query = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($query);
    
    // Check if the update query was successful
    if($query) {
        // If successful, redirect to the list page
        echo '<script>
        alert("Successfully Updated School Data!!");
        document.location.href="../index.php";
        </script>';
    } else {
        // If failed, display a message
        var_dump($_POST);
        die();
    }
}else{
echo'hgh';
}
// Add Member Data
// Check if the register button has been clicked
if(isset($_POST['register'])){

    // Get data from the form
    $member_id = $_POST['member_id'];
    $name = $_POST['name'];
    $nis = $_POST['nis'];
    $gender = $_POST['gender'];
    $birth_place = $_POST['birth_place'];
    $birth_date = $_POST['birth_date'];
    $address = $_POST['address'];
    $class = $_POST['class'];
    $major_name = $_POST['major_name'];

    // Create query
    $sql = "INSERT INTO member_list (name, nis, gender, birth_place, birth_date, address, class, major_name) VALUES ('$name', '$nis', '$gender', '$birth_place', '$birth_date', '$address', '$class', '$major_name')";
    $query = mysqli_query($db, $sql);

    // Check if the save query was successful
    if($query) {
        // If successful, redirect to the index page with status=success
        echo '<script>
        alert("Successfully Added Member!!");
        document.location.href="../member.php";
        </script>';
    } else {
        // If failed, redirect to the index page with status=failed
        header('Location: ../member.php?status=failed');
    }
}

// Edit Member Data
// Check if the save button has been clicked
else if(isset($_POST['edit'])){

    // Get data from the form
    $member_id = $_POST['member_id'];
    $name = $_POST['name'];
    $nis = $_POST['nis'];
    $birth_place = $_POST['birth_place'];
    $birth_date = $_POST['birth_date'];
    $address = $_POST['address'];
    $class = $_POST['class'];
    $major_name = $_POST['major_name'];

    // Create update query
    $sql = "UPDATE member_list SET name='$name', nis='$nis', birth_place='$birth_place', birth_date='$birth_date', address='$address', class='$class', major_name='$major_name' WHERE member_id=$member_id";
    $query = mysqli_query($db, $sql);

    // Check if the update query was successful
    if($query) {
        // If successful, redirect to the list page
        echo '<script>
        alert("Successfully Updated Member Data!!");
        document.location.href="../member.php";
        </script>';
    } else {
        // If failed, display a message
        header('Location: ../member.php?status=failed');
    }
}

function uploadPhoto(){
    // Get data sent from the form
    $file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $file_type = $_FILES['photo']['type'];
    $tmp_file = $_FILES['photo']['tmp_name'];
   
    // Set the path to save the image
    $path = "../../img/cover/".$file_name;
   
    if($file_type == "image/jpeg" || $file_type == "image/png"){ // Check if the uploaded file type is JPG / JPEG / PNG
        // If the file type is JPG / JPEG / PNG, proceed
        if($file_size <= 1000000){ // Check if the file size is less than or equal to 1MB
            // If the file size is less than or equal to 1MB, proceed
            // Process upload
            if(move_uploaded_file($tmp_file, $path)){ // Check if the image was successfully uploaded
                return $file_name;
            } else {
                // If the image failed to upload, display a message
                echo '<script>
                alert("An error occurred, the image failed to upload");
                </script>';
            }
        } else {
            // If the file size is more than 1MB, display a message
            echo '<script>
            alert("Image size is too large!! (max>1MB)");
            </script>';
        }
    } else {
        // If the uploaded file type is not JPG / JPEG / PNG, display a message
        echo '<script>
        alert("Image type must be JPG/PNG/JPEG!!");
        </script>';
    }
}

// Add Book Data
if(isset($_POST['add'])){

    // Get data from the form
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $index = $_POST['index'];
    $location = $_POST['location'];
    $stock = $_POST['stock'];
    $photo = uploadPhoto();
    if(!$photo){
        return false;
    }
    // Create query
    $sql = "INSERT INTO book_list (title, author, publisher, year, index, location, stock, photo) VALUES ('$title', '$author', '$publisher', '$year', '$index', '$location', '$stock', '$photo')";
    $query = mysqli_query($db, $sql);

    // Check if the save query was successful
    if($query) {
        // If successful, redirect to the index page with status=success
        echo '<script>
        alert("Successfully Added Book!!");
        document.location.href="../book.php";
        </script>';
    } else {
        // If failed, display a message
        header('Location: ../book.php?status=failed');
    }
}

// Edit Book Cover
else if(isset($_POST['cover'])){
    // Get data from the form
    $id = $_POST['id'];
    $photo = uploadPhoto();

    if(!$photo){
        return false;
    }
    // Create query
    $sql = "UPDATE book_list SET photo='$photo' WHERE book_id=$id";
    $query = mysqli_query($db, $sql);

    // Check if the save query was successful
    if($query) {
        // If successful, redirect to the index page with status=success
        echo '<script>
        alert("Successfully Updated Book Cover!!");
        document.location.href="../detail.php";
        </script>';
    } else {
        // If failed, display a message
        header('Location: ../detail.php?status=failed');
    }
}

// Edit Book Details (Without Photo)
else if(isset($_POST['editDetails'])){
    // Get data from the form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $index = $_POST['index'];
    $location = $_POST['location'];
    $stock = $_POST['stock'];

    // Create query
    $sql = "UPDATE book_list SET title='$title', author='$author', publisher='$publisher', year='$year', index='$index', location='$location', stock='$stock' WHERE book_id=$id";
    $query = mysqli_query($db, $sql);

    // Check if the save query was successful
    if($query) {
        // If successful, redirect to the index page with status=success
        echo '<script>
        alert("Successfully Updated Book Details!!");
        document.location.href="../book.php";
        </script>';
    } else {
        // If failed, display a message
        header('Location: ../book.php?status=failed');
    }
}

// Add Borrowing Data
else if(isset($_POST['addBorrow'])){

    // Get data from the form
    $borrow_id = $_POST['borrow_id'];
    $title = $_POST['title'];
    $name = $_POST['name'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = strtotime("+7 day", strtotime($borrow_date)); // +7 days from the borrow date
    $return_date = date('Y-m-d', $return_date); // format borrow date year-month-day
    $quantity = $_POST['quantity'];

    // Create query
    $query = mysqli_query($db, "INSERT INTO borrow_list (title, name, borrow_date, return_date, quantity) VALUES ('$title', '$name', '$borrow_date', '$return_date', '$quantity')");

    // Check if the save query was successful
    if($query) {
        // If successful, redirect to the index page with status=success
        echo '<script>
        alert("Successfully Added Borrowing Data!!");
        document.location.href="../borrow.php";
        </script>';
    } else {
        // If failed, display a message
        header('Location: ../borrow.php?status=failed');
    }
}

// Edit Borrowing Details
else if(isset($_POST['editData'])){
    var_dump($_POST);
    // Get data from the form
    $id = $_POST['borrow_id'];
    $title = $_POST['title'];
    $name = $_POST['name'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = strtotime("+7 day", strtotime($borrow_date)); // +7 days from the borrow date
    $return_date = date('Y-m-d', $return_date); // format borrow date year-month-day
    $quantity = $_POST['quantity'];

    // Create query
    $sql = "UPDATE borrow_list SET title='$title', name='$name', borrow_date='$borrow_date', return_date='$return_date', quantity='$quantity' WHERE borrow_id=$id";
    $query = mysqli_query($db, $sql) or die(mysqli_error($db));

    // Check if the save query was successful
    if($query) {
        // If successful, redirect to the index page with status=success
        echo '<script>
        alert("Successfully Updated Borrowing Details!!");
        document.location.href="../borrow_detail.php";
        </script>';
    } else {
        // If failed, display a message
        header('Location: ../borrow.php?status=failed');
    }
}

// Edit Admin Data
// Check if the save button has been clicked
if(isset($_POST['editAdmin'])){

    // Get data from the form
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $level = $_POST['level'];

    // Create update query
    $sql = "UPDATE user SET username='$username', password='$password', name='$name', email='$email', phone='$phone', level='$level' WHERE username='$username'";
    $query = mysqli_query($db, $sql);

    // Check if the update query was successful
    if($query) {
        // If successful, redirect to the list page
        echo '<script>
        alert("Successfully Updated Admin Data!!");
        document.location.href="../admin.php";
        </script>';
    } else {
        // If failed, display a message
        header('Location: ../admin.php?status=failed');
    }
}
?>
