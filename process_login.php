<?php
require_once('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$username' AND password = '$password'");

    if (mysqli_num_rows($query) != 0) {
        // Set session variable
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        // Redirect to dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        // Redirect back to login page with error message
        $notification_message = "Username atau password salah";
        $_SESSION['notification_message'] = $notification_message;
        header('Location: login.php');
        exit;
    }
}
?>
