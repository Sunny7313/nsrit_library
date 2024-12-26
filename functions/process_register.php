<?php
session_start();

include('../config.php');

// Admin Register
if (isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

function uploadPhoto(){
    // Get Data Sent from Form
    $file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $file_type = $_FILES['photo']['type'];
    $tmp_file = $_FILES['photo']['tmp_name'];
   
    // Set path folder to save the image
    $path = "../img/photo/".$file_name;
   
    if($file_type == "image/jpeg" || $file_type == "image/png"){ // Check if the uploaded file type is JPG / JPEG / PNG
        // If the uploaded file type is JPG / JPEG / PNG, do:
        if($file_size <= 1000000){ // Check if the uploaded file size is less than or equal to 1MB
            // If the file size is less than or equal to 1MB, do:
            // Process upload
            if(move_uploaded_file($tmp_file, $path)){ // Check if the image was successfully uploaded or not
                return $file_name;
            }else{
                // If the image failed to upload, do:
                echo '<script>
                alert("An error occurred, the image failed to upload");
                </script>';
            }
        }else{
            // If the file size is more than 1MB, do:
            echo '<script>
            alert("Image size is too large!! (max>1MB)");
            </script>';
        }
    }else{
        // If the uploaded file type is not JPG / JPEG / PNG, do:
        echo '<script>
        alert("Image type must be JPG/PNG/JPEG!!");
        </script>';
    }
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    $photo = uploadPhoto();

    if (!$photo){
        return false;
    }

    if ($password == $cpassword) {
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($db, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO user (name, username, password, photo, level)
                    VALUES ('$name','$username', '$password','$photo','Supervisor')";
            $result = mysqli_query($db, $sql);
            if ($result) {
                echo "<script>alert('Welcome to LibraryWeb, ".$name."!!');
                document.location.href='../index.php';</script>";
                $username = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
                
            } else {
                echo "<script>alert('Oops, it seems there is a problem')
                document.location.href='../register.php';</script>";
            }
        } else {
            echo "<script>alert('Oh!! The same username is already registered!')
            document.location.href='../register.php';</script>";
        }
        
    } else {
        echo "<script>alert('Your username or password is incorrect!!')
        document.location.href='../register.php';</script>";
    }
}

?>
