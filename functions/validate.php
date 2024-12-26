<?php 
session_start();
include('../config.php');

// Turn off error reporting in production
error_reporting(0);

// Redirect if already logged in
if (isset($_SESSION['password'])) {
    header("Location: ../index.php");
    exit;
}
$a=$_POST['username'];
// Check if the form is submitted
if (isset($_POST['login'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = md5(trim($_POST['password'])); // Note: Replace `md5` with a more secure hashing mechanism if possible.

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Set session variables
        $_SESSION['name'] = $row['name'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['photo'] = $row['photo'];
        $_SESSION['level'] = $row['level'];

        // Regenerate session ID to prevent fixation attacks
        session_regenerate_id(true);

        // Redirect based on user level
        $redirectUrl = match ($row['level']) {
            'Admin' => '../admin/index.php',
            'Supervisor' => '../supervisor/index.php',
            'User' => '../user/index.php',
            default => '../index.php?message=Unauthorized access'
        };

        echo "<script>
                alert('Welcome back, {$username}!');
                window.location.href = '{$redirectUrl}';
              </script>";
    } else {
        // Invalid username or password
        echo "<script>
                alert('".$a."Oops, the username or password you entered is incorrect!');
                window.location.href = '../index.php';
              </script>";
    }
}
?>
