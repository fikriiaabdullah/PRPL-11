<?php
require_once('koneksi.php');


    // Tangkap data dari formulir pendaftaran
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Sebaiknya gunakan fungsi hash seperti md5 atau bcrypt untuk mengamankan password

    // Query untuk memasukkan data ke dalam tabel users
    $query = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$password')";

    // Lakukan query
    $result = mysqli_query($koneksi, $query);

    if($result) {
        // Jika query berhasil, redirect pengguna ke halaman login.php dengan pesan sukses
        header("Location: login.php?signup=success");
        exit;
    } else {
        // Jika query gagal, tampilkan pesan error atau lakukan tindakan lain sesuai kebutuhan Anda
        echo "Gagal melakukan pendaftaran. Silakan coba lagi.";
    }
?>
